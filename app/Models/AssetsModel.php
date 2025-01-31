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
        'user_id',
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
    public function getAllAssetsData($fullName)
    {
        // Fetch all records for the given user
        $allassetsdata = $this->where('booked_by', $fullName)->findAll();
    
        // Return the result
        return $allassetsdata;
    }
    public function countAssetsForBooking($bookingId)
    {
        return $this->where('booking_id', $bookingId)->countAllResults();
    }
    public function getAssetsbyId($bookingId)
    {
        // Fetch all columns from the user_profiles table for the given user_id
        $assetsdata = $this->where('booking_id', $bookingId)->findAll();

        // Check if the user profile exists
        if ($assetsdata) {
            return $assetsdata; // Return the user profile as an array
        }
        return null; // If user not found, return null
    }
}


