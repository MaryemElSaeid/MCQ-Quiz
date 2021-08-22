<?php

namespace Config;

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
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->group('', ['filter'=>'AdminCheck'],function($routes){
	//add all routes that i want to protect by this filter
	$routes->get('/admindashboard','AdminDashboard::index');
	//user info
	$routes->get('user','UserDashboard::list');
	$routes->get('user-add','UserDashboard::create');
	$routes->post('user-store','UserDashboard::store');

	//questions info 
	$routes->get('question/add/(:num)','QuestionController::create/$1');
	$routes->post('question/store/(:num)','QuestionController::store/$1');
	// $routes->get('quiz/show/(:num)','QuizController::show/$1');
	$routes->get('question/edit/(:num)','QuestionController::edit/$1');
	$routes->put('question/update/(:num)','QuestionController::update/$1');
	$routes->delete('question/delete/(:num)','QuestionController::delete/$1');
	
	//quiz data
	$routes->get('quiz','QuizController::index');
	$routes->get('quiz-add','QuizController::create');
	$routes->post('quiz-store','QuizController::store');
	$routes->get('quiz/show/(:num)','QuizController::show/$1');
	$routes->get('quiz/edit/(:num)','QuizController::edit/$1');
	$routes->put('quiz/update/(:num)','QuizController::update/$1');
	$routes->delete('quiz/delete/(:num)','QuizController::delete/$1');
});
//add group of routes to be protected by filter 
$routes->group('', ['filter'=>'AuthCheck'],function($routes){
	//add all routes that i want to protect by this filter
	$routes->get('/userdashboard','UserDashboard::index');
});

$routes->group('', ['filter'=>'AlreadyLoggedIn'],function($routes){
	//add all routes that i want to protect by this filter
	$routes->get('/auth','Auth::index');
	$routes->get('/auth/register','Auth::register');

});

// $routes->group('', ['filter'=>'PreventBack'],function($routes){

	$routes->get('quiz/user/show/(:num)','QuizController::showQuizForUser/$1');
// });

//user for user
$routes->get('user/show/(:num)','UserDashboard::show/$1');
$routes->get('user/edit/(:num)','UserDashboard::edit/$1');
$routes->put('user/update/(:num)','UserDashboard::update/$1');
$routes->delete('user/delete/(:num)','UserDashboard::delete/$1');

//quiz for user 
$routes->get('quiz/list','QuizController::listQuizForUser');

$routes->post('quiz/check/(:num)','QuizController::check/$1');


//quiz data
// $routes->get('quiz','QuizController::index');
// $routes->get('quiz-add','QuizController::create');
// $routes->post('quiz-store','QuizController::store');
// $routes->get('quiz/show/(:num)','QuizController::show/$1');
// $routes->get('quiz/edit/(:num)','QuizController::edit/$1');
// $routes->put('quiz/update/(:num)','QuizController::update/$1');
// $routes->delete('quiz/delete/(:num)','QuizController::delete/$1');


//question data
// $routes->get('quiz','QuizController::index');
// $routes->get('quiz/show/(:num)','QuizController::show/$1');
// $routes->get('question-add','QuestionController::create');
// $routes->post('question-store','QuestionController::store');



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
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
