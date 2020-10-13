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
<link rel="shortcut icon" href="img/favicon.ico" />	
<?php include "include/ogp.html";?>
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
<body class="gray">
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
    <section id="privacy">
        <article>
            <h2>個人情報保護方針</h2>
            <div>
            <ul>
                <li>1.サービス提供会社の個人情報に関する管理について フォン・ジャパン株式会社<br>
                    個人情報保護管理者 横田 和典<br>
                    〒171-0014 東京都豊島区池袋2-14-4 池袋TAビル8F TEL:0120-966-486 Mail:support@fon-hikari.net</li>
                <li>2.取得・利用目的 氏名、住所、電話番号、メールアドレス、生年月日その他必要な情報を、お申込みに対応、連絡のために取得し利用致します。</li>
                <li>3.第三者への提供<br>
                    頂いた個人情報は第三者への提供は致しません。 ただし、刑事訴訟法、地方税法、所得税法、商法などに基づく場合、ご本人様の同意なく個人情報の利用・提供を行うことがあります。</li>
                <li>4.個人情報の委託<br>
                    レンタルサーバー会社に委託をしています。 尚、業務の委託にあたっては事前に委託会社を選定し、個人情報保護の水準を満たしていることを確認しています。必要に応じて委託先会社とは個人情報保護に関する契約書を交わします。</li>
                <li>5.任意性 当該個人情報をご提出いただくかはご本人様の任意ですが、この同意文によりご不明な点ご解消されず、当該個人情報をご提出いただけない場合、お問い合わせの対応を行えない状況等、ご本人にとって不具合が発生しますことをご承知ください。</li>
                <li>6.個人情報の利用目的の通知、開示、訂正、追加又は削除、ならびに、利用停止、消去、第三者への提供の停止について<br>
                    取得した個人情報については、個人情報保護管理者が管理しています。 当社が保有する開示対象個人情報の利用目的の通知、開示、訂正、追加又は削除、ならびに利用停止、消去、第三者への提供の停止をご請求される場合は、上記1の管理者にお申し出下さい。 尚、そのときは本人確認のため、身分証明書のご提示をして頂きます。</li>
            </ul>
            </div>
        </article>
    </section>
</main>
<?php include "include/footer.html";?>
</body>
</html>
