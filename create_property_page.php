<?php
$subTitle = "create_property_page";
require_once('head.php');
?>

<form class="form-ajax-post"
      data-action="./main/control.php?act=create_property"
      data-url="list_property_page.php">
    <h3 class="title">Create New Property</h3>
    <div class="form-group">
        <label>Subdivision:</label>
        <select id="newPropertyStatus" name="p_sub">
            <option value="HWK">Huron Woods Kitchener</option>
            <option value="HRC">Highland Ridge Cambridge</option>
        </select>
    </div>
    <div id="newProperty" class="form-group">
        <label>Block:</label>
        <input name="p_block" type="text" class="form-control"/>
    </div>
    <div id="newProperty" class="form-group">
        <label>Lot #:</label>
        <input name="p_lotnum" type="text" class="form-control"/>
    </div>
    <div id="newProperty" class="form-group">
        <label>Size:</label>
        <input name="p_size" type="text" class="form-control"/>
    </div>
    <div id="newProperty" class="form-group">
        <label>Model</label>
        <select id="newPropertyStatus" name="p_model">
            <option value="Bridgeport">Bridgeport</option>
            <option value="Brookside">Brookside</option>
            <option value="Meadow">Meadow</option>
        </select>
    </div>
    <div id="newProperty" class="form-group">
        <label>Closing Date:</label>
        <input name="p_closingdate" type="Date" class="form-control"/>
    </div>
    <div id="newProperty" class="form-group">
        <label>Status</label>
        <select id="newPropertyStatus" name="p_status">
            <option value="available" selected>Available</option>
            <option value="on_hold">On Hold</option>
            <option value="cond_offer">Conditional Offer</option>
            <option value="firm_offer">Firm Offer</option>
            <option value="pack_unselected">Package Unselected</option>
            <option value="pack_selected" disabled>Package Selected</option>
        </select>
    </div>
    <div id="newProperty" class="form-group">
        <label>Client:</label>
        <input name="p_buyer" type="text" class="form-control"/>
    </div>

    <div id="newPropertyButton" class="form-group tT010 ">
        <button class="form-ajax-btn" type="submit">Add a Property</button>
    </div>
    <div>
</form>

<?php require_once('foot.php'); ?>