<?php
require_once '../../lib/SearchSupportedAreasFunctions.php';

$f = fopen("./【提出用・NURO東】住所リスト.csv", "r");

// ヘッダー部分を雑に読み飛ばす
fgetcsv($f);
fgetcsv($f);
fgetcsv($f);
fgetcsv($f);
fgetcsv($f);
fgetcsv($f);


$addresses = [];
while($line = fgetcsv($f)){
  $address = trim($line[1] . $line[2] . $line[3] . $line[4]);
  $pref = SearchSupportedAreasFunctions::extractPref($address);
  if (!$pref) throw new Exception($address . '住所が不正です');

  if (!isset($addresses[$pref])) $addresses[$pref] = [];
  $addresses[$pref][$address] = [
    trim($line[5]),
    trim($line[6]),
    trim($line[7]),
    trim($line[8]),
  ];
}
foreach($addresses as $pref => $lines) {
  $prefCode = SearchSupportedAreasFunctions::toAlphabet($pref);
  if (!$prefCode) throw new Exception("Error Processing Request" . $pref, 1);
  file_put_contents('../../lib/SearchSupportedAreas/'.$prefCode.'.php', '<?php'."\n".'return '. var_export($lines,true) . ";\n");
}

fclose($f);
