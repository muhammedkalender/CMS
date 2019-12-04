<?php


class UserAnnouncementMessageObject
{
    public $id, $message, $announcementId, $created_at, $created_by;

    //region Insert

    public function insertWithInput()
    {
        $inputCheck = $this->insertInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->insert(
            post('message'),
            post('announcement')
            );
    }

    public function insertInputCheck()
    {
        return InputCheck::checkAll([
            new Input('message', Input::METHOD_POST, 'input_message', Input::TYPE_TEXT, 1, 2048),
            new Input('announcement', Input::METHOD_POST, 'input_announcement', Input::TYPE_INT, 1, 32)
        ]);
    }

    public function insert($message, $announcementID)
    {
        global $user;

        $announcement = Database::first("SELECT * FROM user_announcements WHERE user_announcement_id = {$announcementID}");

        if ($announcement->status == false || empty($announcement->data)) {
            return new Output(false, Lang::get('user_announcement_select_null'));
        }

        if (!$user->perm(UserObject::PERM_SELF_OR_UPPER, $announcement->data['user_announcement_user'], UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $insertResult = Database::insertReturnID("INSERT INTO user_announcement_messages (user_announcement_message_announcement, user_announcement_message_message, user_announcement_message_created_by) VALUES ('{$announcementID}', '{$message}', {$user->id})");

        if ($insertResult->status) {
            Log::insert('user_announcement_message_insert', 100, $announcementID, $insertResult->data);

            return new Output(true, Lang::get('user_announcement_message_insert_success'));
        } else {
            return new Output(false, Lang::get('user_announcement_message_insert_failure'));
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
            post('user_announcement_message')
        );
    }

    public function deleteInputCheck()
    {
        return InputCheck::checkAll([
            new Input('user_announcement_message', Input::METHOD_POST, 'input_user_announcement_message', Input::TYPE_INT, 1, 32),
        ]);
    }

    private function delete($announcementMessageID)
    {
        global $user;

        if (!$user->perm(UserObject::PERM_IS, UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $delete = Database::exec("UPDATE user_announcement_messages SET user_announcement_message_active = 0, user_announcement_message_updated_by = '{$user->id}' , user_announcement_message_updated_at = '" . getCustomDate() . "' WHERE user_announcement_message_id = {$announcementMessageID}");

        if ($delete->status) {
            Log::insert('user_announcement_message_delete', 101, $announcementMessageID);

            return new Output(true, Lang::get('user_announcement_message_delete_success'));
        } else {
            return new Output(true, Lang::get('user_announcement_message_delete_failure'));
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
            post('user-announcement')
        );
    }

    public function selectInputCheck()
    {
        return InputCheck::checkAll([
            new Input('user-announcement', Input::METHOD_POST, 'input_announcement', Input::TYPE_INT, 1, 8),
        ]);
    }

    public function select($announcementID)
    {
        global $user;

        $announcement = Database::first("SELECT * FROM user_announcements WHERE user_announcement_id = {$announcementID}");

        if ($announcement->status == false || empty($announcement->data)) {
            return new Output(false, Lang::get('announcement_select_null'));
        }

        if (!$user->perm(UserObject::PERM_SELF_OR_UPPER, $announcement->data['user_announcement_user'], UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $select = Database::select("SELECT user_announcement_message_id, user_announcement_message_message, user_announcement_message_announcement, user_announcement_message_created_at, user_announcement_message_created_by, (SELECT CONCAT_WS(' ', user_first_name, user_last_name) FROM users WHERE user_id = user_announcement_message_created_by) as userFullName FROM user_announcement_messages WHERE user_announcement_message_active = 1 AND user_announcement_message_announcement = {$announcementID}");

        if ($select->status) {
            //Log::insert('user_announcement_message_select_success', 104, $announcementID);

            return new Output(true, Lang::get('user_announcement_message_select_success'), $select->data);
        } else {
            return new Output(false, Lang::get('user_announcement_message_select_failure'));
        }
    }

    //endregion
}