<?php
session_start();

require_once('TCommon.php');
if (isset($_GET['act'])) {
    switch ($_GET['act']) {
        case 'user_register':
            userRegister();
            break;
        case 'user_login':
            userLogin(); //TCommon::$TYPE_USER
            break;
        case 'out':
            logOut();
            break;

        case 'create_appointment':
            create_appointment();
            break;
        case 'list_appointments':
            list_appointments();
            break;
        case 'del_appointment':
            del_appointment();
            break;
        case 'edit_appointment':
            edit_appointment();
            break;

        case 'list_clients':
            list_clients();
            break;
        case 'create_client':
            create_client();
            break;
        case 'del_client':
            del_client();
            break;
        case 'edit_client':
            edit_client();
            break;

        case 'list_items':
            list_items();
            break;
        case 'create_item':
            create_item();
            break;
        case 'edit_item':
            edit_item();
            break;
        case 'del_item':
            del_item();
            break;

        case 'list_properties':
            list_properties();
            break;
        case 'create_property':
            create_property();
            break;
        case 'edit_property':
            edit_property();
            break;
        case 'del_property':
            del_property();
            break;

        case 'list_item_in_package':
            list_item_in_package();
            break;
        case 'add_item_to_package':
            add_item_to_package();
            break;
        case 'delete_item_from_package':
            delete_item_from_package();
            break;
        case 'edit_item_in_package':
            edit_item_in_package();
            break;

        default:
            break;
    }
}

//--registration--
function userRegister()
{
    $r["success"] = false;
    $name = $_POST["name"];
    $pwd = trim($_POST["pwd"]);
    $pwd1 = trim($_POST["pwd_a"]);
    $email = $_POST["email"];
    $tel = $_POST["tel"];

    if (!TCommon::isEmpty($name)
        && !TCommon::isEmpty($pwd)
    ) {
        if ($pwd1 !== $pwd) {
            $r["error"] = "password are not match";
        } else {
            //check user exist
            $sql = "select count(*) from " . TCommon::$userTbl . " where userName='$name'";
            if (0 == TCommon::getOneColumn($sql)) {
                $pwd_ = md5($pwd);
                $sqlInsert = "insert into " . TCommon::$userTbl . " (userName,userPass,userEmail,userPhone)
                values('$name','$pwd_','$email','$tel')";
                if (TCommon::execSql($sqlInsert)) {
                    $r['success'] = true;
                    $r['info'] = "$name register success";
                }
            } else {
                $r["error"] = "$name name taken";
            }
        }
    } else {
        $r["error"] = "cannot left empty";
    }
    echo json_encode($r);
}


function userLogin()
{
    $r["success"] = false;
    $name = $_POST["name"];
    $pwd = trim($_POST["pwd"]);
    if (!TCommon::isEmpty($name) && !TCommon::isEmpty($pwd)) {
        $pwd_ = md5($pwd);
        $tbl = TCommon::$userTbl;
        $sqlSearch = "SELECT userPass FROM user WHERE userName='$name'";
        if ($pwd_ === TCommon::getOneColumn($sqlSearch)) {
            //get UserID begin
            $sqlSearch = "SELECT * FROM user WHERE userName = '$name'";
            $user = TCommon::getOne($sqlSearch);
            TCommon::setSession('ID', $user["userId"]);
            //get userID end
            $r['success'] = true;
            $r['info'] = "$name login success";
            TCommon::setSession('NAME', $name);
        } else {
            $r["error"] = "Invalid password";
        }
    } else {
        $r["error"] = "exception";
    }
    echo json_encode($r);
}

function logOut()
{
    $url = "../index.php";
    unset($_SESSION["NAME"]);
    TCommon::headerTo($url);
}


function getLoginUserName()
{
    if (TCommon::sessionExisted("NAME")) {
        return $_SESSION["NAME"];
    } else {
        return FALSE;
    }
}

//--client--
function list_clients(){
    $query = "select * from client ORDER BY client.clientName";
    return TCommon::getAll($query);
}

