<?php

namespace Database\Factories;

use App\Models\Livro;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LivroFactory extends Factory
{
    protected $model = Livro::class;

    public function definition()
    {
        return [
			'nome' => $this->faker->name,
			'ibsn' => $this->faker->name,
			'descricao' => $this->faker->name,
        ];
    }
}
