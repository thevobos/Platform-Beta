<?php

namespace App\Main\Controller;

use App\Main\Model\appModel;
use App\Main\Model\authModel;
use App\Main\Model\cmsSupport;
use App\Main\Model\managementModel;
use App\Main\Model\modulesModel;
use Fix\Support\Header;
use App\Main\Model\crudModel;
use App\Main\Model\templateModel;
use App\Main\Model\menuModel;
use App\Main\Model\language;
use App\Main\Model\plugin;

class module {

    public static function records($modules = null){

        $get = modulesModel::getCrud($modules);

        if(!$get){
            Header::redirect("/not-found");
        }

        if($get["operation"] === "single"){
            Header::redirect("/");
        }

        if(
            (
                !plugin::check_permission($_SESSION["cms_auth_uuid"],$modules)
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


        templateModel::get("modules/records",modulesModel::getCrud($modules)["label"],[
            modulesModel::getCrud($modules)["label"],
            "Kayıtlar",
        ],[
            "menuModel"     => menuModel::class,
            "moduleModel"   => modulesModel::class,
            "modules"       => modulesModel::getCrud($modules),
            "crudModel"     => crudModel::class,
            "languageModel" => language::class,
            "code"          => $modules
        ]);

    }

    public static function create($modules = null){


        $modul = modulesModel::getCrud($modules);

        if(!$modul){
            Header::redirect("/not-found");
        }

        $get = json_decode($modul["components"]);

        if(
            (
                !plugin::check_permission($_SESSION["cms_auth_uuid"],$modules)
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
            Header::redirect("/");
        }

        if(modulesModel::getCrud($modules)["operation"] === "single"){
            Header::redirect("/");
        }

        templateModel::get("modules/create",modulesModel::getCrud($modules)["label"],[
            modulesModel::getCrud($modules)["label"],
            "New Recording"
        ],[
            "menuModel"         => menuModel::class,
            "components"        => $get,
            "modules"           => modulesModel::getCrud($modules),
            "moduleModel"       => modulesModel::class,
            "languageModel"     => language::class,
            "crudModel"         => crudModel::class
        ]);

    }

    public static function edit($modules = null,$record = null){

        $check = modulesModel::getRecord($record,$modules);

        if(!$check){
            Header::redirect("/not-found");
        }

        if(!modulesModel::getRecord($record,$modules)){
            Header::redirect("/");
        }

        $get = json_decode(modulesModel::getCrud($modules)["components"]);

        if(modulesModel::getCrud($modules)["operation"] === "single"){
            Header::redirect("/");
        }

        if(modulesModel::getRecord($record,$modules)["language"] !== $_SESSION["cms_aut_language"]){
            Header::redirect("/");
        }

        if(
            (
                !plugin::check_permission($_SESSION["cms_auth_uuid"],$modules)
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
            Header::redirect("/");
        }

        templateModel::get("modules/edit",modulesModel::getCrud($modules)["label"],[
            modulesModel::getCrud($modules)["label"],
            "Records",
            modulesModel::getRecord($record,$modules)["uuid"]
        ],[
            "menuModel"         => menuModel::class,
            "components"        => $get,
            "modules"           => modulesModel::getCrud($modules),
            "moduleModel"       => modulesModel::class,
            "languageModel"     => language::class,
            "crudModel"         => crudModel::class,
            "record"            => modulesModel::getRecord($record,$modules)
        ]);

    }

    public static function single($modules = null){


        $check = modulesModel::getCrud($modules);

        if(!$check){
            Header::redirect("/not-found");
        }

        $get = json_decode($check["components"]);

        if(modulesModel::getCrud($modules)["operation"] === "multiple"){
            Header::redirect("/");
        }

        if(
            (
                !plugin::check_permission($_SESSION["cms_auth_uuid"],$modules)
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
            Header::redirect("/");
        }

        templateModel::get("modules/single",modulesModel::getCrud($modules)["label"],[
            modulesModel::getCrud($modules)["label"]
        ],[
            "menuModel"         => menuModel::class,
            "components"        => $get,
            "modules"           => modulesModel::getCrud($modules),
            "languageModel" => language::class,
            "moduleModel"       => modulesModel::class,
            "crudModel"         => crudModel::class
        ]);

    }

    public static function settings(){

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
            throw new \Exception("Unauthorized transaction");

        }



        templateModel::get("modules/settings","Home",[
            "asdas"
        ],[
            "menuModel" => menuModel::class,
            "moduleModel"   => modulesModel::class,
            "languageModel" => language::class,
            "crudModel"     => crudModel::class
        ]);

    }

    public static function removeModule(){

        try{

            Header::checkParameter($_POST,["modules","siteCode"]);
            Header::checkValue($_POST,["modules","siteCode"]);

            $getModules = crudModel::getCrudAdmin(
                Header::post("modules")
            );

            if(!$getModules)
                throw new \Exception("Component Not Found");

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


            crudModel::deleteCrudContent(
                Header::post("modules"),
                Header::post("siteCode")
            );

            crudModel::deleteCrud(
                Header::post("modules"),
                Header::post("siteCode")
            );



            Header::jsonResult("success","SUCCESS","Component Silindi.");

        }catch (\Exception $exception){

            Header::jsonResult("error","ERROR",$exception->getMessage());
        }


    }

    public static function saveAjax(){

      try{

          Header::checkParameter($_POST,["modules"]);
          Header::checkValue($_POST,["modules"]);

          $getModules = crudModel::getCrud(
              Header::post("modules"),
              $_SESSION["cms_auth_site"],
              $_SESSION["cms_aut_language"]
          );

          $getLimit       = appModel::getSiteWithCode($getModules["siteCode"])["record_limit"];
          $getAllRecord   = count(crudModel::getAllContent($getModules["siteCode"]));

          if($getLimit > 0)
              if($getAllRecord > $getLimit)
                  throw new \Exception("Your registration limit has exceeded. Please contact your system administrator.");


          if(!$getModules)
              throw new \Exception("Module Not Found");

          if(
              (
                  !plugin::check_permission($_SESSION["cms_auth_uuid"],Header::post("modules"))
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


          $getComponents = json_decode($getModules["components"])->crud;

          $modules = [];

          foreach ($getComponents as $item){
              if($item->required === "active"){
                  if(isset($_POST[$item->name])){
                      $modules[] = $item->name;
                  }
              }
          }

          foreach ($getComponents as $key => $item){

              $getComponents[$key]->content = isset($_POST[$item->name]) ? is_array( Header::post($item->name)) ? implode(",", Header::post($item->name)) :  Header::post($item->name) : null;

          }



          Header::checkParameter($_POST,$modules);
          Header::checkValue($_POST,$modules);

          crudModel::saveCrud(
              $getModules["uuid"],
              $_SESSION["cms_auth_site"],
              json_encode($getComponents,JSON_UNESCAPED_UNICODE),
              $getModules["slug"] === "active" ? cmsSupport::permalink(Header::post($getModules["slugComponent"])) : "passive",
              Header::post("voboCategory"),
              $_SESSION["cms_aut_language"]
          );

          Header::jsonResult("success","SUCCESS","New record added");

      }catch (\Exception $exception){

          Header::jsonResult("error","ERROR",$exception->getMessage());
      }

    }


    public static function singleAjax(){

      try{

          Header::checkParameter($_POST,["modules"]);
          Header::checkValue($_POST,["modules"]);

          $getModules = crudModel::getCrud
          (
              Header::post("modules"),
              $_SESSION["cms_auth_site"],
              $_SESSION["cms_aut_language"]
          );

          if(!$getModules)
              throw new \Exception("Module Not Found");

          $getComponents = json_decode($getModules["components"])->crud;



          if(
              (
                  !plugin::check_permission($_SESSION["cms_auth_uuid"],Header::post("modules"))
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


          foreach ($getComponents as $item)
              $item->content = isset($_POST[$item->name]) ? Header::post($item->name) : null;

          $convert["crud"] = $getComponents;


          crudModel::updateCrudComponents(
              Header::post("modules"),
              $_SESSION["cms_auth_site"],
              json_encode($convert,JSON_UNESCAPED_UNICODE),
              $_SESSION["cms_aut_language"]
              );

          Header::jsonResult("success","SUCCESS","New record updated");



      }catch (\Exception $exception){

          Header::jsonResult("error","ERROR",$exception->getMessage());
      }

    }

    public static function updateAjax(){

      try{

          Header::checkParameter($_POST,["modules","record"]);
          Header::checkValue($_POST,["modules","record"]);


          $getCont = crudModel::getContent(
              Header::post("record"),
              $_SESSION["cms_auth_site"],
              "uuid",
              $_SESSION["cms_aut_language"]
          );

          if(!$getCont)
              throw new \Exception("Content Not Found");

          $getModules = crudModel::getCrud(
              Header::post("modules"),
              $_SESSION["cms_auth_site"],
              $_SESSION["cms_aut_language"]
          );

          if(!$getModules)
              throw new \Exception("Module Not Found");

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


          if(
              (
                  !plugin::check_permission($_SESSION["cms_auth_uuid"],Header::post("modules"))
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

          crudModel::updateCrud(
              Header::post("record"),
              $getModules["uuid"],
              $_SESSION["cms_auth_site"],
              json_encode($getComponents,JSON_UNESCAPED_UNICODE),
              $getModules["slug"] === "active" ? cmsSupport::permalink(Header::post($getModules["slugComponent"])) : "passive",
              Header::post("voboCategory"),
              $_SESSION["cms_aut_language"]
          );

          Header::jsonResult("success","SUCCESS","Data updated");

      }catch (\Exception $exception){

          Header::jsonResult("error","ERROR",$exception->getMessage());
      }

    }

    public static function removeAjax(){

      try{

          Header::checkParameter($_POST,["record"]);
          Header::checkValue($_POST,["record"]);

          $getCont = crudModel::getContent(
              Header::post("record"),
              $_SESSION["cms_auth_site"],
              "uuid",
              $_SESSION["cms_aut_language"]
          );

          if(!$getCont)
              throw new \Exception("Content Not Found");


          if(
              (
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

          crudModel::deleteContent(
              Header::post("record"),
              $_SESSION["cms_auth_site"],
              $_SESSION["cms_aut_language"]
          );

          Header::jsonResult("success","SUCCESS","Data removed");

      }catch (\Exception $exception){

          Header::jsonResult("error","ERROR",$exception->getMessage());
      }

    }

    public static function recordAjax($module = null){

        try{

            if(!isset($module))
                throw new \Exception("Incoming code not found");


            $getModules = crudModel::getCrud(
                $module,
                $_SESSION["cms_auth_site"],
                $_SESSION["cms_aut_language"]
            );

            if(!$getModules)
                throw new \Exception("Module Not Found");

            $getRecords = crudModel::getContents(
                $module,
                $_SESSION["cms_auth_site"],
                "ASC",
                "99999",
                $_SESSION["cms_aut_language"]
            );


            if(
                (
                    !plugin::check_permission($_SESSION["cms_auth_uuid"],$module)
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
                throw new \Exception("Unauthorized transaction");

            }

            if(!$getRecords)
                throw new \Exception("No Records Found");

            $compList = [];

            $getModuleInCrud = json_decode($getModules["components"])->crud;

            foreach ($getModuleInCrud as $item ){
                if($item->table === "active"){
                    $compList[] = $item->name;
                }
            }

            $export = [];

            $counter = 0;

            foreach($getRecords as $item){

                $componentDecode = json_decode($item["content"]);

                $export[$counter] = [];
                $exportCounter = 0;

                foreach ($componentDecode as $getContentInRecord){

                    $export[$counter][0] = $item["uuid"];

                    if($getContentInRecord->table === "active" and in_array($getContentInRecord->name,$compList)){

                        $exportCounter += 1;

                        if(modulesModel::moduleRecordAjaxListFilter($getContentInRecord->component, $getContentInRecord->content,$getContentInRecord,$item)["status"]){
                            $export[$counter][] = modulesModel::moduleRecordAjaxListFilter($getContentInRecord->component, $getContentInRecord->content,$getContentInRecord,$item)["content"];
                        }else{
                            $export[$counter][] = $getContentInRecord->content;
                        }

                    }



                }


                if(count($compList) !== $exportCounter){
                    $export[$counter][] = "INCOMPATIBLE RECORD";
                }

                $export[$counter][count($compList)+1] = date("Y-m-d H:i:s",$item["time"]);

                $counter += 1;

            }


            Header::jsonResult("success","SUCCESS","New record added",$export);

        }catch (\Exception $exception){

            Header::jsonResult("error","ERROR",$exception->getMessage(),[]);
        }


    }

}