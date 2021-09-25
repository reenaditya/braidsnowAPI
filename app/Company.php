<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Company extends Model
{
    use Sortable;

    public $sortable = [
    	'name',
    	'address',
    	'city',
    	'zipcode',
    	'phone',
    	'gst_no'
    ];
}
