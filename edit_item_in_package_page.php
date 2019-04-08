<?php
$subTitle = "edit_item_in_package_page";
require_once('head.php');
//$packageId = $_GET["id"];
//$sqlPackage = "SELECT * FROM package";
//$package = TCommon::getOne($sqlPackage);
//$propertyId = $package['propertyId'];
//echo $propertyId;
//$sqlProperty = "SELECT * FROM property WHERE property.propertyId = $propertyId";
//$property = TCommon::getOne($sqlProperty);

$id = $_GET["id"];
$sql = "SELECT * FROM itemtopackage WHERE id = '$id'";
$t = TCommon::getOne($sql);
?>

<form class="form-ajax-post"
      data-action="./main/control.php?act=edit_item_in_package"
      data-url="list_item_in_package_page.php">
    <h3 class="title">Edit Package Item</h3>

    <div class="form-group">
        <label>Location</label>
        <input id="editPackageItem" type="text" name="location" value="<?php echo $t['location'] ?>" class="form-control" />
    </div>

    <div class="form-group">
        <label>Select Item</label>
        <select id="editPackageItemSelect" name="item" >
            <?php $types = listItems();foreach($types as $k=>$v){?>
                <option value = <?php echo $v["itemName"]?>><?php echo $v["itemName"]?></option>
            <?php }?>
        </select>
    </div>

    <div class="form-group tT010 ">
        <button class="form-ajax-btn" type="submit">Save</button>
    </div>
    <div>
</form>

<?php require_once('foot.php'); ?>