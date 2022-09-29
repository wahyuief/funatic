<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="<?php echo get_option('site_description'); ?>">
    <meta name="author" content="<?php echo get_option('author'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/plugins/fontawesome/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/plugins/notyf/notyf.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/plugins/summernote/summernote-bs4.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/plugins/select2/css/select2.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/css/adminlte.min.css') ?>">
    <style>
        <?php
        if (get_option('accent_color') === 'success') echo 'a{color:#28a745}a:hover{color:#288745}.page-item.active .page-link{background-color: #28a745;border-color: #28a745;}';
        if (get_option('accent_color') === 'primary') echo 'a{color:#007bff}a:hover{color:#000bff}.page-item.active .page-link{background-color: #007bff;border-color: #007bff;}';
        if (get_option('accent_color') === 'warning') echo 'a{color:#ffc107}a:hover{color:#ffa107}.page-item.active .page-link{background-color: #ffc107;border-color: #ffc107;}';
        if (get_option('accent_color') === 'danger') echo 'a{color:#dc3545}a:hover{color:#ac3545}.page-item.active .page-link{background-color: #dc3545;border-color: #dc3545;}';
        ?>
    </style>
    <script src="<?php echo base_url('assets/backend/plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/backend/plugins/summernote/summernote-bs4.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/backend/js/form-builder.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/backend/js/jquery-ui.min.js') ?>"></script>
    <script>
        var base_url = '<?php echo base_url(); ?>';
        var site_name = '<?php echo get_option('site_name'); ?>';
    </script>
</head>
<body class="layout-navbar-fixed layout-footer-fixed layout-fixed sidebar-mini">
    <div class="wrapper">