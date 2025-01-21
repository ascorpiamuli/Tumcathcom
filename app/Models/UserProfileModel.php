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
    public function getDateEnteredById($user_id)
    {
        // Fetch the created_at date for the given user_id
        $date = $this->select('created_at')
                     ->where('user_id', $user_id)
                     ->first();
    
        // Check if the date exists
        if ($date) {
            // Format the created_at date as 'Nov 23, 2024 at 4:34 AM/PM'
            $formattedDate = (new \DateTime($date['created_at']))->format('M d, Y \a\t h:i A');
            
            return $formattedDate; // Return the formatted date string
        }
    
        return null; // If user not found, return null
    }
    

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
    public function getFamilyNamebyId($user_id)
    {
        $user = $this->select('family_jumuia')
            ->where('user_id', $user_id)
            ->first();

        if ($user) {
            // Replace underscores with spaces
            $familyUnderscores = str_replace('_', ' ', $user['family_jumuia']);

            // Capitalize words
            $family = ucwords(strtolower($familyUnderscores));

            // Add a period after "St" if it doesn't have one
            $familyWithDot = preg_replace('/\bSt\s/', 'St. ', $family);

            return $familyWithDot; // Return the formatted family name
        }
    }
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
    public function getUserProfileById($user_id)
    {
        // Fetch all columns from the user_profiles table for the given user_id
        $userProfile = $this->where('user_id', $user_id)->first();

        // Check if the user profile exists
        if ($userProfile) {
            return $userProfile; // Return the user profile as an array
        }

        return null; // If user not found, return null
    }


}


