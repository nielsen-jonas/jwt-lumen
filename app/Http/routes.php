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

$app->get('/', function () use ($app) {
    return $app->version();
});


$app->group(['prefix' => 'token', 'namespace' => 'App\Http\Controllers'], function () use ($app) {
	$app->get('create', 'TokenController@create');
});

$app->group(['prefix' => 'token', 'middleware' => 'JWTAuth' ,'namespace' => 'App\Http\Controllers'], function () use ($app) {
	$app->put('verify', 'TokenController@verify');
});

