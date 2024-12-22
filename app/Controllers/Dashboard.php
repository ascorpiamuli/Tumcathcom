<?php

namespace App\Controllers;

use App\Models\UserProfileModel;
use App\Models\SaintsModel;
use App\Models\PrayerModel;

class Dashboard extends BaseController
{
    private $userProfileModel;
    private $saintsModel;
    private $prayerModel;

    public function __construct()
    {
        // Initialize the models
        $this->userProfileModel = new UserProfileModel();
        $this->saintsModel = new SaintsModel();
        $this->prayerModel = new PrayerModel();
    }

    // Method to fetch common data
    private function getCommonData()
    {
        $session = session();
        $user_id = $session->get('user_id');

        // If user is not logged in, redirect to login page
        if (!$user_id) {
            return redirect()->to('/login');
        }

        $fullName = $this->userProfileModel->getUserFullNameById($user_id);
        $family = $this->userProfileModel->getFamilyNamebyId($user_id);
        $saint = $this->saintsModel->getSaintDatabySaintName($family);
        $serviceRequest = new \App\Libraries\getServiceRequest(\Config\Services::cache());
        $readings = $serviceRequest->fetchReadings();
        $prayer = $this->prayerModel->getRandomPrayer();

        // Returning all the common data as an array
        return [
            'fullName' => $fullName,
            'family' => $family,
            'saint' => $saint,
            'readings' => $readings,
            'prayer' => $prayer
        ];
    }

    public function index()
    {
        // Get common data
        $data = $this->getCommonData();

        // Pass common data directly to the dashboard view
        return view('tabs/dashboard', $data);
    }

    public function family_jumuia()
    {
        // Get common data
        $data = $this->getCommonData();

        // Pass common data directly to the family_jumuia view
        return view('tabs/family_jumuia', $data);
    }

    public function semester_registration()
    {
        // Get common data
        $data = $this->getCommonData();

        // Pass common data directly to the semester_registration view
        return view('tabs/semester_registration', $data);
    }

    public function prayers_novena()
    {
        // Get common data
        $data = $this->getCommonData();

        // Pass common data directly to the prayers_novena view
        return view('tabs/prayers_novena', $data);
    }

    public function assets_report()
    {
        // Get common data
        $data = $this->getCommonData();

        // Pass common data directly to the assets_report view
        return view('tabs/assets_report', $data);
    }

    public function liturgical_classes()
    {
        // Get common data
        $data = $this->getCommonData();

        // Pass common data directly to the liturgical_classes view
        return view('tabs/liturgical_classes', $data);
    }

    public function treasury_report()
    {
        // Get common data
        $data = $this->getCommonData();

        // Pass common data directly to the treasury_report view
        return view('tabs/treasury_report', $data);
    }

    public function daily_prayers($id)
    {
        $data = $this->getCommonData();

        // Fetch the specific prayer by ID
        $prayer = $this->prayerModel->find($id);
        if (!$prayer) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Prayer not found');
        }

        // Add the specific prayer data to the common data
        $data['prayer'] = $prayer;

        // Pass common data directly to the daily_prayers view
        return view('tabs/daily_prayers', $data);
    }

    public function choir()
    {
        $data = $this->getCommonData();
        return view('tabs/choir', $data);
    }

    public function readings()
    {
        $data = $this->getCommonData();
        return view('tabs/readings', $data);
    }

    public function events()
    {
        $data = $this->getCommonData();
        return view('tabs/events', $data);
    }

    public function settings()
    {
        $data = $this->getCommonData();
        return view('tabs/settings', $data);
    }

    public function help()
    {
        $data = $this->getCommonData();
        return view('tabs/help', $data);
    }

    public function suggestion()
    {
        $data = $this->getCommonData();
        return view('tabs/suggestion', $data);
    }

    public function welfare()
    {
        $data = $this->getCommonData();
        return view('tabs/welfare', $data);
    }
}
