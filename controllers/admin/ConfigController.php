<?php namespace Cysha\Modules\Qdb\Controllers\Admin;

use Cysha\Modules\Core\Controllers\Admin\Config\BaseConfigController;
use URL;

class ConfigController extends BaseConfigController
{
    public function getIndex()
    {
        $this->objTheme->setTitle('Configuration Manager');
        $this->objTheme->breadcrumb()->add('QuoteDB Config', URL::route('admin.qdb.index'));

        return $this->setView('config.admin.index', array(), 'module');
    }

}
