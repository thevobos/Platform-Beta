<?php

namespace App\Main\Controller;

use App\Main\Model\menuModel;
use App\Main\Model\nestable;
use Fix\Packages\Assets\Assets;
use App\Main\Model\templateModel;
use Fix\Support\Header;
use App\Main\Model\language;
use App\Main\Model\plugin;

class menu {


    public static function stepOne(){


        if(
            (
                !plugin::check_permission($_SESSION["cms_auth_uuid"],"system_settings")
                or
                !plugin::check_permission($_SESSION["cms_auth_uuid"],"system_read")
            )
            and
            (
                plugin::check_type($_SESSION["cms_auth_uuid"],"user")
                or
                plugin::check_type($_SESSION["cms_auth_uuid"],"api")
            )
        ){
            Header::redirect("/");

        }


        templateModel::get("menu/step1","Menu Operations",[
            "Menu Operations",
            "Step 1"
        ],[
            "menuModel" => menuModel::class,
            "languageModel" => language::class,
        ]);

    }

    public static function stepTwo($categoryCode = null){

        if(
            (
                !plugin::check_permission($_SESSION["cms_auth_uuid"],"system_settings")
                or
                !plugin::check_permission($_SESSION["cms_auth_uuid"],"system_read")
            )
            and
            (
                plugin::check_type($_SESSION["cms_auth_uuid"],"user")
                or
                plugin::check_type($_SESSION["cms_auth_uuid"],"api")
            )
        ){
            Header::redirect("/");
        }

        $get = menuModel::getCategory(
            $_SESSION["cms_auth_site"],
            $categoryCode
        );

        if(!$get){
           Header::redirect("/app/menu");
        }


        templateModel::get("menu/step2","Menu Detail",[
            "Menu Operations",
            "Step 2"
        ],[
            "menuModel" => menuModel::class,
            "categoryCode" => $categoryCode,
            "languageModel" => language::class,
        ]);

    }


    public static function removeMenuItem(){

        try{

            Header::checkParameter($_POST,["uuid"]);
            Header::checkValue($_POST,["uuid"]);


            if(
                (
                    !plugin::check_permission($_SESSION["cms_auth_uuid"],"system_settings")
                    or
                    !plugin::check_permission($_SESSION["cms_auth_uuid"],"system_delete")
                )
                and
                (
                    plugin::check_type($_SESSION["cms_auth_uuid"],"user")
                    or
                    plugin::check_type($_SESSION["cms_auth_uuid"],"api")
                )
            ){
                throw new \Exception("Unauthorized transaction");

            }

            $get = menuModel::getMenuItems(
                $_SESSION["cms_auth_site"],
                Header::post("uuid")
            );

            if(!$get){
                throw new \Exception("Menu not found");
            }

            menuModel::deleteMenuItem(
                $_SESSION["cms_auth_site"],
                Header::post("uuid")
            );

            Header::jsonResult("success","SUCCESS","Process completed");


        }catch (\Exception $exception){
            Header::jsonResult("error","ERROR",$exception->getMessage());
        }

    }

    public static function updateMenuItems(){

        try{

            Header::checkParameter($_POST,["uuid","items"]);
            Header::checkValue($_POST,["uuid","items"]);

            if(
                (
                    !plugin::check_permission($_SESSION["cms_auth_uuid"],"system_settings")
                    or
                    !plugin::check_permission($_SESSION["cms_auth_uuid"],"system_update")
                )
                and
                (
                    plugin::check_type($_SESSION["cms_auth_uuid"],"user")
                    or
                    plugin::check_type($_SESSION["cms_auth_uuid"],"api")
                )
            ){
                throw new \Exception("Unauthorized transaction");

            }

            $get = menuModel::getCategory(
                $_SESSION["cms_auth_site"],
                Header::post("uuid")
            );


            if(!$get){
                throw new \Exception("Menu not found");
            }


            nestable::save(json_decode(Header::post("items")),function ($id,$parent,$sort){

                menuModel::updateMenuItemNestable(
                    intval($sort),
                    $parent,
                    $id
                );

            });

            Header::jsonResult("success","SUCCESS","Process completed");

        }catch (\Exception $exception){
            Header::jsonResult("error","ERROR",$exception->getMessage());
        }

    }

    public static function createMenuItems(){

        try{

            Header::checkParameter($_POST,["uuid","label","sefLink"]);
            Header::checkValue($_POST,["uuid","label","sefLink"]);

            if(
                (
                    !plugin::check_permission($_SESSION["cms_auth_uuid"],"system_settings")
                    or
                    !plugin::check_permission($_SESSION["cms_auth_uuid"],"system_write")
                )
                and
                (
                    plugin::check_type($_SESSION["cms_auth_uuid"],"user")
                    or
                    plugin::check_type($_SESSION["cms_auth_uuid"],"api")
                )
            ){
                throw new \Exception("Unauthorized transaction");

            }

            $get = menuModel::getCategory(
                $_SESSION["cms_auth_site"],
                Header::post("uuid")
            );

            if(!$get){
                throw new \Exception("Menu not found");
            }


            menuModel::createMenuItem(
                $_SESSION["cms_auth_site"],
                Header::post("uuid"),
                Header::post("label"),
                Header::post("sefLink")
            );

            Header::jsonResult("success","SUCCESS","Process completed");

        }catch (\Exception $exception){
            Header::jsonResult("error","ERROR",$exception->getMessage());
        }

    }

