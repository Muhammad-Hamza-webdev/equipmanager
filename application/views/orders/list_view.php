<!-- Orders Listing Card -->
<div class="orders-card">
    <!-- Header Section -->
    <div class="orders-header">
        <h1 class="orders-title">All Orders</h1>
    </div>

    <!-- Orders Table or Empty State -->
    <?php if (!empty($orders)): ?>
        <div class="table-container">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Order Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
<!-- START DEBUG -->
<script>
console.log('======= ORDERS PAGE LOADED =======');
console.log('Total Orders Count: <?= count($orders) ?>');
</script>
<!-- END DEBUG -->

    <?php foreach ($orders as $order): ?>
                        <?php $orderStatus = $order->orderStatus ?? 'requested'; ?>
                        <script>console.log('Order #' + <?= $order->equipmentPaymentID ?> + ' Status: ' + '<?= $orderStatus ?>');</script>
                        <tr class="order-row">
                            <td class="order-name">
                                <span><?= htmlspecialchars($order->equipName ?? 'Equipment') ?></span>
                            </td>
                            <td class="order-category">
                                <span><?= htmlspecialchars($order->catName ?? 'N/A') ?></span>
                            </td>
                            <td class="order-price">
                                <span>$<?= number_format($order->grossAmount ?? 0, 2) ?></span>
                            </td>
                            <td class="order-date">
                                <span><?= date('m/d/Y', strtotime($order->createdAt ?? now())) ?></span>
                            </td>
                            <td class="order-status">
                                <?php 
                                $status_badges = [
                                    'requested' => '<span class="status-badge status-warning">Pending Approval</span>',
                                    'payment_pending' => '<span class="status-badge status-info">Awaiting Payment</span>',
                                    'payment_secured' => '<span class="status-badge status-primary">Payment Secured</span>',
                                    'shipped' => '<span class="status-badge status-info">Shipment On The Way</span>',
                                    'pickup_ready' => '<span class="status-badge status-primary">Ready for Pickup</span>',
                                    'delivered' => '<span class="status-badge status-success">Delivered</span>',
                                    'completed' => '<span class="status-badge status-completed">Completed</span>',
                                    'rejected' => '<span class="status-badge status-danger">Rejected</span>',
                                    'cancelled' => '<span class="status-badge status-secondary">Cancelled</span>'
                                ];
                                echo $status_badges[$orderStatus] ?? '<span class="status-badge status-secondary">' . ucfirst($orderStatus) . '</span>';
                                ?>
                            </td>
                            <td class="order-action">
                                <div class="action-buttons">
                                    <!-- View Details Button -->
                                    <button class="view-button" onclick="viewOrder(<?= $order->equipmentPaymentID ?>)" title="View Details">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    
                                    <!-- Chat Button (if chat exists) -->
                                    <?php if (isset($order->chatID) && $order->chatID): ?>
                                    <a href="<?= base_url('chat/' . $order->equipmentPaymentID) ?>" class="chat-button" title="Open Chat">
                                        <i class="bi bi-chat-dots"></i>
                                    </a>
                                    <?php endif; ?>
                                    
                                    <!-- Pay Now Button (only if payment_pending) -->
                                    <?php if ($orderStatus === 'payment_pending'): 
                                        $now_str = date('Y-m-d H:i:s');
                                        if (!empty($order->checkoutTokenExpiry)) {
                                            $token_expired = $order->checkoutTokenExpiry < $now_str;
                                        } else {
                                            $token_expired = !empty($order->createdAt) && $order->createdAt < date('Y-m-d H:i:s', strtotime('-7 days'));
                                        }
                                        if (!empty($order->checkoutToken) && !$token_expired): ?>
                                    <a href="<?= base_url('checkout/pay/' . $order->checkoutToken) ?>" class="btn-pay-now" title="Complete Payment">
                                        <i class="bi bi-credit-card"></i> Pay Now
                                    </a>
                                        <?php elseif ($token_expired): ?>
                                    <span class="btn-expired-link" title="Payment link has expired. Please contact the seller to request a new link.">
                                        <i class="bi bi-clock-history"></i> Link Expired
                                    </span>
                                        <?php endif;
                                    endif; ?>
                                    
                                    <!-- Confirm Receipt Button (only if shipped) -->
                                    <?php if ($orderStatus === 'shipped'): ?>
                                    <button type="button" class="btn-confirm-delivery" onclick="confirmDelivery(<?= $order->equipmentPaymentID ?>)">
                                        <i class="bi bi-check-circle"></i> Confirm
                                    </button>
                                    <?php endif; ?>
                                    
                                    <!-- Confirm Pickup Button (only if pickup_ready) -->
                                    <?php if ($orderStatus === 'pickup_ready'): ?>
                                    <script>console.log('✅ PICKUP READY DETECTED for order #<?= $order->equipmentPaymentID ?>');</script>
                                    <button type="button" class="btn-confirm-delivery" onclick="confirmPickup(<?= $order->equipmentPaymentID ?>)">
                                        <i class="bi bi-bag-check"></i> Pickup
                                    </button>
                                    <?php else: ?>
                                    <script>console.log('❌ Order #<?= $order->equipmentPaymentID ?> status: <?= htmlspecialchars($orderStatus) ?>');</script>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination (if needed) -->
        <div class="orders-pagination">
            <button class="pagination-btn prev" onclick="previousPage()">Previous</button>
            <span class="pagination-info">Page <span id="current-page">1</span> of <span id="total-pages">1</span></span>
            <button class="pagination-btn next" onclick="nextPage()">Next</button>
        </div>
    <?php else: ?>
        <!-- Empty State -->
        <div class="empty-state">
            <i class="bi bi-bag-x"></i>
            <p class="empty-title">No orders yet</p>
            <p class="empty-subtitle">When you place orders, they will appear here.</p>
            <a href="<?= base_url('marketplace') ?>" class="browse-button">
                <i class="bi bi-shop"></i> Browse Marketplace
            </a>
        </div>
    <?php endif; ?>
