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
<!--<link rel="stylesheet" href="css/style.css">--> 
<link rel="stylesheet" href="css/style_form.css"> 

<!--//* JS読み込み *//-->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/jquery.layerBoard.js"></script>
</head>
<body>
<main>
	<section id="area">
		<h2>fon光お申し込み</h2>
		<h3>01 エリア検索</h3>
		<form method="post" action="area_confirmation.php" id="appForm">
			<div class="search_text">お客様のお住い地域でご利用可能か検索します。</div>
			<div class="address">住所を検索する<br>
				<dl>
					<dt><img src="img/img_area.png" alt=""/></dt>
					<dd><input type="text" placeholder="大阪府大阪市旭区高殿1丁目" name="address"></dd>
				</dl>
			</div>
			<div class="subsequently">
				<ul>
					<li>住所</li>
					<li><p>物件の種類をご選択ください。</p>
						<ul class="type">
							<li><input id="house01" name="house" type="radio" value="一軒家"><label for="man"><img src="img/img_home01.png" alt="一軒家"/><br>一軒家</label></li>
							<li><input id="house02" name="house" type="radio" value="マンション（3F以下）"><label for="man"><img src="img/img_home02.png" alt="マンション（3F以下）"/><br>マンション（3F以下）</label></li>
							<li><input id="house03" name="house" type="radio" value="マンション（4F以上）"><label for="man"><img src="img/img_home03.png" alt="マンション（4F以上）"/><br>マンション（4F以上）</label></li>
						</ul>
					</li>
				</ul>
			</div>
		</form>
	</section>
</main>
</body>
</html>