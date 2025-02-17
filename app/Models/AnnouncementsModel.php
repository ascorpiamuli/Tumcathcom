<?php
namespace App\Models;

use CodeIgniter\Model;

class AnnouncementsModel extends Model
{
    protected $table            = 'announcements';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['title','announcement','created_at','admin_id'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getAnnouncements()
    {
        // Fetch announcements along with the full name of the admin and their position
        $announcements = $this->db->table('announcements')
            ->select('announcements.*, CONCAT(user_profiles.first_name, " ", user_profiles.last_name) AS full_name, admin_users.position')
            ->join('user_profiles', 'user_profiles.user_id = announcements.admin_id') // Ensure correct join condition
            ->join('admin_users', 'admin_users.admin_id = announcements.admin_id') // Join with the admin_users table
            ->orderBy('announcements.created_at', 'ASC') // Sort by the most recent announcement
            ->get()
            ->getResultArray(); // Return as an array of results

        // If no announcements are found, return an empty array
        if (empty($announcements)) {
            return [];
        }

    
        return $announcements;
    }
    
    
    
}
