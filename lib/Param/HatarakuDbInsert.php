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
            "dbSchemaId"=>"101078", // Fon光
            "getSubordinate"=>"0",
            "keyMode"=>"0", // キー項目登録モード ※自動採番を優先する:0 入力したキーの値を優先する:1
            "values"=>[
                "112435" => "{$dataAll['applicationClassification']}",  // 顧客区分
                "112476" => "{$dataAll['applicationRoute']}",           // 申込経路
                "112418" => "{$dataAll['applicationDate']}",            // 申込受付日
                "112492" => "{$dataAll['lastName']}",                   // 契約者　姓
                "112493" => "{$dataAll['firstName']}",                  // 契約者　名
                "112405" => "{$dataAll['lastNameKana']}",               // フリガナ　セイ
                "112494" => "{$dataAll['firstNameKana']}",              // フリガナ　メイ
                "112406" => "{$dataAll['sex']}",                        // 性別
                "112407" => "{$dataAll['birthday']}",                   // 生年月日
                "112408" => "{$dataAll['phoneNumber']}",                // 携帯番号
                "112558" => "{$dataAll['fixedLine']}",                  // 継続する電話番号
                "112410" => "{$dataAll['mailAddress']}",                // 連絡先メールアドレス
                "112411" => "{$dataAll['postalCode']}",                 // 郵便番号
                "112412" => "{$dataAll['installationPref']}",           // 都道府県
                "112496" => "{$dataAll['installationMunicipalities']}", // 市区町村
                "112497" => "{$dataAll['installationTown']}",           // 町名・丁目・番地
                "112498" => "{$dataAll['installationBuilding']}",       // マンション/ビル名・部屋番号
                "112436" => "{$dataAll['ownership']}",                  // 所有形態
                "112499" => "{$dataAll['mailingDestination']}",         // 入会書類郵送希望先
                "112429" => "{$dataAll['mailingPostalCode']}",          // 郵送先郵便番号
                "112430" => "{$dataAll['mailingPrefName']}",            // 郵送先都道府県
                "112431" => "{$dataAll['mailingMunicipalities']}",      // 郵送先市区町村
                "112500" => "{$dataAll['mailingTown']}",                // 郵送先町名・丁目・番地
                "112501" => "{$dataAll['mailingBuilding']}",            // 郵送先マンション/ビル名・部屋番号
                "112502" => "{$dataAll['telephoneApplication']}",       // 光電話申込
                "112577" => "{$dataAll['homeType']}",                   // 物件の種類
                "112516" => "{$dataAll['numberingMethod']}",            // 電話番号種類
            ]
        ];
    }   
}