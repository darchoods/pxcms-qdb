<?php namespace Cysha\Modules\Qdb;

use Illuminate\Foundation\AliasLoader;
use Cysha\Modules\Core\BaseServiceProvider;
use Cysha\Modules\Qdb\Commands\InstallCommand;
use Cysha\Modules\Qdb as Module;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->registerRepositories();
        $this->registerViewComposers();
    }


    public function registerRepositories()
    {
        $this->app->bind(
            'Cysha\Modules\Qdb\Repositories\Quote\RepositoryInterface',
            'Cysha\Modules\Qdb\Repositories\Quote\DbRepository'
        );

        $this->app->bind(
            'Cysha\Modules\Qdb\Repositories\Channel\RepositoryInterface',
            'Cysha\Modules\Qdb\Repositories\Channel\DbRepository'
        );

    }

    public function registerViewComposers()
    {
        $this->app->make('view')->composer('theme.*::views/partials.theme.sidebar-*', '\Cysha\Modules\Qdb\Composers\Sidebar@channelList');
    }


}
