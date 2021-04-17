<?php

ini_set('memory_limit', '-1');
ini_set('max_execution_time', '5000000');
ini_set('max_input_time', '5000000');

header('Access-Control-Allow-Origin: *');

define("__SYSTEM__","VOBO CLOUD");
define("__HOME__",__DIR__);

// Install step 1
define("__VOBOINSTALL__","on");

// Database
define("__SERVER__","");
define("__USERNAME__","");
define("__PASSWORD__","");
define("__TABLE__","");

// SMTP 
define("__SMTP_SENDER__","");
define("__SMTP_HOST__","");
define("__SMTP_MAIL__","");
define("__SMTP_PASSWORD__","");
define("__SMTP_IS_SSL__",true);
define("__SMTP_PORT__",465);