<?php

namespace App\Main\Controller;

use App\Main\Model\crudModel;
use App\Main\Model\templateModel;
use App\Main\Model\menuModel;
use App\Main\Model\language;


class dashboard {


    public static function dashboard(){


        templateModel::get("dashboard/master","Dashboard",[],[
            "menuModel"     => menuModel::class,
            "languageModel" => language::class,
            "crudModel"     => crudModel::class
        ]);

    }

}