<?php

/**
 * @OA\Post(
 *     path="/adoption", security={{"ApiKeyAuth": {}}},
 *     description="Add adoption",
 *     tags={"adoption"},
 *     @OA\RequestBody(description="Add new adoption", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				@OA\Property(property="pet_id", type="int", example="213123", description="Pet Id"),
 *    				@OA\Property(property="user_id", type="int", example="21302131", description="Pets country" ),
 *                   @OA\Property(property="adoption_comments", type="varchar", example="This is a comment", description="Comments for the adoption" ),
 *        )
 *     )),
 *     @OA\Response(
 *         response=200,
 *         description="Addoption has been added"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error"
 *     )
 * )
 */
Flight::route("POST /adoption", function () {
    $request = Flight::request()->data->getData();
    $request['adoption_date'] = date('Y-m-d H:i:s');

    Flight::json(['message' => "Adoption successful!", 'data' => Flight::adoption_service()->add($request)]);
});