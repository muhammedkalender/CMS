<? //https://stackoverflow.com/a/722395 ?>
<?php if ($user->isAdmin()): ?>
    <div class="col-md-3">
        <div class="form-group">
            <button class="btn btn-danger form-control" data-toggle="modal"
                    data-target="#modal-force-request-submission-invoice"><?= uiLang('force_request_submission_invoice') ?></button>
        </div>
    </div>
<?php endif; ?>