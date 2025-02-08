<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\Exceptions\DataException;

class AdminAuthenticationModel extends Model
{
    protected $table = 'admin_users';  // Admin table
    protected $primaryKey = 'admin_id'; 
    protected $allowedFields = ['admin_id', 'department_code', 'admin_email', 'password', 'session_token'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get all admin authentication records
     */
    public function getAllAdmins()
    {
        log_message('info', "Fetching all admin authentication records.");

        $admins = $this->findAll(); // Fetch all admin records

        if ($admins) {
            log_message('info', "Admin authentication records retrieved successfully.");
            return $admins;
        }

        log_message('error', "No admin authentication records found.");
        return [];
    }

    /**
     * Get a single admin by ID
     */
    public function getAdminById(string $adminId)
    {
        log_message('info', "Fetching admin profile for admin ID {$adminId}.");

        $admin = $this->where('admin_id', $adminId)->first();

        if ($admin) {
            log_message('info', "Admin profile found for admin ID {$adminId}.");
            return $admin;
        }

        log_message('error', "Admin profile not found for admin ID {$adminId}.");
        return null;
    }
        /**
     * Update the session token for a user
     */
    public function updateSessionToken(string $adminId, string $sessionToken): bool
    {
        log_message('info', "Attempting to update session token for Admin ID {$adminId}.");

        // Check if user exists using the user_id
        $admin= $this->where('admin_id', $adminId)->first();
        if (!$user) {
            log_message('error', "Admin with ID {$adminId} not found.");
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
            log_message('info', "Updating session token for admin ID {$adminId}.");
            $updateStatus = $this->update($userId, $data);

            if ($updateStatus) {
                log_message('info', "Successfully updated session token for admin ID {$adminId}");
                return true;
            } else {
                log_message('error', "Failed to update session token for admin ID {$adminId}");
                return false;
            }
        } catch (DataException $e) {
            log_message('error', "DataException: " . $e->getMessage());
            return false;
        }
    }
}
