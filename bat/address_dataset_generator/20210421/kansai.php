<?php

// 注：ブロック,住所,"NURO光 対象局舎","ひかりTV...
// のような不要なヘッダ部分は，CSVファイルから前もって手動で除去しておくこと．


$options = getopt('', ['output:']);
if (!isset($options['output'])) {
  echo 'output引数を設定してください。例：php '.basename(__FILE__).' --output ./test/';
  echo "\n";
  exit(1);
}
$dir = $options['output'];

require_once '../../../lib/SearchSupportedAreasFunctions.php';

$fp = fopen('./【西日本】住所リスト_210421.csv', 'r');

// $arealist に全サービスエリアの一覧を作って，最後にPHP配列とし一気に出力する．
// 例：
// [ '大阪府' =>[
//     '大阪府大阪市平野区瓜破東４丁目' =>[
//         0 => '★',
//         1 => '',
//         2 => '',
//         3 => '2018年3期',
//         // ... 提供エリア数分だけこれが続く
//     ],
//     // 都道府県分だけ続く．
// ],
// これが各都道府県分だけ続く配列が作られ，
// 最終的に都道府県ごとに osaka.php のような個別ファイルとして出力される．


$arealist = [];
while($line = fgets($fp)){
    $line = explode(',', $line);
    $address = trim($line[1]); // 住所， ex: 大阪府大阪市旭区高殿１丁目

    // 住所から都道府県（例： 大阪府 ）を切り出し
    $prefecture = SearchSupportedAreasFunctions::extractPref($address);
    if (!$prefecture){
        echo 'ERROR : ' . var_export(  $line , true);
        throw new Exception($address . ' 住所が不正です');
    }

    if (!isset($arealist[$prefecture])){
        $arealist[$prefecture] = [];
    }

    $arealist[$prefecture][$address] = [
        trim($line[2]), // NURO光対象局舎 (例: ★）
        trim($line[5]), // 要注意エリア (例：要注意エリア3）
        trim($line[6]), // 備考 (例： 同住所の一部のエリアはサービスエリア外)
        trim($line[7]), // 開局時期 (例：2018年2機)
        trim($line[8]), // コメント
    ];
}

foreach($arealist as $prefecture => $lines) {
    $fname = SearchSupportedAreasFunctions::toAlphabet($prefecture); // ex 大阪府から osaka
    if (!$fname){
        throw new Exception('Error Processing Request', 1);
    }

    file_put_contents($dir.'/'.$fname.'.php', '<?php'."\n".'return '. var_export($lines,true) . ";\n");
}

fclose($fp);
