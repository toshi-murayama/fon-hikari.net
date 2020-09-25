<?php
require_once '../lib/HatarakuDb.php';
require_once '../lib/Param/HatarakuDbInsert.php';

use Param\HatarakuDbInsert;

$data = HatarakuDbInsert::createData($_POST);

$recordRegistRequestBody[] = HatarakuDbInsert::getApplicationApiParameter($data);


// API送信実行
$hatarakuDb = new HatarakuDb();
$result = $hatarakuDb->sendRequest(
  HatarakuDb::URL_SINGLE_API,
  HatarakuDb::API_TYPE_RECORD_REGIST,
  $recordRegistRequestBody
);
echo $result;
