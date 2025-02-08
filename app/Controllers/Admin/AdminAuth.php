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
        $this->adminAuthModel = new AdminAuthenticationModel;
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
            $adminuser = $this->adminAuthModel->select('department_code, password')->where('department_code', $departmentcode)->first();
    
            if ($adminuser && password_verify($password, $adminuser['password'])) {
                // Log successful login
                log_message('info', "User Admin with dept code'{$departmentcode}' logged in successfully. User ID: {$adminuser['admin_id']}");
    
                // Check if admin had a member account before getting to admin
                $userAuth = $this->userAuthModel->where('user_id', $adminuser['admin_id'])->first();
                if (!$userAuth) {
                    // Log if auth data is missing
                    log_message('warning', "Auth Data missing for user ID: {$adminuser['admin_id']}");
    
                    // Redirect to login if auth data is missing
                    session()->setFlashdata('info', 'You need to have Created a Member Account First to get to Admin.');
                    return redirect()->to('/auth/login');
                }
    
                // Generate session token
                $sessionToken = generateSessionToken();
                log_message('info', "Token Generated for user ID: {$adminuser['admin_id']} - Session Token: {$sessionToken}");
    
                // Update the session token in the database
                $updateStatus = $this->adminAuthModel->updateSessionToken($adminuser['admin_id'], $sessionToken);
                if (!$updateStatus) {
                    log_message('error', "Failed to update session token for admin ID: {$adminuser['admin_id']}");
                    session()->setFlashdata('error', 'Failed to log you in. Try again later.');
                    return redirect()->to('/auth/login');
                }
    
                // Set the session with the token
                session()->set('user_id', $adminuser['admin_id']);
                session()->set('session_token', $sessionToken);
    
                // Log the successful session creation
                log_message('info', "Session set for admin ID: {$uadminser['admin_id']} with session token: {$sessionToken}");
    
                // Set flash data and redirect to dashboard
                session()->setFlashdata('success', 'Great Work! Logged in');
                return redirect()->to('/tabs/dashboard');
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
        $data = $this->getCommonData('Admin Register'); // Assuming this returns an array
        if ($this->request->getMethod()=='POST') {
            
        }
    
        return view('auth/admin/register'); // This line is correct
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
