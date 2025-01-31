<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default route - Redirect to login page
$routes->get('/', 'Auth::login');

// Authentication routes
$routes->group('auth', function($routes) {
    $routes->get('login', 'Auth::login');
    $routes->post('login', 'Auth::login');
    $routes->get('register', 'Auth::register');
    $routes->post('register', 'Auth::register');
    $routes->get('authentication', 'Auth::authentication');
    $routes->post('authentication', 'Auth::authentication');
    $routes->get('forgot_password', 'Auth::forgotPassword');
    $routes->get('logout', 'Auth::logout');
    
});

// Dashboard Routes
$routes->group('tabs', function($routes) {
    // Default Dashboard route
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('profile','Dashboard::profile');
    $routes->post('profile','Dashboard::profile');
    // Family/Jumuia routes
    $routes->get('family', 'Dashboard::family_jumuia');
    $routes->get('semester-registration', 'Dashboard::semester_registration');
    $routes->post('semester-registration', 'Dashboard::semester_registration'); // Add this line
    $routes->get('prayers_novena', 'Dashboard::prayers_novena');

    // TUMCathCom Reports
    $routes->get('assets', 'Dashboard::assets');
    $routes->post('assets', 'Dashboard::assets');
    $routes->get('treasury_report', 'Dashboard::treasury_report');
    $routes->get('assets_report', 'Dashboard::assets_report');
    $routes->get('booking-history', 'Dashboard::bookingHistory');

    // Liturgy routes
    
    $routes->get('prayers', 'Dashboard::prayers');

    $routes->get('choir', 'Dashboard::choir');
    $routes->get('readings', 'Dashboard::readings');


    // Events and Settings
    $routes->get('events', 'Dashboard::events');
    $routes->get('settings', 'Dashboard::settings');
    
    // Help and Suggestion Box
    $routes->get('help', 'Dashboard::help');
    $routes->get('suggestion', 'Dashboard::suggestion');
    
    // Welfare
    $routes->get('welfare', 'Dashboard::welfare');
    $routes->get('liturgical_classes', 'Dashboard::liturgical_classes');
    $routes->post('liturgical_classes', 'Dashboard::liturgical_classes');
    $routes->post('deleteProfile', 'Dashboard::deleteProfile');
});
$routes->get('saints', 'Scraper::fetchAndSaveSaints');
$routes->get('readings','Scraper::fetchReadings');
$routes->get('prayers','Scraper::fetchPrayers');
$routes->get('/getJumuia', 'APIController::getJumuia');
$routes->get('/getAssets', 'APIController::getAssets');
$routes->get('/daily_prayers','Scraper::getDailyPrayers');
$routes->get('/saveMysteries', 'Scraper::saveMysteriesOfTheRosary');
$routes->get('import-calendar', 'CatholicCalendarController::importCalendar');
$routes->get('getAssets/(:any)', 'APIController::getAssetsbyId/$1');
$routes->get('/uploads/(:any)', 'APIController::showProfileImage/$1');

