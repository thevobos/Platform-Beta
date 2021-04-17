<?php

namespace Fix\Router;


use Fix\Packages\Assets\Assets;
use Fix\Support\Header;

class Router
{
    const PATTERN =
        [
            "{number}",
            "{string}",
            "{parameter}",
            "."
        ];

    const DATA =
        [
            "{number}",
            "{string}",
            "{parameter}"
        ];

    const REPLACE =
        [
            "[0-9]*",
            "[a-zA-Z]*",
            "[a-zA-Z0-9_:-]*",
            ".*\.*"
        ];

    const REGEX                 = "@^REGEX$@";
    const REGEX_DATA            = "|REGEX|U";
    const POST                  = "POST";
    const GET                   = "GET";
    const PUT                   = "PUT";
    const DELETE                = "DELETE";
    const HEAD                  = "HEAD";
    const OPTIONS               = "OPTIONS";
    const PATCH                 = "PATCH";

    protected static $writeRoute   = [];
    protected static $writeUrl     = null;
    protected static $getMethod    = null;
    protected static $urlParameter = null;
    protected static $getFilter    = null;

    /**
     * @param null $urlParameter
     * @return mixed
     */
    protected static function getReplacePattern($urlParameter = null){
        return str_replace(self::PATTERN,self::REPLACE,$urlParameter);
    }

    /**
     * @param null $getPattern
     * @return false|int
     */
    protected static function getReturnPattern($getPattern = null){
        return str_replace(self::DATA,"(.*?)",$getPattern);
    }

    /**
     * @param null $urlParameter
     * @param string $setMethod
     * @return mixed
     */
    public static function withReplaceUrl($urlParameter = null, $setMethod = self::GET){
        $writeREGEX         =   str_replace("REGEX",self::getReplacePattern($urlParameter),self::REGEX);
        $writeDATA          =   str_replace("REGEX",self::getReturnPattern($urlParameter),self::REGEX_DATA);
        preg_match_all($writeDATA,self::getRoute(),$export);
        $dataReturn         =   [$writeREGEX,$writeDATA,$setMethod,"DATA" => $export];
        self::$writeRoute[] =   $dataReturn;
        return $dataReturn;
    }

    /**
     * @return null
     */
    protected static function getMethod(){
        self::$getMethod =  $_SERVER['REQUEST_METHOD'];
        return self::$getMethod;
    }

    /**
     * @return null
     */
    protected static function getRoute(){
        self::$urlParameter =  "/".rtrim(str_replace([",","*","'",'"'],"",$_GET["url"] ?? null),"/");
        return self::$urlParameter;
    }

    /**
     * @param null $setRoute
     * @param string $setMethod
     * @return bool
     */
    public static function isMatch($setRoute = null, $setMethod = "GET"){
        return ( (self::getMethod() === $setMethod) &&  (preg_match($setRoute,self::getRoute())) ) ? true : false;
    }


    /**
     * @param null $setRoute
     * @param string $setMethod
     * @return bool
     */
    public static function isMatchErrorMethod($setRoute = null, $setMethod = "GET"){
        return ( (self::getMethod() !== $setMethod) &&  (preg_match($setRoute,self::getRoute())) ) ? true : false;
    }

    /**
     * @param array $Parameters
     * @return array
     */
    protected static function setCallParameters(array $Parameters = []) {
        $setParameters = [];
        foreach ($Parameters as $getPar): $setParameters[] = $getPar[0]; endforeach;
        unset($setParameters[0]);
        return $setParameters;
    }


