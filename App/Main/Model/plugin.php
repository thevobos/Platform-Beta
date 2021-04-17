<?php

namespace App\Main\Model;

use App\Main\Model\crudModel;
use App\Main\Model\templateModel;
use App\Main\Model\menuModel;
use App\Main\Model\language;
use Fix\Packages\Assets\Assets;
use Fix\Packages\Database\Database;
use Fix\Support\Header;
use voku\helper\Hooks;
use Fix\Router\Router;

class plugin {


    const SINGLE_MENU           = "single";
    const MULTIPLE_MENU         = "multiple";


    const PERMISSION_LIST_MODEL_A = "A";
    const PERMISSION_LIST_MODEL_B = "B";


    public static function dirToArray($dir = null) {

        $result = array();

        $cdir = scandir($dir);
        foreach ($cdir as $key => $value)
        {
            if (!in_array($value,array(".","..")))
            {
                if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
                {
                    $result[$value] = self::dirToArray($dir . DIRECTORY_SEPARATOR . $value);
                }
                else
                {
                    $result[] = $value;
                }
            }
        }

        return $result;
    }

    public static function loadPlugin($isRoot = false, $permissions = null){

        if(isset($_SESSION["cms_login"])){

            $getSite = Database::start()->select("sites")->where(["uuid"],[$_SESSION["cms_auth_site"]])->run(Database::Single);

            if(!$_SESSION["cms_auth_manager"])
                foreach (json_decode($getSite["plugins"]) as $plugin)
                    if(file_exists(__DIR__."/../Plugin/$plugin/$plugin.php"))
                        include(__DIR__."/../Plugin/$plugin/$plugin.php");

            if($_SESSION["cms_auth_manager"])
                foreach ( self::dirToArray("App/Main/Plugin") as $key => $item)
                    if(file_exists(__DIR__."/../Plugin/$key/$key.php"))
                        include(__DIR__."/../Plugin/$key/$key.php");

        }else{
            foreach ( self::dirToArray("App/Main/Plugin") as $key => $item)
                if(file_exists(__DIR__."/../Plugin/$key/$key.php"))
                    include(__DIR__."/../Plugin/$key/$key.php");
        }

    }

    public static function hook(){

       return Hooks::getInstance();

    }



    public static function add_css(array $url = []){

        Hooks::getInstance()->add_action("body@css",function () use ($url){
            return $url;
        });

    }


    public static function add_create_form_item($action = null,$type = null,$name = null,$title = null,$required = null,$placeholder = null,$content = null,$child = null){


        Hooks::getInstance()->add_action($action,function () use ($type,$name,$title,$required,$placeholder,$content,$child){

            crudModel::formComponent($type,(object)[
                "name"           => $name,
                "title"          => $title,
                "required"       => $required,
                "placeholder"    => $placeholder,
                "content"        => $content,
                "child"          => $child
            ]);

        });

        return;

    }

    public static function add_edit_form_item($action = null,$type = null,$name = null,$title = null,$required = null,$placeholder = null,$content = null,$child = null){


        Hooks::getInstance()->add_action($action,function () use ($type,$name,$title,$required,$placeholder,$content,$child){

            crudModel::formEditComponent($type,(object)[
                "name"           => $name,
                "title"          => $title,
                "required"       => $required,
                "placeholder"    => $placeholder,
                "content"        => $content,
                "child"          => $child
            ]);

            return;

        });

    }

    public static function add_single_form_item($action = null,$type = null,$name = null,$title = null,$required = null,$placeholder = null,$content = null,$child = null){


        Hooks::getInstance()->add_action($action,function () use ($type,$name,$title,$required,$placeholder,$content,$child){

            crudModel::formSingleComponent($type,(object)[
                "name"           => $name,
                "title"          => $title,
                "required"       => $required,
                "placeholder"    => $placeholder,
                "content"        => $content,
                "child"          => $child
            ]);

            return;

        });

    }

    public static function add_js(array $url = []){

        Hooks::getInstance()->add_action("body@js",function () use ($url){
            return $url;
        });

    }

    public static function info(array $details = []){

        Hooks::getInstance()->add_action("plugin@info",function () use ($details){
            return $details;
        });

    }

    public static function add_menu(array $menu = []){

        Hooks::getInstance()->add_action("admin@menu",function () use ($menu){
            return $menu;
        });

    }

    public static function check_permission($user = null, $permission = null){

      $getUser = Database::start()->select("authorities")->where(["uuid"],[$user])->run(Database::Single);

      if(!$getUser)
          return false;


      return is_array(json_decode($getUser["user_permissions"]))  ?  in_array($permission, json_decode($getUser["user_permissions"])) : false;

    }


    public static function check_type($user = null, $type = null){

        $getUser = Database::start()->select("authorities")->where(["uuid"],[$user])->run(Database::Single);

        if(!$getUser)
            return false;

        return $type === $getUser["user_type"];

    }


    public static function add_user_permission(array $permission = []){

        Hooks::getInstance()->add_action("admin@user:permission",function () use ($permission){
            return $permission;
        });

    }

    public static function add_user_type(array $type = []){

        Hooks::getInstance()->add_action("admin@user:type",function () use ($type){
            return $type;
        });

    }

