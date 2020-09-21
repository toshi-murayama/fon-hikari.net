<?php
/**
 * 働くDBのAPIにデータ送信を行う
 *
 * TODO: hataraku_import.php 内に重複しているコードを当クラスに集約する
 */
class HatarakuDb
{

  const BOUNDARY = "-+-+-+-+-+-+-+-+-Boundary_";
  const CRLF = "\r\n";

  const URL_MULTI_API = "api";
  const URL_SINGLE_API = "apirecord";

  const API_TYPE_FILE_UPLOAD = "fileupload";
  const API_TYPE_CSV_IMPORT = "csvimport";
  const API_TYPE_CHECK_CSV_IMPORT_PROCESS = "checkcsvimportprocess";
  const API_TYPE_CSV_EXPORT = "csvexport";
  const API_TYPE_CSV_DATA_IMPORT = "csvdataimport";

  const API_TYPE_RECORD_REGIST = "regist";
  const API_TYPE_RECORD_UPDATE = "update";
  const API_TYPE_RECORD_DELETE = "delete";
  const API_TYPE_RECORD_VIEW = "view";

  // 可変
  // 接続先URLに利用する設定
  // https://●●●●●/■■■■■/api/API種別/version/▲▲▲
  const DOMAIN = "hdscarlet.htdb.jp";
  const SCHEMA = "s5d7caa";
  const VERSION = "v1";

  // APIトークン（リクエストヘッダで利用します）
  // 管理者設定　＞　ユーザ設定　＞　ユーザ管理　＞　ユーザ情報設定で発行
  const API_TOKEN = "Ea7PtHXTmrzOfhvtL0zecdogMI9mPJh1MnY9vV62venThYgIA7vlSVw4YjGiKh0d";

  // FONJAPAN01
  const API_TOKEN2 = 'w1trxiJtCEVwONtgW6gb9pf2aviDZGhOsmKwiyN1qDsd3ql0ZYj985FxwRkJL6R1';


  /**
   * @var string 働くDB APIからのレスポンスボディ
   */
  public $responseBody = null;
  /**
   * @var string 働くDB APIからのレスポンスステータスコード
   */
  public $responseCode = null;
  /**
   * APIから返ってきたstatus値を返す
   *
   * 成功したら：success
   *
   * @var string|null
   */
  protected $responseStatus = null;
  /**
   * ネットワーク層のエラー文字列
   *
   * curl_error
   *
   * @var string
   */
  protected $error;
  /**
   * ネットワーク層のエラー番号
   *
   * curl_errno
   *
   * @var int
   */
  protected $errorNo;

  /**
   * sendRequest
   *
   * 働くDB側から受領したサンプルをほぼそのまま移植したメソッド。
   * 受領したサンプルはバグが多いのでそのまま使うのはリスクがある。
   * ※変数名が間違っている、APIの戻り値の前後にゴミデータが混ざるなど
   *
   * @deprecated
   * 非推奨メソッドです。
   * 新規実装する場合、このメソッドは使わないでください。
   *
   * @param $urlType string URLの種別
   * @param $apiType string APIの種別
   * @param $requestBody array リクエストのBody
   * @param $csvDataImportBody mixed CSVデータインポートのBody
   * @return mixed|string API種別によりデータを返します
   */
  public function sendRequest($urlType, $apiType, $requestBody, $csvDataImportBody = null) {
    if (!is_array($requestBody)) {
      die("リクエストデータは配列で指定してください。\n");
    }

    switch ($apiType) {
      case static::API_TYPE_FILE_UPLOAD:
        $BOUNDARY = static::BOUNDARY . uniqid('h');
        $REQUEST_CONTENT_TYPE = "Content-Type: multipart/form-data;boundary=" . $BOUNDARY;
        $tmpRequestBody[] = "--" . $BOUNDARY;
        $tmpRequestBody[] = "Content-Disposition: form-data; name='uploadFile'; filename='uploadFile.csv'";
        $tmpRequestBody[] = "Content-Type: text/csv;charset=UTF-8";
        $tmpRequestBody[] = "";
        foreach ($requestBody as $value) {
          $tmpRequestBody[] = mb_convert_encoding($value, "sjis-win", "UTF-8");
        }
        $tmpRequestBody[] = "--" . $BOUNDARY . "--";
        break;
      case static::API_TYPE_CSV_IMPORT:
      case static::API_TYPE_CHECK_CSV_IMPORT_PROCESS:
      case static::API_TYPE_CSV_EXPORT:
      case static::API_TYPE_RECORD_REGIST:
      case static::API_TYPE_RECORD_UPDATE:
      case static::API_TYPE_RECORD_VIEW:
      case static::API_TYPE_RECORD_DELETE:
        $REQUEST_CONTENT_TYPE = "Content-Type: application/json;charset=UTF-8";
        $tmpRequestBody = $requestBody;
        break;
      case static::API_TYPE_CSV_DATA_IMPORT:
        $BOUNDARY = static::BOUNDARY . uniqid('h');
        $REQUEST_CONTENT_TYPE = "Content-Type: multipart/form-data;boundary=" . $BOUNDARY;

        $tmpRequestBody[] = "--" . $BOUNDARY;
        $tmpRequestBody[] = "Content-Disposition: form-data; name='json'";
        $tmpRequestBody[] = "Content-Type: application/json;charset=UTF-8";
        $tmpRequestBody[] = "";
        $tmpRequestBody[] = $csvDataImportBody;

        $tmpRequestBody[] = "--" . $BOUNDARY;
        $tmpRequestBody[] = "Content-Disposition: form-data; name='uploadFile'; filename='uploadFile.csv'";
        $tmpRequestBody[] = "Content-Type: text/csv;charset=UTF-8";
        $tmpRequestBody[] = "";
        foreach ($requestBody as $value) {
          $tmpRequestBody[] = mb_convert_encoding($value, "sjis-win", "UTF-8");
        }
        $tmpRequestBody[] = "--" . $BOUNDARY . "--";
        break;
      default:
        die("API種別の指定が正しくありません。[ " . $apiType . " ]\n");
    }
    $REQUEST_BODY = implode(static::CRLF, $tmpRequestBody);

    $REQUEST[] = "POST /" . static::SCHEMA . "/" . $urlType . "/" . $apiType . "/version/" . static::VERSION . " HTTP/1.1";
    $REQUEST[] = "Host: " . static::DOMAIN;
    $REQUEST[] = $REQUEST_CONTENT_TYPE;
    $REQUEST[] = "Content-Length: ".strlen($REQUEST_BODY);
    $REQUEST[] = "X-HD-apitoken: " . static::API_TOKEN;
    $REQUEST[] = "Cache-Control: no-cache";
    $REQUEST[] = "Connection: Close";
    $REQUEST[] = "";
    $REQUEST[] = $REQUEST_BODY;

    $context = stream_context_create();
    $result = stream_context_set_option($context, 'ssl', 'verify_peer', false);
    $result = stream_context_set_option($context, 'ssl', 'verify_host', false);
    $fp = stream_socket_client('ssl://' . static::DOMAIN . ':443', $errno, $errstr, 10, STREAM_CLIENT_CONNECT, $context);

    if (!$fp) {
      return "接続に失敗しました。errorNo : [ " . $errno . " ]  errorMessage : [ " . $errstr. " ]\n";
    }

    fputs($fp, implode(static::CRLF, $REQUEST));

    $RESPONSE_HEADER = ""; // HTTPヘッダー
    $RESPONSE_BODY = ""; // レスポンスデータ

    // HTTPヘッダの取得
    while (!feof($fp)) {
      $temporaryData = fgets($fp, 4096);
      if (preg_match("/^content-type:.+$/i", $temporaryData, $matches)) {
        $CONTENT_TYPE = $matches[0];
      }
      if (preg_match('/^(\r|\n)+$/x', $temporaryData)) {
        break;
      }
      $RESPONSE_HEADER .= $temporaryData;
    }

    // 結果の取得
    while (!feof($fp)) {
      $RESPONSE_BODY .= fgets($fp, 4096);
    }
    fclose($fp);

    $this->responseBody = $RESPONSE_BODY;
    if (preg_match("/application\/json/i", $CONTENT_TYPE)) {
      $JSON_RESPONSE = json_decode($RESPONSE_BODY, TRUE);

      $this->responseCode = $JSON_RESPONSE["code"];
      if ($JSON_RESPONSE["code"] == 200) {
          return $JSON_RESPONSE["code"];
      } else {
          return $JSON_RESPONSE["code"]."\n".$RESPONSE_BODY;
          //var_dump($RESPONSE_BODY);
      }
    } else {
      $tmp = $RESPONSE_BODY;
      $eol ="\r\n";
      $add = strlen($eol);
      $str = '';
      do {
        $tmp = ltrim($tmp);
        $pos = strpos($tmp, $eol);
        if ($pos === false) {
          break;
        }
        $len = hexdec(substr($tmp, 0, $pos));
        if (!is_numeric($len) or $len < 0) {
          break;
        }
        $str .= substr($tmp, ($pos + $add), $len);
        $tmp = substr($tmp, ($len + $pos + $add));
        $check = trim($tmp);
      } while(!empty($check));
      $RESPONSE_BODY = $str;

      return $RESPONSE_BODY;
    }
  }

