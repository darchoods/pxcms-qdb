<?php namespace Cysha\Modules\Qdb\Composers;

class Sidebar
{

    public function channelList($view)
    {
        $channels = with(\App::make('Cysha\Modules\Qdb\Repositories\Channel\RepositoryInterface'))->getChannels();

        $channels = $channels->filter(function ($row) {
            return ($row->channel != '#bots');
        });

        $view->with('qdbChannels', $channels->toArray());
    }
}
