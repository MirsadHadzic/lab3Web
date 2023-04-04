<?php

//Import and register your DAO class, to be able to call it within routes.

require '../vendor/autoload.php';
require 'dao/UserDao.class.php';


Flight::register('userDao', 'UserDao');

/**
 * Routes should be defined to call the DAO methods, 
 * pass data to them and return the results. Each route needs to 
 * specify the type of the request, the URL of the endpoint, and 
 * the function to be executed once the route is called. 
 * Passing parameters through these endpoints can be done using 
 * named parameters in the URL, or as an HTTP request body.
 */

// routes will go here
Flight::route('GET /api/users', function(){
    Flight::json(Flight::userDao()->getUsers());
});


Flight::route('GET /api/users/@id', function($id){
    Flight::json(Flight::userDao()->getUserById($id));
});


Flight::route('POST /api/users', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::userDao()->addUser($data));
});


Flight::route('PUT /api/users/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::userDao()->updateUser($id, $data);
});

Flight::route('DELETE /api/users/@id', function($id){
    Flight::userDao()->deleteUser($id);
});


Flight::start();

?>