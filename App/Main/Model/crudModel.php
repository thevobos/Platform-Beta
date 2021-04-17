<?php

namespace App\Main\Model;


use Fix\Packages\Assets\Assets;
use Fix\Packages\Database\Database;

class crudModel {



    /**
     * @param $components
     * @param $siteCode
     * @return bool
     */
    public static function crudAssets($components,$siteCode) {

        return Assets::render($components,[
            "crudModel"     => crudModel::class,
            "modulesModel"  => modulesModel::class,
            "siteCode"      => $siteCode
        ]);

    }

    /**
     * @param $components
     * @param null $data
     * @return bool
     */
    public static function formAssets($components, $data = null) {

        return Assets::render($components,$data);

    }



    /**
     * @param $components
     * @param null $data
     * @return bool
     */
    public static function formEditAssets($components, $data = null) {

        return Assets::render($components,$data);

    }


    /**
     * @param $title
     * @param $component
     * @param $name
     * @param $required
     * @param $value
     * @param $table
     * @param $placeholder
     * @param $child
     * @param $content
     * @return array
     */
    public static function convertComponents($component, $title, $name, $required, $value, $table, $placeholder, $child, $content) {

        return [
            "component"   => $component,
            "title"       => $title,
            "name"        => $name,
            "required"    => $required,
            "value"       => $value,
            "table"       => $table,
            "placeholder" => $placeholder,
            "child"       => $child,
            "content"     => $content
        ];

    }


    /**
     * @param null $type
     * @return bool
     */
    public static function crudComponent($type = null,$siteCode = null){

        if($type === "TEXT"){
            return self::crudAssets("components/textCrud",$siteCode);
        }else if($type === "TAGS"){
            return self::crudAssets("components/tagsCrud",$siteCode);
        }else if($type === "SELECT"){
            return self::crudAssets("components/selectCrud",$siteCode);
        }else if($type === "RADIO"){
            return self::crudAssets("components/radioCrud",$siteCode);
        }else if($type === "NUMBER"){
            return self::crudAssets("components/numberCrud",$siteCode);
        }else if($type === "FILE"){
            return self::crudAssets("components/fileCrud",$siteCode);
        }else if($type === "EDITOR"){
            return self::crudAssets("components/editorCrud",$siteCode);
        }else if($type === "COLOR"){
            return self::crudAssets("components/colorCrud",$siteCode);
        }else if($type === "CHECKBOX"){
            return self::crudAssets("components/checkboxCrud",$siteCode);
        }else if($type === "TEXTAREA"){
            return self::crudAssets("components/textareaCrud",$siteCode);
        }else if($type === "DATE"){
            return self::crudAssets("components/dateCrud",$siteCode);
        }else if($type === "MODULE"){
            return self::crudAssets("components/moduleCrud",$siteCode);
        }else if($type === "MASK"){
            return self::crudAssets("components/maskCrud",$siteCode);
        }else if($type === "RANDOM"){
            return self::crudAssets("components/randomCrud",$siteCode);
        }
    }

    /**
     * @param null $type
     * @param null $data
     * @return bool
     */
    public static function formComponent($type = null, $data = null){

        if($type === "TEXT"){
            return self::formAssets("components/textForm",$data);
        }else if($type === "TAGS"){
            return self::formAssets("components/tagsForm",$data);
        }else if($type === "SELECT"){
            return self::formAssets("components/selectForm",$data);
        }else if($type === "RADIO"){
            return self::formAssets("components/radioForm",$data);
        }else if($type === "NUMBER"){
            return self::formAssets("components/numberForm",$data);
        }else if($type === "FILE"){
            return self::formAssets("components/fileForm",$data);
        }else if($type === "EDITOR"){
            return self::formAssets("components/editorForm",$data);
        }else if($type === "COLOR"){
            return self::formAssets("components/colorForm",$data);
        }else if($type === "CHECKBOX"){
            return self::formAssets("components/checkboxForm",$data);
        }else if($type === "TEXTAREA"){
            return self::formAssets("components/textareaForm",$data);
        }else if($type === "DATE"){
            return self::formAssets("components/dateForm",$data);
        }else if($type === "MODULE"){
            return self::formAssets("components/moduleForm",$data);
        }else if($type === "MASK"){
            return self::formAssets("components/maskForm",$data);
        }else if($type === "RANDOM"){
            return self::formAssets("components/randomForm",$data);
        }
    }


