<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="<?=base_url()?>assets/images/logo-icon.png" type="image/png" />
    <!-- Website CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/style.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/header.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/footer.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/resopnsive.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <!-- Website Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <title>User Dashboard - EquipManager</title>
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
        }

        body {
            background-color: var(--body-bg);
            font-family: "Manrope", sans-serif;
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

        .summary-cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-bottom: 40px;
        }

        .summary-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 24px;
            text-align: center;
            box-shadow: var(--shadow);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            display: block;
            text-decoration: none;
            color: inherit;
        }

        .summary-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        }

        .card-icon {
            width: 64px;
            height: 64px;
            background-color: #13372E;
            border-radius: 50%;
            display: flex;
            align-items: center;    
            justify-content: center;
            margin: 0 auto 16px;
        }

        .card-icon i {
            color: #FFFFFF;
            font-size: 32px;
            font-weight: 600;
        }

        .card-label {
            font-size: 14px;
            color: var(--text-secondary);
            font-weight: 500;
            font-family: "Manrope", sans-serif;
        }

        .welcome-section {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 40px;
            box-shadow: var(--shadow);
        }

        .welcome-heading {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 12px;
            font-family: "Manrope", sans-serif;
        }

        .welcome-subtext {
            font-size: 16px;
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: 24px;
            max-width: 600px;
            font-family: "Manrope", sans-serif;
        }

        .view-orders-btn {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 24px 32px;
            border: none;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            display: inline-block;
            text-decoration: none;
            font-family: "Manrope", sans-serif;
            color: var(--accent-green);
            box-shadow: var(--shadow);
        }

        .view-orders-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
            color: var(--accent-green);
        }

        .main-wrapper {
            padding: 0 40px;
            max-width: 1600px;
            margin: 0 auto;
        }

        @media (max-width: 1024px) {
            .summary-cards {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .dashboard-container {
                flex-direction: column;
            }

            .dashboard-sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid var(--border-color);
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                padding: 16px 24px;
                border-radius: 0;
            }

            .sidebar-profile {
                border-bottom: none;
                padding: 0;
                text-align: left;
                flex-direction: row;
                align-items: center;
                gap: 16px;
                width: auto;
            }

            .profile-avatar {
                width: 60px;
                height: 60px;
                margin-bottom: 0;
            }

            .profile-name {
                margin-bottom: 2px;
            }

            .profile-email {
                margin-bottom: 0;
                font-size: 12px;
            }

            .logout-btn {
                width: auto;
                padding: 8px 16px;
            }

            .sidebar-nav {
                display: none;
            }

            .dashboard-content {
                padding: 24px;
            }

            .summary-cards {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
                margin-bottom: 24px;
            }

            .welcome-section {
                padding: 24px;
            }

            .welcome-heading {
                font-size: 24px;
            }

            .main-wrapper {
                padding: 0 20px;
            }
        }

        @media (max-width: 480px) {
            .summary-cards {
                grid-template-columns: 1fr;
            }

            .welcome-heading {
                font-size: 20px;
            }

            .welcome-subtext {
                font-size: 14px;
            }

            .main-wrapper {
                padding: 0 16px;
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
            <?php $this->load->view('components/dashboardSidebar', ['active_page' => 'dashboard']); ?>

            <!-- Main Content -->
            <main class="dashboard-content">
                <!-- Summary Cards -->
                <div class="summary-cards">
                    <a href="<?= base_url('orders') ?>" class="summary-card" style="cursor: pointer; text-decoration: none; color: inherit;">
                        <div class="card-icon">
                            <i class="bi bi-bag"></i>
                        </div>
                        <div class="card-label">All Orders</div>
                    </a>

                    <a href="<?= base_url('orders?status=completed') ?>" class="summary-card" style="cursor: pointer; text-decoration: none; color: inherit;">
                        <div class="card-icon">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <div class="card-label">Completed Orders</div>
                    </a>

                    <a href="<?= base_url('chats') ?>" class="summary-card" style="cursor: pointer; text-decoration: none; color: inherit;">
                        <div class="card-icon">
                            <i class="bi bi-chat-dots"></i>
                        </div>
                        <div class="card-label">Chats</div>
                    </a>

                    <a href="<?= base_url('settings') ?>" class="summary-card" style="cursor: pointer; text-decoration: none; color: inherit;">
                        <div class="card-icon">
                            <i class="bi bi-gear"></i>
                        </div>
                        <div class="card-label">Settings</div>
                    </a>
                </div>

                <!-- Welcome Section -->
                <div class="welcome-section">
                    <?php 
                        $login_data = $this->session->userdata('loginData');
                        $user_name = isset($login_data['userName']) ? $login_data['userName'] : 'User';
                    ?>
                    <h1 class="welcome-heading">Welcome Back, <?= htmlspecialchars($user_name) ?> 👋</h1>
                    <p class="welcome-subtext">
                        We're happy to see you again! From your dashboard, you can easily manage your recent orders, update your account details, and track your purchases.
                    </p>
                    <a href="<?= base_url('orders') ?>" class="view-orders-btn">View My Orders</a>
                </div>
            </main>
        </div>
    </div>

    <!-- Website Footer -->
    <?php $this->load->view('components/websiteFooter'); ?>

    <!-- Scripts -->
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script>
        function logoutUser() {
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = '<?= base_url('logout') ?>';
            }
        }

        function navigateTo(page) {
            window.location.href = '<?= base_url() ?>' + page;
        }
    </script>
</body>
</html>
