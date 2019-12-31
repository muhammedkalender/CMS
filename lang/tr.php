<?php


class Lang
{
    private static $data = [
        'test' => 'TR',
        'lang_code' => '2',

        'check_input_null' =>  '[[FIRST_PARAM]] değeri boş olamaz',
        'check_input_short' => '[[FIRST_PARAM]], [[SECOND_PARAM]] Karakterden kısa olamaz',
        'check_input_long' => '[[FIRST_PARAM]], [[SECOND_PARAM]] Karakterden uzun olamaz',
        'check_input_type' => '[[FIRST_PARAM]], [[SECOND_PARAM]] olmalıdır.',
        'check_input_date' => '[[FIRST_PARAM]], Kabul edilen standartta bir tarih değil',

        'user_email_already_registered' => '[[FIRST_PARAM]] Zaten kullanılıyor',
        'user_wrong_login' => 'Kullanıcı adı veya şifre yanlış',
        'login_success' => 'Giriş yapıldı',

        'type_email' => 'Eposta adresi',
        'type_int' => 'Sayısal değer',

        'input_email' => 'Eposta Adresi',
        'input_password' => 'Şifre',
        'input_name' => 'İsim',
        'input_surname' => 'Soyisim',
        'input_country' => 'Ülke',
        'input_submission' => 'Makale',
        'input_ec_id' => 'EC Id',
        'input_submit_date' => 'Gönderim Tarihi',
        'input_paper_title' => 'Makale Başlığı',
        'input_presentation_type' => 'Sunum Türü',
        'input_type_of_contribution' => 'Katkı Türü',
        'input_users' => 'Yazarlar',
        'input_message' => 'Mesaj',
        'users_input_wrong' => 'Yazarlarla ilgili bir sorun var',
        'input_language_code' => 'Dil',
        'input_title' => 'Başlık',
        'input_announcement' => 'Duyuru',
        'input_language' => 'Dil',
        'input_user' => 'Kullanıcı',
        'input_user_announcement' => 'Kullanıcı Duyurusu',
        'input_user_announcement_message' => 'Mesaj',

        'ui_error' => 'Hata',
        'ui_success' => 'Başarılı',

        'perm_error' => 'Bu işlemi yapmak için yetkiniz yok',

        'submission_insert_failure' => 'Makale oluşturulurken sorun oluştu',
        'submission_insert_success' => 'Makale başarıyla oluşturuldu. ID : [[FIRST_PARAM]]',
        'users_insert_to_submission_failure' => '[[FIRST_PARAM]]. Yazar Makaleye eklenemedi',
        'users_insert_to_submission_success' => '[[FIRST_PARAM]] Yazarı Oluşturuldu',

        'register_success' => '[[FIRST_PARAM]] başarıyla kayıt edildi',
        'register_failure' => '[[FIRST_PARAM]] Kayıt olurken sorun oluştu',


        'mail_title_register' => 'Üyeliğiniz Oluşturuldu',
        'mail_template_register' => 'Merhabalar [[FIRST_PARAM]] [[SECOND_PARAM]], [[FOURTH_PARAM]] Numaraları EC başvurunuza karşın [[THIRD_PARAM]] numaralı makale oluşturulmuştur. Şifreniz : [[FIFTH_PARAM]]',

        'log_user_insert' => '[[FIRST_PARAM]] Mail adresli [[SECOND_PARAM]] için hesap oluşturuldu.',
        'log_user_insert_failure' => '[[FIRST_PARAM]] Mail adresli [[SECOND_PARAM]] için hesap oluşturulamadı',
        'log_submission_insert' => 'Makale oluşturuldu',

        'system_error_login' => 'Giriş yaparken sorun oluştu',

        'user_input_wrong' => 'Bir sorun oluştu, lütfen daha sonra tekrar deneyin',

        'submission_null' => 'Makale bulunamadı',

        'comment_insert_failure' => 'Yorum eklenemedi',
        'comment_insert_success' => 'Yorum başarıyla eklendi',

    ];

    public static function get($name, $firstParam = '', $secondParam = '', $thirdParam = '', $fourthParam = '', $fifthParam = '')
    {
        if (Config::HIDE_LANG || !isset(self::$data[$name])) {
            return '[' . $name . ']';
        }

        $returnData = self::$data[$name];

        if ($firstParam != '') {
            $returnData = str_replace('[[FIRST_PARAM]]', $firstParam, $returnData);
        }

        if ($secondParam != '') {
            $returnData = str_replace('[[SECOND_PARAM]]', $secondParam, $returnData);
        }

        if ($thirdParam != '') {
            $returnData = str_replace('[[THIRD_PARAM]]', $thirdParam, $returnData);
        }

        if ($fourthParam != '') {
            $returnData = str_replace('[[FOURTH_PARAM]]', $fourthParam, $returnData);
        }

        if ($fifthParam != '') {
            $returnData = str_replace('[[FIFTH_PARAM]]', $fifthParam, $returnData);
        }


        return $returnData;
    }

    public static function getWithKey($name, $firstParam = '', $secondParam = '', $thirdParam = '', $fourthParam = '', $fifthParam = '')
    {
        if (Config::HIDE_LANG || !isset(self::$data[$name])) {
            return '[' . $name . ']';
        }

        $returnData = self::$data[$name];

        if ($firstParam != '') {
            if (isset(self::$data[$firstParam])) {
                $returnData = str_replace('[[FIRST_PARAM]]', self::$data[$firstParam], $returnData);
            }else{
                $returnData = str_replace('[[FIRST_PARAM]]', $firstParam, $returnData);
            }
        }

        if ($secondParam != '') {
            if (isset(self::$data[$secondParam])) {
                $returnData = str_replace('[[SECOND_PARAM]]', self::$data[$secondParam], $returnData);
            }else{
                $returnData = str_replace('[[SECOND_PARAM]]', $secondParam, $returnData);
            }
        }

        if ($thirdParam != '') {
            if (isset(self::$data[$thirdParam])) {
                $returnData = str_replace('[[THIRD_PARAM]]', $thirdParam, $returnData);
            }else{
                $returnData = str_replace('[[THIRD_PARAM]]', $thirdParam, $returnData);
            }
        }

        if ($fourthParam != '') {
            if (isset(self::$data[$fourthParam])) {
                $returnData = str_replace('[[FOURTH_PARAM]]', $fourthParam, $returnData);
            }else{
                $returnData = str_replace('[[FOURTH_PARAM]]', $fourthParam, $returnData);
            }
        }

        if ($fifthParam != '') {
            if (isset(self::$data[$fifthParam])) {
                $returnData = str_replace('[[FIFTH_PARAM]]', $fifthParam, $returnData);
            }else{
                $returnData = str_replace('[[FIFTH_PARAM]]', $fifthParam, $returnData);
            }
        }

        return $returnData;
    }
}