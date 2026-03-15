<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Stripe Configuration
|--------------------------------------------------------------------------
|
| Configure Stripe API keys for test and live modes
| 
| SECURITY NOTE: In production, move these to environment variables or 
| secure configuration management system. DO NOT commit real keys to Git.
|
*/

// Stripe Mode: loaded from environment — set STRIPE_MODE in phpenv.php
// SECURITY: All API keys are loaded from environment variables.
// Set values in phpenv.php (gitignored). See phpenv.php.example for the template.
$config['stripe_mode'] = getenv('STRIPE_MODE') ?: 'test';

// Test Mode Keys — set in phpenv.php
$config['stripe_test_publishable_key'] = getenv('STRIPE_TEST_PUBLISHABLE_KEY');
$config['stripe_test_secret_key']      = getenv('STRIPE_TEST_SECRET_KEY');
$config['stripe_test_webhook_secret']  = getenv('STRIPE_TEST_WEBHOOK_SECRET');

// Live Mode Keys — set in phpenv.php when going live
$config['stripe_live_publishable_key'] = getenv('STRIPE_LIVE_PUBLISHABLE_KEY');
$config['stripe_live_secret_key']      = getenv('STRIPE_LIVE_SECRET_KEY');
$config['stripe_live_webhook_secret']  = getenv('STRIPE_LIVE_WEBHOOK_SECRET');

// Default currency
$config['stripe_currency'] = 'USD';

// Payment success/cancel URLs
$config['stripe_success_url'] = base_url('payment/success');
$config['stripe_cancel_url'] = base_url('payment/cancel');

// Webhook endpoint URL (must be publicly accessible)
$config['stripe_webhook_url'] = base_url('stripe/webhook');

// Default commission percentage if not set per item (percentage 0-100)
$config['stripe_default_commission'] = 10.00;
