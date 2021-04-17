<?php

namespace App\Main\Model;

use Fix\Packages\Database\Database;
use Fix\Support\Header;
use DawPhpPagination\Pagination;
use App\Main\Model\language;


class apiModel {


    public static $apiListCrud = [
        "multiple" => [
            ["MODULE","[component]","HOOK CODE"],
            ["NEW REGISTRATION","[URL]/api/v1/insert/multiple/[component]/[secret]/[token][language]","POST"],
            ["REGISTRATION UPDATE" ,"[URL]/api/v1/update/multiple/[component]/[secret]/[token]/[record-uuid][language]","POST"],
            ["DELETING REGISTRATION" ,"[URL]/api/v1/delete/multiple/[component]/[secret]/[token]/[record-uuid][language]","POST"],
            ["ALL RECORDS" ,"[URL]/api/v1/read/multiple/all/[component]/[secret]/[token][language]","GET"],
            ["DATA DETAIL BY REGISTRATION NUMBER" ,"[URL]/api/v1/read/multiple/one/uuid/[secret]/[token]/[record-uuid][language]","GET"],
            ["DATA DETAILS BY SLUG" ,"[URL]/api/v1/read/multiple/one/slug/[secret]/[token]/[slug][language]","GET"],
            ["DATA PAGINATION" ,"[URL]/api/v1/read/multiple/page/[secret]/[token]/[page][language]","GET"]
        ],
        "single" =>  [
            ["MODULE","[component]","HOOK CODE"],
            ["PAGE UPDATE" ,"[URL]/api/v1/update/single/[component]/[secret]/[token][language]","POST"],
            ["PAGE DATA DETAIL" ,"[URL]/api/v1/read/single/one/[component]/[secret]/[token][language]","GET"]
        ]
    ];



    public static $apiListCat = [
        "[URL]/api/v1/get/all/categories/[secret]/[token]",
    ];


    public static function filterLangReplace(){

        $list = [];

        $list[] = "Default ( ".language::$langs[language::$defaultLang][0] . " = " .language::$defaultLang." ) | ";

        foreach (language::$langs as $key => $item){

            if($key !== language::$defaultLang){
                $list[] = "( ".$item[0] . " = " .$key." )";
            }

        }

        return $list;

    }

    public static function filterGet(){

        return
            [
                "filterOrder" => "(ASC) RECORDINGS FROM THE START TO END | (DESC) END TO RECORDS",
                "filterLimit" => "Default ( 99999 ) | Data withdrawal limit 'Only digits must be entered!'",
                "language" => implode(" ",self::filterLangReplace()),
            ];
    }

    public static function getLang(){


        if(isset($_GET["language"])){

            if(array_key_exists($_GET["language"],language::$langs)){
                return strtolower($_GET["language"]);
            }else{
                return language::$defaultLang;
            }

        }else{
            return language::$defaultLang;
        }


    }

    /**
     * @param $secret
     * @param $token
     * @return array|mixed
     */
    public static function checkApiToken($secret, $token){

        return Database::start()->select("tokens")->where(["BINARY uuid","BINARY siteCode"],[$token,$secret])->run(Database::Single);

    }



    public static function getAllCategories($siteCode,$language){


        return Database::start()->select("menu_categories")->where(["BINARY siteCode","language"],[$siteCode,$language])->run(Database::Multiple);

    }


    public static function getAllSubCategories($categoryCode,$selector = ""){

        return Database::start()->select("menu_items",$selector)->where(["BINARY menuCategory"],[$categoryCode])->orderby("sort","ASC")->run(Database::Multiple);

    }

    /**
     * @param $secret
     * @param $component
     * @return array|mixed
     */
    public static function checkApiComponent($secret, $component,$language){

        return Database::start()->select("crud")->where(["BINARY uuid","BINARY siteCode","language"],[$component,$secret,$language])->run(Database::Single);

    }

