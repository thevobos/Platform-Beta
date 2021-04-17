<?php
/**
 * Created by PhpStorm.
 * User: cengizakcan
 * Date: 29.02.2020
 * Time: 21:26
 */

namespace App\Main\Model;


class fileModel {


    /**
     * @param $dir
     */
    public static function userAssetsCreate($dir){

        if ( !file_exists( $dir ) && !is_dir( $dir ) ) {
            mkdir( $dir , 0777, true);
        }

    }

}