  /**
   * SBN Wi-Fiを1行更新する
   *
   * @param string $keyId
   * @param array  $value
   *
   * @return bool|mixed
   */
  public function updateSbnWifiByKeyId(string $keyId, array $value)
  {
    // ローカル環境でのテスト用に固定値を返す
    if($_SERVER['HTTP_HOST'] == 'localhost') {
      if(1) {
        // 正常系
        $this->responseStatus = 'success';
        $this->responseCode = '200';
        $this->responseBody = '{"status":"success","code":"200","url":"http:\/\/hdgarnet.htdb.jp\/d4q2uya\/apirecord\/update\/version\/v1","query":{"dbSchemaId":"100967","keyId":"00403999018831","values":{"111099":"解約予定端末待ち","111152":"2020年07月01日","details":[{"111139":"2020\/06\/10 14:15","113716":"受信","111140":"自動処理","111141":"aaa\nbbbb"}]}},"items":{"keyId":"00403999018831","id":"90251"},"version":"v1","accessTime":"2020-06-10 14:15:13 +0900"}';
        return json_decode($this->responseBody);
      } else if(1) {
        // 入力値エラー
        $this->responseStatus = 'error';
        $this->responseCode = '400';
        $this->responseBody = '{"status":"error","code":"400","url":"http:\/\/hdgarnet.htdb.jp\/d4q2uya\/apirecord\/update\/version\/v1","query":{"dbSchemaId":"100967","keyId":"00403999018831","values":{"111099":"解約予定端末待ちaaaa","111152":"2020年07月01日","details":[{"111139":"2020\/06\/10 15:57","113716":"受信","111140":"自動処理","111141":"aaa\nbbbb"}]}},"errors":{"code":"100","msg":"パラメータが不正です。","description":{"header":[{"name":"111099","value":"解約予定端末待ちaaaa","code":"37","msg":"\'ステータス\'に選択された値は、選択肢として設定されていません。"}]}},"version":"v1","accessTime":"2020-06-10 15:57:30 +0900"}';
        return json_decode($this->responseBody);
      } else {
        // 更新対象が存在しない場合のエラー
        $this->responseStatus = 'error';
        $this->responseCode = '400';
        $this->responseBody = '{"status":"error","code":"400","url":"http:\/\/hdgarnet.htdb.jp\/d4q2uya\/apirecord\/update\/version\/v1","query":{"dbSchemaId":"100967","keyId":"11111119999922","values":{"111152":"2020年07月01日","details":[{"111139":"2020\/06\/11 10:26","113716":"受信","111140":"自動処理","111141":"aaa\nbbbb"}]}},"errors":{"code":"100","msg":"パラメータが不正です。","description":[{"name":"keyId","value":"11111119999922","code":"8","msg":"紐づくデータが存在しません。"}]},"version":"v1","accessTime":"2020-06-11 10:26:39 +0900"}';
        return json_decode($this->responseBody);
      }
    }


    $token = static::API_TOKEN2;
    $result = $this->update([
      'dbSchemaId' => '100967',
      'keyId' => $keyId,
      'values' => $value,
    ], $token);
    if(!$result) return false;
    return json_decode($this->responseBody);
  }

