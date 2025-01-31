<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Database\BaseBuilder;
use App\Models\AssetsModel;

class APIController extends BaseController
{
    protected $assetsModel;
    public function __construct()
    {
        // Load the AssetsModel
        $this->assetsModel = new AssetsModel();  // Note the corrected property name
    }
    
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
    public function getAssetsbyId($booking_id)
    {
        // Log the incoming booking ID
        log_message('debug', 'Fetching assets for Booking ID: ' . $booking_id);
    
        // Fetch the assets from the database using the booking_id

       
        $assets = $this->assetsModel->getAssetsbyId($booking_id);
    
        // Check if assets are found
        if ($assets) {
            // Log success and the number of assets found
            log_message('debug', 'Assets found for Booking ID: ' . $booking_id . '. Total assets: ' . count($assets));
    
            return $this->response->setJSON([
                'success' => true,
                'assets' => $assets
            ]);
        } else {
            // Log that no assets were found for the booking
            log_message('debug', 'No assets found for Booking ID: ' . $booking_id);
    
            return $this->response->setJSON([
                'success' => false,
                'message' => 'No assets found for this booking.'
            ]);
        }
    }
    public function showProfileImage($filename)
    {
        // Log the incoming request with the filename
        log_message('info', 'Request received for profile image: ' . $filename);

        // Define the path to the profile images folder
        $filePath = WRITEPATH . 'uploads/profile_images/' . $filename;

        // Log the file path being checked
        log_message('debug', 'Checking if file exists at: ' . $filePath);

        // Check if the file exists
        if (file_exists($filePath)) {
            // Log success when the file is found
            log_message('info', 'File found: ' . $filePath);

            // Return the image file as a response
            return $this->response->download($filePath, null, true);
        } else {
            // Log the error if the file is not found
            log_message('error', 'File not found: ' . $filePath);

            // Handle the error if the file is not found
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Image not found");
        }
    }
    

    
    
    

}
