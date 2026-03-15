<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payment Successful | Equip Manager</title>
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

        .success-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 50px 40px;
            border: 1px solid #e8e8e8;
            max-width: 700px;
            width: 100%;
        }

        .success-icon {
            width: 64px;
            height: 64px;
            background: #34ff67;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 28px;
        }

        .success-icon svg {
            width: 36px;
            height: 36px;
            color: #0f2f2c;
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

        .order-details {
            background: #f7f8fa;
            border-radius: 8px;
            padding: 24px;
            margin-bottom: 28px;
            border: 1px solid #e8e8e8;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .detail-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .detail-label {
            font-size: 13px;
            color: #797979;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .detail-value {
            font-size: 15px;
            color: #1e1e1e;
            font-weight: 600;
            text-align: right;
        }

        .detail-value.highlight {
            color: #34ff67;
            font-weight: 700;
        }

        .info-section {
            background: #f7f8fa;
            border-left: 3px solid #34ff67;
            padding: 18px 20px;
            border-radius: 6px;
            margin-bottom: 24px;
            font-size: 13px;
            line-height: 1.7;
        }

        .info-section strong {
            color: #0f2f2c;
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .info-section p {
            margin: 0;
            color: #444444;
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
main-wrapper {
                padding: 0 20px;
                min-height: auto;
            }

            .success-card {
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
            .btn {
                padding: 12
        }
    </style>
</head>

<body>
    <!-- Website Header -->
    <?php $this->load->view('components/websiteHeader'); ?>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Main Content -->
        <div class="success-card">
                <div class="success-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </div>

                <h1>Payment Successful</h1>
                <p class="subtitle">Thank you for your purchase. Your order has been confirmed and is being processed.</p>

                <div class="divider"></div>

                <!-- ORDER DETAILS -->
                <div class="order-details">
                    <div class="detail-row">
                        <span class="detail-label">Order ID</span>
                        <span class="detail-value">#<?= htmlspecialchars($order_id ?? 'N/A') ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Total Paid</span>
                        <span class="detail-value">$<?= number_format($amount ?? 0, 2) ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Status</span>
                        <span class="detail-value highlight">Completed</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Date & Time</span>
                        <span class="detail-value"><?= date('M d, Y') ?></span>
                    </div>
                </div>

                <!-- INFO -->
                <div class="info-section">
                    <strong>📧 Confirmation Sent</strong>
                    <p>A detailed receipt and tracking information have been sent to your email. Check your inbox or spam folder.</p>
                </div>

                <!-- BUTTONS -->
                <div class="button-group">
                    <?php if (isset($paymentID) && $paymentID): ?>
                        <a href="<?= site_url('chat/view/' . $paymentID) ?>" class="btn btn-primary">Go to Chat</a>
                    <?php else: ?>
                        <a href="<?= site_url('/') ?>" class="btn btn-primary">Continue Shopping</a>
                    <?php endif; ?>
                    <a href="<?= site_url('user-dashboard') ?>" class="btn btn-secondary">My Dashboard</a>
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
                "timeOut": "4000"
            };
            toastr.success('Thank you for your purchase!');
        }
    </script>

</body>
</html>
                    