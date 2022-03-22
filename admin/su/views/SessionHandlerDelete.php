<?php

namespace PHPMaker2021\project1;

// Page object
$SessionHandlerDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fsession_handlerdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fsession_handlerdelete = currentForm = new ew.Form("fsession_handlerdelete", "delete");
    loadjs.done("fsession_handlerdelete");
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
<form name="fsession_handlerdelete" id="fsession_handlerdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="session_handler">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_session_handler_id" class="session_handler_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->custnum->Visible) { // custnum ?>
        <th class="<?= $Page->custnum->headerCellClass() ?>"><span id="elh_session_handler_custnum" class="session_handler_custnum"><?= $Page->custnum->caption() ?></span></th>
<?php } ?>
<?php if ($Page->cust_id->Visible) { // cust_id ?>
        <th class="<?= $Page->cust_id->headerCellClass() ?>"><span id="elh_session_handler_cust_id" class="session_handler_cust_id"><?= $Page->cust_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->netid->Visible) { // netid ?>
        <th class="<?= $Page->netid->headerCellClass() ?>"><span id="elh_session_handler_netid" class="session_handler_netid"><?= $Page->netid->caption() ?></span></th>
<?php } ?>
<?php if ($Page->firstname->Visible) { // firstname ?>
        <th class="<?= $Page->firstname->headerCellClass() ?>"><span id="elh_session_handler_firstname" class="session_handler_firstname"><?= $Page->firstname->caption() ?></span></th>
<?php } ?>
<?php if ($Page->lastname->Visible) { // lastname ?>
        <th class="<?= $Page->lastname->headerCellClass() ?>"><span id="elh_session_handler_lastname" class="session_handler_lastname"><?= $Page->lastname->caption() ?></span></th>
<?php } ?>
<?php if ($Page->mp_state->Visible) { // mp_state ?>
        <th class="<?= $Page->mp_state->headerCellClass() ?>"><span id="elh_session_handler_mp_state" class="session_handler_mp_state"><?= $Page->mp_state->caption() ?></span></th>
<?php } ?>
<?php if ($Page->deposit_to->Visible) { // deposit_to ?>
        <th class="<?= $Page->deposit_to->headerCellClass() ?>"><span id="elh_session_handler_deposit_to" class="session_handler_deposit_to"><?= $Page->deposit_to->caption() ?></span></th>
<?php } ?>
<?php if ($Page->iso->Visible) { // iso ?>
        <th class="<?= $Page->iso->headerCellClass() ?>"><span id="elh_session_handler_iso" class="session_handler_iso"><?= $Page->iso->caption() ?></span></th>
<?php } ?>
<?php if ($Page->activestudent->Visible) { // activestudent ?>
        <th class="<?= $Page->activestudent->headerCellClass() ?>"><span id="elh_session_handler_activestudent" class="session_handler_activestudent"><?= $Page->activestudent->caption() ?></span></th>
<?php } ?>
<?php if ($Page->activeemployee->Visible) { // activeemployee ?>
        <th class="<?= $Page->activeemployee->headerCellClass() ?>"><span id="elh_session_handler_activeemployee" class="session_handler_activeemployee"><?= $Page->activeemployee->caption() ?></span></th>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <th class="<?= $Page->timestamp->headerCellClass() ?>"><span id="elh_session_handler_timestamp" class="session_handler_timestamp"><?= $Page->timestamp->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_session_handler_id" class="session_handler_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->custnum->Visible) { // custnum ?>
        <td <?= $Page->custnum->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_session_handler_custnum" class="session_handler_custnum">
<span<?= $Page->custnum->viewAttributes() ?>>
<?= $Page->custnum->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->cust_id->Visible) { // cust_id ?>
        <td <?= $Page->cust_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_session_handler_cust_id" class="session_handler_cust_id">
<span<?= $Page->cust_id->viewAttributes() ?>>
<?= $Page->cust_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->netid->Visible) { // netid ?>
        <td <?= $Page->netid->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_session_handler_netid" class="session_handler_netid">
<span<?= $Page->netid->viewAttributes() ?>>
<?= $Page->netid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->firstname->Visible) { // firstname ?>
        <td <?= $Page->firstname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_session_handler_firstname" class="session_handler_firstname">
<span<?= $Page->firstname->viewAttributes() ?>>
<?= $Page->firstname->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->lastname->Visible) { // lastname ?>
        <td <?= $Page->lastname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_session_handler_lastname" class="session_handler_lastname">
<span<?= $Page->lastname->viewAttributes() ?>>
<?= $Page->lastname->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->mp_state->Visible) { // mp_state ?>
        <td <?= $Page->mp_state->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_session_handler_mp_state" class="session_handler_mp_state">
<span<?= $Page->mp_state->viewAttributes() ?>>
<?= $Page->mp_state->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->deposit_to->Visible) { // deposit_to ?>
        <td <?= $Page->deposit_to->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_session_handler_deposit_to" class="session_handler_deposit_to">
<span<?= $Page->deposit_to->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_deposit_to_<?= $Page->RowCount ?>" class="custom-control-input" value="<?= $Page->deposit_to->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->deposit_to->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_deposit_to_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
<?php } ?>
<?php if ($Page->iso->Visible) { // iso ?>
        <td <?= $Page->iso->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_session_handler_iso" class="session_handler_iso">
<span<?= $Page->iso->viewAttributes() ?>>
<?= $Page->iso->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->activestudent->Visible) { // activestudent ?>
        <td <?= $Page->activestudent->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_session_handler_activestudent" class="session_handler_activestudent">
<span<?= $Page->activestudent->viewAttributes() ?>>
<?= $Page->activestudent->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->activeemployee->Visible) { // activeemployee ?>
        <td <?= $Page->activeemployee->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_session_handler_activeemployee" class="session_handler_activeemployee">
<span<?= $Page->activeemployee->viewAttributes() ?>>
<?= $Page->activeemployee->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <td <?= $Page->timestamp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_session_handler_timestamp" class="session_handler_timestamp">
<span<?= $Page->timestamp->viewAttributes() ?>>
<?= $Page->timestamp->getViewValue() ?></span>
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
