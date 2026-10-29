<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function() {
    return view('app');
});

Route::get('/layouts/app-layout', function() {
    return view('layouts.app-layout');
});

Route::get('/layouts/user-layout', function() {
    return view('layouts.user-layout');
});

Route::get('/pages/homepage', function() {
    return view('pages.homepage-page');
});

Route::get('/pages/dashboard', function() {
    return view('pages.dashboard-page');
});

Route::get('/pages/register', function() {
    return view('auth.registration');
});
