<?php
$subTitle = "list_item_in_package";
require_once('head.php');
$propertyId = $_GET["id"];
$sqlProperty = "SELECT property.*, client.clientName FROM property LEFT JOIN client ON property.clientId = client.clientId WHERE property.propertyId = '$propertyId'";
$property = TCommon::getOne($sqlProperty);
//echo $propertyId;

$sqlPackage = "SELECT package.* FROM package WHERE package.propertyId = '$propertyId'";
$package = TCommon::getOne($sqlPackage);
$packageId = $package['packageId'];
//echo $packageId;
?>
<h1 class="title">Package for Lot# <?php echo $property['lotNum'] ?></h1>
<form class="form-ajax-post"
      data-action="./main/control.php?act=add_item_to_package"
      data-url="list_item_in_package_page.php">
    <h3 class="title">Add New Item</h3>
    <input style="display:none" value="<?php echo $packageId?>" name="id"/>
    <div class="form-group">
        <label>Location</label>
        <input type="text" name="location" class="form-control" />
    </div>

    <div class="form-group">
        <label>Select Item</label>
        <select name="item" >
            <?php $types = listItems();foreach($types as $k=>$v){?>
                <option value = <?php echo $v["itemName"]?>><?php echo $v["itemName"]?></option>
            <?php }?>
        </select>
    </div>

    <div class="form-group tT010 ">
        <button class="form-ajax-btn" type="submit">Add to Package</button>
    </div>
    <div>
</form>


<hr>
<h3 class="title">List Items in Package</h3>
<input style="display:none" value="<?php echo $packageId?>" name="id" />
<?php $arr = list_item_in_package(); ?>
<table class="table" border="2" cellpadding="5" cellspacing="3">
    <thead>
    <tr>
        <td>Location</td>
        <td>Item Name</td>
        <td>Edit</td>
        <td>Delete</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach($arr as $k => $v){ ?>
        <tr>
            <td><?php echo $v["location"] ;?></td>
            <td><?php echo $v["itemName"] ;?></td>
            <td><a href="./edit_item_in_package_page.php?id=<?php echo $v["id"]?>">Edit</a></td>
            <td><a href="./main/control.php?act=delete_item_from_package&id=<?php echo $v["id"]?>">Delete</a></td>
        </tr>
    <?php  } ?>
    </tbody>
    <tr>
        <td colspan="11" align="right"><a href="./add_item_to_package_page.php?id=<?php echo $packageId?>">Add More Item</a></td>
    </tr>

</table>


<?php require_once('foot.php'); ?>