<?php namespace Cysha\Modules\QdbServer;

use Illuminate\Foundation\AliasLoader;
use Cysha\Modules\Core\BaseServiceProvider;
use Cysha\Modules\QdbServer\Commands\InstallCommand;
use Cysha\Modules\QdbServer as Module;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->registerRepositories();
    }


    public function registerRepositories()
    {
        $this->app->bind(
            'Cysha\Modules\QdbServer\Repositories\Quote\RepositoryInterface',
            'Cysha\Modules\QdbServer\Repositories\Quote\DbRepository'
        );

        $this->app->bind(
            'Cysha\Modules\QdbServer\Repositories\Channel\RepositoryInterface',
            'Cysha\Modules\QdbServer\Repositories\Channel\DbRepository'
        );

    }

}
