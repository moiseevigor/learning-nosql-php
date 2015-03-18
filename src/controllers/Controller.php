<?php
/*
 * Controller
 */

abstract class Controller 
{
    public static function response($body)
    {
        $app = \Slim\Slim::getInstance();
        $callback = $app->request()->params('callback');

        if(!is_null($callback) && preg_match('/^[a-zA-Z0-9_\-]+$/', $callback)) {
            $body = "{$callback} ( " . json_encode($body) . " )";
        } else {
            $body = json_encode($body);
        }

        $response = $app->response();
        $response['Content-Type'] = 'application/json';
        $response->body($body);
    }
}