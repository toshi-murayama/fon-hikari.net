<?php
// 注意：CSVファイルの邪魔なヘッダ部は，前もって手動でd削除しておくこと．
// 使用例  php kantou.php --output ./temp

$options = getopt('', ['output:']);
if (!isset($options['output'])) {
  echo 'output引数を設定してください。例：php '.basename(__FILE__).' --output ./test/';
  echo "\n";
  exit(1);
}
$dir = $options['output'];

require_once '../../../lib/SearchSupportedAreasFunctions.php';

// $f = fopen("./【提出用・NURO東】住所リスト.csv", "r");
$f = fopen("./【NURO東】住所対応局舎リスト20201120.csv", "r");


$addresses = [];
while($line = fgets($f)){
  $line = explode(',', $line);

  $address = trim($line[0] . $line[1] . $line[2] . $line[3]);
  $pref = SearchSupportedAreasFunctions::extractPref($address);
  if (!$pref){
      echo 'ERROR : ' . var_export(  $line , true);
      throw new Exception($address . '住所が不正です');
  }

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
  if (!$prefCode){
      throw new Exception("Error Processing Request" . $pref, 1);
  }
  file_put_contents($dir.'/'.$prefCode.'.php', '<?php'."\n".'return '. var_export($lines,true) . ";\n");
}

fclose($f);
