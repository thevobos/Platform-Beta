
<div class="row">
    <div class="col-md-6">

        <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-toggle="modal" data-target="#createMenuCategory">Create Menu Category</button>

        <table class="table table-centered table-hover mb-0  " style="margin-top: 20px;">
            <tbody>

                <?php foreach ($page["menuModel"]::listCategory($_SESSION["cms_auth_site"],$_SESSION["cms_aut_language"]) as $categoryItem): ?>
                <tr>
                    <th width="80%" scope="row">
                         <?php echo $categoryItem["label"]; ?>
                    </th>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="/app/menu/<?php echo $categoryItem["uuid"]; ?>">
                                <button type="button" class="btn btn-primary btn-icon">
                                    <i data-feather="eye"></i>
                                </button>
                            </a>
                        </div>
                    </td>
                </tr>

                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
    <div class="col-md-6" >


        <div class="card noti border mt-4 mt-lg-0 mb-0">
            <div class="card-body">

                <div class="text-center">
                    <div class="icons-xl uim-icon-warning my-4">
                        <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em"><path class="uim-tertiary" d="M20.05713,22H3.94287A3.02288,3.02288,0,0,1,1.3252,17.46631L9.38232,3.51123a3.02272,3.02272,0,0,1,5.23536,0L22.6748,17.46631A3.02288,3.02288,0,0,1,20.05713,22Z"></path><circle cx="12" cy="17" r="1" class="uim-primary"></circle><path class="uim-primary" d="M12,14a1,1,0,0,1-1-1V9a1,1,0,0,1,2,0v4A1,1,0,0,1,12,14Z"></path></svg></span>
                    </div>
                    <h4 class="alert-heading font-size-20">WARNING</h4>
                    <p class="text-muted">Make a category selection</p>

                </div>

            </div>
        </div>


    </div>
</div>


<form class="createMenuCategoryForm" onsubmit="return false;">
    <!-- sample modal content -->
    <div id="createMenuCategory" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="createMenuCategory" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Menu Category Creation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="menuTitle" class="col-md-2 col-form-label">Title</label>
                        <div class="col-md-10">
                            <input required  name="label" class="form-control" type="text" placeholder="Category Title..." id="menuTitle">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Create</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</form>