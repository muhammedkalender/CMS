<link rel="stylesheet" href="<?= folder() ?>plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= pageLang('user_profile') ?></h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><?= uiLang('user_info') ?></h3>
                </div>
                <div class="card-body">
                    <form action="/api.php" method="post" onsubmit="return checkForm(this)" id="form-user-update-info"
                          submit-datatable="users"
                          card-loader="ok">
                        <input type="hidden" name="call_category" value="user">
                        <input type="hidden" name="call_request" value="update-info">
                        <input type="hidden" name="id" value="<?= $userID ?>" const="true">

                        <div id="message"></div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?= inputLang('email') ?></label>
                                    <input type="email" class="form-control" placeholder="<?= hintLang('email') ?>"
                                           name="email" id="email"
                                           maxlength="64" required>
                                </div>
                                <div class="form-group">
                                    <label><?= inputLang('first_name') ?></label>
                                    <input type="text" class="form-control" placeholder="<?= hintLang('first_name') ?>"
                                           name="first_name" id="first_name"
                                           minlength="2" maxlength="32" required>
                                </div>
                                <div class="form-group">
                                    <label><?= inputLang('country') ?></label>
                                    <select class="form-control" name="country" id="country" required>
                                        <option value="1">Option 1</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label><?= inputLang('submission') ?></label>
                                    <input type="text" class="form-control" name="submission" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?= inputLang('organization') ?></label>
                                    <input type="text" class="form-control"
                                           placeholder="<?= hintLang('organization') ?>"
                                           name="organization" id="organization"
                                           maxlength="128">
                                </div>
                                <div class="form-group">
                                    <label><?= inputLang('last_name') ?></label>
                                    <input type="text" class="form-control" placeholder="<?= hintLang('last_name') ?>"
                                           name="last_name" id="last_name"
                                           minlength="2" maxlength="32" required>
                                </div>
                                <div class="form-group">
                                    <label><?= inputLang('web_page') ?></label>
                                    <input type="url" class="form-control" placeholder="<?= hintLang('web_page') ?>"
                                           name="web_page" id="web_page" maxlength="128">
                                </div>
                                <div class="form-group">
                                    <label><?= inputLang('tel') ?></label>
                                    <input type="tel" class="form-control" placeholder="<?= hintLang('tel') ?>"
                                           name="tel" id="tel" maxlength="128">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><?= inputLang('address') ?></label>
                            <textarea class="form-control" placeholder="<?= hintLang('address') ?>"
                                      name="address" id="address"
                                      maxlength="128"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="icheck-info">
                                        <input type="checkbox" id="is_corresponding" name="is_corresponding">
                                        <label for="is_corresponding">
                                            <?= inputLang('is_corresponding') ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="icheck-info">
                                        <input type="checkbox" id="joined" name="joined">
                                        <label for="joined">
                                            <?= inputLang('joined') ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><?= uiLang('save') ?></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title"><?= uiLang('user_preferences') ?></h3>
                </div>
                <div class="card-body">
                    <form action="/api.php" method="post" onsubmit="return checkForm(this)"
                          id="form-user-preferences-update"
                          card-loader="ok">
                        <input type="hidden" name="call_category" value="user">
                        <input type="hidden" name="call_request" value="update-preferences">

                        <input type="hidden" name="id" value="<?= $userID ?>">

                        <div id="message"></div>

                        <div class="form-group">
                            <label><?= inputLang('preferences_food') ?></label>
                            <textarea class="form-control" placeholder="<?= hintLang('preferences_food') ?>"
                                      name="food" id="food"
                                      maxlength="256"></textarea>
                        </div>
                        <div class="form-group">
                            <label><?= inputLang('preferences_accommodation') ?></label>
                            <textarea class="form-control" placeholder="<?= hintLang('preferences_accommodation') ?>"
                                      name="accommodation" id="accommodation"
                                      maxlength="256"></textarea>
                        </div>
                        <div class="form-group">
                            <label><?= inputLang('preferences_extra_note') ?></label>
                            <textarea class="form-control" placeholder="<?= hintLang('preferences_extra_note') ?>"
                                      name="extra_note" id="extra_note"
                                      maxlength="256"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning"><?= uiLang('save') ?></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><?= uiLang('user_password') ?></h3>
                </div>
                <div class="card-body">
                    <form action="/api.php" method="post" onsubmit="return checkPassword(this);"
                          id="form-user-password-update"
                          card-loader="ok">
                        <input type="hidden" name="call_category" value="user">
                        <input type="hidden" name="call_request" value="update-password">

                        <input type="hidden" name="id" value="<?= $userID ?>">

                        <div id="message"></div>

                        <div class="form-group">
                            <label><?= inputLang('current_password') ?></label>
                            <input type="password" class="form-control"
                                   placeholder="<?= hintLang('password_old') ?>"
                                   name="password_old" id="password_old"
                                   minlength="<?= $user->isAdmin() ? 0 : 3 ?>"
                                   maxlength="64" <?= $user->isAdmin() ? '' : 'required' ?>>
                        </div>
                        <div class="form-group">
                            <label><?= inputLang('new_password') ?></label>
                            <input type="password" class="form-control" placeholder="<?= hintLang('password_new') ?>"
                                   name="password_new" id="password_new"
                                   minlength="3" maxlength="64" required>
                        </div>
                        <div class="form-group">
                            <label><?= inputLang('confirm_password') ?></label>
                            <input type="password" class="form-control"
                                   placeholder="<?= hintLang('password_repeat') ?>"
                                   name="password_repeat" id="password_repeat"
                                   minlength="3" maxlength="64" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info"><?= uiLang('change') ?></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title"><?= uiLang('user_announcements') ?></h3>
                </div>
                <div class="card-body">
                    <?php if($user->isAdmin()):?>
                    <div class="form-group">
                        <button class="btn btn-success" data-toggle="modal"
                                data-target="#modal-user-announcement-insert"
                                onclick="clearForm($('#form-user-announcement-insert'))"><?= uiLang("insert_user_announcement") ?></button>
                    </div>
                    <?php endif; ?>
                    <div class="table-responsive">
                        <table id="user-announcements" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th><?= uiLang('id') ?></th>
                                <th><?= uiLang('title') ?></th>
                                <th><?= uiLang('public_date') ?></th>
                                <th><?= uiLang('created_by') ?></th>
                                <th class="no-sort"><?= uiLang('options') ?></th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
                        <input type="hidden" name="user" value="<?= $userID ?>" const="true">
                        <p id="modalUserAnnouncementInsertFullName"></p>
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
                        <div class="form-group">
                            <label><?= inputLang('user') ?></label>
                            <input type="hidden" name="user" value="<?= $userID ?>" const="true">
                            <p id="modalUserAnnouncementUpdateFullName"></p>
                        </div>
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
        <div class="modal-content bg-success">
            <div class="modal-header">
                <h4 class="modal-title"><?= uiLang('user_messages') ?></h4>
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
                                <input type="text" name="message" id="user-announcement-message-message"
                                       placeholder="<?= hintLang('type_message') ?>"
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

    var arrUsers = [];
    var arrAnnouncements = [];
    var arrUserAnnouncements = [];

    var storeUser = null;
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
                        json.data[i].user_full_name = json.data[i].user_first_name + ' ' + json.data[i].user_last_name;
                        json.data[i].options = '<a class="btn btn-primary" target="_blank" href="page_test.php?c=user&r=view&user=' + json.data[i].user_id + '" title="<?=uiLang("announcement_view")?>"><span class="fas fa-eye"></span></a>'
                            + ' <a class="btn btn-danger" onclick="showDeleteUser(' + i + ')" title="<?=uiLang("user_delete")?>"><span class="fas fa-trash"></span></a>';
                    }

                    arrUsers = json.data;

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
                {'data': 'options', 'orderable': false}
            ],
            'ajax': {
                'url': 'api.php',
                'type': 'post',
                'dataType': 'json',
                'data': {
                    'call_category': 'user-announcement',
                    'call_request': 'users-data-tables',
                    'id': <?=$userID?>
                },
                'dataSrc': function (json) {
                    for (var i = 0; i < json.data.length; i++) {
                        json.data[i].user_announcement_created_at = formatDMYOnlyDate(json.data[i].user_announcement_created_at);

                        json.data[i].options = '<div class="btn-group" role="group"><button id="btnGroupDropAnnouncement" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=uiLang("dropdown")?></button><div class="dropdown-menu" aria-labelledby="btnGroupDropAnnouncement">';
                        json.data[i].options += '<a class="dropdown-item text-primary" onclick="showDetailUserAnnouncement(' + i + ')" title="<?=uiLang("user_announcement_view")?>"><span class="fas fa-eye"></span> <?=uiLang("user_announcement_view")?></a>';
                        json.data[i].options += '<a class="dropdown-item text-warning" onclick="showUpdateUserAnnouncement(' + i + ')" title="<?=uiLang("user_announcement_update")?>"><span class="fas fa-edit"></span> <?=uiLang("user_announcement_update")?></a>';
                        json.data[i].options += '<a class="dropdown-item text-success" onclick="showMessagesUserAnnouncement(' + json.data[i].user_announcement_id + ')" title="<?=uiLang("user_announcement_messages")?>"><span class="fas fa-envelope"></span> <?=uiLang("user_announcement_messages")?></a>';
                        json.data[i].options += '<a class="dropdown-item text-danger" onclick="showDeleteUserAnnouncement(' + i + ')" title="<?=uiLang("user_announcement_delete")?>"><span class="fas fa-trash"></span> <?=uiLang("user_announcement_delete")?></a>';
                        json.data[i].options += '</div></div>';
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
    });

    showCardOverlay($('#form-user-update-info'));
    showCardOverlay($('#form-user-preferences-update'));

    $.ajax({
        'url': 'api.php',
        'type': 'post',
        'dataType': 'json',
        'data': {
            'call_category': 'user',
            'call_request': 'profile',
            'id': <?=$userID?>,
        },
        'success': function (response) {
            //todo
            if (response.status) {
                loadInputsFromObject('form-user-update-info', response.data, 'user_');
                hideCardOverlay($('#form-user-update-info'));

                loadInputsFromObject('form-user-preferences-update', response.data, 'user_');
                hideCardOverlay($('#form-user-preferences-update'));

                storeUser = response.data;

                $('#modalUserAnnouncementInsertFullName').html(storeUser.user_first_name + ' ' + storeUser.user_last_name);

                $('#form-user-update-info').find('#message').html('');
                $('#form-user-preferences-update').find('#message').html('');
            }else{
                formError($('#form-user-update-info'), response.message);
                formError($('#form-user-preferences-update'), response.message);


                hideCardOverlay($('#form-user-preferences-update'));
                hideCardOverlay($('#form-user-update-info'));
            }
        },
        'error': function () {
            //todo
        }
    });
</script>

<script>
    function showDeleteUser(index) {
        loadInputsFromObject('form-user-delete', arrUsers[index], 'user_', 'full_name');

        $('#modal-user-delete').modal('show');
    }

    function checkPassword(form) {
        if ($('#password_new').val() != $('#password_repeat').val()) {
            formError(form, '<?=uiLang("password_doesnt_match")?>');

            return false;
        }

        return checkForm(form);
    }

    function showDetailUserAnnouncement(index) {
        $($('#modal-user-announcement').find('.modal-header')).html(arrUserAnnouncements[index].user_announcement_title);
        $($('#modal-user-announcement').find('.modal-body')).html('<p>' + arrUserAnnouncements[index].user_announcement_message + '</p>');

        $('#modal-user-announcement').modal('show');
    }

    function showUpdateUserAnnouncement(index) {
        loadInputsFromObject('form-user-announcement-update', arrUserAnnouncements[index], 'user_announcement_');

        $('#modalUserAnnouncementUpdateFullName').html(storeUser.user_first_name + ' ' + storeUser.user_last_name);

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
                    html += '<div class="direct-chat-msg ' + (response.data[i].user_announcement_message_created_by == USER_ID ? '' : 'right') + '"><div class="direct-chat-infos clearfix text-dark"><span class="direct-chat-name float-' + (response.data[i].user_announcement_message_created_by == USER_ID ? 'right' : 'left') + '">' + response.data[i].userFullName + '</span><span class="direct-chat-timestamp float-' + (response.data[i].user_announcement_message_created_by == USER_ID ? 'left' : 'right') + '">' + response.data[i].user_announcement_message_created_at + '</span></div><img class="direct-chat-img" src="../dist/img/user1-128x128.jpg"><div class="direct-chat-text">' + response.data[i].user_announcement_message_message + '</div></div>';
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