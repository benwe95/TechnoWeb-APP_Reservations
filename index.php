<?php
session_start();

//Saves the path to the root of the application
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
define('WEBROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

require(WEBROOT.'controllers/superController.php');
require(WEBROOT.'models/databaseModel.php');

$GLOBALS['database'] = new Database();

//Analyses the url and sets the paramaters which will be use to launch the right controller and method.
$controller = isset($_GET['page']) ? $_GET['page'] : 'main';
$action = isset($_GET['action']) ? $_GET['action'] : 'home';
$id = isset($_GET['id']) ? $_GET['id'] : '-1';

if(is_file(WEBROOT.'controllers/'.$controller.'Controller.php')){
 //Makes an object of the type of the controller for the specific request
  require(WEBROOT.'controllers/'.$controller.'Controller.php');
  $controller = new $controller();
 //Launches the right method according to the paramters
  if(method_exists($controller, $action) && $id!='-1'){
    $controller->$action($id);
  }
  elseif (method_exists($controller, $action) && $id=='-1'){
    $controller->$action();
  }
  else{
    include(WEBROOT.'views/errorView.php');
  }
}
else{
  include(WEBROOT.'views/errorView.php');
}

 ?>
