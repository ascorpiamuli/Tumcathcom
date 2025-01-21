<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\Exceptions\DataException;

class UserAuthenticationModel extends Model
{
    protected $table = 'user_authentication';
    protected $primaryKey = 'user_id';  // Changed to 'user_id' as it's the primary key
    protected $allowedFields = ['user_id', 'username', 'email', 'phone_number', 'password', 'profile_completed', 'session_token'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Update the session token for a user
     *
     * @param string $userId
     * @param string $sessionToken
     * @return bool
     */
    public function updateSessionToken(string $userId, string $sessionToken): bool
    {
        // Check if user exists using the user_id (string)
        $user = $this->where('user_id', $userId)->first();

        if (!$user) {
            log_message('error', "User with ID {$userId} not found.");
            return false;
        }

        // Data to update
        $data = [
            'session_token' => $sessionToken,  // Update session token
            'updated_at' => date('Y-m-d H:i:s')  // Update timestamp
        ];

        // Attempt to update the user data
        try {
            $updateStatus = $this->update($userId, $data);
            
            if ($updateStatus) {
                log_message('info', "Successfully updated session token for user ID {$userId}");
                return true;
            } else {
                log_message('error', "Failed to update session token for user ID {$userId}");
                return false;
            }
        } catch (DataException $e) {
            log_message('error', "DataException: " . $e->getMessage());
            return false;
        }
    }
    public function save($data): bool
    {
        try {
            // Attempt to insert the user data
            $result = $this->insert($data);
    
            if ($result) {
                // If insertion is successful, log and return true
                log_message('info', "User data saved successfully.");
                return true;
            } else {
                // If insertion fails, log the error and return false
                log_message('error', "Failed to save user data: " . $this->errors());
                return false;
            }
        } catch (DataException $e) {
            // Log any database exceptions
            log_message('error', "DataException: " . $e->getMessage());
            return false;
        }
    }
    public function getUserProfileById($user_id)
    {
        // Fetch all columns from the user_profiles table for the given user_id
        $userauthprofile = $this->where('user_id', $user_id)->first();

        // Check if the user profile exists
        if ($userauthprofile) {
            return $userauthprofile; // Return the user profile as an array
        }

        return null; // If user not found, return null
    }
    
    
}