    /**
     * @param array ...$__setParameter
     */
    protected static function setTwoChange(...$__setParameter) {

        if($__setParameter[0] === "FUNCTION"):
            call_user_func_array(
                $__setParameter[2],
                self::setCallParameters(self::withReplaceUrl($__setParameter[1],$__setParameter[3])["DATA"])
            );
        elseif ($__setParameter[0] === "OBJECT"):
            call_user_func_array(
                [$__setParameter[2],$__setParameter[3]],
                self::setCallParameters(self::withReplaceUrl($__setParameter[1],$__setParameter[4])["DATA"])
            );
        elseif ($__setParameter[0] === "ASSETS"):
            $getParameter = self::setCallParameters(self::withReplaceUrl($__setParameter[1],$__setParameter[3])["DATA"]);
            Assets::autoAssetsLoader($getParameter[1],$getParameter[2],$__setParameter[2]);
        endif;

    }

    /**
     * @param null $urlParameter
     * @param null $target
     * @param null $function
     */
    public static function redirect($urlParameter = null, $target = null, $function = null){
        self::isMatch(self::withReplaceUrl($urlParameter,"GET")[0],"GET") ?
            Header::redirect($target)
            : self::isMatchErrorMethod(self::withReplaceUrl($urlParameter,"GET")[0],"GET") ? is_callable($function) ? $function() : false : false;
    }

    /**
     * @param null $urlParameter
     * @param null $parameter
     * @param null $function
     */
    public static function get($urlParameter = null, $parameter = null, $function = null){
        self::isMatch(self::withReplaceUrl($urlParameter,"GET")[0],"GET") ?
            is_callable($parameter) ? self::setTwoChange(
                "FUNCTION",
                $urlParameter,
                $parameter,
                "GET"
            ) : self::setTwoChange(
                "OBJECT",
                $urlParameter,
                $parameter[0],
                $parameter[1],
                "GET"
            )
            : self::isMatchErrorMethod(self::withReplaceUrl($urlParameter,"GET")[0],"GET") ? is_callable($function) ? $function() : false : false;
    }


    /**
     * @param null $urlParameter
     * @param null $parameter
     * @param callable|null $function
     */
    public static function post($urlParameter = null, $parameter = null, $function = null){
        self::isMatch(self::withReplaceUrl($urlParameter,"POST")[0],"POST") ?
            is_callable($parameter) ? self::setTwoChange(
                "FUNCTION",
                $urlParameter,
                $parameter,
                "POST"
            ) : self::setTwoChange(
                "OBJECT",
                $urlParameter,
                $parameter[0],
                $parameter[1],
                "POST"
            )
            : self::isMatchErrorMethod(self::withReplaceUrl($urlParameter,"POST")[0],"POST") ? is_callable($function) ? $function() : false : false;
    }


    /**
     * @param null $urlParameter
     * @param null $parameter
     * @param null $function
     */
    public static function delete($urlParameter = null, $parameter = null, $function = null){
        self::isMatch(self::withReplaceUrl($urlParameter,"DELETE")[0],"DELETE") ?
            is_callable($parameter) ? self::setTwoChange(
                "FUNCTION",
                $urlParameter,
                $parameter,
                "DELETE"
            ) : self::setTwoChange(
                "OBJECT",
                $urlParameter,
                $parameter[0],
                $parameter[1],
                "DELETE"
            )
            : self::isMatchErrorMethod(self::withReplaceUrl($urlParameter,"DELETE")[0],"DELETE") ? is_callable($function) ? $function() : false : false;
    }


    /**
     * @param null $urlParameter
     * @param null $parameter
     * @param null $function
     */
    public static function put($urlParameter = null, $parameter = null, $function = null){
        self::isMatch(self::withReplaceUrl($urlParameter,"PUT")[0],"PUT") ?
            is_callable($parameter) ? self::setTwoChange(
                "FUNCTION",
                $urlParameter,
                $parameter,
                "PUT"
            ) : self::setTwoChange(
                "OBJECT",
                $urlParameter,
                $parameter[0],
                $parameter[1],
                "PUT"
            )
            : self::isMatchErrorMethod(self::withReplaceUrl($urlParameter,"PUT")[0],"PUT") ? is_callable($function) ? $function() : false : false;
    }


