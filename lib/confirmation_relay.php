<?php
	require_once(__DIR__ . '/Cost.php');
    require_once(__DIR__ . '/Common.php');

// TODO 本当はクラス化したいが、、、時間のあるときにリファクタリング.

// 正常にページ推移したか確認(正しくなかったらtopに戻る)
$ref = $_SERVER['HTTP_REFERER'];
if ((isset($_POST['applicationSubmitFlag']) && $_POST['applicationSubmitFlag'] != 1) || strpos($ref,'application') === false) {
    header( "Location: / " );
}

// application→confirmationの処理
session_start();

// トークンをセッションにセット
$token = sha1(uniqid(mt_rand(), true));
$_SESSION['tk'] = $token;

// TODO: structにする
$applicationClassification = h($_POST['applicationClassification']);
$lastName = h($_POST['lastName']);
$lastNameKana = h($_POST['lastNameKana']);
$firstName = h($_POST['firstName']);
$firstNameKana = h($_POST['firstNameKana']);
$sex = h($_POST['sex']);
$birthday = h($_POST['birthday']);
$phoneNumber = h($_POST['phoneNumber']);
$fixedLine = h($_POST['fixedLine']);
$mailAddress = h($_POST['mailAddress']);
$postalCode = h($_POST['postalCode']);
$installationPref = h($_POST['installationPref']);
$installationMunicipalities = h($_POST['installationMunicipalities']);
$installationTown = h($_POST['installationTown']);
$installationAddress = h($_POST['installationAddress']);
$installationBuilding = h($_POST['installationBuilding']);
$ownership = h($_POST['ownership']);
$mailingDestination = h($_POST['mailingDestination']);
$mailingPostalCode = h($_POST['mailingPostalCode']);
$mailingPrefName = h($_POST['mailingPrefName']);
$mailingMunicipalities = h($_POST['mailingMunicipalities']);
$mailingTown = h($_POST['mailingTown']);
$mailingAddress = h($_POST['mailingAddress']);
$mailingBuilding = h($_POST['mailingBuilding']);
$telephoneApplication = h($_POST['telephoneApplication']);
$homeType = h($_POST['homeType']);
$numberingMethod = h($_POST['numberingMethod']);
$remortSupport = h($_POST['remortSupport']);
$collectivelyElectricity = h($_POST['collectivelyElectricity']);
$hikariTV = h($_POST['hikariTV']);
$kasperskySecurity = h($_POST['kasperskySecurity']);
$construction = h($_POST['construction']);
$couponCode = h($_POST['couponCode']);

$cloudBackup = h($_POST['cloudBackup']);

// 性別表示
if($sex == '1') {
    $sexString = '男性';
} else {
    $sexString = '女性';
}

// 物件種類表示
if ($homeType == '1') {
    $homeTypeString = '一軒家';
} else if ($homeType == '2') {
    $homeTypeString = 'マンション（3F以下）';
} else {
    $homeTypeString = 'マンション（4F以上）';
}

// 所有携帯表示
if ($ownership == '1') {
    $ownershipString = '賃貸';
} else if ($ownership == '2') {
    $ownershipString = '分譲';
} else if ($ownership == '3'){
    $ownershipString = '分譲賃貸';
} else {
    $ownershipString = '持ち家';
}

// 光電話申込表示
if ($telephoneApplication == '0') {
    $telephoneApplicationString = 'なし';
} else {
    $telephoneApplicationString = 'NURO光でんわ';
}

// 発番方法表示
if ($telephoneApplication == '1' && $numberingMethod == '0') {
    $numberingMethodString = '新規発番';
} else if ($telephoneApplication == '1' && $numberingMethod == '1') {
    $numberingMethodString = '現在使用中の電話番号を継続して使用';
}

// 入会書類郵送希望先表示
if($mailingDestination == '0') {
    $mailingDestinationString = '設置場所と同じ';
} else {
    $mailingDestinationString = '別住所に送る';
}

// リモートサポート
if($remortSupport == '0') {
    $remortSupportString = 'なし';
} else {
    $remortSupportString = 'あり';
}

// まとめてでんき
if($collectivelyElectricity == '0') {
    $collectivelyElectricityString = 'なし';
} else {
    $collectivelyElectricityString = 'あり';
}

// ひかりTV
if($hikariTV == '0') {
    $hikariTVString = 'なし';
} else {
    $hikariTVString = 'あり';
    // ひかりTVプラン
    $hikariTvPlan = h($_POST['hikariTvPlan']);
    // ひかりTV一契約目申込（無:0/有:1）
    $hikariTvPlanApplication = 1;
    // ひかりTV一契約目チューナーレンタル（無:0/有:1）
    $hikariTvPlanTuner = 1;
    $hikariTvPlanString = getHikariTVString($hikariTvPlan);
}

