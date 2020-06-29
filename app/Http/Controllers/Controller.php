<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /* Create an Array with the response, msg and code for return as a Json object*/
    protected function JsonResponse(string $msg, int $code = 200, array $data = null, $error = null) {
        $response = [
            "success"   => $error ? False : True,
            "msg"       => $msg,
            "error"     => $error,
            "code"      => $code,
            "data"      => $data
        ];

        return response()->json($response, $code);
    }
}
