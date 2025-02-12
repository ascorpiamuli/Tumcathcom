<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserAuthenticationModel;
use App\Models\AdminAuthenticationModel;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security, be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = ['general_helper','form_helper','session_helper'];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
        // Validate session on each controller
        $this->validateSession();

        // Preload any models, libraries, etc., here.
    }

    /**
     * Session Validation Method (Called on each request)
     */
    protected function validateSession()
    {
        $adminSessionToken = session()->get('admin_session_token');
        $adminId = session()->get('admin_id');
    
        $userSessionToken = session()->get('user_session_token');
        $userId = session()->get('user_id');
    
        // Admin session validation
        if ($adminSessionToken) {
            $adminAuthModel = new AdminAuthenticationModel();
            $admin = validateSessionToken($adminSessionToken, 'admin'); // Fixed token variable

            if (!$admin) {
                session()->setFlashdata('error', 'Admin session expired. Please log in again.');
                session()->remove(['admin_id', 'admin_session_token']);
                return redirect()->to('/auth/admin/login');
            }
        }

    
        // User session validation
        if ($userSessionToken) {
            $userAuthModel = new UserAuthenticationModel();
            $user = validateSessionToken($userSessionToken,'user');
    
            if (!$user) {
                session()->setFlashdata('error', 'User session expired. Please log in again.');
                session()->remove(['user_id', 'user_session_token']);
                return redirect()->to('/auth/login');
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
            $user_id = $this->request->getGet('user_id') ?? $this->request->getPost('user_id') ?? $userId;
            $fullName = $this->userProfileModel->getUserFullNameById($user_id); // Fetch Admin Name
        } else {
            $user_id = $userId; // Normal user session
            $fullName = $this->userProfileModel->getUserFullNameById($user_id); // Fetch User Name
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
    
        // Fetch other data
        $assetsdata = $this->assetsModel->getAssetsData($fullName);
        $allassetsdata = $this->assetsModel->getAllAssetsData($fullName);
        $registrationdata = $this->semesterRegistrationModel->getRegistrationData($fullName);
        $confirmationdata = $this->liturgicalClassesModel->getConfirmationData($fullName);
        $dancersdata = $this->liturgicalDancersModel->getDancersData($fullName);
        $serversdata = $this->liturgicalServersModel->getServersData($fullName);
        $catechistdata = $this->liturgicalCatechistModel->getCatechistData($fullName);
        $datelogged = $this->userProfileModel->getDateEnteredById($user_id);
        $userprofile = $this->userProfileModel->getUserProfileById($user_id);
        $family = $this->userProfileModel->getFamilyNameById($user_id);
        $userauthprofile = $this->userAuthModel->getUserProfileById($user_id);
        $saint = $this->saintsModel->getSaintData($family);
        $readings = $serviceRequest->fetchReadings();
        $saintoftheday = $serviceRequest->getSaintOfTheDay();
        $prayer = $this->prayerModel->getRandomPrayer();
        $saintofthedaydata = $this->saintsModel->getSaintDataBySaintName($saintoftheday);
        $todayscatholicdate = $this->CatholicCalendarModel->fetchCatholicDays(date('Y-m-d'));
    
        return array_merge($data, [
            'allassetsdata' => $allassetsdata,
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
