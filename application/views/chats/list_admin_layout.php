<!DOCTYPE html>
<html lang="en" class="minimal-theme">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="<?=base_url()?>assets/images/logo-icon.png" type="image/png" />
    <!--plugins-->
    <link href="<?=base_url()?>assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="<?=base_url()?>assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="<?=base_url()?>assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?=base_url()?>assets/css/bootstrap-extended.css" rel="stylesheet" />
    <link href="<?=base_url()?>assets/css/style.css" rel="stylesheet" />
    <link href="<?=base_url()?>assets/css/icons.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <!-- loader-->
    <link href="<?=base_url()?>assets/css/pace.min.css" rel="stylesheet" />
    <!--Theme Styles-->
    <link href="<?=base_url()?>assets/css/dark-theme.css" rel="stylesheet" />
    <link href="<?=base_url()?>assets/css/light-theme.css" rel="stylesheet" />
    <link href="<?=base_url()?>assets/css/semi-dark.css" rel="stylesheet" />
    <link href="<?=base_url()?>assets/css/header-colors.css" rel="stylesheet" />
    
    <!-- Manrope Font -->
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">

    <title>My Chats - Equip Manager</title>
</head>

<body>
    <!--start wrapper-->
    <div class="wrapper">
        <?php $this->load->view('components/header'); ?>
        <?php $this->load->view('components/sidemenu'); ?>

        <!--start content-->
        <main class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">My Chats</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="<?= base_url('company-dashboard') ?>"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Chats</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

            <!-- Page Title -->
            <div class="page-title-section" style="margin-bottom: 30px;">
                <div class="page-title-container">
                    <div>
                        <h1 class="page-title">My Chats</h1>
                        <p class="page-subtitle">Manage your conversations and orders</p>
                    </div>
                </div>
            </div>

            <!-- Chats Content -->
            <div class="row">
                <div class="col-12">
                    <?php $this->load->view('chats/list_view'); ?>
                </div>
            </div>
        </main>
        <!--end page main-->

        <!--start overlay-->
        <div class="overlay nav-toggle-icon"></div>
        <!--end overlay-->

        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class="bx bxs-up-arrow-alt"></i></a>
        <!--End Back To Top Button-->
    </div>
    <!--end wrapper-->

    <!-- Bootstrap bundle JS -->
    <script src="<?=base_url()?>assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="<?=base_url()?>assets/js/jquery.min.js"></script>
    <script src="<?=base_url()?>assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="<?=base_url()?>assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="<?=base_url()?>assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="<?=base_url()?>assets/plugins/peity/jquery.peity.min.js"></script>
    <script src="<?=base_url()?>assets/js/index.js"></script>
    <script src="<?=base_url()?>assets/js/app.js"></script>
</body>
</html>
