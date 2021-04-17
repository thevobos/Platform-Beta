<?php

include("../../apiModel.php");

$cms = new cms();

$getBlogArticles = cms::getRecords("2742-17606-7313-90168")->data;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Multiple Module Sample</title>


    <style>
        * { outline: none; clear: inherit; font-size: 11px; margin: 0px; border: none; padding: 0; text-decoration: none; list-style-type: none; font-family: 'Barlow', sans-serif;  color: black; }

        html,body { width: 100%; height: 100%; background: #efefef; display: flex; }

        .container {width: 600px;margin: 0 auto;overflow: scroll;position: relative;}
        .container > .header {width: 600px;height: 100px;background: black;justify-content: center;align-items: center;align-content: center;display: flex;font-size: 25px;font-weight: bolder;color: white;position: fixed;}
        .container > .end {width: 600px;height: 70px;background: #ef291b;justify-content: center;align-items: center;align-content: center;display: flex;font-size: 25px;font-weight: bolder;color: white; margin-top: 30px; }

        .container > .item {width: calc(100% - 20px);height: 250px;margin-top: 20px;background: white;padding: 10px;overflow: hidden;}
        .container > .item > .cover { width: 100%; height: 180px; background: black; }
        .container > .item > .title, .container > .item > .title > a {width: 100%;height: 50px;line-height: 50px;font-size: 19px;font-weight: bolder;}
        .container > .item > .go {width: 100%;height: 20px;align-items: center;align-content: center;display: flex;}
        .container > .item:nth-child(2) { margin-top: 120px; }
        .container > .item:nth-last-child(1) { margin-bottom: 20px; }

    </style>

    <!--

    Login root dashboard

    Required module operations for sample

    Module Settings :   Slug for url search | Multiple Record
    Elements        :   Title | Cover | Description

    -->

</head>
<body>


<div class="container">
    <div class="header">BLOG</div>

    <?php foreach ($getBlogArticles as $article): ?>
    <div class="item">
        <div class="cover">
            <img src="<?php echo $article->cover; ?>" alt="">
        </div>
        <div class="title"><a href="details.php?slug=<?php echo $article->slug; ?>"><?php echo $article->title; ?></a> </div>
        <div class="go"><a href="details.php?slug=<?php echo $article->slug; ?>">Read More</a> </div>
    </div>
    <?php endforeach; ?>


    <div class="end">END</div>
</div>

</body>
</html>