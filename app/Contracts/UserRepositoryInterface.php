<?php

namespace App\Contracts;

interface UserRepositoryInterface
{
    public function find(int $id);
    public function update(int $id, array $data);
    public function delete(int $id);
}