<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\Exceptions\DataException;

class AdminAuthenticationModel extends Model
{
    protected $table = 'admin_users';  // Admin table
    protected $primaryKey = 'admin_id'; 
    protected $allowedFields = ['admin_id', 'departmental_id','position', 'admin_email', 'password', 'session_token'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get all admin authentication records
     */
    public function getAllAdmins()
    {
        log_message('info', "Fetching all admin authentication records.");
        return $this->findAll() ?: [];
    }

    /**
     * Get a single admin by ID
     */
    public function getAdminById(string $adminId)
    {
        return $this->where('admin_id', $adminId)->first();
    }

    /**
     * Update the session token for an admin
     */
    public function updateSessionToken(string $adminId, string $sessionToken): bool
    {
        log_message('info', "Attempting to update session token for Admin ID {$adminId}.");

        // Check if admin exists
        $admin = $this->where('admin_id', $adminId)->first();
        if (!$admin) {
            log_message('error', "Admin with ID {$adminId} not found.");
            return false;
        }

        // Data to update
        $data = [
            'session_token' => $sessionToken,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Attempt update
        try {
            return $this->update($adminId, $data);
        } catch (DataException $e) {
            log_message('error', "DataException: " . $e->getMessage());
            return false;
        }
    }
}
