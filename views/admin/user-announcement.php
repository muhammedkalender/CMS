<?php
require_once 'views/sidebar.php';
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Fixed Layout</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Layout</a></li>
                        <li class="breadcrumb-item active">Fixed Layout</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="from-group">
                <button class="btn btn-success" data-toggle="modal" data-target="#modal-user-announcement-insert"
                        onclick="clearForm($('#form-user-announcement-insert'))"><span
                            class="fas fa-plus"></span> <?= uiLang('add_new') ?>
                </button>
            </div>
            <br>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?= uiLang('user_announcements') ?></h3>
                        </div>
                        <div class="card-body">
                            <table id="user-announcements" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th><?= uiLang('id') ?></th>
                                    <th><?= uiLang('title') ?></th>
                                    <th><?= uiLang('public_date') ?></th>
                                    <th><?= uiLang('created_by') ?></th>
                                    <th><?= uiLang('user') ?></th>
                                    <th class="no-sort"><?= uiLang('options') ?></th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="modal-user-announcement">
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
<div class="modal fade" id="modal-user-announcement-insert">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h4 class="modal-title">
                    <?= uiLang('insert_user_announcements') ?>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="/api.php" method="post" onsubmit="return checkForm(this)"
                      id="form-user-announcement-insert"
                      submit-datatable="user-announcements"
                      modal-loader="modal-user-announcement-insert">
                    <input type="hidden" name="call_category" value="user-announcement">
                    <input type="hidden" name="call_request" value="insert">

                    <div id="message"></div>

                    <div class="form-group">
                        <label><?= inputLang('user') ?></label>
                        <select class="form-control userSelect" name="user" required></select>
                    </div>
                    <div class="form-group">
                        <label><?= inputLang('title') ?></label>
                        <input type="text" class="form-control" name="title" minlength="1" maxlength="256" required>
                    </div>
                    <div class="form-group">
                        <label><?= inputLang('message') ?></label>
                        <textarea type="text" class="form-control" name="message" minlength="1" maxlength="2048"
                                  required></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success"><?= uiLang('add') ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-user-announcement-update">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h4 class="modal-title">
                    <?= uiLang('update_user_announcements') ?>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="/api.php" method="post" onsubmit="return checkForm(this)"
                      id="form-user-announcement-update"
                      submit-datatable="user-announcements"
                      modal-loader="modal-user-announcement-update">
                    <input type="hidden" name="call_category" value="user-announcement">
                    <input type="hidden" name="call_request" value="update">

                    <div id="message"></div>

                    <input type="hidden" name="id">

                    <div class="form-group">
                        <label><?= inputLang('user') ?></label>
                        <select class="form-control userSelect" name="user" id="user-announcement-user" required>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><?= inputLang('title') ?></label>
                        <input type="text" class="form-control" name="title" minlength="1" maxlength="256" required>
                    </div>
                    <div class="form-group">
                        <label><?= inputLang('message') ?></label>
                        <textarea type="text" class="form-control" name="message" minlength="1" maxlength="2048"
                                  required></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success"><?= uiLang('update') ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-user-announcement-delete">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h4 class="modal-title">
                    <?= uiLang('delete_user_announcements') ?>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="/api.php" method="post" onsubmit="return checkForm(this)"
                      id="form-user-announcement-delete"
                      submit-datatable="user-announcements"
                      modal-loader="modal-user-announcement-delete">
                    <input type="hidden" name="call_category" value="user-announcement">
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
<div class="modal fade" id="modal-user-announcement-message">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <div class="card card-primary card-outline direct-chat direct-chat-primary">
                    <div class="card-body">
                        <div class="direct-chat-messages" id="direct-chat-messages">

                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <form action="#" onsubmit="sendUserAnnouncementMessage(); return false;" method="post">
                            <div class="input-group">
                                <input type="hidden" id="user-announcement-id">
                                <input type="text" name="message" id="user-announcement-message-message" placeholder="<?= hintLang('type_message') ?>"
                                       class="form-control" required>
                                <span class="input-group-append">
                      <button type="submit" class="btn btn-primary"><?= uiLang('send') ?></button>
                    </span>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-footer-->
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal"><?= uiLang('close') ?></button>
            </div>
        </div>
    </div>
</div>

<script src="<?= folder() ?>plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= folder() ?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<script>
    const USER_ID = <?=$user->id?>;
    const USER_FULL_NAME = '<?=$user->getFullName()?>';

    var arrUserAnnouncements = [];
</script>

