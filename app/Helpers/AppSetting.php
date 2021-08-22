<?php

namespace App\Helpers;


class AppSetting
{


    static $allLanguageCode = ['en', 'es', 'fr', 'hi', 'zh'];
    static $allLanguage = ['English', 'Spanish', 'France', 'Hindi', 'Chinese'];

    static $currencySign = "$";
    static $currencyCode = "USD";

    //--- set timezone ----------//

    //static $timezone = "UTC";
    static $timezone = "GMT+5:30";


    //-------------------------- Minimum Application Version ----------------------------//
    static $MINIMUM_APPLICATION_VERSION        = 200;



    //----------------- Google Map Api Key (Set a key if you enable billing at https://developers.google.com/maps) -------------------------//
    //TODO : add your google map api key
    static $GOOGLE_MAP_API_KEY = "AIzaSyCtSAR45TFgZjOs4nBFFZnII-6mMHLfSYI";


    //--------- Stripe API (https://dashboard.stripe.com/) ----------//
    //TODO : add your own Stripe payment keys
    static $STRIPE_PUBLIC_KEY = "";
    static $STRIPE_SECRET_KEY = "";



    //--------- Razorpay API (https://dashboard.razorpay.com/app/dashboard) ----------//
    //TODO : add your own razorpay payment keys
    static $RAZORPAY_ID = "";
    static $RAZORPAY_SECRET = "";


    //--------- Pay stack API (https://dashboard.paystack.com/) ----------//
    //TODO : add your own razorpay payment keys
    static $PAYSTACK_PUBLIC_KEY = "";
    static $PAYSTACK_SECRET_KEY = "";
    static $PAYSTACK_EMAIL_ADDRESS = "paystack@coderthemes.com";



    //Firebase Cloud Messaging (FCM) Server key
    //TODO: add your own Firebase Cloud Messaging developer key
    static $FCM_SERVER_KEY = "";

}

