<?php
// $to = "support@fon-hikari.net,onepiecetakaie@gmail.com";
$to = "onepiecetakaie@gmail.com";



/**
 * 働くDBのインポートエラーメッセージ送信
 *
 * @param string $result
 * @return void
 */
function sendHatarakuDBErrorMail(string $result){

    $body_head = <<<SUB_HEAD
    下記のお客様情報の登録に失敗しました。
    お申込み内容を確認の上管理者にご確認ください。
    error_code :=> {$result}
    SUB_HEAD;
    
    $error_mail = $body_head."\n\n";

    mb_language("Japanese");
    mb_internal_encoding("UTF-8");

    $error_subject =  "Fon光管理者通知メール【重要】申込の働くDBインポート登録に失敗しました。";
    // support@fon-hikari.net ← を追加.
    $to = mb_convert_encoding("onepiecetakaie@gmail.com", 'UTF-8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS');
    $subject = mb_convert_encoding($error_subject, 'UTF-8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS');
    $text = mb_convert_encoding($error_mail, 'UTF-8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS');
    $from = mb_encode_mimeheader('Fon光運営事務局 ','ISO-2022-JP') . '<info@shibarinashi-wifi.jp>';
    // $rp = mb_convert_encoding("y-kushibiki@1onepiece.jp", 'UTF-8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS');
    $org = mb_convert_encoding("フォン・ジャパン株式会社", 'UTF-8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS');

    $head = '';
    $head .= "Content-Type: text/plain \r\n";
    $head .= "Return-Path: $rp \r\n";
    $head .= "From: $from \r\n";
    $head .= "Sender: $from \r\n";
    // $head .= "Reply-To: $rp \r\n";
    $head .= "Organization: $org \r\n";
    $head .= "X-Sender: $from \r\n";
    $head .= "X-Priority: 3 \r\n";

    //管理者宛にメール送信
    mb_send_mail($to, $subject, $text, $head);
}

?>