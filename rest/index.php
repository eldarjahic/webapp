<?php
 require "../vendor/autoload.php";
 require "services/UserService.php";
 require "services/PetService.php";
 require_once "dao/UserDao.php";

 /*Flight::map('error', function(Exception $ex){
    Flight::json(["message"=>$ex->getMessage()],$ex->getCode()?$ex->getCode():500);
  });*/
 Flight::register('userDao', "UserDao");
 Flight::register('user_service', "UserService");
 Flight::register('pet_service', "PetService");
 

 require_once 'routes/UserRoutes.php';
 require_once 'routes/PetsRoutes.php';

 Flight::start();
?>
