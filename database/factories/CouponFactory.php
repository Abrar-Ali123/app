<?php
namespace Database\Factories;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CouponFactory extends Factory
{
    protected $model = Coupon::class;

    public function definition()
    {
        return [
            'code'=>$this->faker->unique()->name(),
            'description'=>$this->faker->text(20),
            'offer'=>$this->faker->randomFloat(2,0,100),
            'is_activate'=>$this->faker->randomElement([true,false]),
            'expired_at'=>$this->faker->date()
        ];
    }
}

