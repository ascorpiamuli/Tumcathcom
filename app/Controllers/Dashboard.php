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

class Dashboard extends BaseController
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
   // protected $liturgicalCatechistModel;
    protected $liturgicalServersModel;

    public function __construct()
    {
        // Initialize the models
        $this->userAuthModel= new UserAuthenticationModel();
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
            $phoneNumber = $this->request->getPost('payphone');
            $amount = $this->request->getPost('payamount');    
            // Validate phone number and amount
            $isValidPhoneNumber = preg_match('/^2547\d{8}$/', $phoneNumber) || preg_match('/^07\d{8}$/', $phoneNumber);
            $isValidAmount = $amount >= 50;
            if (!$isValidAmount) {
                session()->setFlashdata('info', 'Amount Should not be less than 50 Shillings');
                return redirect()->back()->withInput();
            }
            // Check if phone number starts with '7' and has 9 digits
            if (preg_match('/^7\d{8}$/', $phoneNumber)) {
                $phoneNumber = '254' . $phoneNumber;
            } elseif (!preg_match('/^2547\d{8}$/', $phoneNumber) && !preg_match('/^07\d{8}$/', $phoneNumber)) {
                // If phone number is invalid, set flashdata with error
                session()->setFlashdata('error', 'Invalid phone number. Please enter a valid phone Number ');
                return redirect()->back()->withInput();
            }
    
            // Proceed with the M-Pesa transaction
            try {
                $mpesaInit = new \App\Libraries\Mpesa;
                $mpesaInit->lipa_na_mpesa($phoneNumber, $amount);
            
                // Set flash data for success
                $session = session();
                $session->setFlashdata('success', 'Transaction initiated successfully.STK Push Sent');
            } catch (\Exception $e) {
                // Log any errors that occur during the transaction
                log_message('error', 'Error initiating M-Pesa transaction: ' . $e->getMessage());
                $session = session();
                $session->setFlashdata('error', 'There was an error initiating the M-Pesa transaction.');
            }
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

    public function assets_report()
    {
        // Get common data
        $data = $this->getCommonData('Assets Report');

        // Pass common data directly to the assets_report view
        return view('tabs/assets_report', $data);
    }

    public function liturgical_classes()
    {
        $session = session();
        log_message('debug', 'Liturgical classes method called');
        
        $registrationType = $this->request->getGet('registration');
        log_message('debug', 'Registration Type: ' . $registrationType);
        if ($registrationType == 'step1' && $this->request->getMethod() == 'POST') {
    
            // Validation rules with custom error messages
            $validationRules = [
                'yourname' => 'required',
                'yourphone' => 'required|numeric|min_length[9]|max_length[9]|regex_match[/^7\d{8}$/]',
                'guardianname' => 'required',
                'guardianphone' => 'required|numeric|min_length[9]|max_length[9]|regex_match[/^7\d{8}$/]',
                'gender' => 'required',
                'diocese' => 'required',
                'parish' => 'required',
                'progression' => 'required',
                'family' => 'required',
                'semesterperiod' => 'required',
            ];
    
            // Custom error messages
            $errorMessages = [
                'yourname' => 'Please enter your full name.',
                'yourphone' => [
                    'required' => 'Your phone number is required.',
                    'numeric' => 'Your phone number must contain only digits.',
                    'min_length' => 'Your phone number must be 9 digits long.',
                    'max_length' => 'Your phone number must be exactly 9 digits long.',
                    'regex_match' => 'Your phone number must start with 7 and contain 9 digits.'
                ],
                'guardianname' => 'Please enter your guardian\'s name.',
                'guardianphone' => [
                    'required' => 'Your guardian\'s phone number is required.',
                    'numeric' => 'Guardian\'s phone number must contain only digits.',
                    'min_length' => 'Guardian\'s phone number must be 9 digits long.',
                    'max_length' => 'Guardian\'s phone number must be exactly 9 digits long.',
                    'regex_match' => 'Guardian\'s phone number must start with 7 and contain 9 digits.'
                ],
                'gender' => 'Please select your gender.',
                'diocese' => 'Please select your diocese.',
                'parish' => 'Please select your parish.',
                'progression' => 'Please select your progression.',
                'family' => 'Please select your family status.',
                'semesterperiod' => 'Please specify your semester period.',
            ];
    
            // Run validation with custom error messages
            if (!$this->validate($validationRules, $errorMessages)) {
                $session->setFlashdata('errors', $this->validator->getErrors());
                return redirect()->back()->withInput();
            }
    
            // Custom validation: Ensure phone numbers don't match
            $yourphone = $this->request->getPost('yourphone');
            $guardianphone = $this->request->getPost('guardianphone');
            if ($yourphone === $guardianphone) {
                $session->setFlashdata('error', 'Your phone number and guardian\'s phone number should not match.');
                return redirect()->back()->withInput();
            }
    
            // Initialize form data
            $formData = [
                'name' => $this->request->getPost('yourname'),
                'phone' => $yourphone,
                'guardian_name' => $this->request->getPost('guardianname'),
                'guardian_phone' => $guardianphone,
                'gender' => $this->request->getPost('gender'),
                'home_diocese' => $this->request->getPost('diocese'),
                'home_parish' => $this->request->getPost('parish'),
                'academic_progression_status' => $this->request->getPost('progression'),
                'family_jumuia' => $this->request->getPost('family'),
                'semester_period' => $this->request->getPost('semesterperiod'),
                'created_at' => date('Y-m-d H:i:s'), // Current timestamp
                'updated_at' => date('Y-m-d H:i:s'), // Current timestamp
            ];
            if ($this->liturgicalCatechistModel->saveData($formData)) {
                $session->setFlashdata('success', 'Registration successful! Await approval by the Liturgical Coordinator.');
            } else {
                $session->setFlashdata('error', 'Failed to save registration details. Please try again.');
            }
            log_message('info', 'Form submitted: ' . json_encode($formData));
        }
        
        if ($registrationType == 'step2' && $this->request->getMethod() == 'POST') {
    
            // Validation rules with custom error messages
            $validationRules = [
                'yourname' => 'required',
                'yourphone' => 'required|numeric|min_length[9]|max_length[9]|regex_match[/^7\d{8}$/]',
                'guardianname' => 'required',
                'guardianphone' => 'required|numeric|min_length[9]|max_length[9]|regex_match[/^7\d{8}$/]',
                'baptismalname' => 'required',
                'gender' => 'required',
                'diocese' => 'required',
                'parish' => 'required',
                'progression' => 'required',
                'family' => 'required',
                'semesterperiod' => 'required',
                'baptismal_certificate' => 'uploaded[baptismal_certificate]|max_size[baptismal_certificate,1024]|ext_in[baptismal_certificate,pdf]',
            ];
    
            // Custom error messages
            $errorMessages = [
                'yourname' => 'Please enter your full name.',
                'yourphone' => [
                    'required' => 'Your phone number is required.',
                    'numeric' => 'Your phone number must contain only digits.',
                    'min_length' => 'Your phone number must be 9 digits long.',
                    'max_length' => 'Your phone number must be exactly 9 digits long.',
                    'regex_match' => 'Your phone number must start with 7 and contain 9 digits.'
                ],
                'guardianname' => 'Please enter your guardian\'s name.',
                'guardianphone' => [
                    'required' => 'Your guardian\'s phone number is required.',
                    'numeric' => 'Guardian\'s phone number must contain only digits.',
                    'min_length' => 'Guardian\'s phone number must be 9 digits long.',
                    'max_length' => 'Guardian\'s phone number must be exactly 9 digits long.',
                    'regex_match' => 'Guardian\'s phone number must start with 7 and contain 9 digits.'
                ],
                'baptismalname' => 'Please enter your baptismal name.',
                'gender' => 'Please select your gender.',
                'diocese' => 'Please select your diocese.',
                'parish' => 'Please select your parish.',
                'progression' => 'Please select your progression.',
                'family' => 'Please select your family status.',
                'semesterperiod' => 'Please specify your semester period.',
                'baptismal_certificate' => [
                    'uploaded' => 'Please upload a baptismal certificate.',
                    'max_size' => 'The uploaded file is too large. Maximum size is 1MB.',
                    'ext_in' => 'The uploaded file must be a PDF.'
                ]
            ];
    
            // Run validation with custom error messages
            if (!$this->validate($validationRules, $errorMessages)) {
                $session->setFlashdata('errors', $this->validator->getErrors());
                return redirect()->back()->withInput();
            }
    
            // Custom validation: Ensure phone numbers don't match
            $yourphone = $this->request->getPost('yourphone');
            $guardianphone = $this->request->getPost('guardianphone');
            if ($yourphone === $guardianphone) {
                $session->setFlashdata('error', 'Your phone number and guardian\'s phone number should not match.');
                return redirect()->back()->withInput();
            }
    
            // Initialize form data
            $formData = [
                'name' => $this->request->getPost('yourname'),
                'phone' => $yourphone,
                'guardian_name' => $this->request->getPost('guardianname'),
                'guardian_phone' => $guardianphone,
                'baptismal_name' => $this->request->getPost('baptismalname'),
                'gender' => $this->request->getPost('gender'),
                'home_diocese' => $this->request->getPost('diocese'),
                'home_parish' => $this->request->getPost('parish'),
                'academic_progression_status' => $this->request->getPost('progression'),
                'family_jumuia' => $this->request->getPost('family'),
                'semester_period' => $this->request->getPost('semesterperiod'),
                'baptismal_certificate' => '', // Will be updated if upload is successful
                'created_at' => date('Y-m-d H:i:s'), // Current timestamp
                'updated_at' => date('Y-m-d H:i:s'), // Current timestamp
            ];
            
    
            // Handle file upload
            $file = $this->request->getFile('baptismal_certificate');
            try {
                if ($file->isValid() && !$file->hasMoved()) {
                    $uploadPath = WRITEPATH . 'uploads/';
                    if (!is_dir($uploadPath)) {
                        mkdir($uploadPath, 0755, true);
                    }
                    $file->move($uploadPath);
                    $formData['baptismal_certificate'] = $file->getName();
                }
            } catch (\Exception $e) {
                log_message('error', 'File upload failed: ' . $e->getMessage());
                $session->setFlashdata('error', 'File upload failed. Please try again.');
                return redirect()->back()->withInput();
            }
            if ($this->liturgicalClassesModel->saveData($formData)) {
                $session->setFlashdata('success', 'Registration successful! Await approval by the Liturgical Coordinator.');
            } else {
                $session->setFlashdata('error', 'Failed to save registration details. Please try again.');
            }
    
            log_message('info', 'Form submitted: ' . json_encode($formData));
        }
        if ($registrationType == 'step4' && $this->request->getMethod() == 'POST') {
    
            // Validation rules with custom error messages
            $validationRules = [
                'name' => 'required',
                'phone' => 'required|numeric|min_length[9]|max_length[9]|regex_match[/^7\d{8}$/]',
                'gender' => 'required',
                'progression' => 'required',
                'family' => 'required',
                'semesterperiod' => 'required',
            ];
    
            // Custom error messages
            $errorMessages = [
                'name' => 'Please enter your full name.',
                'phone' => [
                    'required' => 'Your phone number is required.',
                    'numeric' => 'Your phone number must contain only digits.',
                    'min_length' => 'Your phone number must be 9 digits long.',
                    'max_length' => 'Your phone number must be exactly 9 digits long.',
                    'regex_match' => 'Your phone number must start with 7 and contain 9 digits.'
                ],
                'gender' => 'Please select your gender.',
                'progression' => 'Please select your progression.',
                'family' => 'Please select your family status.',
                'semesterperiod' => 'Please specify your semester period.',
            ];
    
            // Run validation with custom error messages
            if (!$this->validate($validationRules, $errorMessages)) {
                $session->setFlashdata('errors', $this->validator->getErrors());
                return redirect()->back()->withInput();
            }
    
            // Initialize form data
            $formData = [
                'name' => $this->request->getPost('name'),
                'phone' => $this->request->getPost('phone'),
                'gender' => $this->request->getPost('gender'),
                'academic_progression_status' => $this->request->getPost('progression'),
                'family_jumuia' => $this->request->getPost('family'),
                'semester_period' => $this->request->getPost('semesterperiod'),
                'created_at' => date('Y-m-d H:i:s'), // Current timestamp
                'updated_at' => date('Y-m-d H:i:s'), // Current timestamp
            ];
    
            if ($this->liturgicalDancersModel->saveData($formData)) {
                $session->setFlashdata('success', 'Registration successful! Await approval by the Liturgical Coordinator.');
            } else {
                $session->setFlashdata('error', 'Failed to save registration details. Please try again.');
            }
    
            log_message('info', 'Form submitted: ' . json_encode($formData));
        }
        if ($registrationType == 'step3' && $this->request->getMethod() == 'POST') {
    
            // Validation rules with custom error messages
            $validationRules = [
                'name' => 'required',
                'phone' => 'required|numeric|min_length[9]|max_length[9]|regex_match[/^7\d{8}$/]',
                'gender' => 'required',
                'progression' => 'required',
                'family' => 'required',
                'semesterperiod' => 'required',
            ];
    
            // Custom error messages
            $errorMessages = [
                'name' => 'Please enter your full name.',
                'phone' => [
                    'required' => 'Your phone number is required.',
                    'numeric' => 'Your phone number must contain only digits.',
                    'min_length' => 'Your phone number must be 9 digits long.',
                    'max_length' => 'Your phone number must be exactly 9 digits long.',
                    'regex_match' => 'Your phone number must start with 7 and contain 9 digits.'
                ],
                'gender' => 'Please select your gender.',
                'progression' => 'Please select your progression.',
                'family' => 'Please select your family status.',
                'semesterperiod' => 'Please specify your semester period.',
            ];
    
            // Run validation with custom error messages
            if (!$this->validate($validationRules, $errorMessages)) {
                $session->setFlashdata('errors', $this->validator->getErrors());
                return redirect()->back()->withInput();
            }
    
            // Initialize form data
            $formData = [
                'name' => $this->request->getPost('name'),
                'phone' => $this->request->getPost('phone'),
                'gender' => $this->request->getPost('gender'),
                'academic_progression_status' => $this->request->getPost('progression'),
                'family_jumuia' => $this->request->getPost('family'),
                'semester_period' => $this->request->getPost('semesterperiod'),
                'created_at' => date('Y-m-d H:i:s'), // Current timestamp
                'updated_at' => date('Y-m-d H:i:s'), // Current timestamp
            ];
    
            if ($this->liturgicalServersModel->saveData($formData)) {
                $session->setFlashdata('success', 'Registration successful! Await approval by the Liturgical Coordinator.');
            } else {
                $session->setFlashdata('error', 'Failed to save registration details. Please try again.');
            }
    
            log_message('info', 'Form submitted: ' . json_encode($formData));
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
