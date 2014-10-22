<?php

$namespace = 'Cysha\Modules\QdbServer\Controllers';

require 'routes-admin.php';
require 'routes-api.php';
require 'routes-module.php';

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

use Cysha\Modules\QdbServer\Repositories\Quote\RepositoryInterface as QuoteRepository;
use Cysha\Modules\QdbServer\Repositories\Channel\RepositoryInterface as ChannelRepository;

Route::get('qimport', function () {
    $directory = public_path().'/uploads';

    $repoQuote = new Cysha\Modules\QdbServer\Repositories\Quote\DbRepository(new Cysha\Modules\QdbServer\Models\Quote);
    $repoChannel = new Cysha\Modules\QdbServer\Repositories\Channel\DbRepository(new Cysha\Modules\QdbServer\Models\Channel);

    $file = '/#treehouse.txt';
    $contents = File::get($directory.$file);
    if (empty($contents)) {
        continue;
    }

    $channel = head(explode('.', last(explode('/', $file))));
    echo \Debug::dump($channel, 'Started Processing');

    preg_match_all('/\[(\d+)\]\s+quote\=(.*)\s+author\=(.*)/', $contents, $matches);
    unset($contents);


    $objChannel = $repoChannel->getChannel($channel);
    if (empty($objChannel)) {
        return 'Channel no found '.$channel;
    }

    foreach ($matches[0] as $key => $quote) {
        $details = [
            'quote_id'  => $matches[1][$key],
            'author_id' => $matches[3][$key],
            'content'   => $matches[2][$key],
        ];

        unset($matches[1][$key], $matches[2][$key], $matches[3][$key]);
        $repoQuote->create($objChannel, $details);
    }

    return 'Done';
});


Route::get('qupdate', function () {

    $created = [
 '3' => '2013-08-21 16:00:20',
 '4' => '2013-08-21 16:03:44',
 '3' => '2014-02-12 16:06:35',
 '5' => '2014-02-12 16:10:08',
 '6' => '2014-07-18 11:24:21',
 '1' => '2014-07-19 23:42:01',
 '7' => '2014-07-23 01:05:28',
 '8' => '2014-08-13 01:34:20',
 '9' => '2014-08-15 14:38:56',
 '9' => '2014-08-15 14:39:23',
 '10' => '2014-08-20 11:34:21',
 '11' => '2014-08-21 10:17:21',
 '12' => '2014-08-21 10:50:35',
 '13' => '2014-08-21 10:50:44',
 '14' => '2014-08-21 10:50:47',
    ];

    $channel_id = 4;
    foreach ($created as $id => $timestamp) {
        DB::table('quote_content')->where('quote_id', $id)->update(['created_at' => $timestamp]);
    }


});
