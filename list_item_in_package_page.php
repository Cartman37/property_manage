<?php
$subTitle = "list_item_in_package";
require_once('head.php');
if(isset($_GET['id'])){
    $propertyId = $_GET["id"];
    $_SESSION['propId'] = $propertyId;
}else{
    $propertyId = $_SESSION['propId'];
}
$sqlProperty = "SELECT property.*, client.clientName FROM property LEFT JOIN client ON property.clientId = client.clientId WHERE property.propertyId = '$propertyId'";
$property = TCommon::getOne($sqlProperty);

$sqlPackage = "SELECT package.* FROM package WHERE package.propertyId = '$propertyId'";
$package = TCommon::getOne($sqlPackage);
$packageId = $package['packageId'];
$_SESSION["packId"] = $packageId;
?>
<h1 class="title">Package for <?php echo $property["sub"]." ".$property['block']."-".$property['lotNum'] ?></h1>
<form class="form-ajax-post"
      data-action="./main/control.php?act=add_item_to_package"
      data-url="list_item_in_package_page.php">
    <h3 class="title">Add New Item</h3><br>
    <input style="display:none" value="<?php echo $packageId?>" name="id"/>
    <div id="listItemPackage" class="form-group">
        <label>Location</label>
        <input type="text" name="location" class="form-control" />
    </div>

    <div class="form-group">
        <label>Select Item</label>
        <select id="listItemPackageSelect" name="item" >
            <?php $types = listItems();foreach($types as $k=>$v){?>
                <option value="<?php echo $v["itemName"]?>"><?php echo $v["itemName"]?></option>
            <?php }?>
        </select>
    </div>

    <div id="listItemPackageButton" class="form-group tT010 ">
        <button class="form-ajax-btn" type="submit">Add to Package</button>
    </div>
    <div>
</form>
<h3 class="title">Items in Package</h3><br>
<table class="table">
    <thead>
    <tr>
        <td>Location</td>
        <td>Item Type</td>
        <td>Item Manufacturer</td>
        <td>Item Name</td>
        <td>Edit</td>
        <td>Delete</td>
    </tr>
    </thead>
    <tbody>
        <?php $arr = list_item_in_package(); foreach($arr as $k => $v){ ?>
            <tr>
                <td><?php echo $v["location"] ;?></td>
                <td><?php echo $v["typeName"] ;?></td>
                <td><?php echo $v["manuName"] ;?></td>
                <td><?php echo $v["itemName"] ;?></td>
                <td><a href="./edit_item_in_package_page.php?id=<?php echo $v["id"]?>">Edit</a></td>
                <td><a href="./main/control.php?act=delete_item_from_package&id=<?php echo $v["id"]?>">Delete</a></td>
            </tr>
        <?php  } ?>
    </tbody>
</table>


<?php require_once('foot.php'); ?>