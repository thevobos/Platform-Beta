

<div class="row">
    <div class="col-md-6">
        <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-toggle="modal" data-target="#createMenuCategory">Creating a Menu Category</button>

        <table class="table table-centered table-hover mb-0  " style="margin-top: 20px;">
            <tbody>

                <?php foreach ($page["menuModel"]::listCategory($_SESSION["cms_auth_site"],$_SESSION["cms_aut_language"]) as $categoryItem): ?>
                <tr>
                    <th width="80%" scope="row">
                        <?php echo $categoryItem["label"]; ?> <?php echo $categoryItem["uuid"] === $page["categoryCode"] ? "<span style='top: -2.5px; position: relative;' class='badge badge-pill badge-success'>Active</span>" : "<span style='top: -2.5px; position: relative;'  class='badge badge-pill badge-danger'>Passive</span>"?>
                    </th>
                    <td>
                        <div class="btn-group" role="group">
                          <?php if($categoryItem["uuid"] !== $page["categoryCode"]): ?>
                              <button onclick="location.href ='/app/menu/<?php echo $categoryItem["uuid"]; ?>'"  class="btn btn-primary btn-icon " data-toggle="tooltip" data-placement="top" title="Details">
                                  <i data-feather="eye"></i>
                              </button>
                        <?php endif; ?>

                            <button data-label="<?php echo $categoryItem["label"]; ?>" data-uuid="<?php echo $categoryItem["uuid"]; ?>" type="button" class="btn btn-primary btn-icon categoryEdit" data-toggle="tooltip" data-placement="top" title="Edit">
                                <i data-feather="edit-2"></i>
                            </button>

                            <button type="button" class="categoryDelete btn btn-primary btn-icon" data-uuid="<?php echo $categoryItem["uuid"]; ?>"  data-toggle="tooltip" data-placement="top" title="Remove">
                                <i data-feather="trash-2"></i>
                            </button>



                        </div>
                    </td>
                </tr>

                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
    <div class="col-md-6" >

        <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-toggle="modal" data-target="#createMenuItem">
            Creating a Sub Menu
            <span class="badge badge-success ml-1"><?php echo $page["menuModel"]::getCategory($_SESSION["cms_auth_site"],$page["categoryCode"],$_SESSION["cms_aut_language"],$_SESSION["cms_aut_language"])["label"]; ?></span>
        </button>
        <div class="custom-dd dd" data-uuid="<?php echo $page["categoryCode"];?>" id="menuNest" style="margin-top: 10px;">
            <?php echo $page["menuModel"]::getNestable($_SESSION["cms_auth_site"],$page["categoryCode"]); ?>
        </div>
    </div>
</div>

<form action="" class="createMenuItemForm" onsubmit="return false;">
    <!-- sample modal content -->
    <div id="createMenuItem" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="createMenuItem" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Creating a Sub Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="menuTitle" class="col-md-2 col-form-label">Title</label>
                        <div class="col-md-10">
                            <input required class="form-control sefLinkInCategoryItemMaster" type="text" placeholder="Enter title..." name="label" id="menuTitle">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="menuTitle" class="col-md-2 col-form-label">Url</label>
                        <div class="col-md-10">
                            <div class="input-group mt-3 mt-sm-0 mr-sm-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">/</div>
                                </div>
                                <input required readonly type="text" class="form-control sefLinkInCategoryItem" name="sefLink" placeholder="Entry link...">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="uuid" value="<?php echo $page["categoryCode"];?>">
                    <div class="alert alert-info" role="alert">
                       <strong>URL</strong> Add the spaces last to customize the address.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cance</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Create</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</form>

<form class="createMenuCategoryForm" onsubmit="return false;">
    <!-- sample modal content -->
    <div id="createMenuCategory" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="createMenuCategory" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Menu Menu Category Creation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"> 
                    <div class="form-group row">
                        <label for="menuTitle" class="col-md-2 col-form-label">Title</label>
                        <div class="col-md-10">
                            <input required  name="label" class="form-control" type="text" placeholder="Menu Title..." id="menuTitle">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Oluştur</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</form> 

<form class="editMenuCategoryForm" onsubmit="return false;">
    <!-- sample modal content -->
    <div id="editMenuCategory" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editMenuCategory" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Menu Category Editing</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="menuTitle" class="col-md-2 col-form-label">Title</label>
                        <div class="col-md-10">
                            <input required class="form-control editMenuCategoryInput" type="text" name="label" placeholder="Enter title..." id="menuTitle">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="menuUuid" class="col-md-2 col-form-label">UUID</label>
                        <div class="col-md-10">
                            <input readonly disabled  class="form-control uuidsA" type="text" placeholder="UUID..."  id="menuUuid">
                        </div>
                    </div>
                </div>
                <input type="hidden" name="uuid" class="uuidsA" value="">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</form>





<form class="updateMenuItemForm" onsubmit="return false;">
    <!-- sample modal content -->
    <div id="updateMenuItem" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updateMenuItem" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Editing a Sub Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group row">
                        <label for="menuTitle" class="col-md-2 col-form-label">Title</label>
                        <div class="col-md-10">
                            <input required class="form-control sefLinkInCategoryItemMasterUp" type="text" placeholder="Title..." name="label" id="menuTitle">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="menuTitle" class="col-md-2 col-form-label">Url</label>
                        <div class="col-md-10">
                            <div class="input-group mt-3 mt-sm-0 mr-sm-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">/</div>
                                </div>
                                <input required type="text" class="form-control sefLinkInCategoryItemUp" name="sefLink" placeholder="Enter Link...">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="menuUuid" class="col-md-2 col-form-label">UUID</label>
                        <div class="col-md-10">
                            <input readonly disabled  class="form-control uuids" type="text" placeholder="UUID..."  id="menuUuid">
                        </div>
                    </div>
                    <input type="hidden" name="uuid" class="updateMenuItemFormId" value="">
                    <div class="alert alert-info" role="alert">
                        <strong>URL</strong> Add the spaces last to customize the address.
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Cover Image* <a class="iframe-btn" href="/3thparty/filemanager/dialog.php?type=2&field_id=coverUpdate&multiple=0">(CHOOSE)</a> </label>
                            <input autocomplete="off" type="hidden" name="coverUpdate" class="custom-file-input" id="coverUpdate">
                            <ul class="add-produc-imgs coverUpdate"></ul>
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