<?php

Route::group(['prefix' => 'qdb', 'namespace' => $namespace.'\Module'], function () {

    Route::group(['prefix' => '{channel}'], function () {
        Route::get('all', ['as' => 'pxcms.qdb.all', 'uses' => 'ViewQuoteController@getByChannelInOrder']);
        Route::get('{qdb_quote_id}', ['as' => 'pxcms.qdb.view', 'uses' => 'ViewQuoteController@getQuoteById']);
        Route::get('/', ['as' => 'pxcms.qdb.channel', 'uses' => 'ViewQuoteController@getByChannel']);
    });

    Route::get('/', ['as' => 'pxcms.qdb.index', 'uses' => 'ViewQuoteController@getIndex']);
});
