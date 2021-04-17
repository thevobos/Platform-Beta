<div class="form-group row">
    <label for="<?php echo $data->name; ?>" class="col-md-3 col-form-label"><?php echo $data->title; ?> <?php echo $data->required === "active" ? "(Requirement active)" : null; ?></label>
    <div id="<?php echo $data->name; ?>" class="col-md-9">
        <select name="<?php echo $data->name; ?>" class="selectize"  <?php echo $data->required === "active" ? "required" : null; ?>  >
            <option value="">Make a selection.</option>

            <?php foreach (explode(",",$data->child) as $item): ?>
            <option value="<?php echo $item; ?>"><?php echo $item; ?></option>
            <?php endforeach; ?>


        </select>
    </div>
</div>