    /**
     * @param $component
     * @param $siteCode
     * @throws \Exception
     */
    public static function saveMultipleComponentItem($component, $siteCode){


        $getLang = function (){

            if(isset($_GET["language"])){

                if(array_key_exists($_GET["language"],language::$langs)){
                    return strtolower($_GET["language"]);
                }else{
                    return language::$defaultLang;
                }

            }else{
                return language::$defaultLang;
            }

        };

        $getModules = crudModel::getCrud
        (
            $component,
            $siteCode,
            $getLang()
        );

        $getLang = function (){

            if(isset($_GET["language"])){

                if(array_key_exists($_GET["language"],language::$langs)){
                    return strtolower($_GET["language"]);
                }else{
                    return language::$defaultLang;
                }

            }else{
                return language::$defaultLang;
            }

        };

        if(!$getModules)
            throw new \Exception("Component Not Found");

        if($getModules["operation"] === "single")
            throw new \Exception("The transaction is available for multiple entries");

        $getComponents = json_decode($getModules["components"])->crud;

        $modules = [];


        foreach ($getComponents as $item){
            if($item->required === "active"){
                $modules[] = $item->name;
            }
        }

        Header::checkParameter($_POST,$modules);
        Header::checkValue($_POST,$modules);

        foreach ($getComponents as $key => $item){

            $getComponents[$key]->content = isset($_POST[$item->name]) ? is_array( Header::post($item->name)) ? implode(",", Header::post($item->name)) :  Header::post($item->name) : null;

        }

        crudModel::saveCrud
        (
            $component,
            $siteCode,
            json_encode($getComponents,JSON_HEX_TAG),
            $getModules["slug"] === "active" ? cmsSupport::permalink(Header::post($getModules["slugComponent"])) : "passive",
            $getModules["menuCategory"] !== "passive" ? Header::post("voboCategory") : "passive",
            $getLang()
        );

    }


    /**
     * @param $component
     * @param $siteCode
     * @param $record
     * @throws \Exception
     */
    public static function updateMultipleComponentItem($component, $siteCode, $record){


        $getLang = function (){

            if(isset($_GET["language"])){

                if(array_key_exists($_GET["language"],language::$langs)){
                    return strtolower($_GET["language"]);
                }else{
                    return language::$defaultLang;
                }

            }else{
                return language::$defaultLang;
            }

        };

        $getModules = crudModel::getCrud(
            $component,
            $siteCode,
            $getLang()
        );

        if(!$getModules)
            throw new \Exception("Module Not Found");

        $getLang = function (){

            if(isset($_GET["language"])){

                if(array_key_exists($_GET["language"],language::$langs)){
                    return strtolower($_GET["language"]);
                }else{
                    return language::$defaultLang;
                }

            }else{
                return language::$defaultLang;
            }

        };

        $getCont = crudModel::getContent(
            $record,
            $siteCode,
            "uuid",
            $getLang()
        );

        if(!$getCont)
            throw new \Exception("Content Not Found");






        $getComponents = json_decode($getModules["components"])->crud;

        $modules = [];

        foreach ($getComponents as $item){

            if($item->required === "active"){
                $modules[] = $item->name;
            }
        }

        Header::checkParameter($_POST,$modules);
        Header::checkValue($_POST,$modules);

        foreach ($getComponents as $key => $item){

            $getComponents[$key]->content = isset($_POST[$item->name]) ? is_array( Header::post($item->name)) ? implode(",", Header::post($item->name)) :  Header::post($item->name) : null;

        }

        crudModel::updateCrud(
            $record,
            $getModules["uuid"],
            $siteCode,
            json_encode($getComponents,JSON_HEX_TAG),
            $getModules["slug"] === "active" ? cmsSupport::permalink(Header::post($getModules["slugComponent"])) : "passive",
            $getModules["menuCategory"] !== "passive" ? Header::post("voboCategory") : "passive",
            $getLang()
        );

    }


    /**
     * @param $component
     * @param $siteCode
     * @throws \Exception
     */
    public static function updateSingleComponentItem($component, $siteCode){

        $getLang = function (){

            if(isset($_GET["language"])){

                if(array_key_exists($_GET["language"],language::$langs)){
                    return strtolower($_GET["language"]);
                }else{
                    return language::$defaultLang;
                }

            }else{
                return language::$defaultLang;
            }

        };

        $getModules = crudModel::getCrud
        (
            $component,
            $siteCode,
            $getLang()
        );

        if(!$getModules)
            throw new \Exception("Component Not Found");

        if($getModules["operation"] === "multiple")
            throw new \Exception("The transaction is available for multiple entries");

        $getLang = function (){

            if(isset($_GET["language"])){

                if(array_key_exists($_GET["language"],language::$langs)){
                    return strtolower($_GET["language"]);
                }else{
                    return language::$defaultLang;
                }

            }else{
                return language::$defaultLang;
            }

        };

        $getComponents = json_decode($getModules["components"])->crud;

        $modules = [];

        foreach ($getComponents as $item){
            if($item->required === "active"){
                $modules[] = $item->name;
            }
        }

        Header::checkParameter($_POST,$modules);
        Header::checkValue($_POST,$modules);


        foreach ($getComponents as $item){

            $item->content = isset($_POST[$item->name]) ? Header::post($item->name) : null;

        }

        $convert["crud"] = $getComponents;

        crudModel::updateCrudComponents(
            $component,
            $siteCode,
            json_encode($convert,JSON_HEX_TAG),
            $getLang()
        );

    }


