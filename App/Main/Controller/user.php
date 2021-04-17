<?php
/**
 * Created by PhpStorm.
 * User: cengizakcan
 * Date: 5.05.2020
 * Time: 13:35
 */

namespace App\Main\Controller;


use App\Main\Model\apiModel;
use App\Main\Model\appModel;
use App\Main\Model\authModel;
use App\Main\Model\crudModel;
use App\Main\Model\exportImport;
use App\Main\Model\templateModel;
use App\Main\Model\menuModel;
use Fix\Packages\Database\Database;
use Fix\Support\Header;
use App\Main\Model\language;
use App\Main\Model\plugin;
use PicORM\Exception;


class user {

    public static function alluser(){

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

        templateModel::get("user/list","User Management",[
            "User Management"
        ],[
            "menuModel" => menuModel::class,
            "languageModel" => language::class,
            "crudModel" => crudModel::class
        ]);

    }


    public static function createUser(){

        try{

            Header::checkParameter($_POST,["name","surname","email","password","phone","type"]);
            Header::checkValue($_POST,["name","surname","email","password","phone","type"]);

            if(
                (
                    !plugin::check_permission($_SESSION["cms_auth_uuid"],"system_write")
                    or
                    !plugin::check_permission($_SESSION["cms_auth_uuid"],"system_settings")
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

            if(authModel::checkEmail(Header::post("email")))
                throw new \Exception("This e-mail address cannot be used");


            if(!authModel::createUser(Header::post("name"),Header::post("surname"),Header::post("email"),Header::post("phone"),Header::post("password"),Header::post("type"),json_encode($_POST["permission"]),$_SESSION["cms_auth_site"],self::createUuid()))
                throw new \Exception("Registration error");


            Header::jsonResult("success","SUCCESS","Please wait");

        }catch (\Exception $exception){

            Header::jsonResult("error","ERROR",$exception->getMessage());

        }

    }


    public static function updateUser(){

        try{

            Header::checkParameter($_POST,["name","surname","email","password","phone","type","uuid"]);
            Header::checkValue($_POST,["name","surname","email","phone","type","uuid"]);

            if(
                (
                    !plugin::check_permission($_SESSION["cms_auth_uuid"],"system_update")
                    or
                    !plugin::check_permission($_SESSION["cms_auth_uuid"],"system_settings")
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




            if(!authModel::getUserWithUuid($_SESSION["cms_auth_site"],Header::post("uuid")))
                throw new \Exception("User not found");


            if(authModel::checkEmail(Header::post("email")))
                if(authModel::checkEmail(Header::post("email"))["uuid"] !== Header::post("uuid"))
                    throw new \Exception("This e-mail address cannot be used");


           if(strlen(Header::post("password")) > 5){

               if(!authModel::updateUserWithPassword(Header::post("name"),Header::post("surname"),Header::post("email"),Header::post("phone"),Header::post("password"),Header::post("type"),json_encode($_POST["permission"]),$_SESSION["cms_auth_site"],Header::post("uuid")))
                   throw new \Exception("Update error");

           }else{

               if(!authModel::updateWithNonPassword(Header::post("name"),Header::post("surname"),Header::post("email"),Header::post("phone"),Header::post("type"),json_encode($_POST["permission"]),$_SESSION["cms_auth_site"],Header::post("uuid")))
                   throw new \Exception("Update error");

           }


            Header::jsonResult("success","SUCCESS","Please wait");

        }catch (\Exception $exception){

            Header::jsonResult("error","ERROR",$exception->getMessage());

        }

    }

    public static function deleteUser(){

        try{

            Header::checkParameter($_POST,["uuid"]);
            Header::checkValue($_POST,["uuid"]);


            if(
                (
                    !plugin::check_permission($_SESSION["cms_auth_uuid"],"system_delete")
                    or
                    !plugin::check_permission($_SESSION["cms_auth_uuid"],"system_settings")
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

            if($_SESSION["cms_auth_uuid"] === Header::post("uuid"))
                throw new \Exception("You can't delete yourself");

            if(!authModel::getUserWithUuid($_SESSION["cms_auth_site"],Header::post("uuid")))
                throw new \Exception("User not found");


            if(!authModel::deleteUserWithUuid($_SESSION["cms_auth_site"],Header::post("uuid")))
                throw new \Exception("Error deleting, please try again later");


            Header::jsonResult("success","SUCCESS","Please wait");

        }catch (\Exception $exception){

            Header::jsonResult("error","ERROR",$exception->getMessage());

        }

    }


    public static function listUser(){

        $get = [];

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


        foreach (authModel::getList($_SESSION["cms_auth_site"]) as $item){

            $get[] = [
                $item["uuid"],
                $item["name"],
                $item["surname"],
                $item["email"],
                plugin::init_type($item["user_type"]),

                date("Y-m-d",$item["time"])
            ];

        }

        Header::jsonResult("success","SUCCESS","Data is attached",$get);


    }


    public static function onlineUser(){

        $get = [];


        foreach (authModel::getList($_SESSION["cms_auth_site"]) as $item){

            if($item["lastLogin"]+3 > time())
                $get[$item["uuid"]] = "active";

        }

        Header::jsonResult("success","SUCCESS","Data is attached",$get);


    }




    public static function getUserInfo(){

        try{

            Header::checkParameter($_POST,["record"]);
            Header::checkValue($_POST,["record"]);

            $getUser  = authModel::getUser(Header::post("record"),$_SESSION["cms_auth_site"]);

            if(!$getUser){
                throw new \Exception("User not found");
            }

            Header::jsonResult("success","SUCCESS","Data is attached",[
                "uuid"          => $getUser["uuid"],
                "name"          => $getUser["name"],
                "surname"       => $getUser["surname"],
                "email"         => $getUser["email"],
                "phone"         => $getUser["phone"],
                "password"      => authModel::getUser($_SESSION["cms_auth_uuid"],$_SESSION["cms_auth_site"])["user_type"] === "admin" ?  $getUser["password"] : null,
                "type"          => $getUser["user_type"],
                "permission"    => json_decode($getUser["user_permissions"])
            ]);



        }catch (\Exception $exception){

            Header::jsonResult("error","ERROR",$exception->getMessage());

        }

    }

    public static function lastLogin(){

        try{

            $getUser  = authModel::userLastLoginUpdate($_SESSION["cms_auth_uuid"],$_SESSION["cms_auth_site"]);

            if(!$getUser){
                throw new \Exception("Session update error");
            }

            Header::jsonResult("success","SUCCESS","Session time updated");

        }catch (\Exception $exception){

            Header::jsonResult("error","ERROR",$exception->getMessage());

        }

    }


    /**
     * @return string
     */
    public static function createUuid(){

        return rand(1111,9999)."-".rand(1134,9874)."-".rand(1234,9876)."-".rand(1135,8762);
    }

}