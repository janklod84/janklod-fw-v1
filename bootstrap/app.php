<?php 

/*
|----------------------------------------------------------------------
|   Check compatibility php version user with that used application
|----------------------------------------------------------------------
*/

if(!version_compare(PHP_VERSION, '7.1', '>='))
{
   exit(
     'This application use <b> version php >= 7.1 </b>.
      But your version php is <b> '. PHP_VERSION . '</b>'
  );
}



/*
|-------------------------------------------------------------------
|    Application starting time
|-------------------------------------------------------------------
*/

define('JKSTART', microtime(true));



/*
|-------------------------------------------------------------------
|    Route Directory of Application
|    Root directory specifly  dirname(__DIR__) or [../]
|-------------------------------------------------------------------
*/

define('ROOT', '../');



/*
|-------------------------------------------------------
|    Development mode 
|    FALSE mean that you are in production mode
|    TRUE  mean that you are in develpment mode
|-------------------------------------------------------
*/

define('DEV', true);



/*
|----------------------------------------------------------------------
|   Autoloading classes and dependencies of application
|----------------------------------------------------------------------
*/

require_once realpath(__DIR__ .'/../vendor/autoload.php');


/*
|----------------------------------------------------------------------
|    Error Handler settings
|----------------------------------------------------------------------
*/

error_reporting(E_ALL);
set_error_handler('JK\Exception\ErrorHandler::errorHandler');
set_exception_handler('JK\Exception\ErrorHandler::exceptionHandler');


/*
|-------------------------------------------------------------------
|    Get instance of Application 
|-------------------------------------------------------------------
*/

$app = \JK\Application::instance(ROOT);



/*
|-------------------------------------------------------------------
|    Start session
|-------------------------------------------------------------------
*/

$app->session();



/*
|-------------------------------------------------------------------
|    Initialize all Functions of Application
|-------------------------------------------------------------------
*/

$app->loadFunctions();



/*
|-------------------------------------------------------------------
|   Loading all alias
|-------------------------------------------------------------------
*/

$app->loadAlias();




/*
|-------------------------------------------------------------------
|   Loading all providers
|-------------------------------------------------------------------
*/

$app->loadProviders();




/*
|-------------------------------------------------------------------
|   Loading all routes of Application
|-------------------------------------------------------------------
*/

$app->file->call('routes/app.php');




/*
|-------------------------------------------------------------------
|   Add all collections routes
|-------------------------------------------------------------------
*/

$app->router->addRoutes(
	\JK\Routing\Route\RouteCollection::all()
);


/*
\JK\Initialize::output();
*/