<?php

namespace App\Main\Controller;

use App\Main\Model\apiModel;
use App\Main\Model\appModel;
use App\Main\Model\crudModel;
use App\Main\Model\exportImport;
use App\Main\Model\templateModel;
use App\Main\Model\menuModel;
use Fix\Packages\Assets\Assets;
use Fix\Packages\Database\Database;
use Fix\Support\Header;
use App\Main\Model\language;
use App\Main\Model\plugin;

use Exception;
use PDO;
use PDOException;

class app {


    public static function api(){


        if(
            !plugin::check_type($_SESSION["cms_auth_uuid"],"root") and
            !plugin::check_type($_SESSION["cms_auth_uuid"],"admin") and
            !plugin::check_type($_SESSION["cms_auth_uuid"],"root") and
            !plugin::check_type($_SESSION["cms_auth_uuid"],"api")
        ){
            Header::redirect("/");
        }


        templateModel::get("app/api","Api Management",[
            "Settings",
            "Api"
        ],[
            "menuModel"     => menuModel::class,
            "languageModel" => language::class,
            "crudModel"     => crudModel::class
        ]);

    }

    public static function settings(){

        if(
            (!plugin::check_type($_SESSION["cms_auth_uuid"],"root") and !plugin::check_type($_SESSION["cms_auth_uuid"],"root") and  !plugin::check_type($_SESSION["cms_auth_uuid"],"admin") ) and
            (!plugin::check_permission($_SESSION["cms_auth_uuid"],"system_settings"))
        ){
            Header::redirect("/");
        }

        templateModel::get("app/settings","System Management",[
            "System Management"
        ],[
            "menuModel" => menuModel::class,
            "languageModel" => language::class,
            "crudModel" => crudModel::class
        ]);

    }

    public static function apiView($crudCode = null){

        if(
            (!plugin::check_type($_SESSION["cms_auth_uuid"],"root") and !plugin::check_type($_SESSION["cms_auth_uuid"],"root") and
            !plugin::check_type($_SESSION["cms_auth_uuid"],"admin") and !plugin::check_type($_SESSION["cms_auth_uuid"],"api")  ) and
            (!plugin::check_permission($_SESSION["cms_auth_uuid"],"system_settings"))
        ){
            Header::redirect("/");
        }

        $getCrud = crudModel::getCrud(
            $crudCode,
            $_SESSION["cms_auth_site"],
            $_SESSION["cms_aut_language"]
        );

        if(!$getCrud)
            Header::redirect("not-found");

        templateModel::get("app/apiView","Api Management",[
            "Settings",
            "Api",
            $getCrud["label"]
        ],[
            "details" => $getCrud,
            "menuModel" => menuModel::class,
            "apiModel" => apiModel::class,
            "languageModel" => language::class,
            "crudModel" => crudModel::class
        ]);

    }


    public static function profile(){

        if(
            (!plugin::check_type($_SESSION["cms_auth_uuid"],"root") and
            !plugin::check_type($_SESSION["cms_auth_uuid"],"admin") and
            !plugin::check_type($_SESSION["cms_auth_uuid"],"root") ) and
            (!plugin::check_permission($_SESSION["cms_auth_uuid"],"system_settings"))
        ){
            Header::redirect("/");
        }

        templateModel::get("app/api","Profile",[
            "Profile"
        ],[
            "menuModel" => menuModel::class,
            "languageModel" => language::class,
            "crudModel" => crudModel::class
        ]);

    }

    public static function tokenAddAjax(){

        try{

            Header::checkParameter($_POST,["isRead","isWrite","isDelete","isUpdate"]);
            Header::checkValue($_POST,["isRead","isWrite","isDelete","isUpdate"]);

            if(
                (!plugin::check_type($_SESSION["cms_auth_uuid"],"root") and !plugin::check_type($_SESSION["cms_auth_uuid"],"root") and
                !plugin::check_type($_SESSION["cms_auth_uuid"],"admin") and !plugin::check_type($_SESSION["cms_auth_uuid"],"api") ) and
                (!plugin::check_permission($_SESSION["cms_auth_uuid"],"system_settings"))
            ){
                throw new \Exception("Unauthorized transaction");
            }

            if(!appModel::saveToken(
                $_SESSION["cms_auth_site"],
                Header::post("isWrite"),
                Header::post("isRead"),
                Header::post("isUpdate"),
                Header::post("isDelete")
            )) throw new \Exception("Operation failed");

            Header::jsonResult("success","SUCCESS","Token created");

        }catch (\Exception $exception){

            Header::jsonResult("error","ERROR",$exception->getMessage());
        }

    }

