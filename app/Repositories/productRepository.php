<?php

namespace App\Repositories;

use App\Models\product;
use InfyOm\Generator\Common\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Criteria\SearchProductNameCriteria;
use App\Criteria\SearchProductIdCriteria;

/**
 * Class productRepository
 * @package App\Repositories
 * @version August 30, 2018, 4:42 am UTC
 *
 * @method product findWithoutFail($id, $columns = ['*'])
 * @method product find($id, $columns = ['*'])
 * @method product first($columns = ['*'])
*/
class productRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'category_id',
        'website_id',
        'attribute',
        'price',
        'stock',
        'weight'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return product::class;
    }

     public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
        $this->pushCriteria(SearchProductIdCriteria::class);
        $this->pushCriteria(SearchProductNameCriteria::class);
    }
}
