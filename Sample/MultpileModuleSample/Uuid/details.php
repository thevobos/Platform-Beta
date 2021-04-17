<?php

include("../../apiModel.php");

$cms = new cms();


$getArticle = cms::getRecordWithId("1891-18790-7831-46612",$_GET["uuid"] ?? "");

if($getArticle->status !== "success"){
    die(exit("Not Found Article"));
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $getArticle->data->title; ?></title>


    <style>
        * { outline: none; clear: inherit; font-size: 11px; margin: 0px; border: none; padding: 0; text-decoration: none; list-style-type: none; font-family: 'Barlow', sans-serif;  color: black; }

        html,body { width: 100%; height: 100%; background: #efefef; display: flex; }

        .container {width: 600px;margin: 0 auto;overflow: scroll;position: relative;}
        .container > .header {width: 600px;height: 100px;background: black;justify-content: center;align-items: center;align-content: center;display: flex;font-size: 25px;font-weight: bolder;color: white;position: fixed;}
        .container > .end {width: 600px;height: 70px;background: #ef291b;justify-content: center;align-items: center;align-content: center;display: flex;font-size: 25px;font-weight: bolder;color: white; margin-top: 30px; }

        .container > .item {width: calc(100% - 20px);margin-top: 20px;background: white;padding: 10px;overflow: hidden;}
        .container > .item > .cover { width: 100%; height: 180px; background: black; }
        .container > .item > .title, .container > .item > .title > a {width: 100%;height: 50px;line-height: 50px;font-size: 19px;font-weight: bolder;}
        .container > .item > .go {width: 100%;height: 20px;align-items: center;align-content: center;display: flex;}
        .container > .item:nth-child(2) { margin-top: 120px; }
        .container > .item:nth-last-child(1) { margin-bottom: 20px; }
        .container > .item > .content { width: 100%; padding-top: 20px; padding-bottom: 20px; }
        .container > .item > .content > p { font-size: 12px;}

    </style>

</head>
<body>


<div class="container">
    <div class="header"><?php echo $getArticle->data->title; ?></div>
    <div class="item">
        <div class="cover">
            <img src="<?php echo $getArticle->data->cover; ?>" alt="">
        </div>
        <div class="content">
            <p><?php echo $getArticle->data->content; ?></p>
        </div>
    </div>
</div>

</body>
</html>