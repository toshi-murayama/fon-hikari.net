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
     * Fon光LPのパラメータ
     *
     * @param array $dataAll
     * @return array
     */ 
    private static function getApiParameter(array $dataAll): array
    {
        return [
            "dbSchemaId"=>"101266", // Fon光（青の働くDB）
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
                "117665" => "{$dataAll['memo']}",                       // メモ
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
        // 郵便番号のハイフンは削除
        $data['postalCode'] = str_replace(array("-","ー","−","―","‐"),"",$data['postalCode']);
        // Fon光回線
        if ($data['fonHikariLine'] == 'Fon光回線') {
            $data['fonHikariLine'] = 'あり';
            $data['listType'] = '見積';
        } else {
            $data['listType'] = 'エリア検索';
        }

        /* --------------------- 以下、固定の値 --------------------------- */
        // 登録日
        $data['applicationDate'] = date("Y年m月d日");
        // 登録時間
        date_default_timezone_set('Asia/Tokyo');
        $data['applicationTime'] = date("H:i:s");
        return $data;
    }
}