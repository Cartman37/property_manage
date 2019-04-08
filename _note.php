<?php
$subTitle = "c";
require_once('head.php');
$propertyId = $_GET["id"];
$sql = "SELECT property.*, client.clientName FROM property LEFT JOIN client ON property.clientId = client.clientId WHERE property.propertyId = '$propertyId'";
$property = TCommon::getOne($sql);
echo $propertyId;
?>