<?php

require_once 'object/UserObject.php';

class RequestSubmissionInvoiceObject
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

        $resultInsert = Database::insertReturnID("INSERT INTO request_submission_invoices (request_submission_invoice_submission, request_submission_invoice_url, request_submission_invoice_created_by) VALUES ('{$submissionID}', '{$URL}', {$user->id})");

        //todo niyeyse hata veriyor ?
        if ($resultInsert->status) {
            Log::insertWithKey('request_submission_invoice_insert', [160, $resultInsert->data]);

            return new Output(true, Lang::get('request_submission_invoice_insert_success'), $resultInsert->data);
        } else {
            return new Output(false, Lang::get('request_submission_invoice_insert_failure'));
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
            new Input("id", Input::METHOD_POST, "input_request_submission_invoice", Input::TYPE_INT, 1, 32)
        ]);
    }

    public function delete($requestSubmissionInvoiceID)
    {
        global $user;

        if (!$user->perm(UserObject::PERM_IS,UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $resultSelect = Database::first("SELECT * FROM request_submission_invoices WHERE request_submission_invoice_id = '{$requestSubmissionInvoiceID}'");

        if(!$resultSelect->status){
            return new Output(false, Lang::get('null_request_submission_invoice'));
        }

        $submissionID = $resultSelect->data["request_submission_invoice_submission"];

        $resultDelete = Database::exec("UPDATE request_submission_invoices SET request_submission_invoice_active = 0, request_submission_invoice_updated_by = '{$user->id}', request_submission_invoice_updated_at = '".getCustomDate()."' WHERE request_submission_invoice_id = '{$requestSubmissionInvoiceID}'");

        if ($resultDelete->status) {
            Log::insertWithKey('request_submission_invoice_delete', [161, $requestSubmissionInvoiceID]);
            Log::insertWithKey('submission_request_submission_invoice_delete', [802, $submissionID, $requestSubmissionInvoiceID]);

            return new Output(true, Lang::get('request_submission_invoice_delete_success'));
        } else {
            return new Output(false, Lang::get('request_submission_invoice_delete_failure'));
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
            new Input("id", Input::METHOD_POST, "input_request_submission_invoice", Input::TYPE_INT, 1, 32)
        ]);
    }

    public function confirm($requestSubmissionInvoiceID)
    {
        global $user;

        if (!$user->perm(UserObject::PERM_IS,UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $resultSelect = Database::first("SELECT * FROM request_submission_invoices WHERE request_submission_invoice_id = '{$requestSubmissionInvoiceID}'");

        if(!$resultSelect->status){
            return new Output(false, Lang::get('null_request_submission_invoice'));
        }

        $submissionID = $resultSelect->data["request_submission_invoice_submission"];

        $resultUpdate = Database::exec("UPDATE request_submission_invoices SET request_submission_invoice_status = 2, request_submission_invoice_updated_by = '{$user->id}', request_submission_invoice_updated_At = '".getCustomDate()."' WHERE request_submission_invoice_id = '{$requestSubmissionInvoiceID}'");
        $resultRelatedUpdate = Database::exec("UPDATE submissions SET submission_invoice = '".$resultSelect->data["request_submission_invoice_url"]."', request_submission_invoice_updated_by = '{$user->id}, request_submission_invoice_updated_At = '".getCustomDate()."' WHERE submission_id = '".$resultSelect->data["request_submission_invoice_submission"]."'");

        if ($resultRelatedUpdate->status) {
            Log::insertWithKey('request_submission_invoice_confirm', [162, $requestSubmissionInvoiceID]);
            Log::insertWithKey('submission_request_submission_invoice_confirm', [800, $submissionID, $requestSubmissionInvoiceID]);

            return new Output(true, Lang::get('request_submission_invoice_confirm_success'));
        } else {
            return new Output(false, Lang::get('request_submission_invoice_confirm_failure'));
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

        if (!$user->perm(UserObject::PERM_IS,UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $resultRelatedUpdate = Database::exec("UPDATE submissions SET submission_invoice = '-1', submission_updated_by = '{$user->id}', submission_updated_at = '".getCustomDate()."' WHERE submission_id = '{$submissionID}'");

        if ($resultRelatedUpdate->status) {
            Log::insertWithKey('request_submission_invoice_force_confirm', [165, $submissionID]);

            return new Output(true, Lang::get('request_submission_invoice_force_confirm_success'));
        } else {
            return new Output(false, Lang::get('request_submission_invoice_force_confirm_failure'));
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
            new Input("id", Input::METHOD_POST, "input_request_submission_invoice", Input::TYPE_INT, 1, 32)
        ]);
    }

    public function decline($requestSubmissionInvoiceID)
    {
        global $user;

        if (!$user->perm(UserObject::PERM_IS,UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $resultSelect = Database::first("SELECT * FROM request_submission_invoices WHERE request_submission_invoice_id = '{$requestSubmissionInvoiceID}'");

        if(!$resultSelect->status){
            return new Output(false, Lang::get('null_request_submission_invoice'));
        }

        $submissionID = $resultSelect->data["request_submission_invoice_submission"];

        $resultUpdate = Database::exec("UPDATE request_submission_invoices SET request_submission_invoice_status = 1, request_submission_invoice_updated_by = '{$user->id}', request_submission_invoice_updated_at = '".getCustomDate()."' WHERE request_submission_invoice_id = '{$requestSubmissionInvoiceID}'");

        if ($resultUpdate->status) {
            Log::insertWithKey('request_submission_invoice_decline', [163, $requestSubmissionInvoiceID]);
            Log::insertWithKey('submission_request_submission_invoice_decline', [801, $submissionID, $requestSubmissionInvoiceID]);


            return new Output(true, Lang::get('request_submission_invoice_decline_success'));
        } else {
            return new Output(false, Lang::get('request_submission_invoice_decline_failure'));
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
            'request_submission_invoice_id',
            'request_submission_invoice_submission',
            'request_submission_invoice_status',
            'request_submission_invoice_full_name',
            'request_submission_invoice_created_at'
        ];

        $querySearch = "";

        if ($keyword) {
            $querySearch = dataTablesLikeQuery(post('keyword'), [
                'request_submission_invoice_id',
                'request_submission_invoice_submission',
                'request_submission_invoice_status',
            ]);
        }

        $select = Database::select("SELECT request_submission_invoice_id, request_submission_invoice_submission, request_submission_invoice_status, request_submission_invoice_url, request_submission_invoice_created_by, request_submission_invoice_created_at, (SELECT CONCAT_WS(' ', user_first_name, user_last_name) FROM users WHERE user_id = request_submission_invoice_created_by) as request_submission_invoice_full_name FROM request_submission_invoices WHERE request_submission_invoice_active = 1 {$querySearch} ORDER BY {$columns[$orderColumn]} {$orderDir} LIMIT  {$length} OFFSET {$start}");
        $stats = Database::select("SELECT COUNT(*) as recordsFiltered, (SELECT COUNT(*) FROM request_submission_invoices WHERE request_submission_invoice_active = 1) as recordsTotal FROM request_submission_invoices WHERE request_submission_invoice_active = 1 {$querySearch}");

        if ($select->status && $stats->status) {
            return new DataTablesOutput(true, Lang::get('request_submission_invoices_datatable_success'), $select->data, $stats->data[0]['recordsTotal'], $stats->data[0]['recordsFiltered']);
        } else {
            return new DataTablesOutput(false, Lang::get('request_submission_invoices_datatable_failure'));
        }
    }

    //endregion
}