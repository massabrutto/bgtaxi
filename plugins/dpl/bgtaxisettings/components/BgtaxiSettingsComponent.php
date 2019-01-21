<?php namespace Dpl\Bgtaxisettings\Components;

use Cache;
use Carbon\Carbon;
use Cms\Classes\ComponentBase;
use Cms\Classes\Content;
use Dpl\Bgtaxisettings\Models\BgtaxiSettings;

class BgtaxiSettingsComponent extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'BgtaxiSettingsComponent',
        ];
    }

    public function getContent($sKey)
    {
        if(empty($sKey)){
            return;
        }
        $sCachedValue = Cache::remember('sCachedValue' . $sKey . __CLASS__ . __METHOD__, Carbon::now()->addMonth(), function() use ($sKey){
            $sValue = BgtaxiSettings::get($sKey);
            return $sValue;
        });
        return $sCachedValue;
    }

}