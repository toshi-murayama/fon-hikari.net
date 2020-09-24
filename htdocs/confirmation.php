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

// トークンをセッションにセット
function setToken(){
    $token = sha1(uniqid(mt_rand(), true));
    $_SESSION['tk'] = $token;
}
setToken();

$pay = h($_POST['pay']);
$first_name = h($_POST['姓']);
$first_name_kana = h($_POST['姓（カナ）']);
$second_name = h($_POST['名']);
$second_name_kana = h($_POST['名（カナ）']);
$sex = h($_POST['性別']);
$postal_code = h($_POST['郵便番号']);
$address = h($_POST['住所']);
$prefectures = h($_POST['pref_name']);
$room_number = h($_POST['マンション名・部屋番号']);
$tel = h($_POST['電話番号']);
$mail = h($_POST['メールアドレス']);
$tel_week = h($_POST['連絡のつきやすい日時（曜日）']);
$tel_time = h($_POST['連絡のつきやすい日時（時間帯）']);
$consent = h($_POST['同意文、利用約款']);
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

$postal_code_len = mb_strlen($postal_code);
if (!preg_match("/^[0-9]+$/",$postal_code) || $postal_code_len != 7) {
	$error .= '<p class="error">郵便番号を半角数字7桁で入力してください</p>';
}

if(!preg_match("/^[0-9]+$/",$tel)) {
	$error .= '<p class="error">電話番号を半角数字で入力してください</p>';
}

check_empty($first_name,'姓');
check_empty($first_name_kana,'姓（カナ）');
check_empty($second_name,'名');
check_empty($second_name_kana,'名（カナ）');
check_empty($postal_code,'郵便番号');
check_empty($address,'住所');
check_empty($tel,'電話番号');
check_empty($mail,'メールアドレス');
check_empty($tel_week,'連絡のつきやすい日時（曜日）');
check_empty($tel_time,'連絡のつきやすい日時（時間帯）');


if (!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $mail)) {	
	$error .= '<p class="error">メールアドレスを正しい形で入力してください</p>';
}

?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,user-scalable=no,maximum-scale=1">
<title>確認画面</title>
<meta name="description" content="">
<meta name="keywords" content="">
<!----css---->
<link rel="stylesheet" href="css/animate.css">
<link rel="stylesheet" href="css/style_form.css">
<!----js---->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!--script src="js/confirmation.js"></script-->
<script src="js/script.js"></script>
</head>

<body>
<?php include "include/header_form.html";?>
	<section id="confirmation">
		<h2>fon光お申し込み</h2>
		<h3>03 ご契約情報確認</h3>
		<div class="search_text">ご契約先の情報をご確認ください。</div>
		<?php
	print $error;
	?>
		<form method="post" action="thanks.php">
				<input type="hidden" value="<?php print $ref; ?>" name="form_name">
				<input type="hidden" value="<?php print $first_name; ?>" name="姓">
				<input type="hidden" value="<?php print $first_name_kana; ?>" name="姓（カナ）">	
				<input type="hidden" value="<?php print $second_name; ?>" name="名">				
				<input type="hidden" value="<?php print $second_name_kana; ?>" name="名（カナ）">
				<input type="hidden" value="<?php print $sex; ?>" name="性別">
				<input type="hidden" value="<?php print $postal_code; ?>" name="郵便番号">	
				<input type="hidden" value="<?php print $address; ?>" name="住所">
				<input type="hidden" value="<?php print $room_number; ?>" name="マンション名・部屋番号">	
				<input type="hidden" value="<?php print $tel; ?>" name="電話番号">		
				<input type="hidden" value="<?php print $mail; ?>" name="メールアドレス">	
				<input type="hidden" value="<?php print $tel_week; ?>" name="連絡のつきやすい日時（曜日）">		
				<input type="hidden" value="<?php print $tel_time; ?>" name="連絡のつきやすい日時（時間帯）">
				<input type="hidden" value="<?php print $consent; ?>" name="同意文、利用約款">
				<input type="hidden" value="<?php print h($_SESSION['tk']); ?>" name="tk">
			<h4>ご契約者情報</h4>
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
				<li class="categories">性別</li>
				<li><p><?php print $sex; ?></p></li>
				<li class="categories">生年月日</li>
				<li><p><?php print $date; ?></p></li>
				<li class="categories">電話番号</li>
				<li><p><?php print $phoneNumber; ?></p></li>
				<li class="categories">メールアドレス</li>
				<li><p><?php print $mailAddress; ?></p></li>
				<li class="categories">郵便番号</li>
				<li><p><?php print $postalCode; ?></p></li>
				<li class="categories">都道府県</li>
				<li><p><?php print $installationPref; ?></p></li>
				<li class="categories">市区町村</li>
				<li><p><?php print $installationMunicipalities; ?></p></li>
				<li class="categories">町丁名・番地号</li>
				<li><p><?php print $installationTown; ?></p></li>
				<li class="categories">建物名・部屋番号</li>
				<li><p><?php print $installationBuilding; ?></p></li>
				<li class="categories">物件の種類</li>
				<li><p><?php print $homeType; ?></p></li>
				<li class="categories">連絡先メールアドレス</li>
				<li><p><?php print $contactMailAddress; ?></p></li>
				<li class="categories">連絡先メールアドレス（確認）</li>
				<li><p><?php print $contactMailAddress; ?></p></li>
			</ul>
			<h4>オプション</h4>
			<ul class="form">
				<li class="categories">所有形態</li>
				<li><p><?php print $ownership; ?></p></li>
				<li class="categories">光電話申込</li>
				<li><p><?php print $telephoneApplication; ?></p></li>
				<li class="categories">固定電話番号</li>
				<li><p><?php print $fixedLine; ?></p></li>
			</ul>
			<h4>入会書類郵送先</h4>
			<ul class="form">
				<li class="categories">入会書類郵送希望先</li>
				<li><p><?php print $mailingDestination; ?></p></li>
				<li class="categories">郵便番号</li>
				<li><p><?php print $mailingPostalCode; ?></p></li>
				<li class="categories">都道府県</li>
				<li><p><?php print $mailingPrefName; ?></p></li>
				<li class="categories">市区町村</li>
				<li><p><?php print $mailingMunicipalities; ?></p></li>
				<li class="categories">町丁名・番地号</li>
				<li><p><?php print $mailingTown; ?></p></li>
				<li class="categories">建物名・部屋番号</li>
				<li><p><?php print $mailingBuilding; ?></p></li>
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