<?php
namespace Param;

/**
 * 働くDBのインサート用のパラメータ
 */
class HatarakuDbInsert
{    
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
        return [
            "dbSchemaId"=>"101234", // Fon光（青の働くDB）
            "getSubordinate"=>"0",
            "keyMode"=>"0", // キー項目登録モード ※自動採番を優先する:0 入力したキーの値を優先する:1
            "values"=>[
                "116902" => "{$dataAll['applicationClassification']}",  // 顧客区分
                "116899" => "{$dataAll['applicationRoute']}",           // 申込経路
                "116894" => "{$dataAll['applicationDate']}",            // 申込受付日
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
                "116980" => "{$dataAll['hikariTV1stContract']}",        // ひかりTV一契約目申込（無:0/有:1
                "116983" => "{$dataAll['hikariTV2ndContract']}",        // ひかりTV二契約目申込（無:0/有:1
                "116897" => "{$dataAll['planCode']}",                   // プランコード
                "116895" => "{$dataAll['agencyCode']}",                 // 代理店コード
                "116997" => "{$dataAll['remortSupport']}",              // リモートサポート（MO21FZ) 
                "116896" => "{$dataAll['routeCode']}",                  // 経路コード
                "117058" => "{$dataAll['affiOrderNumber']}",            // アフィリエイトID
                "117001" => "{$dataAll['collectivelyElectricity']}",    // まとめて でんき(MO56FZ) 
                "116980" => "{$dataAll['hikariTV']}",                   // ひかりTV一契約目申込（無:0/有:1）
                "116996" => "{$dataAll['kasperskySecurity']}",          // カスペルスキーセキュリティ(MO20FZ)
            ]
        ];
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
     * @param array $post
     * @return array
     */
    public static function createData(array $post): array {
        
        $data = $post;
        // 顧客区分
        if ($data['applicationClassification'] == '0') {
            $data['applicationClassification'] = '個人';
        } else {
            $data['applicationClassification'] = '法人';
        }
        // 入会書類郵送希望先
        if ($data['mailingDestination'] == '0') {
            $data['mailingDestination'] = '設置場所に同じ';

        } else {
            $data['mailingDestination'] = '別住所';
        }
        //物件の種類
        if ($data['homeType'] == '1') {
            $data['homeType'] = '一戸建';
            // 建物区分
            $data['buildingDividion'] = 1;
        } else if ($data['homeType'] == '2') {
            $data['homeType'] = 'マンション3F以下';
            // 建物区分
            $data['buildingDividion'] = 2;
        } else {
            $data['homeType'] = 'マンション4F以上';
            // 建物区分
            $data['buildingDividion'] = 2;
        }
        // 日中連絡先番号 
        $data['daytimeContact'] = $data['phoneNumber'];

        // リモートサポート
        if ($data['remortSupport'] == '0') {
            $data['remortSupport'] = '';
        } else {
            $data['remortSupport'] = 'MO21FZ';
        }

        // まとめてでんき
        if ($data['collectivelyElectricity'] == '0') {
            $data['collectivelyElectricity'] = '';
        } else {
            $data['collectivelyElectricity'] = 'MO56FZ';
        }

        // カスペルスキーセキュリティー
        if ($data['kasperskySecurity'] == '0') {
            $data['kasperskySecurity'] = '';
        } else {
            $data['kasperskySecurity'] = 'MO20FZ';
        }

        /* --------------------- 以下、固定の値 --------------------------- */
        // 申込受付日、経路
        $data['applicationRoute'] = 'WEB';
        date_default_timezone_set('Asia/Tokyo');
        $data['applicationDate'] = date("Y年m月d日");
        // ひかりTV契約申込
        $data['hikariTV1stContract'] = 0;
        $data['hikariTV2ndContract'] = 0;
        // 契約書面電子交付への同意
        $data['consentToElectronicDelivery'] = 0;
        // プランコード
        $data['planCode'] = 'MB01FZ';
        // 代理店コード
        $data['agencyCode'] = 'FA19317';
        // 経路コード
        $data['routeCode'] = 'EA001A02';

        return $data;
    }
    /**
     * importするデータを生成（LP用）.
     *
     * @param array $data
     * @return array
     */
    public static function createDataByLp(array $data): array
    {
        // 郵便番号のハイフンは削除
        // TODO: 別の場所でやったほうがいい
        $data['postalCode'] = str_replace(array("-","ー","−","―","‐"),"",$data['postalCode']);
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