function create_client(){
    $r["success"] = false;
    $clientName = $_POST["clientName"];
    $address1 = $_POST["clientAddress1"];
    $address2 = $_POST["clientAddress2"];
    $city = $_POST["clientCity"];
    $province = $_POST["clientProv"];
    $postal = $_POST["clientPostal"];
    $phone1 = $_POST["clientPhone1"];
    $phone2 = $_POST["clientPhone2"];
    $email = $_POST["clientEmail"];
    $details = $_POST["clientDetails"];

    if(TCommon::isEmpty($clientName) || TCommon::isEmpty($phone1)){
        $r["error"] = "client name and phone number 1 required";
    }
    else if(!preg_match("/\(? (\d{3})? \)? (?(1) [\-\s])\d{3}-\d{4}/x", $phone1)){
        $r["error"] = "phone number invalid";
    }
    else{
        $sql = "SELECT count(*) FROM client WHERE clientName ='$clientName'";
        if(0 == TCommon::getOneColumn($sql)){
            $sqlInsert = "INSERT INTO client (clientName,clientAddress1,clientAddress2,clientCity,clientProv,clientPostal,clientPhone1,clientPhone2,clientEmail,clientDetails)
                    VALUES ('$clientName','$address1','$address2','$city','$province','$postal','$phone1','$phone2','$email','$details')";
            if(TCommon::execSql($sqlInsert)){
                 $r['success'] = true;
                 $r['info'] = "$clientName create success";
            }
        }
        else{
            $r["error"] = "$clientName exist already";
        }
    }

    echo json_encode($r);
}

function edit_client(){
    $r["success"] = false;
    $id = $_POST["id"];

    $clientName = $_POST["clientName"];
    $address1 = $_POST["clientAddress1"];
    $address2 = $_POST["clientAddress2"];
    $city = $_POST["clientCity"];
    $province = $_POST["clientProv"];
    $postal = $_POST["clientPostal"];
    $phone1 = $_POST["clientPhone1"];
    $phone2 = $_POST["clientPhone2"];
    $email = $_POST["clientEmail"];
    $details = $_POST["clientDetails"];

    $sql = "UPDATE client SET clientName = '$clientName',
            clientAddress1 = '$address1',
            clientAddress2 = '$address2',
            clientCity = '$city',
            clientProv = '$province',
            clientPostal = '$postal',
            clientPhone1 = '$phone1',
            clientPhone2 = '$phone2',
            clientEmail = '$email',
            clientDetails = '$details'
            WHERE clientId = $id";

    TCommon::execSql($sql);
    $r['success'] = true;
    $r['info'] = "$clientName's info updated";

    echo json_encode($r);
}

function del_client(){
    $clientName = $_GET["clientName"];
    $sqlExec = "DELETE FROM client WHERE client.clientName = '$clientName'";

    print_r($sqlExec);
    if(TCommon::execSql($sqlExec)){

    }
    TCommon::headerTo("../list_client_page.php");
}

//--item--
function create_item(){
    $r["success"] = false;
    $itemName = $_POST["itemName"];
    $itemDescription = $_POST["itemDescription"];
    $itemStandard = $_POST["itemStandard"];
    $itemType = $_POST["itemType"];
    $itemManufacturer = $_POST["itemManufacturer"];

    if(TCommon::isEmpty($itemName)){
        $r["error"] = "item name required";
    }
    else{
        $sql = "SELECT count(*) FROM item WHERE itemName='$itemName'";
        if(0 == TCommon::getOneColumn($sql)){
            $sqlInsert = "INSERT INTO item (itemName, itemDescription, itemStandard, itemType_typeId, itemManufacturer_manuId)
                    VALUES ('$itemName', '$itemDescription', '$itemStandard', '$itemType', '$itemManufacturer')";
            if(TCommon::execSql($sqlInsert)){
                $r['success'] = true;
                $r['info'] = "$itemName created success";
            }
        }
        else{
            $r["error"] = "$itemName already exits";
        }

    }
    echo json_encode($r);
}

function edit_item(){
    $r["success"] = false;
    $id = $_POST["id"];
    $itemName = $_POST["itemName"];
    $itemDescription = $_POST["itemDescription"];
    $itemStandard = $_POST["itemStandard"];
    $itemType = $_POST["itemType"];
    $itemManufacturer = $_POST["itemManufacturer"];

    $sql = "UPDATE item SET itemName='$itemName',
            itemDescription='$itemDescription',
            itemStandard='$itemStandard',
            itemType_typeId='$itemType',
            itemManufacturer_manuId='$itemManufacturer'
            WHERE itemId='$id'";
    TCommon::execSql($sql);
    $r['success'] = true;
    $r['info'] = "$itemName edited success";

    echo json_encode($r);
}

function list_items(){
    $query = "SELECT item.*, itemtype.typeName, itemmanufacturer.manuName FROM item
        LEFT JOIN itemtype ON item.itemType_typeId=itemtype.typeId
        LEFT JOIN itemmanufacturer ON item.itemManufacturer_manuId=itemmanufacturer.manuId";
    return TCommon::getAll($query);
}

function del_item(){
    $itemId = $_GET["id"];
    $sqlExec = "DELETE FROM item WHERE item.itemId='$itemId'";
    print_r($sqlExec);
    if(TCommon::execSql($sqlExec)){
        $r['success'] = true;
        $r['info'] = "delete item successful";
    }
    TCommon::headerTo("../list_item_page.php");
}

