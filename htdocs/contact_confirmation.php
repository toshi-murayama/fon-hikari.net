<!--<?php
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

// トークンをセッションにセット
function setToken(){
    $token = sha1(uniqid(mt_rand(), true));
    $_SESSION['tk'] = $token;
}
setToken();

$first_name = h($_POST['姓']);
$first_name_kana = h($_POST['姓（カナ）']);
$second_name = h($_POST['名']);
$second_name_kana = h($_POST['名（カナ）']);
$tel = h($_POST['電話番号']);
$mail = h($_POST['メールアドレス']);
$consent = h($_POST['同意文、利用約款']);
$content = h($_POST['お問い合わせ内容']);
$submit_flg = h($_POST['submit_flg']);

$error = '';

// ヴァリデーションチェック
if($consent != '同意する') {
	$error .= '<p class="error">個人情報取得における告知・同意文、利用約款に同意してください</p>';
}

if (!preg_match("/^[ァ-ヶー]+$/u", $first_name_kana)) {
	$error .= '<p class="error">姓（カナ）が半角カタカナではありません</p>';
} 

if (!preg_match("/^[ァ-ヶー]+$/u", $second_name_kana)) {
	$error .= '<p class="error">名（カナ）が半角カタカナではありません</p>';
}

if(!preg_match("/^[0-9]+$/",$tel)) {
	$error .= '<p class="error">電話番号を半角数字で入力してください</p>';
}

check_empty($first_name,'姓');
check_empty($first_name_kana,'姓（カナ）');
check_empty($second_name,'名');
check_empty($second_name_kana,'名（カナ）');
check_empty($tel,'電話番号');
check_empty($mail,'メールアドレス');
check_empty($content,'お問い合わせ内容');


if (!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $mail)) {	
	$error .= '<p class="error">メールアドレスを正しい形で入力してください</p>';
}

?>-->
<!DOCTYPE html>
<html lang="ja" dir="ltr">
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
<!----css---->
<link href="https://fonts.googleapis.com/css2?family=M+PLUS+1p:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/animate.css"> 
<link rel="stylesheet" href="css/style_form.css">
<!----js---->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!--tag-->
<?php include "include/tag_head.html";?>
</head>
<body>
<?php include "include/tag_start.html";?>
<p id="cursor"></p>
<div id="stalker"></div>
<?php include "include/header_form.html";?>
	<section id="confirmation">
		<h2>お問い合わせ</h2>
		<h3 class="second">02 お客様情報</h3>
		<?php
	print $error;
	?>
		<form method="post" action="contact_thanks">
				<input type="hidden" value="<?php print $first_name; ?>" name="姓">
				<input type="hidden" value="<?php print $first_name_kana; ?>" name="姓（カナ）">	
				<input type="hidden" value="<?php print $second_name; ?>" name="名">				
				<input type="hidden" value="<?php print $second_name_kana; ?>" name="名（カナ）">
				<input type="hidden" value="<?php print $tel; ?>" name="電話番号">		
				<input type="hidden" value="<?php print $mail; ?>" name="メールアドレス">	
				<input type="hidden" value="<?php print $consent; ?>" name="同意文、利用約款">
				<input type="hidden" value="<?php print $content; ?>" name="お問い合わせ内容">
				<input type="hidden" value="<?php print h($_SESSION['tk']); ?>" name="tk">
			<ul class="form">
				<li class="categories">
					<dl>
						<dt>氏名（姓）
							<p><?php print $first_name; ?>&nbsp;</p>
						</dt>
						<dd>氏名（名）
							<p><?php print $second_name; ?>&nbsp;</p>
						</dd>
						</dl>
				</li>
				<li class="categories">
					<dl>
						<dt>フリガナ（セイ）

							<p><?php print $first_name_kana; ?>&nbsp;</p></dt>
						<dd>フリガナ（メイ）
							<p><?php print $second_name_kana; ?>&nbsp;</p></dd>
						</dl>
				</li>
				<li class="categories">電話番号</li>
				<li><p><?php print $tel; ?>&nbsp;</p></li>
				<li class="categories">メールアドレス</li>
				<li><p><?php print $mail; ?>&nbsp;</p></li>
				<li class="categories">お問い合わせ内容</li>
				<li><p><?php print nl2br($content); ?>&nbsp;</p></li>
			</ul>
			<dl class="btn">
				<dt><input type="button" name="submit" value="戻る" id="backBtn" onclick="history.back()"></dt>

				<?php if (!$error) { ?>

				<dd><input type="submit" name="submit" value="お問い合わせ" id="submit"></dd>

				<?php } ?>

			</dl>
		</form>
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