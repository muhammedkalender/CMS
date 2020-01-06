<body class="hold-transition sidebar-mini layout-fixed">
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="../../dist/img/logo.png"
             alt="Logo"
             class="brand-image"
             style="opacity: .8">
        <span class="brand-text font-weight-light"><?=COMPANY_NAME?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="<?= internalURL('user', 'profile', $user->id) ?>"
                   class="d-block"><i class="nav-icon fas fa-user"></i> <?= $user->getFullName() ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="/" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p><?= sidebarLang('home') ?></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= internalURL('user', 'profile', $user->id) ?>" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p><?= sidebarLang('profile') ?></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= internalURL('submission', 'show', $user->submissionID) ?>" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p><?= sidebarLang('my_submission') ?></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= internalURL('user', 'logout') ?>" class="nav-link">
                        <i class="fas fa-sign-out-alt nav-icon"></i>
                        <p><?= sidebarLang('exit') ?></p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<