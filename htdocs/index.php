<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>fon光</title>
<meta name="robots" content="noindex" />
<meta name="viewport" id="viewport" content="width=device-width">
<meta name="description" content="">
<meta name="keywords" content="">
<link href="https://fonts.googleapis.com/css2?family=M+PLUS+1p:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- ▲ローカルに保存したjQuery本体へのリンクでももちろんOK -->
    <!--for Scroll fix header -->
    <script>
        //scroll fix header
        $(function() {
            "use strict";
            var flag = "view";

            $(window).on("scroll", function() {
                // scrollTop()が「200」より大きい場合
                //画面トップから、ナビゲーションメニューまでの高さ（ピクセル）を指定すれば、メニュースクロールで
                //消えていくタイミングでヘッダが表示されて固定される。  

                if ($(this).scrollTop() > 200) {
                    if (flag === "view") {
                        $(".fix-header").stop().css({
                            opacity: '1.0'
                        }).animate({
                            //”▲.fix-header”の部分は固定ヘッダとして表示させるブロックのID名もしくはクラス名に
                            top: 0
                        }, 500);

                        flag = "hide";
                    }
                } else {
                    if (flag === "hide") {
                        $(".fix-header").stop().animate({
                            top: "-66px",
                            opacity: 0
                        }, 500);
                        //上にあがり切ったら透過度を0%にして背景が生きるように
                        　　　　 //”▲.fix-header”の部分は固定ヘッダとして表示させるブロックのID名もしくはクラス名に
                        flag = "view";
                    }
                }
            });
        });
    </script>
</head>

<body>
    <!-- 固定ヘッダ表示用のブロック -->
    <div class="fix-header">
        <div class="fix-header-contents">
            <!-- ロゴはfloat左寄せで表示 -->
            <div id="fix-header-logo">
                <a href=""><img src="./images/sample-logo.png" alt="ete"></a>
            </div>
            <!-- メニューのブロックはfloatで右寄せ -->
            <div id="fix-header-menus" class="cf">
                <ul id="scroll-fix-menu" class="menu">
                    <li><a href="#">HOME</a></li>
                    <li><a href="#">Menu1</a></li>
                    <li><a href="#">Menu2</a></li>
                    <li><a href="#">Menu3</a></li>
                    <li><a href="#">Menu4</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- ここから常時表示させるヘッダ―部分 -->
    <header>
        <a href="＃"><img src="./images/sample-logo.png" alt="ete"></a>
    </header>

    <nav>
        <div class="nav-container">
            <ul id="gloval-nav" class="menu cf">
                <li><a href="#">HOME</a></li>
                <li><a href="#">Menu1</a></li>
                <li><a href="#">Menu2</a></li>
                <li><a href="#">Menu3</a></li>
                <li><a href="#">Menu4</a></li>
            </ul>
        </div>
        <!-- /.nav-container -->
    </nav>

    <div>
        <section id="top">
            <article>
                <h1>fon光で快適な<br>インターネット生活を送ろう</h1>
                <h2><spna>月額</spna>¥3,980</h2>
                <p>超高速インターネット回線</p>
                <p>下り最大 2Gbps</p>
                <ul>
                    <li>
                        <a href=""></a>
                        <dl>
                            <dt>webでお申し込み</dt>
                            <dd>>> 今すぐこちらから</dd>
                        </dl>
                    </li>
                    <li>
                        <a href=""></a>
                        <dl>
                            <dt>webでお申し込み</dt>
                            <dd>>> 今すぐこちらから</dd>
                        </dl>
                    </li>
                    <li>
                        <a href=""></a>
                        <dl>
                            <dt>webでお申し込み</dt>
                            <dd>>> 今すぐこちらから</dd>
                        </dl>
                    </li>
                </ul>
            </article>
        </section>

        <section>
            <article>
                <h2>下り最大2Gbpsの超高速光回線</h2>
                <p>Fon光は、NTT東日本・NTT西日本の光ファイバー回線(ダークファイバー)を利用したインターネットサービスです。
