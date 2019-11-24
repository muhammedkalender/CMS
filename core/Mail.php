<?php

require_once 'core/Text.php';

class Mail
{
    public static function queue($emailAddress, $emailTitle, $emailMessage, $emailUser = 0){
        $emailTitle = Text::decode($emailTitle);
        $emailMessage = Text::decode($emailMessage);

        $insertMail = Database::insertReturnID("INSERT INTO mails (mail_address, mail_title, mail_content, mail_user_id) VALUES ('{$emailAddress}', '{$emailTitle}', '{$emailMessage}', '{$emailUser}')");

        if($insertMail->status){
            return new Output(true);
        }

        return new Output(false);
    }
}