<?php

declare(strict_types=1);

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

use App\Services\LaravelCertificateValidationService;
use App\Services\PackagistExtractor;
use App\Services\LaracastsScraper;

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/', 'DashboardController@index')->name('dashboard');

});

Route::get('/cert', function () {
    $laravelCertificationInfo = new LaravelCertificateValidationService('Bobby Bouwmann', '2018-01-26');

    echo $laravelCertificationInfo->isValid();
});

Route::get('/packagist/{vendorName}', function (PackagistExtractor $packagistExtractor, string $vendorName) {
    dd($packagistExtractor->getStatsForVendor($vendorName));
});

Route::get('/laracasts/{username}', function (LaracastsScraper $scraper, string $username) {
    return $scraper->getDataFor($username)->statistics();
});
