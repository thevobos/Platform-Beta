<div class="form-group row">
    <label for="<?php echo $data->name; ?>" class="col-md-3 col-form-label"><?php echo $data->title; ?> <?php echo $data->required === "active" ? "(Requirement active)" : null; ?></label>
    <div id="<?php echo $data->name; ?>" class="col-md-9">
        <select name="<?php echo $data->name; ?>" class="selectize"  <?php echo $data->required === "active" ? "required" : null; ?>  >
            <option value="">Make a selection.</option>

            <?php $getCrudInfoAtModuleCrud = explode("::",$data->child); ?>

            <?php foreach ($data->crudModel::getCrudComponents($data->siteCode,$getCrudInfoAtModuleCrud[0],$data->languageModel::$defaultLang) as $item): ?>

                <?php foreach (json_decode($item["content"]) as $itemEnd): ?>
                    <?php if($itemEnd->name === $getCrudInfoAtModuleCrud[1]): ?>
                        <option <?php echo ($item["uuid"] === $data->content ) ? "selected": null ?> value="<?php echo $item["uuid"]; ?>"><?php echo $itemEnd->content; ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>

        </select>
    </div>
</div>