<?php

require_once '../lib/HatarakuDb.php';
require_once '../lib/Param/HatarakuDbInsert.php';

use Param\HatarakuDbInsert;

// TODO 本当はクラス化したいが、、、時間のあるときにリファクタリング.
// 正常にページ推移したか確認(正しくなかったらtopに戻る)
$ref = $_SERVER['HTTP_REFERER'];

if ((isset($_POST['confirmationSubmitFlag']) && $_POST['confirmationSubmitFlag'] != 1) || strpos($ref,'confirmation') === false) {
	header( "Location: / " );
}
$error ='';
session_start();
var_dump($_SESSION['tk']);
var_dump($_POST['tk']);
// 2重送信確認
if ($_SESSION['tk'] != $_POST['tk'] || empty($_SESSION['tk'])) {
	$error .= '<p class="error">不正な値が送信されました</p>';
}

if(empty($error)) {
	//働くDBインポート.
	$data = HatarakuDbInsert::createData($_POST);

	$recordRegistRequestBody[] = HatarakuDbInsert::getApplicationApiParameter($data);
	// API送信実行
	$hatarakuDb = new HatarakuDb();
	$result = $hatarakuDb->sendRequest(
	HatarakuDb::URL_SINGLE_API,
	HatarakuDb::API_TYPE_RECORD_REGIST,
	$recordRegistRequestBody
	);
	var_dump($result);
	// 失敗したらメールで報告
	if ($result !== "200") {
		sendHatarakuDBErrorMail($result);
		$error .= '<p class="error">お申し込みに失敗しました。お手数ですがサポート窓口までお問い合わせください。</p>';
	} else {
		//文字指定
		mb_language("Japanese");
		mb_internal_encoding("UTF-8");

		//-----------------------------------------------------------
		// 管理者へメール
		//-----------------------------------------------------------
		$content = '';
		foreach($_POST as $k => $v) {
			$content .= '【 '. $k . ' 】 ' . $v . "\r\n";
		}
		$content .= "\r\n";
		$content .= '送信された日時：' . date( "Y/m/d (D) H:i:s" )."\r\n";
		$content .= '申し込みのページHOST：' . $_SERVER['HTTP_HOST']."\r\n";
		$content .= '申込のページURL：' . $_SERVER['REQUEST_URI']."\r\n";
		$to = 'support@fon-hikari.net,s_kagaya@1onepiece.jp';
		$title = '【fon光申込】';
		$headers  = 'From: ' . mb_encode_mimeheader($_POST['メールアドレス']) . "\r\n";
		$headers .='Bcc: onepiecetakaie@gmail.com' . "\r\n";
		$send_mail = mb_send_mail($to, $title, $content, $headers, '-f support@fon-hikari.net');
		
		//-----------------------------------------------------------
		// ユーザーへメール
		//-----------------------------------------------------------
		$to = $_POST['メールアドレス'];
		$headers  = "From: support@fon-hikari.net\r\n";
		$headers .='Bcc: onepiecetakaie@gmail.com' . "\r\n";
		$title = "《Fon光》お申し込み確認メール";
		$content  = createApplicationMailContent();
		var_dump($content);
		$send_mail = mb_send_mail($to, $title, $content, $headers, '-f support@fon-hikari.net');		
	}
	unset($_SESSION['tk']);
}

