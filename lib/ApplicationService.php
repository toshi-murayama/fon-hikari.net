<?php
/**
 * 申込時に行う処理を集約.
 * TODO: 	本当はクラス化したいが、、、時間のあるときにリファクタリング.
 *			thanks.phpでインスタンス化して使用する予定.
 * */

require_once '../lib/HatarakuDb.php';
require_once '../lib/Param/HatarakuDbInsert.php';
require_once '../lib/Common.php';
require_once '../lib/Mail.php';

use Param\HatarakuDbInsert;



// 正常にページ推移したか確認(正しくなかったらtopに戻る)
$ref = $_SERVER['HTTP_REFERER'];
date_default_timezone_set('Asia/Tokyo');
if ((isset($_POST['confirmationSubmitFlag']) && $_POST['confirmationSubmitFlag'] != 1) || strpos($ref,'confirmation') === false) {
	header( "Location: / " );
}
$error ='';
session_start();
// 2重送信確認
if ($_SESSION['tk'] != $_POST['tk'] || empty($_SESSION['tk'])) {
	// TODO: thanks.phpに書く（文字列だけ返すようにして、domは書かない）
	$error .= '<p class="error">不正な値が送信されました</p>';
}

if(empty($error)) {
	//働くDBインポート.
	$data = HatarakuDbInsert::createData($_POST);

	$recordRegistRequestBody[] = HatarakuDbInsert::getApplicationApiParameter($data);
	// API送信実行
	$hatarakuDb = new HatarakuDb();
	$result = $hatarakuDb->sendRequest(
		HatarakuDb::URL_SINGLE_API,
		HatarakuDb::API_TYPE_RECORD_REGIST,
		$recordRegistRequestBody
	);
	// 失敗したらメールで報告
	if ($result !== "200") {
		Mail::sendHatarakuDBImportError($result);
		// TODO: thanks.phpに書く（文字列だけ返すようにして、domは書かない）
		$error .= '<p class="error">お申し込みに失敗しました。お手数ですがサポート窓口までお問い合わせください。</p>';
	} else {
		// 管理者へメール
		Mail::sendApplication2Admin($_POST);
		// ユーザーへメール
		Mail::sendApplication2User($_POST);
	}
	unset($_SESSION['tk']);
}

?>