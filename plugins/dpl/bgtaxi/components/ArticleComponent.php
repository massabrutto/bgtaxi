<?php namespace Dpl\Bgtaxi\Components;

use Cache;
use Carbon\Carbon;
use Cms\Classes\ComponentBase;
use Dpl\Bgtaxi\Models\Article;

class ArticleComponent extends ComponentBase
{
    protected $sSlug;

    public function componentDetails()
    {
        return [
            'name' => 'ArticleComponent',
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
            $obItem = Article::active()->where('slug', $this->sSlug)->first();
            if (empty($obItem)) {
                return;
            }
            $arGallery = [];
            if(!$obItem->gallery->isEmpty()){
                foreach ($obItem->gallery as $obImage) {
                    $arGallery[] = $obImage->getPath();
                }
            }
            $sImagePath = '';
            $obTopImage = $obItem->image;
            if(!empty($obTopImage)){
                $sImagePath = $obTopImage->getPath();
            }
            $sPreviewImagePath = '';
            $obImage = $obItem->preview_image;
            if(!empty($obImage)){
                $sPreviewImagePath = $obImage->getPath();
            }
            $arItem = [
                'id' => $obItem->id,
                'slug' => $obItem->slug,
                'preview_title' => $obItem->preview_title,
                'start_time' => $obItem->start_time,
                'title' => $obItem->title,
                'price' => $obItem->price,
                'preview_description' => $obItem->preview_description,
                'description' => $obItem->description,
                'seo_item_title' => $obItem->seo_item_title,
                'seo_item_description' => $obItem->seo_item_description,
                'seo_item_keywords' => $obItem->seo_item_keywords,
                'gallery' => $arGallery,
                'image' => $sImagePath,
            ];
            return $arItem;
        });

        return $arCachedItem;
    }
}