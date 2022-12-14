<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
    public function find($id);

    public function findAll();

    public function create(array $data);

    public function update(array $data, $id);

    public function firstOrCreate(array $data);

    public function delete($id);

    public function findBy(array $criteria);

    public function findOneBy(array $criteria);

    public function paginate($pages);

}
