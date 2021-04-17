<div class="form-group row">
    <label for="<?php echo $data->name; ?>" class="col-md-3 col-form-label"><?php echo $data->title; ?> <?php echo $data->required === "active" ? "(Requirement active)" : null; ?></label>
    <div class="col-md-9">
        <input type="text" class="form-control"  placeholder="<?php echo $data->placeholder; ?>" name="<?php echo $data->name; ?>"  id="<?php echo $data->name; ?>" data-role="tagsinput">
    </div>
</div>