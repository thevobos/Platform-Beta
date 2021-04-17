<?php $rnd = "iD".rand(1111,9999);  ?>
<div class="form-group row">
    <label for="example-text-input" class="col-md-3 col-form-label"><?php echo $data->title; ?> <?php echo $data->required === "active" ? "(Requirement active)" : null; ?></label>
    <div class="col-md-9">
        <div class="row">

            <div class="col-md-3">
                <a style="width: 100%" href="/3thparty/filemanager/dialog.php?type=2&field_id=<?php echo $rnd; ?>" class="btn btn-primary iframe-btn" type="button">File Manager</a>
            </div>
            <div class="col-md-12">
                <textarea  style="display: none; font-size: 11px;line-height: 24px; height: 37px;" readonly id="<?php echo $rnd; ?>"  name="<?php echo $data->name; ?>"  <?php echo $data->required === "active" ? "required" : null; ?>  class="form-control imgContentZone" type="text" placeholder="<?php echo $data->placeholder; ?>" ><?php echo $data->content; ?></textarea>

                <div class="imgViews <?php echo $rnd; ?>" >


                    <?php if(json_decode($data->content,true)): ?>

                        <?php foreach(json_decode($data->content) as $item): ?>

                            <div class="imgPreview" >
                                <img src="<?php echo $item; ?>" alt="">
                            </div>

                        <?php endforeach; ?>

                    <?php else: ?>
                        <div class="imgPreview" >
                            <img src="<?php echo $data->content; ?>" alt="">
                        </div>

                    <?php endif; ?>
                    
                </div>

            </div>
        </div>

    </div>
</div>