//--appointment---------------------------------------------------------------------------------------------------------
function create_appointment(){
    $r["success"] = false;

    $uid = $_SESSION['ID'];
    $clientName = $_POST["clientName"];
    $apptDate = $_POST["apptDate"];

    $clientId = false;
    $sqlQuery = "SELECT * FROM client WHERE client.clientName='$clientName'";
    $client = TCommon::getOne($sqlQuery);

    if($client){
        $clientId = $client["clientId"];
    }

    if($clientId){
        $sqlInsert = "INSERT INTO appointment (apptDate,Client_clientId,User_userId) 
            VALUES('$apptDate','$clientId','$uid')";
        if(TCommon::execSql($sqlInsert)){
            $r['success'] = true;
            $r['info'] = "Appointment created success";
        }
    }else{
       $r['info'] = "cannot locate $clientName";
    }
    echo json_encode($r);
}

function list_appointments(){
    $uid = $_SESSION['ID'];
    $query = "SELECT  appointment.apptId, appointment.apptDate, client.clientName, client.clientPhone1, client.clientEmail FROM appointment
        JOIN client ON appointment.Client_clientId=client.clientId WHERE appointment.User_userId='$uid' ORDER BY appointment.apptDate";
    return TCommon::getAll($query);
}

function del_appointment(){
    $apptId = $_GET["id"];
    $sqlExec = "DELETE FROM appointment WHERE appointment.apptId='$apptId'";
    print_r($sqlExec);
    if(TCommon::execSql($sqlExec)){
        $r['success'] = true;
        $r['info'] = "delete appointment successful";
    }
    TCommon::headerTo("../index.php");
}

function edit_appointment(){
    $r["success"] = false;
    $id = $_POST["id"];
    $clientName = $_POST["clientName"];
    $apptDate = $_POST["apptDate"];

    $sqlQuery = "SELECT * FROM client WHERE client.clientName='$clientName'";
    $client = TCommon::getOne($sqlQuery);
    if($client){
        $clientId = $client["clientId"];
    }
    if($clientId){
        $sql = "UPDATE appointment SET apptDate='$apptDate', Client_clientId='$clientId' WHERE apptId='$id'";
        TCommon::execSql($sql);
        $r['success'] = true;
        $r['info'] = "Appointment updated successfully";
    }else{
        $r['info'] = "cannot locate client $clientName";
    }
    echo json_encode($r);

}


//--property------------------------------------------------------------------------------------------------------------
function create_property(){
    $r["success"] = false;

    $sub = $_POST["p_sub"];
    $block = $_POST["p_block"];
    $lot = $_POST["p_lotnum"];
    $size = $_POST["p_size"];
    $model = $_POST["p_model"];
    $date = $_POST["p_closingdate"];
    $status = $_POST["p_status"];
    $buyer = $_POST["p_buyer"];

    if(TCommon::isEmpty($lot) || TCommon::isEmpty($sub) || TCommon::isEmpty($block)){
        $r["error"] = "Lot#, sub, block required";
    }
    else{
        if($status != "available"){
            if(TCommon::isEmpty($buyer)){
                $r["error"] = "$status requires a buyer";
            }
            else{
                $sqlQuery = "SELECT * FROM client WHERE client.clientName='$buyer'";
                $client = TCommon::getOne($sqlQuery);
                if($client){
                    $clientId = $client["clientId"];
                    $sqlInsert = "INSERT INTO property (status, lotNum, lotSize, closingDate, lotModel, sub, block, clientId)
                            VALUES('$status','$lot','$size','$date','$model','$sub','$block',$clientId)";
                    if(TCommon::execSql($sqlInsert)){
                        $r["success"] = true;
                        $r['info'] = "success";
                    }
                }
                else{
                    $r["error"] = "Buyer not in file";
                }
            }
        }
        else{
            $sqlInsert = "INSERT INTO property (status, lotNum, lotSize, closingDate, lotModel, sub, block, clientId)
                            VALUES('$status','$lot','$size','$date','$model','$sub','$block', 'NULL')";
            if(TCommon::execSql($sqlInsert)){
                $r['success'] = true;
                $r['info'] = "success";
            }
        }
    }
    echo json_encode($r);
}

