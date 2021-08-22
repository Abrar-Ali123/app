<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\DeliveryBoy;
use App\Models\Manager;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductItem;
use App\Models\ProductItemFeature;
use App\Models\Shop;
use App\Models\ShopCoupon;
use App\Models\SubCategory;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                'name' => "Admin",
                'email' => "admin@demo.com",
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'avatar_url' => 'admin_avatars/1.jpeg'
            ]
        ];

        $users = [
            [
                'name' => "User 1",// William Clark
                'email' => "user@demo.com",
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'avatar_url' => 'user_avatars/1.jpeg',
                'mobile'=>"+918469435337",
                "mobile_verified"=>true
            ],
            [
                'avatar_url' => 'user_avatars/2.jpeg',
                'name' => "User 2", // James Perez
                'email' => "user2@demo.com",
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'mobile'=>"+918469435336",
                "mobile_verified"=>true
            ],
            [
                'name' => "User 3",// Olivia Austin
                'email' => "user3@demo.com",
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'avatar_url' => 'user_avatars/3.jpeg',
                'mobile'=>"+918469435335",
                "mobile_verified"=>true
            ],
            [
                'name' => "User 4",// Hannah Wilson
                'email' => "user4@demo.com",
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'avatar_url' => 'user_avatars/4.jpeg',
                'mobile'=>"+918469435334",
                "mobile_verified"=>true
            ],
            [
                'name' => "User 5",// Henry Martin
                'email' => "user5@demo.com",
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'avatar_url' => 'user_avatars/5.jpeg',

            ],

        ];

        $deliveryBoys = [
            [
                'name' => "Delivery Boy 1",// Charles Jones
                'email' => "delivery.boy@demo.com",
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'avatar_url' => 'delivery_boy_avatars/1.jpeg',
                'latitude' => 37.421104,
                'longitude' => -122.086951,
                'mobile'=>"+918469435337",
                "mobile_verified"=>true
            ],
            [
                'name' => "Delivery Boy 2",// David Miller
                'email' => "delivery.boy2@demo.com",
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'avatar_url' => 'delivery_boy_avatars/2.jpeg',
                'mobile'=>"+918469435336",
                "mobile_verified"=>true,
                'latitude' => 37.419010,
                'longitude' => -122.077957,
            ],
            [
                'name' => "Delivery Boy 3",// John Taylor
                'email' => "delivery.boy3@demo.com",
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'avatar_url' => 'delivery_boy_avatars/3.jpg',
                'mobile'=>"+918469435335",
                "mobile_verified"=>true,
                'latitude' => 37.416797,
                'longitude' => -122.082967,
            ],
            [
                'name' => "Delivery Boy 4",// Benjamin Lopez
                'email' => "delivery.boy4@demo.com",
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'avatar_url' => 'delivery_boy_avatars/4.jpg',
                'mobile'=>"+918469435334",
                "mobile_verified"=>true,
                'latitude' => 37.415458,
                'longitude' => -122.074953,
            ],
            [
                'name' => "Delivery Boy 5",// Alexander Ray
                'email' => "delivery.boy5@demo.com",
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'avatar_url' => 'delivery_boy_avatars/5.jpg',

                'latitude' => 37.421617,
                'longitude' => -122.096288,
            ],
        ];

        $managers = [
            [
                'name' => "Manager 1", // Michael Smith
                'email' => "manager@demo.com",
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'avatar_url' => 'manager_avatars/1.jpeg',
                'mobile'=>"+918469435337",
                "mobile_verified"=>true
            ],
            [
                'name' => "Manager 2",// Nicholas Jones
                'email' => "manager2@demo.com",
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'avatar_url' => 'manager_avatars/2.jpeg',
                'mobile'=>"+918469435336",
                "mobile_verified"=>true
            ],
            [
                'name' => "Manager 3",// Ryan corner
                'email' => "manager3@demo.com",
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'avatar_url' => 'manager_avatars/3.jpeg',
                'mobile'=>"+918469435335",
                "mobile_verified"=>true
            ],
            [
                'name' => "Manager 4",// Miles White
                'email' => "manager4@demo.com",
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'avatar_url' => 'manager_avatars/4.jpeg',
                'mobile'=>"+918469435334",
                "mobile_verified"=>true
            ],
            [
                'name' => "Manager 5",// Dylan Parker
                'email' => "manager5@demo.com",
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'avatar_url' => 'manager_avatars/5.jpeg',

            ],
        ];

        $categories = [
            [
                'title' => 'Cloth',
                'description' => "The cloth category includes men’s formals, casuals, youth wear, women’s wear, sportswear, kids wear, footwear, accessories, and more...",
                'image_url' => "category_images/cloth.png",
            ],
            [
                'title' => 'Grocery',
                'description' => "grocery is primarily engaged in the retail sale of all sorts of foods and dry goods, such as tea, coffee, spices, sugar, and flour, fresh fruits and vegetables.",
                'image_url' => "category_images/grocery.png",
            ],
            [
                'title' => 'Food',
                'description' => "In the Food, category describes all type of item which human eat in daily life at breakfast, lunch, and other time. In this Category also Includes an animal food.",
                'image_url' => "category_images/food.png",
            ],
            [
                'title' => 'Cosmetics',
                'description' => "Cosmetics are a category of health and beauty products that are used to care for the face and body, or used to accentuate or change a person's appearance.",
                'image_url' => "category_images/cosmetic.png",
            ],
            [
                'title' => 'Electronic',
                'description' => "Electronics In these category sellers sell different types of machines like tv, refrigerator, oven, and some small things like headphones, mobile, device accessories.",
                'image_url' => "category_images/electronic.png",
            ],
        ];

        $subCategories = [
            [
                'title' => 'T-Shirts',
                'category_id' => "1",
            ],
            [
                'title' => 'Oils',
                'category_id' => "2",
            ],
            [
                'title' => 'Fruit',
                'category_id' => "3",
            ],
            [
                'title' => 'makeup',
                'category_id' => "4",
            ],
            [
                'title' => 'television',
                'category_id' => "5",
            ],
        ];


        $coupons = [
            [
                'code' => 'SAVE40',
                'description' => '40% off at any products with product price above $300 and get upto $800 discount',
                'offer' => 40,
                'min_order' => 300,
                'max_discount' => 800,
                'for_new_user' => true,
                'for_only_one_time' => true,
                'expired_at' => now()->addDays(2),
            ],
            [
                'code' => 'GRUB10',
                'description' => 'Buy Product with above $50 and get 10% discount upto $200',
                'offer' => 10,
                'min_order' => 50,
                'max_discount' => 200,
                'expired_at' => now()->addDays(2)
            ],
            [
                'code' => 'FLAT25',
                'description' => 'Flat 25% off on any Order with total amount greater than $100',
                'offer' => 25,
                'min_order' => 100,
                'max_discount' => 800,
                'expired_at' => now()->addDays(2)
            ],
            [
                'code' => 'GET30',
                'description' => '30% off on any Order above $500 and win discount upto $300',
                'offer' => 30,
                'min_order' => 500,
                'max_discount' => 300,
                'expired_at' => now()->addDays(2)
            ],
            [
                'code' => 'SALE50',
                'description' => '50% off at any Order above $800. Buy using code SALE50 and get upto $500 discount',
                'offer' => 50,
                'min_order' => 800,
                'max_discount' => 500,
                'expired_at' => now()->addDays(2)
            ],
            [
                'code' => 'GET20',
                'description' => 'upto 20% off at any Order above $200',
                'offer' => 20,
                'min_order' => 200,
                'max_discount' => 200,
                'expired_at' => now()->addDays(2)
            ],
            [
                'code' => 'SAVE10',
                'description' => '10% off with toal amount $50 and above on any Prduct',
                'offer' => 10,
                'min_order' => 50,
                'max_discount' => 100,
                'expired_at' => now()->addDays(2)
            ],
            [
                'code' => 'FLAT15',
                'description' => 'Get Flat 15% off on your Order $50 and above upto $100 discount',
                'offer' => 15,
                'min_order' => 50,
                'max_discount' => 100,
                'expired_at' => now()->addDays(2)
            ],
        ];


        $shops = [
            [
                'name' => "Fashion Factory",// Fashion Factory
                'description' => "<p>Fashion Factory is committed to providing each customer with the highest standard of customer service.</p><ul><li>Monday - Sunday( 9am - 10pm )</li></ul>",
                'email' => "shop@demo.com",
                'mobile' => "789654123",
                'latitude' => 37.4235492,
                'longitude' => -122.0924447,
                'address' => "Garcia Ave, Mountain View",
                'image_url' => 'shop_images/1.jpg',
                'default_tax' => 10,
                'minimum_delivery_charge' => 9,
                "delivery_cost_multiplier" => 3,
                'available_for_delivery' => true,
                'open' => true,
                'manager_id' => 1,
                "admin_commission" => 15,
                "delivery_range" => 99999999
            ],
            [
                'name' => "The Corner Store",// The Corner Store
                'description' => "<p>The Corner Store only sells quality products. You'll find brand-name groceries and produce at up to 40-70% off conventional retail prices.</p><ul><li>Monday - Saturday ( 7:00am - 9:00pm )</li><li>Sunday ( 7:00am - 1:00pm )</li></ul><p>&nbsp; The Corner Store&nbsp;providing fresh grocery delivery on the same day</p><p><br></p>",
                'email' => "shop2@demo.com",
                'mobile' => "147852369",
                'latitude' => 37.4258241,
                'longitude' => -122.0810562,
                'address' => "Bill Graham Pkwy, Mountain View",
                'image_url' => 'shop_images/2.jpg',
                'default_tax' => 15,

                'minimum_delivery_charge' => 9,
                "delivery_cost_multiplier" => 3, 'available_for_delivery' => true,
                'open' => true,
                'manager_id' => 2,
                "admin_commission" => 15,
                "delivery_range" => 99999999
            ],
            [
                'name' => "Healthy Treats",// Healthy Treats
                'description' => "<div>The Fastest Growing Food Chain with so many outlets across the mountain view. Purity is our Priority!</div><ul><li>Monday - Sunday ( 10:00am - 11:30pm )</li></ul><div>we provide Home made delicacies food. we also take Corporate lunch orders and Party/Event Orders.</div><p><br></p>",
                'email' => "shop3@demo.com",
                'mobile' => "369589147",
                'latitude' => 37.4219616,
                'longitude' => -122.067714,
                'address' => "Lomax Ln, Google Bay",
                'image_url' => 'shop_images/3.jpg',
                'default_tax' => 15,

                'minimum_delivery_charge' => 9,
                "delivery_cost_multiplier" => 3, 'available_for_delivery' => true,
                'open' => true,
                'manager_id' => 3,
                "admin_commission" => 15,
                "delivery_range" => 99999999
            ],
            [
                'name' => "Blossom Beauty",// Blossom Beauty
                'description' => "<div>Dive into the world of Blossom Beauty that's high on style &amp; higher on performance. We provide High-quality Cosmetics at the lowest price with 100% Satisfaction.&nbsp;</div><ul><li>Monday - Saturday ( 5:00am - 8:00pm)</li><li>Sunday ( Closed )</li></ul>",
                'email' => "shop4@demo.com",
                'mobile' => "1596284536",
                'latitude' => 37.423493,
                'longitude' => -122.077813,
                'address' => "454 N Shoreline Blvd, Mountain View",
                'image_url' => 'shop_images/4.jpg',
                'default_tax' => 20,

                'minimum_delivery_charge' => 9,
                "delivery_cost_multiplier" => 3, 'available_for_delivery' => true,
                'open' => true,
                'manager_id' => 4,
                "admin_commission" => 15,
                "delivery_range" => 99999999
            ],
            [
                'name' => "E-Store",// E-Store
                'description' => "<div><div>We Deal With All Electrical Equipment And services. Get all Electrical Equipment at the best price.</div></div><ul><li>Monday - Saturday ( 8:00am - 8:00pm )</li></ul><p>Multi-brand electrical products &amp; hardware at a very competitive price. We Have a good collection of common electrical and hardware items</p>",
                'email' => "shop5@demo.com",
                'mobile' => "8564251689",
                'latitude' => 37.417635,
                'longitude' => -122.077707,
                'address' => "Google Building, Mountain View",
                'image_url' => 'shop_images/5.jpg',
                'default_tax' => 8,

                'minimum_delivery_charge' => 9,
                "delivery_cost_multiplier" => 3, 'available_for_delivery' => true,
                'open' => true,
                'manager_id' => 5,
                "admin_commission" => 15,
                "delivery_range" => 99999999
            ],
        ];

        $products = [
            [
                'name' => "T-shirt Pink",
                'description' => "<ul><li>Care Instructions: Dry Clean Only</li><li>Fit Type: Regular Fit</li><li>Material: Embroidery || Colour: Pink || 100% Cotton (180 GSM, Bio-Washed, Combed, and Pre-Shrunk).</li><li>Awesome, Stylish &amp; Iconic T-shirt for Men. Latest and Trendy designs. Comfortable for all-day use with a soft feel.</li><li> Product Care Guidelines: Wash in normal water, use mild detergent, dry in shade, and turn inside out before drying tumble dry low, do not bleach.</li></ul>",
                'offer' => 20,
                'shop_id' => 1,
                'sub_category_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => "T-shirt Blue pattern",
                'description' => "<ul><li>Care Instructions: Machine Wash</li><li>Fit Type: Regular Fit</li><li>Type: Half Sleeve. Fit Type: Regular Fit. It features a comfy fit, incredible appearance, and eye-catching scenario</li><li>Colour and fabric: multi-colored soft and comfy pique fabric which is unique mingle of 100% Micro Polyester Dry Fit. its Dry Fit fabric is ultra-soft, breathable, and lightweight</li><li>This Regular Fit Round Neck t-shirt is ideal for all seasons and accurate to wear anywhere such as in the workplace, classroom, tennis or basketball court</li><li>Care guide: Fully Machine or Hand Wash and Wash in Hot/Coldwater as you wish</li></ul>",
                'offer' => 0,
                'shop_id' => 1,
                'sub_category_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => "Relaxed Jeans Jacket",
                'description' => "<ul><li>Care Instructions: machine wash</li><li>Fit Type: Slim Fit</li><li>Style: A stylish denim jacket that has a waist length. It features two pockets on the chest area.</li><li>Closure: Fits true to size. It's a slim fit jacket. This jacket has a button at the front and on the sleeves.</li><li>wash care: Wash this jacket with a mild detergent, tumble dry, or dry in shade. Do not bleach. Treat with fabric conditioners to maintain freshness.</li><li>Fabric and Styling: Denim made from twill cotton yarn. This jacket will go well with jeans in a lighter shade and a flannel shirt or a t-shirt.</li></ul><div><br></div>",
                'offer' => 15,
                'shop_id' => 1,
                'sub_category_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => "Quaker Oats",
                'description' => "<ul><li>This is a Vegetarian product.</li><li>Get great savings and a great taste with Quaker oats mega saver pack and get 500g free with a 1.5kg pack of Quaker oats</li><li>Quaker oats are made from 100 percent whole grain oats, which is a natural source of carbohydrates, protein, and dietary fiber</li><li>Garnish your wholesome bowl of oats with your favourite fruits and nuts to make it more delicious</li><li>Helps reduce the risk of high blood pressure and cholesterol</li><li>Helps maintain weight</li></ul>",
                'offer' => 10,
                'shop_id' => 2,
                'sub_category_id' => 2,
                'category_id' => 2
            ],
            [
                'name' => "Almonds Chocolate",
                'description' => "<ul><li>Weight: 200 grams</li><li>Shelf life: 9 months</li><li>Hand-sorted cocoa beans used; Customized to perfection</li><li>Package contents: Roasted 2 almond chocolate bar</li><li>Storage Instructions: Keep in a cool and dry place</li><li>Speciality: Roasted almond in chocolates bar</li></ul>",
                'offer' => 0,
                'shop_id' => 2,
                'sub_category_id' => 2,
                'category_id' => 2
            ],
            [
                'name' => "Honey",
                'description' => "<ul><li>One tablespoon of honey with warm water daily morning will help you in managing weight and reducing one size in 90days (clinically tested)</li><li>Honey is rich in antioxidants and hence will help in strengthening your immunity</li><li>Daily use of Dabur Honey with warm water in morning is proved to be good for heart health</li><li>It is a rich souce of nutrition for you and your family</li><li>It when mixed with ginger and other household ingredients is a great remedy for cough &amp; cold</li><li>Daily intake of Honey will help boost your energy and keep you active,Product cap color may vary</li></ul>",
                'offer' => 25,
                'shop_id' => 2,
                'sub_category_id' => 2,
                'category_id' => 2
            ],
            [
                'name' => "Peanut Butter",
                'description' => "<ul><li>Unsweetened | Made With Only Roasted Peanuts (100%) | No Added Sugar | No Added Salt | No Hydrogenated Oils | 100% Non-GMO | Gluten-Free | Vegan</li><li>25% Protein Per Serving Of 32 G| Rich Source Of Fibre | No Trans Fat | No Cholesterol</li><li>Good Source Of Vitamins E, B3 &amp; B6 | Rich In Minerals: Iron, Magnesium, Phosphorous, And Potassium</li><li>Oil Separation Is Natural Process, Stir Well Before Use Together With The Confidence Of Knowing Your Peanut Contains No Stabilizers Or Fillers.</li></ul>",
                'offer' => 0,
                'shop_id' => 3,
                'sub_category_id' => 3,
                'category_id' => 3
            ],
            [
                'name' => "Dry Dog Food",
                'description' => "<ul><li>Complete and balanced food with the goodness of Egg for adult dogs</li><li>Contains 22% crude protein, 10% crude fat, and 5% crude Fibre</li><li>Provides strong muscles, bones &amp; teeth, and healthier &amp; shinier coat</li><li>Also promotes Digestive Health and supports Natural Defences</li><li>Ideal for Pugs, Beagle to Labrador, Golden Retriever &amp; German shepherd</li></ul>",
                'offer' => 10,
                'shop_id' => 3,
                'sub_category_id' => 3,
                'category_id' => 3
            ],
            [
                'name' => "Herble Tea",
                'description' => "<ul><li>Traditional Recipe&nbsp; – Uses the natural ayurvedic ingredients to boost immunity in both men and women</li><li>AMLA - GILOY – TULSI – ASHWAGANDHA – Combines the most potent naturals ingredients with NO Preservatives and NO Added Sugar.</li><li>Delicious Herbal Tea - The most soothing hot beverage to boost your immunity. Mild earthy flavor (not bitter) will be a hit with your friends a family.</li><li>How To Prepare – 1. Bring Water to Boil then wait for 30 seconds, 2. Add a Tea Spoon or Immunity Tea Leaves to water and let it steep for 3-4 minutes, 3. Filter water through the leaves and drink it hot.</li></ul>",
                'offer' => 10,
                'shop_id' => 3,
                'sub_category_id' => 3,
                'category_id' => 3
            ],
            [
                'name' => "Eyeshadow Palette",
                'description' => "<ul><li>The excellent and immediate payoff with a single stroke &amp; Easily blendable eyeshadow kit.</li><li>Double coating eyeshadow makeup technology used to optimize the impact</li><li>This eyeshadow palette is meant for both, wet and dry use &amp; Foil formulas are also talc-free</li><li>Best eyeshadow palette which is free from parabens, oils, mineral oils, D5 and nano-ingredients</li><li>There might be minor colour variation between the actual product and image shown on screen due to lighting on the photography.</li></ul>",
                'offer' => 5,
                'shop_id' => 4,
                'sub_category_id' => 4,
                'category_id' => 4
            ],
            [
                'name' => "Matte Lipstick",
                'description' => "<ul><li>Superstay Matte Ink Liquid Lipstick leaves your lips with a flawless matte finish that will last for up to 16 hours</li><li>The lipstick features a unique arrow applicator for a more precise liquid lipstick application</li><li>Intensely Pigmented formula Long-Lasting and doesn't dry out lips</li><li>It is available in over 25+ super-saturated shades</li></ul>",
                'offer' => 0,
                'shop_id' => 4,
                'sub_category_id' => 4,
                'category_id' => 4
            ],
            [
                'name' => "Vanilla Fair Cream",
                'description' => "<ul><li>The skin would look fair and beautifully white.</li><li>Makes the skin smooth and gentle and gives a younger look.</li><li>Lightens and whitens the skin.</li><li>Regenerate skin cells.</li><li>Protects from inflammation and irritation happens to the skin.</li></ul>",
                'offer' => 10,
                'shop_id' => 4,
                'sub_category_id' => 4,
                'category_id' => 4
            ],
            [
                'name' => "Fully-Automatic Washing Machine",
                'description' => "<ul><li>Fully-automatic front-loading washing machine; 8.5 kg</li><li>14 wash programs; Spin Speed Options (RPM): 1400; Power Supply220-240V, Single Phase, 50 HZ; Water Supply0.3 Bar to 10 Bar; Temperature Options: Mild</li><li>Warranty: 4 years of comprehensive warranty</li><li>Aqua Energie: Water is energized by this built-in device, the filter treatment dissolves detergent better to give clothes a softer wash</li><li>9 swirl wave</li><li>Door glass shower</li></ul>",
                'offer' => 30,
                'shop_id' => 5,
                'sub_category_id' => 5,
                'category_id' => 5
            ],
            [
                'name' => "Wireless Headphone",
                'description' => "<ul><li>Superior listening experience with Pure Bass sound</li><li>Wireless Bluetooth Streaming</li><li>11 hours of playtime under optimum audio settings</li><li>Call and music controls on earcup</li><li>Flat-foldable, lightweight, and comfortable</li><li>1 year manufacturer’s warranty</li></ul>",
                'offer' => 0,
                'shop_id' => 5,
                'sub_category_id' => 5,
                'category_id' => 5
            ],
            [
                'name' => "Microwave Oven",
                'description' => "<ul><li>28L: Suitable for large families</li><li>Convection: Can be used for baking along with grilling, reheating, defrosting, and cooking</li><li>Slimfry technology: Enjoy healthier fried food without the deep fryer. Turntable Size: 318 mm</li><li>Warranty: 1 Year on Product &amp; 5 Years on Magnetron &amp; 10 years on Ceramic Cavity</li><li>Control: Touch Key Pad (Membrane) is sensitive to touch and easy to clean</li><li>Child Lock: Ensures complete safety especially for homes with small children</li></ul>",
                'offer' => 20,
                'shop_id' => 5,
                'sub_category_id' => 5,
                'category_id' => 5
            ],


        ];

        $productImages = [
            [
                'url' => 'product_images/1.png',
                'product_id' => 1
            ],
            [
                'url' => 'product_images/2.png',
                'product_id' => 2
            ],
            [
                'url' => 'product_images/3.png',
                'product_id' => 3
            ],
            [
                'url' => 'product_images/4.png',
                'product_id' => 4
            ],
            [
                'url' => 'product_images/5.png',
                'product_id' => 5
            ],
            [
                'url' => 'product_images/6.png',
                'product_id' => 6
            ],
            [
                'url' => 'product_images/7.png',
                'product_id' => 7
            ],
            [
                'url' => 'product_images/8.png',
                'product_id' => 8
            ],
            [
                'url' => 'product_images/9.png',
                'product_id' => 9
            ],
            [
                'url' => 'product_images/10.png',
                'product_id' => 10
            ],
            [
                'url' => 'product_images/11.png',
                'product_id' => 11
            ],
            [
                'url' => 'product_images/12.png',
                'product_id' => 12
            ],
            [
                'url' => 'product_images/13.png',
                'product_id' => 13
            ],
            [
                'url' => 'product_images/14.png',
                'product_id' => 14
            ],
            [
                'url' => 'product_images/15.png',
                'product_id' => 15
            ],
        ];

        $userAddresses = [
            [
                'latitude' => 37.4218855,
                'longitude' => -122.070862,
                'address' => 'A to Z Tree Nursery',
                'city' => 'Google Bay',
                'pincode' => 456789,
                'user_id' => 1
            ],
            [
                'latitude' => 37.4203822,
                'longitude' => -122.0804247,
                'address' => 'UPS Drop box',
                'city' => 'Charleston',
                'pincode' => 369852,
                'user_id' => 2
            ],
            [
                'latitude' => 37.4225616,
                'longitude' => -122.089441,
                'address' => 'Alza Vollyball Court',
                'city' => 'Googleplex',
                'pincode' => 147852,
                'user_id' => 3
            ],
            [
                'latitude' => 37.422330,
                'longitude' => -122.101335,
                'address' => 'San Antonio Rd',
                'city' => ' Palo Alto',
                'pincode' => 452033,
                'user_id' => 4
            ],
            [
                'latitude' => 37.416131,
                'longitude' => -122.092675,
                'address' => 'Rengstorff Ave',
                'city' => 'Mountain View',
                'pincode' => 240431,
                'user_id' => 5
            ],
        ];

        $shopCoupons = [
            [
                'shop_id' => 1,
                'coupon_id' => 1,
            ],
            [
                'shop_id' => 1,
                'coupon_id' => 2,
            ],
            [
                'shop_id' => 1,
                'coupon_id' => 3,
            ],
            [
                'shop_id' => 1,
                'coupon_id' => 4,
            ],

            [
                'shop_id' => 2,
                'coupon_id' => 1,
            ],
            [
                'shop_id' => 2,
                'coupon_id' => 2,
            ],
            [
                'shop_id' => 2,
                'coupon_id' => 3,
            ],

            [
                'shop_id' => 3,
                'coupon_id' => 5,
            ],
            [
                'shop_id' => 3,
                'coupon_id' => 6,
            ],

            [
                'shop_id' => 4,
                'coupon_id' => 5,
            ],
            [
                'shop_id' => 4,
                'coupon_id' => 6,
            ],

            [
                'shop_id' => 5,
                'coupon_id' => 5,
            ],
            [
                'shop_id' => 5,
                'coupon_id' => 6,
            ],
            [
                'shop_id' => 5,
                'coupon_id' => 7,
            ],
            [
                'shop_id' => 5,
                'coupon_id' => 8,
            ],


        ];


        foreach ($users as $user) {
            User::create($user);
        }
        foreach ($admins as $admin) {
            Admin::create($admin);
        }


        foreach ($managers as $manager) {
            Manager::create($manager);
        }
        foreach ($categories as $category) {
            Category::create($category);
        }
        foreach ($subCategories as $subCategory) {
            SubCategory::create($subCategory);
        }
        foreach ($coupons as $coupon) {
            Coupon::create($coupon);
        }

        foreach ($shops as $shop) {
            Shop::create($shop);
        }

        foreach ($deliveryBoys as $deliveryBoy) {
            DeliveryBoy::create($deliveryBoy);
        }

        foreach ($products as $product) {
            Product::create($product);
        }

        foreach ($productImages as $productImage) {
            ProductImage::create($productImage);
        }

        foreach ($userAddresses as $userAddress) {
            UserAddress::create($userAddress);
        }

        foreach ($shopCoupons as $shopCoupon) {
            ShopCoupon::create($shopCoupon);
        }

        for ($i = 1; $i < 16; $i++) {

            ProductItem::create([
                'price' => 100,
                'revenue' => 10,
                'quantity' => 10,
                'product_id' => $i
            ]);

            ProductItemFeature::create([
                'product_item_id' => $i,
                'feature' => "Color",
                'value' => "#ff0000"
            ]);

            ProductItemFeature::create([
                'product_item_id' => $i,
                'feature' => "Size",
                'value' => "XL"
            ]);

            ProductItemFeature::create([
                'product_item_id' => $i,
                'feature' => "Gram",
                'value' => rand(100, 700)
            ]);
        }
        for ($i = 16; $i < 31; $i++) {

            ProductItem::create([
                'price' => 80,
                'revenue' => 15,
                'quantity' => 8,
                'product_id' => ($i - 15)
            ]);

            ProductItemFeature::create([
                'product_item_id' => $i,
                'feature' => "Color",
                'value' => "#3300ff"
            ]);

            ProductItemFeature::create([
                'product_item_id' => $i,
                'feature' => "Size",
                'value' => "L"
            ]);

            ProductItemFeature::create([
                'product_item_id' => $i,
                'feature' => "Gram",
                'value' => rand(400, 1000)
            ]);
        }
    }
}
