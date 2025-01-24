<?php

namespace App\Controllers;

use App\Models\UserProfileModel;
use App\Models\SaintsModel;
use App\Models\PrayerModel;
use App\Models\CatholicCalendarModel;
use App\Models\RosaryModel;
use App\Models\UserAuthenticationModel;
use App\Models\LiturgicalClassesModel;
use App\Models\LiturgicalServersModel;
use App\Models\LiturgicalDancersModel;
use App\Models\LiturgicalCatechistModel;
use App\Models\SemesterRegistrationModel;
use App\Models\AssetsModel;
// Handle profile image upload
use CodeIgniter\Images\Image;

class Dashboard extends FormsImplementor
{
    //Data Members(PROTECTED!!)
    protected $userProfileModel;
    protected $saintsModel;
    protected $userAuthModel;
    protected $prayerModel;
    protected $rosaryModel;
    protected $CatholicCalendarModel;
    protected $liturgicalClassesModel;
    protected $liturgicalDancersModel;
    protected $semesterRegistrationModel;
    protected $liturgicalCatechistModel;
    protected $liturgicalServersModel;
    protected $assetsModel;

    public function __construct()
    {
        // Initialize the models
        $this->userAuthModel= new UserAuthenticationModel();
        $this->assetsModel=new AssetsModel();
        $this->semesterRegistrationModel=new SemesterRegistrationModel();
        $this->userProfileModel = new UserProfileModel();
        $this->saintsModel = new SaintsModel();
        $this->prayerModel = new PrayerModel();
        $this->rosaryModel=new RosaryModel();
        $this->liturgicalClassesModel=new LiturgicalClassesModel();
        $this->liturgicalDancersModel=new liturgicalDancersModel();
        $this->liturgicalCatechistModel=new liturgicalCatechistModel();
        $this->liturgicalServersModel=new liturgicalServersModel();
        
        // Load CatholicCalendarModel
        $this->CatholicCalendarModel = new CatholicCalendarModel();
    }
    public function index()
    {
        $session = session();
        $user_id = $session->get('user_id');
        if (!$user_id) {
            return redirect()->to('auth/login');
        }
        // Get common data
        $data = $this->getCommonData('Dashboard');
        // Pass data to the dashboard view
        return view('tabs/dashboard', $data);
    }
    
    

    public function family_jumuia()
    {
        // Get common data
        $data = $this->getCommonData('Families');

        // Extract the family name (saint name) from the common data
        $family = $data['family']; // Assuming 'family' is part of the common data

        // Fetch the saint's data based on the family (saint name)
        $saintData = $this->saintsModel->getSaintData($family);

        // Add the saint's data to the view data
        $data['saintData'] = $saintData;

        // Pass common data and saint data to the family_jumuia view
        return view('tabs/family_jumuia', $data);
    }


    public function semester_registration()
    {
        // Get common data
        $data = $this->getCommonData('Semester Registration');
    
        // Log when the form is accessed (GET method)
        log_message('info', 'Semester registration form accessed.');
        if ($this->request->getMethod() == 'POST') {
            $this->submitRegistrationData();
            // Set flash data for success
            $session = session();
            $session->setFlashdata('success', 'Transaction initiated successfully. STK Push sent.');
            return redirect()->to('tabs/semester-registration');
        }
        // Pass common data directly to the semester_registration view
        return view('tabs/semester_registration', $data);
    }
    public function prayers_novena()
    {
        // Get common data
        $data = $this->getCommonData('Prayers & Novenas');

        // Pass common data directly to the prayers_novena view
        return view('tabs/prayers_novena', $data);
    }
    public function assets() {
        // Get common data (optional for your view rendering)
        $data = $this->getCommonData('Assets Management');

        // Initialize logger (optional for logging actions)
        $logger = service('logger');
        $session=session();

        if ($this->request->getMethod() === 'POST') {
            // Check if the request contains the assets data
            $assetsData = json_decode($this->request->getPost('assetsData'), true);
            if (!$assetsData) {
                // Log error if data is missing
                $logger->error('Missing assets data in POST request.');
                session()->setFlashdata('error', 'Please Fill all the Required Asset Data and Try again.');
                return redirect()->back()->withInput();
            }

            $this->submitAssetData($assetsData,$logger);
            return redirect()->to('/tabs/assets');
        }

        // Return the view with common data (optional for your view rendering)
        return view('/tabs/assets', $data);
    }

    

