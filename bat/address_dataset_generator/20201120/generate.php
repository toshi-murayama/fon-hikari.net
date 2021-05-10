<?php
ini_set('memory_limit', '256M');

$options = getopt('', ['output:']);
if (!isset($options['output'])) {
  echo 'output引数にディレクトリを設定してください。例：php generate.php --output ./test/';
  echo "\n";
  exit(1);
}

$path = realpath(__DIR__ . '/' . $options['output']);
if (!is_dir($path)) {
  echo '存在しないパス、もしくはディレクトリ以外が指定されました';
  echo "\n";
  exit(1);
}

exec('php ./kantou.php --output '.escapeshellarg($path), $output, $ret);
echo implode("\n", $output);
if ($ret !== 0) {
  echo "\n".'NG'."\n";
  exit(1);
}

exec('php ./kansai.php --output '.escapeshellarg($path), $output, $ret);
echo implode("\n", $output);
if ($ret !== 0) {
  echo "\n".'NG'."\n";
  exit(1);
}

echo 'ok';
