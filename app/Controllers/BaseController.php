<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\UserAuthenticationModel;
use App\Models\AdminAuthenticationModel;
use App\Models\SuggestionsModel;
use App\Controllers\Admin\AdminDashboard;
use App\Traits\AnnouncementsTrait; // ✅ Import the trait


/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 */
abstract class BaseController extends Controller
{
  
    protected $request;
    protected $helpers = ['general_helper', 'form_helper', 'session_helper'];
    protected $userAuthModel;
    protected $adminAuthModel;
    protected $suggestionsModel;
    protected $announcementsModel;
 

    public function __construct()
    { 
        $this->admindashboard=new AdminDashboard();
        $this->userAuthModel = new UserAuthenticationModel();
        $this->adminAuthModel = new AdminAuthenticationModel();
        $this->sugggestionsModel=new SuggestionsModel();
    }

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // Validate session on each request
        $this->validateSession();

        // Update last activity time for online tracking
        $this->updateUserActivity();
        // ✅ Get latest announcement using the trait method
      
       

}

    /**
     * Validate the user's session on each request.
     */
    protected function validateSession()
    {
        $adminSessionToken = session()->get('admin_session_token');
        $userSessionToken = session()->get('user_session_token');

        if ($adminSessionToken) {
            $admin = validateSessionToken($adminSessionToken, 'admin');
            if (!$admin) {
                session()->setFlashdata('error', 'Admin session expired. Please log in again.');
                session()->remove(['admin_id', 'admin_session_token']);
                return redirect()->to('/auth/admin/login')->send();
            }
        }

        if ($userSessionToken) {
            $user = validateSessionToken($userSessionToken, 'user');
            if (!$user) {
                session()->setFlashdata('error', 'User session expired. Please log in again.');
                session()->remove(['user_id', 'user_session_token']);
                return redirect()->to('/auth/login')->send();
            }
        }
    }

    /**
     * Update the last activity timestamp for online status tracking.
     */
    protected function updateUserActivity()
    {
        if (session_status() === PHP_SESSION_ACTIVE) { // ✅ Check if session is active
            if (session()->has('admin_id') && isset($this->adminAuthModel)) {
                $this->adminAuthModel->update(session()->get('admin_id'), ['updated_at' => date('Y-m-d H:i:s')]);
            } elseif (session()->has('user_id') && isset($this->userAuthModel)) {
                $this->userAuthModel->update(session()->get('user_id'), ['updated_at' => date('Y-m-d H:i:s')]);
            }
        }
    }
    


    

    /**
     * Fetch common data for views
     *
     * @param string $pageTitle
     * @return array
     */
    protected function getCommonData($pageTitle = 'Dashboard')
    {
        // Start session
        $session = session();
    
        // Determine user type and ID
        if ($session->has('admin_id')) {
            $userId = $session->get('admin_id');
            $userType = 'admin';
            $session->set('user_type', 'admin'); // Ensure user type is set
        } elseif ($session->has('user_id')) {
            $userId = $session->get('user_id');
            $userType = 'user';
            $session->set('user_type', 'user');
        } else {
            return redirect()->to('/auth/login');
        }
    
        // Determine correct user ID
        if ($userType === 'admin') {
            $adminAuthModel = new AdminAuthenticationModel();
            $user_id = $this->request->getGet('user_id') ?? $this->request->getPost('user_id') ?? $userId;
            $fullName = $this->userProfileModel->getUserFullNameById($user_id); // Fetch Admin Name
            $admindata=$adminAuthModel->getAdminById($user_id);//admin data
            $alladmindata=$adminAuthModel->getAllAdmins();
        } else {
            $user_id = $userId; // Normal user session
            $fullName = $this->userProfileModel->getUserFullNameById($user_id); // Fetch User Name
            $admindata=null;
            $alladmindata=null;
        }
        // Day mapping logic
        $dayMap = [
            1 => 'Monday & Saturday',
            2 => 'Tuesday & Friday',
            3 => 'Wednesday & Sunday',
            4 => 'Thursday'
        ];
    
        $today = date('l');
        $dayId = null;
        $matchingContent = null;
    
        foreach ($dayMap as $id => $days) {
            if (in_array($today, explode(' & ', $days))) {
                $dayId = $id;
                $matchingContent = $days;
                break;
            }
        }
    
        $data = [];
        if ($dayId !== null) {
            $data['mystery'] = $this->rosaryModel->getMysteriesByDay($matchingContent);
            $data['matchingContent'] = $matchingContent;
        } else {
            $data['mystery'] = [];
            $data['matchingContent'] = null;
        }
    
        // Fetch Daily Prayer
        $serviceRequest = new \App\Libraries\getServiceRequest(\Config\Services::cache());
        $dailyprayer = $serviceRequest->getDailyPrayers();
    
        if ($dailyprayer) {
            $title = '';
            $content = '';
    
            foreach ($dailyprayer as $prayer) {
                if ($prayer['type'] === 'h3') {
                    $title = $prayer['content'];
                } elseif ($prayer['type'] === 'p') {
                    $content = $prayer['content'];
                }
            }
    
            $data['dailyprayer'] = [
                'title' => $title,
                'content' => $content,
            ];
        } else {
            $data['dailyprayer'] = [
                'status' => 'error',
                'message' => 'An error occurred while fetching the daily prayers.',
            ];
        }
    
        $approvedadmins=$this->adminAuthModel->countActiveMembers();
        $onlineadmins=$this->adminAuthModel->getAdminOnlineUsers();
        $alladmins=$this->adminAuthModel->countRegisteredMembers();
        $assetsdata = $this->assetsModel->getAssetsData($fullName);
        $assetshired=$this->assetsModel->countAllAssetsHired();
        $assetspending=$this->assetsModel->countAllAssetsPending();
        $assetsdeclined=$this->assetsModel->countAllAssetsDeclined();
        $wholeassets = $this->assetsModel->getAllAssetsDataSorted();
        $pendingassets = $this->assetsModel->getPendingAssets();
        $allassetsdata = $this->assetsModel->getAllAssetsData($fullName);
        $registrationdata = $this->semesterRegistrationModel->getRegistrationData($fullName);
        $confirmationdata = $this->liturgicalClassesModel->getConfirmationData($fullName);
        $dancersdata = $this->liturgicalDancersModel->getDancersData($fullName);
        $serversdata = $this->liturgicalServersModel->getServersData($fullName);
        $catechistdata = $this->liturgicalCatechistModel->getCatechistData($fullName);
        $datelogged = $this->userProfileModel->getDateEnteredById($user_id);
        $userprofile = $this->userProfileModel->getUserProfileById($user_id);
        $catechismmembers=$this->liturgicalCatechistModel->countRegisteredMembers();
        $confirmationmembers=$this->liturgicalClassesModel->countRegisteredMembers();
        $dancersmembers=$this->liturgicalDancersModel->countRegisteredMembers();
        $serversmembers=$this->liturgicalServersModel->countRegisteredMembers();
        $registeredmembers=$this->semesterRegistrationModel->countRegisteredMembers();
        $family = $this->userProfileModel->getFamilyNameById($user_id);
        $userauthprofile = $this->userAuthModel->getUserProfileById($user_id);
        $saint = $this->saintsModel->getSaintData($family);
        $readings = $serviceRequest->fetchReadings();
        $saintoftheday = $serviceRequest->getSaintOfTheDay();
        $prayer = $this->prayerModel->getRandomPrayer();
        $saintofthedaydata = $this->saintsModel->getSaintDataBySaintName($saintoftheday);
        $weeklypercentregistration=$this->semesterRegistrationModel->getWeeklyRegistrationPercentage();
        $todayscatholicdate = $this->CatholicCalendarModel->fetchCatholicDays(date('Y-m-d'));
        $registrationfeetotal=$this->semesterRegistrationModel->countRegistrationFee();
    
        return array_merge($data, [
            'onlineadmins'=>$onlineadmins,
            'assetshired'=>$assetshired,
            'assetspending'=>$assetspending,
            'assetsdeclined'=>$assetsdeclined,
            'pendingassets'=>$pendingassets,
            'alladmins'=>$alladmins,
            'approvedadmins'=>$approvedadmins,
            'serversmembers'=>$serversmembers,
            'alladmindata'=>$alladmindata,
            'catechismmembers'=>$catechismmembers,
            'dancersmembers'=>$dancersmembers,
            'confirmationmembers'=>$confirmationmembers,
            'registrationfeetotal'=>$registrationfeetotal,
            'registeredmembers'=>$registeredmembers,
            'weeklypercentregistration'=>$weeklypercentregistration,
            'admindata'=>$admindata,
            'allassetsdata' => $allassetsdata,
            'wholeassets'=>$wholeassets,
            'assetsdata' => $assetsdata,
            'confirmationdata' => $confirmationdata,
            'registrationdata' => $registrationdata,
            'catechistdata' => $catechistdata,
            'todayscatholicdate' => $todayscatholicdate,
            'saintofthedaydata' => $saintofthedaydata,
            'saintoftheday' => $saintoftheday,
            'fullName' => $fullName,
            'dancersdata' => $dancersdata,
            'family' => $family,
            'userprofile' => $userprofile,
            'saint' => $saint,
            'readings' => $readings,
            'prayer' => $prayer,
            'userauthprofile' => $userauthprofile,
            'pageTitle' => $pageTitle,
            'datelogged' => $datelogged,
            'serversdata' => $serversdata
        ]);
    }
    
}
