<?php

require_once 'core/Database.php';

class SubmissionObject
{
    public $submissionID, $ecID, $submitDate;

    public $paperTitle, $presentationType, $keywords, $ecKeyphrases, $topics, $typeOfContribution;

    //Invoice URL, Fullpaper URL
    public $invoice, $abstractPaper, $fullPaper, $amount;

    public $createdAt, $updatedAt;

    public function __construct($submissionID = 0)
    {
        if ($submissionID != 0) {
            $this->loadObject($submissionID);
        }
    }

    public function loadObject($submissionID)
    {
        global $user;

        if (!$user->perm(UserObject::AUTHOR_OR_ADMIN, $submissionID)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $submission = Database::first("SELECT *, 
(SELECT COUNT(*) FROM request_submission_full_papers WHERE request_submission_full_paper_submission = {$submissionID} AND request_submission_full_paper_active = 1 AND request_submission_full_paper_status = 'Pending') as fullPaperPendingCount,
(SELECT COUNT(*) FROM request_submission_full_papers WHERE request_submission_full_paper_submission = {$submissionID} AND request_submission_full_paper_active = 1 AND request_submission_full_paper_status = 'Declined') as fullPaperDeclinedCount,
(SELECT COUNT(*) FROM request_submission_invoices WHERE request_submission_invoice_submission = {$submissionID} AND request_submission_invoice_active = 1 AND request_submission_invoice_status = 'Pending') as invoicePendingCount,
(SELECT COUNT(*) FROM request_submission_invoices WHERE request_submission_invoice_submission = {$submissionID} AND request_submission_invoice_active = 1 AND request_submission_invoice_status = 'Declined') as invoiceDeclinedCount 
FROM submissions WHERE submission_id = {$submissionID}");

        if (!$submission->status) {
            return new Output(false, Lang::get('submission_null'));
        }

        $submission = $submission->data;

        if(empty($submission["submission_full_paper"])){
            if($submission["fullPaperPendingCount"] > 0){
                $submission["submission_full_paper"] = 1;
            }else if($submission["fullPaperDeclinedCount"] > 0){
                $submission["submission_full_paper"] = 3;
            }
        }

        if(empty($submission["submission_invoice"])){
            if($submission["invoicePendingCount"] > 0){
                $submission["submission_invoice"] = 1;
            }else if($submission["invoiceDeclinedCount"] > 0){
                $submission["submission_invoice"] = 3;
            }
        }

        return new Output(true, '', $submission);
    }

    public function insertWithInput()
    {
        $inputCheck = $this->insertInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->insert(
            post('ec_id'),
            post('submit_date'),
            post('paper_title'),
            post('presentation_type'),
            post('keywords'),
            post('ec_keyprases'),
            post('topics'),
            post('type_of_contribution'),
            post('abstract_paper'),
            post('full_paper'),
            post('users')
        );
    }

    public function loadObjectWithInput()
    {
        $inputCheck = $this->loadObjectInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->loadObject(
            post('id')
        );
    }

    public function loadObjectInputCheck()
    {
        return InputCheck::checkAll([
            new Input('id', Input::METHOD_POST, 'input_submission', Input::TYPE_INT, 1, 8),
        ]);
    }


    public function insertInputCheck()
    {
        $firstStep = InputCheck::checkAll([
            new Input("ec_id", Input::METHOD_POST, "input_ec_id", Input::TYPE_INT, 1, 64),
            new Input('submit_date', Input::METHOD_POST, 'input_submit_date', Input::TYPE_DATE, 1, 32),
            new Input('paper_title', Input::METHOD_POST, 'input_paper_title', Input::TYPE_TEXT, 3, 256),
            new Input('presentation_type', Input::METHOD_POST, 'input_presentation_type', Input::TYPE_STRING, 1, 32),
            new Input('keywords', Input::METHOD_POST, 'input_keywords', Input::TYPE_STRING, 0, 256),
            new Input('ec_keyprases', Input::METHOD_POST, 'input_ec_keyprases', Input::TYPE_STRING, 0, 256),
            new Input('topics', Input::METHOD_POST, 'input_topics', Input::TYPE_STRING, 0, 256),
            new Input('type_of_contribution', Input::METHOD_POST, 'input_type_of_contribution', Input::TYPE_STRING, 1, 128),
            new Input('abstract_paper', Input::METHOD_POST, 'input_abstract_paper', Input::TYPE_STRING, 0, 1024),
            new Input('full_paper', Input::METHOD_POST, 'input_full_paper', Input::TYPE_STRING, 0, 128),
            new Input('users', Input::METHOD_POST, 'input_users', Input::TYPE_ARRAY, 1, 128),
        ]);

        if (!$firstStep->status) {
            return $firstStep;
        }

        require_once 'object/UserObject.php';

        $secondStep = true;

        foreach ($_POST['users'] as $postUser) {
            /*
         * 0 => FN
         * 1 => LN
         * 2 => EMAIL
         * 3 => COUNTRY
         * 4 => ORGANIZATION
         * 5 => WEB_PAGE
         * 6 => IS_CORRRESPONDING
             * 7 => IS_JOINED
         */

            $userArray = explode(DEFAULT_HTML_SPLITTER, $postUser);

            if (count($userArray) != 8) {
                $secondStep = new Output(false, Lang::get('users_input_wrong'));
                break;
            }

            $user = new UserObject();

            $user->loadPostData($userArray, 'SUBMISSION_TEST');

            $checkResult = $user->registerWithInput(true);

            if (!$checkResult->status) {
                return $checkResult;
            }
        }

        return new Output($secondStep);

    }

    public
    function insert($ecID, $submitDate, $paperTitle, $presentationType, $keywords, $ecKeyprases, $topics, $typeOfContribution, $abstractPaper, $fullPaper)
    {
        $message = '';

        $submissionID = Database::insertReturnID("INSERT INTO submissions (submission_ec_id, submission_submit_date, submission_paper_title, submission_presentation_type, submission_keywords, submission_ec_keyprases, submission_topics, submission_type_of_contribution, submission_abstract_paper, submission_full_paper) VALUES  
({$ecID}, '{$submitDate}', '{$paperTitle}', '{$presentationType}', '{$keywords}', '{$ecKeyprases}', '{$topics}', '{$typeOfContribution}', '{$abstractPaper}', '{$fullPaper}')");

        if (!$submissionID->status) {
            return new Output(false, Lang::get('submission_insert_failure'));
        }

        $submissionID = $submissionID->data;

        Log::insert('log_submission_insert', 60, $submissionID);

        $message = Lang::get('submission_insert_success', $submissionID) . '<br>';
        $index = 0;

        foreach ($_POST['users'] as $postUser) {
            $index++;

            $userArray = explode(DEFAULT_HTML_SPLITTER, $postUser);

            if (count($userArray) != 8) {
                $message .= Lang::get('users_insert_to_submission_failure', $index) . '<br>';
                continue;
            }

            $user = new UserObject();

            $user->loadPostData($userArray, 'SUBMISSION_TEST', $submissionID);

            $checkResult = $user->registerWithInput();

            if (!$checkResult->status) {
                $message .= Lang::get('users_insert_to_submission_failure', $index) . '<br>';
            } else {
                $message .= Lang::get('users_insert_to_submission_success', post('email')) . '<br>';
            }
        }

        return new Output(true, $message, $submissionID);
    }

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
            'submission_id',
            'submission_ec_id',
            'submission_submit_date',
            'submission_paper_title',
            'submission_presentation_type',
            'submission_invoice',
            'submission_abstract_paper',
            'submission_full_paper',
            'submission_authors'
        ];

        $querySearch = "";

        if (post('keyword')) {
            $querySearch = dataTablesLikeQuery(post('keyword'), [
                'submission_id',
                'submission_ec_id',
                'submission_submit_date',
                'submission_paper_title',
                'submission_presentation_type',
                'submission_authors'
            ]);
        }
//SELECT GROUP_CONCAT(user_first_name SEPARATOR ', ') FROM users WHERE user_active = 1 AND user_submission = submission_id todo
        $select = Database::select("SELECT submission_id, submission_ec_id, submission_submit_date, submission_paper_title, submission_presentation_type, submission_invoice, submission_abstract_paper, submission_full_paper, (SELECT GROUP_CONCAT(CONCAT_WS(' ', user_first_name, user_last_name) SEPARATOR ', ') FROM users WHERE user_active = 1 AND user_submission = submission_id) as submission_authors FROM submissions WHERE submission_active = 1 {$querySearch} ORDER BY {$columns[$orderColumn]} {$orderDir} LIMIT  {$length} OFFSET {$start}");
        $stats = Database::select("SELECT COUNT(*) as recordsFiltered, (SELECT COUNT(*) FROM submissions WHERE submission_active = 1) as recordsTotal FROM submissions WHERE submission_active = 1 {$querySearch}");

        if ($select->status && $stats->status) {
            return new DataTablesOutput(true, Lang::get('announcement_select_success'), $select->data, $stats->data[0]['recordsTotal'], $stats->data[0]['recordsFiltered']);
        } else {
            return new DataTablesOutput(false, Lang::get('announcement_select_failure'));
        }

    }

    //endregion

    //region Show

    public function showWithInput()
    {
        $inputCheck = $this->showInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->show(
            post('id')
        );
    }

    public function showInputCheck()
    {
        return InputCheck::checkAll([
            new Input('id', Input::METHOD_POST, 'input_submission', Input::TYPE_INT, 1, 8),
        ]);
    }

    public function show($submissionID)
    {
        global $user;

        if (!$user->perm(UserObject::AUTHOR_OR_ADMIN, $submissionID)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $submission = Database::first("SELECT * FROM submissions WHERE submission_id = {$submissionID}");

        if (!$submission->status) {
            return new Output(false, Lang::get('submission_null'));
        }

        $submission = $submission->data;

        $this->submissionID = $submissionID;
        $this->ecID = $submission['submission_ec_id'];
        $this->submitDate = $submission['submission_submit_date'];
        $this->paperTitle = $submission['submission_paper_title'];
        $this->presentationType = $submission['submission_presentation_type'];
        $this->keywords = $submission['submission_keywords'];
        $this->ecKeyphrases = $submission['submission_ec_keyprases'];
        $this->topics = $submission['submission_topics'];
        $this->typeOfContribution = $submission['submission_type_of_contribution'];
        $this->invoice = $submission['submission_invoice'];
        $this->abstractPaper = $submission['submission_abstract_paper'];
        $this->fullPaper = $submission['submission_full_paper'];
        $this->amount = $submission['submission_amount'];

        return new Output(true, '', $this);
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
            new Input('id', Input::METHOD_POST, 'input_submission', Input::TYPE_INT, 1, 8),
        ]);
    }

