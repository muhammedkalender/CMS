<?php

require_once 'object/UserObject.php';

class RequestSubmissionFullPaperObject
{
    //region Variables

    public $id, $submissionID, $URL, $status;
    public $createdAt, $createdBy, $updatedAt, $updatedBy, $active;

    //endregion

    //region Insert

    public function insertWithInput()
    {
        $inputCheck = $this->insertInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->insert(
            post('id'),
            post('file')
        );
    }

    public function insertInputCheck()
    {
        return InputCheck::checkAll([
            new Input("id", Input::METHOD_POST, "input_submission", Input::TYPE_INT, 1, 32),
            new Input("file", Input::METHOD_POST, "input_file", Input::TYPE_BASE64_IMAGE, 1, 4096)
        ]);
    }

    public function insert($submissionID, $URL)
    {
        global $user;

        if (!$user->perm(UserObject::AUTHOR_OR_ADMIN, $submissionID, UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $resultInsert = Database::insertReturnID("INSERT INTO request_submission_full_papers (request_submission_full_paper_submission, request_submission_full_paper_url, request_submission_full_paper_created_by) VALUES ('{$submissionID}', '{$URL}', {$user->id})");

        //todo niyeyse hata veriyor ?
        if ($resultInsert->status) {
            Log::insertWithKey('request_submission_full_paper_insert', [180, $submissionID, $resultInsert->data]);

            return new Output(true, Lang::get('request_submission_full_paper_success'), $resultInsert->data);
        } else {
            return new Output(false, Lang::get('request_submission_full_paper_failure'));
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
            new Input("id", Input::METHOD_POST, "input_request_submission_full_paper", Input::TYPE_INT, 1, 32)
        ]);
    }

    public function delete($requestSubmissionFullPaperID)
    {
        global $user;

        if (!$user->perm(UserObject::PERM_IS, UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $resultDelete = Database::exec("UPDATE request_submission_full_papers SET request_submission_full_paper_active = 0, request_submission_full_paper_updated_by = '{$user->id}', request_submission_full_paper_updated_at = '" . getCustomDate() . "' WHERE request_submission_full_paper_id = '{$requestSubmissionFullPaperID}'");

        if ($resultDelete->status) {
            Log::insertWithKey('request_submission_full_paper_delete', [181, $requestSubmissionFullPaperID]);

            return new Output(true, Lang::get('request_submission_full_paper_delete_success'));
        } else {
            return new Output(false, Lang::get('request_submission_full_paper_delete_failure'));
        }
    }

    //endregion

    //region Confirm

    public function confirmWithInput()
    {
        $inputCheck = $this->confirmInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->confirm(
            post('id')
        );
    }

    public function confirmInputCheck()
    {
        return InputCheck::checkAll([
            new Input("id", Input::METHOD_POST, "input_request_submission_full_paper", Input::TYPE_INT, 1, 32)
        ]);
    }

    public function confirm($requestSubmissionFullPaperID)
    {
        global $user;

        if (!$user->perm(UserObject::PERM_IS, UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $resultSelect = Database::first("SELECT * FROM request_submission_full_papers WHERE request_submission_full_paper_id = '{$requestSubmissionFullPaperID}'");

        if (!$resultSelect->status) {
            return new Output(false, Lang::get('null_request_submission_full_paper'));
        }

        $submissionID = $resultSelect->data["request_submission_full_paper_submission"];

        $resultUpdate = Database::exec("UPDATE request_submission_full_papers SET request_submission_full_paper_status = 2, request_submission_full_paper_updated_by = '{$user->id}', request_submission_full_paper_updated_at = '" . getCustomDate() . "' WHERE request_submission_full_paper_id = '{$requestSubmissionFullPaperID}'");
        $resultRelatedUpdate = Database::exec("UPDATE submissions SET submission_full_paper = '" . $resultSelect->data["request_submission_full_paper_url"] . "', submission_updated_by = '{$user->id}', submission_updated_at = '" . getCustomDate() . "' WHERE submission_id = '" . $resultSelect->data["request_submission_full_paper_submission"] . "'");

        if ($resultRelatedUpdate->status) {
            Log::insertWithKey('request_submission_full_paper_confirm', [182, $requestSubmissionFullPaperID]);
            Log::insertWithKey('submission_request_submission_full_paper_confirm', [812, $submissionID, $requestSubmissionFullPaperID]);


            return new Output(true, Lang::get('request_submission_full_paper_confirm_success'));
        } else {
            return new Output(false, Lang::get('request_submission_full_paper_confirm_failure'));
        }
    }

    //endregion

    //region Force Confirm

    public function forceConfirmWithInput()
    {
        $inputCheck = $this->forceConfirmInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->forceConfirm(
            post('id')
        );
    }

    public function forceConfirmInputCheck()
    {
        return InputCheck::checkAll([
            new Input("id", Input::METHOD_POST, "input_submission", Input::TYPE_INT, 1, 32)
        ]);
    }

    public function forceConfirm($submissionID)
    {
        global $user;

        if (!$user->perm(UserObject::PERM_IS, UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $resultRelatedUpdate = Database::exec("UPDATE submissions SET submission_full_paper = '-1', request_submission_full_paper_updated_by = '{$user->id}' request_submission_full_paper_updated_At = '" . getCustomDate() . "' WHERE submission_id = '{$submissionID}'");

        if ($resultRelatedUpdate->status) {
            Log::insertWithKey('request_submission_full_paper_force_confirm', [185, $submissionID]);

            return new Output(true, Lang::get('request_submission_full_paper_force_confirm_success'));
        } else {
            return new Output(false, Lang::get('request_submission_full_paper_force_confirm_failure'));
        }
    }

    //endregion

    //region Decline

    public function declineWithInput()
    {
        $inputCheck = $this->declineInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->decline(
            post('id')
        );
    }

    public function declineInputCheck()
    {
        return InputCheck::checkAll([
            new Input("id", Input::METHOD_POST, "input_request_submission_full_paper", Input::TYPE_INT, 1, 32)
        ]);
    }

    public function decline($requestSubmissionFullPaperID)
    {
        global $user;

        if (!$user->perm(UserObject::PERM_IS, UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $resultSelect = Database::first("SELECT * FROM request_submission_full_papers WHERE request_submission_full_paper_id = '{$requestSubmissionFullPaperID}'");

        if(!$resultSelect->status){
            return new Output(false, Lang::get('null_request_submission_full_paper'));
        }

        $submissionID = $resultSelect->data["request_submission_full_paper_submission"];

        $resultUpdate = Database::exec("UPDATE request_submission_full_papers SET request_submission_full_paper_status = 1, request_submission_full_paper_updated_by = '{$user->id}', request_submission_full_paper_updated_at = '" . getCustomDate() . "' WHERE request_submission_full_paper_id = '{$requestSubmissionFullPaperID}'");

        if ($resultUpdate->status) {
            Log::insertWithKey('request_submission_full_paper_decline', [183, $requestSubmissionFullPaperID]);
            Log::insertWithKey("submission_request_full_paper_decline", [813, $submissionID, $requestSubmissionFullPaperID]);

            return new Output(true, Lang::get('request_submission_full_paper_decline_success'));
        } else {
            return new Output(false, Lang::get('request_submission_full_paper_decline_failure'));
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
            'request_submission_full_paper_id',
            'request_submission_full_paper_submission',
            'request_submission_full_paper_status',
            'request_submission_full_paper_full_name',
            'request_submission_full_paper_created_at'
        ];

        $querySearch = "";

        if ($keyword) {
            $querySearch = dataTablesLikeQuery(post('keyword'), [
                'request_submission_full_paper_id',
                'request_submission_full_paper_submission',
                'request_submission_full_paper_status',
            ]);
        }

        $select = Database::select("SELECT request_submission_full_paper_id, request_submission_full_paper_submission, request_submission_full_paper_status, request_submission_full_paper_url, request_submission_full_paper_created_by, request_submission_full_paper_created_at, (SELECT CONCAT_WS(' ', user_first_name, user_last_name) FROM users WHERE user_id = request_submission_full_paper_created_by) as request_submission_full_paper_full_name FROM request_submission_full_papers WHERE request_submission_full_paper_active = 1 {$querySearch} ORDER BY {$columns[$orderColumn]} {$orderDir} LIMIT  {$length} OFFSET {$start}");
        $stats = Database::select("SELECT COUNT(*) as recordsFiltered, (SELECT COUNT(*) FROM request_submission_full_papers WHERE request_submission_full_paper_active = 1) as recordsTotal FROM request_submission_full_papers WHERE request_submission_full_paper_active = 1 {$querySearch}");

        if ($select->status && $stats->status) {
            return new DataTablesOutput(true, Lang::get('request_submission_full_paper_datatable_success'), $select->data, $stats->data[0]['recordsTotal'], $stats->data[0]['recordsFiltered']);
        } else {
            return new DataTablesOutput(false, Lang::get('request_submission_full_paper_datatable_failure'));
        }
    }

    //endregion
}