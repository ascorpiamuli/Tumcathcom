<?php

namespace App\Models;

use CodeIgniter\Model;

namespace App\Models;

use CodeIgniter\Model;

class AssetsModel extends Model
{
    protected $table = 'assets_history';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name',
        'category',
        'comments',
        'quantity',
        'value',
        'asset_condition',
        'booking_id',
        'phone',
        'family',
        'location',
        'booked_by',
        'booking_start_date',
        'booking_end_date',
    ];
    protected $useTimestamps = true;
    public function getAssetsData($fullName)
    {
        // Fetch all columns from the user_profiles table for the given user_id
        $assetsdata = $this->where('booked_by', $fullName)->first();

        // Check if the user profile exists
        if ($assetsdata) {
            return $assetsdata; // Return the user profile as an array
        }

        return null; // If user not found, return null
    }
}


