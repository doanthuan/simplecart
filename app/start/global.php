<?php

//error_reporting(E_ALL ^ E_NOTICE);
// Define the gethostname function if it does not exist
if (!function_exists('gethostname')) {
    function gethostname() {
        require_once 'google/appengine/api/app_identity/AppIdentityService.php';
        return \google\appengine\api\app_identity\AppIdentityService::getApplicationId();
    }
}

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

ClassLoader::addDirectories(array(

//	app_path().'/commands',
//	app_path().'/controllers',
//	app_path().'/models',
//	app_path().'/database/seeds',
));


/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a basic log file setup which creates a single file for logs.
|
*/

use Monolog\Logger;
if(isset($_SERVER['SERVER_SOFTWARE']) && strpos($_SERVER['SERVER_SOFTWARE'],'Google App Engine') !== false) {
$monolog = Log::getMonolog();
$monolog->pushHandler(new Monolog\Handler\SyslogHandler('intranet', 'user', Logger::DEBUG, false, LOG_PID));
}
else{
    Log::useFiles(storage_path().'/logs/laravel.log');
}

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

App::error(function(Exception $exception, $code)
{
	Log::error($exception);
});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenance mode is in effect for the application.
|
*/

App::down(function()
{
	return Response::make("Be right back!", 503);
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

require 'filters.php';

//register events
require 'events.php';

/*
|--------------------------------------------------------------------------
| Define some path constants
|--------------------------------------------------------------------------
*/
define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);
define('BP', dirname(dirname(__FILE__)));


Blade::extend(function($view, $compiler)
{
    $pattern = $compiler->createMatcher('block');

    $result = preg_replace($pattern, '$1<?php if(!isset($block)){$block=null;} echo \Goxob::getBlock$2->toHtml();?>', $view);
    $result = str_replace('))->toHtml();?>',',\'parent\' => $block))->toHtml();?>', $result);
    return $result;
});


Form::macro('row', function($type, $label, $name, $value = null, $attributes = array(), $data = array(),$wrapperClass = null)
{
    return \Goxob\Core\Html\FormRow::field($type, $label, $name, $value, $attributes, $data, $wrapperClass);
});

/*
|--------------------------------------------------------------------------
| Route match
|--------------------------------------------------------------------------
*/
Route::matched(function($route, $request)
{
    \Goxob::setSegments($route);
    \Goxob::initView();

    \Goxob\Application\Helper::countVisit();
});