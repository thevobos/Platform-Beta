<?php

class cms {

    public static $API_ENDPOINT = "https://fw.m2kdijital.com";

    public static $SECRET       = "527-9237-2216-5378";

    public static $TOKEN        = "2669-5935-4053-1338";


    /**
     * @param null $module
     * @param array $data
     * @return mixed
     */
    public static function addRecord($module = null, array $data = [] ){

        return json_decode
        (
            self::postRequest(
                self::$API_ENDPOINT."/api/v1/insert/multiple/".$module."/".self::$SECRET."/".self::$TOKEN."?language=".$_SESSION["language"],
                $data
            )
        )->data;

    }

    /**
     * @param null $module
     * @param null $uuid
     * @param array $data
     * @return mixed
     */
    public static function updateRecord($module = null, $uuid = null , array $data = [] ){

        return json_decode
        (
            self::postRequest
            (
                self::$API_ENDPOINT."/api/v1/update/multiple/{$module}/".self::$SECRET."/".self::$TOKEN."/".$uuid."?language=".$_SESSION["language"],
                $data
            )
        );

    }


    /**
     * @param null $module
     * @param null $uuid
     * @return mixed
     */
    public static function deleteRecord($module = null, $uuid = null){

        return json_decode
        (
            self::postRequest
            (
                self::$API_ENDPOINT."/api/v1/delete/multiple/{$module}/".self::$SECRET."/".self::$TOKEN."/".$uuid."?language=".$_SESSION["language"]
            )
        );

    }


    /**
     * @param null $module
     * @param string $orderBy
     * @param int $orderLimit
     * @return mixed
     */
    public static function getRecords($module = null, $orderBy = "DESC", $orderLimit = 9999){


        return json_decode(
            self::getRequest
            (
                self::$API_ENDPOINT."/api/v1/read/multiple/all/{$module}/".self::$SECRET."/".self::$TOKEN."?filterOrder=".$orderBy."&filterLimit=".$orderLimit."&language=".$_SESSION["language"]
            )
        );

    }

    /**
     * @return mixed
     */
    public static function getCategories(){

        return json_decode
        (
            self::getRequest
            (
                self::$API_ENDPOINT."/api/v1/get/all/categories/".self::$SECRET."/".self::$TOKEN."?language=".$_SESSION["language"]
            )
        );

    }


    /**
     * @param null $module
     * @param null $uuid
     * @return mixed
     */
    public static function getRecordWithId($module = null, $uuid = null){

        return json_decode
        (
            self::getRequest
            (
                self::$API_ENDPOINT."/api/v1/read/multiple/one/uuid/{$module}/".self::$SECRET."/".self::$TOKEN."/".$uuid."?language=".$_SESSION["language"]
            )
        );

    }

    /**
     * @param null $module
     * @param null $slug
     * @return mixed
     */
    public static function getRecordWithSlug($module = null, $slug = null){

        return json_decode
        (
            self::getRequest
            (
                self::$API_ENDPOINT."/api/v1/read/multiple/one/slug/{$module}/".self::$SECRET."/".self::$TOKEN."/".$slug."?language=".$_SESSION["language"]
            )
        );

    }

    /**
     * @param null $module
     * @param int $page
     * @param string $orderBy
     * @param int $perPageLimit
     * @return mixed
     */
    public static function getRecordPagination($module = null, $page = 1, $orderBy = "DESC", $perPageLimit = 10){

        return json_decode
        (
            self::getRequest
            (
                self::$API_ENDPOINT."/api/v1/read/multiple/page/{$module}/".self::$SECRET."/".self::$TOKEN."/".$page."?filterOrder=".$orderBy."&filterLimit=".$perPageLimit."&language=".$_SESSION["language"]
            )
        );

    }


    /**
     * @param null $module
     * @param array $data
     * @return mixed
     */
    public static function updatePage($module = null, array $data = [] ){

        return json_decode
        (
            self::postRequest
            (
                self::$API_ENDPOINT."/api/v1/update/single/{$module}/".self::$SECRET."/".self::$TOKEN."?language=".$_SESSION["language"],
                $data
            )
        );

    }

    /**
     * @param null $module
     * @return mixed
     */
    public static function getPage($module = null){

        return json_decode
        (
            self::getRequest
            (
                self::$API_ENDPOINT."/api/v2/read/single/one/{$module}/".self::$SECRET."/".self::$TOKEN."?language=".$_SESSION["language"]
            )
        );

    }


    /**
     * @param $requestUrl
     * @param array $data
     * @return mixed
     */
    private static function postRequest($requestUrl, array $data = [] ){

        $ch = curl_init();

        curl_setopt($ch,CURLOPT_URL,$requestUrl);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $output = curl_exec($ch);

        curl_close($ch);

        return $output;

    }


    /**
     * @param $url
     * @return mixed
     */
    private static function getRequest($url){

        $ch=curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;

    }


}
