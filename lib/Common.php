<?php

/**
 * 本番環境か？
 * @return bool 本番サーバーならtrue、そうでなければfalse
 */
function isProd():bool
{
    // if (!isset($_SERVER['SERVER_NAME'])) {
    //     return gethostname() === 'ip-10-0-11-204.ap-northeast-1.compute.internal';
    // }
    return $_SERVER['SERVER_NAME'] === 'fon-hikari.net';
}