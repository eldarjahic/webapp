<?php
/**
 * @OA\Get(path="/pets", tags={"pets"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all pets from the API. ",
 *         @OA\Response( response=200, description="List of pets.")
 * )
 */
Flight::route("GET /pets", function () {
   Flight::json(Flight::pet_service()->get_all());
});
/**
 * @OA\Get(path="/pet_by_id", tags={"pets"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(in="query", name="id", example=1, description="Pet ID"),
 *     @OA\Response(response="200", description="Fetch individual pet")
 * )
 */
Flight::route("GET /pet_by_id", function () {
   Flight::json(Flight::pet_service()->get_by_id($id = Flight::request()->query['id']));
});
/**
 * @OA\Get(path="/pets/{id}", tags={"pets"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(in="path", name="id", example=1, description="Pet ID"),
 *     @OA\Response(response="200", description="Fetch individual pet")
 * )
 */
Flight::route("GET /pet/@id", function ($id) {
   Flight::json(Flight::pet_service()->get_by_id($id));
});
/**
 * @OA\Post(
 *     path="/pet", security={{"ApiKeyAuth": {}}},
 *     description="Add pet",
 *     tags={"students"},
 *     @OA\RequestBody(description="Add new pet", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				@OA\Property(property="name", type="varchar", example="Koko",	description="Pet name"),
 *    				@OA\Property(property="country", type="varchar", example="Croatia",	description="Pets country" ),
 *                   @OA\Property(property="weight", type="int", example="10",	description="Pets weight" ),
 *                   @OA\Property(property="age", type="int", example="8",	description="Pets age" ),
 *        )
 *     )),
 *     @OA\Response(
 *         response=200,
 *         description="Pet has been added"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error"
 *     )
 * )
 */
Flight::route("POST /pet", function () {
   $request = Flight::request()->data->getData();

   Flight::json(['message' => "Pet added successfully!", 'data' => Flight::pet_service()->add($request)]);
});
/**
 * @OA\Put(
 *     path="/pet/{id}", security={{"ApiKeyAuth": {}}},
 *     description="Edit pet",
 *     tags={"pets"},
 *     @OA\Parameter(in="path", name="id", example=1, description="Pet ID"),
 *     @OA\RequestBody(description=" info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				@OA\Property(property="name", type="varchar", example="Koko",	description="Pet name"),
 *    				@OA\Property(property="country", type="varchar", example="Croatia",	description="Pets country" ),
 *                   @OA\Property(property="weight", type="int", example="10",	description="Pets weight" ),
 *                   @OA\Property(property="age", type="int", example="8",	description="Pets age" ),
 *             )
 *       )
 *    ),
 *     @OA\Response(
 *         response=200,
 *         description="Pet has been edited"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error"
 *     )
 * )
 */
Flight::route("PUT /pet/@id", function ($id) {
   $user = Flight::request()->data->getData();

   Flight::json(['message' => "Pet edit successfully!", 'data' => Flight::pet_service()->update($user, $id)]);
});
/**
 * @OA\Delete(
 *     path="/pet/{id}", security={{"ApiKeyAuth": {}}},
 *     description="Delete pet",
 *     tags={"pets"},
 *     @OA\Parameter(in="path", name="id", example=1, description="Pet ID"),
 *     @OA\Response(
 *         response=200,
 *         description="Pet Deleted"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error"
 *     )
 * )
 */
Flight::route("DELETE /pet/@id", function ($id) {
   Flight::pet_service()->delete($id);
   Flight::json(['message' => "Pet deleted successfully!"]);
});


Flight::route("GET /pets/@name", function ($name) {
   echo "hello from  /users route with name=" . $name;
});
Flight::route("GET /pets/@name/@status", function ($name, $status) {
   echo "hello from  /users route with name = " . $name . " and status = " . $status;
});

?>