    /**
     * @param null $type
     * @param null $data
     * @return bool
     */
    public static function formEditComponent($type = null, $data = null){

        if($type === "TEXT"){
            return self::formEditAssets("components/textEditForm",$data);
        }else if($type === "TAGS"){
            return self::formEditAssets("components/tagsEditForm",$data);
        }else if($type === "SELECT"){
            return self::formEditAssets("components/selectEditForm",$data);
        }else if($type === "RADIO"){
            return self::formEditAssets("components/radioEditForm",$data);
        }else if($type === "NUMBER"){
            return self::formEditAssets("components/numberEditForm",$data);
        }else if($type === "FILE"){
            return self::formEditAssets("components/fileEditForm",$data);
        }else if($type === "EDITOR"){
            return self::formEditAssets("components/editorEditForm",$data);
        }else if($type === "COLOR"){
            return self::formEditAssets("components/colorEditForm",$data);
        }else if($type === "CHECKBOX"){
            return self::formEditAssets("components/checkboxEditForm",$data);
        }else if($type === "TEXTAREA"){
            return self::formEditAssets("components/textareaEditForm",$data);
        }else if($type === "DATE"){
            return self::formEditAssets("components/dateEditForm",$data);
        }else if($type === "MODULE"){
            return self::formEditAssets("components/moduleEditForm",$data);
        }else if($type === "MASK"){
            return self::formEditAssets("components/maskEditForm",$data);
        }else if($type === "RANDOM"){
            return self::formEditAssets("components/randomEditForm",$data);
        }
    }

    /**
     * @param null $type
     * @param null $data
     * @return bool
     */
    public static function formSingleComponent($type = null, $data = null){

        if($type === "TEXT"){
            return self::formEditAssets("components/textSingle",$data);
        }else if($type === "TAGS"){
            return self::formEditAssets("components/tagsSingle",$data);
        }else if($type === "SELECT"){
            return self::formEditAssets("components/selectSingle",$data);
        }else if($type === "RADIO"){
            return self::formEditAssets("components/radioSingle",$data);
        }else if($type === "NUMBER"){
            return self::formEditAssets("components/numberSingle",$data);
        }else if($type === "FILE"){
            return self::formEditAssets("components/fileSingle",$data);
        }else if($type === "EDITOR"){
            return self::formEditAssets("components/editorEditForm",$data);
        }else if($type === "COLOR"){
            return self::formEditAssets("components/colorEditForm",$data);
        }else if($type === "CHECKBOX"){
            return self::formEditAssets("components/checkboxEditForm",$data);
        }else if($type === "TEXTAREA"){
            return self::formEditAssets("components/textareaEditForm",$data);
        }else if($type === "DATE"){
            return self::formEditAssets("components/dateEditForm",$data);
        }else if($type === "MODULE"){
            return self::formEditAssets("components/moduleEditForm",$data);
        }else if($type === "MASK"){
            return self::formEditAssets("components/maskEditForm",$data);
        }else if($type === "RANDOM"){
            return self::formEditAssets("components/randomEditForm",$data);
        }
    }


    /**
     * @param $uuid
     * @param $siteCode
     * @param $menuCategory
     * @param $label
     * @param $components
     * @param $slug
     * @param $slugComponent
     * @param $operation
     * @return array|mixed
     */
    public static function newCrudRecord($uuid, $siteCode, $menuCategory, $label, $components, $slug, $slugComponent, $operation,$language,$listing){

        return Database::start()->insert("crud")->set(["uuid","siteCode","menuCategory","label","components","slug","slugComponent","operation","language","ip","time","listing"],[$uuid,$siteCode,$menuCategory,$label,$components,$slug,$slugComponent,$operation,$language,$_SERVER["REMOTE_ADDR"],time(),$listing])->run(Database::Progress);

    }
    /**
     * @param $uuid
     * @param $siteCode
     * @param $menuCategory
     * @param $label
     * @param $components
     * @param $slug
     * @param $slugComponent
     * @param $operation
     * @return array|mixed
     */
    public static function updateCrudRecord($uuid, $siteCode, $menuCategory, $label, $components, $slug, $slugComponent, $operation, $listing){

        return Database::start()->update("crud")->set(["menuCategory","label","components","slug","slugComponent","operation","ip","time","listing"],[$menuCategory,$label,$components,$slug,$slugComponent,$operation,$_SERVER["REMOTE_ADDR"],time(),$listing])->where(["uuid","siteCode"],[$uuid, $siteCode])->run(Database::Progress);

    }

    /**
     * @param $uuid
     * @param $siteCode
     * @param $language
     * @return array|mixed
     */
    public static function getCrud($uuid, $siteCode, $language){

        return Database::start()->select("crud")->where(["uuid","siteCode","language"],[$uuid,$siteCode,$language])->run(Database::Single);

    }

    /**
     * @param $uuid
     * @return array|mixed
     */
    public static function getCrudAdmin($uuid){

        return Database::start()->select("crud")->where(["uuid"],[$uuid])->run(Database::Single);

    }

    /**
     * @param $siteCode
     * @param string $operation
     * @return array|mixed
     */
    public static function getCrudWithSiteCode($siteCode, $operation = "multiple"){

        return Database::start()->select("crud")->where(["siteCode","operation","language"],[$siteCode,$operation,$_SESSION["cms_aut_language"]])->run(Database::Multiple);

    }

