<?php 
	require_once('../lib/confirmation_relay.php');
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
<meta charset="UTF-8" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>お申し込み | Fon光 超高速光回線インターネット</title>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!--script src="js/confirmation.js"></script-->
<!-- <script src="js/script.js"></script> -->
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
	<section id="confirmation">
		<h2>Fon光お申し込み</h2>
		<h3>03 ご契約情報確認</h3>
		<div class="search_text">ご契約先の情報をご確認ください。</div>
		<?php
	print $error;
	?>
		<form method="post" action="thanks">
			<h4>ご契約者情報</h4>
			<ul class="form">
				<li class="categories">
					<dl>
						<dt>氏名（姓）
							<p><?php print $lastName; ?></p>
						</dt>
						<dd>氏名（名）
							<p><?php print $firstName; ?></p>
						</dd>
					</dl>
				</li>
				<li class="categories">
					<dl>
						<dt>フリガナ（セイ）
							<p><?php print $lastNameKana; ?></p>
						</dt>
						<dd>フリガナ（メイ）
							<p><?php print $firstNameKana; ?></p>
						</dd>
					</dl>
				</li>
				<li class="categories">性別</li><li><p><?php print $sexString; ?></p></li>
				<li class="categories">生年月日</li><li><p><?php print $birthday; ?></p></li>
				<li class="categories">携帯番号</li><li><p><?php print $phoneNumber; ?></p></li>
				<li class="categories">メールアドレス</li><li><p><?php print $mailAddress; ?></p></li>
				<li class="categories">郵便番号</li><li><p><?php print $postalCode; ?></p></li>
				<li class="categories">都道府県</li><li><p><?php print $installationPref; ?></p></li>
				<li class="categories">市区町村</li><li><p><?php print $installationMunicipalities; ?></p></li>
				<li class="categories">町名・丁目</li><li><p><?php print $installationTown; ?></p></li>
				<li class="categories">番地・号</li><li><p><?php print $installationAddress; ?></p></li>
				<li class="categories">建物名・部屋番号</li><li><p><?php print $installationBuilding; ?></p></li>
				<li class="categories">物件の種類</li><li><p><?php print $homeTypeString; ?></p></li>
				<li class="categories">所有形態</li><li><p><?php print $ownershipString; ?></p></li>
			</ul>
			<h4>オプション</h4>
			<ul class="form">
				<li class="categories">光電話申込</li><li><p><?php print $telephoneApplicationString; ?></p></li>
				<div <?php if ($telephoneApplication == "0") { ?> style="display:none"<?php } ?> >
					<li class="categories">発番方法</li><li><p><?php print $numberingMethodString; ?></p></li>
				</div>
				<div <?php if ($numberingMethod == "0") { ?> style="display:none" <?php } ?> >
					<li class="categories">固定電話番号</li><li><p><?php print $fixedLine; ?></p></li>
				</div>
				<li class="categories">リモートサポート</li><li><p><?php print $remortSupportString; ?></p></li>
				<li class="categories">まとめてでんき</li><li><p><?php print $collectivelyElectricityString; ?></p></li>
				<li class="categories">ひかりTV for NURO申込</li><li><p><?php print $hikariTVString; ?></p></li>
				<div <?php if ($hikariTV == "0") { ?> style="display:none"<?php } ?> >
					<li class="categories">ひかりTV プラン</li><li><p><?php print $hikariTvPlanString; ?></p></li>
				</div>
				<li class="categories">カスペルスキーセキュリティー</li><li><p><?php print $kasperskySecurityString; ?></p></li>
				<li class="categories">希望工事日</li><li><p><?php print nl2br($construction); ?></p></li>
			</ul>
			<h4>入会書類郵送先</h4>
			<ul class="form">
				<li class="categories">入会書類郵送希望先</li><li><p><?php print $mailingDestinationString; ?></p></li>
				<div <?php if ($mailingDestination == "0") { ?> style="display:none" <?php } ?> >
					<li class="categories">郵便番号</li><li><p><?php print $mailingPostalCode; ?></p></li>
					<li class="categories">都道府県</li><li><p><?php print $mailingPrefName; ?></p></li>
					<li class="categories">市区町村</li><li><p><?php print $mailingMunicipalities; ?></p></li>
					<li class="categories">町名・丁目</li><li><p><?php print $mailingTown; ?></p></li>
					<li class="categories">番地・号</li><li><p><?php print $mailingAddress; ?></p></li>
					<li class="categories">建物名・部屋番号</li><li><p><?php print $mailingBuilding; ?></p></li>
				</div>
			</ul>
			<dl class="btn">
				<dt><input type="button" name="backBtn" value="戻る" id="backBtn" onclick="history.back()"></dt>
				<dd><input type="submit" name="submit" value="お申し込み" id="submit"></dd>
			</dl>

			<!-- postを設定 -->
			<input type="hidden" value="<?php print h($applicationClassification); ?>" name="applicationClassification">
			<input type="hidden" value="<?php print h($lastName); ?>" name="lastName">	
			<input type="hidden" value="<?php print h($firstName); ?>" name="firstName">				
			<input type="hidden" value="<?php print h($lastNameKana); ?>" name="lastNameKana">
			<input type="hidden" value="<?php print h($firstNameKana); ?>" name="firstNameKana">
			<input type="hidden" value="<?php print h($sex); ?>" name="sex">	
			<input type="hidden" value="<?php print h($birthday); ?>" name="birthday">
			<input type="hidden" value="<?php print h($phoneNumber); ?>" name="phoneNumber">	
			<input type="hidden" value="<?php print h($fixedLine); ?>" name="fixedLine">		
			<input type="hidden" value="<?php print h($mailAddress); ?>" name="mailAddress">	
			<input type="hidden" value="<?php print h($postalCode); ?>" name="postalCode">		
			<input type="hidden" value="<?php print h($installationPref); ?>" name="installationPref">
			<input type="hidden" value="<?php print h($installationMunicipalities); ?>" name="installationMunicipalities">
			<input type="hidden" value="<?php print h($installationTown); ?>" name="installationTown">
			<input type="hidden" value="<?php print h($installationAddress); ?>" name="installationAddress">	
			<input type="hidden" value="<?php print h($installationBuilding); ?>" name="installationBuilding">				
			<input type="hidden" value="<?php print h($ownership); ?>" name="ownership">
			<input type="hidden" value="<?php print h($mailingDestination); ?>" name="mailingDestination">
			<input type="hidden" value="<?php print h($mailingPostalCode); ?>" name="mailingPostalCode">	
			<input type="hidden" value="<?php print h($mailingPrefName); ?>" name="mailingPrefName">
			<input type="hidden" value="<?php print h($mailingMunicipalities); ?>" name="mailingMunicipalities">	
			<input type="hidden" value="<?php print h($mailingTown); ?>" name="mailingTown">		
			<input type="hidden" value="<?php print h($mailingAddress); ?>" name="mailingAddress">	
			<input type="hidden" value="<?php print h($mailingBuilding); ?>" name="mailingBuilding">		
			<input type="hidden" value="<?php print h($telephoneApplication); ?>" name="telephoneApplication">
			<input type="hidden" value="<?php print h($homeType); ?>" name="homeType">
			<input type="hidden" value="<?php print h($numberingMethod); ?>" name="numberingMethod">
			<input type="hidden" value="<?php print h($remortSupport); ?>" name="remortSupport">
			<input type="hidden" value="<?php print h($collectivelyElectricity); ?>" name="collectivelyElectricity">
			<input type="hidden" value="<?php print h($hikariTV); ?>" name="hikariTV">
			<input type="hidden" value="<?php print h($kasperskySecurity); ?>" name="kasperskySecurity">
			<input type="hidden" value="<?php print h($construction); ?>" name="construction">
			<input type="hidden" value="<?php print h($hikariTvPlan); ?>" name="hikariTvPlan">
            <input type="hidden" value="<?php print h($hikariTvPlanString); ?>" name="hikariTvPlanString">
			<input type="hidden" value="<?php print h($hikariTvPlanApplication); ?>" name="hikariTvPlanApplication">
			<input type="hidden" value="<?php print h($hikariTvPlanTuner); ?>" name="hikariTvPlanTuner">
			<input type="hidden" value="<?php print h($affiOrderNumber); ?>" name="affiOrderNumber">
			<input type="hidden" value="<?php print h($_SESSION['tk']); ?>" name="tk">
			<input type="hidden" name="confirmationSubmitFlag" value="1">
		</form>
	</section>
	<?php 
	if(isset($_COOKIE['affiliate'])) {
		include "include/footer_affiliate.html";
	} else {
		include "include/footer_form.html";
	}
	?>
</body>
</html>