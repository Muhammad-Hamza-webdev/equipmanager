<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="<?= base_url() ?>assets/images/logo-icon.png" type="image/png" />
    
    <!-- Website CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/style.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/header.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/footer.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/resopnsive.css" />
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    
    <title>My Orders - Equip Manager</title>
    
    <style>
        :root {
            --primary-brand: #13372E;
            --accent-green: #13372E;
            --text-primary: #1A1A1A;
            --text-secondary: #6B7280;
            --text-light: #FFFFFF;
            --body-bg: #F5F6F8;
            --card-bg: #FFFFFF;
            --border-color: #E5E7EB;
            --shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            --table-shadow: 0px 4px 12px rgba(0, 0, 0, 0.05);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--body-bg);
            font-family: "Manrope", sans-serif;
        }

        .main-wrapper {
            padding: 0 40px;
            max-width: 1600px;
            margin: 0 auto;
            width: 100%;
        }

        .dashboard-container {
            display: flex;
            gap: 0;
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .dashboard-content {
            flex: 1;
            background-color: var(--body-bg);
            padding: 40px;
            display: flex;
            flex-direction: column;
        }

        @media (max-width: 1024px) {
            .dashboard-container {
                flex-direction: column;
            }

            .dashboard-content {
                padding: 24px;
            }

            .main-wrapper {
                padding: 0 16px;
            }
        }

        @media (max-width: 768px) {
            .main-wrapper {
                padding: 0 12px;
            }

            .dashboard-content {
                padding: 16px;
            }
        }

        @media (max-width: 480px) {
            .main-wrapper {
                padding: 0 8px;
            }

            .dashboard-content {
                padding: 12px;
            }
        }
    </style>
</head>
<body>
    <!-- Website Header -->
    <?php $this->load->view('components/websiteHeader'); ?>

    <div class="main-wrapper">
        <!-- Main Dashboard Container -->
        <div class="dashboard-container">
            <!-- Dashboard Sidebar Component -->
            <?php $this->load->view('components/dashboardSidebar', ['active_page' => 'orders']); ?>

            
            <!-- Main Content -->
            <main class="dashboard-content">
                <?php 
                // Prepare data for list_view.php
                $view_data = array(
                    'orders' => isset($orders) ? $orders : array(),
                );
                $this->load->view('orders/list_view', $view_data); 
                ?>
            </main>
        </div>
    </div>

    <!-- Website Footer -->
    <?php $this->load->view('components/websiteFooter'); ?>

    <!-- Scripts -->
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
</body>
</html>
