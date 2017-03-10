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

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
  $api->get('participants', 'App\Http\Controllers\ParticipantController@showAll');
  $api->post('participants', 'App\Http\Controllers\ParticipantController@create');
  $api->put('participants/{id}', 'App\Http\Controllers\ParticipantController@update');
  $api->delete('participants/{id}', 'App\Http\Controllers\ParticipantController@delete');
});

$app->group(['prefix' => 'api/'], function() use ($app) {
  $app->get('participants', [
    'as' => 'participants.index',
    'uses' => 'ParticipantController@showAll',
  ]);
  $app->post('participants', [
    'as' => 'participants.store',
    'uses' => 'ParticipantController@create',
  ]);
  $app->put('participants/{id}', [
    'as' => 'participants.update',
    'uses' => 'ParticipantController@update',
  ]);
  $app->delete('participants/{id}', [
    'as' => 'participants.delete',
    'uses' => 'ParticipantController@delete',
  ]);
});
