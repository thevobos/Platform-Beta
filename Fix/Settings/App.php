<?php


namespace Fix\Settings;

use Fix\Support\Support;

class App
{

    const APP =
        [
            "www" => [
                "folder"                => "Main",
                "router"                => "Main",
                "assets"                => false,
                "https"                 => false,
                "maintenance"           => false,
                "maintenanceRouter"     => [],
                "autoLoadClass"         => [],
                "database"              =>
                    [
                        "driver"        => "mysql",
                        "host"          => __SERVER__,
                        "username"      => __USERNAME__,
                        "password"      => __PASSWORD__,
                        "table"         => __TABLE__,
                        "charset"       => "utf8",
                        "prefix"        => null
                    ]
            ]
        ];

}

