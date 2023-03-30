<?php
 require "../vendor/autoload.php";
 require "dao/usersDao.class.php";

 Flight::register('users_dao', "usersDao");

 Flight::route("GET /users", function(){
    //echo "hello from eldars / route";
    //$users_dao = new usersDao();
    //$results = Flight::users_dao()->get_all();
    //print_r($results);
    Flight::json(Flight::users_dao()->get_all());
 });
 Flight::route("GET /users_by_id", function(){
    
    Flight::json(Flight::users_dao()->get_by_id($id = Flight::request()->query['id']));
 });
 Flight::route("GET /users/@id", function($id){
    //echo "hello from eldars / route";
    //$users_dao = new usersDao();
    //$results = $users_dao->get_by_id($id);
    //print_r($results);
    Flight::json(Flight::users_dao()->get_by_id($id));
 });
 Flight::route("POST /user", function(){
    //$users_dao = new usersDao();
    $request = Flight::request()->data->getData();
    //$response = $users_dao->add($request);
    Flight::json(['message' => "User added successfully!", 'data' =>Flight::users_dao()->add($request)]);
 });
 Flight::route("PUT /user/@id", function($id){
    //$users_dao = new usersDao();
    $user = Flight::request()->data->getData();
    //$response = $users_dao->update($user, $id);
    Flight::json(['message' => "User edit successfully!", 'data' =>Flight::users_dao()->update($user, $id)]);
 });
 Flight::route("DELETE /users/@id", function($id){
    //echo "hello from eldars / route";
    //$users_dao = new usersDao();
    Flight::users_dao()->delete($id);
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
