;/*****************************************************************
 * Japanese language file for jquery.validationEngine.js (ver2.0)
 *
 * Transrator: tomotomo ( Tomoyuki SUGITA )
 * http://tomotomoSnippet.blogspot.com/
 * Licenced under the MIT Licence
 *******************************************************************/
(function($){
	$.fn.validationEngineLanguage = function(){
	};
	$.validationEngineLanguage = {
		newLang: function(){
			$.validationEngineLanguage.allRules = {
				"required": { // Add your regex rules here, you can take telephone as an example
					"regex": "none",
					"alertText": "* 必須項目です",
					"alertTextCheckboxMultiple": "* 選択してください",
					"alertTextCheckboxe": "個人情報取得における告知・同意文、個人情報保護方針に同意して下さい"
				},
				"requiredInFunction": {
					"func": function(field, rules, i, options){
						return (field.val() == "test") ? true : false;
					},
					"alertText": "* Field must equal test"
				},
				"minSize": {
					"regex": "none",
					"alertText": "* ",
					"alertText2": "文字以上にしてください"
				},
				"groupRequired": {
					"regex": "none",
					"alertText": "* You must fill one of the following fields"
				},
				"maxSize": {
					"regex": "none",
					"alertText": "* ",
					"alertText2": "文字以下にしてください"
				},
				"min": {
					"regex": "none",
					"alertText": "* ",
					"alertText2": " 以上の数値にしてください"
				},
				"max": {
					"regex": "none",
					"alertText": "* ",
					"alertText2": " 以下の数値にしてください"
				},
				"past": {
					"regex": "none",
					"alertText": "* ",
					"alertText2": " より過去の日付にしてください"
				},
				"future": {
					"regex": "none",
					"alertText": "* ",
					"alertText2": " より最近の日付にしてください"
				},
				"maxCheckbox": {
					"regex": "none",
					"alertText": "* チェックしすぎです"
				},
				"minCheckbox": {
					"regex": "none",
					"alertText": "* ",
					"alertText2": "つ以上チェックしてください"
				},
				"equals": {
					"regex": "none",
					"alertText": "* 入力された値が一致しません"
				},
				"creditCard": {
					"regex": "none",
					"alertText": "* 無効なクレジットカード番号"
				},
				"phone": {
					// credit: jquery.h5validate.js / orefalo
					"regex": /^([\+][0-9]{1,3}([ \.\-])?)?([\(][0-9]{1,6}[\)])?([0-9 \.\-]{1,32})(([A-Za-z \:]{1,11})?[0-9]{1,4}?)$/,
					"alertText": "* 電話番号が正しくありません"
				},
				"email": {
					// Shamelessly lifted from Scott Gonzalez via the Bassistance Validation plugin http://projects.scottsplayground.com/email_address_validation/
					"regex": /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i,
					"alertText": "* メールアドレスが正しくありません"
				},
				"integer": {
					"regex": /^[\-\+]?\d+$/,
					"alertText": "* 整数を半角で入力してください"
				},
				"number": {
					// Number, including positive, negative, and floating decimal. credit: orefalo
					"regex": /^[\-\+]?((([0-9]{1,3})([,][0-9]{3})*)|([0-9]+))?([\.]([0-9]+))?$/,
					"alertText": "* 数値を半角で入力してください"
				},
				"date": {
					"regex": /^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$/,
					"alertText": "* 日付は半角で「YYYY/MM/DD」の形式で入力してください"
				},
				"ipv4": {
					"regex": /^((([01]?[0-9]{1,2})|(2[0-4][0-9])|(25[0-5]))[.]){3}(([0-1]?[0-9]{1,2})|(2[0-4][0-9])|(25[0-5]))$/,
					"alertText": "* IPアドレスが正しくありません"
				},
				"url": {
					"regex": /^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i,
					"alertText": "* URLが正しくありません"
				},
				"onlyNumberSp": {
					"regex": /^[0-9\ ]+$/,
					"alertText": "* ハイフン抜き半角数字で入力してください。"
				},
				"onlyLetterSp": {
					"regex": /^[a-zA-Z\ \']+$/,
					"alertText": "* 半角アルファベットで入力してください"
				},
				"onlyLetterNumber": {
					"regex": /^[0-9a-zA-Z]+$/,
					"alertText": "* 半角英数で入力してください"
				},
				"zip": {
					"regex": /^[0-9\ ]{7}$/,
					"range":[7,7],
					"digits":true,
					"alertText": "* 郵便番号が正しくありません。"
				},
				// --- CUSTOM RULES -- Those are specific to the demos, they can be removed or changed to your likings
				"ajaxUserCall": {
					"url": "ajaxValidateFieldUser",
					// you may want to pass extra data on the ajax call
					"extraData": "name=eric",
					"alertText": "* This user is already taken",
					"alertTextLoad": "* Validating, please wait"
				},
				"ajaxNameCall": {
					// remote json service location
					"url": "ajaxValidateFieldName",
					// error
					"alertText": "* This name is already taken",
					// if you provide an "alertTextOk", it will show as a green prompt when the field validates
					"alertTextOk": "* This name is available",
					// speaks by itself
					"alertTextLoad": "* Validating, please wait"
				},"zenkaku": {
					// 全角判定追加　
"regex":/^[０-９－ａ-ｚＡ-Ｚぁ-んァ-ー一-龠　、。，．・：；？！゛゜´｀¨＾￣＿ヽヾゝゞ〃仝々〆〇ー―‐／＼～∥｜…‥‘’“”（）〔〕［］｛｝〈〉《》「」『』【】＋－±×÷＝≠＜＞≦≧∞∴♂♀°′″℃￥＄￠￡％＃＆＊＠§☆★○●◎◇◆□■△▲▽▼※〒→←↑↓〓∈∋⊆⊇⊂⊃∪∩∧∨￢⇒⇔∀∃∠⊥⌒∂∇≡≒≪≫√∽∝∵∫∬Å‰♯♭♪\n\r]+$/,
"alertText": "* 全角文字で入力してください"
				},"kana": {
					// 判定追加　
"regex": /^[\uFF65-\uFF9F]+$/,
"alertText": "* 半角ﾌﾘｶﾞﾅで入力してください"
				},"zenkaku_kana": {
					// 全角カナ判定追加 　
"regex": /^[ァ-ヶ　]+$/,
"alertText": "* 全角カナで入力してください"
				},
				"validate2fields": {
					"alertText": "* 『HELLO』と入力してください"
				},
				"couponCode" :{
					"regex": /^(fondonuts202106|fhgamesoftcp2021|dp-oomiya-w|dp-higashijujo|dp-shibuya-md|dp-koenji-s|dp-koiwa|dp-sugamo|dp-sagamiono|dp-akabane-ekimae|dp-meidaimae|dp-narimasu|dp-nerima|dp-kichijoji|dp-oomori|dp-ooyama-ekimae|dp-musashikoyama|dp-kamata-w|dp-ogikubo|dp-kamedo|dp-shimokitazawa-ekimae|dp-keido|dp-higashinakano|dp-jiyugaoka|dp-komazawadaigaku|dp-tokorozawa-p|dp-chitosefunabashi|dp-tsunashima|dp-oomiya-e|dp-takadanobaba|dp-mejiro|dp-machida|dp-chitosekarasuyama|dp-funabashi|g0000-0000-0000|g0003-0000-0000|g0011-0000-0000|g0002-0000-0000|g0002-0001-0000|g0002-0002-0000|g0002-0003-0000|s0000-0000-0000|s0001-0000-0000|s0001-0001-0000|s0001-0002-0000|s0001-0003-0000|s0002-0000-0000|s0002-0001-0000|s0002-0002-0000|s0002-0003-0000|s0002-0004-0000|s0003-0000-0000|s0004-0000-0000|s0004-0001-0000|s0005-0000-0000|s0007-0000-0000|s0009-0000-0000|s0010-0000-0000|s0012-0000-0000|s0013-0000-0000|s0014-0000-0000|s0014-0001-0000|s0014-0002-0000|s0014-0003-0000|s0014-0004-0000|s0014-0005-0000|s0015-0000-0000|s0016-0000-0000|s0016-0001-0000|s0017-0000-0000|s0017-0001-0000|s0018-0000-0000|s0004-0002-0000|s0019-0000-0000|s0001-0004-0000|s0003-0001-0000|n0001-0003-0000|n0001-0000-0000|n0001-0001-0000|n0001-0002-0000|n0001-0004-0000|n0001-0005-0000|g0004-0000-0000|g0004-0001-0000|g0007-0000-0000|g0007-0001-0000|g0007-0002-0000|g0007-0003-0000|g0007-0004-0000|g0007-0005-0000|g0007-0006-0000|g0007-0007-0000|g0007-0008-0000|g0007-0009-0000|g0007-0010-0000|g0008-0000-0000|g0009-0000-0000|g0010-0000-0000|p0000-0000-0000|g0014-0000-0000|g0012-0000-0000|g0013-0000-0000|g0015-0000-0000|g0019-0000-0000|g0020-0000-0000|g0016-0000-0000|g0017-0000-0000|g0018-0000-0000|g0021-0000-0000|g0022-0000-0000|d0001-0000-0000|d0001-0000-0001|d0001-0000-0002|d0001-0000-0003|d0001-0000-0004|d0001-0000-0005|d0001-0000-0006|d0001-0000-0007|d0001-0000-0008|d0001-0000-0009|d0001-0000-0010|d0001-0000-0011|d0001-0000-0012|d0001-0000-0013|d0001-0000-0014|d0001-0000-0015|d0001-0000-0016|d0001-0000-0017|d0001-0000-0018|d0001-0000-0019|d0001-0000-0020|d0001-0000-0021|d0001-0000-0022|d0001-0000-0023|d0001-0000-0024|d0001-0000-0025|s0001-0000-1001|s0001-0000-1002|s0001-0000-0101|s0001-0001-0001|s0001-0003-0001|s0001-0003-0002|s0001-0003-0003|s0001-0003-0004|s0001-0003-0005|s0001-0003-0006|s0001-0004-0001)$/,
					"alertText": "* クーポンコードが正しくありません",
				},
			};

		}
	};
	$.validationEngineLanguage.newLang();
})(jQuery);


