<?php

namespace App\Controllers;
//models
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
use App\Controllers\FormsImplementor;
use App\Models\AssetReportsModel;
use App\Models\AdminAuthenticationModel;
use App\Models\AnnouncementsModel;
use App\Traits\AnnouncementsTrait;

// Handle profile image upload
use CodeIgniter\Images\Image;

class Dashboard extends FormsImplementor
{
    //Data Members(PROTECTED!!)
    protected $announcementsModel;
    protected $userProfileModel;
    protected $adminAuthModel;
    protected $assetReportsModel;
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
    use AnnouncementsTrait;

    public function __construct()
    {
        // Initialize the models
        $this->announcementsModel=new AnnouncementsModel();
        $this->adminAuthModel=new AdminAuthenticationModel();
        $this->userAuthModel= new UserAuthenticationModel();
        $this->assetsModel=new AssetsModel();
        $this->semesterRegistrationModel=new SemesterRegistrationModel();
        $this->userProfileModel = new UserProfileModel();
        $this->saintsModel = new SaintsModel();
        $this->prayerModel = new PrayerModel();
        $this->assetReportsModel=new AssetReportsModel();
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
        
        // Check if the user is logged in
        if (!$user_id) {
            return redirect()->to('auth/login');
        }
    
        // Check if the announcement has already been fetched in this session
        if (!$session->get('latest_announcement')) {
            // Fetch the latest announcement and store it in the session
            $this->getLatestAnnouncement();
            $session->set('latest_announcement', true); // Mark it as fetched
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
        $session = session();
    
        // Check if the request method is POST
        if ($this->request->getMethod() === 'POST') {
            // Check if the request contains the assets data
            $assetsData = json_decode($this->request->getPost('assetsData'), true);
            if (!$assetsData) {
                // Log error if data is missing
                $logger->error('Missing assets data in POST request.');
                session()->setFlashdata('error', 'Please Fill all the Required Asset Data and Try again.');
                return redirect()->back()->withInput();
            }
    
            // Check the timestamp of the last request
            $lastRequestTime = $session->get('lastRequestTime');
            $currentTime = time();
            
            // If the last request was made within the last 10 minutes, set a flash message
            if ($lastRequestTime && ($currentTime - $lastRequestTime) < 600) {  // 600 seconds = 10 minutes
                session()->setFlashdata('info', 'Please wait 10 minutes before submitting again to prevent spamming Bookings.');
                return redirect()->back()->withInput();
            }
    
            // Update the last request time in session
            $session->set('lastRequestTime', $currentTime);
    
            // Submit the asset data
            $this->submitAssetData($assetsData, $logger);
    
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
            $this->submitFormData($registrationType, $session, $this->liturgicalCatechistModel);
        }    
        //confirmation classes
        if ($registrationType == 'step2' && $this->request->getMethod() == 'POST') { 
            $this->submitFormData($registrationType, $session, $this->liturgicalClassesModel);     
        }
        //altar servers registration
        if ($registrationType == 'step3' && $this->request->getMethod() == 'POST') {
            $this->submitFormData($registrationType, $session, $this->liturgicalServersModel);
        }
        //liturgical dancers registration
        if ($registrationType == 'step4' && $this->request->getMethod() == 'POST') {
            $this->submitFormData($registrationType, $session, $this->liturgicalDancersModel);
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
    public function choirRegistration()
    {
        $data = $this->getCommonData('Choir');
        return view('tabs/choir-registration', $data);
    }
    public function profile()
    {
        $data = $this->getCommonData('My Profile');
        $validation = \Config\Services::validation();    
        if ($this->request->getMethod() === 'POST') {
            $session=session();
          if($this->submitProfileData($session)){
            $session->setFlashData('success','Profile Data Updated Successfully.');
            return redirect()->to('/tabs/dashboard');
          }
          //$session->setFlashData('error','Error Updating Profile.');
          return redirect()->to('/tabs/profile');

        }
        return view('tabs/profile', $data);
    }
    
    public function bookingHistory()
    {   
        // Fetch common data, including the user's full name
        $data = $this->getCommonData('Booking History');  
        $userId = $data['userprofile']['user_id'];
        // Fetch all assets booked by the user
        $allassetsdata = $this->assetsModel->where('user_id', $userId)->findAll(); 
        // Add assets count to each booking
        foreach ($allassetsdata as &$booking) {
            $assetsCount = $this->assetsModel->countAssetsForBooking($booking['booking_id']);
            $booking['assets_count'] = $assetsCount !== null ? $assetsCount : 0; // Ensure we set a valid count
        }    
        return view('tabs/booking-history', ['allassetsdata' => $allassetsdata] + $data);
    }
    public function  assets_report()
    {
        // Fetch common data, including the user's full name
        $data = $this->getCommonData('Assets Report');  
        // Fetch all assets booked by the user
        $allreportsdata = $this->assetReportsModel->getAllReports(); 
        // Add assets count to each booking 
        return view('tabs/assets_report', ['allreportsdata' => $allreportsdata] + $data);
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
    public function deleteProfile()
    {
        $userId = session()->get('user_id');  // Assuming the user ID is stored in session
    
        if ($userId) {
            // Start transaction to ensure all related data is deleted
            $db = \Config\Database::connect();
            $db->transStart();  // Start a transaction
    
            // Delete user authentication data
            $this->userAuthModel->delete(['user_id' => $userId]);
    
            // Delete user's profile data 
            $this->userProfileModel->delete(['user_id' => $userId]);
    
            // Check if there are any assets associated with the user
            $assets = $this->assetsModel->where('user_id', $userId)->findAll();
    
            if ($assets) {
                // Delete associated asset data
                $this->assetsModel->delete(['user_id' => $userId]);
                log_message('info', 'Assets associated with user ID ' . $userId . ' have been deleted.');
            } else {
                log_message('info', 'No assets found for user ID ' . $userId . ' to delete.');
            }
    
            // Commit the transaction if everything went well
            $db->transComplete();
    
            if ($db->transStatus() === false) {
                // If any of the delete operations fail, rollback and return error
                return $this->response->setJSON(['success' => false, 'message' => 'Error deleting profile data']);
            }
    
            // If everything is successful, set success message
            session()->setFlashdata('success', 'Profile and associated data deleted successfully!');
    
            // Now destroy the session after the successful deletion
            session()->destroy();  // Destroy the session to log the user out
    
            // Return success response
            return $this->response->setJSON(['success' => true]);
        }
    
        // If no user ID in session, return error response
        return $this->response->setJSON(['success' => false, 'message' => 'User not logged in']);
    }
}

