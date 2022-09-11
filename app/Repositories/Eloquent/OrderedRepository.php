<?php

namespace App\Repositories\Eloquent;

use App\Models\Ordered;
use App\Repositories\Contracts\OrderedRepositoryInterface;

class OrderedRepository extends AbstractRepository implements OrderedRepositoryInterface
{
    protected $model = Ordered::class;

}
