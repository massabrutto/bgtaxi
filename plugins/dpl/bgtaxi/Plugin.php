<?php namespace Dpl\Bgtaxi;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents() {
        return [
            '\Dpl\Bgtaxi\Components\ArticleComponent' => 'ArticleComponent',
            '\Dpl\Bgtaxi\Components\ArticlesListComponent' => 'ArticlesListComponent',
            '\Dpl\Bgtaxi\Components\CarhireListComponent' => 'CarhireListComponent',
            '\Dpl\Bgtaxi\Components\ExcursionComponent' => 'ExcursionComponent',
            '\Dpl\Bgtaxi\Components\ExcursionsListComponent' => 'ExcursionsListComponent',
            '\Dpl\Bgtaxi\Components\InsuaranceComponent' => 'InsuaranceComponent',
            '\Dpl\Bgtaxi\Components\InsuarancesListComponent' => 'InsuarancesListComponent',
            '\Dpl\Bgtaxi\Components\TransferComponent' => 'TransferComponent',
            '\Dpl\Bgtaxi\Components\TransfersListComponent' => 'TransfersListComponent',
            '\Dpl\Bgtaxi\Components\MailComponent' => 'MailComponent',
        ];
    }

    public function registerSettings()
    {
    }
}
