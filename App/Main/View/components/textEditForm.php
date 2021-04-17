<div class="form-group row">
    <label for="<?php echo $data->name; ?>" class="col-md-3 col-form-label"><?php echo $data->title; ?> <?php echo $data->required === "active" ? "(Requirement active)" : null; ?></label>
    <div class="col-md-9">
        <input class="form-control" value="<?php echo $data->content; ?>"  <?php echo $data->required === "active" ? "required" : null; ?> placeholder="<?php echo $data->placeholder; ?>" type="text" name="<?php echo $data->name; ?>"  id="<?php echo $data->name; ?>">
    </div>
</div>
