<?php

$namespace = 'Cysha\Modules\QdbServer\Controllers';

require_once 'routes-admin.php';
require_once 'routes-api.php';
require_once 'routes-module.php';

use Goutte\Client;

Route::get('test', function () {
    require_once(base_path().'/goutte.phar');

    $quotes = Cache::remember('ds.quotes', 60, function () {
        $url = 'http://www.darkscience.net/quotes/all/?page=%d';

        $quotes = [];
        $client = new Client();
        foreach (range(1, 32) as $i) {
            $crawler = $client->request('GET', sprintf($url, $i));

            $j = 0;
            $crawler->filter('article > h2')->each(function ($node) use (&$quotes, $i, &$j) {
                $quotes[$i][$j++]['header'] = $node->text();
            });

            $j = 0;
            $crawler->filter('article > ul.quote')->each(function ($node) use (&$quotes, $i, &$j) {
                $quotes[$i][$j++]['content'] = $node->text();
            });

            $j = 0;
            $crawler->filter('article > p:not(.note)')->each(function ($node) use (&$quotes, $i, &$j) {
                $quotes[$i][$j++]['timestamp'] = $node->text();
            });
        }

        return $quotes;
    });

    echo \Debug::dump($quotes, '');
});
