<?php namespace Cysha\Modules\Qdb\Controllers\Module;

use Cysha\Modules\Darchoods\Controllers\Module\BaseController;

class ApiController extends BaseModuleController
{

    public function __construct()
    {
        parent::__construct();
        API::user();
    }

    public function getApi()
    {
        $this->setDecorativeMode();
        $this->setTitle('QuoteDB API Documentation');

        $route = '/api/qdb';
        $api = [[
                'method'      => 'POST',
                'url'         => $route.'/random',
                'description' => 'Get a random quote from the system.',
                'vars'        => [[
                    'var'   => 'channel',
                    'value' => 'eg #darchoods',
                    'use'   => 'Channel Name.'
                ]],
            ], [
                'method'      => 'POST',
                'url'         => $route.'/create',
                'description' => 'Create a Quote for #channel.',
                'vars'        => [[
                    'var'   => 'channel',
                    'value' => 'eg #darchoods',
                    'use'   => 'Channel Name.'
                ],[
                    'var'   => 'quote',
                    'value' => '',
                    'use'   => 'The quote you want to submit.'
                ],[
                    'var'   => 'author',
                    'value' => '',
                    'use'   => 'Who submitted the quote (irc nickname).'
                ]],
            // ], [
            //     'method'      => 'POST',
            //     'url'         => $route.'/search/byAuthor',
            //     'description' => 'Get quote ID\'s by author.',
            //     'vars'        => [[
            //         'var'   => 'channel',
            //         'value' => 'eg #darchoods',
            //         'use'   => 'Channel Name.'
            //     ],[
            //         'var'   => 'author',
            //         'value' => '',
            //         'use'   => 'Who submitted the quote (irc nickname).'
            //     ]],
            ], [
                'method'      => 'POST',
                'url'         => $route.'/search/byId',
                'description' => 'Get quote ID\'s by author.',
                'vars'        => [[
                    'var'   => 'channel',
                    'value' => 'eg #darchoods',
                    'use'   => 'Channel Name.'
                ],[
                    'var'   => 'quote_id',
                    'value' => '',
                    'use'   => 'Quote ID for requested channel.'
                ]],
            ],
        ];

        $comment = 'Use the documentation below to query the quotes in the database.';
        return $this->setView('pages.api.index', [
            'api'     => $api,
            'comment' => $comment,
        ], 'module:core');
    }

}
