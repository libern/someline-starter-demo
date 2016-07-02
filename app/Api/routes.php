<?php

/*
|--------------------------------------------------------------------------
| Application API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// v1
$api->version('v1', [
    'namespace' => 'Someline\Api\Controllers',
    'middleware' => ['api']
], function (\Dingo\Api\Routing\Router $api) {

    // Request Token for OAuth
    $api->post('oauth/access_token', function () {
        return \Response::json(\Authorizer::issueAccessToken());
    });

    /**
     * @oauth_type client_credentials
     */
    $api->group(['middleware' => ['api-auth:client'], 'providers' => ['oauth']], function (\Dingo\Api\Routing\Router $api) {
        // Rate: 100 requests per 5 minutes
        $api->group(['middleware' => ['api.throttle'], 'limit' => 100, 'expires' => 5], function (\Dingo\Api\Routing\Router $api) {

            $api->post('users', 'UsersController@store');

        });
    });

    /**
     * @oauth_type password & jwt
     */
    $api->group(['middleware' => ['api-auth:user'], 'providers' => ['oauth', 'jwt']], function (\Dingo\Api\Routing\Router $api) {

        // Rate: 100 requests per 5 minutes
        $api->group(['middleware' => ['api.throttle'], 'limit' => 100, 'expires' => 5], function (\Dingo\Api\Routing\Router $api) {

            // users
            $api->group(['prefix' => 'users'], function (\Dingo\Api\Routing\Router $api) {
                $api->get('/', 'UsersController@index');

                $api->get('/me', 'UsersController@me');

                $api->get('/{id}', 'UsersController@show');

                $api->put('/{id}', 'UsersController@update');

                $api->delete('/{id}', 'UsersController@destroy');
            });

            // posts
            $api->group(['prefix' => 'posts'], function (\Dingo\Api\Routing\Router $api) {

                $api->get('/', 'PostsController@index');
                $api->post('/', 'PostsController@store');

                $api->get('/{id}', 'PostsController@show');

                $api->put('/{id}', 'PostsController@update');

                $api->delete('/{id}', 'PostsController@destroy');

            });

        });

    });


});