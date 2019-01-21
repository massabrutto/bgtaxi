<?php namespace Dpl\Bgtaxi\Components;

use Carbon\Carbon;
use Cms\Classes\ComponentBase;
use Dpl\Bgtaxi\Models\Transfer;
use Illuminate\Support\Facades\Cache;

class TransfersListComponent extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name' => 'TransfersListComponent',
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function getList()
    {
        $arCachedList = Cache::remember('arCachedList' . __CLASS__ . __METHOD__, Carbon::now()->addMonth(), function(){
            $arList = [];
            $obList = Transfer::active()->orderBy('sort_order', 'ASC')->get();
            if($obList->isEmpty()){
                return [];
            }
            foreach ($obList as $obItem) {
                $arList[] = [
                    'title' => $obItem->title,
                    'slug' => $obItem->slug,
                ];
            }
            return $arList;
        });
        return $arCachedList;
    }
}