<?php

Route::group(['prefix' => \Config::get('core::routes.paths.admin', 'admin')], function () use ($namespace) {
    $namespace .= '\Admin';

    // URI: /admin/config
    Route::group(array('prefix' => 'config'), function () use ($namespace) {

        // URI: /admin/config/qdb/
        Route::group(array('prefix' => 'qdb'), function () use ($namespace) {
            Route::get('/', array('as' => 'admin.qdb.index',  'uses' => $namespace.'\ConfigController@getIndex', 'before' => 'permissions'));
        });

    });
});
