<?php


namespace App\Main\Model;


use Fix\Packages\Database\Database;

use App\Main\Model\plugin;

class menuModel {



    /**
     * @param $siteCode
     * @param $id
     * @return array|mixed
     */
    public static function getCategory($siteCode, $id){

        return Database::start()->select("menu_categories")->where(["siteCode","uuid","language"],[$siteCode,$id,$_SESSION["cms_aut_language"]])->run(Database::Single);

    }


    /**
     * @param $siteCode
     * @return array|mixed
     */
    public static function listCategory($siteCode){

        return Database::start()->select("menu_categories")->where(["siteCode","language"],[$siteCode,$_SESSION["cms_aut_language"]])->run(Database::Multiple);

    }

    /**
     * @param $siteCode
     * @param $label
     * @return array|mixed
     */
    public static function createCategory($siteCode, $label){

        return Database::start()->insert("menu_categories")->set(["uuid","siteCode","label","ip","time","language"],[self::createUuid(),$siteCode,$label,$_SERVER["REMOTE_ADDR"],time(),$_SESSION["cms_aut_language"]])->run(Database::Progress);

    }

    /**
     * @param $siteCode
     * @param $id
     * @return array|mixed
     */
    public static function deleteMenu($siteCode, $id){

        return Database::start()->delete("menu_categories")->where(["siteCode","uuid","language"],[$siteCode,$id,$_SESSION["cms_aut_language"]])->run(Database::Progress);

    }

    /**
     * @param $siteCode
     * @param $menuCategory
     * @return array|mixed
     */
    public static function deleteMenuItemAllCategory($siteCode, $menuCategory){

        return Database::start()->delete("menu_items")->where(["siteCode","menuCategory","language"],[$siteCode,$menuCategory,$_SESSION["cms_aut_language"]])->run(Database::Progress);

    }

    /**
     * @param $siteCode
     * @param $id
     * @return array|mixed
     */
    public static function deleteMenuItem($siteCode, $id){

        return Database::start()->delete("menu_items")->where(["siteCode","uuid","language"],[$siteCode,$id,$_SESSION["cms_aut_language"]])->run(Database::Progress);

    }

    /**
     * @param $siteCode
     * @param $menuCategory
     * @return array|mixed
     */
    public static function listMenuItems($siteCode, $menuCategory){

        return Database::start()->select("menu_items")->where(["siteCode","menuCategory","language"],[$siteCode,$menuCategory,$_SESSION["cms_aut_language"]])->orderby("sort","ASC")->run(Database::Multiple);

    }

    /**
     * @param $siteCode
     * @param $menuId
     * @return array|mixed
     */
    public static function getMenuItems($siteCode, $menuId){

        return Database::start()->select("menu_items")->where(["siteCode","uuid","language"],[$siteCode,$menuId,$_SESSION["cms_aut_language"]])->run(Database::Single);

    }

    /**
     * @param $siteCode
     * @param $menuCategory
     * @param $label
     * @param $link
     * @return array|mixed
     */
    public static function createMenuItem($siteCode, $menuCategory, $label, $link){

        return Database::start()->insert("menu_items")->set(["uuid","parent","sort","siteCode","menuCategory","label","link","ip","time","language"],[self::createUuid(),"0","99",$siteCode,$menuCategory,$label,$link,$_SERVER["REMOTE_ADDR"],time(),$_SESSION["cms_aut_language"]])->run(Database::Progress);

    }

    /**
     * @param $siteCode
     * @param $id
     * @param array $key
     * @param array $val
     * @return array|mixed
     */
    public static function updateMenuItem($siteCode, $id, $key = [], $val = []){

        return Database::start()->update("menu_items")->set($key,$val)->where(["siteCode","uuid"],[$siteCode,$id])->run(Database::Progress);

    }

    /**
     * @param $siteCode
     * @param $id
     * @param array $key
     * @param array $val
     * @return array|mixed
     */
    public static function updateMenu($siteCode, $id, $key = [], $val = []){

        return Database::start()->update("menu_categories")->set($key,$val)->where(["siteCode","uuid"],[$siteCode,$id])->run(Database::Progress);

    }

    /**
     * @param $sort
     * @param $parent
     * @param $id
     * @return array|mixed
     */
    public static function updateMenuItemNestable($sort, $parent, $id){

        return Database::start()->update("menu_items")->set(["sort","parent"],[$sort,$parent])->where(["uuid"],[$id])->run(Database::Progress);

    }

    /**
     * @param $site
     * @return array|mixed
     */
    public static function getMenuListMultiple($site){

        return Database::start()->select("crud")->where(["siteCode","operation","language"],[$site,"multiple",$_SESSION["cms_aut_language"]])->orderby("listing","ASC")->run(Database::Multiple);

    }

    /**
     * @param $site
     * @return array|mixed
     */
    public static function getMenuListSingle($site){

        return Database::start()->select("crud")->where(["siteCode","operation","language"],[$site,"single",$_SESSION["cms_aut_language"]])->run(Database::Multiple);

    }

    /**
     * @param $siteCode
     * @param $menuCategory
     * @return string
     */
    public static function getNestable($siteCode, $menuCategory){

        return nestable::buildMenu(
                    nestable::sqlConverter(
                        self::listMenuItems(
                            $siteCode,
                            $menuCategory
                            
                        )
                    )
                );

    }

    /**
     * @return string
     */
    public static function createUuid(){

        return rand(1111,9999)."-".rand(1134,9874)."-".rand(1234,9876)."-".rand(1135,8762);
    }




}