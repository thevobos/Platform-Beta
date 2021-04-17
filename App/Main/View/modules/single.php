<form action="" class="moduleSingleForm" onsubmit="return false;">

    <?php if( $page["modules"]["menuCategory"] !== "passive" ) : ?>
        <div class="form-group row">
            <label for="voboCategory" class="col-md-2 col-form-label">Menu</label>
            <div id="voboCategory" class="col-md-3">
                <select name="voboCategory" class="selectize" required  >
                    <option value="passive">No Choice</option>

                    <?php foreach ($page["menuModel"]::listCategory($_SESSION["cms_auth_site"]) as $itemCat): ?>

                        <optgroup label="<?php echo $itemCat["label"]; ?>">

                            <?php foreach ($page["menuModel"]::listMenuItems($_SESSION["cms_auth_site"],$itemCat["uuid"]) as $itemSub): ?>
                                <option value="<?php echo $itemSub["uuid"]; ?>"><?php echo $itemSub["label"]; ?></option>
                            <?php endforeach; ?>

                        </optgroup>
                    <?php endforeach; ?>

                </select>
            </div>
        </div>
    <?php else: ?>
        <input type="hidden" name="voboCategory" value="0">
    <?php endif; ?>


    <?php  foreach ( $page["components"]->crud as $item) $page["crudModel"]::formSingleComponent($item->component,$item);  ?>

    <input type="hidden" name="modules" value="<?php echo $page["modules"]["uuid"]; ?>">

    <div class="row">
        <div class="col-md-10"></div>
        <div class="col-md-2 text-center">
            <button type="submit" class="btn btn-primary col-md-12 waves-effect waves-light">Update</button>
        </div>
    </div>

</form>