    /**
     * @param null $urlParameter
     * @param null $parameter
     * @param null $function
     */
    public static function head($urlParameter = null, $parameter = null, $function= null){
        self::isMatch(self::withReplaceUrl($urlParameter,"HEAD")[0],"HEAD") ?
            is_callable($parameter) ? self::setTwoChange(
                "FUNCTION",
                $urlParameter,
                $parameter,
                "HEAD"
            ) : self::setTwoChange(
                "OBJECT",
                $urlParameter,
                $parameter[0],
                $parameter[1],
                "HEAD"
            )
            : self::isMatchErrorMethod(self::withReplaceUrl($urlParameter,"HEAD")[0],"HEAD") ? is_callable($function) ? $function() : false : false;
    }


    /**
     * @param null $urlParameter
     * @param null $parameter
     * @param null $function
     */
    public static function patch($urlParameter = null, $parameter = null, $function = null){
        self::isMatch(self::withReplaceUrl($urlParameter,"PATCH")[0],"PATCH") ?
            is_callable($parameter) ? self::setTwoChange(
                "FUNCTION",
                $urlParameter,
                $parameter,
                "PATCH"
            ) : self::setTwoChange(
                "OBJECT",
                $urlParameter,
                $parameter[0],
                $parameter[1],
                "PATCH"
            )
            : self::isMatchErrorMethod(self::withReplaceUrl($urlParameter,"PATCH")[0],"PATCH") ? is_callable($function) ? $function() : false : false;
    }


    /**
     * @param null $urlParameter
     * @param null $parameter
     * @param null $function
     */
    public static function options($urlParameter = null, $parameter = null, $function = null){
        self::isMatch(self::withReplaceUrl($urlParameter,"OPTIONS")[0],"OPTIONS") ?
            is_callable($parameter) ? self::setTwoChange(
                "FUNCTION",
                $urlParameter,
                $parameter,
                "OPTIONS"
            ) : self::setTwoChange(
                "OBJECT",
                $urlParameter,
                $parameter[0],
                $parameter[1],
                "OPTIONS"
            )
            : self::isMatchErrorMethod(self::withReplaceUrl($urlParameter,"OPTIONS")[0],"OPTIONS") ? is_callable($function) ? $function() : false : false;
    }


    /**
     * @param null $urlParameter
     * @param null $getClass
     * @param null $getFunction
     * @param null $function
     */
    public static function object($urlParameter = null, $getClass = null, $getFunction = null, $function = null){
        self::isMatch(self::withReplaceUrl($urlParameter,"GET")[0],"GET") ?
            call_user_func_array(
                [$getClass,$getFunction],
                self::setCallParameters(self::withReplaceUrl($urlParameter,"GET")["DATA"])
            )
            : self::isMatchErrorMethod(self::withReplaceUrl($urlParameter,"OPTIONS")[0],"OPTIONS") ? is_callable($function) ? $function() : false : false;
    }

    /**
     * @param callable $function
     */
    public static function notFound(callable $function){

        $count = 0;
        foreach (self::$writeRoute as $routs):
            if((preg_match($routs[0],self::getRoute()))) : $count +=1; endif;
        endforeach;
        if($count === 0) :call_user_func_array(
            $function,
            [self::getRoute()]
        ); endif;
    }

    /**
     * @param null $urlParameter
     * @param null $parameter
     */
    public static function assets($urlParameter = null, $parameter = null){
        self::isMatch(self::withReplaceUrl($urlParameter,"GET")[0],"GET") ?
            self::setTwoChange(
                "ASSETS",
                $urlParameter,
                $parameter,
                "GET"
            )
            : false;
    }

    /**
     * @param null $getParamName
     * @return bool
     */
    public static function getParam($getParamName = null){

        return isset($_GET[$getParamName]) ? $_GET[$getParamName] : false;

    }

    /**
     * @param callable $function
     * @return mixed
     */
    public static function export(callable $function){

        return call_user_func_array(
            $function,
            [self::$writeRoute,json_encode(self::$writeRoute)]
        );
    }


}