<button type="button" data-toggle="modal" data-target="#siteAdd" class="btn btn-primary btn-sm waves-effect waves-light">Create Site</button>

<table id="sites-table" class="table table-striped table-bordered  nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Site Code</th>
        <th>Site Url</th>
        <th>Site Title</th>
        <th>Site Authorized</th>
        <th>Date</th>
        <th>Operation</th>
    </tr>
    </thead>
</table>




<form class="siteAdd" onsubmit="return false;">
    <!-- sample modal content -->
    <div id="siteAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="siteAdd" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Creating a Site</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="menuTitle" class="col-md-2 col-form-label">Domain Name</label>
                        <div class="col-md-10">
                            <input required  name="domain" class="form-control" type="text" placeholder="Domain ... example.com" id="menuTitle">
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="menuTitle" class="col-md-2 col-form-label">Title</label>
                        <div class="col-md-10">
                            <input required  name="title" class="form-control" type="text" placeholder="Enter title (site title)" id="menuTitle">
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="menuTitle" class="col-md-2 col-form-label">Authorized</label>
                        <div class="col-md-10">
                            <input required  name="author" class="form-control" type="text" placeholder="Enter the authorized name..." id="menuTitle">
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="record_limit" class="col-md-2 col-form-label">Record Limit ( 0 = unlimited )</label>
                        <div class="col-md-10">
                            <input required  name="record_limit" class="form-control" type="number" value="500" placeholder="Data logging limit" id="record_limit">
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="panelLogo" class="col-md-2 col-form-label">Dashboard Logo</label>
                        <div class="col-md-7">
                            <input required  name="logo" class="form-control" type="text" placeholder="Choose..." id="panelLogo">
                        </div>
                        <div class="col-md-3">
                            <a href="/3thparty/filemanager/dialog.php?type=2&field_id=panelLogo&relative_url=1" class="btn btn-primary iframe-btn" type="button">Choose Logo</a>
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
                                        <option  value="<?php echo $userPermission["slug"]; ?>"><?php echo $userPermission["title"]; ?></option>
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
