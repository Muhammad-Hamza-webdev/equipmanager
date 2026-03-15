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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    
    <title>My Orders - EquipManager</title>
    
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
            --table-shadow: 0px 4px 12px rgba(0, 0, 0, 0.05);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Manrope", sans-serif;
        }

        body {
            background-color: var(--body-bg);
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

        /* Page Title Section */
        .page-title-section {
            background-color: var(--card-bg);
            border-bottom: 1px solid var(--border-color);
            padding: 24px;
            margin-bottom: 24px;
            border-radius: 12px;
            box-shadow: var(--table-shadow);
        }

        .page-title {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            color: var(--text-primary);
        }

        .page-subtitle {
            margin: 8px 0 0 0;
            font-size: 14px;
            color: var(--text-secondary);
        }

        /* Status Filter Tabs */
        .status-filters {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
            flex-wrap: wrap;
            background: linear-gradient(135deg, #f0f9f4 0%, #ffffff 100%);
            padding: 20px;
            border-radius: 12px;
            border: 2px solid #e8f5f0;
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
            text-decoration: none;
        }

        .filter-btn:hover {
            border-color: var(--accent-green);
            color: var(--text-primary);
            background-color: #e8f5f0;
            text-decoration: none;
            transform: translateY(-2px);
        }

        .filter-btn.active {
            border-color: var(--accent-green);
            background: linear-gradient(135deg, #13372E 0%, #13372E 100%);
            color: white;
            font-weight: 700;
        }

        /* Sorting Controls */
        .table-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: nowrap;
            gap: 24px;
            padding: 16px 20px;
            background-color: #f9f9f9;
            border-bottom: 1px solid var(--border-color);
            border-radius: 12px 12px 0 0;
        }

        .sort-group {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: nowrap;
            white-space: nowrap;
        }

        .sort-label {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .sort-select {
            padding: 8px 12px;
            border: 2px solid var(--border-color);
            background-color: #ffffff;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-primary);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .sort-select:hover {
            border-color: var(--accent-green);
        }

        .sort-select:focus {
            outline: none;
            border-color: var(--accent-green);
        }

        /* Orders Table */
        .orders-table-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            border: 1px solid var(--border-color);
            overflow: hidden;
            box-shadow: var(--table-shadow);
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }

        thead {
            background-color: #f9f9f9;
            border-bottom: 2px solid var(--border-color);
        }

        th {
            padding: 16px;
            font-weight: 700;
            font-size: 13px;
            color: var(--text-primary);
            text-transform: uppercase;
            letter-spacing: 0.3px;
            border: none;
            text-align: left;
        }

        td {
            padding: 16px;
            border-bottom: 1px solid #f5f5f5;
            color: var(--text-secondary);
            font-size: 14px;
            vertical-align: middle;
        }

        tbody tr:hover {
            background-color: #fafafa;
        }

        .order-id {
            font-weight: 700;
            color: var(--text-primary);
            font-size: 15px;
        }

        /* Status Badges */
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-warning {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-info {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .status-primary {
            background-color: #d1e7f5;
            color: #004085;
        }

        .status-success {
            background-color: #d4edda;
            color: #155724;
        }

        .status-completed {
            background-color: #d4edda;
            color: #155724;
        }

        .status-shipped {
            background-color: #e0f0ff;
            color: #0057b8;
        }

        .status-danger {
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
            display: inline-flex;
            align-items: center;
            gap: 4px;
            text-decoration: none;
            background: none;
            border: 1px solid;
        }

        .btn-view {
            background-color: #f0f9f4;
            color: var(--accent-green);
            border: 1px solid #d0e8e0;
        }

        .btn-view:hover {
            background-color: #e0f5e8;
            border-color: var(--accent-green);
            text-decoration: none;
            transform: translateY(-2px);
        }

        .btn-chat {
            background-color: #e8f5ff;
            color: #0066cc;
            border: 1px solid #b3d9ff;
        }

        .btn-chat:hover {
            background-color: #d4ebff;
            text-decoration: none;
            transform: translateY(-2px);
        }

        .btn-pay {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #a3d9a5;
        }

        .btn-pay:hover {
            background-color: #c3e6cb;
            text-decoration: none;
            transform: translateY(-2px);
        }

        .btn-confirm {
            background-color: #34FF67;
            color: #0f2f2c;
            border: 1px solid #1fcc4f;
            font-weight: 700;
        }

        .btn-confirm:hover {
            background-color: #1fcc4f;
            text-decoration: none;
            transform: translateY(-2px);
        }

        .btn-confirm:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .btn-expired-link {
            background-color: #f3f4f6;
            color: #6b7280;
            border: 1px solid #d1d5db;
            cursor: not-allowed;
            opacity: 0.7;
        }

        .btn-expired-link:hover {
            background-color: #f3f4f6;
            color: #6b7280;
            text-decoration: none;
            transform: none;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-secondary);
        }

        .empty-state-icon {
            font-size: 48px;
            color: #ddd;
            margin-bottom: 16px;
        }

        .empty-state-text {
            font-size: 16px;
            color: var(--text-secondary);
        }

        @media (max-width: 1024px) {
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

            .table-controls {
                flex-direction: column;
                gap: 12px;
                align-items: flex-start;
            }

            th, td {
                padding: 12px;
                font-size: 12px;
            }

            .action-buttons {
                flex-direction: column;
                gap: 4px;
            }

            .btn-action {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Website Header -->
    <?php $this->load->view('components/websiteHeader'); ?>

    <div class="main-wrapper">
        <div class="dashboard-container">
            <!-- Dashboard Sidebar -->
            <?php $this->load->view('components/dashboardSidebar', ['active_page' => 'orders']); ?>

            <!-- Main Content -->
            <main class="dashboard-content">
                
                <!-- Page Title -->
                <div class="page-title-section">
                    <h1 class="page-title">My Orders</h1>
                    <p class="page-subtitle">View and manage your purchases</p>
                </div>

                <!-- Status Filter Tabs -->
                <div class="status-filters">
                    <a href="<?= base_url('orders') ?>" class="filter-btn <?= !$filter ? 'active' : '' ?>">
                        <i class="bi bi-list-ul"></i>
                        <span>All Orders</span>
                    </a>
                    <a href="<?= base_url('orders?status=requested') ?>" class="filter-btn <?= $filter == 'requested' ? 'active' : '' ?>">
                        <i class="bi bi-clock"></i>
                        <span>Pending</span>
                    </a>
                    <a href="<?= base_url('orders?status=payment_pending') ?>" class="filter-btn <?= $filter == 'payment_pending' ? 'active' : '' ?>">
                        <i class="bi bi-credit-card"></i>
                        <span>Awaiting Payment</span>
                    </a>
                    <a href="<?= base_url('orders?status=shipped') ?>" class="filter-btn <?= $filter == 'shipped' ? 'active' : '' ?>">
                        <i class="bi bi-truck"></i>
                        <span>On The Way</span>
                    </a>
                    <a href="<?= base_url('orders?status=completed') ?>" class="filter-btn <?= $filter == 'completed' ? 'active' : '' ?>">
                        <i class="bi bi-check-circle"></i>
                        <span>Completed</span>
                    </a>
                </div>

                <!-- Orders Table -->
                <div class="orders-table-card">
                    <!-- Table Controls -->
                    <div class="table-controls">
                        <div class="sort-group">
                            <label class="sort-label">Sort by:</label>
                            <select class="sort-select" onchange="sortTable(this.value)">
                                <option value="date-desc">Newest First</option>
                                <option value="date-asc">Oldest First</option>
                                <option value="amount-desc">Price: High to Low</option>
                                <option value="amount-asc">Price: Low to High</option>
                                <option value="id-asc">Order ID: A to Z</option>
                                <option value="id-desc">Order ID: Z to A</option>
                            </select>
                        </div>
                        <div class="sort-group">
                            <small style="color: #999; font-size: 12px;">
                                Total Orders: <strong id="total-orders-count">0</strong>
                            </small>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Equipment</th>
                                    <th>Category</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($orders)): ?>
                                    <?php foreach ($orders as $order): ?>
                                        <tr data-id="<?= htmlspecialchars($order->equipmentPaymentID) ?>" 
                                            data-date="<?= htmlspecialchars($order->createdAt) ?>" 
                                            data-amount="<?= htmlspecialchars($order->grossAmount) ?>">
                                            <td class="order-id">#<?= htmlspecialchars($order->equipmentPaymentID) ?></td>
                                            <td><?= htmlspecialchars($order->equipName ?? 'Equipment') ?></td>
                                            <td><?= htmlspecialchars($order->catName ?? 'N/A') ?></td>
                                            <td><strong>$<?= number_format($order->grossAmount, 2) ?></strong></td>
                                            <td><?= date('M d, Y', strtotime($order->createdAt)) ?></td>
                                            <td>
                                                <?php 
                                                    $orderStatus = $order->orderStatus ?? 'requested';
                                                    $status_labels = [
                                                        'requested'       => ['class' => 'status-warning',   'label' => 'Pending Approval'],
                                                        'payment_pending' => ['class' => 'status-info',      'label' => 'Awaiting Payment'],
                                                        'payment_secured' => ['class' => 'status-primary',   'label' => 'Payment Secured'],
                                                        'pickup_ready'    => ['class' => 'status-primary',   'label' => 'Ready for Pickup'],
                                                        'shipped'         => ['class' => 'status-shipped',   'label' => 'Shipment On The Way'],
                                                        'delivered'       => ['class' => 'status-success',   'label' => 'Delivered'],
                                                        'completed'       => ['class' => 'status-completed', 'label' => 'Completed'],
                                                        'rejected'        => ['class' => 'status-danger',    'label' => 'Rejected'],
                                                        'cancelled'       => ['class' => 'status-danger',    'label' => 'Cancelled'],
                                                    ];
                                                    $badge = $status_labels[$orderStatus] ?? ['class' => 'status-warning', 'label' => ucfirst(str_replace('_',' ',$orderStatus))];
                                                ?>
                                                <span class="status-badge <?= $badge['class'] ?>">
                                                    <?= $badge['label'] ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="<?= base_url('orders/' . $order->equipmentPaymentID) ?>" class="btn-action btn-view" title="View Details">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <?php if (!empty($order->chatID)): ?>
                                                    <a href="<?= base_url('chat/' . $order->equipmentPaymentID) ?>" class="btn-action btn-chat" title="Open Chat">
                                                        <i class="bi bi-chat-dots"></i>
                                                    </a>
                                                    <?php endif; ?>
                                                    <?php if ($orderStatus === 'payment_pending' && !empty($order->checkoutToken)): ?>
                                                        <?php 
                                                            $createdAt = strtotime($order->createdAt);
                                                            $expiresAt = $createdAt + (7 * 24 * 60 * 60); // 7 days in seconds
                                                            $isExpired = time() > $expiresAt;
                                                        ?>
                                                        <?php if (!$isExpired): ?>
                                                        <a href="<?= base_url('checkout/pay/' . $order->checkoutToken) ?>" class="btn-action btn-pay" title="Pay Now">
                                                            <i class="bi bi-credit-card"></i> Pay
                                                        </a>
                                                        <?php else: ?>
                                                        <button class="btn-action btn-expired-link" disabled title="Payment link expired after 7 days">
                                                            <i class="bi bi-exclamation-circle"></i> Expired
                                                        </button>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php if ($orderStatus === 'pickup_ready'): ?>
                                                    <button type="button" class="btn-action btn-confirm" onclick="confirmPickup(<?= $order->equipmentPaymentID ?>)" title="Confirm Pickup">
                                                        <i class="bi bi-bag-check"></i> Pickup
                                                    </button>
                                                    <?php endif; ?>
                                                    <?php if ($orderStatus === 'shipped'): ?>
                                                    <button type="button" class="btn-action btn-confirm" onclick="confirmDelivery(<?= $order->equipmentPaymentID ?>)" title="Confirm Receipt">
                                                        <i class="bi bi-check-circle"></i> Received
                                                    </button>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7">
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
        </div>
    </div>

    <!-- Website Footer -->
    <?php $this->load->view('components/websiteFooter'); ?>

    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    
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
            
            // Skip empty state row
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
            
            document.getElementById('total-orders-count').textContent = totalCount;
        }
        
        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateStats();
            sortTable('date-desc');
        });

        function confirmDelivery(orderId) {
            if (!confirm('Have you received your order? This will mark the order as completed and release payment to the seller.')) {
                return;
            }
            const btn = event.currentTarget;
            const originalHTML = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Processing...';

            const formData = new FormData();
            formData.append('order_id', orderId);
            formData.append('<?= $this->security->get_csrf_token_name() ?>', '<?= $this->security->get_csrf_hash() ?>');

            fetch('<?= base_url('orders/confirm_delivery') ?>', {
                method: 'POST',
                body: formData,
                credentials: 'include',
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert('✅ ' + data.message);
                    window.location.href = data.redirect;
                } else {
                    alert('❌ ' + data.message);
                    btn.disabled = false;
                    btn.innerHTML = originalHTML;
                }
            })
            .catch(err => {
                console.error(err);
                alert('⚠️ Something went wrong. Please try again.');
                btn.disabled = false;
                btn.innerHTML = originalHTML;
            });
        }

        function confirmPickup(orderId) {
            if (!confirm('Have you collected your order? Confirming pickup will release payment to the seller. This action cannot be undone.')) {
                return;
            }
            const btn = event.currentTarget;
            const originalHTML = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Processing...';

            const formData = new FormData();
            formData.append('order_id', orderId);
            formData.append('<?= $this->security->get_csrf_token_name() ?>', '<?= $this->security->get_csrf_hash() ?>');

            fetch('<?= base_url('orders/confirm_pickup') ?>', {
                method: 'POST',
                body: formData,
                credentials: 'include',
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert('✅ ' + data.message);
                    window.location.href = data.redirect;
                } else {
                    alert('❌ ' + data.message);
                    btn.disabled = false;
                    btn.innerHTML = originalHTML;
                }
            })
            .catch(err => {
                console.error(err);
                alert('⚠️ Something went wrong. Please try again.');
                btn.disabled = false;
                btn.innerHTML = originalHTML;
            });
        }
    </script>
</body>
</html>
