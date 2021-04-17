<?php



$export = "";

if($data->child === "A1"){
    $export = generateRandomStringFulll(4)."-".generateRandomStringFulll(6)."-".generateRandomStringFulll(4)."-".rand(11,99);
}

if($data->child === "A2"){
    $export = generateRandomStringString(4);
}
if($data->child === "A3"){
    $export = rand(1000000000,9999999999);
}

?>

<div class="form-group row">
    <label for="<?php echo $data->name; ?>" class="col-md-3 col-form-label"><?php echo $data->title; ?> <?php echo $data->required === "active" ? "(Requirement active)" : null; ?></label>
    <div class="col-md-9">
        <input readonly class="form-control" value="<?php echo $export; ?>"  <?php echo $data->required === "active" ? "required" : null; ?> placeholder="<?php echo $data->placeholder; ?>" type="text" name="<?php echo $data->name; ?>"  id="<?php echo $data->name; ?>">
    </div>
</div>
