<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>All Orders - Equip Manager</title>
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

        .company-name {
            font-weight: 600;
            color: #0f2f2c;
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
                <div class="breadcrumb-title pe-3">All Orders</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="<?= base_url('admin-dashboard') ?>"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">All Orders</li>
                        </ol>
                    </nav>
                </div>
            </div>
            
            <!-- Page Title Section -->
            <div class="page-title-section">
                <div class="page-title-container">
                    <div class="page-title-left">
                        <div>
                            <h3 class="page-title">All Website Orders</h3>
                            <p class="page-subtitle">View and manage all orders from all companies</p>
                        </div>
                    </div>
                    <div class="page-title-right">
                        <div class="stat-card">
                            <span class="stat-number" id="total-orders-stat">0</span>
                            <span class="stat-label">Total Order<span id="pluralS">s</span></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Filter Tabs -->
            <div class="status-filters">
                <a href="<?= base_url('super-admin-orders') ?>" class="filter-btn <?= !$filter ? 'active' : '' ?>">
                    <i class="bi bi-list-ul"></i>
                    <span>All Orders</span>
                </a>
                <a href="<?= base_url('super-admin-orders?status=requested') ?>" class="filter-btn <?= $filter == 'requested' ? 'active' : '' ?>">
                    <i class="bi bi-clock"></i>
                    <span>Pending Approval</span>
                </a>
                <a href="<?= base_url('super-admin-orders?status=payment_pending') ?>" class="filter-btn <?= $filter == 'payment_pending' ? 'active' : '' ?>">
                    <i class="bi bi-credit-card"></i>
                    <span>Awaiting Payment</span>
                </a>
                <a href="<?= base_url('super-admin-orders?status=payment_secured') ?>" class="filter-btn <?= $filter == 'payment_secured' ? 'active' : '' ?>">
                    <i class="bi bi-box"></i>
                    <span>Ready to Ship</span>
                </a>
                <a href="<?= base_url('super-admin-orders?status=shipped') ?>" class="filter-btn <?= $filter == 'shipped' ? 'active' : '' ?>">
                    <i class="bi bi-truck"></i>
                    <span>Shipped</span>
                </a>
            </div>
            
            <!-- Orders Table -->
            <div class="orders-table-card">
                <!-- Table Controls -->
                <div class="table-controls">
                    <div class="sort-group">
                        <label class="sort-label">Sort By:</label>
                        <select class="sort-select" onchange="sortTable(this.value)">
                            <option value="date-desc">Newest First</option>
                            <option value="date-asc">Oldest First</option>
                            <option value="amount-desc">Amount: High to Low</option>
                            <option value="amount-asc">Amount: Low to High</option>
                            <option value="id-asc">Order ID: A to Z</option>
                            <option value="id-desc">Order ID: Z to A</option>
                        </select>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Buyer Name</th>
                                <th>Company</th>
                                <th>Amount</th>
                                <th>Commission</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($orders)): ?>
                                <?php foreach ($orders as $order): ?>
                                    <tr data-id="<?= htmlspecialchars($order->equipmentPaymentID) ?>" 
                                        data-date="<?= htmlspecialchars($order->createdAt) ?>" 
                                        data-amount="<?= htmlspecialchars($order->grossAmount) ?>">
                                        <td class="order-id">#<?= htmlspecialchars($order->equipmentPaymentID) ?></td>
                                        <td>
                                            <div class="buyer-info"><?= htmlspecialchars($order->buyerFirstName) ?></div>
                                            <div class="buyer-email"><?= htmlspecialchars($order->buyerEmail) ?></div>
                                        </td>
                                        <td><span class="company-name"><?= htmlspecialchars($order->companyName ?? 'N/A') ?></span></td>
                                        <td><strong>$<?= number_format($order->grossAmount, 2) ?></strong></td>
                                        <td><span class="text-success">$<?= number_format($order->commission ?? 0, 2) ?></span></td>
                                        <td>
                                            <?php 
                                                $status_map = [
                                                    'requested' => 'badge-pending',
                                                    'payment_pending' => 'badge-payment',
                                                    'payment_secured' => 'badge-secured',
                                                    'shipped' => 'badge-shipped',
                                                    'pickup_ready' => 'badge-secured',
                                                    'completed' => 'badge-completed',
                                                    'rejected' => 'badge-rejected'
                                                ];
                                                $badge_class = $status_map[$order->status] ?? 'badge-pending';
                                            ?>
                                            <span class="badge-custom <?= $badge_class ?>">
                                                <?= ucfirst(str_replace('_', ' ', htmlspecialchars($order->status))) ?>
                                            </span>
                                        </td>
                                        <td><?= date('M d, Y', strtotime($order->createdAt)) ?></td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="<?= base_url('super-admin-orders/view/' . $order->equipmentPaymentID) ?>" class="btn-action btn-view">
                                                    <i class="bi bi-eye"></i> View
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8">
                                        <div class="empty-state">
                                            <div class="empty-state-icon"><i class="bi bi-inbox"></i></div>
                                            <p class="empty-state-text">No orders found</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
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
        // Merge Sort Algorithm
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
            
            const emptyStateRow = rows.find(row => row.querySelector('.empty-state-icon'));
            const dataRows = rows.filter(row => !row.querySelector('.empty-state-icon'));
            
            if (dataRows.length === 0) return;
            
            let compareFn;
            
            switch(sortBy) {
                case 'date-desc':
                    compareFn = (a, b) => {
                        const dateA = new Date(a.getAttribute('data-date'));
                        const dateB = new Date(b.getAttribute('data-date'));
                        return dateB - dateA;
                    };
                    break;
                case 'date-asc':
                    compareFn = (a, b) => {
                        const dateA = new Date(a.getAttribute('data-date'));
                        const dateB = new Date(b.getAttribute('data-date'));
                        return dateA - dateB;
                    };
                    break;
                case 'amount-desc':
                    compareFn = (a, b) => {
                        const amountA = parseFloat(a.getAttribute('data-amount'));
                        const amountB = parseFloat(b.getAttribute('data-amount'));
                        return amountB - amountA;
                    };
                    break;
                case 'amount-asc':
                    compareFn = (a, b) => {
                        const amountA = parseFloat(a.getAttribute('data-amount'));
                        const amountB = parseFloat(b.getAttribute('data-amount'));
                        return amountA - amountB;
                    };
                    break;
                case 'id-desc':
                    compareFn = (a, b) => {
                        const idA = a.getAttribute('data-id');
                        const idB = b.getAttribute('data-id');
                        return idB.localeCompare(idA);
                    };
                    break;
                case 'id-asc':
                    compareFn = (a, b) => {
                        const idA = a.getAttribute('data-id');
                        const idB = b.getAttribute('data-id');
                        return idA.localeCompare(idB);
                    };
                    break;
                default:
                    return;
            }
            
            const sortedRows = mergeSort(dataRows, compareFn);
            tbody.innerHTML = '';
            sortedRows.forEach(row => tbody.appendChild(row));
        }

        // Update statistics
        function updateStats() {
            const rows = document.querySelectorAll('table tbody tr');
            let totalCount = 0;
            
            rows.forEach(row => {
                if (!row.querySelector('.empty-state-icon')) {
                    totalCount++;
                }
            });
            
            document.getElementById('total-orders-stat').textContent = totalCount;
            const pluralS = document.getElementById('pluralS');
            pluralS.textContent = totalCount === 1 ? '' : 's';
        }
        
        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateStats();
            sortTable('date-desc');
        });
    </script>
</body>
</html>