// TODO ネストが深い. メール内容がわかりにくいため、判定などはメソッド化する.
// 申込内容生成
function createApplicationMailContent() {
	$content = '';
	$content .= 'この度はFon光のお申込みありがとうございます。'."\r\n";
	$content .= 'お客様のお申し込みを下記内容で承りました。'."\r\n";
	$content .= '情報に問題がなければこのままお手続きを進めさせていただきます。'."\r\n";
	$content .= '━━━━━━━━━━━━━━━━━━━━━━━━━━━'."\r\n";
	$content .= '◆ お申し込み内容'."\r\n";
	$content .= '───────────────────────────'."\r\n";
	$content .= '《お申込み日時》'."\r\n";
	$content .= date( "Y/m/d (D) H:i:s" )."\r\n";
	$content .= '【Fon光】'."\r\n";
	$content .= '《契約期間》'."\r\n";
	$content .= '24か月（自動更新）'."\r\n";
	$content .= '《Fon光月額利用料》'."\r\n";
	$content .= '3,980円'."\r\n";
	$content .= '《工事費：分割》'."\r\n";
	$content .= '40,000 円（ 1,333 円 X 30 か月の分割払い）'."\r\n";
	$content .= '※ 工事費割引1,333 円 X 30 か月割引が適用されますので、実質無料となります。'."\r\n";
	$content .= '《契約事務手数料》'."\r\n";
	$content .= '3,000円'."\r\n";
	$content .= '【付加サービス】'."\r\n";
	$content .= '《NURO光でんわ申込》'."\r\n";
	if($_POST['telephoneApplication'] == '0') {
		$content .= 'なし'."\r\n";
	} else {
		$content .= 'あり'."\r\n";
		$content .= '《NURO光でんわ基本料金》'."\r\n";
		// 都道府県判定.
		$pref = '';
		// 設置場所の都道府県を設定
		if($_POST['mailingDestination'] == '0') {
			$pref = $_POST['installationPref'];
		} else {
			$pref = $_POST['mailingPrefName'];
		}
		switch ($pref) {
			case '北海道' :
			case '東京都' :
			case '神奈川県' :
			case '千葉県' :
			case '埼玉県' :
			case '群馬県' :
			case '栃木県' :
			case '茨城県' :
				$content .= '500円'."\r\n";
				break;
			case '静岡県' :
			case '愛知県' :
			case '岐阜県' :
			case '三重県' :
			case '大阪府' :
			case '兵庫県' :
			case '京都府' :
			case '奈良県' :
			case '福岡県' :
			case '佐賀県' :
				$content .= '300円'."\r\n";
				break;
		}
		// 番号ポータビリティ.
		if($_POST['numberingMethod'] == '1') {
			$content .= '《固定電話番号》'."\r\n";
			$content .= $_POST['fixedLine']."\r\n";		
		}
	}
	// 今はなしに固定 なし or あり
	$content .= '《リモートサポート》'."\r\n";
	$content .= 'なし'."\r\n";
	// リモートサポートリリース時に復活
	// $content .= '《プラン料金》';
	// $content .= '500';
	// 今はなしに固定 なし/TVおすすめプラン/お値打ちプラン/ビデオざんまいプラン/基本放送プラン
	$content .= '《ひかりTV for NURO申込》'."\r\n";
	$content .= 'なし'."\r\n";
	// $content .= '《プラン料金》';
	// $content .= '';

	$content .= '※工事内容により追加工事費が発生する場合がございます。'."\r\n";
	$content .= '※付加サービスはプランにより価格が異なります。'."\r\n";
	$content .= '※表示の金額は全て税抜き価格です。'."\r\n";
	$content .= "\r\n";
	$content .= $_POST['lastName'] . ' ' . $_POST['firstName'] . '様'."\r\n";
	$content .= '《設置先ご住所》'."\r\n";
	if($_POST['mailingDestination'] == '0') {
		$content .= $_POST['installationPref'] .$_POST['installationMunicipalities'] .$_POST['installationTown'] .$_POST['installationAddress'].$_POST['installationBuilding']."\r\n";
	} else {
		$content .= $_POST['mailingPrefName'] .$_POST['mailingMunicipalities'] .$_POST['mailingTown'] .$_POST['mailingAddress'].$_POST['mailingBuilding']."\r\n";
	}
	$content .= '《ご連絡携帯電話番号》'."\r\n";
	$content .= $_POST['phoneNumber']."\r\n";
	$content .= "\r\n";
	$content .= '━━━━━━━━━━━━━━━━━━━━━━━━━━━'."\r\n";
	$content .= '◆ご利用開始までの流れ'."\r\n";
	$content .= '───────────────────────────'."\r\n";
	$content .= 'STEP1：お申込み'."\r\n";
	$content .= '本メールにて受付を致しました。'."\r\n";
	$content .= 'お電話にて申込確認のお電話を入れさせて頂いた後に'."\r\n";
	$content .= '1週間以内にお申込みに関する書面をご登録住所へ発送致します。'."\r\n";
	$content .= 'STEP2：宅内工事日決定'."\r\n";
	$content .= '・申込確認のお電話にて宅内工事希望日を選択した場合'."\r\n";
	$content .= '　約3日～4日後に宅内工事日決定のご連絡を、申し込み時にご登録いただいた携帯電話番号宛にSMSを送信いたします。また、希望日で工事の実施ができない場合は、光回線調整窓口より、お申し込み時にご登録いただいた電話番号へ「宅内工事」の調整のご連絡をいたします。'."\r\n";
	$content .= '・申込確認のお電話にてに宅内工事希望日を選択しなかった場合'."\r\n";
	$content .= '　およそ10日後に光回線調整窓口から日程調整の電話をいたします。'."\r\n";
	$content .= 'STEP3：宅内工事'."\r\n";
	$content .= 'お客さまの立ち合いが必要です。'."\r\n";
	$content .= '立ち会いは必ず契約者本人である必要はありませんが （ご家族、ご友人も可）、本人以外の場合は契約者本人と電話がつながる状態であることが必要です。 '."\r\n";
	$content .= 'STEP4：屋外工事日決定'."\r\n";
	$content .= '屋外工事日は建物への提供方法が確定し、工事日調整の準備が整い次第、ご連絡をしています。'."\r\n";
	$content .= 'STEP5：屋外工事・ご利用開始'."\r\n";
	$content .= '宅内工事完了後、屋外工事日を決定していただきます。 立ち会いは必ず契約者本人である必要はありませんが （ご家族、ご友人も可）、本人以外の場合は契約者本人と電話がつながる状態であることが必要です。'."\r\n";
	$content .= '━━━━━━━━━━━━━━━━━━━━━━━━━━━'."\r\n";
	$content .= '▼お問い合わせ'."\r\n";
	$content .= '────────────────────────────'."\r\n";
	$content .= 'ご不明点につきましては、よくある質問をご覧ください。'."\r\n";
	$content .= '・よくある質問：https://fon-hikari.net/faq'."\r\n";
	$content .= 'それでもご不明点がございましたら、お問い合わせフォームよりお問い合わせください。'."\r\n";
	$content .= '・お問い合わせフォーム：https://fon-hikari.net/contact'."\r\n";
	$content .= '━━━━━━━━━━━━━━━━━━━━━━━━━━━'."\r\n";
	$content .= '▼会社概要'."\r\n";
	$content .= '────────────────────────────'."\r\n";
	$content .= 'フォン・ジャパン株式会社'."\r\n";
	$content .= '〒171-0014 東京都豊島区池袋2-14-4 池袋TAビル8F'."\r\n";
	$content .= 'このメールに心当たりの無い場合は、お手数ですがサポート窓口までお問い合わせください。'."\r\n";
	return $content;
}