    public function delete($submissionID)
    {
        global $user;

        if (!$user->perm(UserObject::PERM_IS, UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $select = Database::exec("UPDATE submissions SET submission_active = 0, submission_updated_at = '".getCustomDate()."', submission_updated_by = ".$user->id." WHERE submission_id = {$submissionID}");

        if ($select->status) {
            Log::insert('submission_delete_success', 700, $submissionID);

            return new Output(true, Lang::get('submission_delete_success'));
        } else {
            return new Output(false, Lang::get('submission_delete_failure'));
        }
    }

    //endregion

    //region Data Tables Log

    public function dataTablesLogWithInput()
    {
        $inputCheck = $this->dataTablesLogInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->dataTablesLog(
            post('id'),
            post('start'),
            post('length'),
            post('keyword'),
            post('orderColumn'),
            post('orderDir')
        );
    }

    public function dataTablesLogInputCheck()
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
            new Input('id', Input::METHOD_POST, 'input_submission', Input::TYPE_INT, 1, 8),
            new Input('start', Input::METHOD_POST, 'input_start', Input::TYPE_INT, 1, 8),
            new Input('length', Input::METHOD_POST, 'input_length', Input::TYPE_INT, 1, 8),
            new Input('keyword', Input::METHOD_POST, 'input_keyword', Input::TYPE_TEXT, 0, 64),
            new Input('orderColumn', Input::METHOD_POST, 'input_order_column', Input::TYPE_INT, 1, 8),
            new Input('orderDir', Input::METHOD_POST, 'input_order_dir', Input::TYPE_TEXT, 3, 4),
        ]);
    }

    public function dataTablesLog($submissionID, $start, $length, $keyword, $orderColumn, $orderDir)
    {
        global $user;

        if (!$user->perm(UserObject::AUTHOR_OR_ADMIN, $submissionID)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $columns = [
            'log_id',
            'log_text',
            'ownerFullName',
            'log_created_at',
        ];

        $querySearch = "";

        if (post('keyword')) {
            $querySearch = dataTablesLikeQuery(post('keyword'), [
                'log_id',
                'log_text',
                'log_created_at'
            ]);
        }

        $logIDs = [
            60, 70, 71,
            120, 121, 122, 123, 124,
            160, 161, 162, 163,
            165,
            180,181,182,183,185,
            700,
            800,801,802,
            812,813
        ];

        $logIDs = implode(",", $logIDs);

        $select = Database::select("SELECT log_id, log_text, log_created_at, (SELECT CONCAT_WS(' ', user_first_name, user_last_name) FROM users WHERE user_id = log_created_by) as ownerFullName, log_first_param, log_second_param, log_third_param, log_param_text_first, log_param_text_second, log_param_text_third, log_param_text_fourt FROM logs WHERE log_active = 1 AND log_first_param IN ({$logIDs}) AND log_second_param = {$submissionID} {$querySearch} ORDER BY {$columns[$orderColumn]} {$orderDir} LIMIT  {$length} OFFSET {$start}");
        $stats = Database::select("SELECT COUNT(*) as recordsFiltered, (SELECT COUNT(*) FROM logs WHERE log_active = 1 AND log_first_param IN ({$logIDs}) AND log_second_param = {$submissionID}) as recordsTotal FROM logs WHERE log_active = 1 AND log_first_param IN ({$logIDs}) AND log_second_param = {$submissionID} {$querySearch}");

        if ($select->status && $stats->status) {
            $countData = count($select->data);
            for ($i = 0; $i < $countData; $i++){
                $select->data[$i]["log_text"] = Lang::get($select->data[$i]["log_text"], $select->data[$i]["log_param_text_first"], $select->data[$i]["log_param_text_second"], $select->data[$i]["log_param_text_third"], $select->data[$i]["log_param_text_fourt"]);
            }

            return new DataTablesOutput(true, Lang::get('submission_log_select_success'), $select->data, $stats->data[0]['recordsTotal'], $stats->data[0]['recordsFiltered']);
        } else {
            return new DataTablesOutput(false, Lang::get('submission_log_select_failure'));
        }

    }

    //endregion

    public function list(){
        global $user;

        if (!$user->perm(UserObject::PERM_IS, UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $submissions = Database::select("SELECT submission_id, submission_paper_title FROM submissions WHERE submission_active = 1");

        if($submissions->status){
            return new Output(true, Lang::get("submission_list_success"), $submissions->data);
        }else{
            return Output::returnWithErrorMessage(Lang::get("submission_list_failure"));
        }
    }
}