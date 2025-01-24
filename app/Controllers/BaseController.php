<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserAuthenticationModel;
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
        $sessionToken = session()->get('session_token');
        $userId = session()->get('user_id');
        if ($sessionToken) {
            $userAuthModel = new UserAuthenticationModel();
            $user = validateSessionToken($sessionToken, $userAuthModel);
            if (!$user || $user['user_id'] !== $userId) {
                session()->setFlashdata('error', 'Session expired or invalid. Please log in again.');
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
        $session = session();
        $user_id = $session->get('user_id');

        if (!$user_id) {
            return redirect()->to('/login');
        }

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
            $dayList = explode(' & ', $days);
            if (in_array($today, $dayList)) {
                $dayId = $id;
                $matchingContent = $days;
                break;
            }
        }

        $data = [];
        if ($dayId !== null) {
            $mystery = $this->rosaryModel->getMysteriesByDay($matchingContent);
            $data['mystery'] = $mystery;
            $data['matchingContent'] = $matchingContent;
        } else {
            $data['mystery'] = [];
            $data['matchingContent'] = null;
        }

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

        $fullName = $this->userProfileModel->getUserFullNameById($user_id);
        $assetsdata=$this->assetsModel->getAssetsData($fullName);
        $registrationdata=$this->semesterRegistrationModel->getRegistrationData($fullName);
        $confirmationdata = $this->liturgicalClassesModel->getConfirmationData($fullName);
        $dancersdata = $this->liturgicalDancersModel->getDancersData($fullName);
        $serversdata = $this->liturgicalServersModel->getServersData($fullName);
        $catechistdata = $this->liturgicalCatechistModel->getCatechistData($fullName);

        $datelogged = $this->userProfileModel->getDateEnteredById($user_id);
        $userprofile = $this->userProfileModel->getUserProfileById($user_id);
        $family = $this->userProfileModel->getFamilyNamebyId($user_id);
        $userauthprofile = $this->userAuthModel->getUserProfileById($user_id);
        $saint = $this->saintsModel->getSaintData($family);
        $readings = $serviceRequest->fetchReadings();
        $saintoftheday = $serviceRequest->getSaintOfTheDay();
        $prayer = $this->prayerModel->getRandomPrayer();
        $saintofthedaydata = $this->saintsModel->getSaintDatabySaintName($saintoftheday);
        $todayscatholicdate = $this->CatholicCalendarModel->fetchCatholicDays(date('Y-m-d'));
        
        return array_merge($data, [
            'assetsdata'=>$assetsdata,
            'confirmationdata' => $confirmationdata,
            'registrationdata'=>$registrationdata,
            'catechistdata'=>$catechistdata,
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
            'serversdata' => $serversdata // New variable added to avoid overwriting
        ]);
        
    }
}
