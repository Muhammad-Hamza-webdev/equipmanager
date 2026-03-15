<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Jwt_service
 * 
 * Handles JWT token generation and verification for Socket.io authentication.
 * Uses HS256 algorithm for signing.
 */
class Jwt_service
{

    private $secret_key;
    private $algorithm = 'HS256';
    private $expiration_time = 86400; // 24 hours in seconds

    public function __construct()
    {
        // Load JWT secret exclusively from environment variable.
        // Set JWT_SECRET in phpenv.php — see phpenv.php.example for instructions.
        // SECURITY: No hardcoded fallback. Tokens are non-functional until configured.
        $this->secret_key = getenv('JWT_SECRET');

        if (!$this->secret_key) {
            // Log a loud warning. Chat JWT tokens will not validate correctly
            // until JWT_SECRET is configured in phpenv.php.
            log_message('error', 'SECURITY WARNING: JWT_SECRET is not configured. Set it in phpenv.php. Chat authentication is non-functional.');
            // Use a per-boot random key so the app does not crash, but tokens
            // will be invalidated on every server restart (intentionally broken
            // until properly configured).
            $this->secret_key = 'UNCONFIGURED-' . bin2hex(random_bytes(16));
        }
    }

    /**
     * Generate JWT token for chat authentication
     * 
     * @param int $user_id
     * @param int $chat_id
     * @param string $role 'buyer' or 'seller'
     * @return string JWT token
     */
    public function generate_token($user_id, $chat_id, $role)
    {
        $issued_at = time();
        $expiration = $issued_at + $this->expiration_time;

        // Ensure IDs are integers (not strings)
        $payload = [
            'iat' => $issued_at,
            'exp' => $expiration,
            'user_id' => (int)$user_id,
            'chat_id' => (int)$chat_id,
            'role' => (string)$role
        ];

        return $this->encode($payload);
    }

    /**
     * Verify and decode JWT token
     * 
     * @param string $token
     * @return array|false Decoded payload on success, false on failure
     */
    public function verify_token($token)
    {
        try {
            $decoded = $this->decode($token);

            // Check expiration
            if (isset($decoded['exp']) && $decoded['exp'] < time()) {
                return false;
            }

            // Validate required fields
            if (!isset($decoded['user_id']) || !isset($decoded['chat_id']) || !isset($decoded['role'])) {
                return false;
            }

            return $decoded;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Encode payload to JWT
     * Simple implementation without external dependencies
     * 
     * @param array $payload
     * @return string
     */
    private function encode($payload)
    {
        $header = [
            'typ' => 'JWT',
            'alg' => $this->algorithm
        ];

        $header_encoded = $this->base64url_encode(json_encode($header));
        $payload_encoded = $this->base64url_encode(json_encode($payload));

        $signature = hash_hmac(
            'sha256',
            $header_encoded . '.' . $payload_encoded,
            $this->secret_key,
            true
        );
        $signature_encoded = $this->base64url_encode($signature);

        return $header_encoded . '.' . $payload_encoded . '.' . $signature_encoded;
    }

    /**
     * Decode and verify JWT
     * 
     * @param string $token
     * @return array
     * @throws Exception
     */
    private function decode($token)
    {
        $parts = explode('.', $token);

        if (count($parts) !== 3) {
            throw new Exception('Invalid token format');
        }

        list($header_encoded, $payload_encoded, $signature_encoded) = $parts;

        // Verify signature
        $signature = $this->base64url_decode($signature_encoded);
        $expected_signature = hash_hmac(
            'sha256',
            $header_encoded . '.' . $payload_encoded,
            $this->secret_key,
            true
        );

        if (!hash_equals($expected_signature, $signature)) {
            throw new Exception('Invalid signature');
        }

        // Decode payload
        $payload = json_decode($this->base64url_decode($payload_encoded), true);

        if (!$payload) {
            throw new Exception('Invalid payload');
        }

        return $payload;
    }

    /**
     * Base64 URL encode
     * 
     * @param string $data
     * @return string
     */
    private function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    /**
     * Base64 URL decode
     * 
     * @param string $data
     * @return string
     */
    private function base64url_decode($data)
    {
        return base64_decode(strtr($data, '-_', '+/'));
    }
}
