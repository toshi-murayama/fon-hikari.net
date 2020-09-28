<?php
    require_once('../lib/Param/pref.php');
?>
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
<meta name="keywords" content="コミュファ,fon光,光,キャンペーン,インターネット,高速インターネット,光回線,プロバイダ,工事,キャッシュバック,乗り換え">
<meta name="theme-color" content="#EC7103">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<link rel="shortcut icon" href="img/favicon.ico" />	
<!----css---->
<link rel="stylesheet" href="css/animate.css"> 
<link rel="stylesheet" href="css/style_form.css">
<link rel="stylesheet" href="css/validationEngine.jquery.css"> 
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<link rel="stylesheet" href="css/jquery-ui.css" >
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/jquery-1.8.2.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/datepicker-ja.min.js"></script>
<script type="text/javascript">

$(function(){

	//カレンダー
	$("#datepicker").datepicker({
		defaultDate: new Date(2000,3,1),
		changeMonth: true,
		changeYear: true,
		yearRange: '-70:+0',
	}).datepicker("setDate", "2000/03/01");
	$('.privacy').hide();
	$('.privacyTitle').on('click', function() {
		$('.privacy').slideToggle(500);
	});
	// 光電話申込
	$('input[name="telephoneApplication"]').change(function() {
		if ($('input[name="telephoneApplication"]:checked').val() != '0') {
			$('.numbering').show();
			// 固定電話
			if ($('input[name="numberingMethod"]:checked').val() == '1') {
				$('.telephoneApplicationFixedLine').show();
			}
		} else {
			$('.numbering').hide();
			$('.telephoneApplicationFixedLine').hide();
		}
	});
	// 発番方法
	$('input[name="numberingMethod"]').change(function() {
		if ($('input[name="numberingMethod"]:checked').val() != '0') {
			$('.telephoneApplicationFixedLine').show();
		} else {
			$('.telephoneApplicationFixedLine').hide();
		}
	});

	// 郵送先情報
	$('input[name="mailingDestination"]').change(function() {
		if ($('input[name="mailingDestination"]:checked').val() != '0') {
			$('.aother_address').show();
		} else {
			$('.aother_address').hide();
		}
	});
});
	
$(window).load(function() {
		//発送先住所
		$('[name="mailingDestination"]:radio').change( function() {
				if($('[id=same]').prop('checked')){
					$('.aother_address').fadeOut();
				} else if ($('[id=aother]').prop('checked')) {
					$('.aother_address').fadeIn();
				} 
		}).change();

		var homeType;
		<?php
		if(isset($_POST['homeType'])) {
		?>
			homeType = <?php echo $_POST['homeType']?> - 1;
		<?php 
		}
		?>
		// 物件種類
		$('input[name="homeType"]:eq('+ homeType +')').attr('checked', 'checked');

});
</script>
<script src="js/jquery.validationEngine.js"></script>
<script src="js/jquery.validationEngine-ja.js"></script>
<script src="js/jquery.jpostal.min.js"></script>
<script src="js/ajaxzip3.js"></script>
<script src="js/jquery.autoKana.js"></script>
<script src="js/application.js"></script>

