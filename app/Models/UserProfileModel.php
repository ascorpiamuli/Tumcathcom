<?php

namespace App\Models;

use CodeIgniter\Model;

class UserProfileModel extends Model
{
    protected $table = 'user_profiles';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id', 'first_name', 'last_name', 'registration_number', 'dob', 
        'year_of_study', 'family_jumuia', 'baptized', 'confirmed', 
        'course', 'created_at', 'updated_at',
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Method to fetch and format full name (first_name + last_name)
    public function getUserFullNameById($user_id)
    {
        // Fetch the first_name and last_name for the given user_id
        $user = $this->select('first_name, last_name')
                    ->where('user_id', $user_id)
                    ->first();

        // Capitalize the first letter of each name part and concatenate them
        if ($user) {
            $fullName = ucwords(strtolower($user['first_name'])) . ' ' . ucwords(strtolower($user['last_name']));
            return $fullName; // Return the full name as one string
        }

        return null; // If user not found, return null
    }
}


