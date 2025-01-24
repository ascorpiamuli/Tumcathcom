<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\Exceptions\DataException;

class UserAuthenticationModel extends Model
{
    protected $table = 'user_authentication';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['user_id', 'username', 'email', 'phone_number', 'password', 'profile_completed', 'session_token'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Update the session token for a user
     */
    public function updateSessionToken(string $userId, string $sessionToken): bool
    {
        log_message('info', "Attempting to update session token for user ID {$userId}.");

        // Check if user exists using the user_id
        $user = $this->where('user_id', $userId)->first();
        if (!$user) {
            log_message('error', "User with ID {$userId} not found.");
            return false;
        }

        log_message('info', "User found. Preparing to update session token.");

        // Data to update
        $data = [
            'session_token' => $sessionToken,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Attempt to update the user data
        try {
            log_message('info', "Updating session token for user ID {$userId}.");
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
        log_message('info', "Attempting to save user data: " . json_encode($data));

        try {
            $result = $this->insert($data);

            if ($result) {
                log_message('info', "User data saved successfully.");
                return true;
            } else {
                log_message('error', "Failed to save user data: " . $this->errors());
                return false;
            }
        } catch (DataException $e) {
            log_message('error', "DataException: " . $e->getMessage());
            return false;
        }
    }

    public function getUserProfileById($user_id)
    {
        log_message('info', "Fetching user profile for user ID {$user_id}.");

        $userauthprofile = $this->where('user_id', $user_id)->first();

        if ($userauthprofile) {
            log_message('info', "User profile found for user ID {$user_id}.");
            return $userauthprofile;
        }

        log_message('error', "User profile not found for user ID {$user_id}.");
        return null;
    }
}