    public static function get_tmp_storage($siteCode = null,$key = null){

        $get = Database::start()->select("tmpstorage")->where(["siteCode","v_key"],[$siteCode,$key])->run(Database::Single);

        if(!$get){
            return false;
        }

        return $get["v_value"];

    }


    public static function set_tmp_storage($siteCode = null,$key = null,$val = null){

        $get = Database::start()->update("tmpstorage")->set(["v_val"],[$val])->where(["siteCode","v_key"],[$siteCode,$key])->run(Database::Progress);

        if(!$get){
            throw new \Exception("Update failed");
        }

        return true;

    }



    public static function add_tmp_storage($siteCode = null,$key = null,$val = null){

        $get = Database::start()->insert("tmpstorage")->set(["v_key","siteCode","v_value"],[$key,$siteCode,$val])->run(Database::Progress);

        if(!$get){
            throw new \Exception("Creating failed");
        }

        return true;

    }


    public static function delete_tmp_storage($siteCode = null,$key = null){

        $get = Database::start()->delete("tmpstorage")->where(["siteCode","v_key"],[$siteCode,$key])->run(Database::Progress);

        if(!$get){
            throw new \Exception("Delete failed");
        }

        return true;

    }

    public static function view_render($plugin = null,$file = null,$data = []){

        $getPluginName = self::get_name($plugin);

        Assets::renderPlugin($getPluginName,$file,$data);

    }

    public static function admin_view_render($title = null,$breadcrumb = [], $plugin = null,$action = null, $file = null, $data = []){

        $getPluginName = self::get_name($plugin);

        Hooks::getInstance()->add_action($getPluginName."@".$action,function () use ($data,$file,$getPluginName) {

            Assets::renderPlugin($getPluginName,$file,array_merge($data,[
                "hook"              => Hooks::getInstance(),
                "pluginModel"       => self::class
            ]));

        });

        Hooks::getInstance()->add_action($getPluginName."@".$action.":page-title",function () use ($title,$breadcrumb) {

            return [
                "title"         => $title,
                "breadcrumb"    => $breadcrumb
            ];

        });

    }




    public static function add_router_redirect($plugin = null,$action = null){

        $getPluginName = self::get_name($plugin);

        Header::redirect("/app/plugin?page=$getPluginName@".$action);

    }

    public static function add_router_post($action = null,$url = null, $router = null){

        Hooks::getInstance()->add_action($action,function () use ($url,$router) {

            Router::post($url,$router);

        });

    }

    public static function action($action = null, callable $function = null,$priority = 99999){

        Hooks::getInstance()->add_action($action,$function,$priority);

    }


    public static function get_name($dir = null){

        if(preg_match_all("|/Plugin/(.*?)/|U", $dir,$export1)){
            return $export1[1][0];
        }


        if(preg_match_all("|/Plugin/(.*?)|U", $dir,$export2)){
            return $export2[1][0];
        }


        if(preg_match_all("|/Plugin/(.*?)/|U", $dir) && preg_match_all("|/Plugin/(.*?)|U", $dir)){
            throw new \Exception("Plugin not detected");
        }


    }

    public static function add_router_get($action = null,$url = null, $router = null){

        Hooks::getInstance()->add_action($action,function () use ($url,$router) {

            Router::get($url,$router);

        });

    }


    public static function init_permission(array $userPermissionList = [],$type = self::PERMISSION_LIST_MODEL_A,callable $function = null){

        $allPermission      = [];
        $acceptPermission   = [];

        $getSystemPermissions = plugin::hook()->do_action("admin@user:permission",$_REQUEST,true);

        if(!$getSystemPermissions)
            return $function([]);

        foreach ($getSystemPermissions as $key => $getAll){

            foreach ($getAll as $item){

                $allPermission[$item["label"]] = $item["label"];

                if(in_array($item["value"],$userPermissionList)){

                    $acceptPermission[$item["value"]] = $item["label"];

                    if($type === self::PERMISSION_LIST_MODEL_B){
                         $function($item,$getSystemPermissions,$allPermission);
                    }

                }

            }

        }

        if( $type === self::PERMISSION_LIST_MODEL_A ){
            return $function($acceptPermission,$getSystemPermissions,$allPermission);
        }

    }


    public static function init_type($type = null){

        $getSystemType = plugin::hook()->do_action("admin@user:type",$_REQUEST,true);

        $export = [];

        foreach ($getSystemType as $key => $getAll){

            foreach ($getAll as $item){

                $export[$item["value"]]  = $item["label"];


            }

        }

        if(isset($export[$type])){
            return $export[$type];
        }else if($type === "root"){
            return "SYSTEM ADMINISTRATOR";
        }else{
            return false;
        }

    }


    public static function sitePluginPermission($site,$plugin){

        $getSite = Database::start()->select("sites")->where(["uuid"],[$site])->run(Database::Single);

        if(!$getSite)
            return false;


        echo array_search($plugin,(array)json_decode(($getSite["plugins"]))) ? "yes" :"no";
    }


    public static function getPluginList(){

        $export = [];

        foreach (self::dirToArray("App/Main/Plugin") as $key => $item)
            $export[] = $key;

        return $export;

    }


    public static function checkingSetup($table = null,$sql = null){

        $check = Database::start()->manuel('show tables like "'.$table.'"')->run(Database::Multiple);

        if(!$check){

            $get = Database::start()->connect()->prepare($sql);

            $get->execute();

            return true;

        }

    }

}