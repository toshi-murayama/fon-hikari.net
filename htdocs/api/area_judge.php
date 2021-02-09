<?php
/**
 * サービス提供判定API
 */
require_once '../../lib/API/SearchAreas.php';

// 適度にキャッシュさせる
$expires = 5 * 60; // 5分
header('Expires: ' . gmdate('D, d M Y H:i:s T', time() + $expires));
header('Cache-Control: private, max-age=' . $expires);
header('Content-Type: application/json; charset=utf-8');

$searchArea = new SearchAreas();
$zipAddress = $_POST['zipAddress'];
$homeType = (int)$_POST['homeType'];
$town = $_POST['town'];
$result = $searchArea->areaServiceJudge($zipAddress, $town, $homeType);

echo json_encode($result);