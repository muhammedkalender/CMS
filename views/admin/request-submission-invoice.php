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
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><?= uiLang('request_submission_invoices') ?></h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="request-submission-invoices" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th><?= uiLang('id') ?></th>
                                <th><?= uiLang('submission') ?></th>
                                <th><?= uiLang('status') ?></th>
                                <th><?= uiLang('full_name') ?></th>
                                <th><?= uiLang('created_at') ?></th>
                                <th class="no-sort"><?= uiLang('options') ?></th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
    </section>
</div>
<div class="modal fade" id="modal-request-submission-invoice-confirm">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-success">
            <div class="modal-header">
                <h4 class="modal-title">
                    <?= uiLang('confirm_request_submission_invoice') ?>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="/api.php" method="post" onsubmit="return checkForm(this)"
                      id="form-request-submission-invoice-confirm"
                      submit-datatable="request-submission-invoices"
                      modal-loader="modal-request-submission-invoice-confirm">
                    <input type="hidden" name="call_category" value="request-submission-invoice">
                    <input type="hidden" name="call_request" value="confirm">

                    <div id="message"></div>

                    <input type="hidden" name="id">

                    <div class="form-group">
                        <p class="objectName"></p>
                        <p><?= uiLang('confirm_are_you_sure') ?></p>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-default"><?= uiLang('confirm') ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-request-submission-invoice-decline">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-warning">
            <div class="modal-header">
                <h4 class="modal-title">
                    <?= uiLang('decline_request_submission_invoice') ?>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="/api.php" method="post" onsubmit="return checkForm(this)"
                      id="form-request-submission-invoice-decline"
                      submit-datatable="request-submission-invoices"
                      modal-loader="modal-request-submission-invoice-decline">
                    <input type="hidden" name="call_category" value="request-submission-invoice">
                    <input type="hidden" name="call_request" value="decline">

                    <div id="message"></div>

                    <input type="hidden" name="id">

                    <div class="form-group">
                        <p class="objectName"></p>
                        <p><?= uiLang('decline_are_you_sure') ?></p>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-default"><?= uiLang('confirm') ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-request-submission-invoice-delete">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h4 class="modal-title">
                    <?= uiLang('delete_request_submission_invoice') ?>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="/api.php" method="post" onsubmit="return checkForm(this)"
                      id="form-request-submission-invoice-delete"
                      submit-datatable="request-submission-invoices"
                      modal-loader="modal-request-submission-invoice-delete">
                    <input type="hidden" name="call_category" value="request-submission-invoice">
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

<link rel="stylesheet" href="<?= folder() ?>plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<script src="<?= folder() ?>plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= folder() ?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<script>
    const USER_ID = <?=$user->id?>;
    const USER_FULL_NAME = '<?=$user->getFullName()?>';

    var arrRequestSubmissionInvoices = [];
</script>

<script>
    $(function () {
        $('#request-submission-invoices').DataTable({
            'processing': true,
            'serverSide': true,
            'ordering': true,
            'paging': true,
            'searching': true,
            'info': true,
            'lengthMenu': [[10, 25, 50, 100, 400], [10, 25, 50, 100, 400]],
            'serverMethod': 'post',
            'columns': [
                {'data': 'request_submission_invoice_id'},
                {'data': 'request_submission_invoice_submission'},
                {'data': 'request_submission_invoice_status'},
                {'data': 'request_submission_invoice_full_name'},
                {'data': 'request_submission_invoice_created_at'},
                {'data': 'options', 'orderable': false}
            ],
            'ajax': {
                'url': 'api.php',
                'type': 'post',
                'dataType': 'json',
                'data': {
                    'call_category': 'request-submission-invoice',
                    'call_request': 'data-tables'
                },
                'dataSrc': function (json) {
                    for (var i = 0; i < json.data.length; i++) {
                        json.data[i].request_submission_invoice_created_at = formatDMYOnlyDate(json.data[i].request_submission_invoice_created_at);

                        var status = '<?=uiLang("pending")?>';

                        if (json.data[i].request_submission_invoice_status == 2) {
                            status = '<?=uiLang("confirmed")?>';
                        } else if(json.data[i].request_submission_invoice_status == 1) {
                            status = '<?=uiLang("declined")?>';
                        }

                        json.data[i].request_submission_invoice_status = status;

                        json.data[i].options = '<div class="btn-group" role="group"><button id="btnGroupDropSubmission" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=uiLang("dropdown")?></button><div class="dropdown-menu" aria-labelledby="btnGroupDropSubmission">';
                        json.data[i].options += '<a class="dropdown-item text-primary" target="_blank" href="<?=Config::PATH_UPLOAD_DOCUMENT?>' + json.data[i].request_submission_invoice_url + '" title="<?=uiLang("download")?>"><span class="fas fa-download"></span> <?=uiLang("download")?></a>';
                        json.data[i].options += '<a class="dropdown-item text-success" onclick="showRequestSubmissionInvoiceConfirm(' + i + ')" title="<?=uiLang("confirm")?>"><span class="fas fa-check"></span> <?=uiLang("confirm")?></a>';
                        json.data[i].options += '<a class="dropdown-item text-warning" onclick="showRequestSubmissionInvoiceDecline(' + i + ')" title="<?=uiLang("decline")?>"><span class="fas fa-times"></span> <?=uiLang("decline")?></a>';
                        json.data[i].options += '<a class="dropdown-item text-danger" onclick="showRequestSubmissionInvoiceDelete(' + i + ')" title="<?=uiLang("delete")?>"><span class="fas fa-trash"></span> <?=uiLang("delete")?></a>';
                        json.data[i].options += '</div></div>';
                    }

                    arrRequestSubmissionInvoices = json.data;

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
    function showRequestSubmissionInvoiceConfirm(index) {
        loadInputsFromObject('form-request-submission-invoice-confirm', arrRequestSubmissionInvoices[index], 'request_submission_invoice_', 'id');

        $('#modal-request-submission-invoice-confirm').modal('show');
    }

    function showRequestSubmissionInvoiceDecline(index) {
        loadInputsFromObject('form-request-submission-invoice-decline', arrRequestSubmissionInvoices[index], 'request_submission_invoice_', 'id');

        $('#modal-request-submission-invoice-decline').modal('show');
    }

    function showRequestSubmissionInvoiceDelete(index) {
        loadInputsFromObject('form-request-submission-invoice-delete', arrRequestSubmissionInvoices[index], 'request_submission_invoice_', 'id');

        $('#modal-request-submission-invoice-delete').modal('show');
    }
</script>