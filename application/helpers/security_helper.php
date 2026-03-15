<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Security Helper
 *
 * Centralises CSRF token output and other security utilities so every view
 * can call csrf_field() without repeating boilerplate.
 */

if (!function_exists('csrf_field')) {
    /**
     * Returns a hidden input containing the current CSRF token.
     * Drop <?= csrf_field() ?> as the first child of every <form> that uses
     * method="post".  AJAX fetch/XHR endpoints that are excluded in
     * csrf_exclude_uris do not need this.
     *
     * @return string  HTML hidden input tag
     */
    function csrf_field()
    {
        $CI =& get_instance();
        $name  = $CI->security->get_csrf_token_name();
        $token = $CI->security->get_csrf_hash();
        return '<input type="hidden" name="' . $name . '" value="' . $token . '">';
    }
}

if (!function_exists('csrf_meta_tag')) {
    /**
     * Returns a <meta> tag that exposes the CSRF token for JS fetch() calls.
     * Place <?= csrf_meta_tag() ?> inside the <head> of layouts that make
     * authenticated AJAX POSTs that are NOT excluded from CSRF.
     *
     * Usage in JS:
     *   const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
     *   fetch(url, { method:'POST', headers:{'X-CSRF-Token': csrfToken}, ... });
     *
     * @return string  HTML meta tag
     */
    function csrf_meta_tag()
    {
        $CI =& get_instance();
        $token = $CI->security->get_csrf_hash();
        return '<meta name="csrf-token" content="' . $token . '">';
    }
}

if (!function_exists('h')) {
    /**
     * HTML-escape a value for safe output in HTML context.
     *
     * Use <?= h($var) ?> in every view instead of <?= $var ?> to prevent
     * Cross-Site Scripting (XSS) attacks from stored or reflected user data.
     *
     * Converts all applicable characters to HTML entities using ENT_QUOTES
     * (escapes both single AND double quotes) plus ENT_HTML5.
     *
     * @param  mixed  $str  The value to escape (will be cast to string)
     * @return string       HTML-safe string safe for output inside HTML tags
     */
    function h($str)
    {
        return htmlspecialchars((string)$str, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }
}
