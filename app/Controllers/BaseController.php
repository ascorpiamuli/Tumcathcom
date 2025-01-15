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
 * For security be sure to declare any new methods as protected or private.
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
    protected $helpers = ['general_helper'];

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
        //Validate Session on each Controller
        $this->validateSession();

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }
    // Session Validation Method (Called on each request)
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
    // Method to fetch common data
    protected function getCommonData($pageTitle='Dashboard')    {
        $session = session();
        $user_id = $session->get('user_id');

        // If user is not logged in, redirect to login page
        if (!$user_id) {
            return redirect()->to('/login');
        }

        $fullName = $this->userProfileModel->getUserFullNameById($user_id);
        $datelogged = $this->userProfileModel->getDateEnteredById($user_id);
        $family = $this->userProfileModel->getFamilyNamebyId($user_id);
        $saint = $this->saintsModel->getSaintData($family);
        $serviceRequest = new \App\Libraries\getServiceRequest(\Config\Services::cache());
        $readings = $serviceRequest->fetchReadings();
        $saintoftheday=$serviceRequest->getSaintOfTheDay();
        $prayer = $this->prayerModel->getRandomPrayer();
        $saintofthedaydata=$this->saintsModel->getSaintDatabySaintName($saintoftheday);
        $todayscatholicdate=$this->CatholicCalendarModel->fetchCatholicDays(date('Y-m-d'));
        // Returning all the common data as an array
        return [
            'todayscatholicdate'=>$todayscatholicdate,
            'saintofthedaydata'=>$saintofthedaydata,
            'saintoftheday'=>$saintoftheday,
            'fullName' => $fullName,
            'family' => $family,
            'saint' => $saint,
            'readings' => $readings,
            'prayer' => $prayer,
            'pageTitle'=>$pageTitle,
            'datelogged'=>$datelogged
        ];
    }
}
