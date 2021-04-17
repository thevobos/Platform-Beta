<?php

namespace App\Main\Model;

use Fix\Packages\Database\Database;

class managementModel {

    /**
     * @return array|mixed
     */
    public static function getSites($manager = null) {

        return Database::start()->select("sites")->where(["manager"],[$manager])->run(Database::Multiple);

    }

    /**
     * @param $uuid
     * @param $domain
     * @param $title
     * @param $author
     * @param $logo
     * @return array|mixed
     */
    public static function siteAdd($manager,$uuid, $domain, $title, $author, $logo,$record_limit) {

        return Database::start()->insert("sites")->set(["manager","uuid","domain","title","author","logo","ip","time","record_limit"],[$manager,$uuid,$domain,$title,$author,$logo,$_SERVER["REMOTE_ADDR"],time(),$record_limit])->run(Database::Progress);

    }

    /**
     * @param $uuid
     * @param $domain
     * @param $title
     * @param $author
     * @param $logo
     * @param $plugins
     * @return array|mixed
     */
    public static function siteUpdate($uuid, $domain, $title, $author, $logo,$plugins,$record_limit) {

        return Database::start()->update("sites")->set(["record_limit","plugins","domain","title","author","logo"],[$record_limit,$plugins,$domain,$title,$author,$logo])->where(["uuid"],[$uuid])->run(Database::Progress);

    }

    /**
     * @param $uuid
     * @param $name
     * @param $surname
     * @param $phone
     * @param $email
     * @param $password
     * @param $siteCode
     * @param $status
     * @return array|mixed
     */
    public static function authAdd($uuid, $name, $surname, $phone, $email, $password, $siteCode, $status) {
  ///aaaa
        return Database::start()->insert("authorities")->set(["uuid","siteCode","name","surname","phone","email","status","password","ip","time","user_type","user_permissions"],[$uuid,$siteCode,$name,$surname,$phone,$email,$status,$password,$_SERVER["REMOTE_ADDR"],time(),"admin","[]"])->run(Database::Progress);

    }

    /**
     * @param null $uuid
     * @return array|mixed
     */
    public static function getSitesDetails($uuid = null) {

        return Database::start()->select("sites")->where(["uuid"],[$uuid])->run(Database::Single);

    }

    /**
     * @return array|mixed
     */
    public static function getCrud($siteCode = null) {

        return Database::start()->select("crud")->where(["siteCode","language"],[$siteCode,language::$defaultLang])->run(Database::Multiple);

    }

    /**
     * @param $siteCode
     * @param $table
     * @param string $column
     * @return array|mixed
     */
    public static function removeDataAll($siteCode, $table, $column = "siteCode") {

        return Database::start()->delete($table)->where([$column],[$siteCode])->run(Database::Progress);

    }


}