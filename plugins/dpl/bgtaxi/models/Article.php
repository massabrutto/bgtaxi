<?php namespace Dpl\Bgtaxi\Models;

use Model;

/**
 * Model
 */
class Article extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sortable;

    /*
     * Validation
     */
    public $rules = [
    ];

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'dpl_bgtaxi_articles';

    protected $jsonable = ['start_time', 'start_time_preview'];

    public $attachOne = [
        'image' => 'System\Models\File',
        'preview_image' => 'System\Models\File',
    ];

    public $attachMany = [
        'gallery' => 'System\Models\File'
    ];

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}