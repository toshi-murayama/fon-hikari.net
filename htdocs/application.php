<?php
	require_once('../lib/Param/Pref.php');
	require_once('../lib/Common.php');
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
<meta charset="utf-8">
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
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
<!--style-->
<link href="https://fonts.googleapis.com/css2?family=M+PLUS+1p:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/animate.css">
<link rel="stylesheet" href="css/style_form.css">
<link rel="stylesheet" href="css/validationEngine.jquery.css">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<link rel="stylesheet" href="css/jquery-ui.css" >
<!--js-->
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
	//カレンダー
	$("#deliveryDate,#deliveryDate2").datepicker({
		minDate: '6d'
	});
    //光TV選択
    $('select[name="constructionWeek"],input[name="constructionPreferred1"],input[name="constructionPreferred2"],select[name="constructionDay1"],select[name="constructionDay2"]').prop('disabled', true);
    $('input[name="construction"]').change(function() {
		if ($('input[name="construction"]:checked').val() == '0') {
            $('select[name="constructionWeek"]').prop('disabled', true);
            $('input[name="constructionPreferred1"]').prop('disabled', true);
            $('input[name="constructionPreferred2"]').prop('disabled', true);
            $('select[name="constructionDay1"]').prop('disabled', true);
            $('select[name="constructionDay2"]').prop('disabled', true);
		} else if ($('input[name="construction"]:checked').val() == '1') {
			$('select[name="constructionWeek"]').prop('disabled', false);
            $('input[name="constructionPreferred1"]').prop('disabled', true);
            $('input[name="constructionPreferred2"]').prop('disabled', true);
            $('select[name="constructionDay1"]').prop('disabled', true);
            $('select[name="constructionDay2"]').prop('disabled', true);
		} else if ($('input[name="construction"]:checked').val() == '2') {
			$('select[name="constructionWeek"]').prop('disabled', true);
            $('input[name="constructionPreferred1"]').prop('disabled', false);
            $('input[name="constructionPreferred2"]').prop('disabled', false);
            $('select[name="constructionDay1"]').prop('disabled', false);
            $('select[name="constructionDay2"]').prop('disabled', false);
		}
	});
    // 約款動作
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
	// 光TV
	$('input[name="hikariTV"]').change(function() {
		if ($('input[name="hikariTV"]:checked').val() != '0') {
			$('.hikariTVplan').show();
		} else {
			$('.hikariTVplan').hide();
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

		// 郵便番号
		$('#postalCode').keyup();

		// 物件種類
		var homeType;
		<?php
		if(isset($_POST['homeType'])) {
		?>
		homeType = <?php echo $_POST['homeType']?> - 1;
		<?php
		}
		?>

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
	<?php
		if(isset($_COOKIE['affiliate'])) {
			include "include/header_affiliate_form.html";
		} else {
			include "include/header_form.html";
		}
	?>
	<section id="application">
		<h2>Fon光お申し込み</h2>
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
			<h4>Fon光 設置先住所</h4>
			<ul class="form">
				<li class="categories">郵便番号</li>
				<li>
					<input type="tel" name="postalCode" value="<?php print h($_POST['zipAddress']); ?>"  minlength='7' maxlength='7' oninput="value = value.replace(/[^0-9]+/i,'');" class="min validate[required],[custom[zip]]" id="postalCode" onkeyup="AjaxZip3.zip2addr(this,'','installationPref','installationMunicipalities', '', '', false);">
			 	</li>
				<li class="categories">都道府県</li>
				<li>
					<div class="select">
						<i class="fa fa-chevron-down" aria-hidden="true"></i>
						<select name="installationPref" id="prefectures" class="validate[required]">
                            <option value="" selected>都道府県を選択</option>

							<?php foreach(Pref::PREFS as $pref) { ?>

							<option value=<?php print $pref?>><?php print $pref?></option>

							<?php } ?>

                        </select>
						</div>
				</li>
				<li class="categories">市区町村</li>
				<li>
					<input type="text" name="installationMunicipalities"  class="validate[required]">
				</li>
				<li class="categories">町名・丁目</li>
				<li>
					<input type="text" name="installationTown" id="installationTown" class="validate[required]" >
				</li>
				<li class="categories">番地・号</li>
				<li>
					<input type="text" name="installationAddress"  class="validate[required]">
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
							<label for="house01"><img src="img/img_home01.svg" alt="一軒家"/><br>一軒家</label>
                        </li>
                        <li>
                            <input id="house02" name="homeType" type="radio" value="2" class="check">
                            <label for="house02"><img src="img/img_home02.svg" alt="マンション（3F以下）"/><br>マンション<br class="show_sp">（3F以下）</label>
                        </li>
                        <li>
                            <input id="house03" name="homeType" type="radio" value="3" class="check">
                            <label for="house03"><img src="img/img_home03.svg" alt="マンション（4F以上）"/><br>マンション<br class="show_sp">（4F以上）</label>
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
					<label for="nuro">NURO光でんわ 東日本エリア月額550円<span>(税込)</span>/西日本エリア月額330円<span>(税込)</span></label>
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
					<input type="radio" name="remortSupport" value="0" id="noneRemortSupport" checked>
					<label for="noneRemortSupport">なし</label>
					<input type="radio" name="remortSupport" value="1" class="check" id="remortSupport">
					<label for="remortSupport">あり 月額550円<span>(税込)</span></label>
				</li>
				<li class="categories">まとめてでんき</li>
				<li class="app">
					<input type="radio" name="collectivelyElectricity" value="0" id="noneCollectivelyElectricityortSupport" checked>
					<label for="noneCollectivelyElectricityortSupport">なし</label>
					<input type="radio" name="collectivelyElectricity" value="1" class="check" id="collectivelyElectricity">
					<label for="collectivelyElectricity">あり 総額より500円引き</label>
				</li>
				<li class="categories">ひかりTV for NURO申込</li>
				<li class="app">
					<input type="radio" name="hikariTV" value="0" id="noneHikariTV" checked>
					<label for="noneHikariTV">なし</label>
					<input type="radio" name="hikariTV" value="1" class="check" id="hikariTV">
					<label for="hikariTV">あり</label>
				</li>
				<li class='hikariTVplan' style='display:none'>
                    <ul>
                        <li class="app">
                            <input type="radio" name="hikariTvPlan" value="0" id="normalPlan" checked>
                            <label for="normalPlan">基本料金プラン 月額1,100円<span>(税込)</span></label>
                        </li>
                        <li class="app">
                            <input type="radio" name="hikariTvPlan" value="1" class="check" id="oneutiPlan">
                            <label for="oneutiPlan">お値うちプラン 月額3,850円<span>(税込)</span></label>
                        </li>
                        <li class="app">
                            <input type="radio" name="hikariTvPlan" value="2" class="check" id="tvPlan">
                            <label for="tvPlan">テレビおすすめプラン 月額2,750円<span>(税込)</span></label>
                        </li>
                        <li class="app">
                            <input type="radio" name="hikariTvPlan" value="3" class="check" id="videoPlan">
                            <label for="videoPlan">ビデオざんまいプラン 月額2,750円<span>(税込)</span></label>
                        </li>
                        <li class="app">
                            <input type="radio" name="hikariTvPlan" value="4" class="check" id="oneutiPlan2">
                            <label for="oneutiPlan2">お値うちプラン(2ねん割) 月額2,750円<span>(税込)</span></label>
                        </li>
                        <li class="app">
                            <input type="radio" name="hikariTvPlan" value="5" class="check" id="tvPlan2">
                            <label for="tvPlan2">テレビおすすめプラン(2ねん割) 月額1,650円<span>(税込)</span></label>
                        </li>
                        <li class="app">
                            <input type="radio" name="hikariTvPlan" value="6" class="check" id="videoPlan2">
                            <label for="videoPlan2">ビデオざんまいプラン(2ねん割) 月額1,650円<span>(税込)</span></label>
                        </li>
                    </ul>
                </li>
				<li class="categories">カスペルスキーセキュリティー</li>
				<li class="app">
					<input type="radio" name="kasperskySecurity" value="0" id="noneKasperskySecurity" checked>
					<label for="noneKasperskySecurity">なし</label>
					<input type="radio" name="kasperskySecurity" value="1" class="check" id="kasperskySecurity">
					<label for="kasperskySecurity">あり 月額550円<span>(税込)</span></label>
				</li>
			</ul>

            <h4>希望工事日</h4>
			<ul class="form">
			    <li class="categories"></li>
				<li class="app">
					<input type="radio" name="construction" value="0" id="free" checked>
					<label for="free">いつでも可能</label>
				</li>
				<li class="desired app">
					<input type="radio" name="construction" value="1" id="week">
					<label for="week">曜日希望
                        <div class="select">
                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                            <select name="constructionWeek" id="" class="dateTime">
                                <option value="月曜日" selected>月</option>
                                <option value="火曜日">火</option>
                                <option value="水曜日">水</option>
                                <option value="木曜日">木</option>
                                <option value="金曜日">金</option>
                                <option value="土曜日">土</option>
                                <option value="日曜日">日</option>
                            </select>
                        </div>曜日であればいつでも可能
                    </label>
				</li>
				<li class="app">
					<input type="radio" name="construction" value="2" id="day">
					<label for="day">日程指定</label>
				</li>
				<li class="desired app">第一希望
                    <input type="text" class="" id="deliveryDate" name="constructionPreferred1" autocomplete="off">
                    <div class="select">
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        <select name="constructionDay1" id="" class="dateTime">
                            <option value="午前" selected>午前</option>
                            <option value="午後">午後</option>
                        </select>
                    </div>
                </li>
				<li class="desired app">第二希望
                    <input type="text" class="" id="deliveryDate2" name="constructionPreferred2" autocomplete="off">
                    <div class="select">
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        <select name="constructionDay2" id="" class="dateTime">
                            <option value="午前" selected>午前</option>
                            <option value="午後">午後</option>
                        </select>
                    </div>
				</li>
				<li class="categories">※希望に添えない場合もございます。決定ではございませんので、あらかじめご了承ください</li>
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
					<input type="tel" name="mailingPostalCode" value="<?php print $postal_code; ?>"  minlength='7' maxlength='7' oninput="value = value.replace(/[^0-9]+/i,'');" class="min validate[required],[custom[zip]]" onkeyup="AjaxZip3.zip2addr(this,'','mailingPrefName','mailingMunicipalities', 'mailingTown');">
				</li>
				<li class="categories">都道府県</li>
				<li>
					<div class="select">
						<i class="fa fa-chevron-down" aria-hidden="true"></i>
						<select name="mailingPrefName" class="validate[required]">
                            <option value="" selected>都道府県を選択</option>

							<?php foreach(Pref::PREFS as $pref) { ?>

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
            <div class="pdfTitle">重要事項説明書/契約約款</div>
            <div class="pdfBtn">
                <a href="pdf/hikari_jyusetsu.pdf" target="_blank">重要事項説明書<br>ダウンロード</a>
                <a href="pdf/hikari_kiyaku.pdf" target="_blank">契約約款<br>ダウンロード</a>
            </div>
			<p class="agree_box">
                「個人情報取得における告知・同意文」「重要事項説明書」「契約約款」の内容に同意します。<br>
                <input type="checkbox" name="同意文、利用約款" value="同意する" class="validate[required] orange" id="agree">
                <label for="agree" class="agree"></label>同意する</p>
                <dl class="btn">
					<dt><input type="button" value="戻る" id="backBtn" onclick="history.back()"></dt>
                    <dd><input type="submit" name="submit" value="確認画面へ" id="submit"></dd>
                </dl>
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