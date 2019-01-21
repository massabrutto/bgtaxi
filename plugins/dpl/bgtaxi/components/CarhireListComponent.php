<?php namespace Dpl\Bgtaxi\Components;

use Carbon\Carbon;
use Cms\Classes\ComponentBase;
use Dpl\Bgtaxi\Models\Carhire;
use Illuminate\Support\Facades\Cache;

class CarhireListComponent extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'CarhireListComponent',
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
            $obList = Carhire::active()->orderBy('sort_order', 'ASC')->get();
            if($obList->isEmpty()){
                return [];
            }
            foreach ($obList as $obItem) {
                $sImagePath = '';
                $obImage = $obItem->image;
                if(!empty($obImage)){
                    $sImagePath = $obImage->getPath();
                }
                $arList[] = [
                    'model' => $obItem->model,
                    'slug' => $obItem->slug,
                    'reg_num' => $obItem->reg_num,
                    'details' => $obItem->details,
                    'icons' => $obItem->icons,
                    'preview_image' => $sImagePath,
                ];
            }
            return $arList;
        });
        return $arCachedList;
    }
}