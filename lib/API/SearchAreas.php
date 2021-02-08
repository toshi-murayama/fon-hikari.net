<?php

require_once(__DIR__ . '/../Common.php');

/**
 * SNCの住所検索APIを操作するClass
 *  @link [https://drive.google.com/drive/u/0/folders/15JWWYlRLVecQLGRYOUiUbQFE2IVuCJb6][APIの仕様書]
 */

class SearchAreas
{
    /**
     * NOTE: APIを特定するための識別子.
     * APIキー
     */
    private const API_KEY = 'api_key';
    /**
     * 郵便番号キー
     */
    private const ZIP_KEY = 'zip';
    /**
     * カテゴリキー
     */
    private const CATEGORY_KEY = 'category';
    /**
     * 提供エリア判定に必要なカテゴリ（提供プラン）
     * NOTE: 提供プランは、2021/01/22時点で今後増えることがないとのこと. 増えた場合は、パラメータを","で追加する. カテゴリ一覧はAPIの仕様書を確認.
     */
    private const CATEGORY = 'g2home';
    /**
     * 証明書と秘密鍵を配置しているディレクトリ. Prod、Stgで同じディレクトリに配置.
     */
    private const ROOT_DIRECTORY = '/home/ec2-user/api-ssh/snc/';

    // TODO: url、key等はENVファイルとか使って、管理したい... 切り替えのメソッド自体いらない + 変数定義もENVファイルにできるので、可読性が上がる. 時間があるときにやる.
    /**
     * 町丁目リスト取得url
     *
     * @var string
     */
    private $getAddressListUrl = 'https://api.nuro.jp/area/address/town/json';
    /**
     * サービス提供判定url
     *
     * @var string
     */
    private $serviceAddressUrl = 'https://api.nuro.jp/area/service/address/json';
    /**
     * 都道府県リスト取得url
     *
     * @var string
     */
    private $getPrefListUrl = 'https://api.nuro.jp/area/address/prefecture/json';
    /**
     * CA証明書 
     *
     * @var string
     */
    private $cacert = self::ROOT_DIRECTORY . 'So-net_Private_CA_for_MV.crt';
    /**
     * 証明書
     *
     * @var string
     */
    private $cert = self::ROOT_DIRECTORY . 'fon-hikari-prod.crt';
    /**
     * 秘密鍵
     *
     * @var string
     */
    private $secretkey = self::ROOT_DIRECTORY . 'fon-hikari-prod.key';
    /**
     * 秘密鍵のパスワード
     *
     * @var string
     */
    private $secretKeyPassword = 'fon-prod';