/**
 * FIXME 働くDBのインポートエラーメッセージ送信 縛りなしのコピペ 動作確認してない. いらないかも..
 *
 * @param string $result
 * @return void
 */
function sendHatarakuDBErrorMail(string $result){

    $body_head = <<<SUB_HEAD
    下記のお客様情報の登録に失敗しました。
    お申込み内容を確認の上管理者にご確認ください。
    error_code :=> {$result}
    SUB_HEAD;
    
    $error_mail = $body_head."\n\n";

    mb_language("Japanese");
    mb_internal_encoding("UTF-8");

    $error_subject =  "Fon光管理者通知メール【重要】申込の働くDBインポート登録に失敗しました。";
    //  ← を追加.
    $to = mb_convert_encoding("support@fon-hikari.net, onepiecetakaie@gmail.com", 'UTF-8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS');
    $subject = mb_convert_encoding($error_subject, 'UTF-8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS');
    $text = mb_convert_encoding($error_mail, 'UTF-8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS');
    $from = mb_encode_mimeheader('Fon光運営事務局 ','ISO-2022-JP') . '<info@shibarinashi-wifi.jp>';
    $org = mb_convert_encoding("フォン・ジャパン株式会社", 'UTF-8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS');

    $head = '';
    $head .= "Content-Type: text/plain \r\n";
    $head .= "Return-Path: $rp \r\n";
    $head .= "From: $from \r\n";
    $head .= "Sender: $from \r\n";
    $head .= "Organization: $org \r\n";
    $head .= "X-Sender: $from \r\n";
    $head .= "X-Priority: 3 \r\n";

    //管理者宛にメール送信
    mb_send_mail($to, $subject, $text, $head, '-f support@fon-hikari.net');
}

?>