インターネット網からお客さまのご自宅まで弊社がサービス提供しており、高品質で安心なインターネットライフをお楽しみいただけます。 
国際標準規格であるGPON※2の採用と、専用に開発されたホームゲートウェイを組み合わせたことで、個人宅向け商用サービスで下り最大2Gbpsを
実現しています。</p>
                <img src="" alt="">
                <ul>
                    <li>※1 機器使用時の通信速度はお客さまの通信環境と規格により異なります。 (技術規格上の最大値でありお客さま宅内での実使用速度を示すものではありません)となります。</li>
                    <li>※2 GPONとは：PON(Passive Optical Network)とは1芯の光ファイバーを複数ユーザーで共用する伝送技術です。
GPON(Gigabit capable passive optical networks)とはITU-T標準化規格G.984シリーズで規定された伝送技術で、通信速度は最大2.5Gbpsまで対応しています。</li>
                </ul>
            </article>
        </section>

        <section>
            <article>
                <ul>
                    <li>
                        <dl>
                            <dd>
                                <img src="" alt="">
                            </dd>
                            <dt>高速回線</dt>
                            <dd>下り最大2Gbpsの超高速回線
ゲームや複数人で動画も見てもサクサク！</dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dd>
                                <img src="" alt="">
                            </dd>
                            <dt>おとくな料金</dt>
                            <dd>業界最安値級の料金プラン
月々のお支払いがお得になります。</dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dd>
                                <img src="" alt="">
                            </dd>
                            <dt>威力的なオプション</dt>
                            <dd>NURO光でんわやリモートサポートなど
お客様にお楽しみいただけるオプションを用意しています。</dd>
                        </dl>
                    </li>
                </ul>
            </article>
        </section>

        <section>
            <article>
                <h2>料金</h2>
                <p>fon光は、下り2Gbpsの超高速光回線と、無線LANがついて月額3,980円（税抜）でご利用頂ける光ファイバーインターネットサービスです。
音楽も動画もゲームも、ダウンロード/アップロード共にストレス無く快適にご利用頂けます。工事の後、細かい設定無くすぐにお使い頂くことが可能です。</p>
                <h3>月額基本料金<em>¥3,980</em></h3>
                <ul>
                    <li>
                        <dl>
                            <dt>工事費</dt>
                            <dd>無料</dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt>契約事務手数料</dt>
                            <dd>¥3,000</dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt>契約期間</dt>
                            <dd>2年更新</dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt>契約解除料</dt>
                            <dd>¥19,800</dd>
                        </dl>
                    </li>
                </ul>
            </article>
        </section>

        <section>
            <article>
                <h2>オプション</h2>
                <ul>
                    <li>NURO光でんわ</li>
                    <li>リモートサポート</li>
                </ul>
                <div>
                    <div>
                        <img src="" alt="">
                    </div>
                    <div>
                        <dl>
                            <dt>NURO光でんわ</dt>
                            <dd>「NURO 光 でんわ」は「NURO 光」でご利用いただけるソニーネットワークコミ
ュニケーションズ提供の月額基本料・通話料がおトクなIP電話サービスです。</dd>
                        </dl>
                        <dl>
                            <dt>月額基本料金</dt>
                            <dd>【関東・北海道エリア】500円<br>
【関西・東海・九州エリア】300円</dd>
                        </dl>
                        <dl>
                            <dt>規約</dt>
                            <dd>
                                <ul>
                                    <li><a href="">NURO 光 でんわ規約約款</a></li>
                                    <li><a href="">NURO 光 でんわ重要事項説明</a></li>
                                    <li><a href="">ホワイトコール 24 重要事項説明</a></li>
                                </ul>
                            </dd>
                        </dl>
                        <a href="">今すぐお申し込み</a>
                    </div>
                </div>
                <div>
                    <div>
                        <img src="" alt="">
                    </div>
                    <div>
                        <dl>
                            <dt>リモートサポート</dt>
                            <dd>「NURO 光 でんわ」は「NURO 光」でご利用いただけるソニーネットワークコミ
