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

        /* Page Header */
        .page-header {
            background-color: #ffffff;
            border-bottom: 1px solid #f0f0f0;
            padding: 20px 0;
            margin-bottom: 24px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
        }

        .page-header-content {
            max-width: 100%;
            padding: 0 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background-color: #f0f9f4;
            border: 2px solid #d0e8e0;
            border-radius: 8px;
            font-weight: 600;
            color: #0f2f2c;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: "Manrope", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            margin-bottom: 16px;
        }

        .back-button:hover {
            background-color: #e0f5e8;
            border-color: #34FF67;
            box-shadow: 0 4px 12px rgba(52, 255, 103, 0.15);
            text-decoration: none;
            color: #0f2f2c;
            transform: translateX(-4px);
        }

        .page-title {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            color: #0f2f2c;
            letter-spacing: -0.5px;
        }

        .order-id-badge {
            display: inline-block;
            padding: 8px 16px;
            background-color: #e8f5f0;
            border: 2px solid #34FF67;
            border-radius: 8px;
            color: #0f2f2c;
            font-weight: 700;
            font-size: 16px;
        }

        /* Status Badge Large */
        .status-badge-large {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pending { background-color: #fff3cd; color: #856404; }
        .status-payment { background-color: #d1ecf1; color: #0c5460; }
        .status-secured { background-color: #d1e7f5; color: #004085; }
        .status-shipped { background-color: #d4edda; color: #155724; }
        .status-completed { background-color: #d4edda; color: #155724; }
        .status-rejected { background-color: #f8d7da; color: #721c24; }

        /* Detail Cards */
        .detail-section {
            background-color: #ffffff;
            border-radius: 10px;
            border: 1px solid #f0f0f0;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            margin-bottom: 24px;
        }

        .detail-section-header {
            background-color: #f9f9f9;
            border-bottom: 2px solid #f0f0f0;
            padding: 16px 24px;
        }

        .detail-section-title {
            margin: 0;
            font-size: 16px;
            font-weight: 700;
            color: #0f2f2c;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .detail-section-content {
            padding: 24px;
        }

        .detail-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 24px;
            padding-bottom: 24px;
            border-bottom: 1px solid #f5f5f5;
        }

        .detail-row:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
        }

        .detail-label {
            font-size: 12px;
            font-weight: 700;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            margin-bottom: 8px;
        }

        .detail-value {
            font-size: 16px;
            font-weight: 600;
            color: #0f2f2c;
        }

        .detail-value.email {
            font-size: 14px;
            color: #666;
            font-weight: 400;
        }

        .detail-value.amount {
            font-size: 24px;
            font-weight: 700;
            color: #34FF67;
        }

        .detail-section.full-width .detail-row {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        /* Equipment Details */
        .equipment-card {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 16px;
            display: grid;
            grid-template-columns: 120px 1fr;
            gap: 16px;
            align-items: start;
        }

        .equipment-image {
            width: 120px;
            height: 120px;
            background-color: #e0e0e0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .equipment-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .equipment-info h4 {
            margin: 0 0 8px 0;
            font-size: 18px;
            font-weight: 700;
            color: #0f2f2c;
        }

        .equipment-info p {
            margin: 6px 0;
            font-size: 13px;
            color: #666;
            line-height: 1.6;
        }

        .equipment-brand {
            font-size: 12px;
            color: #999;
            font-weight: 500;
        }

        /* Timeline */
        .timeline {
            position: relative;
            padding-left: 40px;
        }

        .timeline-item {
            position: relative;
            padding-bottom: 24px;
            margin-bottom: 24px;
            border-bottom: 1px solid #f0f0f0;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
            border-bottom: none;
        }

        .timeline-dot {
            position: absolute;
            left: -40px;
            top: 2px;
            width: 16px;
            height: 16px;
            background-color: #34FF67;
            border: 3px solid #ffffff;
            border-radius: 50%;
            box-shadow: 0 0 0 2px #34FF67;
        }

        .timeline-item.pending .timeline-dot {
            background-color: #ffc107;
            box-shadow: 0 0 0 2px #ffc107;
        }

        .timeline-date {
            font-size: 12px;
            font-weight: 700;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 0.2px;
            margin-bottom: 4px;
        }

        .timeline-description {
            font-size: 14px;
            color: #333;
            font-weight: 500;
        }

        /* Action Section */
        .action-section {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn-action {
            padding: 12px 24px;
            border: 2px solid transparent;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: "Manrope", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            text-decoration: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .btn-primary {
            background: linear-gradient(135deg, #34FF67 0%, #2ae050 100%);
            color: #0f2f2c;
            border: 2px solid #34FF67;
        }

        .btn-primary:hover {
            box-shadow: 0 4px 12px rgba(52, 255, 103, 0.25);
            transform: translateY(-2px);
            text-decoration: none;
        }

        .btn-secondary {
            background-color: #f0f9f4;
            color: #0f2f2c;
            border: 2px solid #d0e8e0;
        }

        .btn-secondary:hover {
            background-color: #e0f5e8;
            border-color: #34FF67;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(52, 255, 103, 0.15);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .detail-row {
                grid-template-columns: 1fr;
                gap: 24px;
            }

            .equipment-card {
                grid-template-columns: 1fr;
            }

            .equipment-image {
                width: 100%;
                height: 200px;
            }

            .page-header-content {
                flex-direction: column;
                align-items: flex-start;
            }

            .action-section {
                flex-direction: column;
            }

            .btn-action {
                width: 100%;
                justify-content: center;
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
                            <li class="breadcrumb-item"><a href="<?= base_url('admin-dashboard') ?>"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('super-admin-orders') ?>">All Orders</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Order #<?= htmlspecialchars($order->equipmentPaymentID) ?></li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!-- Back Button -->
            <a href="<?= base_url('super-admin-orders') ?>" class="back-button">
                <i class="bi bi-arrow-left"></i>
                <span>Back to Orders</span>
            </a>

            <!-- Page Header with Status -->
            <div class="detail-section" style="margin-bottom: 32px;">
                <div class="detail-section-content">
                    <div style="display: flex; justify-content: space-between; align-items: center; gap: 20px; flex-wrap: wrap;">
                        <div>
                            <div class="order-id-badge">#<?= htmlspecialchars($order->equipmentPaymentID) ?></div>
                            <p style="margin: 12px 0 0 0; color: #666; font-size: 14px;">
                                Order placed on <?= date('F d, Y \a\t g:i A', strtotime($order->createdAt)) ?>
                            </p>
                        </div>
                        <div>
                            <?php 
                                $status_class_map = [
                                    'requested' => 'status-pending',
                                    'payment_pending' => 'status-payment',
                                    'payment_secured' => 'status-secured',
                                    'shipped' => 'status-shipped',
                                    'pickup_ready' => 'status-secured',
                                    'completed' => 'status-completed',
                                    'rejected' => 'status-rejected'
                                ];
                                $status_class = $status_class_map[$order->orderStatus] ?? 'status-pending';
                            ?>
                            <span class="status-badge-large <?= $status_class ?>">
                                <?= ucfirst(str_replace('_', ' ', htmlspecialchars($order->orderStatus))) ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            // Decode metadata to get billing email
            $_meta = json_decode($order->paymentMetadata ?? '{}', true);
            $_billing_email = $_meta['customer_email'] ?? null;
            ?>

            <!-- Buyer Information -->
            <div class="detail-section">
                <div class="detail-section-header">
                    <h3 class="detail-section-title">
                        <i class="bi bi-person-circle"></i>
                        Buyer Information
                    </h3>
                </div>
                <div class="detail-section-content">
                    <div class="detail-row">
                        <div class="detail-item">
                            <span class="detail-label">Buyer Name</span>
                            <span class="detail-value"><?= htmlspecialchars($order->buyerName) ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Phone Number</span>
                            <span class="detail-value"><?= htmlspecialchars($order->buyerPhone ?? 'N/A') ?></span>
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-item">
                            <span class="detail-label">Account Email</span>
                            <span class="detail-value email" style="font-size: 13px;"><?= htmlspecialchars($order->buyerEmail) ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Billing Email</span>
                            <span class="detail-value email" style="font-size: 13px;"><?= htmlspecialchars($_billing_email ?? 'N/A') ?></span>
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-item">
                            <span class="detail-label">User ID</span>
                            <span class="detail-value">#<?= htmlspecialchars($order->buyerUserID) ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seller Information -->
            <div class="detail-section">
                <div class="detail-section-header">
                    <h3 class="detail-section-title">
                        <i class="bi bi-building"></i>
                        Seller Information
                    </h3>
                </div>
                <div class="detail-section-content">
                    <div class="detail-row">
                        <div class="detail-item">
                            <span class="detail-label">Seller Name</span>
                            <span class="detail-value"><?= htmlspecialchars($order->sellerUserName ?? 'N/A') ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Company ID</span>
                            <span class="detail-value">#<?= htmlspecialchars($order->sellerCompanyID) ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Equipment Details -->
            <div class="detail-section">
                <div class="detail-section-header">
                    <h3 class="detail-section-title">
                        <i class="bi bi-box"></i>
                        Equipment Information
                    </h3>
                </div>
                <div class="detail-section-content">
                    <?php
                    $saImages = isset($images) ? array_values(array_filter($images)) : [];
                    ?>
                    <?php if (!empty($saImages)): ?>
                    <!-- Gallery -->
                    <div style="margin-bottom:20px;">
                        <div id="saGalleryMain" style="width:100%;height:300px;border-radius:8px;overflow:hidden;background:#f5f5f5;display:flex;align-items:center;justify-content:center;position:relative;border:1px solid #e0e0e0;">
                            <img id="saMainImg"
                                 src="<?= base_url($saImages[0]) ?>"
                                 alt="Equipment"
                                 style="width:100%;height:100%;object-fit:cover;"
                                 onerror="this.src='<?= base_url('assets/website/images/brand-logo-2.png') ?>'">
                            <?php if (count($saImages) > 1): ?>
                            <button onclick="saGalleryNav(-1)" style="position:absolute;left:8px;top:50%;transform:translateY(-50%);width:34px;height:34px;background:rgba(255,255,255,.9);border:none;border-radius:50%;cursor:pointer;font-size:16px;color:#0f2f2c;z-index:5;">&#8249;</button>
                            <button onclick="saGalleryNav(1)"  style="position:absolute;right:8px;top:50%;transform:translateY(-50%);width:34px;height:34px;background:rgba(255,255,255,.9);border:none;border-radius:50%;cursor:pointer;font-size:16px;color:#0f2f2c;z-index:5;">&#8250;</button>
                            <span id="saGalleryCounter" style="position:absolute;bottom:8px;right:10px;background:rgba(0,0,0,.55);color:#fff;font-size:11px;font-weight:600;padding:3px 8px;border-radius:12px;">1 / <?= count($saImages) ?></span>
                            <?php endif; ?>
                        </div>
                        <?php if (count($saImages) > 1): ?>
                        <div style="display:flex;gap:6px;overflow-x:auto;padding:8px 0 2px;scrollbar-width:thin;">
                            <?php foreach ($saImages as $idx => $img): ?>
                            <div onclick="saGallerySet(<?= $idx ?>)"
                                 id="saThumb<?= $idx ?>"
                                 style="flex-shrink:0;width:60px;height:60px;border-radius:6px;border:2px solid <?= $idx === 0 ? '#34FF67' : '#e0e0e0' ?>;overflow:hidden;cursor:pointer;transition:border-color .2s;">
                                <img src="<?= base_url($img) ?>"
                                     style="width:100%;height:100%;object-fit:cover;"
                                     onerror="this.src='<?= base_url('assets/website/images/brand-logo-2.png') ?>'">
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <div class="equipment-card" style="<?= !empty($saImages) ? 'grid-template-columns:1fr;' : '' ?>">
                        <?php if (empty($saImages)): ?>
                        <div class="equipment-image">
                            <i class="bi bi-image" style="font-size: 48px; color: #999;"></i>
                        </div>
                        <?php endif; ?>
                        <div class="equipment-info">
                            <h4><?= htmlspecialchars($order->equipmentName) ?></h4>
                            <p class="equipment-brand">Equipment ID: #<?= htmlspecialchars($order->equipmentID) ?></p>
                            <p><?= htmlspecialchars(substr($order->equipDesc, 0, 200)) ?><?= strlen($order->equipDesc) > 200 ? '...' : '' ?></p>
                            <p style="margin-top: 12px; padding-top: 12px; border-top: 1px solid #e0e0e0;">
                                <strong>Quantity Ordered:</strong> <?= htmlspecialchars($order->quantity) ?> unit<?= $order->quantity > 1 ? 's' : '' ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="detail-section">
                <div class="detail-section-header">
                    <h3 class="detail-section-title">
                        <i class="bi bi-receipt"></i>
                        Order Summary
                    </h3>
                </div>
                <div class="detail-section-content">
                    <div class="detail-row" style="border: none; padding-bottom: 0;">
                        <div class="detail-item">
                            <span class="detail-label">Gross Amount</span>
                            <span class="detail-value amount">$<?= number_format($order->grossAmount, 2) ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Commission Amount</span>
                            <span class="detail-value" style="color: #ff4757;">$<?= number_format($order->commissionAmount ?? 0, 2) ?></span>
                        </div>
                    </div>
                    <div class="detail-row" style="border: none; padding-bottom: 0;">
                        <div class="detail-item">
                            <span class="detail-label">Commission Percent</span>
                            <span class="detail-value"><?= htmlspecialchars($order->commissionPercent ?? 0) ?>%</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Net Amount (After Commission)</span>
                            <span class="detail-value amount">$<?= number_format($order->netAmount ?? 0, 2) ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment & Status Information -->
            <div class="detail-section">
                <div class="detail-section-header">
                    <h3 class="detail-section-title">
                        <i class="bi bi-credit-card"></i>
                        Payment & Status Information
                    </h3>
                </div>
                <div class="detail-section-content">
                    <div class="detail-row">
                        <div class="detail-item">
                            <span class="detail-label">Payment Status</span>
                            <span class="detail-value">
                                <div style="margin-bottom: 8px; text-transform: capitalize;">
                                    <?= htmlspecialchars($order->paymentStatus) ?>
                                </div>
                                <div style="font-size: 12px; color: #6B7280; margin-top: 6px;">
                                    <strong>Payment to Company:</strong>
                                </div>
                                <?php if (!empty($order->fundsReleasedAt)): ?>
                                    <span style="color:#10B981; font-weight:600;"><i class="bi bi-check-circle-fill"></i> Released</span>
                                    <small style="color:#6B7280; display:block; margin-top:2px;"><?= date('M d, Y', strtotime($order->fundsReleasedAt)) ?></small>
                                <?php else: ?>
                                    <span style="color:#F59E0B; font-weight:600;"><i class="bi bi-hourglass-split"></i> Pending Release</span>
                                <?php endif; ?>
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Order Status</span>
                            <span class="detail-value" style="text-transform: capitalize;">
                                <?= htmlspecialchars($order->orderStatus) ?>
                            </span>
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-item">
                            <span class="detail-label">Sale Type</span>
                            <span class="detail-value" style="text-transform: capitalize;">
                                <?= htmlspecialchars($order->saleType) ?>
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Currency</span>
                            <span class="detail-value"><?= htmlspecialchars($order->currency) ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipping Information -->
            <?php if (!empty($order->trackingNumber) || !empty($order->shippedAt)): ?>
            <div class="detail-section">
                <div class="detail-section-header">
                    <h3 class="detail-section-title">
                        <i class="bi bi-truck"></i>
                        Shipping Information
                    </h3>
                </div>
                <div class="detail-section-content">
                    <div class="detail-row">
                        <div class="detail-item">
                            <span class="detail-label">Tracking Number</span>
                            <span class="detail-value"><?= htmlspecialchars($order->trackingNumber ?? 'N/A') ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Shipped At</span>
                            <span class="detail-value">
                                <?= $order->shippedAt ? date('F d, Y \a\t g:i A', strtotime($order->shippedAt)) : 'N/A' ?>
                            </span>
                        </div>
                    </div>
                    <?php if (!empty($order->shippingNotes)): ?>
                    <div class="detail-row" style="grid-template-columns: 1fr; border: none;">
                        <div class="detail-item">
                            <span class="detail-label">Shipping Notes</span>
                            <span class="detail-value">
                                <?= htmlspecialchars($order->shippingNotes) ?>
                            </span>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Approval Information -->
            <?php if (!empty($order->approvedAt)): ?>
            <div class="detail-section">
                <div class="detail-section-header">
                    <h3 class="detail-section-title">
                        <i class="bi bi-check-circle"></i>
                        Approval Information
                    </h3>
                </div>
                <div class="detail-section-content">
                    <div class="detail-row">
                        <div class="detail-item">
                            <span class="detail-label">Approved By</span>
                            <span class="detail-value"><?= htmlspecialchars($order->approvedByName ?? 'N/A') ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Approved At</span>
                            <span class="detail-value"><?= date('F d, Y \a\t g:i A', strtotime($order->approvedAt)) ?></span>
                        </div>
                    </div>
                    <?php if (!empty($order->rejectionReason)): ?>
                    <div class="detail-row" style="grid-template-columns: 1fr; border: none;">
                        <div class="detail-item">
                            <span class="detail-label">Rejection Reason</span>
                            <span class="detail-value">
                                <?= htmlspecialchars($order->rejectionReason) ?>
                            </span>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Action Section -->
            <div class="detail-section">
                <div class="detail-section-content">
                    <div class="action-section">
                        <a href="<?= base_url('super-admin-orders') ?>" class="btn-action btn-secondary">
                            <i class="bi bi-arrow-left"></i> Back to Orders
                        </a>
                        <?php if (!empty($order->chatID)): ?>
                        <a href="<?= base_url('chat/' . $order->equipmentPaymentID) ?>" class="btn-action btn-primary">
                            <i class="bi bi-chat-dots"></i> View Chat
                        </a>
                        <?php endif; ?>
                    </div>
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
        var saImages = <?= isset($images) ? json_encode(array_values(array_filter($images))) : '[]' ?>;
        var saCurrent = 0;
        var BASE = '<?= base_url() ?>';

        window.saGalleryNav = function(dir) {
            saGallerySet((saCurrent + dir + saImages.length) % saImages.length);
        };

        window.saGallerySet = function(idx) {
            saCurrent = idx;
            var mainImg = document.getElementById('saMainImg');
            var counter = document.getElementById('saGalleryCounter');
            if (mainImg) mainImg.src = BASE + saImages[idx];
            if (counter) counter.textContent = (idx + 1) + ' / ' + saImages.length;
            saImages.forEach(function(_, i) {
                var thumb = document.getElementById('saThumb' + i);
                if (thumb) thumb.style.borderColor = (i === idx) ? '#34FF67' : '#e0e0e0';
            });
        };
    })();
    </script>
</body>
</html>
