<?php

namespace Fix\Packages\Database;

use Fix\Kernel\Url;

class Database
{


    public static $_query;
    public static $_tableName;
    public static $_limit;
    public static $_multiple;
    public static $_setData;
    public static $_whereData;
    public static $_inData;
    const Progress    = "other";
    const Single      = true;
    const Multiple    = false;
    public static $_Config      = null;


    public static function start($_Config = null){

        return new self($_Config);

    }

    public function __construct($_Config = null) {

        self::$_Config = $_Config;

        return $this;

    }


    /**
     * @param null $setConfig
     * @return \PDO
     */
    public function connect($setConfig = null){

        try {

            $PDO        = new \PDO((is_array($setConfig) ? $setConfig["driver"] : Url::getSettings()["database"]["driver"]).':host=' . (is_array($setConfig)  ? $setConfig["host"] :  Url::getSettings()["database"]["host"]) . ';dbname=' . (is_array($setConfig)  ? $setConfig["table"] : Url::getSettings()["database"]["table"]), (is_array($setConfig)  ? $setConfig["username"] : Url::getSettings()["database"]["username"]), (is_array($setConfig)  ? $setConfig["password"] :  Url::getSettings()["database"]["password"]));
            $PDO->query('SET CHARACTER SET ' . (is_array($setConfig)  ? $setConfig["charset"] : Url::getSettings()["database"]["charset"]));
            $PDO->query('SET NAMES ' . (is_array($setConfig)  ? $setConfig["charset"] : Url::getSettings()["database"]["charset"]));

            return $PDO;

        } catch ( \PDOException $e ){ die($e->getMessage()); }

    }


    /**
     * @param null $table
     * @param string $selector
     * @return $this
     */
    public function select($table = null, $selector = "*") {

        self::$_query = "SELECT" . " " . $selector . " " . "FROM" . " " . $table;
        self::$_tableName = $table;
        return $this;

    }


    /**
     * @param null $columname
     * @return $this
     */
    public function insert($columname = null){

        self::$_query = "INSERT INTO"." ".$columname;
        return $this;

    }


    /**
     * @param null $columname
     * @return $this
     */
    public function delete($columname = null){

        self::$_query = "DELETE FROM"." ".$columname;
        return $this;

    }


    /**
     * @param null $columname
     * @return $this
     */
    public function update($columname = null){

        self::$_query = "UPDATE"." ".$columname;
        return $this;

    }


    /**
     * @return $this
     */
    public function random(){

        self::$_query .= " ORDER BY RAND()";
        return $this;

    }


    /**
     * @param int $limit
     * @return $this
     */
    public function getLimit($limit = 1){

        self::$_query .= " LIMIT {$limit}";
        return $this;

    }


    public function  set(array $colm = null, array $data = null,$bracket = ","){

        if(is_array($colm) && is_array($data) && count($colm) >= count($data)){


            if(count($colm) === count($data)){


                self::$_query .= " "."SET"." ";

                $count = 0;

                foreach($colm as $col){

                    $count = $count+1;
                    if(count($colm) === $count){

                        self::$_query .= " ".$col."=?"." ";

                    }else{

                        self::$_query .= " ".$col."=?".$bracket." ";

                    }

                }

                self::$_setData = $data;

                return $this;

            }else{ die("Database (set) parameter error : not equal"); }

        }else{ die("Database (set) parameter error : not equal"); }


    }


    public function  where(array $colm = null, array $data = null,$bracket = "AND"){


        if(is_array($colm) && is_array($data) && count($colm) >= count($data)){


            if(count($colm) === count($data)){

                self::$_query .= " "."where"." ";

                $count = 0;

                foreach($colm as $col){

                    $count = $count+1;
                    if(count($colm) === $count){

                        self::$_query .= " ".$col."=?"." ";

                    }else{

                        self::$_query .= " ".$col."=?"." ".$bracket." ";

                    }

                }

                self::$_whereData = $data;

                return $this;
            }else{ die("Database (set) parameter error : not equal"); }

        }else{ die("Database (set) parameter error : not equal"); }

    }

    public function  andWhere($query = null){

        self::$_query .= $query;

        return $this;

    }



    public function  manuel($query = null){

        self::$_query = $query;

        return $this;

    }



    public function  in($colm = null, array $data = null,$bracket = ","){


        if( is_array($data)){


            $in  = str_repeat('?,', count($data) - 1) . '?';
            self::$_query .= " ".$colm." "."IN (".$in.")"." ";
            self::$_inData = $data;

            return $this;


        }else{ die("Database (where) parameter (2 - data) error : is not array"); }

    }

    /**
     * @param null $columname
     * @param string $sort
     * @return $this
     */
    public function orderby($columname = null, $sort = "ASC"){

        self::$_query .= " ORDER BY"." ".$columname." ".$sort;
        return $this;


    }

    /**
     * @param null $columname
     * @return $this
     */
    public function groupby($columname = null){

        self::$_query .= " "."GROUP BY"." ".$columname;
        return $this;

    }

    /**
     * @param null $start
     * @param null $finish
     * @return $this
     */
    public function limit($start = null,$finish = null){

        self::$_query .= " "."LIMIT"." ".$start.",".$finish." ";
        return $this;

    }


    public function end($start = ","){

        self::$_query .= " ".$start." ";
        return $this;

    }

    /**
     * @return array
     */
    public function exportsql(){

        return [
            "query"    => self::$_query,
            "where"    => self::$_whereData,
            "set"      => self::$_setData,
            "in"       => self::$_inData
        ];

    }


    /**
     * @param bool|false $single
     * @return array|mixed
     */
    public function run($single  = false){

        $array1 = [];
        $array2 = [];
        $array3 = [];

        if(is_array(self::$_setData)){

            $array1 = self::$_setData;
        }

        if(is_array(self::$_whereData)){

            $array2 = self::$_whereData;
        }

        if(is_array(self::$_inData)){

            $array3 = self::$_inData;
        }

        if(self::$_query !== ""){

            $connect = $this->connect(self::$_Config);

            if(is_array(self::$_whereData) or is_array(self::$_setData)){

                $sql = $connect->prepare(self::$_query);

            }else{

                $sql = $connect->query(self::$_query);
            }

            if( count(array_merge($array1,$array2,$array3)) > 0 ){

                $sql->execute(array_merge($array1,array_merge($array2,$array3)));

            }

            self::$_inData      = null;
            self::$_whereData   = null;
            self::$_setData     = null;

            if ($single === "other"){

                return $connect;

            } else if($single){

                return $sql->fetch(\PDO::FETCH_ASSOC);

            } else{

                return $sql->fetchAll(\PDO::FETCH_ASSOC);

            }



        }

    }


}