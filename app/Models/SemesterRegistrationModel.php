<?php

namespace App\Models;

use CodeIgniter\Model;

class SemesterRegistrationModel extends Model
{
    protected $table            = 'semester_registrations';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id','name','phone_number','amount','progression','semester_period','family','status','created_at','updated_at'];

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
    public function getRegistrationData($fullName)
    {
        // Fetch all columns from the user_profiles table for the given user_id
        $registrationdata = $this->where('name', $fullName)->first();

        // Check if the user profile exists
        if ($registrationdata) {
            return $registrationdata; // Return the user profile as an array
        }

        return null; // If user not found, return null
    }
    public function countRegisteredMembers(): int
    {
        return $this->countAll();
    }
    public function countActiveMembers(): int
    {
        return $this->where('status', 'active')->countAllResults();
    }
    public function getWeeklyRegistrationPercentage(): float
    {
        // Get total registered members
        $totalMembers = (float) $this->countRegisteredMembers();
    
        // Get the number of members registered since last week
        $lastWeek = date('Y-m-d H:i:s', strtotime('-7 days'));
        $newRegistrations = $this->where('created_at >=', $lastWeek)->countAllResults();
    
        // Avoid division by zero
        if ($totalMembers == 0) {
            return  0.00;
        }
       
       log_message('debug',$this->countRegistrationFee());
       
        // Calculate percentage and ensure it's a float with two decimal places
        return (float) number_format(($newRegistrations / $totalMembers) * 100, 2, '.', '');
    }
    public function countRegistrationFee(): float
    {
        return (float) $this->selectSum('amount')->get()->getRow()->amount;
    }
    
    



}
