<?php

namespace App\Repositories;

use App\Models\website;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class websiteRepository
 * @package App\Repositories
 * @version August 30, 2018, 4:38 am UTC
 *
 * @method website findWithoutFail($id, $columns = ['*'])
 * @method website find($id, $columns = ['*'])
 * @method website first($columns = ['*'])
*/
class websiteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return website::class;
    }
}
