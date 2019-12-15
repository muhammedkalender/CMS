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
    //region User

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
    }else if($callRequest == 'select'){
        $user = new UserObject();

        $callResult = $user->selectWithInput();
    }else if($callRequest == 'data-tables'){
        $user = new UserObject();

        $callResult = $user->dataTablesWithInput();
    }else if($callRequest == 'delete'){
        $user = new UserObject();

        $callResult = $user->deleteWithInput();
    }else if($callRequest == 'update-preferences'){
        $user = new UserObject();

        $callResult = $user->updatePreferencesWithInput();
    }else if($callRequest == 'profile'){
        $user = new UserObject();

        $callResult = $user->showWithInput();
    }

    //endregion
}else if($callCategory == "submission"){
    //region Submission

    require_once 'object/SubmissionObject.php';

    if($callRequest == 'insert'){
        $submission = new SubmissionObject();

        $callResult = $submission->insertWithInput();
    }else if($callRequest == 'show'){
        $submission = new SubmissionObject();

        $submission = $submission->loadObjectWithInput();

        $callResult = $submission;
    }else if($callRequest == 'data-tables'){
        $submission = new SubmissionObject();

        $callResult = $submission->dataTablesWithInput();
    }

    //endregion
}else if($callCategory == 'submission-comment'){
    //region Submission Comment

    require_once 'object/SubmissionCommentObject.php';

    if($callRequest == 'insert'){
        $submissionComment = new SubmissionCommentObject();

        $callResult = $submissionComment->insertWithInput();
    }else if($callRequest == 'set_completed'){
        $submissionComment = new SubmissionCommentObject();

        $callResult = $submissionComment->setCompletedWithInput();
    }else if($callRequest == 'set_pending'){
        $submissionComment = new SubmissionCommentObject();

        $callResult = $submissionComment->setPendingWithInput();
    }else if($callRequest == 'set_canceled'){
        $submissionComment = new SubmissionCommentObject();

        $callResult = $submissionComment->setCanceledWithInput();
    }else if($callRequest == 'delete'){
        $submissionComment = new SubmissionCommentObject();

        $callResult = $submissionComment->deleteWithInput();
    }else if($callRequest == 'data-tables'){
        $submissionComment = new SubmissionCommentObject();

        $callResult = $submissionComment->dataTablesWithInput();
    }

    //endregion
}else if($callCategory == 'announcement'){
    //region Announcement

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

    //endregion
}else if($callCategory == 'user-announcement'){
    //region User Announcement

    require_once 'object/UserAnnouncementObject.php';

    if($callRequest == 'insert'){
        $announcement = new UserAnnouncementObject();

        $callResult = $announcement->insertWithInput();
    }else if($callRequest == 'delete'){
        $announcement = new UserAnnouncementObject();

        $callResult = $announcement->deleteWithInput();
    }else if($callRequest == 'update'){
        $userAnnouncement = new UserAnnouncementObject();

        $callResult = $userAnnouncement->updateWithInput();
    }else if($callRequest == 'select'){
        $announcement = new UserAnnouncementObject();

        $callResult = $announcement->selectWithInput();
    }else if($callRequest == 'data-tables'){
        $userAnnouncement = new UserAnnouncementObject();

        $callResult = $userAnnouncement->dataTablesWithInput();
    }

    //endregion
}else if($callCategory == 'user-announcement-message'){
    //region User Announcement Message

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

    //endregion
}

nothing:
if($callResult == null){
    $callResult = new Output(false, Lang::get("api_request_null"));
}

output:
echo json_encode($callResult, true);