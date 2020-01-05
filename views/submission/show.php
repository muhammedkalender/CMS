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
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label><?= inputLang('invoice') ?></label>
                                <div class="form-group inputStatus" data-name="invoice">
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
                    <? //https://stackoverflow.com/a/722395 ?>
                    <?php if ($user->isAdmin()): ?>
                        <div class="col-md-3">
                            <div class="form-group">
                                <button class="btn btn-danger form-control" data-toggle="modal"
                                        data-target="#modal-force-request-submission-full-paper"><?= uiLang('force_request_submission_full_paper') ?></button>
                            </div>
                        </div>
                    <?php endif; ?>
                    <form action="/api.php" method="post" onsubmit="return checkForm(this)"
                          id="form-full-paper-insert" submit-delay="2000" card-loader="ok" call-function="showFullPaperButton">
                        <input type="hidden" name="call_category" value="request-submission-full-paper">
                        <input type="hidden" name="call_request" value="insert">

                        <div id="message"></div>

                        <input type="hidden" name="id" value="<?= $submissionID ?>">
                        <input type="hidden" name="file" id="full_paper">

                        <div class="form-group">
                            <input type="file" class="form-control" id="fileURLFullPaper" onchange="uploadFullPaper();"
                                   required/>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" id="btnFullPaper" disabled><i
                                        class="fas fa-save"></i> <?= uiLang('save') ?></button>
                            <a target="_blank" class="btn btn-warning" href="" id="showFileFullPaper" style="display: none"><i class="fas fa-eye"></i> <?= uiLang('show_file') ?></a>
                        </div>
                    </form>
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
                          id="form-invoice-insert" submit-delay="2000" card-loader="ok" call-function="showInvoiceButton">
                        <input type="hidden" name="call_category" value="request-submission-invoice">
                        <input type="hidden" name="call_request" value="insert">

                        <div id="message"></div>

                        <input type="hidden" name="id" value="<?= $submissionID ?>">
                        <input type="hidden" name="file" id="invoice">

                        <div class="form-group">
                            <input type="file" class="form-control" id="fileURL" onchange="uploadInvoice();"
                                   required/>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" id="btnInvoice" disabled><i
                                        class="fas fa-save"></i> <?= uiLang('save') ?></button>
                            <a target="_blank" class="btn btn-warning" href="" id="showFileInvoice" style="display: none"><i class="fas fa-eye"></i> <?= uiLang('show_file') ?></a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card card-success collapsed-card">
                <div class="card-header">
                    <h5 class="card-title"><?= uiLang('submission_comments') ?></h5>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" onclick="collapseCard(this)" data-tables="submissionComments"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <?php if($user->isAdmin()): ?>
                    <div class="form-group">
                        <button class="btn btn-success" onclick="showInsertTask()"><?= uiLang("insert_submission_comment") ?></button>
                    </div>
                    <?php endif; ?>
                    <table id="submissionComments" class="table table-bordered table-hover">
                        <thead>
                        <th><?= uiLang('id') ?></th>
                        <th><?= uiLang('submission') ?></th>
                        <th><?= uiLang('message') ?></th>
                        <th><?= uiLang('created_at') ?></th>
                        <th><?= uiLang('created_by') ?></th>
                        <th><?= uiLang('status') ?></th>
                        <th class="no-sort"><?= uiLang('options') ?></th>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="card card-secondary collapsed-card">
                <div class="card-header">
                    <h5 class="card-title"><?= uiLang('submission_logs') ?></h5>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" onclick="collapseCard(this)" data-tables="logs"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body" style="display: none;">
                    <table id="logs" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th><?= uiLang('id') ?></th>
                            <th><?= uiLang('message') ?></th>
                            <th><?= uiLang('owner') ?></th>
                            <th><?= uiLang('created_at') ?></th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
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
                                            <label><?= inputLang('first_name') ?></label>
                                            <input type="text" class="form-control"
                                                   placeholder="<?= hintLang('first_name') ?>"
                                                   name="first_name" id="first_name"
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
                                            <label><?= inputLang('last_name') ?></label>
                                            <input type="text" class="form-control"
                                                   placeholder="<?= hintLang('last_name') ?>"
                                                   name="last_name" id="last_name"
                                                   minlength="2" maxlength="32" required>
                                        </div>
                                        <div class="form-group">
                                            <label><?= inputLang('web_page') ?></label>
                                            <input type="url" class="form-control"
                                                   placeholder="<?= hintLang('web_page') ?>"
                                                   name="web_page" id="web_page" maxlength="128">
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
            <div class="modal fade" id="modal-force-request-submission-full-paper">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content bg-success">
                        <div class="modal-header">
                            <h4 class="modal-title">
                                <?= uiLang('force_request_submission_full_paper') ?>
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form action="/api.php" method="post" onsubmit="return checkForm(this)"
                                  id="form-force-request-submission-full-paper"
                                  modal-loader="modal-force-request-submission-full-paper">
                                <input type="hidden" name="call_category" value="request-submission-full-paper">
                                <input type="hidden" name="call_request" value="force-confirm">

                                <div id="message"></div>

                                <input type="hidden" name="id" value="<?= $submissionID ?>">

                                <div class="form-group">
                                    <p class="objectName"></p>
                                    <p><?= uiLang('force_request_full_paper_are_you_sure') ?></p>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default"><?= uiLang('confirm') ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal-submission-comment">
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
            <div class="modal fade" id="modal-submission-delete">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content bg-danger">
                        <div class="modal-header">
                            <h4 class="modal-title">
                                <?= uiLang('delete_submissions') ?>
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form action="/api.php" method="post" onsubmit="return checkForm(this)" id="form-submission-delete"
                                  submit-datatable="submissions"
                                  modal-loader="modal-submission-delete">
                                <input type="hidden" name="call_category" value="submission">
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
            <div class="modal fade" id="modal-submission-message">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content bg-primary">
                        <div class="modal-header">
                            <h4 class="modal-title">
                                <?= uiLang('submission_messages') ?>
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form action="/api.php" method="post" onsubmit="return checkForm(this)" id="form-submission-insert"
                                  submit-datatable="submission_messages"
                                  modal-loader="modal-submission-insert">
                                <input type="hidden" name="call_category" value="submission">
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
            <div class="modal fade" id="modal-submission-comment-complete">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content bg-success">
                        <div class="modal-header">
                            <h4 class="modal-title">
                                <?= uiLang('complete_task') ?>
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form action="/api.php" method="post" onsubmit="return checkForm(this)"
                                  id="form-submission-comment-complete"
                                  submit-datatable="submissionComments"
                                  modal-loader="modal-submission-comment-complete">
                                <input type="hidden" name="call_category" value="submission-comment">
                                <input type="hidden" name="call_request" value="set_completed">

                                <div id="message"></div>

                                <input type="hidden" name="id">

                                <div class="form-group">
                                    <p class="objectName"></p>
                                    <p><?= uiLang('set_complete_are_you_sure') ?></p>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default"><?= uiLang('confirm') ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal-submission-comment-canceled">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content bg-warning">
                        <div class="modal-header">
                            <h4 class="modal-title">
                                <?= uiLang('canceled_task') ?>
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form action="/api.php" method="post" onsubmit="return checkForm(this)"
                                  id="form-submission-comment-canceled"
                                  submit-datatable="submissionComments"
                                  modal-loader="modal-submission-comment-canceled">
                                <input type="hidden" name="call_category" value="submission-comment">
                                <input type="hidden" name="call_request" value="set_canceled">

                                <div id="message"></div>

                                <input type="hidden" name="id">

                                <div class="form-group">
                                    <p class="objectName"></p>
                                    <p><?= uiLang('set_canceled_are_you_sure') ?></p>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default"><?= uiLang('confirm') ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal-submission-comment-pending">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content bg-info">
                        <div class="modal-header">
                            <h4 class="modal-title">
                                <?= uiLang('pending_task') ?>
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form action="/api.php" method="post" onsubmit="return checkForm(this)"
                                  id="form-submission-comment-pending"
                                  submit-datatable="submissionComments"
                                  modal-loader="modal-submission-comment-pending">
                                <input type="hidden" name="call_category" value="submission-comment">
                                <input type="hidden" name="call_request" value="set_pending">

                                <div id="message"></div>

                                <input type="hidden" name="id">

                                <div class="form-group">
                                    <p class="objectName"></p>
                                    <p><?= uiLang('set_pending_are_you_sure') ?></p>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default"><?= uiLang('confirm') ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal-submission-comment-insert">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content bg-success">
                        <div class="modal-header">
                            <h4 class="modal-title">
                                <?= uiLang('submission_comment_insert') ?>
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form action="/api.php" method="post" onsubmit="return checkForm(this)"
                                  id="form-submission-comment-insert"
                                  submit-datatable="submissionComments"
                                  modal-loader="modal-submission-comment-insert">
                                <input type="hidden" name="call_category" value="submission-comment">
                                <input type="hidden" name="call_request" value="insert">

                                <div id="message"></div>

                                <input type="hidden" name="id" value="<?=$submissionID?>" const="true">

                                <div class="form-group">
                                    <label><?=uiLang("message")?></label>
                                    <textarea class="form-control" name="message" placeholder="<?=hintLang("message")?>" required></textarea>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-default"><?= uiLang('insert') ?></button>
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
    var isAdmin = <?=$user->isAdmin()?>;

    var arrLogs = [];
    var arrSubmissionsComment = [];
    var itemList = [];
