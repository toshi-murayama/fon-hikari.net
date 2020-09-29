<?php
ini_set("memory_limit", "400M");
require_once '../../lib/SearchSupportedAreasFunctions.php';


function startsWith($haystack, $needle) {
  return (strpos($haystack, $needle) === 0);
}
function toSjis($array) {
  $converted = [];
  foreach($array as $i => $col) {
    $converted[$i] = mb_convert_encoding($col, 'SJIS-win', 'UTF-8' );
  }
  return $converted;
}

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
  $filename = '../../lib/SearchSupportedAreas/'.$prefCode.'.php';

  if (file_exists($filename)) {
    $in = include $filename;
    $PREFECTURES_ADRESSES[$pref] = $in;
  } else {
    $PREFECTURES_ADRESSES[$pref] = [];
  }
}



//---------------------------------------------------------------
// CSVの1行1行とメモリ上の住所をマッチングする
//---------------------------------------------------------------

$f = fopen('./架電要クリーニングリスト.csv', 'r');

// ヘッダー部分を雑に読み飛ばす
fgetcsv($f);

$outeputFP = fopen("./converted.csv", "w");
   fputcsv($outeputFP, toSjis(["電話番号","名前","ふりがな","郵便番号","都道府県","市区町村","該当地域", "NURO光対象局舎","要注意エリア","備考","開局時期","10G"]));
// fputcsv($outeputFP,        ["電話番号","名前","ふりがな","郵便番号","都道府県","市区町村","該当地域", "NURO光対象局舎","要注意エリア","備考","開局時期","10G"]);

$matches = [];
$loop = 0;
while($line = fgetcsv($f)){
  $pref = $line[4];
  $address = mb_convert_kana($line[4] . $line[5], 'N');//数値を全角に寄せる
  $address  = preg_replace("/( |　)/", "", $address);//スペース削除

  $mostMatched = ["","","","","",""];
  $mostMatchedLength = 0;


  foreach($PREFECTURES_ADRESSES[$pref] as $datasetAddress => $row) {
    // $matched = [];
    $matchedLength = 0;
    $matchedDatasetAddress = '';

    foreach(preg_split("//u", $address, -1, PREG_SPLIT_NO_EMPTY) as $i => $s) {
      if (mb_substr($address, $i, 1) === mb_substr($datasetAddress, $i, 1) ) {

        // $matched = $row;
        $matchedLength = $i+1;
        $matchedDatasetAddress = $datasetAddress;
      } else {
        //マッチしなかった
        break;
      }
      // echo $s."\n";
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
  echo $loop . "  " . date('H:i:s') .  "  " . memory_get_usage() ."\n";


     fputcsv($outeputFP, toSjis([$line[0], $line[1], $line[2], $line[3], $line[4], $line[5], $mostMatched[0], $mostMatched[1], $mostMatched[2], $mostMatched[3], $mostMatched[4],$mostMatched[5]]));
  // fputcsv($outeputFP,        [$line[0], $line[1], $line[2], $line[3], $line[4], $line[5], $mostMatched[0], $mostMatched[1], $mostMatched[2], $mostMatched[3], $mostMatched[4],$mostMatched[5]]);

}
fclose($f);
fclose($outeputFP);


// echo json_encode($matches, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
