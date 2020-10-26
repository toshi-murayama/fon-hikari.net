<?php
/**
 * 住所クリーニング画面
 */
ini_set('memory_limit', '400M'); // 住所配列が巨大なので適当にメモリを確保する
date_default_timezone_set('Asia/Tokyo');
set_time_limit(60 * 60 * 12); // 12時間位に制限をかける

require_once '../../../lib/BasicAuth.php';
require_once '../../../lib/SearchSupportedAreasFunctions.php';

if ($_SERVER['HTTP_HOST'] !== 'stg.fon-hikari.net') { // stg環境でなければBasic認証する
  BasicAuth::exitIfFails(); // Basic認証に失敗したら終了する
}

function h($h_string){
	return htmlspecialchars($h_string,ENT_QUOTES);
}

/**
 * アップロードされたCSVと、
 * NURO光提供エリアの配列を付き合わせ、
 * その結果をアップロードされたCSVファイルの右側に追記した
 * ものをダウンロードさせる。
 * 
 * 社内用のツールなので適当なclass実装になっています。
 * 
 * bat/area_matching を元に作ってます。
 */
class AreaMatching {

  const UPLOAD_FILE_NAME = 'csv';

  public $errorMessage = '';

  public function hasError()
  {
    return $this->errorMessage !== '';
  }

  public function posted()
  {
    return isset($_FILES[static::UPLOAD_FILE_NAME]);
  }

  public function validateUploadedFile()
  {
    if (!isset($_FILES[static::UPLOAD_FILE_NAME]['error']) || !is_int($_FILES[static::UPLOAD_FILE_NAME]['error'])) {
      $this->errorMessage = 'アップロードしたファイルに問題がありました。csvファイルを修正してください。';
      return false;
    }
    if (!isset($_FILES[static::UPLOAD_FILE_NAME]['name'])) {
      $this->errorMessage = 'アップロードしたファイルに問題がありました。csvファイルを修正してください。';
      return false;
    }
    // mimetypeが 'text/csv' と返らないケースがあるのでmimetypeでの確認はしないが、
    // 代わりに簡易的に拡張子でのチェックを行う。
    // csvファイルをアップロードするのは社員なので拡張子偽装は考慮しない。
    if (pathinfo($_FILES[static::UPLOAD_FILE_NAME]['name'], PATHINFO_EXTENSION) !== 'csv') {
      $this->errorMessage = 'アップロードしたファイルがcsv形式ではありませんでした。ファイルを修正してください。';
      return false;
    }
    return true;
  }

