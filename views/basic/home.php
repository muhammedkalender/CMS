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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?= uiLang('announcements') ?></h3>
                        </div>
                        <div class="card-body">
                            <table id="announcements" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th><?= uiLang('title') ?></th>
                                    <th><?= uiLang('public_date') ?></th>
                                    <th class="no-sort"><?= uiLang('options') ?></th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

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
                                    <th><?= uiLang('title') ?></th>
                                    <th><?= uiLang('public_date') ?></th>
                                    <th><?= uiLang('unread_messages') ?></th>
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

    var arrAnnouncements = [];
    var arrUserAnnouncements = [];
</script>

<script>
    $(function () {
        $('#announcements').DataTable({
            'processing': true,
            'serverSide': true,
            'ordering': false,
            'paging': false,
            'searching': false,
            "info": false,
            'serverMethod': 'post',
            'columns': [
                {'data': 'announcement_title'},
                {'data': 'announcement_created_at'},
                {'data': 'options'}
            ],
            'ajax': {
                'url': 'api.php',
                'type': 'post',
                'dataType': 'json',
                'data': {
                    'call_category': 'announcement',
                    'call_request': 'select',
                    'language': '<?= Lang::get('lang_code') ?>',
                },
                'dataSrc': function (json) {
                    for (var i = 0; i < json.data.length; i++) {
                        json.data[i].announcement_created_at = formatDMYOnlyDate(json.data[i].announcement_created_at);
                        json.data[i].options = '<a class="btn btn-primary" onclick="showDetailAnnouncement(' + i + ')"><span class="fas fa-eye"></span></a>'; //todo
                    }

                    arrAnnouncements = json.data;

                    return json.data;
                }
            }
        });

        $('#user-announcements').DataTable({
            'processing': true,
            'serverSide': true,
            'ordering': false,
            'paging': false,
            'searching': false,
            "info": false,
            'serverMethod': 'post',
            'columns': [
                {'data': 'user_announcement_title'},
                {'data': 'user_announcement_created_at'},
                {'data': 'unread_message_count'},
                {'data': 'options'}
            ],
            'ajax': {
                'url': 'api.php',
                'type': 'post',
                'dataType': 'json',
                'data': {
                    'call_category': 'user-announcement',
                    'call_request': 'select',
                    'language': '<?= Lang::get('lang_code') ?>',
                    'user': '<?=$user->id?>'
                },
                'dataSrc': function (json) {
                    for (var i = 0; i < json.data.length; i++) {
                        json.data[i].user_announcement_created_at = formatDMYOnlyDate(json.data[i].user_announcement_created_at);
                        json.data[i].unread_message_count = '<a onclick="showMessagesUserAnnouncement(' + json.data[i].user_announcement_id + ')">' + (json.data[i].unread_message_count == 0 ? '<span class="badge badge-success">0</span>' : '<span class="badge badge-danger">' + json.data[i].unread_message_count + '</span>') + '</a>';
                        json.data[i].options = '<a class="btn btn-primary" onclick="showDetailUserAnnouncement(' + i + ')"><span class="fas fa-eye"></span></a>'
                            + ' <a class="btn btn-success" onclick="showMessagesUserAnnouncement(' + json.data[i].user_announcement_id + ')"><span class="fas fa-envelope"></span></a>';
                    }

                    arrUserAnnouncements = json.data;

                    return json.data;
                }
            }
        });
    });
</script>

<script>
    function showDetailAnnouncement(index) {
        $($('#modal-announcement').find('.modal-header')).html(arrAnnouncements[index].announcement_title);
        $($('#modal-announcement').find('.modal-body')).html('<p>' + arrAnnouncements[index].announcement_message + '</p>');

        $('#modal-announcement').modal('show');
    }

    function showDetailUserAnnouncement(index) {
        $($('#modal-user-announcement').find('.modal-header')).html(arrUserAnnouncements[index].user_announcement_title);
        $($('#modal-user-announcement').find('.modal-body')).html('<p>' + arrUserAnnouncements[index].user_announcement_message + '</p>');

        $('#modal-user-announcement').modal('show');
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
                //
                // <div class="direct-chat-msg">
                //     <div class="direct-chat-infos clearfix text-dark">
                //         <span class="direct-chat-name float-left">Alexander Pierce</span>
                //         <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                //     </div>
                //     <img class="direct-chat-img" src="../dist/img/user1-128x128.jpg"
                //          alt="Message User Image">
                //         <div class="direct-chat-text">
                //             Is this template really for free? That's unbelievable!
                //         </div>
                // </div>
                // <div class="direct-chat-msg right">
                //     <div class="direct-chat-infos clearfix text-dark">
                //         <span class="direct-chat-name float-right">Sarah Bullock</span>
                //         <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                //     </div>
                //     <img class="direct-chat-img" src="../dist/img/user3-128x128.jpg"
                //          alt="Message User Image">
                //         <div class="direct-chat-text">
                //             You better believe it!
                //         </div>
                // </div>

                var html = '';

                for (var i = response.data.length - 1; i != 0; i--) {
                    html += '<div class="direct-chat-msg ' + (response.data[i].user_announcement_message_created_by == USER_ID ? '' : 'right') + '"><div class="direct-chat-infos clearfix text-dark"><span class="direct-chat-name float-'+ (response.data[i].user_announcement_message_created_by == USER_ID ? 'right' : 'left')+'">' + response.data[i].userFullName + '</span><span class="direct-chat-timestamp float-'+(response.data[i].user_announcement_message_created_by == USER_ID ? 'left' : 'right')+'">' + response.data[i].user_announcement_message_created_at + '</span></div><img class="direct-chat-img" src="../dist/img/user1-128x128.jpg"><div class="direct-chat-text">' + response.data[i].user_announcement_message_message + '</div></div>';
                }

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