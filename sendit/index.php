<?php
define('DS', DIRECTORY_SEPARATOR);
define('BASE_PATH', __DIR__ . DS);

require BASE_PATH.'vendor/autoload.php';
require BASE_PATH.'settings/settings.php';

$app		= System\App::instance();
$app->request  	= System\Request::instance();
$app->route	= System\Route::instance($app->request);
$route		= $app->route;
$route->any('/', function() {
    echo time();
Airplay::header();

});


$route->any('/slag', function() {
    echo time();
Airplay::header();

});





//create user account
$route->post('/user', function(){
    include_once 'model/user/account.php'; 
    
    Airplay::header();
});


//user login
$route->post('/login', function(){
    //include_once 'model/user/login.php'; 
echo time();
    Airplay::header();
});




//get rider's current location
$route->any('/gis', function(){
     include_once 'model/user/login.php'; 
    Airplay::header();
});

$route->any('/emitter', function(){
    header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$time = date('r');
echo "data: The server time is: {$time}\n\n";
flush();
});



$route->end();