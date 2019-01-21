<?php namespace Dpl\Bgtaxisettings;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents() {
        return [
            '\Dpl\BgtaxiSettings\Components\BgtaxiSettingsComponent' => 'BgtaxiSettingsComponent',
        ];
    }

    public function registerSettings() {
        return [
            'config' => [
                'label'       => 'Bgtaxi settings',
                'icon'        => 'icon-cogs',
                'description' => 'Manage pages content',
                'class'       => 'Dpl\BgtaxiSettings\Models\BgtaxiSettings',
                'order'       => 100
            ]
        ];
    }
}
