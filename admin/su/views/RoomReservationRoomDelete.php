<?php

namespace PHPMaker2021\project1;

// Page object
$RoomReservationRoomDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var froom_reservation_roomdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    froom_reservation_roomdelete = currentForm = new ew.Form("froom_reservation_roomdelete", "delete");
    loadjs.done("froom_reservation_roomdelete");
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
<form name="froom_reservation_roomdelete" id="froom_reservation_roomdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="room_reservation_room">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_room_reservation_room_id" class="room_reservation_room_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->room_reservation_id->Visible) { // room_reservation_id ?>
        <th class="<?= $Page->room_reservation_id->headerCellClass() ?>"><span id="elh_room_reservation_room_room_reservation_id" class="room_reservation_room_room_reservation_id"><?= $Page->room_reservation_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->room_id->Visible) { // room_id ?>
        <th class="<?= $Page->room_id->headerCellClass() ?>"><span id="elh_room_reservation_room_room_id" class="room_reservation_room_room_id"><?= $Page->room_id->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_room_reservation_room_id" class="room_reservation_room_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->room_reservation_id->Visible) { // room_reservation_id ?>
        <td <?= $Page->room_reservation_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_room_room_reservation_id" class="room_reservation_room_room_reservation_id">
<span<?= $Page->room_reservation_id->viewAttributes() ?>>
<?= $Page->room_reservation_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->room_id->Visible) { // room_id ?>
        <td <?= $Page->room_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_room_room_id" class="room_reservation_room_room_id">
<span<?= $Page->room_id->viewAttributes() ?>>
<?= $Page->room_id->getViewValue() ?></span>
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
