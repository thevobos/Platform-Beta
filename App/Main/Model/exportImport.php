<?php

namespace App\Main\Model;

use Fix\Packages\Database\Database;

class exportImport {


    public static function recordsEx($crudItem){

        $crud_contents = Database::start()->select("crud_contents")->where(["crudCode"],[$crudItem])->run(Database::Multiple);

        $exs = [];
        foreach ($crud_contents as $contentItem){

            $exs[] = [
                "uuid"          => $contentItem["uuid"],
                "crud"          => $crudItem,
                "category"      => $contentItem["category"],
                "slug"          => ($contentItem["slug"]),
                "crud_code"     => $contentItem["contentCode"],
                "language"      => $contentItem["language"],
                "contents"      => json_decode(($contentItem["content"])),
            ];

        }

        return $exs;
    }

    public static function export($siteCode = null){

        $crud = Database::start()->select("crud")->where(["siteCode"],[$siteCode])->run(Database::Multiple);


        
        if(!$crud)
            throw new \Exception("Data for the site was not found");

        $menu = Database::start()->select("menu_categories")->where(["siteCode"],[$siteCode])->run(Database::Multiple);



        $ex = [];

        $ex["creator"]      = "VOBO";
        $ex["version"]      = __VERSION__;
        $ex["export_time"]  = $_SERVER["REQUEST_TIME"];
        $ex["export_host"]  = $_SERVER["HTTP_HOST"];
        $ex["export_ip"]    = $_SERVER["REMOTE_ADDR"];
        $ex["app_uuid"]     = $crud[0]["siteCode"];
        $ex["menu"]         = [];

        foreach ($crud as $crudItem){



            $ex["crud"][] =
                [
                    "uuid"          => $crudItem["uuid"],
                    "label"         => ($crudItem["label"]),
                    "menu"          => $crudItem["menuCategory"],
                    "slug"          => ($crudItem["slug"]),
                    "slug_key"      => ($crudItem["slugComponent"]),
                    "components"    => json_decode(($crudItem["components"])),
                    "type"          => $crudItem["operation"],
                    "language"      => $crudItem["language"],
                    "records"       => self::recordsEx($crudItem["uuid"])
                ];

        }

        foreach ($menu as $menuItem){

            $ex["menu"][$menuItem["uuid"]] =
                [
                    "uuid"          => $menuItem["uuid"],
                    "site"          => $menuItem["siteCode"],
                    "label"         => ($menuItem["label"]),
                    "language"      => $menuItem["language"]
                ];


            $menuItems = Database::start()->select("menu_items")->where(["menuCategory"],[$menuItem["uuid"]])->run(Database::Multiple);

            $ex["menu"][$menuItem["uuid"]]["children"] = [];

            foreach ($menuItems as $menuItemChild){

                $ex["menu"][$menuItem["uuid"]]["children"][] =
                    [
                        "uuid"          => $menuItemChild["uuid"],
                        "parent"        => $menuItemChild["parent"],
                        "sort"          => $menuItemChild["sort"],
                        "category"      => $menuItemChild["menuCategory"],
                        "label"         => $menuItemChild["label"],
                        "link"          => $menuItemChild["link"],
                        "language"      => $menuItemChild["language"]
                    ];

            }

        }

        return $ex;


    }

}