<?php

use Fix\Router\Router;

use Fix\Packages\Assets\Assets;
use App\Main\Controller\auth;
use App\Main\Controller\dashboard;
use App\Main\Controller\menu;
use App\Main\Controller\management;
use App\Main\Controller\api;
use App\Main\Controller\crud;
use App\Main\Controller\module;
use App\Main\Model\fileModel;
use App\Main\Controller\app;
use Fix\Support\Header;
use App\Main\Model\language;
use App\Main\Model\plugin as pluginModel;
use App\Main\Controller\plugin as pluginController;
use voku\helper\Hooks;
use App\Main\Controller\user;
use App\Main\Hook\settingOnAdmin;

session_start();
ob_start();

pluginModel::loadPlugin();


if(__VOBOINSTALL__ === "on")
    Router::redirect("/","/install");

if(!isset($_SESSION["cms_login"])){

    Router::redirect("/","/auth/login");
    Router::get("/auth/login",[auth::class,"login"]);
    Router::get("/auth/password",[auth::class,"password"]);
    Router::post("/auth/ajax/login",[auth::class,"ajaxLogin"]);

}

if(isset($_SESSION["cms_login"])){

    settingOnAdmin::permissions();

    fileModel::userAssetsCreate(__DIR__."/../../../Upload/".($_SESSION["cms_auth_manager"] ? "static" : $_SESSION["cms_auth_site"])."/original/");
    fileModel::userAssetsCreate(__DIR__."/../../../Upload/".($_SESSION["cms_auth_manager"] ? "static" : $_SESSION["cms_auth_site"])."/thumbs/");

    Router::redirect("/","/app/dashboard");

    Router::get("/app/dashboard",[dashboard::class,"dashboard"]);
    Router::get("/app/menu",[menu::class,"stepOne"]);
    Router::get("/app/menu/{parameter}",[menu::class,"stepTwo"]);
    Router::get("/app/management",[management::class,"users"]);
    Router::get("/app/management/{parameter}",[management::class,"siteDashboard"]);
    Router::get("/app/management/{parameter}/module/create",[management::class,"siteDashboardAdd"]);
    Router::get("/app/management/{parameter}/module/edit/{parameter}",[management::class,"getSiteModule"]);
    Router::get("/app/management/{parameter}/edit/{parameter}",[management::class,"siteDashboardEdit"]);
    Router::get("/app/module/{parameter}/records",[module::class,"records"]);
    Router::get("/app/module/{parameter}/create",[module::class,"create"]);
    Router::get("/app/module/{parameter}/record/{parameter}",[module::class,"edit"]);
    Router::get("/app/module/{parameter}",[module::class,"single"]);
    Router::get("/app/module/{parameter}/settings",[module::class,"settings"]);
    Router::get("/app/api",[app::class,"api"]);
    Router::get("/app/api/{parameter}",[app::class,"apiView"]);
    Router::get("/app/settings",[app::class,"settings"]);
    Router::get("/app/user/management",[user::class,"alluser"]);
    Router::get("/app/plugin",[pluginController::class,"view"]);
    Router::post("/ajax/get/crud/{parameter}",[management::class,"getCrud"]);
    Router::post("/ajax/get/sites",[management::class,"getSites"]);
    Router::post("/ajax/get/component",[crud::class,"getComponent"]);
    Router::post("/ajax/create/menu",[menu::class,"createMenu"]);
    Router::post("/ajax/update/menu",[menu::class,"updateMenu"]);
    Router::post("/ajax/remove/menu",[menu::class,"deleteMenu"]);
    Router::post("/ajax/management/add",[management::class,"ajaxAdd"]);
    Router::post("/ajax/management/edit",[management::class,"ajaxEdit"]);
    Router::post("/ajax/management/authorities/add",[management::class,"authoritiesAdd"]);
    Router::post("/ajax/management/authorities/remove",[management::class,"authoritiesRemove"]);
    Router::post("/ajax/crud/save",[crud::class,"saveCrud"]);
    Router::post("/ajax/crud/edit",[crud::class,"editCrud"]);
    Router::post("/ajax/create/menu-item",[menu::class,"createMenuItems"]);
    Router::post("/ajax/remove/menu-item",[menu::class,"removeMenuItem"]);
    Router::post("/ajax/update/menu-items",[menu::class,"updateMenuItems"]);
    Router::post("/ajax/update/menu-item",[menu::class,"updateMenuItem"]);
    Router::post("/ajax/site/remove",[management::class,"siteRemove"]);
    Router::post("/ajax/modules/single",[module::class,"singleAjax"]);
    Router::post("/ajax/modules/save",[module::class,"saveAjax"]);
    Router::post("/ajax/modules/update",[module::class,"updateAjax"]);
    Router::post("/ajax/modules/remove",[module::class,"removeAjax"]);
    Router::post("/ajax/get/record/{parameter}",[module::class,"recordAjax"]);
    Router::post("/ajax/module/remove",[module::class,"removeModule"]);
    Router::post("/ajax/get/crud/site/manager/{parameter}",[management::class,"getSiteManager"]);
    Router::post("/ajax/create/token",[app::class,"tokenAddAjax"]);
    Router::post("/ajax/delete/token",[app::class,"tokenDeleteAjax"]);
    Router::post("/ajax/app/get/tokens",[app::class,"tokenGetAjax"]);
    Router::post("/ajax/app/get/api",[app::class,"apiGetAjax"]);
    Router::post("/ajax/app/update/password",[app::class,"ajaxUpdatePassword"]);
    Router::post("/ajax/app/exit",[app::class,"closedSession"]);
    Router::get("/get/app/export",[app::class,"exportJson"]);
    Router::post("/ajax/backup/import",[app::class,"backupImport"]);
    Router::post("/ajax/app/language/stabilizing",[app::class,"adaptorForAllLanguage"]);
    Router::post("/ajax/user/create",[user::class,"createUser"]);
    Router::post("/ajax/get/userlist",[user::class,"listUser"]);
    Router::post("/ajax/user/update",[user::class,"updateUser"]);
    Router::post("/ajax/user/delete",[user::class,"deleteUser"]);
    Router::post("/ajax/user/lastlogin",[user::class,"lastLogin"]);
    Router::post("/ajax/user/online",[user::class,"onlineUser"]);

    Router::post("/ajax/set/language",[language::class,"setLanguage"]);
    Router::post("/ajax/user/get/information",[user::class,"getUserInfo"]);

    Hooks::getInstance()->do_action("router@admin");

}

