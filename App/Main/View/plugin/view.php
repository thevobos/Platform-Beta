<style>
    td { white-space: break-spaces !important; }
</style>
<?php


if($_GET["page"]){

    if($data["define"]["hook"]->has_action($_GET["page"])){

        $data["define"]["hook"]->do_action($_GET["page"]);

    }else{

        echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert"> <strong>Error!</strong> Plugin not found. </div>';

    }


}else{
    echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert"> <strong>Error!</strong> Plugin not found. </div>';
}