<?php
/**
 * Basic認証
 * 
 * 簡易的な認証でも大丈夫な画面で使ってください
 * 
 * @see https://github.com/mpyw-yattemita/php-auth-examples
 */
class BasicAuth
{
  /**
   * 事前に生成したユーザごとのパスワードハッシュの配列
   * 
   * php -r 'echo password_hash("hLPYFREmReUn", PASSWORD_BCRYPT), PHP_EOL;'
   *
   * @var array
   */
  protected static $HASHES = [
    'operator' => '$2y$10$kkoBUwLntmTOUXf37gZ3XOK.W3rlcsXDI.JwbvDHJFa40GYeEH8k.',
  ];

  /**
   * ユーザー名
   * 認証に成功した場合ユーザー名が入る
   *
   * @var string
   */
  public static $userName = '';

  /**
   * Basic認証を要求するページの先頭で使う関数
   * 初回時または失敗時にはヘッダを送信してexitする
   *
   * @return bool true|void 認証に成功したらtrueを返す
   */
  public static function exitIfFails()
  {
    if (
      !isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) ||
      !password_verify(
        $_SERVER['PHP_AUTH_PW'],
        isset(static::$HASHES[$_SERVER['PHP_AUTH_USER']])
          ? static::$HASHES[$_SERVER['PHP_AUTH_USER']]
          : '$2y$10$abcdefghijklmnopqrstuv' // ユーザ名が存在しないときだけ極端に速くなるのを防ぐ
      )
    ) {
      // 初回時または認証が失敗したとき
      header('WWW-Authenticate: Basic realm="Enter username and password."');
      header('Content-Type: text/plain; charset=utf-8');
      exit('Authentication error');
    }

    static::$userName = $_SERVER['PHP_AUTH_USER'];
    return true;
  }
}