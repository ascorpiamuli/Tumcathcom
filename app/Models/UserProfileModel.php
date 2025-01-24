<?php

namespace App\Models;

use CodeIgniter\Model;

class UserProfileModel extends Model
{
    protected $table = 'user_profiles';
    protected $primaryKey = 'user_id';
    protected $allowedFields = [
        'user_id', 'first_name', 'last_name', 'registration_number', 'dob',
        'year_of_study', 'family_jumuia', 'baptized', 'confirmed',
        'course', 'created_at', 'updated_at', 'profile_image'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Method to fetch and format the date entered by the user
    public function getDateEnteredById($user_id)
    {
        log_message('info', "Fetching created_at for user_id: {$user_id}");

        $date = $this->select('created_at')
                     ->where('user_id', $user_id)
                     ->first();

        if ($date) {
            $formattedDate = (new \DateTime($date['created_at']))->format('M d, Y \a\t h:i A');
            log_message('info', "Formatted date for user_id {$user_id}: {$formattedDate}");
            return $formattedDate;
        }

        log_message('error', "No created_at date found for user_id: {$user_id}");
        return null;
    }

    // Method to fetch and format the user's full name
    public function getUserFullNameById($user_id)
    {
        log_message('info', "Fetching full name for user_id: {$user_id}");

        $user = $this->select('first_name, last_name')
                    ->where('user_id', $user_id)
                    ->first();

        if ($user) {
            $fullName = ucwords(strtolower($user['first_name'])) . ' ' . ucwords(strtolower($user['last_name']));
            log_message('info', "Full name for user_id {$user_id}: {$fullName}");
            return $fullName;
        }

        log_message('error', "No user found for user_id: {$user_id}");
        return null;
    }

    // Method to fetch family name with proper formatting
    public function getFamilyNamebyId($user_id)
    {
        log_message('info', "Fetching family name for user_id: {$user_id}");

        $user = $this->select('family_jumuia')
            ->where('user_id', $user_id)
            ->first();

        if ($user) {
            $familyUnderscores = str_replace('_', ' ', $user['family_jumuia']);
            $family = ucwords(strtolower($familyUnderscores));
            $familyWithDot = preg_replace('/\bSt\s/', 'St. ', $family);
            log_message('info', "Family name for user_id {$user_id}: {$familyWithDot}");
            return $familyWithDot;
        }

        log_message('error', "No family name found for user_id: {$user_id}");
        return null;
    }

    // Save method to insert user data
    public function save($data): bool
    {
        log_message('info', "Attempting to save user data: " . json_encode($data));

        try {
            $result = $this->insert($data);

            if ($result) {
                log_message('info', "User data saved successfully.");
                return true;
            } else {
                log_message('error', "Failed to save user data. Errors: " . json_encode($this->errors()));
                return false;
            }
        } catch (\Exception $e) {
            log_message('error', "Exception while saving user data. Message: " . $e->getMessage());
            return false;
        }
    }

    // Get user profile by ID
    public function getUserProfileById($user_id)
    {
        log_message('info', "Fetching user profile for user_id: {$user_id}");

        $userProfile = $this->where('user_id', $user_id)->first();

        if ($userProfile) {
            log_message('info', "User profile found for user_id: {$user_id}");
            return $userProfile;
        }

        log_message('error', "No user profile found for user_id: {$user_id}");
        return null;
    }
}
