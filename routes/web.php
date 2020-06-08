<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function ($router) {
	$router->get('category/all', 'CategoryController@show_active');
	$router->get('category/{id}/files', 'CategoryController@files_to');

	$router->group(['middleware' => 'auth'], function($router){
		$router->post('file/category', 'CategoryController@insert_file');
		$router->put('file/rename', 'FileController@rename_name');
		$router->delete('file/category', 'CategoryController@delete_file');
		
	});
});



