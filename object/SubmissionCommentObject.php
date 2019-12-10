<?php

require_once 'object/UserObject.php';

class SubmissionCommentObject
{
    //Status 0 => Beklemede, 1 => Tamamlandı, 2 => İptal Edildi
    public $id, $message, $status, $submissionId, $created_by, $created_at;

    public function insertWithInput()
    {
        $inputCheck = $this->insertInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->insert(
            post('message'),
            post('submission_id')
            );
    }

    public function insertInputCheck()
    {
        return InputCheck::checkAll([
            new Input("message", Input::METHOD_POST, "input_message", Input::TYPE_TEXT, 1, 256),
            new Input('submission_id', Input::METHOD_POST, 'input_submission', Input::TYPE_INT, 1, 32)
        ]);
    }

    /*
     * [PERM] => SADECE ADMİNLER
     */
    public function insert($message, $submissionID)
    {
        global $user;

        if (!$user->perm(UserObject::PERM_IS, UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $insertComment = Database::insertReturnID("INSERT INTO submission_comments (comment_submission, comment_message, comment_created_by) VALUES ('{$submissionID}', '{$message}', {$user->id})");

        if ($insertComment->status) {
            Log::insertWithKey('comment_insert', [120, $insertComment->data], [$user->getFullName()]);

            return new Output(true, Lang::get('comment_insert_success'), $insertComment->data);
        } else {
            return new Output(false, Lang::get('comment_insert_failure'));
        }
    }

    public function setCompleted($commentID){
        global $user;

        if (!$user->perm(UserObject::PERM_IS, UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $updateComment = Database::exec("UPDATE submission_comments SET comment_status = 1, updated_by = {$user->id}, updated_at = '".getCustomDate()."' WHERE comment_id  = {$commentID}");


        if ($updateComment->status) {
            Log::insertWithKey('comment_set_complete', [121], [$user->getFullName()]);

            return new Output(true, Lang::get('comment_set_completed_success'), $updateComment->data);
        } else {
            return new Output(false, Lang::get('comment_set_completed_failure'));
        }
    }

    public function setCanceled($commentID){
        global $user;

        if (!$user->perm(UserObject::PERM_IS, UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $updateComment = Database::exec("UPDATE submission_comments SET comment_status = 2, updated_by = {$user->id}, updated_at = '".getCustomDate()."' WHERE comment_id  = {$commentID}");


        if ($updateComment->status) {
            Log::insertWithKey('comment_set_canceled', [122], [$user->getFullName()]);

            return new Output(true, Lang::get('comment_set_canceled_success'), $updateComment->data);
        } else {
            return new Output(false, Lang::get('comment_set_canceled_failure'));
        }
    }

    public function setPending($commentID){
        global $user;

        if (!$user->perm(UserObject::PERM_IS, UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $updateComment = Database::exec("UPDATE submission_comments SET comment_status = 0, updated_by = {$user->id}, updated_at = '".getCustomDate()."' WHERE comment_id  = {$commentID}");


        if ($updateComment->status) {
            Log::insertWithKey('comment_set_pending', [123], [$user->getFullName()]);

            return new Output(true, Lang::get('comment_set_pending_success'), $updateComment->data);
        } else {
            return new Output(false, Lang::get('comment_set_pending_failure'));
        }
    }

    public function delete($commentID){
        global $user;

        if (!$user->perm(UserObject::PERM_IS, UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $updateComment = Database::exec("UPDATE submission_comments SET comment_active = 0, comment_updated_by = {$user->id}, comment_updated_at = '".getCustomDate()."' WHERE comment_id  = {$commentID}");


        if ($updateComment->status) {
            Log::insertWithKey('comment_delete', [124], [$user->getFullName()]);

            return new Output(true, Lang::get('comment_delete_success'), $updateComment->data);
        } else {
            return new Output(false, Lang::get('comment_delete_failure'));
        }
    }

    public function setCompletedWithInput()
    {
        $inputCheck = $this->setCompletedInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->setCompleted(
            post('comment_id')
        );
    }

    public function setCompletedInputCheck()
    {
        return InputCheck::checkAll([
            new Input("comment_id", Input::METHOD_POST, "input_comment", Input::TYPE_INT, 1, 16)
        ]);
    }

    public function setPendingWithInput()
    {
        $inputCheck = $this->setPendingInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->setPending(
            post('comment_id')
        );
    }

    public function setPendingInputCheck()
    {
        return InputCheck::checkAll([
            new Input("comment_id", Input::METHOD_POST, "input_comment", Input::TYPE_INT, 1, 16)
        ]);
    }

    public function setCanceledWithInput()
    {
        $inputCheck = $this->setCanceledInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->setCanceled(
            post('comment_id')
        );
    }

    public function setCanceledInputCheck()
    {
        return InputCheck::checkAll([
            new Input("comment_id", Input::METHOD_POST, "input_comment", Input::TYPE_INT, 1, 16)
        ]);
    }

    public function deleteWithInput()
    {
        $inputCheck = $this->deleteInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->delete(
            post('comment_id')
        );
    }

    public function deleteInputCheck()
    {
        return InputCheck::checkAll([
            new Input("comment_id", Input::METHOD_POST, "input_comment", Input::TYPE_INT, 1, 16)
        ]);
    }

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
            'submission_comment_fullName'
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

        $select = Database::select("SELECT submission_comment_id, submission_comment_submission, submission_comment_message, submission_comment_created_at, submission_comment_status, (SELECT CONCAT_WS(' ', user_first_name, user_last_name) FROM users WHERE user_id = submission_comment_created_by) as submission_comment_fullName FROM submission_comments WHERE submission_comment_active = 1 {$querySearch} ORDER BY {$columns[$orderColumn]} {$orderDir} LIMIT  {$length} OFFSET {$start}");
        $stats = Database::select("SELECT COUNT(*) as recordsFiltered, (SELECT COUNT(*) FROM submission_comments WHERE submission_comment_active = 1) as recordsTotal FROM submission_comments WHERE submission_comment_active = 1 {$querySearch}");

        if ($select->status && $stats->status) {
            return new DataTablesOutput(true, Lang::get('submission_select_success'), $select->data, $stats->data[0]['recordsTotal'], $stats->data[0]['recordsFiltered']);
        } else {
            return new DataTablesOutput(false, Lang::get('submission_select_failure'));
        }
    }

    //endregion
}