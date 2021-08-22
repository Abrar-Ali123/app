<?php
namespace Database\Factories;

use App\Models\Manager;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class ManagerFactory extends Factory
{

    protected $model = Manager::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement(["Manager","Manager2","Manager3"]),
            'email' => $this->faker->unique()->randomElement(["manager@demo.com","manager2@demo.com","manager3@demo.com"]),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'avatar_url'=>'manager_avatars/sR9ExUZQeGZaYpy3xPhdnloB3RE2qWGV65jyddRS.jpeg'
        ];
    }
}
