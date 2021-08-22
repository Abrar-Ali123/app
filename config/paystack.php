<?php

return [

    /**
     * Public Key From Paystack Dashboard
     *
     */
    'publicKey' => \App\Helpers\AppSetting::$PAYSTACK_PUBLIC_KEY,

    /**
     * Secret Key From Paystack Dashboard
     *
     */
    'secretKey' => \App\Helpers\AppSetting::$PAYSTACK_SECRET_KEY,

    /**
     * Paystack Payment URL
     *
     */
    'paymentUrl' => 'https://api.paystack.co',

    /**
     * Optional email address of the merchant
     *
     */
    'merchantEmail' => \App\Helpers\AppSetting::$PAYSTACK_EMAIL_ADDRESS,

];
