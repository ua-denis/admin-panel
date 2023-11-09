<?php

namespace App\Contracts;

interface NewsRepositoryInterface
{
    public function paginate(int $perPage);
    public function find(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}