<?php

/**
  * @SWG\Definition(
 *      definition="UesrDevicesResponse",
 *      @SWG\Property(
 *          property="account",
 *          type="object",
 *          @SWG\Schema(ref="#/definitions/Account")
 *      ),
 *      @SWG\Property(
 *          property="devices",
 *          type="array",
 *          @SWG\Items(ref="#/definitions/Device")
 *      )
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
 *             type="object",
 *             @SWG\Schema(ref="#/definitions/UesrDevicesResponse")
 *         ),
 *         @SWG\Property(
 *             property="message",
 *             type="string"
 *         )
 *     )
 * )
 * 
 * @SWG\Response(
 *     response="SuccessResponse",
 *     description="successful operation",
 *     @SWG\Schema(
 *         type="object",
 *         @SWG\Property(
 *             property="success",
 *             type="boolean"
 *         ),
 *         @SWG\Property(
 *             property="message",
 *             type="string"
 *         ),
 *         @SWG\Property(
 *             property="returnObject",
 *             type="object"
 *         ),
 *         @SWG\Property(
 *             property="objectType",
 *             type="string"
 *         )
 *     )
 * )
 * 
 * @SWG\Response(
 *     response="ExceptionResponse",
 *     description="Exception",
 *     @SWG\Schema(
 *         type="object",
 *         @SWG\Property(
 *             property="code",
 *             type="integer"
 *         ),
 *         @SWG\Property(
 *             property="exception",
 *             type="string"
 *         ),
 *         @SWG\Property(
 *             property="message",
 *             type="string"
 *         ),
 *         @SWG\Property(
 *             property="errors",
 *             type="string"
 *         ),
 *         @SWG\Property(
 *             property="trace",
 *             type="string"
 *         )
 *     )
 * )
 * 
 */