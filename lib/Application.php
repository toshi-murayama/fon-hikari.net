<?php
/**
 * 申込時に行う処理を集約.
 * TODO: リファクタリング対象.
 * */

require_once '../lib/HatarakuDb.php';
require_once '../lib/Param/HatarakuDbInsert.php';
require_once '../lib/Common.php';
require_once '../lib/Mail.php';
require_once '../vendor/autoload.php';
require_once '../config.php';

use Param\HatarakuDbInsert;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;

$libApplicationLogger = new Logger('lib/Application.php');
$libApplicationLogger->pushHandler(new RotatingFileHandler($GLOBALS['DEBUG_LOG_DIR']. 'debug.log' , 5 ,
                                                           $GLOBALS['DEBUG_LOG_LEVEL']) );
$libApplicationLogger->debug('==== START ====');

class Service {
	/**
	 * 登録処理実行
	 *
	 * @return string エラー文字列、正常なら空文字.
	 */
	static public function exec(): string {
        global $libApplicationLogger;
        $libApplicationLogger->debug('START exec()');
        $libApplicationLogger->debug('$_POST : '. var_export($_POST, true ) );

		$ref = $_SERVER['HTTP_REFERER'];
		if ((isset($_POST['confirmationSubmitFlag']) && $_POST['confirmationSubmitFlag'] != 1) || !strpos($ref,'confirmation')) {
			unset($_SESSION['tk']);
            $libApplicationLogger->debug('END exec() A');
			return '不正な値が送信されました。';
		}
		session_start();
		// 2重送信確認
		if ($_SESSION['tk'] != $_POST['tk'] || empty($_SESSION['tk'])) {
			unset($_SESSION['tk']);
            $libApplicationLogger->debug('END exec() B');
			return '不正な値が送信されました。';
		}

		// ここまで来たら、トークン削除.
		unset($_SESSION['tk']);
		// POSTに入れるべきではないが、、、既存のソースに手を加えたくないので、、
		$_POST['isCp'] = isCP();

		// 働くDBインポート
		$error = self::AddHatarakuDb($_POST);
		if (!empty($error)) {
            $libApplicationLogger->error('DB Error');
            $libApplicationLogger->debug('END exec() C');
			return $error;
		}
		// メール送信
        $ret = self::sendMail($_POST);
        $libApplicationLogger->debug('END exec() D');
		return $ret;
	}

	/**
	 * 働くDBに登録.
	 *
	 * @param array $data
	 * @return string エラー文字列、正常なら空文字.
	 */
	private static function AddHatarakuDb(array $data): string {
        global $libApplicationLogger;
        $libApplicationLogger->debug('START AddHatarakuDb()');
		// ポストの値から、働くDBの値を生成.
		$insertData = HatarakuDbInsert::createData($data);
        $libApplicationLogger->debug('$insertData : ' . var_export($insertData, true) );

		$recordRegistRequestBody[] = HatarakuDbInsert::getApplicationApiParameter($insertData);
        $libApplicationLogger->debug('$recordRegistRequestBody : '
                                     . var_export($recordRegistRequestBody, true) );

		// API送信実行
		$hatarakuDb = new HatarakuDb();
		$result = $hatarakuDb->sendRequest(
			HatarakuDb::URL_SINGLE_API,
			HatarakuDb::API_TYPE_RECORD_REGIST,
			$recordRegistRequestBody
		);

        $libApplicationLogger->debug('$result : '. var_export($result, true) );
		if ($result !== "200") {
			// 失敗したらメールで報告. ログ出力するべき.
			Mail::sendHatarakuDBImportError($result);
            $libApplicationLogger->debug('END AddHatarakuDb() A');
			return 'お申し込みに失敗しました。お手数ですがサポート窓口までお問い合わせください。';
		}

        $libApplicationLogger->debug('END AddHatarakuDb() B');
		return '';
	}

	/**
	 * メール送信
	 *
	 * @param array $data
	 * @return string エラー文字列、正常なら空文字.
	 */
	private static function sendMail(array $data): string {
        global $libApplicationLogger;
        $libApplicationLogger->debug('START sendMail()');
		// 管理者へメール
		// TODO: 管理者メールは、エラーになっても処理しない. ログ出力するべき.
		Mail::sendApplication2Admin($_POST);
		// ユーザーへメール
		if (!Mail::sendApplication2User($_POST)) {
			// TODO: 文字列出すだけではなくて、管理者にメール送る処理とか入れたほうがいい. せめて、ログ出力するべき.
            $libApplicationLogger->error('can not send mail to user');
            $libApplicationLogger->debug('EXIT sendMail() A');
			return 'メール送信に失敗しました。お手数ですがサポート窓口までお問い合わせください。';
		}
        $libApplicationLogger->debug('EXIT sendMail() B');
		return '';
	}
}

// donutsCPが終わったら削除
function isCP() {
    global $libApplicationLogger;
    $libApplicationLogger->debug('START isCP()');

	session_start();
	date_default_timezone_set('Asia/Tokyo');
	$now = new DateTime();
	$endDateTime = new DateTime('2021/03/10 22:15:00');
    $ret = $_SESSION['dunutsCp'] && ($now <= $endDateTime);

    $libApplicationLogger->debug('END isCP()');
	return $ret;
}

?>