ュニケーションズ提供の月額基本料・通話料がおトクなIP電話サービスです。</dd>
                        </dl>
                        <dl>
                            <dt>月額基本料金</dt>
                            <dd>【関東・北海道エリア】500円<br>
【関西・東海・九州エリア】300円</dd>
                        </dl>
                        <dl>
                            <dt>規約</dt>
                            <dd>
                                <ul>
                                    <li><a href="">NURO 光 でんわ規約約款</a></li>
                                    <li><a href="">NURO 光 でんわ重要事項説明</a></li>
                                    <li><a href="">ホワイトコール 24 重要事項説明</a></li>
                                </ul>
                            </dd>
                        </dl>
                        <a href="">今すぐお申し込み</a>
                    </div>
                </div>
            </article>
        </section>

        <section>
            <article>
                <h2>お申し込みの流れ</h2>
                <ul>
                    <li>
                        <dl>
                            <dd><img src="" alt=""></dd>
                            <dt>お申し込み</dt>
                            <dd>お手持ちのスマートフォン、
電話、パソコンよりお申し込み
頂けます。</dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dd><img src="" alt=""></dd>
                            <dt>工事日確定</dt>
                            <dd>お手持ちのスマートフォン、
電話、パソコンよりお申し込み
頂けます。</dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dd><img src="" alt=""></dd>
                            <dt>工事完了</dt>
                            <dd>お手持ちのスマートフォン、
電話、パソコンよりお申し込み
頂けます。</dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dd><img src="" alt=""></dd>
                            <dt>利用開始</dt>
                            <dd>お手持ちのスマートフォン、
電話、パソコンよりお申し込み
頂けます。</dd>
                        </dl>
                    </li>
                </ul>
            </article>
        </section>

        <section>
            <article>
                <h2>サービス提供エリア</h2>
                <div>北海道
関東（東京、神奈川、埼玉、千葉、茨城、栃木、群馬）
東海（愛知、静岡、岐阜、三重）
関西（大阪、兵庫、京都、滋賀、奈良）
九州（福岡、佐賀）
※一部エリアを除く
                <a href="">エリア検索する</a>
                </div>
            </article>
        </section>

        <section>
            <article>
                <ul>
                    <li>
                        <img src="" alt="">
                        <h3>ご不明な点は</h3>
                        <p>まずは、よくある質問事項をご確認ください。</p>
                        <a href="">詳しくはこちらから</a>
                    </li>
                    <li>
                        <img src="" alt="">
                        <h3>お困りの場合は</h3>
                        <p>お困りの問題に対する解決策をご案内します。</p>
                        <a href="">お電話は0120-966-486まで</a>
                        <a href="">メールでのお問い合わせはこちらから</a>
                    </li>
                </ul>
            </article>
        </section>
    </div>

    <footer>
        <footer>
            <div>
                <img src="img/" alt="fon光">
                フォン・ジャパン株式会社<br>
電気通信事業者番号：第A-18-9032号<br>
代理店届出番号：C2030088
            </div>
            <div>
                <ul>
                    <li><a href="">会社概要</a></li>
                    <li><a href="">個人情報保護方針</a></li>
                    <li><a href="">障害・メンテナンス情報</a></li>
                    <li><a href="">よくある質問</a></li>
                    <li><a href="">お申し込み</a></li>
                    <li><a href="">お問い合わせ</a></li>
                </ul>
                <div>
                    <ul>
                        <li><a href=""><img src="img/" alt="twitter"></a></li>
                        <li><a href=""><img src="img/" alt="LINE"></a></li>
                        <li><a href=""><img src="img/" alt="facebook"></a></li>
                    </ul>
                    <small>Copyright @ 2020 Fon japan.</small>
                </div>
            </div>
        </footer>
    </footer>
</body>
</html>
