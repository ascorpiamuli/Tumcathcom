<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MysteriesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'day'            => 'Monday & Saturday',
                'title'          => 'The Joyful Mysteries',
                'mystery_title'  => 'The Annunciation',
                'mystery_number' => 'First Mystery',
                'mystery_content'=> 'The angel Gabriel appears to Mary.',
                'created_at'     => date('Y-m-d H:i:s'), // Set the current timestamp
                'updated_at'     => date('Y-m-d H:i:s'), // Set the current timestamp
            ],
            // Add more entries as needed
        ];

        // Insert data into the table
        $this->db->table('mysteries_of_the_rosary')->insertBatch($data);
    }
}
