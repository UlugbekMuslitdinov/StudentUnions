<?php

namespace PHPMaker2021\project1;

// Page object
$RoomReservationRoomOptionsDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var froom_reservation_room_optionsdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    froom_reservation_room_optionsdelete = currentForm = new ew.Form("froom_reservation_room_optionsdelete", "delete");
    loadjs.done("froom_reservation_room_optionsdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="froom_reservation_room_optionsdelete" id="froom_reservation_room_optionsdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="room_reservation_room_options">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->id->Visible) { // id ?>
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_room_reservation_room_options_id" class="room_reservation_room_options_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->room->Visible) { // room ?>
        <th class="<?= $Page->room->headerCellClass() ?>"><span id="elh_room_reservation_room_options_room" class="room_reservation_room_options_room"><?= $Page->room->caption() ?></span></th>
<?php } ?>
<?php if ($Page->floor->Visible) { // floor ?>
        <th class="<?= $Page->floor->headerCellClass() ?>"><span id="elh_room_reservation_room_options_floor" class="room_reservation_room_options_floor"><?= $Page->floor->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->id->Visible) { // id ?>
        <td <?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_room_options_id" class="room_reservation_room_options_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->room->Visible) { // room ?>
        <td <?= $Page->room->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_room_options_room" class="room_reservation_room_options_room">
<span<?= $Page->room->viewAttributes() ?>>
<?= $Page->room->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->floor->Visible) { // floor ?>
        <td <?= $Page->floor->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_room_options_floor" class="room_reservation_room_options_floor">
<span<?= $Page->floor->viewAttributes() ?>>
<?= $Page->floor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
