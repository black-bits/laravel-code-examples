<?php

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
    return view('welcome');
});

Route::get('/test/cache', function () {

    /***
     *
     * If we use a service for caching like a redis instance we create a possible site wide error scenario when the instance fails.
     * Every request that contains cached data (which should be as many as possible) would fail with a 500 http error code.
     * Since the cache layer is non-essential we can catch that exception, prevent an error and still satisfy the request.
     *
     */
    try {
        $value = Cache::remember('test', $minutes = 5, function () {

            /*** workload */
            return getTimestampedDemoData();
        });

    /*** The exact exception you need to catch varies depending on the cache service and driver you use, but it's easy to test */
    } catch (\Predis\Connection\ConnectionException $e) {

        /*** it might be a good idea to log this error or trigger an alert */
        notifyAdminsOfThisErrorOrLogIt();

        /*** workload */
        $value = getTimestampedDemoData();
    }

    return Response::json($value);
});

Route::get('/test/write_connection/{id}', function ($id) {

    /***
     *
     * If we use a service for caching like a redis instance we create a possible site wide error scenario when the instance fails.
     * Every request that contains cached data (which should be as many as possible) would fail with a 500 http error code.
     * Since the cache layer is non-essential we can catch that exception, prevent an error and still satisfy the request.
     *
     */

    return Response::json(getTimestampedDemoDataViaWriteConnection($id));
});


/***
 * Versioned routes
 *
 * The routes inside the following route construct would automatically be available via the following routes
 * /v1/versioned/route
 * /v2/versioned/route
 *
 * The Controllers would also be versioned in the following name spaces
 *  App\Http\Controllers\v1
 *  App\Http\Controllers\v2
 *
 *
 */
foreach ( ["v1", "v2"] as $version) {
    Route::group(['prefix' => $version], function () use ($version) {
        Route::get("versioned/route", ['uses' => "{$version}\\ApiController@test" ]);
    });
}