  /**
   * csvファイルを作って、csvダウンロードませさせます。
   * 失敗した時はfalseを返し、csvダウンロードは行いません。
   * 
   * @return bool
   */
  public function execute() {

    $PREFECTURES = [
      '北海道',
      '青森県',
      '岩手県',
      '宮城県',
      '秋田県',
      '山形県',
      '福島県',
      '茨城県',
      '栃木県',
      '群馬県',
      '埼玉県',
      '千葉県',
      '東京都',
      '神奈川県',
      '山梨県',
      '長野県',
      '新潟県',
      '富山県',
      '石川県',
      '福井県',
      '岐阜県',
      '静岡県',
      '愛知県',
      '三重県',
      '滋賀県',
      '京都府',
      '大阪府',
      '兵庫県',
      '奈良県',
      '和歌山県',
      '鳥取県',
      '島根県',
      '岡山県',
      '広島県',
      '山口県',
      '徳島県',
      '香川県',
      '愛媛県',
      '高知県',
      '福岡県',
      '佐賀県',
      '長崎県',
      '熊本県',
      '大分県',
      '宮崎県',
      '鹿児島県',
      '沖縄県'
    ];

    //---------------------------------------------------------------
    // 住所の配列をメモリに展開する
    //---------------------------------------------------------------

    $PREFECTURES_ADRESSES = [];
    foreach ($PREFECTURES as $pref) {
      $prefCode = SearchSupportedAreasFunctions::toAlphabet($pref);
      $filename = '../../../lib/SearchSupportedAreas/'.$prefCode.'.php';

      if (file_exists($filename)) {
        $in = include $filename;
        $PREFECTURES_ADRESSES[$pref] = $in;
      } else {
        $PREFECTURES_ADRESSES[$pref] = [];
      }
    }

    try {

      //---------------------------------------------------------------
      // 入力CSVファイルの1行目（ヘッダー）を読み込む
      //---------------------------------------------------------------
      $f = fopen($_FILES[static::UPLOAD_FILE_NAME]['tmp_name'], 'r');
      $header = fgetcsv($f);

      if (!$header) throw new Exception('csv読み込みに失敗しました。csvファイルを修正してください。');
      if (count($header) !== 7) throw new Exception('列の数に誤りがありました。csvファイルを修正してください。');


      //---------------------------------------------------------------
      // 出力CSVにヘッダーを書き込む
      // 
      // Windows版Excelでcsvを開いた時、文字化けしないよう
      // 下記のフォーマットのCSVを出力する。
      // - UTF-8 with BOM
      // - CRLF
      // https://qiita.com/mpyw/items/2795bef3ed561f4cf4e9
      //---------------------------------------------------------------
      $outputFP = tmpfile();
      $meta = stream_get_meta_data($outputFP);
      $outputFilepath = $meta['uri'];
      fwrite($fp, "\xEF\xBB\xBF"); // BOM追加

      fputcsv(
        $outputFP,
        array_merge($header, ["該当地域", "NURO光対象局舎","要注意エリア","備考","開局時期","10G"])
      );

      // LF --> CRLF に変換
      fseek($outputFP, -1, SEEK_CUR);
      fwrite($outputFP, "\r\n");


      //---------------------------------------------------------------
      // 入力CSVの1行1行とメモリ上の住所をマッチングして、出力CSVに書き込む
      //---------------------------------------------------------------
      $loop = 0;
      while($line = fgetcsv($f)){
        $pref = $line[5];
        $address = mb_convert_kana($line[5] . $line[6], 'N');//数値を全角に寄せる
        $address  = preg_replace('/( |　)/', '', $address);//スペース削除

        $mostMatched = ['','','','','',''];
        $mostMatchedLength = 0;

        foreach($PREFECTURES_ADRESSES[$pref] as $datasetAddress => $row) {
          $matchedLength = 0;
          $matchedDatasetAddress = '';

          foreach(preg_split("//u", $address, -1, PREG_SPLIT_NO_EMPTY) as $i => $s) {
            if (mb_substr($address, $i, 1) === mb_substr($datasetAddress, $i, 1) ) {
              $matchedLength = $i+1;
              $matchedDatasetAddress = $datasetAddress;
            } else {
              //マッチしなかった
              break;
            }
          }
          if ($mostMatchedLength < $matchedLength) {
            $mostMatched[0] = $matchedDatasetAddress;
            $mostMatched[1] = $row[0];
            $mostMatched[2] = $row[1];
            $mostMatched[3] = $row[2];
            $mostMatched[4] = $row[3];

            if (count($row)===5) {
              // 関西
              $mostMatched[1] = $row[0];
              $mostMatched[2] = $row[2];
              $mostMatched[3] = $row[3];
              $mostMatched[4] = $row[4];
              $mostMatched[5] = $row[1];
            } else {
              //関東
              $mostMatched[1] = $row[0];
              $mostMatched[2] = $row[1];
              $mostMatched[3] = $row[2];
              $mostMatched[4] = $row[3];
              $mostMatched[5] = '';
            }

            $mostMatchedLength = $matchedLength;
          }
        }
        $loop++;

        fputcsv(
          $outputFP,
          array_merge($line, $mostMatched)
        );

        // LF --> CRLF に変換
        fseek($outputFP, -1, SEEK_CUR);
        fwrite($outputFP, "\r\n");
      }

      header('Content-Type: application/octet-stream');
      header('Content-Length: '.filesize($outputFilepath));
      header('Content-Disposition: attachment; filename=converted_'.date('Ymd_His').'.csv');

      readfile($outputFilepath);
      fclose($f);
      fclose($outputFP);

      return true; // 成功

    } catch (Exception $e) {

      $this->errorMessage = $e->getMessage();

    }

    return false; // 異常があった

  }

}

