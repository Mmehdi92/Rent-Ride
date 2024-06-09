<?php


namespace Controllers;

class ErrorController
{

    public static function  notFound($message = 'Resource not found.')
    {
        http_response_code(404);
        loadView('error', [
            'message' => $message,
            'status' => 404
        ]);
    }

    public static function unAuthorized($message = 'You are not authorized to access this resource.')
    {
        http_response_code(403);
        loadView('error', [
            'message' => $message,
            'status' => 403
        ]);
    }
    

    public function index()
    {
        loadView('404');
    }
}
