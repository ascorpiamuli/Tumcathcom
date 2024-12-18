<?php

namespace App\Models;

use CodeIgniter\Model;

class PrayerModel extends Model
{
    protected $table      = 'prayers';
    protected $primaryKey = 'id';
    
    protected $allowedFields = ['title', 'content'];
    protected $useTimestamps = true;
}
