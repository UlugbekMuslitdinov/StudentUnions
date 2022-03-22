<?php

namespace PHPMaker2021\project1;

// Page object
$RoomReservationRoomOptionsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var froom_reservation_room_optionsview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    froom_reservation_room_optionsview = currentForm = new ew.Form("froom_reservation_room_optionsview", "view");
    loadjs.done("froom_reservation_room_optionsview");
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
<form name="froom_reservation_room_optionsview" id="froom_reservation_room_optionsview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="room_reservation_room_options">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_room_options_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_room_reservation_room_options_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->room->Visible) { // room ?>
    <tr id="r_room">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_room_options_room"><?= $Page->room->caption() ?></span></td>
        <td data-name="room" <?= $Page->room->cellAttributes() ?>>
<span id="el_room_reservation_room_options_room">
<span<?= $Page->room->viewAttributes() ?>>
<?= $Page->room->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->floor->Visible) { // floor ?>
    <tr id="r_floor">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_room_options_floor"><?= $Page->floor->caption() ?></span></td>
        <td data-name="floor" <?= $Page->floor->cellAttributes() ?>>
<span id="el_room_reservation_room_options_floor">
<span<?= $Page->floor->viewAttributes() ?>>
<?= $Page->floor->getViewValue() ?></span>
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
