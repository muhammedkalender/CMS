<link rel="stylesheet" href="<?= folder() ?>plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title ?></h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><?= uiLang('submissions') ?></h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="submissions" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th><?= uiLang('id') ?></th>
                                        <th><?= uiLang('ec_id') ?></th>
                                        <th><?= uiLang('submit_date') ?></th>
                                        <th><?= uiLang('paper_title') ?></th>
                                        <th><?= uiLang('presentation_type') ?></th>
                                        <th><?= uiLang('abstract_paper') ?></th>
                                        <th><?= uiLang('full_paper') ?></th>
                                        <th><?= uiLang('authors') ?></th>
                                        <th class="no-sort"><?= uiLang('options') ?></th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card card-warning" id="divSubmissionComments" style="display: none;">
                        <div class="card-header">
                            <h3 class="card-title"><?= uiLang('submission_comments') ?></h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <button class="btn btn-success" onclick="showInsertTask()"><?= uiLang("insert_submission_comment") ?></button>
                            </div>
                            <div class="table-responsive">
                                <table id="submissionComments" class="table table-bordered table-hover">
                                    <thead>
                                    <th><?= uiLang('id') ?></th>
                                    <th><?= uiLang('submission') ?></th>
                                    <th><?= uiLang('message') ?></th>
                                    <th><?= uiLang('created_at') ?></th>
                                    <th><?= uiLang('created_by') ?></th>
                                    <th><?= uiLang('status') ?></th>
                                    <th class="no-sort"><?= uiLang('options') ?></th>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="modal-announcement">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal"><?= uiLang('close') ?></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-submission-comment">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal"><?= uiLang('close') ?></button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-submission-delete">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h4 class="modal-title">
                    <?= uiLang('delete_submissions') ?>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="/api.php" method="post" onsubmit="return checkForm(this)" id="form-submission-delete"
                      submit-datatable="submissions"
                      modal-loader="modal-submission-delete">
                    <input type="hidden" name="call_category" value="submission">
                    <input type="hidden" name="call_request" value="delete">

                    <div id="message"></div>

                    <input type="hidden" name="id">

                    <div class="form-group">
                        <p class="objectName"></p>
                        <p><?= uiLang('delete_are_you_sure') ?></p>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-warning"><?= uiLang('delete') ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-submission-comment-complete">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-success">
            <div class="modal-header">
                <h4 class="modal-title">
                    <?= uiLang('complete_task') ?>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="/api.php" method="post" onsubmit="return checkForm(this)"
                      id="form-submission-comment-complete"
                      submit-datatable="submissionComments"
                      modal-loader="modal-submission-comment-complete">
                    <input type="hidden" name="call_category" value="submission-comment">
                    <input type="hidden" name="call_request" value="set_completed">

                    <div id="message"></div>

                    <input type="hidden" name="id">

                    <div class="form-group">
                        <p class="objectName"></p>
                        <p><?= uiLang('set_complete_are_you_sure') ?></p>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-default"><?= uiLang('confirm') ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-submission-comment-canceled">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-warning">
            <div class="modal-header">
                <h4 class="modal-title">
                    <?= uiLang('canceled_task') ?>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="/api.php" method="post" onsubmit="return checkForm(this)"
                      id="form-submission-comment-canceled"
                      submit-datatable="submissionComments"
                      modal-loader="modal-submission-comment-canceled">
                    <input type="hidden" name="call_category" value="submission-comment">
                    <input type="hidden" name="call_request" value="set_canceled">

                    <div id="message"></div>

                    <input type="hidden" name="id">

                    <div class="form-group">
                        <p class="objectName"></p>
                        <p><?= uiLang('set_canceled_are_you_sure') ?></p>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-default"><?= uiLang('confirm') ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-submission-comment-pending">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-info">
            <div class="modal-header">
                <h4 class="modal-title">
                    <?= uiLang('pending_task') ?>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="/api.php" method="post" onsubmit="return checkForm(this)"
                      id="form-submission-comment-pending"
                      submit-datatable="submissionComments"
                      modal-loader="modal-submission-comment-pending">
                    <input type="hidden" name="call_category" value="submission-comment">
                    <input type="hidden" name="call_request" value="set_pending">

                    <div id="message"></div>

                    <input type="hidden" name="id">

                    <div class="form-group">
                        <p class="objectName"></p>
                        <p><?= uiLang('set_pending_are_you_sure') ?></p>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-default"><?= uiLang('confirm') ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-submission-comment-insert">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-success">
            <div class="modal-header">
                <h4 class="modal-title">
                    <?= uiLang('submission_comment_insert') ?>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="/api.php" method="post" onsubmit="return checkForm(this)"
                      id="form-submission-comment-insert"
                      submit-datatable="submissionComments"
                      modal-loader="modal-submission-comment-insert">
                    <input type="hidden" name="call_category" value="submission-comment">
                    <input type="hidden" name="call_request" value="insert">

                    <div id="message"></div>

                    <input type="hidden" name="id" const="true">

                    <div class="form-group">
                        <label><?=uiLang("message")?></label>
                        <textarea class="form-control" name="message" placeholder="<?=hintLang("message")?>" required></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-default"><?= uiLang('insert') ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?= folder() ?>plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= folder() ?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<script>
    const USER_ID = <?=$user->id?>;
    const USER_FULL_NAME = '<?=$user->getFullName()?>';

    var arrSubmissions = [];
    var arrSubmissionsComment = [];

    var currentSubmissionID = 0;
