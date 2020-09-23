<?php
require_once '../lib/HatarakuDb.php';
require_once '../lib/Param/HatarakuDbInsert.php';

use Param\HatarakuDbInsert;

var_dump($_POST);
// 顧客区分
if ($_POST['applicationClassification'] == '0') {
  $_POST['applicationClassification'] = '個人';
} else {
  $_POST['applicationClassification'] = '法人';
}
// 入会書類郵送希望先
if ($_POST['mailingDestination'] == '0') {
  $_POST['mailingDestination'] = '設置場所に同じ';
} else {
  $_POST['mailingDestination'] = '別住所';
}
//物件の種類
if ($_POST['homeType'] == '1') {
  $_POST['homeType'] = '一戸建';
} else if ($_POST['homeType'] == '2') {
  $_POST['homeType'] = 'マンション3F以下';
} else {
  $_POST['homeType'] = 'マンション4F以上';
}
$_POST['applicationRoute'] = 'WEB';
$_POST['applicationDate'] = date("Y年m月d日");

// die();

$recordRegistRequestBody[] = HatarakuDbInsert::getApplicationApiParameter($_POST);


// API送信実行
$hatarakuDb = new HatarakuDb();
$result = $hatarakuDb->sendRequest(
  HatarakuDb::URL_SINGLE_API,
  HatarakuDb::API_TYPE_RECORD_REGIST,
  $recordRegistRequestBody
);
echo $result;
