<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Random 1 trong 2 loại: Course hoặc Lesson
        $type =  $this->faker->randomElement([
            Course::class,
            Lesson::class,
        ]);

        // Tạo model tương ứng để lấy ID
        $commentable = $type::factory()->create();

        return [
            'user_id' => User::factory(),
            'content' => $this->faker->paragraph(),
            'commentable_id' => $commentable->id,
            'commentable_type' => $type,
        ];
    }
}
