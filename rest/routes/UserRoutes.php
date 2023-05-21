<?php


Flight::route('POST /login', function(){
    $login = Flight::request()->data->getData();
    $token = Flight::user_service()->login($login);
    Flight::json($token, 201);
    
    
});



 ?>