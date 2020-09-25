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
$tel_week = h($_POST['連絡のつきやすい日時（曜日）']);
$tel_time = h($_POST['連絡のつきやすい日時（時間帯）']);
$consent = h($_POST['同意文、利用約款']);
$content = h($_POST['お問い合わせ内容']);
$submit_flg = h($_POST['submit_flg']);

// 住所連結
$address = $prefectures . $address;

// 正常にページ推移したか確認
$ref = $_SERVER['HTTP_REFERER'];
if ($submit_flg != 1 || strpos($ref,'://fon-hikari.net/') === false) {
	$header = 'http://fon-hikari.net/';
	header('Location:' . $header);	
}

// ヴァリデーションチェック
if($consent != '同意する') {
	$error .= '<p class="error">個人情報取得における告知・同意文、利用約款に同意してください</p>';
}

if (!preg_match("/^[ァ-ヶー]+$/u", $first_name_kana)) {
	$error = '<p class="error">姓（カナ）が半角カタカナではありません</p>';
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
check_empty($tel_week,'連絡のつきやすい日時（曜日）');
check_empty($tel_time,'連絡のつきやすい日時（時間帯）');
check_empty($content,'お問い合わせ内容');


if (!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $mail)) {	
	$error .= '<p class="error">メールアドレスを正しい形で入力してください</p>';
}

?>-->
<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,user-scalable=no,maximum-scale=1">
<title>fons光 お問い合せ</title>
<meta name="description" content="">
<meta name="keywords" content="">
<!----css---->
<link rel="stylesheet" href="css/animate.css"> 
<link rel="stylesheet" href="css/style_form.css">
<!----js---->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/script.js"></script>
</head>

<body>
<?php include "include/header_form.html";?>
	<section id="confirmation">
		<h2>お問い合わせ</h2>
		<h3 class="second">02 お客様情報</h3>
		<?php
	print $error;
	?>
            <form method="post" action="thanks.php">
				<input type="hidden" value="<?php print $ref; ?>" name="form_name">
				<input type="hidden" value="<?php print $first_name; ?>" name="姓">
				<input type="hidden" value="<?php print $first_name_kana; ?>" name="姓（カナ）">	
				<input type="hidden" value="<?php print $second_name; ?>" name="名">				
				<input type="hidden" value="<?php print $second_name_kana; ?>" name="名（カナ）">
				<input type="hidden" value="<?php print $tel; ?>" name="電話番号">		
				<input type="hidden" value="<?php print $mail; ?>" name="メールアドレス">	
				<input type="hidden" value="<?php print $tel_week; ?>" name="連絡のつきやすい日時（曜日）">		
				<input type="hidden" value="<?php print $tel_time; ?>" name="連絡のつきやすい日時（時間帯）">
				<input type="hidden" value="<?php print $consent; ?>" name="同意文、利用約款">
                <input type="hidden" value="<?php print $content; ?>" name="お問い合わせ内容">
				<input type="hidden" value="<?php print h($_SESSION['tk']); ?>" name="tk">
			<ul class="form">
				<li class="categories">
					<dl>
						<dt>氏名（姓）
                            <p><?php print $first_name; ?></p></dt>
                        <dd>氏名（名）
							<p><?php print $first_name_kana; ?></p></dd>
						</dl>
				</li>
				<li class="categories">
					<dl>
						<dt>フリガナ（セイ）
							<p><?php print $second_name; ?></p></dt>
						<dd>フリガナ（メイ）
							<p><?php print $second_name_kana; ?></p></dd>
						</dl>
				</li>
				<li class="categories">電話番号</li>
				<li><p><?php print $phoneNumber; ?></p></li>
				<li class="categories">メールアドレス</li>
				<li><p><?php print $mailAddress; ?></p></li>
				<li class="categories">お問い合わせ内容</li>
				<li><p><?php print $inquiry; ?></p></li>
			</ul>
			<dl class="btn">
				<dt><input type="submit" name="submit" value="戻る" id="backBtn" onclick="history.back()"></dt>
				<dd><input type="submit" name="submit" value="お申し込み" id="submit"></dd>
			</dl>
            </form>
		</section>
<?php include "include/footer_form.html";?>
</body>
</html>