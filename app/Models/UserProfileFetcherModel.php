<?php

namespace App\Models;

use CodeIgniter\Model;

class UserProfileFetcherModel extends Model
{
    protected $table = 'user_profiles';
    protected $primaryKey = 'user_id';

    // Fetch user profile details by user_id, including first_name and last_name
    public function getUserFullNameById($user_id)
    {
        // Query to fetch only first_name and last_name columns
        return $this->select('first_name, last_name')
                    ->where('user_id', $user_id)
                    ->first();
    }
}


