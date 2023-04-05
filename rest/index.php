<?php
 require "../vendor/autoload.php";
 require "services/UserService.php";
 require "services/PetService.php";

 Flight::register('user_service', "UserService");
 Flight::register('pet_service', "PetService");

 require_once 'routes/UserRoutes.php';
 require_once 'routes/PetsRoutes.php';

 Flight::start();
?>
