<?php namespace Dpl\Bgtaxisettings\Models;

use Model;

/**
 * BgtaxiSettings Model
 */
class BgtaxiSettings extends Model
{

    use \October\Rain\Database\Traits\Validation;

    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'bgtaxi_settings';

    public $settingsFields = 'fields.yaml';

    /**
     * Validation rules
     */
    public $rules = [
    ];

}