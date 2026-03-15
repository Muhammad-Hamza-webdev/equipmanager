<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - EquipManager</title>
    <link rel="icon" href="<?= base_url() ?>assets/images/logo-icon.png" type="image/png" />
    <!-- Website CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/style.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/header.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/footer.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/resopnsive.css" />
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
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
            --shadow: 0px 4px 12px rgba(0, 0, 0, 0.05);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Manrope", sans-serif;
            background-color: var(--body-bg);
            color: var(--text-primary);
        }

        /* Main Layout */
        .website-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-container {
            flex: 1;
            display: flex;
            width: 100%;
        }

        .dashboard-container {
            display: flex;
            width: 100%;
            gap: 0;
        }

        .main-content {
            flex: 1;
            padding: 40px;
            overflow-y: auto;
        }

        /* Order Detail Grid Layout */
        .order-detail-grid {
            display: grid;
            grid-template-columns: 40% 1fr;
            gap: 32px;
            margin-bottom: 24px;
        }

        .gallery-section {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .gallery-main {
            background: var(--card-bg);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow);
            aspect-ratio: 4/5;
            position: relative;
        }

        .main-image-wrapper {
            width: 100%;
            height: 100%;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--body-bg);
        }

        .main-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.3s ease;
        }

        .main-image-wrapper.fade-out img {
            opacity: 0;
        }

        .main-image-wrapper.fade-in img {
            opacity: 1;
        }

        .gallery-controls {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            transform: translateY(-50%);
            display: flex;
            justify-content: space-between;
            padding: 0 12px;
            z-index: 10;
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .gallery-main:hover .gallery-controls {
            opacity: 1;
        }

        .gallery-btn {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-brand);
            font-size: 18px;
            transition: all 0.2s ease;
        }

        .gallery-btn:hover:not(:disabled) {
            background: var(--text-light);
            transform: scale(1.1);
        }

        .gallery-btn:disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }

        .gallery-counter {
            position: absolute;
            bottom: 12px;
            right: 12px;
            background: rgba(0, 0, 0, 0.6);
            color: var(--text-light);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            z-index: 10;
        }

        .gallery-thumbnails {
            display: flex;
            gap: 8px;
            overflow-x: auto;
            padding: 8px;
            background: var(--card-bg);
            border-radius: 12px;
            box-shadow: var(--shadow);
        }

        .gallery-thumbnail {
            width: 64px;
            height: 64px;
            border-radius: 8px;
            border: 2px solid transparent;
            cursor: pointer;
            overflow: hidden;
            flex-shrink: 0;
            transition: all 0.2s ease;
        }

        .gallery-thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .gallery-thumbnail.active {
            border-color: var(--primary-brand);
        }

        /* Order Info Section */
        .order-info-section {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
        }

        .back-button {
            background: transparent;
            border: none;
            color: var(--primary-brand);
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
            align-self: flex-start;
        }

        .back-button:hover {
            opacity: 0.8;
            transform: translateX(-4px);
        }

        .order-title-section h1 {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 4px;
        }

        .order-title-section p {
            font-size: 14px;
            color: var(--text-secondary);
        }

        .order-status {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
        }

        .order-status.status-requested {
            background: #E0F2FE;
            color: #0369A1;
        }

        .order-status.status-approved {
            background: #DCFCE7;
            color: #166534;
        }

        .order-status.status-rejected {
            background: #FEE2E2;
            color: #991B1B;
        }

        .order-status.status-payment_pending {
            background: #FEF9C3;
            color: #854D0E;
        }

        .order-status.status-payment_secured {
            background: #D1FAE5;
            color: #065F46;
        }

        .order-status.status-shipped {
            background: #DBEAFE;
            color: #1D4ED8;
        }

        .order-status.status-delivered {
            background: #EDE9FE;
            color: #5B21B6;
        }

        .order-status.status-completed {
            background: #DCFCE7;
            color: #14532D;
        }

        .order-status.status-cancelled {
            background: #FEE2E2;
            color: #991B1B;
        }

        .order-status.status-refunded {
            background: #E5E7EB;
            color: #374151;
        }

        .order-price {
            font-size: 24px;
            font-weight: 700;
            color: #22C55E;
        }

        /* Order Details */
        .order-details {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 24px;
            box-shadow: var(--shadow);
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .detail-item {
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border-color);
        }

        .detail-item:nth-child(2n) {
            border-right: 1px solid var(--border-color);
            padding-right: 20px;
        }

        .detail-item:nth-child(2n-1) {
            padding-right: 20px;
        }

        .detail-label {
            font-size: 12px;
            color: var(--text-secondary);
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .detail-value {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-primary);
        }

        /* Responsive Breakpoints */
        @media (max-width: 1600px) {
            .main-content {
                padding: 32px;
            }

            .order-detail-grid {
                grid-template-columns: 45% 1fr;
                gap: 28px;
            }

            .order-title-section h1 {
                font-size: 24px;
            }
        }

        @media (max-width: 1024px) {
            .main-content {
                padding: 24px;
            }

            .order-detail-grid {
                grid-template-columns: 1fr;
                gap: 24px;
            }

            .gallery-main {
                aspect-ratio: 1/1;
            }

            .details-grid {
                grid-template-columns: 1fr;
            }

            .detail-item:nth-child(2n) {
                border-right: none;
                padding-right: 0;
            }

            .detail-item:nth-child(2n-1) {
                padding-right: 0;
            }

            .gallery-btn {
                width: 36px;
                height: 36px;
                font-size: 16px;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 16px;
            }

            .order-detail-grid {
                gap: 16px;
            }

            .gallery-main {
                aspect-ratio: 4/5;
            }

            .gallery-btn {
                width: 32px;
                height: 32px;
                font-size: 14px;
            }

            .order-title-section h1 {
                font-size: 20px;
            }

            .order-price {
                font-size: 20px;
            }

            .details-grid {
                gap: 16px;
            }

            .detail-item {
                padding-bottom: 16px;
            }

            .gallery-counter {
                font-size: 11px;
            }
        }

        @media (max-width: 480px) {
            .main-content {
                padding: 12px;
            }

            .gallery-thumbnails {
                gap: 6px;
                padding: 6px;
            }

            .gallery-thumbnail {
                width: 48px;
                height: 48px;
            }

            .gallery-btn {
                width: 28px;
                height: 28px;
                font-size: 12px;
            }

            .order-header {
                flex-direction: column;
            }

            .order-title-section h1 {
                font-size: 18px;
            }

            .order-details {
                padding: 16px;
            }

            .detail-label {
                font-size: 11px;
            }

            .detail-value {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <!-- Website Header -->
    <?php $this->load->view('components/websiteHeader'); ?>

    <div class="website-wrapper">
        <div class="main-container">
            <div class="dashboard-container">
                <!-- Sidebar -->
                <?php $this->load->view('components/dashboardSidebar', ['active_page' => 'orders']); ?>

                <!-- Main Content -->
                <div class="main-content">
                    <?php if (!empty($order)): ?>
                        <!-- Back Button -->
                        <button class="back-button" onclick="window.location.href='<?= base_url('orders') ?>'">
                            <i class="bi bi-chevron-left"></i> Back to Orders
                        </button>

                        <!-- Order Detail Grid -->
                        <div class="order-detail-grid">
                            <!-- Image Gallery Section -->
                            <div class="gallery-section">
                                <!-- Main Image -->
                                <div class="gallery-main" id="galleryMain">
                                    <div class="main-image-wrapper" id="mainImageWrapper">
                                        <img id="mainImage" src="" alt="Equipment image">
                                    </div>
                                    <div class="gallery-controls">
                                        <button class="gallery-btn" id="prevBtn" onclick="previousImage()">
                                            <i class="bi bi-chevron-left"></i>
                                        </button>
                                        <button class="gallery-btn" id="nextBtn" onclick="nextImage()">
                                            <i class="bi bi-chevron-right"></i>
                                        </button>
                                    </div>
                                    <div class="gallery-counter" id="counter"></div>
                                </div>

                                <!-- Thumbnails -->
                                <div class="gallery-thumbnails" id="thumbnails"></div>
                            </div>

                            <!-- Order Info Section -->
                            <div class="order-info-section">
                                <!-- Header -->
                                <div class="order-header">
                                    <div class="order-title-section">
                                        <h1>You have ordered a voucher of:</h1>
                                        <div class="order-price">$<?= number_format($order->grossAmount, 2) ?></div>
                                    </div>
                                    <?php
                                    $statusMap = [
                                        'requested'       => ['class' => 'status-requested',       'label' => 'Requested'],
                                        'approved'        => ['class' => 'status-approved',        'label' => 'Approved'],
                                        'rejected'        => ['class' => 'status-rejected',        'label' => 'Rejected'],
                                        'payment_pending' => ['class' => 'status-payment_pending', 'label' => 'Payment Pending'],
                                        'payment_secured' => ['class' => 'status-payment_secured', 'label' => 'Payment Secured'],
                                        'shipped'         => ['class' => 'status-shipped',         'label' => 'Shipment On The Way'],
                                        'pickup_ready'    => ['class' => 'status-payment_secured', 'label' => 'Ready for Pickup'],
                                        'delivered'       => ['class' => 'status-delivered',       'label' => 'Delivered'],
                                        'completed'       => ['class' => 'status-completed',       'label' => 'Completed'],
                                        'cancelled'       => ['class' => 'status-cancelled',       'label' => 'Cancelled'],
                                        'refunded'        => ['class' => 'status-refunded',        'label' => 'Refunded'],
                                    ];
                                    $orderStatus = $order->orderStatus ?? 'requested';
                                    $statusInfo  = $statusMap[$orderStatus] ?? ['class' => 'status-requested', 'label' => ucfirst($orderStatus)];
                                    ?>
                                    <span class="order-status <?= $statusInfo['class'] ?>">
                                        <?= $statusInfo['label'] ?>
                                    </span>
                                </div>

                                <!-- Order Details Card -->
                                <div class="order-details">
                                    <div class="details-grid">
                                        <div class="detail-item">
                                            <div class="detail-label">Equipment</div>
                                            <div class="detail-value"><?= htmlspecialchars($order->equipName ?? 'N/A') ?></div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-label">Category</div>
                                            <div class="detail-value"><?= htmlspecialchars($order->catName ?? 'N/A') ?></div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-label">Price</div>
                                            <div class="detail-value">$<?= number_format($order->grossAmount ?? 0, 2) ?></div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-label">Order Date</div>
                                            <div class="detail-value"><?= date('m/d/Y', strtotime($order->createdAt ?? 'now')) ?></div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-label">Status</div>
                                            <div class="detail-value"><?= $statusInfo['label'] ?></div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-label">Tracking</div>
                                            <div class="detail-value">#<?= $order->equipmentPaymentID ?></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Confirm Pickup Action -->
                                <?php if ($orderStatus === 'pickup_ready'): ?>
                                <div class="order-details" style="margin-top:16px; border-left:4px solid #F59E0B; background:#FFFBEB; padding:20px 24px; border-radius:8px;">
                                    <p style="margin:0 0 12px; font-weight:600; color:#92400E;"><i class="bi bi-building"></i> Your order is ready for collection at the store.</p>
                                    <p style="margin:0 0 16px; font-size:14px; color:#78350F;">Once you have collected your order in person, tap the button below to confirm pickup and complete the transaction.</p>
                                    <button id="btnConfirmPickup" class="action-button" style="background:#F59E0B;color:#fff;border:none;padding:12px 28px;border-radius:8px;font-weight:700;cursor:pointer;font-size:15px;" onclick="confirmPickupDetail(<?= $order->equipmentPaymentID ?>)">
                                        <i class="bi bi-bag-check"></i> Confirm Pickup &amp; Complete Order
                                    </button>
                                </div>
                                <?php endif; ?>

                                <!-- Confirm Receipt Action -->
                                <?php if ($orderStatus === 'shipped'): ?>
                                <div class="order-details" style="margin-top:16px; border-left:4px solid #3B82F6; background:#EFF6FF; padding:20px 24px; border-radius:8px;">
                                    <p style="margin:0 0 12px; font-weight:600; color:#1E40AF;"><i class="bi bi-truck"></i> Your order is on its way.</p>
                                    <p style="margin:0 0 16px; font-size:14px; color:#1E3A8A;">Once you have received your delivery, tap below to confirm receipt and complete the transaction.</p>
                                    <button id="btnConfirmDelivery" class="action-button" style="background:#3B82F6;color:#fff;border:none;padding:12px 28px;border-radius:8px;font-weight:700;cursor:pointer;font-size:15px;" onclick="confirmDeliveryDetail(<?= $order->equipmentPaymentID ?>)">
                                        <i class="bi bi-check-circle"></i> Confirm Receipt &amp; Complete Order
                                    </button>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <!-- Order Not Found -->
                        <div style="text-align: center; padding: 60px 40px;">
                            <i class="bi bi-question-circle" style="font-size: 64px; color: var(--border-color); margin-bottom: 16px;"></i>
                            <h2 style="margin-bottom: 8px;">Order Not Found</h2>
                            <p style="color: var(--text-secondary); margin-bottom: 24px;">This order doesn't exist or you don't have permission to view it.</p>
                            <button class="action-button primary" onclick="window.location.href='<?= base_url('orders') ?>'">
                                Back to Orders
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Website Footer -->
    <?php $this->load->view('components/websiteFooter'); ?>

    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script>
        const BASE_URL = '<?= base_url() ?>';
        const images = <?= isset($images) ? json_encode($images) : '[]' ?>;
        let currentIndex = 0;

        // Debug: Log images array to console
        console.log('🖼️ Images Array:', images);
        console.log('📍 Base URL:', BASE_URL);
        console.log('🔢 Total Images:', images.length);

        const mainImage = document.getElementById('mainImage');
        const counter = document.getElementById('counter');
        const thumbnails = document.getElementById('thumbnails');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const mainImageWrapper = document.getElementById('mainImageWrapper');

        // Initialize gallery
        function initGallery() {
            // Filter to only valid images that might exist
            const validImages = images.filter(img => img && img.length > 0);
            
            if (validImages.length === 0) {
                console.log('⚠️ No valid images found in array, using fallback');
                mainImage.src = BASE_URL + 'assets/website/images/brand-logo-2.png';
                counter.textContent = '0/0';
                prevBtn.disabled = true;
                nextBtn.disabled = true;
                return;
            }

            console.log('✅ Loading gallery with', validImages.length, 'images');

            // Render thumbnails
            validImages.forEach((img, index) => {
                const thumb = document.createElement('div');
                thumb.className = 'gallery-thumbnail' + (index === 0 ? ' active' : '');
                const imgElement = document.createElement('img');
                imgElement.src = BASE_URL + img;
                imgElement.alt = `Thumbnail ${index + 1}`;
                let thumbnailFallbackAttempted = false;
                imgElement.onerror = function() {
                    if (!thumbnailFallbackAttempted) {
                        console.error(`❌ Failed to load thumbnail ${index + 1}:`, this.src);
                        console.log('ℹ️ The database may reference files that were never uploaded. Check:', img);
                        thumbnailFallbackAttempted = true;
                        this.src = BASE_URL + 'assets/website/images/brand-logo-2.png';
                    }
                };
                imgElement.onload = function() {
                    console.log(`✅ Thumbnail ${index + 1} loaded:`, this.src);
                };
                thumb.appendChild(imgElement);
                thumb.onclick = () => goToImage(index);
                thumbnails.appendChild(thumb);
            });

            // Set initial image
            showImage(0);
        }

        function showImage(index) {
            if (images.length === 0) return;

            currentIndex = (index + images.length) % images.length;
            const imageUrl = BASE_URL + images[currentIndex];
            mainImage.src = imageUrl;
            
            // Add error handling for main image (prevent infinite loop)
            let mainImageFallbackAttempted = false;
            mainImage.onerror = function() {
                if (!mainImageFallbackAttempted) {
                    console.error('❌ Failed to load main image:', imageUrl);
                    mainImageFallbackAttempted = true;
                    this.src = BASE_URL + 'assets/website/images/brand-logo-2.png';
                }
            };
            
            mainImage.onload = function() {
                console.log('✅ Main image loaded:', imageUrl);
            };
            
            counter.textContent = `${currentIndex + 1}/${images.length}`;

            // Update active thumbnail
            document.querySelectorAll('.gallery-thumbnail').forEach((thumb, i) => {
                thumb.classList.toggle('active', i === currentIndex);
            });

            // Update button states
            prevBtn.disabled = images.length <= 1;
            nextBtn.disabled = images.length <= 1;
        }

        function goToImage(index) {
            mainImageWrapper.classList.add('fade-out');
            setTimeout(() => {
                showImage(index);
                mainImageWrapper.classList.remove('fade-out');
                mainImageWrapper.classList.add('fade-in');
            }, 150);
        }

        function nextImage() {
            if (images.length > 1) goToImage(currentIndex + 1);
        }

        function previousImage() {
            if (images.length > 1) goToImage(currentIndex - 1);
        }

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowRight') nextImage();
            if (e.key === 'ArrowLeft') previousImage();
        });

        // Touch swipe support
        let touchStartX = 0;
        let touchEndX = 0;

        mainImageWrapper.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        }, false);

        mainImageWrapper.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            const diff = touchStartX - touchEndX;
            if (Math.abs(diff) > 50) {
                if (diff > 0) nextImage();
                else previousImage();
            }
        }, false);

        // Initialize on load
        document.addEventListener('DOMContentLoaded', function() {
            console.log('🎯 DOM loaded, initializing gallery...');
            initGallery();
        });

        function confirmPickupDetail(orderId) {
            if (!confirm('Have you collected your order? Confirming pickup will release payment to the seller. This action cannot be undone.')) return;
            const btn = document.getElementById('btnConfirmPickup');
            btn.disabled = true;
            btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Processing...';
            const fd = new FormData();
            fd.append('order_id', orderId);
            fd.append('<?= $this->security->get_csrf_token_name() ?>', '<?= $this->security->get_csrf_hash() ?>');
            fetch('<?= base_url("orders/confirm_pickup") ?>', { method: 'POST', body: fd, credentials: 'include', headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(r => r.json())
            .then(data => {
                if (data.success) { alert('✅ ' + data.message); window.location.href = data.redirect; }
                else { alert('❌ ' + data.message); btn.disabled = false; btn.innerHTML = '<i class="bi bi-bag-check"></i> Confirm Pickup & Complete Order'; }
            })
            .catch(e => { alert('⚠️ Error: ' + e.message); btn.disabled = false; btn.innerHTML = '<i class="bi bi-bag-check"></i> Confirm Pickup & Complete Order'; });
        }

        function confirmDeliveryDetail(orderId) {
            if (!confirm('Have you received your order? Confirming receipt will release payment to the seller. This action cannot be undone.')) return;
            const btn = document.getElementById('btnConfirmDelivery');
            btn.disabled = true;
            btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Processing...';
            const fd = new FormData();
            fd.append('order_id', orderId);
            fd.append('<?= $this->security->get_csrf_token_name() ?>', '<?= $this->security->get_csrf_hash() ?>');
            fetch('<?= base_url("orders/confirm_delivery") ?>', { method: 'POST', body: fd, credentials: 'include', headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(r => r.json())
            .then(data => {
                if (data.success) { alert('✅ ' + data.message); window.location.href = data.redirect; }
                else { alert('❌ ' + data.message); btn.disabled = false; btn.innerHTML = '<i class="bi bi-check-circle"></i> Confirm Receipt & Complete Order'; }
            })
            .catch(e => { alert('⚠️ Error: ' + e.message); btn.disabled = false; btn.innerHTML = '<i class="bi bi-check-circle"></i> Confirm Receipt & Complete Order'; });
        }
    </script>
</body>
</html>
