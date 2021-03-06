<div class="modal fade" id="modal-dialog-error">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-warning" data-dismiss="modal"><?= uiLang('confirm') ?></button>
            </div>
        </div>
    </div>
</div>

<script>
    var LANG_CODE = "<?=Lang::get("constants_code")?>";
    var DEFAULT_HTML_SPLITTER = "<?=DEFAULT_HTML_SPLITTER?>";
    var langErrorTitle = "<?=uiLang('error')?>";
    var langSuccessTitle = "<?=uiLang('success')?>";
    var langErrorSystem = "<?=uiLang('system_error')?>";
    var langStatusNothing = "<?=uiLang('status_nothing')?>";
    var langStatusPending = "<?=uiLang('status_pending')?>";
    var langStatusAccepted = "<?=uiLang('status_accepted')?>";
    var langStatusDeclined = "<?=uiLang('status_declined')?>";
    var langDialogErrorTitle = "<?=uiLang('dialog_error_title')?>";
    var langDefaultOption = "<?=uiLang('default_option')?>";
    var langAllOfThem = "<?=uiLang("all_of_them")?>";
    var langSystemAccount = "<?=uiLang("account_system")?>";
    var langSystemicalError = "<?=uiLang("systemical_error")?>";
</script>
<script>
    $(document).ready(function () {
        initialize();
    });
</script>
</body>
</html>