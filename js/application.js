$(function($){
	
	function centering(){
        var w = $(window).width();
        var h = $(window).height();
		var win_top = $(window).scrollTop();
        var cw = $(".modalBox").outerWidth(true);
        var ch = $(".modalBox").outerHeight(true);
        $(".modalBox").css({
            "left": ((w - cw) / 2) + "px",
            "top": ((h - ch) / 2 + win_top) + "px"
        });
	}

	function entryChange(){
		radio = document.getElementsByName('pay');
		if(radio[0].checked) {
			$('.creditBox').css('display','');
			$('.bankBox').css('display','none');
		}else if(radio[1].checked) {
			$('.creditBox').css('display','none');
			$('.bankBox').css('display','');
		}
	}	
	
	// numberBoxの番号調整
	function numberBox(){
		box_i = 0;
		$('.nomberBox ul li').removeClass('on');
		$('.modalInnerBox').each(function(){
			if($(this).css('display') == 'block'){

				if (box_i != 0) {
					box_i --;
				}
				
				console.log(box_i);
				$('.nomberBox ul li:eq(' + box_i + ')').addClass('on');
			}
			box_i++;
		});		
		
	}

	jQuery("#appForm").validationEngine();
	entryChange();
	var cmn = [];
	var w = $(window).width();	
	cmn.ua = window.navigator.userAgent.toLowerCase();
	cmn.ua_iPhone = (cmn.ua.indexOf('iPhone') > 0) ? true : false;
	cmn.ua_iPod = (cmn.ua.indexOf('iPod') > 0) ? true : false;
	cmn.ua.Android = (cmn.ua.indexOf('Android') > 0 && cmn.ua.indexOf('Mobile') > 0) ? true : false;
	cmn.ua_WinPhone = (cmn.ua.indexOf('Windows Phone') > 0) ? true : false;
	cmn.ua_Blackberry = (cmn.ua.indexOf('Brackberry') > 0) ? true : false;	
	if(cmn.ua_iphone || cmn.ua_iPod || cmn.ua.Android || cmn.ua_WinPhone || cmn.ua_Blackberry || w < 680) {
		$('.modalInnerBox2 .initial').css('display','none');
		$('input').each(function(){
			var input_class = String($(this).attr('class'));
			if(input_class.match(/validate/)){
				$(this).attr('data-prompt-position','topLeft');
			}
		});
		$('#agree').attr('data-prompt-position','centerLeft');
		$('select').each(function(){
			var input_class = String($(this).attr('class'));
			if(input_class.match(/validate/)){
				$(this).attr('data-prompt-position','topLeft');
			}
		});		
		sp_flg = 1;
	} else {
		$('.modalInnerBox2 .initial_sp').css('display','none');
		sp_flg = 0;
	}
	
	var timer = false;
	
	$(window).resize(function() {
		if (timer !== false) {
			clearTimeout(timer);
		}
		timer = setTimeout(function() {
			centering();
		}, 200);
	});	

	$(window).scroll(function () {
		centering();
	});			

	// spの場合頭文字を切り替えるので切り替え前のhtml保存
	initial_sp_before = $('.initialBox_sp').html();	
	
	// 確認画面から戻った時の為記述
	bank_name = $('input[name="銀行"]').val();
	if (bank_name == 'みずほ銀行' || bank_name == '三菱東京UFJ銀行' || bank_name == '東北銀行' || bank_name == '群馬銀行' || bank_name == '千葉興業銀行' || bank_name == '静岡銀行' || bank_name == '池田泉州銀行' || bank_name == '広島銀行' || bank_name == '北洋銀行' || bank_name == '愛知銀行' || bank_name == '宮崎太陽銀行') {
		conditions_html = '' +
		'<tr class="bankBox bankConditions">' + 
		'<th valign="top">最終残高下4桁<span>必須</span></th>' +
		'<td><input size="30" type="text" name="最終残高下4桁" class="validate[required],[custom[onlyNumberSp]]" data-prompt-position="topLeft"></td>' +
		'</tr>';
	} else if (bank_name == '青森銀行' || bank_name == '山形銀行' || bank_name == '筑波銀行' || bank_name == '武蔵野銀行' || bank_name == '八十二銀行' || bank_name == '阿波銀行' || bank_name == '宮崎銀行' || bank_name == '琉球銀行') {
		conditions_html = '' +
		'<tr class="bankBox bankConditions">' + 
		'<th valign="top">銀行届出電話番号<span>必須</span></th>' +
		'<td><input size="30" type="text" name="銀行届出電話番号" class="validate[required],[custom[onlyNumberSp]]" data-prompt-position="topLeft"></td>' +
		'</tr>';
	} else {
		conditions_html = '';
	}
	$('tr.bankBox:eq(3)').after(conditions_html);	
	
	$('#postalCode').jpostal({
		click : '.autoInput',
		postcode : [
			'#postalCode'
		],
			address : {
			  '#prefectures'  : '%3',
			  '#address' : '%4%5'
			}
	});	
	
	$(document).on('click','.autoInput',function(){
		return false;
	});		
	
	$(document).on('click','input[name="pay"]',function(){
		entryChange();
	});
		
	$(document).on("click",'input[name="銀行"]',function(){
		$('#bankBtn').trigger('click');
	});
	
	$(document).on("click","#bankBtn",function(){
		centering();
		$('input[name="銀行"]').blur();
		$('.overLayer').fadeIn(500);
		$('.modalBox').fadeIn(500);
		$('html').css('overflow','hidden');
		$('body').css('overflow','hidden');
		$('html').css('height', '100%');	
		$('body').css('height','100%');
		return false;
	});
	
	$(document).on("click",".overLayer,.stopBtn",function(){
		$('html').css('cssText', 'overflow-y: scroll !important');
		$('.modalBox').fadeOut(500);
		$('.overLayer').fadeOut(500);
		return false;
	});		

	$(document).on("click",".overLayer,.formBtn",function(){
		$('input[name="銀行"]').val(bank_name);
		$('.bankConditions').remove();
		$('tr.bankBox:eq(3)').after(conditions_html);
		$('.stopBtn').trigger('click');
		$('input[name="銀行"]').trigger('blur');
		return false;
	});		
	
	$(document).on("click",".returnBtn",function(){
		modalInnerBox_i = 1;
		$('.modalInnerBox').each(function(){
			if($(this).css('display') == 'block'){
				$('.modalInnerBox' + modalInnerBox_i).css('display','none');
			
				// 第3画面でゆうちょ銀行と都市銀行時
				if((modalInnerBox_i == 3)  && (bankList_name == 'ゆうちょ銀行' || bankList_name == '都市銀行') ) {
						modalInnerBox_i--;
				}
				$('.modalInnerBox' + --modalInnerBox_i).fadeIn();
				
			}
			modalInnerBox_i++;
		});

		// スマホのみ頭文字の切り替えを戻す
		if (sp_flg == 1) {
			$('.initialBox_sp').html(initial_sp_before);
		}
		numberBox();
		return false;
	});			

	$(document).on("click",".modalInnerBox1 .bankList li a",function(){
		bankList_name = $(this).text();
		$('.modalInnerBox2').children('dl').children('dd').html(bankList_name);
		$(".modalBox .modalInnerBox1").css('display','none');
		if(bankList_name == 'ゆうちょ銀行'){
			$('.modalInnerBox3 ul.bankList').html('<li><a href="">ゆうちょ銀行(金融機関受付方式）</a></li><li><a href="">ゆうちょ銀行（Web受付方式）</a></li>');			
			$('.modalBox .modalInnerBox3').fadeIn();
		} else if(bankList_name == '都市銀行') {
			$('.modalInnerBox3 ul.bankList').html('<li><a href="">埼玉りそな銀行</a></li><li><a href="">みずほ銀行</a></li><li><a href="">三菱東京UFJ銀行</a></li><li><a href="">三井住友銀行</a></li><li><a href="">りそな銀行</a></li>');						
			$('.modalBox .modalInnerBox3').fadeIn();
		} else {
			$('.modalBox .modalInnerBox2').fadeIn();			
		}
		numberBox();
		return false;
	});
	
	
	$(document).on("click",".modalInnerBox3 .bankList li a",function(){
		bank_name = $(this).text();
		notes = '<span class="alert">これより先は' + bank_name + '入力フォームへ推移します。</span><br>' + bank_name + 'は以下の入力が必要となります。予めご了承ください。<ul>';
		if (bank_name == 'みずほ銀行' || bank_name == '三菱東京UFJ銀行' || bank_name == '東北銀行' || bank_name == '群馬銀行' || bank_name == '千葉興業銀行' || bank_name == '静岡銀行' || bank_name == '池田泉州銀行' || bank_name == '広島銀行' || bank_name == '北洋銀行' || bank_name == '愛知銀行' || bank_name == '宮崎太陽銀行') {
			notes += '<li>最終残高下4桁</li>';
			conditions_html = '' +
			'<tr class="bankBox bankConditions">' + 
            '<th valign="top">最終残高下4桁<span>必須</span></th>' +
            '<td><input size="30" type="text" name="最終残高下4桁" class="validate[required],[custom[onlyNumberSp]]" data-prompt-position="topLeft"></td>' +
            '</tr>';
		} else if (bank_name == '青森銀行' || bank_name == '山形銀行' || bank_name == '筑波銀行' || bank_name == '武蔵野銀行' || bank_name == '八十二銀行' || bank_name == '阿波銀行' || bank_name == '宮崎銀行' || bank_name == '琉球銀行') {
			notes += '<li>銀行届出電話番号</li>';
			conditions_html = '' +
			'<tr class="bankBox bankConditions">' + 
            '<th valign="top">銀行届出電話番号<span>必須</span></th>' +
            '<td><input size="30" type="text" name="銀行届出電話番号" class="validate[required],[custom[onlyNumberSp]]" data-prompt-position="topLeft"></td>' +
            '</tr>';
		} else {
			conditions_html = '';
		}
		$('input[name="最終残高下4桁"]').remove();
		$('input[name="銀行届出電話番号"]').remove();
		notes += '<li>支店名（支店番号）</li>';
		notes += '<li>口座番号</li>';
		notes += '<li>キャッシュカードの暗証番号</li>';
		notes += '</ul>';
		$('.modalBox .modalInnerBox4 .notes').html(notes);
		$('.modalBox .modalInnerBox4 dl dd').html(bank_name);
		$('.modalBox .modalInnerBox3').css('display','none');
		$('.modalBox .modalInnerBox4').fadeIn();
		numberBox();
		return false;
	});		

	$(document).on("click",".initial_sp li a",function(){

		initial_code = $(this).html();
		if (bankList_name != 'ゆうちょ銀行') {
			switch(initial_code) {
				case 'ア':
					initial_sp_html = '<li><a href="" class="initial_sp_a">ア</a></li><li><a href="" class="initial_sp_a">イ</a><li><a href="" class="initial_sp_a">ウ</a></li><li><a href="" class="initial_sp_a">エ</a></li><li><a href="" class="initial_sp_a">オ</a></li>';
				break;
				case 'カ':
					initial_sp_html = '<li><a href="" class="initial_sp_a">カ</a></li><li><a href="" class="initial_sp_a">キ</a><li><a href="" class="initial_sp_a">ク</a></li><li><a href="" class="initial_sp_a">ケ</a></li><li><a href="" class="initial_sp_a">コ</a></li>';					
				break;
				case 'サ':
					initial_sp_html = '<li><a href="" class="initial_sp_a">サ</a></li><li><a href="" class="initial_sp_a">シ</a><li><a href="" class="initial_sp_a">ス</a></li><li><a href="" class="initial_sp_a">セ</a></li><li><a href="" class="initial_sp_a">ソ</a></li>';					
				break;
				case 'タ':
					initial_sp_html = '<li><a href="" class="initial_sp_a">タ</a></li><li><a href="" class="initial_sp_a">チ</a><li><a href="" class="initial_sp_a">ツ</a></li><li><a href="" class="initial_sp_a">テ</a></li><li><a href="" class="initial_sp_a">ト</a></li>';										
				break;
				case 'ナ':
					initial_sp_html = '<li><a href="" class="initial_sp_a">ナ</a></li><li><a href="" class="initial_sp_a">ニ</a><li><a href="" class="initial_sp_a">ヌ</a></li><li><a href="" class="initial_sp_a">ネ</a></li><li><a href="" class="initial_sp_a">ノ</a></li>';					
				break;
				case 'ハ':
					initial_sp_html = '<li><a href="" class="initial_sp_a">ハ</a></li><li><a href="" class="initial_sp_a">ヒ</a><li><a href="" class="initial_sp_a">フ</a></li><li><a href="" class="initial_sp_a">ヘ</a></li><li><a href="" class="initial_sp_a">ホ</a></li>';					
				break;
				case 'マ':
					initial_sp_html = '<li><a href="" class="initial_sp_a">マ</a></li><li><a href="" class="initial_sp_a">ミ</a><li><a href="" class="initial_sp_a">ム</a></li><li><a href="" class="initial_sp_a">メ</a></li><li><a href="" class="initial_sp_a">モ</a></li>';					
				break;
				case 'ヤ':
					initial_sp_html = '<li><a href="" class="initial_sp_a">ヤ</a></li><li><a href="" class="initial_sp_a">ユ</a><li><a href="" class="initial_sp_a">ヨ</a></li>';					
				break;
				case 'ラ':
					initial_sp_html = '<li><a href="" class="initial_sp_a">ラ</a></li><li><a href="" class="initial_sp_a">リ</a><li><a href="" class="initial_sp_a">ル</a></li><li><a href="" class="initial_sp_a">レ</a></li><li><a href="" class="initial_sp_a">ロ</a></li>';					
				break;
				case 'ワ':
					initial_sp_html = '<li><a href="" class="initial_sp_a">ワ</a></li><li><a href="" class="initial_sp_a">ヲ</a><li><a href="" class="initial_sp_a">ン</a></li>';					
				break;					
			}
			$('.initial_sp').fadeOut(300,function(){
				$(this).html(initial_sp_html).fadeIn();
			});
		}
		return false;
	});
	
	$(document).on("click",".initial li a,.initial_sp_a",function(){

		initial_code = $(this).html();
		if(bankList_name == '都市銀行'){

		} else if (bankList_name == '地方銀行') {
			switch (initial_code){
				case 'ア':
					array_bank = ['青森銀行','秋田銀行','足利銀行','阿波銀行'];
				break;
				case 'イ':
					array_bank = ['岩手銀行','池田泉州銀行','伊予銀行','愛知銀行'];
				break;
				case 'ウ':
					array_bank = [];				
				break;
				case 'エ':
					array_bank = [];				
				break;
				case 'オ':
					array_bank = ['大垣共立銀行','大分銀行 '];
				break;
				case 'カ':
					array_bank = ['鹿児島銀行'];
				break;
				case 'キ':
					array_bank = ['京都銀行','近畿大阪銀行','紀陽銀行','北九州銀行'];
				break;
				case 'ク':
					array_bank = ['群馬銀行','熊本銀行 '];
				break;
				case 'ケ':
					array_bank = ['京葉銀行'];
				break;
				case 'コ':
					array_bank = [];				
				break;
				case 'サ':
					array_bank = ['山陰合同銀行','佐賀銀行'];
				break;
				case 'シ':
					array_bank = ['荘内銀行','七十七銀行','常陽銀行','静岡銀行','清水銀行','十六銀行','滋賀銀行','四国銀行','十八銀行','親和銀行'];
				break;
				case 'ス':
					array_bank = ['スルガ銀行'];
				break;
				case 'セ':
					array_bank = [];				
				break;
				case 'ソ':
					array_bank = [];				
				break;
				case 'タ':
					array_bank = ['第四銀行','但馬銀行','大光銀行','第三銀行'];
				break;			
				case 'チ':
					array_bank = ['千葉銀行','千葉興業銀行','中国銀行'];
				break;			
				case 'ツ':
					array_bank = ['筑波銀行'];
				break;			
				case 'テ':
					array_bank = [];				
				break;			
				case 'ト':
					array_bank = ['東北銀行','東邦銀行','東京都民銀行','富山銀行','鳥取銀行','栃木銀行','トマト銀行'];
				break;			
				case 'ナ':
					array_bank = ['南都銀行'];
				break;			
				case 'ニ':
					array_bank = ['西日本シティ銀行'];
				break;			
				case 'ヌ':
					array_bank = [];				
				break;			
				case 'ネ':
					array_bank = [];				
				break;			
				case 'ノ':
					array_bank = [];				
				break;			
				case 'ハ':
					array_bank = ['北海道銀行','北都銀行','八十二銀行'];
				break;			
				case 'ヒ':
					array_bank = ['百五銀行','広島銀行','百十四銀行','肥後銀行'];
				break;			
				case 'フ':
					array_bank = ['福井銀行','福岡銀行'];
				break;			
				case 'ヘ':
					array_bank = [];				
				break;			
				case 'ホ':
					array_bank = ['北越銀行','北陸銀行','北國銀行','北洋銀行'];
				break;			
				case 'マ':
					array_bank = [];				
				break;			
				case 'ミ':
					array_bank = ['みちのく銀行','三重銀行','宮崎銀行','宮崎太陽銀行'];
				break;			
				case 'ム':
					array_bank = ['武蔵野銀行'];
				break;			
				case 'メ':
					array_bank = [];				
				break;			
				case 'モ':
					array_bank = ['もみじ銀行'];
				break;			
				case 'ヤ':
					array_bank = ['山形銀行','山梨中央銀行','山口銀行'];
				break;			
				case 'ユ':
					array_bank = [];				
				break;
				case 'ヨ':
					array_bank = ['横浜銀行'];
				break;
				case 'ラ':
					array_bank = [];				
				break;
				case 'リ':	
					array_bank = [];				
				break;
				case 'ル':	
					array_bank = ['琉球銀行'];
				break;
				case 'レ':	
					array_bank = [];				
				break;
				case 'ロ':	
					array_bank = [];				
				break;				
				break;			
				case 'ワ':
					array_bank = [];				
				break;			
				case 'ヲ':
					array_bank = [];				
				break;			
				case 'ン':
					array_bank = [];				
				break;	
				case '英字（a～z）':
					array_bank = [];
				break;				
			}							
		} else if (bankList_name == '信用金庫') {
			switch (initial_code){
				case 'ア':
					array_bank = ['旭川','網走','青い森','秋田','会津','あぶくま','アイオー','足利小山','朝日','足立成和','青梅','アルプス中央','愛知','尼崎','淡路','阿南','天草','奄美大島'];
				break;
				case 'イ':
					array_bank = ['一関','石巻','飯田','石動','磐田','いちい','飯塚','伊万里'];
				break;
				case 'ウ':
					array_bank = ['羽後','上田','宇和島'];
				break;
				case 'エ':
					array_bank = ['江差','遠軽','越前','遠州','永和','愛媛'];
				break;
				case 'オ':
					array_bank = ['小樽','帯広','大田原','小浜','大垣西濃','大阪','大阪厚生','大阪シティ','大阪商工','おかやま','大牟田柳川','遠賀','大分','大分みらい'];
				break;
				case 'カ':
					array_bank = ['鹿沼相互','烏山','川口','亀有','柏崎','金沢','蒲郡','観音寺','唐津','鹿児島','鹿児島相互'];
				break;
				case 'キ':
					array_bank = ['北空知','北上','桐生','北群馬','岐阜','北伊勢上野','紀北','京都','京都中央','京都北都','北おおさか','きのくに','吉備','九州ひぜん'];
				break;
				case 'ク':
					array_bank = ['釧路','桑名','倉吉','呉','熊本','熊本第一','熊本中央'];
				break;
				case 'ケ':
					array_bank = ['気仙沼'];
				break;
				case 'コ':
					array_bank = ['郡山','興産','小松川','甲府','興能','湖東','神戸'];
				break;
				case 'サ':
					array_bank = ['札幌','埼玉縣','佐原','さがみ','さわやか','西京','昭和','三条','佐賀'];
				break;
				case 'シ':
					array_bank = ['新庄','白河','しののめ','芝','城北','上越','新湊','島田','滋賀中央','新宮','しまね','島根中央','しまなみ'];
				break;
				case 'ス':
					array_bank = ['須賀川','巣鴨','諏訪','しずおか'];
				break;
				case 'セ':
					array_bank = ['仙南','世田谷','瀧野川','静清','瀬戸'];
				break;
				case 'ソ':
					array_bank = ['空知'];
				break;
				case 'タ':
					array_bank = ['伊達','大地みらい','高崎','館林','多摩','高岡','高山','但馬','但陽','玉島','高松','高鍋'];
				break;			
				case 'チ':
					array_bank = ['千葉','銚子','中栄','中南','知多','中日','筑後'];
				break;			
				case 'ツ':
					array_bank = ['鶴岡','鶴来','敦賀','津','津山'];
				break;			
				case 'テ':
					array_bank = [];				
				break;			
				case 'ト':
					array_bank = ['苫小牧','東奥','利根郡','栃木','東京ベイ','東京東','東京三協','東京','富山','砺波','東濃','豊橋','豊川','豊田','鳥取','徳島','東予'];
				break;			
				case 'ナ':
					array_bank = ['長岡','長浜','奈良','奈良中央','中兵庫','南郷'];
				break;			
				case 'ニ':
					array_bank = ['二本松','にいかわ','西尾','日新','西兵庫','日本海','西中国'];
				break;			
				case 'ヌ':
					array_bank = ['沼津'];
				break;			
				case 'ネ':
					array_bank = [];				
				break;			
				case 'ノ':
					array_bank = ['のと共栄','延岡'];
				break;			
				case 'ハ':
					array_bank = ['函館','花巻','飯能','浜松','半田','播州','萩山口','幡多'];
				break;			
				case 'ヒ':
					array_bank = ['日高','ひまわり','氷見伏木','尾西','枚方','姫路','兵庫','備北','日生','備前','東山口','日田'];
				break;			
				case 'フ':
					array_bank = ['福島','福井','富士宮','富士','福岡','福岡ひびき'];
				break;			
				case 'ヘ':
					array_bank = ['碧海'];
				break;			
				case 'ホ':
					array_bank = ['北門','北海','北陸'];
				break;			
				case 'マ':
					array_bank = ['松本'];
				break;			
				case 'ミ':
					array_bank = ['宮古','水沢','水戸','三島','三重','水島','宮崎','都城'];
				break;			
				case 'ム':
					array_bank = ['室蘭'];
				break;			
				case 'メ':
					array_bank = ['目黒'];
				break;			
				case 'モ':
					array_bank = ['盛岡'];
				break;			
				case 'ヤ':
					array_bank = ['山梨','焼津','大和'];
				break;			
				case 'ユ':
					array_bank = ['結城'];
				break;
				case 'ヨ':
					array_bank = ['米沢','米子'];
				break;	
				case 'ラ':	
					array_bank = [];				
				break;
				case 'リ':	
					array_bank = [];				
				break;
				case 'ル':	
					array_bank = ['留萌'];
				break;
				case 'レ':	
					array_bank = [];				
				break;
				case 'ロ':	
					array_bank = [];				
				break;				
				case 'ワ':
					array_bank = ['稚内'];
				break;			
				case 'ヲ':
					array_bank = [];				
				break;			
				case 'ン':
					array_bank = [];				
				break;	
				case '英字（a～z）':
					array_bank = [];
				break;				
			}			
			
		} else if (bankList_name == 'ゆうちょ銀行') {

		} else if (bankList_name == 'その他') {
			switch (initial_code){
				case 'ア':
					array_bank = [];				
				break;
				case 'イ':
					array_bank = ['イオン銀行'];
				break;
				case 'ウ':
					array_bank = [];				
				break;
				case 'エ':
					array_bank = [];				
				break;
				case 'オ':
					array_bank = [];				
				break;
				case 'カ':
					array_bank = [];				
				break;
				case 'キ':
					array_bank = [];				
				break;
				case 'ク':
					array_bank = [];				
				break;
				case 'ケ':
					array_bank = [];				
				break;
				case 'コ':
					array_bank = [];				
				break;
				case 'サ':
					array_bank = [];				
				break;
				case 'シ':
					array_bank = ['ジャパンネット銀行','じぶん銀行','新生銀行'];
				break;
				case 'ス':
					array_bank = ['住信ＳＢＩネット銀行'];
				break;
				case 'セ':
					array_bank = ['セブン銀行'];
				break;
				case 'ソ':
					array_bank = ['ソニー銀行'];
				break;
				case 'タ':
					array_bank = [];				
				break;			
				case 'チ':
					array_bank = [];				
				break;			
				case 'ツ':
					array_bank = [];				
				break;			
				case 'テ':
					array_bank = [];				
				break;			
				case 'ト':
					array_bank = [];				
				break;			
				case 'ナ':
					array_bank = [];				
				break;			
				case 'ニ':
					array_bank = [];				
				break;			
				case 'ヌ':
					array_bank = [];				
				break;			
				case 'ネ':
					array_bank = [];				
				break;			
				case 'ノ':
					array_bank = [];				
				break;			
				case 'ハ':
					array_bank = [];				
				break;			
				case 'ヒ':
					array_bank = [];				
				break;			
				case 'フ':
					array_bank = [];				
				break;			
				case 'ヘ':
					array_bank = [];				
				break;			
				case 'ホ':
					array_bank = [];				
				break;			
				case 'マ':
					array_bank = [];				
				break;			
				case 'ミ':
					array_bank = [];				
				break;			
				case 'ム':
					array_bank = [];				
				break;			
				case 'メ':
					array_bank = [];				
				break;			
				case 'モ':
					array_bank = [];				
				break;			
				case 'ヤ':
					array_bank = [];				
				break;			
				case 'ユ':
					array_bank = [];				
				break;
				case 'ヨ':
					array_bank = [];				
				break;	
				case 'ラ':	
					array_bank = ['楽天銀行'];
				break;
				case 'リ':
					array_bank = [];				
				break;
				case 'ル':	
					array_bank = [];				
				break;
				case 'レ':	
					array_bank = [];				
				break;
				case 'ロ':	
					array_bank = [];				
				break;				
				case 'ワ':
					array_bank = [];				
				break;			
				case 'ヲ':
					array_bank = [];				
				break;			
				case 'ン':
					array_bank = [];				
				break;	
				case '英字（a～z）':
					array_bank = [];
				break;				
			}		
		}
		$('.modalInnerBox2').css('display','none');
		$('.modalInnerBox3').fadeIn();
		list_html = '<ul class="bankList">';
		if(array_bank.length > 0) {
			for(i=0;array_bank.length>i;i++) {
				
				// 信用金庫のみリストに信用金庫がついていなかった為記述
				if (bankList_name == '信用金庫') {
					array_bank[i] += '信用金庫';
				}
				list_html += '<li><a href="">' + array_bank[i] + '</a></li>';
			}

		} else {
				list_html += '<li>データが存在しません</li>';
		}
		list_html += '</ul>';	
		$('.modalInnerBox3 .bankListWrap').html(list_html);
		numberBox();
		return false;
	});
		
});

$(window).on('load', function() {
    $.fn.autoKana('#lastName', '#lastNameKana', {
        katakana : true
    });	    
    $.fn.autoKana('#firstName', '#firstNameKana', {
        katakana : true
    });	    	
});

animate_flg = 0;

$(window).scroll(function(){
	var submit = $('#submit');
	var position_next = submit.offset().top + 100 - $(window).height();	
	if ($(window).scrollTop() > position_next && animate_flg == 0) {
		submit.addClass('animated rubberBand');
		animate_flg = 1;
		setTimeout(function(){
			submit.removeClass('animated').removeClass('rubberBand');
			animate_flg = 0;
		},1000);		
	}	
});