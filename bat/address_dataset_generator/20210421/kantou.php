<?php

$options = getopt('', ['output:']);
if (!isset($options['output'])) {
  echo 'output引数を設定してください。例：php '.basename(__FILE__).' --output ./test/';
  echo "\n";
  exit(1);
}
$dir = $options['output'];

require_once '../../lib/SearchSupportedAreasFunctions.php';

// $f = fopen("./【提出用・NURO東】住所リスト.csv", "r");
$f = fopen("./【NURO東】住所対応局舎リスト20201120.csv", "r");

// ヘッダー部分を雑に読み飛ばす
fgetcsv($f); // 1行目
fgetcsv($f); // 2行目
fgetcsv($f); // 3行目
fgetcsv($f); // 4行目
fgetcsv($f); // 5行目
fgetcsv($f); // 6行目


$addresses = [];
while($line = fgetcsv($f)){
  $address = trim($line[0] . $line[1] . $line[2] . $line[3]);
  $pref = SearchSupportedAreasFunctions::extractPref($address);
  if (!$pref) throw new Exception($address . '住所が不正です');

  if (!isset($addresses[$pref])) $addresses[$pref] = [];
  $addresses[$pref][$address] = [
    trim($line[4]),
    trim($line[5]),
    trim($line[6]),
    trim($line[7]),
    trim($line[8]),
  ];
}
foreach($addresses as $pref => $lines) {
  $prefCode = SearchSupportedAreasFunctions::toAlphabet($pref);
  if (!$prefCode) throw new Exception("Error Processing Request" . $pref, 1);
  file_put_contents($dir.'/'.$prefCode.'.php', '<?php'."\n".'return '. var_export($lines,true) . ";\n");
}

fclose($f);
