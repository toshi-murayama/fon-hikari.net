<?php

$shibarinashiFlag = false; // 縛りなしフラグ
if (isset($_GET['shibarinashi'])) {
	// 縛りなしのfon光セット割LP画面から当画面に遷移した場合、
	// 縛りなしフラグを立てる。
	// 縛りなしフラグが立っている場合は、申し込み画面へ遷移させない。
	$shibarinashiFlag = true;
}

// 主にメンテナンスなどによる，サービスの一時停止用．
// 古くなった物は随時削除していくことが望ましい．
function serviceUnavailable( $now , &$information ){

    // プラン刷新に伴うサービス停止 2021年11月24日16:00～24：00でのWEB申込受付不可
    if( ((new DateTime('2021-11-24 16:00:00') < $now )
         && ($now < new DateTime('2021-11-25 00:00:00')) )){
        $information = '<div class="maintenance">
		<p class="tit">メンテナンス中</p>
		<p class="text">ただいまメンテナンスのため一時サービスを停止しております。<br class="sp">
		大変ご不便をおかけいたしますが、今しばらくお待ちください。<br>
		<br>
		【メンテナンス期間】<br>
		11月24日(水) 16:00 ～24:00</p>
		</div>';
        return true;
    }

    return false; // submit 使用可．
}

$now = new DateTime();
// $now = new Datetime('2021-11-24 16:00:01'); // for test

$information = '';
if( serviceUnavailable( $now , $information ) ){
    $disabledSubmit = ' disabled="disabled" '; // お申し込みSubmitボタン使用可否
}
else{
    $disabledSubmit = '';
}

?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
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
<!--style-->
<link href="https://fonts.googleapis.com/css2?family=M+PLUS+1p:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="css/style_form.css?<?php echo filemtime(realpath(__DIR__.'/css/style_form.css')) ?>">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