</div>

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
        --table-shadow: 0px 4px 12px rgba(0, 0, 0, 0.05);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Orders Card Container */
    .orders-card {
        background: var(--card-bg);
        border-radius: 12px;
        box-shadow: var(--table-shadow);
        padding: 32px;
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    /* Orders Header */
    .orders-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

    .orders-title {
        font-size: 20px;
        font-weight: 700;
        color: var(--text-primary);
        font-family: "Manrope", sans-serif;
    }

    /* Table Container */
    .table-container {
        overflow-x: auto;
        border-radius: 8px;
    }

    /* Orders Table */
    .orders-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    /* Table Header */
    .orders-table thead {
        background-color: #F9FAFB;
    }

    .orders-table thead th {
        padding: 16px;
        text-align: left;
        font-size: 14px;
        font-weight: 600;
        color: var(--text-secondary);
        border-bottom: 1px solid var(--border-color);
        font-family: "Manrope", sans-serif;
    }

    /* Table Body Rows */
    .orders-table tbody tr {
        border-bottom: 1px solid var(--border-color);
        transition: background-color 0.2s ease;
    }

    .orders-table tbody tr:hover {
        background-color: #F9FAFB;
    }

    .orders-table tbody td {
        padding: 20px 16px;
        color: var(--text-primary);
        font-family: "Manrope", sans-serif;
    }

    /* Table Cell Content */
    .order-name {
        font-weight: 500;
        color: var(--text-primary);
    }

    .order-category {
        color: var(--text-secondary);
    }

    .order-price {
        font-weight: 600;
        color: var(--primary-brand);
    }

    .order-date {
        color: var(--text-secondary);
        font-size: 13px;
    }

    /* Status Badge */
    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 500;
        text-align: center;
        min-width: 100px;
    }

    .status-badge.status-completed {
        background: #DCFCE7;
        color: #166534;
    }

    .status-badge.status-pending {
        background: #FEF9C3;
        color: #854D0E;
    }

    .status-badge.status-cancelled {
        background: #FEE2E2;
        color: #991B1B;
    }

    .status-badge.status-processing {
        background: #FEF3C7;
        color: #92400E;
    }

    .status-badge.status-refunded {
        background: #E5E7EB;
        color: #374151;
    }

    /* View Button */
    .view-button {
        background: var(--primary-brand);
        color: var(--text-light);
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        transition: all 0.2s ease;
        font-family: "Manrope", sans-serif;
    }

    .view-button:hover {
        opacity: 0.9;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(19, 55, 46, 0.2);
    }

    .view-button:active {
        transform: translateY(0);
    }

    .view-button i {
        font-size: 16px;
    }

    /* Pagination */
    .orders-pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 16px;
        padding-top: 24px;
        border-top: 1px solid var(--border-color);
    }

    .pagination-btn {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        color: var(--text-primary);
        font-family: "Manrope", sans-serif;
    }

    .pagination-btn:hover:not(:disabled) {
        background: var(--primary-brand);
        color: var(--text-light);
        border-color: var(--primary-brand);
    }

    .pagination-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .pagination-info {
        color: var(--text-secondary);
        font-size: 14px;
        font-weight: 500;
        font-family: "Manrope", sans-serif;
    }

    /* Empty State */
    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 80px 40px;
        gap: 16px;
        text-align: center;
    }

    .empty-state i {
        font-size: 64px;
        color: var(--border-color);
        opacity: 0.5;
    }

    .empty-title {
        font-size: 18px;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0;
        font-family: "Manrope", sans-serif;
    }

    .empty-subtitle {
        font-size: 16px;
        color: var(--text-secondary);
        margin: 0;
        max-width: 400px;
        font-family: "Manrope", sans-serif;
    }

    .browse-button {
        margin-top: 16px;
        background: var(--primary-brand);
        color: var(--text-light);
        padding: 12px 32px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.2s ease;
        font-family: "Manrope", sans-serif;
    }

    .browse-button:hover {
        opacity: 0.9;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(19, 55, 46, 0.2);
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .orders-card {
            padding: 24px;
        }

        .orders-title {
            font-size: 18px;
        }

        .orders-table thead th {
            padding: 12px;
            font-size: 13px;
        }

        .orders-table tbody td {
            padding: 12px;
            font-size: 13px;
        }

        .view-button {
            padding: 6px 12px;
            font-size: 13px;
        }
    }

    @media (max-width: 768px) {
        .orders-card {
            padding: 16px;
        }

        .orders-title {
            font-size: 18px;
        }

        .table-container {
            overflow-x: auto;
        }

        .orders-table {
            font-size: 13px;
            white-space: nowrap;
        }

        .orders-table thead th {
            padding: 12px 8px;
            font-size: 12px;
        }

        .orders-table tbody td {
            padding: 12px 8px;
            font-size: 13px;
        }

        .view-button {
            padding: 6px 10px;
            font-size: 12px;
        }

        .view-button i {
            display: none;
        }

        .status-badge {
            min-width: 80px;
            font-size: 12px;
            padding: 4px 8px;
        }
    }

    @media (max-width: 480px) {
        .orders-card {
            padding: 12px;
        }

        .orders-title {
            font-size: 16px;
        }

        /* Stack table as cards on mobile */
        .table-container {
            display: none;
        }

        .orders-table {
            display: block;
        }

        .orders-table thead {
            display: none;
        }

        .orders-table tbody {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .order-row {
            display: flex;
            flex-direction: column;
            gap: 12px;
            padding: 16px;
            border: 1px solid var(--border-color);
            border-bottom: none;
            border-radius: 8px;
            background: var(--card-bg);
        }

        .order-row:hover {
            background: var(--card-bg);
        }

        .orders-table tbody td {
            padding: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .orders-table tbody td::before {
            content: attr(data-label);
            font-weight: 600;
            color: var(--text-secondary);
            min-width: 80px;
        }

        .order-action {
            justify-content: flex-end;
            margin-top: 8px;
            padding-top: 8px;
            border-top: 1px solid var(--border-color);
        }

        .order-action::before {
            content: none !important;
        }

        .empty-state {
            padding: 60px 20px;
        }

        .empty-state i {
            font-size: 48px;
        }

        .empty-title {
            font-size: 16px;
        }

        .empty-subtitle {
            font-size: 14px;
        }
    }

    /* Action Buttons Styling */
    .action-buttons {
        display: flex;
        gap: 8px;
        align-items: center;
        flex-wrap: wrap;
    }
    
    .chat-button {
        background: #3B82F6;
        color: white;
        padding: 8px 12px;
        border-radius: 6px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 13px;
        transition: background 0.2s;
    }
    
    .chat-button:hover {
        background: #2563EB;
        color: white;
        text-decoration: none;
    }
    
    .btn-pay-now {
        background: #10B981;
        color: white;
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 13px;
        transition: background 0.2s;
    }
    
    .btn-pay-now:hover {
        background: #059669;
        color: white;
        text-decoration: none;
    }

    .btn-expired-link {
        background: #F3F4F6;
        color: #6B7280;
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 13px;
        border: 1px solid #D1D5DB;
        cursor: default;
    }
    
    .btn-confirm-delivery {
        background: #F59E0B;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 13px;
        transition: background 0.2s;
    }
    
    .btn-confirm-delivery:hover {
        background: #D97706;
    }
    
    /* Additional Status Badge Styles */
    .status-badge.status-warning { 
        background: #FEF3C7; 
        color: #92400E; 
    }
    
    .status-badge.status-info { 
        background: #DBEAFE; 
        color: #1E40AF; 
    }
    
    .status-badge.status-primary { 
        background: #E0E7FF; 
        color: #4338CA; 
    }
    
    .status-badge.status-completed {
        background: #DCFCE7;
        color: #166534;
    }
</style>

<script>
    const BASE_URL = '<?= base_url() ?>';
    
    function viewOrder(orderId) {
        window.location.href = BASE_URL + 'orders/' + orderId;
    }

    function confirmDelivery(orderId) {
        if (!confirm('Have you received your order? Confirming delivery will release payment to the seller. This action cannot be undone.')) {
            return;
        }
        
        // Show loading state
        const button = event.target;
        const originalText = button.innerHTML;
        button.disabled = true;
        button.innerHTML = '<i class="bi bi-hourglass-split"></i> Processing...';
        
        // Prepare form data
        const formData = new FormData();
        formData.append('order_id', orderId);
        formData.append('<?= $this->security->get_csrf_token_name() ?>', '<?= $this->security->get_csrf_hash() ?>');
        
        // Make AJAX request with credentials to preserve session cookies
        fetch('<?= base_url("orders/confirm_delivery") ?>', {
            method: 'POST',
            body: formData,
            credentials: 'include',  // IMPORTANT: Include cookies in request and response
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            console.log('Response status:', response.status);
            
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            
            // Parse as JSON
            return response.json();
        })
        .then(data => {
            console.log('Response data:', data);
            
            if (data.success) {
                alert('✅ ' + data.message);
                // Redirect to orders page after success
                window.location.href = data.redirect;
            } else {
                alert('❌ ' + data.message);
                button.disabled = false;
                button.innerHTML = originalText;
            }
        })
        .catch(error => {
            console.error('Error confirming delivery:', error);
            alert('⚠️ Error confirming delivery: ' + error.message);
            button.disabled = false;
            button.innerHTML = originalText;
        });
    }

    function confirmPickup(orderId) {
        if (!confirm('Have you collected your order? Confirming pickup will release payment to the seller. This action cannot be undone.')) {
            return;
        }

        const button = event.target;
        const originalText = button.innerHTML;
        button.disabled = true;
        button.innerHTML = '<i class="bi bi-hourglass-split"></i> Processing...';

        const formData = new FormData();
        formData.append('order_id', orderId);
        formData.append('<?= $this->security->get_csrf_token_name() ?>', '<?= $this->security->get_csrf_hash() ?>');

        fetch('<?= base_url("orders/confirm_pickup") ?>', {
            method: 'POST',
            body: formData,
            credentials: 'include',
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok: ' + response.statusText);
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert('✅ ' + data.message);
                window.location.href = data.redirect;
            } else {
                alert('❌ ' + data.message);
                button.disabled = false;
                button.innerHTML = originalText;
            }
        })
        .catch(error => {
            console.error('Error confirming pickup:', error);
            alert('⚠️ Error confirming pickup: ' + error.message);
            button.disabled = false;
            button.innerHTML = originalText;
        });
    }