function edit_property(){

    $r["success"] = false;
    $id=$_POST["id"];

    $sub = $_POST["p_sub"];
    $block = $_POST["p_block"];
    $lot = $_POST["p_lotnum"];
    $size = $_POST["p_size"];
    $model = $_POST["p_model"];
    $date = $_POST["p_closingdate"];
    $status = $_POST["p_status"];
    $buyer = $_POST["p_buyer"];

    if(TCommon::isEmpty($lot) || TCommon::isEmpty($sub) || TCommon::isEmpty($block)){
        $r["error"] = "Lot#, sub, and block required";
    }
    else{
        if($status != "available"){
            if($status == "pack_selected"){
                $sqlSearch = "SELECT count(*) FROM package WHERE propertyId='$id'";
                if(0==TCommon::isEmpty($sqlSearch)){
                    $sqlPackage = "INSERT INTO package (propertyId) VALUES ('$id')";
                    TCommon::execSql($sqlPackage);
                }
            }
            if(TCommon::isEmpty($buyer)){
                $r["error"] = "$status requires a client";
            }else{
                $sqlQuery = "SELECT * FROM client WHERE client.clientName='$buyer'";
                $client = TCommon::getOne($sqlQuery);
                if($client){
                    $clientId = $client["clientId"];
                    $sqlUpdate = "UPDATE property SET sub = '$sub',
                            block = '$block',
                            lotNum = '$lot',
                            lotSize = '$size',
                            lotModel = '$model',
                            closingDate = '$date',
                            status = '$status',
                            clientId = '$clientId'
                            WHERE propertyId = $id";
                    if(TCommon::execSql($sqlUpdate)){
                        $r["success"] = true;
                        $r['info'] = "edit property successful";
                    }
                }
                else{
                    $r["error"] = "$buyer not found";
                }
            }
        }
        else{
            $sqlUpdate = "UPDATE property SET sub = '$sub',
                                        block = '$block',
                                        lotNum = '$lot',
                                        lotSize = '$size',
                                        lotModel = '$model',
                                        closingDate = '$date',
                                        status = '$status',
                                        clientId = 'NULL'
                                        WHERE propertyId = $id";

            if(TCommon::execSql($sqlUpdate)){
                $r['success'] = true;
                $r['info'] = "edit property successful";
            }
        }
    }
    echo json_encode($r);
}

function list_properties(){
    $query = "SELECT property.*, client.clientName FROM property LEFT JOIN client ON property.clientId=client.clientId
        ORDER BY cast(property.lotNum as INTEGER), property.block, property.sub";
    return TCommon::getAll($query);
}

function del_property(){
    $id = $_GET["id"];
    $sqlExec = "DELETE FROM property WHERE property.propertyId='$id'";
    print_r($sqlExec);
    if(TCommon::execSql($sqlExec)){
        $r['success'] = true;
        $r['info'] = "delete property success";
    }
    TCommon::headerTo("../list_property_page.php");
}


//--item_to_package-------------------------------------------------------------------------------------------------------------
function list_item_in_package(){
    $packId = $_SESSION["packId"];
    $query = "SELECT itemtopackage.* FROM itemtopackage WHERE itemtopackage.packageId='$packId'";
    return TCommon::getAll($query);
}

function add_item_to_package(){
    $r['success'] = false;
    $id = $_POST["id"];
    $location = $_POST["location"];
    $item = $_POST["item"];

    if(!TCommon::isEmpty($location)){
        $sqlInsert = "INSERT INTO itemtopackage (itemName,location,packageId) VALUES ('$item','$location','$id')";

        if(TCommon::execSql($sqlInsert)){
            $r['success'] = true;
            $r['info'] = "Item added";
        }
    }
    else{
        $r['error'] = "Location required";
    }
    echo json_encode($r);
}

function delete_item_from_package(){
    $id=$_GET["id"];
    $sqlExec = "DELETE FROM itemtopackage WHERE id='$id'";

    print_r($sqlExec);
    if(TCommon::execSql($sqlExec)){

    }
    TCommon::headerTo("../list_item_in_package_page.php");
}

function edit_item_in_package(){
    $r['success'] = false;
    $id = $_POST["id"];
    $location = $_POST["location"];
    $item = $_POST["item"];

    if(!TCommon::isEmpty($location)){
        $sqlUpdate = "UPDATE itemtopackage SET itemName = '$item', location = '$location' WHERE id = '$id'";

        if(TCommon::execSql($sqlUpdate)){
            $r['success'] = true;
            $r['info'] = "Success";
        }
    }else{
        $r['error'] = "Location required";
    }
    echo json_encode($r);
}



//--other---------------------------------------------------------------------------------------------------------------
function listTypes(){
    $sql = "SELECT * FROM itemType ORDER BY itemtype.typeName";
    return TCommon::getAll($sql);
}

function listManus(){
    $sql = "SELECT * FROM itemManufacturer ORDER BY itemmanufacturer.manuName";
    return TCommon::getAll($sql);
}

function listItems(){
    $sql = "SELECT * FROM item ORDER BY item.itemName";
    return TCommon::getAll($sql);
}