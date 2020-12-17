<?php

$options = getopt('', ['output:']);
if (!isset($options['output'])) {
  echo 'output引数を設定してください。例：php '.basename(__FILE__).' --output ./test/';
  echo "\n";
  exit(1);
}
$dir = $options['output'];

require_once '../../lib/SearchSupportedAreasFunctions.php';

$f = fopen("./【提出用・NURO西】住所リスト.csv", "r");

// ヘッダー部分を雑に読み飛ばす
fgetcsv($f);
fgetcsv($f);
fgetcsv($f);
fgetcsv($f);
fgetcsv($f);
fgetcsv($f);
fgetcsv($f);
fgetcsv($f);


$addresses = [];
while($line = fgetcsv($f)){
  $address = trim($line[2]);

  $pref = SearchSupportedAreasFunctions::extractPref($address);
  if (!$pref) throw new Exception('住所が不正です');

  if (!isset($addresses[$pref])) $addresses[$pref] = [];
  $addresses[$pref][trim($address)] = [
    trim($line[4]),
    trim($line[6]),
    trim($line[7]),
    trim($line[8]),
  ];
}
foreach($addresses as $pref => $lines) {
  $prefCode = SearchSupportedAreasFunctions::toAlphabet($pref);
  if (!$prefCode) throw new Exception("Error Processing Request", 1);
  file_put_contents($dir.'/'.$prefCode.'.php', '<?php'."\n".'return '. var_export($lines,true) . ";\n");
}
fclose($f);
