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
            post('submission_id'),
            );
    }

    public function insertInputCheck()
    {
        return InputCheck::checkAll([
            new Input("message", Input::METHOD_POST, "input_message", Input::TYPE_TEXT, 1, 256),
            new Input('submission_id', Input::METHOD_POST, 'input_submission', Input::TYPE_INT, 1, 32),
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

        $updateComment = Database::exec("UPDATE submission_comments SET comment_status = 1, updated_by = {$user->id}, updated_at = '".getDate()."' WHERE comment_id  = {$commentID}");


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

        $updateComment = Database::exec("UPDATE submission_comments SET comment_status = 2, updated_by = {$user->id}, updated_at = '".getDate()."' WHERE comment_id  = {$commentID}");


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

        $updateComment = Database::exec("UPDATE submission_comments SET comment_status = 0, updated_by = {$user->id}, updated_at = '".getDate()."' WHERE comment_id  = {$commentID}");


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

        $updateComment = Database::exec("UPDATE submission_comments SET comment_is_active = 0, updated_by = {$user->id}, updated_at = '".getDate()."' WHERE comment_id  = {$commentID}");


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
            post('comment_id'),
            );
    }

    public function setCompletedInputCheck()
    {
        return InputCheck::checkAll([
            new Input("comment_id", Input::METHOD_POST, "input_comment", Input::TYPE_INT, 1, 16),
        ]);
    }

    public function setPendingWithInput()
    {
        $inputCheck = $this->setPendingInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->setPending(
            post('comment_id'),
            );
    }

    public function setPendingInputCheck()
    {
        return InputCheck::checkAll([
            new Input("comment_id", Input::METHOD_POST, "input_comment", Input::TYPE_INT, 1, 16),
        ]);
    }

    public function setCanceledWithInput()
    {
        $inputCheck = $this->setCanceledInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->setCanceled(
            post('comment_id'),
            );
    }

    public function setCanceledInputCheck()
    {
        return InputCheck::checkAll([
            new Input("comment_id", Input::METHOD_POST, "input_comment", Input::TYPE_INT, 1, 16),
        ]);
    }

    public function deleteWithInput()
    {
        $inputCheck = $this->deleteInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->delete(
            post('comment_id'),
            );
    }

    public function deleteInputCheck()
    {
        return InputCheck::checkAll([
            new Input("comment_id", Input::METHOD_POST, "input_comment", Input::TYPE_INT, 1, 16),
        ]);
    }
}