<?php

namespace App\Controllers;

use App\Models\UserProfileModel;
use App\Models\UserAuthenticationModel;
use App\Models\SaintsModel;
use App\Controllers\BaseController;

class Auth extends BaseController
{
    public $userAuthModel;
    public $userProfileModel;
    public  function __construct(){

        $this->userAuthModel=new UserAuthenticationModel;
        $this->userProfileModel=new UserProfileModel;
    }
     // Authentication and Registration Flow
    public function index()
    {
        // Check if user is already logged in
        if (session()->has('user_id')) {
            return redirect()->to('/auth/dashboard');
        }

        return redirect()->to('/auth/authentication');
    }

    public function authentication()
    {
        if ($this->request->getMethod() == 'POST') {
            $userAuthModel = new UserAuthenticationModel();
    
            // Validation rules
            $validationRules = [
                'username' => 'required|is_unique[user_authentication.username]',
                'email' => 'required|valid_email|is_unique[user_authentication.email]',
                'phone' => 'required|regex_match[/^7[0-9]{8}$/]',
               'password' => 'required|min_length[8]',
               'confirm_password' => 'required|matches[password]', // Ensure confirm password matches
            ];
            // Customizing the error messages for password
            $validationMessages = [
                'password' => [
                    'min_length' => 'Password must contain at least 8 characters long.'
                ],

                'phone' => [
                    'regex_match' => 'The phone number must Start with 7..  (Should be 9 characters long) .'
                ],
                'email'=>[
                    'is_unique'=>'The Email Already Exists in the Database'
                ]
            ];            
    
            // Validate the form input based on the rules
            if (!$this->validate($validationRules, $validationMessages)) {
                // If validation fails, flash errors and return to the form
                session()->setFlashdata('errors', $this->validator->getErrors());
                return redirect()->back()->withInput();
            }
    
            // Rate limiting: Check if user has tried too frequently
            if (session()->has('last_attempt_time') && (time() - session()->get('last_attempt_time') < 180)) {
                session()->setFlashdata('info', 'Please wait for 3 minutes before trying again.');
                return redirect()->back()->withInput();
            }
            // Generate unique user ID
            $userId = generateUserId();

            // If ID generation failed after multiple retries
            if (!$userId) {
                session()->setFlashdata('info', 'Unable to process your request at the moment. Please try again later.');
                return redirect()->back()->withInput();
            }

            // Collect form data
            $data = [
                'user_id' => $userId,
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'phone_number' => $this->request->getPost('phone'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT), // Hash the password
            ];
    
            // Attempt to save user data to the database
            if ($userAuthModel->save($data)) {
                // Set session and flash success message
                session()->set('user_id', $userId);
                session()->setFlashdata('success', 'Authentication details saved successfully!'); // Show success message
                return redirect()->to('/auth/register'); // Redirect after the message is set
            } else {
                // If save fails, flash error message
                session()->setFlashdata('error', 'Failed to save authentication data.');
                return redirect()->back();
            }
        }
    
        // If the form is not submitted, display the authentication page
        return view('auth/login');
    }
    

