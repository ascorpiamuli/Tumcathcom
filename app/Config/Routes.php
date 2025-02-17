<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default route - Redirect to login page
//this url /, will call the authentication controller which in turn calls the login method.
$routes->get('/', 'Auth::login');

/** ---------------------------------------
 *  Authentication Routes
 * ----------------------------------------
 */
$routes->group('auth', function ($routes) {
    $routes->get('register', 'Auth::register');
    $routes->post('register', 'Auth::register');
    $routes->get('login', 'Auth::login');
    $routes->post('login', 'Auth::login');
    $routes->get('authentication', 'Auth::authentication');
    $routes->post('authentication', 'Auth::authentication');
    $routes->get('forgot_password', 'Auth::forgotPassword');
    $routes->get('logout', 'Auth::logout');
});

// Admin Authentication Routes
$routes->group('auth/admin', function ($routes) {
    $routes->get('login', 'Admin\AdminAuth::login');
    $routes->post('login', 'Admin\AdminAuth::login');
    $routes->get('register', 'Admin\AdminAuth::register');
    $routes->post('register', 'Admin\AdminAuth::register');
    $routes->get('forgot_password', 'Admin\AdminAuth::forgotPassword');
    $routes->get('logout', 'Admin\AdminAuth::logout');
});

/** ---------------------------------------
 *  Admin Dashboard Routes
 * ----------------------------------------
 */
$routes->group('admin', function ($routes) {
    $routes->get('dashboard', 'Admin\AdminDashboard::index');
    $routes->get('approval', 'Admin\AdminDashboard::approval_pending');
    $routes->get('suspended', 'Admin\AdminDashboard::suspended');
    $routes->post('admin_announcements', 'Admin\AdminDashboard::adminAnnouncements');
});

/** ---------------------------------------
 *  User Dashboard & Tabs Routes
 * ----------------------------------------
 */
$routes->group('tabs', function ($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('profile', 'Dashboard::profile');
    $routes->post('profile', 'Dashboard::profile');
    $routes->get('family', 'Dashboard::family_jumuia');
    $routes->get('semester-registration', 'Dashboard::semester_registration');
    $routes->post('semester-registration', 'Dashboard::semester_registration');
    $routes->get('prayers_novena', 'Dashboard::prayers_novena');
    $routes->get('assets', 'Dashboard::assets');
    $routes->post('assets', 'Dashboard::assets');
    $routes->get('treasury_report', 'Dashboard::treasury_report');
    $routes->get('assets_report', 'Dashboard::assets_report');
    $routes->get('booking-history', 'Dashboard::bookingHistory');
    $routes->get('prayers', 'Dashboard::prayers');
    $routes->get('choir-registration', 'Dashboard::choirRegistration');
    $routes->get('readings', 'Dashboard::readings');
    $routes->get('events', 'Dashboard::events');
    $routes->get('settings', 'Dashboard::settings');
    $routes->get('help', 'Dashboard::help');
    $routes->get('register', 'Auth::register');
    $routes->post('register', 'Auth::register');
    $routes->get('suggestion', 'Dashboard::suggestion');
    $routes->get('welfare', 'Dashboard::welfare');
    $routes->get('liturgical_classes', 'Dashboard::liturgical_classes');
    $routes->post('liturgical_classes', 'Dashboard::liturgical_classes');
    $routes->post('deleteProfile', 'Dashboard::deleteProfile');
});

/** ---------------------------------------
 *  API & Scraper Routes
 * ----------------------------------------
 */
$routes->get('saints', 'Scraper::fetchAndSaveSaints');
$routes->get('readings', 'Scraper::fetchReadings');
$routes->get('prayers', 'Scraper::fetchPrayers');
$routes->get('/daily_prayers', 'Scraper::getDailyPrayers');
$routes->get('/saveMysteries', 'Scraper::saveMysteriesOfTheRosary');
$routes->get('import-calendar', 'CatholicCalendarController::importCalendar');
$routes->get('/getJumuia', 'APIController::getJumuia');
$routes->get('/getAssets', 'APIController::getAssets');
$routes->get('getAssets/(:any)', 'APIController::getAssetsbyId/$1');
$routes->get('/uploads/(:any)', 'APIController::showProfileImage/$1');
$routes->post('/save-comment', 'APIController::saveComment');

/** ---------------------------------------
 *  Booking & Approval Routes
 * ----------------------------------------
 */
$routes->post('/approveBooking/(:any)', 'APIController::approveBooking/$1');
$routes->post('/declineBooking/(:any)', 'APIController::declineBooking/$1');
$routes->get('/approve/(:any)', 'APIController::approve/$1');
$routes->get('/decline/(:any)', 'APIController::decline/$1');
$routes->get('/suspend/(:any)', 'APIController::suspend/$1');
$routes->get('/reinstate/(:any)', 'APIController::reinstate/$1');
/** ---------------------------------------
 *  Suggetions Routes
 * ----------------------------------------
 */
$routes->post('/suggestion/submit', 'SuggestionsController::submitSuggestion');
$routes->get('/suggestion/fetch', 'SuggestionsController::fetchSuggestions');

