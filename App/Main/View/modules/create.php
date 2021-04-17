<?php

function generateRandomStringFulll($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function generateRandomStringString($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>

<form action="" class="moduleRecordForm" onsubmit="return false;">

    <?php if( $page["modules"]["menuCategory"] !== "passive" ) : ?>
    <div class="form-group row">
        <label for="voboCategory" class="col-md-3 col-form-label">Menu</label>
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
        <input type="hidden" name="voboCategory" value="passive">
    <?php endif; ?>

    <?php  foreach ( $page["components"]->crud as $item)
        $page["crudModel"]::formComponent($item->component, (object) array_merge( (array) $item,[
            "languageModel" => $data["define"]["languageModel"],
            "crudModel"     => $data["define"]["crudModel"],
            "moduleModel"   => $data["define"]["moduleModel"],
            "siteCode"      => $_SESSION["cms_auth_site"],
            "uuid"          => $page["modules"]["uuid"]
        ]));  ?>

    <input type="hidden" name="modules" value="<?php echo $page["modules"]["uuid"]; ?>">
    <input type="hidden" name="operation" value="multiple">

   <div class="row">
       <div class="col-md-10"></div>
       <div class="col-md-2 text-center">
           <button type="submit" class="btn btn-primary col-md-12 waves-effect waves-light">Save</button>
       </div>
   </div>

</form>