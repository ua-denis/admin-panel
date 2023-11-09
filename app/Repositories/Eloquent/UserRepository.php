<?php

namespace App\Repositories\Eloquent;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function find(int $id): User
    {
        return User::findOrFail($id);
    }


    public function update(int $id, array $data): User
    {
        $user = $this->find($id);
        $user->update($data);
        return $user;
    }

    public function delete(int $id): void
    {
        $user = $this->find($id);
        $user->delete();
    }
}