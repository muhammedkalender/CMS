<?php

require_once 'core/Lang.php';
require_once 'core/Output.php'; //todo
require_once 'core/DataTablesOutput.php'; //todo
require_once 'core/InputCheck.php'; //todo
require_once 'core/Input.php'; //todo
require_once 'core/EasyCode.php'; //todo

require_once 'object/UserObject.php';

$callResult = null;

if (isset($_POST["call_category"]) && isset($_POST["call_request"])) {
    $callCategory = $_POST["call_category"];
    $callRequest = $_POST["call_request"];
}else if (isset($_GET["call_category"]) && isset($_GET["call_request"])) {
    $callCategory = $_GET["call_category"];
    $callRequest = $_GET["call_request"];
}else{
    goto nothing;
}

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
    }else if($callRequest == 'forgot-password'){
        $user = new UserObject();

        $callResult = $user->forgotPasswordWithInput();
    }else if($callRequest == 'update-password'){
        $user = new UserObject();

        $callResult = $user->changePasswordWithInput();
    }else if($callRequest == 'authors'){
        $user = new UserObject();

        $callResult = $user->selectAuthorsWithInput();
    }else if($callRequest == 'update-info'){
        $user = new UserObject();

        $callResult = $user->updateInfoWithInput();
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
    }else if($callRequest == "delete"){
        $submission = new SubmissionObject();

        $callResult = $submission->deleteWithInput();
    }else if($callRequest == "logs"){
        $submission = new SubmissionObject();

        $callResult = $submission->dataTablesLogWithInput();
    }else if($callRequest == "list"){
        $submission = new SubmissionObject();

        $callResult = $submission->list();
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
    }else if($callRequest == 'users-data-tables'){
        $userAnnouncement = new UserAnnouncementObject();

        $callResult = $userAnnouncement->usersDataTablesWithInput();
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
}else if($callCategory == 'request-submission-invoice'){
    //region Request Submission Invoice

    require_once 'object/RequestSubmissionInvoiceObject.php';

    if($callRequest == 'insert'){
        $requestSubmissionInvoice = new RequestSubmissionInvoiceObject();

        $callResult = $requestSubmissionInvoice->insertWithInput();
    }else if($callRequest == 'delete'){
        $requestSubmissionInvoice = new RequestSubmissionInvoiceObject();

        $callResult = $requestSubmissionInvoice->deleteWithInput();
    }else if($callRequest == 'confirm'){
        $requestSubmissionInvoice = new RequestSubmissionInvoiceObject();

        $callResult = $requestSubmissionInvoice->confirmWithInput();
    }else if($callRequest == 'decline'){
        $requestSubmissionInvoice = new RequestSubmissionInvoiceObject();

        $callResult = $requestSubmissionInvoice->declineWithInput();
    }else if($callRequest == 'force-confirm'){
        $requestSubmissionInvoice = new RequestSubmissionInvoiceObject();

        $callResult = $requestSubmissionInvoice->forceConfirmWithInput();
    }else if('data-tables'){
        $requestSubmissionInvoice = new RequestSubmissionInvoiceObject();

        $callResult = $requestSubmissionInvoice->dataTablesWithInput();
    }

    //endregion
}else if($callCategory == 'request-submission-full-paper'){
    //region Request Submission Full Paper

    require_once 'object/RequestSubmissionFullPaperObject.php';

    if($callRequest == 'insert'){
        $requestSubmissionFullPaper = new RequestSubmissionFullPaperObject();

        $callResult = $requestSubmissionFullPaper->insertWithInput();
    }else if($callRequest == 'delete'){
        $requestSubmissionFullPaper = new RequestSubmissionFullPaperObject();

        $callResult = $requestSubmissionFullPaper->deleteWithInput();
    }else if($callRequest == 'confirm'){
        $requestSubmissionFullPaper = new RequestSubmissionFullPaperObject();

        $callResult = $requestSubmissionFullPaper->confirmWithInput();
    }else if($callRequest == 'decline'){
        $requestSubmissionFullPaper = new RequestSubmissionFullPaperObject();

        $callResult = $requestSubmissionFullPaper->declineWithInput();
    }else if($callRequest == 'force-confirm'){
        $requestSubmissionFullPaper = new RequestSubmissionFullPaperObject();

        $callResult = $requestSubmissionFullPaper->forceConfirmWithInput();
    }else if('data-tables'){
        $requestSubmissionFullPaper = new RequestSubmissionFullPaperObject();

        $callResult = $requestSubmissionFullPaper->dataTablesWithInput();
    }

    //endregion
}else if($callCategory == 'filter'){
    //region Submission

    require_once 'object/FilterObject.php';

    if($callRequest == 'submission'){
        $submission = new FilterObject();

        $callResult = $submission->submissionDataTablesWithInput();
    }

    //endregion
}else if($callCategory == 'upload-file'){
    //region Upload File

    require_once "controllers/FileController.php";

    if($callRequest == 'document'){
        $fileController = new FileController();

        $callResult = $fileController->uploadDocument();
    }

    //endregion
}

nothing:
if($callResult == null){
    $callResult = new Output(false, Lang::get("api_request_null"));
}

output:
echo json_encode($callResult, true);