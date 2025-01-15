<?php

namespace App\Models;

use CodeIgniter\Model;

class RosaryModel extends Model
{
    protected $table            = 'mysteries_of_the_rosary';
    protected $primaryKey       = 'id';
    protected $useTimestamps = true;
    public function getMysteriesByDay($matchingContent)
    {
        // Use getResultArray() for multiple rows
        $mystery = $this->where('day', $matchingContent)->findAll();

        // Return mysteries as an array or empty array
        return $mystery;
    }

}
