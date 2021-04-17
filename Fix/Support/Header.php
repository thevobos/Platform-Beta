<?php


namespace Fix\Support;


class Header
{


    /**
     * @param string $AUTH_USER
     * @param string $AUTH_PASS
     * @param callable $function
     * @return bool
     */
    public static function httpAut($AUTH_USER = "admin", $AUTH_PASS = "admin", callable $function){

        if (!isset($_SERVER['PHP_AUTH_USER'])) {

            header('WWW-Authenticate: Basic realm="VOBO CLOUD"');
            header('HTTP/1.0 401 Unauthorized');

            return false;

        } else {

            if($_SERVER['PHP_AUTH_USER'] === $AUTH_USER and $_SERVER['PHP_AUTH_PW'] === $AUTH_PASS) {

                $function();

            }else{

                header('WWW-Authenticate: Basic realm="VOBO CLOUD"');
                header('HTTP/1.0 401 Unauthorized');
                return false;

            }
        }

    }

    public static function noCache(){

        header("Expires: 0");
        header("Pragma: no-cache");
        header("Cache-Control: no-cache,no-store,max-age=0,s-maxage=0,must-revalidate");

    }

    public static function notFound(){

        header("HTTP/1.1 404 Not Found");
        return null;

    }
    public static function serverError(){

        header("HTTP/1.1 505 Not Found");
        return null;

    }

    public static function notFoundResponse($string = null){

        header("HTTP/1.1 404 Not Found");

        return $string;

    }

    /**
     * @param null $setTarget
     */
    public static function redirect($setTarget = null){

        header("Location: ".$setTarget);
        exit(die());

    }

    /**
     * @param null $setType
     */
    public static function content($setType = null){

        header("Content-type: ".$setType);

    }


    /**
     * @param null $provider
     * @param array $list
     * @return bool
     * @throws \Exception
     */
    public static function checkParameter($provider = null, $list = []){

        foreach ($list as $key => $item){

             if(!isset($provider[$item])){
                 throw new \Exception("Fill in the information");
             }

        }

        return true;

    }

    /**
     * @param null $key
     * @param bool $filterStatus
     * @param callable|null $filter
     * @return mixed
     */
    public static function post($key = null, $filterStatus = false, callable $filter = null){

        return $filterStatus ? $filter($_POST[$key]) : $_POST[$key];

    }

    /**
     * @param null $key
     * @param bool $filterStatus
     * @param callable|null $filter
     * @return mixed
     */
    public static function get($key = null, $filterStatus = false, callable $filter = null){

        return $filterStatus ? $filter($_GET[$key]) : $_GET[$key];

    }


    /**
     * @param null $provider
     * @param array $list
     * @return bool
     * @throws \Exception
     */
    public static function checkValue($provider = null, $list = []){

        foreach ($list as $key => $item)
             if(!is_array($provider[$item])){
                 if(strlen($provider[$item]) === 0){
                     throw new \Exception("Fill in the information");
                 }
             }else{
                 if(count($provider[$item]) === 0){
                     throw new \Exception("Fill in the information");
                 }
             }
        return true;
    }

    public static function jsonResult(...$parameters){

        die(exit(
            json_encode(
                [
                    "status"    => $parameters[0],
                    "title"     => $parameters[1],
                    "message"   => $parameters[2],
                    "data"      => $parameters[3] ?? null,
                ],
                JSON_HEX_TAG
            )
        ));

    }

}