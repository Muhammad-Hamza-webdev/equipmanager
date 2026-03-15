<!DOCTYPE html>
<html lang="en" class="minimal-theme">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="<?=base_url()?>assets/images/logo-icon.png" type="image/png" />
    
    <?php if ($user_type == 2 || $user_type == 3): ?>
        <!-- Admin Dashboard CSS -->
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
    <?php else: ?>
        <!-- Website CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/style.css" />
        <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/header.css" />
        <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/footer.css" />
        <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/resopnsive.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <?php endif; ?>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    
    <title>My Chats - Equip Manager</title>
    
    <style>
        :root {
            --primary-brand: #13372E;
            --accent-green: #2A7A66;
            --text-primary: #1A1A1A;
            --text-secondary: #6B7280;
            --text-light: #FFFFFF;
            --body-bg: #F5F6F8;
            --card-bg: #FFFFFF;
            --border-color: #E5E7EB;
            --shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            --table-shadow: 0px 4px 12px rgba(0, 0, 0, 0.05);
        }

        body {
            background-color: var(--body-bg);
            font-family: "Manrope", sans-serif;
            margin: 0;
            padding: 0;
        }

        .main-wrapper {
            padding: 0 40px;
            max-width: 1600px;
            margin: 0 auto;
        }

        .dashboard-container {
            display: flex;
            gap: 0;
            min-height: calc(100vh - 200px);
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .dashboard-content {
            flex: 1;
            background-color: var(--body-bg);
            padding: 40px;
            overflow-y: auto;
        }

        @media (max-width: 1024px) {
            .dashboard-container {
                flex-direction: column;
            }

            .dashboard-content {
                padding: 24px;
            }
        }

        @media (max-width: 480px) {
            .main-wrapper {
                padding: 0 16px;
            }

            .dashboard-content {
                padding: 16px;
            }
        }

        /* Admin Layout Specific - Minimal overrides only */
        .wrapper .page-content {
            padding: 10px 16px !important;
        }

        .wrapper .page-breadcrumb {
            margin-bottom: 2px !important;
            padding: 0 !important;
        }

        .wrapper .page-content .row {
            margin: 0 !important;
        }

        .wrapper .page-content .col-12 {
            padding: 0 !important;
        }

        /* Override chats-card padding for compact admin view */
        .wrapper .page-content .chats-card {
            padding: 12px !important;
            margin: 0 !important;
        }

        .wrapper .page-content .chats-header-section {
            margin-bottom: 10px !important;
        }

        .chats-title {
            font-size: 18px !important;
            font-weight: 600 !important;
        }
    </style>
</head>
<body>
    <?php if ($user_type == 2 || $user_type == 3): ?>
        <!-- Admin Layout for Company Admin / Manager -->
        <div class="wrapper">
            <?php $this->load->view('components/header'); ?>
            <?php $this->load->view('components/sidemenu'); ?>
            
            <main class="page-content" id="admin-chat-container">
                <!-- Breadcrumb -->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center" style="margin-bottom: 8px;">
                    <div class="breadcrumb-title pe-3" style="border: none; font-size: 14px;">My Chats</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0" style="font-size: 12px;">
                                <li class="breadcrumb-item"><a href="<?= base_url('company-dashboard') ?>"><i class="bx bx-home-alt"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Chats</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                
                <!-- Chats Content -->
                <div class="row">
                    <div class="col-12">
                        <?php $this->load->view('chats/list_view'); ?>
                    </div>
                </div>
            </main>
            
            <div class="overlay nav-toggle-icon"></div>
            <a href="javaScript:;" class="back-to-top"><i class="bx bxs-up-arrow-alt"></i></a>
        </div>
    <?php else: ?>
        <!-- Website Layout for Regular Users -->
        <?php $this->load->view('components/websiteHeader'); ?>

        <div class="main-wrapper">
            <!-- Main Dashboard Container -->
            <div class="dashboard-container">
                <!-- Dashboard Sidebar Component -->
                <?php $this->load->view('components/dashboardSidebar', ['active_page' => 'chats']); ?>

                <!-- Main Content -->
                <main class="dashboard-content">
                    <?php $this->load->view('chats/list_view'); ?>
                </main>
            </div>
        </div>

        <!-- Website Footer -->
        <?php $this->load->view('components/websiteFooter'); ?>
    <?php endif; ?>

    <?php if ($user_type == 2 || $user_type == 3): ?>
        <!-- Admin Dashboard Scripts -->
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
    <?php else: ?>
        <!-- Website Scripts -->
        <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <?php endif; ?>
</body>
</html>
