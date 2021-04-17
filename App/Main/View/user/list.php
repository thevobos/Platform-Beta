<button style="margin-bottom: 20px;" type="button" data-toggle="modal" data-target="#userAdminform" class="btn btn-primary btn-sm waves-effect waves-light">Create User</button>


<table id="user-table" class="table table-striped table-bordered  nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Surname</th>
        <th>E-Mail</th>
        <th>Status</th>
        <th>Date</th>
        <th></th>
    </tr>
    </thead>
</table>



<form class="userAdminformAjax" onsubmit="return false;">
    <!-- sample modal content -->
    <div id="userAdminform" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="userAdminform" aria-hidden="true">
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
                        <label for="name" class="col-md-4 col-form-label">Name</label>
                        <div class="col-md-8">
                            <input  name="name" class="form-control" type="text"  id="name">
                        </div>
                    </div>



                    <div class="form-group row">
                        <label for="surname" class="col-md-4 col-form-label">Surname</label>
                        <div class="col-md-8">
                            <input  name="surname" class="form-control" type="text"  id="surname">
                        </div>
                    </div>



                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label">Phone</label>
                        <div class="col-md-8">
                            <input  name="phone" class="form-control" type="tel"  id="phone">
                        </div>
                    </div>



                    <div class="form-group row">
                        <label for="eMail" class="col-md-4 col-form-label">E-Mail</label>
                        <div class="col-md-8">
                            <input  name="email" class="form-control" type="email"  id="email">
                        </div>
                    </div>



                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label">Password</label>
                        <div class="col-md-8">
                            <input  name="password" class="form-control" type="text"  id="password">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="userType" class="col-md-4 col-form-label">User Type</label>
                        <div class="col-md-8">
                            <select id="userType" required class="custom-select" name="type">
                                <?php if($data["define"]["hook"]->do_action("admin@user:type",$_REQUEST,true)): ?>
                                    <?php foreach ($data["define"]["hook"]->do_action("admin@user:type",$_REQUEST,true) as $userType): ?>
                                        <?php foreach ($userType as $userTypeItem): ?>

                                            <option  value="<?php echo $userTypeItem["value"]; ?>"><?php echo $userTypeItem["label"]; ?></option>

                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="userType" class="col-md-4 col-form-label">User Permissions</label>
                        <div class="col-md-8">
                            <select multiple  required class="multipleselectJs" name="permission[]">
                                <?php if($data["define"]["hook"]->do_action("admin@user:permission",$_REQUEST,true)): ?>
                                    <?php foreach ($data["define"]["hook"]->do_action("admin@user:permission",$_REQUEST,true) as $userPermission): ?>
                                        <?php foreach ($userPermission as $userPermissionItem): ?>

                                            <option  value="<?php echo $userPermissionItem["value"]; ?>"><?php echo $userPermissionItem["label"]; ?></option>

                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
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



<form class="userAdminformAjaxUpdate" onsubmit="return false;">
    <!-- sample modal content -->
    <div id="userAdminformAjaxUpdate" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="userAdminformAjaxUpdate" aria-hidden="true">
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
                        <label for="name" class="col-md-4 col-form-label">Name</label>
                        <div class="col-md-8">
                            <input  name="name" class="form-control nameUp" type="text"  id="name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="surname" class="col-md-4 col-form-label">Surname</label>
                        <div class="col-md-8">
                            <input  name="surname" class="form-control surnameUp" type="text"  id="surname">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label">Phone</label>
                        <div class="col-md-8">
                            <input  name="phone" class="form-control phoneUp" type="tel"  id="phone">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="eMail" class="col-md-4 col-form-label">E-Mail</label>
                        <div class="col-md-8">
                            <input  name="email" class="form-control emailUp" type="email"  id="email">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label">Password</label>
                        <div class="col-md-8">
                            <input  name="password" class="form-control passwordUp" type="text"  id="password">
                        </div>
                    </div>

                    <input type="hidden" name="uuid" class="hiddenUserUuid">

                    <div class="form-group row">
                        <label for="userType" class="col-md-4 col-form-label">User Types</label>
                        <div class="col-md-8">
                            <select id="userType" required class="updateType" name="type">
                                <?php if($data["define"]["hook"]->do_action("admin@user:type",$_REQUEST,true)): ?>
                                    <?php foreach ($data["define"]["hook"]->do_action("admin@user:type",$_REQUEST,true) as $userType): ?>
                                        <?php foreach ($userType as $userTypeItem): ?>

                                            <option  value="<?php echo $userTypeItem["value"]; ?>"><?php echo $userTypeItem["label"]; ?></option>

                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="userType" class="col-md-4 col-form-label">User Permissions</label>
                        <div class="col-md-8">
                            <select multiple  required class="updatePermission" name="permission[]">
                                <?php if($data["define"]["hook"]->do_action("admin@user:permission",$_REQUEST,true)): ?>
                                    <?php foreach ($data["define"]["hook"]->do_action("admin@user:permission",$_REQUEST,true) as $userPermission): ?>
                                        <?php foreach ($userPermission as $userPermissionItem): ?>

                                            <option  value="<?php echo $userPermissionItem["value"]; ?>"><?php echo $userPermissionItem["label"]; ?></option>

                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button"  class="removeUserUuid btn btn-danger waves-effect" >Remove</button>
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</form>
