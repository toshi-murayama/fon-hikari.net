<?php
// 共通関数
/**
 * 本番環境か？
 * @return bool 本番サーバーならtrue、そうでなければfalse
 */
function isProd(): bool
{
    return $_SERVER['SERVER_NAME'] === 'fon-hikari.net';
}

function h($val) {
	return htmlspecialchars($val,ENT_QUOTES);
}