    public function register()
    {
        $userId = session()->get('user_id');
        if (!$userId) {
            return redirect()->to('/auth/login');
        }
    
        if ($this->request->getMethod() == 'POST') {
            $userProfileModel = new UserProfileModel();
    
            // Validation rules
            $validationRules = [
                'first_name' => 'required',
                'last_name' => 'required',
                'registration_number' => [
                    'rules' => 'required|is_unique[user_profiles.registration_number]|regex_match[/^[A-Z]{4}\/[0-9]{3}[A-Z]\/[0-9]{4}$/]',
                    'errors' => [
                        'regex_match' => 'The Registration Number is not in the correct Format.Should be in format BSIT/111J/2027',
                        'is_unique' => 'The Registration Number already exists.',
                    ],
                ],
                'dob' => 'required|valid_date',
                'year_of_study' => 'required',
                'family' => 'required',
                'course' => 'required',
                'baptized' => 'required|in_list[yes,no]',
                'confirmed' => 'required|in_list[yes,no]',
            ];
    
            if (!$this->validate($validationRules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
    
            $family = $this->request->getPost('family');
            $data = [
                'user_id' => $userId,
                'first_name' => $this->request->getPost('first_name'),
                'last_name' => $this->request->getPost('last_name'),
                'registration_number' => $this->request->getPost('registration_number'),
                'dob' => $this->request->getPost('dob'),
                'year_of_study' => $this->request->getPost('year_of_study'),
                'family_jumuia' => $family,
                'course' => $this->request->getPost('course'),
                'baptized' => $this->request->getPost('baptized') === 'yes' ? true : false,
                'confirmed' => $this->request->getPost('confirmed') === 'yes' ? true : false,
                'created_at' => date('Y-m-d H:i:s'),
            ];
    
            $saintsModel = new SaintsModel();
            $validFamily = $saintsModel->where('title', $family)->first();
    
            if (!$validFamily) {
                session()->setFlashdata('error', 'Please select a valid family name From the Dropdown.');
                return redirect()->to('/tabs/register');
            }
    
            if ($userProfileModel->save($data)) {
                session()->setFlashdata('success', 'Profile details saved successfully!');
                return redirect()->to('/tabs/dashboard');
            } else {
                session()->setFlashdata('error', 'Failed to save Profile data.');
                return redirect()->back();
            }
          log_message('info',json_decode($data));
        }
        return view('tabs/register');
    }
    
    // Login Method
    public function login()
    {
        if ($this->request->getMethod() == 'POST') {
            $email= $this->request->getPost('email');
            $password = $this->request->getPost('password');
          //MVC Architecture Model databases,Views User Frotend and Controller Handles HTTP Requests and passes data to the views.
          //CRUD Operations,use models.
          //LOGICAL OPERATIONS,USE Controllers
          //Authorizations ,use Middleware
          //For UI,use views
            $userAuthModel = new UserAuthenticationModel();
            $user = $userAuthModel->select('user_id, password')->where('email', $email)->first();
    
            if ($user && password_verify($password, $user['password'])) {
                // Log successful login
                log_message('info', "User with email '{$email}' logged in successfully. User ID: {$user['user_id']}");
    
                // Check if user profile exists
                $userProfileModel = new UserProfileModel();
                $userProfile = $userProfileModel->where('user_id', $user['user_id'])->first();
                if (!$userProfile) {
                    // Log if profile data is missing
                    log_message('warning', "Profile missing for user ID: {$user['user_id']}");
    
                    // Redirect to registration if profile data is missing
                    session()->setFlashdata('info', 'Please Complete Your Profile to Continue');
                    return redirect()->to('/auth/register');
                }
    
                // Generate session token
                $sessionToken = generateSessionToken();
                log_message('info', "Token Generated for user ID: {$user['user_id']} - Session Token: {$sessionToken}");
    
                // Update the session token in the database
                $updateStatus = $userAuthModel->updateSessionToken($user['user_id'], $sessionToken);
                if (!$updateStatus) {
                    log_message('error', "Failed to update session token for user ID: {$user['user_id']}");
                    session()->setFlashdata('error', 'Failed to log you in. Try again later.');
                    return redirect()->to('/auth/login');
                }
                session()->set('user_id', $user['user_id']);
                session()->set('user_session_token', $sessionToken);
                
    
                // Log the successful session creation
                log_message('info', "Session set for user ID: {$user['user_id']} with session token: {$sessionToken}");
    
                // Set flash data and redirect to dashboard
                session()->setFlashdata('success', 'Great Work! Logged in');
                return redirect()->to('/tabs/dashboard');
            } else {
                // Log failed login attempt
                log_message('warning', "Failed login attempt for email '{$email}'");
    
                session()->setFlashdata('error', 'Invalid Email or Password.Try Again');
                return redirect()->to('/auth/login');
            }
        }
    
        // Return the login view if the request method is not POST
        return view('auth/login');
    }
    
    
    // Forgot
    public function forgotPassword()
    {

        // Render dashboard view
        return view('auth/forgot_password');
    }
    public function logout()
    {
        // Start session
        $session = session();
    
        // Determine user type and get the correct ID
        if ($session->has('admin_id')) {
            $userId = $session->get('admin_id');
            $userType = 'admin';
            $authModel = new \App\Models\AdminAuthenticationModel(); // Admin model
        } elseif ($session->has('user_id')) {
            $userId = $session->get('user_id');
            $userType = 'user';
            $authModel = new \App\Models\UserAuthenticationModel(); // User model
        } else {
            log_message('error', "Logout attempt failed - No valid session found.");
            return redirect()->to('/auth/login');
        }
    
        // Log logout attempt
        log_message('info', "{$userType} with ID {$userId} is logging out");
    
        // Set a flash message for successful logout
        session()->setFlashdata('success', 'Successfully Logged Out.');
    
        // Remove the session token from the database (Only if user ID exists)
        if (!empty($userId)) { 
            $authModel->where('id', $userId)->set(['session_token' => null])->update();
        } else {
            log_message('error', "Logout attempt failed - {$userType} ID is missing.");
        }
        $session->remove('latest_announcement');
        // Remove session data from the browser session
        $session->remove(['user_id', 'admin_id', 'session_token', 'user_type']);
    
        // Log out event
        log_message('info', "{$userType} with ID {$userId} logged out successfully");
        
    
        // Redirect to the appropriate login page
        return ($userType === 'admin') 
            ? redirect()->to('/auth/admin/login') 
            : redirect()->to('/auth/login');
    }
    
    
}
