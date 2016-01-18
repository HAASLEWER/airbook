<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

    /**
     * Home Page
     */
    Route::get('/', function () {
        return view('home');
    });  

    /**
     * Authentication route for Laravel
     */
    Route::auth();

    // Ticket routes
    Route::get('/tickets', 'TicketController@index');
    Route::get('/tickets/profile', 'TicketController@userTickets');
    Route::post('/tickets/profile', 'TicketController@userSearch');
    Route::post('/tickets', 'TicketController@search');    
    Route::get('/tickets/create', 'TicketController@create');
    Route::post('/ticket', 'TicketController@store');
    Route::delete('/ticket/{ticket}', 'TicketController@destroy');    

    // Scraper routes
    Route::get('/scraper', function() {
        return view('scraper');
    });
});
