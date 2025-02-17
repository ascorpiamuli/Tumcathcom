<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\Exceptions\DataException;

class AdminAuthenticationModel extends Model
{
    protected $table = 'admin_users';  // Admin table
    protected $primaryKey = 'admin_id'; 
    protected $allowedFields = ['admin_id', 'departmental_id','position', 'admin_email', 'password','suspended','updated_at', 'session_token','approval'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get all admin authentication records
     */
    public function getAllAdmins()
    {
        return $this->db->table('admin_users')
            ->select('admin_users.*, user_profiles.first_name, user_profiles.last_name, admin_users.approval')
            ->join('user_profiles', 'user_profiles.user_id = admin_users.admin_id')
            ->orderBy('admin_users.approval', 'ASC') // Sort by approval status (unapproved first)
            ->get()
            ->getResultArray();
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
    public function countRegisteredMembers(): int
    {
        return $this->countAll();
    }
    public function countActiveMembers(): int
    {
        return $this->where('approval', 1)->countAllResults();
    }
    public function getAdminOnlineUsers()
    {
        $oneDayAgo = date('Y-m-d H:i:s', strtotime('-1 day')); // Fetch users from the past 24 hours
    
        return $this->select('admin_users.admin_id, admin_users.updated_at, CONCAT(user_profiles.first_name, " ", user_profiles.last_name) AS full_name')
                    ->join('user_profiles', 'user_profiles.user_id = admin_users.admin_id') // Ensuring correct join
                    ->where('admin_users.updated_at >', $oneDayAgo)
                    ->orderBy('admin_users.updated_at', 'DESC') // Order by last activity (most recent first)
                    ->findAll();
    }
    
    
    
}
