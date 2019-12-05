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
            post('user')
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
            post('id')
        );
    }

    public function deleteInputCheck()
    {
        return InputCheck::checkAll([
            new Input('id', Input::METHOD_POST, 'input_user_announcement', Input::TYPE_INT, 1, 32),
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

        $select = Database::select("SELECT user_announcement_id, user_announcement_title, user_announcement_message, user_announcement_user, user_announcement_created_at, (SELECT COUNT(*) FROM user_announcement_messages WHERE user_announcement_message_announcement = user_announcement_id AND user_announcement_message_active = 1 AND user_announcement_message_read = 0) as unread_message_count FROM user_announcements WHERE user_announcement_active = 1 AND user_announcement_user = {$userID}");

        if ($select->status) {
            //Log::insert('user_announcement_select_success', 94, $userID);

            return new Output(true, Lang::get('user_announcement_select_success'), $select->data);
        } else {
            return new Output(false, Lang::get('user_announcement_select_failure'));
        }
    }

    //endregion


    //region Data Tables

    public function dataTablesWithInput()
    {
        $inputCheck = $this->dataTablesInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->dataTables(
            post('start'),
            post('length'),
            post('keyword'),
            post('orderColumn'),
            post('orderDir')
        );
    }

    public function dataTablesInputCheck()
    {
        if (isset($_POST['search']) && isset($_POST['search']['value'])) {
            setPost('keyword', $_POST['search']['value']);
        } else {
            setPost('keyword', '');
        }

        if (isset($_POST['order']) && isset($_POST['order'][0]['column']) && isset($_POST['order'][0]['dir'])) {
            setPost('orderColumn', $_POST['order'][0]['column']);
            setPost('orderDir', $_POST['order'][0]['dir'] == 'asc' ? 'ASC' : 'DESC');
        } else {
            setPost('orderColumn', 1);
            setPost('orderDir', 'ASC');
        }

        return InputCheck::checkAll([
            new Input('start', Input::METHOD_POST, 'input_start', Input::TYPE_INT, 1, 8),
            new Input('length', Input::METHOD_POST, 'input_length', Input::TYPE_INT, 1, 8),
            new Input('keyword', Input::METHOD_POST, 'input_keyword', Input::TYPE_TEXT, 0, 64),
            new Input('orderColumn', Input::METHOD_POST, 'input_order_column', Input::TYPE_INT, 1, 8),
            new Input('orderDir', Input::METHOD_POST, 'input_order_dir', Input::TYPE_TEXT, 3, 4),
        ]);
    }

    public function dataTables($start, $length, $keyword, $orderColumn, $orderDir)
    {
        global $user;

        if (!$user->perm(UserObject::PERM_IS, UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $columns = [
            'user_announcement_id',
            'user_announcement_title',
            'user_announcement_created_at',
            'createdBy',
            'userFullName'
        ];

        $querySearch = "";

        if (post('keyword')) {
            $querySearch = dataTablesLikeQuery($keyword, [
                'user_announcement_id',
                'user_announcement_title',
                'user_announcement_message',
                'userFullName',
                'user_announcement_created_at'
            ]);
        }

        $select = Database::select("SELECT user_announcement_id, user_announcement_title, user_announcement_message, user_announcement_created_at, user_announcement_user, (SELECT CONCAT_WS(' ', user_first_name, user_last_name) FROM users WHERE user_id = user_announcement_created_by) as createdBy, (SELECT CONCAT_WS(' ', user_first_name, user_last_name) FROM users WHERE user_id = user_announcement_user) as userFullName FROM user_announcements WHERE user_announcement_active = 1 {$querySearch} ORDER BY " . $columns[$orderColumn] . ' ' . $orderDir . ' LIMIT ' . $length . ' OFFSET ' . $start);
        $stats = Database::select("SELECT COUNT(*) as recordsFiltered, (SELECT COUNT(*) FROM user_announcements WHERE user_announcement_active = 1) as recordsTotal FROM user_announcements WHERE user_announcement_active = 1 {$querySearch}");

        if ($select->status && $stats->status) {
            return new DataTablesOutput(true, Lang::get('user_announcement_select_success'), $select->data, $stats->data[0]['recordsTotal'], $stats->data[0]['recordsFiltered']);
        } else {
            return new DataTablesOutput(false, Lang::get('user_announcement_select_failure'));
        }

    }

    //endregion

    //region Update

    public function updateWithInput()
    {
        $inputCheck = $this->updateInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->update(
            post('id'),
            post('title'),
            post('message'),
            post('user')
        );
    }

    public function updateInputCheck()
    {
        return InputCheck::checkAll([
            new Input('id', Input::METHOD_POST, 'input_user_announcement', Input::TYPE_INT, 1, 8),
            new Input('title', Input::METHOD_POST, 'input_title', Input::TYPE_TEXT, 1, 256),
            new Input('message', Input::METHOD_POST, 'input_message', Input::TYPE_TEXT, 1, 2048),
            new Input('user', Input::METHOD_POST, 'input_user', Input::TYPE_INT, 1, 32),
        ]);
    }

    public function update($userAnnouncement, $title, $message, $userID)
    {
        global $user;

        if (!$user->perm(UserObject::PERM_IS, UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $updateResult = Database::exec("UPDATE user_announcements SET user_announcement_title = '{$title}', user_announcement_message = '{$message}', user_announcement_user = {$userID}, user_announcement_updated_by = {$user->id} WHERE user_announcement_id = {$userAnnouncement}");

        if ($updateResult->status) {
            Log::insert('user_announcement_update', 96, $userAnnouncement, $userID);

            return new Output(true, Lang::get('user_announcement_update_success'));
        } else {
            return new Output(false, Lang::get('user_announcement_update_failure'));
        }
    }

    //endregion
}