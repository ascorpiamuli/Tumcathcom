<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Database\BaseBuilder;

class JumuiaController extends BaseController
{
    public function getJumuia()
    {
        log_message('info', 'Inside getJumuia method');

        // Sanitize and validate the input query
        $query = $this->request->getGet('query');
        $query = trim($query); // Remove leading/trailing spaces
        // Check if query is empty and return an empty result
        if (empty($query)) {
            return $this->response->setJSON([]);
        }
    
        try {
            // Connect to the database
            $db = \Config\Database::connect();
            $builder = $db->table('saints');
    
            // Query the database for matching results
            $results = $builder->select('title')
                               ->like('title', $query)
                               ->get()
                               ->getResultArray();
    
            // Return results as JSON response
            return $this->response->setJSON($results);
        } catch (\Exception $e) {
            // Handle any errors that may occur
            return $this->response->setJSON([
                'error' => 'An error occurred while fetching data.',
                'message' => $e->getMessage()
            ]);
        }
    }
    

}
