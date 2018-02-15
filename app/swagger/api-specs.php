<?php

/**
 * @SWG\Swagger(
 *     schemes={"http", "https"},
 *     basePath="/api",
 *     host="cure-temperature.localhost",
 *     security={
 *         {
 *             "cure_auth2": {"write:pets", "read:pets"}
 *         }
 *     },
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="Cure-Temperature APIs",
 *         description="This is Cure-Temperature server. You can use the api key `special-key` to test the authorization filters.",
 *         @SWG\Contact(
 *             email="mohammedzaki.dev@gmail.com"
 *         )
 *     )
 * )
 * 
 */
/**
 * @SWG\Parameter(
 *   parameter="userId",
 *   name="userId",
 *   description="The ID of the user",
 *   type="integer",
 *   format="int64",
 *   in="path",
 *   required=true
 * )
 * 
 * @SWG\Parameter(
 *   name="search",
 *   in="query",
 *   description="Search Criteria",
 *   required=false,type="string"
 * )
 * 
 * @SWG\Parameter(
 *   name="searchFields",
 *   in="query",
 *   description="Search Fields conditions",
 *   required=false,type="string"
 * )
 * 
 * @SWG\Parameter(
 *   name="searchJoin",
 *   in="query",
 *   description="Search Fields join conditions",
 *   required=false,type="string"
 * )
 * 
 * @SWG\Parameter(
 *   name="with",
 *   in="query",
 *   description="Search with additional data.",
 *   required=false,type="string"
 * )
 * 
 * @SWG\Response(
 *     response="device",
 *     description="successful operation",
 *     @SWG\Schema(
 *         type="object",
 *         @SWG\Property(
 *             property="success",
 *             type="boolean"
 *         ),
 *         @SWG\Property(
 *             property="data",
 *             type="array",
 *             @SWG\Items(ref="#/definitions/Device")
 *         ),
 *         @SWG\Property(
 *             property="message",
 *             type="string"
 *         )
 *     )
 * )
 * 
 */