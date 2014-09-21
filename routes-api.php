<?php

Route::api(['version' => 'v1', 'prefix' => \Config::get('core::routes.paths.api', 'api'), 'protected' => true], function () use ($namespace) {
    $namespace .= '\Api\V1';

    Route::group(['prefix' => 'qdb'], function () use ($namespace) {

        Route::group(['prefix' => 'search'], function () use ($namespace) {
            Route::post('byId', ['uses' => $namespace.'\ReadController@postFindById']);
        });

        Route::group(['prefix' => 'vote/{quote_id}'], function () use ($namespace) {
            Route::post('up', ['uses' => $namespace.'\ModifyController@postVoteUp']);
            Route::post('down', ['uses' => $namespace.'\ModifyController@postVoteDown']);
        });

        Route::post('random', ['uses' => $namespace.'\ReadController@postFindRandom']);
        Route::post('create', ['uses' => $namespace.'\ModifyController@postCreateQuote']);
    });
});

Route::group(['prefix' => \Config::get('core::routes.paths.api', 'api')], function () use ($namespace) {
    $namespace .= '\Module';

    Route::group(['prefix' => 'qdb'], function () use ($namespace) {
        Route::get('/', ['as' => 'darchoods.qdb.apidoc', 'uses' => $namespace.'\ApiController@getApi']);
    });
});
