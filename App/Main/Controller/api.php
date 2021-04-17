<?php
/**
 * Created by PhpStorm.
 * User: cengizakcan
 * Date: 26.02.2020
 * Time: 19:54
 */

namespace App\Main\Controller;


use App\Main\Model\apiModel;
use App\Main\Model\language;
use Fix\Support\Header;
use App\Main\Model\crudModel;

class api {


    /**
     * @param $component
     * @param $siteCode
     * @param $token
     */
    public static function saveMultipleComponentItem($component = null, $siteCode = null, $token = null){

        try{

            if(is_null($component) && is_null($siteCode) && is_null($token))
                throw new \Exception("Required information not found");

            $checkToken = apiModel::checkApiToken(
                $siteCode,
                $token
            );

            if(!$checkToken) throw new \Exception("Api Information Is Invalid");

            $checkComponent = apiModel::checkApiComponent(
                $siteCode,
                $component,
                apiModel::getLang()
            );

            if(!$checkComponent) throw new \Exception("Component Information Invalid");


            if($checkToken["is_write"] === "passive") throw new \Exception("Api is not authorized to write information");

            apiModel::saveMultipleComponentItem(
                $component,
                $siteCode
            );

            Header::jsonResult("success","SUCCESS","Data has been saved");


        }catch (\Exception $exception){

            Header::jsonResult("error","ERROR",$exception->getMessage(),[]);

        }

    }


    /**
     * @param $component
     * @param $siteCode
     * @param $token
     */
    public static function updateSingleComponent($component = null, $siteCode = null, $token = null){

        try{

            if(is_null($component) && is_null($siteCode) && is_null($token))
                throw new \Exception("Required information not found");


            $checkToken = apiModel::checkApiToken(
                $siteCode,
                $token
            );

            if(!$checkToken) throw new \Exception("Api Information Is Invalid");

            $checkComponent = apiModel::checkApiComponent(
                $siteCode,
                $component,
                apiModel::getLang()
            );

            if(!$checkComponent) throw new \Exception("Component Information Invalid");


            if($checkToken["is_update"] === "passive") throw new \Exception("Api is not authorized to update information");

            apiModel::updateSingleComponentItem(
                $component,
                $siteCode
            );

            Header::jsonResult("success","SUCCESS","Data updated");


        }catch (\Exception $exception){

            Header::jsonResult("error","ERROR",$exception->getMessage(),[]);

        }

    }


    /**
     * @param $component
     * @param $siteCode
     * @param $token
     * @param $record
     */
    public static function updateMultipleComponent($component = null, $siteCode = null, $token = null, $record = null){

        try{

            if(is_null($component) && is_null($siteCode) && is_null($token) && is_null($record))
                throw new \Exception("Required information not found");


            $checkToken = apiModel::checkApiToken(
                $siteCode,
                $token
            );

            if(!$checkToken) throw new \Exception("Api Information Is Invalid");

            $checkComponent = apiModel::checkApiComponent(
                $siteCode,
                $component,
                apiModel::getLang()
            );

            if(!$checkComponent) throw new \Exception("Component Information Invalid");


            if($checkToken["is_delete"] === "passive") throw new \Exception("Api is not authorized to update information");

            apiModel::updateMultipleComponentItem
            (
                $component,
                $siteCode,
                $record
            );

            Header::jsonResult("success","SUCCESS","Data updated");


        }catch (\Exception $exception){

            Header::jsonResult("error","ERROR",$exception->getMessage(),[]);

        }

    }


    /**
     * @param $component
     * @param $siteCode
     * @param $token
     * @param $record
     */
    public static function deleteMultipleComponent($component = null, $siteCode = null, $token = null, $record = null){

        try{

            if(is_null($component) && is_null($siteCode) && is_null($token) && is_null($record))
                throw new \Exception("Required information not found");


            $checkToken = apiModel::checkApiToken(
                $siteCode,
                $token
            );

            if(!$checkToken) throw new \Exception("Api Information Is Invalid");

            $checkComponent = apiModel::checkApiComponent(
                $siteCode,
                $component,
                apiModel::getLang()
            );

            if($checkComponent["operation"] === "single")
                throw new \Exception("Çoklu girişler gilinebilir");

            if(!$checkComponent) throw new \Exception("Component Information Invalid");


            if($checkToken["is_delete"] === "passive") throw new \Exception("Api is not authorized to delete information");

            apiModel::deleteMultipleComponentItem
            (
                $component,
                $siteCode,
                $record
            );

            Header::jsonResult("success","SUCCESS","Data deleted");


        }catch (\Exception $exception){

            Header::jsonResult("error","ERROR",$exception->getMessage(),[]);

        }

    }


