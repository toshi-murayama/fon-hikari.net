20210421 版提供エリアリスト ファイル一式．

○元となるExcelデータ
【厳秘】中国エリア拡大資料_20210421.pdf
【西日本】局番リスト_210421.xlsx
【西日本】住所リスト_210421.xlsx
【西日本】住所リスト_210421B.csv
【東日本】局番リスト_210421.xlsx
【東日本】住所リスト_210421.xlsx

現在は東西住所リストのみ使用している．

○上記Excelファイルから出力させたCSV型式テキスト
【西日本】住所リスト_210421.csv
【東日本】住所リスト_210421.csv

○CSVファイルを処理するスクリプト．
CSVファイル名がハードコーティングされてる他，完全にこのデータフォーマット専用．
generate.php
kansai.php
kantou.php

generate.php が，残り二つを呼び出す．
だがそれだけ．generate.phpを使わず直接呼び出しても同じだろう．
引数には最低限，出力先パス名が必要．

おそらく，こんな型式になる．（パスの指定方法はOSによって変わる可能性大）
php generate.php -output:bat/address_dataset_generator/20210421/test 

或いは
php generate.php -output:lib/SearchSupportedAreas

指定す出力先ディレクトリは事前に作成され，中味を空にしておくこと．
