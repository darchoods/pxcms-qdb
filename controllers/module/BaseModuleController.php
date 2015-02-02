<?php namespace Cysha\Modules\Qdb\Controllers\Module;

use Cysha\Modules\Core\Controllers\BaseModuleController as CoreController;
use URL;
use API;
use Config;

class BaseModuleController extends CoreController
{
    public $layout = 'cols-2-right';

    public function __construct()
    {
        parent::__construct();
    }

}
