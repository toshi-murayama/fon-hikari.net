<?php
/**
 * 働くDBのAPIにデータ送信を行う
 * NOTE shibarinasi からコピペ... API_TOKEN、DOMAIN、SCHEMAだけ変更.
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