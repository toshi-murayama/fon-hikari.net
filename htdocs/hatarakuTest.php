<?php
require_once '../lib/HatarakuDb.php';
require_once '../lib/Param/HatarakuDbInsert.php';

use Param\HatarakuDbInsert;

$_POST['1'] = '個人';
$_POST['2'] = 'テスト';
$_POST['3'] = 'たかいえ';
$_POST['4'] = 'テスト';
$_POST['5'] = 'タカイエ';
$_POST['6'] = '1';
$_POST['8'] = '00000000000';
$_POST['10'] = 'test@dee.com';
$_POST['11'] = '0738111';
$_POST['23'] = '1';

$recordRegistRequestBody[] = HatarakuDbInsert::getApplicationApiParameter($_POST);


  // API送信実行
  $hatarakuDb = new HatarakuDb();
  $result = $hatarakuDb->sendRequest(
    HatarakuDb::URL_SINGLE_API,
    HatarakuDb::API_TYPE_RECORD_REGIST,
    $recordRegistRequestBody
  );
  echo $result;
