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
<!----css---->
<link rel="stylesheet" href="css/animate.css"> 
<link rel="stylesheet" href="css/style_form.css">
  <link rel="stylesheet" href="pikaday/dist/pikaday-package.css">
<link rel="stylesheet" href="css/validationEngine.jquery.css"> 
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css" >
<!----js---->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
	$('.privacy').hide();
	$('.privacyTitle').on('click', function() {
		$('.privacy').slideToggle(500);
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
});
</script>
  <script src="pikaday/dist/dependencies/pikaday-responsive-modernizr.js"></script>
<script src="js/jquery.zip2addr.js"></script>
<script src="js/jquery.validationEngine.js"></script>
<script src="js/jquery.validationEngine-ja.js"></script>
<script src="js/jquery.jpostal.min.js"></script>
<script src="js/jquery.autoKana.js"></script>
<script src="js/application.js"></script>
<script src="js/script.js"></script>
</head>

<body>
	<?php include "include/header_form.html";?>
	<section id="application">
		<h2>fon光お申し込み</h2>
		<h3>02 お客様情報入力</h3>
		<div class="search_text">ご契約先の情報をご入力ください。</div>
		<form method="post" action="confirmation.php" id="appForm">
			<h4>ご契約者情報</h4>
			<ul class="form">
				<li class="categories">申込区分</li>
				<li class="app">
					<input type="radio" name="applicationClassification" value="個人" id="individual" checked>
					<label for="individual">個人</label>
					<input type="radio" name="applicationClassification" value="法人" class="check" id="corporation">
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
					<input type="radio" name="sex" value="男性" id="man" class="check">
					<label for="man">男性</label>
					<input type="radio" name="sex" value="女性" class="check" id="women">
					<label for="women">女性</label>
				</li>
				<li class="categories">生年月日</li>
				<li>
					<input name="date" type="date" value="value="<?php print $date; ?>"" id="date1"/>
				</li>
				<li class="categories">電話番号</li>
				<li>
					<input type="text" name="phoneNumber" value="<?php print $tel; ?>" maxlength='11' class="validate[required],[custom[onlyNumberSp]]">
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
					<input type="text" name="postalCode" value="<?php print $postal_code; ?>" maxlength='7' class="min validate[required],[custom[onlyNumberSp]]"  id="postalCode" onKeyUp="$('#postalCode').zip2addr({pref:'#prefectures',addr:'#address'});" ><br>
					</li>
				<li class="categories">都道府県</li>
				<li>
					<div class="select">
						<i class="fa fa-chevron-down" aria-hidden="true"></i>
						<select name="installationPref" id="prefectures" class="validate[required]">
                                    <option value="" selected>都道府県を選択</option>
                                    <option value="北海道">北海道</option>
                                    <option value="青森県">青森県</option>
                                    <option value="岩手県">岩手県</option>
                                    <option value="宮城県">宮城県</option>
                                    <option value="秋田県">秋田県</option>
                                    <option value="山形県">山形県</option>
                                    <option value="福島県">福島県</option>
                                    <option value="茨城県">茨城県</option>
                                    <option value="栃木県">栃木県</option>
                                    <option value="群馬県">群馬県</option>
                                    <option value="埼玉県">埼玉県</option>
                                    <option value="千葉県">千葉県</option>
                                    <option value="東京都">東京都</option>
                                    <option value="神奈川県">神奈川県</option>
                                    <option value="新潟県">新潟県</option>
                                    <option value="富山県">富山県</option>
                                    <option value="石川県">石川県</option>
                                    <option value="福井県">福井県</option>
                                    <option value="山梨県">山梨県</option>
                                    <option value="長野県">長野県</option>
                                    <option value="岐阜県">岐阜県</option>
                                    <option value="静岡県">静岡県</option>
                                    <option value="愛知県">愛知県</option>
                                    <option value="三重県">三重県</option>
                                    <option value="滋賀県">滋賀県</option>
                                    <option value="京都府">京都府</option>
                                    <option value="大阪府">大阪府</option>
                                    <option value="兵庫県">兵庫県</option>
                                    <option value="奈良県">奈良県</option>
                                    <option value="和歌山県">和歌山県</option>
                                    <option value="鳥取県">鳥取県</option>
                                    <option value="島根県">島根県</option>
                                    <option value="岡山県">岡山県</option>
                                    <option value="広島県">広島県</option>
                                    <option value="山口県">山口県</option>
                                    <option value="徳島県">徳島県</option>
                                    <option value="香川県">香川県</option>
                                    <option value="愛媛県">愛媛県</option>
                                    <option value="高知県">高知県</option>
                                    <option value="福岡県">福岡県</option>
                                    <option value="佐賀県">佐賀県</option>
                                    <option value="長崎県">長崎県</option>
                                    <option value="熊本県">熊本県</option>
                                    <option value="大分県">大分県</option>
                                    <option value="宮崎県">宮崎県</option>
                                    <option value="鹿児島県">鹿児島県</option>
                                    <option value="沖縄県">沖縄県</option>
                                </select>
						</div>
				</li>
				<li class="categories">市区町村</li>
				<li>
					<input type="text" name="installationMunicipalities" value="<?php print $address; ?>" class="validate[required]" id="address">
				</li>
				<li class="categories">町丁名・番地号</li>
				<li>
					<input type="text" name="installationTown" value="<?php print $address; ?>" class="validate[required]" id="address">
				</li>
                <li class="categories">建物名・部屋番号</li>
				<li>
					<input type="text" name="installationBuilding" value="<?php print $room_number; ?>">
				</li>
				<li>物件の種類をご選択ください。</li>
				<li>
					<ul class="type">
						<li>
                            <input id="house01" name="homeType" type="radio" value="house" class="check">
							<label for="house01"><img src="img/img_home01.png" alt="一軒家"/><br>一軒家</label>
                        </li>
                        <li>
                            <input id="house02" name="homeType" type="radio" value="apartment3rdFloorAndBelow" class="check">
                            <label for="house02"><img src="img/img_home02.png" alt="マンション（3F以下）"/><br>マンション<br class="show_sp">（3F以下）</label>
                        </li>
                        <li>
                            <input id="house03" name="homeType" type="radio" value="apartment3rdFloorAndAbove" class="check">
                            <label for="house03"><img src="img/img_home03.png" alt="マンション（4F以上）"/><br>マンション<br class="show_sp">（4F以上）</label>
                        </li>
					</ul>
				</li>
				<li class="categories">連絡先メールアドレス</li>
				<li>
					<input type="text" name="contactMailAddress" value="<?php print $mail; ?>" class="validate[required],[custom[email]]">
				</li>
				<li class="categories">連絡先メールアドレス（確認）</li>
				<li>
					<input type="text" name="連絡先メールアドレス（確認）" value="<?php print $mail; ?>" class="validate[required],[custom[email]]">
				</li>
				<li class="categories">所有形態</li>
				<li><div class="select">
						<i class="fa fa-chevron-down" aria-hidden="true"></i>
						<select name="ownership" id="ownership" class="validate[required]">
                                    <option value="" selected>選択してください</option>
                                    <option value="賃貸">賃貸</option>
                                    <option value="分譲">分譲</option>
                                    <option value="分譲賃貸">分譲賃貸</option>
                                    <option value="持ち家">持ち家</option>
							</select>
					</div>
				</li>
			</ul>
			<h4>オプション</h4>
			<ul class="form">
				<li class="categories">光電話申込</li>
				<li class="app">
					<input type="radio" name="telephoneApplication" value="なし" id="nashi" checked>
					<label for="nashi">なし</label>
					<input type="radio" name="telephoneApplication" value="NURO光でんわ" class="check" id="ari">
					<label for="ari">NURO光でんわ</label>
				</li>
				<li class="categories">固定電話番号</li>
				<li>
					<input type="text" name="fixedLine" value="<?php print $tel; ?>" maxlength='11' class="validate[required],[custom[onlyNumberSp]]">
				</li>
			</ul>
			<div class="documents">
				<p>入会書類郵送希望先</p>
				<div class="app">
					<input type="radio" name="mailingDestination" value="設置場所と同じ" id="same" checked>
					<label for="same">設置場所と同じ</label>
					<input type="radio" name="mailingDestination" value="別住所に送る" id="aother">
					<label for="aother">別住所に送る</label>
				</div>
			</div>
			<ul class="form aother_address">
				<li class="categories">郵便番号</li>
				<li>
					<input type="text" name="mailingPostalCode" value="<?php print $postal_code; ?>" type="number" maxlength='7' class="min validate[required],[custom[onlyNumberSp]]" id="postalCode">
				</li>
				<li class="categories">都道府県</li>
				<li>
					<div class="select">
						<i class="fa fa-chevron-down" aria-hidden="true"></i>
						<select name="mailingPrefName" id="prefectures" class="validate[required]">
                                    <option value="" selected>都道府県を選択</option>
                                    <option value="北海道">北海道</option>
                                    <option value="青森県">青森県</option>
                                    <option value="岩手県">岩手県</option>
                                    <option value="宮城県">宮城県</option>
                                    <option value="秋田県">秋田県</option>
                                    <option value="山形県">山形県</option>
                                    <option value="福島県">福島県</option>
                                    <option value="茨城県">茨城県</option>
                                    <option value="栃木県">栃木県</option>
                                    <option value="群馬県">群馬県</option>
                                    <option value="埼玉県">埼玉県</option>
                                    <option value="千葉県">千葉県</option>
                                    <option value="東京都">東京都</option>
                                    <option value="神奈川県">神奈川県</option>
                                    <option value="新潟県">新潟県</option>
                                    <option value="富山県">富山県</option>
                                    <option value="石川県">石川県</option>
                                    <option value="福井県">福井県</option>
                                    <option value="山梨県">山梨県</option>
                                    <option value="長野県">長野県</option>
                                    <option value="岐阜県">岐阜県</option>
                                    <option value="静岡県">静岡県</option>
                                    <option value="愛知県">愛知県</option>
                                    <option value="三重県">三重県</option>
                                    <option value="滋賀県">滋賀県</option>
                                    <option value="京都府">京都府</option>
                                    <option value="大阪府">大阪府</option>
                                    <option value="兵庫県">兵庫県</option>
                                    <option value="奈良県">奈良県</option>
                                    <option value="和歌山県">和歌山県</option>
                                    <option value="鳥取県">鳥取県</option>
                                    <option value="島根県">島根県</option>
                                    <option value="岡山県">岡山県</option>
                                    <option value="広島県">広島県</option>
                                    <option value="山口県">山口県</option>
                                    <option value="徳島県">徳島県</option>
                                    <option value="香川県">香川県</option>
                                    <option value="愛媛県">愛媛県</option>
                                    <option value="高知県">高知県</option>
                                    <option value="福岡県">福岡県</option>
                                    <option value="佐賀県">佐賀県</option>
                                    <option value="長崎県">長崎県</option>
                                    <option value="熊本県">熊本県</option>
                                    <option value="大分県">大分県</option>
                                    <option value="宮崎県">宮崎県</option>
                                    <option value="鹿児島県">鹿児島県</option>
                                    <option value="沖縄県">沖縄県</option>
                                </select>
						</div>
				</li>
				<li class="categories">市区町村</li>
				<li>
					<input type="text" name="mailingMunicipalities" value="<?php print $address; ?>" class="validate[required]" id="address">
				</li>
				<li class="categories">町丁名・番地号</li>
				<li>
					<input type="text" name="mailingTown" value="<?php print $address; ?>" class="validate[required]" id="address">
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
	
