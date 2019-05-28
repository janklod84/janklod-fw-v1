<?php 
/*
  |------------------------------------------------------------------
  |         WEB ROUTES OF APPLICATION
  |         In this file you can register all lists routes
  |------------------------------------------------------------------
*/

# SITE

/*
$options = [
  'path' => '/admin',
  'controller' => 'admin'
];

Route::prefix($options, function () {
    Route::get('/', 'HomeController@index', 'welcome.page');
    Route::get('/about/:slug-:id', 'HomeController@about');
    Route::get('/contact/:id', 'HomeController@contact', 'contact.me')->with('id','[0-9+]');
    Route::post('/contact', 'HomeController@contact');
});
*/


$options = [
  'path' => '/admin',
  'controller' => 'admin'
];

Route::prefix($options, function () {
    Route::get('/', 'HomeController@index', 'welcome.page');
    Route::get('/about/:slug-:id', 'HomeController@about');
    Route::get('/contact/:id', 'HomeController@contact', 'contact.me')->with('id','[0-9+]');
    Route::post('/contact', 'HomeController@contact');
});


Route::get('/', 'HomeController@index', 'welcome.page');
Route::get('/about', 'HomeController@about');
Route::get('/contact', 'HomeController@contact');
Route::post('/contact', 'HomeController@contact');