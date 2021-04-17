<?php $rnd = "ID".rand(1111,9999);  ?>
<div class="form-group row">
    <label for="<?php echo $rnd; ?>" class="col-md-3 col-form-label"><?php echo $data->title; ?> <?php echo $data->required === "active" ? "(Requirement active)" : null; ?></label>
    <div class="col-md-9">
        <input value="<?php echo $data->content; ?>" <?php echo $data->required === "active" ? "required" : null; ?>  class="form-control" type="number" name="<?php echo $data->name; ?>" placeholder="<?php echo $data->placeholder; ?>" id="<?php echo $rnd; ?>">
    </div>
</div>