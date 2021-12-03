<?php
// SupportMailUtil.php の SwiftMailer 版．
// V7.0 以降が必須になるし，一部引数やメソッドが異なる．
// メールアドレスの型式がmb_send_mail()のような「文字列」ではなく「配列」になる．
// explode()するくらいで動かせる．

// E-mailアドレス指定に配列意外にSwift Mailer型式の配列意外に，コンマ区切り文字列も
// 許しているのは 旧 SupportMailUtil との互換性のため．

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\RotatingFileHandler;

class SupportMailUtil2 {
    private $logger;

    private $adminTop = '';
    private $adminBottom = '';
    private $adminBody = '';
    private $adminAttachments = [];

    private $customerTop = '';
    private $customerBottom = '';
    private $customerBody = '';
    private $customerAttachments = [];

    public function __construct( $logger) {
        $logger->debug('START SupportMailUtil2->__construct()');
        $this->logger = $logger;

        // 日本語むけの設定
        \Swift::init(function () {
            \Swift_DependencyContainer::getInstance()
                ->register('mime.qpheaderencoder')
                ->asAliasOf('mime.base64headerencoder');

            \Swift_Preferences::getInstance()->setCharset('iso-2022-jp');
        });

        $this->logger->debug('END SupportMailUtil2->__construct()' );
    }

    public function sendAdmin($subject, $from, $to, $bcc = [] ){
        $this->logger->debug('START sendAdmin()');
        $ret = $this->send($this->adminBody, $this->adminAttachments, $subject, $from, $to, $bcc);
        $this->logger->debug('END sendAdmin()');
        return $ret;
    }

    public function sendCustomer($subject, $from, $to, $bcc = [] ){
        $this->logger->debug('START sendCustomer()');
        $ret = $this->send($this->customerBody, $this->customerAttachments, $subject, $from, $to, $bcc);
        $this->logger->debug('END sendCustomer()');
        return $ret;
    }

    // E-mail送信．
    public function send($message, $attachments, $subject, $from, $to, $bcc = []){
        $this->logger->debug('START sendMailUtil()');
        $this->logger->info('SEND MAIL : $from = '. var_export($from, true) .
                            ', $to = '. var_export($to,true) .
                            ', $bcc = '. var_export($bcc, true) .
                            ', $subject = '. $subject .', $message = '. $message );

        if( empty($to) ){
            $this->logger->error('$to is empty.');
            $this->logger->debug('END sendMailUtil()');
            return false;
        }

        // swiftmailer
        $transport = new Swift_SendmailTransport('/usr/sbin/sendmail -bs');
        try {
            $transport->start();
        }
        catch (\Swift_TransportException $ex) {
            $this->logger->error( 'Can not start Swift_SendmailTransport : '
                                  . var_export($ex->getMessage(),true) );
            $this->logger->debug('END sendMailUtil()');
            return false;
        }

        $mailer = new \Swift_Mailer($transport);
        $mailLogger = new Swift_Plugins_Loggers_ArrayLogger();
        $mailer->registerPlugin(new Swift_Plugins_LoggerPlugin($mailLogger));

        try {
            $swiftMsg = (new \Swift_Message($subject))
                      ->setFrom( $from )
                      ->setTo( $to )
                      ->setBody($message);

            if( ! empty($bcc)){
                $swiftMsg->setBcc( $bcc );
            }
        }
        catch (Swift_RfcComplianceException $e) {
            $this->logger->info('E-mail address errror : '
                                . var_export($e->getMessage(), true) );
            $this->logger->debug('END sendMailUtil()');
            return false;
        }


        $this->logger->debug('attaches: '. var_export($attachments,true));
        foreach( $attachments as $fname => $path  ){
            $this->logger->debug('attache file from path: "'. $path .
                                 '", fname: "'.$fname. '"' );
            $att = Swift_Attachment::fromPath($path)->setFilename($fname);
            $swiftMsg->attach( $att );
        }

        // Send the message
        $ret = $mailer->send($swiftMsg);

        if($ret === 0){
            $this->logger->error('SEND MAIL FAIL : $from = '. var_export($from, true) .
                                 ', $to = '. var_export($to,true) .
                                 ', $bcc = '. var_export($bcc, true) .
                                 ', $subject = '. $subject .', $message = '. $message );
            $this->logger->error('swift mailer log: '. var_export($mailLogger->dump(), true) );

            $this->logger->debug('END sendMailUtil()');
            return false;
        }
        $this->logger->debug('swift mailer log: '. var_export($mailLogger->dump(), true) );

        $this->logger->debug('successfully sent to '.$ret.' of recipents.');
        $this->logger->debug('END sendMailUtil()');
        return true;
    }

    // リクエストパラメータを，E-mailに埋め込むテキストとして，並べて整形．
    public function messageParamsText($params){
        $this->logger->debug('START messageParamsText()');

        $msgParams = '';
        foreach( $params as $k => $v){
            $msgParams .= '【 '. $k .' 】  '.$v. "\n";
        }

        $this->logger->debug('$msgParams = '. $msgParams);
        $this->logger->debug('END messageParamsText()');
        return $msgParams ;
    }

    //////////////////////////////////////////////////////////////////
    // 各種メールのテキスト本文の作成

    ////////////////
    // 管理者向け

    public function setAdminTopAndBottom($top, $bottom){
        $this->logger->debug('START setAdminTopAndBottom()');
        $this->adminTop = $top;
        $this->adminBottom = $bottom;
        $this->logger->debug('END setAdminTopAndBottom()');
    }

    // 管理者向けメッセージの本文のテキストを返す．
    public function adminMessageText($params, $adminParams = []){
        $this->logger->debug('START adminMessageText()');

        $messageParams = $this->messageParamsText($params);
        if( empty($adminParams) ){
            $adminMessageParams = '';
        }
        else{
            $adminMessageParams = $this->messageParamsText($adminParams);
        }

        $msg = <<< MSG
{$this->adminTop}

{$messageParams}
{$adminMessageParams}
{$this->adminBottom}
MSG;

      $this->adminBody = $msg;
      $this->logger->debug('END adminMessageText()');
      return $msg ;
    }

    public function getAdminText(){
        return $this->adminBody;
    }

    public function attachAdmin( $fname, $filepath ){
        $this->logger->debug('START attachAdmin()');
        //   $this->adminAttachments[mb_convert_encoding($fname, 'UTF-8','auto') ] = $filepath;
        $this->adminAttachments[$fname] = $filepath;
        $this->logger->debug('END attachAdmin()');
        return ;
    }


    ////////////////
    // 顧客向け

    public function setCustomerTopAndBottom($top,$bottom){
        $this->logger->debug('START setCustomerTopAndBottom()');
        $this->customerTop = $top;
        $this->customerBottom = $bottom;
        $this->logger->debug('END setCustomerTopAndBottom()');
    }

    // 顧客向けメッセージの本文のテキストを返す．
    public function customerMessageText( $params ){
        $this->logger->debug('START customerMessageText()');

        $messageParams = $this->messageParamsText($params);

        $msg = <<< MSG
{$this->customerTop}

{$messageParams}
{$this->customerBottom}
MSG;

      $this->customerBody = $msg;
      $this->logger->debug('END customerMessageText()');
      return $msg ;
    }

    public function getCustomerText(){
        return $this->customerBody;
    }

    public function attachCustomer( $fname, $filepath ){
        $this->logger->debug('START attachCustomer()');
        $this->customerAttachments[$fname] = $filepath;
        $this->logger->debug('END attachCustomer()');
        return ;
    }

}


