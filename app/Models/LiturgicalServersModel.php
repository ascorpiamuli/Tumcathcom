<?php

namespace App\Models;

use CodeIgniter\Model;

class LiturgicalServersModel extends Model
{
    // Specify the table name for this model
    protected $table = 'altar_servers'; // Set the table name here
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    
    // Define allowed fields for the model
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

    // Control Insert & Update behavior
    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Cast data types for specific fields if necessary
    protected array $casts = [];
    protected array $castHandlers = [];

    // Define dates for the model
    protected $useTimestamps = true; // Enable timestamps for automatic date handling
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation rules and messages
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    /**
     * Save data to the liturgical_servers table
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
                log_message('info', "Data saved successfully to table '{$this->table}'.");
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
     * Get servers data based on full name
     * 
     * @param string $fullName
     * @return array|null
     */
    public function getServersData($fullName)
    {
        // Fetch the servers record based on the full name
        $serversdata = $this->where('name', $fullName)->first();

        // Check if the server exists
        if ($serversdata) {
            return $serversdata; // Return the server data as an array
        }

        return null; // If server not found, return null
    }
}
