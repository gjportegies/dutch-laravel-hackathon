<?php

declare(strict_types=1);

use App\Services\LaravelCertificateValidationService;

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

Route::get('/', function () {
    $laravelCertificationInfo = new LaravelCertificateValidationService('Bobby Bouwmann', '2018-01-26');

    echo $laravelCertificationInfo->isValid();
});
