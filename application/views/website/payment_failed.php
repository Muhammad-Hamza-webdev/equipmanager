<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payment Failed | Equip Manager</title>
    <link rel="icon" type="image/x-icon" href="<?= base_url() ?>assets/website/img/favicon.svg" />
    <!-- Website CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/style.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/header.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/footer.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/resopnsive.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/toastr/toastr.min.css" />
    
    <style>
        * { box-sizing: border-box; }
        
        body {
            background-color: #f7f8fa;
            font-family: 'Manrope', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: #444444;
        }

        .main-wrapper {
            padding: 0 40px;
            max-width: 1600px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: calc(100vh - 200px);
        }

        .error-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 50px 40px;
            border: 1px solid #e8e8e8;
            max-width: 700px;
            width: 100%;
        }

        .error-icon {
            width: 64px;
            height: 64px;
            background: #ff5252;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 28px;
        }

        .error-icon svg {
            width: 36px;
            height: 36px;
            color: white;
            stroke-width: 2.5;
        }

        h1 {
            font-family: 'Manrope', sans-serif;
            font-size: 32px;
            font-weight: 600;
            color: #0f2f2c;
            text-align: center;
            margin: 0 0 12px 0;
            line-height: 1.3;
        }

        .subtitle {
            font-size: 15px;
            color: #797979;
            text-align: center;
            margin: 0 0 40px 0;
            line-height: 1.6;
        }

        .error-message {
            background: #ffe5e5;
            border: 1px solid #ffcccc;
            border-left: 3px solid #ff5252;
            border-radius: 8px;
            padding: 18px 20px;
            margin-bottom: 28px;
            font-size: 14px;
            color: #d32f2f;
            line-height: 1.6;
        }

        .tips-section {
            background: #f7f8fa;
            border: 1px solid #e8e8e8;
            border-radius: 8px;
            padding: 24px;
            margin-bottom: 28px;
        }

        .tips-section strong {
            display: block;
            color: #0f2f2c;
            margin-bottom: 12px;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .tips-section ul {
            margin: 0;
            padding-left: 20px;
            color: #444444;
            font-size: 13px;
            line-height: 1.8;
        }

        .tips-section li {
            margin: 6px 0;
        }

        .info-box {
            background: #f7f8fa;
            border-left: 3px solid #34ff67;
            padding: 18px 20px;
            border-radius: 6px;
            margin-bottom: 28px;
            font-size: 13px;
        }

        .info-box strong {
            color: #0f2f2c;
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .info-box a {
            color: #34ff67;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .info-box a:hover {
            color: #0f2f2c;
        }

        .divider {
            height: 1px;
            background: #e8e8e8;
            margin: 28px 0;
        }

        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 32px;
        }

        .btn {
            flex: 1;
            padding: 14px 20px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            transition: all 0.3s ease;
            font-family: 'Manrope', sans-serif;
        }

        .btn-primary {
            background: #34ff67;
            color: #0f2f2c;
            border: 1px solid #34ff67;
        }

        .btn-primary:hover {
            background: #0f2f2c;
            color: #34ff67;
            box-shadow: 0 8px 20px rgba(52, 255, 103, 0.2);
        }

        .btn-secondary {
            background: transparent;
            color: #1e1e1e;
            border: 1px solid #d0d0d0;
        }

        .btn-secondary:hover {
            background: #f7f8fa;
            border-color: #1e1e1e;
        }

        @media (max-width: 640px) {
            .main-wrapper {
                padding: 0 20px;
                min-height: auto;
            }

            .error-card {
                padding: 32px 24px;
            }

            h1 {
                font-size: 26px;
            }

            .button-group {
                flex-direction: column;
            }

            .btn {
                padding: 12px 16px;
            }
        }
    </style>
</head>

<body>
    <!-- Website Header -->
    <?php $this->load->view('components/websiteHeader'); ?>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Main Content -->
        <div class="error-card">
                <div class="error-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </div>

                <h1>Payment Failed</h1>
                <p class="subtitle">Unfortunately, your payment could not be processed. Please review the details below and try again.</p>

                <div class="divider"></div>

                <!-- ERROR DETAILS -->
                <div class="error-message">
                    <strong style="display: block; margin-bottom: 6px;">Error Details:</strong>
                    <?= htmlspecialchars($error_message ?? 'Your payment was declined. Please try again or use a different payment method.') ?>
                </div>

                <!-- TROUBLESHOOTING TIPS -->
                <div class="tips-section">
                    <strong>Try the following to resolve the issue:</strong>
                    <ul>
                        <li>Verify your card number, expiration date, and CVV are correct</li>
                        <li>Ensure your card has sufficient available funds</li>
                        <li>Check that your card is not expired</li>
                        <li>Contact your bank if your card was flagged for security</li>
                        <li>Try a different payment method if available</li>
                        <li>Clear your browser cache and try again</li>
                    </ul>
                </div>

                <!-- SUPPORT INFO -->
                <div class="info-box">
                    <strong>Still having issues?</strong>
                    <p style="margin: 0;">Our support team is here to help. <a href="<?= site_url('/support') ?>">Contact support</a> if you continue to experience problems.</p>
                </div>

                <!-- BUTTONS -->
                <div class="button-group">
                    <a href="javascript:history.back();" class="btn btn-primary">Try Again</a>
                    <a href="<?= site_url('/') ?>" class="btn btn-secondary">Return to Shop</a>
                </div>
        </div>
    </div>

    <!-- Website Footer -->
    <?php $this->load->view('components/websiteFooter'); ?>

    <script src="<?= base_url() ?>assets/toastr/toastr.min.js"></script>
    <script>
        if (typeof toastr !== 'undefined') {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "5000"
            };
            toastr.error('Payment processing failed. Please try again.');
        }
    </script>

</body>
</html>
