<?php
/**
 * Created by PhpStorm.
 * User: cengizakcan
 * Date: 24.02.2020
 * Time: 17:51
 */

namespace App\Main\Model;


use Fix\Packages\Database\Database;
use Fix\Support\Header;


class authModel {


    /**
     * @param $email
     * @param $password
     * @return array|mixed
     */
    public static function login($site, $email, $password){

        return Database::start()->select("authorities")->where(["BINARY email","BINARY password","siteCode"],[$email,$password,$site])->run(Database::Single);

    }
    /**
     * @param $email
     * @param $password
     * @return array|mixed
     */
    public static function loginNormal($email, $password){

        return Database::start()->select("authorities")->where(["BINARY email","BINARY password"],[$email,$password])->run(Database::Single);

    }


    /**
     * @param null $user
     * @param $siteCode
     * @return array|mixed
     */
    public static function getUser($user = null, $siteCode){

        return Database::start()->select("authorities")->where(["BINARY uuid","BINARY siteCode"],[$user,$siteCode])->run(Database::Single);

    }

    /**
     * @param $siteCode
     * @return array|mixed
     */
    public static function getSiteWithCode($siteCode){

        return Database::start()->select("sites")->where(["BINARY uuid"],[$siteCode])->run(Database::Single);

    }


    /**
     * @param null $user
     * @param $siteCode
     * @return array|mixed
     */
    public static function userLastLoginUpdate($user = null, $siteCode){

        return Database::start()->update("authorities")->set(["lastLogin"],[time()])->where(["BINARY uuid","BINARY siteCode"],[$user,$siteCode])->run(Database::Progress);

    }


    /**
     * @param $site
     * @return array|mixed
     */
    public static function getSiteWithUrl($site){

        return Database::start()->select("sites")->where(["BINARY domain"],[$site])->run(Database::Single);

    }


    /**
     * @param $uuid
     * @return array|mixed
     */
    public static function getSite($uuid){

        return Database::start()->select("sites")->where(["BINARY uuid"],[$uuid])->run(Database::Single);

    }


    /**
     * @param $siteCode
     * @return array|mixed
     */
    public static function getAll($siteCode){

        return Database::start()->select("authorities")->where(["siteCode"],[$siteCode])->run(Database::Multiple);

    }


    /**
     * @param null $siteCode
     * @param null $uuid
     * @return array|mixed
     */
    public static function getUserWithUuid($siteCode = null, $uuid = null){

        return Database::start()->select("authorities")->where(["siteCode","uuid"],[$siteCode,$uuid])->run(Database::Single);

    }


    /**
     * @param null $siteCode
     * @param null $uuid
     * @return array|mixed
     */
    public static function deleteUserWithUuid($siteCode = null, $uuid = null){

        return Database::start()->delete("authorities")->where(["siteCode","uuid"],[$siteCode,$uuid])->run(Database::Progress);

    }

    /**
     * @param $email
     * @return array|mixed
     */
    public static function checkEmail($email){

        return Database::start()->select("authorities")->where(["email"],[$email])->run(Database::Single);

    }



    /**
     * @param $name
     * @param $surname
     * @param $email
     * @param $phone
     * @param $password
     * @param $type
     * @param $permission
     * @param $site
     * @param $uuid
     * @return array|mixed
     */
    public static function createUser($name, $surname, $email, $phone, $password, $type, $permission, $site, $uuid){

        return Database::start()->insert("authorities")->set(["name","surname","email","phone","password","user_type","user_permissions","siteCode","uuid","ip","time","status"],[$name,$surname,$email,$phone,$password,$type,$permission,$site,$uuid,$_SERVER["REMOTE_ADDR"],time(),"active"])->run(Database::Progress);

    }


    /**
     * @param $name
     * @param $surname
     * @param $email
     * @param $phone
     * @param $password
     * @param $type
     * @param $permission
     * @param $site
     * @param $uuid
     * @return array|mixed
     */
    public static function updateUserWithPassword($name, $surname, $email, $phone, $password, $type, $permission, $site, $uuid){

        return Database::start()->update("authorities")->set(["name","surname","email","phone","password","user_type","user_permissions"],[$name,$surname,$email,$phone,$password,$type,$permission])->where(["siteCode","uuid"],[$site,$uuid])->run(Database::Progress);

    }


    /**
     * @param $name
     * @param $surname
     * @param $email
     * @param $phone
     * @param $type
     * @param $permission
     * @param $site
     * @param $uuid
     * @return array|mixed
     */
    public static function updateWithNonPassword($name, $surname, $email, $phone, $type, $permission, $site, $uuid){

        return Database::start()->update("authorities")->set(["name","surname","email","phone","user_type","user_permissions"],[$name,$surname,$email,$phone,$type,$permission])->where(["siteCode","uuid"],[$site,$uuid])->run(Database::Progress);

    }

    /**
     * @param $name
     * @param $surname
     * @param $email
     * @param $phone
     * @param $type
     * @param $permission
     * @param $site
     * @param $uuid
     * @return array|mixed
     */
    public static function updateUserWithDetails($name, $surname, $email, $phone, $type, $permission, $site, $uuid){

        return Database::start()->update("authorities")->set(["name","surname","email","phone","user_type","user_permissions"],[$name,$surname,$email,$phone,$type,$permission])->where(["siteCode","uuid"],[$site,$uuid])->run(Database::Progress);

    }

    /**
     * @param null $siteCode
     * @return array|mixed
     */
    public static function getList($siteCode = null ){

        return Database::start()->select("authorities")->where(["siteCode"],[$siteCode])->run(Database::Multiple);

    }



}