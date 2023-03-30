<?php
 require "../vendor/autoload.php";
 require "dao/usersDao.class.php";

 Flight::route("GET /users", function(){
    //echo "hello from eldars / route";
    $users_dao = new usersDao();
    $results = $users_dao->get_all();
    //print_r($results);
    Flight::json($results);
 });
 Flight::route("GET /users/@id", function($id){
    //echo "hello from eldars / route";
    $users_dao = new usersDao();
    $results = $users_dao->get_by_id($id);
    //print_r($results);
    Flight::json($results);
 });
 Flight::route("DELETE /users/@id", function($id){
    //echo "hello from eldars / route";
    $users_dao = new usersDao();
    $results = $users_dao->delete($id);
    Flight::json(['message' => "User deleted successfully!"]);
 });
 
 
 Flight::route("GET /users/@name", function($name){
    echo "hello from  /users route with name=" .$name;
 });
 Flight::route("GET /users/@name/@status", function($name, $status){
    echo "hello from  /users route with name = " . $name ." and status = " .$status  ;
 });
 Flight::start();
?>
