<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Controllers\Dashboard;

class AdminDashboard extends Dashboard
{
    public function __construct()
    {
        parent::__construct(); // ✅ Load parent constructor to inherit methods & properties
    }

    public function index()
    {
        $data = $this->getCommonData('Admin Dashboard');
    
        // Check if getCommonData() returned a redirect
        if ($data instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $data; // Return redirect response instead of passing to view()
        }
    
        return view('admin/dashboard', $data);
    }
}
