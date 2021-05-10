20201120版 提供エリアリストファイル一式．
この時点ですでに役目を終えていると思われる．

もともとは
bat/address_dataset_generator/
以下にあったので

require_once '../../lib/SearchSupportedAreasFunctions.php';
の部分のパスを，
require_once '../../../lib/SearchSupportedAreasFunctions.php';
のように変更しないと動かないと思われるが，あえて変更まではしていない．