</script>

<script>
    $(function () {
        $('#submissions').DataTable({
            'processing': true,
            'serverSide': true,
            'ordering': true,
            'paging': true,
            'searching': true,
            'info': true,
            'lengthMenu': [[10, 25, 50, 100, 400], [10, 25, 50, 100, 400]],
            'serverMethod': 'post',
            'columns': [
                {'data': 'submission_id'},
                {'data': 'submission_ec_id'},
                {'data': 'submission_submit_date'},
                {'data': 'submission_paper_title'},
                {'data': 'submission_presentation_type'},
                {'data': 'submission_abstract_paper'},
                {'data': 'submission_full_paper'},
                {'data': 'submission_authors'},
                {'data': 'options', 'orderable': false}
            ],
            'ajax': {
                'url': 'api.php',
                'type': 'post',
                'dataType': 'json',
                'data': {
                    'call_category': 'submission',
                    'call_request': 'data-tables'
                },
                'dataSrc': function (json) {
                    console.log(json);
                    for (var i = 0; i < json.data.length; i++) {
                        json.data[i].options = '<div class="btn-group" role="group"><button id="btnGroupDropSubmission" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=uiLang("dropdown")?></button><div class="dropdown-menu" aria-labelledby="btnGroupDropSubmission">';

                        json.data[i].options = '<div class="btn-group" role="group"><button id="btnGroupDropSubmission" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=uiLang("dropdown")?></button><div class="dropdown-menu" aria-labelledby="btnGroupDropSubmission">';
                        json.data[i].options += '<a class="dropdown-item text-info" onclick="loadSubmissionComments(' + json.data[i].submission_id + ')" title="<?=uiLang("submission_message_view")?>"><span class="fas fa-list"></span> <?=uiLang("submission_message_view")?></a>';
                        json.data[i].options += '<a class="dropdown-item text-primary" target="_blank" href="' + internalURL('submission', 'show', 'submission', json.data[i].submission_id) + '" title="<?=uiLang("view")?>"><span class="fas fa-edit"></span> <?=uiLang("view")?></a>';
                        json.data[i].options += '<a class="dropdown-item text-danger" onclick="showDeleteSubmission(' + i + ')" title="<?=uiLang("delete")?>"><span class="fas fa-trash"></span> <?=uiLang("delete")?></a>';
                        json.data[i].options += '</div></div>';
                    }

                    arrSubmissions = json.data;

                    return json.data;
                }
            },
            'language': {
                'lengthMenu': '<?=uiLang("dt_length_menu")?>',
                'zeroRecords': '<?=uiLang("dt_zero_records")?>',
                'info': '<?=uiLang("dt_info")?>',
                'infoEmpty': '<?=uiLang("dt_info_empty")?>',
                'infoFiltered': '<?=uiLang("dt_info_filtered")?>',
                'search': '<?=uiLang("dt_search")?>',
                'paginate': {
                    'previous': '<?=uiLang("dt_previous")?>',
                    'next': '<?=uiLang("dt_next")?>',
                }
            }
        });
    });

    function loadSubmissionComments(submissionID) {
        $('#submissionComments').DataTable().destroy();
        $('#submissionComments').DataTable({
            'processing': true,
            'serverSide': true,
            'ordering': true,
            'paging': true,
            'searching': true,
            'info': true,
            'lengthMenu': [[10, 25, 50, 100, 400], [10, 25, 50, 100, 400]],
            'serverMethod': 'post',
            'columns': [
                {'data': 'submission_comment_id'},
                {'data': 'submission_comment_submission'},
                {'data': 'submission_comment_message'},
                {'data': 'submission_comment_created_at'},
                {'data': 'submission_comment_fullName'},
                {'data': 'submission_comment_status'},
                {'data': 'options', 'orderable': false}
            ],
            'ajax': {
                'url': 'api.php',
                'type': 'post',
                'dataType': 'json',
                'data': {
                    'call_category': 'submission-comment',
                    'call_request': 'data-tables',
                    'submission': submissionID
                },
                'dataSrc': function (json) {
                    for (var i = 0; i < json.data.length; i++) {
                        json.data[i].options = '<div class="btn-group" role="group"><button id="btnGroupDropSubmission" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=uiLang("dropdown")?></button><div class="dropdown-menu" aria-labelledby="btnGroupDropSubmission">';
                        json.data[i].options += '<a class="dropdown-item text-primary" onclick="showCommentSubmission(' + i +  ')" title="<?=uiLang("submission_message_view")?>"><span class="fas fa-list"></span> <?=uiLang("submission_message_view")?></a>';

                        //Status 0 => Beklemede, 1 => Tamamlandı, 2 => İptal Edildi

                        var drawComplete = false, drawCancel = false, drawPending = false;

                        switch (json.data[i].submission_comment_status) {
                            case '0':
                                drawComplete = true;
                                drawCancel = true;
                                break;
                            case '1':
                                drawPending = true;
                                break;
                            case '2':
                                drawPending = true;
                                break;
                        }

                        if (drawComplete) {
                            json.data[i].options += '<a class="dropdown-item text-success" onclick="showCompleteTask(' +  json.data[i].submission_comment_id + ')" title="<?=uiLang("complete_task")?>"><span class="fas fa-check"></span> <?=uiLang("complete_task")?></a>';
                        }

                        if (drawPending) {
                            json.data[i].options += '<a class="dropdown-item text-info" onclick="showPendingTask(' + json.data[i].submission_comment_id + ')" title="<?=uiLang("pending_task")?>"><span class="fas fa-reply"></span> <?=uiLang("pending_task")?></a>';
                        }

                        if (drawCancel) {
                            json.data[i].options += '<a class="dropdown-item text-danger" onclick="showCancelTask(' + json.data[i].submission_comment_id  + ')" title="<?=uiLang("cancel_task")?>"><span class="fas fa-times"></span> <?=uiLang("cancel_task")?></a>';
                        }

                        switch (json.data[i].submission_comment_status) {
                            case '0':
                                json.data[i].submission_comment_status = '<?= uiLang("status_pending")?>';
                                break;
                            case '1':
                                json.data[i].submission_comment_status = '<?= uiLang("status_completed")?>';
                                break;
                            case '2':
                                json.data[i].submission_comment_status = '<?= uiLang("status_canceled")?>';
                                break;
                        }

                        json.data[i].options += '</div></div>';
                    }

                    arrSubmissionsComment = json.data;

                    $('#divSubmissionComments').show();

                    window.location.href = '#divSubmissionComments';

                    currentSubmissionID = submissionID;

                    return json.data;
                }
            },
            'language': {
                'lengthMenu': '<?=uiLang("dt_length_menu")?>',
                'zeroRecords': '<?=uiLang("dt_zero_records")?>',
                'info': '<?=uiLang("dt_info")?>',
                'infoEmpty': '<?=uiLang("dt_info_empty")?>',
                'infoFiltered': '<?=uiLang("dt_info_filtered")?>',
                'search': '<?=uiLang("dt_search")?>',
                'paginate': {
                    'previous': '<?=uiLang("dt_previous")?>',
                    'next': '<?=uiLang("dt_next")?>',
                }
            }
        });
    }
