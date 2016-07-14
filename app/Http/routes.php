<?php
Route::get('/login', ['as' => 'login', 'uses' => 'SteamController@login']);
Route::get('/logout', ['as' => 'logout', 'uses' => 'SteamController@logout']);
Route::match(['get', 'post'], '/', ['as' => 'index', 'uses' => 'GameController@currentGame']);
Route::match(['get', 'post'], '/faq', ['as' => 'faq', 'uses' => 'Pages@faq']);
Route::match(['get', 'post'], '/history', ['as' => 'history', 'uses' => 'Pages@history']);
Route::match(['get', 'post'],'/referral', ['as' => 'referral', 'uses' => 'Pages@referral']);
Route::match(['get', 'post'],'/ladder', ['as' => 'ladder', 'uses' => 'Pages@ladder']);
Route::match(['get', 'post'],'/game/{id}', ['as' => 'game', 'uses' => 'Pages@game']);

Route::any('/test', ['as' => 'test', 'uses' => 'Pages@test']);
Route::get('/postLang/{lang}', ['as' => 'postLang', 'uses' => 'Pages@postLang']);

Route::group(['middleware' => 'auth'], function () {
    Route::post('/newdeposit', 'GameController@newdeposit');
    Route::post('/my_inventory', 'Pages@myinventory');
    Route::post('/without', 'GameController@without');
    Route::post('/newbet', 'GameController@newBet');
    Route::post('/getBalance', ['as' => 'get.balance', 'uses' => 'GameController@getBalance']);
    Route::match(['get', 'post'],'/store', ['as' => 'Store', 'uses' => 'Store@index']);
    Route::post('/chat', ['as' => 'chat', 'uses' => 'ChatController@add_message']);
    Route::post('/myhistory', ['as' => 'myhistory', 'uses' => 'Pages@myhistory']);
    Route::post('/save_link', ['as' => 'settings.update', 'uses' => 'SteamController@updateSettings']);
    Route::match(['get', 'post'], '/settings', ['as' => 'settings', 'uses' => 'Pages@settings']);
    Route::post('/my_inventory_tosite', ['as' => 'my_inventory_tosite', 'uses' => 'Pages@my_inventory_tosite']);
});

Route::group(['middleware' => 'auth', 'middleware' => 'access:admin'], function () {
    Route::get('/admin', ['as' => 'admin', 'uses' => 'Admin@index']);
    Route::get('/admin/users', ['as' => 'users', 'uses' => 'Admin@users']);
    Route::get('/admin/user/{id}', ['as' => 'users', 'uses' => 'Admin@user']);
    Route::get('/admin/bots', ['as' => 'bots', 'uses' => 'Admin@bots']);
    Route::any('/admin/bot/{id}', ['as' => 'bots', 'uses' => 'Admin@bot']);
    Route::any('/admin/classconfig', ['as' => 'classconfig', 'uses' => 'Admin@classconfig']);
    Route::get('/getWinners', 'GameController@getWinners');
    Route::get('/lastwinner', 'GameController@lastwinner');
    Route::get('/newdepositapi', 'GameController@newdepositapi');
});

Route::group(['prefix' => 'api', 'middleware' => 'secretKey'], function () {
    Route::get('/lastwinner', 'GameController@lastwinner');
    Route::get('/checkOffer', 'GameController@checkOffer');
    Route::post('/setGameStatus', 'GameController@setGameStatus');
    Route::post('/setPrizeStatus', 'GameController@setPrizeStatus');
    Route::post('/getCurrentGame', 'GameController@getCurrentGame');
    Route::post('/haventescrow', 'GameController@haventescrow');
    Route::post('/getWinners', 'GameController@getWinners');
    Route::post('/getPreviousWinner', 'GameController@getPreviousWinner');
    Route::post('/newGame', 'GameController@newGame');
    Route::post('/newdeposit', 'GameController@newdepositapi');

});
