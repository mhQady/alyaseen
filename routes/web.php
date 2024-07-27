<?php

use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return to_route('dash.index');
})->name('home');

Route::get('lang/{lang}', function ($locale) {

    if (in_array($locale, config('app.supported_locales'))) {
        session()->put('locale', $locale);
    }

    return back();

})->name('lang');
