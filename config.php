<?php
require_once __DIR__ . '/vendor/autoload.php';
use Monolog\Logger;

// //////////////////////////////////////////////////////
// // ログレベル： DEBUG, INFO. NOTICE, WARNING, ERROR,CRITICAL, ALERT, EMERGENCY 
$DEBUG_LOG_LEVEL = Logger::INFO ;

// ログディレクトリ．個別に設定できるが，同じディレクトリを指定しても可．
$DEBUG_LOG_DIR = __DIR__ . '/log/';  // デバッグ用

// //////////////////////////////////////////////////////
// 管理者

$SUPPORT_CLOUDBACKUP_EMAIL =[
    'FROM' => ['support@fon-hikari.net' => 'オプション申込フォーム'],
    'TO' => ['support@fon-hikari.net' => 'fon光 管理者'],
];