    /**
     * @param $component
     * @param $siteCode
     * @param $token
     */
    public static function apiGetAll($component = null, $siteCode = null, $token = null){

        try{

            if(is_null($component) && is_null($siteCode) && is_null($token))
                throw new \Exception("Required information not found");


            $checkToken = apiModel::checkApiToken(
                $siteCode,
                $token
            );

            if(!$checkToken) throw new \Exception("Api Information Is Invalid");

            $checkComponent = apiModel::checkApiComponent(
                $siteCode,
                $component,
                apiModel::getLang()
            );


            if(!$checkComponent) throw new \Exception("Component Information Invalid");


            if($checkToken["is_read"] === "passive") throw new \Exception("Api is not authorized to read information");

            Header::jsonResult("success","SUCCESS","Data is attached",apiModel::apiAll($component,$siteCode));


        }catch (\Exception $exception){

            Header::jsonResult("error","ERROR",$exception->getMessage(),[]);

        }

    }

    /**
     * @param $component
     * @param $siteCode
     * @param $token
     * @param int $page
     */
    public static function apiAllPagination($component = null, $siteCode = null, $token = null, $page = 1){

        try{

            if(is_null($component) && is_null($siteCode) && is_null($token))
                throw new \Exception("Required information not found");

            $checkToken = apiModel::checkApiToken(
                $siteCode,
                $token
            );

            if(!$checkToken) throw new \Exception("Api Information Is Invalid");

            $checkComponent = apiModel::checkApiComponent(
                $siteCode,
                $component,
                apiModel::getLang()
            );

            if(!$checkComponent) throw new \Exception("Component Information Invalid");

            if($checkToken["is_read"] === "passive") throw new \Exception("Api is not authorized to read information");

            Header::jsonResult("success","SUCCESS","Data is attached",apiModel::apiAllPagination($component,$siteCode,$page));

        }catch (\Exception $exception){

            Header::jsonResult("error","ERROR",$exception->getMessage(),[]);

        }

    }

    /**
     * @param $component
     * @param $siteCode
     * @param $token
     * @param $record
     */
    public static function apiGetOneInMultiple($component = null, $siteCode = null, $token = null, $record = null){

        try{

            if(is_null($component) && is_null($siteCode) && is_null($token) && is_null($record))
                throw new \Exception("Required information not found");

            $checkToken = apiModel::checkApiToken(
                $siteCode,
                $token
            );

            if(!$checkToken) throw new \Exception("Api Information Is Invalid");

            $checkComponent = apiModel::checkApiComponent(
                $siteCode,
                $component,
                apiModel::getLang()
            );

            if(!$checkComponent) throw new \Exception("Component Information Invalid");

            if($checkToken["is_read"] === "passive") throw new \Exception("Api is not authorized to read information");


            Header::jsonResult("success","SUCCESS","Data is attached",apiModel::getOneRecordInMultiple($component,$siteCode,$record));


        }catch (\Exception $exception){

            Header::jsonResult("error","ERROR",$exception->getMessage(),[]);

        }

    }


    /**
     * @param $component
     * @param $siteCode
     * @param $token
     * @param $record
     */
    public static function apiGetOneInMultipleWhileSlug($component = null, $siteCode = null, $token = null, $record = null){

        try{

            if(is_null($component) && is_null($siteCode) && is_null($token) && is_null($record))
                throw new \Exception("Required information not found");

            $checkToken = apiModel::checkApiToken(
                $siteCode,
                $token
            );

            if(!$checkToken) throw new \Exception("Api Information Is Invalid");

            $checkComponent = apiModel::checkApiComponent(
                $siteCode,
                $component,
                apiModel::getLang()
            );

            if(!$checkComponent) throw new \Exception("Component Information Invalid");

            if($checkToken["is_read"] === "passive") throw new \Exception("Api is not authorized to read information");


            Header::jsonResult("success","SUCCESS","Data is attached",apiModel::getOneRecordInMultipleWhileSef($component,$siteCode,$record));


        }catch (\Exception $exception){

            Header::jsonResult("error","ERROR",$exception->getMessage(),[]);

        }

    }

    public static function apiGetOneInMultipleUuid($component = null,$siteCode = null,$token = null,$record = null){

        try{

            if(is_null($component) && is_null($siteCode) && is_null($token) && is_null($record))
                throw new \Exception("Required information not found");

            $checkToken = apiModel::checkApiToken(
                $siteCode,
                $token
            );

            if(!$checkToken) throw new \Exception("Api Information Is Invalid");

            $checkComponent = apiModel::checkApiComponent(
                $siteCode,
                $component,
                apiModel::getLang()
            );

            if(!$checkComponent) throw new \Exception("Component Information Invalid");

            if($checkToken["is_read"] === "passive") throw new \Exception("Api is not authorized to read information");


            Header::jsonResult("success","SUCCESS","Data is attached",apiModel::getOneRecordInMultiple($component,$siteCode,$record));


        }catch (\Exception $exception){

            Header::jsonResult("error","ERROR",$exception->getMessage(),[]);

        }

    }