<script>
    $(function () {
        $('#user-announcements').DataTable({
            'processing': true,
            'serverSide': true,
            'ordering': true,
            'paging': true,
            'searching': true,
            'info': true,
            'lengthMenu': [[10, 25, 50, 100, 400], [10, 25, 50, 100, 400]],
            'serverMethod': 'post',
            'columns': [
                {'data': 'user_announcement_id'},
                {'data': 'user_announcement_title'},
                {'data': 'user_announcement_created_at'},
                {'data': 'createdBy'},
                {'data': 'userFullName'},
                {'data': 'options', 'orderable': false}
            ],
            'ajax': {
                'url': 'api.php',
                'type': 'post',
                'dataType': 'json',
                'data': {
                    'call_category': 'user-announcement',
                    'call_request': 'data-tables'
                },
                'dataSrc': function (json) {
                    for (var i = 0; i < json.data.length; i++) {
                        json.data[i].user_announcement_created_at = formatDMYOnlyDate(json.data[i].user_announcement_created_at);
                        json.data[i].options = '<a class="btn btn-primary" onclick="showDetailUserAnnouncement(' + i + ')" title="<?=uiLang("user_announcement_view")?>"><span class="fas fa-eye"></span></a>'
                            + ' <a class="btn btn-warning" onclick="showUpdateUserAnnouncement(' + i + ')" title="<?=uiLang("user_announcement_update")?>"><span class="fas fa-edit"></span></a>'
                            + ' <a class="btn btn-success" onclick="showMessagesUserAnnouncement(' + json.data[i].user_announcement_id + ')" title="<?=uiLang("user_announcement_messages")?>"><span class="fas fa-envelope"></span></a>'
                            + ' <a class="btn btn-danger" onclick="showDeleteUserAnnouncement(' + i + ')" title="<?=uiLang("user_announcement_delete")?>"><span class="fas fa-trash"></span></a>'; //todo
                    }

                    arrUserAnnouncements = json.data;

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

        $.ajax({
            'url': 'api.php',
            'type': 'post',
            'dataType': 'json',
            'data': {
                'call_category': 'user',
                'call_request': 'select'
            },
            'success': function (response) {
                //todo

                if (response.status == false) {
                    //todo
                    return;
                }

                var html = '';

                for (var i = 0; i < response.data.length; i++) {
                    html += '<option value="' + response.data[i].user_id + '">' + response.data[i].user_first_name + ' ' + response.data[i].user_last_name + '( ' + response.data[i].user_ec_id + ' )</option>';
                }

                $('.userSelect').each(function (index) {
                    $(this).html(html);
                });
            },
            'error': function () {
                //error todo
            }
        });
    });
</script>

<script>
    function showDetailUserAnnouncement(index) {
        $($('#modal-user-announcement').find('.modal-header')).html(arrUserAnnouncements[index].user_announcement_title);
        $($('#modal-user-announcement').find('.modal-body')).html('<p>' + arrUserAnnouncements[index].user_announcement_message + '</p>');

        $('#modal-user-announcement').modal('show');
    }

    function showUpdateUserAnnouncement(index) {
        loadInputsFromObject('form-user-announcement-update', arrUserAnnouncements[index], 'user_announcement_');

        $('#modal-user-announcement-update').modal('show');
    }

    function showDeleteUserAnnouncement(index) {
        loadInputsFromObject('form-user-announcement-delete', arrUserAnnouncements[index], 'user_announcement_', 'title');

        $('#modal-user-announcement-delete').modal('show');
    }

    function showMessagesUserAnnouncement(user_announcement_id) {
        $('#modal-user-announcement-message').modal('show');

        showModalOverlay('modal-user-announcement-message');

        $.ajax({
            'url': 'api.php',
            'type': 'post',
            'dataType': 'json',
            'data': {
                'call_category': 'user-announcement-message',
                'call_request': 'select',
                'user-announcement': user_announcement_id
            },
            'success': function (response) {
                if (response.status == false) {
                    //todo
                    return;
                }

                var html = '';

                for (var i = response.data.length - 1; i >= 0; i--) {
                    html += '<div class="direct-chat-msg ' + (response.data[i].user_announcement_message_created_by == USER_ID ? '' : 'right') + '"><div class="direct-chat-infos clearfix text-dark"><span class="direct-chat-name float-'+ (response.data[i].user_announcement_message_created_by == USER_ID ? 'right' : 'left')+'">' + response.data[i].userFullName + '</span><span class="direct-chat-timestamp float-'+(response.data[i].user_announcement_message_created_by == USER_ID ? 'left' : 'right')+'">' + response.data[i].user_announcement_message_created_at + '</span></div><img class="direct-chat-img" src="../dist/img/user1-128x128.jpg"><div class="direct-chat-text">' + response.data[i].user_announcement_message_message + '</div></div>';
                }
console.log(html);
                $('#direct-chat-messages').html(html);

                $('#user-announcement-id').val(user_announcement_id);

                $('#direct-chat-messages').scrollTop(0);

                hideModalOverlay('modal-user-announcement-message');
            },
            'error': function () {
                //todo
                hideModalOverlay('modal-user-announcement-message');
            }
        });

        //todo
    }

    function sendUserAnnouncementMessage() {
        showModalOverlay('modal-user-announcement-message');

        $.ajax({
            'url': 'api.php',
            'type': 'post',
            'dataType': 'json',
            'data': {
                'call_category': 'user-announcement-message',
                'call_request': 'insert',
                'user-announcement': $('#user-announcement-id').val(),
                'message': $('#user-announcement-message-message').val()
            },
            'success': function (response) {
                //todo

                $('#user-announcement-message-message').val('');
                hideModalOverlay('modal-user-announcement-message');

                showMessagesUserAnnouncement($('#user-announcement-id').val());
            },
            'error': function () {
                //todo

                hideModalOverlay('modal-user-announcement-message');
            }
        });
    }
</script>