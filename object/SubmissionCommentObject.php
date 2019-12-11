<?php

require_once 'object/UserObject.php';

class SubmissionCommentObject
{
    //Status 0 => Beklemede, 1 => Tamamlandı, 2 => İptal Edildi
    public $id, $message, $status, $submissionId, $created_by, $created_at;

    //region Insert

    public function insertWithInput()
    {
        $inputCheck = $this->insertInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->insert(
            post('id'),
            post('message')
        );
    }

    public function insertInputCheck()
    {
        return InputCheck::checkAll([
            new Input('id', Input::METHOD_POST, 'input_submission', Input::TYPE_INT, 1, 32),
            new Input("message", Input::METHOD_POST, "input_message", Input::TYPE_TEXT, 1, 256)
        ]);
    }

    /*
     * [PERM] => SADECE ADMİNLER
     */
    public function insert($submissionID, $message)
    {
        global $user;

        if (!$user->perm(UserObject::PERM_IS, UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $insertComment = Database::insertReturnID("INSERT INTO submission_comments (submission_comment_submission, submission_comment_message, submission_comment_created_by) VALUES ('{$submissionID}', '{$message}', {$user->id})");

        if ($insertComment->status) {
            Log::insertWithKey('submission_comment_insert', [120, $insertComment->data]);

            return new Output(true, Lang::get('submission_comment_insert_success'), $insertComment->data);
        } else {
            return new Output(false, Lang::get('submission_comment_insert_failure'));
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
            new Input("id", Input::METHOD_POST, "input_comment", Input::TYPE_INT, 1, 16)
        ]);
    }

    public function delete($commentID)
    {
        global $user;

        if (!$user->perm(UserObject::PERM_IS, UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $updateComment = Database::exec("UPDATE submission_comments SET submission_comment_active = 0, submission_comment_updated_by = {$user->id}, submission_comment_updated_at = '" . getCustomDate() . "' WHERE submission_comment_id  = {$commentID}");


        if ($updateComment->status) {
            Log::insertWithKey('submission_comment_delete', [124, $commentID]);

            return new Output(true, Lang::get('submission_comment_delete_success'), $updateComment->data);
        } else {
            return new Output(false, Lang::get('submission_comment_delete_failure'));
        }
    }

    //endregion

    //region SetComplete

    public function setCompletedWithInput()
    {
        $inputCheck = $this->setCompletedInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->setCompleted(
            post('id')
        );
    }

    public function setCompletedInputCheck()
    {
        return InputCheck::checkAll([
            new Input("id", Input::METHOD_POST, "input_comment", Input::TYPE_INT, 1, 16)
        ]);
    }

    public function setCompleted($commentID)
    {
        global $user;

        if (!$user->perm(UserObject::PERM_IS, UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $updateComment = Database::exec("UPDATE submission_comments SET submission_comment_status = 1, submission_comment_updated_by = {$user->id}, submission_comment_updated_at = '" . getCustomDate() . "' WHERE submission_comment_id  = {$commentID}");


        if ($updateComment->status) {
            Log::insertWithKey('submission_comment_set_complete', [121, $commentID]);

            return new Output(true, Lang::get('submission_comment_set_completed_success'), $updateComment->data);
        } else {
            return new Output(false, Lang::get('submission_comment_set_completed_failure'));
        }
    }

    //endregion

    //region SetPending

    public function setPendingWithInput()
    {
        $inputCheck = $this->setPendingInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->setPending(
            post('id')
        );
    }

    public function setPendingInputCheck()
    {
        return InputCheck::checkAll([
            new Input("id", Input::METHOD_POST, "input_comment", Input::TYPE_INT, 1, 16)
        ]);
    }

    public function setPending($commentID)
    {
        global $user;

        if (!$user->perm(UserObject::PERM_IS, UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $updateComment = Database::exec("UPDATE submission_comments SET submission_comment_status = 0, submission_comment_updated_by = {$user->id}, submission_comment_updated_at = '" . getCustomDate() . "' WHERE submission_comment_id  = {$commentID}");


        if ($updateComment->status) {
            Log::insertWithKey('submission_comment_set_pending', [123, $commentID]);

            return new Output(true, Lang::get('submission_comment_set_pending_success'), $updateComment->data);
        } else {
            return new Output(false, Lang::get('submission_comment_set_pending_failure'));
        }
    }

    //endregion

    //region SetCanceled

    public function setCanceledWithInput()
    {
        $inputCheck = $this->setCanceledInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->setCanceled(
            post('id')
        );
    }

    public function setCanceledInputCheck()
    {
        return InputCheck::checkAll([
            new Input("id", Input::METHOD_POST, "input_comment", Input::TYPE_INT, 1, 16)
        ]);
    }

    public function setCanceled($commentID)
    {
        global $user;

        if (!$user->perm(UserObject::PERM_IS, UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $updateComment = Database::exec("UPDATE submission_comments SET submission_comment_status = 2, submission_comment_updated_by = {$user->id}, submission_comment_updated_at = '" . getCustomDate() . "' WHERE submission_comment_id  = {$commentID}");

        if ($updateComment->status) {
            Log::insertWithKey('submission_comment_set_canceled', [122, $commentID]);

            return new Output(true, Lang::get('submission_comment_set_canceled_success'), $updateComment->data);
        } else {
            return new Output(false, Lang::get('submission_comment_set_canceled_failure'));
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
            post('submission'),
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
            new Input('submission', Input::METHOD_POST, 'input_submission', Input::TYPE_INT, 1, 8),
            new Input('start', Input::METHOD_POST, 'input_start', Input::TYPE_INT, 1, 8),
            new Input('length', Input::METHOD_POST, 'input_length', Input::TYPE_INT, 1, 8),
            new Input('keyword', Input::METHOD_POST, 'input_keyword', Input::TYPE_TEXT, 0, 64),
            new Input('orderColumn', Input::METHOD_POST, 'input_order_column', Input::TYPE_INT, 1, 8),
            new Input('orderDir', Input::METHOD_POST, 'input_order_dir', Input::TYPE_TEXT, 3, 4),
        ]);
    }

    public function dataTables($submission, $start, $length, $keyword, $orderColumn, $orderDir)
    {
        global $user;

        if (!$user->perm(UserObject::PERM_IS, UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $columns = [
            'submission_comment_id',
            'submission_comment_submission',
            'submission_comment_message',
            'submission_comment_created_at',
            'submission_comment_fullName',
            'submission_comment_status'
        ];

        $querySearch = "";

        if (post('keyword')) {
            $querySearch = dataTablesLikeQuery(post('keyword'), [
                'submission_comment_id',
                'submission_comment_submission',
                'submission_comment_message',
                'submission_comment_created_at',
            ]);
        }

        $select = Database::select("SELECT submission_comment_id, submission_comment_submission, submission_comment_message, submission_comment_created_at, submission_comment_status, (SELECT CONCAT_WS(' ', user_first_name, user_last_name) FROM users WHERE user_id = submission_comment_created_by) as submission_comment_fullName FROM submission_comments WHERE submission_comment_submission = {$submission} AND submission_comment_active = 1 {$querySearch} ORDER BY {$columns[$orderColumn]} {$orderDir} LIMIT  {$length} OFFSET {$start}");
        $stats = Database::select("SELECT COUNT(*) as recordsFiltered, (SELECT COUNT(*) FROM submission_comments WHERE submission_comment_active = 1) as recordsTotal FROM submission_comments WHERE submission_comment_submission = {$submission} AND submission_comment_active = 1 {$querySearch}");

        if ($select->status && $stats->status) {
            return new DataTablesOutput(true, Lang::get('submission_select_success'), $select->data, $stats->data[0]['recordsTotal'], $stats->data[0]['recordsFiltered']);
        } else {
            return new DataTablesOutput(false, Lang::get('submission_select_failure'));
        }
    }

    //endregion
}