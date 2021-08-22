<?php

namespace App\Helpers;


use Carbon\Carbon;

class DateTimeUtil
{

    public static function convertToDateTimeText($dateTime): string
    {
        return self::convertToDateText($dateTime) . " " . self::convertToTimeText($dateTime);
    }

    public static function convertToDateText($dateTime): string
    {
        return Carbon::parse($dateTime)->setTimezone(AppSetting::$timezone)->format('M d Y');
    }

    public static function convertToTimeText($dateTime): string
    {
        return Carbon::parse($dateTime)->setTimezone(AppSetting::$timezone)->format('h:i A');
    }

}

