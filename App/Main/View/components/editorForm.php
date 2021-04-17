<div class="form-group row">
    <label for="<?php echo $data->name; ?>" class="col-md-3 col-form-label"><?php echo $data->title; ?> <?php echo $data->required === "active" ? "(Requirement active)" : null; ?></label>
    <div class="col-md-9">
        <textarea id="<?php echo $data->name; ?>" placeholder="<?php echo $data->placeholder; ?>" class="formEditor" name="<?php echo $data->name; ?>"></textarea>
    </div>
</div>