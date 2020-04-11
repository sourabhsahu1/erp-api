<?php

namespace App\Exceptions;

use App\Constants\ErrorConstants;
use Exception;
use Illuminate\Auth\AuthenticationException;

class Handler extends \Luezoid\Laravelcore\Exceptions\Handler
{
    public function render($request, Exception $exception)
    {

        $response = null;
        if ($exception instanceof AuthenticationException) {
            $response = response()->json([
                'error' => $exception->getMessage(),
                'type' => ErrorConstants::TYPE_INVALID_TOKEN_ERROR,
                'errorDetails' => $exception->getTraceAsString()
            ], 401);

        } else {
            $response = parent::render($request, $exception);
        }
        return $response;
    }

}
