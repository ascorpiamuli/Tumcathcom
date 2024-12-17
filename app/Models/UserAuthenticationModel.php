<?php

namespace App\Models;

use CodeIgniter\Model;

class UserAuthenticationModel extends Model
{
    protected $table = 'user_authentication';
    protected $primaryKey = 'id';  // Changed primary key to 'user_id'
    protected $allowedFields = ['user_id', 'username','email','phone_number', 'password','profile_completed'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
