<div class="form-group row">
    <label for="<?php echo $data->name; ?>" class="col-md-3 col-form-label"><?php echo $data->title; ?> <?php echo $data->required === "active" ? "(Requirement active)" : null; ?></label>
    <div class="col-md-9">
        <input value="<?php echo $data->content; ?>" class="tagsIn" type="text" placeholder="<?php echo $data->placeholder; ?>" name="<?php echo $data->name; ?>" id="<?php echo $data->name; ?>">
    </div>
</div>