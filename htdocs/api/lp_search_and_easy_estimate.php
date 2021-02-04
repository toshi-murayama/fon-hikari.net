<?php
/**
 * lp_logic.php的なファイルを作成して、処理をまとめるべき.
 * $modal_text = はHTMLにModalを作成したほうがわかりやすいと思うが、一旦はこのまま.
 * validationがない
 */ 
require_once '../../lib/HatarakuDb.php';
require_once '../../lib/Param/HatarakuDbInsert.php';
require_once '../../lib/Param/Pref.php';
require_once '../../lib/Cost.php';
require_once '../../lib/API/SearchAreas.php';

$data = $_POST;
$installationPref = $data['installationPref'];

// 都道府県の例外処理 
/**
 * TODO:よくない書き方だと思うので、後に仕組みを修正した方がいい
 *      入力側でテキストではなく、セレクトにするなどの処理をするべき
 *      テキストで入力しているなら、各都道府県と一致するか判定しないと、判定が足りない.
 */
if($installationPref == "東京" && strpos($installationPref,'都') === false){
    $installationPref += "都";
} else if($installationPref == "大阪" && strpos($installationPref,'府') === false){
    $installationPref += "府";
} else if($installationPref == "京都" && strpos($installationPref,'府') === false){
    $installationPref += "府";
} else if(strpos($installationPref,'県') === false){
    $installationPref += "県";
}

// Fon光提供エリア判定
$searchAreas = new SearchAreas();
$provitedFlag = in_array($installationPref, $searchAreas->getPrefList());

$modal_text = '';
$areaType = '';
$estimatedAmount = 0;
// 値が入っていれば true.
$optionFlags = [
    'fonHikariLineFlag' => !is_null($data['fonHikariLine']),
    'hikariPhoneFlag' => !is_null($data['hikariPhone']),
    'remortSupportFlag' => !is_null($data['remortSupport']),
    'hikariTVforNUROFlag' => !is_null($data['hikariTVforNURO']),
    'collectivelyElectricityFlag' => !is_null($data['collectivelyElectricity']),
];
$areaTypes = [
    'provited' => '提供〇都道府県',
    'notProvited' => '提供外✖都道府県',
];
$easyEstimateFlag = $optionFlags['fonHikariLineFlag'];

if (!$provitedFlag && !$easyEstimateFlag) {
    // エリア検索（提供外エリア）
    $areaType = $areaTypes['notProvited'];
    $modal_text = showSearchAreaModalByNotProvide('エリア検索のご依頼ありがとうございます。');
} else if ($provitedFlag && !$easyEstimateFlag) {
    // エリア検索（提供中エリア）
    $areaType = $areaTypes['provited'];
    $modal_text = showSearchAreaModalByProvide();
} else if(!$provitedFlag && $easyEstimateFlag) {
    // かんたん見積り（提供外エリア）
    $areaType = $areaTypes['notProvited'];
    $modal_text = showSearchAreaModalByNotProvide('簡単見積りのご依頼ありがとうございます。');
} else if($provitedFlag && $easyEstimateFlag) {
    // かんたん見積り（提供中エリア）
    $areaType = $areaTypes['provited'];
    // 価格、モーダルに出力する文字列を設定
    $results = getEstimatesAndModalList($optionFlags, $installationPref);
    $estimatedAmount += $results['estimates'];
    // モーダルに出力するリストを生成
    foreach($results['items'] as $value) { 
        $modalItem .= "<li> ". $value . "</li>";
    }
    $modal_text = showEasyEstimateModalByProvide($modalItem, $estimatedAmount);
}
// モーダルに結果を出力する
echo $modal_text;

//-----------------------------------------------------------
//働くDBインポート.
//-----------------------------------------------------------
use Param\HatarakuDbInsert;

$data['areaType'] = $areaType;
$data['estimatedAmount'] = $estimatedAmount;
$importData = HatarakuDbInsert::createDataByLp($data);

