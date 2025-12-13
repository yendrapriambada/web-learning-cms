<!-- Favicon-->
<link rel="icon" href="<?= base_url();?>assets/logo/favicon.png" type="image/x-icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

<!-- Bootstrap Core Css -->
<link href="<?= base_url();?>assets_guru/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

<!-- Waves Effect Css -->
<link href="<?= base_url();?>assets_guru/plugins/node-waves/waves.css" rel="stylesheet" />

<!-- Animation Css -->
<link href="<?= base_url();?>assets_guru/plugins/animate-css/animate.css" rel="stylesheet" />

<!-- Morris Chart Css-->
<link href="<?= base_url();?>assets_guru/plugins/morrisjs/morris.css" rel="stylesheet" />

<!-- JQuery DataTable Css -->
<link href="<?= base_url();?>assets_guru/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

<!-- Bootstrap Select Css -->
<link href="<?= base_url();?>assets_guru/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

<!-- Custom Css -->
<link href="<?= base_url();?>assets_guru/css/style.css" rel="stylesheet">

<!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
<link href="<?= base_url();?>assets_guru/css/themes/all-themes.css" rel="stylesheet" />

<style>
    .chat-container {
        width: 100%;
        max-width: none;
        height: 80vh;
        border: 1px solid #dee2e6;
        border-radius: .25rem;
        background-color: #fff;
        display: flex;
        flex-direction: column;
    }
    .chat-header, .chat-footer {
        padding: 1rem;
        border-bottom: 1px solid #dee2e6;
        background-color:#FFFED3;
    }
    .chat-footer {
        border-top: 1px solid #dee2e6;
        border-bottom: 0;
    }
    .chat-body {
        flex: 1;
        padding: 1rem;
        overflow-y: auto;
    }
    .chat-message {
        margin-bottom: 1rem;
    }
    .chat-message .message-content {
        text-align: right;
        background-color: #f1f1f1;
        padding: .75rem;
        border-radius: .25rem;
    }

    .chat-message.sent .message-user {
        text-align: left;
        background-color: #0F67B1;
        color:white;
        padding: .75rem;
        border-radius: .25rem;
    }

    .chat-message .message-user {
        text-align: right;
        background-color: #0F67B1;
        color:white;
        padding: .75rem;
        border-radius: .25rem;
    }

    .chat-message.sent .message-content {
        text-align: left;
        background-color: #ccc;
        color: #fff;
    }

    .time-right {
        display: block;
        text-align:right;
        font-size:11px;
    }

    .time-left {
        display: block;
        text-align:left;
        font-size:11px;
    }
</style>