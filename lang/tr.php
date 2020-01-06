<?php

require_once "core/Config.php";

class Lang
{
    private static $data = [
        'test' => 'TR',
        'lang_code' => '2',
        "constants_code" => "tr",

        "country_tr" => "Türkiye",

        "systemical_error" => "Sistemsel bir hata oluştu, lütfen daha sonra deneyin",
        "ui_account_system" => "Sistem",
        "api_request_null" => "Sistem Talep Gönderemedi",

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
        "input_id" => "ID",
        "input_presentation_lang" => "Sunum",
        "input_full_paper" => "Tam Metin",
        "input_invoice" => "Makbuz",
        "input_keywords" => "Anahtar Kelimeler",
        "input_ec_keyprases" => "EC Keyprases",
        "input_topics" => "Konular",
        "input_abstract_paper" => "Ön Metin",
        "input_admin" => "Yönetici mi ?",
        "input_corresponding" => "Başyazar mı ?",

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
        "sidebar_my_submission" => "Makale",

        "page_home" => "Ana Sayfa",
        "page_user_profile" => "Kullanıcı Profili",
        "page_profile" => "Kullanıcı Profili",
        "page_view_submission" => "Makale",
        "page_submission" => "Makale Yönetimi",
        "page_user" => "Kullanıcılar",
        "page_announcement" => "Duyurular",
        "page_user_announcement" => "Kullanıcı Duyuruları",
        "page_request_submission_invoices" => "Makbuz Gönderimleri",
        "page_request_submission_full_papers" => "Tam Metin Gönderimleri",
        "page_filter_submission" => "Makale Filtreleme",
        "page_login" => "Giriş Yap",
        "page_insert_submission" => "Makale Girişi",
        "page_forget_password" => "Şifre Yenileme",


        "null_user" => "Kullanıcı Bulunamadı",

        "forgot_password_failure" => "İşlem sırasında bir hata oluştu",
        "forgot_password_success" => "Yeni şifreniz mail adresinize gönderilecektir",

        "mail_title_forgot_password" => "Yeni Şifreniz",

        "ui_author" => "Yazar",

        "hint_ec_id" => "EC ID",
        "hint_paper_title" => "Başlık",

        "null_user_change_password" => "Mevcut şifreyi doğru girdiğinizden emin olun",

        "hint_keywords" => "doğa, yenilebilir enerji, sürdürbilirlik",
        "hint_ec_keyprases" => "EC Keyprases",
        "hint_topics" => "Yenilebilir Enerjide Güneş",
        "hint_type_of_contribution" => "Katkı Türü",
        "hint_abstract_paper" => "Ön Metin",

        "input_authors" => "Yazarlar",

        "ui_forgot_password" => "Şifremi Unuttum !",
        "ui_register" => "Kayıt Ol",

        "ui_login" => "Giriş Yap",

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
        "ui_first_name" => "İsim",
        "ui_last_name" => "Soy İsim",
        "ui_email" => "Eposta",
        "ui_submission_id" => "Makale",
        "ui_add_new" => "Yeni Ekle",
        "ui_filters" => "Filtreler",
        "ui_search" => "Ara",

        "ui_status_full_paper" => "Tam Metin Durumu",
        "ui_status_invoice" => "Makbuz Durumu",

        "ui_users" => "Kullanıcılar",

        "ui_all_of_them" => "Hepsi",
        "ui_pending" => "Bekliyor",
        "ui_rejected" => "Rededildi",
        "ui_accepted" => "Kabul Edildi",
        "ui_nothing" => "İşlem Yapılmadı",

        "ui_authors" => "Yazarlar",
        "ui_submission" => "Makale",
        "ui_submission_full_paper" => "Tam Metin",
        "ui_submission_invoice" => "Makbuz",

        "ui_user_info" => "Kullanıcı Bilgileri",
        "ui_user_preferences" => "Kullanıcı Tercihleri",
        "ui_user_password" => "Şifre Değişikliği",
        "ui_user_delete" => "Kullanıcıyı Sil",

        "ui_announcements" => "Duyurular",
        "ui_user_announcements" => "Kullanıcı Duyuruları",
        "ui_unread_messages" => "Okunmamış mesajlar",

        "ui_delete_user" => "Kullanıcıyı Sil",
        "user_delete_success" => "Kullanıcı Başarıyla Silindi",
        "user_delete_failure" => "Kullanıcı Silinirken Sorun Oluştu",

        "ui_announcement_view" => "Duyuruyu Görüntüle",

        "ui_insert_user" => "Yeni Kullanıcı Ekle",
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
        "ui_show_file" => "Dosyayı Görüntüle",
        "ui_user_view" => "Kullanıcıyı Görüntüle",
        "ui_confirm" => "Onayla",
        "ui_view" => "Görüntüle",
        "ui_submission_message_view" => "Yorumları Görüntüle",
        "ui_ec_id" => "EC ID",
        "ui_submit_date" => "Gönderim Tarihi",
        "ui_paper_title" => "Başlık",
        "ui_presentation_type" => "Sunum Şekli",
        "ui_abstract_paper" => "Ön Metin",
        "ui_full_paper" => "Tam Metin",
        "ui_message" => "Yorum",
        "ui_created_at" => "İşlem Tarihi",
        "ui_status" => "Durum",
        "ui_owner" => "İşlemi Yapan",
        "ui_full_name" => "İsim Soyisim",
        "ui_download" => "İndir",
        "ui_decline" => "Reddet",
        "ui_declined" => "Rededildi",
        "ui_confirmed" => "Onaylandı",
        "ui_invoice" => "Makbuz",

        "ui_submission_comments" => "Makale Yorumları",

        "ui_insert_user_announcements" => "Duyuru Ekle",
        "ui_update_user_announcements" => "Duyuru Güncelleme",

        "ui_delete_user_announcements" => "Duyuru Sil",
        "ui_delete_submissions" => "Makale Silme",

        "ui_delete_are_you_sure" => "Silmek İstediğinize eminmisiniz ?",

        "ui_user_messages" => "Kullanıcı Mesajları",

        "ui_status_nothing" => "İşlem Yapılmadı",
        "ui_status_pending" => "Bekliyor",
        "ui_status_accepted" => "Onaylandı",
        "ui_status_declined" => "Rededildi",
        "ui_status_completed" => "Tamamlandı",
        "ui_status_canceled" => "İptal Edildi",

        "ui_complete_task" => "İşlemi Tamamla",
        "ui_cancel_task" => "İşlemi İptal Et",

        "ui_set_complete_are_you_sure" => "İşlemi tamamlamak istediğinize eminmisiniz ?",
        "submission_comment_set_completed_success" => "İşlem başarıyla tamamlandı",
        "submission_comment_set_completed_failure" => "İşlem tamamlanırken sorun oluştu",

        "ui_submission_logs" => "İşlem Geçmişi",

        "ui_canceled_task" => "İşlemi İptal Et",
        "ui_set_canceled_are_you_sure" => "İşlemi iptal etmek istediğinize eminmisiniz ?",
        "submission_comment_set_canceled_success" => "İşlem iptal edildi",
        "submission_comment_set_canceled_failure" => "İşlem İptal edilirken sorun oluştu",

        "ui_pending_task" => "İşlemi Aç",
        "ui_set_pending_are_you_sure" => "İşlemi Açmak istediğinize eminmisiniz ?",
        "submission_comment_set_pending_success" => "İşlem başarıyla geri açıldı",
        "submission_comment_set_pending_failure" => "İşlem geri açılırken sorun oluştu",

        "ui_error_upload_full_paper" => "Makbuz Yüklenemedi",
        "request_submission_full_paper_success" => "Tam Metin talebi başarıyla gönderildi",
        "request_submission_full_paper_failure" => "Tam Metin talebi gönderilirken sorun oluştu",

        "ui_error_upload_invoice" => "Tam Metin Yüklenemedi",
        "request_submission_invoice_insert_success" => "Makbuz talebi başarıyla gönderildi",
        "request_submission_invoice_insert_failure" => "Makbuz talebi gönderilirken sorun oluştu",

        "error_upload_full_paper" => "Tam Metin Yüklenemedi",

        "user_announcement_delete_success" => "Duyuru Başarıyla Silindi",
        "user_announcement_insert_success" => "Duyuru Başarıyla Eklendi",
        "user_announcement_update_success" => "Duyuru Başarıyla Güncellendi",
        "user_announcement_update_failure" => "Duyuru Güncellenirken Sorun Oluştu",

        "ui_force_request_submission_full_paper" => "Tam Metini İşaretle",
        "ui_force_request_full_paper_are_you_sure" => "Tam Metin Gönderilmiş ve Onaylanmış Sayılacaktır. Emin misiniz ?",
        "request_submission_full_paper_force_confirm_success" => "Tam Metinin işaretlenmesi başarıyla tamamlandı",
        "request_submission_full_paper_force_confirm_failure" => "Tam Metin işaretlenirken sorun oluştu",

        "ui_force_request_submission_invoice" => "Makbuzu İşaretle",
        "ui_force_request_invoice_are_you_sure" => " Makbuz Gönderilmiş ve Onaylanmış Sayılacaktır. Emin misiniz ?",
        "request_submission_invoice_force_confirm_success" => "Makbuzun işaretlenmesi başarıyla tamamlandı",
        "request_submission_invoice_force_confirm_failure" => "Makbuz işaretlenirken sorun oluştu",

        "ui_submissions" => "Makaleler",

        "hint_type_message" => "Mesajınızı Yazınız",

        "user_select_failure" => "Kullanıcılar Çekilemedi",
        "user_show_failure" => "Kullanıcı Verisi Çekilemedi",

        "change_password_success" => "Şifre Başarıyla Güncellendi",
        "change_password_failure" => "Şifre Güncellenirken Sorun Oluştu",

        "user_update_preferences_success" => "Kullanıcı Tercihleri başarıyla güncellendi",
        "user_update_preferences_failure" => "Kullanıcı Tercihleri güncellenirken sorun oluştu",

        "user_update_info_success" => "Kullanıcı Bilgileri başarıyla güncellendi",
        "user_update_info_failure" => "Kullanıcı Bilgileri güncellenirken sorun oluştu",

        "submission_delete_success" => "Makale başarıyla silindi",
        "submission_delete_failure" => "Makale silinirken sorun oluştu",

        "log_request_submission_invoice_decline" => "Makbuz gönderimi red edildi",

        "ui_insert_announcements" => "Duyuru Ekleme",
        "ui_update_announcements" => "Duyuru Güncelleme",
        "ui_update_announcement" => "Duyuru Güncelleme",
        "ui_delete_announcement" => "Duyuruyu Sil",
        "ui_delete_announcements" => "Duyuru Silme",

        "announcement_delete_success" => "Duyuru Başarıyla Silindi",
        "announcement_delete_failure" => "Duyuru Silinirken Sorun Oluştu",


        "announcement_insert_success" => "Duyuru başarıyla kayıt edildi",
        "announcement_insert_failure" => "Duyuru kayıt edilirken sorunla karşılaşıldı",
        "announcement_update_success" => "Duyuru başarıyla güncellendi",
        "announcement_update_failure" => "Duyuru güncellenirken sorunla karşılaşıldı",

        "ui_request_submission_invoices" => "Mekbuz Gönderim Listesi",

        "ui_confirm_request_submission_invoice" => "Makbuz Gönderimini Onayla",
        "ui_decline_request_submission_invoice" => "Makbuz Gönderimini Reddet",
        "ui_delete_request_submission_invoice" => "Makbugz Gönderimini Sil",

        "ui_confirm_are_you_sure" => "Onaylamak istediğinize emin misiniz ?",
        "ui_decline_are_you_sure" => "Reddetmek istediğinize emin misiniz ?",

        "request_submission_invoice_confirm_success" => "Makbuz Gönderimi Başarıyla Onaylandı",
        "request_submission_invoice_confirm_failure" => "Makbuz Gönderimi Onaylanırken sorun oluştu",

        "request_submission_invoice_decline_success" => "Makbuz Gönderimi Başarıyla rededildi",
        "request_submission_invoice_decline_failure" => "Makbuz Gönderimi Rededilirken sorun oluştu",

        "request_submission_invoice_delete_success" => "Makbuz Gönderimi başarıyla silindi",
        "request_submission_invoice_delete_failure" => "Makbuz Gönderimi silinirken sorun oluştu",

        "ui_request_submission_full_papers" => "Tam Metin Gönderimleri Listesi",

        "ui_confirm_request_submission_full_paper" => "Tam Metin Gönderimi Onaylama",

        "request_submission_full_paper_confirm_success" => "Tam Metin Gönderimi başarıyla onaylandı",
        "request_submission_full_paper_confirm_failure" => "Tam Metin Gönderimi onaylanırken sorun oluştu",

        "ui_decline_request_submission_full_paper" => "Tam Metin Gönderimi Reddet",

        "request_submission_full_paper_decline_success" => "Tam Metin Gönderimi başarıyla rededildi",
        "request_submission_full_paper_decline_failure" => "Tam Metin Gönderimi rededilirken sorun oluştu",

        "ui_delete_request_submission_full_paper" => "Tam Metin Gönderimi Silme",

        "request_submission_full_paper_delete_success" => "Tam Metin Gönderimi başarıyla silindi",
        "request_submission_full_paper_delete_failure" => "Tam Metin Gönderimi silinirken sorun oluştu",

        "request_submission_full_paper_insert" => "Tam Metin Gönderildi",
        "request_submission_invoice_insert" => "Makbuz Gönderildi",

        "ui_submission_comment_insert" => "Makale Yorumu Ekleme",
        "ui_insert_submission_comment" => "Makale Yorumu Ekleme",

        "ui_dt_info_empty" => "Gösterilecek Veri Yok",
        "ui_dt_info_filtered" => " - Toplam _MAX_ kayıt içinde",

        "ui_insert" => "Ekle",
        "hint_message" => "Mesaj",

        "submission_comment_insert_success" => "Makale Yorumu Başarıyla eklendi",
        "submission_comment_insert_failure" => "Makale Yorumu Eklenirken sorun oluştu",

        "submission_comment_insert" => "Makaleye yorum eklendi",

        "submission_request_submission_invoice_decline" => "Makbuz gönderimi rededildi",
        "submission_request_submission_invoice_confirm" => "Makbuz gönderimi kabul edildi",

        "submission_request_submission_full_paper_confirm" => "Tam metin gönderimi kabul edildi",
        "submission_request_submission_full_paper_decline" => "Tam metin gönderimi rededildi",

        "request_submission_invoice_force_confirm" => "Makbuz yönetici tarafından onaylandı",
        "request_submission_full_paper_force_confirm" => "Tam metin yönetici tarafından onaylandı",

        "ui_send_password" => "Şifreyi Gönder",

        "mail_template_forgot_password" => "Merhabalar,<br>Şifre yenileme talebiniz başarıyla işleme alınmıştır.<br>Yeni Şifreniz :<b>[[FIRST_PARAM]]</b>",
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