$recordRegistRequestBody[] = HatarakuDbInsert::getLpApiParameter(HatarakuDbInsert::createDataByLp($importData));
// API送信実行
$hatarakuDb = new HatarakuDb();
$result = $hatarakuDb->sendRequest(
    HatarakuDb::URL_SINGLE_API,
    HatarakuDb::API_TYPE_RECORD_REGIST,
    $recordRegistRequestBody
);
// $result = "200";
if ($result !== "200") {
    // 管理者宛にメールを送信するだけで、ユーザーに対してはアクションしない. 
    sendHatarakuDBErrorMail($result);
    return;
}
//文字指定
mb_language("Japanese");
mb_internal_encoding("UTF-8");

//-----------------------------------------------------------
// 管理者へメール
//-----------------------------------------------------------
$title = '【LP登録メール】 ';
if ($easyEstimateFlag) {
    $title .= '見積もり';
} else {
    $title .= 'エリア判定';
}

$content = createApplicationUserMailContent($estimatedAmount, $provitedFlag, $easyEstimateFlag, $data);
// $to = 'support@fon-hikari.net,scramask@gmail.com,s_kagaya@1onepiece.jp';
$to = 'onepiecetakaie@gmail.com';
// $headers ='Bcc: onepiecedeguchi@gmail.com' . "\r\n";
$headers = '';
// $headers .='Bcc: onepiecetakaie@gmail.com' . "\r\n";
$headers ='From: support@fon-hikari.net' . "\r\n";
mb_send_mail($to, $title, $content, $headers, '-f support@fon-hikari.net');

/**
 * TODO: メールclassを作成するべき.
 * 管理者用申込メール生成
 * @param int $estimatedAmount
 * @param bool $provitedFlag
 * @param bool $easyEstimateFlag
 * @param array $data
 * @return string
 */
function createApplicationUserMailContent(int $estimatedAmount, bool $provitedFlag, bool $easyEstimateFlag, array $data): string {
    $content = 'Fon光LPからのお申し込みがありました。'. "\r\n";
    $content .= "\r\n";
    $content .= '【 エリア判定 】 '. "\t" ;
    if ($provitedFlag) {
        $content .= '提供対象';
    } else {
        $content .= '未提供';
    }
    $content .= "\r\n";
    $content .= '【 氏名 】 '. "\t\t" . $data['name'] . "\r\n";
    $content .= '【 氏名(フリガナ) 】 '. "\t" . $data['nameKana'] . "\r\n";
    $content .= '【 郵便番号 】 '. "\t\t" . $data['postalCode'] . "\r\n";
    $content .= '【 電話番号 】 '. "\t\t" . $data['phoneNumber'] . "\r\n";
    $content .= '【 都道府県 】 '. "\t\t" . $data['installationPref'] . "\r\n";
    $content .= '【 住所 】 '. "\t\t" . $data['address'] . "\r\n";
    $content .= '【 建物 】 '. "\t\t" . $data['buildingType'] . "\r\n";
    $content .= '【 建物名 】 '. "\t\t" . $data['buildingName'] . "\r\n";
    $content .= "\r\n";
    if ($easyEstimateFlag) {
        $content .= '下記以降は「かんたん見積もり」の情報です。'."\r\n";
        $content .= "\r\n";
        $content .= '【 回線 】 '. "\t\t" . $data['fonHikariLine'] . "\r\n";
        $content .= '【 ひかり電話 】 '. "\t" . $data['hikariPhone'] . "\r\n";
        $content .= '【 リモートサポート 】 '. "\t" . $data['remortSupport'] . "\r\n";
        $content .= '【 ひかりTV for NURO 】 ' . $data['hikariTVforNURO'] . "\r\n";
        $content .= '【 まとめでんき 】 '. "\t" . $data['collectivelyElectricity'] . "\r\n";
        $content .= '【 合計金額 】 '. "\t\t" . number_format($estimatedAmount) . '円' . "\r\n";
        $content .= "\r\n"; 
    }
    $content .= '送信日時：' . date( "Y/m/d (D) H:i:s" )."\r\n";

    return $content;
}
/**
 * TODO: 重複メソッド 共通化できていない. + 開発者全員にメールするべき.
 * 働くDBのインポートエラーメッセージ送信
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

    $error_subject =  "Fon光管理者通知メール【重要】Fon光LPリストの働くDBインポート登録に失敗しました。";
    $to = mb_convert_encoding("onepiecetakaie@gmail.com", 'UTF-8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS');
    $subject = mb_convert_encoding($error_subject, 'UTF-8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS');
    $text = mb_convert_encoding($error_mail, 'UTF-8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS');
    $org = mb_convert_encoding("フォン・ジャパン株式会社", 'UTF-8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS');

    $head = '';
    $head .= "Content-Type: text/plain \r\n";
    $head .= "Organization: $org \r\n";
    $head .= "X-Priority: 3 \r\n";

    //管理者宛にメール送信
    mb_send_mail($to, $subject, $text, $head, '-f support@fon-hikari.net');
}
/**
 * 未提供エリアModal表示.
 * class化するときは使用しない（HTMLにModalを書いたほうがいい）
 * 以下の、Modalメソッドも同様.
 * 
 * @return string
 */