<!--//* JS読み込み *//-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="js/jquery.layerBoard.js"></script>
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
	<?php
		if(isset($_COOKIE['affiliate'])) {
			include "include/header_affiliate_form.html";
		} else {
			include "include/header_form.html";
		}
	?>

	<div id="layer_board_area">
		<div class="layer_board_bg"></div>
		<div id="popup_area" class="layer_board">
            <article>
                <h4><img src="img/img_area.svg" alt="">お申し込みの前にご確認ください。</h4>
                <dl>
                    <dt>サービス提供エリアは以下となっています。</dt>
                    <dd>北海道<br>
						関東（東京、神奈川、埼玉、千葉、茨城、栃木、群馬）<br>
						東海（愛知、静岡、岐阜、三重）<br>
						関西（大阪、兵庫、京都、滋賀、奈良）<br>
						九州（福岡、佐賀）<br>
						中国（広島、岡山）<br>
						※一部エリアを除く</dd>
                </dl>
                <a href="#" class="btn_close">閉じる</a>
            </article>
		</div>
	</div>
	<!-- 郵便番号がない、または提供エリア外のときに出力 -->
	<div id="layer_board_area_01">
		<div class="layer_board_bg"></div>
		<div id="popup_area" class="layer_board">
				<div class="modalWrapper">
					<p><img class='search_ng' src="img/img_pc_ng.png" alt=""/></p>
					<div id="area_search_error">郵便番号が正しくないか、エリア外の郵便番号を入力されました。<br></div>
					<span> 入力内容をご確認のうえ、検索してください。</span>
				</div>
				<a href="#" class="btn_close">閉じる</a>
		</div>
	</div>
	<section id="area_search">
		<?php if( $information != ''){ ?>
		<p class="error"><?= $information ?></p>
		<?php } ?>

		<?php if ($shibarinashiFlag) { ?>

		<h2>Fon光エリア検索</h2>

		<?php } else { ?>

		<h2>Fon光お申し込み</h2>

		<?php } ?>


		<h3>01 エリア検索</h3>
		<form method="post" action="application" id="appForm">
			<div class="search_text">お客様のお住い地域でご利用可能か検索します。</div>
			<div class="address">1. 郵便番号を検索してください<br>
				<dl>
					<dt><img src="img/img_area.svg" alt=""/></dt>
					<dd>
						<input id="address-search" name="zipAddress" type="tel" oninput="value = value.replace(/[^0-9]+/i,'');" minlength="7" maxlength="7" placeholder="1710014(ハイフンなし)">
						<p class='alert' id='address-search-error-message' style='display:none;color:#ff0000;'>郵便番号を入力してください。</p>
					</dd>
				</dl>
			</div>
			<div class="subsequently">
				<ul class="form">
					<li>2. 住所をご選択ください。</li>
					<li>
						<div class="select">
							<select id="address-search-result" name="town" class="result">
								<option value='0'>ご選択ください</option>
							</select>
						</div>
					</li>
					<p id="address-search-result-error-message" class="alert" style="display: none;">住所を１つ選択してください。</p>
					<li><p>3. 物件の種類をご選択ください。</p>
						<ul class="type">
							<li><input id="house01" name="homeType" type="radio" value="1" class="check">
								<label for="house01"><img src="img/img_home01.svg" alt="一軒家"/><br>一軒家</label></li>
							<li><input id="house02" name="homeType" type="radio" value="2" class="check">
								<label for="house02"><img src="img/img_home02.svg" alt="マンション（3F以下）"/><br>マンション<br class="show_sp">（3F以下）</label></li>
							<li><input id="house03" name="homeType" type="radio" value="3" class="check">
								<label for="house03"><img src="img/img_home03.svg" alt="マンション（4F以上）"/><br>マンション<br class="show_sp">（4F以上）</label></li>
						</ul>
					</li>
				</ul>
				<p id="home-type-error-message" class="alert" style="display: none;">物件の種類を１つ選択してください。</p>
			</div>
			<div class="area_btn">
				<p id="openModal">エリアを検索する</p>
				<!-- 提供エリアのモーダル -->
				<section id="modalArea" class="modalArea">
					<div class="modalWrapper">
						<p><img src="img/img_pc_ok.png" alt=""/></p>
						<div class="answer">Fon光提供エリアとなっています<br>
							<span>今すぐお申し込み頂けます</span></div>
						<div class="street_address">東京都 豊島区 池袋2丁目</div>
						<div id="closeModal" class="closeModal">×</div>

						<?php if ($shibarinashiFlag) { ?>

						<input type="button" value="セット割を申し込む" onclick="window.open('https://shibarinashi-wifi.jp/application','_blank');">
						Fon光単体のお申し込みは<a href="/" target="_blank" style="margin-top: 1rem;">こちら</a>

						<?php } else { ?>

						<input type="submit" value="お申し込みする" id="submit" <?= $disabledSubmit ?> >

						<?php } ?>

					</div>
				</section>
				<!-- 提供エリア外のモーダル -->
				<section id="modalArea02" class="modalArea" style="display: none;">
					<div class="modalWrapper">
						<p><img src="img/img_pc_ng.png" alt=""/></p>
						<div class="answer">Fon光提供エリア外となっています。</div>
						<div class="street_address">東京都 豊島区 池袋2丁目</div>
						<div id="closeModal" class="closeModal">×</div>

						<?php if (!$shibarinashiFlag) { ?>

						<a class="ng" href="/">トップへ戻る</a>

						<?php } ?>

					</div>
				</section>
				<!-- 未確定エリアのモーダル -->
				<section id="modalArea03" class="modalArea" style="display: none;">
					<div class="modalWrapper">
						<p><img src="img/img_pc_subtle.png" alt=""/></p>
						<div class="answer">Fon光提供先行予約エリアとなっています。<br>
						<span>一部提供が出来ないエリアもございます。詳細についてはお問い合わせください。</span></div>
						<div class="street_address">東京都 豊島区 池袋2丁目</div>
						<div id="closeModal" class="closeModal">×</div>
						<input type="submit" value="お問い合わせする" id="submit">
						<br>
					</div>
				</section>
				<!-- データ取得失敗時のモーダル -->
				<section id="modalArea04" class="modalArea" style="display: none;">
					<div class="modalWrapper">
						<p><img src="img/img_pc_ng.png" alt=""/></p>
						<div class="answer">データ取得に失敗しました。<br>
						<span>再度、ご入力お願いします。</span>
						<span>解決しない場合は、お手数おかけしますが、お問い合わせください</span>
					</div>
						<div id="closeModal" class="closeModal">×</div>
						<input type="submit" value="お問い合わせする" id="submit">
						<br>
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
	$(function(){
		$('#appForm').keypress(function(e) {
			// FromのEnterキーを無効.
			if (e.which === 13) {
        		return false;
    		}
		});

		$('#address-search').change(function() {
			$('.modalArea').hide();
			$('#address-search-error-message').hide();
			getAddressList($(this).val());
		});

		$('#address-search-result').change(function() {
			$('.modalArea').hide();
			$('#address-search-result-error-message').hide();
		});

		$('[name=homeType]').change(function() {
			$('.modalArea').hide();
			$('#home-type-error-message').hide();
		});

		$('#openModal').click(function() {
			$('.modalArea').hide();

			var hasError = false;
			var address = $('#address-search').val();
			var town = $('#address-search-result option:selected').val();
			var homeType = $('[name=homeType]:checked').val();
			if (address.length !== 7) {
				hasError = true;
				$('#address-search-error-message').show();
			} else {
				if (town === '0') {
				hasError = true;
				$('#address-search-result-error-message').show();
				}
			}
			if (!homeType) {
				hasError = true;
				$('#home-type-error-message').show();
			}
			if (hasError) {
				return;
			}
			areaJudge(address, town, homeType)
		});
	});
	// 住所リスト取得.
	function getAddressList(zipAddress) {
		if (showAddressErrorMessage(zipAddress.length !== 7, '郵便番号は7桁でご入力ください')) {
			return;
		}
		$.ajax({
			cache: true,
			delay: 100,
			url: './api/search_areas',
			type: 'POST',
			dataType: 'json',
			data: {
				zipAddress: zipAddress
			},
		})
		.done(function(data){
			// 検索結果は一旦削除.
			$('.search-result').remove();
			if (data === null) {
				showAreaSearchErrorModal('郵便番号が正しくないか、エリア外の郵便番号を入力されました。');
				return;
			}
			$.each(data.towns, function(index, value){
				$('#address-search-result').append($('<option>').text(data.address + value).addClass('search-result').val(value));
			});
			$('#address-search-result').focus();
		})
		.fail(function(){
			showAreaSearchErrorModal('データ取得に失敗しました。');
		});
	}
	// エリア判定.
	function areaJudge(zipAddress,town, homeType) {
		let address = $('#address-search-result option:selected').html();
		$('.street_address').html(address);
		if(homeType == '3') {
			$('#appForm').attr('action', 'contact');
			// マンション(4F以上) は常に問い合わせするように促す.
			$('#modalArea03').show(600);
			return;
		}
		$.ajax({
			cache: true,
			delay: 100,
			url: './api/area_judge',
			type: 'POST',
			dataType: 'json',
			data: {
				zipAddress: zipAddress,
				town: town,
			},
		})
		.done(function(data) {

			if(data) {
				// 念の為.
				$('#appForm').attr('action', 'application');
				// 提供中
				$('#modalArea').show(600);
			} else {
				$('#appForm').attr('action', 'contact');
				// 提供以外は問い合わせするように促す.
				$('#modalArea03').show(600);

			}
		})
		.fail(function() {
			$('#appForm').attr('action', 'contact');
			$('#modalArea04').show(600);
		});
	}
	// 郵便番号検索でエラーになったら出力するModal.
	function showAreaSearchErrorModal(errorMessage) {
	$('#area_search_error').html(errorMessage)
	$('#layer_board_area_01').layerBoard({
		delayTime: 50,
		fadeTime : 100,
		alpha : 0.8,
		limitMin : 0,
		easing: 'linear',
		limitCookie : 0 ,
		countCookie : 1000
	});
	}
	// エラーメッセージを表示. エラー = true、エラーではない = falseを返す.
	function showAddressErrorMessage(judge, errorMessage) {
		if (judge) {
			$('#address-search-error-message').html(errorMessage)
			$('#address-search-error-message').show();
			return true;
		} else {
			$('#address-search-error-message').hide();
			return false;
		}
	}
</script>
</body>
</html>
