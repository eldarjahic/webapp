<?php
 Flight::route("GET /users", function(){
   
    Flight::json(Flight::user_service()->get_all());
 });
 Flight::route("GET /users_by_id", function(){
    
    Flight::json(Flight::user_service()->get_by_id($id = Flight::request()->query['id']));
 });
 Flight::route("GET /users/@id", function($id){
  
    Flight::json(Flight::user_service()->get_by_id($id));
 });
 Flight::route("POST /user", function(){
   
    $request = Flight::request()->data->getData();
 
    Flight::json(['message' => "User added successfully!", 'data' =>Flight::user_service()->add($request)]);
 });
 Flight::route("PUT /user/@id", function($id){
    
    $user = Flight::request()->data->getData();

    Flight::json(['message' => "User edit successfully!", 'data' =>Flight::user_service()->update($user, $id)]);
 });
 Flight::route("DELETE /users/@id", function($id){
    
    Flight::user_service()->delete($id);
    Flight::json(['message' => "User deleted successfully!"]);
 });
 
 
 Flight::route("GET /users/@name", function($name){
    echo "hello from  /users route with name=" .$name;
 });
 Flight::route("GET /users/@name/@status", function($name, $status){
    echo "hello from  /users route with name = " . $name ." and status = " .$status  ;
 });
?>