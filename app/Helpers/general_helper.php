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
function format_phone_number($phone_number) {
    // Check if the phone number is already in the international format starting with '254'
    if (preg_match('/^254\d{9}$/', $phone_number)) {
        return $phone_number; // Return as-is
    }
    // Check if the phone number starts with '07' and has 10 digits
    elseif (preg_match('/^07\d{8}$/', $phone_number)) {
        // Replace leading '0' with '254'
        return '254' . substr($phone_number, 1);
    } else {
        // Handle invalid phone numbers
        throw new Exception("Invalid phone number format. Must start with '07' (10 digits) or '254' (12 digits).");
    }
}