$matching = new AreaMatching();
if ($matching->posted() && $matching->validateUploadedFile()) {
  if ($matching->execute()) {
    // メソッドの中でcsvファイルを出力しているのでexitする
    exit;
  }
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>住所クリーニング</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  </head>
  <body>

    <div class="container">

      <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">

          <h1 class="my-5">住所クリーニング</h1>

          <?php if ($matching->hasError()) { ?>
            <div class="alert alert-danger" role="alert">
              <h4 class="alert-heading font-weight-bold">エラー</h4>
              <p class="mb-0"><?php echo h($matching->errorMessage); ?></p>
            </div>
          <?php } ?>

          <div class="card mb-5 shadow">
            <div class="card-header">
              CSVファイルアップロード
            </div>
            <div class="card-body">
              <form method="POST" enctype="multipart/form-data">

                <div class="form-group">
                  <input type="file" class="form-control-file" name="csv" accept=".csv">
                </div>

                <button type="submit" class="btn btn-primary">送信</button>
              </form>
            </div>
          </div>

          <div class="card mb-5 shadow">
            <div class="card-header">
              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-question-circle align-text-bottom" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
              </svg>
              ヘルプ
            </div>
            <div class="card-body">

              <h4 class="mb-4"><b>使い方</b></h4>
              <ul>
                <li class="mt-4">
                  csvファイルを選択して、送信ボタンをクリックしてください。
                  <br>
                  <img src="./image3.png" class="img-thumbnail shadow-sm">
                </li>
                <li class="mt-4">
                  処理が始まり、Chromeのアイコンがクルクル回りますので、そのままお待ちください。
                  <br>
                  件数が少なければ数秒で終わりますが、件数が多い場合は数十分かかることもあります。
                  <br>
                  <img src="./image5.png" class="img-thumbnail shadow-sm">
                </li>
                <li class="mt-4">
                  無事に処理が終わるとcsvがダウンロードされます。アップロードしたcsvファイルの列の右側に対応エリアかどうかの結果が追記されたcsvがダウンロードされます。
                  <br>
                  <img src="./image4.png" class="img-thumbnail shadow-sm">
                </li>
              </ul>

              <h4 class="mt-5 mb-4"><b>アップロードするCSVファイルの形式について</b></h4>
              <ul>
                <li class="mt-4">
                  CSVの1行目はヘッダーをA〜G列に記載してください。何を記載しても良いです。
                </li>
                <li class="mt-4">
                  <p>
                    CSVの2行目以降に実際の住所を記載してください。<br>
                    F列とG列には住所を記載しますが、A〜E列は任意の値を記入していただいて問題ないです。
                  </p>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col"></th>
                        <th scope="col">A列目</th>
                        <th scope="col">B列目</th>
                        <th scope="col">C列目</th>
                        <th scope="col">D列目</th>
                        <th scope="col">E列目</th>
                        <th scope="col">F列目</th>
                        <th scope="col">G列目</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><b>入力値</b></td>
                        <td>任意</td>
                        <td>任意</td>
                        <td>任意</td>
                        <td>任意</td>
                        <td>任意</td>
                        <td>
                          都道府県
                        </td>
                        <td>
                          都道府県以降の住所
                        </td>
                      </tr>
                      <tr>
                        <td><b>例1</b></td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>
                          東京都
                        </td>
                        <td>
                          板橋区大谷口北町85-1
                        </td>
                      </tr>
                      <tr>
                        <td><b>例2</b></td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>
                          京都府
                        </td>
                        <td>
                          京都市右京区西院西寿町　18
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </li>
                <li class="mt-4">
                  以下はCSVの例です。
                  <br>
                  <img src="./image1.png" class="img-thumbnail shadow-sm">
                </li>
                <li class="mt-4">
                  文字コードはUTF-8です。Excelにて名前を付けて保存する際「CSV UTF-8」で保存してください。
                  <br>
                  <img src="./image2.png" class="img-thumbnail shadow-sm">
                </li>
                <li class="mt-4">
                  <p>
                    アップロードするcsvファイルのファイルサイズが大きい場合エラーになる可能性があります。
                    <br>
                    もしも <code>413 Request Entity Too Large</code> と表示されたら連絡ください。
                  </p>
                </li>
              </ul>

            </div>
          </div>

        </div>
      </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html>