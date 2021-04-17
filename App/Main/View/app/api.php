<button type="button" data-toggle="modal" data-target="#tokenAdd" class="btn btn-primary btn-sm waves-effect waves-light">Create Api</button>

<table id="tokens-table" class="table table-striped table-bordered  nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Token Code</th>
        <th>Secret Code</th>
        <th>Write</th>
        <th>Read</th>
        <th>Update</th>
        <th>Remove</th>
        <th>Date</th>
        <th>Operation</th>
    </tr>
    </thead>
</table>


<table id="api-table" class="table table-striped table-bordered  nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Module</th>
        <th>Type</th>
        <th>Operation</th>
    </tr>
    </thead>
</table>


<form class="tokenAdd" onsubmit="return false;">
    <!-- sample modal content -->
    <div id="tokenAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tokenAdd" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Api Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group row">
                        <label for="menuTitle" class="col-md-3 col-form-label">WRITE</label>
                        <div class="col-md-9">
                            <select required class="custom-select" name="isWrite">
                                <option selected  value="active">Yes</option>
                                <option  value="passive">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="menuTitle" class="col-md-3 col-form-label">READ</label>
                        <div class="col-md-9">
                            <select required class="custom-select" name="isRead">
                                <option selected  value="active">Yes</option>
                                <option  value="passive">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="menuTitle" class="col-md-3 col-form-label">UPDATE</label>
                        <div class="col-md-9">
                            <select required class="custom-select" name="isUpdate">
                                <option selected  value="active">Yes</option>
                                <option  value="passive">No</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="menuTitle" class="col-md-3 col-form-label">REMOVE</label>
                        <div class="col-md-9">
                            <select required class="custom-select" name="isDelete">
                                <option selected  value="active">Yes</option>
                                <option  value="passive">No</option>
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
