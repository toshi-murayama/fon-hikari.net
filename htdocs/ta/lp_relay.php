<?php
$estimatedAmount = 0;
$installationPref = $_POST['installationPref'];
$hikariPhone = $_POST['hikariPhone'];
$fonHikariLine = $_POST['fonHikariLine'];
$remortSupport = $_POST['remortSupport'];
$hikariTVforNURO = $_POST['hikariTVforNURO'];
$collectivelyElectricity = $_POST['collectivelyElectricity'];

// 都道府県の例外処理 TODO:よくない書き方だと思うので、後に仕組みを修正した方がいい
if($installationPref == "東京" && strpos($installationPref,'都') === false){
    $installationPref += "都";
} else if($installationPref == "大阪" && strpos($installationPref,'府') === false){
    $installationPref += "府";
} else if($installationPref == "京都" && strpos($installationPref,'府') === false){
    $installationPref += "府";
} else if(strpos($installationPref,'県') === false){
    $installationPref += "県";
}

// Fon光提供エリア
$offerPrefectures = [
    '北海道',
    '東京都',
    '神奈川県',
    '埼玉県',
    '千葉県',
    '茨城県',
    '栃木県',
    '群馬県',
    '愛知県',
    '静岡県',
    '岐阜県',
    '三重県',
    '大阪府',
    '兵庫県',
    '京都府',
    '滋賀県',
    '奈良県',
    '福岡県',
    '佐賀県'
];

// 東日本
$easternJapan = [
    '北海道',
    '青森県',
    '秋田県',
    '岩手県',
    '宮城県',
    '福島県',
    '山形県',
    '新潟県',
    '栃木県',
    '茨城県',
    '群馬県',
    '埼玉県',
    '千葉県',
    '神奈川県',
    '東京都',
    '山梨県',
    '長野県'
];

// Fon光
if($fonHikariLine == "Fon光回線"){
    $fonHikariLine = 4378;
    $estimatedItem[] = "Fon光回線";
}

// Fon光エリア判定
if(in_array($installationPref,$offerPrefectures) !== false){
    $service_Area = "提供エリア";
    $areaType = "提供〇都道府県";
} else {
    $service_Area = "未提供エリア";
    $areaType = "提供外✖都道府県";
}

// ひかり電話
if($hikariPhone == "あり"){
    if(in_array($installationPref,$easternJapan) !== false){
        $hikariPhone = 550; // 東日本の料金
    } else {
        $hikariPhone = 330; // 西日本の料金
    }
    $estimatedItem[] = "ひかり電話";
}

// リモートサポート
if($remortSupport == "あり"){
    $remortSupport = 550;
    $estimatedItem[] = "リモートサポート";
}

// ひかりTV for NURO
if($hikariTVforNURO == "あり"){
    $hikariTVforNURO = 2750;
    $estimatedItem[] = "ひかりTV for NURO";
}

// まとめでんき
if($collectivelyElectricity == "あり"){
    $collectivelyElectricity = 500;
    $estimatedItem[] = "まとめでんき";
}

// 選択したオプションをモーダルに出力
foreach($estimatedItem as $value) { 
    $modalItem .= "<li> ". $value . "</li>";
}

// 簡単見積もり合計金額
// Fon光基本料金 + ひかり電話 + リモートサポート + ひかりTVforNURO - まとめでんき
$estimatedAmount = $fonHikariLine + $hikariPhone + $remortSupport + $hikariTVforNURO - $collectivelyElectricity;

