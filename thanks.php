<?php
session_start();

function h($h_string){
	return htmlspecialchars($h_string,ENT_QUOTES);
}

/* 必須チェック
　第一引数：対象文字列、第2引数：エラー表示名 */
function check_empty($target,$target_name){
	global $error;
	if (empty($target)) {
		$error .= '<p class="error">' . $target_name . 'を入力してください</p>';	
	}	
}

function encryption_data($data){
	
    $key = "1onepiece_encrypt";

    //暗号化
    $encrypt_data = openssl_encrypt($data,'aes-256-ecb',$key);
	return $encrypt_data;
}

function decryption_data($data){

    $key = "1onepiece_encrypt";
	
    //復号化
    $decrypt_data = openssl_decrypt($data,'aes-256-ecb',$key);
	return $decrypt_data;	
}

// 正常にページ推移したか確認
$ref = $_SERVER['HTTP_REFERER'];
if (strpos($ref,'://fon-hikari.net/') === false) {
	$header = 'http://fon-hikari.net/';
	header('Location:' . $header);	
}

// 2重送信確認
if ($_SESSION['tk'] != $_POST['tk'] || empty($_SESSION['tk'])) {
	$error .= '<p class="error">不正な値が送信されました</p>';
}

$form_name = h($_POST['form_name']);
$mail = h($_POST['メールアドレス']);

if(strpos($form_name,'application.php') !== false) {
	$message = 'お申し込みありがとうございます。<br>
<br>
後程弊社担当よりお電話にてご連絡させて頂きます。<br>
お電話をもってお申し込み完了となります。<br>
<br>
0120-955-271よりお電話させて頂きますので<br>
フリーダイヤル等の着信拒否設定をされている方は設定解除をお願い致します。<br><br>';
} else if (strpos($form_name,'contact.php') !== false) {
	$message = 'お問い合わせありがとうございます。<br>
<br>
内容を確認し、ご指定いただいた時間帯にご連絡いたします。<br>
<br>
0120-955-271よりお電話させて頂きますので<br>
フリーダイヤル等の着信拒否設定をされている方は設定解除をお願い致します。<br>';
} else if (strpos($form_name,'https://sv-nuro-h.site/') !== false) {
	$message = 'エリア確認ありがとうございます。<br><br>
内容を確認し、ご連絡いたします。<br>
<br>
0120-955-271よりお電話させて頂きますので<br>
フリーダイヤル等の着信拒否設定をされている方は設定解除をお願い致します。<br>';
}

if(empty($error)) {

	// メール文章生成
	foreach($_POST as $post_key=>$post_val) {
		$post_key = h($post_key);
		$post_val = h($post_val);
		if ($post_key != 'submit' && $post_key !="form_name" && $post_key != 'tk') {
			$mail_content .= "【 ". $post_key . " 】 " . $post_val . "\n";	
		}
	}

	//文字指定
	mb_language("Japanese");
	mb_internal_encoding("UTF-8");

	//メールの内容
	$to = "support@fon-hikari.net,s_kagaya@1onepiece.jp";

	if(strpos($form_name,'application.php') !== false) {
		$title = "【fon光お申し込み】";
	} else if (strpos($form_name,'contact.php') !== false){
		$title = "【fon光お問い合わせ】";		
	} else if (strpos($form_name,'https://fon-hikari.net/') !== false){
		$title = "【fon光エリア確認】";		
	}	
	if(!empty($_COOKIE['ref'])) {
		$title .= '【流入元: ' . $_COOKIE['ref'] . '】';
	}	
	$content = '「' . $title . '」からメールが届きました

＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝

' . $mail_content . '

＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
送信された日時：' . date( "Y/m/d (D) H:i:s" ) . '
問い合わせのページURL：' . $form_name . '

──────────────────────
フォン・ジャパン株式会社
〒171-0014 東京都豊島区池袋2-14-4 池袋TAビル8F
URL: https://fon.ne.jp/
──────────────────────';
	$from = "From: " . $mail . "\r\n";
	
	//メールの送信
	$send_mail = mb_send_mail($to, $title, $content, $from);
	
	unset($_SESSION['tk']);
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>fon光 お申し込みサイト</title>
<meta name="viewport" id="viewport" content="width=device-width">
<meta name="description" content="fon光のおトク情報満載！今ならお申し込みで【80,000円キャッシュバック中】月額料金も最安級3,680円で使い放題！セキュリティ・電話・テレビなどのサービスも豊富に取り揃えています。お得に申込むなら今がチャンス！" />
<meta name="keywords" content="fon光,光,キャンペーン,インターネット,高速インターネット,光回線,プロバイダ,工事,キャッシュバック,乗り換え," />
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/animations.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</head>

<body>

<div id="container">
  <div id="header">
        <div class="header_box">
            <h1><a href="./"><img src="img/img_logo.png" alt=""></a></h1>
            <div class="header_c">
                <p>お申込み・ご相談<span>10:00〜21:00（年末年始、お盆を除く）</span></p>
                <p class="tel">0120-955-531</p>
            </div>
            <div class="header_r"><a href="">マイページ</a></div>
        </div>
    </div>
<div id="contents_bg">
<div class="thanks"><?php
if (empty($error)) {
	print $message;
} else {
	print $error;
}
?>
<p><a href="../">最初のぺージに戻る</a></p>
</div>
</div>
	</div>
<footer>
	<p><a href="./#flow">ご利用の流れ</a> | <a href="company.html">運営会社</a> | <a href="privacy.html">個人情報保護方針</a> | <a href="application.php">お申込み</a> | <a href="contact.php">お問い合わせ</a></p>
</footer>
</body>
</html>
