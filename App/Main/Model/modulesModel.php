<?php
/**
 * Created by PhpStorm.
 * User: cengizakcan
 * Date: 28.02.2020
 * Time: 16:26
 */

namespace App\Main\Model;


use  Fix\Packages\Database\Database;

class modulesModel {


    /**
     * @param null $crudCode
     * @return array|mixed
     */
    public static function getCrud($crudCode  = null){

        return Database::start()->select("crud")->where(["BINARY uuid","siteCode","BINARY language"],[$crudCode,$_SESSION["cms_auth_site"],$_SESSION["cms_aut_language"]])->run(Database::Single);

    }


    /**
     * @param null $recordCode
     * @param null $crudCode
     * @return array|mixed
     */
    public static function getRecord($recordCode  = null, $crudCode = null){

        return Database::start()->select("crud_contents")->where(["BINARY uuid","crudCode","siteCode"],[$recordCode,$crudCode,$_SESSION["cms_auth_site"]])->run(Database::Single);

    }

    public static function random_color_part() {

        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);

    }

    public static function random_color() {

        return self::random_color_part() . self::random_color_part() . self::random_color_part();

    }

    public static function moduleRecordAjaxListFilter($module = null,$content = null,$getContentInRecord = null,$item = null){

        if($module === "CHECKBOX"){

            $export = "";

            foreach(explode(",",$content) as $item){


                $export .= "<div style='white-space: break-spaces; margin-top: 4px; padding: 3px 9px; border: 1.5px dashed #0067f8; border-radius: 4px; color: #0067f8;'>$item</div>";

            }

            return [
                "status" => true,
                "content" => $export
            ];

        }else if($module === "TAGS"){

            $export = "";

            foreach(explode(",",$content) as $item){


                $export .= "<div style='white-space: break-spaces; margin-top: 4px; padding: 3px 9px; border: 1.5px dashed #0067f8; border-radius: 4px; color: #0067f8;'>$item</div>";

            }

            return [
                "status" => true,
                "content" => $export
            ];

        }else if($module === "MODULE"){

            $export = "";
            $exp = explode("::",$getContentInRecord->child);



            $getCrudRecord = crudModel::getContent($getContentInRecord->content,$item["siteCode"],"uuid",appModel::getLanguage());

            foreach (json_decode($getCrudRecord["content"]) as $content){
                if($content->name === $exp[1]){
                    return [
                        "status" => true,
                        "content" => $content->content
                    ];
                }
            }


            return [
                "status" => true,
                "content" => "Bulunamadı"
            ];

        }else{
            return [
                "status" => false,
                "content" => $content
            ];
        }

    }

}