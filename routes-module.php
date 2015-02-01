<?php

$namespace .= '\Module';


Route::group(['prefix' => 'qdb'], function () use ($namespace) {

    Route::group(['prefix' => '{channel}'], function () use ($namespace) {
        Route::get('{quoteid}', ['as' => 'pxcms.qdb.view', 'uses' => $namespace.'\ViewQuoteController@getQuoteById']);
        Route::get('/', ['as' => 'pxcms.qdb.channel', 'uses' => $namespace.'\ViewQuoteController@getByChannel']);
    });

    Route::get('/', ['as' => 'pxcms.qdb.index', 'uses' => $namespace.'\ViewQuoteController@getIndex']);
});