// カスペルスキーセキュリティ
if($kasperskySecurity == '0') {
    $kasperskySecurityString = 'なし';
} else {
    $kasperskySecurityString = 'あり';
}

// 希望工事日(インポート項目名：業務備考）
if($construction == '0') {
    $construction = 'いつでも可能';
} else if ($construction == '1') {
    $construction = h($_POST['constructionWeek']);
} else if ($construction == '2') {
    $construction =
    "第一希望： " . h($_POST['constructionPreferred1']) . "(" . h($_POST['constructionDay1']) . ")" . "\n" .
    "第二希望： " . h($_POST['constructionPreferred2']) . "(" . h($_POST['constructionDay2']) . ")";
}

// アフィリエイトID
$affiOrderNumber = md5(uniqid(rand(), true)) . date('YmdHis');

// アフィリエイトIDをセッションで受け渡し
$_SESSION['affiOrderNumber'] = $affiOrderNumber;

// TODO: validation リリース後に実装をする. 今は一時的なもの...
if (!preg_match("/^[ァ-ヶー]+$/u", $lastNameKana)) {
	$error = '<p class="error">フリガナ（セイ）が半角カタカナではありません</p>';
}

if (!preg_match("/^[ァ-ヶー]+$/u", $firstNameKana)) {
	$error .= '<p class="error">フリガナ（名）が半角カタカナではありません</p>';
}

$postalCodeLen = mb_strlen($postalCode);
if (!preg_match("/^[0-9]+$/",$postalCode) || $postalCodeLen != 7) {
	$error .= '<p class="error">郵便番号を半角数字7桁で入力してください</p>';
}

if(!preg_match("/^[0-9]+$/",$phoneNumber)) {
	$error .= '<p class="error">携帯番号を半角数字で入力してください</p>';
}

if (!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $mailAddress)) {
	$error .= '<p class="error">メールアドレスを正しい形で入力してください</p>';
}

// TODO: メソッドする + 今は常に表示している項目しかチェックしていない. (画面のみ)
check_empty($lastName,'氏名（姓）');
check_empty($lastNameKana,'フリガナ（セイ）');
check_empty($firstName,'氏名（名）');
check_empty($firstNameKana,'フリガナ（メイ）');
check_empty($sex,'性別');
check_empty($birthday,'生年月日');
check_empty($phoneNumber,'携帯番号');
check_empty($mailAddress,'メールアドレス');
check_empty($postalCode,'郵便番号');
check_empty($installationPref,'都道府県');
check_empty($installationMunicipalities,'市区町村');
check_empty($installationTown,'町名・丁目');
check_empty($installationAddress,'番地・号');

/* 必須チェック
　第一引数：対象文字列、第2引数：エラー表示名 */
function check_empty($target,$target_name){
	global $error;
	if (empty($target)) {
		$error .= '<p class="error">' . $target_name . 'を入力してください</p>';
	}
}

function getHikariTVString($hikariTvPlan) {
    $cost = new Cost();
    $hikariTvPlanString = '';
    switch($hikariTvPlan) {
        case $hikariTvPlan == '01':
            $hikariTvPlanString = '基本料金プラン 月額' . number_format($cost->getHikariTVBasicCost()) . '円(税込)';
            break;
        case $hikariTvPlan == '02':
            $hikariTvPlanString = 'お値うちプラン 月額' . number_format($cost->getHikariTVValueOfMoneyCost()) . '円(税込)';
            break;
        case $hikariTvPlan == '03':
            $hikariTvPlanString = 'テレビおすすめプラン 月額' . number_format($cost->getHikariTVRecommendCost()) . '円(税込)';
            break;
        case $hikariTvPlan == '04':
            $hikariTvPlanString = 'ビデオざんまいプラン 月額' . number_format($cost->getHikariTVVideoZammaiCost()) . '円(税込)';
            break;
        case $hikariTvPlan == '05':
            $hikariTvPlanString = 'お値うちプラン(2ねん割) 月額' . number_format($cost->getHikariTVValueOfMoney2YearCost()) . '円(税込)';
            break;
        case $hikariTvPlan == '06':
            $hikariTvPlanString = 'テレビおすすめプラン(2ねん割) 月額' . number_format($cost->getHikariTVRecommend2YearCost()) . '円(税込)';
            break;
        case $hikariTvPlan == '07':
            $hikariTvPlanString = 'ビデオざんまいプラン(2ねん割) 月額' . number_format($cost->getHikariTVVideoZammai2YearCost()) . '円(税込)';
            break;
    }
    return $hikariTvPlanString;
}

?>
