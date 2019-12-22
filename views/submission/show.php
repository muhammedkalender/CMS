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
            <div class="card card-info">
                <div class="card-header">
                    <h5 class="card-title"><?= uiLang('authors') ?></h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="authors" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th><?= uiLang('id') ?></th>
                                <th><?= uiLang('first_name') ?></th>
                                <th><?= uiLang('last_name') ?></th>
                                <th><?= uiLang('email') ?></th>
                                <th class="no-sort"><?= uiLang('options') ?></th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title"><?= uiLang('submission') ?></h5>
                </div>
                <div class="card-body submission-update-body">
                    <form action="/api.php" method="post" onsubmit="return checkForm(this)"
                          id="form-submission-update" submit-delay="2000" card-loader="ok">
                        <!--                todo url redictect-->
                        <input type="hidden" name="call_category" value="submission">
                        <input type="hidden" name="call_request" value="insert">

                        <div id="divUsers"></div>

                        <div id="message"></div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><?= inputLang('id') ?></label>
                                    <input type="number" class="form-control" placeholder="<?= hintLang('id') ?>"
                                           name="id"
                                           minlength="1" maxlength="64" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><?= inputLang('ec_id') ?></label>
                                    <input type="number" class="form-control" placeholder="<?= hintLang('ec_id') ?>"
                                           name="ec_id"
                                           minlength="1" maxlength="64" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label><?= inputLang('full_paper') ?></label>
                                <div class="form-group inputStatus" data-name="full_paper">
                                    <!--                                        todo generic birşey, varsa badge çakacak ?-->
                                    <!--                                        <label class="badge badge-success">Onaylandı</label>-->
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label><?= inputLang('invoice') ?></label>
                                <div class="form-group inputStatus" data-name="invoice">
                                    <!--                                        todo generic birşey, varsa badge çakacak ?-->
                                    <!--                                        <label class="badge badge-success">Onaylandı</label>-->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="presentation_type"><?= inputLang('presentation_lang') ?></label>
                                    <select class="form-control" id="presentation_type" name="presentation_type">
                                        <option>option 1</option>
                                        <!--todo-->
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><?= inputLang('submit_date') ?></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                            class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control" data-inputmask-alias="datetime"
                                               data-inputmask-inputformat="mm/dd/yyyy" data-mask=""
                                               im-insert="false"
                                               name="submit_date"
                                               placeholder="<?= inputLang('submit_date') ?>" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><?= inputLang('paper_title') ?></label>
                            <input type="text" class="form-control" placeholder="<?= hintLang('paper_title') ?>"
                                   name="paper_title" minlength="3" maxlength="256" required>
                        </div>


                        <div class="form-group">
                            <label><?= inputLang('keywords') ?></label>
                            <input type="text" class="form-control" placeholder="<?= hintLang('keywords') ?>"
                                   name="keywords"
                                   maxlength="256">
                        </div>
                        <div class="form-group">
                            <label><?= inputLang('ec_keyprases') ?></label>
                            <input type="text" class="form-control" placeholder="<?= hintLang('ec_keyprases') ?>"
                                   name="ec_keyprases" maxlength="256">
                        </div>
                        <div class="form-group">
                            <label><?= inputLang('topics') ?></label>
                            <input type="text" class="form-control" placeholder="<?= hintLang('topics') ?>"
                                   name="topics"
                                   maxlength="256">
                        </div>
                        <div class="form-group">
                            <label><?= inputLang('type_of_contribution') ?></label>
                            <input type="text" class="form-control"
                                   placeholder="<?= hintLang('type_of_contribution') ?>"
                                   name="type_of_contribution" maxlength="256">
                        </div>
                        <!--                todo wsync-->
                        <div class="form-group">
                            <label><?= inputLang('abstract_paper') ?></label>
                            <textarea class="form-control" name="abstract_paper"
                                      placeholder="<?= hintLang('abstract_paper') ?>"
                                      maxlength="1024"></textarea>
                        </div>

                        <div class="form-group">
                            <label><?= inputLang('authors') ?></label>
                            <input type="text" class="form-control" data-role="tagsinput" id="authors">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="form-control btn-success" value="<?= uiLang('save') ?>"
                                   onclick="loadAuthors();">
                        </div>
                    </form>
                </div>
            </div>
            <div class="card card-warning">
                <div class="card-header">
                    <h5 class="card-title"><?= uiLang('submission_full_paper') ?></h5>
                </div>
                <div class="card-body">

                </div>
            </div>
            <div class="card card-info">
                <div class="card-header">
                    <h5 class="card-title"><?= uiLang('submission_invoice') ?></h5>
                </div>
                <div class="card-body">
                    <? //https://stackoverflow.com/a/722395 ?>
                    <?php if ($user->isAdmin()): ?>
                        <div class="col-md-3">
                            <div class="form-group">
                                <button class="btn btn-danger form-control" data-toggle="modal"
                                        data-target="#modal-force-request-submission-invoice"><?= uiLang('force_request_submission_invoice') ?></button>
                            </div>
                        </div>
                    <?php endif; ?>
                    <form action="/api.php" method="post" onsubmit="return checkForm(this)"
                          id="form-invoice-insert" submit-delay="2000" card-loader="ok">
                        <input type="hidden" name="call_category" value="request-submission-invoice">
                        <input type="hidden" name="call_request" value="insert">

                        <div id="message"></div>

                        <input type="hidden" name="id" value="<?= $submissionID ?>">
                        <input type="hidden" name="file" id="invoice">

                        <div class="form-group">
                            <input type="file" class="form-control" id="fileURL" onchange="encodeImageFileAsURL();"
                                   required/>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success"><i
                                        class="fas fa-save"></i> <?= uiLang('save') ?></button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal" id="modal-author">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content bg-primary">
                        <div class="modal-header">
                            <h4 class="modal-title">Primary Modal</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form onsubmit="saveAuthor(); return false;">
                                <input type="hidden" id="key">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?= inputLang('email') ?></label>
                                            <input type="email" class="form-control"
                                                   placeholder="<?= hintLang('email') ?>"
                                                   name="email" id="email"
                                                   maxlength="64" required>
                                        </div>
                                        <div class="form-group">
                                            <label><?= inputLang('name') ?></label>
                                            <input type="text" class="form-control"
                                                   placeholder="<?= hintLang('name') ?>"
                                                   name="name" id="name"
                                                   minlength="2" maxlength="32" required>
                                        </div>
                                        <div class="form-group">
                                            <label><?= inputLang('country') ?></label>
                                            <select class="form-control select2" name="country" id="country" required>
                                                <option value="1">Option 1</option>
                                            </select>
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
                                            <label><?= inputLang('organization') ?></label>
                                            <input type="text" class="form-control"
                                                   placeholder="<?= hintLang('organization') ?>"
                                                   name="organization" id="organization"
                                                   maxlength="128">
                                        </div>
                                        <div class="form-group">
                                            <label><?= inputLang('surname') ?></label>
                                            <input type="text" class="form-control"
                                                   placeholder="<?= hintLang('surname') ?>"
                                                   name="surname" id="surname"
                                                   minlength="2" maxlength="32" required>
                                        </div>
                                        <div class="form-group">
                                            <label><?= inputLang('web_site') ?></label>
                                            <input type="url" class="form-control"
                                                   placeholder="<?= hintLang('webs_ite') ?>"
                                                   name="web_site" id="web_site" maxlength="128">
                                        </div>
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
                                    <input type="submit" class="form-control" value="<?= uiLang('save') ?>">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal-force-request-submission-invoice">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content bg-success">
                        <div class="modal-header">
                            <h4 class="modal-title">
                                <?= uiLang('force_request_submission_invoice') ?>
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form action="/api.php" method="post" onsubmit="return checkForm(this)"
                                  id="form-force-request-submission-invoice"
                                  modal-loader="modal-force-request-submission-invoice">
                                <input type="hidden" name="call_category" value="request-submission-invoice">
                                <input type="hidden" name="call_request" value="force-confirm">

                                <div id="message"></div>

                                <input type="hidden" name="id" value="<?= $submissionID ?>">

                                <div class="form-group">
                                    <p class="objectName"></p>
                                    <p><?= uiLang('force_request_invoice_are_you_sure') ?></p>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default"><?= uiLang('confirm') ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="<?= folder() ?>plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= folder() ?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
