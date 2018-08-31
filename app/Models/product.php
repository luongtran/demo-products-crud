<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class product
 * @package App\Models
 * @version August 30, 2018, 4:42 am UTC
 *
 * @property string name
 * @property integer category_id
 * @property integer website_id
 * @property string attribute
 * @property integer price
 * @property integer stock
 * @property integer weight
 */
class product extends Model
{
    use SoftDeletes;

    public $table = 'products';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'product_id',
        'category_id',
        'website_id',
        'attribute',
        'price',
        'stock',
        'weight'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'product_id' => 'string',
        'category_id' => 'integer',
        'website_id' => 'integer',
        'attribute' => 'string',
        'price' => 'integer',
        'stock' => 'integer',
        'weight' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
