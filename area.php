<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>fon光</title>
<meta name="robots" content="noindex" />
<meta name="viewport" id="viewport" content="width=device-width">
<meta name="description" content="">
<meta name="keywords" content="">
<link rel="stylesheet" href="css/style.css"> 
<link rel="stylesheet" href="css/style_form.css">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

<!--//* JS読み込み *//-->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/jquery.layerBoard.js"></script>
<script>
	$(function(){
  $('#modalArea').hide();

	$("#openModal").click(function() {
		// 1秒かけて表示する
		$("#modalArea").show(600);
	});
});
</script>
</head>
<body>
	<?php include "include/header_form.html";?>
	<section id="area">
		<h2>fon光お申し込み</h2>
		<h3 class="first">01 エリア検索</h3>
		<form method="post" action="application.php" id="appForm">
			<div class="search_text">お客様のお住い地域でご利用可能か検索します。</div>
			<div class="address">住所を検索する<br>
				<dl>
					<dt><img src="img/img_area.png" alt=""/></dt>
					<dd>
						<div class="select">
							<i class="fa fa-chevron-down" aria-hidden="true"></i>
							<select name="address">
							<option value="テスト1">テスト1</option>
							<option value="テスト2">テスト2</option>
							<option value="テスト3">テスト3</option>
						</select>
							</div>
					</dd>
				</dl>
			</div>
			<div class="subsequently">
				<ul class="form">
					<li>住所</li>
					<li><input class="result" type="text" placeholder="大阪府大阪市旭区高殿1丁目" name="address" readonly></li>
					<li><p>物件の種類をご選択ください。</p>
						<ul class="type">
							<li><input id="house01" name="house" type="radio" value="一軒家" class="check">
								<label for="house01"><img src="img/img_home01.png" alt="一軒家"/><br>一軒家</label></li>
							<li><input id="house02" name="house" type="radio" value="マンション（3F以下）" class="check">
								<label for="house02"><img src="img/img_home02.png" alt="マンション（3F以下）"/><br>マンション<br class="show_sp">（3F以下）</label></li>
							<li><input id="house03" name="house" type="radio" value="マンション（4F以上）" class="check">
								<label for="house03"><img src="img/img_home03.png" alt="マンション（4F以上）"/><br>マンション<br class="show_sp">（4F以上）</label></li>
						</ul>
					</li>
				</ul>
			</div>
			<div class="area_btn">
				<p id="openModal">エリアを検索する</p>
				<section id="modalArea" class="modalArea">
					<div id="modalBg" class="modalBg"></div>
					<div class="modalWrapper">
						<p><img src="img/img_pc_ok.png" alt=""/></p>
						<div class="answer">fon光提供エリアとなっています<br>
							<span>今すぐお申し込み頂けます</span></div>
						<div class="street_address">東京都 豊島区 池袋2丁目</div>
						<div id="closeModal" class="closeModal">×</div>
						<input type="submit" name="submit" value="お申し込みする" id="submit">
					</div>
				</section>
				<section id="modalArea02" class="modalArea02" style="display: none;">
					<div id="modalBg" class="modalBg"></div>
					<div class="modalWrapper">
						<p><img src="img/img_pc_ng.png" alt=""/></p>
						<div class="answer">fon光提供エリア外となっています</div>
						<div class="street_address">東京都 豊島区 池袋2丁目</div>
						<div id="closeModal" class="closeModal">×</div>
						<a class="ng" href="/">トップへ戻る</a>
					</div>
				</section>
				<section id="modalArea03" class="modalArea03" style="display: none;">
					<div id="modalBg" class="modalBg"></div>
					<div class="modalWrapper">
						<p><img src="img/img_pc_subtle.png" alt=""/></p>
						<div class="answer">fon光提供未確定エリアとなっています<br>
						<span>詳細はお電話にてお問い合わせください。</span></div>
						<div class="street_address">東京都 豊島区 池袋2丁目</div>
						<div id="closeModal" class="closeModal">×</div>
						<a class="subtle" href="tel:+81-120-966-486">電話で問い合わせる</a>
					</div>
				</section>
            </div>
			
		</form>
	</section>
	<?php include "include/footer_form.html";?>
</body>
</html>