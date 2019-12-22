<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?=pageLang('user_profile')?></h1>
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

                        <!--                    todo submission seçilince bunu yükliyecek-->
                        <input type="hidden" name="ec_id" id="ec_id">

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
                                    <select class="form-control" name="submission" id="submission" required>
                                        <!--                                    todo-->
                                        <option value="1">Option 1</option>
                                    </select>
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
                                    <input type="url" class="form-control" placeholder="<?= hintLang('tel') ?>"
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
                                        <input type="checkbox" id="corresponding" name="corresponding">
                                        <label for="corresponding">
                                            <?= inputLang('corresponding') ?>
                                        </label>
                                    </div>
                                </div>
                                <?php if ($user->isAdmin()) { ?>
                                    <div class="form-group">
                                        <div class="icheck-info">
                                            <input type="checkbox" id="admin" name="admin">
                                            <label for="admin">
                                                <?= inputLang('admin') ?>
                                            </label>
                                        </div>
                                    </div>
                                <?php } ?>
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
                    <form action="/api.php" method="post" onsubmit="return checkForm(this)"
                          id="form-user-password-update"
                          card-loader="ok">
                        <input type="hidden" name="call_category" value="user">
                        <input type="hidden" name="call_request" value="password-update">

                        <div id="message"></div>

                        <div class="form-group">
                            <label><?= inputLang('current_password') ?></label>
                            <input type="password" class="form-control"
                                   placeholder="<?= hintLang('current_password') ?>"
                                   name="current_password" id="current_password"
                                   minlength="3" maxlength="64" required>
                        </div>
                        <div class="form-group">
                            <label><?= inputLang('new_password') ?></label>
                            <input type="password" class="form-control" placeholder="<?= hintLang('new_password') ?>"
                                   name="new_password" id="new_password"
                                   minlength="3" maxlength="64" required>
                        </div>
                        <div class="form-group">
                            <label><?= inputLang('confirm_password') ?></label>
                            <input type="password" class="form-control"
                                   placeholder="<?= hintLang('confirm_password') ?>"
                                   name="confirm_password" id="confirm_password"
                                   minlength="3" maxlength="64" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info"><?= uiLang('change') ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
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
            loadInputsFromObject('form-user-update-info', response.data, 'user_');
            hideCardOverlay($('#form-user-update-info'));

            loadInputsFromObject('form-user-preferences-update', response.data, 'user_');
            hideCardOverlay($('#form-user-preferences-update'));
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
</script>