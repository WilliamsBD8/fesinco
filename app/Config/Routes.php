<?php namespace Config;
      use App\Controllers\RestResume;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('HomeController');
$routes->setDefaultMethod('home');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// Links Para La pagina
$routes->get('/', 'PageController::home');
$routes->get('/about_us', 'PageController::about_us');
$routes->get('contact', 'PageController::contact');
$routes->get('contact/(:segment)', 'PageController::contact/$1');
$routes->get('section/(:segment)', 'PageController::section/$1');
$routes->get('section/detail/(:segment)', 'PageController::section_detail/$1');

$routes->get('sections/(:segment)', 'PageController::sections/$1');

$routes->post('send/contact', 'PageController::sendContact');

// Fin Links para la pagina

$routes->get('password', 'PasswordController::index');
$routes->post('password/updated', 'PasswordController::updated');

$routes->group('dashboard', function ($routes){
	$routes->get('', 'DashboardController::index');
	$routes->get('simulate_credit', 'DashboardController::simulate');
	$routes->post('simulate_credit', 'DashboardController::create_simulate');
	$routes->post('credits/create', 'DashboardController::create_credit');
	$routes->get('credits', 'DashboardController::credits');
	$routes->post('credits/updated', 'DashboardController::updated_credit');

	$routes->post('extracts/load', 'DashboardController::load_extracts');
	$routes->get('extracts', 'DashboardController::extracts');
	$routes->get('extracts/(:segment)', 'DashboardController::extracts/$1');
	$routes->post('extracts/view', 'DashboardController::extracts_view');

	// PDF
	$routes->get('credits/pdf/(:segment)', 'DashboardController::generate_pdf_credit/$1');
});

$routes->get('/login', 'AuthController::login');
$routes->get('/register', 'AuthController::register');
$routes->post('/create', 'AuthController::create');
$routes->get('/reset_password', 'AuthController::resetPassword');
$routes->post('/forgot_password', 'AuthController::forgotPassword');
$routes->post('/validation', 'AuthController::validation');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/about', 'DashboardController::about');
$routes->get('/perfile', 'UserController::perfile');
$routes->post('/update_photo', 'UserController::updatePhoto');
$routes->post('/update_user', 'UserController::updateUser');
$routes->post('/config/(:segment)', 'ConfigController::index/$1');
$routes->get('/config/(:segment)', 'ConfigController::index/$1');
$routes->post('/table/(:segment)', 'TableController::index/$1');
$routes->get('/table/(:segment)', 'TableController::index/$1');

$routes->post('/table/(:segment)/(:segment)', 'TableController::detail/$1/$2');
$routes->get('/table/(:segment)/(:segment)', 'TableController::detail/$1/$2');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
