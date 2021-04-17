<?php
/**
 * Created by PhpStorm.
 * User: cengizakcan
 * Date: 26.02.2020
 * Time: 18:56
 */

namespace App\Main\Controller;

use App\Main\Model\appModel;
use App\Main\Model\authModel;
use App\Main\Model\crudModel;
use App\Main\Model\menuModel;
use App\Main\Model\nestable;
use Fix\Packages\Assets\Assets;
use App\Main\Model\templateModel;
use Fix\Packages\Database\Database;
use Fix\Support\Header;
use App\Main\Model\managementModel;
use App\Main\Model\language;
use App\Main\Model\plugin;
use PicORM\Exception;

class management {


    public static function users(){

        templateModel::get("management/dashboard","Site Management",[
            "Administration",
            "Site Management"
        ],[
            "menuModel" => menuModel::class,
            "languageModel" => language::class,
        ]);

    }

    public static function getSiteManager($siteCode = null){

        try{

            $getSite = managementModel::getSitesDetails(
                $siteCode
            );

            if(!$getSite){
                throw new \Exception("Site not found");
            }

            $getAllAuth = authModel::getAll(
                $siteCode
            );

            $export = [];

            foreach ($getAllAuth as $item){

                $export[] = [
                    $item["uuid"],
                    $item["name"],
                    $item["phone"],
                    $item["email"],
                    $item["password"],
                    date("Y-m-d", $item["time"])
                ];

            }

            Header::jsonResult("success","SUCCESS","Data are attached ...",$export);

        }catch (\Exception $exception){

            Header::jsonResult("error","ERROR",$exception->getMessage(),[]);
        }

    }

    public static function siteDashboard($code = null){

        $getSite = appModel::getSiteWithCode($code);

        if(!$getSite)
            Header::redirect("/");

        templateModel::get("management/siteDashboard",$getSite["title"],[
            "Administration",
            "Site Management",
            $getSite["title"]." (".$getSite["domain"].")"
        ],[
            "menuModel"         => menuModel::class,
            "languageModel"     => language::class,
            "code"              => $code,
            "details"           => $getSite
        ]);

    }

    public static function siteDashboardAdd($code = null){

        $siteCheck = appModel::getSiteWithManager($code,appModel::getAuthUuid());

        if(!$siteCheck)
            Header::redirect("/");


        templateModel::get("management/siteDashboardAdd","Module Creating",[
            "Module registration"
        ],[
            "menuModel" => menuModel::class,
            "languageModel" => language::class,
            "code"      => $code
        ]);

    }

    public static function getSiteModule($siteCode = null,$module = null){


        $siteCheck = appModel::getSiteWithManager($siteCode,appModel::getAuthUuid());

        if(!$siteCheck)
            Header::redirect("/");


        $getModule = crudModel::getCrud($module,$siteCode,language::$defaultLang);

        if(!$getModule)
            Header::redirect("/");

        templateModel::get("management/siteDashboardEdit","Module Edit",[
            "Module registration"
        ],[
            "menuModel"     => menuModel::class,
            "languageModel" => language::class,
            "code"          => $siteCode,
            "details"       => $getModule
        ]);

    }

    public static function getSites(){

        $get = [];

        foreach (managementModel::getSites(appModel::getAuthUuid()) as $item){

            $get[] = [
                $item["uuid"],
                $item["domain"],
                $item["title"],
                $item["author"],
                date("Y-m-d",$item["time"]),
                $item["uuid"]
            ];

        }

        Header::jsonResult("success","SUCCESS","Data is attached",$get);


    }


    public static function getCrud($siteCode = ""){

        $get = [];

        foreach (managementModel::getCrud($siteCode) as $item){

            $get[] = [
                $item["uuid"],
                $item["label"],
                $item["listing"],
                $item["operation"] === "single" ? "SINGLE" : "MULTIPLE",
                date("Y-m-d",$item["time"])
            ];

        }

        Header::jsonResult("success","SUCCESS","Data is attached",$get);


    }


