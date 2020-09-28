<?php 
	require_once('../lib/confirmation_relay.php');
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,user-scalable=no,maximum-scale=1">
<title>確認画面</title>
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="theme-color" content="#EC7103">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<link rel="shortcut icon" href="img/favicon.ico" />	
<!----css---->
<link rel="stylesheet" href="css/animate.css">
<link rel="stylesheet" href="css/style_form.css">
<!----js---->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!--script src="js/confirmation.js"></script-->
<!-- <script src="js/script.js"></script> -->
<!--tag-->
<?php include "include/tag_head.html";?>
</head>
<body>
<?php include "include/tag_start.html";?>
<p id="cursor"></p>
<div id="stalker"></div>
<?php include "include/header_form.html";?>
	<section id="confirmation">
		<h2>fon光お申し込み</h2>
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
			</ul>
			<h4>オプション</h4>
			<ul class="form">
				<li class="categories">所有形態</li><li><p><?php print $ownershipString; ?></p></li>
				<li class="categories">光電話申込</li><li><p><?php print $telephoneApplicationString; ?></p></li>
				<div <?php if ($telephoneApplication == "0") { ?> style="display:none"<?php } ?> >
					<li class="categories">発番方法</li><li><p><?php print $numberingMethodString; ?></p></li>
				</div>
				<div <?php if ($numberingMethod == "0") { ?> style="display:none" <?php } ?> >
					<li class="categories">固定電話番号</li><li><p><?php print $fixedLine; ?></p></li>
				</div>
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
				<dt><input type="submit" name="submit" value="戻る" id="backBtn" onclick="history.back()"></dt>
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
			<input type="hidden" value="<?php print h($_SESSION['tk']); ?>" name="tk">
			<input type="hidden" name="confirmationSubmitFlag" value="1">
		</form>
	</section>
<?php include "include/footer_form.html";?>
</body>
</html>