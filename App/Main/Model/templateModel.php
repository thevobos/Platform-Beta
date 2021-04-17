<?php

namespace App\Main\Model;

use Fix\Packages\Assets\Assets;

use App\Main\Model\appModel;
use voku\helper\Hooks;
use App\Main\Model\plugin;



class templateModel
{

    /**
     * @param null $file
     * @param null $title
     * @param array $parameter
     * @param array $breadcrumb
     */
    public static function get($file = null,$title = null, $breadcrumb = [] ,$parameter = [] ){

        Assets::render("template/template_v2",
            self::injectParameter(
                $parameter,
                array_merge
                (
                    [
                        "_inner_page"       => $file,
                        "breadcrumb"        => $breadcrumb,
                        "templateModel"     => templateModel::class,
                        "title"             => $title,
                        "app"               => appModel::class,
                        "hook"              => Hooks::getInstance(),
                        "pluginModel"       => plugin::class,
                    ],
                    $parameter
                )
            )
        );

    }


    /**
     * @param null $file
     * @param array $parameter
     * @return null
     */
    public static function getInner($file = null , $parameter = [] ){

        Assets::render(
            $file,
            $parameter
        );

        return null;

    }


    /**
     * @param array $parameter
     * @param array $defineParameter
     * @return array
     */
    public static function injectParameter($parameter = [], $defineParameter = []){

        return
            [
                "define"    => $defineParameter,
                "page"      => $parameter
            ];

    }


}