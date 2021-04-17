<?php


namespace App\Main\Hook;


use App\Main\Model\menuModel;
use App\Main\Model\plugin;


class settingOnAdmin {



    public static function permissions(){

        $menuPermissions = [];

        foreach (menuModel::getMenuListSingle($_SESSION["cms_auth_site"]) as $menuSingle){

            $menuPermissions[] = [
                "label"     => $menuSingle["label"],
                "value"     =>  $menuSingle["uuid"]
            ];

        }

        foreach (menuModel::getMenuListMultiple($_SESSION["cms_auth_site"]) as $menuSingle){

            $menuPermissions[] = [
                "label"     => $menuSingle["label"],
                "value"     =>  $menuSingle["uuid"]
            ];

        }

        plugin::add_user_permission(
            array_merge(
                [
                    [
                        "label"     => "Demo",
                        "value"     =>  "NONOLOGIN"
                    ],
                    [
                        "label"     => "Reading",
                        "value"     =>  "system_read"
                    ],
                    [
                        "label"     => "Writing",
                        "value"     =>  "system_write"
                    ],
                    [
                        "label"     => "Update",
                        "value"     =>  "system_update"
                    ],
                    [
                        "label"     => "Delete",
                        "value"     =>  "system_delete"
                    ],
                    [
                        "label"     => "Settings",
                        "value"     =>  "system_settings"
                    ]
                ],
                $menuPermissions
            )
        );

        plugin::add_user_type(
            [
                [
                    "label"     => "Admin",
                    "value"     =>  "admin"
                ],
                [
                    "label"     => "User",
                    "value"     =>  "user"
                ],
                [
                    "label"     => "Integration",
                    "value"     =>  "api"
                ]
            ]
        );


    }

}