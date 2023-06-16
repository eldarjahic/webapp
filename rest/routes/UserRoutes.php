<?php


Flight::route('POST /login', function () {
  $loginRequest = Flight::request()->data->getData();
  Flight::json(Flight::user_service()->login($loginRequest));
});



?>