    public static function ajaxUpdatePassword(){

        try{

            Header::checkParameter($_POST,["pass","rePass"]);
            Header::checkValue($_POST,["pass","rePass"]);


            if(
                (!plugin::check_type($_SESSION["cms_auth_uuid"],"root") and !plugin::check_type($_SESSION["cms_auth_uuid"],"root") and
                !plugin::check_type($_SESSION["cms_auth_uuid"],"admin") ) and
                (!plugin::check_permission($_SESSION["cms_auth_uuid"],"system_settings"))
            ){
                throw new \Exception("Unauthorized transaction");
            }

            if(Header::post("pass") !== Header::post("rePass")) throw new \Exception("Passwords Could Not Be Confirmed");

            if(!appModel::updateUserInfo(
                $_SESSION["cms_auth_email"],
                [
                    "password"
                ],[
                    Header::post("pass")
                ],
                $_SESSION["cms_auth_site"]
            )) throw new \Exception("Operation failed");

            Header::jsonResult("success","SUCCESS","Password updated");

        }catch (\Exception $exception){

            Header::jsonResult("error","ERROR",$exception->getMessage());
        }

    }

    public static function tokenDeleteAjax(){

        try{

            Header::checkParameter($_POST,["token"]);
            Header::checkValue($_POST,["token"]);

            if(
                (!plugin::check_type($_SESSION["cms_auth_uuid"],"root") and !plugin::check_type($_SESSION["cms_auth_uuid"],"root") and
                !plugin::check_type($_SESSION["cms_auth_uuid"],"admin") and !plugin::check_type($_SESSION["cms_auth_uuid"],"api") ) and
                (!plugin::check_permission($_SESSION["cms_auth_uuid"],"system_settings"))
            ){
                throw new \Exception("Unauthorized transaction");
            }

            if(!appModel::deleteToken(
                Header::post("token"),
                $_SESSION["cms_auth_site"]
            )) throw new \Exception("Operation failed");

            Header::jsonResult("success","SUCCESS","Token kaldırıldı");

        }catch (\Exception $exception){

            Header::jsonResult("error","ERROR",$exception->getMessage());
        }

    }

    public static function tokenGetAjax(){

        $get = [];


        if(
            (!plugin::check_type($_SESSION["cms_auth_uuid"],"root") and !plugin::check_type($_SESSION["cms_auth_uuid"],"root") and
            !plugin::check_type($_SESSION["cms_auth_uuid"],"admin") and !plugin::check_type($_SESSION["cms_auth_uuid"],"api") ) and
            (!plugin::check_permission($_SESSION["cms_auth_uuid"],"system_settings"))
        ){
            Header::redirect("/");
        }

        foreach (appModel::getTokens($_SESSION["cms_auth_site"]) as $item){

            $get[] = [
                $item["uuid"],
                $_SESSION["cms_auth_site"],
                $item["is_write"] === "active" ? "<span class='badge badge-info'>Yes</span>" : "<span class='badge badge-danger'>No</span>",
                $item["is_read"] === "active" ? "<span class='badge badge-info'>Yes</span>" : "<span class='badge badge-danger'>No</span>",
                $item["is_update"] === "active" ? "<span class='badge badge-info'>Yes</span>" : "<span class='badge badge-danger'>No</span>",
                $item["is_delete"] === "active" ? "<span class='badge badge-info'>Yes</span>" : "<span class='badge badge-danger'>No</span>",
                date("Y-m-d",$item["time"])
            ];

        }

        Header::jsonResult("success","SUCCESS","Data is attached",$get);


    }

    public static function apiGetAjax(){

        $get = [];

        if(
            (!plugin::check_type($_SESSION["cms_auth_uuid"],"root") and !plugin::check_type($_SESSION["cms_auth_uuid"],"root") and
            !plugin::check_type($_SESSION["cms_auth_uuid"],"admin") and !plugin::check_type($_SESSION["cms_auth_uuid"],"api") ) and
            (!plugin::check_permission($_SESSION["cms_auth_uuid"],"system_settings"))
        ){
            Header::redirect("/");
        }


        foreach (appModel::getApi($_SESSION["cms_auth_site"]) as $item){

            $get[] = [
                $item["label"],
                $item["operation"] === "single" ? "<span class='badge badge-info'>SINGLE MODULE</span>" : "<span class='badge badge-info'>MULTIPLE MODULE</span>",
                "<a href='/app/api/".$item["uuid"]."'> <button class='btn btn-primary btn-sm waves-effect waves-light'>DETAIL</button> </a>"
            ];

        }

        Header::jsonResult("success","SUCCESS","Data is attached",$get);


    }


    public static function exportJson(){

        try{


            if(
                (!plugin::check_type($_SESSION["cms_auth_uuid"],"root") and !plugin::check_type($_SESSION["cms_auth_uuid"],"root") and
                !plugin::check_type($_SESSION["cms_auth_uuid"],"admin") ) and
                (!plugin::check_permission($_SESSION["cms_auth_uuid"],"system_settings"))
            ){
                Header::redirect("/");
            }

            header('Content-Type: text/plain; charset=utf-8');
            header('Content-Disposition: attachment; filename="export-'.time().'.vobo"');


            echo json_encode(exportImport::export($_SESSION["cms_auth_site"]),JSON_HEX_TAG);



        }catch (\Exception $exception){
            Header::jsonResult("error","ERROR",$exception->getMessage());
        }

    }

