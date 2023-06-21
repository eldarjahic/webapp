<?php
require "../vendor/autoload.php";
require "services/UserService.php";
require "services/PetService.php";
require "services/AdoptionService.php";
require_once "dao/UserDao.php";

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/*Flight::map('error', function(Exception $ex){
   Flight::json(["message"=>$ex->getMessage()],$ex->getCode()?$ex->getCode():500);
 });*/
Flight::register('userDao', "UserDao");
Flight::register('user_service', "UserService", array(new UserDao()));
Flight::register('pet_service', "PetService");
Flight::register('adoption_service', "AdoptionService");

// middleware method for login
Flight::route('/*', function () {
  //perform JWT decode
  $path = Flight::request()->url;
  if ($path == '/login' || $path == '/docs.json')
    return TRUE; // exclude login route from middleware

  $headers = getallheaders();
  if (!@$headers['Authorization']) {
    Flight::json(["message" => "Authorization is missing"], 403);
    return FALSE;
  } else {
    try {
      $decoded = (array) JWT::decode($headers['Authorization'], new Key(Config::JWT_SECRET(), 'HS256'));
      Flight::set('user', $decoded);
      return TRUE;
    } catch (\Exception $e) {
      Flight::json(["message" => "Authorization token is not valid"], 403);
      return FALSE;
    }
  }
});

/* REST API documentation endpoint */
Flight::route('GET /docs.json', function () {
  $openapi = \OpenApi\Generator::scan(["routes"]);
  header('Content-Type: application/json');
  echo $openapi->toJson();
});


require_once 'routes/UserRoutes.php';
require_once 'routes/PetsRoutes.php';
require_once 'routes/AdoptionRoutes.php';

Flight::start();
?>