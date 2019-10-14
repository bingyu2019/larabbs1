<?php

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/','PagesController@root')->name('root');