    public static function backupImport(){

        try{

            Header::checkParameter($_POST,["content"]);
            Header::checkValue($_POST,["content"]);


            if(
                (!plugin::check_type($_SESSION["cms_auth_uuid"],"root") and !plugin::check_type($_SESSION["cms_auth_uuid"],"root") and
                !plugin::check_type($_SESSION["cms_auth_uuid"],"admin") ) and
                (!plugin::check_permission($_SESSION["cms_auth_uuid"],"system_settings"))
            ){
                throw new \Exception("Unauthorized transaction");
            }


            $crud = json_decode(Header::post("content"))->crud;

            foreach ($crud as $crudItem){

                if(!crudModel::getCrud($crudItem->uuid,$_SESSION["cms_auth_site"],$crudItem->language)){

                    Database::start()->insert("crud")
                        ->set([
                            "uuid",
                            "siteCode",
                            "menuCategory",
                            "label",
                            "components",
                            "slug",
                            "slugComponent",
                            "operation",
                            "language",
                            "ip",
                            "time"
                        ],[
                            $crudItem->uuid,
                            $_SESSION["cms_auth_site"],
                            $crudItem->menu,
                            $crudItem->label,
                            json_encode($crudItem->components),
                            $crudItem->slug,
                            $crudItem->slug_key,
                            $crudItem->type,
                            $crudItem->language,
                            $_SERVER["REMOTE_ADDR"],
                            time()
                        ])->run(Database::Progress);

                }

                if(isset($crudItem->records)){

                    foreach ($crudItem->records as $records) {

                        if(!crudModel::getContent($records->uuid, $_SESSION["cms_auth_site"], "uuid", $records->language)){

                            Database::start()->insert("crud_contents")
                                ->set([
                                    "uuid",
                                    "contentCode",
                                    "crudCode",
                                    "siteCode",
                                    "content",
                                    "slug",
                                    "language",
                                    "ip",
                                    "time"
                                ],[
                                    $records->uuid,
                                    "passive",
                                    $records->crud,
                                    $_SESSION["cms_auth_site"],
                                    json_encode($records->contents),
                                    $records->slug,
                                    $records->language,
                                    $_SERVER["REMOTE_ADDR"],
                                    time()
                                ])->run(Database::Progress);

                        }

                    }

                }

            }

            Header::jsonResult("success","SUCCESS","Refreshing the Page");

        }catch (\Exception $exception){

            Header::jsonResult("error","ERROR",$exception->getMessage());

        }

    }

    public static function adaptorForAllLanguage(){

        if(
            (!plugin::check_type($_SESSION["cms_auth_uuid"],"root") and !plugin::check_type($_SESSION["cms_auth_uuid"],"root") and
            !plugin::check_type($_SESSION["cms_auth_uuid"],"admin") ) and
            (!plugin::check_permission($_SESSION["cms_auth_uuid"],"system_settings"))
        ){
            Header::redirect("/");
        }

        foreach (language::$langs as $lang => $item){

            if($lang !== language::$defaultLang){

                language::adaptationLanguageCrudComponent(language::$defaultLang,$lang);

            }

        }

        Header::jsonResult("success","SUCCESS","Refreshing the Page");

    }

    public static function ajaxNotFound(){

        Header::notFound();
        return;

    }

    public static function setupCheck(){

        if(__VOBOINSTALL__ === "off")
            Header::redirect("/");

        Assets::render("app/install");

    }




    public static function setupFinish(){

        try {

            Header::checkParameter($_POST,["dbserver","dbname","dbusername","dbpassword"]);
            Header::checkValue($_POST,["dbserver","dbname","dbusername"]);

            $phpVersion         = phpversion();

            if(($phpVersion < 7))
                throw new Exception("Server requirements are missing. need min php 7");

            $db = new PDO('mysql:host='.Header::post("dbserver").';dbname='.Header::post("dbname"), Header::post("dbusername"), Header::post("dbpassword"));

            $getSql     = file_get_contents(__HOME__."/Fix/Install/config.sql");

            $query      = $db->prepare($getSql);
            $insert     = $query->execute();

            if(!$insert)
                throw new Exception("Setup failed");

            $getFix             = file_get_contents(__HOME__."/config.php");
            $file_handleConfig  = fopen(__HOME__."/config.php", 'w');


            if(!$file_handleConfig)
                throw new Exception("Installation status not found");

            fwrite($file_handleConfig, str_replace([
                'define("__SERVER__","")',
                'define("__USERNAME__","")',
                'define("__PASSWORD__","")',
                'define("__TABLE__","")',
                'define("__VOBOINSTALL__","on")',
            ],[
                'define("__SERVER__","'.Header::post("dbserver").'")',
                'define("__USERNAME__","'.Header::post("dbusername").'")',
                'define("__PASSWORD__","'.Header::post("dbpassword").'")',
                'define("__TABLE__","'.Header::post("dbname").'")',
                'define("__VOBOINSTALL__","off")',
            ],$getFix));

            fclose($file_handleConfig);

            echo "ok";

        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    public static function closedSession(){

        session_destroy();
        ob_end_flush();

        Header::jsonResult("success","SUCCESS","Exited");


    }

}