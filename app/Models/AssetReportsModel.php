<?php
namespace App\Models;

use CodeIgniter\Model;

class AssetReportsModel extends Model
{
    protected $table            = 'assetreports';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['report_id', 'report_month', 'report_date', 'report_publisher', 'expenses_incurred', 'revenues_earned', 'pdf_path', 'created_at', 'updated_at'];

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

    // Method to get all data from assetreports table
    public function getAllReports()
    {
        return $this->findAll();  // This will return all rows from the assetreports table
    }

    // Method to save comments for asset reports
    public function saveComment($reportId, $userId, $comment)
    {
        // Assuming you have a `comments` table that stores the comments linked to reports
        $commentData = [
            'report_id' => $reportId,
            'user_id' => $userId,
            'comment' => $comment,
            'created_at' => date('Y-m-d H:i:s') // Adding timestamp
        ];

        // Insert comment data into the comments table
        $db = \Config\Database::connect();
        $builder = $db->table('asset_reports_comments');
        $builder->insert($commentData);

        // Return the success status
        return $db->affectedRows() > 0;
    }
    public function hasCommented($reportId, $userId)
    {
        return $this->db->table('asset_reports_comments')  // Adjust to your actual comments table
            ->where('report_id', $reportId)
            ->where('user_id', $userId)
            ->countAllResults() > 0;  // Check if there are any existing comments from this user for the report
    }
}
