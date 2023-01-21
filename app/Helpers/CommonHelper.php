<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommonHelper
{
    public static function success($body){
        return response(
            $body,
            Response::HTTP_OK
        );
    }

    public static function notFound($details = '', $message = '')
    {
        $message = Response::$statusTexts[Response::HTTP_NOT_FOUND];
        return response(
            [
                'message' => $message, 'code' => Response::HTTP_NOT_FOUND, 'details' => $details
            ],
            Response::HTTP_NOT_FOUND
        );
    }

    public static function internalServerError($details = '', $message = '')
    {
        $message = Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR];
        return response(
            [
                'message' => $message, 'code' => Response::HTTP_INTERNAL_SERVER_ERROR, 'details' => $details
            ],
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }

    public static function badRequest($details = '', $message = '')
    {
        $message = Response::$statusTexts[Response::HTTP_BAD_REQUEST];
        return response(
            [
                'message' => $message, 'code' => Response::HTTP_BAD_REQUEST, 'details' => $details
            ],
            Response::HTTP_BAD_REQUEST
        );
    }

    public static function sanitizeRequest(Request $request){
        $arrayRequest = [];
        foreach ($request->all() as $key => $value) {
            $snakeCaseKey = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $key));
            $arrayRequest[$snakeCaseKey] = $value;
        }

        return $arrayRequest;
    }

    public static function created($body){
        return response(
            $body,
            Response::HTTP_CREATED
        );
    }
}
