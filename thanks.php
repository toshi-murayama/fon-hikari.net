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
/*
$ref = $_SERVER['HTTP_REFERER'];
if (strpos($ref,'://cm-hikari-net.site') === false) {
	$header = 'http://cm-hikari-net.site';
	header('Location:' . $header);	
}
*/

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
		$post_val = encryption_data($post_val);
		if ($post_key != 'submit' && $post_key !="form_name" && $post_key != 'tk') {
			$mail_content .= "【 ". $post_key . " 】 " . $post_val . "\n";	
		}
	}

	//文字指定
	mb_language("Japanese");
	mb_internal_encoding("UTF-8");

	//メールの内容
	$to = "nh.info@sv-nuro-h.site,s-kagaya@1onepiece.jp";

	if(strpos($form_name,'application.php') !== false) {
		$title = "【NURO光お申し込み】";
	} else if (strpos($form_name,'contact.php') !== false){
		$title = "【NURO光お問い合わせ】";		
	} else if (strpos($form_name,'https://sv-nuro-h.site/') !== false){
		$title = "【NURO光エリア確認】";		
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
株式会社ONE PIECE(ワンピース)
〒171-0014 東京都豊島区池袋2-14-4 池袋TAビル7F
TEL：03-5979-6870 　FAX：03-5979-6871
URL: http://1onepiece.jp/
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
<title>NURO光 お申し込みサイト</title>
<meta name="viewport" id="viewport" content="width=device-width">
<meta name="description" content="NURO光のおトク情報満載！今ならお申し込みで【80,000円キャッシュバック中】月額料金も最安級3,680円で使い放題！セキュリティ・電話・テレビなどのサービスも豊富に取り揃えています。お得に申込むなら今がチャンス！" />
<meta name="keywords" content="コミュファ,NURO光,光,キャンペーン,インターネット,高速インターネット,光回線,プロバイダ,工事,キャッシュバック,乗り換え," />
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/animations.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
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
<?php

// 申し込みのコンバージョンタグ
if(strpos($form_name,'application.php') !== false) {
?>
<!-- Event snippet for 申し込み conversion page -->
<script>
  gtag('event', 'conversion', {'send_to': 'AW-817611267/T4INCObps3wQg4TvhQM'});
</script>
<?php

// 問い合わせのコンバージョンタグ
} else if (strpos($form_name,'contact.php') !== false) {
?>
<!-- Event snippet for 問い合わせ conversion page -->
<script>
  gtag('event', 'conversion', {'send_to': 'AW-817611267/9f_ACKm8oXwQg4TvhQM'});
</script>

<?php

// エリア確認のコンバージョンタグ
} else if (strpos($form_name,'https://sv-nuro-h.site/') !== false) {
?>
<!-- Event snippet for エリア確認 conversion page -->
<script>
  gtag('event', 'conversion', {'send_to': 'AW-817611267/V_FiCM3Xm34Qg4TvhQM'});
</script>

<?php
}
?>
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
<?php

// 申し込みのコンバージョンタグ
if(strpos($form_name,'application.php') !== false) {
?>

<div id="tagManager_DIV" style="display:none"></div>

<!-- Google Code for CV(&#12513;&#12540;&#12523;&#65306;&#30003;&#36796;) Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 861025052;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "bE_lCI3HonAQnObImgM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/861025052/?label=bE_lCI3HonAQnObImgM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>


<?php

// 問い合わせのコンバージョンタグ
} else if (strpos($form_name,'contact.php') !== false) {
?>
<!--
<div id="tagManager_DIV" style="display:none"></div>
-->

<!-- Google Code for CV(&#12513;&#12540;&#12523;&#65306;&#21839;&#21512;) Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 861025052;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "npvQCMyzkHAQnObImgM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/861025052/?label=npvQCMyzkHAQnObImgM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

<?php
}
?>
</body>
</html>
