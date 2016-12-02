<?php
use App\User;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Api\Controllers'], function ($api) {
        $api->get('/login', 'LoginController@index');
        $api->get('/toke', 'AuthController@authenticate');
        $api->get('/code', 'LoginController@code');

        $api->post('/user/orderSave', 'UserPostController@orderSave');
        $api->post('/user/carNum', 'UserPostController@carNum');
        $api->post('/user/price', 'UserPostController@price');
        
        $api->group(['middleware' => 'jwt.api.auth'], function ($api) {
             $api->get('logout', 'AuthController@logout');
             $api->get('test', 'LoginController@test');
        });
    });
});
