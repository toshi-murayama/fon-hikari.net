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
}