</script>

<script>
    function showCommentSubmission(index) {
        $($('#modal-submission-comment').find('.modal-header')).html(arrSubmissionsComment[index].submission_comment_id);
        $($('#modal-submission-comment').find('.modal-body')).html('<p>' + arrSubmissionsComment[index].submission_comment_message + '</p>');

        $('#modal-submission-comment').modal('show');
    }

    function showDeleteSubmission(index) {
        loadInputsFromObject('form-submission-delete', arrSubmissions[index], 'submission_', 'id');

        $('#modal-submission-delete').modal('show');
    }

    function showCompleteTask(submissionCommentID) {
        loadInputsFromObject('form-submission-comment-complete', {submission_comment_id: submissionCommentID}, 'submission_comment_', 'message');

        $('#modal-submission-comment-complete').modal();
    }

    function showPendingTask(submissionCommentID) {
        loadInputsFromObject('form-submission-comment-pending', {submission_comment_id: submissionCommentID}, 'submission_comment_', 'message');

        $('#modal-submission-comment-pending').modal();
    }

    function showCancelTask(submissionCommentID) {
        loadInputsFromObject('form-submission-comment-canceled', {submission_comment_id: submissionCommentID}, 'submission_comment_', 'message');

        $('#modal-submission-comment-canceled').modal();
    }

    function showInsertTask(){
        clearForm($("#form-submission-comment-insert"));

        loadInputsFromObject('form-submission-comment-insert', {submission_id: currentSubmissionID}, 'submission_', 'id');

        $("#modal-submission-comment-insert").modal();
    }
</script>