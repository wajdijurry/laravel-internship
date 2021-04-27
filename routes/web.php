<?php



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/** @var \Illuminate\Routing\Router $router */
$router->group(['namespace' => 'App\Http\Controllers'], function () use($router) {
    $router->get('/', function (){
       return view('welcome');
    });
    $router->get('/Post', 'TestController@tahssine');
    $router->get('/testMongo', 'TestController@testMongo');
});