Router::post("/api/v1/insert/multiple/{parameter}/{parameter}/{parameter}",[api::class,"saveMultipleComponentItem"]);
Router::post("/api/v1/update/multiple/{parameter}/{parameter}/{parameter}/{parameter}",[api::class,"updateMultipleComponent"]);
Router::post("/api/v1/delete/multiple/{parameter}/{parameter}/{parameter}/{parameter}",[api::class,"deleteMultipleComponent"]);
Router::post("/api/v1/update/single/{parameter}/{parameter}/{parameter}",[api::class,"updateSingleComponent"]);
Router::get("/api/v1/read/multiple/all/{parameter}/{parameter}/{parameter}",[api::class,"apiGetAll"]);
Router::get("/api/v1/read/multiple/page/{parameter}/{parameter}/{parameter}/{parameter}",[api::class,"apiAllPagination"]);
Router::get("/api/v1/read/multiple/one/uuid/{parameter}/{parameter}/{parameter}/{parameter}",[api::class,"apiGetOneInMultiple"]);
Router::get("/api/v1/read/multiple/one/slug/{parameter}/{parameter}/{parameter}/{parameter}",[api::class,"apiGetOneInMultipleWhileSlug"]);
Router::get("/api/v1/read/single/one/{parameter}/{parameter}/{parameter}",[api::class,"getOneRecordInSingle"]);
Router::get("/api/v1/crud/{parameter}/{parameter}/{parameter}",[api::class,"exportCrud"]);
Router::get("/api/v1/get/all/categories/{parameter}/{parameter}",[api::class,"getAllCategory"]);
Router::get("/api/v2/read/single/one/{parameter}/{parameter}/{parameter}",[api::class,"getOneRecordInSingleV2"]);
Router::post("/api/v2/read/search/{parameter}/{parameter}/{parameter}",[api::class,"getSearchDynamic"]);


Router::get("/api/v1/plugin/get/{parameter}",function ($plugin = null){
    if(Hooks::getInstance()->has_action("api@get:$plugin")){
        Hooks::getInstance()->do_action("api@get:$plugin",$_REQUEST);
    }else{
        Header::notFound();
    }
});

Router::post("/api/v1/plugin/post/{parameter}",function ($plugin = null){
    if(Hooks::getInstance()->has_action("api@post:$plugin")){
        Hooks::getInstance()->do_action("api@post:$plugin",$_REQUEST);
    }else{
        Header::notFound();
    }
});

Router::get("/system/cron",function (){

    if(Hooks::getInstance()->has_action("system@cron")){
        Hooks::getInstance()->do_action("system@cron",$_REQUEST);
    }

});

Router::get("/install",[app::class,"setupCheck"]);
Router::post("/install/ajax",[app::class,"setupFinish"]);

Router::notFound(function (){

    isset($_SESSION["cms_login"]) ? Assets::render("app/notFound") : Header::redirect("/");

});
