<?php

namespace App\Main\Model;


use Fix\Packages\Database\Database;
use Fix\Support\Header;

class language {

    public static $defaultLang = "en";

    public static $langs = [
        "tr" => ["Turkish", "turkey"],
        "en" => ["English", "english"],
        "ru" => ["Russian", "russian"],
        "it" => ["Italian", "italy"],
        "fr" => ["French", "french"],
        "de" => ["German", "germany"]
    ];

    public static function adaptationLanguageCrudComponent($default = "en",$lang = "en"){

        $getCrud = Database::start()->select("crud")->where(["language"],[$default])->run(Database::Multiple);

        $add    = 0;
        $pass   = 0;

        foreach ($getCrud as $item){

            $check = Database::start()->select("crud")->where(["language","uuid"],[$lang,$item["uuid"]])->run(Database::Single);

            if(!$check){

                ++$add;

                Database::start()
                    ->insert("crud")
                    ->set([
                        "uuid",
                        "siteCode",
                        "menuCategory",
                        "label",
                        "components",
                        "slug",
                        "slugComponent",
                        "operation",
                        "language",
                        "ip",
                        "time",
                    ],[
                        $item["uuid"],
                        $item["siteCode"],
                        $item["menuCategory"],
                        $item["label"],
                        $item["components"],
                        $item["slug"],
                        $item["slugComponent"],
                        $item["operation"],
                        $lang,
                        $item["ip"],
                        $item["time"]
                    ])
                    ->run(Database::Progress);
            }else{ ++$pass; }

        }


        return [
            "add"   => $add,
            "pass"  => $pass
        ];
    }


    public static function setLanguage(){


        try{

            Header::checkParameter($_POST,["prefix"]);
            Header::checkValue($_POST,["prefix"]);

            if(!isset(self::$langs[ Header::post("prefix") ]))
                Header::notFound();

            $_SESSION["cms_aut_language"] = Header::post("prefix");


            Header::jsonResult("success","BAŞARILI","İştem tamamlandı");


        }catch (\Exception $exception){

            Header::notFound();

        }

    }



}