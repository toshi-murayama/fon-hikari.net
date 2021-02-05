<?php
// TODO: クラス化したほうがいいけど、今はこのまま.
/**
 * 本番環境か？
 * @return bool 本番サーバーならtrue、そうでなければfalse
 */
function isProd(): bool
{
    return $_SERVER['SERVER_NAME'] === 'fon-hikari.net';
}