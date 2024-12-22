<?php

namespace App\Models;

use CodeIgniter\Model;

class SaintsModel extends Model
{
    protected $table = 'saints';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'saint_id',
        'title',
        'feast_day',
        'patron',
        'birth',
        'death',
        'saint_image',
        'paragraphs',
        'youtube_links'
    ];
    public function getSaintDatabySaintName($family)
    {
        $user = $this->select('paragraphs') // Select the 'paragraphs' field
            ->where('title', $family) // Query by the saint name in 'title'
            ->first(); // Get the first matching result
    
        if ($user) {
            return $user['paragraphs']; // Return the paragraphs field
        }
    
        return null; // Return null if no match is found
    }
    

}
