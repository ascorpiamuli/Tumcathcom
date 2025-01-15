<?php

namespace App\Controllers;

use App\Models\UserProfileModel;
use App\Models\UserAuthenticationModel;
use App\Models\SaintsModel;
use App\Controllers\BaseController;

class Auth extends BaseController
{
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
                'phone' => 'required|regex_match[/^[0-9]{10}$/]',
               'password' => 'required|min_length[8]',
               'confirm_password' => 'required|matches[password]', // Ensure confirm password matches
            ];
            // Customizing the error messages for password
            $validationMessages = [
                'password' => [
                    'min_length' => 'Password must contain at least 8 characters long.'
                ],

                'phone' => [
                    'regex_match' => 'The phone number must be 12 digits long and consist of numbers only.'
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
        return view('auth/authentication');
    }
    

    // Registration (Second Step)
    public function register()
    {
        $userId = session()->get('user_id');
        if (!$userId) {
            return redirect()->to('/auth/authentication');
        }

        if ($this->request->getMethod() == 'POST') {
            $userProfileModel = new UserProfileModel();

            // Validation rules
            $validationRules = [
                'first_name' => 'required',
                'last_name' => 'required',
                'registration_number' => 'required|is_unique[user_profiles.registration_number]',
                'dob' => 'required|valid_date',
                'year_of_study' => 'required|numeric',
                'family' => 'required',
                'course' => 'required',
                'baptized' => 'required|in_list[yes,no]',
                'confirmed' => 'required|in_list[yes,no]',
            ];

            if (!$this->validate($validationRules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
            $family=$this->request->getPost('family');

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
            // Query the saints database to check if the family exists
            $validFamily = $saintsModel->where('title', $family)->first();
            // If the family doesn't exist in the database, set an error and redirect back
            if (!$validFamily) {
                // Set an error message and redirect back to the register page
                session()->setFlashdata('error', 'Please select a valid family name From the Dropdown.');
                return redirect()->to('/auth/register');
            }

            if ($userProfileModel->save($data)) {
                //  flash success message
                session()->setFlashdata('success', 'Profile details saved successfully!'); // Show success message
                return redirect()->to('/tabs/dashboard'); // Redirect after the message is set
            } else {
                // If save fails, flash error message
                session()->setFlashdata('error', 'Failed to save Profile data.');
                return redirect()->back();
            }
        }

        return view('auth/register');
    }
    // Login Method
    public function login()
    {
        if ($this->request->getMethod() == 'POST') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
    
            $userAuthModel = new UserAuthenticationModel();
            $user = $userAuthModel->select('user_id, password')->where('username', $username)->first();
    
            if ($user && password_verify($password, $user['password'])) {
                // Log successful login
                log_message('info', "User with username '{$username}' logged in successfully. User ID: {$user['user_id']}");
    
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
    
                // Set the session with the token
                session()->set('user_id', $user['user_id']);
                session()->set('session_token', $sessionToken);
    
                // Log the successful session creation
                log_message('info', "Session set for user ID: {$user['user_id']} with session token: {$sessionToken}");
    
                // Set flash data and redirect to dashboard
                session()->setFlashdata('success', 'Great Work! Logged in');
                return redirect()->to('/tabs/dashboard');
            } else {
                // Log failed login attempt
                log_message('warning', "Failed login attempt for username '{$username}'");
    
                session()->setFlashdata('error', 'Invalid Credentials. Try Again');
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
        // Get the current user's ID and session token
        $userId = session()->get('user_id');
        $sessionToken = session()->get('session_token');
    
        // Log logout attempt
        log_message('info', "User with ID {$userId} is logging out");
    
        // Set a flash message for successful logout
        session()->setFlashdata('success', 'Successfully Logged Out.');
    
        // Remove the session token from the database for the current user
        $userAuthModel = new UserAuthenticationModel();
        $userAuthModel->update($userId, ['session_token' => null]);
    
        // Remove session data from the browser session
        session()->remove('user_id');
        session()->remove('session_token');
    
        // Log out event
        log_message('info', "User with ID {$userId} logged out successfully");
    
        // Redirect to login page
        return redirect()->to('/auth/login');
    }
    
}