    public function liturgical_classes()
    {
        $session = session();
        $registrationType = $this->request->getGet('registration');
        //catechism classes
        if ($registrationType == 'step1' && $this->request->getMethod() == 'POST') {
           $this->submitStep1FormData($registrationType,$session);
        }    
        //confirmation classes
        if ($registrationType == 'step2' && $this->request->getMethod() == 'POST') { 
            $this->submitStep2FormData($registrationType,$session);       
        }
        //altar servers registration
        if ($registrationType == 'step3' && $this->request->getMethod() == 'POST') {
            $this->submitStep3FormData($registrationType,$session);
        }
        //liturgical dancers registration
        if ($registrationType == 'step4' && $this->request->getMethod() == 'POST') {
            $this->submitStep4FormData($registrationType,$session);
        }
        $data = $this->getCommonData('Liturgical Classes');
        return view('tabs/liturgical_classes', $data);
    }
    public function treasury_report()
    {
        // Get common data
        $data = $this->getCommonData('Treasury');

        // Pass common data directly to the treasury_report view
        return view('tabs/treasury_report', $data);
    }
    public function prayers()
    {
        log_message('info', 'Prayers method started.');
        
        // Step 1: Fetch common data
        log_message('info', 'Fetching common data for "Prayers".');
        $data = $this->getCommonData('Prayers');
        return view('tabs/prayers', $data);
    }
    public function choir()
    {
        $data = $this->getCommonData('Choir');
        return view('tabs/choir', $data);
    }
    public function profile()
    {
        $data = $this->getCommonData('My Profile');
        $validation = \Config\Services::validation();
        log_message('info', 'Profile update process initiated.');
    
        if ($this->request->getMethod() === 'POST') {
            log_message('info', 'POST request received for profile update.');
            log_message('debug', 'Received POST data: ' . json_encode($this->request->getPost()));
    
            $rules = [
                'fname'             => 'min_length[3]',
                'lname'             => 'min_length[3]',
                'email'             => 'valid_email',
                'phone'             => 'numeric|regex_match[/^[71]\d{8}$/]', // Starts with 7 or 1 and is 9 digits in total
                'yearofstudy'       => 'required|numeric|min_length[1]|max_length[2]|less_than[7]',
                'password'          => 'permit_empty|min_length[6]',
                'confirm_password'  => 'matches[password]',
            ];
            
    
            if (!$this->validate($rules)) {
                // Get the validation errors
                $validationErrors = $this->validator->getErrors();
                
                // Set the errors in the session flashdata
                session()->setFlashdata('error', json_encode($validationErrors));
                
                // Redirect to the same page with the validation errors
                return redirect()->to(current_url())->withInput(); // withInput() keeps the old input data
            }
            
            
    


            $profileImageName = $this->request->getFile('profile_image');
            $newProfileImage = null;
            
            if ($profileImageName && $profileImageName->isValid() && !$profileImageName->hasMoved()) {
                $newProfileImage = $profileImageName->getRandomName();
            
                // Resize the image to 160x160
                $image = \Config\Services::image()
                    ->withFile($profileImageName)
                    ->resize(160, 160, true)  // Resize and crop to 160x160
                    ->save(WRITEPATH . 'uploads/profile_images/' . $newProfileImage);
            
                log_message('info', 'Profile image uploaded and resized: ' . $newProfileImage);
            } else {
                $newProfileImage = $this->request->getPost('current_profile_image');
                log_message('info', 'Using existing profile image: ' . $newProfileImage);
            }
            
    
            // Prepare data for updating
            $authData = [
                'email'        => $this->request->getPost('email'),
                'phone_number' => $this->request->getPost('phone'),
            ];
            if ($this->request->getPost('password')) {
                $authData['password'] = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);
                log_message('debug', 'Password included for update.');
            }
    
            $profileData = [
                'first_name'         => $this->request->getPost('fname'),
                'last_name'         => $this->request->getPost('lname'),
                'year_of_study'       => $this->request->getPost('yearofstudy'),
                'registration_number' => $this->request->getPost('registration_number'),
                'dob'                 => $this->request->getPost('dob'),
                'family'              => $this->request->getPost('family'),
                'profile_image'       => $newProfileImage,
            ];
    
            log_message('debug', 'Prepared authData: ' . json_encode($authData));
            log_message('debug', 'Prepared profileData: ' . json_encode($profileData));
    
            // Database transaction
            $db = \Config\Database::connect();
            $db->transStart();
    
            try {
                $userId = session()->get('user_id');
                log_message('info', 'Processing updates for user ID: ' . $userId);
    
                if (!empty($authData)) {
                    $this->userAuthModel->update($userId, $authData);
                    log_message('info', 'user_auth updated successfully.');
                }
    
                $this->userProfileModel->update($userId, $profileData);
                log_message('info', 'user_profiles updated successfully.');
    
                $db->transComplete();
    
                if ($db->transStatus() === false) {
                    throw new \Exception('Transaction failed.');
                }
    
                session()->setFlashdata('success', 'Profile updated successfully!');
                log_message('info', 'Profile update transaction committed successfully.');
                return redirect()->to('/tabs/profile');
            } catch (\Exception $e) {
                $db->transRollback();
                log_message('error', 'Error during profile update: ' . $e->getMessage());
                log_message('error', 'Stack trace: ' . $e->getTraceAsString());
    
                session()->setFlashdata('error', 'There was an error updating your profile.');
                return redirect()->to('/tabs/profile');
            }
        }
    
