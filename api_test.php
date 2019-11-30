<?php

require_once 'lang/tr.php'; //todo
require_once 'core/Output.php'; //todo
require_once 'core/InputCheck.php'; //todo
require_once 'core/Input.php'; //todo
require_once 'core/EasyCode.php'; //todo

require_once 'object/UserObject.php';

$callResult = null;

$_POST['call_category'] = $_GET['c'];
$_POST['call_request'] = $_GET['r'];

if (isset($_POST["call_category"]) == false || isset($_POST["call_request"]) == false) {
    goto nothing;
}

$callCategory = $_POST["call_category"];
$callRequest = $_POST["call_request"];

if($callCategory == "user"){
    require_once 'object/UserObject.php';

    if($callRequest == "register"){
        $user = new UserObject();

        $_POST['email'] = "test@gmail.com";
        $_POST['name'] = "Test Name";
        $_POST['surname'] = "Surname";
        $_POST['country'] = "1";
        $_POST['submission'] = '1';
        $_POST['ec_id'] = '1';
        $_POST['web_site'] = '';

        $callResult = $user->registerWithInput();
    }else if($callRequest == "login"){
        $user = new UserObject();

        $_POST['email'] = 'test@gmail.com';
        $_POST['password'] = 'vePuXKUW7uGVoPV9';

        $callResult = $user->loginWithInput();
    }else if($callRequest == "check-login"){
        $user = new UserObject();

        $callResult = new Output($user->isLogged());
    }
}else if($callCategory == "submission"){
    require_once 'object/SubmissionObject.php';

    if($callRequest == 'insert'){
        $submission = new SubmissionObject();

        setPost('ec_id', 1);
        setPost('submit_date', '10:18:13 30-12-2019');
        setPost('paper_title', 'Test');
        setPost('presentation_type', 'Test_PT');
        setPost('type_of_contribution', 'NASIL KATKI?');
        setPost('users',
            [
                'Ali'.DEFAULT_HTML_SPLITTER.'Veli'.DEFAULT_HTML_SPLITTER.'13210aaa@gmail.com'.DEFAULT_HTML_SPLITTER.'1'.DEFAULT_HTML_SPLITTER.'TEST ORGz'.DEFAULT_HTML_SPLITTER.'http://www.google.com'.DEFAULT_HTML_SPLITTER.''.DEFAULT_HTML_SPLITTER.'a1',
                'Ali'.DEFAULT_HTML_SPLITTER.'Veli'.DEFAULT_HTML_SPLITTER.'1133aaa@gmail.com'.DEFAULT_HTML_SPLITTER.'1'.DEFAULT_HTML_SPLITTER.'TEST ORGz'.DEFAULT_HTML_SPLITTER.'http://www.google.com'.DEFAULT_HTML_SPLITTER.''.DEFAULT_HTML_SPLITTER.'a1'
            ]
        );


        $callResult = $submission->insertWithInput();
    }else if($callRequest == 'shown'){
        setPost('submission', 20);
        setPost('submission', 50);
        $submission = new SubmissionObject();

        $submission = $submission->loadObject($_POST['submission']);

        $callResult = $submission;
    }
}else if($callCategory == 'submission_comment'){
    require_once 'object/SubmissionCommentObject.php';

    if($callRequest == 'insert'){
        $submissionComment = new SubmissionCommentObject();

        setPost('message', 'TEST MESAJ"');
        setPost('submission_id', '1');

        $callResult = $submissionComment->insertWithInput();
    }else if($callRequest == 'set_completed'){
        $submissionComment = new SubmissionCommentObject();

        setPost('comment_id', '1');

        $callResult = $submissionComment->setCompletedWithInput();
    }else if($callRequest == 'set_pending'){
        $submissionComment = new SubmissionCommentObject();

        setPost('comment_id', '1');

        $callResult = $submissionComment->setPendingWithInput();
    }else if($callRequest == 'set_canceled'){
        $submissionComment = new SubmissionCommentObject();

        setPost('comment_id', '1');

        $callResult = $submissionComment->setCanceledWithInput();
    }else if($callRequest == 'delete'){
        $submissionComment = new SubmissionCommentObject();

        setPost('comment_id', '1');

        $callResult = $submissionComment->deleteWithInput();
    }
}else if($callCategory == 'announcement'){
    require_once 'object/AnnouncementObject.php';


    if($callRequest == 'insert'){
        $announcement = new AnnouncementObject();

        setPost('title', 'başlık');
        setPost('message', 'mesaj');
        setPost('language_code', '1'); //globe

        $callResult = $announcement->insertWithInput();
    }else if($callRequest == 'delete'){
        $announcement = new AnnouncementObject();

        setPost('announcement', '1');

        $callResult = $announcement->deleteWithInput();
    }else if($callRequest == 'select'){
        $announcement = new AnnouncementObject();

        setPost('language', '2');

        $callResult = $announcement->selectWithInput();
    }
}

nothing:
if($callResult == null){
    $callResult = new Output(false, Lang::get("api_request_null"));
}

output:
echo json_encode($callResult, true);