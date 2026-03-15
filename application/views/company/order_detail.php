<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Order Details - Equip Manager</title>
    <link rel="icon" href="<?= base_url() ?>assets/images/logo-icon.png" type="image/png" />
    
    <!-- Stylesheets -->
    <link href="<?= base_url() ?>assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/bootstrap-extended.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/icons.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <link href="<?= base_url() ?>assets/css/pace.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/dark-theme.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/light-theme.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/semi-dark.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/header-colors.css" rel="stylesheet" />
    <style>
        * {
            font-family: "Manrope", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }
        
        body {
            background-color: #fafafa;
            font-family: "Manrope", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        /* Breadcrumb Navigation */
        .page-breadcrumb {
            padding: 0 0 12px 0;
        }

        .page-breadcrumb .breadcrumb {
            background-color: transparent;
            padding: 0;
        }

        .breadcrumb-item a {
            color: #34FF67;
            text-decoration: none;
            font-weight: 500;
        }

        .breadcrumb-item a:hover {
            color: #2ae050;
            text-decoration: underline;
        }

        /* Page Title Section */
        .page-title-section {
            background-color: transparent;
            border-bottom: none;
            padding: 24px 0 16px 0;
            margin-bottom: 24px;
        }

        .page-title-container {
            max-width: 100%;
            padding: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            color: #0f2f2c;
            letter-spacing: -0.5px;
        }

        .page-subtitle {
            margin: 4px 0 0 0;
            font-size: 13px;
            color: #999;
            font-weight: 400;
        }

        /* Order Detail Card Styles */
        .order-detail-card {
            background-color: #ffffff;
            border-radius: 8px;
            border: 1px solid #efefef;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            transition: box-shadow 0.2s ease;
        }

        .order-detail-card:hover {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .card-header-custom {
            background: linear-gradient(135deg, #f9f9f9 0%, #f5f5f5 100%);
            border-bottom: 1px solid #efefef;
            padding: 16px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title-custom {
            margin: 0;
            font-size: 14px;
            font-weight: 700;
            color: #0f2f2c;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .card-body-custom {
            padding: 20px;
        }

        .info-label {
            font-weight: 600;
            color: #666;
            font-size: 12px;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.2px;
        }

        .info-value {
            color: #0f2f2c;
            font-size: 14px;
            margin-bottom: 16px;
            font-weight: 500;
        }

        .status-badge {
            font-size: 11px;
            padding: 8px 14px;
            border-radius: 6px;
            font-weight: 700;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .badge-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .badge-payment {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .badge-secured {
            background-color: #d1e7f5;
            color: #004085;
        }

        .badge-shipped {
            background-color: #d4edda;
            color: #155724;
        }

        .badge-completed {
            background-color: #d4edda;
            color: #155724;
        }

        .badge-rejected {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* Timeline Styles */
        .timeline-item {
            padding-bottom: 20px;
            border-left: 3px solid #f0f0f0;
            padding-left: 20px;
            position: relative;
        }

        .timeline-item:last-child {
            border-left: 3px solid transparent;
            padding-bottom: 0;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -8px;
            top: 5px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #34FF67;
            border: 2px solid white;
        }

        /* Action Buttons */
        .btn-action-custom {
            padding: 11px 20px;
            border: 2px solid transparent;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            font-family: "Manrope", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            min-width: 140px;
            text-align: center;
        }

        .btn-success-custom {
            background-color: #34FF67;
            color: #0f2f2c;
            border: 2px solid #2ae050;
        }

        .btn-success-custom:hover {
            background-color: #2ae050;
            border-color: #1fb83f;
            box-shadow: 0 4px 12px rgba(52, 255, 103, 0.25);
            transform: translateY(-2px);
        }

        .btn-danger-custom {
            background-color: #ff4757;
            color: #ffffff;
            border: 2px solid #ff3838;
        }

        .btn-danger-custom:hover {
            background-color: #ff3839;
            border-color: #ff1d1d;
            box-shadow: 0 4px 12px rgba(255, 71, 87, 0.25);
            transform: translateY(-2px);
        }

        .btn-secondary-custom {
            background-color: #f0f0f0;
            color: #0f2f2c;
            border: 2px solid #ddd;
            width: 100%;
        }

        .btn-secondary-custom:hover {
            background-color: #e8e8e8;
            border-color: #34FF67;
            box-shadow: 0 4px 12px rgba(52, 255, 103, 0.1);
            transform: translateY(-2px);
        }

        .btn-primary-custom {
            background-color: #34FF67;
            color: #0f2f2c;
            border: 2px solid #2ae050;
            width: 100%;
        }

        .btn-primary-custom:hover {
            background-color: #2ae050;
            border-color: #1fb83f;
            box-shadow: 0 4px 12px rgba(52, 255, 103, 0.25);
            transform: translateY(-2px);
        }

        /* Equipment Image */
        .equipment-image {
            max-height: 280px;
            width: 100%;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #efefef;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        /* Rejection Alert */
        .rejection-alert {
            background-color: #fef0f0;
            border: 1px solid #f0d0d0;
            border-radius: 8px;
            padding: 14px 16px;
            color: #721c24;
            margin-top: 12px;
            font-size: 13px;
            line-height: 1.5;
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .action-buttons form {
            display: block;
            margin-bottom: 0;
        }

        .action-buttons button,
        .action-buttons form button {
            width: 100%;
        }

        .back-nav-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background-color: #f0f9f4;
            color: #0f2f2c;
            border: 2px solid #d0e8e0;
            border-radius: 6px;
            font-weight: 600;
            font-size: 13px;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .back-nav-button:hover {
            background-color: #e0f5e8;
            border-color: #34FF67;
            box-shadow: 0 4px 12px rgba(52, 255, 103, 0.15);
            transform: translateY(-2px);
        }

        /* Modal Styling */
        .modal-content {
            border-radius: 8px;
            border: 1px solid #efefef;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            border-bottom: 1px solid #efefef;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .modal-title {
            color: #0f2f2c;
            font-weight: 700;
            font-size: 16px;
        }

        .modal-body {
            padding: 20px;
        }

        .modal-footer {
            border-top: 1px solid #efefef;
            padding: 16px 20px;
            background-color: #f9f9f9;
        }

        .modal-footer .btn {
            font-weight: 600;
            font-size: 13px;
            border-radius: 6px;
            padding: 10px 20px;
        }

        .form-control {
            border-radius: 6px;
            border: 1px solid #ddd;
            padding: 10px 12px;
            font-family: "Manrope", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .form-control:focus {
            border-color: #34FF67;
            box-shadow: 0 0 0 3px rgba(52, 255, 103, 0.1);
        }

        .form-label {
            color: #0f2f2c;
            font-weight: 600;
            font-size: 13px;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.2px;
        }

        @media (max-width: 768px) {
            .page-title {
                font-size: 22px;
            }

            .page-title-container {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .card-body-custom {
                padding: 16px;
            }

            .card-header-custom {
                padding: 14px 16px;
            }

            .card-title-custom {
                font-size: 13px;
            }

            .btn-action-custom {
                padding: 9px 14px;
                font-size: 12px;
            }

            .info-label {
                font-size: 11px;
            }

            .info-value {
                font-size: 13px;
            }

            .row {
                margin-bottom: 12px;
            }

            .col-md-6 {
                margin-bottom: 12px;
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

            <!-- Breadcrumb -->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">Order Details</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="<?= base_url('company-dashboard') ?>"><i class="bx bx-home-alt"></i></a></li>
                                <li class="breadcrumb-item"><a href="<?= base_url('company-orders') ?>">Orders</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Order #<?= $order['equipmentPaymentID'] ?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
                
                <!-- Page Title Section -->
                <div class="page-title-section">
                    <div class="page-title-container">
                        <div>
                            <h1 class="page-title">Order #<?= $order['equipmentPaymentID'] ?></h1>
                            <p class="page-subtitle">View and manage order details</p>
                        </div>
                    </div>
                </div>

                <?php
                // Decode delivery metadata once — used throughout the page
                $_meta            = json_decode($order['paymentMetadata'] ?? '{}', true);
                $_delivery_method = intval($_meta['delivery_method'] ?? 0);
                $_is_delivery     = ($_delivery_method === 2);
                $_is_pickup       = ($_delivery_method === 1);
                ?>

                <div class="row">
                    <!-- Order Summary Card -->
                    <div class="col-lg-8">
                        <div class="order-detail-card">
                            <div class="card-header-custom">
                                <h3 class="card-title-custom">Order Information</h3>
                                <?php
                                $status_class = '';
                                $status_text = '';
                                switch ($order['orderStatus']) {
                                    case 'requested':
                                        $status_class = 'badge-pending';
                                        $status_text = 'Pending Approval';
                                        break;
                                    case 'payment_pending':
                                        $status_class = 'badge-payment';
                                        $status_text = 'Awaiting Payment';
                                        break;
                                    case 'payment_secured':
                                        $status_class = 'badge-secured';
                                        $status_text = 'Payment Secured';
                                        break;
                                    case 'shipped':
                                        $status_class = 'badge-shipped';
                                        $status_text = 'Shipped';
                                        break;
                                    case 'delivered':
                                        $status_class = 'badge-shipped';
                                        $status_text = 'Delivered';
                                        break;
                                    case 'pickup_ready':
                                        $status_class = 'badge-secured';
                                        $status_text = 'Ready for Pickup';
                                        break;
                                    case 'completed':
                                        $status_class = 'badge-completed';
                                        $status_text = 'Completed';
                                        break;
                                    case 'rejected':
                                        $status_class = 'badge-rejected';
                                        $status_text = 'Rejected';
                                        break;
                                    case 'cancelled':
                                        $status_class = 'badge-rejected';
                                        $status_text = 'Cancelled';
                                        break;
                                }
                                ?>
                                <span class="status-badge <?= $status_class ?>"><?= $status_text ?></span>
                            </div>
                            <div class="card-body-custom">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="info-label">Order ID</div>
                                        <div class="info-value"><strong>#<?= $order['equipmentPaymentID'] ?></strong></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-label">Order Date</div>
                                        <div class="info-value"><?= date('M d, Y h:i A', strtotime($order['createdAt'])) ?></div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="info-label">Equipment</div>
                                        <div class="info-value"><strong><?= htmlspecialchars($order['equipmentName']) ?></strong></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-label">Quantity</div>
                                        <div class="info-value"><?= $order['quantity'] ?> unit(s)</div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="info-label">Sale Type</div>
                                        <div class="info-value"><?= ucfirst($order['saleType']) ?></div>
                                    </div>
                                    <?php if ($order['saleType'] === 'rental') { ?>
                                        <div class="col-md-6">
                                            <div class="info-label">Rental Period</div>
                                            <div class="info-value">
                                                <?= date('M d, Y', strtotime($order['rentalStartDate'])) ?> to 
                                                <?= date('M d, Y', strtotime($order['rentalEndDate'])) ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>

                                <hr style="margin: 20px 0;">

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="info-label">Gross Amount</div>
                                        <div class="info-value"><strong>$<?= number_format($order['grossAmount'], 2) ?></strong></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-label">Commission (<?= $order['commissionPercent'] ?>%)</div>
                                        <div class="info-value" style="color: #ff6b6b;">-$<?= number_format($order['commissionAmount'], 2) ?></div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="info-label">Net Amount (Your Earnings)</div>
                                        <div class="info-value" style="color: #34FF67; font-weight: 700; font-size: 16px;">$<?= number_format($order['netAmount'], 2) ?></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-label">Payment Status</div>
                                        <div class="info-value">
                                            <?php
                                            $payment_badge = '';
                                            switch ($order['paymentStatus']) {
                                                case 'pending':
                                                    $payment_badge = '<span class="badge-pending status-badge">Pending Payment</span>';
                                                    break;
                                                case 'completed':
                                                    $payment_badge = '<span class="badge-completed status-badge">Paid to ' . htmlspecialchars($order['sellerCompanyName'] ?? 'Your Company') . '</span>';
                                                    break;
                                                case 'failed':
                                                    $payment_badge = '<span class="badge-rejected status-badge">Failed</span>';
                                                    break;
                                                case 'refunded':
                                                    $payment_badge = '<span class="badge-payment status-badge">Refunded</span>';
                                                    break;
                                            }
                                            echo $payment_badge;
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <?php if (!empty($order['rejectionReason'])) { ?>
                                    <hr style="margin: 20px 0;">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="info-label">Rejection Reason</div>
                                            <div class="rejection-alert">
                                                <?= nl2br(htmlspecialchars($order['rejectionReason'])) ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                                <!-- Delivery / Pickup Details -->
                                <?php if ($_is_delivery): ?>
                                    <hr style="margin: 20px 0;">
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <div class="info-label">Fulfillment Method</div>
                                            <div class="info-value">
                                                <span class="status-badge badge-payment"><i class="bi bi-truck"></i>&nbsp;Delivery</span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if (!empty($_meta['delivery_name'])): ?>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="info-label">Recipient Name</div>
                                            <div class="info-value"><?= htmlspecialchars($_meta['delivery_name']) ?></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-label">Phone</div>
                                            <div class="info-value"><?= htmlspecialchars($_meta['customer_phone'] ?? '-') ?></div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if (!empty($_meta['delivery_street'])): ?>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="info-label">Street Address</div>
                                            <div class="info-value"><?= htmlspecialchars($_meta['delivery_street']) ?></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-label">City / Postal Code</div>
                                            <div class="info-value"><?= htmlspecialchars($_meta['delivery_city'] ?? '') ?><?= !empty($_meta['delivery_postal']) ? ' &mdash; ' . htmlspecialchars($_meta['delivery_postal']) : '' ?></div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if (!empty($_meta['delivery_country'])): ?>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="info-label">Country</div>
                                            <div class="info-value"><?= htmlspecialchars($_meta['delivery_country']) ?></div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if (!empty($_meta['delivery_notes'])): ?>
                                    <div class="row mb-2">
                                        <div class="col-12">
                                            <div class="info-label">Delivery Notes</div>
                                            <div class="info-value"><?= nl2br(htmlspecialchars($_meta['delivery_notes'])) ?></div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                <?php elseif ($_is_pickup): ?>
                                    <hr style="margin: 20px 0;">
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <div class="info-label">Fulfillment Method</div>
                                            <div class="info-value">
                                                <span class="status-badge badge-pending"><i class="bi bi-building"></i>&nbsp;Pickup at Store</span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        $_pickup_name = $_meta['customer_name'] ?? ($_meta['delivery_name'] ?? null);
                                        $_pickup_phone = $_meta['customer_phone'] ?? null;
                                        $_pickup_email = $_meta['customer_email'] ?? null;
                                    ?>
                                    <?php if ($_pickup_name || $_pickup_phone): ?>
                                    <div class="row mb-3">
                                        <?php if ($_pickup_name): ?>
                                        <div class="col-md-6">
                                            <div class="info-label">Buyer Name</div>
                                            <div class="info-value"><?= htmlspecialchars($_pickup_name) ?></div>
                                        </div>
                                        <?php endif; ?>
                                        <?php if ($_pickup_phone): ?>
                                        <div class="col-md-6">
                                            <div class="info-label">Buyer Phone</div>
                                            <div class="info-value"><?= htmlspecialchars($_pickup_phone) ?></div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php endif; ?>
                                    <?php if ($_pickup_email): ?>
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <div class="info-label">Buyer Email</div>
                                            <div class="info-value"><?= htmlspecialchars($_pickup_email) ?></div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Equipment Details Card -->
                        <div class="order-detail-card">
                            <div class="card-header-custom">
                                <h3 class="card-title-custom">Equipment Details</h3>
                            </div>
                            <div class="card-body-custom">
                                <?php
                                $adminImages = isset($images) ? array_values(array_filter($images)) : [];
                                if (!empty($adminImages)):
                                ?>
                                <div class="mb-4" style="position:relative;">
                                    <!-- Main image -->
                                    <div id="adminGalleryMain" style="width:100%;height:260px;border-radius:8px;overflow:hidden;background:#f5f5f5;display:flex;align-items:center;justify-content:center;position:relative;border:1px solid #efefef;">
                                        <img id="adminMainImg"
                                             src="<?= base_url($adminImages[0]) ?>"
                                             alt="<?= htmlspecialchars($order['equipmentName']) ?>"
                                             style="width:100%;height:100%;object-fit:cover;"
                                             onerror="this.src='<?= base_url('assets/website/images/brand-logo-2.png') ?>'">
                                        <?php if (count($adminImages) > 1): ?>
                                        <button onclick="adminGalleryNav(-1)" style="position:absolute;left:8px;top:50%;transform:translateY(-50%);width:32px;height:32px;background:rgba(255,255,255,.9);border:none;border-radius:50%;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:14px;color:#0f2f2c;z-index:5;">&#8249;</button>
                                        <button onclick="adminGalleryNav(1)"  style="position:absolute;right:8px;top:50%;transform:translateY(-50%);width:32px;height:32px;background:rgba(255,255,255,.9);border:none;border-radius:50%;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:14px;color:#0f2f2c;z-index:5;">&#8250;</button>
                                        <span id="adminGalleryCounter" style="position:absolute;bottom:8px;right:10px;background:rgba(0,0,0,.55);color:#fff;font-size:11px;font-weight:600;padding:3px 8px;border-radius:12px;">1 / <?= count($adminImages) ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (count($adminImages) > 1): ?>
                                    <!-- Thumbnails -->
                                    <div id="adminThumbRow" style="display:flex;gap:6px;overflow-x:auto;padding:8px 0 4px;scrollbar-width:thin;">
                                        <?php foreach ($adminImages as $idx => $img): ?>
                                        <div onclick="adminGallerySet(<?= $idx ?>)"
                                             class="admin-thumb <?= $idx === 0 ? 'admin-thumb-active' : '' ?>"
                                             style="flex-shrink:0;width:56px;height:56px;border-radius:6px;border:2px solid <?= $idx === 0 ? '#34FF67' : '#ddd' ?>;overflow:hidden;cursor:pointer;transition:border-color .2s;"
                                             id="adminThumb<?= $idx ?>">
                                            <img src="<?= base_url($img) ?>"
                                                 style="width:100%;height:100%;object-fit:cover;"
                                                 onerror="this.src='<?= base_url('assets/website/images/brand-logo-2.png') ?>'">
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="info-label">Equipment ID</div>
                                        <div class="info-value">#<?= $order['equipmentID'] ?></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-label">Total Available</div>
                                        <div class="info-value"><?= $order['equipTotalQuantity'] ?> unit(s)</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Buyer Information & Actions -->
                    <div class="col-lg-4">
                        <!-- Buyer Details Card -->
                        <div class="order-detail-card">
                            <div class="card-header-custom">
                                <h3 class="card-title-custom">Buyer Information</h3>
                            </div>
                            <div class="card-body-custom">
                                <div class="mb-4">
                                    <div class="info-label">Name</div>
                                    <div class="info-value"><?= htmlspecialchars($order['buyerName']) ?></div>
                                </div>
                                <div class="mb-4">
                                    <div class="info-label">Account Email</div>
                                    <div class="info-value"><?= htmlspecialchars($order['buyerEmail']) ?></div>
                                </div>
                                <div class="mb-4">
                                    <div class="info-label">Billing Email</div>
                                    <div class="info-value"><?= htmlspecialchars($_meta['customer_email'] ?? 'N/A') ?></div>
                                </div>
                                <?php if (!empty($order['chatID'])) { ?>
                                    <button type="button" class="btn-action-custom btn-primary-custom" onclick="window.location.href='<?= base_url('chat/' . $order['equipmentPaymentID']) ?>'">
                                        <i class="bi bi-chat-dots"></i> Open Chat
                                    </button>
                                <?php } ?>
                            </div>
                        </div>

                        <!-- Actions Card -->
                        <?php if ($order['orderStatus'] === 'requested') { ?>
                            <div class="order-detail-card">
                                <div class="card-header-custom">
                                    <h3 class="card-title-custom">Actions</h3>
                                </div>
                                <div class="card-body-custom">
                                    <div class="action-buttons">
                                        <form method="POST" action="<?= base_url('company-orders/accept') ?>">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                                            <input type="hidden" name="order_id" value="<?= $order['equipmentPaymentID'] ?>">
                                            <button type="submit" class="btn-action-custom btn-success-custom" onclick="return confirm('Are you sure you want to approve this purchase request?')">
                                                <i class="bi bi-check-circle"></i> Approve Request
                                            </button>
                                        </form>

                                        <button type="button" class="btn-action-custom btn-danger-custom" data-bs-toggle="modal" data-bs-target="#rejectModal">
                                            <i class="bi bi-x-circle"></i> Reject Request
                                        </button>

                                        <!-- Reject Modal -->
                                        <div class="modal fade" id="rejectModal" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content" style="border-radius: 8px; border: 1px solid #efefef; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                                                    <form method="POST" action="<?= base_url('company-orders/reject') ?>">
                                                        <div class="modal-header" style="border-bottom: 1px solid #efefef; padding: 20px; background-color: #f9f9f9;">
                                                            <h5 class="modal-title" style="color: #0f2f2c; font-weight: 700; font-size: 16px;">Reject Purchase Request</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body" style="padding: 20px;">
                                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                                                            <input type="hidden" name="order_id" value="<?= $order['equipmentPaymentID'] ?>">
                                                            <div class="mb-3">
                                                                <label for="rejection_reason" class="form-label" style="color: #0f2f2c; font-weight: 600; font-size: 13px; text-transform: uppercase; letter-spacing: 0.2px;">Reason for Rejection</label>
                                                                <textarea class="form-control" id="rejection_reason" name="rejection_reason" rows="4" placeholder="Please provide a reason..." style="border-radius: 6px; border: 1px solid #ddd; padding: 10px 12px; font-family: Manrope, sans-serif;"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer" style="border-top: 1px solid #efefef; padding: 16px; background-color: #f9f9f9;">
                                                            <button type="button" class="btn" data-bs-dismiss="modal" style="color: #0f2f2c; background-color: #f0f0f0; border-radius: 6px; padding: 10px 20px; font-weight: 600; border: none; cursor: pointer; transition: all 0.2s ease;">Cancel</button>
                                                            <button type="submit" class="btn" style="background-color: #ff4757; color: white; border-radius: 6px; padding: 10px 20px; font-weight: 600; border: none; cursor: pointer; transition: all 0.2s ease;">Reject Request</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <!-- Actions Card: payment_secured (Ship or Allow Pickup) -->
                        <?php if ($order['orderStatus'] === 'payment_secured'): ?>
                            <div class="order-detail-card">
                                <div class="card-header-custom">
                                    <h3 class="card-title-custom">Actions</h3>
                                </div>
                                <div class="card-body-custom">
                                    <?php if ($_is_delivery): ?>
                                        <p style="color:#666; font-size:13px; margin-bottom:16px;">Payment secured. Mark this order as shipped once dispatched.</p>
                                        <button type="button" class="btn-action-custom btn-success-custom" data-bs-toggle="modal" data-bs-target="#shippingModal">
                                            <i class="bi bi-truck"></i> Mark as Shipped
                                        </button>
                                        <!-- Shipping Modal -->
                                        <div class="modal fade" id="shippingModal" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content" style="border-radius:8px;border:1px solid #efefef;box-shadow:0 4px 12px rgba(0,0,0,.1);">
                                                    <form method="POST" action="<?= base_url('company-orders/mark_shipped') ?>">
                                                        <div class="modal-header" style="border-bottom:1px solid #efefef;padding:20px;background:#f9f9f9;">
                                                            <h5 class="modal-title" style="color:#0f2f2c;font-weight:700;font-size:16px;">Mark Order as Shipped</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body" style="padding:20px;">
                                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                                                            <input type="hidden" name="order_id" value="<?= $order['equipmentPaymentID'] ?>">
                                                            <div class="mb-3">
                                                                <label class="form-label">Tracking Number <small style="color:#999">(optional)</small></label>
                                                                <input type="text" class="form-control" name="tracking_number" placeholder="Enter tracking number..." style="border-radius:6px;border:1px solid #ddd;padding:10px 12px;font-family:Manrope,sans-serif;">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Shipping Notes <small style="color:#999">(optional)</small></label>
                                                                <textarea class="form-control" name="shipping_notes" rows="3" placeholder="Any additional information..." style="border-radius:6px;border:1px solid #ddd;padding:10px 12px;font-family:Manrope,sans-serif;"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer" style="border-top:1px solid #efefef;padding:16px;background:#f9f9f9;">
                                                            <button type="button" class="btn" data-bs-dismiss="modal" style="color:#0f2f2c;background:#f0f0f0;border-radius:6px;padding:10px 20px;font-weight:600;border:none;cursor:pointer;">Cancel</button>
                                                            <button type="submit" class="btn" style="background:#34FF67;color:#0f2f2c;border-radius:6px;padding:10px 20px;font-weight:600;border:none;cursor:pointer;">Confirm Shipment</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <p style="color:#666; font-size:13px; margin-bottom:16px;">Payment secured. Click below to notify the buyer that their order is ready for collection.</p>
                                        <form method="POST" action="<?= base_url('company-orders/allow_pickup') ?>">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                                            <input type="hidden" name="order_id" value="<?= $order['equipmentPaymentID'] ?>">
                                            <button type="submit" class="btn-action-custom btn-success-custom" onclick="return confirm('Notify buyer that order #<?= $order['equipmentPaymentID'] ?> is ready for pickup?')">
                                                <i class="bi bi-bag-check"></i> Allow Pickup
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Approval History Card -->
                        <?php if (!empty($order['approvedAt'])) { ?>
                            <div class="order-detail-card">
                                <div class="card-header-custom">
                                    <h3 class="card-title-custom">Timeline</h3>
                                </div>
                                <div class="card-body-custom">
                                    <div class="timeline-item">
                                        <div class="info-label">Created</div>
                                        <div class="info-value"><?= date('M d, Y h:i A', strtotime($order['createdAt'])) ?></div>
                                    </div>
                                    <div class="timeline-item">
                                        <div class="info-label"><?= ucfirst(str_replace('_', ' ', $order['orderStatus'])) ?></div>
                                        <div class="info-value"><?= date('M d, Y h:i A', strtotime($order['approvedAt'])) ?></div>
                                        <?php if (!empty($order['approvedByName'])) { ?>
                                            <small style="color: #999;">By: <?= htmlspecialchars($order['approvedByName']) ?></small>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <a href="<?= base_url('company-orders') ?>" class="back-nav-button">
                            <i class="bi bi-arrow-left"></i> Back to Orders List
                        </a>
                    </div>
                </div>

        </main>
    
        <!-- Overlay -->
        <div class="overlay toggle-icon"></div>
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    </div>

    <!-- Scripts -->
    <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="<?= base_url() ?>assets/js/pace.min.js"></script>
    <script src="<?= base_url() ?>assets/js/app.js"></script>
    <script>
    (function() {
        var adminImages = <?= isset($images) ? json_encode(array_values(array_filter($images))) : '[]' ?>;
        var adminCurrent = 0;
        var BASE = '<?= base_url() ?>';

        window.adminGalleryNav = function(dir) {
            adminGallerySet((adminCurrent + dir + adminImages.length) % adminImages.length);
        };

        window.adminGallerySet = function(idx) {
            adminCurrent = idx;
            var mainImg = document.getElementById('adminMainImg');
            var counter = document.getElementById('adminGalleryCounter');
            if (mainImg) mainImg.src = BASE + adminImages[idx];
            if (counter) counter.textContent = (idx + 1) + ' / ' + adminImages.length;
            adminImages.forEach(function(_, i) {
                var thumb = document.getElementById('adminThumb' + i);
                if (thumb) thumb.style.borderColor = (i === idx) ? '#34FF67' : '#ddd';
            });
        };
    })();
    </script>
</body>

</html>