    public static function siteRemove() {

        try{

            Header::checkParameter($_POST,["site"]);
            Header::checkValue($_POST,["site"]);


            if(Header::post("site") === $_SESSION["cms_auth_site"])
                throw new \Exception("You cannot delete your own site");

            $getSite = managementModel::getSitesDetails(
                Header::post("site")
            );

            if(!$getSite)
                throw new \Exception("Site not found");


            managementModel::removeDataAll(
                Header::post("site"),
                "authorities"
            );


            managementModel::removeDataAll(
                Header::post("site"),
                "crud"
            );

            managementModel::removeDataAll(
                Header::post("site"),
                "crud_contents"
            );

            managementModel::removeDataAll(
                Header::post("site"),
                "menu_categories"
            );

            managementModel::removeDataAll(
                Header::post("site"),
                "menu_items"
            );

            managementModel::removeDataAll(
                Header::post("site"),
                "sites",
                "uuid"
            );


            Header::jsonResult("success","SUCCESS","Site deleted with all its data");




        }catch (\Exception $exception){
            Header::jsonResult("error","ERROR",$exception->getMessage());
        }


    }


    public static function ajaxAdd() {

        try{


            Header::checkParameter($_POST,["domain","title","author","logo","record_limit"]);
            Header::checkValue($_POST,["domain","title","author","logo","record_limit"]);

            if(!is_numeric(Header::post("record_limit")))
                throw new \Exception("The record limit must be number.");
 
            managementModel::siteAdd(
                appModel::getAuthUuid(),
                self::createUuid(),
                Header::post("domain"),
                Header::post("title"),
                Header::post("author"),
                Header::post("logo"),
                Header::post("record_limit")
            );

            Header::jsonResult("success","SUCCESS","Site Saved");

        }catch (\Exception $exception){
            Header::jsonResult("error","ERROR",$exception->getMessage());
        }

    }



    public static function ajaxEdit() {

        try{

            Header::checkParameter($_POST,["domain","title","author","logo","uuid","record_limit"]);
            Header::checkValue($_POST,["domain","title","author","logo","uuid"]);

            managementModel::siteUpdate(
                Header::post("uuid"),
                Header::post("domain"),
                Header::post("title"),
                Header::post("author"),
                Header::post("logo"),
                isset($_POST["plugins"]) ? json_encode($_POST["plugins"]) : "[]",
                Header::post("record_limit")
            );

            Header::jsonResult("success","SUCCESS","Site Updated");




        }catch (\Exception $exception){
            Header::jsonResult("error","ERROR",$exception->getMessage());
        }

    }


    public static function authoritiesAdd() {

        try{

            Header::checkParameter($_POST,["name","surname","phone","password","eMail","siteCode"]);
            Header::checkValue($_POST,["name","surname","phone","password","eMail","siteCode"]);


            if(!managementModel::authAdd(
                self::createUuid(),
                Header::post("name"),
                Header::post("surname"),
                Header::post("phone"),
                Header::post("eMail"),
                Header::post("password"),
                Header::post("siteCode"),
                "active"
            )) throw new \Exception("Registration failed");

            Header::jsonResult("success","SUCCESS","Registration Saved");


        }catch (\Exception $exception){
            Header::jsonResult("error","ERROR",$exception->getMessage());
        }

    }



    public static function authoritiesRemove() {

        try{

            Header::checkParameter($_POST,["record"]);
            Header::checkValue($_POST,["record"]);

            if(Header::post("record") === $_SESSION["cms_auth_uuid"])
                throw new \Exception("You cannot delete your own account");


            if(!managementModel::removeDataAll(
                Header::post("record"),
                "authorities",
                "uuid")) throw new \Exception("Remove failed");

            Header::jsonResult("success","SUCCESS","Removed");


        }catch (\Exception $exception){
            Header::jsonResult("error","ERROR",$exception->getMessage());
        }

    }


    public static function createUuid(){

        return rand(111,999)."-".rand(1134,9864)."-".rand(1234,9876)."-".rand(1345,9872);
    }


}