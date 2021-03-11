<?php
    session_start();
    unset($_SESSION['dunutsCp']);
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
<!--js-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/common.js"></script>
<script src="js/index.js"></script>
<!--tag-->
<?php include "include/tag_head.html";?>
</head>
<body>
<?php include "include/tag_start.html";?>
<?php setcookie('affiliate', '', time() - 1, '/')?>
<p id="cursor"></p>
<div id="stalker"></div>

    <?php include "include/header.html";?>
    <div id="wrap">
        <section id="top">
            <article>
                <h1><img src="ta/img/spring_cp_top.png" alt="3月31日（水） 20:59までにお申し込みの方限定！春のWキャンペーン月額半額 2,189円Amazonギフト券10,000円プレゼント" class="pc">
                <img src="ta/img/spring_cp_top_sp.png" alt="3月31日（水） 20:59までにお申し込みの方限定！春のWキャンペーン月額半額 2,189円Amazonギフト券10,000円プレゼント" class="sp"></h1>
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
                    <li>
                        <a href="tel:0120-966-486"></a>
                        <span><img src="img/top_tel_ico.svg" alt=""></span>
                        <dl>
                            <dt>電話で申し込み</dt>
                            <dd>>> 0120-966-486</dd>
                        </dl>
                        <em>13:00-17:00(土日祝除く)</em>
                    </li>
                </ul>
            </article>
        </section>

        <section id="summary">
            <article>
                <h2>下り最大2Gbpsの超高速光回線</h2>
                <p>Fon光はソニーネットワークコミュニケーションズ株式会社が提供しているNURO光回線を利用したインターネットサービスです。
インターネット網からお客さまのご自宅まで弊社がサービス提供しており、高品質で安心なインターネットライフをお楽しみいただけます。
国際標準規格であるGPON※2の採用と、専用に開発されたホームゲートウェイを組み合わせたことで、個人宅向け商用サービスで下り最大2Gbpsを
実現しています。</p>
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

        <section id="recommend">
            <article>
                <ul>
                    <li class="bEffect01">
                        <a href="#summary">
                            <dl>
                                <dd>
                                    <img src="img/movie_ico.svg" alt="">
                                </dd>
                                <dt>高速回線</dt>
                                <dd>下り最大2Gbpsの超高速回線
                                    ゲームや複数人で動画も見てもサクサク！</dd>
                            </dl>
                        </a>
                    </li>
                    <li class="bEffect02">
                        <a href="#plan">
                            <dl>
                                <dd>
                                    <img src="img/money_ico.svg" alt="">
                                </dd>
                                <dt>おとくな料金</dt>
                                <dd>業界最安値級の料金プラン
                                    月々のお支払いがお得になります。</dd>
                            </dl>
                        </a>
                    </li>
                    <li class="bEffect03">
                        <a href="option">
                            <dl>
                                <dd>
                                    <img src="img/tel_ico.svg" alt="">
                                </dd>
                                <dt>魅力的なオプション</dt>
                                <dd>NURO光でんわやリモートサポートなど
                                    お客様にお楽しみいただけるオプションを用意しています。</dd>
                            </dl>
                        </a>
                    </li>
                </ul>
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
                    <h3>月額基本料金<s>¥4,378</s>
                    ↓
                    <em>¥2,189<sup>※2</sup></em></h3>
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
                                <dd>¥3,300</dd>
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
                                <dd>¥21,780</dd>
                            </dl>
                        </li>
                    </ul>
                </div>
                <p>※ 記載の金額は全て税込金額です。</p>
                <p>※1 工事費44,000 円（ 1,466 円 X 30 か月の分割払い）を、工事費割引1,466 円 X 30 か月が適用されます。明細上で相殺いたしますので、工事費は実質無料となります。</p>
                <p>※2 月額4,378円（税込）から開通～6カ月目まで月額2,189円をキャッシュバックした金額です。</p>
                <p>※ 基本工事以外の内容をご希望のお客様は以下の内容にて対応可能です。サポートセンターへお申し付けください</p>
                <p>〇屋内LAN工事：￥12,430　〇屋内電話設置工事：￥12,430　〇屋外LAN・電話工事：￥18,040</p>
            </article>
        </section>

        <section id="optionArea">
            <article>
                <h2>オプション</h2>
                <p>Fon光には様々なオプションがあります。みなさんの生活をサポートするために用意しました。</p>
                <ul>
                    <li>NURO光でんわ</li>
                    <li>ひかりTV for NURO</li>
                    <li>まとめてでんき</li>
                    <li>リモートサポート</li>
                    <li>カスペルスキーセキュリティ</li>
                </ul>
                <a href="option">詳しくはこちらから</a>
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

        <section id="spring_cp">
            <article>
                <h2>
                    <img src="ta/img/bnr.png" alt="3月31日（水） 20:59までにお申し込みの方限定！春のWキャンペーン月額半額 2,189円Amazonギフト券10,000円プレゼント" class="pc">
                    <img src="ta/img/spring_cp_top_sp.png" alt="3月31日（水） 20:59までにお申し込みの方限定！春のWキャンペーン月額半額 2,189円Amazonギフト券10,000円プレゼント" class="sp">
                </h2>
                <a href="ta/">詳しくはこちら</a>
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

    <?php include "include/footer.html";?>
</body>
</html>
