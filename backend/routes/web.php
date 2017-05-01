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

$app->get('/start', 'GameController@start');
$app->get('/restart', 'GameController@restart');
$app->get('/history', 'GameController@getAnswerHistory');
$app->get('/download', 'GameController@downloadHistory');

$app->group(['middleware' => 'game'], function () use ($app) {
    $app->post('/check', 'GameController@checkUsedAnswer');
});