<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Database\BaseBuilder;
use App\Models\AssetsModel;
use App\Models\AdminAuthenticationModel;

class APIController extends BaseController
{
    protected $assetsModel;
    protected $adminAuthModel;
    public function __construct()
    {
        // Load the AssetsModel
        $this->assetsModel = new AssetsModel();  // Note the corrected property name
        $this->adminAuthModel=new AdminAuthenticationModel();
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
    public function saveComment()
    {
        // Get JSON input instead of using getPost
        $json = $this->request->getJSON(true);  // 'true' returns the decoded array
    
        // Extract values from the JSON data
        $reportId = $json['report_id'] ?? null;  // Use null coalescing operator to avoid undefined index
        $comment = $json['comment'] ?? null;
    
        // Log the incoming values for debugging
        log_message('info', "Received Report ID: $reportId, Comment: $comment");
    
        // Validate inputs
        if (empty($reportId) || empty($comment)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Missing report ID or comment.']);
        }
    
        // Get the user ID from the session
        $session = \Config\Services::session();
        $userId = $session->get('user_id');
    
        if (!$userId) {
            return $this->response->setJSON(['success' => false, 'message' => 'User not logged in.']);
        }
    
        // Load the model
        $assetReportsModel = new \App\Models\AssetReportsModel();
        
        // Check if the user has already submitted a comment for this report
        if ($assetReportsModel->hasCommented($reportId, $userId)) {
            return $this->response->setJSON(['success' => false, 'message' => 'You have already submitted a comment for this report.']);
        }
    
        // Save the comment using the model method
        if ($assetReportsModel->saveComment($reportId, $userId, $comment)) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to save the comment.']);
        }
    }
    public function approveBooking($bookingId)
    {
        $session = session();
        $loggedInAdminId = $session->get('admin_id');

        // ✅ Fetch logged-in admin details
        $loggedInAdmin = $this->adminAuthModel->where('admin_id', $loggedInAdminId)->first();
        // Fetch bookings with the given booking ID
        $bookings = $this->assetsModel->where('booking_id', $bookingId)->findAll();
    
        if (empty($bookings)) {
            log_message('error', "Booking ID {$bookingId} not found for approval.");
            return $this->response->setJSON(['success' => false, 'message' => 'Booking not found']);
        }
        // ✅ Check if the logged-in admin is the Chairperson
        if (!$loggedInAdmin || $loggedInAdmin['position'] !== 'Assets Manager') {
            return $this->response->setJSON(['success' => false, 'message' => 'Only the Library & Assets Manager can Appprove Bookings.']);
            return redirect()->to('admin/dashboard');
        }
    
        // Update all matching records to "Approved"
        $updated = $this->assetsModel->where('booking_id', $bookingId)->set(['booking_status' => 'Approved'])->update();
    
        if ($updated) {
            log_message('info', "Booking ID {$bookingId} approved by Admin: " . session('username'));
        } else {
            log_message('error', "Failed to approve Booking ID {$bookingId}.");
        }
    
        return $this->response->setJSON(['success' => $updated]);
    }
    
