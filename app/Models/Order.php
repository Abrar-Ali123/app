<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed id
 * @property mixed coupon_id
 * @property mixed user_id
 * @property mixed address_id
 * @property mixed payment_type
 * @property int|mixed shop_id
 * @property mixed total
 * @property mixed delivery_fee
 * @property mixed tax
 * @property mixed order
 * @property mixed card_number
 * @property mixed coupon_discount
 * @property mixed order_payment_id
 * @property mixed longitude
 * @property mixed latitude
 * @property mixed order_type
 * @property mixed status
 * @property int|mixed otp
 * @property float|int|mixed shop_revenue
 * @property float|int|mixed admin_revenue
 * @method static find($order_id)
 * @method static where(string $string, int $ORDER_DELIVERED)
 */
class Order extends Model
{
    use HasFactory;


    public static $ORDER_CANCELLED_BY_SHOP = -2;
    public static $ORDER_CANCELLED_BY_USER = -1;
    public static $ORDER_WAIT_FOR_PAYMENT = 0;
    public static $ORDER_WAIT_FOR_CONFIRMATION = 1;
    public static $ORDER_ACCEPTED = 2;
    public static $ORDER_READY_FOR_DELIVERY = 3;
    public static $ORDER_ON_THE_WAY = 4;
    public static $ORDER_DELIVERED = 5;
    public static $ORDER_REVIEWED = 6;

    public static $ORDER_TYPE_PICKUP = 1;
    public static $ORDER_TYPE_DELIVERY = 2;

    public static $ORDER_PT_COD = 1;
    public static $ORDER_PT_RAZORPAY = 2;
    public static $ORDER_PT_PAYSTACK = 3;
    public static $ORDER_PT_STRIPE = 4;


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function address()
    {
        return $this->belongsTo(UserAddress::class);
    }

    public function productReviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function deliveryBoy()
    {
        return $this->belongsTo(DeliveryBoy::class);
    }

    public function deliveryBoyReview()
    {
        return $this->hasOne(DeliveryBoyReview::class);
    }

    public function orderPayment(): BelongsTo
    {
        return $this->belongsTo(OrderPayment::class);
    }

    static function getTextFromStatus(int $status, int $orderType)
    {
        if ($orderType == self::$ORDER_TYPE_PICKUP) {
            switch ($status) {
                case self::$ORDER_CANCELLED_BY_SHOP :
                    return __('manager.order_cancelled_by_shop');
                case self::$ORDER_CANCELLED_BY_USER:
                    return __('manager.order_cancelled_by_user');
                case self::$ORDER_WAIT_FOR_PAYMENT:
                    return __('manager.wait_for_payment');
                case self::$ORDER_WAIT_FOR_CONFIRMATION:
                    return __('manager.wait_for_confirmation');
                case self::$ORDER_ACCEPTED:
                    return __('manager.accepted_and_packaging');
                case self::$ORDER_READY_FOR_DELIVERY:
                    return __('manager.wait_for_pickup');
                case self::$ORDER_ON_THE_WAY:
                case self::$ORDER_DELIVERED:
                    return __('manager.delivered');
                case self::$ORDER_REVIEWED:
                    return __('manager.rated');
            }
        } else {
            switch ($status) {

                case self::$ORDER_CANCELLED_BY_SHOP :
                    return __('manager.order_cancelled_by_shop');
                case self::$ORDER_CANCELLED_BY_USER:
                    return __('manager.order_cancelled_by_user');
                case self::$ORDER_WAIT_FOR_PAYMENT:
                    return __('manager.wait_for_payment');
                case self::$ORDER_WAIT_FOR_CONFIRMATION:
                    return __('manager.wait_for_confirmation');
                case self::$ORDER_ACCEPTED:
                    return __('manager.accepted_and_packaging');
                case self::$ORDER_READY_FOR_DELIVERY:
                    return __('manager.wait_for_delivery_boy');
                case self::$ORDER_ON_THE_WAY:
                    return __('manager.on_the_way');
                case self::$ORDER_DELIVERED:
                    return __('manager.delivered');
                case self::$ORDER_REVIEWED:
                    return __('manager.rated');
            }
        }


        return "something wrong";
    }

    static function isPaymentConfirm(int $status): bool
    {
        return $status !=self::$ORDER_WAIT_FOR_PAYMENT;
    }

    static function getActionFromStatus(int $status, int $orderType): string
    {
        if ($orderType == self::$ORDER_TYPE_PICKUP) {
            switch ($status) {
                case self::$ORDER_ACCEPTED:
                    return __('manager.accept');
                case self::$ORDER_READY_FOR_DELIVERY:
                    return __('manager.order_is_ready');
            }
        } else {
            switch ($status) {
                case self::$ORDER_ACCEPTED:
                    return __('manager.accept');
                case self::$ORDER_READY_FOR_DELIVERY:
                    return __('manager.order_is_ready');
            }
        }
        return self::getActionFromStatus(self::$ORDER_ACCEPTED, $orderType);
    }

    static function generateGoogleMapLocationUrl($latitude, $longitude): string
    {
        return "http://maps.google.com/maps?q=$latitude+$longitude";
    }

    static function getTextFromPaymentType(int $paymentType): string
    {
        switch ($paymentType) {
            case self::$ORDER_PT_COD:
                return __('manager.cash_on_delivery');
            case self::$ORDER_PT_RAZORPAY:
                return __('manager.razorpay');
            case self::$ORDER_PT_PAYSTACK:
                return __('manager.paystack');
            case self::$ORDER_PT_STRIPE:
                return __('manager.stripe');
        }
        return self::getTextFromPaymentType(self::$ORDER_PT_COD);
    }


    static function getTextFromOrderType(int $orderType): string
    {
        switch ($orderType) {
            case 1:
                return "Pickup from shop";
            case 2:
                return "Delivery";
        }
        return "Pickup from shop";
    }

    static function isOrderTypePickup(int $orderType): bool
    {
        return $orderType == 1;
    }

    static function isOrderCompleted(int $orderStatus): bool
    {

        return $orderStatus>= self::$ORDER_DELIVERED;
    }

    static function isPaymentByRazorpay(int $paymentType): bool
    {
        return $paymentType == 2;
    }

    static function isPaymentByCOD(int $paymentType): bool
    {
        return $paymentType == self::$ORDER_PT_COD;
    }

    static function isPaymentByPaystack(int $paymentType): bool
    {
        return $paymentType == self::$ORDER_PT_PAYSTACK;
    }
  static function isPaymentByStripe(int $paymentType): bool
    {
        return $paymentType == self::$ORDER_PT_STRIPE;
    }

    static function makeSecureCardNumber(int $cardNumber)
    {
        return substr($cardNumber, -4);
    }

    static function isCancellable(int $orderStatus): bool
    {
        return $orderStatus == self::$ORDER_WAIT_FOR_PAYMENT || $orderStatus == self::$ORDER_WAIT_FOR_CONFIRMATION;
    }

    static function isCancelStatus(int $orderStatus): bool
    {
        return $orderStatus == self::$ORDER_CANCELLED_BY_USER || $orderStatus == self::$ORDER_CANCELLED_BY_SHOP;
    }

    static function isOrderReadyForDelivery(int $orderStatus): bool
    {
        return $orderStatus==self::$ORDER_READY_FOR_DELIVERY;
    }

}
