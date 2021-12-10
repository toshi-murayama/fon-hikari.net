<?php
require_once('../lib/Application.php');
require_once '../vendor/autoload.php';
require_once '../config.php';
require_once '../lib/SupportMailUtil2.php';

use Param\HatarakuDbInsert;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;

$logger = new Logger('thanks.php');
$logger->pushHandler(new RotatingFileHandler($GLOBALS['DEBUG_LOG_DIR']. 'debug.log' , 5 ,
                                             $GLOBALS['DEBUG_LOG_LEVEL']) );
$logger->debug('==== START ====');
$logger->debug('$_POST : '. var_export($_POST, true) );

$retVals = [
    'keyId' => 'XXXXXXX',
];
$logger->debug('before Service::exec();');
$error = Service::exec( $retVals );
$logger->debug('after Service::exec();');
$logger->debug('$error : '. var_export($error, true) );

$cbParams = [];
if( $error == '' ){
    cloudBackup($logger, $error, $cbParams, $retVals['keyId'] ); 
}

///////////////////////////////////////////////////////////////////////////
function cloudBackup($logger, $error, &$cbParams, $recordid ) {
    $logger->debug('START cloudBackup()');

    $cbParams['cloudBackup'] = $_POST['cloudBackup'];
    if( $cbParams['cloudBackup'] != 'YES' ){
        $logger->debug('$cbParams : '. var_export( $cbParams, true) );
        $logger->debug('END cloudBackup() A');
        return;
    }

    //契約形態．
    // 双方共に，0:個人，1:法人
    $cbParams['pracontact'] = $_POST['applicationClassification'];

    $cbParams['pracompany']  = '' ; // 企業名としては入力してない．

    $cbParams['pradname1']  = htmlspecialchars($_POST['lastName'] );
    $cbParams['pradname2']  = htmlspecialchars($_POST['firstName'] );
    $cbParams['pranameread1'] = htmlspecialchars($_POST['lastNameKana'] );
    $cbParams['pranameread2'] = htmlspecialchars($_POST['firstNameKana'] );

    // 性別： application.php では「1:男,2:女] ，
    // クラウドバックアップ連携では 「0:男,1:女] なので注意
    if( $_POST['sex'] == '1'){
        $cbParams['pragender'] = '0'; // 男
    }
    else {
        $cbParams['pragender'] = '1'; // 女
    }
    $cbParams['prabirthday'] = htmlspecialchars( str_replace('/','', $_POST['birthday']) );
    $cbParams['pramail'] = htmlspecialchars($_POST['mailAddress'] );
    $cbParams['praphone'] = htmlspecialchars($_POST['phoneNumber'] );
    $cbParams['prapostal'] = htmlspecialchars($_POST['postalCode'] );

    // 発送先住所
    if( $_POST['mailingDestination'] =='0' ) { // 0: 設置場所と同じ
        $cbParams['praaddress'] = htmlspecialchars(  $_POST['installationPref'] .' '
                                                    . $_POST['installationMunicipalities'] .' '
                                                    . $_POST['installationTown'] .' '
                                                    . $_POST['installationAddress'] .' '
                                                    . $_POST['installationBuilding'] );
    }
    else { // 1: 別住所に送る
        $cbParams['praaddress'] = htmlspecialchars(  $_POST['mailingPrefName'] .' '
                                                    . $_POST['mailingMunicipalities'] .' '
                                                    . $_POST['mailingTown'] .' '
                                                    . $_POST['mailingAddress'] .' '
                                                    . $_POST['mailingBuilding'] );
    }
    $cbParams['pratodofuken'] = $_POST['installationPref'];

    $cbParams['pradbid'] = '101234' ;// FON光は固定
    $cbParams['prarecordid'] = $recordid ;
    $logger->debug('$cbParams : '. var_export( $cbParams, true) );

    ////////////////////////////////////////////
    // メール のパラメータ
    $adminMailParams = [];
    if( $_POST['applicationClassification'] == '1' ) { // 法人
        $adminMailParams['契約形態'] = '法人';
    }
    else { // 0 個人
        $adminMailParams['契約形態'] = '個人';
    }
    //    $adminMailParams['会社名'] = '--'; //「会社名」を入力してない
    $adminMailParams['お名前'] = $_POST['lastName'] .' '. $_POST['firstName'] ;
    $adminMailParams['フリガナ'] = $_POST['lastNameKana'] .' '. $_POST['firstNameKana'] ;
    // 性別： クラウドバックアップ連携では 「0:男,1:女] なので注意
    if( $_POST['sex'] == '1' ){
        $adminMailParams['性別'] = '男性';
    }
    else { // 2
        $adminMailParams['性別'] = '女性';
    }

    $adminMailParams['生年月日'] = $_POST['birthday'];
    $adminMailParams['メールアドレス'] = $_POST['mailAddress'];
    $adminMailParams['電話番号'] = $_POST['phoneNumber'];
    $adminMailParams['郵便番号'] = $_POST['postalCode'];
    $adminMailParams['都道府県'] = $_POST['installationPref'];
    $adminMailParams['契約住所'] = $_POST['installationMunicipalities']
                                 .' '. $_POST['installationTown']
                                 .' '. $_POST['installationAddress']
                                 .' '. $_POST['installationBuilding'];
    $adminMailParams['お支払い方法'] = 'クレカのみ';
    $adminMailParams['クラウドバックアップ月額（税込)'] = '550円';
    $adminMailParams['月額合計料金(税込)'] =  '550円' ;

    $adminMailParams['働くDBのテーブル'] = '101234 : Fon光';
    $adminMailParams['テーブルのレコードID'] = $recordid ;
    $logger->debug(' $adminMailParams : '. var_export( $adminMailParams, true) );


    //////////////////////
    // メール送信
    $mailConfig = $GLOBALS['SUPPORT_CLOUDBACKUP_EMAIL'] ;
    $logger->debug('$mailConfig : '. var_export($mailConfig, true) );

    // 管理者むけ．
    $date = (new DateTime())->format('Y/m/d (D) H:i:s');
    $adminMsgTop = <<< MSG
Fon光 担当者様
以下の内容で「Fon光 クラウドサービス連携」のお申込みがありました。

受け付け日時： {$date}

＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
MSG;

        $adminMsgBottom = <<< MSG
＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝

■□━━━━━━━━━━━━━━━━━━━━━━━□■

MAIL：support@fon-hikari.net
MSG;

    $mailUtil = new SupportMailUtil2( $logger ) ;
    $mailUtil->setAdminTopAndBottom( $adminMsgTop , $adminMsgBottom );
    $mailUtil->adminMessageText( [], $adminMailParams) ;

    $mailUtil->sendAdmin( '[新規申込] オプション商品',
                          $mailConfig['FROM'],
                          $mailConfig['TO'] );

    $logger->debug('END cloudBackup() B');
    return;
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
<title>申し込み | Fon光 超高速光回線インターネット</title>
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
<link rel="stylesheet" href="css/animations.css">
<!--js-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
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
		<h2>Fon光お申し込み</h2>
		<h3>04 お申し込み完了</h3>
		<?php if ( $error == '' ) { ?>

		<div class="search_text">お申し込みありがとうございます。</div>
		<p class="text">後程弊社担当よりお電話にてご連絡させて頂きます。お電話をもってお申し込み完了となります。<br>
		0120-966-486よりお電話させて頂きますので<br>
		フリーダイヤル等の着信拒否設定をされている方は設定解除をお願い致します。<br>
		</p>

		<?php if( $cbParams['cloudBackup'] == 'YES' ){ ?>
		<!--
        <form method="POST" action="https://cloud-option.com/">
          <div class="cp_cloud_backup">
			<h6>Amazonギフトコード<span>3,000</span>円分<span><br>プレゼントキャンペーン！！</span></h6>
			<div class="cp_text">クラウドバックアップのお申し込みへチェックを入れた方は、下記ボタンよりお申し込みを完了させてください。</div>
			<div class="cp_btn">
			  <button type="submit" value="送信する">引き続きクラウドバックアップのお申し込みへ</button>
            </div>
          </div>

          <input type="hidden" name="pracontact" value="<?= $cbParams['pracontact'] ?>">
          <input type="hidden" name="pracompany" value="<?= $cbParams['pracompany'] ?>">
          <input type="hidden" name="praname1" value="<?= $cbParams['pradname1'] ?>">
          <input type="hidden" name="praname2" value="<?= $cbParams['pradname2'] ?>">
          <input type="hidden" name="pranameread1" value="<?= $cbParams['pranameread1'] ?>">
          <input type="hidden" name="pranameread2" value="<?= $cbParams['pranameread2'] ?>">
          <input type="hidden" name="pragender" value="<?= $cbParams['pragender'] ?>">
          <input type="hidden" name="prabirthday" value="<?= $cbParams['prabirthday'] ?>">
          <input type="hidden" name="pramail" value="<?= $cbParams['pramail'] ?>">
          <input type="hidden" name="praphone" value="<?= $cbParams['praphone'] ?>">
          <input type="hidden" name="prapostal" value="<?= $cbParams['prapostal'] ?>">
          <input type="hidden" name="praaddress" value="<?= $cbParams['praaddress'] ?>">

          <input type="hidden" name="pratodofuken" value="<?= $cbParams['pratodofuken'] ?>">
          <input type="hidden" name="pradbid" value="<?= $cbParams['pradbid'] ?>">
          <input type="hidden" name="prarecordid" value="<?= $cbParams['prarecordid'] ?>">
        </form>
		-->
		<?php } /* cludBackup */ ?>
	<?php } else { /* error表示 */ ?>

		<p class="error" style="margin: 0 0 4em; text-align:center;">

		<p class="error"><?php print $error; ?></p>

		</p>

	<?php } ?>
		<?php if(isset($_COOKIE['affiliate'])) { ?>
			<p class="btn"><a href="/ta">最初のぺージに戻る</a></p>
		<?php } else if($isDonutsCp) {?>
			<p class="btn"><a href="/donuts_lp">最初のぺージに戻る</a></p>
		<?php } else {?>
			<p class="btn"><a href="/">最初のぺージに戻る</a></p>
		<?php } ?>
	</section>
	<?php
	if(isset($_COOKIE['affiliate'])) {
		include "include/footer_affiliate.html";
	} else {
		include "include/footer_form.html";
	}
	?>

<!-- TODO GTMでのCV発火が出来次第削除予定 -->
<!-- ロンバード(フェルマ) CV計測タグ 20201008 -->
<script type='text/javascript' src='https://js.felmat.net/fmcv.js?adid=V50235&uqid=<?php print($_SESSION['affiOrderNumber']); ?>'></script>
<!-- end ロンバード(フェルマ) CV計測タグ 20201008 -->

<!-- もしも CV計測タグ 20201008 -->
<script src="https://r.moshimo.com/af/r/result.js?p_id=3037&pc_id=7006&m_v=<?php print($_SESSION['affiOrderNumber']); ?>" id="msmaf"></script>
<noscript><img src="https://r.moshimo.com/af/r/result?p_id=3037&pc_id=7006&m_v=<?php print($_SESSION['affiOrderNumber']); ?>" width="1" height="1" alt=""></noscript>
<!-- end もしも CV計測タグ 20201008 -->

<!-- フリーダイブ 成果識別タグ 20210930 -->
<script>
(function(){
var _CIDN = "cid";
var _PLIDN = "plid";
var _ACTN = "cid_auth_get_type";
var _APTN = "plid_auth_get_type";
var _PMTV = "5f7558aaacb8c";
var _ARGSV = "<?php print($_SESSION['affiOrderNumber']); ?>";
var _TRKU = "https://s8affi.net/track.php?p=" + _PMTV + "&args=" + _ARGSV;
var _cks = document.cookie.split("; ");
var _cidv = "", _plidv = "", _actv = "", _aptv = "";
for(var i = 0; i < _cks.length; i++){ var _ckd = _cks[i].split("="); if(_ckd[0] == "CL_" + _PMTV && _ckd[1].length > 1){ _cidv = _ckd[1]; } if(_ckd[0] == "PL_" + _PMTV && _ckd[1].length > 1){ _plidv = _ckd[1]; } if(_ckd[0] == "ACT_" + _PMTV && _ckd[1].length > 1){ _actv = _ckd[1]; } if(_ckd[0] == "APT_" + _PMTV && _ckd[1].length > 1){ _aptv = _ckd[1]; } if(_cidv && _plidv && _actv && _aptv) break; }
if(!_cidv && localStorage.getItem("CL_" + _PMTV)){ _cidv = localStorage.getItem("CL_" + _PMTV); _actv = "ls"; }
if(_cidv){ _TRKU += "&" + _CIDN + "=" + _cidv; }
if(!_plidv && localStorage.getItem("PL_" + _PMTV)){ _plidv = localStorage.getItem("PL_" + _PMTV); _aptv = "ls"; }
if(_plidv){ _TRKU += "&" + _PLIDN + "=" + _plidv; }
if(_actv){ _TRKU += "&" + _ACTN + "=" + _actv; }
if(_aptv){ _TRKU += "&" + _APTN + "=" + _aptv; }
var _xhr = new XMLHttpRequest(); _xhr.open("GET", _TRKU + "&t=5f7558aa"); _xhr.send();
}());
</script>
<!-- end フリーダイブ 成果識別タグ 20210930 -->

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
_rt.cinfo = '<?php print($_SESSION['affiOrderNumber']); ?>';
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
"order_number": "<?php print($_SESSION['affiOrderNumber']); ?>",
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

<!-- アクセストレード CVタグ 20201016 -->
<script>
  var __atw = __atw || [];
  __atw.push({ "merchant" : "fonhikari", "param" : {
    "result_id" : "100",
    "verify" : "<?php print($_SESSION['affiOrderNumber']); ?>",
  }});
(function(a){var b=a.createElement("script");b.src="https://h.accesstrade.net/js/nct/cv.min.js";b.async=!0;
a=a.getElementsByTagName("script")[0];a.parentNode.insertBefore(b,a)})(document);
</script>
<!-- end アクセストレード CVタグ 20201016 -->

</body>
</html>
