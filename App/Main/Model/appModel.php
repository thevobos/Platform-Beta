<?php
/**
 * Created by PhpStorm.
 * User: cengizakcan
 * Date: 15.03.2020
 * Time: 14:31
 */

namespace App\Main\Model;


use Fix\Packages\Database\Database;

class appModel {


    public static function getSiteCode(){

        return isset($_SESSION["cms_auth_site"]) ? $_SESSION["cms_auth_site"] : false;

    }


    public static function isManager(){

        return isset($_SESSION["cms_auth_manager"]) ? $_SESSION["cms_auth_manager"] : false;

    }

    public static function getAuthId(){

        return isset($_SESSION["cms_auth_code"]) ? $_SESSION["cms_auth_code"] : false;

    }

    public static function getAuthUuid(){

        return isset($_SESSION["cms_auth_uuid"]) ? $_SESSION["cms_auth_uuid"] : false;

    }


    public static function getLanguage(){

        return isset($_SESSION["cms_aut_language"]) ? $_SESSION["cms_aut_language"] : false;

    }
    public static function getEmail(){

        return isset($_SESSION["cms_auth_email"]) ? $_SESSION["cms_auth_email"] : false;

    }

    /**
     * @param $siteCode
     * @param $write
     * @param $read
     * @param $update
     * @param $delete
     * @return array|mixed
     */
    public static function saveToken($siteCode, $write, $read, $update, $delete) {

        return Database::start()->insert("tokens")->set(["uuid","siteCode","is_write","is_read","is_update","is_delete","time","ip"],[self::createUuid(),$siteCode,$write,$read,$update,$delete,time(),$_SERVER["REMOTE_ADDR"]])->run(Database::Progress);

    }


    /**
     * @param $siteCode
     * @return array|mixed
     */
    public static function getTokens($siteCode) {

        return Database::start()->select("tokens")->where(["siteCode"],[$siteCode])->run(Database::Multiple);

    }

    /**
     * @param $siteCode
     * @return array|mixed
     */
    public static function getApi($siteCode) {

        return Database::start()->select("crud")->where(["siteCode","language"],[$siteCode,$_SESSION["cms_aut_language"]])->run(Database::Multiple);

    }

    /**
     * @param $token
     * @param $siteCode
     * @return array|mixed
     */
    public static function deleteToken($token, $siteCode) {

        return Database::start()->delete("tokens")->where(["uuid","siteCode"],[$token,$siteCode])->run(Database::Progress);

    }

    /**
     * @return array|mixed
     */
    public static function getSite() {

        return Database::start()->select("sites")->where(["uuid"],[$_SESSION["cms_auth_site"]])->run(Database::Single);

    }

    /**
     * @return array|mixed
     */
    public static function getSiteWithCode($code) {

        return Database::start()->select("sites")->where(["uuid"],[$code])->run(Database::Single);

    }

    /**
     * @return array|mixed
     */
    public static function getSiteWithManager($code,$manager) {

        return Database::start()->select("sites")->where(["uuid","manager"],[$code,$manager])->run(Database::Single);

    }

    /**
     * @param string $getEmail
     * @return array|mixed
     */
    public static function getUser($getEmail = "",$siteCode = "") {

        return Database::start()->select("authorities")->where(["email","siteCode"],[$getEmail,$siteCode])->run(Database::Single);

    }
    /**
     * @param string $code
     * @return array|mixed
     */
    public static function getManager($code = "") {

        return Database::start()->select("authorities")->where(["uuid","user_type"],[$code,"root"])->run(Database::Single);

    }

    /**
     * @param string $getEmail
     * @param array $key
     * @param array $val
     * @return array|mixed
     */
    public static function updateUserInfo($getEmail = "", $key = [], $val = [],$siteCode) {

        return Database::start()->update("authorities")->set($key,$val)->where(["email","siteCode"],[$getEmail,$siteCode])->run(Database::Progress);

    }


    /**
     * @return string
     */
    public static function createUuid(){

        return rand(1111,9999)."-".rand(1134,9874)."-".rand(1234,9876)."-".rand(1135,8762);
    }


    /**
     * @param string $default
     * @return string
     */
    public static function getLogo($default = "/assets/images/voboColor.png") {

        return self::getSite() ? "/Upload/static/original/".self::getSite()["logo"] : $default;

    }


    public static function userType($type){

        if($type === "root"){
            return "System administrator";
        }

        if($type === "admin"){
            return "Manager";
        }

        if($type === "user"){
            return "User";
        }

        if($type === "api"){
            return "Integration";
        }

    }



}