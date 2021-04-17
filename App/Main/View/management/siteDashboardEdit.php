<script>
    let setDefaultConfigInModuleSystem = JSON.parse(JSON.stringify(<?php echo $define["details"]["components"]; ?>));
    let siteCode = "<?php echo $define["details"]["siteCode"]; ?>";
    let types       = "edit";
</script>

<a href="/app/management/<?php echo $define["code"]; ?>">
    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light">Back to Site Management</button>
</a>

<form action="" method="post" onsubmit="return false;" class="submitCrudEdit">

     <input type="hidden" name="crudSite" value="<?php echo $define["code"]; ?>">
     <input type="hidden" name="crudModule" value="<?php echo $define["details"]["uuid"]; ?>">


     <div class="row moduleEditorSettingPanel " style=" display: none; margin-top: 10px; ">
         <div class="alert alert-info moduleEditorSettingPanel" style="display: none; width: 100%;" role="alert">
             PLEASE ADJUST IT CAREFULLY TO AVOID ERROR AFTER THE UPDATE.
         </div>
         <div class="col-md-6">
             <div class="form-group row">
                 <label class="col-md-4 col-form-label">Title</label>
                 <div class="col-md-8">
                     <input type="text" value="<?php echo $define["details"]["label"]; ?>" class="form-control mt-3 mt-sm-0 mr-sm-3" name="crudTitle" id="comTitle" placeholder="Enter title...">
                 </div>
             </div>

             <div class="form-group row">
                 <label class="col-md-4 col-form-label">Url Slug</label>
                 <div class="col-md-8">
                     <select class="custom-select crudSlugStatus" name="crudSlugStatus">
                         <option <?php echo $define["details"]["slug"] === "active" ? "selected" : null ; ?> value="active">Active</option>
                         <option <?php echo $define["details"]["slug"] === "passive" ? "selected" : null ; ?>  value="passive">Passive</option>
                     </select>
                 </div>
             </div>

             <div class="form-group row slugComponent" <?php echo $define["details"]["slug"] === "passive" ? 'style="display: none;"' : null ; ?> >
                 <label class="col-md-4 col-form-label">Slug Module Key</label>
                 <div class="col-md-8">
                     <input type="text" value="<?php echo $define["details"]["slugComponent"]; ?>" class="form-control mt-3 mt-sm-0 mr-sm-3" id="crudSlugContent" name="crudSlugContent" placeholder="Component Key">
                 </div>
             </div>
         </div>
         <div class="col-md-6">

             <div class="form-group row">
                 <label class="col-md-4 col-form-label">Menu Selection</label>
                 <div class="col-md-8">
                     <select class="custom-select" name="voboCategory">
                         <option  <?php echo $define["details"]["menuCategory"] === "active" ? "selected" : null ; ?> value="active">Active</option>
                         <option value="passive" <?php echo $define["details"]["menuCategory"] === "passive" ? "selected" : null ; ?>>Passive</option>
                     </select>
                 </div>
             </div>


             <div class="row">
                 <div class="col-md-12">
                     <div class="form-group row">
                         <label class="col-md-4 col-form-label">Operation Type</label>
                         <div class="col-md-8">
                             <select required class="custom-select crudCreate" name="crudCreate">
                                 <option <?php echo $define["details"]["operation"] === "multiple" ? "selected" : null ; ?>   value="multiple">Multiple Record</option>
                                 <option  <?php echo $define["details"]["operation"] === "single" ? "selected" : null ; ?>  value="single">Single Record</option>
                             </select>
                         </div>
                     </div>
                 </div>
                 <div class="col-md-12">
                     <div class="form-group row">
                         <label class="col-md-4 col-form-label">Menu Row Number</label>
                         <div class="col-md-8">
                             <input type="number" value="<?php echo $define["details"]["listing"]; ?>" class="form-control mt-3 mt-sm-0 mr-sm-3" name="listing" id="listing" placeholder="Row number 0 - N">
                         </div>
                     </div>
                 </div>
             </div>

         </div>
     </div>


     <div class="row moduleEditorSettingPanel"  style="display: none;">
         <div class="btn-group" role="group" style="width:100%; margin: 0 auto; margin-top: 20px;">
             <button type="button" class="btn btn-primary componentAdd" data-prefix="TEXT">TEXT</button>
             <button type="button" class="btn btn-primary componentAdd" data-prefix="TAGS">TAGS</button>
             <button type="button" class="btn btn-primary componentAdd" data-prefix="SELECT">OPTION (SELECT BOX)</button>
             <button type="button" class="btn btn-primary componentAdd" data-prefix="RADIO">OPTION (RADIO)</button>
             <button type="button" class="btn btn-primary componentAdd" data-prefix="NUMBER">NUMBER</button>
             <button type="button" class="btn btn-primary componentAdd" data-prefix="FILE">PHOTO</button>
             <button type="button" class="btn btn-primary componentAdd" data-prefix="EDITOR">TEXT EDITOR</button>
         </div>
         <div class="btn-group" role="group" style="width:100%; margin: 0 auto; margin-top: 20px;">
             <button type="button" class="btn btn-primary componentAdd" data-prefix="COLOR">COLOR</button>
             <button type="button" class="btn btn-primary componentAdd" data-prefix="CHECKBOX">OPTION MULTIPLE (CHECK BOX)</button>
             <button type="button" class="btn btn-primary componentAdd" data-prefix="TEXTAREA">TEXT (TEXTAREA)</button>
             <button type="button" class="btn btn-primary componentAdd" data-prefix="MASK">INPUT MASK (MASK)</button>
             <button type="button" class="btn btn-primary componentAdd" data-prefix="RANDOM">RANDOM</button>
             <button <?php echo $define["details"]["operation"] === "multiple" ? null : 'style="display: none;"' ; ?>   type="button" class="btn btn-primary componentAdd componentsModuleExt" data-prefix="MODULE">COMPONENT</button>
             <button type="button" class="btn btn-primary componentAdd" data-prefix="DATE">DATE</button>
         </div>
     </div>

     <div class="row componentManager " id="simpleList" style="margin-top:  30px;">

         <div class="col-md-12 warninShowing ">

             <div class="row">
                 <div class="col-md-1"></div>
                 <div class="col-md-10">
                     <div class="alert alert-info text-center" role="alert">
                         PLEASE WAIT
                     </div>
                 </div>
             </div>

         </div>

     </div>

     <div style="display: none; text-align: center; width: 100%;" class="moduleEditorSettingPanel">
         <button type="submit" class="btn btn-primary btn-rounded waves-effect waves-light">Update</button>
     </div>

</form>