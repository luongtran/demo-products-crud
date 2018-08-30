<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class SearchProductIdCriteria.
 *
 * @package namespace App\Criteria;
 */
class SearchProductIdCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    protected $search;
    public function __construct($search = null){
        $this->search = $search;
    }

    public function apply($model, RepositoryInterface $repository)
    {
       $this->search  = '%'.$this->search.'%';
        if(($this->search) != ''){
            $model = $model->where('product_id', 'like', $this->search);
        }
        return $model;
    }
}
