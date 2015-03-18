<?php
/**
 * Hello controller
 */

class HelloController extends Controller
{
    public static function index()
    {
        Controller::response(array(
            'status' => 200,
            'message' => 'Hello index'
        ));
    }

    public static function show($name)
    {
        Controller::response(array(
            'status' => 200,
            'message' => 'Hello ' . $name
        ));
    }
}