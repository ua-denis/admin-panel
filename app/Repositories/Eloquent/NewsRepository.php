<?php

namespace App\Repositories\Eloquent;

use App\Contracts\NewsRepositoryInterface;
use App\Models\News;

class NewsRepository implements NewsRepositoryInterface
{
    public function paginate(int $perPage = 10)
    {
        return News::orderBy('id', 'desc')->paginate($perPage);
    }

    public function find(int $id)
    {
        return News::findOrFail($id);
    }

    public function create(array $data)
    {
        return News::create($data);
    }

    public function update(int $id, array $data)
    {
        $news = $this->find($id);
        $news->update($data);
        return $news;
    }

    public function delete(int $id)
    {
        $news = $this->find($id);
        $news->delete();
    }
}