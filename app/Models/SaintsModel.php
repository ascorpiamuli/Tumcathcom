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
    public function getSaintData($family){
        // Fetch the first matching record based on the saint name (title)
        $saint = $this->where('title', $family)->first();

        if ($saint) {
            return $saint; // Return the full saint data as an array
        }

        return null; // Return null if no saint is found
        }

}
