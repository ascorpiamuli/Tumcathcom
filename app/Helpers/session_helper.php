<?php
if (!function_exists('generateSessionToken')) {
    // Generate a unique session token
    function generateSessionToken() {
        return bin2hex(random_bytes(16)); // Generate a 32-character hexadecimal token
    }
}

if (!function_exists('setUserSession')) {
    // Set the session data along with a unique session token
    function setUserSession($userId, $sessionToken) {
        session()->regenerate(); // Regenerate the session ID
        session()->set(['user_id' => $userId, 'session_token' => $sessionToken]);
    }
}
if (!function_exists('validateSessionToken')) {
    function validateSessionToken($sessionToken, $userType) {
        if ($userType === 'admin') {
            $model = new \App\Models\AdminAuthenticationModel();
        } else {
            $model = new \App\Models\UserAuthenticationModel();
        }

        return $model->where('session_token', $sessionToken)->first();
    }
}