<script src="pikaday/dist/dependencies/jquery.min.js"></script>
<script src="pikaday/dist/dependencies/moment.min.js"></script>
<script src="pikaday/dist/dependencies/pikaday.min.js"></script>
<script src="pikaday/src/pikaday-responsive.js"></script>

<script>
	
	var picker = new Pikaday({  
    changeMonth: true, 
    changeYear: true, 
    field: document.getElementById('#date6'), 
    firstDay: 1, 
    minDate: new Date('1960-01-01'), 
    maxDate: new Date('2020-12-31'), 
    yearRange: [1960,2020] 

}); 
	
  var $date1 = $("#date1");
  var instance1 = pikadayResponsive($date1);
  $date1.on("change", function() {
    $("#output1").html($(this).val());
  });

  var $date2 = $("#date2");
  var instance2 = pikadayResponsive($date2, {
    outputFormat: "X"
  });
  $date2.on("change", function() {
    $("#output2").html($(this).val());
  });

  var $date3 = $("#date3");
  var instance3 = pikadayResponsive($date3, {
    format: "Do MMM YYYY",
    outputFormat: "X"
  });

  var $date4 = $("#date4");
  var today = new Date();
  var minDate = new Date('1960-01-01');
  var maxDate = new Date();
  minDate.setDate(today.getDate() + 3);
  maxDate.setDate(today.getDate() + 365);
  var instance4 = pikadayResponsive($date4, {
    format: "DD/MM/YYYY",
    outputFormat: "DD/MM/YYYY",
    pikadayOptions: {
      minDate: minDate,
      maxDate: maxDate,
    },
  });
  instance4.setDate(minDate);

  $date3.on("change", function() {
    $("#output3").html($(this).val());
  });

  $date4.on("change", function() {
    $("#output4").html($(this).val());
  });

  $("#clear").click(function() {
    instance3.setDate(null);
  });

  $("#today").click(function() {
    instance3.setDate(moment());
  });

</script>

</body>
</html>