    /**
     * 都道府県 + 市区郡町村と町丁目リスト取得. 成功以外または検索結果なしはnullを返す.
     *
     * @param string $zip 郵便番号
     * @return array|null
     */
    public function getAddressList(string $zip) 
    {
        $response = $this->execute($this->switchingProdOrStgApiUrl($this->getAddressListUrl), $this->createParamByGetAddressList($zip));
        $result = json_decode($response, true);

        // 取得ステータス、リストの存在を判定.
        if (!$this->isSuccess($result['result_code']) || !array_key_exists('addresses', $result)) {
            return null;
        }
        $towns = $this->townExtraction($result['addresses']);
        // ここまで来ると言うことは、addresses配列の０番目があるということなので、チェックしない。
        // NOTE: 都道府県市町村までは同じなので、結合して、返す.
        $address = $result['addresses'][0]['pref'] . $result['addresses'][0]['city'];
       
        return [
            'address' => $address,
            'towns' => $towns
        ];
    }
    /**
     * サービスエリア提供判定
     *
     * @param string $zip 郵便番号
     * @param string $town 町丁目
     * @param int $homeType 1 = 一軒家, 2 = マンション（3F以下）, 3 = マンション（4F以上）.
     * @return bool
     */
    public function areaServiceJudge(string $zip, string $town, int $homeType): bool
    {
        $response = $this->execute($this->switchingProdOrStgApiUrl($this->serviceAddressUrl), $this->createParamByAreaServiceJudge($zip));
        $result = json_decode($response, true);
        
        // 取得ステータス、リストの存在を判定.
        if (!$this->isSuccess($result['result_code']) || !array_key_exists('addresses', $result)) {
            return false;
        }
        return $this->serviceJudge($result['addresses'], $town, $homeType);
    }
    /**
     * 都道府県リスト取得
     *
     * @return array|null
     */
    public function getPrefList()
    {
        $response = $this->execute($this->switchingProdOrStgApiUrl($this->getPrefListUrl),'');
        $result = json_decode($response, true);
        // 取得ステータス判定.
        if (!$this->isSuccess($result['result_code'])) {
            return null;
        }
        return $this->prefExtraction($result['addresses']);
    }
    /**
     * APIの値から、都道府県だけ抽出
     *
     * @param array $addresses 住所リスト.
     * @return array
     */
    private function prefExtraction(array $addresses): array
    {
        $prefs = [];
        foreach($addresses as $address) {
            $prefs[] = $address['pref'];
        }
        return $prefs;
    }
    /**
     * 住所から、町名を抽出.
     *
     * @param array $addresses 住所リスト.
     * @return array
     */
    private function townExtraction(array $addresses): array
    {
        $towns = [];
        foreach($addresses as $address) {
            if (!isset($address['town'])) continue;
            $towns[] = $address['town'];
        }
        return $towns;
    }
    /**
     * サービス提供判定
     * TODO: 今は提供中か未提供かのみ判定. 今後は予告などのステータスを追加していく予定.
     *      カテゴリがg2homeのみなので、提供判定結果に問わずfalseにする.
     *      APIを使用すれば判定ロジックは作れるが、複雑になる + 今後提供カテゴリが増える予定がないので、この実装にしている.
     * 　　　同丁目でも提供できる、できないはAPIだけでは判定できないので、providing以外はfalseにする.
     *
     * @param array $addresses 住所リスト
     * @param string $town 町丁目
     * @param int $homeType 1 = 一軒家, 2 = マンション（3F以下）, 3 = マンション（4F以上）.
     * @return bool 
     */
    private function serviceJudge(array $addresses, string $town, int $homeType): bool
    {
        // マンション(4F以上) は常にNG. 
        if ($homeType === 3) return false;
        $state = $this->getServiceState($addresses, $town);
        return $state === 'providing';
    }
    /**
     * サービス提供状態を取得.
     * NOTE : state_sumaryにはxxx_patialyというステータスがあるが、同丁目でも提供できる、できないのステータスがあり、そのときだけ[datails][X][state]が複数ある.
     * 　　　　state_sumaryがprovidingのときは、配列にはならない。
     *
     * @param array $addresses 住所リスト
     * @param string $town 町丁目
     * @return string|null
     */
    private function getServiceState(array $addresses, string $town)
    {
        foreach($addresses as $address) {
            
            if (!isset($address['town']) || $address['town'] !== $town) continue;
            // HACK: json_decodeで余計な配列が入ってしまう. 他にいい方法があれば修正したい.
            $stateSummary = $address['services'][0]['state_summary'];
            // providingの場合は、datailsのstateを取得.
            if ($stateSummary === 'providing') return $address['services'][0]['details'][0]['state'];
            // providing以外のステータスはstate_summaryを返す.
            return $stateSummary;
        }
        // 基本的には通らない想定. 念の為.
        return null;
    }
    /**
     * 住所取得APIパラメータ生成. APIキー + 郵便番号.
     *
     * @param string $zip 郵便番号
     * @return string
     */
    private function createParamByGetAddressList(string $zip): string
    {
        return http_build_query([
            self::API_KEY => $this->createApiKeyParam(),
            self::ZIP_KEY => $zip
        ]);
    }
    /**
     * サービス提供判定APIパラメータ生成. APIキー + 郵便番号 + カテゴリ識別子.
     *
     * @param integer $zip 郵便番号
     * @return string
     */
    private function createParamByAreaServiceJudge(string $zip): string
    {
        return http_build_query([
            self::API_KEY => $this->createApiKeyParam(),
            self::ZIP_KEY => $zip,
            self::CATEGORY_KEY => self::CATEGORY
        ]);
    }
    /**
     * APIキーのパラメータを生成. fon-prod_ or fon-stg_ + マイクロ秒で、生成.
     *
     * @return string
     */
    private function createApiKeyParam():string
    {   
        $keyword = 'fon-prod_';
        if(!isProd()) $keyword = 'fon-stg_';
        $keyword .= microtime(true);
        return $keyword;
    }
    /**
     * CA証明書を取得.
     *
     * @return string
     */
    private function getCacert(): string
    {
        return $this->switchingProdOrStgCertAndSecretKey($this->cacert);
    }
    /**
     * 証明書を取得.
     *
     * @return string
     */
    private function getcert(): string
    {
        return $this->switchingProdOrStgCertAndSecretKey($this->cert);
    }
    /**
     * 秘密鍵を取得.
     *
     * @return string
     */
    private function getSecretKey(): string
    {
        return $this->switchingProdOrStgCertAndSecretKey($this->secretkey);
    }
    /**
     * 秘密鍵のパスワードを取得.
     *
     * @return string
     */
    private function getSecretKeyPassword(): string
    {
        return $this->switchingProdOrStgCertAndSecretKey($this->secretKeyPassword);
    }
    /**
     * apiurlをProd、Stgで切り替える.(Prod、Stgの違いは、Prod = api -> Stg = apitだけ).
     *
     * @param string $url APIURL
     * @return string
     */
    private function switchingProdOrStgApiUrl(string $url): string
    {
        return $this->switchingProdOrStg('api', 'apit', $url);
    }
    /**
     * 証明書、秘密鍵をProd、Stgで切り替える(Prod、Stgの違いは、Prod = prod -> Stg = stgだけ). 
     *
     * @param string $val
     * @return string
     */
    private function switchingProdOrStgCertAndSecretKey(string $val): string
    {
        return $this->switchingProdOrStg('prod', 'stg', $val);
    }
    /**
     * Prod、Stgの切り替え.
     *
     * @param string $prod Prodの値
     * @param string $stg STGの値
     * @param string $val 切り替え対象の値
     * @return string
     */
    private function switchingProdOrStg(string $prod, string $stg, string $val): string
    {
        if(!isProd()) $val = str_replace($prod, $stg, $val);
        return $val;
    }
    /**
     * 成功か判定. 成功は000、それ以外の場合は失敗と判定. 
     *
     * @param string $resultCode APIの結果.
     * @return boolean
     */
    private function isSuccess(string $resultCode): bool
    {
        return $resultCode === '000';
    }
    /**
     * API実行.
     *
     * @param string $apiUrl
     * @param string $param GETパラメータ
     * @return string
     */
    private function execute(string $apiUrl, string $param): string
    {
        $curl=curl_init();
        // URLを指定.
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        // 証明書、秘密鍵を設定.
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_CAINFO, $this->getCacert());
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_SSLCERT, $this->getCert());
        curl_setopt($curl, CURLOPT_SSLKEY, $this->getSecretKey());
        curl_setopt($curl, CURLOPT_KEYPASSWD, $this->getSecretKeyPassword());
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // パラメータ設定.
        curl_setopt ($curl, CURLOPT_POSTFIELDS, $param);
        
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }
}
