<?php
/**
 * SearchSupportedAreasFunctions
 * 
 * 対応エリア検索で使う関数群です。
 * 
 * 多分すぐに使わなくなる処理なので、雑に静的関数を集約しただけのクラスにしています。
 * 雑に作ったクラスなので必要になったらリファクタリングしてください。
 */
class SearchSupportedAreasFunctions
{
  /**
   * extractPref
   * 
   * 住所名から県名を抽出します。
   * 適当にネットから拾ったコードなので正規表現がうまくっているかちょっと不安です。
   * 例：東京都新宿区 --> 東京都
   *
   * @param string $address
   * @return string|null
   */
  public static function extractPref(string $address)
  {
    $pattern = '/東京都|北海道|(?:大阪|京都)府|(?:三重|兵庫|千葉|埼玉|大分|奈良|岐阜|岩手|島根|新潟|栃木|沖縄|熊本|福井|秋田|群馬|長野|青森|高知|鳥取|(?:宮|長)崎|(?:宮|茨)城|(?:佐|滋)賀|(?:静|福)岡|山(?:口|形|梨)|愛(?:媛|知)|(?:石|香|神奈)川|(?:富|岡|和歌)山|(?:福|広|徳|鹿児)島)県/';
    $address = preg_match($pattern, $address, $m) ? $m[0] : null;
    return $address;
  }

  /**
   * toAlphabet
   * 
   * 県名（東京都など）から英字の文字列を返します。
   * 見つからなかったら false を返します。
   * 例：東京都 --> tokyo
   * 
   * ネットで適当に拾った配列ですので、
   * 北海道が hokkai になっていたりして気持ちが悪いので、
   * 使うときは慎重に使ってください。
   * ※どうでも良い処理にだけ使ってください
   * 
   * @param string $in
   * @return string|false
   */
  public static function toAlphabet($in)
  {
    $prefecture = [
      'hokkai'     => '北海道',
      'aomori'     => '青森県',
      'iwate'      => '岩手県',
      'miyagi'     => '宮城県',
      'akita'      => '秋田県',
      'yamagata'   => '山形県',
      'fukushima'  => '福島県',
      'ibaraki'    => '茨城県',
      'tochigi'    => '栃木県',
      'gunma'      => '群馬県',
      'saitama'    => '埼玉県',
      'chiba'      => '千葉県',
      'tokyo'      => '東京都',
      'kanagawa'   => '神奈川県',
      'yamanashi'  => '山梨県',
      'nagano'     => '長野県',
      'nigata'     => '新潟県',
      'toyama'     => '富山県',
      'ishikawa'   => '石川県',
      'hukui'      => '福井県',
      'gihu'       => '岐阜県',
      'shizuoka'   => '静岡県',
      'aichi'      => '愛知県',
      'mie'        => '三重県',
      'shiga'      => '滋賀県',
      'kyouto'     => '京都府',
      'osaka'      => '大阪府',
      'hyogo'      => '兵庫県',
      'nara'       => '奈良県',
      'wakayama'   => '和歌山県',
      'totori'     => '鳥取県',
      'shimane'    => '島根県',
      'okayama'    => '岡山県',
      'hiroshima'  => '広島県',
      'yamaguchi'  => '山口県',
      'tokushima'  => '徳島県',
      'kagawa'     => '香川県',
      'ehime'      => '愛媛県',
      'kouchi'     => '高知県',
      'fukuoka'    => '福岡県',
      'saga'       => '佐賀県',
      'nagasaki'   => '長崎県',
      'kumamoto'   => '熊本県',
      'oita'       => '大分県',
      'miyazaki'   => '宮崎県',
      'kagoshima'  => '鹿児島県',
      'okinawa'    => '沖縄県'
    ];
    return array_search($in, $prefecture);
  }
}