    public function declineBooking($bookingId)
    {
        $session = session();
        $loggedInAdminId = $session->get('admin_id');

        // ✅ Fetch logged-in admin details
        $loggedInAdmin = $this->adminAuthModel->where('admin_id', $loggedInAdminId)->first();
        // Fetch bookings with the given booking ID
        $bookings = $this->assetsModel->where('booking_id', $bookingId)->findAll();
    
        if (empty($bookings)) {
            log_message('error', "Booking ID {$bookingId} not found for approval.");
            return $this->response->setJSON(['success' => false, 'message' => 'Booking not found']);
        }
        // ✅ Check if the logged-in admin is the Chairperson
        if (!$loggedInAdmin || $loggedInAdmin['position'] !== 'Assets Manager') {
            return $this->response->setJSON(['success' => false, 'message' => 'Only the Library & Assets Manager can Decline Bookings.']);
            return redirect()->to('admin/dashboard');
        }
    
        // Update all matching records to "Declined"
        $updated = $this->assetsModel->where('booking_id', $bookingId)->set(['booking_status' => 'Declined'])->update();
    
        if ($updated) {
            log_message('info', "Booking ID {$bookingId} declined by Admin: " . session('username'));
        } else {
            log_message('error', "Failed to decline Booking ID {$bookingId}.");
        }
    
        return $this->response->setJSON(['success' => $updated]);
    }
    public function approve($adminId)
    {
        $session = session();
        $loggedInAdminId = $session->get('admin_id');

        // ✅ Fetch logged-in admin details
        $loggedInAdmin = $this->adminAuthModel->where('admin_id', $loggedInAdminId)->first();

        // ✅ Check if the user is the Chairperson
        if (!$loggedInAdmin || $loggedInAdmin['position'] !== 'Chairperson') {
            session()->setFlashdata('info', 'Only the Chairperson can approve admins.');
            return redirect()->to('admin/dashboard');
        }

        log_message('debug', 'Received admin ID for approval: ' . $adminId);

        // ✅ Fetch the admin record
        $admin = $this->adminAuthModel->where('admin_id', $adminId)->first();
        if (!$admin) {
            session()->setFlashdata('error', 'Admin not found.');
            return redirect()->to('admin/dashboard');
        }

        // ✅ Update approval status
        $this->adminAuthModel->update($adminId, ['approval' => 1]);

        log_message('debug', 'Admin approved successfully for ID: ' . $adminId);

        session()->setFlashdata('success', 'Admin approved successfully.');
        return redirect()->to('admin/dashboard');
    }

    public function decline($adminId)
    {
        $session = session();
        $loggedInAdminId = $session->get('admin_id');

        // ✅ Fetch logged-in admin details
        $loggedInAdmin = $this->adminAuthModel->where('admin_id', $loggedInAdminId)->first();

        // ✅ Check if the user is the Chairperson
        if (!$loggedInAdmin || $loggedInAdmin['position'] !== 'Chairperson') {
            session()->setFlashdata('info', 'Only the Chairperson can decline admins.');
            return redirect()->to('admin/dashboard');
        }

        // ✅ Fetch the admin record
        $admin = $this->adminAuthModel->where('admin_id', $adminId)->first();
        if (!$admin) {
            session()->setFlashdata('error', 'Admin not found.');
            return redirect()->to('admin/dashboard');
        }

        // ✅ Delete the admin
        $this->adminAuthModel->delete($adminId);

        session()->setFlashdata('success', 'Admin declined successfully.');
        return redirect()->to('admin/dashboard');
    }
    public function suspend($adminId)
    {
        $session = session();
        $loggedInAdminId = $session->get('admin_id');
    
        // ✅ Fetch logged-in admin details
        $loggedInAdmin = $this->adminAuthModel->where('admin_id', $loggedInAdminId)->first();
    
        // ✅ Check if the logged-in admin is the Chairperson
        if (!$loggedInAdmin || $loggedInAdmin['position'] !== 'Chairperson') {
            session()->setFlashdata('info', 'Only the Chairperson can suspend admins.');
            return redirect()->to('admin/dashboard');
        }
    
        // ✅ Prevent an admin from suspending themselves
        if ($loggedInAdminId == $adminId) {
            session()->setFlashdata('info', 'You cannot suspend yourself as the chief administrator.');
            return redirect()->to('admin/dashboard');
        }
    
        // ✅ Update approval status
        $this->adminAuthModel->update($adminId, ['suspended' => 1]);
        session()->setFlashdata('success', 'Admin suspended successfully.');
    
        return redirect()->to('admin/dashboard');
    }
    
    public function reinstate($adminId){
        $session = session();
        $loggedInAdminId = $session->get('admin_id');
        // ✅ Fetch logged-in admin details
        $loggedInAdmin = $this->adminAuthModel->where('admin_id', $loggedInAdminId)->first();

        // ✅ Check if the user is the Chairperson
        if (!$loggedInAdmin || $loggedInAdmin['position'] !== 'Chairperson') {
            session()->setFlashdata('info', 'Only the Chairperson can Re-instate admins/Members.');
            return redirect()->to('admin/dashboard');
        }
        // ✅ Update approval status
        $this->adminAuthModel->update($adminId, ['suspended' => 0]);
        session()->setFlashdata('success', 'Admin Reinstated successfully.');
        return redirect()->to('admin/dashboard');
    }
    
    

}