        log_message('info', 'Loading profile view.');
        return view('tabs/profile', $data);
    }
    
    
    


    public function readings()
    {
        // Log the start of the method
        log_message('debug', 'Entered readings method.');

        // Get common data
        $data = $this->getCommonData('Readings');
        log_message('debug', 'Fetched common data.');

        // Fetch the date from the GET request
        $date = $this->request->getGet('date'); // date is passed as 'date' in the GET request
        log_message('debug', 'Received GET date: ' . ($date ? $date : 'No date provided'));

        // Validate the date
        if (!$date) {
            log_message('debug', 'No date provided, defaulting to today\'s date: ' . date('Y-m-d'));
            $date = date('Y-m-d'); // Default to today's date
        }

        // Fetch readings for the given date
        log_message('debug', 'Fetching readings for date: ' . $date);
        $serviceRequest = new \App\Libraries\getServiceRequest(\Config\Services::cache());
        $readings = $serviceRequest->fetchReadings($date);
        $dayscalendar=$this->CatholicCalendarModel->fetchCatholicDays($date);
        // Log the number of readings fetched
        if ($readings) {
            log_message('debug', 'Fetched ' . count($readings) . ' readings for the date: ' . $date);

        } else {
            session()->setFlashdata('info', 'Please Connect to the Internet to Fetch Readings.');
        }

        // Add readings and the date to the data array
        $data['readings'] = $readings;
        $data['dayscalendar']=$dayscalendar;
        $data['selected_date'] = $date;

        // Log the data being passed to the view
        log_message('debug', 'Passing data to view: ' . json_encode(['readings' => count($readings), 'selected_date' => $date]));
        // Pass the data to the view
        return view('tabs/readings', $data);
    }

    public function events()
    {
        $data = $this->getCommonData('Events');
        return view('tabs/events', $data);
    }

    public function settings()
    {
        $data = $this->getCommonData('Settings');
        return view('tabs/settings', $data);
    }

    public function help()
    {
        $data = $this->getCommonData('Help');
        return view('tabs/help', $data);
    }

    public function suggestion()
    {
        $data = $this->getCommonData('Suggestions');
        return view('tabs/suggestion', $data);
    }

    public function welfare()
    {
        $data = $this->getCommonData('Welfare');
        return view('tabs/welfare', $data);
    }
}