    /**
     * @param $component
     * @param $siteCode
     * @param $record
     * @throws \Exception
     */
    public static function deleteMultipleComponentItem($component, $siteCode, $record){


        $getLang = function (){

            if(isset($_GET["language"])){

                if(array_key_exists($_GET["language"],language::$langs)){
                    return strtolower($_GET["language"]);
                }else{
                    return language::$defaultLang;
                }

            }else{
                return language::$defaultLang;
            }

        };


        $getCont = crudModel::getContent(
            $record,
            $siteCode,
            "uuid",
            $getLang()
        );

        if(!$getCont)
            throw new \Exception("Content Not Found");


        $getModules = crudModel::getCrud(
            $component,
            $siteCode,
            $getLang()
        );

        if(!$getModules)
            throw new \Exception("Module Not Found");


        crudModel::deleteContent(
            $record,
            $siteCode,
            $getLang()
        );

    }


    /**
     * @param $component
     * @param $siteCode
     * @return array
     * @throws \Exception
     */
    public static function apiAll($component, $siteCode){

        if(!isset($component))
            throw new \Exception("Incoming code not found");

        $getLang = function (){

            if(isset($_GET["language"])){

                if(array_key_exists($_GET["language"],language::$langs)){
                    return strtolower($_GET["language"]);
                }else{
                    return language::$defaultLang;
                }

            }else{
                return language::$defaultLang;
            }

        };


        $getModules = crudModel::getCrud(
            $component,
            $siteCode,
            $getLang()
        );

        if(!$getModules)
            throw new \Exception("Module Not Found");


        $filterOrder    = isset($_GET["filterOrder"]) ? ( in_array($_GET["filterOrder"],["DESC","ASC"]) ? $_GET["filterOrder"] : "DESC" ) : "DESC";
        $filterLimit    = isset($_GET["filterLimit"]) ? ( is_numeric(intval($_GET["filterLimit"])) ? $_GET["filterLimit"] : 999999 ) : 999999;


        $getRecords = crudModel::getContents(
            $component,
            $siteCode,
            $filterOrder,
            $filterLimit,
            $getLang()
        );

        if(!$getRecords)
            throw new \Exception("No Records Found");

        $compList = [];

        foreach (json_decode($getModules["components"])->crud as $item ){
            $compList[] = $item->name;
        }

        $export = [];

        $counter = 0;

        foreach($getRecords as $item){

            $componentDecode = json_decode($item["content"]);

            $export[$counter] = [];

            foreach ($componentDecode as $getContentInRecord){

                $export[$counter]["uuid"] = $item["uuid"];

                if($item["slug"] !== "passive"){
                    $export[$counter]["slug"] = $item["slug"];
                }


                if($item["category"] !== "passive" && $item["category"] !== "0"){
                    $export[$counter]["category"] = $item["category"];
                }

                $export[$counter][$getContentInRecord->name] = $getContentInRecord->content;

                if($getContentInRecord->component === "MODULE"){

                    $export["module"] = [];

                }

            }

            $export[$counter]["time"] = date("Y-m-d",$item["time"]);

            $counter += 1;

        }

        return count($export) > 0 ? $export : [];

    }