  /**
   * SBN Wi-Fi を KeyId（自動採番）を使って検索する
   * @param $keyId
   * @return bool|mixed
   */
  public function findSbnWifiByKeyId($keyId)
  {
    // ローカル環境でのテスト用に固定値を返す
    if ($_SERVER['HTTP_HOST'] == 'localhost') {
      if (0) {
        // 正常系
        $a = '{"status":"success","code":"200","url":"http:\/\/hdgarnet.htdb.jp\/d4q2uya\/apirecord\/view\/version\/v1","query":{"dbSchemaId":"100967","keyId":"0053402","responseType":"1"},"items":{"[ID]":"53390","[登録日]":"2020\/01\/15 16:55","[登録ユーザ]":"自動インポート用","[更新日]":"2020\/06\/02 17:57","[更新ユーザ]":"FON JAPAN","申込プランID":"00122","自動採番":"0053402","ステータス":"解約予定","申込プラン名":"★SBN基本プラン","月額(キャンペーン)":"\\\\3,630","獲得台数":"1","決済方法":"クレカ決済","契約者":"佐藤　悠哉","生年月日":"1972\/12\/07","性別":"男性","電話番号":"","携帯番号":"09011112222","メールアドレス":"onepiecedeguchi@gmail.com","カード名義":"YUYA SATOU","郵便番号":"920-3116","住所":"金沢市南森本町　100-200","発送先名":"佐藤　悠哉","発送先郵便番号":"920-3116","発送先住所":"金沢市南森本町　100-200","初回発送台数":"1","W04":"","W05":"","601HW":"","FS030W":"1","E5383s":"","801ZT":"","602HW":"","W06":"","WX05":"","クレカ番号":"","クレカ有効期限":"","クレカ名義人":"","ｾｷｭﾘﾃｨｺｰﾄﾞ":"","カード会社":"","決済システムID":"1579074929570000","有効期限":"","キャンセル理由":"","領収書発行日":"","課金フラグ":"","セキュリティコード":"","営業備考":"","業務備考":"","details":[{"行":"1","対応日時":"2020\/01\/18 17:00","対応方法":"","対応者名":"メール送信　木場","対応履歴":"お客様各位\n事業譲渡に関するお知らせ\n \n拝啓　益々ご清祥のこととお慶び申し上げます。\n平素は格別のご高配を賜り、厚くお礼申し上げます。\n \nさて、この度、株式会社クーペックスの事業である\nレンタルWi-Fi事業「縛りなしWi-Fi」\n（縛りなしプラン、縛っちゃうプラン等レンタルWi-Fi事業全てを含みます。）を\nフォン・ジャパン株式会社が譲り受けることで合意し、事業譲渡契約を締結いたしました。\n株式会社クーペックスに対し、永年にわたり賜わりましたご愛顧ご厚情に対しお礼申し上げます。\n今後は新たな体制で皆様のご要望にお応えしていく所存でございますので、\nご高承の上ご指導ご鞭撻を賜りますようお願い申し上げます。\nまずは、略儀ながら書中をもってご案内、ご挨拶申し上げます。\n敬具\n　令和２年１月１７日\n株式会社クーペックス　代表取締役　金森玄　　\nフォン・ジャパン株式会社　代表取締役　横田和典　\n \n　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　\n \n \n \n下記事業譲渡により、株式会社クーペックスの行ってきた\n「縛りなしWi-Fi」事業をフォン・ジャパン株式会社が引き継ぎ、\n株式会社クーペックスが有していたお客様各位に対する料金債権を含む契約上の地位も、\n全てフォン・ジャパン株式会社が引き継ぎます。\n事業譲渡日以降、お客様各位との間における「縛りなしWi-Fi」についてのサービス提供は、\n全てフォン・ジャパン株式会社が行いますので、\n営業主体の変更についてご認識頂いた上\nこれまでと変わらずご愛顧を賜りますよう、何卒よろしくお願い致します。\n以上をもって、事業譲渡のご挨拶とさせて頂きます。\n \n記\n \n【事業譲受会社】  フォン・ジャパン株式会社\n　〒171-0014 東京都豊島区池袋２丁目１４?４ 池袋TAビル8F\n【事業譲渡契約日】 令和２年１月１７日\n【事業譲渡日】   令和２年１月１７日\n【本件に関する窓口】フォン・ジャパン株式会社 電話番号0120-541-226","解約対応者":"","解約対応履歴":"","解約台数":""},{"行":"2","対応日時":"2020\/02\/20 18:20","対応方法":"","対応者名":"メール送信　柴田","対応履歴":"平素より大変お世話になっております。\n縛りなしWiFiをご利用いただき誠にありがとうございます。\n本メールはご利用が《2ヶ月目》のお客様を対象に一斉送信しております。\n\n弊社では毎月27日にご利用料金をご請求しております。\n今後、当月ご利用分として、毎月27日に請求となりますので、\nご認識の程宜しくお願い致します。\n\nお客様の次回請求日は《2月ご利用分》でございますので、\n《2月27日》に請求させていただきます。\nお支払いの準備(限度額調整等)をお願い致します。\n\n※注意事項※\n・万が一、27日に決済の確認ができない場合のみ再度ご連絡を差し上げます。\n・再請求不可となった場合、回線停止措置を取らせていただきます。\nなお、その後請求確認が取れた際に回線復旧致しますが、お時間がかかる場合がございます。\n・回線停止措置を取らせていただいた期間も料金が発生致します。\n・お客様ご利用のクレジットカード会社により、お引き落としの時期が異なります。\n\n上記内容を予めご了承くださいませ。\nその他、何かご不明点等がございましたらお気軽にご連絡ください。\n何卒、宜しくお願い申し上げます。","解約対応者":"","解約対応履歴":"","解約台数":""},{"行":"3","対応日時":"2020\/05\/22 17:20","対応方法":"受信","対応者名":"自動処理","対応履歴":"以下の内容を自動送信しました。\n\n▼宛先メールアドレス\nonepiecedeguchi@gmail.com\n\n▼メール文面\n縛りなしWiFiへお問い合わせありがとうございます。\n後程担当者よりご連絡差し上げますのでお待ち下さい。\n\n以下の内容が送信されました。\n\n━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n【 お問い合わせのタイミング 】 お申し込み後\n【 申込契約形態 】 個人\n【 お問い合わせカテゴリ(大項目) 】 解約\n【 お問い合わせカテゴリ(中項目) 】 解約する\n【 ご利用中のプラン 】 縛りなしプラン\n【 姓 】 佐藤\n【 名 】 悠哉\n【 メールアドレス 】 onepiecedeguchi@gmail.com\n【 電話番号 】 09011112222\n【 生年月日(年) 】 1972\n【 生年月日(月) 】 12\n【 生年月日(日) 】 7\n【 端末管理番号 】 FS_01_1601\n【 解約月 】 2020-06\n【 解約理由 】 データ量が足りない\n【 連絡が繋がりやすい曜日 】 いつでも\n【 連絡が繋がりやすい時間帯 】 10:00-12:00\n【 告知・同意文 】 同意する\n\n━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n\n\n\n今後とも《縛りなしWiFi》をよろしくお願いいたします。\n\n■□━━━━━━━━━━━━━━━━━━━━━━━□■\n\n縛りなしWiFiサポート窓口\n\nMAIL：info@shibarinashi-wifi.jp\nHP：https:\/\/shibarinashi-wifi.jp\/","解約対応者":"","解約対応履歴":"","解約台数":""},{"行":"4","対応日時":"2020\/05\/23 11:39","対応方法":"メール送信","対応者名":"自動処理","対応履歴":"以下の内容でメール送信しました。\n▼メール送信元\ninfo@shibarinashi-wifi.jp\n\n▼メール件名\n≪縛りなしWiFi≫ご解約に関して\n\n▼メール送信先\nonepiecedeguchi@gmail.com\n\n▼メール内容\n佐藤　悠哉様\n \nお世話になっております。\n縛りなしWiFiでございます。\n \nこの度は縛りなしWiFiをご利用いただき、誠にありがとうございます。\n現在大変多くのお問い合わせをいただいており、ご返信が遅くなりました事、心よりお詫び申し上げます。\n \nご利用サービスの解約手続きについて、以下の内容で承りました。\n \n━━━━━━━━━━━━━━━━━━━━━━━━━━━\n■ 契約内容 ■\n───────────────────────────\n契約終了日：2020年06月30日\n※ご解約はご申告日の翌月末となっております。\n※ご利用料金は6月末のご請求が最終となります。\n \n-------------------------------------------------------------------------\n※※解約の前に料金を見直しませんか？※※\n「縛っちゃうプラン」なら、現在よりも月額500円もお安くなります。\nプラン変更でもっとお得に縛りなしWifiを使いましょう！\n　　\n　　★★★★PLAN★★★★\n　　　縛りなしプラン　　月額3,300円　　　※通常プランの場合\n　　⇒縛っちゃうプラン　月額2,800円　　　※通常プランの場合\n　\n「縛っちゃうプラン」参考URL：https:\/\/shibarinashi-wifi.jp\/index.php#plane\n※お申込みは「お問合せ＞お問合せカテゴリ＞プラン変更」よりお問い合わせください。\n\n━━━━━━━━━━━━━━━━━━━━━━━━━━━\n■ 端末の返却先 ■\n───────────────────────────\n【返却先住所】\n〒136-0075 東京都江東区新砂2-2-11\nSTLCビル荷捌き棟4F 縛りなしWiFi 宛\nTEL：0120-541-226\n \n7月1日までの消印日にて上記住所に到着するようご返送ください。\n※宅配業者様の消印日をもって返却日とさせていただきます。\n2日以降の消印のお客様に関しましては、翌月分の料金が発生致しますのでご注意ください。\n※送料はお客様負担にてご返送ください。\n※契約終了日前にご返却いただいた場合もご利用料金は全額発生致しますので、予めご了承ください。\n \n━━━━━━━━━━━━━━━━━━━━━━━━━━━\n■ 返送方法 ■\n───────────────────────────\n【佐川急便】（飛脚宅配便・飛脚ジャスト便）\n【ヤマト運輸】（宅急便・宅急便コンパクト）\n【日本郵便】（レターパック・ゆうパック）\n \n※上記以外での伝票番号が不明な状態でのご返却の場合、\n返却確認が出来かねる、または返却確認が遅れる可能性がございます。\n※端末と充電用USBケーブルをご返送ください。\n※弊社USBケーブルを紛失された方は、ご利用中の物をご返送ください。\n※ACアダプタをお送りしている方は、併せてご返送ください。\n※モバイルバッテリーご契約中の方は、併せてご返送ください。\n \n━━━━━━━━━━━━━━━━━━━━━━━━━━━\n■ 返送完了後 ■　※ご確認をお願い致します※\n───────────────────────────\nご返却状況確認の為、弊社よりご連絡を差し上げる場合がございます。\n下記内容が必要のため、伝票の保管をお願い致します。\n \n【配送会社】【伝票番号】【発送日時】\n \n※伝票は発送日時より2ヶ月の保管をお願い致します。\n※伝票の保管方法はご返却時の控え・写真にてお願い致します。\n※追跡確認が出来ず端末が紛失となった場合、端末弁済金をご請求となる場合や\n　月額料金が継続してご請求となる可能性がございますので、必ず保管をお願い致します。\n \n━━━━━━━━━━━━━━━━━━━━━━━━━━━\n■ 返送時の注意点 ■\n───────────────────────────\n1．ご返送時の送料について\n解約に伴うご返送料金は、お客様ご負担となります。\n \n2．緩衝材の利用について\n配送中に破損しないよう緩衝材のご利用をお願い致します。\n（配送中の破損に関する費用は、お客様負担となります。）\n \n3．私物品の同梱について\nご返却時に私物品が同梱されていた場合、理由を問わず廃棄致します。\n私物品の紛失･破損等につきましては、一切責任を負いかねますのでご了承ください。\n\n \n万が一、変更点がございます時のみご連絡させていただきます。\n上記内容に関しましてご不明点等がございましたら、お気軽にご連絡くださいませ。\n \nこの度は、弊社サービスをご利用いただきまして誠にありがとうございます。\nご確認・ご対応の程、宜しくお願い申し上げます。\n\n■□━━━━━━━━━━━━━━━━━━━━━━━□■\n縛りなしWiFiサポート窓口\n\nMAIL：info@shibarinashi-wifi.jp\nHP：https:\/\/shibarinashi-wifi.jp\/\n\n※現在、新型コロナウイルス感染拡大の影響により、お電話窓口を停止しております。\nお問い合わせに関しましては、メールにてご連絡させていただきます。","解約対応者":"","解約対応履歴":"","解約台数":""}],"端末情報":"003204835","電話番号（MSN）":"08032016941","ICCID":"8981200091964671127","IMEI":"863938031627455","発送日":"2020年01月17日","伝票番号":"403562079922","着荷日":"","返却日":"","リスト種別":"新規契約","問合せ日時":"2020\/01\/15 16:55:30","インポート担当者":"[札幌]飯田","完了日時":"2020\/06\/02 12:15:57","営業時対応履歴":"【 注文時間 】 2020\/01\/15 (Wed) 16:55:29\n【 申込プラン名 】 縛りなしプラン\n【 お申込み台数 】 1\n【 端末到着希望日 】 2020-01-18\n【 利用終了予定 】 3ヶ月以上半年未満\n【 主なご利用用途 】 動画の視聴\n【 日々のご利用目安時間 】 6時間以上\n【 安心サポートプラン 】 加入しない\n【 モバイルバッテリー 】 0\n【 クーポンコード 】 \n【 告知・同意文、ご利用規約 】 同意する\n【 姓 】 佐藤\n【 名 】 悠哉\n【 姓(フリガナ) 】 サトウ\n【 名(フリガナ) 】 ユウヤ\n【 性別 】 男性\n【 生年月日(年) 】 1972\n【 生年月日(月) 】 12\n【 生年月日(日) 】 7\n【 メールアドレス 】 onepiecedeguchi@gmail.com\n【 電話番号 】 09011112222\n【 郵便番号 】 9203116\n【 都道府県 】 石川県\n【 住所 】 金沢市南森本町\n【 番地・建物名・部屋番号 】 100-200\n【 発送先住所 】 上記住所と同じ\n【 お届け先の郵便番号 】 \n【 お届け先の都道府県 】 \n【 お届け先の住所 】 \n【 お届け先の建物名 】 \n【 クレジットカード番号 】 \n【 セキュリティ番号 】 \n【 有効期限(年) 】 \n【 有効期限(月) 】 \n【 カード名義 】 YUYA SATOU\n【 token 】 db60076fb809d41ec13603eed5540b547762aac2\n【 affi_order_number 】 0b453bdf1735438bc0181de1f481af8e20200115165529\n【 初月金額 】 2740\n【 定期課金額 】 3630\n【 メタップス注文ID 】 1579074929570000\n【 決済システムID 】 1579074929570000","CB案内":"","時間指定有無":"","月額":"\\\\3630","初期費用":"","端末着日指定":"2020-01-18","端末着時間指定":"なし","書面発送有無":"","キャンセル日":"","OPID":"","OP名":"","OP料金":"","OPIDⅡ":"","契約者カナ":"サトウ　ユウヤ","初回請求額":"2740","月額合計":"3,630","解約台数合計":"0","現・契約台数":"1","アフィリエイトID":"0b453bdf1735438bc0181de1f481af8e20200115165529","端末発送日":"2020\/01\/17","発送先都道府県":"石川県","端末到着日指定":"2020\/01\/18","クレーム":"","別途課金金額":"0","課金日（別途課金）":"","支払方法変更希望":"","支払方法変更処理":"","解約理由":"データ量が足りない","解約申請日":"2020\/05\/22","アンケート":"","契約形態":"","利用用途":"","解約月":"2020年06月","サポートプラン":"無し","バッテリー":"0台","キャンセル備考":"","お問合せ内容":"","お問い合わせ後の結果":"","※旧メタップス会員ID":"","流入元":"","[afi]成果種別":"","[afi]処理":"","利用終了予定":"3ヶ月以上半年未満","クーポンコード":"","返却確認日":"","キャンペーン":"","主なご利用用途":"動画の視聴","日々のご利用目安時間":"6時間以上","通信制限に関する問い合わせ":"","【営業架電】架電日":"","【営業架電】架電者":"","【営業架電】ステータス":"","返金処理日":"","返金総額":"","着払い案件状況":"","着払い受取日":"","着払い伝票番号":"","着払い着荷予定日":"","提携会社":"","sub流入元":"","決済用メールアドレス":"","初回課金設定":"","口座名義":"","顧客ステータス":"","未課金者ステータス":"","回線停止":"","回線状況":"","個人情報不備項目":"","SMS送信日":"","請求mail送信日":"","結果（SMS)":"","定期登録":"","定期入れ直し時期":"","返却時伝票番号":"","返却締切日":"2020\/07\/01","詳細プラン名":"","入金フラグ":"","請求NGフラグ":"","未収1":"","未収2":"","未収3":"","未収金額合計":"0円","未収（過去分）":"","未収備考":"","定期課金日":"","法人コンシェルAC番号":"","未収メール":"","クレーム対応状況":"","クレーム対応発生日":"","クレーム起因":"","分割対象":"","分割金額":"","分割詳細":"","CP":"","スマート請求ID":"","CIF-ID":"","SBS PW":"","対応依頼":"","SBSお客様番号":"","test　小柳":[],"連絡期日":"","ギガチャージ量":"","容量超過回線停止":"","追加GB":"","GC課金額":"","GC課金日":"","FON ID":"","FONステータス":"","FON ID自動採番":"","FON ID番号":"","FON IDパスワード":""},"version":"v1","accessTime":"2020-06-04 15:57:27 +0900"}';
        $this->responseBody = $a;
        $this->responseStatus = 'success';
        $this->responseCode = '200';
        return json_decode($a);
      } else if(1) {
        // 端末情報無し
        $a = '{"status":"success","code":"200","url":"http:\/\/hdgarnet.htdb.jp\/d4q2uya\/apirecord\/view\/version\/v1","query":{"dbSchemaId":"100967","keyId":"0053402","responseType":"1"},"items":{"[ID]":"53390","[登録日]":"2020\/01\/15 16:55","[登録ユーザ]":"自動インポート用","[更新日]":"2020\/06\/02 17:57","[更新ユーザ]":"FON JAPAN","申込プランID":"00122","自動採番":"0053402","ステータス":"解約予定","申込プラン名":"★SBN基本プラン","月額(キャンペーン)":"\\\\3,630","獲得台数":"1","決済方法":"クレカ決済","契約者":"佐藤　悠哉","生年月日":"1972\/12\/07","性別":"男性","電話番号":"","携帯番号":"09011112222","メールアドレス":"onepiecedeguchi@gmail.com","カード名義":"YUYA SATOU","郵便番号":"920-3116","住所":"金沢市南森本町　100-200","発送先名":"佐藤　悠哉","発送先郵便番号":"920-3116","発送先住所":"金沢市南森本町　100-200","初回発送台数":"1","W04":"","W05":"","601HW":"","FS030W":"1","E5383s":"","801ZT":"","602HW":"","W06":"","WX05":"","クレカ番号":"","クレカ有効期限":"","クレカ名義人":"","ｾｷｭﾘﾃｨｺｰﾄﾞ":"","カード会社":"","決済システムID":"1579074929570000","有効期限":"","キャンセル理由":"","領収書発行日":"","課金フラグ":"","セキュリティコード":"","営業備考":"","業務備考":"","details":[{"行":"1","対応日時":"2020\/01\/18 17:00","対応方法":"","対応者名":"メール送信　木場","対応履歴":"お客様各位\n事業譲渡に関するお知らせ\n \n拝啓　益々ご清祥のこととお慶び申し上げます。\n平素は格別のご高配を賜り、厚くお礼申し上げます。\n \nさて、この度、株式会社クーペックスの事業である\nレンタルWi-Fi事業「縛りなしWi-Fi」\n（縛りなしプラン、縛っちゃうプラン等レンタルWi-Fi事業全てを含みます。）を\nフォン・ジャパン株式会社が譲り受けることで合意し、事業譲渡契約を締結いたしました。\n株式会社クーペックスに対し、永年にわたり賜わりましたご愛顧ご厚情に対しお礼申し上げます。\n今後は新たな体制で皆様のご要望にお応えしていく所存でございますので、\nご高承の上ご指導ご鞭撻を賜りますようお願い申し上げます。\nまずは、略儀ながら書中をもってご案内、ご挨拶申し上げます。\n敬具\n　令和２年１月１７日\n株式会社クーペックス　代表取締役　金森玄　　\nフォン・ジャパン株式会社　代表取締役　横田和典　\n \n　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　\n \n \n \n下記事業譲渡により、株式会社クーペックスの行ってきた\n「縛りなしWi-Fi」事業をフォン・ジャパン株式会社が引き継ぎ、\n株式会社クーペックスが有していたお客様各位に対する料金債権を含む契約上の地位も、\n全てフォン・ジャパン株式会社が引き継ぎます。\n事業譲渡日以降、お客様各位との間における「縛りなしWi-Fi」についてのサービス提供は、\n全てフォン・ジャパン株式会社が行いますので、\n営業主体の変更についてご認識頂いた上\nこれまでと変わらずご愛顧を賜りますよう、何卒よろしくお願い致します。\n以上をもって、事業譲渡のご挨拶とさせて頂きます。\n \n記\n \n【事業譲受会社】  フォン・ジャパン株式会社\n　〒171-0014 東京都豊島区池袋２丁目１４?４ 池袋TAビル8F\n【事業譲渡契約日】 令和２年１月１７日\n【事業譲渡日】   令和２年１月１７日\n【本件に関する窓口】フォン・ジャパン株式会社 電話番号0120-541-226","解約対応者":"","解約対応履歴":"","解約台数":""},{"行":"2","対応日時":"2020\/02\/20 18:20","対応方法":"","対応者名":"メール送信　柴田","対応履歴":"平素より大変お世話になっております。\n縛りなしWiFiをご利用いただき誠にありがとうございます。\n本メールはご利用が《2ヶ月目》のお客様を対象に一斉送信しております。\n\n弊社では毎月27日にご利用料金をご請求しております。\n今後、当月ご利用分として、毎月27日に請求となりますので、\nご認識の程宜しくお願い致します。\n\nお客様の次回請求日は《2月ご利用分》でございますので、\n《2月27日》に請求させていただきます。\nお支払いの準備(限度額調整等)をお願い致します。\n\n※注意事項※\n・万が一、27日に決済の確認ができない場合のみ再度ご連絡を差し上げます。\n・再請求不可となった場合、回線停止措置を取らせていただきます。\nなお、その後請求確認が取れた際に回線復旧致しますが、お時間がかかる場合がございます。\n・回線停止措置を取らせていただいた期間も料金が発生致します。\n・お客様ご利用のクレジットカード会社により、お引き落としの時期が異なります。\n\n上記内容を予めご了承くださいませ。\nその他、何かご不明点等がございましたらお気軽にご連絡ください。\n何卒、宜しくお願い申し上げます。","解約対応者":"","解約対応履歴":"","解約台数":""},{"行":"3","対応日時":"2020\/05\/22 17:20","対応方法":"受信","対応者名":"自動処理","対応履歴":"以下の内容を自動送信しました。\n\n▼宛先メールアドレス\nonepiecedeguchi@gmail.com\n\n▼メール文面\n縛りなしWiFiへお問い合わせありがとうございます。\n後程担当者よりご連絡差し上げますのでお待ち下さい。\n\n以下の内容が送信されました。\n\n━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n【 お問い合わせのタイミング 】 お申し込み後\n【 申込契約形態 】 個人\n【 お問い合わせカテゴリ(大項目) 】 解約\n【 お問い合わせカテゴリ(中項目) 】 解約する\n【 ご利用中のプラン 】 縛りなしプラン\n【 姓 】 佐藤\n【 名 】 悠哉\n【 メールアドレス 】 onepiecedeguchi@gmail.com\n【 電話番号 】 09011112222\n【 生年月日(年) 】 1972\n【 生年月日(月) 】 12\n【 生年月日(日) 】 7\n【 端末管理番号 】 FS_01_1601\n【 解約月 】 2020-06\n【 解約理由 】 データ量が足りない\n【 連絡が繋がりやすい曜日 】 いつでも\n【 連絡が繋がりやすい時間帯 】 10:00-12:00\n【 告知・同意文 】 同意する\n\n━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n\n\n\n今後とも《縛りなしWiFi》をよろしくお願いいたします。\n\n■□━━━━━━━━━━━━━━━━━━━━━━━□■\n\n縛りなしWiFiサポート窓口\n\nMAIL：info@shibarinashi-wifi.jp\nHP：https:\/\/shibarinashi-wifi.jp\/","解約対応者":"","解約対応履歴":"","解約台数":""},{"行":"4","対応日時":"2020\/05\/23 11:39","対応方法":"メール送信","対応者名":"自動処理","対応履歴":"以下の内容でメール送信しました。\n▼メール送信元\ninfo@shibarinashi-wifi.jp\n\n▼メール件名\n≪縛りなしWiFi≫ご解約に関して\n\n▼メール送信先\nonepiecedeguchi@gmail.com\n\n▼メール内容\n佐藤　悠哉様\n \nお世話になっております。\n縛りなしWiFiでございます。\n \nこの度は縛りなしWiFiをご利用いただき、誠にありがとうございます。\n現在大変多くのお問い合わせをいただいており、ご返信が遅くなりました事、心よりお詫び申し上げます。\n \nご利用サービスの解約手続きについて、以下の内容で承りました。\n \n━━━━━━━━━━━━━━━━━━━━━━━━━━━\n■ 契約内容 ■\n───────────────────────────\n契約終了日：2020年06月30日\n※ご解約はご申告日の翌月末となっております。\n※ご利用料金は6月末のご請求が最終となります。\n \n-------------------------------------------------------------------------\n※※解約の前に料金を見直しませんか？※※\n「縛っちゃうプラン」なら、現在よりも月額500円もお安くなります。\nプラン変更でもっとお得に縛りなしWifiを使いましょう！\n　　\n　　★★★★PLAN★★★★\n　　　縛りなしプラン　　月額3,300円　　　※通常プランの場合\n　　⇒縛っちゃうプラン　月額2,800円　　　※通常プランの場合\n　\n「縛っちゃうプラン」参考URL：https:\/\/shibarinashi-wifi.jp\/index.php#plane\n※お申込みは「お問合せ＞お問合せカテゴリ＞プラン変更」よりお問い合わせください。\n\n━━━━━━━━━━━━━━━━━━━━━━━━━━━\n■ 端末の返却先 ■\n───────────────────────────\n【返却先住所】\n〒136-0075 東京都江東区新砂2-2-11\nSTLCビル荷捌き棟4F 縛りなしWiFi 宛\nTEL：0120-541-226\n \n7月1日までの消印日にて上記住所に到着するようご返送ください。\n※宅配業者様の消印日をもって返却日とさせていただきます。\n2日以降の消印のお客様に関しましては、翌月分の料金が発生致しますのでご注意ください。\n※送料はお客様負担にてご返送ください。\n※契約終了日前にご返却いただいた場合もご利用料金は全額発生致しますので、予めご了承ください。\n \n━━━━━━━━━━━━━━━━━━━━━━━━━━━\n■ 返送方法 ■\n───────────────────────────\n【佐川急便】（飛脚宅配便・飛脚ジャスト便）\n【ヤマト運輸】（宅急便・宅急便コンパクト）\n【日本郵便】（レターパック・ゆうパック）\n \n※上記以外での伝票番号が不明な状態でのご返却の場合、\n返却確認が出来かねる、または返却確認が遅れる可能性がございます。\n※端末と充電用USBケーブルをご返送ください。\n※弊社USBケーブルを紛失された方は、ご利用中の物をご返送ください。\n※ACアダプタをお送りしている方は、併せてご返送ください。\n※モバイルバッテリーご契約中の方は、併せてご返送ください。\n \n━━━━━━━━━━━━━━━━━━━━━━━━━━━\n■ 返送完了後 ■　※ご確認をお願い致します※\n───────────────────────────\nご返却状況確認の為、弊社よりご連絡を差し上げる場合がございます。\n下記内容が必要のため、伝票の保管をお願い致します。\n \n【配送会社】【伝票番号】【発送日時】\n \n※伝票は発送日時より2ヶ月の保管をお願い致します。\n※伝票の保管方法はご返却時の控え・写真にてお願い致します。\n※追跡確認が出来ず端末が紛失となった場合、端末弁済金をご請求となる場合や\n　月額料金が継続してご請求となる可能性がございますので、必ず保管をお願い致します。\n \n━━━━━━━━━━━━━━━━━━━━━━━━━━━\n■ 返送時の注意点 ■\n───────────────────────────\n1．ご返送時の送料について\n解約に伴うご返送料金は、お客様ご負担となります。\n \n2．緩衝材の利用について\n配送中に破損しないよう緩衝材のご利用をお願い致します。\n（配送中の破損に関する費用は、お客様負担となります。）\n \n3．私物品の同梱について\nご返却時に私物品が同梱されていた場合、理由を問わず廃棄致します。\n私物品の紛失･破損等につきましては、一切責任を負いかねますのでご了承ください。\n\n \n万が一、変更点がございます時のみご連絡させていただきます。\n上記内容に関しましてご不明点等がございましたら、お気軽にご連絡くださいませ。\n \nこの度は、弊社サービスをご利用いただきまして誠にありがとうございます。\nご確認・ご対応の程、宜しくお願い申し上げます。\n\n■□━━━━━━━━━━━━━━━━━━━━━━━□■\n縛りなしWiFiサポート窓口\n\nMAIL：info@shibarinashi-wifi.jp\nHP：https:\/\/shibarinashi-wifi.jp\/\n\n※現在、新型コロナウイルス感染拡大の影響により、お電話窓口を停止しております。\nお問い合わせに関しましては、メールにてご連絡させていただきます。","解約対応者":"","解約対応履歴":"","解約台数":""}],"端末情報":"","電話番号（MSN）":"08032016941","ICCID":"8981200091964671127","IMEI":"863938031627455","発送日":"2020年01月17日","伝票番号":"403562079922","着荷日":"","返却日":"","リスト種別":"新規契約","問合せ日時":"2020\/01\/15 16:55:30","インポート担当者":"[札幌]飯田","完了日時":"2020\/06\/02 12:15:57","営業時対応履歴":"【 注文時間 】 2020\/01\/15 (Wed) 16:55:29\n【 申込プラン名 】 縛りなしプラン\n【 お申込み台数 】 1\n【 端末到着希望日 】 2020-01-18\n【 利用終了予定 】 3ヶ月以上半年未満\n【 主なご利用用途 】 動画の視聴\n【 日々のご利用目安時間 】 6時間以上\n【 安心サポートプラン 】 加入しない\n【 モバイルバッテリー 】 0\n【 クーポンコード 】 \n【 告知・同意文、ご利用規約 】 同意する\n【 姓 】 佐藤\n【 名 】 悠哉\n【 姓(フリガナ) 】 サトウ\n【 名(フリガナ) 】 ユウヤ\n【 性別 】 男性\n【 生年月日(年) 】 1972\n【 生年月日(月) 】 12\n【 生年月日(日) 】 7\n【 メールアドレス 】 onepiecedeguchi@gmail.com\n【 電話番号 】 09011112222\n【 郵便番号 】 9203116\n【 都道府県 】 石川県\n【 住所 】 金沢市南森本町\n【 番地・建物名・部屋番号 】 100-200\n【 発送先住所 】 上記住所と同じ\n【 お届け先の郵便番号 】 \n【 お届け先の都道府県 】 \n【 お届け先の住所 】 \n【 お届け先の建物名 】 \n【 クレジットカード番号 】 \n【 セキュリティ番号 】 \n【 有効期限(年) 】 \n【 有効期限(月) 】 \n【 カード名義 】 YUYA SATOU\n【 token 】 db60076fb809d41ec13603eed5540b547762aac2\n【 affi_order_number 】 0b453bdf1735438bc0181de1f481af8e20200115165529\n【 初月金額 】 2740\n【 定期課金額 】 3630\n【 メタップス注文ID 】 1579074929570000\n【 決済システムID 】 1579074929570000","CB案内":"","時間指定有無":"","月額":"\\\\3630","初期費用":"","端末着日指定":"2020-01-18","端末着時間指定":"なし","書面発送有無":"","キャンセル日":"","OPID":"","OP名":"","OP料金":"","OPIDⅡ":"","契約者カナ":"サトウ　ユウヤ","初回請求額":"2740","月額合計":"3,630","解約台数合計":"0","現・契約台数":"1","アフィリエイトID":"0b453bdf1735438bc0181de1f481af8e20200115165529","端末発送日":"2020\/01\/17","発送先都道府県":"石川県","端末到着日指定":"2020\/01\/18","クレーム":"","別途課金金額":"0","課金日（別途課金）":"","支払方法変更希望":"","支払方法変更処理":"","解約理由":"データ量が足りない","解約申請日":"2020\/05\/22","アンケート":"","契約形態":"","利用用途":"","解約月":"2020年06月","サポートプラン":"無し","バッテリー":"0台","キャンセル備考":"","お問合せ内容":"","お問い合わせ後の結果":"","※旧メタップス会員ID":"","流入元":"","[afi]成果種別":"","[afi]処理":"","利用終了予定":"3ヶ月以上半年未満","クーポンコード":"","返却確認日":"","キャンペーン":"","主なご利用用途":"動画の視聴","日々のご利用目安時間":"6時間以上","通信制限に関する問い合わせ":"","【営業架電】架電日":"","【営業架電】架電者":"","【営業架電】ステータス":"","返金処理日":"","返金総額":"","着払い案件状況":"","着払い受取日":"","着払い伝票番号":"","着払い着荷予定日":"","提携会社":"","sub流入元":"","決済用メールアドレス":"","初回課金設定":"","口座名義":"","顧客ステータス":"","未課金者ステータス":"","回線停止":"","回線状況":"","個人情報不備項目":"","SMS送信日":"","請求mail送信日":"","結果（SMS)":"","定期登録":"","定期入れ直し時期":"","返却時伝票番号":"","返却締切日":"2020\/07\/01","詳細プラン名":"","入金フラグ":"","請求NGフラグ":"","未収1":"","未収2":"","未収3":"","未収金額合計":"0円","未収（過去分）":"","未収備考":"","定期課金日":"","法人コンシェルAC番号":"","未収メール":"","クレーム対応状況":"","クレーム対応発生日":"","クレーム起因":"","分割対象":"","分割金額":"","分割詳細":"","CP":"","スマート請求ID":"","CIF-ID":"","SBS PW":"","対応依頼":"","SBSお客様番号":"","test　小柳":[],"連絡期日":"","ギガチャージ量":"","容量超過回線停止":"","追加GB":"","GC課金額":"","GC課金日":"","FON ID":"","FONステータス":"","FON ID自動採番":"","FON ID番号":"","FON IDパスワード":""},"version":"v1","accessTime":"2020-06-04 15:57:27 +0900"}';
        $this->responseBody = $a;
        $this->responseStatus = 'success';
        $this->responseCode = '200';
        return json_decode($a);
      } else {
        // エラー発生
        $a = '{"status":"error","code":"400","url":"http:\/\/hdgarnet.htdb.jp\/d4q2uya\/apirecord\/view\/version\/v1","query":{"dbSchemaId":"100967","keyId":"11111119999922","responseType":"1"},"errors":{"code":"100","msg":"パラメータが不正です。","description":[{"name":"keyId","value":"11111119999922","code":"8","msg":"紐づくデータが存在しません。"}]},"version":"v1","accessTime":"2020-06-11 10:10:18 +0900"}';
        $this->responseBody = $a;
        $this->responseStatus = 'error';
        $this->responseCode = '400';
        return json_decode($a);
      }
    }


    $token = static::API_TOKEN2;

    $result = $this->view([
      'dbSchemaId' => 100967,
      'keyId' => $keyId,
      'responseType' => 1,
    ], $token);
    if(!$result) return false;
    return json_decode($this->responseBody);
  }

