<?php

namespace App\Main\Controller;

use App\Main\Model\language;
use Fix\Packages\Assets\Assets;
use Fix\Support\Header;

use App\Main\Model\authModel;

class auth {


    public static function login(){

        Assets::render("auth/login");

    }


    public static function password(){
        Assets::render("auth/password");

    }



    public static function ajaxLogin(){

        try{

            Header::checkParameter($_POST,["email","password"]);
            Header::checkValue($_POST,["email","password"]);

            if(!isset($_SERVER["REMOTE_ADDR"])){
                throw new \Exception("Your IP Address could not be determined");
            }

            $get = authModel::loginNormal(
                Header::post("email"),
                Header::post("password")
            );


            if(!$get)
                throw new \Exception("User not found");

            $_SESSION["cms_login"]              = true;

            $_SESSION["cms_auth_domain"]        = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://".$_SERVER["HTTP_HOST"];

            $_SESSION["cms_auth_email"]         = Header::post("email");

            $_SESSION["cms_aut_language"]       = language::$defaultLang;

            $_SESSION["cms_auth_password"]      = Header::post("password");

            $_SESSION["cms_auth_assets"]        = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://".$_SERVER["HTTP_HOST"];

            $_SESSION["cms_auth_site"]          = $get["siteCode"];

            $_SESSION["cms_auth_manager"]       = (($get["user_type"] === "root" ) ? true : false);

            $_SESSION["cms_auth_code"]          = $get["id"];

            $_SESSION["cms_auth_uuid"]          = $get["uuid"];

            $_SESSION["cms_auth_ip"]            = $_SERVER["REMOTE_ADDR"];

            $_SESSION["cms_auth_time"]          = time();

            $_SESSION["cms_auth_time_ex"]       = time() +  isset($_POST["remember"]) ? 18000 : 3600;

            Header::jsonResult("success","SUCCESS","Your information has been verified");

        }catch(\Exception $exception){

            Header::jsonResult("error","ERROR",$exception->getMessage());

        }

    }


}