    /**
     * @param $component
     * @param $siteCode
     * @param $page
     * @return array
     * @throws \Exception
     */
    public static function apiAllPagination($component, $siteCode, $page){

        if(!isset($component))
            throw new \Exception("Incoming code not found");

        $getLang = function (){

            if(isset($_GET["language"])){

                if(array_key_exists($_GET["language"],language::$langs)){
                    return strtolower($_GET["language"]);
                }else{
                    return language::$defaultLang;
                }

            }else{
                return language::$defaultLang;
            }

        };

        $getModules = crudModel::getCrud(
            $component,
            $siteCode,
            $getLang()
        );

        if(!$getModules)
            throw new \Exception("Module Not Found");



        $getRecordsAll = crudModel::getContents(
            $component,
            $siteCode,
            "ASC",
            "999999",
            $getLang()
        );

        $filterPage     = isset($_GET["filterLimit"]) ?  is_numeric($_GET["filterLimit"]) ? intval($_GET["filterLimit"]) : 1 : 1;

        $filterOrder    = isset($_GET["filterOrder"]) ? ( in_array($_GET["filterOrder"],["DESC","ASC"]) ? $_GET["filterOrder"] : "DESC" ) : "DESC";

        $pagination     = new Pagination(['pp'=> $filterPage ]);

        $pagination->getP = is_numeric($page) ? $page : 1;

        $pagination->paginate(count($getRecordsAll));

        $getRecords =  Database::start()
            ->select("crud_contents")
            ->where([ "siteCode","crudCode" ],[ $siteCode,$component ])
            ->orderby("id",$filterOrder)
            ->limit($pagination->getOffset(),$pagination->getLimit())
            ->run(Database::Multiple);


        if(!($page <= $pagination->getNbPages() ?  $getRecords : []))
            throw new \Exception("No Records Found");

        $compList = [];

        foreach (json_decode($getModules["components"])->crud as $item ){
            $compList[] = $item->name;
        }

        $export = [];

        $counter = 0;

        foreach(($page <= $pagination->getNbPages() ?  $getRecords : []) as $item){

            $componentDecode = json_decode($item["content"]);

            $export[$counter] = [];

            foreach ($componentDecode as $getContentInRecord){

                $export[$counter]["uuid"] = $item["uuid"];
                if($item["slug"] !== "passive")
                    $export[$counter]["slug"] = $item["slug"];

                if($item["category"] !== "passive")
                    $export[$counter]["category"] = $item["category"];


                $export[$counter][$getContentInRecord->name] = $getContentInRecord->content;

            }

            $export[$counter]["time"] = date("Y-m-d",$item["time"]);

            $counter += 1;

        }

        return [
            "totalPage" =>  $pagination->getNbPages(),
            "result"    =>  count($export) > 0 ? $export : []
        ];

    }


    /**
     * @param $component
     * @param $siteCode
     * @param $record
     * @return array
     * @throws \Exception
     */
    public static function getOneRecordInMultiple($component, $siteCode, $record){



        $getLang = function (){

            if(isset($_GET["language"])){

                if(array_key_exists($_GET["language"],language::$langs)){
                    return strtolower($_GET["language"]);
                }else{
                    return language::$defaultLang;
                }

            }else{
                return language::$defaultLang;
            }

        };


        $getModules = crudModel::getCrud(
            $component,
            $siteCode,
            $getLang()
        );

        if(!$getModules)
            throw new \Exception("Module Not Found");


        $getCont = crudModel::getContent(
            $record,
            $siteCode,
            "uuid",
            $getLang()
        );

        if(!$getCont)
            throw new \Exception("Content Not Found");


        $export = [];

        $export["uuid"] = $getCont["uuid"];


        if($getCont["slug"] !== "passive")
            $export["slug"] = $getCont["slug"];


       foreach (json_decode($getCont["content"]) as $item){

           $export[$item->name] = $item->content;

       }

        $export["time"] = $getCont["time"];

       return count($export) > 0 ? $export : [];

    }

    public static function getOneRecordInMultipleWhileSef($component,$siteCode,$record){

        $getLang = function (){

            if(isset($_GET["language"])){

                if(array_key_exists($_GET["language"],language::$langs)){
                    return strtolower($_GET["language"]);
                }else{
                    return language::$defaultLang;
                }

            }else{
                return language::$defaultLang;
            }

        };

        $getModules = crudModel::getCrud(
            $component,
            $siteCode,
            $getLang()
        );

        if(!$getModules)
            throw new \Exception("Module Not Found");


        $getCont = crudModel::getContent(
            $record,
            $siteCode,
            "slug",
            $getLang()
        );

        if(!$getCont)
            throw new \Exception("Content Not Found");


        $export = [];

        $export["uuid"] = $getCont["uuid"];

        if($getCont["slug"] !== "passive")
            $export["slug"] = $getCont["slug"];

       foreach (json_decode($getCont["content"]) as $item){

           $export[$item->name] = $item->content;

       }

        $export["time"] = date("Y-m-d",$getCont["time"]);

       return count($export) > 0 ? $export : [];

    }


    /**
     * @param $component
     * @param $siteCode
     * @return mixed
     * @throws \Exception
     */
    public static function getOneRecordInSingle($component, $siteCode){

        $getLang = function (){

            if(isset($_GET["language"])){

                if(array_key_exists($_GET["language"],language::$langs)){
                    return strtolower($_GET["language"]);
                }else{
                    return language::$defaultLang;
                }

            }else{
                return language::$defaultLang;
            }

        };

        $getModules = crudModel::getCrud(
            $component,
            $siteCode,
            $getLang()
        );

        if(!$getModules)
            throw new \Exception("Module Not Found");



       return json_decode($getModules["components"])->crud;

    }






}