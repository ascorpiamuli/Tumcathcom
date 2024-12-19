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
        'youtube_links',
        'created_at',
        'updated_at',
    ];

    // Timestamps won't be auto-managed since useTimestamps is not set to true
}
