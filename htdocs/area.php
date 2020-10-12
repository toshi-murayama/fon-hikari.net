<?php

$shibarinashiFlag = false; // 縛りなしフラグ
if (isset($_GET['shibarinashi'])) {
	// 縛りなしのfon光セット割LP画面から当画面に遷移した場合、
	// 縛りなしフラグを立てる。
	// 縛りなしフラグが立っている場合は、申し込み画面へ遷移させない。
	$shibarinashiFlag = true;
}

?><!DOCTYPE html>
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
<meta name="theme-color" content="#EC7103">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<link rel="shortcut icon" href="img/favicon.ico" />	
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="css/style_form.css?<?php echo filemtime(realpath(__DIR__.'/css/style_form.css')) ?>">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

<!--//* JS読み込み *//-->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/jquery.layerBoard.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
$(function(){
$('#layer_board_area').layerBoard({
delayTime: 100,
fadeTime : 300,
alpha : 0.8,
limitMin : 0,
easing: 'linear',
limitCookie : 0 ,
countCookie : 1000
});
});
</script>
<!--tag-->
<?php include "include/tag_head.html";?>
</head>
<body>
<?php include "include/tag_start.html";?>
<p id="cursor"></p>
<div id="stalker"></div>
	<?php include "include/header_form.html";?>
	<div id="layer_board_area">
		<div class="layer_board_bg"></div>
		<div id="popup_area" class="layer_board">
            <article>
                <h4><img src="img/img_area.png" alt="">お申し込みの前にご確認ください。</h4>
                <dl>
                    <dt>サービス提供エリアは以下となっています。</dt>
                    <dd>北海道<br>
    関東（東京、神奈川、埼玉、千葉、茨城、栃木、群馬）<br>
    東海（愛知、静岡、岐阜、三重）<br>
    関西（大阪、兵庫、京都、滋賀、奈良）<br>
    九州（福岡、佐賀）<br>
    ※一部エリアを除く</dd>
                </dl>
                <a href="#" class="btn_close">閉じる</a>
            </article>
		</div>
	</div>
	<section id="area_search">

		<?php if ($shibarinashiFlag) { ?>

		<h2>fon光エリア検索</h2>

		<?php } else { ?>

		<h2>fon光お申し込み</h2>

		<?php } ?>


		<h3>01 エリア検索</h3>
		<form method="post" action="application" id="appForm">
			<div class="search_text">お客様のお住い地域でご利用可能か検索します。</div>
			<div class="address">住所を検索する<br>
				<dl>
					<dt><img src="img/img_area.png" alt=""/></dt>
					<dd>
						<div class="select">
							<select id="address-search"></select>
							<p id="address-search-error-message" class="alert" style="display: none;">住所を入力してください。</p>
						</div>
					</dd>
				</dl>
			</div>
			<div class="subsequently">
				<ul class="form">
					<li>住所</li>
					<li><input class="result" type="text" placeholder="大阪府大阪市旭区高殿1丁目" readonly></li>
					<li><p>物件の種類をご選択ください。</p>
						<ul class="type">
							<li><input id="house01" name="homeType" type="radio" value="1" class="check">
								<label for="house01"><img src="img/img_home01.png" alt="一軒家"/><br>一軒家</label></li>
							<li><input id="house02" name="homeType" type="radio" value="2" class="check">
								<label for="house02"><img src="img/img_home02.png" alt="マンション（3F以下）"/><br>マンション<br class="show_sp">（3F以下）</label></li>
							<li><input id="house03" name="homeType" type="radio" value="3" class="check">
								<label for="house03"><img src="img/img_home03.png" alt="マンション（4F以上）"/><br>マンション<br class="show_sp">（4F以上）</label></li>
						</ul>
					</li>
				</ul>
				<p id="home-type-error-message" class="alert" style="display: none;">物件の種類を１つ選択してください。</p>
			</div>
			<div class="area_btn">
				<p id="openModal">エリアを検索する</p>
				<section id="modalArea" class="modalArea">
					<div class="modalWrapper">
						<p><img src="img/img_pc_ok.png" alt=""/></p>
						<div class="answer">fon光提供エリアとなっています<br>
							<span>今すぐお申し込み頂けます</span></div>
						<div class="street_address">東京都 豊島区 池袋2丁目</div>
						<div id="closeModal" class="closeModal">×</div>

						<?php if ($shibarinashiFlag) { ?>

						<input type="button" value="セット割を申し込む" onclick="window.open('https://shibarinashi-wifi.jp/application','_blank');">
						Fon光単体のお申し込みは<a href="/" target="_blank" style="margin-top: 1rem;">こちら</a>

						<?php } else { ?>

						<input type="submit" value="お申し込みする" id="submit">

						<?php } ?>

					</div>
				</section>
				<section id="modalArea02" class="modalArea" style="display: none;">
					<div class="modalWrapper">
						<p><img src="img/img_pc_ng.png" alt=""/></p>
						<div class="answer">fon光提供エリア外となっています</div>
						<div class="street_address">東京都 豊島区 池袋2丁目</div>
						<div id="closeModal" class="closeModal">×</div>

						<?php if (!$shibarinashiFlag) { ?>

						<a class="ng" href="/">トップへ戻る</a>

						<?php } ?>

					</div>
				</section>
				<section id="modalArea03" class="modalArea" style="display: none;">
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


	<?php if ($shibarinashiFlag) { ?>

	<div class="btn_close" style="margin: 6rem auto 5rem;" onclick="window.close()">
		閉じる
	</div>

	<?php } ?>

	<?php 
	if(isset($_COOKIE['affiliate'])) {
		include "include/footer_affiliate.html";
	} else {
		include "include/footer_form.html";
	}
	?>

