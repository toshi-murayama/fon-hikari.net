<?php
/**
 * 対象エリアの一覧を返すAPI
 * 
 * select2から呼び出される想定のAPIです
 */


require_once '../../lib/SearchSupportedAreasFunctions.php';

// 愛知県のファイルが5Mあるので、愛知県が動く程度＋αのメモリを確保する
ini_set('memory_limit', '50M');

function startsWith($haystack, $needle) {
  return (strpos($haystack, $needle) === 0);
}

function paging($array, $p=1) {
  $CHUNK = 50;
  $p = (int)$p;
  if ($p < 1) $p=1;
  $startIndex = ($p-1) * $CHUNK;
  $max = $CHUNK;
  $hasNextPage = ($startIndex + $max) < count($array);

  return [
    array_slice($array, $startIndex, $max),
    $hasNextPage
  ];
}

$keyword = $_GET['q'] ?? '';
$pref = SearchSupportedAreasFunctions::extractPref($keyword);
$prefCode = SearchSupportedAreasFunctions::toAlphabet($pref);
$matches = [];

// 住所配列のファイルパス
$filename = '../../lib/SearchSupportedAreas/'.$prefCode.'.php';

if (file_exists($filename)) {
  $in = include $filename;
  foreach($in as $address => $row) {
    if (!startsWith($address, $keyword) ) continue;
    // 住所が前方一致しているものを収集する
    $matches[] = [
      'id' => $address,
      'text' => $address,
      'support' => $row[0],
      'cautionLevel' => $row[1],
      'note' => $row[2],
      'startDate' => $row[3],
    ];
  }
}

// 適度にキャッシュさせる
$expires = 5 * 60; // 5分
header('Expires: ' . gmdate('D, d M Y H:i:s T', time() + $expires));
header('Cache-Control: private, max-age=' . $expires);
header('Content-Type: application/json; charset=utf-8');

// ページングする
list($paging, $hasNextPage) = paging($matches, $_GET['page']);

echo json_encode([
  'results' => $paging,
  'pagination' => [
    'more' => $hasNextPage
  ]
]);
