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
function generateBookingId() {
    // Define all the uppercase alphabets to choose from
    $alphabets = range('A', 'Z');
    
    // Start the booking ID with 'B'
    $bookingId = 'B';
    
    // Generate 9 random characters from the alphabet to make the total length 10
    for ($i = 0; $i < 9; $i++) {
        $randomChar = $alphabets[array_rand($alphabets)];  // Randomly pick an alphabet
        $bookingId .= $randomChar;
    }
    
    return $bookingId;
}

if (!function_exists('generate_admin_id')) {
    function generate_departmental_id($position)
    {
        // Extract the first three letters and convert to uppercase
        $prefix = strtoupper(substr($position, 0, 3));

        // Generate a random 4-digit number
        $random_number = rand(1000, 9999);

        // Get the current year
        $year = date('Y');

        // Format the ID as "ABC-1234/2025"
        return "{$prefix}-{$random_number}/{$year}";
    }
}











