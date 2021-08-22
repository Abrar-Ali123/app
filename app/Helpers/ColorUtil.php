<?php
namespace App\Helpers;


class ColorUtil {

    public static function getColorFromRating($rating): string
    {
        if($rating<1.5)
            return "#fc1926";
        else if($rating<2.5)
            return "#fc1926";
        else if($rating<3.5)
            return "#ffcb2e";
        else if($rating<4.5)
            return "#35cc71";
        else
            return "#35cc71";
    }




}