  /**
   * モバイル在庫管理 を KeyId（自動採番）を使って検索する
   *
   * @param string $keyId
   * @param array  $value
   *
   * @return bool|mixed
   */
  public function updateMobileStockByKeyId(string $keyId, array $value)
  {
    // ローカル環境でのテスト用に固定値を返す
    if($_SERVER['HTTP_HOST'] == 'localhost') {
      if(1) {
        // 正常系
        $this->responseStatus = 'success';
        $this->responseCode = '200';
        $this->responseBody = '{"status":"success","code":"200","url":"http:\/\/hdgarnet.htdb.jp\/d4q2uya\/apirecord\/update\/version\/v1","query":{"dbSchemaId":"100794","keyId":"003281580","values":{"106441":"2020\/10\/01"}},"items":{"keyId":"003281580","id":"135673"},"version":"v1","accessTime":"2020-06-11 17:26:07 +0900"}';
        return json_decode($this->responseBody);
      } else if(1) {
        // 入力値エラー
        $this->responseStatus = 'error';
        $this->responseCode = '400';
        $this->responseBody = '{"status":"error","code":"400","url":"http:\/\/hdgarnet.htdb.jp\/d4q2uya\/apirecord\/update\/version\/v1","query":{"dbSchemaId":"100794","keyId":"003281580","values":{"106441":"2020\/010\/01"}},"errors":{"code":"100","msg":"パラメータが不正です。","description":{"header":[{"name":"106441","value":"2020\/010\/01","code":"39","msg":"\'返却日\'に入力された値が、日付として正しくありません。"}]}},"version":"v1","accessTime":"2020-06-11 17:25:01 +0900"}';
        return json_decode($this->responseBody);
      } else {
        // 更新対象が存在しない場合のエラー
        $this->responseStatus = 'error';
        $this->responseCode = '400';
        $this->responseBody = '{"status":"error","code":"400","url":"http:\/\/hdgarnet.htdb.jp\/d4q2uya\/apirecord\/update\/version\/v1","query":{"dbSchemaId":"100794","keyId":"003281580","values":{"106441":"2020\/10\/01"}},"errors":{"code":"100","msg":"パラメータが不正です。","description":[{"name":"keyId","value":"003281580","code":"8","msg":"紐づくデータが存在しません。"}]},"version":"v1","accessTime":"2020-06-11 17:28:55 +0900"}';
        return json_decode($this->responseBody);
      }
    }

    $token = static::API_TOKEN2;
    $result = $this->update([
      'dbSchemaId' => '100794',
      'keyId' => $keyId,
      'values' => $value,
    ], $token);
    if(!$result) return false;
    return json_decode($this->responseBody);
  }

