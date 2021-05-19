<?php

require_once(__DIR__ . '/Common.php');
require_once(__DIR__ . '/Cost.php');
require_once(__DIR__ . '/Param/Pref.php');

/**
 * メールに関するClass
 *
 */
class Mail
{
    /** 改行 */
    private const LINE = "\r\n";
    /** 申込管理者タイトル */
    private const APPLICATION_ADMIN_TITLE = '【fon光申込】';
    /** 申込ユーザータイトル */
    private const APPLICATION_USER_TITLE = '《Fon光》お申し込み確認メール';
    /** 申込本文（管理者）で使用する、データ変換用の配列. */
    private const APPLICATIOIN_CLASSIFICATION = ['0' => '個人', '1' => '法人'];
    private const SEX = ['0' => '女性', '1' => '男性'];
    private const OWNERSHIP = ['1' => '賃貸', '2' => '分譲', '3' => '分譲賃貸', '4' => '持ち家'];
    private const MAILING_DESTONATION = ['0' => '設置場所に同じ', '1' => '別住所'];
    private const ON_OR_OFF = ['0' => 'なし', '1' => 'あり'];
    private const HOME_TYPES = ['1' => '一戸建', '2' => 'マンション3F以下', '3' => 'マンション4F以上'];
    private const NUMBERING_METHOD = ['0' => '新規', '1' => '番ポ'];

