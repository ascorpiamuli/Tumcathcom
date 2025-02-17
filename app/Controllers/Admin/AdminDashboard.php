<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Controllers\Dashboard;

class AdminDashboard extends Dashboard
{
    public function __construct()
    {
        parent::__construct(); // ✅ Load parent constructor
    }

    public function index()
    {
        $session = session();
        $admin_id = $session->get('admin_id');
        
        if (!$admin_id) {
            return redirect()->to('auth/admin/login');
        }
    
        $data = $this->getCommonData('Admin Dashboard');
    
        // Check if getCommonData() returned a redirect response
        if ($data instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $data;
        }

        if ($data['admindata']['suspended'] == 1) {
            session()->setFlashdata('error', 'Account Suspended. Contact the Administrator.');
            return redirect()->to('auth/admin/login');
        }
        // Check if the announcement has already been fetched in this session
        if (!$session->get('latest_announcement')) {
            // Fetch the latest announcement and store it in the session
            $this->getLatestAnnouncement();
            $session->set('latest_announcement', true); // Mark it as fetched
        }
        
    
        return view('admin/dashboard', $data);
    }
    public function adminAnnouncements()
    {
        $session = session();
        $adminId = $session->get('admin_id');
    
        // Handle POST request (Announcement creation)
        if ($this->request->getMethod() == 'POST') {
            $announcementTitle = $this->request->getPost('announcement_title');
            $announcementContent = $this->request->getPost('announcement_content');
            
            // Check if the fields are empty
            if (!$announcementTitle || !$announcementContent) {
                $session->setFlashdata('error', 'All fields are required');
                return redirect()->back()->withInput();
            }
            
            // Check if content word count is more than 150 words
            if (str_word_count($announcementContent) > 150) {
                $session->setFlashdata('error', 'Content must be less than 150 words');
                return redirect()->back()->withInput();
            }
    
            // Check if content word count is less than 10 words
            if (str_word_count($announcementContent) < 10) {
                $session->setFlashdata('error', 'Content must be greater than 10 words');
                return redirect()->back()->withInput();
            }
    
            // Prepare the data for insertion
            $announcementData = [
                'admin_id' => $adminId,
                'title' => $announcementTitle,
                'announcement' => $announcementContent,
                'created_at' => date('Y-m-d H:i:s'), // Current time for created_at
                'updated_at' => date('Y-m-d H:i:s')  // Current time for updated_at
            ];
            
            // Insert data into the database
            if ($this->announcementsModel->insert($announcementData)) {
                $session->setFlashdata('success', 'Announcement posted successfully!');
            } else {
                $session->setFlashdata('error', 'There was a problem saving your announcement.');
            }
    
            return redirect()->to('/admin/dashboard');
        }
    }
 
    public function approval_pending()
    {
        return view('/approval-pending');
    }

}
