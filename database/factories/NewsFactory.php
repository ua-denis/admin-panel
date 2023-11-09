<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    protected $model = News::class;

    public function definition()
    {
        return [
            'headline' => $this->faker->sentence(),
            'body' => $this->faker->paragraph(),
            'photo' => $this->faker->imageUrl(),
        ];
    }
}