<!--tag-->
<?php include "include/tag_head.html";?>
</head>
<body>
<?php include "include/tag_start.html";?>
<p id="cursor"></p>
<div id="stalker"></div>
	<?php include "include/header_form.html";?>
	<section id="application">
		<h2>fon光お申し込み</h2>
		<h3>02 お客様情報入力</h3>
		<div class="search_text">ご契約先の情報をご入力ください。</div>
		<form method="post" action="confirmation" id="appForm">
			<h4>ご契約者情報</h4>
			<ul class="form">
				<li class="categories">申込区分</li>
				<li class="app">
					<input type="radio" name="applicationClassification" value="0" id="individual" checked>
					<label for="individual">個人</label>
					<input type="radio" name="applicationClassification" value="1" class="check" id="corporation">
					<label for="corporation">法人</label>
				</li>
				<li class="categories">
					<dl>
						<dt>氏名（姓）<br>
						<input size="30" type="text" name="lastName" value="<?php print $first_name; ?>" class="validate[required]" id="lastName"></dt>
						<dd>氏名（名）<br>
						<input size="30" type="text" name="firstName" value="<?php print $second_name; ?>" class="validate[required]" id="firstName"></dd>
					</dl>
					</li>
				<li class="categories">
					<dl>
						<dt>フリガナ（セイ）<br>
						<input size="30" type="text" name="lastNameKana" value="<?php print $first_name_kana; ?>" class="validate[required],[custom[zenkaku_kana]]" id="lastNameKana"></dt>
						<dd>フリガナ（メイ）<br>
						<input size="30" type="text" name="firstNameKana" value="<?php print $second_name_kana; ?>" class="validate[required],[custom[zenkaku_kana]]" id="firstNameKana"></dd>
					</dl>
				</li>
				<li class="categories">性別</li>
				<li class="app">
					<input type="radio" name="sex" value="1" id="man" class="check" checked>
					<label for="man">男性</label>
					<input type="radio" name="sex" value="2" class="check" id="women">
					<label for="women">女性</label>
				</li>
				<li class="categories">生年月日</li>
				<li>
					<label class="birthday">
						<input name="birthday" type="text" id="datepicker" class="validate[required]">
					</label>
				</li>
				<li class="categories">携帯番号</li>
				<li>
					<input type="text" name="phoneNumber" value="<?php print $tel; ?>"  minlength='11' maxlength='11' class="validate[required],[custom[onlyNumberSp]]">
				</li>
				<li class="categories">メールアドレス</li>
				<li>
					<input type="text" name="mailAddress" value="<?php print $mail; ?>" class="validate[required],[custom[email]]">
				</li>
			</ul>
			<h4>fon光 設置先住所</h4>
			<ul class="form">
				<li class="categories">郵便番号</li>
				<li>
					<input type="text" name="postalCode" value="<?php print $postal_code; ?>" type="number"  minlength='7' maxlength='7' class="min validate[required],[custom[onlyNumberSp]]" id="postalCode" onkeyup="AjaxZip3.zip2addr(this,'','installationPref','installationMunicipalities','installationTown');">
				</li>
				<li class="categories">都道府県</li>
				<li>
					<div class="select">
						<i class="fa fa-chevron-down" aria-hidden="true"></i>
						<select name="installationPref" id="prefectures" class="validate[required]">
                            <option value="" selected>都道府県を選択</option>
                            <?php foreach($prefs as $pref) { ?>
                                <option value=<?php print $pref?>><?php print $pref?></option>                                       
                            <?php } ?>
                        </select>
						</div>
				</li>
				<li class="categories">市区町村</li>
				<li>
					<input type="text" name="installationMunicipalities" value="<?php print $address; ?>" class="validate[required]">
				</li>
				<li class="categories">町名・丁目</li>
				<li>
					<input type="text" name="installationTown" value="<?php print $address; ?>" class="validate[required]" >
				</li>
				<li class="categories">番地・号</li>
				<li>
					<input type="text" name="installationAddress" value="<?php print $address; ?>" class="validate[required]">
				</li>
                <li class="categories">建物名・部屋番号</li>
				<li>
					<input type="text" name="installationBuilding" value="<?php print $room_number; ?>">
				</li>
				<li>物件の種類をご選択ください。</li>
				<li>
					<ul class="type">
						<li>
                            <input id="house01" name="homeType" type="radio" value="1" class="check">
							<label for="house01"><img src="img/img_home01.png" alt="一軒家"/><br>一軒家</label>
                        </li>
                        <li>
                            <input id="house02" name="homeType" type="radio" value="2" class="check">
                            <label for="house02"><img src="img/img_home02.png" alt="マンション（3F以下）"/><br>マンション<br class="show_sp">（3F以下）</label>
                        </li>
                        <li>
                            <input id="house03" name="homeType" type="radio" value="3" class="check">
                            <label for="house03"><img src="img/img_home03.png" alt="マンション（4F以上）"/><br>マンション<br class="show_sp">（4F以上）</label>
                        </li>
					</ul>
				</li>
				<li class="categories">所有形態</li>
				<li><div class="select">
						<i class="fa fa-chevron-down" aria-hidden="true"></i>
						<select name="ownership" id="ownership" class="validate[required]">
                                    <option value="" selected>選択してください</option>
                                    <option value="1">賃貸</option>
                                    <option value="2">分譲</option>
                                    <option value="3">分譲賃貸</option>
                                    <option value="4">持ち家</option>
						</select>
					</div>
				</li>
			</ul>
			<h4>オプション</h4>
			<ul class="form">
				<li class="categories">光電話申込</li>
				<li class="app">
					<input type="radio" name="telephoneApplication" value="0" id="noneNuro" checked>
					<label for="noneNuro">なし</label>
					<input type="radio" name="telephoneApplication" value="1" class="check" id="nuro">
					<label for="nuro">NURO光でんわ</label>
				</li>
				<div class='numbering' style='display:none'>
					<li class="categories">発番方法</li>
					<li class="app">
						<input type="radio" name="numberingMethod" value="0" id="new" checked>
						<label for="new">新規発番</label>
						<input type="radio" name="numberingMethod" value="1" class="check" id="portability">
						<label for="portability">現在使用中の電話番号を継続して使用</label>
					</li>
                </div>
                <div class='telephoneApplicationFixedLine' style='display:none'>
					<li class="categories">固定電話番号</li>
					<li>
						<input type="text" name="fixedLine" value="<?php print $tel; ?>" maxlength='10' class="validate[required],[custom[onlyNumberSp]]">
					</li>
                </div>
				<li class="categories">リモートサポート</li>
				<li class="app">
					<input type="radio" name="remortSupport" value="0" id="noneremortSupport" checked>
					<label for="noneNuro">なし</label>
					<input type="radio" name="remortSupport" value="1" class="check" id="remortSupport">
					<label for="nuro">あり</label>
				</li>
				<li class="categories">ひかりTV for NURO申込</li>
				<div class="select">
					<select name="hikariTV" id="hikariTV" class="validate[required]">
							<option value="0" selected>なし</option>
							<option value="1">TVおすすめプラン</option>
							<option value="2">お値打ちプラン</option>
							<option value="3">ビデオざんまいプラン</option>
							<option value="4">基本放送プラン</option>
					</select>
				</div>
			</ul>
			<div class="documents">
				<p>入会書類郵送希望先</p>
				<div class="app">
					<input type="radio" name="mailingDestination" value="0" id="same" checked>
					<label for="same">設置場所と同じ</label>
					<input type="radio" name="mailingDestination" value="1" id="aother">
					<label for="aother">別住所に送る</label>
				</div>
			</div>
			<ul class="form aother_address" style='display:none'>
				<li class="categories">郵便番号</li>
				<li>
					<input type="text" name="mailingPostalCode" value="<?php print $postal_code; ?>" type="number" maxlength='7' class="min validate[required],[custom[onlyNumberSp]]" onkeyup="AjaxZip3.zip2addr(this,'','mailingPrefName','mailingMunicipalities', 'mailingTown');">
				</li>
				<li class="categories">都道府県</li>
				<li>
					<div class="select">
						<i class="fa fa-chevron-down" aria-hidden="true"></i>
						<select name="mailingPrefName" class="validate[required]">
                            <option value="" selected>都道府県を選択</option>
                            <?php foreach($prefs as $pref) { ?>
                                <option value=<?php print $pref?>><?php print $pref?></option>                                       
                            <?php } ?>
                        </select>
					</div>
				</li>
				<li class="categories">市区町村</li>
				<li>
					<input type="text" name="mailingMunicipalities" value="<?php print $address; ?>" class="validate[required]">
				</li>
				<li class="categories">町名・丁目</li>
				<li>
					<input type="text" name="mailingTown" value="<?php print $address; ?>" class="validate[required]">
				</li>
				<li class="categories">番地・号</li>
				<li>
					<input type="text" name="mailingAddress" value="<?php print $address; ?>" class="validate[required]">
				</li>
                <li class="categories">建物名・部屋番号</li>
				<li>
					<input type="text" name="mailingBuilding" value="<?php print $room_number; ?>">
				</li>
			</ul>

			<div class="privacyTitle">個人情報取得における告知・同意文</div>
                <div class="privacy">
                    <h5>【重要】お申込みをされる前に、下記個人報取得における告知・同意文、ご利用規約をよくお読みください。</h5>
                    <div class="privacy_text">
                        【個人情報取得における告知・同意文】<br>
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
			<p class="agree_box"><input type="checkbox" name="同意文、利用約款" value="同意する" class="validate[required] orange" id="agree">

                        <label for="agree" class="agree">
                        </label>同意する</p>
                <dl class="btn">
					<dt><input type="button" value="戻る" id="backBtn" onclick="history.back()"></dt>
                    <dd><input type="submit" name="submit" value="確認画面へ" id="submit"></dd>
                </dl>
        </form>
	</section>
	<?php include "include/footer_form.html";?>

</body>
</html>