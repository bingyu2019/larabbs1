<?php

/*Route::get('/', function () {
    return view('welcome');
});*/

//Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'PagesController@root')->name('root');

// 用户身份验证相关的路由
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// 用户注册相关路由
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// 密码重置相关路由
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Email 认证相关路由
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');


// 注册成功后提示消息页面
Route::get('users/show','Auth\VerificationController@show')->name('users.show');

// 个人页面
Route::resource('users', 'UsersController',['only'=>['show','update','edit']]);

// 分类列表话题
Route::resource('categories', 'CategoriesController',['only'=> ['show']]);

// 编辑器上传图片路由
Route::post('upload_image', 'TopicsController@uploadImage')->name('topics.upload_image');

// 帖子路由
Route::resource('topics', 'TopicsController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
// 显示百度翻译路由
Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');

// 回复路由
//Route::resource('replies', 'RepliesController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);
Route::resource('replies', 'RepliesController', ['only' => ['create', 'store', 'update', 'edit', 'destroy']]);

// 通知列表路由
Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);

// 无权限提醒页面
Route::get('permission-denied', 'PagesController@permissionDenied')->name('permission-denied');




















