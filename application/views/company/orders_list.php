<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Orders - Equip Manager</title>
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

        /* Page Title Section */
        .page-title-section {
            background-color: #ffffff;
            border-bottom: 1px solid #f0f0f0;
            padding: 24px 0;
            margin-bottom: 24px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
        }

        .page-title-container {
            max-width: 100%;
            padding: 0 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .page-title {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            color: #0f2f2c;
            letter-spacing: -0.5px;
        }

        .page-subtitle {
            margin: 0;
            font-size: 14px;
            color: #666;
            font-weight: 400;
        }

        .page-title-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .stat-card {
            padding: 8px 16px;
            background-color: #f0f9f4;
            border-radius: 8px;
            text-align: center;
        }

        .stat-number {
            font-size: 20px;
            font-weight: 700;
            color: #34FF67;
            display: block;
        }

        .stat-label {
            font-size: 12px;
            color: #0f2f2c;
            font-weight: 500;
        }

        /* Alert Styles */
        .alert-custom {
            border: none;
            border-radius: 10px;
            padding: 16px 20px;
            margin-bottom: 24px;
            font-family: "Manrope", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .alert-success-custom {
            background-color: #f0f9f4;
            color: #0f2f2c;
            border-left: 4px solid #34FF67;
        }

        .alert-danger-custom {
            background-color: #fef0f0;
            color: #8b0000;
            border-left: 4px solid #ff6b6b;
        }

        /* Status Filter Tabs - Modern Style */
        .status-filters {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
            flex-wrap: wrap;
            background: linear-gradient(135deg, #f0f9f4 0%, #ffffff 100%);
            padding: 20px;
            border-radius: 12px;
            border: 2px solid #e8f5f0;
            box-shadow: 0 2px 8px rgba(52, 255, 103, 0.08);
        }

        .filter-btn {
            padding: 12px 24px;
            border: 2px solid #d0d0d0;
            background-color: #ffffff;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #666;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
            font-family: "Manrope", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            text-decoration: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .filter-btn:hover {
            border-color: #34FF67;
            color: #0f2f2c;
            background-color: #e8f5f0;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(52, 255, 103, 0.15);
            transform: translateY(-2px);
        }

        .filter-btn.active {
            border-color: #34FF67;
            background: linear-gradient(135deg, #34FF67 0%, #2ae050 100%);
            color: #0f2f2c;
            box-shadow: 0 4px 12px rgba(52, 255, 103, 0.25);
            font-weight: 700;
        }

        /* Sorting Controls */
        .table-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 20px;
            background-color: #f9f9f9;
            border-bottom: 1px solid #f0f0f0;
        }

        .sort-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .sort-label {
            font-size: 13px;
            font-weight: 600;
            color: #0f2f2c;
            font-family: "Manrope", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .sort-select {
            padding: 8px 12px;
            border: 2px solid #e0e0e0;
            background-color: #ffffff;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            color: #0f2f2c;
            cursor: pointer;
            font-family: "Manrope", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            transition: all 0.2s ease;
        }

        .sort-select:hover {
            border-color: #34FF67;
            box-shadow: 0 2px 8px rgba(52, 255, 103, 0.1);
        }

        .sort-select:focus {
            outline: none;
            border-color: #34FF67;
            box-shadow: 0 0 0 3px rgba(52, 255, 103, 0.1);
        }

        /* Orders Table - Modern Style */
        .orders-table-card {
            background-color: #ffffff;
            border-radius: 10px;
            border: 1px solid #f0f0f0;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .table {
            margin-bottom: 0;
            font-family: "Manrope", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .table thead {
            background-color: #f9f9f9;
            border-bottom: 2px solid #f0f0f0;
        }

        .table thead th {
            padding: 16px;
            font-weight: 700;
            font-size: 13px;
            color: #0f2f2c;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            border: none;
        }

        .table tbody td {
            padding: 16px;
            border-bottom: 1px solid #f5f5f5;
            color: #333;
            font-size: 14px;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: #fafafa;
        }

        .order-id {
            font-weight: 700;
            color: #0f2f2c;
            font-size: 15px;
        }

        .buyer-info {
            font-size: 14px;
        }

        .buyer-email {
            font-size: 12px;
            color: #999;
            margin-top: 4px;
        }

        /* Status Badges */
        .badge-custom {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            font-family: "Manrope", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
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

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn-action {
            padding: 8px 14px;
            border: 2px solid transparent;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            gap: 4px;
            font-family: "Manrope", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .btn-view {
            background-color: #f0f9f4;
            color: #0f2f2c;
            border: 2px solid #d0e8e0;
        }

        .btn-view:hover {
            background-color: #e0f5e8;
            border-color: #34FF67;
            box-shadow: 0 4px 12px rgba(52, 255, 103, 0.15);
            transform: translateY(-2px);
        }

        .btn-chat {
            background-color: #e8f5ff;
            color: #0066cc;
            border: 2px solid #b3d9ff;
        }

        .btn-chat:hover {
            background-color: #d4ebff;
            border-color: #0066cc;
            box-shadow: 0 4px 12px rgba(0, 102, 204, 0.15);
            transform: translateY(-2px);
        }

        .btn-accept {
            background-color: #d4edda;
            color: #155724;
            border: 2px solid #a3d9a5;
        }

        .btn-accept:hover {
            background-color: #c3e6cb;
            border-color: #34FF67;
            box-shadow: 0 4px 12px rgba(52, 255, 103, 0.15);
            transform: translateY(-2px);
        }

        .btn-reject {
            background-color: #f8d7da;
            color: #721c24;
            border: 2px solid #f5c6cb;
        }

        .btn-reject:hover {
            background-color: #f5c2c7;
            border-color: #ff6b6b;
            box-shadow: 0 4px 12px rgba(255, 107, 107, 0.15);
            transform: translateY(-2px);
        }

        .btn-ship {
            background-color: #34FF67;
            color: #0f2f2c;
            border: 2px solid #2ae050;
        }

        .btn-ship:hover {
            background-color: #2ae050;
            border-color: #1fb83f;
            box-shadow: 0 4px 12px rgba(52, 255, 103, 0.25);
            transform: translateY(-2px);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }

        .empty-state-icon {
            font-size: 48px;
            color: #ddd;
            margin-bottom: 16px;
        }

        .empty-state-text {
            font-size: 16px;
            color: #666;
        }

        @media (max-width: 768px) {
            .page-title-container {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .page-title-right {
                width: 100%;
                justify-content: flex-start;
            }

            .status-filters {
                gap: 8px;
            }

            .filter-btn {
                padding: 8px 16px;
                font-size: 13px;
            }

            .table thead th,
            .table tbody td {
                padding: 12px;
                font-size: 12px;
            }

            .action-buttons {
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
                    <div class="breadcrumb-title pe-3">Orders</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="<?= base_url('company-dashboard') ?>"><i class="bx bx-home-alt"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Orders List</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                
                <!-- Page Title Section -->
                <div class="page-title-section">
                    <div class="page-title-container">
                        <div class="page-title-left">
                            <div>
                                <h1 class="page-title">Orders</h1>
                                <p class="page-subtitle">Manage your purchase requests and orders</p>
                            </div>
                        </div>
                        <div class="page-title-right">
                            <div class="stat-card">
                                <span class="stat-number" id="total-orders-stat">0</span>
                                <span class="stat-label">Total Orders</span>
                            </div>
                            <div class="stat-card">
                                <span class="stat-number" id="pending-orders-stat">0</span>
                                <span class="stat-label">Pending</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Flash Messages -->
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-custom alert-success-custom alert-dismissible fade show">
                        <strong>✓ Success!</strong> <?= $this->session->flashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-custom alert-danger-custom alert-dismissible fade show">
                        <strong>✕ Error!</strong> <?= $this->session->flashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                
                <!-- Status Filter Tabs -->
                <div class="status-filters">
                    <a href="<?= base_url('company-orders') ?>" class="filter-btn <?= !$filter ? 'active' : '' ?>">
                        <i class="bi bi-list-ul"></i>
                        <span>All Orders</span>
                    </a>
                    <a href="<?= base_url('company-orders?status=requested') ?>" class="filter-btn <?= $filter == 'requested' ? 'active' : '' ?>">
                        <i class="bi bi-clock"></i>
                        <span>Pending Approval</span>
                    </a>
                    <a href="<?= base_url('company-orders?status=payment_pending') ?>" class="filter-btn <?= $filter == 'payment_pending' ? 'active' : '' ?>">
                        <i class="bi bi-credit-card"></i>
                        <span>Awaiting Payment</span>
                    </a>
                    <a href="<?= base_url('company-orders?status=payment_secured') ?>" class="filter-btn <?= $filter == 'payment_secured' ? 'active' : '' ?>">
                        <i class="bi bi-box"></i>
                        <span>Needs Action</span>
                    </a>
                    <a href="<?= base_url('company-orders?status=shipped') ?>" class="filter-btn <?= $filter == 'shipped' ? 'active' : '' ?>">
                        <i class="bi bi-truck"></i>
                        <span>On The Way</span>
                    </a>
                    <a href="<?= base_url('company-orders?status=pickup_ready') ?>" class="filter-btn <?= $filter == 'pickup_ready' ? 'active' : '' ?>">
                        <i class="bi bi-bag-check"></i>
                        <span>Ready for Pickup</span>
                    </a>
                </div>
                
                <!-- Orders Table -->
                <div class="orders-table-card">
                    <!-- Table Controls -->
                    <div class="table-controls">
                        <div class="sort-group">
                            <label class="sort-label" for="sortSelect">Sort by:</label>
                            <select id="sortSelect" class="sort-select" onchange="sortTable(this.value)">
                                <option value="date-desc">Newest First</option>
                                <option value="date-asc">Oldest First</option>
                                <option value="amount-desc">Amount: High to Low</option>
                                <option value="amount-asc">Amount: Low to High</option>
                                <option value="id-desc">Order ID: Z to A</option>
                                <option value="id-asc">Order ID: A to Z</option>
                            </select>
                        </div>
                        <div class="sort-group">
                            <small style="color: #999; font-size: 12px;">
                                <i class="bi bi-info-circle"></i>&nbsp;
                                <span id="totalOrdersCount">0</span> order<span id="pluralS">s</span>
                            </small>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Equipment</th>
                                    <th>Buyer</th>
                                    <th>Qty</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($orders)): ?>
                                    <?php foreach ($orders as $order): ?>
                                        <tr data-id="<?= $order->equipmentPaymentID ?>" 
                                            data-date="<?= $order->createdAt ?>" 
                                            data-amount="<?= $order->grossAmount ?>">
                                            <td><span class="order-id">#<?= $order->equipmentPaymentID ?></span></td>
                                            <td>
                                                <strong><?= htmlspecialchars($order->equipName) ?></strong>
                                            </td>
                                            <td>
                                                <div class="buyer-info">
                                                    <strong><?= htmlspecialchars($order->buyerName) ?></strong>
                                                    <div class="buyer-email"><?= htmlspecialchars($order->buyerEmail) ?></div>
                                                </div>
                                            </td>
                                            <td><?= $order->quantity ?></td>
                                            <td><strong>$<?= number_format($order->grossAmount, 2) ?></strong></td>
                                            <td>
                                                <?php 
                                                $status_badges = [
                                                    'requested' => '<span class="badge-custom badge-pending">Pending Approval</span>',
                                                    'payment_pending' => '<span class="badge-custom badge-payment">Awaiting Payment</span>',
                                                    'payment_secured' => '<span class="badge-custom badge-secured">Payment Secured</span>',
                                                    'shipped' => '<span class="badge-custom badge-shipped">Shipment On The Way</span>',
                                                    'pickup_ready' => '<span class="badge-custom badge-secured">Ready for Pickup</span>',
                                                    'delivered' => '<span class="badge-custom badge-shipped">Delivered</span>',
                                                    'completed' => '<span class="badge-custom badge-completed">Completed</span>',
                                                    'rejected' => '<span class="badge-custom badge-rejected">Rejected</span>',
                                                    'cancelled' => '<span class="badge-custom badge-rejected">Cancelled</span>',
                                                    'refunded' => '<span class="badge-custom badge-rejected">Refunded</span>'
                                                ];
                                                echo $status_badges[$order->orderStatus] ?? '<span class="badge-custom">' . ucfirst($order->orderStatus) . '</span>';
                                                ?>
                                            </td>
                                            <td><small><?= date('M d, Y', strtotime($order->createdAt)) ?></small></td>
                                            <td>
                                                <div class="action-buttons">
                                                    <!-- View Details -->
                                                    <button type="button" class="btn-action btn-view" 
                                                            onclick="viewOrderDetails(<?= $order->equipmentPaymentID ?>)"
                                                            title="View Details">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                    
                                                    <!-- Chat -->
                                                    <a href="<?= base_url('chat/view/' . $order->equipmentPaymentID) ?>" 
                                                       class="btn-action btn-chat" 
                                                       title="Open Chat">
                                                        <i class="bi bi-chat-dots"></i>
                                                    </a>
                                                    
                                                    <!-- Accept/Reject (only for requested) -->
                                                    <?php if ($order->orderStatus == 'requested'): ?>
                                                        <form method="POST" action="<?= base_url('company-orders/accept') ?>" style="display: inline;">
                                                            <input type="hidden" name="order_id" value="<?= $order->equipmentPaymentID ?>" />
                                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                                                            <button type="submit" class="btn-action btn-accept" 
                                                                    onclick="return confirm('Accept this purchase request?')"
                                                                    title="Accept Request">
                                                                <i class="bi bi-check-circle"></i>
                                                            </button>
                                                        </form>
                                                        
                                                        <button type="button" class="btn-action btn-reject" 
                                                                onclick="rejectOrder(<?= $order->equipmentPaymentID ?>)"
                                                                title="Reject Request">
                                                            <i class="bi bi-x-circle"></i>
                                                        </button>
                                                    <?php endif; ?>
                                                    
                                                    <!-- Mark as Shipped OR Allow Pickup (only for payment_secured) -->
                                                    <?php if ($order->orderStatus == 'payment_secured'): ?>
                                                        <?php
                                                        $_om  = json_decode($order->paymentMetadata ?? '{}', true);
                                                        $_odm = intval($_om['delivery_method'] ?? 0);
                                                        ?>
                                                        <?php if ($_odm === 2): // delivery ?>
                                                            <button type="button" class="btn-action btn-ship" 
                                                                    onclick="markAsShipped(<?= $order->equipmentPaymentID ?>)"
                                                                    title="Mark as Shipped">
                                                                <i class="bi bi-truck"></i>
                                                            </button>
                                                        <?php else: // pickup ?>
                                                            <form method="POST" action="<?= base_url('company-orders/allow_pickup') ?>" style="display:inline;">
                                                                <input type="hidden" name="order_id" value="<?= $order->equipmentPaymentID ?>">
                                                                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                                                                <button type="submit" class="btn-action btn-accept"
                                                                        onclick="return confirm('Allow buyer to pick up order #<?= $order->equipmentPaymentID ?>?')"
                                                                        title="Allow Pickup">
                                                                    <i class="bi bi-bag-check"></i>
                                                                </button>
                                                            </form>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8">
                                            <div class="empty-state">
                                                <div class="empty-state-icon"><i class="bi bi-inbox"></i></div>
                                                <div class="empty-state-text">No orders found</div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
        
        <!-- Overlay -->
        <div class="overlay toggle-icon"></div>
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        
    </div>
    
    <!-- Reject Modal -->
    <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 10px; border: none; font-family: 'Manrope', sans-serif;">
                <div class="modal-header" style="border-bottom: 1px solid #f0f0f0; padding: 24px;">
                    <h5 class="modal-title" id="rejectModalLabel" style="color: #0f2f2c; font-weight: 700;">Reject Purchase Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="rejectForm" method="POST" action="<?= base_url('company-orders/reject') ?>">
                    <div class="modal-body" style="padding: 24px;">
                        <input type="hidden" name="order_id" id="reject_order_id" />
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                        
                        <div class="mb-3">
                            <label for="rejection_reason" class="form-label" style="color: #0f2f2c; font-weight: 600; font-family: 'Manrope', sans-serif;">Reason for Rejection <span style="color: #999;">(Optional)</span></label>
                            <textarea class="form-control" id="rejection_reason" name="rejection_reason" rows="4" placeholder="Enter reason..." style="border-radius: 8px; border: 1px solid #ddd; font-family: 'Manrope', sans-serif; padding: 12px;"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid #f0f0f0; padding: 16px; background-color: #f9f9f9;">
                        <button type="button" class="btn" data-bs-dismiss="modal" style="color: #666; background-color: #f0f0f0; border-radius: 6px; padding: 10px 24px; font-weight: 600; border: none; font-family: 'Manrope', sans-serif;">Cancel</button>
                        <button type="submit" class="btn" style="background-color: #ff6b6b; color: white; border-radius: 6px; padding: 10px 24px; font-weight: 600; border: none; font-family: 'Manrope', sans-serif;">Reject Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Mark as Shipped Modal -->
    <div class="modal fade" id="shippingModal" tabindex="-1" aria-labelledby="shippingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 10px; border: none; font-family: 'Manrope', sans-serif;">
                <div class="modal-header" style="border-bottom: 1px solid #f0f0f0; padding: 24px;">
                    <h5 class="modal-title" id="shippingModalLabel" style="color: #0f2f2c; font-weight: 700;">Mark Order as Shipped</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="shippingForm" method="POST" action="<?= base_url('company-orders/mark_shipped') ?>">
                    <div class="modal-body" style="padding: 24px;">
                        <input type="hidden" name="order_id" id="shipping_order_id" />
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                        
                        <div class="mb-3">
                            <label for="tracking_number" class="form-label" style="color: #0f2f2c; font-weight: 600; font-family: 'Manrope', sans-serif;">Tracking Number <span style="color: #999;">(Optional)</span></label>
                            <input type="text" class="form-control" id="tracking_number" name="tracking_number" placeholder="Enter tracking number..." style="border-radius: 8px; border: 1px solid #ddd; font-family: 'Manrope', sans-serif; padding: 12px;">
                        </div>
                        
                        <div class="mb-3">
                            <label for="shipping_notes" class="form-label" style="color: #0f2f2c; font-weight: 600; font-family: 'Manrope', sans-serif;">Shipping Notes <span style="color: #999;">(Optional)</span></label>
                            <textarea class="form-control" id="shipping_notes" name="shipping_notes" rows="3" placeholder="Any additional shipping information..." style="border-radius: 8px; border: 1px solid #ddd; font-family: 'Manrope', sans-serif; padding: 12px;"></textarea>
                        </div>
                        
                        <div style="background-color: #f0f9f4; border: 1px solid #34FF67; border-radius: 8px; padding: 12px 16px; color: #0f2f2c;">
                            <i class="bi bi-info-circle" style="color: #34FF67; margin-right: 8px;"></i>
                            <strong>Note:</strong> The buyer will be notified via chat that their order has been shipped.
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid #f0f0f0; padding: 16px; background-color: #f9f9f9;">
                        <button type="button" class="btn" data-bs-dismiss="modal" style="color: #666; background-color: #f0f0f0; border-radius: 6px; padding: 10px 24px; font-weight: 600; border: none; font-family: 'Manrope', sans-serif;">Cancel</button>
                        <button type="submit" class="btn" style="background-color: #34FF67; color: #0f2f2c; border-radius: 6px; padding: 10px 24px; font-weight: 600; border: none; font-family: 'Manrope', sans-serif;">Confirm Shipment</button>
                    </div>
                </form>
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
        // Efficient Merge Sort Algorithm for table rows
        function mergeSort(arr, compareFn) {
            if (arr.length <= 1) return arr;
            
            const mid = Math.floor(arr.length / 2);
            const left = mergeSort(arr.slice(0, mid), compareFn);
            const right = mergeSort(arr.slice(mid), compareFn);
            
            return merge(left, right, compareFn);
        }

        function merge(left, right, compareFn) {
            const result = [];
            let i = 0, j = 0;
            
            while (i < left.length && j < right.length) {
                if (compareFn(left[i], right[j]) <= 0) {
                    result.push(left[i++]);
                } else {
                    result.push(right[j++]);
                }
            }
            
            return result.concat(left.slice(i)).concat(right.slice(j));
        }

        // Sort table function
        function sortTable(sortBy) {
            const tbody = document.querySelector('table tbody');
            const rows = Array.from(tbody.querySelectorAll('tr'));
            
            // Skip empty state row
            const emptyStateRow = rows.find(row => row.querySelector('.empty-state-icon'));
            const dataRows = rows.filter(row => !row.querySelector('.empty-state-icon'));
            
            if (dataRows.length === 0) return;
            
            let compareFn;
            
            switch(sortBy) {
                case 'date-desc':
                    // Newest first (descending)
                    compareFn = (a, b) => {
                        const dateA = new Date(a.getAttribute('data-date'));
                        const dateB = new Date(b.getAttribute('data-date'));
                        return dateB - dateA;
                    };
                    break;
                case 'date-asc':
                    // Oldest first (ascending)
                    compareFn = (a, b) => {
                        const dateA = new Date(a.getAttribute('data-date'));
                        const dateB = new Date(b.getAttribute('data-date'));
                        return dateA - dateB;
                    };
                    break;
                case 'amount-desc':
                    // High to low
                    compareFn = (a, b) => {
                        const amountA = parseFloat(a.getAttribute('data-amount'));
                        const amountB = parseFloat(b.getAttribute('data-amount'));
                        return amountB - amountA;
                    };
                    break;
                case 'amount-asc':
                    // Low to high
                    compareFn = (a, b) => {
                        const amountA = parseFloat(a.getAttribute('data-amount'));
                        const amountB = parseFloat(b.getAttribute('data-amount'));
                        return amountA - amountB;
                    };
                    break;
                case 'id-desc':
                    // Z to A
                    compareFn = (a, b) => {
                        const idA = a.getAttribute('data-id');
                        const idB = b.getAttribute('data-id');
                        return idB.localeCompare(idA);
                    };
                    break;
                case 'id-asc':
                    // A to Z
                    compareFn = (a, b) => {
                        const idA = a.getAttribute('data-id');
                        const idB = b.getAttribute('data-id');
                        return idA.localeCompare(idB);
                    };
                    break;
                default:
                    return;
            }
            
            // Sort using merge sort
            const sortedRows = mergeSort(dataRows, compareFn);
            
            // Clear tbody
            tbody.innerHTML = '';
            
            // Append sorted rows
            sortedRows.forEach(row => tbody.appendChild(row));
        }

        // Update statistics on page load
        function updateStats() {
            const rows = document.querySelectorAll('table tbody tr');
            let totalCount = 0;
            let pendingCount = 0;
            
            rows.forEach(row => {
                const statusCell = row.querySelector('td:nth-child(6)');
                if (statusCell && !row.querySelector('.empty-state-icon')) {
                    totalCount++;
                    if (statusCell.textContent.includes('Pending')) {
                        pendingCount++;
                    }
                }
            });
            
            document.getElementById('total-orders-stat').textContent = totalCount;
            document.getElementById('pending-orders-stat').textContent = pendingCount;
            document.getElementById('totalOrdersCount').textContent = totalCount;
            
            // Update plural form
            const pluralS = document.getElementById('pluralS');
            if (totalCount === 1) {
                pluralS.textContent = '';
            } else {
                pluralS.textContent = 's';
            }
        }
        
        function rejectOrder(orderId) {
            document.getElementById('reject_order_id').value = orderId;
            var rejectModal = new bootstrap.Modal(document.getElementById('rejectModal'));
            rejectModal.show();
        }
        
        function markAsShipped(orderId) {
            document.getElementById('shipping_order_id').value = orderId;
            var shippingModal = new bootstrap.Modal(document.getElementById('shippingModal'));
            shippingModal.show();
        }
        
        function viewOrderDetails(orderId) {
            window.location.href = '<?= base_url("company-orders/view/") ?>' + orderId;
        }
        
        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateStats();
            // Sort by newest first by default
            sortTable('date-desc');
        });
    </script>
</body>
</html>
