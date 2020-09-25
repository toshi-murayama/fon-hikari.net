<?php

require_once '../lib/mail.php';
require_once '../lib/HatarakuDb.php';
require_once '../lib/Param/HatarakuDbInsert.php';

use Param\HatarakuDbInsert;

// TODO 本当はクラス化したいが、、、時間のあるときにリファクタリング.
// 正常にページ推移したか確認(正しくなかったらtopに戻る)
$ref = $_SERVER['HTTP_REFERER'];
// var_dump($ref);
// die();
if ((isset($_POST['confirmationSubmitFlag']) && $_POST['confirmationSubmitFlag'] != 1) || strpos($ref,'confirmation') === false) {
	header( "Location: / " );
}

session_start();
var_dump($_SESSION['tk']);
var_dump($_POST['tk']);
// 2重送信確認
if ($_SESSION['tk'] != $_POST['tk'] || empty($_SESSION['tk'])) {
	$error .= '<p class="error">不正な値が送信されました</p>';
}

//働くDBインポート.
$data = HatarakuDbInsert::createData($_POST);

$recordRegistRequestBody[] = HatarakuDbInsert::getApplicationApiParameter($data);
// var_dump($data);
// API送信実行
$hatarakuDb = new HatarakuDb();
$result = $hatarakuDb->sendRequest(
  HatarakuDb::URL_SINGLE_API,
  HatarakuDb::API_TYPE_RECORD_REGIST,
  $recordRegistRequestBody
);
var_dump($result);
// 失敗したらメールで報告
if ($result !== "200") {
	sendHatarakuDBErrorMail($result);
}
mb_language("Japanese");
mb_internal_encoding("UTF-8");
$to = 'takaiesamba@gmail.com';
$subject = '《Fon光》お申し込み確認メール';
$content = $ref;
$from = "From: support@fon-hikari.net";
$send = mb_send_mail($to, $subject, $content, $from);
var_dump($send);
unset($_SESSION['tk']);
// if(empty($error)) {
// 	// メール文章生成
// 	foreach($_POST as $post_key=>$post_val) {
// 		$post_key = h($post_key);
// 		$post_val = h($post_val);
// 		if ($post_key != 'submit' && $post_key !="form_name" && $post_key != 'tk') {
// 			$mail_content .= "【 ". $post_key . " 】 " . $post_val . "\n";	
// 		}
// 	}

// 	//文字指定
// 	mb_language("Japanese");
// 	mb_internal_encoding("UTF-8");

// 	//メールの内容
// 	$to = "support@fon-hikari.net,s_kagaya@1onepiece.jp";

// 	if(strpos($form_name,'application.php') !== false) {
// 		$title = "【fon光お申し込み】";
// 	} else if (strpos($form_name,'contact.php') !== false){
// 		$title = "【fon光お問い合わせ】";		
// 	} else if (strpos($form_name,'https://fon-hikari.net/') !== false){
// 		$title = "【fon光エリア確認】";		
// 	}	
// 	if(!empty($_COOKIE['ref'])) {
// 		$title .= '【流入元: ' . $_COOKIE['ref'] . '】';
// 	}	
// 	$content = '「' . $title . '」からメールが届きました

// ＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝

// ' . $mail_content . '

// ＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
// 送信された日時：' . date( "Y/m/d (D) H:i:s" ) . '
// 問い合わせのページURL：' . $form_name . '

// ──────────────────────
// フォン・ジャパン株式会社
// 〒171-0014 東京都豊島区池袋2-14-4 池袋TAビル8F
// URL: https://fon.ne.jp/
// ──────────────────────';
// 	$from = "From: " . $mail . "\r\n";
	
// 	//メールの送信
// 	$send_mail = mb_send_mail($to, $title, $content, $from);
	
// 	unset($_SESSION['tk']);
// }

function h($h_string){
	return htmlspecialchars($h_string,ENT_QUOTES);
}

?>