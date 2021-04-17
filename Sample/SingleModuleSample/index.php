<?php

include("../apiModel.php");

$cms = new cms();


$getAboutUs = cms::getPage("2311-68912-3164-37172");

if($getAboutUs->status !== "success"){

    die(exit("Record not found"));
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $getAboutUs->data->title; ?></title>


    <style>
        * { outline: none; clear: inherit; font-size: 11px; margin: 0px; border: none; padding: 0; text-decoration: none; list-style-type: none; font-family: 'Barlow', sans-serif;  color: black; }

        html,body { width: 100%; height: 100%; background: #efefef; display: flex; }

        .container {width: 600px;margin: 0 auto;overflow: scroll;position: relative;}
        .container > .header {width: 600px;height: 100px;background: black;justify-content: center;align-items: center;align-content: center;display: flex;font-size: 25px;font-weight: bolder;color: white;position: fixed;}

        .container > .item {width: calc(100% - 20px);margin-top: 20px;background: white;padding: 10px;overflow: hidden;}
        .container > .item > .cover { width: 100%; height: 180px; background: black; }
        .container > .item:nth-child(2) { margin-top: 120px; }
        .container > .item:nth-last-child(1) { margin-bottom: 20px; }
        .container > .item > .content { width: 100%; padding-top: 20px; padding-bottom: 20px; }
        .container > .item > .content > p { font-size: 12px;}

    </style>

    <!--

    Login root dashboard

    Required module operations for sample


    Module Settings :   Single Record
    Elements        :   Title | Description

    -->

</head>
<body>


<div class="container">
    <div class="header"><?php echo $getAboutUs->data->title; ?></div>
    <div class="item">
        <div class="content">
            <p><?php echo $getAboutUs->data->content; ?></p>
        </div>
    </div>
</div>

</body>
</html>