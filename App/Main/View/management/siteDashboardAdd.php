<script>
    let siteCode    = "<?php echo $define["code"]; ?>";
    let types       = "new";
</script>

<a href="/app/management/<?php echo $define["code"]; ?>">
    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light">Back to Site Management</button>
</a>


<form action="" method="post" onsubmit="return false;" class="submitCrud">

     <input type="hidden" name="site" value="<?php echo $define["code"]; ?>">



    <div class="row  " style="  margin-top: 30px; ">
        <div class="alert alert-info moduleEditorSettingPanel" style="display: none; width: 100%;" role="alert">
            PLEASE ADJUST IT CAREFULLY TO AVOID ERROR AFTER THE UPDATE.
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Module Title</label>
                <div class="col-md-8">
                    <input type="text"  class="form-control mt-3 mt-sm-0 mr-sm-3" name="crudTitle" id="comTitle" placeholder="Entry title...">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label">Slug Search</label>
                <div class="col-md-8">
                    <select class="custom-select crudSlugStatus" name="crudSlugStatus">
                        <option  value="active">Active</option>
                        <option selected  value="passive">Passive</option>
                    </select>
                </div>
            </div>

            <div class="form-group row slugComponent" style="display: none;"  >
                <label class="col-md-4 col-form-label">Slug Key</label>
                <div class="col-md-8">
                    <input type="text" class="form-control mt-3 mt-sm-0 mr-sm-3" id="crudSlugContent" name="crudSlugContent" placeholder="Input Key">
                </div>
            </div>
        </div>
        <div class="col-md-6">

            <div class="form-group row">
                <label class="col-md-4 col-form-label">Menu Selection</label>
                <div class="col-md-8">
                    <select class="custom-select" name="voboCategory">
                        <option value="active">Active</option>
                        <option value="passive" selected>Passive</option>
                    </select>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Operation Type</label>
                        <div class="col-md-8">
                            <select required class="custom-select crudCreate" name="crudCreate">
                                <option   value="multiple">Multiple Record</option>
                                <option selected value="single">Single Record</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Menu Sorting</label>
                        <div class="col-md-8">
                            <input type="number" value="99" class="form-control mt-3 mt-sm-0 mr-sm-3" name="listing" id="listing" placeholder="Row number 0 - N">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



    <div class="row "  >
        <div class="btn-group" role="group" style="width:100%; margin: 0 auto; margin-top: 20px;">
            <button type="button" class="btn btn-primary componentAdd" data-prefix="TEXT">TEXT</button>
            <button type="button" class="btn btn-primary componentAdd" data-prefix="TAGS">TAGS</button>
            <button type="button" class="btn btn-primary componentAdd" data-prefix="SELECT">OPTION (SELECT BOX)</button>
            <button type="button" class="btn btn-primary componentAdd" data-prefix="RADIO">OPTION (RADIO)</button>
            <button type="button" class="btn btn-primary componentAdd" data-prefix="NUMBER">NUMBER</button>
            <button type="button" class="btn btn-primary componentAdd" data-prefix="FILE">PHOTO</button>
            <button type="button" class="btn btn-primary componentAdd" data-prefix="EDITOR">TEXT EDITOR</button>
        </div>

        <div class="btn-group" role="group" style=" width: 100%; margin: 0 auto; margin-top: 20px;">
            <button type="button" class="btn btn-primary componentAdd" data-prefix="COLOR">COLOR</button>
            <button type="button" class="btn btn-primary componentAdd" data-prefix="CHECKBOX">OPTION MULTIPLE (CHECK BOX)</button>
            <button type="button" class="btn btn-primary componentAdd" data-prefix="TEXTAREA">TEXT (TEXTAREA)</button>
            <button type="button" class="btn btn-primary componentAdd" data-prefix="MASK">INPUT MASK (MASK)</button>
            <button type="button" class="btn btn-primary componentAdd" data-prefix="RANDOM">RANDOM</button>
            <button style="display: none;" type="button" class="btn btn-primary componentAdd componentsModuleExt" data-prefix="MODULE">COMPONENT</button>
            <button type="button" class="btn btn-primary componentAdd" data-prefix="DATE">DATE</button>
        </div>
    </div>

     <div class="row componentManager simpleList" style="margin-top:  30px;">

         <div class="col-md-12 warninShowing">

             <div class="row">
                 <div class="col-md-1"></div>
                 <div class="col-md-10">
                     <div class="alert alert-warning text-center" role="alert">
                         Make a component selection
                     </div>
                 </div>
             </div>
         </div>

     </div>

     <div style="text-align: center; width: 100%;">
         <button type="submit" class="btn btn-primary btn-rounded waves-effect waves-light">Save</button>
     </div>

</form>