    public static function createMenu(){

        try{

            Header::checkParameter($_POST,["label"]);
            Header::checkValue($_POST,["label"]);


            if(
                (
                    !plugin::check_permission($_SESSION["cms_auth_uuid"],"system_settings")
                    or
                    !plugin::check_permission($_SESSION["cms_auth_uuid"],"system_write")
                )
                and
                (
                    plugin::check_type($_SESSION["cms_auth_uuid"],"user")
                    or
                    plugin::check_type($_SESSION["cms_auth_uuid"],"api")
                )
            ){
                throw new \Exception("Unauthorized transaction");

            }


            menuModel::createCategory(
                $_SESSION["cms_auth_site"],
                Header::post("label")
            );

            Header::jsonResult("success","SUCCESS","Process completed");

        }catch (\Exception $exception){
            Header::jsonResult("error","ERROR",$exception->getMessage());
        }

    }

    public static function updateMenuItem(){

        try{

            Header::checkParameter($_POST,["uuid","label","sefLink","coverUpdate"]);
            Header::checkValue($_POST,["uuid","label","sefLink"]);

            if(
                (
                    !plugin::check_permission($_SESSION["cms_auth_uuid"],"system_settings")
                    or
                    !plugin::check_permission($_SESSION["cms_auth_uuid"],"system_update")
                )
                and
                (
                    plugin::check_type($_SESSION["cms_auth_uuid"],"user")
                    or
                    plugin::check_type($_SESSION["cms_auth_uuid"],"api")
                )
            ){
                throw new \Exception("Unauthorized transaction");

            }

            $get = menuModel::getMenuItems(
                $_SESSION["cms_auth_site"],
                Header::post("uuid")
            );

            if(!$get){
                throw new \Exception("Menu not found");
            }


            menuModel::updateMenuItem(
                $_SESSION["cms_auth_site"],
                Header::post("uuid"),
                [
                    "label",
                    "link",
                    "cover"
                ],
                [

                    Header::post("label"),
                    Header::post("sefLink"),
                    Header::post("coverUpdate")
                ]

            );

            Header::jsonResult("success","SUCCESS","Process completed");

        }catch (\Exception $exception){
            Header::jsonResult("error","ERROR",$exception->getMessage());
        }

    }


    public static function updateMenu(){

        try{

            Header::checkParameter($_POST,["uuid","label",]);
            Header::checkValue($_POST,["uuid","label"]);

            if(
                (
                    !plugin::check_permission($_SESSION["cms_auth_uuid"],"system_settings")
                    or
                    !plugin::check_permission($_SESSION["cms_auth_uuid"],"system_update")
                )
                and
                (
                    plugin::check_type($_SESSION["cms_auth_uuid"],"user")
                    or
                    plugin::check_type($_SESSION["cms_auth_uuid"],"api")
                )
            ){
                throw new \Exception("Unauthorized transaction");

            }

            $get = menuModel::getCategory(
                $_SESSION["cms_auth_site"],
                Header::post("uuid")
            );

            if(!$get){
                throw new \Exception("Menu not found");
            }


            menuModel::updateMenu(
                $_SESSION["cms_auth_site"],
                Header::post("uuid"),
                [
                    "label"
                ],
                [

                    Header::post("label")
                ]

            );

            Header::jsonResult("success","SUCCESS","Process completed");

        }catch (\Exception $exception){
            Header::jsonResult("error","ERROR",$exception->getMessage());
        }

    }


    public static function deleteMenu(){

        try{

            Header::checkParameter($_POST,["uuid"]);
            Header::checkValue($_POST,["uuid"]);

            if(
                (
                    !plugin::check_permission($_SESSION["cms_auth_uuid"],"system_settings")
                    or
                    !plugin::check_permission($_SESSION["cms_auth_uuid"],"system_delete")
                )
                and
                (
                    plugin::check_type($_SESSION["cms_auth_uuid"],"user")
                    or
                    plugin::check_type($_SESSION["cms_auth_uuid"],"api")
                )
            ){
                throw new \Exception("Unauthorized transaction");

            }

            $get = menuModel::getCategory(
                $_SESSION["cms_auth_site"],
                Header::post("uuid")
            );

            if(!$get){
                throw new \Exception("Menu not found");
            }

            menuModel::deleteMenu(
                $_SESSION["cms_auth_site"],
                Header::post("uuid")
            );

            menuModel::deleteMenuItemAllCategory(
                $_SESSION["cms_auth_site"],
                Header::post("uuid")
            );

            Header::jsonResult("success","SUCCESS","Process completed");

        }catch (\Exception $exception){
            Header::jsonResult("error","ERROR",$exception->getMessage());
        }

    }

}