<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Checkout | Equip Manager</title>
    <link rel="icon" type="image/x-icon" href="<?= base_url() ?>assets/website/img/favicon.svg" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/style.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/header.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/footer.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/toastr/toastr.min.css" />
    <script src="https://js.stripe.com/v3/"></script>
    
    <style>
        * { box-sizing: border-box; }
        
        body {
            background-color: #f5f5f5;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        .checkout-wrapper {
            max-width: 1100px;
            margin: 0 auto;
            padding: 40px 16px;
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 32px;
        }

        @media (max-width: 900px) {
            .checkout-wrapper {
                grid-template-columns: 1fr;
                gap: 24px;
                padding: 24px 16px;
            }
        }

        /* ===== LEFT COLUMN: FORM ===== */
        .checkout-form-wrapper {
            background: white;
            border-radius: 8px;
            padding: 32px;
        }

        .form-section {
            margin-bottom: 32px;
        }

        .form-section:last-child {
            margin-bottom: 0;
        }

        .form-section-heading {
            font-size: 16px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid #e0e0e0;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 16px;
        }

        .form-row.full {
            grid-template-columns: 1fr;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-size: 13px;
            font-weight: 500;
            color: #333;
            margin-bottom: 8px;
        }

        .form-group label .required {
            color: #ff3434;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            font-family: inherit;
            transition: all 0.2s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #34FF67;
            box-shadow: 0 0 0 2px rgba(52, 255, 103, 0.1);
        }

        .form-group input::placeholder,
        .form-group select::placeholder,
        .form-group textarea::placeholder {
            color: #aaa;
        }

        .radio-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .radio-option {
            display: flex;
            align-items: center;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .radio-option:hover {
            border-color: #34FF67;
            background-color: #f9f9f9;
        }

        .radio-option input[type="radio"] {
            margin-right: 8px;
            cursor: pointer;
        }

        .radio-option input[type="radio"]:checked {
            accent-color: #34FF67;
        }

        .radio-option.checked {
            border-color: #34FF67;
            background-color: #f0fdf4;
        }

        /* ===== PICKUP LOCATION DISPLAY ===== */
        #pickup-section {
            animation: slideDown 0.3s ease;
        }

        #pickup-section .location-info {
            background: linear-gradient(135deg, #f0fdf4 0%, #ffffff 100%);
            border: 1px solid #d4edda;
            border-left: 4px solid #34FF67;
            padding: 16px;
            border-radius: 6px;
        }

        #pickup-section .location-info > div {
            margin-bottom: 12px;
        }

        #pickup-section .location-info > div:last-child {
            margin-bottom: 0;
        }

        #pickup-section .location-label {
            display: block;
            color: #1a1a1a;
            margin-bottom: 4px;
            font-weight: 600;
            font-size: 13px;
        }

        #pickup-section .location-value {
            color: #666;
            font-size: 14px;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ===== RIGHT COLUMN: SUMMARY ===== */
        .order-summary {
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 24px;
            height: fit-content;
            position: sticky;
            top: 20px;
        }

        .summary-title {
            font-size: 16px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid #e0e0e0;
        }

        .summary-item {
            padding: 16px 0;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
        }

        .summary-item:last-of-type {
            border-bottom: none;
        }

        .item-info {
            flex: 1;
        }

        .item-name {
            font-size: 14px;
            font-weight: 500;
            color: #1a1a1a;
            margin-bottom: 4px;
        }

        .item-sku {
            font-size: 12px;
            color: #888;
            margin-bottom: 4px;
        }

        .item-meta {
            font-size: 12px;
            color: #666;
        }

        .item-price {
            font-weight: 600;
            color: #1a1a1a;
            text-align: right;
            min-width: 80px;
        }

        .summary-divider {
            height: 1px;
            background: #e0e0e0;
            margin: 16px 0;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
            margin-bottom: 12px;
        }

        .summary-row.total {
            font-size: 18px;
            font-weight: 700;
            color: #1a1a1a;
            border-top: 1px solid #e0e0e0;
            border-bottom: none;
            padding: 16px 0;
            margin-top: 12px;
            margin-bottom: 0;
        }

        .summary-label {
            color: #666;
        }

        .summary-value {
            font-weight: 500;
            color: #1a1a1a;
        }

        /* ===== PAYMENT SECTION ===== */
        .stripes-element-wrapper {
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid #e0e0e0;
        }

        .stripe-label {
            font-size: 13px;
            font-weight: 500;
            color: #333;
            margin-bottom: 12px;
            display: block;
        }

        .stripe-element {
            padding: 12px 14px !important;
            border: 1px solid #ddd !important;
            border-radius: 4px !important;
            background: white !important;
            font-size: 14px !important;
            min-height: 46px;
            width: 100%;
            display: block !important;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }

        .stripe-element iframe {
            width: 100% !important;
            max-width: 100% !important;
        }

        .stripe-element.StripeElement--focus {
            border-color: #1a1a1a !important;
            box-shadow: 0 0 0 1px #1a1a1a !important;
        }

        .stripe-element.StripeElement--invalid {
            border-color: #ff3434 !important;
        }

        .stripe-error {
            color: #ff3434;
            font-size: 13px;
            margin-top: 8px;
        }

        /* ===== BUTTONS ===== */
        .checkout-actions {
            display: flex;
            gap: 12px;
            margin-top: 24px;
            margin-bottom: 16px;
        }

        .btn {
            flex: 1;
            padding: 14px 16px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary {
            background: #34FF67;
            color: #0f2f2c;
            flex: 2;
        }

        .btn-primary:hover:not(:disabled) {
            background: #28d652;
            box-shadow: 0 4px 12px rgba(52, 255, 103, 0.25);
        }

        .btn-secondary {
            background: #f5f5f5;
            color: #1a1a1a;
            border: 1px solid #ddd;
        }

        .btn-secondary:hover:not(:disabled) {
            background: #f0f0f0;
            border-color: #1a1a1a;
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(0, 0, 0, 0.1);
            border-top-color: currentColor;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .security-info {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: #666;
            margin-top: 12px;
        }

        .security-info svg {
            width: 16px;
            height: 16px;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 600px) {
            .checkout-wrapper {
                padding: 16px;
            }

            .checkout-form-wrapper {
                padding: 20px;
            }

            .order-summary {
                position: static;
                margin-bottom: 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .radio-group {
                grid-template-columns: 1fr;
            }

            .summary-item {
                flex-direction: column;
            }

            .item-price {
                text-align: left;
            }
        }
    </style>
</head>

<body>
    <!-- CHECKOUT HEADER -->
    <div style="background: white; border-bottom: 1px solid #e0e0e0; padding: 20px 0;">
        <div style="max-width: 1100px; margin: 0 auto; padding: 0 16px;">
            <a href="<?= site_url('/') ?>" style="color: #34FF67; text-decoration: none; font-weight: 600; font-size: 16px;">← Back to Shop</a>
            <h1 style="font-size: 28px; font-weight: 700; color: #1a1a1a; margin: 12px 0 0 0;">Checkout</h1>
        </div>
    </div>

    <!-- MAIN CHECKOUT -->
    <div class="checkout-wrapper">
        
        <!-- LEFT: FORM -->
        <div class="checkout-form-wrapper">
            
            <form id="checkout-form" method="POST">
                <input type="hidden" name="<?= $csrf_token_name ?>" value="<?= $csrf_token_value ?>">
                <input type="hidden" name="equipment_payment_id" value="<?= htmlspecialchars($order['equipment_payment_id'] ?? '') ?>">
                <input type="hidden" name="item_id" value="<?= htmlspecialchars($order['item_id']) ?>">
                <input type="hidden" name="quantity" value="<?= htmlspecialchars($order['quantity']) ?>">
                <input type="hidden" name="start_date" value="<?= htmlspecialchars($order['rental_start_date'] ?? '') ?>">
                <input type="hidden" name="end_date" value="<?= htmlspecialchars($order['rental_end_date'] ?? '') ?>">
                
                <!-- CONTACT INFORMATION -->
                <div class="form-section">
                    <h3 class="form-section-heading">Contact Information</h3>
                    
                    <div class="form-row full">
                        <div class="form-group">
                            <label>Email Address <span class="required">*</span></label>
                            <input type="email" name="customer_email" placeholder="you@example.com" required>
                        </div>
                    </div>

                    <div class="form-row full">
                        <div class="form-group">
                            <label>Phone Number <span class="required">*</span></label>
                            <input type="tel" name="customer_phone" placeholder="+1 (555) 000-0000" required>
                        </div>
                    </div>
                </div>

                <!-- EQUIPMENT RULES -->
                <?php if (!empty($order['equipment_rules'])): ?>
                <div class="form-section">
                    <h3 class="form-section-heading">Equipment Rules & Guidelines</h3>
                    
                    <div style="background: linear-gradient(135deg, #f0f9f4 0%, #ffffff 100%); border: 1px solid #d4edda; border-left: 4px solid #34FF67; padding: 16px; border-radius: 6px; line-height: 1.6; color: #333; font-size: 14px;">
                        <?= nl2br(htmlspecialchars($order['equipment_rules'])) ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- DELIVERY METHOD (MOVED FIRST) -->
                <div class="form-section">
                    <h3 class="form-section-heading">How would you like to receive this?</h3>
                    
                    <div class="radio-group" id="delivery-method-group">
                        <label class="radio-option">
                            <input type="radio" name="delivery_method" value="1" required onchange="updateDeliveryDisplay()">
                            <span>Pickup</span>
                        </label>
                        <?php if ($order['delivery_option'] == 1): ?>
                        <label class="radio-option">
                            <input type="radio" name="delivery_method" value="2" required onchange="updateDeliveryDisplay()">
                            <span>Delivery</span>
                        </label>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- PICKUP LOCATION (SHOWN WHEN PICKUP SELECTED) -->
                <div class="form-section" id="pickup-section" style="display: none;">
                    <h3 class="form-section-heading">Pickup Location</h3>
                    
                    <div class="location-info">
                        <div>
                            <span class="location-label">Address</span>
                            <span class="location-value"><?= htmlspecialchars($order['pickup_address'] ?? 'Address not available') ?></span>
                        </div>
                        <div>
                            <span class="location-label">City</span>
                            <span class="location-value"><?= htmlspecialchars($order['pickup_city'] ?? 'City not available') ?></span>
                        </div>
                    </div>
                </div>

                <!-- DELIVERY INFORMATION (SHOWN WHEN DELIVERY SELECTED) -->
                <div class="form-section" id="delivery-section" style="display: none;">
                    <h3 class="form-section-heading">Delivery Address</h3>
                    
                    <div class="form-row full">
                        <div class="form-group">
                            <label>Full Name <span class="required">*</span></label>
                            <input type="text" name="delivery_name" placeholder="John Doe">
                        </div>
                    </div>

                    <div class="form-row full">
                        <div class="form-group">
                            <label>Street Address <span class="required">*</span></label>
                            <input type="text" name="delivery_street" placeholder="123 Main Street">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>City <span class="required">*</span></label>
                            <input type="text" name="delivery_city" placeholder="New York">
                        </div>
                        <div class="form-group">
                            <label>ZIP Code <span class="required">*</span></label>
                            <input type="text" name="delivery_postal" placeholder="10001">
                        </div>
                    </div>

                    <div class="form-row full">
                        <div class="form-group">
                            <label>Country <span class="required">*</span></label>
                            <input type="text" name="delivery_country" placeholder="United States">
                        </div>
                    </div>

                    <div class="form-row full">
                        <div class="form-group">
                            <label>Delivery Instructions</label>
                            <textarea name="delivery_notes" placeholder="e.g., Please ring bell twice" rows="3" style="resize: vertical;"></textarea>
                        </div>
                    </div>
                </div>

                <!-- PAYMENT -->
                <div class="form-section">
                    <h3 class="form-section-heading">Payment Details</h3>
                    
                    <div class="stripes-element-wrapper">
                        <!-- Card Number -->
                        <div class="form-row full">
                            <div class="form-group">
                                <label>Card Number <span class="required">*</span></label>
                                <div id="card-number-element" class="stripe-element"></div>
                            </div>
                        </div>

                        <!-- Expiry & CVC Row -->
                        <div class="form-row">
                            <div class="form-group">
                                <label>Expiration <span class="required">*</span></label>
                                <div id="card-expiry-element" class="stripe-element"></div>
                            </div>
                            <div class="form-group">
                                <label>CVV <span class="required">*</span></label>
                                <div id="card-cvc-element" class="stripe-element"></div>
                            </div>
                        </div>

                        <!-- Card Type Badge -->
                        <div id="card-brand-display" style="margin-top: 12px; display: flex; align-items: center; gap: 8px; font-size: 12px; color: #666; flex-wrap: wrap;">
                            <span id="brand-visa" style="display: none; background: #f5f5f5; padding: 6px 10px; border: 1px solid #ddd; border-radius: 4px; font-weight: 600; color: #1a1a1a;">VISA</span>
                            <span id="brand-mastercard" style="display: none; background: #f5f5f5; padding: 6px 10px; border: 1px solid #ddd; border-radius: 4px; font-weight: 600; color: #1a1a1a;">Mastercard</span>
                            <span id="brand-amex" style="display: none; background: #f5f5f5; padding: 6px 10px; border: 1px solid #ddd; border-radius: 4px; font-weight: 600; color: #1a1a1a;">AMEX</span>
                            <span id="brand-discover" style="display: none; background: #f5f5f5; padding: 6px 10px; border: 1px solid #ddd; border-radius: 4px; font-weight: 600; color: #1a1a1a;">Discover</span>
                            <span id="brand-diners" style="display: none; background: #f5f5f5; padding: 6px 10px; border: 1px solid #ddd; border-radius: 4px; font-weight: 600; color: #1a1a1a;">Diners</span>
                            <span id="brand-jcb" style="display: none; background: #f5f5f5; padding: 6px 10px; border: 1px solid #ddd; border-radius: 4px; font-weight: 600; color: #1a1a1a;">JCB</span>
                            <span id="brand-unionpay" style="display: none; background: #f5f5f5; padding: 6px 10px; border: 1px solid #ddd; border-radius: 4px; font-weight: 600; color: #1a1a1a;">UnionPay</span>
                        </div>

                        <div id="card-errors" class="stripe-error"></div>
                    </div>
                </div>

            </form>

            <!-- BUTTONS -->
            <div class="checkout-actions">
                <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                    Back
                </button>
                <button type="button" class="btn btn-primary" id="pay-button" onclick="processPayment()">
                    Pay $<?= number_format($order['total'], 2) ?>
                </button>
            </div>

            <div class="security-info">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                </svg>
                <span>Secure payment powered by Stripe</span>
            </div>
        </div>

        <!-- RIGHT: SUMMARY -->
        <div class="order-summary">
            <h3 class="summary-title">Order Summary</h3>

            <!-- PRODUCT -->
            <div class="summary-item">
                <div class="item-info">
                    <div class="item-name"><?= htmlspecialchars($order['product_name']) ?></div>
                    <div class="item-sku">SKU: <?= htmlspecialchars($order['product_sku']) ?></div>
                    <?php if ($order['sale_type'] == 0 && $order['rental_days'] > 0): ?>
                        <div class="item-meta">
                            <?= $order['rental_days'] ?> day<?= $order['rental_days'] > 1 ? 's' : '' ?> rental • Qty: <?= $order['quantity'] ?>
                        </div>
                    <?php else: ?>
                        <div class="item-meta">Purchase • Qty: <?= $order['quantity'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="item-price">$<?= number_format($order['subtotal'], 2) ?></div>
            </div>

            <div class="summary-divider"></div>

            <!-- RENTAL DATES (If Applicable) -->
            <?php if ($order['sale_type'] == 0 && $order['rental_start_date'] && $order['rental_end_date']): ?>
            <div style="padding: 12px 0; font-size: 13px; border-top: 1px solid #f0f0f0; margin-bottom: 12px;">
                <div style="color: #666; margin-bottom: 8px;">
                    <strong>Rental Period:</strong>
                    <div style="margin-top: 4px; color: #888; font-size: 12px;">
                        From <?= date('M d, Y', strtotime($order['rental_start_date'])) ?> to <?= date('M d, Y', strtotime($order['rental_end_date'])) ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- PRICING BREAKDOWN -->
            <div class="summary-row">
                <span class="summary-label">Subtotal</span>
                <span class="summary-value">$<?= number_format($order['subtotal'], 2) ?></span>
            </div>

            <?php if ($order['tax_amount'] > 0): ?>
            <div class="summary-row">
                <span class="summary-label">Tax</span>
                <span class="summary-value">$<?= number_format($order['tax_amount'], 2) ?></span>
            </div>
            <?php endif; ?>

            <div class="summary-row total">
                <span>Total</span>
                <span>$<?= number_format($order['total'], 2) ?></span>
            </div>

            <!-- DELIVERY -->
            <div style="padding: 12px 0; font-size: 13px; color: #666;">
                <strong>Delivery:</strong> 
                <div style="margin-top: 4px; color: #888;">
                    Calculated after address verification
                </div>
            </div>
        </div>
        
    </div>

    <!-- FOOTER -->
    <div style="background: white; border-top: 1px solid #e0e0e0; margin-top: 40px; padding: 24px 0;">
        <div style="max-width: 1100px; margin: 0 auto; padding: 0 16px; text-align: center; font-size: 13px; color: #666;">
            <p style="margin: 0;">By completing this purchase, you agree to our Terms of Service and Privacy Policy</p>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script src="<?= base_url() ?>assets/toastr/toastr.min.js"></script>
    <script>
        // Set global base URL for AJAX calls (works on localhost, ngrok, production)
        window.APP_BASE_URL = '<?= site_url('/') ?>';

        // Safe toastr configuration - check if toastr exists first
        if (typeof toastr !== 'undefined') {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "5000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
        }

        // Safe toast error function that handles toastr not being loaded
        function showError(message) {
            console.error('❌ Error:', message);
            if (typeof toastr !== 'undefined' && toastr.error) {
                try {
                    toastr.error(message);
                } catch (e) {
                    console.warn('Toastr error call failed:', e);
                    alert(message);
                }
            } else {
                alert(message);
            }
        }

        // Safe toast success function
        function showSuccess(message) {
            console.log('✅ Success:', message);
            if (typeof toastr !== 'undefined' && toastr.success) {
                try {
                    toastr.success(message);
                } catch (e) {
                    console.warn('Toastr success call failed:', e);
                }
            }
        }

        // Global Stripe objects
        let stripe = null;
        let cardNumberElement = null;
        let cardExpiryElement = null;
        let cardCvcElement = null;

        // Wait for DOM to be fully loaded AND toastr to be ready
        document.addEventListener('DOMContentLoaded', function() {
            console.log('🎯 DOMContentLoaded fired - waiting for toastr...');
            
            // Wait a bit for toastr to load
            setTimeout(() => {
                if (typeof toastr !== 'undefined') {
                    console.log('✅ Toastr loaded');
                    initializeStripe();
                } else {
                    console.warn('⚠️ Toastr not loaded, initializing Stripe anyway');
                    initializeStripe();
                }
            }, 100);
        });

        // Initialize Stripe with individual card elements
        function initializeStripe() {
            try {
                // Check if Stripe is loaded
                if (typeof Stripe === 'undefined') {
                    console.error('❌ Stripe library not loaded! Check that https://js.stripe.com/v3/ is loading.');
                    return;
                }

                console.log('✅ Stripe library loaded');

                // Initialize Stripe
                stripe = Stripe('<?= $stripe_public_key ?>');
                if (!stripe) {
                    console.error('❌ Failed to initialize Stripe');
                    return;
                }
                console.log('✅ Stripe initialized');

                // Create elements
                const elements = stripe.elements();
                if (!elements) {
                    console.error('❌ Failed to create Stripe elements collection');
                    return;
                }
                console.log('✅ Stripe elements collection created');

                // Define styles
                const elementStyles = {
                    style: {
                        base: {
                            fontSize: '14px',
                            color: '#1a1a1a',
                            fontFamily: '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif',
                            '::placeholder': { color: '#aaa' },
                            '::selection': { color: '#34FF67' }
                        },
                        invalid: {
                            color: '#ff3434',
                            iconColor: '#ff3434'
                        }
                    }
                };

                // Verify container elements exist
                const cardNumberContainer = document.getElementById('card-number-element');
                const cardExpiryContainer = document.getElementById('card-expiry-element');
                const cardCvcContainer = document.getElementById('card-cvc-element');

                if (!cardNumberContainer) {
                    console.error('❌ Container #card-number-element not found in DOM');
                    return;
                }
                if (!cardExpiryContainer) {
                    console.error('❌ Container #card-expiry-element not found in DOM');
                    return;
                }
                if (!cardCvcContainer) {
                    console.error('❌ Container #card-cvc-element not found in DOM');
                    return;
                }

                console.log('✅ All container elements exist in DOM');

                // Create individual card elements
                cardNumberElement = elements.create('cardNumber', elementStyles);
                cardExpiryElement = elements.create('cardExpiry', elementStyles);
                cardCvcElement = elements.create('cardCvc', elementStyles);

                console.log('✅ Card elements created');

                // Mount elements with error handling
                try {
                    cardNumberElement.mount('#card-number-element');
                    console.log('✅ Card number element mounted');
                } catch (e) {
                    console.error('❌ Failed to mount card number element:', e);
                    return;
                }

                try {
                    cardExpiryElement.mount('#card-expiry-element');
                    console.log('✅ Card expiry element mounted');
                } catch (e) {
                    console.error('❌ Failed to mount card expiry element:', e);
                    return;
                }

                try {
                    cardCvcElement.mount('#card-cvc-element');
                    console.log('✅ Card CVC element mounted');
                } catch (e) {
                    console.error('❌ Failed to mount card CVC element:', e);
                    return;
                }

                console.log('✅ All Stripe card elements successfully mounted!');
                attachElementEventListeners();

            } catch (err) {
                console.error('❌ Error initializing Stripe:', err);
            }
        }

        // Attach event listeners to elements
        function attachElementEventListeners() {
            const errorDiv = document.getElementById('card-errors');
            if (!errorDiv) {
                console.warn('⚠️ Error display element #card-errors not found');
                return;
            }

            // Handle card number element - detect brand and errors
            if (cardNumberElement) {
                cardNumberElement.addEventListener('change', function(event) {
                    // Detect card brand
                    const brand = event.brand || null;
                    updateCardBrandDisplay(brand);
                    
                    if (event.error) {
                        console.warn('Card number error:', event.error.message);
                        errorDiv.textContent = event.error.message;
                        errorDiv.style.display = 'block';
                    } else {
                        errorDiv.textContent = '';
                        errorDiv.style.display = 'none';
                    }
                });

                cardNumberElement.addEventListener('focus', function() {
                    document.getElementById('card-number-element').style.borderColor = '#34FF67';
                });

                cardNumberElement.addEventListener('blur', function() {
                    document.getElementById('card-number-element').style.borderColor = '#ddd';
                });
            }

            // Handle expiry element
            if (cardExpiryElement) {
                cardExpiryElement.addEventListener('change', function(event) {
                    if (event.error) {
                        console.warn('Card expiry error:', event.error.message);
                        errorDiv.textContent = event.error.message;
                        errorDiv.style.display = 'block';
                    } else {
                        errorDiv.textContent = '';
                        errorDiv.style.display = 'none';
                    }
                });

                cardExpiryElement.addEventListener('focus', function() {
                    document.getElementById('card-expiry-element').style.borderColor = '#34FF67';
                });

                cardExpiryElement.addEventListener('blur', function() {
                    document.getElementById('card-expiry-element').style.borderColor = '#ddd';
                });
            }

            // Handle CVC element
            if (cardCvcElement) {
                cardCvcElement.addEventListener('change', function(event) {
                    if (event.error) {
                        console.warn('Card CVC error:', event.error.message);
                        errorDiv.textContent = event.error.message;
                        errorDiv.style.display = 'block';
                    } else {
                        errorDiv.textContent = '';
                        errorDiv.style.display = 'none';
                    }
                });

                cardCvcElement.addEventListener('focus', function() {
                    document.getElementById('card-cvc-element').style.borderColor = '#34FF67';
                });

                cardCvcElement.addEventListener('blur', function() {
                    document.getElementById('card-cvc-element').style.borderColor = '#ddd';
                });
            }
        }

        // Update card brand display based on detected brand
        function updateCardBrandDisplay(brand) {
            const brandDisplay = document.getElementById('card-brand-display');
            const brandIcons = {
                'visa': document.getElementById('brand-visa'),
                'mastercard': document.getElementById('brand-mastercard'),
                'amex': document.getElementById('brand-amex'),
                'discover': document.getElementById('brand-discover'),
                'diners': document.getElementById('brand-diners'),
                'jcb': document.getElementById('brand-jcb'),
                'unionpay': document.getElementById('brand-unionpay')
            };

            // Hide all brand icons
            Object.values(brandIcons).forEach(icon => {
                if (icon) icon.style.display = 'none';
            });

            // Show only detected brand
            if (brand && brandIcons[brand]) {
                brandIcons[brand].style.display = 'block';
            }
        }

        // Process payment
        async function processPayment() {
            try {
                // Check if Stripe is initialized
                if (!stripe || !cardNumberElement) {
                    console.error('❌ Stripe not initialized. Card fields may not be ready.');
                    showError('Payment system is not ready. Please refresh the page.');
                    return;
                }

                const form = document.getElementById('checkout-form');
                const payButton = document.getElementById('pay-button');
                const deliveryMethod = document.querySelector('input[name="delivery_method"]:checked');
                
                // Validate form
                if (!form.checkValidity()) {
                    showError('Please fill out all required fields');
                    form.reportValidity();
                    return;
                }

                // Validate delivery method is selected
                if (!deliveryMethod) {
                    showError('Please select a delivery method');
                    return;
                }

                // For delivery method, ensure address fields are filled
                if (deliveryMethod.value === '2') {
                    const deliveryName = form.querySelector('input[name="delivery_name"]').value.trim();
                    const deliveryStreet = form.querySelector('input[name="delivery_street"]').value.trim();
                    const deliveryCity = form.querySelector('input[name="delivery_city"]').value.trim();
                    const deliveryPostal = form.querySelector('input[name="delivery_postal"]').value.trim();
                    const deliveryCountry = form.querySelector('input[name="delivery_country"]').value.trim();

                    if (!deliveryName || !deliveryStreet || !deliveryCity || !deliveryPostal || !deliveryCountry) {
                        showError('Please fill out all delivery address fields');
                        return;
                    }
                }

                // Show loading state
                payButton.disabled = true;
                payButton.innerHTML = '<span class="spinner"></span> Processing...';

                console.log('🔄 Creating payment method...');
                console.log('Card Number Element exists:', !!cardNumberElement);
                console.log('Card Expiry Element exists:', !!cardExpiryElement);
                console.log('Card CVC Element exists:', !!cardCvcElement);

                // Create payment method with card element
                const { error, paymentMethod } = await stripe.createPaymentMethod({
                    type: 'card',
                    card: cardNumberElement
                });

                if (error) {
                    console.error('❌ Stripe createPaymentMethod error:', error);
                    showError('Card error: ' + error.message);
                    payButton.disabled = false;
                    payButton.innerHTML = 'Pay $<?= number_format($order['total'], 2) ?>';
                    return;
                }

                console.log('✅ Payment method created:', paymentMethod.id);

            // Send to backend
            try {
                const response = await fetch('<?= site_url('checkout/prepare_payment') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        [window.CSRF_TOKEN_NAME]: window.CSRF_TOKEN_VALUE,
                        payment_method_id: paymentMethod.id,
                        equipment_payment_id: form.querySelector('input[name="equipment_payment_id"]').value,
                        item_id: form.querySelector('input[name="item_id"]').value,
                        quantity: form.querySelector('input[name="quantity"]').value,
                        start_date: form.querySelector('input[name="start_date"]').value,
                        end_date: form.querySelector('input[name="end_date"]').value,
                        customer_email: form.querySelector('input[name="customer_email"]').value,
                        customer_phone: form.querySelector('input[name="customer_phone"]').value,
                        delivery_name: deliveryMethod.value === '2' ? form.querySelector('input[name="delivery_name"]').value : '',
                        delivery_street: deliveryMethod.value === '2' ? form.querySelector('input[name="delivery_street"]').value : '',
                        delivery_city: deliveryMethod.value === '2' ? form.querySelector('input[name="delivery_city"]').value : '',
                        delivery_postal: deliveryMethod.value === '2' ? form.querySelector('input[name="delivery_postal"]').value : '',
                        delivery_country: deliveryMethod.value === '2' ? form.querySelector('input[name="delivery_country"]').value : '',
                        delivery_method: deliveryMethod.value,
                        delivery_notes: form.querySelector('textarea[name="delivery_notes"]').value
                    })
                });

                const data = await response.json();

                if (!response.ok || !data.success) {
                    console.error('❌ Backend error:', data.message);
                    showError(data.message || 'Payment failed');
                    payButton.disabled = false;
                    payButton.innerHTML = 'Pay $<?= number_format($order['total'], 2) ?>';
                    return;
                }

                console.log('✅ Backend accepted payment method, processing...');

                // Store payment intent ID for success redirect
                const paymentIntentId = data.payment_intent_id;

                // Handle 3D Secure / SCA if required
                if (data.requires_action && data.client_secret) {
                    console.log('ℹ️ 3D Secure required, confirming payment...');
                    const result = await stripe.confirmPayment({
                        clientSecret: data.client_secret,
                        confirmParams: {
                            return_url: '<?= site_url('checkout/payment_success') ?>?payment_intent=' + paymentIntentId
                        }
                    });
                    
                    if (result.error) {
                        console.error('❌ Payment confirmation error:', result.error);
                        showError(result.error.message);
                        payButton.disabled = false;
                        payButton.innerHTML = 'Pay $<?= number_format($order['total'], 2) ?>';
                        return;
                    }
                } else {
                    // Payment successful (no 3D Secure needed)
                    console.log('✅ Payment successful! Intent ID:', paymentIntentId);
                    showSuccess('Payment successful!');
                    setTimeout(() => {
                        window.location.href = '<?= site_url('checkout/payment_success') ?>?payment_intent=' + paymentIntentId;
                    }, 1500);
                }

            } catch (err) {
                console.error('❌ Payment processing error:', err);
                showError('An error occurred during payment: ' + err.message);
                payButton.disabled = false;
                payButton.innerHTML = 'Pay $<?= number_format($order['total'], 2) ?>';
            }
            } catch (err) {
                console.error('❌ Outer error in payment processing:', err);
                showError('An unexpected error occurred');
                const payButton = document.getElementById('pay-button');
                if (payButton) {
                    payButton.disabled = false;
                    payButton.innerHTML = 'Pay $<?= number_format($order['total'], 2) ?>';
                }
            }
        }

        // Update radio button styling
        document.querySelectorAll('.radio-option input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.querySelectorAll('.radio-option').forEach(opt => opt.classList.remove('checked'));
                if (this.checked) {
                    this.closest('.radio-option').classList.add('checked');
                }
            });
        });

        // Update delivery display based on selection
        function updateDeliveryDisplay() {
            const deliveryMethod = document.querySelector('input[name="delivery_method"]:checked');
            const pickupSection = document.getElementById('pickup-section');
            const deliverySection = document.getElementById('delivery-section');
            const deliveryInputs = deliverySection.querySelectorAll('input:not([name="delivery_notes"]), textarea');

            if (deliveryMethod && deliveryMethod.value === '1') {
                // Pickup selected
                pickupSection.style.display = 'block';
                deliverySection.style.display = 'none';
                
                // Remove required from delivery fields
                deliveryInputs.forEach(input => {
                    input.removeAttribute('required');
                });
            } else if (deliveryMethod && deliveryMethod.value === '2') {
                // Delivery selected
                pickupSection.style.display = 'none';
                deliverySection.style.display = 'block';
                
                // Add required to delivery fields (except notes)
                deliverySection.querySelectorAll('input[type="text"], input[type="email"], input[type="tel"]').forEach(input => {
                    if (input.name !== 'delivery_notes') {
                        input.setAttribute('required', 'required');
                    }
                });
            }
        }

        // Initialize delivery display on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Set default selection to pickup
            const pickupRadio = document.querySelector('input[name="delivery_method"][value="1"]');
            if (pickupRadio) {
                pickupRadio.checked = true;
                pickupRadio.closest('.radio-option').classList.add('checked');
                updateDeliveryDisplay();
            }
        });
    </script>

</body>
</html>
