$(function() {
	jQuery("#appForm").validationEngine();

	// 生年月日カレンダー
	$("#datepicker").datepicker({
		defaultDate: new Date(2000,4,1),
		changeMonth: true,
		changeYear: true,
		yearRange: '-70:+0',
	}).datepicker("setDate", "2000/04/01");

	// 希望工事日カレンダー
	$("#deliveryDate,#deliveryDate2").datepicker({
		minDate: '6d'
	});

	// 光TV選択
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

$(window).on('load', function() {
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

	// フリガナ自動補完
    $.fn.autoKana('#lastName', '#lastNameKana', {
        katakana : true
    });
    $.fn.autoKana('#firstName', '#firstNameKana', {
        katakana : true
    });
});
