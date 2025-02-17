<?php

namespace App\Models;

use CodeIgniter\Model;

class SuggestionsModel extends Model
{
    protected $table            = 'suggestions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = ['user_id', 'message', 'created_at'];

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

    public function getAllSuggestions()
    {
        $result = $this->select('suggestions.*, user_profiles.user_id, CONCAT(user_profiles.first_name, " ", user_profiles.last_name) AS full_name')
                       ->join('user_profiles', 'user_profiles.user_id = suggestions.user_id')
                       ->orderBy('suggestions.created_at', 'ASC')
                       ->findAll();
        // Ensure it always returns an array, even if empty
        return !empty($result) ? $result : [];
    }
    
}    
