<script>
    let siteCode = "<?php echo $define["code"]; ?>";
</script>

<a href="/app/management/<?php echo $define["code"]; ?>/module/create">
    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light">Create Module</button>
</a>

<button type="button" data-toggle="modal" data-target="#siteSettings" class="btn btn-primary btn-sm waves-effect waves-light">Site Settings</button>


<table data-code="<?php echo $define["code"]; ?>" id="crud-table" class="table table-striped table-bordered  nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>UUID</th>
        <th>Title</th>
        <th>Type</th>
        <th>Sordt</th>
        <th>Date</th>
        <th>Operation</th>
    </tr>
    </thead>
</table>

<a href="#managerForm"  data-target="#managerForm" data-toggle="modal"  style="margin-top: 40px;">
    <button type="button" style="margin-top: 40px;" class="btn btn-primary btn-sm waves-effect waves-light">Create Authorized</button>
</a>

<table data-code="<?php echo $define["code"]; ?>" id="manager-table" class="table table-striped table-bordered nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; margin-top: 20px;">
    <thead>
    <tr>
        <th>UUID</th>
        <th>Name</th>
        <th>Phone</th>
        <th>E-mail (Username)</th>
        <th>Password</th>
        <th>Operation</th>
    </tr>
    </thead>
</table>


<form class="managerForm" onsubmit="return false;">
    <!-- sample modal content -->
    <div id="managerForm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="managerForm" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Authorized Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">



                    <div class="form-group row">
                        <label for="name" class="col-md-3 col-form-label">Name</label>
                        <div class="col-md-9">
                            <input  name="name" class="form-control" type="text"  id="name">
                        </div>
                    </div>



                    <div class="form-group row">
                        <label for="surname" class="col-md-3 col-form-label">Surname</label>
                        <div class="col-md-9">
                            <input  name="surname" class="form-control" type="text"  id="surname">
                        </div>
                    </div>



                    <div class="form-group row">
                        <label for="phone" class="col-md-3 col-form-label">Phone</label>
                        <div class="col-md-9">
                            <input  name="phone" class="form-control" type="tel"  id="phone">
                        </div>
                    </div>



                    <div class="form-group row">
                        <label for="eMail" class="col-md-3 col-form-label">E-Mail</label>
                        <div class="col-md-9">
                            <input  name="eMail" class="form-control" type="email"  id="eMail">
                        </div>
                    </div>



                    <div class="form-group row">
                        <label for="password" class="col-md-3 col-form-label">Password</label>
                        <div class="col-md-9">
                            <input  name="password" class="form-control" type="text"  id="password">
                        </div>
                    </div>

                    <input type="hidden" name="siteCode" value="<?php echo $define["code"]; ?>">

                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Create</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</form>






<form class="siteSettings" onsubmit="return false;">
    <!-- sample modal content -->
    <div id="siteSettings" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="siteSettings" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Site Settings</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="menuTitle" class="col-md-2 col-form-label">Domain</label>
                        <div class="col-md-10">
                            <input required  name="domain" class="form-control" type="text" value="<?php echo $define["details"]["domain"]; ?>" placeholder="Domain ... example.com" id="menuTitle">
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="menuTitle" class="col-md-2 col-form-label">Title</label>
                        <div class="col-md-10">
                            <input required  name="title" class="form-control" type="text" value="<?php echo $define["details"]["title"]; ?>" placeholder="Enter title (site title)" id="menuTitle">
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="menuTitle" class="col-md-2 col-form-label">Authorized</label>
                        <div class="col-md-10">
                            <input required  name="author" class="form-control" type="text" value="<?php echo $define["details"]["author"]; ?>" placeholder="Enter the authorized name ..." id="menuTitle">
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="record_limit" class="col-md-2 col-form-label">Record Limit</label>
                        <div class="col-md-10">
                            <input required  name="record_limit" class="form-control" type="number" value="<?php echo $define["details"]["record_limit"]; ?>" placeholder="Data logging limit" id="record_limit">
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="panelLogo" class="col-md-2 col-form-label">Dashboard Logo</label>
                        <div class="col-md-7">
                            <input required  name="logo" class="form-control" type="text" value="<?php echo $define["details"]["logo"]; ?>" placeholder="Choose..." id="panelLogo">
                        </div>
                        <div class="col-md-3">
                            <a href="/3thparty/filemanager/dialog.php?type=2&field_id=panelLogo&relative_url=1" class="btn btn-primary iframe-btn" type="button">Choose</a>
                        </div>

                    </div>
                </div>

                <div class="modal-body">
                    <div class="form-group row">
                        <label for="plugins" class="col-md-3 col-form-label">Plugins</label>
                        <div class="col-md-9">
                            <select multiple class="multipleselectJs" name="plugins[]">
                                <?php if($data["define"]["hook"]->do_action("plugin@info",$_REQUEST,true)): ?>
                                    <?php foreach ($data["define"]["hook"]->do_action("plugin@info",$_REQUEST,true) as $userPermission): ?>
                                        <option <?php echo in_array($userPermission["slug"],((array)json_decode($define["details"]["plugins"]))) ? "selected" : "";  ?>  value="<?php echo $userPermission["slug"]; ?>"><?php echo $userPermission["title"]; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                    </div>
                </div>

                <input type="hidden" name="uuid" value="<?php echo $define["details"]["uuid"]; ?>">


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</form>
