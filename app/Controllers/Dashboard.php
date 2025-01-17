<?php

namespace App\Controllers;

use App\Models\UserProfileModel;
use App\Models\SaintsModel;
use App\Models\PrayerModel;
use App\Models\CatholicCalendarModel;
use App\Models\RosaryModel;

class Dashboard extends BaseController
{
    //Data Members(PROTECTED!!)
    protected $userProfileModel;
    protected $saintsModel;
    protected $prayerModel;
    protected $rosaryModel;
    protected $CatholicCalendarModel;

    public function __construct()
    {
        // Initialize the models
        $this->userProfileModel = new UserProfileModel();
        $this->saintsModel = new SaintsModel();
        $this->prayerModel = new PrayerModel();
        $this->rosaryModel=new RosaryModel();
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
        // Get common data
        $data = $this->getCommonData('Liturgical Classes');

        // Pass common data directly to the liturgical_classes view
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
