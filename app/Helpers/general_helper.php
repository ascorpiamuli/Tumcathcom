<?php

if (!function_exists('generateUserId')) {
    function generateUserId() {
        // Generate a random string with letters and numbers (16 characters long)
        $randomString = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"), 0, 16);
        
        // Get the current timestamp and convert it to a string
        $timestamp = (string) time();

        // Combine the random string with the timestamp, ensuring a total length of 32 characters
        $userId = $randomString . substr($timestamp, 0, 16);  // Use part of the timestamp if needed

        return $userId;  // Return a 32 character unique user_id
    }
}