<script>
function AddressSearchSelectbox() {
	this.selectedHandler = function() {};
	this.selected = null;
};
AddressSearchSelectbox.prototype.init = function() {

	var that = this;

	var addressSearch = $('#address-search').select2({
		// closeOnSelect: false,
		// tags: true,
		minimumInputLength: 3,
		placeholder: '例：大阪府大阪市旭区高殿１丁目',
		width: '100%',
		language: {
			// https://github.com/select2/select2/blob/develop/src/js/select2/i18n/ja.js
			errorLoading: function () {
				return '結果が読み込まれませんでした';
			},
			inputTooShort: function (args) {
				var remainingChars = args.minimum - args.input.length;
				var message = '住所を入力してください';
				return message;
			},
			noResults: function () {
				return '利用可能エリアが見つかりません';
			},
			loadingMore: function () {
				return '読み込み中…';
			},
			searching: function () {
				return '検索しています…';
			}
		},
		templateResult: function (result) {
			if (result.loading) {
				return result.text;
			}
			var $container = $("<div class='select2-result-address'></div>");
			$container.text(result.text);
			if (!('support' in result)) $container.addClass('dynamic');
			return $container;
		},
		ajax: {
			cache: true,
			delay: 200,
			url: './api/search_supported_areas',
			dataType: 'json',
			data: function (params) {
				var n = $('.select2-search__field').val();
				var query = {
					q: n,
					page: params.page || 1
				}
				return query;
			},
		}
	});
	addressSearch
		.on('select2:open', function(e) {
			$('.select2-search__field').val(addressSearch.val());
			$('.select2-search__field').trigger('input');
		})
		.on('select2:select',function(e){
			$('.select2-search__field').val(e.params.data.text).focus();
			// 末端の住所を選択したとき、２回inputをtriggerしないとajaxが走らないので、
			// 2回triggerする。
			$('.select2-search__field').trigger('input').trigger('input');
			that.selected = e.params.data;
			that.selectedHandler(e.params.data);
		});
	$(document).on('keyup', '.select2-search__field', function(e){
		var keycode = (e.keyCode ? e.keyCode : e.which);
		if (keycode == 13) { // Enter key
			$('.select2-search__field').trigger('input').trigger('input');
			if ($('.select2-search__field').val() == '') {
				addressSearch.val('').trigger('change');
				that.selected = null;
				that.selectedHandler(null);
			}
		}
	});

	$('.select2-container').on('click', function() {
		// iOSデバイスで、select2クリック時にキーボードを表示する
		// https://github.com/select2/select2/issues/5706
		$('.select2-search__field').focus();
	});

	return this;
};
AddressSearchSelectbox.prototype.setSelectHandler = function(func) {
	this.selectedHandler = func;
	return this;
};


$(function(){
	var typeOfHouse = "";
	var selectbox =
		new AddressSearchSelectbox()
		.setSelectHandler(function(data){
			$('.modalArea').hide();
			$('#address-search-error-message').hide();
			var str = '';
			if (data) str = data.text;
			$('.result').val(str);
			$('.street_address').text(str);
		})
		.init();

	$('[name=homeType]').change(function(){
		$('.modalArea').hide();
		$('#home-type-error-message').hide();
	});

	$('#openModal').click(function() {

		var OK = 0;
		var NG = 1;
		var type = NG;

		$('.modalArea').hide();

		var hasError = false;
		var homeType = $('[name=homeType]:checked').val();
		if (!selectbox.selected) {
			hasError = true;
			$('#address-search-error-message').show();
		}
		if (!homeType) {
			hasError = true;
			$('#home-type-error-message').show();
		}
		if (hasError) {
			return;
		}

		if (homeType == '1' || homeType == '2') {
			if (selectbox.selected.support) {
				if (selectbox.selected.note == '') {
					type = OK;
				} else {
					type = NG;
				}
			} else {
				type = NG;
			}
		} else {
			// マンション(4F以上) は常にNG
			type = NG;
		}
		if(type === OK){
			$('#modalArea').show(600);
		} else if(type === NG){
			$('#modalArea02').show(600);
		}
	});
});
</script>
</body>
</html>