<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>FAQ | Fon光 超高速光回線インターネット</title>
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
<link rel="stylesheet" href="css/other.css">
<!--js-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/common.js"></script>
<script src="js/jquery.cookie.js"></script>
<script>
	$(function(){
  $('a[href^="#"]').click(function(){
    //スクロールのスピード
    var speed = 600;
    //リンク元を取得
    var href= $(this).attr("href");
    //リンク先を取得
    var target = $(href == "#" || href == "" ? 'html' : href);
    //リンク先までの距離を取得
    var position = target.offset().top;
    //スムーススクロール
    $("html, body").animate({scrollTop:position}, speed, "swing");
    return false;
  });
});
</script>
<!--tag-->
<?php include "include/tag_head.html";?>
</head>
<body>
<?php include "include/tag_start.html";?>
<p id="cursor"></p>
<div id="stalker"></div>
<?php
	if(isset($_COOKIE['affiliate'])) {
		include "include/header_affiliate.html";
	} else {
		include "include/header.html";
	}
?>
<main>
    <section id="title" class="faq_img">
        <article>
            <h1>FAQ</h1>
        </article>
    </section>
    <section id="other">
        <article class="faq">
            <div class="faq_box">
				<ul class="faq_menu">
					<li><a href="#q1">料金・特典について</a></li>
					<li><a href="#q2">サービス・仕様について</a></li>
					<li><a href="#q3">開通工事について</a></li>
					<li><a href="#q4">その他</a></li>
				</ul>
                <h3 id="q1"><span>料金・特典について</span></h3>
				<h4>料金・支払いについて</h4>
                <dl>
                    <dt><p class="q">Q</p><p>1年以内で解約した場合にかかる料金はいくらですか？</p></dt>
                    <dd>
                        <p class="a">A</p>
                        <p>更新月以外の解約の場合は契約解除料21,780円と、お支払いいただいていない基本工事費の残債額を一括で請求いたします。</p>
                    </dd>
                </dl>
                <dl>
                    <dt><p class="q">Q</p><p>工事費は割引されますか？</p></dt>
                    <dd>
                        <p class="a">A</p>
                        <p>お申し込みの際の条件なく、回線工事費は相当の割引が適用されます。</p>
                    </dd>
                </dl>
                <dl>
                    <dt><p class="q">Q</p><p>毎月の料金を確認したい。</p></dt>
                    <dd>
                        <p class="a">A</p>
                        <p>お客様のマイページにてご確認いただけます。</p>
                    </dd>
                </dl>
                <dl>
                    <dt><p class="q">Q</p><p>支払い方法は何がありますか？</p></dt>
                    <dd>
                        <p class="a">A</p>
                        <p>クレジットカード払い・口座振替がございます。<br>
							また初回登録時のみ、 NTT請求（電話料金合算） ・ソフトバンクまとめて支払い が選択可能です。<br>
							<span>※登録可能のクレジットカードVISA/MasterCard/AMERICAN EXPRESS/JCB デビットカードやプリペイドカードならびに一部の海外発行のクレジットカードは登録できません。</span></p>
                    </dd>
                </dl>
                <h3 id="q2"><span>サービス・仕様について</span></h3>
				<h4>回線速度について</h4>
                <dl>
                    <dt><p class="q">Q</p><p>Fon 光の通信速度を教えてください。</p></dt>
                    <dd>
                        <p class="a">A</p>
                        <p>下り最大2Gbps、上り最大1Gbpsになります。<br>
							PC、スマホでのサイト閲覧はもちろん、オンラインゲーム、ストリーミングでのドラマ視聴など、複数端末で同時に使用しても遅延なく快適に利用することができます。<br>
							<span>※「最大 2Gbps 」という通信速度はネットワークからお客さま宅内に設置する宅内終端装置へ提供する最大速度です。<br>
							機器使用時の通信速度はお客さまの通信環境と規格により異なります。<br>
							無線接続の場合は通信規格 IEEE802.11ac における通信で最大 1.3Gbpsとなります。<br>
							※宅内終端装置の機種によりIEEE802.11acに対応していない場合があります。<br>
							なお、記載の最大通信速度は、技術規格上の最大値であり実使用速度を示すものではありません。<br>
							インターネットご利用時の速度は、お客さまのご利用環境（端末機器の仕様等）や回線混雑状況等により低下する場合があります。</span></p>
                    </dd>
                </dl>
                <dl>
                    <dt><p class="q">Q</p><p>速度制限はありますか？</p></dt>
                    <dd>
                        <p class="a">A</p>
                        <p>一般的な利用であれば制限はありません。</p>
                    </dd>
                </dl>
                <dl>
                    <dt><p class="q">Q</p><p>速度保障はしてくれますか？</p></dt>
                    <dd>
                        <p class="a">A</p>
                        <p>インターネットご利用時の速度は、お客さまのご利用環境（端末機器の仕様等）や回線混雑状況等により異なるため、速度保障は行っておりません。<br>
							ただし設置させていただく宅内機器に不調が見られる場合は交換可能の場合がございますのでご相談ください。</p>
                    </dd>
                </dl>
                <dl>
                    <dt><p class="q">Q</p><p>他のインターネット回線との違いは何でしょうか？</p></dt>
                    <dd>
                        <p class="a">A</p>
                        <p>Fon光は、他社とは異なる通信規格GPONの採用と、対応するたホームゲートウェイ（ONU）によって、下り最大2Gbpsという高速通信が可能となっております。<br>
							また、無線LAN機能がONU内に内蔵されており、余分な料金をかけずにご自宅のWi-Fi環境を整えることができます。</p>
                    </dd>
                </dl>
				<h4>無線LAN・ONUについて</h4>
                <dl>
                    <dt><p class="q">Q</p><p>Wi-Fiで繋ぎたいのですが、ルーターは自分で用意が必要ですか？</p></dt>
                    <dd>
                        <p class="a">A</p>
                        <p>無線LANルーター機能が搭載されているONUを無料でレンタルいたしますので、別途ご自身で機器をご用意いただく必要はございません。</p>
                    </dd>
                </dl>
                <dl>
                    <dt><p class="q">Q</p><p>現在自分で所有している無線LANルーターは利用できますか？</p></dt>
                    <dd>
                        <p class="a">A</p>
                        <p>ご使用いただけますが、動作保証はしておりません。<br>
							Fon光のONUには無線LANルーター機能が搭載されておりますので、Wi-Fiをご利用の場合はそちらをお使い頂くことを推奨します。</p>
                    </dd>
                </dl>
                <dl>
                    <dt><p class="q">Q</p><p>鉄筋製の家でもWi-Fiは届きますか？</p></dt>
                    <dd>
                        <p class="a">A</p>
                        <p>壁の材質にもよりますが、一般的には問題なくご利用いただけます。</p>
                    </dd>
                </dl>
                <dl>
                    <dt><p class="q">Q</p><p>最大何台までWi-Fiにつなげられますか？</p></dt>
                    <dd>
                        <p class="a">A</p>
                        <p>10台まで接続可能です。</p>
                    </dd>
                </dl>
                <dl>
                    <dt><p class="q">Q</p><p>Wi-Fiの速度はどのくらいですか？</p></dt>
                    <dd>
                        <p class="a">A</p>
                        <p>最大概ね1.3Gbpsです。<br>
							<span>※IEEE802.11acの場合の速度です。弊社が設置する宅内終端装置の機種により対応していない場合があります。<br>
							速度は、お客さまのご利用環境(端末機器の仕様等)や回線混雑状況等により、低下する場合があります。</span></p>
                    </dd>
                </dl>
                <dl>
                    <dt><p class="q">Q</p><p>IPv6には対応していますか？</p></dt>
                    <dd>
                        <p class="a">A</p>
                        <p>IPv6に対応しています。</p>
                    </dd>
                </dl>
                <dl>
                    <dt><p class="q">Q</p><p>ブリッジモードには対応していますか？</p></dt>
                    <dd>
                        <p class="a">A</p>
                        <p>Fon光のONUはブリッジモードに対応していません。</p>
                    </dd>
                </dl>
                <h3 id="q3"><span>開通工事について</span></h3>
				<h4>工事内容について</h4>
                <dl>
                    <dt><p class="q">Q</p><p>Fon 光の工事内容を教えてください。</p></dt>
                    <dd>
                        <p class="a">A</p>
                        <p>開通工事は「宅内」「屋外」で2回行われます。<br>
							宅内工事で、外壁に光キャビネットの取り付け・宅内への光ケーブル引き込み・Wifiルをルーター（ONU）を宅内に設置を行い、屋外工事で 電柱から光ケーブル引き込み・光キャビネットに接続を行い完了となります。</p>
                    </dd>
                </dl>
                <dl>
                    <dt><p class="q">Q</p><p>工事の際に壁に穴は開けますか？</p></dt>
                    <dd>
                        <p class="a">A</p>
                        <p>既存の配管を優先的に利用して工事を行っておりますので、基本的に穴が開くことはございません。<br>
							ただし、建物の状態によっては、どうしても穴開けが発生する場合もございます。その場合は必ずお客様へ説明を行い、了承をいただかなければ工事は実施いたしませんのでご安心ください。</p>
                    </dd>
                </dl>
                <dl>
                    <dt><p class="q">Q</p><p>ビス留めはどこにされますか？</p></dt>
                    <dd>
                        <p class="a">A</p>
                        <p>工事担当者が現場で判断してお客様にご説明させていただくため、現段階では分かりかねます。</p>
                    </dd>
                </dl>
                <dl>
                    <dt><p class="q">Q</p><p>事前に工事内容を教えてもらえますか？</p></dt>
                    <dd>
                        <p class="a">A</p>
                        <p>詳細は工事日までは分かりかねるのですが、工事担当者が現場で判断してお客様にご説明させていただきます。</p>
                    </dd>
                </dl>
                <dl>
                    <dt><p class="q">Q</p><p>現在別の光回線があるのですが、工事は必要でしょうか？<br>
						その際事前に撤去する必要はありますか？</p></dt>
                    <dd>
                        <p class="a">A</p>
                        <p>Fon光はNTT等の回線を利用せず、新しく電柱から回線を引き込みするので、工事が発生します。<br>
							状況にもよりますが、原則他の回線を撤去されていなくても工事は行っております。</p>
                    </dd>
                </dl>
                <dl>
                    <dt><p class="q">Q</p><p>工事の内容次第で契約するかどうかを決めたいのですが、キャンセルは無料でできますか？</p></dt>
                    <dd>
                        <p class="a">A</p>
                        <p>2回目の工事（屋外工事）の実施前々日までであれば無料でキャンセルが可能です。</p>
                    </dd>
                </dl>
                <dl>
                    <dt><p class="q">Q</p><p>工事日の指定はできますか？</p></dt>
                    <dd>
                        <p class="a">A</p>
                        <p>お申し込みの際に、1回目の工事日の希望を伺って予約を行います。<br>
                            希望に添えない場合もございますが、その場合は工事担当者からお客様へご連絡し、ご希望を伺って調整いたします。</p>
                    </dd>
                </dl>
                <dl>
                    <dt><p class="q">Q</p><p>開通できるか事前に確認できますか？</p></dt>
                    <dd>
                        <p class="a">A</p>
                        <p>工事の際に建物の状態などの調査を行い開通可否を判断しておりますので事前にお伝えすることはできませんが、万一開通不可の判断となった場合でもキャンセル料等は発生いたしません。</p>
                    </dd>
                </dl>
				<h4>手続き方法について</h4>
                <dl>
                    <dt><p class="q">Q</p><p>インターネットを利用できない期間を作りたくないのですが、現在使っている回線の解約はいつすれば良いですか？</p></dt>
                    <dd>
                        <p class="a">A</p>
                        <p>Fon光が開通してからご解約いただけば、インターネットがご利用できない期間が発生せずに、スムーズにお乗り換えいただけます。</p>
                    </dd>
                </dl>
                <dl>
                    <dt><p class="q">Q</p><p>今、固定電話番号を使っています。引き継ぐことは可能ですか？</p></dt>
                    <dd>
                        <p class="a">A</p>
                        <p>お使いの番号がNTT発番の場合、お申し込みの際に、番号ポータビリティを希望するに チェックをお願いいたします。<br>
							当社が代行してNTT休止の手続きをさせていただきますので お客様の休止手続きは不要でございます。</p>
                    </dd>
                </dl>
                <dl>
                    <dt><p class="q">Q</p><p>集合住宅でFon 光は利用できますか？</p></dt>
                    <dd>
                        <p class="a">A</p>
                        <p>物件管理者様へ工事の了承については、建物に入居されているお客さまからオーナーさまへご相談をお願いしています。</p>
                    </dd>
                </dl>
				<h3 id="q4"><span>その他</span></h3>
                <dl>
                    <dt><p class="q">Q</p><p>Fon 光が使える地域を知りたい。</p></dt>
                    <dd>
                        <p class="a">A</p>
                        <p>以下のご地域で提供をしています。（一部地域を除く）<br>
							・北海道 <br>
							・関東（東京、神奈川、埼玉、千葉、茨城、栃木、群馬） <br>
							・東海（愛知、静岡、岐阜、三重） <br>
							・関西（大阪、兵庫、京都、滋賀、奈良） <br>
							・九州（福岡、佐賀）<br>
                        ・中国（広島、岡山）</p>
                    </dd>
				</dl>
                <dl>
                    <dt><p class="q">Q</p><p>契約期間を知りたい</p></dt>
                    <dd>
                        <p class="a">A</p>
                        <p>初年度は3年、以降は2年ごとの自動更新になっております。<br>
							更新期間以外での解約には21,780円の契約解除料がかかります。<br>
							※更新期間は初回36ヶ月～38ヶ月目、以降は24ヶ月～26ヶ月目となります。</p>
                    </dd>
				</dl>
                <dl>
                    <dt><p class="q">Q</p><p>プロバイダーとの契約は必要でしょうか？</p></dt>
                    <dd>
                        <p class="a">A</p>
                        <p>別のプロバイダ会社とのご契約は必要ありません。</p>
                    </dd>
				</dl>
            </div>
        </article>
    </section>
</main>
<?php include "include/footer.html";?>
</body>
</html>