    public static function getOneRecordInSingle($component = null,$siteCode = null,$token = null){

        try{

            if(is_null($component) && is_null($siteCode) && is_null($token))
                throw new \Exception("Required information not found");

            $checkToken = apiModel::checkApiToken(
                $siteCode,
                $token
            );

            if(!$checkToken) throw new \Exception("Api Information Is Invalid");

            $checkComponent = apiModel::checkApiComponent(
                $siteCode,
                $component,
                apiModel::getLang()
            );

            if(!$checkComponent) throw new \Exception("Component Information Invalid");

            if($checkToken["is_read"] === "passive") throw new \Exception("Api is not authorized to read information");


            Header::jsonResult("success","SUCCESS","Data is attached",apiModel::getOneRecordInSingle($component,$siteCode));


        }catch (\Exception $exception){

            Header::jsonResult("error","ERROR",$exception->getMessage(),[]);

        }

    }

    public static function getOneRecordInSingleV2($component = null,$siteCode = null,$token = null){

        try{

            if(is_null($component) && is_null($siteCode) && is_null($token))
                throw new \Exception("Required information not found");

            $checkToken = apiModel::checkApiToken(
                $siteCode,
                $token
            );

            if(!$checkToken) throw new \Exception("Api Information Is Invalid");

            $checkComponent = apiModel::checkApiComponent(
                $siteCode,
                $component,
                apiModel::getLang()
            );

            if(!$checkComponent) throw new \Exception("Component Information Invalid");

            if($checkToken["is_read"] === "passive") throw new \Exception("Api is not authorized to read information");

            $export = [];

            foreach (apiModel::getOneRecordInSingle($component,$siteCode) as $item ){

                $export[$item->name] = $item->content;


            }

            Header::jsonResult("success","SUCCESS","Data is attached",$export);


        }catch (\Exception $exception){

            Header::jsonResult("error","ERROR",$exception->getMessage(),[]);

        }

    }



    public static function getAllCategory($siteCode = null,$token = null){

        try{


            $checkToken = apiModel::checkApiToken(
                $siteCode,
                $token
            );

            if(!$checkToken) throw new \Exception("Api Information Is Invalid");


            if($checkToken["is_read"] === "passive") throw new \Exception("Api is not authorized to read information");


            $export = [];

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

            foreach (apiModel::getAllCategories($siteCode,$getLang()) as $item){

                $export[$item["uuid"]] = [
                  "label"       => $item["label"],
                  "time"        => date("Y-m-d",$item["time"]),
                  "childs"    => apiModel::getAllSubCategories($item["uuid"],"uuid,parent,sort,label,link")
                ];

            }

            Header::jsonResult("success","SUCCESS","Data is attached",$export);


        }catch (\Exception $exception){

            Header::jsonResult("error","ERROR",$exception->getMessage(),[]);

        }

    }

    public static function getSearchDynamic($siteCode = null,$token = null,$crud = null){

        try{

            Header::checkParameter($_POST,["query","precision"]);
            Header::checkValue($_POST,["query","precision"]);

            $checkToken = apiModel::checkApiToken(
                $siteCode,
                $token
            );

            if(!$checkToken) throw new \Exception("Api Information Is Invalid");

            if($checkToken["is_read"] === "passive") throw new \Exception("Api is not authorized to read information");

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

            $query = [];

            if(json_decode($_POST["query"],true))
                foreach (json_decode($_POST["query"]) as $itemQuery)
                    $query[] = json_encode($itemQuery);



            $result = crudModel::getSpecialQuery(
                $siteCode,
                $crud,
                $getLang(),
                $query,
                (Header::post("precision") === "active" ? true : false)
            );

            $export = [];

            if(count($result) > 0)
                foreach ($result as $item)
                    $export[] = json_decode($item["content"]);

            if(count($export) === 0):
                Header::jsonResult("error","ERROR","Veri bulunamadı");
            else:
                Header::jsonResult("success","SUCCESS","Data is attached",$export);
            endif;

        }catch (\Exception $exception){

            Header::jsonResult("error","ERROR",$exception->getMessage(),[]);

        }

    }


    public static function exportCrud($component = null,$siteCode = null,$token = null){

        try{

            if(is_null($component) && is_null($siteCode) && is_null($token))
                throw new \Exception("Required information not found");

            $checkToken = apiModel::checkApiToken(
                $siteCode,
                $token
            );

            if(!$checkToken) throw new \Exception("Api Information Is Invalid");

            $checkComponent = apiModel::checkApiComponent(
                $siteCode,
                $component,
                apiModel::getLang()
            );

            if(!$checkComponent) throw new \Exception("Component Information Invalid");

            Header::jsonResult("success","SUCCESS","Data is attached",apiModel::getOneRecordInSingle($component,$siteCode));


        }catch (\Exception $exception){

            Header::jsonResult("error","ERROR",$exception->getMessage(),[]);

        }

    }

}