    /**
     * @param $uuid
     * @param $siteCode
     * @return array|mixed
     */
    public static function deleteContent($uuid, $siteCode, $language){

        return Database::start()->delete("crud_contents")->where(["uuid","siteCode","language"],[$uuid,$siteCode, $language])->run(Database::Progress);

    }

    /**
     * @param $crudCode
     * @param $siteCode
     * @return array|mixed
     */
    public static function deleteCrudContent($crudCode, $siteCode){

        return Database::start()->delete("crud_contents")->where(["crudCode","siteCode"],[$crudCode,$siteCode])->run(Database::Progress);

    }

    /**
     * @param $uuid
     * @return array|mixed
     */
    public static function deleteCrud($uuid,$siteCode){

        return Database::start()->delete("crud")->where(["uuid","siteCode"],[$uuid,$siteCode])->run(Database::Progress);

    }


    /**
     * @param $uuid
     * @param $siteCode
     * @param $content
     * @return array|mixed
     */
    public static function updateCrudComponents($uuid, $siteCode, $content,$language){

        return Database::start()->update("crud")->set(["components"],[$content])->where(["uuid","siteCode","language"],[$uuid,$siteCode,$language])->run(Database::Progress);

    }

    /**
     * @param $uuid
     * @param $siteCode
     * @param string $key
     * @return array|mixed
     */
    public static function getContent($uuid, $siteCode, $key = "uuid", $language = null){

        return Database::start()->select("crud_contents")->where([$key,"siteCode","language"],[$uuid,$siteCode,$language])->run(Database::Single);

    }

    /**
     * @param $siteCode
     * @return array|mixed
     */
    public static function getAllContent($siteCode){

        return Database::start()->select("crud_contents")->where(["siteCode"],[$siteCode])->run(Database::Multiple);

    }

    /**
     * @param $crudCode
     * @param $siteCode
     * @param $order
     * @return array|mixed
     */
    public static function getContents($crudCode, $siteCode,$order = "ASC",$Limit = 99999,$language){

        return Database::start()->select("crud_contents")->where(["crudCode","siteCode","language"],[$crudCode,$siteCode,$language])->orderby("id",$order)->limit(0,$Limit)->run(Database::Multiple);

    }

    /**
     * @param $crudCode
     * @param $siteCode
     * @param $content
     * @param $slug
     * @param $category
     * @return array|mixed
     */
    public static function saveCrud($crudCode, $siteCode, $content, $slug, $category,$language){

        return Database::start()->insert("crud_contents")->set(["uuid","crudCode","siteCode","content","slug","category","language","ip","time"],[self::createUuid(),$crudCode,$siteCode,$content,$slug,$category,$language,$_SERVER["REMOTE_ADDR"],time()])->run(Database::Progress);

    }

    /**
     * @param $uuid
     * @param $crudCode
     * @param $siteCode
     * @param $content
     * @param $slug
     * @param $category
     * @return array|mixed
     */
    public static function updateCrud($uuid, $crudCode, $siteCode, $content, $slug, $category,$language){

        return Database::start()->update("crud_contents")->set(["crudCode","siteCode","content","slug","category","ip","time"],[$crudCode,$siteCode,$content,$slug,$category,$_SERVER["REMOTE_ADDR"],time()])->where(["uuid","language"],[$uuid,$language])->run(Database::Progress);

    }

    /**
     * @return string
     */
    public static function createUuid(){

        return rand(1111,9999)."-".rand(11234,98764)."-".rand(1234,9876)."-".rand(11345,98762);

    }

    /**
     * @param $siteCode
     * @param $crudCode
     * @param $language
     * @return array|mixed
     */
    public static function getCrudComponents($siteCode, $crudCode, $language){

        return Database::start()->select("crud_contents")->where(["crudCode","siteCode","language"],[$crudCode,$siteCode,$language])->run(Database::Multiple);

    }

    /**
     * @param $siteCode
     * @return array|mixed
     */
    public static function getCrudList($siteCode){

        return Database::start()->select("crud")->where(["siteCode","language"],[$siteCode,language::$defaultLang])->run(Database::Multiple);

    }

    /**
     * @param string $site
     * @param string $crud
     * @param string $language
     * @param array $json
     * @param bool $precision
     * @return array|mixed
     */
    public static function getSpecialQuery($site = "", $crud = "", $language = "tr", $json = [], $precision = false){

        $getJson = [];
        foreach ($json as $item){
            $getJson[] =  ($precision ? "BINARY" : "")." JSON_CONTAINS(content, '$item')";
        }

        return Database::start()->manuel("SELECT * FROM crud_contents WHERE siteCode='$site' and crudCode='$crud' and language='$language' and ".implode(" AND ",$getJson))->run(Database::Multiple);

    }





}