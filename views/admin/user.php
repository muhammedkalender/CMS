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
            <div class="from-group">
                <button class="btn btn-success" data-toggle="modal" data-target="#modal-user-insert"
                        onclick="loadSubmissions(); loadCountries('country', true); clearForm($('#form-user-insert'));"><span
                            class="fas fa-plus"></span> <?= uiLang('add_new') ?>
                </button>
            </div>
            <br>
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><?= uiLang('users') ?></h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
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
                <form action="<?=apiURL()?>" method="post" onsubmit="return checkForm(this)" id="form-user-insert"
                      submit-datatable="users"
                      modal-loader="modal-user-insert">
                    <input type="hidden" name="call_category" value="user">
                    <input type="hidden" name="call_request" value="register">

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
                                <select class="form-control select2" name="submission" id="submission" required>
                                    <!--                                    todo-->
                                    <option value="1">Option 1</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?= inputLang('organization') ?></label>
                                <input type="text" class="form-control" placeholder="<?= hintLang('organization') ?>"
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
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="icheck-info">
                                    <input type="checkbox" id="admin" name="admin">
                                    <label for="admin">
                                        <?= inputLang('admin') ?>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="icheck-info">
                                    <input type="checkbox" id="corresponding" name="corresponding">
                                    <label for="corresponding">
                                        <?= inputLang('corresponding') ?>
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
                <form action="<?=apiURL()?>" method="post" onsubmit="return checkForm(this)" id="form-announcement-update"
                      submit-datatable="announcements"
                      modal-loader="modal-announcement-update">
                    <input type="hidden" name="call_category" value="announcement">
                    <input type="hidden" name="call_request" value="update">

                    <div id="message"></div>

                    <input type="hidden" name="id">

                    <div class="form-group">
                        <label><?= inputLang('language') ?></label>
                        <select class="form-control" name="language" required>
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

<div class="modal fade" id="modal-user-delete">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h4 class="modal-title">
                    <?= uiLang('delete_user') ?>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="<?=apiURL()?>" method="post" onsubmit="return checkForm(this)" id="form-user-delete"
                      submit-datatable="users"
                      modal-loader="modal-user-delete">
                    <input type="hidden" name="call_category" value="user">
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
                'url': '<?=apiURL()?>',
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

                        json.data[i].options = '<div class="btn-group" role="group"><button id="btnGroupDropUser" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=uiLang("dropdown")?></button><div class="dropdown-menu" aria-labelledby="btnGroupDropUser">';
                        json.data[i].options += '<a class="dropdown-item text-primary" target="_blank" href="' + internalURL('user', 'profile', json.data[i].user_id) + '" title="<?=uiLang("user_view")?>"><span class="fas fa-eye"></span> <?=uiLang("user_view")?></a>';
                        json.data[i].options += '<a class="dropdown-item text-danger" onclick="showDeleteUser(' + i + ')" title="<?=uiLang("user_delete")?>"><span class="fas fa-trash"></span> <?=uiLang("user_delete")?></a>';
                        json.data[i].options += '</div></div>';
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
</script>

<script>
    function loadSubmissions() {
        showModalOverlay("modal-user-insert");

        $.ajax({
            'url': '<?=apiURL("submission", "list")?>',
            'type': 'get',
            'dataType': 'json',
            'success': function(response){
                if(response.status){
                    var html = "";

                    for(var i = 0; i < response.data.length; i++){
                        html += "<option value=\""+response.data[i].submission_id+"\">" + response.data[i].submission_id + " - " +response.data[i].submission_paper_title.substr(0, 32) + "</option>";
                    }

                    $("#submission").html(html);

                    hideModalOverlay("modal-user-insert");
                }else{
                    formError($('#form-user-insert'), response.message);
                    hideModalOverlay("modal-user-insert");
                }
            }
        });
    }

    function showDeleteUser(index) {
        loadInputsFromObject('form-user-delete', arrUsers[index], 'user_', 'full_name');

        $('#modal-user-delete').modal('show');
    }
</script>