<link rel="stylesheet" href="<?= folder() ?>plugins/bootstrap-tagsinput/bootstrap-tagsinput.css">
<script src="<?= folder() ?>plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>

<style>
    .bootstrap-tagsinput {
        width: 100%;
    }
</style>

<script>
    var itemList = [];

    function showAuthor(key) {
        var objData = null;

        for (var i = 0; i < itemList.length; i++) {
            if (itemList[i].key == key) {
                objData = itemList[i];

                break;
            }
        }

        if (objData == null) {
            //todo
            console.log('asdas');
            return;
        }

        $('#email').val(objData.email);
        $('#organization').val(objData.organization);
        $('#name').val(objData.name);
        $('#surname').val(objData.surname);
        $('#country').val(objData.country);
        $('#web_site').val(objData.web_site);
        $('#corresponding').prop('checked', objData.corresponding == 1 ? true : false);
        $('#joined').prop('checked', objData.joined == 1 ? true : false);

        $('#key').val(key);
        $('#modal-author').modal('show');
    }

    function saveAuthor() {
        var key = $('#key').val();

        for (var i = 0; i < itemList.length; i++) {
            if (itemList[i].key == key) {
                itemList[i] = {
                    key: key,
                    email: $('#email').val(),
                    organization: $('#organization').val(),
                    name: $('#name').val(),
                    surname: $('#surname').val(),
                    country: $('#country').val(),
                    web_site: $('#web_site').val(),
                    corresponding: $('#corresponding').prop('checked') ? 1 : 0,
                    joined: $('#joined').prop('checked') ? 1 : 0
                };

                break;
            }
        }

        $('#modal-author').modal('hide');
    }

    function loadAuthors() {
        var html = '';

        for (var i = 0; i < itemList.length; i++) {
            html += '<input type="hidden" name="users[]" value="' + itemList[i].name + DEFAULT_HTML_SPLITTER + itemList[i].surname + DEFAULT_HTML_SPLITTER + itemList[i].email + DEFAULT_HTML_SPLITTER + itemList[i].country + DEFAULT_HTML_SPLITTER + itemList[i].organization + DEFAULT_HTML_SPLITTER + itemList[i].web_site + DEFAULT_HTML_SPLITTER + itemList[i].corresponding + DEFAULT_HTML_SPLITTER + itemList[i].joined + '">';
        }

        $('#divUsers').html(html);
    }

    //https://stackoverflow.com/a/23669825
    function encodeImageFileAsURL() {
        var filesSelected = document.getElementById("fileURL").files;

        if (filesSelected.length > 0) {
            var fileToLoad = filesSelected[0];

            var fileReader = new FileReader();

            fileReader.onload = function (fileLoadedEvent) {
                var srcData = fileLoadedEvent.target.result; // <--- data: base64

                $('#invoice').val(srcData);

                //todo size, format ?
            };

            fileReader.readAsDataURL(fileToLoad);
        }
    }
