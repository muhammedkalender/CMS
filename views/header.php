<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title ?> - CMS</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= folder() ?>plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= folder() ?>plugins/fontawesome-free/css/core.css">
    <link rel="stylesheet" href="<?= folder() ?>dist/css/core.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= folder() ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= folder() ?>dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="<?= folder() ?>plugins/jquery/jquery.min.js"></script>
    <script src="<?= folder() ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= folder() ?>dist/js/adminlte.min.js"></script>
    <script src="<?= folder() ?>dist/js/core.js"></script>
</head>
<?php
if ($showSidebar && $user->isLogged()) {
    if ($user->isAdmin()) {
        require_once 'views/sidebar-admin.php';
    } else {
        require_once 'views/sidebar.php';
    }
}
?>