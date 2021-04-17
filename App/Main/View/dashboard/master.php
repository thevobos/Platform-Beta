<div class="row dashboardWidget" style=" overflow: hidden; transition: all 500ms;  overflow: hidden; transition: all 500ms;" >
    <?php foreach ( $page["crudModel"]::getCrudWithSiteCode($_SESSION["cms_auth_site"])  as $item):  ?>
        <?php if ( $data["define"]["pluginModel"]::check_permission($_SESSION["cms_auth_uuid"],$item["uuid"]) or ($data["define"]["pluginModel"]::check_type($_SESSION["cms_auth_uuid"],"root") or $data["define"]["pluginModel"]::check_type($_SESSION["cms_auth_uuid"],"admin") or $data["define"]["pluginModel"]::check_type($_SESSION["cms_auth_uuid"],"root") ) ):  ?>

            <div class="col-md-2" style="margin-top: 15px; margin-bottom: 15px;">
                <h4 class="tx-normal tx-rubik mg-b-10"><?php echo number_format(count($page["crudModel"]::getContents($item["uuid"],$_SESSION["cms_auth_site"],"ASC",99999,$_SESSION["cms_aut_language"]))); ?></h4>
                <div class="progress ht-2 mg-b-10">
                    <div class="progress-bar wd-100p bg-df-2" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h6 class="tx-uppercase tx-spacing-1 tx-semibold tx-10 tx-color-02 mg-b-2"><?php echo $item["label"]; ?></h6>
                <p class="tx-10 tx-color-03 mg-b-0"><span class="tx-medium tx-success">Recorded Data</span></p>
            </div><!-- col -->

        <?php endif; ?>
    <?php endforeach; ?>
</div>


<div class="row" style="margin-top: 20px;">
    <?php $data["define"]["hook"]->do_action("dashboard@widget"); ?>
</div>