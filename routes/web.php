<?php

use Illuminate\Support\Facades\Route;

// Homepage
Route::view('/', 'pages.home');

// Routes for quotes resource
Route::resource('orcamentos', 'QuoteController');

// Route for filtering quotes
Route::any('/orcamentos/search', 'QuoteController@search')->name('orcamentos.search');