<?php

$options = getopt('', ['output:']);
if (!isset($options['output'])) {
    echo 'output引数を設定してください。例：php '.basename(__FILE__).' --output ./test/';
    echo "\n";
    exit(1);
}
$dir = $options['output'];

require_once '../../lib/SearchSupportedAreasFunctions.php';

$fp = fopen('./【東日本】住所リスト_210421.csv', 'r');

// ヘッダー部分は不要なので，力業で読み飛ばす
fgetcsv($fp); // 1行目
fgetcsv($fp); // 2行目
fgetcsv($fp); // 3行目
fgetcsv($fp); // 4行目
fgetcsv($fp); // 5行目
fgetcsv($fp); // 6行目


// $arealist に全サービスエリアの一覧を作って，最後にPHP配列とし一気に出力する．
// 例：
// [ '北海道' =>[
//     '北海道札幌市中央区旭ケ丘１丁目' => [
//         0 => '★',
//         1 => '',
//         2 => '',
//         3 => '2020年1期',
//         // ... 提供エリア数分だけこれが続く
//     ],
//     // 都道府県分だけ続く．
// ],
// これが各都道府県分だけ続く配列が作られ，
// 最終的に都道府県ごとに hokkai.php のような個別ファイルとして出力される．


$arealist = [];
while($line = fgetcsv($fp)){

    // 住所． ex: 北海道札幌市中央区旭ケ丘１丁目
    // 都道府県＋ 住所1(市区町村) ＋ 住所2 + 住所3(○丁目)
    $address = trim($line[0] . $line[1] . $line[2] . $line[3]); 

    // 住所から都道府県（例： 北海道 ）を切り出し
    $prefecture = SearchSupportedAreasFunctions::extractPref($address);
    if (!$prefecture){
        throw new Exception($address . '住所が不正です');
    }

    if (!isset($arealist[$prefecture])){
        $arealist[$prefecture] = [];
    }

    $arealist[$prefecture][$address] = [
        trim($line[4]), // NURO光対象局舎． ex: ★
        trim($line[7]), // 要注意エリア
        trim($line[8]), // 備考
        trim($line[9]), // 開局時期． ex: 2020年1期
        trim($line[10]), // コメント
    ];
}
foreach($arealist as $prefecture => $lines) {
    $fname = SearchSupportedAreasFunctions::toAlphabet($prefecture); // ex 北海道 から hokkai
    if (!$fname){
        throw new Exception("Error Processing Request" . $pref, 1);
    }

    file_put_contents($dir.'/'.$fname.'.php', '<?php'."\n".'return '. var_export($lines,true) . ";\n");
}

fclose($fp);
