<?php

namespace PHPMaker2021\project1;

// Page object
$RoomReservationRoomView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var froom_reservation_roomview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    froom_reservation_roomview = currentForm = new ew.Form("froom_reservation_roomview", "view");
    loadjs.done("froom_reservation_roomview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="froom_reservation_roomview" id="froom_reservation_roomview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="room_reservation_room">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_room_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_room_reservation_room_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->room_reservation_id->Visible) { // room_reservation_id ?>
    <tr id="r_room_reservation_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_room_room_reservation_id"><?= $Page->room_reservation_id->caption() ?></span></td>
        <td data-name="room_reservation_id" <?= $Page->room_reservation_id->cellAttributes() ?>>
<span id="el_room_reservation_room_room_reservation_id">
<span<?= $Page->room_reservation_id->viewAttributes() ?>>
<?= $Page->room_reservation_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->room_id->Visible) { // room_id ?>
    <tr id="r_room_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_room_room_id"><?= $Page->room_id->caption() ?></span></td>
        <td data-name="room_id" <?= $Page->room_id->cellAttributes() ?>>
<span id="el_room_reservation_room_room_id">
<span<?= $Page->room_id->viewAttributes() ?>>
<?= $Page->room_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
