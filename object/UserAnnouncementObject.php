<?php


class UserAnnouncementObject
{
    public $id, $title, $message, $userID;

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
            post('user'),
            );
    }

    public function insertInputCheck()
    {
        return InputCheck::checkAll([
            new Input('title', Input::METHOD_POST, 'input_title', Input::TYPE_TEXT, 1, 256),
            new Input('message', Input::METHOD_POST, 'input_message', Input::TYPE_TEXT, 1, 2048),
            new Input('user', Input::METHOD_POST, 'input_user', Input::TYPE_INT, 1, 32),
        ]);
    }

    public function insert($title, $message, $userID)
    {
        global $user;

        if (!$user->perm(UserObject::PERM_IS, UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $insertResult = Database::insert("INSERT INTO user_announcements (user_announcement_title, user_announcement_message, user_announcement_user, user_announcement_created_by) VALUES ('{$title}', '{$message}', {$userID}, {$user->id})");

        if ($insertResult->status) {
            Log::insert('user_announcement_insert', 90, $insertResult->data, $userID);

            return new Output(true, Lang::get('user_announcement_insert_success'));
        } else {
            return new Output(false, Lang::get('user_announcement_insert_failure'));
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
            post('user_announcement')
        );
    }

    public function deleteInputCheck()
    {
        return InputCheck::checkAll([
            new Input('user_announcement', Input::METHOD_POST, 'input_user_announcement', Input::TYPE_INT, 1, 32),
        ]);
    }

    private function delete($announcementID)
    {
        global $user;

        if (!$user->perm(UserObject::PERM_IS, UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $delete = Database::exec("UPDATE user_announcements SET user_announcement_active = 0, user_announcement_updated_by = '{$user->id}' , user_announcement_updated_at = '" . getCustomDate() . "' WHERE user_announcement_id = {$announcementID}");

        if ($delete->status) {
            Log::insert('user_announcement_delete', 91, $announcementID);

            return new Output(true, Lang::get('user_announcement_delete_success'));
        } else {
            return new Output(true, Lang::get('user_announcement_delete_failure'));
        }

    }

    //endregion

    //region Select

    public function selectWithInput()
    {
        $inputCheck = $this->selectInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->select(
            post('user')
        );
    }

    public function selectInputCheck()
    {
        return InputCheck::checkAll([
            new Input('user', Input::METHOD_POST, 'input_user', Input::TYPE_INT, 1, 8),
        ]);
    }

    public function select($userID)
    {
        global $user;

        if (!$user->perm(UserObject::PERM_SELF_OR_UPPER, $userID, UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $select = Database::select("SELECT user_announcement_id, user_announcement_title, user_announcement_message, user_announcement_user FROM user_announcements WHERE user_announcement_active = 1 AND user_announcement_user = {$userID}");

        if ($select->status) {
            //Log::insert('user_announcement_select_success', 94, $userID);

            return new Output(true, Lang::get('user_announcement_select_success'), $select->data);
        } else {
            return new Output(false, Lang::get('user_announcement_select_failure'));
        }
    }

    //endregion
}