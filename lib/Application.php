<?php
/**
 * 申込時に行う処理を集約.
 * TODO:
 * */

require_once '../lib/HatarakuDb.php';
require_once '../lib/Param/HatarakuDbInsert.php';
require_once '../lib/Common.php';
require_once '../lib/Mail.php';

use Param\HatarakuDbInsert;

class Service
{
	static public function exec()
	{
		// 正常にページ推移したか確認(正しくなかったらtopに戻る)
		$ref = $_SERVER['HTTP_REFERER'];
		date_default_timezone_set('Asia/Tokyo');
		if ((isset($_POST['confirmationSubmitFlag']) && $_POST['confirmationSubmitFlag'] != 1) || strpos($ref,'confirmation') === false) {
			header( "Location: / " );
		}
		session_start();
		// 2重送信確認
		if ($_SESSION['tk'] != $_POST['tk'] || empty($_SESSION['tk'])) {
			unset($_SESSION['tk']);
			return '不正な値が送信されました。';

		}
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
		// 失敗したらメールで報告
		if ($result !== "200") {
			Mail::sendHatarakuDBImportError($result);
			unset($_SESSION['tk']);
			return 'お申し込みに失敗しました。お手数ですがサポート窓口までお問い合わせください。';
		} else {
			// 管理者へメール
			Mail::sendApplication2Admin($_POST);
			// ユーザーへメール
			if (!Mail::sendApplication2User($_POST)) {
				// TODO: 文字列出すだけではなくて、管理者にメール送る処理とか入れたほうがいい. せめて、ログ出力するべき.
				unset($_SESSION['tk']);
				return 'メール送信に失敗しました。お手数ですがサポート窓口までお問い合わせください。';
			}
		}
		unset($_SESSION['tk']);
		return '';
	}
}
?>