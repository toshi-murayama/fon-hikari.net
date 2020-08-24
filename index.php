<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>fon光</title>
<meta name="robots" content="noindex" />
<meta name="viewport" id="viewport" content="width=device-width">
<meta name="description" content="">
<meta name="keywords" content="">
<link rel="stylesheet" href="css/style.css"> 
<link rel="stylesheet" href="css/validationEngine.jquery.css"> 


<!--//* JS読み込み *//-->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/jquery.layerBoard.js"></script>
<script type="text/javascript" src="js/script.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/jquery.validationEngine.js"></script>
<script src="js/jquery.validationEngine-ja.js"></script>
<script src="js/jquery.jpostal.min.js"></script>
<script src="js/jquery.autoKana.js"></script>
<script src="js/application.js"></script>
<script src="js/script.js"></script>

<script type="text/javascript">
	
//ページ内リンク
$(function () {
    $('a[href^=#]').click(function () {
        var speed = 1500;
        var href = $(this).attr("href");
        var target = $(href == "#" || href == "" ? 'html' : href);
        var position = target.offset().top;
        $("html, body").animate({
            scrollTop: position
        }, speed, "swing");
        return false;
    });
});
</script>

</head>
<body>

<div id="container">
    <div id="header">
        <div class="header_box">
            <h1><img src="img/img_logo.png" alt=""></h1>
            <div class="header_c">
                <p>お申込み・ご相談<span>10:00〜21:00（年末年始、お盆を除く）</span></p>
				<p class="tel">0120-955-531</p>
            </div>
            <div class="header_r"><a href="">マイページ</a></div>
        </div>
    </div>

    <div id="top">
        <p><img src="img/img_top_big.png" width="1200" alt=""></p>
    </div>
    <div class="contact">
        <div class="contact_l">
            <p>お気軽にお問合せ・ご相談ください。</p>
            <p class="tel">0120-955-531</p>
            <p>受付時間 10:00〜21:00<br class="sp">（年末年始、お盆を除く）</p>
        </div>
        <div class="contact_r">
            <dl>
                <dt><a href="application.php">WEBお申込み</a></dt>
                <dd><a href="contact.php">お問い合わせ</a></dd>
            </dl>
        </div>
    </div>

    <div id="elected">
        <h2><img src="img/tit_top.png" width="700" height="220" alt=""/></h2>
        <h3><span><img src="img/tit_h3_01.png" alt="1"/></span>安心の回線品質</h3>
        <div class="no01">
            <p><img src="img/img_quality.jpg" width="1099" height="498" alt="安心の回線品質" /></p>
            <p class="text">fon 光は、NTT東日本の光ファイバー回線(ダークファイバー)を利用したインターネットサービスです。
                <br> インターネット網からお客さまのご自宅までソニーネットワークコミュニケーションズがサービス提供しており、高品質で安心なインターネットライフをお楽しみいただけます。
                <br> さらに、インターネットを接続するのも簡単です。 難しい設定は必要なく専用のホームゲートウェイ(ONU)とパソコンをLANケーブルで繋げるだけで、すぐにインターネットをお使いいただけます。</p>
        </div>

        <h3><span><img src="img/tit_h3_02.png" alt="2"/></span>料金表</h3>
        <div class="top_no02">
            <dl>
                <dt><img src="img/img_hikari_tel01.jpg" width="176" height="176" alt=""/></dt>
                <dd>fon光は、下り2Gbpsの超高速光回線と、無線LANがついて月額3,980円（税抜）でご利用頂ける光ファイバーインターネットサービスです。音楽も動画もゲームも、ダウンロード/アップロード共にストレス無く快適にご利用頂けます。工事の後、細かい設定無くすぐにお使い頂くことが可能です。
                </dd>
            </dl>
        </div>
        <div class="no02">
            <div class="no02_l">
                <h4>fon光 お得な料金</h4>
                <p class="tit">月額基本料金</p>
				<p><span>月額</span>3,980円<span>（税抜）</span></p>
                <p class="tit">基本工事費</p>
                <p>無料</p>
                <p class="tit">契約事務手数料</p>
				<p>3,000円<span>（税抜）</span></p>
                <p class="tit">契約期間</p>
                <p>2年更新</p>
                <p class="tit">契約解除料</p>
                <p>19,800円</p>
            </div>
            <div class="no02_r"><img src="img/img_hikari_tel02.jpg"></div>
        </div>
    </div>

    <div class="contact">
        <div class="contact_l">
            <p>お気軽にお問合せ・ご相談ください。</p>
            <p class="tel">0120-955-531</p>
            <p>受付時間 10:00〜21:00（年末年始、お盆を除く）</p>
        </div>
        <div class="contact_r">
            <dl>
                <dt><a href="application.php">WEBお申込み</a></dt>
                <dd><a href="contact.php">お問い合わせ</a></dd>
            </dl>
        </div>
    </div>

    <div id="flow">
        <div class="flow_box">
            <p><img src="img/tit_flow.jpg" width="851" height="106" alt="" /></p>
            <h4>カンタンお申込み!<br>ご利用開始まで専門スタッフがしっかりサポート!</h4>
            <p><img src="img/img_flow.jpg" width="1100" height="270" class="pc" alt="" /><img src="img/img_flow_sp.jpg" class="sp" alt="" /></p>
        </div>
    </div>

    <div id="notes">
        <h4>注意事項</h4>
        <p>表記価格は「fon 光G2V」コースの月額基本料金となります。別途契約事務手数料3,000円（税別）
          <br> 通信速度はfon ネットワークからお客さま宅内に設置する宅内終端装置へ提供する最大速度です。
            <br> インターネットご利用時の実効速度は、お客さまのご利 用環境や回線の混雑状況などにより変化します。</p>
        <ul>
            <li>「So-net」、「So-net」のロゴ、「ソネット」 及び「fon」は、ソニーネットワークコミュニケーションズ株式会社の商標または登録商標です。</li>
            <li>無線LAN機能は、IEEE 802.11a/b/g/n(Wi-Fi端末)に対応しています。</li>
            <li>無線LAN通信速度は技術規格上の最大値であり、お客さま宅内での実行速度を示すものではありません。</li>
        </ul>
        <h5>「超高速」「下り最大2Gbps」について</h5>
        <p>※個人宅向け商用FTTHサービス市場で超高速となります。（Ovum 2015年1月時点調べ）
            <br> 通信速度はfonネットワークからお客さま宅内に設置する宅内終端装置へ提供する最大速度です。インターネットご利用時の実行速度は、お客さまのご利用環境や回線の混雑状況などにより変化します。
            <h5>「提供エリア」について</h5>
            <p>サービス提携エリアは北海道、東京都、神奈川県、千葉県、埼玉県、群馬県、栃木県、茨城県、愛知県、兵庫県、奈良県、大阪府、静岡県、滋賀県、三重県、京都府、岐阜県、福岡、佐賀です。（一部エリアを除く）</p>
            <h5>「違約金・工事費用」について</h5>
            <p>更新月以外の解約については、9,500円の違約金が発生致します。
                <br> 30ヶ月未満の解約については、残月数分の工事費用の残高が発生致します。
            </p>
		<h5>「fon光利用規約」について</h5>
	  <p>「fon光コース」重要事項説明についてご確認をお願い致します。<br>
   重要事項説明：<a href="https://www.nuro.jp/hikari/legal/" target="_blank">https://www.nuro.jp/hikari/legal/</a></p>
    </div>

    <div class="contact">
        <div class="contact_l">
            <p>お気軽にお問合せ・ご相談ください。</p>
            <p class="tel">0120-955-531</p>
            <p>受付時間 10:00〜21:00（年末年始、お盆を除く）</p>
        </div>
        <div class="contact_r">
            <dl>
                <dt><a href="application.php">WEBお申込み</a></dt>
                <dd><a href="contact.php">お問い合わせ</a></dd>
            </dl>
        </div>
    </div>
