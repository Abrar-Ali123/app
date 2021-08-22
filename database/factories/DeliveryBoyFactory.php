<?php

/** @var Factory $factory */
namespace Database\Factories;

use App\Models\DeliveryBoy;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class DeliveryBoyFactory extends Factory
{
    protected $model = DeliveryBoy::class;
    public function definition()
    {
        return [
            'name' => "Delivery Boy",
            'email' => "delivery.boy@demo.com",
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'avatar_url'=>'delivery_boy_avatars/bNEyxpdFCaTo4VXB0Y1JPH5MXhS0bmIVQGopESZl.jpeg'
        ];
    }
}