    /**
     * 申込（管理者）
     *  TODO: 定義してあったものを使いまわしているので、リファクタリングが必要
     *
     * @param array $data
     * @return void
     */
    static public function sendApplication2Admin(array $data)
    {
        //文字指定
        mb_language("Japanese");
        mb_internal_encoding("UTF-8");

        $headers ='';
        if(isProd()) {
            $to = 'support@fon-hikari.net,fononepiecetest@gmail.com';
            $headers ='Bcc: onepiecetakaie@gmail.com' . "\r\n";
        } else {
            $to = self::getStgToAddress();
        }
        return mb_send_mail(
            $to,
            self::APPLICATION_ADMIN_TITLE,
            self::createApplicationAdminContent($data),
            $headers,
            '-f support@fon-hikari.net'
        );
    }
    /**
     * 申込（ユーザー）
     *  TODO: 定義してあったものを使いまわしているので、リファクタリングが必要
     *
     * @param array $data
     * @return void
     */
    static public function sendApplication2User(array $data)
    {
        //文字指定
        mb_language("Japanese");
        mb_internal_encoding("UTF-8");
        $to = $data['mailAddress'];
        $headers ='';
        if(isProd()) {
            $headers  = "From: support@fon-hikari.net\r\n";
            $headers .='Bcc: onepiecetakaie@gmail.com,fononepiecetest@gmail.com' . "\r\n";
        }
        return mb_send_mail(
            $to,
            self::APPLICATION_USER_TITLE,
            self::createApplicationUserContent($data),
            $headers,
            '-f support@fon-hikari.net'
        );
    }
    /**
     * STG用送信先取得
     *
     * @return string
     */
    static private function getStgToAddress(): string
    {
        // NOTE: STGで試験する場合は、自分のmailを設定する.
        return 'onepiecetakaie@gmail.com, onepiecetomisaki@gmail.com';
    }
    /**
     * 申込本文（管理者）
     * TODO: 定義してあったメソッドを持ってきただけなので、リファクタリングが必要
     *       メソッドが長すぎるので、swithをなんとかしたいが、、
     *
     * @param array $data ポストデータ
     * @return string
     */
    static private function createApplicationAdminContent(array $data): string
    {
        $content = '';
        foreach($data as $k => $v) {

            if ($k == 'submit') continue;
            if ($k == 'tk') continue;
            if ($k == 'confirmationSubmitFlag') continue;
            if (empty($v)) continue;

            switch($k) {
                case 'applicationClassification' :
                    $content .= '【 申込区分 】 ' . self::APPLICATIOIN_CLASSIFICATION[$v] . self::LINE;
                break;
                case 'lastName' :
                    $content .= '【 氏名（姓） 】 ' . $v . self::LINE;
                break;
                case 'firstName' :
                    $content .= '【 氏名（名） 】 ' . $v . self::LINE;
                break;
                case 'lastNameKana' :
                    $content .= '【 フリガナ（セイ） 】 ' . $v . self::LINE;
                break;
                case 'firstNameKana' :
                    $content .= '【 フリガナ（メイ） 】 ' . $v . self::LINE;
                break;
                case 'sex' :
                    $content .= '【 性別 】 ' . self::SEX[$v] . self::LINE;
                break;
                case 'birthday' :
                    $content .= '【 生年月日 】 ' . $v . self::LINE;
                break;
                case 'phoneNumber' :
                    $content .= '【 携帯番号 】 ' . $v . self::LINE;
                break;
                case 'fixedLine' :
                    $content .= '【 固定電話番号 】 ' . $v . self::LINE;
                break;
                case 'mailAddress' :
                    $content .= '【 メールアドレス 】 ' . $v . self::LINE;
                break;
                case 'postalCode' :
                    $content .= '【 郵便番号 】 ' . $v . self::LINE;
                break;
                case 'installationPref' :
                    $content .= '【 都道府県 】 ' . $v . self::LINE;
                break;
                case 'installationMunicipalities' :
                    $content .= '【 市区町村 】 ' . $v . self::LINE;
                break;
                case 'installationTown' :
                    $content .= '【 町名・丁目 】 ' . $v . self::LINE;
                break;
                case 'installationAddress' :
                    $content .= '【 番地・号 】 ' . $v . self::LINE;
                break;
                case 'installationBuilding' :
                    $content .= '【 建物名・部屋番号 】 ' . $v . self::LINE;
                break;
                case 'ownership' :
                    $content .= '【 所有携帯 】 ' . self::OWNERSHIP[$v] . self::LINE;
                break;
                case 'mailingDestination' :
                    $content .= '【 入会書類郵送希望先 】 ' . self::MAILING_DESTONATION[$v] . self::LINE;
                break;
                case 'mailingPostalCode' :
                    $content .= '【 郵送先郵便番号 】 ' . $v . self::LINE;
                break;
                case 'mailingPrefName' :
                    $content .= '【 郵送先都道府県 】 ' . $v . self::LINE;
                break;
                case 'mailingMunicipalities' :
                    $content .= '【 郵送先市区町村 】 ' . $v . self::LINE;
                break;
                case 'mailingTown' :
                    $content .= '【 郵送先町名・丁目 】 ' . $v . self::LINE;
                break;
                case 'mailingAddress' :
                    $content .= '【 郵送先番地・号 】 ' . $v . self::LINE;
                break;
                case 'mailingBuilding' :
                    $content .= '【 郵送先建物名・部屋番号 】 ' . $v . self::LINE;
                break;
                case 'telephoneApplication' :
                    $content .= '【 ひかり電話申込 】 ' . self::ON_OR_OFF[$v] . self::LINE;
                break;
                case 'homeType' :
                    $content .= '【 物件種類 】 ' . self::HOME_TYPES[$v] . self::LINE;
                break;
                case 'numberingMethod' :
                    $content .= '【 電話番号種類 】 ' .self::NUMBERING_METHOD[$v] . self::LINE;
                break;
                case 'remortSupport' :
                    $content .= '【 リモートサポート 】 ' . self::ON_OR_OFF[$v] . self::LINE;
                break;
                case 'affiOrderNumber' :
                    $content .= '【 アフィリエイトID 】 ' . $v . self::LINE;
                break;
                case 'collectivelyElectricity' :
                    $content .= '【 まとめてでんき 】 ' . self::ON_OR_OFF[$v] . self::LINE;
                break;
                case 'hikariTV' :
                    $content .= '【 ひかりTV for NURO申込 】 ' . self::ON_OR_OFF[$v] . self::LINE;
                break;
                case 'hikariTvPlan' :
                    $content .= '【 ひかりTVプラン 対応番号 】 ' . $v . self::LINE;
                break;
                case 'hikariTvPlanString' :
                    $content .= '【 ひかりTVプラン 】 ' . $v . self::LINE;
                break;
                case 'hikariTvPlanApplication' :
                    $content .= '【 ひかりTV一契約目申込 】 ' . $v . self::LINE;
                break;
                case 'hikariTvPlanTuner' :
                    $content .= '【 ひかりTV一契約目チューナーレンタル 】 ' . $v . self::LINE;
                break;
                case 'kasperskySecurity' :
                    $content .= '【 カスペルスキーセキュリティー 】 ' . self::ON_OR_OFF[$v] . self::LINE;
                break;
                case 'construction' :
                    $content .= '【 業務備考 】 ' . $v . self::LINE;
                break;
                default :
                $content .= '【 '. $k . ' 】 ' . $v . self::LINE;
            }
        }

        if($data['isCp']) {
            $content .= '【 CP 】 ドーナツCP' . self::LINE;
        }

        $content .= self::LINE;
        $content .= '送信された日時：' . date( "Y/m/d (D) H:i:s" ) . self::LINE;
        $content .= '申込のページHOST：' . $_SERVER['HTTP_HOST'] . self::LINE;
        $content .= '申込のページURL：' . $_SERVER['REQUEST_URI'] . self::LINE;
        return $content;
    }
    /**
     * 申込本文（ユーザー）
     * TODO: 定義してあったメソッドを持ってきただけなので、リファクタリングが必要
     *
     * @param array $data ポストデータ
     * @return string
     */
    static private function createApplicationUserContent(array $data): string
    {
        $cost = new Cost();

        $content = '';
        $content .= 'この度はFon光のお申込みありがとうございます。' . self::LINE;
        $content .= 'お客様のお申し込みを下記内容で承りました。' . self::LINE;
        $content .= '情報に問題がなければこのままお手続きを進めさせていただきます。' . self::LINE;
        $content .= '━━━━━━━━━━━━━━━━━━━━━━━━━━━' . self::LINE;
        $content .= '◆ お申し込み内容' . self::LINE;
        $content .= '───────────────────────────' . self::LINE;
        $content .= '《お申込み日時》' . self::LINE;
        $content .= date( "Y/m/d (D) H:i:s" ) . self::LINE;
        $content .= '【Fon光】' . self::LINE;
        $content .= '《契約期間》' . self::LINE;
        $content .= '24か月（自動更新）' . self::LINE;
        $content .= '《Fon光月額利用料》' . self::LINE;
        $content .= '月額：' . $cost->getFee4MailContent($cost->getHikariLineCost()) . self::LINE;
        if($data['isCp']) {
            $content .= '※開通から6カ月間は月額0円' . self::LINE;
            $content .= '《工事費：無料》' . self::LINE;
            $content .= '0円' . self::LINE;
            $content .= '※ 半年間で解約される場合も請求されません。' . self::LINE;
            $content .= '《契約事務手数料》' . self::LINE;
            $content .= '0円' . self::LINE;
        } else {
            $content .= '《工事費：分割》' . self::LINE;
            $content .= '44,000 円（税込）（1,467 円（税込） X 30 か月の分割払い）' . self::LINE;
            $content .= '※ 工事費割引1,467 円（税込） X 30 か月割引が適用されますので、実質無料となります。' . self::LINE;
            $content .= '《契約事務手数料》' . self::LINE;
            $content .= $cost->getFee4MailContent($cost->getAdminFee()) . self::LINE;
        }

        $content .= '【付加サービス】' . self::LINE;
        $content .= '《NURO光でんわ申込》' . self::LINE;
        if($data['telephoneApplication'] == '0') {
            $content .= 'なし' . self::LINE;
        } else {
            $content .= 'あり' . self::LINE;
            $content .= '《NURO光でんわ基本料金》' . self::LINE;
            if(in_array($data['installationPref'], Pref::PROVIDE_BY_EAST_JAPAN)) {
                $estimates += $cost->getFee4MailContent($cost->getHikariPhoneEastCost()) . self::LINE;
            } else {
                $estimates += $cost->getFee4MailContent($cost->getHikariPhoneWestCost()) . self::LINE;
            }
            // 番号ポータビリティ.
            if($data['numberingMethod'] == '1') {
                $content .= '《固定電話番号》' . self::LINE;
                $content .= $data['fixedLine'] . self::LINE;
            }
        }
        // リモートサポート
        $content .= '《リモートサポート》' . self::LINE;
        if($data['remortSupport'] == '0') {
            $content .= 'なし' . self::LINE;
        } else {
            $content .= 'あり' . self::LINE;
            $content .= '《リモートサポート料金》' . self::LINE;
            $content .= $cost->getFee4MailContent($cost->getRemoteSuportCost()) . self::LINE;
        }

        // ひかりTV
        $content .= '《ひかりTV for NURO申込》' . self::LINE;
        if($data['hikariTV'] == '0') {
            $content .= 'なし' . self::LINE;
        } else {
            $content .= 'あり' . self::LINE;
            $content .= '《ひかりTVプラン 料金》' . self::LINE;
            $content .= $data['hikariTvPlanString'] . self::LINE;
        }

        // まとめてでんき
        $content .= '《まとめてでんき》' . self::LINE;
        if($data['collectivelyElectricity'] == '0') {
            $content .= 'なし' . self::LINE;
        } else {
            $content .= 'あり' . self::LINE;
        }
        // カスペルスキーセキュリティー
        $content .= '《カスペルスキーセキュリティー》' . self::LINE;
        if($data['kasperskySecurity'] == '0') {
            $content .= 'なし' . self::LINE;
        } else {
            $content .= 'あり' . self::LINE;
        }
        // 工事希望日
        $content .= '《希望工事日》' . self::LINE;
        $content .= $data['construction'] . self::LINE;

        $content .= '※工事内容により追加工事費が発生する場合がございます。' . self::LINE;
        $content .= '※付加サービスはプランにより価格が異なります。' . self::LINE;
        $content .= self::LINE;
        $content .= $data['lastName'] . ' ' . $data['firstName'] . '様' . self::LINE;
        $content .= '《設置先ご住所》' . self::LINE;
        $content .= $data['installationPref'] .$data['installationMunicipalities'] .$data['installationTown'] .'-' . $data['installationAddress'].$data['installationBuilding'] . self::LINE;
        $content .= '《ご連絡携帯電話番号》' . self::LINE;
        $content .= $data['phoneNumber'] . self::LINE;
        $content .= self::LINE;
        $content .= '━━━━━━━━━━━━━━━━━━━━━━━━━━━' . self::LINE;
        $content .= '◆ご利用開始までの流れ' . self::LINE;
        $content .= '───────────────────────────' . self::LINE;
        $content .= 'STEP1：お申込み' . self::LINE;
        $content .= '本メールにて受付を致しました。' . self::LINE;
        $content .= '内容不備や確認事項がある場合は、必要に応じて弊社よりご連絡がございます。お電話・メールのご確認をお願い致します。' . self::LINE;
        $content .= '問題のない状態でございましたら1週間以内にお申込みに関する書面をご登録住所へ発送致します。' . self::LINE;
        $content .= ' ' . self::LINE;
        $content .= 'STEP2：宅内工事日決定' . self::LINE;
        $content .= '約3日～4日後に宅内工事日決定のご連絡を、申し込み時にご登録いただいた携帯電話番号宛にSMSを送信いたします。' . self::LINE;
        $content .= 'また、ご調整が取れない場合は光回線調整窓口より、1週間前後でお申し込み時にご登録いただいた電話番号へ「宅内工事」の調整のご連絡をいたします。' . self::LINE;
        $content .= ' ' . self::LINE;
        $content .= 'STEP3：宅内工事' . self::LINE;
        $content .= 'お客さまの立ち合いが必要です。' . self::LINE;
        $content .= '立ち会いは必ず契約者本人である必要はありませんが （ご家族、ご友人も可）、本人以外の場合は契約者本人と電話がつながる状態であることが必要です。 ' . self::LINE;
        $content .= ' ' . self::LINE;
        $content .= 'STEP4：屋外工事日決定' . self::LINE;
        $content .= '屋外工事日は建物への提供方法が確定し、工事日調整の準備が整い次第、ご連絡をしています。' . self::LINE;
        $content .= ' ' . self::LINE;
        $content .= 'STEP5：屋外工事・ご利用開始' . self::LINE;
        $content .= '宅内工事完了後、屋外工事日を決定していただきます。' . self::LINE;
        $content .= '立ち会いは必ず契約者本人である必要はありませんが （ご家族、ご友人も可）、本人以外の場合は契約者本人と電話がつながる状態であることが必要です。' . self::LINE;
        $content .= '━━━━━━━━━━━━━━━━━━━━━━━━━━━' . self::LINE;
        $content .= '▼お問い合わせ' . self::LINE;
        $content .= '────────────────────────────' . self::LINE;
        $content .= 'ご不明点につきましては、よくある質問をご覧ください。' . self::LINE;
        $content .= '・よくある質問：https://fon-hikari.net/faq' . self::LINE;
        $content .= 'それでもご不明点がございましたら、お問い合わせフォームよりお問い合わせください。' . self::LINE;
        $content .= '・お問い合わせフォーム：https://fon-hikari.net/contact' . self::LINE;
        $content .= '━━━━━━━━━━━━━━━━━━━━━━━━━━━' . self::LINE;
        $content .= '▼会社概要' . self::LINE;
        $content .= '────────────────────────────' . self::LINE;
        $content .= 'フォン・ジャパン株式会社' . self::LINE;
        $content .= '〒171-0014 東京都豊島区池袋2-14-4 池袋TAビル8F' . self::LINE;
        $content .= 'このメールに心当たりの無い場合は、お手数ですがサポート窓口までお問い合わせください。' . self::LINE;
        return $content;
    }
    /**
     * 働くDBのインポートエラーメッセージ送信
     * TODO: 定義してあったメソッドを持ってきただけなので、リファクタリングが必要
     *
     * @param string $result 働くDBImoprtのレスポンス
     * @return void
     */
    static public function sendHatarakuDBImportError(string $result)
    {
        $body_head = <<<SUB_HEAD
        下記のお客様情報の登録に失敗しました。
        お申込み内容を確認の上管理者にご確認ください。
        error_code :=> {$result}
        SUB_HEAD;

        $error_mail = $body_head."\n\n";

        mb_language("Japanese");
        mb_internal_encoding("UTF-8");

        $error_subject =  "Fon光管理者通知メール【重要】申込の働くDBインポート登録に失敗しました。";

        $to = mb_convert_encoding("support@fon-hikari.net, onepiecetakaie@gmail.com,fononepiecetest@gmail.com", 'UTF-8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS');
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
}