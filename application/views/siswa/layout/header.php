<!-- bootstrap css -->
<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets_siswa/css/bootstrap.min.css">

<!-- style css -->
<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets_siswa/css/style.css">
<!-- Responsive-->
<link rel="stylesheet" href="<?= base_url();?>assets_siswa/css/responsive.css">
<!-- fevicon -->
<link rel="icon" href="<?= base_url();?>assets/logo/favicon.png" type="image/gif" />
<!-- Scrollbar Custom CSS -->
<link rel="stylesheet" href="<?= base_url();?>assets_siswa/css/jquery.mCustomScrollbar.min.css">
<!-- Tweaks for older IEs-->
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
<!-- fonts -->
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;800&family=Sen:wght@400;700;800&display=swap" rel="stylesheet">
<!-- Datatables -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
<!-- Canva -->
<link rel="stylesheet" href="<?= base_url();?>assets/canva/canva.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Canva -->
<script src="<?= base_url();?>assets/canva/canva.js" defer></script>
<script src="https://kit.fontawesome.com/c353d71a36.js" crossorigin="anonymous"></script>

<!-- CHAT -->
<style>
    .chat-container {
        width: 100%;
        max-width: none;
        height: 100vh;
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
    
      .dropdown-submenu {
      position: relative;
  }
  .dropdown-submenu .dropdown-menu {
      top: 0;
      left: 100%;
      margin-top: -1px;
  }
</style>