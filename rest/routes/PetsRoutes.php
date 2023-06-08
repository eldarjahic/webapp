<?php
/**
 * @OA\Get(path="/pets", tags={"pets"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all pets from the API. ",
 *         @OA\Response( response=200, description="List of pets.")
 * )
 */
 Flight::route("GET /pets", function(){
   
    Flight::json(Flight::pet_service()->get_all());
 });
 Flight::route("GET /pet_by_id", function(){
    
    Flight::json(Flight::pet_service()->get_by_id($id = Flight::request()->query['id']));
 });
 Flight::route("GET /pet/@id", function($id){
  
    Flight::json(Flight::pet_service()->get_by_id($id));
 });
 Flight::route("POST /pet", function(){
   
    $request = Flight::request()->data->getData();
 
    Flight::json(['message' => "Pet added successfully!", 'data' =>Flight::pet_service()->add($request)]);
 });
 Flight::route("PUT /pet/@id", function($id){
    
    $user = Flight::request()->data->getData();

    Flight::json(['message' => "Pet edit successfully!", 'data' =>Flight::pet_service()->update($user, $id)]);
 });
 Flight::route("DELETE /pet/@id", function($id){
    
    Flight::pet_service()->delete($id);
    Flight::json(['message' => "Pet deleted successfully!"]);
 });
 
 
 Flight::route("GET /pets/@name", function($name){
    echo "hello from  /users route with name=" .$name;
 });
 Flight::route("GET /pets/@name/@status", function($name, $status){
    echo "hello from  /users route with name = " . $name ." and status = " .$status  ;
 });

?>