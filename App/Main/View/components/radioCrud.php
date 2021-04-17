<div class="col-md-12 pulse animated" id="_INPUT_">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">
                SINGLE OPTION (RADIO)
                <button type="button" data-id="_INPUT_" class="btn btn-danger btn-sm waves-effect waves-light removeComponent">Remove</button>
            </h4>

            <div class="row">

                <div class="col-md-3">
                    <div class="mt-3 mr-sm-2">
                        <input required type="text" class="form-control mb-2" name="name[]"  placeholder="Input Key">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mt-3 mr-sm-2">
                        <input required type="text" class="form-control mb-2" name="title[]"  placeholder="Input Title">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mt-3 mr-sm-2">
                        <input type="text" required class="_INPUT_"  name="child[]"  placeholder="Input Childrens">
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="mt-3 mr-sm-2">
                        <select name="required[]" required="" class="custom-select" >
                            <option value="active">Requirement active</option>
                            <option selected="" value="passive">Requirement disabled</option>
                        </select>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="mt-3 mr-sm-2">
                        <select name="table[]" required="" class="custom-select" >
                            <option value="active">Table active</option>
                            <option selected="" value="passive">Table passive</option>
                        </select>
                    </div>
                </div>


                <input type="hidden" name="values[]" value="">
                <input type="hidden" name="placeholder[]" value="">
                <input type="hidden" name="component[]" value="RADIO">


            </div>

        </div>
    </div>
</div>