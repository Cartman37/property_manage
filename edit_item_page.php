<?php
$subTitle = "edit_item_page";
require_once('head.php');
$id = $_GET["id"];
$sql = "SELECT * FROM item WHERE itemId = '$id'";
$item = TCommon::getOne($sql);
//print_r($item);
?>
<form class="form-ajax-post"
      data-action="./main/control.php?act=edit_item"
      data-url="list_item_page.php">
    <h3 class="title">Edit <?php echo $item['itemName'] ?></h3>
    <input type="hidden" value="<?php echo $id?>" name="id" />
    <div id="editItem" class="form-group">
        <label>Item name:</label>
        <input name="itemName" type="text" value="<?php echo $item['itemName']?>" class="form-control"/>
    </div>
    <div id="editItem" class="form-group">
        <label>Description:</label>
        <input name="itemDescription" type="text" value="<?php echo $item['itemDescription']?>" class="form-control"/>
    </div>
    <div id="editItem" class="form-group">
        <label>Standard:</label>
        <select name="itemStandard">
            <option value="1" <?php echo $item['itemStandard']=='1'?'selected':''?>>Standard</option>
            <option value="0" <?php echo $item['itemStandard']=='0'?'selected':''?>>Upgrade</option>
        </select>
    </div>

    <div id="editItem" class="form-group">
        <label>Type:</label>
        <select id="editItemType" name="itemType">
        <?php $types = listTypes();foreach($types as $k=>$v){?>
            <option value=<?php echo $v["typeId"]." ".$item['typeId']==$v['typeId']?'selected':''?>><?php echo $v["typeName"]?></option>
        <?php }?>
        </select>
    </div>

    <div id="editItem" class="form-group">
        <label>Manufacturer:</label>
        <select name="itemManufacturer"  value="<?php echo $item['itemManufacturer']?>">
        <?php $manus = listManus(); foreach($manus as $k=>$v) {?>
            <option value=<?php echo $v["manuId"]." ".$item["manuId"]==$v['typeId']?'selected':''?>><?php echo $v["manuName"]?></option>
        <?php }?>
        </select>
    </div>

    <div id="editItemButton" class="form-group tT010 ">
        <button class="form-ajax-btn" type="submit">Submit</button>
    </div>
</form>

<?php require_once('foot.php'); ?>