<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
<meta charset="utf-8">
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta name="viewport" content="width=device-width,user-scalable=no,maximum-scale=1">
<title>fon光 お申し込みサイト</title>
<meta name="description" content="fon光のおトク情報満載！今ならお申し込みで【80,000円キャッシュバック中】月額料金も最安級3,680円で使い放題！セキュリティ・電話・テレビなどのサービスも豊富に取り揃えています。お得に申込むなら今がチャンス！">
<meta name="keywords" content="コミュファ,fon光,光,キャンペーン,インターネット,高速インターネット,光回線,プロバイダ,工事,キャッシュバック,乗り換え">
<!----css---->
<link rel="stylesheet" href="css/animate.css"> 
<link rel="stylesheet" href="css/style_form.css">
<link rel="stylesheet" href="css/validationEngine.jquery.css"> 
<!----js---->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/jquery.validationEngine.js"></script>
<script src="js/jquery.validationEngine-ja.js"></script>
<script src="js/jquery.jpostal.min.js"></script>
<script src="js/jquery.autoKana.js"></script>
<script src="js/application.js"></script>
<script src="js/script.js"></script>
</head>

<body>
	<?php include "include/header_form.html";?>
	<section id="application">
		<h2>fon光お申し込み</h2>
		<h3 class="">02 お客様情報入力</h3>
		<div class="search_text">ご契約先の情報をご入力ください。</div>
		<h4>ご契約者情報</h4>
		<form method="post" action="confirmation.php" id="appForm">
			<ul class="form">
				<li>
					<dl>
						<dt>氏名（姓）<br>
						<input size="30" type="text" name="姓" value="<?php print $first_name; ?>" class="validate[required]" id="lastName"></dt>
						<dd>氏名（名）<br>
						<input size="30" type="text" name="名" value="<?php print $second_name; ?>" class="validate[required]" id="firstName"></dd>
					</dl>
					</li>
				<li>
					<dl>
						<dt>フリガナ（セイ）<br>
						<input size="30" type="text" name="姓（カナ）" value="<?php print $first_name_kana; ?>" class="validate[required],[custom[zenkaku_kana]]" id="lastNameKana"></dt>
						<dd>フリガナ（メイ）<br>
						<input size="30" type="text" name="名（カナ）" value="<?php print $second_name_kana; ?>" class="validate[required],[custom[zenkaku_kana]]" id="firstNameKana"></dd>
					</dl>
				</li>
				<li>性別</li>
				<li>
					<input type="radio" name="性別" value="男性" id="man" class="check">
					<label for="man">男性</label>
					<input type="radio" name="性別" value="女性" class="check" id="women">
					<label for="women">女性</label>
					</li>
				<li>郵便番号</li>
				<li>〒<input size="20" type="text" name="郵便番号" value="<?php print $postal_code; ?>" type="number" maxlength='7' class="validate[required],[custom[onlyNumberSp]]" id="postalCode"><a href="http://www.post.japanpost.jp/zipcode/" target="_blank">郵便番号検索</a>
                                <br>
                                <a href="" class="autoInput">郵便番号から住所を自動入力</a>
					</li>
				<li>都道府県</li>
				<li><select name="pref_name" id="prefectures" class="validate[required]">
                                    <option value="" selected>都道府県を選択</option>
                                    <option value="北海道">北海道</option>
                                    <option value="青森県">青森県</option>
                                    <option value="岩手県">岩手県</option>
                                    <option value="宮城県">宮城県</option>
                                    <option value="秋田県">秋田県</option>
                                    <option value="山形県">山形県</option>
                                    <option value="福島県">福島県</option>
                                    <option value="茨城県">茨城県</option>
                                    <option value="栃木県">栃木県</option>
                                    <option value="群馬県">群馬県</option>
                                    <option value="埼玉県">埼玉県</option>
                                    <option value="千葉県">千葉県</option>
                                    <option value="東京都">東京都</option>
                                    <option value="神奈川県">神奈川県</option>
                                    <option value="新潟県">新潟県</option>
                                    <option value="富山県">富山県</option>
                                    <option value="石川県">石川県</option>
                                    <option value="福井県">福井県</option>
                                    <option value="山梨県">山梨県</option>
                                    <option value="長野県">長野県</option>
                                    <option value="岐阜県">岐阜県</option>
                                    <option value="静岡県">静岡県</option>
                                    <option value="愛知県">愛知県</option>
                                    <option value="三重県">三重県</option>
                                    <option value="滋賀県">滋賀県</option>
                                    <option value="京都府">京都府</option>
                                    <option value="大阪府">大阪府</option>
                                    <option value="兵庫県">兵庫県</option>
                                    <option value="奈良県">奈良県</option>
                                    <option value="和歌山県">和歌山県</option>
                                    <option value="鳥取県">鳥取県</option>
                                    <option value="島根県">島根県</option>
                                    <option value="岡山県">岡山県</option>
                                    <option value="広島県">広島県</option>
                                    <option value="山口県">山口県</option>
                                    <option value="徳島県">徳島県</option>
                                    <option value="香川県">香川県</option>
                                    <option value="愛媛県">愛媛県</option>
                                    <option value="高知県">高知県</option>
                                    <option value="福岡県">福岡県</option>
                                    <option value="佐賀県">佐賀県</option>
                                    <option value="長崎県">長崎県</option>
                                    <option value="熊本県">熊本県</option>
                                    <option value="大分県">大分県</option>
                                    <option value="宮崎県">宮崎県</option>
                                    <option value="鹿児島県">鹿児島県</option>
                                    <option value="沖縄県">沖縄県</option>
                                </select>
				</li>
				<li>住所</li>
				<li>
					<input size="60" type="text" name="住所" value="<?php print $address; ?>" class="validate[required]" id="address">
				</li>
                <li>建物名・部屋番号</li>
				<li>
					<input size="60" type="text" name="マンション名・部屋番号" value="<?php print $room_number; ?>">
				</li>
				<li>電話番号</li>
				<li><input size="30" type="text" name="電話番号" value="<?php print $tel; ?>" maxlength='11' class="validate[required],[custom[onlyNumberSp]]">
					</li>
				<li>メールアドレス</li>
				<li>
					<input size="30" type="text" name="メールアドレス" value="<?php print $mail; ?>" class="validate[required],[custom[email]]">
				</li>
				<li>連絡のつきやすい日時</li>
				<li><select name="連絡のつきやすい日時（曜日）" class="validate[required]">
                                    <option value="いつでも" <?php 
									if ($tel_week　=='いつでも' ) { 
										?> selected<?php
									}
									?>>いつでも</option>
                                    <option value="月" <?php 
									if ($tel_week　=='月' ) { 
										?> selected<?php
									}
									?>>月</option>
                                    <option value="火" <?php 
									if ($tel_week　=='火' ) { 
										?> selected<?php
									}
									?>>火</option>
                                    <option value="水" <?php
									if ($tel_week　=='水' ) { 
										?> selected<?php
									}
									?>>水</option>
                                    <option value="木" <?php
									if ($tel_week　=='木' ) {
										?> selected<?php
									}
									?>>木</option>
                                    <option value="金" <?php
									if ($tel_week　=='金' ) {
										?> selected<?php
									}
									?>>金</option>
                                    <option value="土" <?php 
									if ($tel_week　=='土' ) { 
									?> selected<?php
									}
									?>>土</option>
                                    <option value="日" <?php 
									if ($tel_week　=='日' ) { 
										?> selected<?php
									}
									?>>日</option>
                                </select>
                                時間帯
                                <select name="連絡のつきやすい日時（時間帯）" class="validate[required]">
                                    <option value="いつでも" <?php 
									if ($tel_time=='いつでも' ) { 
									?> selected<?php
									}
									?>>いつでも</option>
                                    <option value="午前中" <?php 
									if ($tel_time=='午前中' ) { 
									?> selected<?php
									}
									?>>午前中</option>
                                    <option value="12-14" <?php 
									if ($tel_time=='12-14' ) { 
										?> selected<?php
									}
									?>>12-14</option>
                                    <option value="14-16" <?php 
									if ($tel_time=='14-16' ) { 
										?> selected<?php
									}
									?>>14-16</option>
                                    <option value="16-18" <?php 
									if ($tel_time=='16-18' ) { 
										?> selected<?php
									}
									?>>16-18</option>
                                    <option value="18-21" <?php 
									if ($tel_time=='18-21' ) { 
										?> selected<?php
									}
									?>>18-21</option>
                                </select>
					</li>
			</ul>


                <div class="kiyaku">
                    <p><b>【重要】お申込みをされる前に、下記個人報取得における告知・同意文、ご利用規約をよくお読みください。</b></p>
                    <div class="kiyaku_text">
                        フォン・ジャパン株式会社 (以下、「当社」という。)は、 通信・ネットワークソリューション事業、 営業事業、IT・Webソリューション事業を行っております。<br> 
                        当社は、当社の事業の用に供するすべての個人情報を適切に取扱うため、 当社全従業者が遵守すべき行動基準として本個人情報保護方針を定め、その遵守の徹底を図ることといたします。<br>
                        <br>    
                        当社は、個人情報の取扱いに関する法令、国が定める指針その他の規範を遵守するため、日本工業規格 「個人情報保護マネジメントシステム-要求事項」 (JIS Q 15001)に準拠した個人情報保護マネジメントシステムを策定し、適切に運用いたします。 <br>
                        当社は、事業の内容及び規模を考慮した適切な個人情報の取得、利用及び提供を行います。 それには特定された利用目的の達成に必要な範囲を超えた個人情報の取扱いを行わないこと及びそのための措置を講じることを含みます。<br>
                        当社は、個人情報の取扱いの全部又は一部を委託する場合は、その取扱いを委託された個人情報の安全管理が図られるよう、委託を受けた者に対する必要かつ適切な監督を行います。<br>
                        当社は、本人の同意がある場合又は法令に基づく場合を除き、個人情報を第三者に提供することはありません。<br>
                        当社は、個人情報の漏えい、滅失又はき損の防止及び是正のための措置を講じます。<br>
                        当社は、個人情報の取扱いに関する苦情及び相談への適切かつ迅速な対応に努めます。<br> 
                        また、当社が保有する開示対象個人情報の開示等の求め(利用目的の通知、 開示、訂正・追加又は削除、利用又は提供の停止）を受け付けます。<br>
                        開示等の求めの手続きにつきましては、以下の「個人情報に関する相談窓口」までご連絡ください。<br>
                        当社は、個人情報保護マネジメントシステムの継続的改善を行ないます。<br>
                        <br>
                        フォン・ジャパン株式会社<br>
                        代表取締役社長 横田 和典<br>
                        <br>
                        当社における<br>
                        個人情報の取扱いについて<br>
                        <br>
                        （個人情報保護法及びJISに基づく公表事項及び本人が容易に知り得る状態に置く事項）<br>
                        <br>
                        1.お取引先様から委託を受ける業務において取り扱う個人情報の利用目的<br>
                        ・お取引先様からの委託を受けて、「ブロードバンド・モバイル等通信サービスの販売取次業務」、 「ドメイン、サーバー等の取得代行をはじめとしたウェブ関連サービス及びデザイン関連サービス」、 「公共放送の契約に付帯する諸所の手続き及び料金回収業務」をはじめとする業務を適切に実施するため。<br>
                        <br>
                        2.お取引先様から委託を受ける業務において取り扱う個人情報<br>
                        ・「ブロードバンド・モバイル等通信サービスの販売取次業務」に関しては「市販の住宅地図」を取り扱います。<br>
                        ・「ドメイン、サーバー等の取得代行をはじめとしたウェブ関連サービス及びデザイン関連サービス」に関しては、「エンドクライアントの企業情報」を取り扱います。<br>
                        <br>
                        当社が保有する開示対象個人情報について<br>
                        <br>    
                        個人情報取り扱い事業者の氏名または名称<br>
                        <br>    
                        フォン・ジャパン株式会社<br>
                        <br>
                        すべての開示対象個人情報の利用目的<br>
                        <br>
                        当社が、通信・ネットワークソリューション事業、営業事業、 IT・webソリューション事業を主な事業としていることを踏まえて当社が取扱う個人情報の利用目的を以下のように定めます。<br>
                        <br>
                        <br>
                        1.お客様の個人情報<br>
                        ・ご契約内容を実施し、適切に管理するため<br>
                        <br>
                        2.お取引先様の個人情報<br>
                        ・お取引先様との間のご契約内容を適切に管理するため<br>
                        <br>
                        3.株主の皆様の個人情報<br>
                        ・会社法及び商法に基づく権利の行使・義務の履行のため<br>
                        ・当社から各種便宜を供与するため<br>
                        ・株主と会社の関係の円滑化を図るための各種の施策を実施するため<br>
                        ・各種法令に基づき所定の基準による株主のデータを作成する等、株主管理のため<br>
                        <br>
                        4.当社への入社を希望される皆様の個人情報<br>
                        ・就職先としてご興味をお持ちになった方並びにご応募いただいた方への採用、募集情報等の提供・連絡のため<br>
                        ・採用選考業務のため<br>
                        <br>
                        5.当社の社員の個人情報<br>
                        ・業務上の連絡、社員名簿の作成、法律上要求される諸手続(本人退職後も含む)、その他雇用管理のため。<br>
                        ・人事選考、配属先および出向、派遣先の決定のため。<br>
                        ・報酬の決定および支払、税務処理、社会保険関連の手続き、福利厚生の提供のため。<br>
                        ・ビデオ及びオンラインによるモニタリング等における安全管理措置のため。<br>
                        ・当社PR又は宣伝資料等における当社PR又は宣伝活動等のため。<br>
                        ・適正な健康管理のため。(健康診断の結果等の労働者の健康情報については、法令に基づく場合を除いて、取得、利用又は提供を行いません。)<br>
                        <br>
                        6.当社へお問合せ頂いた方の個人情報<br>
                        ・当社の接客態度等の向上のため<br>
                        ・お問い合わせやご連絡内容を正確に把握し、対処するため<br>
                        ※上記利用目的において、「ご契約内容を適切に管理するため」としているものは、「契約に入る前の段階における利用」と「契約終了後における利用」を含みます。<br>
                        <br>
                        開示対象個人情報の取扱いに関する苦情の申し出先<br>
                        <br>
                        「個人情報に関する相談窓口」（末尾に記載）<br>
                        <br>
                        認定個人情報保護団体の名称及び苦情の解決の申し出先<br>
                        <br>
                        現在当社は、認定個人情報保護団体の対象事業者ではございません。<br>
                        <br>
                        開示等の求めに応じる手続き<br>
                        <br>
                        1.開示等の求めの申し出先<br>
                        <br>
                        2.開示等の求めに際して提出すべき書面の様式その他の開示等の求めの方式<br>
                        下記を当社「個人情報に関するご相談窓口」までご送付ください。できる限り迅速に対応いたします。<br>
                        a.当社指定の「開示等の求め申請書」<br>
                        お手元にない場合は、ご連絡ください。こちらからお送りいたします。<br>
                        <br>
                        b.本人確認書類<br>
                        i.ご本人によるお申し込みの場合<br>
                        不要（後日、ご本人確認のためにご連絡することがあります。）<br>
                        ii.代理人によるお申し込みの場合<br>
                        下記の書類のうち該当するもののすべて。<br>
                        ア.親権者（または未成年被後見人)の場合<br>
                        ・本人の住所・本籍を確認できる公的証明書のコピー<br>
                        ・戸籍謄本(全部事項証明)1通のコピー<br>
                        ・代理人の住所・本籍を確認できる公的証明書のコピー<br>
                        イ.成年後見人(成年被後見人の法定代理人)の場合<br>
                        ・本人の住所を確認できる公的証明書のコピー<br>
                        ・「登記事項証明書」1通のコピー(本人の法定代理人であることがわかるもの。)<br>
                        ・代理人の住所を確認できる公的証明書のコピー<br>
                        ウ.委任状による代理人の場合 ・本人の印鑑証明書のコピー<br>
                        ・当社指定の委任状(本人の印鑑証明書で使用している印鑑を捺印したもの) （当社指定の委任状がお手元にない場合は、ご連絡ください。早急にご郵送します。<br>
                        ・代理人の住所を確認できる公的証明書のコピー(弁護士の場合は登録番号でも可)<br>
                        c.手数料<br>
                        「利用目的の通知」あるいは「開示」につきましては、1件のお申込みにつき手数料として1,000円いただきます。<br>
                        1,000円分の郵便小為替を上記書類にあわせてご同封ください。 上記の通り手数料が同封されていなかった場合は、その旨ご連絡申し上げますが、所定の期間内にお支払いいただけない場合は開示等の求めがなかったものといたします。<br>
                        なお、送付頂いた書類は原則としてご返却いたしません。                        
                        <br>
                    </div>
                    <p style="text-align:center;">個人情報取得における告知・同意文、<a href="privacy.html" target="_blank">個人情報保護方針</a>に同意します
                        <input type="checkbox" name="同意文、利用約款" value="同意する" class="validate[required]" id="agree">
                        <label for="agree" class="agree"><img src="img/check.png" alt="">
                        </label>
                    </p>
                </div>
                <div class="btn">
                    <input type="submit" name="submit" value="確認画面へ" id="submit">
                </div>
            </div>
        </form>
	</section>
	<?php include "include/footer_form.html";?>
</body>
</html>