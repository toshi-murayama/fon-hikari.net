<?php
namespace Param;

/**
 * 働くDBのインサート用のパラメータ
 */
class HatarakuDbInsert
{
    // Applicationで使用する、データ変換用の配列.
    private const APPLICATIOIN_CLASSIFICATION = ['0' => '個人', '1' => '法人'];
    private const MAILING_DESTONATION = ['0' => '設置場所に同じ', '1' => '別住所'];
    private const HOME_TYPES = ['1' => '一戸建', '2' => 'マンション3F以下', '3' => 'マンション4F以上'];
    private const REMORT_SUPPORT = ['0' => '', '1' => 'MO21FZ'];
    private const COOLECTOVELY_ELECTRICITY = ['0' => '', '1' => 'MO56FZ'];
    private const KASPERSKY_SECURITY = ['0' => '', '1' => 'MO20FZ'];


    /**
     * NOTE 本番、開発を切り替え想定...
     * 本番用の申込パラメータを取得.
     *
     * @param array $dataAll
     * @return string
     */
    public static function getApplicationApiParameter(array $dataAll): string
    {
        return json_encode(self::getApiParameter($dataAll));
    }
    /**
     * LP画面のエリア確認、簡単見積もり用パラメータを取得.
     *
     * @param array $dataAll
     * @return string
     */
    public static function getLpApiParameter(array $dataAll): string
    {
        return json_encode(self::getApiParameterByLp($dataAll));
    }
    /**
     * Fon光のパラメータ
     *
     * @param array $dataAll
     * @return array
     */
    private static function getApiParameter(array $dataAll): array
    {
        date_default_timezone_set('Asia/Tokyo');
        $ret = [
            "dbSchemaId"=>"101234", // Fon光（青の働くDB）
            "getSubordinate"=>"0",
            "keyMode"=>"0", // キー項目登録モード ※自動採番を優先する:0 入力したキーの値を優先する:1
            "values"=>[
                "116902" => "{$dataAll['applicationClassification']}",  // 顧客区分
                "116899" => 'WEB',                                      // 申込経路(固定値)
                "116894" => date("Y年m月d日"),                           // 申込受付日
                "116903" => "{$dataAll['lastName']}",                   // 契約者　姓
                "116904" => "{$dataAll['firstName']}",                  // 契約者　名
                "116905" => "{$dataAll['lastNameKana']}",               // フリガナ　セイ
                "116906" => "{$dataAll['firstNameKana']}",              // フリガナ　メイ
                "116907" => "{$dataAll['sex']}",                        // 性別(1:男/2:女)
                "116908" => "{$dataAll['birthday']}",                   // 生年月日
                "116909" => "{$dataAll['phoneNumber']}",                // 携帯番号
                "116962" => "{$dataAll['fixedLine']}",                  // 継続する電話番号
                "116911" => "{$dataAll['mailAddress']}",                // 連絡先メールアドレス
                "116913" => "{$dataAll['postalCode']}",                 // 郵便番号
                "116914" => "{$dataAll['installationPref']}",           // 都道府県
                "116915" => "{$dataAll['installationMunicipalities']}", // 市区町村
                "116916" => "{$dataAll['installationTown']}",           // 町名・丁目
                "116917" => "{$dataAll['installationAddress']}",        // 番地・号
                "116928" => "{$dataAll['installationBuilding']}",       // マンション/ビル名・部屋番号
                "116924" => "{$dataAll['ownership']}",                  // 所有形態（1賃貸/2分譲/3分譲賃貸/4持ち家）
                "116929" => "{$dataAll['mailingDestination']}",         // 入会書類郵送希望先
                "116930" => "{$dataAll['mailingPostalCode']}",          // 郵送先郵便番号
                "116931" => "{$dataAll['mailingPrefName']}",            // 郵送先都道府県
                "116932" => "{$dataAll['mailingMunicipalities']}",      // 郵送先市区町村
                "116933" => "{$dataAll['mailingTown']}",                // 郵送先町名・丁目・番地
                "116934" => "{$dataAll['mailingAddress']}",             // 郵送先番地・号
                "116935" => "{$dataAll['mailingBuilding']}",            // 郵送先マンション/ビル名・部屋番号
                "116960" => "{$dataAll['telephoneApplication']}",       // 光電話申込（0:無/1:有）
                "116927" => "{$dataAll['homeType']}",                   // 物件の種類
                "116961" => "{$dataAll['numberingMethod']}",            // 電話番号種類(0:新規/1:番ポ)
                "116910" => "{$dataAll['daytimeContact']}",             // 日中連絡先番号
                "116912" => "{$dataAll['consentToElectronicDelivery']}",// 契約書面電子交付への同意
                "116918" => "{$dataAll['buildingDividion']}",           // 建物区分（1:戸建/２:集合）
                "116980" => "{$dataAll['hikariTvPlanApplication']}",    // ひかりTV一契約目申込（無:0/有:1)
                "116983" => 0,                                          // ひかりTV二契約目申込（無:0/有:1)0に固定
                "116981" => "{$dataAll['hikariTvPlan']}",               // ひかりTV一契約目プラン
                "116982" => "{$dataAll['hikariTvPlanTuner']}",          // ひかりTV一契約目チューナーレンタル（無:0/有:1）
                "116897" => 'MB01FZ',                                   // プランコード (固定値)
                "116895" => 'FA19317',                                  // 代理店コード (固定値)
                "116896" => 'EA001A02',                                 // 経路コード (固定値)
                "116997" => "{$dataAll['remortSupport']}",              // リモートサポート（MO21FZ)
                "117058" => "{$dataAll['affiOrderNumber']}",            // アフィリエイトID
                "117001" => "{$dataAll['collectivelyElectricity']}",    // まとめて でんき(MO56FZ)
                "116980" => "{$dataAll['hikariTV']}",                   // ひかりTV一契約目申込（無:0/有:1）
                "116996" => "{$dataAll['kasperskySecurity']}",          // カスペルスキーセキュリティ(MO20FZ)
                "116955" => "{$dataAll['construction']}",               // 業務備考
                "118462" => $dataAll['couponCode'],                     // クーポンコード [テキスト(1行)]
                "117749" => 0,                                          // Amazonギフト券 NOTE: CP終了に伴い、0に固定
            ]
        ];

        // GOLDEX株式会社, クーポンコード
        // jquery.validationEngine-ja.js のものと 1対1 対応する必要あり．
        $goldexPattern = '/^(g0000-0000-0000|g0003-0000-0000|g0011-0000-0000|g0002-0000-0000|g0002-0001-0000|g0002-0002-0000|g0002-0003-0000|s0000-0000-0000|s0001-0000-0000|s0001-0001-0000|s0001-0002-0000|s0001-0003-0000|s0002-0000-0000|s0002-0001-0000|s0002-0002-0000|s0002-0003-0000|s0002-0004-0000|s0003-0000-0000|s0004-0000-0000|s0004-0001-0000|s0005-0000-0000|s0007-0000-0000|s0009-0000-0000|s0010-0000-0000|s0012-0000-0000|s0013-0000-0000|s0014-0000-0000|s0014-0001-0000|s0014-0002-0000|s0014-0003-0000|s0014-0004-0000|s0014-0005-0000|s0015-0000-0000|s0016-0000-0000|s0016-0001-0000|s0017-0000-0000|s0017-0001-0000|s0018-0000-0000|s0004-0002-0000|s0019-0000-0000|s0001-0004-0000|s0003-0001-0000|n0001-0003-0000|n0001-0000-0000|n0001-0001-0000|n0001-0002-0000|n0001-0004-0000|n0001-0005-0000|g0004-0000-0000|g0004-0001-0000|g0007-0000-0000|g0007-0001-0000|g0007-0002-0000|g0007-0003-0000|g0007-0004-0000|g0007-0005-0000|g0007-0006-0000|g0007-0007-0000|g0007-0008-0000|g0007-0009-0000|g0007-0010-0000|g0008-0000-0000|g0009-0000-0000|g0010-0000-0000|p0000-0000-0000|g0014-0000-0000|g0012-0000-0000|g0013-0000-0000|g0015-0000-0000|g0019-0000-0000|g0020-0000-0000|g0016-0000-0000|g0017-0000-0000|g0018-0000-0000|g0021-0000-0000|g0022-0000-0000|d0001-0000-0000|d0001-0000-0001|d0001-0000-0002|d0001-0000-0003|d0001-0000-0004|d0001-0000-0005|d0001-0000-0006|d0001-0000-0007|d0001-0000-0008|d0001-0000-0009|d0001-0000-0010|d0001-0000-0011|d0001-0000-0012|d0001-0000-0013|d0001-0000-0014|d0001-0000-0015|d0001-0000-0016|d0001-0000-0017|d0001-0000-0018|d0001-0000-0019|d0001-0000-0020|d0001-0000-0021|d0001-0000-0022|d0001-0000-0023|d0001-0000-0024|d0001-0000-0025|s0001-0000-1001|s0001-0000-1002|s0001-0000-0101|s0001-0001-0001|s0001-0003-0001|s0001-0003-0002|s0001-0003-0003|s0001-0003-0004|s0001-0003-0005|s0001-0003-0006|s0001-0004-0001)$/' ;
        if( preg_match( $goldexPattern, trim( $dataAll['couponCode']) ) ) {
            // GOLDEXのクーポンのパターンマッチしたものは，DBの以下の項目にも書き込む
            $ret['values']['116899'] = 'その他' ;  //：申込経路 [選択肢(1件選択)]
            $ret['values']['117748'] = 'GOLDEX';  // ：CP [テキスト(1行)]
        }

        // クラウドバックアップ連携
        if( $dataAll['cloudBackup'] == 'YES' ){
            $ret['values']['119585'] = '有り（申し込み待ち）'; //【クラウドバックアップ】
            $ret['values']['117749'] = '3000'; // 【Amazonギフト券】
        }

        return $ret ;
    }
    /**
     * Fon光LPのパラメータ
     *
     * @param array $dataAll
     * @return array
     */
    private static function getApiParameterByLp(array $dataAll): array
    {
        return [
            "dbSchemaId"=>"101266", // Fon光LPリスト（青の働くDB）
            "getSubordinate"=>"0",
            "keyMode"=>"0", // キー項目登録モード ※自動採番を優先する:0 入力したキーの値を優先する:1
            "values"=>[
                "117683" => "{$dataAll['applicationDate']}",            // 登録日
                "117684" => "{$dataAll['applicationTime']}",            // 登録時間
                "117649" => "{$dataAll['listType']}",                   // リスト種別
                "117667" => "{$dataAll['areaType']}",                   // 提供エリア種別
                "117650" => "{$dataAll['name']}",                       // 顧客名
                "117651" => "{$dataAll['nameKana']}",                   // 顧客名フリガナ
                "117669" => "{$dataAll['phoneNumber']}",                // 携帯番号
                "117652" => "{$dataAll['postalCode']}",                 // 郵便番号
                "117653" => "{$dataAll['installationPref']}",           // 都道府県
                "117654" => "{$dataAll['address']}",                    // 住所
                "117655" => "{$dataAll['buildingType']}",               // 建物種別
                "117656" => "{$dataAll['buildingName']}",               // 建物名
                "117659" => "{$dataAll['fonHikariLine']}",              // Fon光回線
                "117660" => "{$dataAll['hikariPhone']}",                // ひかり電話
                "117661" => "{$dataAll['remortSupport']}",              // リモートサポート
                "117662" => "{$dataAll['hikariTVforNURO']}",            // ひかりTV for NURO
                "117663" => "{$dataAll['collectivelyElectricity']}",    // まとめてでんき
                "117664" => "{$dataAll['estimatedAmount']}",            // 見積金額
            ]
        ];
    }
    /**
     * importするデータを生成.
     *
     * @param array $data
     * @return array
     */
    public static function createData(array $data): array
    {
        // 顧客区分
        $data['applicationClassification'] = self::APPLICATIOIN_CLASSIFICATION[$data['applicationClassification']];
        // 入会書類郵送希望先
        $data['mailingDestination'] = self::MAILING_DESTONATION[[$data['mailingDestination']]];
        //物件の種類
        $data['homeType'] = self::HOME_TYPES[$data['homeType']];
        // 日中連絡先番号
        $data['daytimeContact'] = $data['phoneNumber'];
        // リモートサポート
        $data['remortSupport'] = self::REMORT_SUPPORT[$data['remortSupport']];
        // まとめてでんき
        $data['collectivelyElectricity'] = self::COOLECTOVELY_ELECTRICITY[$data['collectivelyElectricity']];
        // カスペルスキーセキュリティー
        $data['kasperskySecurity'] = self::KASPERSKY_SECURITY[$data['kasperskySecurity']];

        return $data;
    }

    /**
     * importするデータを生成（LP用）.
     *
     * @param array $data
     * @param string $areaType
     * @param int $estimatedAmount
     * @return array
     */
    public static function createDataByLp(array $data, string $areaType, int $estimatedAmount): array
    {
        $data['areaType'] = $areaType;
        $data['estimatedAmount'] = $estimatedAmount;
        // Fon光回線
        if ($data['fonHikariLine'] == 'Fon光回線') {
            $data['fonHikariLine'] = 'あり';
            $data['listType'] = '見積';
        } else {
            $data['listType'] = 'エリア検索';
        }

        /* --------------------- 以下、固定の値 --------------------------- */
        date_default_timezone_set('Asia/Tokyo');
        // 登録日
        $data['applicationDate'] = date("Y年m月d日");
        // 登録時間
        $data['applicationTime'] = date("H:i:s");
        return $data;
    }
}
