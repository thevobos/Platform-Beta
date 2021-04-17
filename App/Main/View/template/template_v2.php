<!DOCTYPE html>
<html lang="en">
  <head>

    <title><?php echo $define["title"]; ?> | <?php echo $define["app"]::getSite()["title"]; ?></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="icon"  href="<?php echo $define["app"]::getLogo(); ?>" />

      <!-- vendor css -->
    <link href="/Assets/v2/Assets/lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="/Assets/v2/Assets/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.0/dist/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="/Assets/libs/nestable2/jquery.nestable.min.css">
    <link href="/Assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/Assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/Assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/Assets/libs/air-datepicker/css/datepicker.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/Assets/v2/Assets/css/dashforge.css">
    <link href="/Assets/v2/Assets/lib/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
    <link href="/Assets/v2/Assets/lib/spectrum-colorpicker/spectrum.css" rel="stylesheet" />
    <link href="/Assets/v2/Assets/lib/select2/css/select2.min.css" rel="stylesheet" />

    <link href="/Assets/libs/selectize/css/selectize.css" rel="stylesheet" type="text/css" />

    <?php if($data["define"]["hook"]->do_action("body@css",$_REQUEST,true)): ?>
      <?php foreach ($data["define"]["hook"]->do_action("body@css",$_REQUEST,true) as $css): ?>
          <?php foreach ($css as $cssItem): ?>
              <link href="<?php echo $cssItem; ?>" rel="stylesheet" type="text/css" />
          <?php endforeach; ?>
      <?php endforeach; ?>
    <?php endif; ?>

      <style>
          .fancybox-slide--iframe .fancybox-content {  width: 95% !important;  height: 95% !important;  }
          .fancybox-bg {  background: #333231;  background: linear-gradient(90deg, #333231 14%, #333231 100%);  }
          .badge { padding-top: 4px; }
          .breadcrumb-item+.breadcrumb-item::before{ color: white !important;}
          .page-title-box .breadcrumb .breadcrumb-item.active { color: rgb(255, 255, 255); }
          .uim-svg { fill: #e45114 !important  }
          .btn-primary:hover { background-color: #e45114; border-color: #b33b09; }
          .datepickers-container { z-index: 99999; }
          .imgPreview{ margin-right: 12px; width: 200px; height: auto; padding: 11px 0px; text-align: center; border: 1px solid #0168fa; float: left; min-height: 135px; max-height: 135px; margin-bottom: 12px; margin-top: 20px; justify-content: center; align-items: center; display: flex; }
          .imgPreview  > img { width: 100%; padding: 3px; height: auto; display: flex; max-width: 110px; }
          .toggleWrapper {margin-top: 4px; margin-left: -20px; transform: scale(0.7); position: absolute;  overflow: hidden;   } .toggleWrapper input { position: absolute; left: -99em; } .toggle { cursor: pointer; display: inline-block; position: relative; width: 80px; height: 40px; background-color: #0168fa; border-radius: 84px; transition: background-color 200ms cubic-bezier(0.445, 0.05, 0.55, 0.95); } .toggle__handler { display: inline-block; position: relative; z-index: 1; top: 3px; left: 3px; width: 34px; height: 34px; background-color: #ffcf96; border-radius: 50px; box-shadow: 0 2px 6px rgba(0, 0, 0, .3); transition: all 400ms cubic-bezier(0.68, -0.55, 0.265, 1.55); transform: rotate(-45deg); } .toggle__handler .crater { position: absolute; background-color: #e8cda5; opacity: 0; transition: opacity 200ms ease-in-out; border-radius: 100%; } .toggle__handler .crater--1 { top: 18px; left: 10px; width: 4px; height: 4px; } .toggle__handler .crater--2 { top: 22px; left: 22px; width: 4px; height: 4px; } .toggle__handler .crater--3 { top: 7px; left: 15px; width: 8px; height: 8px; } .star { position: absolute; background-color: #fff; transition: all 300ms cubic-bezier(0.445, 0.05, 0.55, 0.95); border-radius: 50%; } .star--1 { top: 10px; left: 35px; z-index: 0; width: 30px; height: 3px; } .star--2 { top: 18px; left: 28px; z-index: 1; width: 30px; height: 3px; } .star--3 { top: 27px; left: 40px; z-index: 0; width: 30px; height: 3px; } .star--4, .star--5, .star--6 { opacity: 0; transition: all 300ms 0 cubic-bezier(0.445, 0.05, 0.55, 0.95); } .star--4 { top: 16px; left: 11px; z-index: 0; width: 2px; height: 2px; transform: translate3d(3px, 0, 0); } .star--5 { top: 32px; left: 17px; z-index: 0; width: 3px; height: 3px; transform: translate3d(3px, 0, 0); } .star--6 { top: 36px; left: 28px; z-index: 0; width: 2px; height: 2px; transform: translate3d(3px, 0, 0); } #dn:checked + .toggle { background-color: #2c303a; } #dn:checked + .toggle:before { color: #749ed7; } #dn:checked + .toggle:after { color: #fff; } #dn:checked + .toggle .toggle__handler { background-color: #ffe5b5; transform: translate3d(40px, 0, 0) rotate(0); } #dn:checked + .toggle .toggle__handler .crater { opacity: 1; } #dn:checked + .toggle .star--1 { width: 2px; height: 2px; } #dn:checked + .toggle .star--2 { width: 4px; height: 4px; transform: translate3d(-5px, 0, 0); } #dn:checked + .toggle .star--3 { width: 2px; height: 2px; transform: translate3d(-7px, 0, 0); } #dn:checked + .toggle .star--4, #dn:checked + .toggle .star--5, #dn:checked + .toggle .star--6 { opacity: 1; transform: translate3d(0, 0, 0); } #dn:checked + .toggle .star--4 { transition: all 300ms 200ms cubic-bezier(0.445, 0.05, 0.55, 0.95); } #dn:checked + .toggle .star--5 { transition: all 300ms 300ms cubic-bezier(0.445, 0.05, 0.55, 0.95); } #dn:checked + .toggle .star--6 { transition: all 300ms 400ms cubic-bezier(0.445, 0.05, 0.55, 0.95); }
          span.badge.badge-soft-primary {  background: #0168fa;  color: white;  }
          span.badge.badge-soft-danger {  color: white;  background: #f30000;  }
          span.badge.badge-soft-info { background: #11ca11; color: white; }
          span.badge.badge-soft-dark {background: white;color: black;}
          .bootstrap-tagsinput { width: 100% !important; }
          span.tag.label.label-info {border-radius: 31px;}
          span.tag.label.label-info > span { margin-top: -7px; margin-left: 4px; margin-right: 4px; }
      </style>

  </head>
  <body class="app-chat">

    <aside class="aside aside-fixed">
      <div class="aside-header">
          <a href="/" class="aside-logo" style="font-weight: 100;">
              <img style="max-width: 160px; margin-top: -6px;" src="<?php echo $define["app"]::getLogo(); ?>" alt="<?php echo $define["title"]; ?>" height="30px">
          </a>
        <a href="" class="aside-menu-link">
          <i data-feather="menu"></i>
          <i data-feather="x"></i>
        </a>
        <a href="" id="chatContentClose" class="burger-menu d-none"><i data-feather="arrow-left"></i></a>
      </div>
      <div class="aside-body">
        <div class="aside-loggedin">
          <div class="d-flex align-items-center justify-content-start">
            <a href=""  class="avatar"><img  src="<?php echo "//www.gravatar.com/avatar/" . md5( strtolower( trim( $define["app"]::getUser($_SESSION["cms_auth_email"],$_SESSION["cms_auth_site"])["email"] ) ) ) . "?s=100"; ?>" class="rounded-50"  alt=""></a>
            <div class="aside-alert-link">

              <a href="javascript:;" class="exitApp" data-toggle="tooltip" title="Sign out"><i data-feather="log-out"></i></a>
            </div>
          </div>
          <div class="aside-loggedin-user">
            <a href="#loggedinMenu" class="d-flex align-items-center justify-content-between mg-b-2" data-toggle="collapse">
              <h6 class="tx-semibold mg-b-0"><?php echo $define["app"]::getUser($_SESSION["cms_auth_email"],$_SESSION["cms_auth_site"])["name"]; ?> <?php echo $define["app"]::getUser($_SESSION["cms_auth_email"],$_SESSION["cms_auth_site"])["surname"]; ?></h6>
              <i data-feather="chevron-down"></i>
            </a>
            <p class="tx-color-03 tx-12 mg-b-0"><?php echo $define["app"]::userType($define["app"]::getUser($_SESSION["cms_auth_email"],$_SESSION["cms_auth_site"])["user_type"]); ?></p>
          </div>
          <div class="collapse" id="loggedinMenu">
            <ul class="nav nav-aside mg-b-0">
              <li class="nav-item"><a  href="#settingsForm" data-target="#settingsForm" data-toggle="modal"  class="nav-link"><i data-feather="edit"></i> <span>Update Password</span></a></li>
              <li class="nav-item"><a href="<?php echo $define["app"]::getSite()["domain"]; ?>" target="_blank" class="nav-link"><i data-feather="external-link"></i> <span>Visit Page</span></a></li>
              <li class="nav-item exitApp"><a href="javascript:;" class="nav-link"><i data-feather="log-out"></i> <span>Sign out</span></a></li>
            </ul>
          </div>
        </div><!-- aside-loggedin -->
        <ul class="nav nav-aside">

            <li class="nav-item"><a href="/" class="nav-link"><i data-feather="home"></i> <span>Home</span></a></li>


            <?php $b1 = 0; foreach ($page["menuModel"]::getMenuListMultiple($_SESSION["cms_auth_site"]) as $itemMenuMultiple): ?>
                <?php  if(($data["define"]["pluginModel"]::check_permission($_SESSION["cms_auth_uuid"],$itemMenuMultiple["uuid"])) or ($data["define"]["pluginModel"]::check_type($_SESSION["cms_auth_uuid"],"root") or $data["define"]["pluginModel"]::check_type($_SESSION["cms_auth_uuid"],"root") or $data["define"]["pluginModel"]::check_type($_SESSION["cms_auth_uuid"],"admin")) ): $b1 += 1; ?>
                    <?php if($b1 === 1): ?>
                        <li class="nav-label mg-t-25">Multiple Module</li>
                    <?php endif; ?>
                    <li class="nav-item with-sub">
                        <a href="" class="nav-link"><i data-feather="layers"></i> <span><?php echo $itemMenuMultiple["label"]; ?></span></a>
                        <ul>
                            <li><a href="/app/module/<?php echo $itemMenuMultiple["uuid"]; ?>/create">New Record</a></li>
                            <li><a href="/app/module/<?php echo $itemMenuMultiple["uuid"]; ?>/records">All Records</a></li>
                        </ul>
                    </li>

                <?php endif; ?>
            <?php endforeach; ?>

            <?php  $m1 = 0;  foreach ($page["menuModel"]::getMenuListSingle($_SESSION["cms_auth_site"]) as $itemMenu): ?>
                <?php if(($data["define"]["pluginModel"]::check_permission($_SESSION["cms_auth_uuid"],$itemMenu["uuid"])) or ($data["define"]["pluginModel"]::check_type($_SESSION["cms_auth_uuid"],"root") or $data["define"]["pluginModel"]::check_type($_SESSION["cms_auth_uuid"],"root") or $data["define"]["pluginModel"]::check_type($_SESSION["cms_auth_uuid"],"admin")) ): $m1 += 1; ?>
                    <?php if($m1 === 1): ?>
                        <li class="nav-label mg-t-25">Single Module</li>
                    <?php endif; ?>
                    <li class="nav-item"><a href="/app/module/<?php echo $itemMenu["uuid"]; ?>" class="nav-link"><i data-feather="edit"></i> <span><?php echo $itemMenu["label"]; ?></span></a></li>

                <?php endif; ?>
            <?php endforeach; ?>

            <?php if ($data["define"]["hook"]->do_action("admin@menu",$_REQUEST,true)): ?>

                <?php $p1 = 0; foreach ($data["define"]["hook"]->do_action("admin@menu",$_REQUEST,true) as $menuChildMaster): ?>

                    <?php foreach ($menuChildMaster as $menu): $p1 += 1;  ?>
                        <?php if($p1 === 1): ?>
                            <li class="nav-label mg-t-25">Plugins</li>
                        <?php endif; ?>

                        <?php if(!isset($menu["child"])): ?>
                            <?php if(($data["define"]["pluginModel"]::check_permission($_SESSION["cms_auth_uuid"],$menu["permission"])) or ($data["define"]["pluginModel"]::check_type($_SESSION["cms_auth_uuid"],"root") or $data["define"]["pluginModel"]::check_type($_SESSION["cms_auth_uuid"],"admin") or $data["define"]["pluginModel"]::check_type($_SESSION["cms_auth_uuid"],"root")) ):   ?>

                                <li class="nav-item"><a href="/app/plugin?page=<?php echo $menu["url"]; ?>" class="nav-link"><i data-feather="<?php echo $menu["icon"]; ?>"></i> <span><?php echo $menu["title"]; ?></span></a></li>

                            <?php endif; ?>
                        <?php else: ?>

                            <?php if(isset($menu["child"])):?>
                                <?php if(($data["define"]["pluginModel"]::check_permission($_SESSION["cms_auth_uuid"],$menu["permission"])) or ($data["define"]["pluginModel"]::check_type($_SESSION["cms_auth_uuid"],"root") or $data["define"]["pluginModel"]::check_type($_SESSION["cms_auth_uuid"],"admin")  or $data["define"]["pluginModel"]::check_type($_SESSION["cms_auth_uuid"],"root")) ):   ?>

                                    <li class="nav-item with-sub">
                                        <a href="" class="nav-link"><i data-feather="<?php echo $menu["icon"]; ?>"></i> <span><?php echo $menu["title"]; ?></span></a>
                                        <ul>
                                            <?php foreach ($menu["child"] as $multiMenu): ?>
                                                <?php if(($data["define"]["pluginModel"]::check_permission($_SESSION["cms_auth_uuid"],$multiMenu["permission"])) or ($data["define"]["pluginModel"]::check_type($_SESSION["cms_auth_uuid"],"root") or $data["define"]["pluginModel"]::check_type($_SESSION["cms_auth_uuid"],"admin")) ):  ?>
                                                    <li><a href="/app/plugin?page=<?php echo $multiMenu["url"]; ?>"><?php echo $multiMenu["title"]; ?></a></li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                            <?php endif;?>

                        <?php endif; ?>


                    <?php endforeach; ?>

                <?php endforeach; ?>
            <?php endif; ?>




            <?php if( $data["define"]["pluginModel"]::check_permission($_SESSION["cms_auth_uuid"],"system_settings") || $data["define"]["pluginModel"]::check_type($_SESSION["cms_auth_uuid"],"root") || $data["define"]["pluginModel"]::check_type($_SESSION["cms_auth_uuid"],"admin") || $data["define"]["pluginModel"]::check_type($_SESSION["cms_auth_uuid"],"root") ): ?>
                <li class="nav-label mg-t-25">Administration</li>
                <li class="nav-item with-sub">
                    <a href="" class="nav-link"><i data-feather="settings"></i> <span>Settings</span></a>
                    <ul>
                        <li><a href="/app/user/management">User Management</a></li>
                        <li><a href="/app/menu">Menu Management</a></li>
                        <li><a href="/app/settings">System Management</a></li>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if( $data["define"]["pluginModel"]::check_type($_SESSION["cms_auth_uuid"],"root") ||  $data["define"]["pluginModel"]::check_type($_SESSION["cms_auth_uuid"],"admin") || $data["define"]["pluginModel"]::check_type($_SESSION["cms_auth_uuid"],"root") || $data["define"]["pluginModel"]::check_type($_SESSION["cms_auth_uuid"],"api") ): ?>
                <li class="nav-label mg-t-25">Integration</li>
                <li class="nav-item"><a href="/app/api" class="nav-link"><i data-feather="git-pull-request"></i> <span>Api Management</span></a></li>
            <?php endif; ?>

            <?php if($_SESSION["cms_auth_manager"] or $data["define"]["pluginModel"]::check_type($_SESSION["cms_auth_uuid"],"root")): ?>
                <li class="nav-label mg-t-25">System Management</li>
                <li class="nav-item"><a href="/app/management" class="nav-link"><i data-feather="cpu"></i> <span>Site Management</span></a></li>
            <?php  endif; ?>

        </ul>
      </div>
    </aside>

    <div class="content ht-100v pd-0">
      <div class="content-header">
        <div class="content-search">
            <div class="toggleWrapper">
                <input type="checkbox" class="dn" id="dn"/>
                <label for="dn" class="toggle">
                <span class="toggle__handler">
                  <span class="crater crater--1"></span>
                  <span class="crater crater--2"></span>
                  <span class="crater crater--3"></span>
                </span>
                <span class="star star--1"></span>
                <span class="star star--2"></span>
                <span class="star star--3"></span>
                <span class="star star--4"></span>
                <span class="star star--5"></span>
                <span class="star star--6"></span>
                </label>
            </div>
        </div>
        <nav class="nav">

            <div class="dropdown dropdown-message">
                <a href="" class="dropdown-link new-indicator" data-toggle="dropdown" aria-expanded="false">
                    <img src="/Assets/images/flags/<?php echo $define["languageModel"]::$langs[$_SESSION["cms_aut_language"]][1]; ?>.jpg" width="35px" alt="">
                </a>
                <div class="dropdown-menu dropdown-menu-right" style="width: auto !important; top:20px !important;">
                    <div class="dropdown-header">Data Entry Languages</div>

                    <?php foreach ($define["languageModel"]::$langs as $key => $langs): ?>

                        <?php if($key !== $_SESSION["cms_aut_language"]): ?>
                            <!-- item-->


                            <a data-prefix="<?php echo $key; ?>" href="javascript:void(0);"   class="switchLanguage setLanguage dropdown-item">
                                <div class="media">
                                    <img src="/Assets/images/flags/<?php echo $langs[1]; ?>.jpg" alt="user-image" class="mr-2" height="12"><span class="align-middle"><?php echo $langs[0]; ?></span>
                                </div><!-- media -->
                            </a>

                        <?php endif; ?>

                    <?php endforeach; ?>

                </div><!-- dropdown-menu -->
            </div>

        </nav>
      </div><!-- content-header -->

      <div class="content-body ">
          <div class="container pd-x-0">
              <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
                  <div>
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                              <li class="breadcrumb-item"><a href="/">Home</a></li>
                              <?php foreach ($define["breadcrumb"] as $itemBreadcrumb): ?>
                                  <li class="breadcrumb-item active"><?php echo $itemBreadcrumb; ?></li>
                              <?php endforeach; ?>
                          </ol>
                      </nav>
                      <h4 class="mg-b-0 tx-spacing--1"><?php echo $define["title"]; ?></h4>
                  </div>
                  <div class="d-none d-md-block"></div>
              </div>
              <?php $define["templateModel"]::getInner($define["_inner_page"],$data); ?>
          </div>
      </div>
    </div><!-- content -->



    <form class="settingsForm" onsubmit="return false;">
        <!-- sample modal content -->
        <div id="settingsForm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="settingsForm" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myModalLabel">Account settings</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">


                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label">Name</label>
                            <div class="col-md-10">
                                <input value="<?php echo $define["app"]::getUser($_SESSION["cms_auth_email"],$_SESSION["cms_auth_site"])["name"];?>"  readonly disabled class="form-control" type="text"  id="name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="surname" class="col-md-2 col-form-label">Surname</label>
                            <div class="col-md-10">
                                <input value="<?php echo $define["app"]::getUser($_SESSION["cms_auth_email"],$_SESSION["cms_auth_site"])["surname"];?>"  readonly disabled  class="form-control" type="text"  id="surname">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="menuTitle" class="col-md-2 col-form-label">E-Mail</label>
                            <div class="col-md-10">
                                <input value="<?php echo $define["app"]::getUser($_SESSION["cms_auth_email"],$_SESSION["cms_auth_site"])["email"];?>"  readonly disabled class="form-control" type="text"  id="menuTitle">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pass" class="col-md-5 col-form-label">New Password</label>
                            <div class="col-md-7">
                                <input    name="pass" class="form-control" type="text"  id="pass">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rePass" class="col-md-5 col-form-label">Repeat New Password</label>
                            <div class="col-md-7">
                                <input  name="rePass" class="form-control" type="text"  id="rePass">
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </form>


    <script src="/Assets/v2/Assets/lib/jquery/jquery.min.js"></script>
    <script src="/Assets/v2/Assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/Assets/v2/Assets/lib/feather-icons/feather.min.js"></script>
    <script src="/Assets/v2/Assets/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="/Assets/libs/node-waves/waves.min.js"></script>
    <script src="/Assets/libs/nestable2/jquery.nestable.min.js"></script>

    <script src="/Assets/v2/Assets/js/dashforge.js"></script>
    <script src="/Assets/v2/Assets/js/dashforge.aside.js"></script>

    <script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



    <!-- Required datatable js -->
    <script src="/Assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/Assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/Assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/Assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="/Assets/libs/jszip/jszip.min.js"></script>
    <script src="/Assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="/Assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="/Assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="/Assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="/Assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="/Assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/Assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script><script src="/Assets/libs/tinymce/tinymce.min.js"></script>
    <script src="/Assets/js/prism.js"></script>
    <script src="/Assets/js/download.js"></script>
    <script src="/Assets/v2/Assets/lib/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
    <script src="/Assets/libs/spectrum-colorpicker/spectrum.js"></script>
    <script src="/Assets/libs/selectize/js/standalone/selectize.min.js"></script>
    <script src="/Assets/libs/air-datepicker/js/datepicker.min.js"></script>
    <script src="/Assets/libs/air-datepicker/js/i18n/datepicker.en.js"></script>
    <script src="/Assets/js/jquery.steps.min.js"></script>
    <script src="/Assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="/Assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.10.2/Sortable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.0/dist/jquery.fancybox.min.js"></script>
    <script src="/Assets/js/sequencer.js"></script>
    <script src="/Assets/v2/Assets/lib/parsleyjs/parsley.min.js"></script>
    <script src="/Assets/v2/Assets/lib/jquery-steps/build/jquery.steps.min.js"></script>
    <script src="/Assets/js/waiter.js"></script>

    <?php if ($data["define"]["hook"]->do_action("body@js",$_REQUEST,true)): ?>
        <?php foreach ($data["define"]["hook"]->do_action("body@js",$_REQUEST,true) as $js): ?>
            <?php foreach ($js as $jsItem): ?>
                <script src="<?php echo $jsItem; ?>"></script>
            <?php endforeach; ?>
        <?php endforeach; ?>
    <?php endif; ?>

    <script src="/Assets/v2/Assets/lib/js-cookie/js.cookie.js"></script>
    <script src="/Assets/v2/Assets/js/dashforge.settings.js"></script>
    <script src="/Assets/js/urlify.js"></script>
    <script src="/Assets/js/imask.js"></script>
    <script src="/Assets/js/vobo.js"></script>



  </body>
</html>