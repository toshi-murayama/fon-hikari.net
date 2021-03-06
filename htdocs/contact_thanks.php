<?php
session_start();

function h($h_string){
	return htmlspecialchars($h_string,ENT_QUOTES);
}

$error = '';

// 2重送信確認
if ($_SESSION['tk'] != $_POST['tk'] || empty($_SESSION['tk'])) {
	$error .= '不正な値が送信されました';
}

if(empty($error)) {

	//文字指定
	mb_language("Japanese");
	mb_internal_encoding("UTF-8");

	//-----------------------------------------------------------
	// 管理者へメール
	//-----------------------------------------------------------
	$content = '';
	foreach($_POST as $k => $v) {
		$content .= '【 '. $k . ' 】 ' . $v . "\r\n";
	}
	$content .= "\r\n";
	$content .= '送信された日時：' . date( "Y/m/d (D) H:i:s" )."\r\n";
	$content .= '問い合わせのページHOST：' . $_SERVER['HTTP_HOST']."\r\n";
	$content .= '問い合わせのページURL：' . $_SERVER['REQUEST_URI']."\r\n";
	$to = 'support@fon-hikari.net,fononepiecetest@gmail.com';
	$title = '【Fon光お問い合わせ】';
	$headers ='Bcc: onepiecedeguchi@gmail.com' . "\r\n";
	$send_mail = mb_send_mail($to, $title, $content, $headers, '-f support@fon-hikari.net');

	//-----------------------------------------------------------
	// ユーザーへメール
	//-----------------------------------------------------------
	$to = $_POST['メールアドレス'];
	$headers  = "From: support@fon-hikari.net\r\n";
	$headers .='Bcc: onepiecedeguchi@gmail.com,fononepiecetest@gmail.com' . "\r\n";
	$title = "《Fon光》お問い合わせ確認メール";
	$content  = '';
	$content .= $_POST['姓'] . ' ' . $_POST['名'] . '様'."\r\n";
	$content .= "\r\n";
	$content .= 'Fon光のお問い合わせありがとうございます。'."\r\n";
	$content .= '下記内容でお問い合わせを承りました。'."\r\n";
	$content .= '後程担当者よりご連絡差し上げますのでお待ち下さい。'."\r\n";
	$content .= "\r\n";
	$content .= '━━━━━━━━━━━━━━━━━━━━━━━━━━━'."\r\n";
	$content .= "\r\n";
	foreach($_POST as $k => $v) {
		if ($k === 'tk') continue;
		if ($k === 'submit') continue;
		$content .= '【 '. $k . ' 】 ' . $v . "\r\n";
	}
	$content .= "\r\n";
	$content .= "\r\n";
	$content .= '■□━━━━━━━━━━━━━━━━━━━━━━━□■'."\r\n";
	$content .= 'フォン・ジャパン株式会社'."\r\n";
	$content .= '〒171-0014 東京都豊島区池袋2-14-4 池袋TAビル8F'."\r\n";
	$content .= 'URL: https://fon-hikari.net/'."\r\n";
	$send_mail = mb_send_mail($to, $title, $content, $headers, '-f support@fon-hikari.net');


	unset($_SESSION['tk']);
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>お問い合わせ | Fon光 超高速光回線インターネット</title>
<meta name="viewport" id="viewport" content="width=device-width">
<meta name="description" content="月額3,980円！Fon光で快適なインターネット生活を送ろう">
<meta name="keywords" content="Fon,Fon光,nuro,nuro光,NTT,プロバイダ,高速,2Gbps,WiFi,ルーター,WiMAX,Softbank,縛りなしWiF">
<meta name="theme-color" content="#EC7103">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<link rel="shortcut icon" href="img/favicon.ico" />
<?php include "include/ogp.html";?>
<!--style-->
<link href="https://fonts.googleapis.com/css2?family=M+PLUS+1p:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style_form.css">
<link rel="stylesheet" href="css/animate.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!--tag-->
<?php include "include/tag_head.html";?>
</head>
<body>
<?php include "include/tag_start.html";?>
<p id="cursor"></p>
<div id="stalker"></div>
	<?php 
		if(isset($_COOKIE['affiliate'])) {
			include "include/header_affiliate_form.html";
		} else {
			include "include/header_form.html";
		}
	?>
	<section id="thanks">
		<h2>お問い合わせ</h2>
		<h3>03 お問い合わせ完了</h3>
		
		<?php if (empty($error)) { ?>

			<div class="search_text">お問い合わせありがとうございます。</div>
			内容を確認し、ご連絡いたします。<br>
			<br>
			0120-966-486よりお電話させて頂きますので<br>
			フリーダイヤル等の着信拒否設定をされている方は設定解除をお願い致します。<br>

		<?php } else { ?>

			<p class="error" style="margin: 0 0 4em; text-align:center;">

				<?php print $error; ?>

			</p>

		<?php } ?>

		<?php if(isset($_COOKIE['affiliate'])) { ?>
			<p class="btn"><a href="/ta">最初のぺージに戻る</a></p>
		<?php } else {?>
			<p class="btn"><a href="/">最初のぺージに戻る</a></p>
		<?php } ?>
	</section>
	<?php 
	if(isset($_COOKIE['affiliate'])) {
		include "include/footer_affiliate.html";
	} else {
		include "include/footer_contact.html";
	}
	?>
</body>
</html>
