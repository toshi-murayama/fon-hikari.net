<?php
/**
 * 申込時に行う処理を集約.
 * TODO: リファクタリング対象.
 * */

require_once '../lib/HatarakuDb.php';
require_once '../lib/Param/HatarakuDbInsert.php';
require_once '../lib/Common.php';
require_once '../lib/Mail.php';

use Param\HatarakuDbInsert;

class Service
{
	/**
	 * 登録処理実行
	 *
	 * @return string エラー文字列、正常なら空文字.
	 */
	static public function exec(): string
	{
		$ref = $_SERVER['HTTP_REFERER'];
		if ((isset($_POST['confirmationSubmitFlag']) && $_POST['confirmationSubmitFlag'] != 1) || !strpos($ref,'confirmation')) {
			unset($_SESSION['tk']);
			return '不正な値が送信されました。';
		}
		session_start();
		// 2重送信確認
		if ($_SESSION['tk'] != $_POST['tk'] || empty($_SESSION['tk'])) {
			unset($_SESSION['tk']);
			return '不正な値が送信されました。';
		}
		// ここまで来たら、トークン削除.
		unset($_SESSION['tk']);
		// POSTに入れるべきではないが、、、既存のソースに手を加えたくないので、、
		$_POST['isCp'] = isCP();
		// 働くDBインポート
		$error = self::AddHatarakuDb($_POST);
		if (!empty($error)) {
			return $error;
		}
		// メール送信
		return self::sendMail($_POST);
	}

	/**
	 * 働くDBに登録.
	 *
	 * @param array $data
	 * @return string エラー文字列、正常なら空文字.
	 */
	private static function AddHatarakuDb(array $data): string
	{
		// ポストの値から、働くDBの値を生成.
		$insertData = HatarakuDbInsert::createData($data);
		$recordRegistRequestBody[] = HatarakuDbInsert::getApplicationApiParameter($insertData);
		// API送信実行
		$hatarakuDb = new HatarakuDb();
		$result = $hatarakuDb->sendRequest(
			HatarakuDb::URL_SINGLE_API,
			HatarakuDb::API_TYPE_RECORD_REGIST,
			$recordRegistRequestBody
		);
		if ($result !== "200") {
			// 失敗したらメールで報告. ログ出力するべき.
			Mail::sendHatarakuDBImportError($result);
			return 'お申し込みに失敗しました。お手数ですがサポート窓口までお問い合わせください。';
		}
		return '';
	}
	/**
	 * メール送信
	 *
	 * @param array $data
	 * @return string エラー文字列、正常なら空文字.
	 */
	private static function sendMail(array $data): string
	{
		// 管理者へメール
		// TODO: 管理者メールは、エラーになっても処理しない. ログ出力するべき.
		Mail::sendApplication2Admin($_POST);
		// ユーザーへメール
		if (!Mail::sendApplication2User($_POST)) {
			// TODO: 文字列出すだけではなくて、管理者にメール送る処理とか入れたほうがいい. せめて、ログ出力するべき.
			return 'メール送信に失敗しました。お手数ですがサポート窓口までお問い合わせください。';
		}
		return '';
	}
}

// donutsCPが終わったら削除
function isCP() {
	session_start();
	date_default_timezone_set('Asia/Tokyo');
	$now = new DateTime();
	$endDateTime = new DateTime('2021/03/10 22:15:00');
	return $_SESSION['dunutsCp'] && ($now <= $endDateTime);
}

?>