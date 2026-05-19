<?php

namespace App\Controllers;

use Framework\Database;

class ErrorController
{


    //error404
    public static function notFound($message = 'Page Not Found')
    {
        http_response_code(404);

        loadView('error', [
            'status' => '404',
            'message' => $message
        ]);
    }


    //error403 not authorized error
    public function unauthorized($message = 'You are not authorized to view this page')
    {
        http_response_code(403);

        loadView('error', [
            'status' => '403',
            'message' => $message
        ]);
    }
}
