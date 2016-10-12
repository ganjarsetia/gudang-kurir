<?php

namespace App\Repositories;

use App\Models\order;
use InfyOm\Generator\Common\BaseRepository;

class orderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'destination',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return order::class;
    }
}
