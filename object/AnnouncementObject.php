<?php

class AnnouncementObject
{
    //Duyurular dillere özel çekilecek, Dil yoksa herkese
    //Duyuru her bir kullanıcıya eklenecek ( mesajlaşma yapabilecekelr )
    public $id, $title, $message, $languageCode;

    public $createdAt;

    //region Insert

    public function insertWithInput()
    {
        $inputCheck = $this->insertInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->insert(
            post('title'),
            post('message'),
            post('language_code')
            );
    }

    public function insertInputCheck()
    {
        return InputCheck::checkAll([
            new Input('title', Input::METHOD_POST, 'input_title', Input::TYPE_TEXT, 1, 256),
            new Input('message', Input::METHOD_POST, 'input_message', Input::TYPE_TEXT, 1, 2048),
            new Input('language_code', Input::METHOD_POST, 'input_language_code', Input::TYPE_INT, 1, 32),
        ]);
    }

    public function insert($title, $message, $languageCode)
    {
        global $user;

        if (!$user->perm(UserObject::PERM_IS, UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $insertResult = Database::insert("INSERT INTO announcements (announcement_title, announcement_message, announcement_language, announcement_created_by) VALUES ('{$title}', '{$message}', {$languageCode}, {$user->id})");

        if ($insertResult->status) {
            Log::insert('announcement_insert', 80, $insertResult->data);

            return new Output(true, Lang::get('announcement_insert_success'));
        } else {
            return new Output(false, Lang::get('announcement_insert_failure'));
        }
    }

    //endregion

    //region Delete

    public function deleteWithInput()
    {
        $inputCheck = $this->deleteInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->delete(
            post('announcement')
        );
    }

    public function deleteInputCheck()
    {
        return InputCheck::checkAll([
            new Input('announcement', Input::METHOD_POST, 'input_announcement', Input::TYPE_INT, 1, 32),
        ]);
    }

    private function delete($announcementID)
    {
        global $user;

        if (!$user->perm(UserObject::PERM_IS, UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $delete = Database::exec("UPDATE announcements SET announcement_active = 0, announcement_updated_by = '{$user->id}' , announcement_updated_at = '" . getCustomDate() . "' WHERE announcement_id = {$announcementID}");

        if ($delete->status) {
            Log::insert('announcement_delete', 81, $announcementID);

            return new Output(true, Lang::get('announcement_delete_success'));
        } else {
            return new Output(true, Lang::get('announcement_delete_failure'));
        }

    }

    //endregion

    //region Select

    public function selectWithInput(){
        $inputCheck = $this->selectInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->select(
            post('language')
        );
    }

    public function selectInputCheck()
    {
        return InputCheck::checkAll([
            new Input('language', Input::METHOD_POST, 'input_language', Input::TYPE_INT, 1, 8),
        ]);
    }

    public function select($language){
        global $user;

        if (!$user->perm(UserObject::PERM_UPPER, UserObject::PERM_GROUP_USER)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $select = Database::select("SELECT announcement_id, announcement_title, announcement_message, announcement_language, announcement_created_at FROM announcements WHERE announcement_active = 1 AND (announcement_language = 1 OR announcement_language = {$language})");

        if($select->status){
            //Log::insert('announcement_select_success', 84, $language);

            return new Output(true, Lang::get('announcement_select_success'), $select->data);
        }else{
            return new Output(false, Lang::get('announcement_select_failure'));
        }

    }

    //endregion
}