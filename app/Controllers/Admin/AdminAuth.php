<?php

namespace App\Controllers\Admin;

use App\Models\UserProfileModel;
use App\Models\UserAuthenticationModel;
use App\Models\SaintsModel;
use App\Controllers\BaseController;
use App\Controllers\Auth;
use App\Models\AdminAuthenticationModel;

class AdminAuth extends Auth
{
    public $adminAuthModel;   


    public function __construct() {
        parent::__construct(); // Explicitly call the parent constructor
        $this->adminAuthModel = new AdminAuthenticationModel();
    }
     // Authentication and Registration Flow
    public function index()
    {
        // Check if user is already logged in
        if (session()->has('admin_id')) {
            return redirect()->to('/auth/dashboard');
        }

        return redirect()->to('auth/admin/authentication');
    }
    // Login Method
    public function login()
    {
        if ($this->request->getMethod() == 'POST') {
            $departmentcode = $this->request->getPost('deptcode');
            $password = $this->request->getPost('password');
            $adminuser = $this->adminAuthModel
            ->select('admin_id, departmental_id, password')
            ->where('departmental_id', $departmentcode)
            ->first();
        
    
            if ($adminuser && password_verify($password, $adminuser['password'])) {
    
                // Generate session token
                $sessionToken = generateSessionToken();
                // Update the session token in the database
                $updateStatus = $this->adminAuthModel->updateSessionToken($adminuser['admin_id'], $sessionToken);
                if (!$updateStatus) {
                    log_message('error', "Failed to update session token for admin ID: {$adminuser['admin_id']}");
                    session()->setFlashdata('error', 'Failed to log you in. Try again later.');
                    return redirect()->to('/auth/login');
                }
    
                session()->set('admin_id', $adminuser['admin_id']);
                session()->set('admin_session_token', $sessionToken);
    
                // Log the successful session creation
                log_message('info', "Session set for admin ID: {$adminuser['admin_id']} with session token: {$sessionToken}");
    
                // Set flash data and redirect to dashboard
                session()->setFlashdata('success', 'Great Work! Logged in');
                return redirect()->to('/admin/dashboard');
            } else {
                // Log failed login attempt
                log_message('warning', "Failed login attempt for username");
    
                session()->setFlashdata('error', 'Invalid Credentials. Try Again');
                return redirect()->to('/auth/admin/login');
            }
        }
    
        // Return the login view if the request method is not POST
        return view('auth/admin/login');
    }

    public function register()
    {
        
        if ($this->request->getMethod() == 'POST') {
            $position = $this->request->getPost('position');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
    
            // Check if user exists in members table
            $member = $this->userAuthModel->where('email', $email)->first();
    
            if (!$member) {
                session()->setFlashdata('info', 'You must register a member account first.');
                return redirect()->to('/auth/login');
            }
    
            // Generate Admin ID and Departmental ID
            $adminId = $member['user_id'];
            $departmentalId = generate_departmental_id($position);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            // Prepare admin data
            $adminData = [
                'position'       =>$position,
                'admin_id'        => $adminId,
                'departmental_id' => $departmentalId,
                'admin_email'     => $email,
                'password'        => $hashedPassword,
                'session_token'   => generateSessionToken()
            ];
    
            // Save to database
            $this->adminAuthModel->insert($adminData);
    
            session()->setFlashdata('success', 'Registration successful. Welcome!');
            return redirect()->to('/admin/dashboard');
        }
    
        return view('auth/admin/login'); 
    }
    
    
    

    
    
    // Forgot
    public function forgotPassword()
    {

        // Render dashboard view
        return view('auth/admin/forgot_password');
    }
    public function logout()
    {
        // Get the current user's ID and session token
        $userId = session()->get('user_id');
        $sessionToken = session()->get('session_token');
    
        // Log logout attempt
        log_message('info', "User with ID {$userId} is logging out");
    
        // Set a flash message for successful logout
        session()->setFlashdata('success', 'Successfully Logged Out.');
    
        // Remove the session token from the database for the current user
        $this->userAuthModel = new UserAuthenticationModel();
        $this->userAuthModel->update($userId, ['session_token' => null]);
    
        // Remove session data from the browser session
        session()->remove('user_id');
        session()->remove('session_token');
    
        // Log out event
        log_message('info', "User with ID {$userId} logged out successfully");
    
        // Redirect to login page
        return redirect()->to('/auth/admin/login');
    }
    
}
