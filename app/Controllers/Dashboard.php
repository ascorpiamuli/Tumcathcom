<?php

namespace App\Controllers;

use App\Models\UserProfileModel;

class Dashboard extends BaseController
{
    public function index()
    {
        // Start session
        $session = session();
        $user_id = $session->get('user_id');

        if (!$user_id) {
            return redirect()->to('/login'); // Redirect to login if user is not logged in
        }

        // Load the model and fetch user data
        $userProfileModel = new UserProfileModel();
        $fullName = $userProfileModel->getUserFullNameById($user_id); // Fetch full name

        // Pass the full name to the view
        return view('tabs/dashboard', ['fullName' => $fullName]);
    }

    public function family_jumuia()
    {
        return view('tabs/family_jumuia');
    }

    public function semester_registration()
    {
        return view('tabs/semester_registration');
    }

    public function prayers_novena()
    {
        return view('tabs/prayers_novena');
    }

    public function assets_report()
    {
        return view('tabs/assets_report');
    }
    public function liturgical_classes()
    {
        return view('tabs/liturgical_classes');
    }

    public function treasury_report()
    {
        return view('tabs/treasury_report');
    }

    public function daily_prayers()
    {
        return view('tabs/daily_prayers');
    }

    public function choir()
    {
        return view('tabs/choir');
    }

    public function readings()
    {
        return view('tabs/readings');
    }

    public function events()
    {
        return view('tabs/events');
    }

    public function settings()
    {
        return view('tabs/settings');
    }

    public function help()
    {
        return view('tabs/help');
    }

    public function suggestion()
    {
        return view('tabs/suggestion');
    }

    public function welfare()
    {
        return view('tabs/welfare');
    }
}
