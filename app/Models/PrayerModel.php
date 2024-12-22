<?php

namespace App\Models;

use CodeIgniter\Model;

class PrayerModel extends Model
{
    protected $table      = 'prayers';
    protected $primaryKey = 'id';
    
    protected $allowedFields = ['title', 'content'];
    protected $useTimestamps = true;
    // Method to fetch a random prayer
    public function getRandomPrayer()
    {
        $randomId = rand(1, 557);  // Randomly choose an ID between 1 and 558
        return $this->find($randomId);  // Fetch the prayer by the randomly chosen ID
    }
}
