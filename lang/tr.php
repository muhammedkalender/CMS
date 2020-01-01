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
        "input_first_name" => "İsim",
        "input_last_name" => "Soy İsim",
        "input_organization" => "Organizasyon",
        "input_web_page" => "Web Sayfası",
        "input_tel" => "Telefon",
        "input_address" => "Adres",
        "input_is_corresponding" => "Baş Yazar mı ?",
        "input_joined" => "Konferansa Katılacak mı?",
        "input_preferences_food" => "Yemek Tercihleri",
        "input_preferences_accommodation" => "Konaklama Tercihleri",
        "input_preferences_extra_note" => "Belirtilmek istenen diğer şeyler",
        "input_current_password" => "Mevcut Şifre",
        "input_new_password" => "Yeni Şifre",
        "input_confirm_password" => "Şifre Onayı",

        "hint_email" => "example@domain.com",
        "hint_organization" => "Open Source Fo.",
        "hint_first_name" => "Muhammed",
        "hint_last_name" => "Kalender",
        "hint_web_page" => "http://www.....",
        "hint_tel" => "+90 555 555 5555",
        "hint_address" => "İş Adresim : Istanbul / Beşiktaş / Pınar Mh ...",

        "hint_preferences_food" => "Gluten Alerjim Var, Vejeteryanim",
        "hint_preferences_accommodation" => "Kendi planladığımız yerde kalıcaz, Sizin yönlendireceğiniz yerde kalıcam",
        "hint_preferences_extra_note" => "Yanımda çok sayıda belge ile geliceğim",

        "hint_password_old" => "Mevcut Şifreniz",
        "hint_password_new" => "Yeni Şifreniz",
        "hint_password_repeat" => "Yeni Şirenizin Tekrarı",

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

        'sidebar_home' => 'Ana Sayfa',
        "sidebar_profile" => "Profilim",
        "sidebar_exit" => "Çıkış",
        "sidebar_dashboard" => "Yönetim",
        "sidebar_user" => "Kullanıcılar",
        "sidebar_submission" => "Makaleler",
        "sidebar_announcement" => "Duyurular",
        "sidebar_user_announcement" => "Kullanıcı Duyuruları",
        "sidebar_request_submission_invoices" => "Makbuz Gönderimleri",
        "sidebar_request_submission_full_papers" => "Tam İçerik Gönderimleri",
        "sidebar_filter_submission" => "Makale Filtresi",

        "page_home" => "Ana Sayfa",
        "page_user_profile" => "Kullanıcı Profili",

        "ui_id" => "#",
        "ui_created_by" => "Oluşturan",
        "ui_title" => "Başlık",
        "ui_public_date" => "Yayınlanma Tarihi",
        "ui_options" => "İşlemler",
        "ui_close" => "Kapat",
        "ui_send" => "Gönder",
        "ui_save" => "Kaydet",
        "ui_change" => "Değiştir",
        "ui_dropdown" => "Seçenekler",
        "ui_add" => "Ekle",
        "ui_delete" => "Sil",

        "ui_user_info" => "Kullanıcı Bilgileri",
        "ui_user_preferences" => "Kullanıcı Tercihleri",
        "ui_user_password" => "Şifre Değişikliği",

        "ui_announcements" => "Duyurular",
        "ui_user_announcements" => "Kullanıcı Duyuruları",
        "ui_unread_messages" => "Okunmamış mesajlar",

        "ui_announcement_view" => "Duyuruyu Görüntüle",

        "ui_insert_user_announcement" => "Yeni Duyuru Ekle",
        "ui_user_announcement_view" => "Duyuruyu Görüntüle",
        "ui_user_announcement_update" => "Duyuruyu Güncelle",
        "ui_user_announcement_messages" => "Mesajları Görüntüle",
        "ui_user_announcement_delete" => "Duyuruyu Sil",
        "ui_dt_previous" => "Önceki",
        "ui_dt_next" => "Sonraki",
        "ui_dt_search" => "Arama",
        "ui_dt_info" => "Toplam _TOTAL_ veri içinden  _START_ ile _END_ arasındakiler görüntüleniyor",
        "ui_dt_length_menu" => "_MENU_ Veri Göster",
        "ui_dt_zero_records" => "Veri Yok",

        "ui_insert_user_announcements" => "Duyuru Ekle",
        "ui_update_user_announcements" => "Duyuru Güncelleme",

        "ui_delete_user_announcements" => "Duyuru Sil",
        "ui_delete_are_you_sure" => "Duyurusunu Silmek İstediğinize eminmisiniz ?",

        "ui_user_messages" => "Kullanıcı Mesajları",

        "user_announcement_delete_success" => "Duyuru Başarıyla Silindi",
        "user_announcement_insert_success" => "Duyuru Başarıyla Eklendi",
        "user_announcement_update_success" => "Duyuru Başarıyla Güncellendi",
        "user_announcement_update_failure" => "Duyuru Güncellenirken Sorun Oluştu",

        "hint_type_message" => "Mesajınızı Yazınız",


        "user_select_failure" => "Kullanıcılar Çekilemedi",
        "user_show_failure" => "Kullanıcı Verisi Çekilemedi",

        "change_password_success" => "Şifre Başarıyla Güncellendi",
        "change_password_failure" => "Şifre Güncellenirken Sorun Oluştu",

        "user_update_preferences_success" => "Kullanıcı Tercihleri başarıyla güncellendi",
        "user_update_preferences_failure" => "Kullanıcı Tercihleri güncellenirken sorun oluştu",

        "user_update_info_success" => "Kullanıcı Bilgileri başarıyla güncellendi",
        "user_update_info_failure" => "Kullanıcı Bilgileri güncellenirken sorun oluştu",
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