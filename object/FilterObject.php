<?php


class FilterObject
{
    //region Submission Data Tables

    public function submissionDataTablesWithInput()
    {
        $inputCheck = $this->submissionDataTablesInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->submissionDataTables(
            post('full_paper'),
            post('invoice'),
            post('start'),
            post('length'),
            post('keyword'),
            post('orderColumn'),
            post('orderDir')
        );
    }

    public function submissionDataTablesInputCheck()
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
            new Input('full_paper', Input::METHOD_POST, 'input_status_full_paper', Input::TYPE_INT, 1, 2),
            new Input('invoice', Input::METHOD_POST, 'input_status_invoice', Input::TYPE_INT, 1, 2),
            new Input('start', Input::METHOD_POST, 'input_start', Input::TYPE_INT, 1, 8),
            new Input('length', Input::METHOD_POST, 'input_length', Input::TYPE_INT, 1, 8),
            new Input('keyword', Input::METHOD_POST, 'input_keyword', Input::TYPE_TEXT, 0, 64),
            new Input('orderColumn', Input::METHOD_POST, 'input_order_column', Input::TYPE_INT, 1, 8),
            new Input('orderDir', Input::METHOD_POST, 'input_order_dir', Input::TYPE_TEXT, 3, 4),
        ]);
    }

    public function submissionDataTables($statusFullPaper, $statusInvoice, $start, $length, $keyword, $orderColumn, $orderDir)
    {
        global $user;

        if (!$user->perm(UserObject::PERM_IS, UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $columns = [
            'submission_id',
            'submission_ec_id',
            'submission_submit_date',
            'submission_paper_title',
            'submission_presentation_type',
            'submission_invoice',
            'submission_abstract_paper',
            'submission_full_paper',
            'submission_invoice',
            'submission_authors'
        ];

        $querySearch = "";

        if (post('keyword')) {
            $querySearch = dataTablesLikeQuery(post('keyword'), [
                'submission_id',
                'submission_ec_id',
                'submission_submit_date',
                'submission_paper_title',
                'submission_presentation_type'
            ]);
        }

        $queryFilter = "";

        if($statusFullPaper != -1){
            if($statusFullPaper == 3){
                $queryFilter = " AND (SELECT COUNT(*) FROM request_submission_full_papers WHERE request_submission_full_paper_active = 1 AND request_submission_full_paper_submission = submission_id) = 0";
            }else{
                $queryFilter = " AND (SELECT COUNT(*) FROM request_submission_full_papers WHERE request_submission_full_paper_active = 1 AND request_submission_full_paper_submission = submission_id AND request_submission_full_paper_status = {$statusFullPaper}) > 0";
            }
        }

        if($statusInvoice != -1){
            if($statusInvoice == 3){
                $queryFilter .= " AND (SELECT COUNT(*) FROM request_submission_invoices WHERE request_submission_invoice_active = 1 AND request_submission_invoice_submission = submission_id) = 0";
            }else{
                $queryFilter .=" AND (SELECT COUNT(*) FROM request_submission_invoices WHERE request_submission_invoice_active = 1 AND request_submission_invoice_submission = submission_id AND request_submission_invoice_status = {$statusInvoice}) > 0";
            }
        }

        $select = Database::select("SELECT submission_id, submission_ec_id, submission_submit_date, submission_paper_title, submission_presentation_type, submission_invoice, submission_invoice, submission_abstract_paper, submission_full_paper, (SELECT GROUP_CONCAT(CONCAT_WS(' ', user_first_name, user_last_name) SEPARATOR ', ') FROM users WHERE user_active = 1 AND user_submission = submission_id) as submission_authors FROM submissions WHERE submission_active = 1 {$querySearch} {$queryFilter} ORDER BY {$columns[$orderColumn]} {$orderDir} LIMIT  {$length} OFFSET {$start}");
        $stats = Database::select("SELECT COUNT(*) as recordsFiltered, (SELECT COUNT(*) FROM submissions WHERE submission_active = 1) as recordsTotal FROM submissions WHERE submission_active = 1 {$querySearch} {$queryFilter}");

        if ($select->status && $stats->status) {
            return new DataTablesOutput(true, Lang::get('submission_filter_select_success'), $select->data, $stats->data[0]['recordsTotal'], $stats->data[0]['recordsFiltered']);
        } else {
            return new DataTablesOutput(false, Lang::get('submission_filter_select_failure'));
        }

    }

    //endregion
}