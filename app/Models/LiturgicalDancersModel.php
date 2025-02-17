<?php

namespace App\Models;

use CodeIgniter\Model;

class LiturgicalDancersModel extends Model
{
    protected $table            = 'liturgical_dancers'; // Define the table name
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'name',
        'phone',
        'gender',
        'academic_progression_status',
        'family_jumuia',
        'semester_period',
        'created_at',
        'updated_at',
    ];

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

    /**
     * Save data to the liturgical_dancers table
     * 
     * @param array $data
     * @return bool
     */
    public function saveData(array $data): bool
    {
        try {
            // Attempt to insert the data
            $result = $this->insert($data);

            if ($result) {
                log_message('info', "Data saved successfully to table '{$this->table}'");
                return true;
            } else {
                log_message('error', "Failed to save data to table '{$this->table}': " . json_encode($this->errors()));
                return false;
            }
        } catch (\Exception $e) {
            log_message('error', "Exception in saving data: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Fetch dancer data by name
     * 
     * @param string $fullName
     * @return array|null
     */
    public function getDancersData(string $fullName): ?array
    {
        // Fetch the dancer record by name
        $dancerData = $this->where('name', $fullName)->first();

        // Return the record if found
        return $dancerData ?: null;
    }
    public function countRegisteredMembers(): int
    {
        return $this->countAll();
    }
    public function countActiveMembers(): int
    {
        return $this->where('status', 'active')->countAllResults();
    }
}
