<?php
/**
 * 住所リスト検索API
 */

require_once '../../lib/API/SearchAreas.php';

// 適度にキャッシュさせる
$expires = 5 * 60; // 5分
header('Expires: ' . gmdate('D, d M Y H:i:s T', time() + $expires));
header('Cache-Control: private, max-age=' . $expires);
header('Content-Type: application/json; charset=utf-8');

$searchArea = new SearchAreas();
$result = $searchArea->getAddressList($_POST['zipAddress']);

echo json_encode($result, JSON_UNESCAPED_UNICODE);