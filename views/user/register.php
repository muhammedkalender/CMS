<body class="hold-transition container">
<div class="row">
    <div class="login-logo">
        <a href="../../index2.html"><b>Admin</b>LTE</a>
    </div>
    <!-- /.login-logo -->
    <div class="card col-12">
        <div class="card-body login-card-body">
            <form action="/api.php" method="post" onsubmit="return checkForm(this)"
                  submit-redirect="test.html" submit-delay="2000">
                <input type="hidden" name="call_category" value="user">
                <input type="hidden" name="call_request" value="register">

                <div id="message"></div>

                <div class="form-group">
                    <label><?= inputLang('ec_id') ?></label>
                    <input type="number" class="form-control" placeholder="<?= hintLang('ec_id') ?>" name="email"
                           minlength="1" maxlength="64" required>
                </div>
                <div class="form-group">
                    <label><?= inputLang('paper_title') ?></label>
                    <input type="text" class="form-control" placeholder="<?= hintLang('paper_title') ?>"
                           name="paper_title" minlength="3" maxlength="256" required>
                </div>
                <div class="form-group">
                    <label><?= inputLang('submit_date') ?></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                        </div>
                        <input type="text" class="form-control" data-inputmask-alias="datetime"
                               data-inputmask-inputformat="mm/dd/yyyy" data-mask="" im-insert="false" name="submit_date"
                               placeholder="<?= inputLang('submit_date') ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="presentation_type"><?= inputLang('presentation_lang') ?></label>
                    <select class="form-control" id="presentation_type">
                        <option>option 1</option>
                        <!--todo-->
                    </select>
                </div>
                <div class="form-group">
                    <label><?= inputLang('keywords') ?></label>
                    <input type="text" class="form-control" placeholder="<?= hintLang('keywords') ?>" name="keywords"
                           maxlength="256">
                </div>
                <div class="form-group">
                    <label><?= inputLang('ec_keyprases') ?></label>
                    <input type="text" class="form-control" placeholder="<?= hintLang('ec_keyprases') ?>"
                           name="ec_keyprases" maxlength="256">
                </div>
                <div class="form-group">
                    <label><?= inputLang('topics') ?></label>
                    <input type="text" class="form-control" placeholder="<?= hintLang('topics') ?>" name="topics"
                           maxlength="256">
                </div>
                <div class="form-group">
                    <label><?= inputLang('type_of_contribution') ?></label>
                    <input type="text" class="form-control" placeholder="<?= hintLang('type_of_contribution') ?>"
                           name="type_of_contribution" maxlength="256">
                </div>
                <!--                todo wsync-->
                <div class="form-group">
                    <label><?= inputLang('abstract_paper') ?></label>
                    <textarea class="form-control" name="abstract_paper" placeholder="<?= hintLang('abstract_paper') ?>"
                              maxlength="1024"></textarea>
                </div>

                <div class="form-group">
                    <label><?= inputLang('authors') ?></label>
                    <input type="text" class="form-control" data-role="tagsinput" id="authors">
                </div>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-author">
                    Launch Primary Modal
                </button>
            </form>
            <p class="mb-1">
                <a href="forgot-password.html"><?= uiLang('forgot_password') ?></a>
            </p>
            <p class="mb-0">
                <a href="register.html" class="text-center"><?= uiLang('register') ?></a>
            </p>
        </div>
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
                <form action="/api.php" method="post" onsubmit="return checkForm(this)"
                      submit-redirect="test.html" submit-delay="2000">
                    <input type="hidden" name="call_category" value="user">
                    <input type="hidden" name="call_request" value="login">

                    <div id="message"></div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?= inputLang('email') ?></label>
                                <input type="email" class="form-control" placeholder="<?= hintLang('email') ?>"
                                       name="email"
                                       maxlength="64">
                            </div>
                            <div class="form-group">
                                <label><?= inputLang('name') ?></label>
                                <input type="text" class="form-control" placeholder="<?= hintLang('name') ?>"
                                       name="name"
                                       minlength="2" maxlength="32" required>
                            </div>
                            <div class="form-group">
                                <label><?= inputLang('country') ?></label>
                                <select class="form-control" name="country" required>
                                    <option value="test">Option 1</option>
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
                                <input type="text" class="form-control" placeholder="<?= hintLang('organization') ?>"
                                       name="keywords"
                                       maxlength="128">
                            </div>
                            <div class="form-group">
                                <label><?= inputLang('surname') ?></label>
                                <input type="text" class="form-control" placeholder="<?= hintLang('surname') ?>"
                                       name="surname"
                                       minlength="2" maxlength="32" required>
                            </div>
                            <div class="form-group">
                                <label><?= inputLang('web_site') ?></label>
                                <input type="url" class="form-control" placeholder="<?= hintLang('webs_ite') ?>"
                                       name="web_site" maxlength="128">
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
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-light" onclick="saveAuthor()">Save changes</button>
            </div>
        </div>
    </div>
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
        console.log(objData);

        $('#email').val(objData.email);
        $('#organization').val(objData.organization);
        $('#name').val(objData.name);
        $('#surname').val(objData.surname);
        $('#country').val(objData.country);
        $('#web_site').val(objData.web_site);
        $('#corresponding').val(objData.corresponding ? 'check' : 'uncheck'); //todo
        $('#joined').val(objData.joined ? 'check' : 'uncheck');


        $('#modal-author').modal('show');
    }

    function saveAuthor(key) {
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
                    corresponding: $('#corresponding').val() == 'on' ? 1 : 0,
                    joined: $('#joined').val() == 'on' ? 1 : 0
                };

                break;
            }
        }

        $('#modal-author').modal('hide');
    }
</script>

<script>
    $(function () {
        $('[data-mask]').inputmask();

        $('#authors').on('itemAdded', function (event) {
            itemList[itemList.length] = {
                key: event.item,
                email: '',
                organization: '',
                name: '',
                surname: '',
                country: 1,
                web_site: '',
                corresponding: 0,
                joined: 0
            };

            $('.label-info').on("click", function () {
                showAuthor($(this).text());
            });
        }).on('itemRemoved', function (event) {
            var tempArray = [];

            for (var i = 0; i < itemList.length; i++) {
                if (itemList[i].key == event.item) {
                    continue;
                }

                tempArray[tempArray.length] = itemList[i];
            }

            itemList = tempArray;
        });
    });
</script>