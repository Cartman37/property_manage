<?php
$subTitle = "list_property_page";
require_once('head.php');
// print_r($_SESSION);
?>
<?php if($u_name) {?>
<h3 class="title">List of Properties</h3><br>
<?php $arr = list_properties(); ?>
<table class="table">
    <thead>
    <tr>
        <td>Subdiv</td>
        <td>Block</td>
        <td>Lot #</td>
        <td>Lot Size</td>
        <td>Lot Model</td>
        <td>Closing Date</td>
        <td>Status</td>
        <td>Client</td>
        <td>Package</td>
        <td></td>
        <td></td>
    </tr>
    </thead>
    <tbody>
    <?php foreach($arr as $k => $v){ ?>
        <tr>
            <td><?php echo $v["sub"] ;?></td>
            <td><?php echo $v["block"] ;?></td>
            <td><?php echo $v["lotNum"] ;?></td>
            <td><?php echo $v["lotSize"] ;?></td>
            <td><?php echo $v["lotModel"] ;?></td>
            <td><?php echo $v["closingDate"] ;?></td>
            <td><?php echo $v["status"] ;?></td>
            <td><?php echo $v["clientName"] ;?></td>
            <td>
            <?php
                if($v["status"]=="pack_selected"){
                    ?><a href="./list_item_in_package_page.php?id=<?php echo $v['propertyId']?>"><?php echo "View Package" ?></a><?php ;
                }
                else{
                    echo "";
                }
                ?>
            </td>
            <td><a href="./edit_property_page.php?id=<?php echo $v['propertyId']?>">Edit</a></td>
            <td><a href="./main/control.php?act=del_property&lotNum=<?php echo $v["lotNum"]?>">Delete</a></td>
        </tr>
    <?php  } ?>
    </tbody>
    <tr>
        <td colspan="11" align="right"><a href="create_property_page.php">Create New Property</a></td>
    </tr>

</table>
<?php }else{?>
<h3 class="title">Please login/register first</h3>
<?php }?>

<?php require_once('foot.php'); ?>