</script>

<script>
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
        $('#first_name').val(objData.first_name);
        $('#last_name').val(objData.last_name);
        $('#country').val(objData.country);
        $('#web_page').val(objData.web_page);
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
                    first_name: $('#first_name').val(),
                    last_name: $('#last_name').val(),
                    country: $('#country').val(),
                    web_page: $('#web_page').val(),
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
            html += '<input type="hidden" name="users[]" value="' + itemList[i].first_name + DEFAULT_HTML_SPLITTER + itemList[i].last_name + DEFAULT_HTML_SPLITTER + itemList[i].email + DEFAULT_HTML_SPLITTER + itemList[i].country + DEFAULT_HTML_SPLITTER + itemList[i].organization + DEFAULT_HTML_SPLITTER + itemList[i].web_page + DEFAULT_HTML_SPLITTER + itemList[i].corresponding + DEFAULT_HTML_SPLITTER + itemList[i].joined + '">';
        }

        $('#divUsers').html(html);
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

        $('#logs').DataTable({
            'processing': true,
            'serverSide': true,
            'ordering': true,
            'paging': true,
            'searching': true,
            "info" : true,
            "deferLoading": 0,
            'serverMethod': 'post',
            'columns': [
                {'data': 'log_id'},
                {'data': 'log_text'},
                {'data': 'ownerFullName'},
                {'data': 'log_created_at'}
            ],
            'ajax': {
                'url': 'api.php',
                'type': 'post',
                'dataType': 'json',
                'data': {
                    'call_category': 'submission',
                    'call_request': 'logs',
                    'id': '<?=$submissionID?>',
                },
                'dataSrc': function (json) {

                    for(var i = 0; i < json.data.length; i++){
                        if(json.data[i].ownerFullName == null || json.data[i].ownerFullName == ''){
                            json.data[i].ownerFullName = langSystemAccount;
                        }
                    }

                    arrLogs = json.data;

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
                    'next': '<?=uiLang("dt_next")?>'
                }
            }
        });

        $('#submissionComments').DataTable({
            'processing': true,
            'serverSide': true,
            'ordering': true,
            'paging': true,
            'searching': true,
            'info': true,
            'deferLoading': 0,
            'lengthMenu': [[10, 25, 50, 100, 400], [10, 25, 50, 100, 400]],
            'serverMethod': 'post',
            'columns': [
                {'data': 'submission_comment_id'},
                {'data': 'submission_comment_submission'},
                {'data': 'submission_comment_message'},
                {'data': 'submission_comment_created_at'},
                {'data': 'submission_comment_fullName'},
                {'data': 'submission_comment_status'},
                {'data': 'options', 'orderable': false}
            ],
            'ajax': {
                'url': 'api.php',
                'type': 'post',
                'dataType': 'json',
                'data': {
                    'call_category': 'submission-comment',
                    'call_request': 'data-tables',
                    'submission': '<?=$submissionID?>',
                },
                'dataSrc': function (json) {
                    for (var i = 0; i < json.data.length; i++) {
                        json.data[i].options = '<div class="btn-group" role="group"><button id="btnGroupDropSubmission" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=uiLang("dropdown")?></button><div class="dropdown-menu" aria-labelledby="btnGroupDropSubmission">';
                        json.data[i].options += '<a class="dropdown-item text-primary" onclick="showCommentSubmission(' + i +  ')" title="<?=uiLang("submission_message_view")?>"><span class="fas fa-list"></span> <?=uiLang("submission_message_view")?></a>';

                        //Status 0 => Beklemede, 1 => Tamamlandı, 2 => İptal Edildi

                        var drawComplete = false, drawCancel = false, drawPending = false;

                        switch (json.data[i].submission_comment_status) {
                            case '0':
                                drawComplete = true;
                                drawCancel = true;
                                break;
                            case '1':
                                drawPending = true;
                                break;
                            case '2':
                                drawPending = true;
                                break;
                        }

                        if (drawComplete && isAdmin) {
                            json.data[i].options += '<a class="dropdown-item text-success" onclick="showCompleteTask(' +  json.data[i].submission_comment_id + ')" title="<?=uiLang("complete_task")?>"><span class="fas fa-check"></span> <?=uiLang("complete_task")?></a>';
                        }

                        if (drawPending && isAdmin) {
                            json.data[i].options += '<a class="dropdown-item text-info" onclick="showPendingTask(' + json.data[i].submission_comment_id + ')" title="<?=uiLang("pending_task")?>"><span class="fas fa-reply"></span> <?=uiLang("pending_task")?></a>';
                        }

                        if (drawCancel && isAdmin) {
                            json.data[i].options += '<a class="dropdown-item text-danger" onclick="showCancelTask(' + json.data[i].submission_comment_id  + ')" title="<?=uiLang("cancel_task")?>"><span class="fas fa-times"></span> <?=uiLang("cancel_task")?></a>';
                        }

                        switch (json.data[i].submission_comment_status) {
                            case '0':
                                json.data[i].submission_comment_status = '<?= uiLang("status_pending")?>';
                                break;
                            case '1':
                                json.data[i].submission_comment_status = '<?= uiLang("status_completed")?>';
                                break;
                            case '2':
                                json.data[i].submission_comment_status = '<?= uiLang("status_canceled")?>';
                                break;
                        }

                        json.data[i].options += '</div></div>';
                    }

                    arrSubmissionsComment = json.data;

                    $('#divSubmissionComments').show();

                    window.location.href = '#divSubmissionComments';

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

                if(response.data.submission_full_paper != null){
                    if(response.data.submission_full_paper == -1){
                        $('#showFileFullPaper').removeAttr("href").show();
                    }else{
                        $('#showFileFullPaper').attr("href", "<?=Config::PATH_UPLOAD_DOCUMENT?>" + response.data.submission_full_paper).show();
                    }
                }

                if(response.data.submission_invoice != null){
                    if(response.data.submission_invoice == -1){
                        $('#showFileInvoice').removeAttr("href").show();
                    }else{
                        $('#showFileInvoice').attr("href", "<?=Config::PATH_UPLOAD_DOCUMENT?>" + response.data.submission_invoice).show();
                    }
                }
                //
                // loadInputsFromObject('form-user-preferences-update', response.data, 'user_');
                // hideCardOverlay($('#form-user-preferences-update'));
            },
            'error': function () {
                //todo
            }
        });
    });

    function uploadInvoice(){
        $('#form-invoice-insert').find('#message').html('');

        if(!$('#fileURL')[0].files){
            $('#btnInvoice').attr('disabled');
            return;
        }

        showCardOverlay($('#form-invoice-insert'));

        //https://stackoverflow.com/a/53891063
        let files = new FormData();
        files.append('file', $('#fileURL')[0].files[0]);
        files.append("call_category", "upload-file");
        files.append("call_request", "document");

        $.ajax({
            type: 'post',
            url: "api.php",
            processData: false,
            contentType: false,
            data: files,
            dataType: 'json',
            success: function (response) {
                if(response.status){
                    $('#invoice').val(response.data);
                }else{
                    formError($('#form-invoice-insert'), response.message);
                }

                $('#btnInvoice').removeAttr('disabled');

                hideCardOverlay($('#form-invoice-insert'));
            },
            error: function (err) {
                formError($('#form-invoice-insert'), "<?=uiLang('error_upload_invoice')?>");

                $('#btnInvoice').attr('disabled');

                hideCardOverlay($('#form-invoice-insert'));
            }
        });
    }

    function uploadFullPaper(){
        $('#form-full-paper-insert').find('#message').html('');

        if(!$('#fileURLFullPaper')[0].files){
            $('#btnFullPaper').attr('disabled');
            return;
        }

        showCardOverlay($('#form-full-paper-insert'));

        //https://stackoverflow.com/a/53891063
        let files = new FormData();
        files.append('file', $('#fileURLFullPaper')[0].files[0]);
        files.append("call_category", "upload-file");
        files.append("call_request", "document");

        $.ajax({
            type: 'post',
            url: "api.php",
            processData: false,
            contentType: false,
            data: files,
            dataType: 'json',
            success: function (response) {
                if(response.status){
                    $('#full_paper').val(response.data);
                }else{
                    formError($('#form-full-paper-insert'), response.message);
                }

                $('#btnFullPaper').removeAttr('disabled');

                hideCardOverlay($('#form-full-paper-insert'));
            },
            error: function (err) {
                formError($('#form-full-paper-insert'), "<?=uiLang('error_upload_full_paper')?>");

                $('#btnFullPaper').attr('disabled');

                hideCardOverlay($('#form-full-paper-insert'));
            }
        });
    }

    function showInvoiceButton(URL){
        $('#showFileInvoice').attr("href", "<?=Config::PATH_UPLOAD_DOCUMENT?>" + $('#invoice').val()).show();
    }

    function showFullPaperButton(URL){
        $('#showFileFullPaper').attr("href", "<?=Config::PATH_UPLOAD_DOCUMENT?>" + $('#full_paper').val()).show();
    }

    function showCommentSubmission(index) {
        $($('#modal-submission-comment').find('.modal-header')).html(arrSubmissionsComment[index].submission_comment_id);
        $($('#modal-submission-comment').find('.modal-body')).html('<p>' + arrSubmissionsComment[index].submission_comment_message + '</p>');

        $('#modal-submission-comment').modal('show');
    }

    function showDeleteSubmission(index) {
        loadInputsFromObject('form-submission-delete', arrSubmissions[index], 'submission_', 'id');

        $('#modal-submission-delete').modal('show');
    }

    function showCompleteTask(submissionCommentID) {
        //todo

        loadInputsFromObject('form-submission-comment-complete', {submission_comment_id: submissionCommentID}, 'submission_comment_', 'message');

        $('#modal-submission-comment-complete').modal();
    }

    function showPendingTask(submissionCommentID) {
        //todo

        loadInputsFromObject('form-submission-comment-pending', {submission_comment_id: submissionCommentID}, 'submission_comment_', 'message');

        $('#modal-submission-comment-pending').modal();
    }

    function showCancelTask(submissionCommentID) {
        //todo

        loadInputsFromObject('form-submission-comment-canceled', {submission_comment_id: submissionCommentID}, 'submission_comment_', 'message');

        $('#modal-submission-comment-canceled').modal();
    }

    function showInsertTask(){
        clearForm($("#form-submission-comment-insert"));

        $("#modal-submission-comment-insert").modal();
    }
</script>