  /**
   * 働くDBのAPI_TYPEがupdateの呼び出しを行う
   * @param $data
   * @param $token
   *
   * @return bool
   */
  protected function update($data, $token)
  {
    return $this->callApi($data, $token, static::API_TYPE_RECORD_UPDATE);
  }

  /**
   * 働くDBのAPI_TYPEがviewの呼び出しを行う
   *
   * @param $data
   * @param $token
   *
   * @return bool
   */
  protected function view($data, $token)
  {
    return $this->callApi($data, $token, static::API_TYPE_RECORD_VIEW);
  }

  /**
   * 働くDBのAPI呼び出しがsuccessを返したかどうか
   * @return bool
   */
  public function isSuccess(): bool
  {
    return $this->responseStatus === 'success';
  }

  /**
   * 働くDBのAPI呼び出し
   *
   * @param $data
   * @param $token
   * @param $apiType
   *
   * @return bool
   */
  protected function callApi($data, $token, $apiType)
  {
    $this->responseBody = null;
    $this->responseCode = null;
    $this->responseStatus = null;

    $url = 'https://hdgarnet.htdb.jp/'.static::SCHEMA.'/apirecord/'.$apiType.'/version/v1';
    $ch = curl_init(); // はじめ
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER,[
      'Content-Type: application/json;charset=UTF-8',
      'Host: hdgarnet.htdb.jp',
      'X-HD-apitoken: '.$token,
      'Cache-Control: no-cache',
      'Connection: Close'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $result =  curl_exec($ch);
    if($result === false){
      // エラー
      $this->error = curl_error($ch);
      $this->errorNo = curl_errno($ch);
      return false;
    }
    $this->responseBody = $result;
    $decoded = json_decode($this->responseBody);
    if(!$decoded) return false; //jsonで無い値が帰ってきた
    if(isset($decoded->code)) {
      $this->responseCode = $decoded->code;
    }
    if(isset($decoded->status)) {
      $this->responseStatus = $decoded->status;
    }
    return true;
  }

}