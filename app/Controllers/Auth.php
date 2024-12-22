<?php

namespace App\Controllers;

use App\Models\UserProfileModel;
use App\Models\UserAuthenticationModel;
use App\Models\SaintsModel;
use CodeIgniter\Controller;

class Auth extends Controller
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
                'phone' => 'required|regex_match[/^\+?[0-9]{10,15}$/]',
                'password' => 'required|min_length[8]|regex_match[/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/]',
                'confirm_password' => 'required|matches[password]', // Ensure confirm password matches
            ];
    
            // Customizing the error messages for password
            $validationMessages = [
                'password' => [
                    'regex_match' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character (e.g., @$!%*?&).'
                ]
            ];
    
            // Validate the form input based on the rules
            if (!$this->validate($validationRules, $validationMessages)) {
                // If validation fails, flash errors and return to the form
                session()->setFlashdata('errors', $this->validator->getErrors());
                return redirect()->back()->withInput();
            }
    
            // Generate user ID
            $userId = generateUserId();
    
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
                $userProfileModel = new UserProfileModel();
                $userProfile = $userProfileModel->where('user_id', $user['user_id'])->first();
                if (!$userProfile) {
                    // Redirect to registration if profile data is missing
                    session()->setFlashdata('info', 'Please Complete Your Profile to Continue');
                    return redirect()->to('/auth/register');
                }

                // Set session data
                session()->set(['user_id' => $user['user_id']]);
                session()->setFlashdata('success', 'Hooyah! Great Work!Logged in');
                return redirect()->to('/tabs/dashboard');
            } else {
                return redirect()->to('/auth/login')->with('error', 'Invalid Credentials.Try Again');
            }
        }

        return view('auth/login');
    }

    // Dashboard
    public function dashboard()
    {
        // Check if user is logged in
        if (!session()->has('user_id')) {
            return redirect()->to('/auth/login');
        }

        // Render dashboard view
        return view('tabs/dashboard');
    }
    // Logout method
// Logout method
public function logout()
{
    // Set a flash message for successful logout
    session()->setFlashdata('success', 'Noo!! Tutakumiss!! Logged Out.');

    // Remove specific session data
    session()->remove('user_id');

    // Redirect first, then destroy the session in the next request
    return redirect()->to('/auth/login');
}


    
}
