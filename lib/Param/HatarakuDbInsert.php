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
                "112435" => "{$dataAll['1']}", // 顧客区分
                "112492" => "{$dataAll['2']}", // 契約者　姓
                "112493" => "{$dataAll['3']}", // 契約者　名
                "112405" => "{$dataAll['4']}", // フリガナ　セイ
                "112494" => "{$dataAll['5']}", // フリガナ　メイ
                "112406" => "{$dataAll['6']}", // 性別
                "112407" => "{$dataAll['7']}", // 生年月日
                "112408" => "{$dataAll['8']}", // 携帯番号
                "112495" => "{$dataAll['9']}", // 固定電話番号
                "112410" => "{$dataAll['10']}", // 連絡先メールアドレス
                "112411" => "{$dataAll['11']}", // 郵便番号
                "112412" => "{$dataAll['12']}", // 都道府県
                "112496" => "{$dataAll['13']}", // 市区町村
                "112497" => "{$dataAll['14']}", // 町名・丁目・番地
                "112498" => "{$dataAll['15']}", // マンション/ビル名・部屋番号
                "112436" => "{$dataAll['16']}", // 所有形態
                "112499" => "{$dataAll['17']}", // 入会書類郵送希望先
                "112429" => "{$dataAll['18']}", // 郵送先郵便番号
                "112430" => "{$dataAll['19']}", // 郵送先都道府県
                "112431" => "{$dataAll['20']}", // 郵送先市区町村
                "112500" => "{$dataAll['21']}", // 郵送先町名・丁目・番地
                "112501" => "{$dataAll['22']}", // 郵送先マンション/ビル名・部屋番号
                "112502" => "{$dataAll['23']}", // 光電話申込
            ]
        ];
    }   
}