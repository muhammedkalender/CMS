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
                                            <select class="form-control" name="country" id="country" required>
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
        </div>
    </section>
</div>
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
</script>

<script>
    $(function () {
        $('[data-mask]').inputmask();

        showCardOverlay($('#form-submission-update'));

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