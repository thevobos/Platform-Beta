<div class="form-group row">
    <label for="example-text-input" class="col-md-3 col-form-label"><?php echo $data->title; ?> <?php echo $data->required === "active" ? "(Requirement active)" : null; ?></label>
    <div class="col-md-9">
        <?php $getContent = explode(",",$data->content); ?>
        <?php foreach (explode(",",$data->child) as $item): ?>
            <?php $rnd = "ID".rand(1111,9999);  ?>
            <div class="form-check form-check-inline">
                <input <?php echo array_search($item,$getContent) !== false  ? "checked" : null; ?>  name="<?php echo $data->name; ?>[]" class="form-check-input"   value="<?php echo $item; ?>"  type="checkbox" id="<?php echo $rnd; ?>">
                <label class="form-check-label" for="<?php echo $rnd; ?>">
                    <?php echo $item; ?>
                </label>
            </div>
        <?php endforeach; ?>
    </div>
</div>

