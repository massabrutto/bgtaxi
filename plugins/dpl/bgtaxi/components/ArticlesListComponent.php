<?php namespace Dpl\Bgtaxi\Components;

use Carbon\Carbon;
use Cms\Classes\ComponentBase;
use Dpl\Bgtaxi\Models\Article;
use Illuminate\Support\Facades\Cache;

class ArticlesListComponent extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'ArticlesListComponent',
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
            $obList = Article::active()->orderBy('sort_order', 'ASC')->get();
            if($obList->isEmpty()){
                return [];
            }
            foreach ($obList as $obItem) {
                $sPreviewImagePath = '';
                $obImage = $obItem->preview_image;
                if(!empty($obImage)){
                    $sPreviewImagePath = $obImage->getPath();
                }
                $sImagePath = '';
                $obImageFull = $obItem->image;
                if(!empty($obImageFull)){
                    $sImagePath = $obImageFull->getPath();
                }
                $arList[] = [
                    'preview_title' => $obItem->preview_title,
                    'preview_description' => $obItem->preview_description,
                    'slug' => $obItem->slug,
                    'preview_price' => $obItem->preview_price,
                    'preview_price_2' => $obItem->preview_price_2,
                    'start_time_preview' => $obItem->start_time_preview,
                    'preview_image' => $sPreviewImagePath,
                    'image' => $sImagePath,
                ];
            }
            return $arList;
        });

        return $arCachedList;
    }

    public function getIndexList()
    {
        $arCachedList = $this->getList();
        if(empty($arCachedList)){
            return;
        }
        if (count($arCachedList) > 2) {
            shuffle($arCachedList);
            $arResult = array_slice($arCachedList, 0, 2);
        }else{
            $arResult = $arCachedList;
        }
        return $arResult;
    }
}