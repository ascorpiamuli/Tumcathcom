<?php

if (!function_exists('generateUserId')) {
    if (!function_exists('generateUserId')) {
        function generateUserId() {
            // Generate a random string with letters and numbers (16 characters long)
            $randomString = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"), 0, 16);
            
            // Get the current timestamp
            $timestamp = (string) time();
    
            // Interleave the random string and the timestamp
            $userId = '';
            $maxLength = max(strlen($randomString), strlen($timestamp));
            for ($i = 0; $i < $maxLength; $i++) {
                if (isset($randomString[$i])) {
                    $userId .= $randomString[$i];  // Add a character from the random string
                }
                if (isset($timestamp[$i])) {
                    $userId .= $timestamp[$i];  // Add a character from the timestamp
                }
            }
    
            // Trim to ensure the user ID does not exceed 32 characters
            $userId = substr($userId, 0, 32);
    
            return $userId;  // Return the final user ID
        }
    }
    
}
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
    // Validate the session token by checking if it exists in the database
    function validateSessionToken($sessionToken, $userAuthModel) {
        return $userAuthModel->where('session_token', $sessionToken)->first();
    }
}



