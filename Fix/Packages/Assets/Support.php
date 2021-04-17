<?php

namespace Fix\Packages\Assets;

use Fix\Support\Support as kernelSupport;

class Support
{



    /**
     * @param null $imgname
     * @return resource
     */
    public static function loadJpg($imgname = null){

        /* Attempt to open */
        $im = @imagecreatefromjpeg($imgname);

        /* See if it failed */
        if(!$im)
        {
            /* Create a black image */
            $im  = imagecreatetruecolor(150, 30);
            $bgc = imagecolorallocate($im, 255, 255, 255);
            $tc  = imagecolorallocate($im, 0, 0, 0);

            imagefilledrectangle($im, 0, 0, 150, 30, $bgc);

            /* Output an error message */
            imagestring($im, 4, 10, 7,"IMAGES NOT FOUND", $tc);
        }

        return $im;
    }

    /**
     * @param null $imgname
     * @return resource
     */
    public static function loadPng($imgname = null){

        /* Attempt to open */
        $im = @imagecreatefrompng($imgname);

        /* See if it failed */
        if(!$im)
        {
            /* Create a blank image */
            $im  = imagecreatetruecolor(150, 30);
            $bgc = imagecolorallocate($im, 255, 255, 255);
            $tc  = imagecolorallocate($im, 0, 0, 0);

            imagefilledrectangle($im, 0, 0, 150, 30, $bgc);

            /* Output an error message */
            imagestring($im, 4, 10, 7, "IMAGES NOT FOUND", $tc);
        }

        return $im;
    }

    /**
     * @param $string
     * @return null|string|string[]
     */
    public static function removeSpace($string){

        $string = preg_replace("/\s+/", "", $string);
        $string = trim($string);
        return $string;

    }

    public static function isAssetFilter($setFile = null,$composer = false){

        return $composer ? self::removeSpace(file_get_contents($setFile,true)) : file_get_contents($setFile,true);

    }

    /**
     * @param null $setFile
     * @param bool $setLoad
     * @param bool $composer
     * @param null $data
     */
    public static function isAsset($setFile = null, $setLoad = false, $composer = false, $data = null){

        is_array($data) ? extract($data) : null;

        file_exists($setFile) ? ($setLoad ? ( !$composer ? require "$setFile" : print self::isAssetFilter($setFile,$composer))  : null) : kernelSupport::__error("FILE NOT FOUND");

    }


}