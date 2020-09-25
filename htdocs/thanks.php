<?php
	require_once('../lib/thanks_relay.php');
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
<link rel="stylesheet" href="css/style_form.css">
<link rel="stylesheet" href="css/animations.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<!--tag-->
<?php include "include/tag_head.html";?>
</head>
<body>
<?php include "include/tag_start.html";?>
<p id="cursor"></p>
<div id="stalker"></div>
<?php include "include/header_form.html";?>
	<section id="thanks">
		<h2>fon光お申し込み</h2>
		<h3>04 お申し込み完了</h3>
		<div class="search_text">お申し込みありがとうございます。</div>
		<?php
if (empty($error)) {
	print $message;
} else {
	print $error;
}
?>
		<p class="text">後程弊社担当よりお電話にてご連絡させて頂きます。お電話をもってお申し込み完了となります。<br>
			0120-966-486よりお電話させて頂きますのでフリーダイヤル等の着信拒否設定をされている方は設定解除をお願い致します。</p>
<p class="btn"><a href="/">最初のぺージに戻る</a></p>
	</section>
	<?php include "include/footer_form.html";?>
</body>
</html>
