<?php


namespace App\Main\Controller;


use App\Main\Model\language;
use Fix\Support\Header;
use App\Main\Model\crudModel;


class crud {


    public static function getComponent(){

        try{

            Header::checkParameter($_POST,["component","siteCode"]);
            Header::checkValue($_POST,["component","siteCode"]);

            crudModel::crudComponent(
                Header::post("component"),
                Header::post("siteCode")
            );

        }catch(\Exception $exception){

            Header::jsonResult("error","ERROR",$exception->getMessage());

        }
    }

    public static function saveCrud(){



        try{

            Header::checkParameter($_POST,["crudTitle","voboCategory","crudSlugStatus","crudCreate"]);
            Header::checkValue($_POST,["crudTitle","voboCategory","crudSlugStatus","crudCreate"]);

            $siteCrud                 = $_POST["site"];
            $titleCrud                = $_POST["crudTitle"];
            $categoryCrud             = $_POST["voboCategory"];
            $slugStatusCrud           = $_POST["crudSlugStatus"];
            $slugContentCrud          = $_POST["crudSlugContent"];
            $listing                  = 99;

            $export         = [];

            $title          = $_POST["title"];
            $name           = $_POST["name"];
            $placeholder    = $_POST["placeholder"];
            $required       = $_POST["required"];
            $table          = $_POST["table"];
            $child          = $_POST["child"];
            $component      = $_POST["component"];

            foreach ($title as $key => $item)
                $export["crud"][] = crudModel::convertComponents(
                    !empty($component[$key]) ? $component[$key] : null,
                    !empty($title[$key]) ? $title[$key] : null,
                    !empty($name[$key]) ? $name[$key] : null,
                    !empty($required[$key]) ? $required[$key] : null,
                    null,
                    !empty($table[$key]) ? $table[$key] : null,
                    !empty($placeholder[$key]) ? $placeholder[$key] : null,
                    !empty($child[$key]) ? $child[$key] : null,
                    null
                );

            $createKey = self::createUuid();

            foreach (language::$langs as $langPrefix => $langDetails){

                crudModel::newCrudRecord(
                    $createKey,
                    $siteCrud,
                    $categoryCrud,
                    $titleCrud,
                    json_encode($export,JSON_HEX_TAG),
                    $slugStatusCrud,
                    $slugContentCrud,
                    Header::post("crudCreate"),
                    $langPrefix,
                    intval($listing)
                );

            }

            Header::jsonResult("success","SUCCESS","Registration completed");

        }catch(\Exception $exception){

            Header::jsonResult("error","ERROR",$exception->getMessage());

        }



    }


    public static function editCrud(){

        try{

            Header::checkParameter($_POST,["crudTitle","voboCategory","crudSlugStatus","crudCreate","crudSite","crudModule","listing"]);
            Header::checkValue($_POST,["crudTitle","voboCategory","crudSlugStatus","crudCreate","crudSite","crudModule","listing"]);

            $titleCrud                = $_POST["crudTitle"];
            $categoryCrud             = $_POST["voboCategory"];
            $slugStatusCrud           = $_POST["crudSlugStatus"];
            $slugContentCrud          = $_POST["crudSlugContent"];

            $export         = [];

            $title          = $_POST["title"];
            $name           = $_POST["name"];
            $placeholder    = $_POST["placeholder"];
            $required       = $_POST["required"];
            $table          = $_POST["table"];
            $child          = $_POST["child"];
            $component      = $_POST["component"];
            $listing        = $_POST["listing"];


            foreach ($title as $key => $item)
                $export["crud"][] = crudModel::convertComponents(
                    !empty($component[$key]) ? $component[$key] : null,
                    !empty($title[$key]) ? $title[$key] : null,
                    !empty($name[$key]) ? $name[$key] : null,
                    !empty($required[$key]) ? $required[$key] : null,
                    null,
                    !empty($table[$key]) ? $table[$key] : null,
                    !empty($placeholder[$key]) ? $placeholder[$key] : null,
                    !empty($child[$key]) ? $child[$key] : null,
                    null
                );

            crudModel::updateCrudRecord(
                Header::post("crudModule"),
                Header::post("crudSite"),
                $categoryCrud,
                $titleCrud,
                json_encode($export,JSON_HEX_TAG),
                $slugStatusCrud,
                $slugContentCrud,
                Header::post("crudCreate"),
                $listing
            );

            Header::jsonResult("success","SUCCESS","Registration completed");

        }catch(\Exception $exception){

            Header::jsonResult("error","ERROR",$exception->getMessage());

        }



    }


    public static function createUuid(){

        return rand(1111,9999)."-".rand(11234,98764)."-".rand(1234,9876)."-".rand(11345,98762);
    }

}