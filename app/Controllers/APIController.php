<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Database\BaseBuilder;

class APIController extends BaseController
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
    public function getAssets()
    {
        log_message('info', 'Inside getAssets method');  // Initial log to confirm method execution
    
        // Sanitize and validate the input query
        $query = $this->request->getGet('query');
        log_message('debug', 'Query parameter: ' . $query);  // Log the incoming query parameter
        
        $query = trim($query); // Remove leading/trailing spaces
        log_message('debug', 'Trimmed query: ' . $query);  // Log the trimmed query
    
        // Check if query is empty and return an empty result
        if (empty($query)) {
            log_message('info', 'Query is empty. Returning empty result.');
            return $this->response->setJSON([]);
        }
        
        try {
            log_message('info', 'Connecting to the database...');
            // Connect to the database
            $db = \Config\Database::connect();
            $builder = $db->table('assets_available');
            
            log_message('info', 'Querying database for matching assets...');
            // Query the database for matching results including all necessary fields
            $results = $builder->select('category, name, description, asset_condition,availability_status,quantity') // Add other columns you need
                               ->like('name', $query)
                               ->get()
                               ->getResultArray();
            
            log_message('info', 'Number of results found: ' . count($results));  // Log the number of results found
            
            // Return results as JSON response
            return $this->response->setJSON($results);
        } catch (\Exception $e) {
            // Handle any errors that may occur
            log_message('error', 'Error occurred: ' . $e->getMessage());  // Log the error message
            return $this->response->setJSON([
                'error' => 'An error occurred while fetching data.',
                'message' => $e->getMessage()
            ]);
        }
    }
    
    
    

}
