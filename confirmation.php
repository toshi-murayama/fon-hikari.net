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
if ($submit_flg != 1 || strpos($ref,'://sv-nuro-h.site') === false) {
	$header = 'http://sv-nuro-h.site';
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
<meta name="keywords" content="ワイファイ,ルーター,wifi,simフリー,ポケットワイファイ,帯域制限,速度制限,プレミアモバイル,データカード,タブレット">
<!----css---->
<link rel="stylesheet" href="css/animate.css">
<link rel="stylesheet" href="css/style_form.css">
<link rel="stylesheet" href="css/style.css"> 
<!----js---->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/confirmation.js"></script>
<script src="js/script.js"></script>
<!--//* TAGS *//-->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-114374366-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-114374366-2');
</script>

<!-- Global site tag (gtag.js) - Google AdWords: 817611267 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-817611267"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-817611267');
</script>
</head>

<body>
<div id="container">
<div id="header">
        <div class="header_box">
            <h1><a href="./"><img src="img/img_logo.png" alt=""></a></h1>
            <div class="header_c">
                <p>お申込み・ご相談<span>10:00〜21:00（年末年始、お盆を除く）</span></p>
                <p class="tel">0120-955-271</p>
            </div>
            <div class="header_r"><a href="application.php">24時間いつでも<br>WEB申込</a></div>
        </div>
    </div>
<div id="contents_bg">
    <div id="contents"><?php
	print $error;
	?>
        <div id="formWrap">
            <div class="formContent">
                <h2 class="mb20 mt20">お客様情報</h2>
            </div>
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
                <div id="confirmation">
                    <table class="formTable">
                        <tr>
                            <th>姓</th>
                            <td><?php print $first_name; ?></td>
                        </tr>
                        <tr>
                            <th>姓（カナ）</th>
                            <td><?php print $first_name_kana; ?></td>
                        </tr>
                        <tr>
                            <th>名</th>
                            <td><?php print $second_name; ?></td>
                        </tr>
                        <tr>
                            <th>名（カナ）</th>
                            <td><?php print $second_name_kana; ?></td>
                        </tr>
                        <tr>
                            <th>性別</th>
                            <td><?php 
							print $sex; ?></td>
                        </tr>
                        <tr>
                            <th>郵便番号</th>
                            <td><?php print $postal_code; ?></td>
                        </tr>
                        <tr>
                            <th>住所</th>
                            <td><?php print $address; ?></td>
                        </tr>
                        <tr>
                            <th>マンション名・部屋番号</th>
                            <td><?php print $room_number; ?></td>
                        </tr>
                        <tr>
                            <th>電話番号</th>
                            <td><?php print $tel; ?></td>
                        </tr>
                        <tr>
                            <th>メールアドレス</th>
                            <td><?php print $mail; ?></td>
                        </tr>
                        <tr>
                            <th>連絡のつきやすい日時（曜日）</th>
                            <td><?php print $tel_week; ?></td>
                        </tr>
                        <tr>
                            <th>連絡のつきやすい日時（時間帯）</th>
                            <td><?php print $tel_time; ?></td>
                        </tr>
                        <tr>
                            <th>告知・同意文、利用約款</th>
                            <td><?php print $consent; ?></td>
                        </tr>
                    </table>
                    
                    <div class="btn cleafix">
					<?php
						if(empty($error)) {
					?>
                        <input type="submit" name="submit" value="申し込む" id="submit">
                    <?php
						}
					?>
						<input type="submit" name="submit" value="戻る" id="backBtn" onclick="history.back()">
                    </div>
                </div>
            </form>
        </div>
	</div>
    </div>
</div>
<footer>
	<p><a href="./#flow">ご利用の流れ</a> | <a href="company.html">運営会社</a> | <a href="privacy.html">個人情報保護方針</a> | <a href="application.php">お申込み</a> | <a href="contact.php">お問い合わせ</a></p>
</footer>
<!-- Google Code for CV(&#38651;&#35441;&#65306;&#21839;&#21512;) Conversion Page
In your html page, add the snippet and call
goog_report_conversion when someone clicks on the
phone number link or button. -->
<script type="text/javascript">
  /* <![CDATA[ */
  goog_snippet_vars = function() {
    var w = window;
    w.google_conversion_id = 861025052;
    w.google_conversion_label = "kDzECMTIonAQnObImgM";
    w.google_remarketing_only = false;
  }
  // DO NOT CHANGE THE CODE BELOW.
  goog_report_conversion = function(url) {
    goog_snippet_vars();
    window.google_conversion_format = "3";
    var opt = new Object();
    opt.onload_callback = function() {
    if (typeof(url) != 'undefined') {
      window.location = url;
    }
  }
  var conv_handler = window['google_trackConversion'];
  if (typeof(conv_handler) == 'function') {
    conv_handler(opt);
  }
}
/* ]]> */
</script>
<script type="text/javascript"
  src="//www.googleadservices.com/pagead/conversion_async.js">
</script>
</body>
</html>