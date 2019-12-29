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
                <button class="btn btn-success" data-toggle="modal" data-target="#modal-announcement-insert"
                        onclick="clearForm($('#form-announcement-insert'))"><span
                            class="fas fa-plus"></span> <?= uiLang('add_new') ?>
                </button>
            </div>
            <br>
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><?= uiLang('announcements') ?></h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="announcements" class="table table-bordered table-hover">
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
<div class="modal fade" id="modal-announcement-insert">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h4 class="modal-title">
                    <?= uiLang('insert_announcements') ?>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="/api.php" method="post" onsubmit="return checkForm(this)" id="form-announcement-insert"
                      submit-datatable="announcements"
                      modal-loader="modal-announcement-insert">
                    <input type="hidden" name="call_category" value="announcement">
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

    var arrAnnouncements = [];
    var arrUserAnnouncements = [];
</script>

<script>
    $(function () {
        $('#announcements').DataTable({
            'processing': true,
            'serverSide': true,
            'ordering': true,
            'paging': true,
            'searching': true,
            'info': true,
            'lengthMenu': [[10, 25, 50, 100, 400], [10, 25, 50, 100, 400]],
            'serverMethod': 'post',
            'columns': [
                {'data': 'announcement_id'},
                {'data': 'announcement_title'},
                {'data': 'announcement_created_at'},
                {'data': 'createdBy'},
                {'data': 'options', 'orderable': false}
            ],
            'ajax': {
                'url': 'api.php',
                'type': 'post',
                'dataType': 'json',
                'data': {
                    'call_category': 'announcement',
                    'call_request': 'data-tables'
                },
                'dataSrc': function (json) {
                    for (var i = 0; i < json.data.length; i++) {
                        json.data[i].announcement_created_at = formatDMYOnlyDate(json.data[i].announcement_created_at);

                        json.data[i].options = '<div class="btn-group" role="group"><button id="btnGroupDropAnnouncement" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=uiLang("dropdown")?></button><div class="dropdown-menu" aria-labelledby="btnGroupDropAnnouncement">';
                        json.data[i].options += '<a class="dropdown-item text-primary" onclick="showDetailAnnouncement(' + i + ')" title="<?=uiLang("announcement_view")?>"><span class="fas fa-eye"></span> <?=uiLang("announcement_view")?></a>';
                        json.data[i].options += ' <a class="dropdown-item text-warning" onclick="showUpdateAnnouncement(' + i + ')" title="<?=uiLang("announcement_update")?>"><span class="fas fa-edit"></span> <?=uiLang("announcement_update")?></a>';
                        json.data[i].options += '<a class="dropdown-item text-danger" onclick="showDeleteAnnouncement(' + i + ')" title="<?=uiLang("announcement_delete")?>"><span class="fas fa-trash"></span> <?=uiLang("announcement_delete")?></a>';
                        json.data[i].options += '</div></div>';
                    }

                    arrAnnouncements = json.data;

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