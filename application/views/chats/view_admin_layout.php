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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        main.page-content {
            padding-top: 8px;
        }

        .chat-interface-container {
            background: var(--card-bg);
            border-radius: 12px;
            box-shadow: var(--table-shadow);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            height: 600px;
            max-height: 70vh;
            margin-top: 12px;
        }

        /* Hide add button */
        .add-button {
            display: none !important;
        }

        /* Chat container structure */
        :host {
            display: contents;
        }

        /* Header panel anchored next to sidebar */
        .chat-header-panel {
            background: var(--card-bg);
            border-bottom: 1px solid var(--border-color);
            padding: 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }

        .chat-header-panel .back-btn {
            background: var(--primary-brand);
            color: var(--text-light);
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: background 0.2s ease;
        }

        .chat-header-panel .back-btn:hover {
            background: var(--accent-green);
        }

        .chat-header-panel .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 1;
            min-width: 0;
        }

        .chat-header-panel .user-avatar-small {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary-brand);
            flex-shrink: 0;
        }

        .chat-header-panel .user-info-text {
            display: flex;
            flex-direction: column;
            gap: 2px;
            min-width: 0;
        }

        .chat-header-panel .user-name-text {
            font-size: 15px;
            font-weight: 700;
            color: var(--text-primary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .chat-header-panel .user-order-text {
            font-size: 12px;
            color: var(--text-secondary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .chat-header-panel .status-badge-small {
            background: #e6f7f0;
            color: #0d7a2c;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        /* Hide inner chat header from view.php to avoid double top bars in admin layout */
        .chat-header {
            display: none;
            padding: 20px 32px;
            border-bottom: 1px solid var(--border-color);
            align-items: center;
            gap: 16px;
            background: var(--card-bg);
            flex-shrink: 0;
        }

        /* Force-hide chat header defined inside view.php (stronger specificity) */
        .chat-interface-container .chat-header {
            display: none !important;
        }

        .back-button {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.2s ease;
        }

        .back-button:hover {
            opacity: 0.7;
        }

        .chat-header-info {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1;
        }

        .user-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-light);
            font-weight: bold;
            font-size: 18px;
            flex-shrink: 0;
        }

        .user-details {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .user-name {
            font-weight: 700;
            font-size: 16px;
            color: var(--text-primary);
        }

        .user-status {
            font-size: 13px;
            color: var(--text-secondary);
        }

        .status-badge {
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
            border: 1px solid transparent;
            margin-left: auto;
            flex-shrink: 0;
        }

        .status-badge.open {
            background: #e6f7f0;
            color: #0d7a2c;
            border-color: rgba(13, 122, 44, 0.2);
        }

        .status-badge.locked {
            background: #fff5f5;
            color: #d32f2f;
            border-color: rgba(211, 47, 47, 0.2);
        }

        /* Messages area - FIXED HEIGHT with scrolling */
        .messages-area {
            flex: 1;
            padding: 24px 32px;
            overflow-y: auto;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            gap: 16px;
            background: var(--card-bg);
            min-height: 300px;
        }

        /* Custom Scrollbar */
        .messages-area::-webkit-scrollbar {
            width: 8px;
        }

        .messages-area::-webkit-scrollbar-track {
            background: transparent;
        }

        .messages-area::-webkit-scrollbar-thumb {
            background: #D1D5DB;
            border-radius: 10px;
            background-clip: padding-box;
        }

        .messages-area::-webkit-scrollbar-thumb:hover {
            background: #9CA3AF;
        }

        .date-separator {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            margin: 8px 0;
            flex-shrink: 0;
        }

        .date-separator span {
            font-size: 12px;
            color: #9CA3AF;
            background: var(--card-bg);
            padding: 0 16px;
            z-index: 1;
            position: relative;
        }

        .date-separator::before {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            top: 50%;
            border-bottom: 1px solid #F3F4F6;
            z-index: 0;
        }

        .message-wrapper {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            width: 100%;
            flex-shrink: 0;
        }

        .message-wrapper.incoming {
            justify-content: flex-start;
        }

        .message-wrapper.outgoing {
            justify-content: flex-end;
        }

        .message-options {
            width: 20px;
            height: 20px;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            transition: opacity 0.2s ease;
            flex-shrink: 0;
        }

        .message-wrapper:hover .message-options {
            opacity: 1;
        }

        .message-content {
            display: flex;
            flex-direction: column;
            gap: 4px;
            max-width: 70%;
        }

        .message-bubble {
            padding: 12px 16px;
            border-radius: 12px;
            word-wrap: break-word;
            font-size: 15px;
            line-height: 1.4;
            min-width: 0;
        }

        .message-bubble.incoming {
            background: #F3F4F6;
            color: var(--text-primary);
            border-bottom-left-radius: 4px;
        }

        .message-bubble.outgoing {
            background: var(--primary-brand);
            color: var(--text-light);
            border-bottom-right-radius: 4px;
        }

        .message-timestamp {
            font-size: 12px;
            color: var(--text-secondary);
            padding: 0 8px;
        }

        .message-wrapper.outgoing .message-timestamp {
            text-align: right;
            color: #9CA3AF;
        }

        .read-receipt {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 8px;
        }

        .no-messages {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            text-align: center;
            gap: 16px;
            padding: 40px;
        }

        .no-messages i, .no-messages svg {
            font-size: 56px;
            opacity: 0.25;
            color: var(--primary-brand);
        }

        .no-messages p {
            font-size: 15px;
            margin: 0;
            font-weight: 500;
            color: var(--text-primary);
        }

        .no-messages p:last-child {
            font-size: 13px;
            color: var(--text-secondary);
            font-weight: 400;
        }

        /* Input Area */
        .chat-input-area {
            padding: 20px 32px;
            border-top: 1px solid var(--border-color);
            background: var(--card-bg);
            flex-shrink: 0;
            display: flex;
            gap: 12px;
            align-items: flex-end;
        }

        .input-button {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            border: none;
            background: var(--primary-brand);
            color: var(--text-light);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }

        .input-button:hover:not(:disabled) {
            background: var(--accent-green);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(19, 55, 46, 0.3);
        }

        .input-button:active:not(:disabled) {
            transform: translateY(0);
        }

        .input-button:disabled {
            background: #D1D5DD;
            cursor: not-allowed;
            color: #9CA3AF;
        }

        .add-button {
            background: #E5E7EB;
            color: var(--text-primary);
        }

        .add-button:hover:not(:disabled) {
            background: #D1D5DD;
        }

        .message-input {
            flex: 1;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            font-size: 15px;
            font-family: inherit;
            color: var(--text-primary);
            outline: none;
            transition: all 0.2s ease;
            resize: none;
            max-height: 100px;
        }

        .message-input:focus {
            border-color: var(--primary-brand);
            box-shadow: 0 0 0 3px rgba(19, 55, 46, 0.1);
        }

        .message-input::placeholder {
            color: var(--text-secondary);
        }

        .message-input:disabled {
            background: #F3F4F6;
            color: var(--text-secondary);
            cursor: not-allowed;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .chat-header {
                padding: 16px 24px;
                gap: 12px;
            }

            .user-avatar {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }

            .user-name {
                font-size: 15px;
            }

            .user-status {
                font-size: 12px;
            }

            .messages-area {
                padding: 16px 20px;
            }

            .message-content {
                max-width: 85%;
            }

            .chat-input-area {
                padding: 16px 20px;
                gap: 10px;
            }

            .input-button {
                width: 36px;
                height: 36px;
            }

            .message-input {
                padding: 10px 12px;
                font-size: 14px;
            }

            .chat-interface-container {
                height: 500px;
                max-height: 65vh;
            }
        }

        @media (max-width: 768px) {
            .chat-header {
                padding: 12px 16px;
                flex-wrap: wrap;
            }

            .back-button {
                width: 32px;
                height: 32px;
            }

            .user-avatar {
                width: 36px;
                height: 36px;
            }

            .user-name {
                font-size: 14px;
            }

            .user-status {
                font-size: 11px;
            }

            .status-badge {
                padding: 4px 10px;
                font-size: 10px;
            }

            .messages-area {
                padding: 12px 16px;
                gap: 12px;
            }

            .message-content {
                max-width: 100%;
            }

            .message-bubble {
                padding: 10px 14px;
                font-size: 14px;
            }

            .chat-input-area {
                padding: 12px 16px;
                gap: 8px;
            }

            .input-button {
                width: 32px;
                height: 32px;
                font-size: 16px;
            }

            .message-input {
                padding: 10px 12px;
                font-size: 14px;
            }

            .chat-interface-container {
                height: 450px;
                max-height: 60vh;
            }
        }

        @media (max-width: 480px) {
            .chat-header {
                padding: 12px 16px;
            }

            .chat-interface-container {
                height: 400px;
                max-height: 55vh;
            }

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
    <!--start wrapper-->
    <div class="wrapper">
        <?php $this->load->view('components/header'); ?>
        <?php $this->load->view('components/sidemenu'); ?>

        <!--start content-->
        <main class="page-content">
            <!-- Chat Header Panel aligned to sidebar -->
            <div class="chat-header-panel">
                <a href="<?= base_url('chats') ?>" class="back-btn">
                    <i class="bx bx-arrow-back"></i>
                    Back
                </a>
                <div class="user-info">
                    <div class="user-avatar-small"></div>
                    <div class="user-info-text">
                        <div class="user-name-text">
                            <?php if (isset($user_role) && $user_role === 'buyer'): ?>
                                <?= isset($chat->sellerCompanyName) ? htmlspecialchars($chat->sellerCompanyName) : 'Seller' ?>
                            <?php else: ?>
                                <?= isset($chat->buyerFirstName, $chat->buyerLastName) ? htmlspecialchars(trim($chat->buyerFirstName . ' ' . $chat->buyerLastName)) : 'User' ?>
                            <?php endif; ?>
                        </div>
                        <div class="user-order-text">Order #<?= isset($chat) ? $chat->equipmentPaymentID : 'N/A' ?> • $<?= isset($chat) ? number_format($chat->grossAmount, 2) : '0.00' ?></div>
                    </div>
                    <div class="status-badge-small"><?= isset($chat) && isset($chat->chatStatus) ? ucfirst(htmlspecialchars($chat->chatStatus)) : 'Open' ?></div>
                </div>
            </div>

            <!-- Chat Container -->
            <div class="row">
                <div class="col-12">
                    <div class="chat-interface-container">
                        <?php 
                        // Prepare data for view.php
                        $view_data = array(
                            'chat' => isset($chat) ? $chat : null,
                            'messages' => isset($messages) ? $messages : array(),
                            'current_user_id' => isset($current_user_id) ? $current_user_id : null,
                            'user_role' => isset($user_role) ? $user_role : null,
                            'jwt_token' => isset($jwt_token) ? $jwt_token : null,
                        );
                        $this->load->view('chats/view', $view_data); 
                        ?>
                    </div>
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
