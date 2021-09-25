<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Str;

class Service extends Model
{
    use Sortable;
    
    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
        	
            $model->setAttribute($model->getKeyName(), Str::uuid());
        });
    }

    /**
     * Sortable
     *
     * @var array
     */
    public $sortable = [
        'title',
        'sorting',
    ];
}
