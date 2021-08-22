<?php

/** @var Factory $factory */
namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class UserFactory extends Factory
{
    protected $model = User::class;
    public function definition()
    {
        return [
            'name' => "User",
            'email' => "user@demo.com",
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'avatar_url'=>'user_avatars/bNEyxpdFCaTo4VXB0Y1JPH5MXhS0bmIVQGopESZl.jpeg'
        ];
    }
}
