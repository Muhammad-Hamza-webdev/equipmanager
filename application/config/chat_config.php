<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Environment Configuration for Chat System
|--------------------------------------------------------------------------
|
| JWT Secret and Node.js Server URL configuration
| IMPORTANT: These values must match in both PHP and Node.js
|
*/

// JWT Secret Key (MUST match Node.js server)
// SECURITY: Do NOT hardcode this value here.
// Set JWT_SECRET in phpenv.php (see phpenv.php.example). It must match the
// JWT_SECRET in chat-server/.env on the Node.js side.
if (!getenv('JWT_SECRET')) {
    log_message('error', 'SECURITY: JWT_SECRET environment variable is not set. Set it in phpenv.php immediately.');
}

// Node.js Chat Server URL
// If CHAT_SERVER_URL env var is set (production), use it directly.
// Otherwise auto-detect based on current request (handles localhost, ngrok).
if (getenv('CHAT_SERVER_URL')) {
    // --- PRODUCTION: explicit override via phpenv.php ---
    $node_server_url = rtrim(getenv('CHAT_SERVER_URL'), '/');
    $php_api_url     = 'https://equipmanager.dk';
} else {
    // --- LOCAL / NGROK: auto-detect from request ---
    $protocol = 'http';
    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
        $protocol = 'https';
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
        $protocol = 'https';
    }

    // Get hostname (ngrok passes X-Forwarded-Host)
    $host = $_SERVER['HTTP_HOST'] ?? $_SERVER['SERVER_NAME'] ?? 'localhost';
    if (!empty($_SERVER['HTTP_X_FORWARDED_HOST'])) {
        $host = $_SERVER['HTTP_X_FORWARDED_HOST'];
    }

    // Remove port from host if present
    $host_without_port = explode(':', $host)[0];

    // Detect base path (handles subdirectories like /equipmanager)
    $script_name = $_SERVER['SCRIPT_NAME'] ?? '';
    $path = preg_replace('@/index\\.php/*@', '', $script_name);
    $path = rtrim($path, '/');
    if (empty($path) || $path === '/' || $path === '') {
        $path = '';
    }

    // PHP API URL - same host as current request
    $php_api_url = $protocol . '://' . $host . $path;

    // Node.js Chat Server URL
    if ($host_without_port === 'localhost' || $host_without_port === '127.0.0.1') {
        $node_server_url = 'http://localhost:3000';
    } else {
        $node_server_url = $protocol . '://' . $host_without_port . ':3000';
    }
}

putenv('PHP_API_URL=' . $php_api_url);
putenv('NODE_SERVER_URL=' . $node_server_url);

// Make URLs available to JavaScript views
if (!defined('CHAT_PHP_API_URL')) {
    define('CHAT_PHP_API_URL', $php_api_url);
}
if (!defined('CHAT_NODE_SERVER_URL')) {
    define('CHAT_NODE_SERVER_URL', $node_server_url);
}
