<?php namespace Dpl\Bgtaxi\Components;

use Carbon\Carbon;
use Cms\Classes\ComponentBase;
use Dpl\Bgtaxi\Models\Transfer;
use Illuminate\Support\Facades\Cache;

class TransferComponent extends ComponentBase
{

    protected $sSlug;

    public function componentDetails()
    {
        return [
            'name' => 'TransferComponent',
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun()
    {
        $obRouter = $this->controller->getRouter();
        $this->sSlug = $obRouter->getParameter('slug');
        if(empty($this->sSlug)) {
            return;
        }
    }

    public function getItem()
    {
        $arCachedItem = Cache::remember('arCachedItem' . $this->sSlug . __CLASS__ . __METHOD__, Carbon::now()->addMonth(), function(){
            $obItem = Transfer::active()->where('slug', $this->sSlug)->first();
            if (empty($obItem)) {
                return;
            }
            $sImagePath = '';
            $obImage = $obItem->image;
            if(!empty($obImage)){
                $sImagePath = $obImage->getPath();
            }
            $arItem = [
                'slug' => $obItem->slug,
                'title' => $obItem->title,
                'description' => $obItem->description,
                'link_text' => $obItem->link_text,
                'content' => $obItem->content,
                'image' => $sImagePath,
                'seo_item_title' => $obItem->seo_item_title,
                'seo_item_description' => $obItem->seo_item_description,
                'seo_item_keywords' => $obItem->seo_item_keywords,
            ];
            return $arItem;
        });

        return $arCachedItem;
    }

}