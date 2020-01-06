<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="/"><b><?= COMPANY_NAME ?></b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <form action="/api.php" method="post" onsubmit="return checkForm(this)">
                <input type="hidden" name="call_category" value="user">
                <input type="hidden" name="call_request" value="forgot-password">

                <div id="message"></div>

                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="<?= inputLang('email') ?>" name="email"
                           minlength="3" maxlength="64" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block"><?= uiLang('send_password') ?></button>
                    </div>
                </div>
            </form>
            <p class="mb-1">
                <a href="<?= internalURL('user', 'login') ?>"><?= uiLang('login') ?></a>
            </p>
            <p class="mb-0">
                <a href="<?= internalURL('submission', 'insert') ?>" class="text-center"><?= uiLang('register') ?></a>
            </p>
        </div>
    </div>
</div>
