<?php
	require_once('../lib/thanks_relay.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Fon光 お申し込みサイト</title>
<meta name="viewport" id="viewport" content="width=device-width">
<meta name="description" content="Fon光のおトク情報満載！今ならお申し込みで【80,000円キャッシュバック中】月額料金も最安級3,680円で使い放題！セキュリティ・電話・テレビなどのサービスも豊富に取り揃えています。お得に申込むなら今がチャンス！" />
<meta name="keywords" content="Fon光,光,キャンペーン,インターネット,高速インターネット,光回線,プロバイダ,工事,キャッシュバック,乗り換え," />
<meta name="theme-color" content="#EC7103">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<link rel="shortcut icon" href="img/favicon.ico" />
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
		<h2>Fon光お申し込み</h2>
		<h3>04 お申し込み完了</h3>
		<?php if (empty($error)) { ?>

		<div class="search_text">お申し込みありがとうございます。</div>
		<p class="text">後程弊社担当よりお電話にてご連絡させて頂きます。お電話をもってお申し込み完了となります。<br>
		0120-966-486よりお電話させて頂きますので<br>
		フリーダイヤル等の着信拒否設定をされている方は設定解除をお願い致します。<br>
		</p>
	<?php } else { ?>

		<p class="error" style="margin: 0 0 4em; text-align:center;">

			<?php print $error; ?>

		</p>

	<?php } ?>

		<p class="btn"><a href="/">最初のぺージに戻る</a></p>
	</section>
	<?php include "include/footer_form.html";?>

<!-- TODO GTMでのCV発火が出来次第削除予定 -->
<!-- ロンバード(フェルマ) CV計測タグ 20201008 -->
<script type='text/javascript' src='https://js.felmat.net/fmcv.js?adid=V50235&uqid=<?php print($_SESSION['affi_order_number']); ?>'></script>
<!-- end ロンバード(フェルマ) CV計測タグ 20201008 -->

<!-- もしも CV計測タグ 20201008 -->
<script src="https://r.moshimo.com/af/r/result.js?p_id=3037&pc_id=7006&m_v=<?php print($_SESSION['affi_order_number']); ?>" id="msmaf"></script>
<noscript><img src="https://r.moshimo.com/af/r/result?p_id=3037&pc_id=7006&m_v=<?php print($_SESSION['affi_order_number']); ?>" width="1" height="1" alt=""></noscript>
<!-- end もしも CV計測タグ 20201008 -->

<!-- フリーダイブ 成果識別タグ 20201008 -->
<script>
var _CIDN = "cid";
var _PMTV = "5f7558aaacb8c";
var _ARGSV = "<?php print($_SESSION['affi_order_number']); ?>";
var _TRKU = "https://s8affi.net/asp/track.php?p=" + _PMTV + "&t=5f7558aa&args=" + _ARGSV;
var _cks = document.cookie.split("; ");
var _cidv = "";
for(var i = 0; i < _cks.length; i++){ var _ckd = _cks[i].split( "=" ); if(_ckd[0] == "CL_" + _PMTV && _ckd[1].length > 1){ _cidv = _ckd[1]; break; }}
if(!_cidv && localStorage.getItem("CL_" + _PMTV)){ _cidv = localStorage.getItem("CL_" + _PMTV); };
if(_cidv){ _TRKU += "&" + _CIDN + "=" + _cidv };
img = document.body.appendChild(document.createElement("img"));
img.src = _TRKU;
</script>
<!-- end フリーダイブ 成果識別タグ 20201008 -->

<!-- レントラックス 成果識別タグ 20201008 -->
<script type="text/javascript">
(function(){
function loadScriptRTCV(callback){
var script = document.createElement('script');
script.type = 'text/javascript';
script.src = 'https://www.rentracks.jp/js/itp/rt.track.js?t=' + (new Date()).getTime();
if ( script.readyState ) {
script.onreadystatechange = function() {
if ( script.readyState === 'loaded' || script.readyState === 'complete' ) {
script.onreadystatechange = null;
callback();
};
};
} else {
script.onload = function() {
callback();
};
};
document.getElementsByTagName('head')[0].appendChild(script);
}

loadScriptRTCV(function(){
_rt.sid = 3990;
_rt.pid = 7945;
_rt.price = 0;
_rt.reward = -1;
_rt.cname = '';
_rt.ctel = '';
_rt.cemail = '';
_rt.cinfo = '<?php print($_SESSION['affi_order_number']); ?>';
rt_tracktag();
});
}(function(){}));
</script>
<!-- end レントラックス 成果識別タグ 20201008 -->

<!-- A8 CVタグ 20201008 -->
<span id="a8sales"></span>
<script src="//statics.a8.net/a8sales/a8sales.js"></script>
<script>
a8sales({
"pid": "s00000019626002",
"order_number": "<?php print($_SESSION['affi_order_number']); ?>",
"currency": "JPY",
"items": [
{
"code": "a8",
"price": 1,
"quantity": 1
},
],
"total_price": 1,
});
</script>
<!-- end A8 CVタグ 20201008 -->

</body>
</html>