function showSearchAreaModalByNotProvide(string $message): string
{
    return '
    <h3>'. $message . '</h3>
    <br>
    <p class="modalBox">
        お客様のお住まいの地域はFon光の未提供エリアとなります。<br>
        <br>
        Fon光の提供が開始しましたら<br>
        担当コンシェルジュよりご連絡させて頂きます。
    </p>
    <br>
    <p class="modalTel">Fon光サポートセンター：<br class="sp">0120-966-486<span>(13:00-17:00土日祝除)</span></p>
    ';
}
/**
 * 提供エリアModal表示.
 * 
 * @return string
 */
function showSearchAreaModalByProvide(): string
{
    return '
    <h3>エリア検索のご依頼ありがとうございます。</h3>
    <br>
    <p class="modalBox">
        お客様のお住まいの地域はFon光の提供エリアとなります。<br>
        <br>
        一部の地域は未提供エリアもございますので、<br>
        担当コンシェルジュよりご連絡させて頂きます。
    </p>
    <br>
    <p class="modalTel">Fon光サポートセンター：<br class="sp">0120-966-486<span>(13:00-17:00土日祝除)</span></p>
    ';
}
/**
 * かんたん見積もりModal表示.
 *
 * @param string $modalItem
 * @param int $estimatedAmount
 * @return string
 */
function showEasyEstimateModalByProvide(string $modalItem, int $estimatedAmount): string
{
    return '
    <div class="modalItem">
        <ul>
            '.$modalItem.'
        </ul>
        <p>=</p>
        <h3>¥'.$estimatedAmount.'</h3>
    </div>
    <div class="estimatedModalBox">
        <p>
            ※ひかりTVはおすすめプラン。<br>
            ※まとめてでんきの電気代は別。
        </p>
    </div>
    <br>
    <p class="ModalBox">
        より詳しい内容を担当コンシェルジュよりご連絡させて頂きます。
    </p>
    <br>
    <p class="modalTel">Fon光サポートセンター：<br class="sp">0120-966-486<span>(13:00-17:00土日祝除)</span></p>
    ';
}
/**
 * オプション設定.
 *
 * @param array $optionFlags
 * @param string $pref
 * @return array
 */
function getEstimatesAndModalList(array $optionFlags, string $pref): array
{   
    $estimates = 0;
    $items = [];
    $cost = new Cost();
    
    // FON光回線. 
    $estimates += $cost->getHikariLineCost();
    $items[] = "Fon光回線";
    // ひかり電話
    if($optionFlags['hikariPhoneFlag']) {
        if(in_array($pref, Pref::PROVIDE_BY_EAST_JAPAN)) {
            $estimates += $cost->getHikariPhoneEastCost();
        } else {
            $estimates += $cost->getHikariPhoneWestCost();
        }
        $items[] = "ひかり電話";
    }
    // リモートサポート
    if($optionFlags['remortSupportFlag']) {
        $estimates += $cost->getRemoteSuportCost();
        $items[] = "リモートサポート";
    }
    // ひかりTV for NURO
    if($optionFlags['hikariTVforNUROFlag']) {
        $estimates += $cost->getHikariTVCost();
        $items[] = "ひかりTV for NURO";
    }
    // まとめでんき
    if($optionFlags['collectivelyElectricityFlag']) {
        // 割引
        $estimates += $cost->getCollectiveryEletricityDiscountCost();
        $items[] = "まとめでんき";
    }
    return [
        'estimates' => $estimates,
        'items' => $items,
    ];
}
?>