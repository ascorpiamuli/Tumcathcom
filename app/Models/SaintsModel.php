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
    public function getSaintData($family)
    {
        // Fetch the first matching record based on the saint name (title)
        $saint = $this->where('title', $family)->first();
    
        if ($saint) {
            // Decode and clean data by removing square brackets, backslashes, and special characters
            $cleanedSaintData = array_map(function ($value) {
                if (is_string($value)) {
                    $value = trim($value); // Remove extra spaces
                    $value = htmlspecialchars_decode($value); // Decode special characters
                    $value = str_replace(['[', ']', '\\'], '', $value); // Remove square brackets and backslashes
                }
                return $value;
            }, $saint);
    
            // Log the cleaned saint data
            log_message('info', 'Fetched and cleaned saint data: ' . json_encode($cleanedSaintData));
    
            return $cleanedSaintData; // Return the cleaned saint data
        }
    
        // Log a warning if no saint is found
        log_message('warning', 'No saint data found for family: ' . $family);
    
        return null; // Return null if no saint is found
    }
    
    
}


