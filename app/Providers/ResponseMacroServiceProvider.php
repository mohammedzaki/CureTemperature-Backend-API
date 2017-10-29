<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Response as ResponseClass;
use App\Exceptions\BaseException;

class ResponseMacroServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {

        $this->registerJsonException();

        $this->registerJsonSuccess();
    }

    public function registerJsonException() {
        Response::macro('jsonException', function (\Exception $exception, $http_code = ResponseClass::HTTP_INTERNAL_SERVER_ERROR) {
            $rcException = new \ReflectionClass($exception);
            if (!empty($exception->http_code)) {
                $http_code = $exception->http_code;
            }
            $errors = empty($exception->errors) ? 'Sorry, something went wrong.' : $exception->errors;
            $trace = (config('app.debug') && !($exception instanceof BaseException)) ? $exception->getTrace() : [];
            return Response::json([
                        'exception' => $rcException->getShortName(),
                        'code' => $exception->getCode(),
                        'message' => $exception->getMessage(),
                        'errors' => $errors,
                        'trace' => $trace,
                            ], $http_code);
        });
    }

    public function registerJsonSuccess() {
        Response::macro('jsonSuccess', function ($http_code = ResponseClass::HTTP_OK, $object = null, $message = "successful operation") {
            $obType = null;
            if (!is_null($object)) {
                $rc = new \ReflectionClass($object);
                $obType = $rc->getShortName();
                if ($obType == "Collection") {
                    $rc = new \ReflectionClass($object[0]);
                    $obType = "[{$rc->getShortName()}]";
                }
            }
            return Response::json([
                        'success' => true,
                        'message' => $message,
                        'returnObject' => $object,
                        'objectType' => $obType,
                            ], $http_code);
        });
    }

}
