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
							<p><?= $lastName; ?></p>
						</dt>
						<dd>氏名（名）
							<p><?= $firstName; ?></p>
						</dd>
					</dl>
				</li>
				<li class="categories">
					<dl>
						<dt>フリガナ（セイ）
							<p><?= $lastNameKana; ?></p>
						</dt>
						<dd>フリガナ（メイ）
							<p><?= $firstNameKana; ?></p>
						</dd>
					</dl>
				</li>
				<li class="categories">性別</li><li><p><?= $sexString; ?></p></li>
				<li class="categories">生年月日</li><li><p><?= $birthday; ?></p></li>
				<li class="categories">携帯番号</li><li><p><?= $phoneNumber; ?></p></li>
				<li class="categories">メールアドレス</li><li><p><?= $mailAddress; ?></p></li>
				<li class="categories">郵便番号</li><li><p><?= $postalCode; ?></p></li>
				<li class="categories">都道府県</li><li><p><?= $installationPref; ?></p></li>
				<li class="categories">市区町村</li><li><p><?= $installationMunicipalities; ?></p></li>
				<li class="categories">町名・丁目</li><li><p><?= $installationTown; ?></p></li>
				<li class="categories">番地・号</li><li><p><?= $installationAddress; ?></p></li>
				<li class="categories">建物名・部屋番号</li><li><p><?= $installationBuilding; ?></p></li>
				<li class="categories">物件の種類</li><li><p><?= $homeTypeString; ?></p></li>
				<li class="categories">所有形態</li><li><p><?= $ownershipString; ?></p></li>
			</ul>
			<h4>オプション</h4>
			<ul class="form">
				<li class="categories">光電話申込</li><li><p><?= $telephoneApplicationString; ?></p></li>
				<div <?php if ($telephoneApplication == "0") { ?> style="display:none"<?php } ?> >
					<li class="categories">発番方法</li><li><p><?= $numberingMethodString; ?></p></li>
				</div>
				<div <?php if ($numberingMethod == "0") { ?> style="display:none" <?php } ?> >
					<li class="categories">固定電話番号</li><li><p><?= $fixedLine; ?></p></li>
				</div>
				<li class="categories">リモートサポート</li><li><p><?= $remortSupportString; ?></p></li>
				<li class="categories">まとめてでんき</li><li><p><?= $collectivelyElectricityString; ?></p></li>
				<li class="categories">ひかりTV for NURO申込</li><li><p><?= $hikariTVString; ?></p></li>
				<div <?php if ($hikariTV == "0") { ?> style="display:none"<?php } ?> >
					<li class="categories">ひかりTV プラン</li><li><p><?= $hikariTvPlanString; ?></p></li>
				</div>
				<li class="categories">カスペルスキーセキュリティー</li><li><p><?= $kasperskySecurityString; ?></p></li>
				<li class="categories">希望工事日</li><li><p><?= nl2br($construction); ?></p></li>
			</ul>
			<h4>入会書類郵送先</h4>
			<ul class="form">
				<li class="categories">入会書類郵送希望先</li><li><p><?= $mailingDestinationString; ?></p></li>
				<div <?php if ($mailingDestination == "0") { ?> style="display:none" <?php } ?> >
					<li class="categories">郵便番号</li><li><p><?= $mailingPostalCode; ?></p></li>
					<li class="categories">都道府県</li><li><p><?= $mailingPrefName; ?></p></li>
					<li class="categories">市区町村</li><li><p><?= $mailingMunicipalities; ?></p></li>
					<li class="categories">町名・丁目</li><li><p><?= $mailingTown; ?></p></li>
					<li class="categories">番地・号</li><li><p><?= $mailingAddress; ?></p></li>
					<li class="categories">建物名・部屋番号</li><li><p><?= $mailingBuilding; ?></p></li>
				</div>
			</ul>
			<dl class="btn">
				<dt><input type="button" name="backBtn" value="戻る" id="backBtn" onclick="history.back()"></dt>
				<dd><input type="submit" name="submit" value="お申し込み" id="submit"></dd>
			</dl>

			<!-- postを設定 -->
			<input type="hidden" value="<?= h($applicationClassification); ?>" name="applicationClassification">
			<input type="hidden" value="<?= h($lastName); ?>" name="lastName">
			<input type="hidden" value="<?= h($firstName); ?>" name="firstName">
			<input type="hidden" value="<?= h($lastNameKana); ?>" name="lastNameKana">
			<input type="hidden" value="<?= h($firstNameKana); ?>" name="firstNameKana">
			<input type="hidden" value="<?= h($sex); ?>" name="sex">
			<input type="hidden" value="<?= h($birthday); ?>" name="birthday">
			<input type="hidden" value="<?= h($phoneNumber); ?>" name="phoneNumber">
			<input type="hidden" value="<?= h($fixedLine); ?>" name="fixedLine">
			<input type="hidden" value="<?= h($mailAddress); ?>" name="mailAddress">
			<input type="hidden" value="<?= h($postalCode); ?>" name="postalCode">
			<input type="hidden" value="<?= h($installationPref); ?>" name="installationPref">
			<input type="hidden" value="<?= h($installationMunicipalities); ?>" name="installationMunicipalities">
			<input type="hidden" value="<?= h($installationTown); ?>" name="installationTown">
			<input type="hidden" value="<?= h($installationAddress); ?>" name="installationAddress">
			<input type="hidden" value="<?= h($installationBuilding); ?>" name="installationBuilding">
			<input type="hidden" value="<?= h($ownership); ?>" name="ownership">
			<input type="hidden" value="<?= h($mailingDestination); ?>" name="mailingDestination">
			<input type="hidden" value="<?= h($mailingPostalCode); ?>" name="mailingPostalCode">
			<input type="hidden" value="<?= h($mailingPrefName); ?>" name="mailingPrefName">
			<input type="hidden" value="<?= h($mailingMunicipalities); ?>" name="mailingMunicipalities">
			<input type="hidden" value="<?= h($mailingTown); ?>" name="mailingTown">
			<input type="hidden" value="<?= h($mailingAddress); ?>" name="mailingAddress">
			<input type="hidden" value="<?= h($mailingBuilding); ?>" name="mailingBuilding">
			<input type="hidden" value="<?= h($telephoneApplication); ?>" name="telephoneApplication">
			<input type="hidden" value="<?= h($homeType); ?>" name="homeType">
			<input type="hidden" value="<?= h($numberingMethod); ?>" name="numberingMethod">
			<input type="hidden" value="<?= h($remortSupport); ?>" name="remortSupport">
			<input type="hidden" value="<?= h($collectivelyElectricity); ?>" name="collectivelyElectricity">
			<input type="hidden" value="<?= h($hikariTV); ?>" name="hikariTV">
			<input type="hidden" value="<?= h($kasperskySecurity); ?>" name="kasperskySecurity">
			<input type="hidden" value="<?= h($construction); ?>" name="construction">
			<input type="hidden" value="<?= h($hikariTvPlan); ?>" name="hikariTvPlan">
            <input type="hidden" value="<?= h($hikariTvPlanString); ?>" name="hikariTvPlanString">
			<input type="hidden" value="<?= h($hikariTvPlanApplication); ?>" name="hikariTvPlanApplication">
			<input type="hidden" value="<?= h($hikariTvPlanTuner); ?>" name="hikariTvPlanTuner">
			<input type="hidden" value="<?= h($affiOrderNumber); ?>" name="affiOrderNumber">
			<input type="hidden" value="<?= h($_SESSION['tk']); ?>" name="tk">
			<input type="hidden" name="confirmationSubmitFlag" value="1">
			<input type="hidden" name="couponCode" value="<?= $couponCode ?>">
			<!--			<input type="hidden" name="cloudBackup" value="<?= $cloudBackup ?>">  -->
			<input type="hidden" name="cloudBackup" value="YES"> 
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
