<?php

class AnnouncementObject
{
    //Duyurular dillere özel çekilecek, Dil yoksa herkese
    //Duyuru her bir kullanıcıya eklenecek ( mesajlaşma yapabilecekelr )
    public $id, $title, $message, $language;

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
            post('language')
        );
    }

    public function insertInputCheck()
    {
        return InputCheck::checkAll([
            new Input('title', Input::METHOD_POST, 'input_title', Input::TYPE_TEXT, 1, 256),
            new Input('message', Input::METHOD_POST, 'input_message', Input::TYPE_TEXT, 1, 2048),
            new Input('language', Input::METHOD_POST, 'input_language', Input::TYPE_INT, 1, 32),
        ]);
    }

    public function insert($title, $message, $language)
    {
        global $user;

        if (!$user->perm(UserObject::PERM_IS, UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $insertResult = Database::insert("INSERT INTO announcements (announcement_title, announcement_message, announcement_language, announcement_created_by) VALUES ('{$title}', '{$message}', {$language}, {$user->id})");

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
            post('id')
        );
    }

    public function deleteInputCheck()
    {
        return InputCheck::checkAll([
            new Input('id', Input::METHOD_POST, 'input_announcement', Input::TYPE_INT, 1, 32),
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

    public function selectWithInput()
    {
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

    public function select($language)
    {
        global $user;

        if (!$user->perm(UserObject::PERM_UPPER, UserObject::PERM_GROUP_USER)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $select = Database::select("SELECT announcement_id, announcement_title, announcement_message, announcement_language, announcement_created_at FROM announcements WHERE announcement_active = 1 AND (announcement_language = 1 OR announcement_language = {$language})");

        if ($select->status) {
            //Log::insert('announcement_select_success', 84, $language);

            return new Output(true, Lang::get('announcement_select_success'), $select->data);
        } else {
            return new Output(false, Lang::get('announcement_select_failure'));
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
            'announcement_id',
            'announcement_title',
            'announcement_created_at',
            'createdBy'
        ];

        $querySearch = "";

        if (post('keyword')) {
            $querySearch = dataTablesLikeQuery(post('keyword'), [
                'announcement_id',
                'announcement_title',
                'announcement_message',
                'announcement_language',
                'announcement_created_at'
            ]);
        }

        $select = Database::select("SELECT announcement_id, announcement_title, announcement_message, announcement_language, announcement_created_at, (SELECT CONCAT_WS(' ', user_first_name, user_last_name) FROM users WHERE user_id = announcement_created_by) as createdBy FROM announcements WHERE announcement_active = 1 {$querySearch} ORDER BY " . $columns[post('orderColumn')] . ' ' . post('orderDir') . ' LIMIT ' . post('length') . ' OFFSET ' . post('start'));
        $stats = Database::select("SELECT COUNT(*) as recordsFiltered, (SELECT COUNT(*) FROM announcements WHERE announcement_active = 1) as recordsTotal FROM announcements WHERE announcement_active = 1 {$querySearch}");

        if ($select->status && $stats->status) {
            return new DataTablesOutput(true, Lang::get('announcement_select_success'), $select->data, $stats->data[0]['recordsTotal'], $stats->data[0]['recordsFiltered']);
        } else {
            return new DataTablesOutput(false, Lang::get('announcement_select_failure'));
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
            post('language')
        );
    }

    public function updateInputCheck()
    {
        return InputCheck::checkAll([
            new Input('id', Input::METHOD_POST, 'input_announcement', Input::TYPE_INT, 1, 32),
            new Input('title', Input::METHOD_POST, 'input_title', Input::TYPE_TEXT, 1, 256),
            new Input('message', Input::METHOD_POST, 'input_message', Input::TYPE_TEXT, 1, 2048),
            new Input('language', Input::METHOD_POST, 'input_language', Input::TYPE_INT, 1, 32),
        ]);
    }

    public function update($announcementID, $title, $message, $language)
    {
        global $user;

        if (!$user->perm(UserObject::PERM_IS, UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $insertResult = Database::exec("UPDATE announcements SET announcement_title = '{$title}', announcement_message = '{$message}', announcement_language = {$language}, announcement_updated_by = {$user->id} WHERE announcement_id = {$announcementID}");

        if ($insertResult->status) {
            Log::insert('announcement_update', 86, $announcementID);

            return new Output(true, Lang::get('announcement_update_success'));
        } else {
            return new Output(false, Lang::get('announcement_update_failure'));
        }
    }

    //endregion
}