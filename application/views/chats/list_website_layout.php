<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Chats - Equip Manager</title>
    <!-- Website Styles -->
    <link rel="stylesheet" href="<?= base_url('assets/website/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/website/css/header.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/website/css/footer.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/website/css/resopnsive.css') ?>">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    
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
        }

        body {
            background-color: var(--body-bg);
            font-family: "Manrope", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
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
    </style>
</head>

<body>
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

    <?php $this->load->view('components/websiteFooter'); ?>

    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
</body>

</html>
