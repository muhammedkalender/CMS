<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require_once 'core/Text.php';
require_once 'core/Output.php';

class Mail
{
    public static function queue($emailAddress, $emailTitle, $emailMessage, $emailUser = 0){
        $emailTitle = Text::decode($emailTitle);
        $emailMessage = Text::decode($emailMessage);

        $insertMail = Database::insertReturnID("INSERT INTO mails (mail_address, mail_title, mail_content, mail_user_id) VALUES ('{$emailAddress}', '{$emailTitle}', '{$emailMessage}', '{$emailUser}')");

        if($insertMail->status){
            return new Output(true, $insertMail->data);
        }

        return new Output(false);
    }

    public static function send($emailAddress, $emailTitle, $emailMessage, $emailUser = 0){
        $mailID = self::queue($emailAddress, $emailTitle, $emailMessage, $emailUser);

        if($mailID->status){
            $mailID = $mailID->data;

            $mail = new Mail();

            $sendMail = $mail->sendMails($mailID);

            return $sendMail;
        }else{
            return $mailID;
        }
    }
    
    public function sendMails($mailID = 0){
        try{
            set_time_limit(0);

            require_once "core/mail/Exception.php";
            require_once "core/mail/PHPMailer.php";
            require_once "core/mail/SMTP.php";

            global $user;

            //todo perm

            $mails = [];

            if($mailID){
                $mails = Database::select("SELECT * FROM mails INNER JOIN users ON user_id = mail_user_id WHERE mail_id = {$mailID}");
            }else{
                $mails = Database::select("SELECT * FROM mails INNER JOIN users ON user_id = mail_user_id WHERE mail_is_sended = 0 AND mail_active = 1 AND mail_send_try < ".Config::MAIL_SEND_TRY." LIMIT ".Config::MAIL_SEND_COUNT);
            }

            if(!$mails->status){
                return new Output(false, $mails->message);
            }

            $successMail = [];
            $failureMail = [];

            $mail = new PHPMailer(true);

            foreach($mails->data as $objMail){
                try{
                    $mail->SMTPDebug = 0;
                    $mail->isSMTP();
                    $mail->Host       = Config::MAIL_SERVER;
                    $mail->SMTPAuth   = true;
                    $mail->Username   = Config::MAIL_LOGIN;
                    $mail->Password   = Config::MAIL_PASSWORD;
                    $mail->SMTPSecure = 'tls';
                    $mail->Port       = Config::MAIL_PORT;
                    $mail->CharSet = 'UTF-8';

                    $mail->setFrom(Config::MAIL_LOGIN, Config::MAIL_FROM_NAME);

                    if($objMail["mail_address"]){
                        $mail->addAddress($objMail["user_email"], $objMail["user_first_name"]." ".$objMail["user_last_name"]);
                    }else{
                        $mail->addAddress($objMail["mail_address"]);
                    }

                    $mail->isHTML(true);
                    $mail->Subject = $objMail["mail_title"];
                    $mail->Body    = $objMail["mail_content"];

                    $mail->send();

                    Database::exec("UPDATE mails SET mail_is_sended = 1, mail_updated_at = '".getCustomDate()."', mail_updated_by = ".$user->id." WHERE mail_id = ".$objMail["mail_id"]);
                    Log::insert("mail_send_success", 900, $objMail["mail_id"]);

                    $successMail[] = $objMail;
                }catch (Exception $e){
                    $objMail["error_message"] = $mail->ErrorInfo;

                    Database::exec("UPDATE mails SET mail_send_try = mail_send_try + 1, mail_updated_at = '".getCustomDate()."', mail_updated_by = ".$user->id." WHERE mail_id = ".$objMail["mail_id"]);
                    Log::insertWithKey("mail_send_failure", [901, $objMail["mail_id"]], [$mail->ErrorInfo]);

                    $failureMail[] = $objMail;
                }
            }

            return new Output(true, "mail_send_success", ["success" => $successMail, "failure" => $failureMail]);
        }catch (Exception $e){
            return new Output(false, "mail_send_failure", $e->getMessage());
        }
    }
}