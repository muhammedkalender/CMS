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
                <button class="btn btn-success" data-toggle="modal" data-target="#modal-user-insert"
                        onclick="clearForm($('#form-user-insert'))"><span
                            class="fas fa-plus"></span> <?= uiLang('add_new') ?>
                </button>
            </div>
            <br>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?= uiLang('users') ?></h3>
                        </div>
                        <div class="card-body">
                            <table id="users" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th><?= uiLang('id') ?></th>
                                    <th><?= uiLang('ec_id') ?></th>
                                    <th><?= uiLang('submission_id') ?></th>
                                    <th><?= uiLang('first_name') ?></th>
                                    <th><?= uiLang('last_name') ?></th>
                                    <th><?= uiLang('email') ?></th>
                                    <th><?= uiLang('created_at') ?></th>
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
<div class="modal fade" id="modal-user-insert">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h4 class="modal-title">
                    <?= uiLang('insert_user') ?>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="/api.php" method="post" onsubmit="return checkForm(this)" id="form-user-insert"
                      submit-datatable="users"
                      modal-loader="modal-user-insert">
                    <input type="hidden" name="call_category" value="user">
                    <input type="hidden" name="call_request" value="insert">

                    <div id="message"></div>

                    <div class="form-group">
                        <label><?= inputLang('language') ?></label>
                        <select class="form-control" name="language_code" required>
                            <!--                            todo-->
                            <option value="1">All</option>
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
                        <button type="submit" class="btn btn-success"><?= uiLang('add') ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-announcement-update">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h4 class="modal-title">
                    <?= uiLang('update_announcements') ?>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="/api.php" method="post" onsubmit="return checkForm(this)" id="form-announcement-update"
                      submit-datatable="announcements"
                      modal-loader="modal-announcement-update">
                    <input type="hidden" name="call_category" value="announcement">
                    <input type="hidden" name="call_request" value="update">

                    <div id="message"></div>

                    <input type="hidden" name="id">

                    <div class="form-group">
                        <label><?= inputLang('language') ?></label>
                        <select class="form-control" name="language_code" required>
                            <!--                            todo-->
                            <option value="1">All</option>
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

<div class="modal fade" id="modal-announcement-delete">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h4 class="modal-title">
                    <?= uiLang('delete_announcements') ?>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="/api.php" method="post" onsubmit="return checkForm(this)" id="form-announcement-delete"
                      submit-datatable="announcements"
                      modal-loader="modal-announcement-delete">
                    <input type="hidden" name="call_category" value="announcement">
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

<script src="<?= folder() ?>plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= folder() ?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<script>
    const USER_ID = <?=$user->id?>;
    const USER_FULL_NAME = '<?=$user->getFullName()?>';

    var arrUsers = [];
    var arrAnnouncements = [];
    var arrUserAnnouncements = [];
</script>

<script>
    $(function () {
        $('#users').DataTable({
            'processing': true,
            'serverSide': true,
            'ordering': true,
            'paging': true,
            'searching': true,
            'info': true,
            'lengthMenu': [[10, 25, 50, 100, 400], [10, 25, 50, 100, 400]],
            'serverMethod': 'post',
            'columns': [
                {'data': 'user_id'},
                {'data': 'user_ec_id'},
                {'data': 'user_submission'},
                {'data': 'user_first_name'},
                {'data': 'user_last_name'},
                {'data': 'user_email'},
                {'data': 'user_created_at'},
                {'data': 'options', 'orderable': false}
            ],
            'ajax': {
                'url': 'api.php',
                'type': 'post',
                'dataType': 'json',
                'data': {
                    'call_category': 'user',
                    'call_request': 'data-tables'
                },
                'dataSrc': function (json) {
                    for (var i = 0; i < json.data.length; i++) {
                        json.data[i].user_created_at = formatDMYOnlyDate(json.data[i].user_created_at);
                        json.data[i].options = '<a class="btn btn-primary" onclick="showDetailAnnouncement(' + i + ')" title="<?=uiLang("announcement_view")?>"><span class="fas fa-eye"></span></a>'
                            + ' <a class="btn btn-warning" onclick="showUpdateAnnouncement(' + i + ')" title="<?=uiLang("announcement_update")?>"><span class="fas fa-edit"></span></a>'
                            + ' <a class="btn btn-danger" onclick="showDeleteAnnouncement(' + i + ')" title="<?=uiLang("announcement_delete")?>"><span class="fas fa-trash"></span></a>'; //todo
                    }

                    arrUserss = json.data;

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
</script>

<script>
    function showDetailAnnouncement(index) {
        $($('#modal-announcement').find('.modal-header')).html(arrAnnouncements[index].announcement_title);
        $($('#modal-announcement').find('.modal-body')).html('<p>' + arrAnnouncements[index].announcement_message + '</p>');

        $('#modal-announcement').modal('show');
    }

    function showUpdateAnnouncement(index) {
        loadInputsFromObject('form-announcement-update', arrAnnouncements[index], 'announcement_');

        $('#modal-announcement-update').modal('show');
    }

    function showDeleteAnnouncement(index) {
        loadInputsFromObject('form-announcement-delete', arrAnnouncements[index], 'announcement_', 'title');

        $('#modal-announcement-delete').modal('show');
    }
</script>