</div>

<footer>
	<p><a href="#flow">ご利用の流れ</a> | <a href="company.html">運営会社</a> | <a href="privacy.html">個人情報保護方針</a> | <a href="application.php">お申込み</a> | <a href="contact.php">お問い合わせ</a></p>
</footer>
<div id="app_fix" class="gotop">
    <div class="contact pc">
        <div class="contact_l">
            <p>お気軽にお問合せ・ご相談ください。</p>
            <p class="tel">0120-955-531</p>
            <p>受付時間 10:00〜21:00（年末年始、お盆を除く）</p>
        </div>
        <div class="contact_r">
            <dl>
                <dt><a href="application.php">WEBお申込み</a></dt>
                <dd><a href="contact.php">お問い合わせ</a></dd>
            </dl>
        </div>
    </div>
	  
	  		<div class="sp">
	  <ul>
		  <li><a onclick="goog_report_conversion ('tel:0120-011-508')" href="tel:0120-011-508"><img src="img/img_app01.png" alt=""/><br>お電話</a></li>
		  <li><a href="application.php"><img src="img/img_app02.png" alt=""/><br>お申し込み</a></li>
		  <li><a href="contact.php"><img src="img/img_app03.png" alt=""/><br>お問い合わせ</a></li>
		  <li><a href="./"><img src="img/img_app04.png" alt=""/><br>トップ</a></li>
	  </ul>
	</div>

	</div>
</body>
</html>