if ($fonHikariLine) {
    if(in_array($installationPref,$offerPrefectures) !== false){
        // かんたん見積もり 提供エリアの場合
        $modal_text = '
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
    } else {
        // かんたん見積もり 未提供エリアの場合
        $modal_text = '
        <h3>エリア検索のご依頼ありがとうございます。</h3>
        <br>
        <p class="ModalBox">
            お客様のお住まいの地域はFon光の未提供エリアとなります。<br>
            <br>
            Fon光の提供が開始しましたら<br>
            担当コンシェルジュよりご連絡させて頂きます。
        </p>
        <br>
        <p class="modalTel">Fon光サポートセンター：<br class="sp">0120-966-486<span>(13:00-17:00土日祝除)</span></p>
        ';
    }
} else {
    if(in_array($installationPref,$offerPrefectures) !== false){
        // エリア検索 提供エリアの場合
        $modal_text = '
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
    } else {
        // エリア検索 未提供エリアの場合
        $modal_text = '
        <h3>エリア検索のご依頼ありがとうございます。</h3>
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
}

// モーダルウィンドウに結果を出力する
echo $modal_text;

require_once '../../lib/HatarakuDb.php';
require_once 'HatarakuDbInsert.php';

use Param\HatarakuDbInsert;

$error ='';

if(empty($error)) {
    //働くDBインポート.
    $data = HatarakuDbInsert::createData($_POST);

    // POSTされていない項目は$dateに格納
    $data['areaType'] = $areaType;
    $data['estimatedAmount'] = $estimatedAmount;

    $recordRegistRequestBody[] = HatarakuDbInsert::getApplicationApiParameter($data);
    // API送信実行
    $hatarakuDb = new HatarakuDb();
    $result = $hatarakuDb->sendRequest(
        HatarakuDb::URL_SINGLE_API,
        HatarakuDb::API_TYPE_RECORD_REGIST,
        $recordRegistRequestBody
    );
    // 失敗したらメールで報告($resultに200が入らなかった時)
	if ($result !== "200") {
		sendHatarakuDBErrorMail($result);
	} else {
        //文字指定
        mb_language("Japanese");
        mb_internal_encoding("UTF-8");

        //-----------------------------------------------------------
        // 管理者へメール
        //-----------------------------------------------------------
        $content = createApplicationUserMailContent($estimatedAmount); //合計金額は引数に
        $to = 'support@fon-hikari.net,scramask@gmail.com,s_kagaya@1onepiece.jp';
        $title = '【LP登録メール】';
        $headers ='Bcc: onepiecetakaie@gmail.com,onepiecedeguchi@gmail.com' . "\r\n";
        $send_mail = mb_send_mail($to, $title, $content, $headers, '-f support@fon-hikari.net');
    }
}

// TODO keyの変換は別のメソッドにするべき...
// 管理者用申込メール生成
function createApplicationUserMailContent($estimatedAmount) {
    $content = '';
    $content .= 'Fon光LPからのお申し込みがありました。'."\r\n";
    $content .= "\r\n";
    $content .= '【 氏名 】 ' . $_POST['name'] . "\r\n";
    $content .= '【 氏名(フリガナ) 】 ' . $_POST['nameKana'] . "\r\n";
    $content .= '【 郵便番号 】 ' . $_POST['postalCode'] . "\r\n";
    $content .= '【 電話番号 】 ' . $_POST['phoneNumber'] . "\r\n";
    $content .= '【 都道府県 】 ' . $_POST['installationPref'] . "\r\n";
    $content .= '【 以降の住所 】 ' . $_POST['address'] . "\r\n";
    $content .= '【 建物 】 ' . $_POST['buildingType'] . "\r\n";
    $content .= '【 建物名 】 ' . $_POST['buildingName'] . "\r\n";
    $content .= "\r\n";
    $content .= '下記以降は「かんたん見積もり」の情報です。'."\r\n";
    $content .= "\r\n";
    $content .= '【 回線 】 ' . $_POST['fonHikariLine'] . "\r\n";
    $content .= '【 ひかり電話 】 ' . $_POST['hikariPhone'] . "\r\n";
    $content .= '【 リモートサポート 】 ' . $_POST['remortSupport'] . "\r\n";
    $content .= '【 ひかりTV for NURO 】 ' . $_POST['hikariTVforNURO'] . "\r\n";
    $content .= '【 まとめでんき 】 ' . $_POST['collectivelyElectricity'] . "\r\n";
    $content .= '【 合計金額 】 ' . $estimatedAmount . '円' . "\r\n";
    $content .= "\r\n";
    $content .= '送信された日時：' . date( "Y/m/d (D) H:i:s" )."\r\n";
	$content .= '申込のページHOST：' . $_SERVER['HTTP_HOST']."\r\n";
	$content .= '申込のページURL：' . $_SERVER['REQUEST_URI']."\r\n";
    return $content;
}

/**
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

        $error_subject =  "Fon光管理者通知メール【重要】申込の働くDBインポート登録に失敗しました。";
        //  ← を追加.
        $to = mb_convert_encoding("support@fon-hikari.net,scramask@gmail.com", 'UTF-8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS');
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
?>