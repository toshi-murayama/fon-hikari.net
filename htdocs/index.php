<?php
    session_start();
    unset($_SESSION['dunutsCp']);
    require_once('../lib/Param/Pref.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Fon光 超高速光回線インターネット</title>
<meta name="viewport" id="viewport" content="width=device-width">
<meta name="description" content="月額4,378円！Fon光で快適なインターネット生活を送ろう">
<meta name="keywords" content="Fon,Fon光,nuro,nuro光,NTT,プロバイダ,高速,2Gbps,WiFi,ルーター,WiMAX,Softbank,縛りなしWiF">
<meta name="theme-color" content="#EC7103">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<link rel="shortcut icon" href="img/favicon.ico" />
<?php include "include/ogp.html";?>
<!--style-->
<link href="https://fonts.googleapis.com/css2?family=M+PLUS+1p:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">

<link rel="stylesheet" href="css/style_lp.css">
<link rel="stylesheet" href="css/validationEngine.jquery.css">
<link rel="stylesheet" href="css/slick.css">
<link rel="stylesheet" href="css/slick-theme.css">
<!--js-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/slick.js"></script>
<script src="js/common.js"></script>
<script src="js/index.js"></script>

<script src="js/lp_index.js"></script>
<script src="js/jquery.validationEngine.js"></script>
<script src="js/jquery.validationEngine-ja.js"></script>
<script src="js/jquery.jpostal.min.js"></script>
<script src="js/ajaxzip3.js"></script>
<!--tag-->
<?php include "include/tag_head.html";?>
</head>
<body>
<?php include "include/tag_start.html";?>
<?php setcookie('affiliate', '', time() - 1, '/')?>

    <?php include "include/header.html";?>
    <div id="wrap">
        <section id="top">
            <article>
                <div id="firstview">
                    <div class="fv1">
                        <div class="content">
                            <h1>Fon光で快適な<br>インターネット生活を送ろう</h1>
                            <h2>月額<span>¥4,378</span></h2>
                            <p>※ 記載の金額は全て税込金額です。</p>
                            <div></div>
                            <p>超高速インターネット回線</p>
                            <p>下り最大 2Gbps</p>
                        </div>
                    </div>
                    <div class="fv2">
                        <div class="content">
                            <h1>22Fon光で快適な<br>インターネット生活を送ろう</h1>
                            <h2>月額<span>¥4,378</span></h2>
                            <p>※ 記載の金額は全て税込金額です。</p>
                            <div></div>
                            <p>超高速インターネット回線</p>
                            <p>下り最大 2Gbps</p>
                        </div>
                    </div>
                </div>
                <ul>
                    <li>
                        <a href="area"></a>
                        <span><img src="img/top_app_ico.svg" alt=""></span>
                        <dl>
                            <dt>webでお申し込み</dt>
                            <dd>>> 今すぐこちらから</dd>
                        </dl>
                    </li>
                    <li>
                        <a href="contact"></a>
                        <span><img src="img/top_contact_ico.svg" alt=""></span>
                        <dl>
                            <dt>メールでお問い合わせ</dt>
                            <dd>>> ご不明点をサポートします</dd>
                        </dl>
                    </li>
                </ul>
            </article>
        </section>

        <section id="summary">
            <article>
                <h2>下り最大2Gbpsの超高速光回線</h2>
                <p>Fon光はソニーネットワークコミュニケーションズ株式会社が提供しているNURO光回線を利用した超高速の光ファイバーサービスです。<br>
                個人宅向け商用FYYHサービスとしては超高速の、下り最大2Gbpsの高速回線を実現しました。<br>
                動画や音楽コンテンツファイルのダウンロード、ストリーミングサービス、ブラウジングもストレスなく快適に。<br>
                あなたのインターネットライフをより一層楽しい世界へと導きます。</p>
                <div class="speed_img">
                    <div class="fon">
                        <div class="provider"><img src="img/fon_logo_w.svg" alt="Fon光"></div>
                        <div class="border ani1"><span></span></div>
                        <div class="speed">2Gbps</div>
                    </div>
                </div>
                <h3>時代が求めるインターネットで<br class="sp">ストレスフリー！<br>
                高速無線LAN(Wi-Fi)標準装備 <span>無料！！</span></h3>
                <ul class="flex">
                    <li class="animation01">
                        <dl>
                            <dd>
                                <img src="img/summary_ico01.png" alt="スマートフォン">
                            </dd>
                            <dt>スマートフォン</dt>
                        </dl>
                    </li>
                    <li class="animation02">
                        <dl>
                            <dd>
                                <img src="img/summary_ico02.png" alt="ゲーム機器">
                            </dd>
                            <dt>ゲーム機器</dt>
                        </dl>
                    </li>
                    <li class="animation03">
                        <dl>
                            <dd>
                                <img src="img/summary_ico03.png" alt="パソコン">
                            </dd>
                            <dt>パソコン</dt>
                        </dl>
                    </li>
                    <li class="animation04">
                        <dl>
                            <dd>
                                <img src="img/summary_ico04.png" alt="スマートホーム">
                            </dd>
                            <dt>スマートホーム</dt>
                        </dl>
                    </li>
                    <li class="animation05">
                        <dl>
                            <dd>
                                <img src="img/summary_ico05.png" alt="テレビ">
                            </dd>
                            <dt>テレビ</dt>
                        </dl>
                    </li>
                    <li class="animation06">
                        <dl>
                            <dd>
                                <img src="img/summary_ico06.png" alt="コンポ">
                            </dd>
                            <dt>コンポ</dt>
                        </dl>
                    </li>
                    <li class="animation07">
                        <dl>
                            <dd>
                                <img src="img/summary_ico07.png" alt="タブレット">
                            </dd>
                            <dt>タブレット</dt>
                        </dl>
                    </li>
                </ul>
                <ul>
                    <li>※1 機器使用時の通信速度はお客さまの通信環境と規格により異なります。 (技術規格上の最大値でありお客さま宅内での実使用速度を示すものではありません)となります。</li>
                    <li>※2 GPONとは：PON(Passive Optical Network)とは1芯の光ファイバーを複数ユーザーで共用する伝送技術です。
GPON(Gigabit capable passive optical networks)とはITU-T標準化規格G.984シリーズで規定された伝送技術で、通信速度は最大2.5Gbpsまで対応しています。</li>
                </ul>
            </article>
        </section>

        <section id="estimate" class="dot">
            <article>
                <h2>簡単見積もり</h2>
                <p>すぐに見積もり額を表示します。専門スタッフが詳しい料金などをお電話にてお伝えいたします。詳しくは<a target="_blank" href="/privacy.php">こちら</a>。</p>
                <div id="formBox1">
                    <form action="" id="lp_form1">
                        <div class="formContent">
                            <ul>
                                <li>
                                    <dl>
                                        <dt>回線</dt>
                                        <dd>
                                            <input type="radio" name="fonHikariLine" value="Fon光回線" id="" checked><label for="">Fon光</label>
                                        </dd>
                                    </dl>
                                </li>
                            </ul>
                            <ul class="option">
                                <li>
                                    <dl>
                                        <dt>オプション</dt>
                                        <dd>
                                            <input type="checkbox" name="hikariPhone" value="あり" id="hikariPhone"><label for="hikariPhone">ひかり電話</label>
                                            <input type="checkbox" name="remortSupport" value="あり" id="remortSupport"><label for="remortSupport">リモートサポート</label>
                                            <br>
                                            <input type="checkbox" name="hikariTVforNURO" value="あり" id="hikariTVforNURO"><label for="hikariTVforNURO">ひかりTV for NURO</label>
                                            <input type="checkbox" name="collectivelyElectricity" value="あり" id="collectivelyElectricity"><label for="collectivelyElectricity">まとめでんき</label>
                                        </dd>
                                    </dl>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <dl>
                                        <dt>お名前</dt>
                                        <dd>
                                            <input type="text" name="name" value="" placeholder="フォン太郎" class="validate[required]">
                                        </dd>
                                    </dl>
                                </li>
                                <li>
                                    <dl>
                                        <dt>フリガナ</dt>
                                        <dd>
                                            <input type="text" name="nameKana" value="" placeholder="フォンタロウ" class="validate[required],[custom[zenkaku_kana]]">
                                        </dd>
                                    </dl>
                                </li>
                                <li>
                                    <dl>
                                        <dt>電話番号</dt>
                                        <dd>
                                            <input type="tel" name="phoneNumber" value="" placeholder="08012345678(ハイフンなし)" class="validate[required],[custom[onlyNumberSp]]">
                                        </dd>
                                    </dl>
                                </li>
                                <li>
                                    <dl>
                                        <dt>郵便番号</dt>
                                        <dd>
                                            <input type="tel" name="postalCode" value="" placeholder="1231234(ハイフンなし)" class="validate[required],[custom[zip]]" minlength='7' maxlength='7' oninput="value = value.replace(/[^0-9]+/i,'');" onkeyup="AjaxZip3.zip2addr(this,'','installationPref','address');">
                                        </dd>
                                    </dl>
                                </li>
                                <li>
                                    <dl>
                                        <dt>都道府県</dt>
                                        <dd>
                                            <select name="installationPref" id="prefectures" class="validate[required]">
                                                <option value="" selected>都道府県を選択</option>

                                            <?php foreach(Pref::PREFS as $pref) { ?>

                                                <option value=<?php print $pref?>><?php print $pref?></option>

                                            <?php } ?>

                                            </select>
                                        </dd>
                                    </dl>
                                </li>
                                <li>
                                    <dl>
                                        <dt>以降の住所</dt>
                                        <dd>
                                            <input type="text" name="address" value="" placeholder="◯◯区池袋1-1-1" class="validate[required]">
                                        </dd>
                                    </dl>
                                </li>
                                <li>
                                    <dl>
                                        <dt>建物</dt>
                                        <dd>
                                            <input type="radio" name="buildingType" value="戸建" id="buildingType_c" checked><label for="buildingType_c">戸建</label>
                                            <input type="radio" name="buildingType" value="集合" id="buildingType_d"><label for="buildingType_d">集合</label>
                                        </dd>
                                    </dl>
                                </li>
                                <li>
                                    <dl>
                                        <dt>建物名</dt>
                                        <dd>
                                            <input type="text" name="buildingName" value="" placeholder="Fonビル1F">
                                        </dd>
                                    </dl>
                                </li>
                            </ul>
                            <button type="button" id="send_mixdata1">お見積りをする</button>
                        </div>
                    </form>
                </div>
            </article>
        </section>

        <section id="plan">
            <article>
                <div class="box">
                    <h2>料金</h2>
                    <p>Fon光は、下り2Gbpsの超高速光回線と、無線LANがついて月額4,378円でご利用頂ける光ファイバーインターネットサービスです。
    音楽も動画もゲームも、ダウンロード/アップロード共にストレス無く快適にご利用頂けます。工事の後、細かい設定無くすぐにお使い頂くことが可能です。</p>
                </div>
                <div class="box">
                    <h3>月額基本料金<em>3,980円</em><span>(税込4,378円)</span></h3>
                    <ul>
                        <li>
                            <img src="img/koji_ico.svg" alt="">
                            <dl>
                                <dt>工事費</dt>
                                <dd>無料<sup>※1</sup></dd>
                            </dl>
                        </li>
                        <li>
                            <img src="img/doc_ico.svg" alt="">
                            <dl>
                                <dt>契約事務手数料</dt>
                                <dd>¥3,000
                                <small>(¥3,300税込)</small></dd>
                            </dl>
                        </li>
                        <li>
                            <img src="img/calender_ico.svg" alt="">
                            <dl>
                                <dt>契約期間</dt>
                                <dd>2年更新</dd>
                            </dl>
                        </li>
                        <li>
                            <img src="img/x_ico.svg" alt="">
                            <dl>
                                <dt>契約解除料</dt>
                                <dd>¥19,800
                                <small>(¥21,780税込)</small></dd>
                            </dl>
                        </li>
                    </ul>
                </div>
                <p>※ 記載の金額は全て税込金額です。</p>
                <p>※1 工事費44,000 円（ 1,466 円 X 30 か月の分割払い）を、工事費割引1,466 円 X 30 か月が適用されます。明細上で相殺いたしますので、工事費は実質無料となります。</p>
                <p>※ 基本工事以外の内容をご希望のお客様は以下の内容にて対応可能です。サポートセンターへお申し付けください</p>
                <p>〇屋内LAN工事：￥12,430　〇屋内電話設置工事：￥12,430　〇屋外LAN・電話工事：￥18,040</p>
            </article>
        </section>

        <section id="recommend">
            <article>
                <h2>インターネットを使うなら<img src="img/fon_logo.svg" alt="Fon光">がおすすめ!</h2>
                <div class="box">
                    <div class="boxL">
                        <img src="img/recommend_img01.svg" alt="">
                    </div>
                    <div class="boxR">
                        <dl>
                            <dt>下り2Gbpsの高速回線</dt>
                            <dd>大容量を使うゲームのダウンロードや、NET FLIXなどでの映画鑑賞など、家族みんなのインターネットがノンストレス。</dd>
                        </dl>
                    </div>
                </div>
                <div class="box">
                    <div class="boxL">
                        <img src="img/recommend_img02.svg" alt="">
                    </div>
                    <div class="boxR">
                        <dl>
                            <dt>ずーっと定額安心価格</dt>
                            <dd>一定期間限定割引の、のちのち高くなるわかりにくい料金ではなく、最初から3,980円(4,378円税込)の定額安心価格。プロバイダ料金もかかりません。
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="box">
                    <div class="boxL">
                        <img src="img/recommend_img03.svg" alt="">
                    </div>
                    <div class="boxR">
                        <dl>
                            <dt>セットでお得に使える</dt>
                            <dd>ソフトバンクのスマホ割引や、フォン・ジャパンで運営するポケットWiFiとのセット割引で、おうちの通信をまとめてお得に使えます。多彩なオプションもご用意しております。<br>
                            <a href="option">お得な特典付きオプションについてこちら</a></dd>
                        </dl>
                    </div>
                </div>
            </article>
        </section>

        <section id="flow">
            <article class="pc">
                <h2>お申し込みの流れ</h2>
                <ul>
                    <li>
                        <dl>
                            <dd><img src="img/flow_ico01.svg" alt=""></dd>
                            <dt>1.お申し込み</dt>
                            <dd>お手持ちのスマートフォン、電話、パソコンよりお申し込み頂けます。</dd>
                        </dl>
                    </li>
                    <div class="triangle"></div>
                    <li>
                        <dl>
                            <dd><img src="img/flow_ico02.svg" alt=""></dd>
                            <dt>2.工事日確定</dt>
                            <dd>お客様のご都合の良い日で工事日を確定させます。</dd>
                        </dl>
                    </li>
                    <div class="triangle"></div>
                    <li>
                        <dl>
                            <dd><img src="img/flow_ico03.svg" alt=""></dd>
                            <dt>3.工事完了</dt>
                            <dd>当日、工事作業員にて工事を行います。</dd>
                        </dl>
                    </li>
                    <div class="triangle"></div>
                    <li>
                        <dl>
                            <dd><img src="img/flow_ico04.svg" alt=""></dd>
                            <dt>4.利用開始</dt>
                            <dd>モデムの設定のちルーター等について高速回線を体験しましょう。</dd>
                        </dl>
                    </li>
                </ul>
                <p>※NURO光の回線を現在ご利用頂いているお客様につきましてはお申込みができない可能性がございます。<br>カスタマーセンターにて確認させて頂きますので、こちらよりお問い合わせ下さいませ。</p>
                <a class="flow_btn" href="area">お申し込みはこちら</a>
            </article>
            <article class="sp">
                <h2>お申し込みの流れ</h2>
                <ul>
                    <li>
                        <img src="img/flow_ico01.svg" alt="">
                        <dl>
                            <dt>1.お申し込み</dt>
                            <dd>お手持ちのスマートフォン、電話、パソコンよりお申し込み頂けます。</dd>
                        </dl>
                    </li>
                    <div class="triangle_sp"></div>
                    <li>
                        <img src="img/flow_ico02.svg" alt="">
                        <dl>
                            <dt>2.工事日確定</dt>
                            <dd>お客様のご都合の良い日で工事日を確定させます。</dd>
                        </dl>
                    </li>
                    <div class="triangle_sp"></div>
                    <li>
                        <img src="img/flow_ico03.svg" alt="">
                        <dl>
                            <dt>3.工事完了</dt>
                            <dd>当日、工事作業員にて工事を行います。</dd>
                        </dl>
                    </li>
                    <div class="triangle_sp"></div>
                    <li>
                        <img src="img/flow_ico04.svg" alt="">
                        <dl>
                            <dt>4.利用開始</dt>
                            <dd>モデムの設定のちルーター等について高速回線を体験しましょう。</dd>
                        </dl>
                    </li>
                </ul>
                <a class="flow_btn" href="area">お申し込みはこちら</a>
            </article>
        </section>

        <section id="mobileWifi">
            <article>
                <h2>お引越し期間中のインターネットもWiFiレンタルをお得にご提供！</h2>
                <div class="content">
                    <div class="boxL">
                        <img src="img/denki_ico.svg" alt="">
                    </div>
                    <div class="boxL">
                        現在の開通期間目安<br>
                        戸建の場合：1〜2ヶ月
                        集合住宅の場合：1〜3ヶ月
                    </div>
                </div>
                <div class="btnArea">
                    <a href="area.php">お申し込みはこちら</a>
                    <a href="contact.php">お問い合わせはこちら</a>
                </div>
            </article>
        </section>

        <section id="footerForm" class="dot">
            <article>
                <div id="fromBox">
                    <h2>まずは無料でエリア確認</h2>
                    <p>専門スタッフよりお電話にてお答えします。詳しくは<a href="../privacy.php" target="_blank">こちら</a></p>
                    <form action="" id="lp_form2">
                        <div class="formContent">
                            <ul>
                                <li>
                                    <dl>
                                        <dt>お名前<span>必須</span></dt>
                                        <dd>
                                            <input type="text" name="name" value="" placeholder="フォン太郎" class="validate[required]">
                                        </dd>
                                    </dl>
                                </li>
                                <li>
                                    <dl>
                                        <dt>フリガナ<span>必須</span></dt>
                                        <dd>
                                            <input type="text" name="nameKana" value="" placeholder="フォンタロウ" class="validate[required],[custom[zenkaku_kana]]">
                                        </dd>
                                    </dl>
                                </li>
                                <li>
                                    <dl>
                                        <dt>電話番号<span>必須</span></dt>
                                        <dd>
                                            <input type="tel" name="phoneNumber" value="" placeholder="08012345678(ハイフンなし)" class="validate[required],[custom[onlyNumberSp]]">
                                        </dd>
                                    </dl>
                                </li>
                                <li>
                                    <dl>
                                        <dt>郵便番号<span>必須</span></dt>
                                        <dd>
                                            <input type="tel" name="postalCode" value="" placeholder="1231234(ハイフンなし)" class="validate[required],[custom[zip]]"  minlength='7' maxlength='7' oninput="value = value.replace(/[^0-9]+/i,'');" onkeyup="AjaxZip3.zip2addr(this,'','installationPref','address');">
                                        </dd>
                                    </dl>
                                </li>
                                <li>
                                    <dl>
                                        <dt>都道府県<span>必須</span></dt>
                                        <dd>
                                            <select name="installationPref" id="prefectures" class="validate[required]">
                                                <option value="" selected>都道府県を選択</option>

                                            <?php foreach(Pref::PREFS as $pref) { ?>

                                                <option value=<?php print $pref?>><?php print $pref?></option>

                                            <?php } ?>

                                            </select>
                                        </dd>
                                    </dl>
                                </li>
                                <li>
                                    <dl>
                                        <dt>以降の住所<span>必須</span></dt>
                                        <dd>
                                            <input type="text" name="address" value="" placeholder="◯◯区池袋1-1-1" class="validate[required]">
                                        </dd>
                                    </dl>
                                </li>
                                <li>
                                    <dl>
                                        <dt>建物<span>必須</span></dt>
                                        <dd>
                                            <input type="radio" name="buildingType" value="戸建" id="buildingType_a" checked><label for="buildingType_a">戸建</label>
                                            <input type="radio" name="buildingType" value="集合" id="buildingType_b"><label for="buildingType_b">集合</label>
                                        </dd>
                                    </dl>
                                </li>
                                <li>
                                    <dl>
                                        <dt>建物名</dt>
                                        <dd>
                                            <input type="text" name="buildingName" value="" placeholder="Fonビル1F">
                                        </dd>
                                    </dl>
                                </li>
                            </ul>
                            <button type="button" id="send_mixdata2">エリア確認</button>
                        </div>
                    </form>
                </div>
            </article>
        </section>

        <section id="provide">
            <article>
                <h2>サービス提供エリア</h2>
                <div class="box">
                    <div class="boxL">北海道<br>
    関東（東京、神奈川、埼玉、千葉、茨城、栃木、群馬）<br>
    東海（愛知、静岡、岐阜、三重）<br>
    関西（大阪、兵庫、京都、滋賀、奈良）<br>
    九州（福岡、佐賀）<br>
    ※一部エリアを除く
                    <a href="area">エリア検索する</a>
                </div>
                <div class="boxR">
                    <img src="img/map.svg" alt="map">
                </div>
                </div>
            </article>
        </section>

        <section id="support">
            <article>
                <ul>
                    <li>
                        <div class="imgBox"><img src="img/support_img01.svg" alt=""></div>
                        <h3>ご不明な点は</h3>
                        <p>まずは、よくある質問事項をご確認ください。</p>
                        <a href="faq">詳しくはこちらから</a>
                    </li>
                    <li>
                        <div class="imgBox"><img src="img/support_img02.png" alt=""></div>
                        <h3>お困りの場合は</h3>
                        <p>お困りの問題に対する解決策をご案内します。</p>
                        <a href="tel:0120-966-486">お電話は0120-966-486まで</a><br>
                        <a href="contact">メールでのお問い合わせはこちらから</a>
                    </li>
                </ul>
            </article>
        </section>
    </div>

    <!-- モーダルエリアここから -->
    <section id="modalArea" class="modalArea">
        <div id="modalBg" class="modalBg"></div>
        <div class="modalWrapper">
            <div class="modalContents">
                <div id="mixdata_response">
                    <!-- 結果を出力する -->
                </div>
            </div>
            <div id="closeModal" class="closeModal" style="font-size: 40px;">
                ×
            </div>
        </div>
    </section>

    <?php include "include/footer.html";?>
</body>
</html>
