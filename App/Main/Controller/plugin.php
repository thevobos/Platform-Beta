<?php
/**
 * Created by PhpStorm.
 * User: cengizakcan
 * Date: 4.05.2020
 * Time: 00:14
 */

namespace App\Main\Controller;



use App\Main\Model\crudModel;
use App\Main\Model\templateModel;
use App\Main\Model\menuModel;
use App\Main\Model\language;
use Fix\Packages\Assets\Assets;
use Fix\Support\Header;
use App\Main\Model\plugin as pluginModel;

class plugin {


    public static function view(){

       if(isset($_GET["page"])){

           $getPluginTemplateConfig = isset(pluginModel::hook()->do_action($_GET["page"].":page-title",$_REQUEST,true)[0]) ? (object)  pluginModel::hook()->do_action($_GET["page"].":page-title",$_REQUEST,true)[0] : (object) [ "title" => null, "breadcrumb" => [] ];

           templateModel::get("plugin/view", $getPluginTemplateConfig->title ,array_merge(
               [],
               $getPluginTemplateConfig->breadcrumb
           ),[
               "menuModel"     => menuModel::class,
               "languageModel" => language::class,
               "crudModel"     => crudModel::class
           ]);

       }

    }



}