</script>

<script>
    $(function () {
        $('[data-mask]').inputmask();

        showCardOverlay($('#form-submission-update'));

        $('#authors').DataTable({
            'processing': true,
            'serverSide': true,
            'ordering': false,
            'paging': false,
            'searching': false,
            "info": false,
            'serverMethod': 'post',
            'columns': [
                {'data': 'user_id'},
                {'data': 'user_first_name'},
                {'data': 'user_last_name'},
                {'data': 'user_email'},
                {'data': 'options', 'orderable': false}
            ],
            'ajax': {
                'url': 'api.php',
                'type': 'post',
                'dataType': 'json',
                'data': {
                    'call_category': 'user',
                    'call_request': 'authors',
                    'id': <?=$submissionID?>
                },
                'dataSrc': function (json) {
                    for (var i = 0; i < json.data.length; i++) {
                        <?php if($user->isAdmin()): ?>
                        json.data[i].options = '<a class="btn btn-primary" href="' + internalURL('user', 'profile', 'user', json.data[i].user_id) + '" target="_blank" title="<?=uiLang("user_view")?>"><span class="fas fa-eye"></span></a>';
                        <?php else: ?>
                        json.data[i].options = '-';
                        <?php endif; ?>
                    }

                    arrAnnouncements = json.data;

                    return json.data;
                }
            }
        });

        $.ajax({
            'url': 'api.php',
            'type': 'post',
            'dataType': 'json',
            'data': {
                'call_category': 'submission',
                'call_request': 'show',
                'id': <?=$submissionID?>,
            },
            'success': function (response) {
                //todo

                if (response.status == false) {
                    dialogError(response.message, '', '/');
                    return;
                }

                loadInputsFromObject('form-submission-update', response.data, 'submission_');
                formToView('form-submission-update');
                hideCardOverlay($('#form-submission-update'));
                //
                // loadInputsFromObject('form-user-preferences-update', response.data, 'user_');
                // hideCardOverlay($('#form-user-preferences-update'));
            },
            'error': function () {
                //todo
            }
        });
    });
</script>