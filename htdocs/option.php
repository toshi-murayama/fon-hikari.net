<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>オプション | Fon光 超高速光回線インターネット</title>
<meta name="viewport" id="viewport" content="width=device-width">
<meta name="description" content="月額3,980円！Fon光で快適なインターネット生活を送ろう">
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
<script src="js/option.js"></script>
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
        <section id="title" class="option_img">
            <article>
                <h1>OPTION</h1>
            </article>
        </section>
        <section id="option">
            <article>
                <h2>オプション</h2>
                <ul>
                    <li>
                        <input type="radio" name="option_btn" id="button1" checked>
                        <label for="button1">
                            <img src="img/hikaritel_ico.svg" alt="NURO光でんわ">NURO光でんわ
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="option_btn" id="button2">
                        <label for="button2">
                            <img src="img/support_ico.svg" alt="リモートサポート">リモートサポート
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="option_btn" id="button3">
                        <label for="button3">
                            <img src="img/hikaritv_ico.svg" alt="リモートサポート">ひかりTV for NURO
                        </label>
                    </li>
                </ul>
                <div id="hikari_tel" class="box">
                    <div class="boxL">
                        <img src="img/hikaritel_img.jpg" alt="">
                    </div>
                    <div class="boxR">
                        <dl>
                            <dt>NURO光でんわ</dt>
                            <dd>「NURO 光 でんわ」は「NURO 光」でご利用いただけるソニーネットワークコミ
ュニケーションズ提供の月額基本料・通話料がおトクなIP電話サービスです。</dd>
                        </dl>
                        <dl>
                            <dt>月額基本料金</dt>
                            <dd>【関東・北海道エリア】500円(税別)<br>
【関西・東海・九州エリア】300円(税別)</dd>
                        </dl>
                        <dl>
                            <dt>規約</dt>
                            <dd>
                                <ul>
                                    <li><a href="pdf/option/tel_kiyaku.pdf" target="_blank">NURO 光 でんわ規約約款</a></li>
                                    <li><a href="pdf/option/tel_jyusetsu.pdf" target="_blank">NURO 光 でんわ重要事項説明</a></li>
                                    <li><a href="pdf/option/tel_wc24.pdf" target="_blank">ホワイトコール 24 重要事項説明</a></li>
                                </ul>
                            </dd>
                        </dl>
                        <a href="area" class="btn">今すぐお申し込み</a>
                    </div>
                </div>
                <div id="remote_support" class="box">
                    <div class="boxL">
                        <img src="img/remotesupport_img.jpg" alt="リモートサポート">
                    </div>
                    <div class="boxR">
                        <dl>
                            <dt>リモートサポート</dt>
                            <dd>お客さまに対して、上記サービス用の電話番号を通知することにより日本語にて実施される、電話サポートサービスおよび遠隔サポートサービス。</dd>
                        </dl>
                        <dl>
                            <dt>月額基本料金</dt>
                            <dd>500円(税別)</dd>
                        </dl>
                        <dl>
                            <dt>規約</dt>
                            <dd>
                                <ul>
                                    <li><a href="pdf/option/remote_jyusetu.pdf">リモートサポート重要事項説明</a></li>
                                </ul>
                            </dd>
                        </dl>
                        <a href="area" class="btn">今すぐお申し込み</a>
                    </div>
                </div>
                <div id="hikari_tv" class="box">
                    <div class="boxL">
                        <img src="img/hikaritv_img.jpg" alt="ひかりTV">
                    </div>
                    <div class="boxR">
                        <dl>
                            <dt>ひかりTV for NURO</dt>
                            <dd>ひかりＴＶは、自宅のテレビを光回線につなげるだけ！<br>
                            80ch以上の専門チャンネルと、約73,000本のビデオオンデマンドなどが楽しめる、総合ライフエンターテインメントサービスです。<br>
                            光回線と一緒に申し込むことで、「高画質」を「安く」楽しめます。</dd>
                        </dl>
                        <dl>
                            <dt>お値うちプラン</dt>
                            <dd>月額3,500円(税別)</dd>
                            <dt>テレビおすすめプラン</dt>
                            <dd>月額2,500円(税別)</dd>
                            <dt>ビデオざんまいプラン</dt>
                            <dd>月額2,500円(税別)</dd>
                            <dt>基本放送プラン</dt>
                            <dd>月額1,000円(税別)</dd>
                        </dl>
                        <dl>
                            <dt>さらに「2ねん割」適用で3〜24ヶ月目まで月額基本料金が1,000円割引！</dt>
                            <dd><a href="https://www.nuro.jp/hikari/fvno/tv/" target="_blank">※詳細はこちらから</a></dd>
                        </dl>
                        <a href="area" class="btn">今すぐお申し込み</a>
                    </div>
                </div>
            </article>
            <article>
                <div class="flex">
                    <h3><img src="img/denki_ico.svg" alt="まとめてでんき">まとめてでんき</h3>
                </div>
                <div class="box">
                    <div class="boxL">
                        <img src="img/denki_img.png" alt="まとめてでんき">
                    </div>
                    <div class="boxR">
                        <dl>
                            <dt>まとめてでんき</dt>
                            <dd>
                                使用量に関わらず、電気とFon光回線をお安く！<br>
                                電気とインターネットは生活に必要なライフライン。<br>
                                賢く選んで使いましょう！
                            </dd>
                        </dl>
                        <dl>
                            <dt>特典１</dt>
                            <dd>Fon光の回線使用料が500円引き</dd>
                        </dl>
                        <dl>
                            <dt>特典２</dt>
                            <dd>電気代が今よりもお安く</dd>
                            <dd><a href="http://hikarisvc.jp/denki/" target="_blank">※詳細はこちらから</a></dd>
                        </dl>
                        <a href="area" class="btn">今すぐお申し込み</a>
                    </div>
                </div>
                <ul class="annotation">
                    <li>※まとめてでんきのお申込みはこちらのサイトからのお申込みが対象になります。<br>
                        新規申込の方は、申込の際にオプションを選択してください。すでにFon光を使われている方は、お問い合わせフォームよりお知らせください。
                    </li>
                </ul>
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
