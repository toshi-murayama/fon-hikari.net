<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
<meta charset="utf-8">
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta name="viewport" content="width=device-width,user-scalable=no,maximum-scale=1">
<title>fon光 お申し込みサイト</title>
<meta name="description" content="fon光のおトク情報満載！今ならお申し込みで【80,000円キャッシュバック中】月額料金も最安級3,680円で使い放題！セキュリティ・電話・テレビなどのサービスも豊富に取り揃えています。お得に申込むなら今がチャンス！">
<meta name="keywords" content="ワイファイ,ルーター,wifi,simフリー,ポケットワイファイ,帯域制限,速度制限,プレミアモバイル,データカード,タブレット">
<meta name="theme-color" content="#EC7103">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<link rel="shortcut icon" href="img/favicon.ico" />	
<!----css---->
<link rel="stylesheet" href="css/animate.css">
<link rel="stylesheet" href="css/style_form.css">
<link rel="stylesheet" href="css/style.css"> 
<link rel="stylesheet" href="css/validationEngine.jquery.css"> 
<!----js---->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/jquery-1.8.2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

<script type="text/javascript">
$(function(){
	$('.privacy').hide();
	$('.privacyTitle').on('click', function() {
		$('.privacy').slideToggle(500);
	});
});
</script>
<script src="js/jquery.validationEngine.js"></script>
<script src="js/jquery.validationEngine-ja.js"></script>
<script src="js/jquery.jpostal.min.js"></script>
<script src="js/jquery.autoKana.js"></script>
<script src="js/contact.js"></script>
<!--tag-->
<?php include "include/tag_head.html";?>
</head>
<body>
<?php include "include/tag_start.html";?>
<p id="cursor"></p>
<div id="stalker"></div>
<?php include "include/header_form.html";?>
	<section id="contact">
		<h2>お問い合わせ</h2>
		<h3>01 お問い合わせ内容をご入力ください</h3>
		<form method="post" action="contact_confirmation" id="appForm">
		<ul class="form">
			<li class="categories">
				<dl>
					<dt>氏名（姓）<br>
						<input size="30" type="text" name="姓" value="<?php print $first_name; ?>" class="validate[required]" id="lastName"></dt>
					<dd>氏名（名）<br>
						<input size="30" type="text" name="名" value="<?php print $second_name; ?>" class="validate[required]" id="firstName"></dd>
				</dl>
			</li>
			<li class="categories">
				<dl>
					<dt>フリガナ（セイ）<br>
						<input size="30" type="text" name="姓（カナ）" value="<?php print $first_name_kana; ?>" class="validate[required],[custom[zenkaku_kana]]" id="lastNameKana"></dt>
					<dd>フリガナ（メイ）<br>
						<input size="30" type="text" name="名（カナ）" value="<?php print $second_name_kana; ?>" class="validate[required],[custom[zenkaku_kana]]" id="firstNameKana"></dd>
				</dl>
			</li>
			<li class="categories">電話番号</li>
			<li>
				<input type="text" name="電話番号" value="<?php print $tel; ?>" maxlength='11' class="validate[required],[custom[onlyNumberSp]]">
			</li>
			<li class="categories">メールアドレス</li>
			<li>
				<input type="text" name="メールアドレス" value="<?php print $mail; ?>" class="validate[required],[custom[email]]">
			</li>
			<li class="categories">お問い合わせ内容</li>
			<li>
				<textarea name="お問い合わせ内容" value="<?php print $mail; ?>" class="validate[required]" rows="6" cols="60"></textarea>
			</li>
		</ul>
		<div class="privacyTitle">個人情報取得における告知・同意文</div>
		<div class="privacy">
                    <h4>【重要】お問い合わせをされる前に、下記個人報取得における告知・同意文、ご利用規約をよくお読みください。</h4>
                    <div class="privacy_text">
                        フ【個人情報取得における告知・同意文】<br>
                        1.サービス提供会社の個人情報に関する管理について フォン・ジャパン株式会社<br>
                        個人情報保護管理者 横田 和典<br>
                        〒171-0014 東京都豊島区池袋2-14-4 池袋TAビル8F TEL:0120-966-486 Mail:support@fon-hikari.net<br>
                        2.取得・利用目的 氏名、住所、電話番号、メールアドレス、生年月日その他必要な情報を、お申込みに対応、連絡のために取得し利用致します。<br>
                        3.第三者への提供<br>
                        頂いた個人情報は第三者への提供は致しません。 ただし、刑事訴訟法、地方税法、所得税法、商法などに基づく場合、ご本人様の同意なく個人情報の利用・提供を行うことがあります。<br>
                        4.個人情報の委託<br>
                        レンタルサーバー会社に委託をしています。 尚、業務の委託にあたっては事前に委託会社を選定し、個人情報保護の水準を満たしていることを確認しています。必要に応じて委託先会社とは個人情報保護に関する契約書を交わします。<br>
                        5.任意性 当該個人情報をご提出いただくかはご本人様の任意ですが、この同意文によりご不明な点ご解消されず、当該個人情報をご提出いただけない場合、お問い合わせの対応を行えない状況等、ご本人にとって不具合が発生しますことをご承知ください。<br>
                        6.個人情報の利用目的の通知、開示、訂正、追加又は削除、ならびに、利用停止、消去、第三者への提供の停止について<br>
                        取得した個人情報については、個人情報保護管理者が管理しています。 当社が保有する開示対象個人情報の利用目的の通知、開示、訂正、追加又は削除、ならびに利用停止、消去、第三者への提供の停止をご請求される場合は、上記1の管理者にお申し出下さい。 尚、そのときは本人確認のため、身分証明書のご提示をして頂きます。<br>
                        個人情報取得における告知・同意文、利用約款に同意します。<br>
                    </div>
		</div>
		<p class="agree_box">
			<input type="checkbox" name="同意文、利用約款" value="同意する" class="validate[required]" id="agree">
			<label for="agree" class="agree">
				同意する
			</label>
		</p>
		<dl class="btn">
			<dt><input type="button" value="戻る" id="backBtn" onclick="history.back()"></dt>
			<dd><input type="submit" name="submit" value="確認画面へ" id="submit"></dd>
		</dl>
		</form>
	</section>
	<?php include "include/footer_form.html";?>
</body>
</html>