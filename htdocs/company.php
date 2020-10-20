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
<meta name="viewport" id="viewport" content="width=device-width">
<meta name="description" content="月額3,980円！fon光で快適なインターネット生活を送ろう">
<meta name="keywords" content="fon,fon光,nuro,nuro光,NTT,プロバイダ,高速,2Gbps,WiFi,ルーター,WiMAX,Softbank,縛りなしWiF">
<meta name="theme-color" content="#EC7103">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<?php include "include/ogp.html";?>
<link rel="shortcut icon" href="img/favicon.ico" />	
<!--style-->
<link href="https://fonts.googleapis.com/css2?family=M+PLUS+1p:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/other.css"> 
<!--js-->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
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
    <section id="title" class="company_img">
        <article>
            <h1>COMPANY</h1>
        </article>
    </section>
    <section id="other">
        <article class="company">
            <div class="company_box">
                <dl>
                    <dt>会社名</dt>
                    <dd>フォン・ジャパン株式会社</dd>
                </dl>
                <dl>
                    <dt>設立年月日</dt>
                    <dd>2006年8月10日</dd>
                </dl>
                <dl>
                    <dt>代表取締役</dt>
                    <dd>横田 和典</dd>
                </dl>
                <dl>
                    <dt>事業者区分</dt>
                    <dd>電気通信事業：A-18-9032<br>届出年月日：平成18年11月29日</dd>
                </dl>
                <dl>
                    <dt>電話番号</dt>
                    <dd>0120-966-486</dd>
                </dl>
                <dl>
                    <dt>メールアドレス</dt>
                    <dd>support@fon-hikari.net</dd>
                </dl>
                <dl>
                    <dt>所在地</dt>
                    <dd>〒171-0014 東京都豊島区池袋2-14-4 池袋TAビル8F</dd>
                </dl>
                <dl>
                    <dt>サービス名称</dt>
                    <dd>Fon光</dd>
                </dl>
                <dl>
                    <dt>商品代金以外の必要料金</dt>
                    <dd>販売価格：商品毎に表示しています。<br>
						初期費用：商品毎に表示しています。</dd>
                </dl>
                <dl>
                    <dt>申し込みの有効期限</dt>
                    <dd>お申込み内容に不備があり、1ヶ月以上連絡がつかない場合はキャンセルとさせていただく場合がございます。</dd>
                </dl>
                <dl>
                    <dt>契約約款</dt>
                    <dd>
                        契約約款につきましては<a href="pdf/hikari_kiyaku.pdf" target="_blank">こちら</a>をご確認下さい。
                    </dd>
                </dl>
            </div>
        </article>
    </section>
</main>
<?php include "include/footer.html";?>
</body>
</html>