<?php

require_once 'core/Lang.php';
require_once 'core/Output.php'; //todo
require_once 'core/DataTablesOutput.php'; //todo
require_once 'core/InputCheck.php'; //todo
require_once 'core/Input.php'; //todo
require_once 'core/EasyCode.php'; //todo

require_once 'object/UserObject.php';

$callResult = null;

if (isset($_POST["call_category"]) == false || isset($_POST["call_request"]) == false) {
    goto nothing;
}

$callCategory = $_POST["call_category"];
$callRequest = $_POST["call_request"];

if($callCategory == "user"){
    require_once 'object/UserObject.php';

    if($callRequest == "register"){
        $user = new UserObject();

        $callResult = $user->registerWithInput();
    }else if($callRequest == "login"){
        $user = new UserObject();

        $callResult = $user->loginWithInput();
    }else if($callRequest == "check-login"){
        $user = new UserObject();

        $callResult = new Output($user->isLogged());
    }
}else if($callCategory == "submission"){
    require_once 'object/SubmissionObject.php';

    if($callRequest == 'insert'){
        $submission = new SubmissionObject();

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

        $callResult = $announcement->insertWithInput();
    }else if($callRequest == 'update'){
        $announcement = new AnnouncementObject();

        $callResult = $announcement->updateWithInput();
    }else if($callRequest == 'delete'){
        $announcement = new AnnouncementObject();

        $callResult = $announcement->deleteWithInput();
    }else if($callRequest == 'select'){
        $announcement = new AnnouncementObject();

        $callResult = $announcement->selectWithInput();
    }else if($callRequest == 'data-tables'){
        $announcement = new AnnouncementObject();

        $callResult = $announcement->dataTablesWithInput();
    }
}else if($callCategory == 'user-announcement'){
    require_once 'object/UserAnnouncementObject.php';


    if($callRequest == 'insert'){
        $announcement = new UserAnnouncementObject();

        setPost('title', 'başlık');
        setPost('message', 'mesaj');
        setPost('user', '7');

        $callResult = $announcement->insertWithInput();
    }else if($callRequest == 'delete'){
        $announcement = new UserAnnouncementObject();

        setPost('user_announcement', '1');

        $callResult = $announcement->deleteWithInput();
    }else if($callRequest == 'select'){
        $announcement = new UserAnnouncementObject();

        $callResult = $announcement->selectWithInput();
    }
}else if($callCategory == 'user-announcement-message'){
    require_once 'object/UserAnnouncementMessageObject.php';


    if($callRequest == 'insert'){
        $announcement = new UserAnnouncementMessageObject();

        $callResult = $announcement->insertWithInput();
    }else if($callRequest == 'delete'){
        $announcement = new UserAnnouncementMessageObject();

        setPost('user_announcement_message', '1');

        $callResult = $announcement->deleteWithInput();
    }else if($callRequest == 'select'){
        $announcement = new UserAnnouncementMessageObject();

        $callResult = $announcement->selectWithInput();
    }
}

nothing:
if($callResult == null){
    $callResult = new Output(false, Lang::get("api_request_null"));
}

output:
echo json_encode($callResult, true);