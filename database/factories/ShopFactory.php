<?php


namespace Database\Factories;

use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;


class ShopFactory extends Factory
{
    protected $model = Shop::class;
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description'=>"<p>Hello Description</p>",
            'email'=>$this->faker->unique()->email,
            'mobile'=>$this->faker->unique()->randomNumber(8),
            'latitude'=>$this->faker->latitude,
            'longitude'=>$this->faker->longitude,
            'address'=>$this->faker->text(25),
            'image_url'=>'shop_images/bXJPwy0GAp3KBC7OrXK7ULxmWFh0Qrdsqw1Za6hZ.jpeg',
            'default_tax'=>10,
            'delivery_fee'=>19,
            'available_for_delivery'=>false,
            'open'=>true,
        ];
    }
}
