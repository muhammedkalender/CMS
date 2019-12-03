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
        //todo
        $submission = Database::first("SELECT * FROM submissions WHERE submission_id = {$submissionID}");

        if(!$submission->status){
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

    public
    function insertInputCheck()
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
                echo count($userArray);
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

        $message = Lang::get('submission_insert_success', $submissionID).'<br>';
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
            }else{
                $message .= Lang::get('users_insert_to_submission_success', post('email')) . '<br>';
            }
        }

        return new Output(true, $message, $submissionID);
    }
}