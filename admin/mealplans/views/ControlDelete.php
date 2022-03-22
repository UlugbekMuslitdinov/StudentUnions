<?php

namespace PHPMaker2022\mealplans;

// Page object
$ControlDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { control: currentTable } });
var currentForm, currentPageID;
var fcontroldelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcontroldelete = new ew.Form("fcontroldelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fcontroldelete;
    loadjs.done("fcontroldelete");
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
<form name="fcontroldelete" id="fcontroldelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="control">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table table-bordered table-hover table-sm ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->ID->Visible) { // ID ?>
        <th class="<?= $Page->ID->headerCellClass() ?>"><span id="elh_control_ID" class="control_ID"><?= $Page->ID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->online->Visible) { // online ?>
        <th class="<?= $Page->online->headerCellClass() ?>"><span id="elh_control_online" class="control_online"><?= $Page->online->caption() ?></span></th>
<?php } ?>
<?php if ($Page->signup_bursars->Visible) { // signup_bursars ?>
        <th class="<?= $Page->signup_bursars->headerCellClass() ?>"><span id="elh_control_signup_bursars" class="control_signup_bursars"><?= $Page->signup_bursars->caption() ?></span></th>
<?php } ?>
<?php if ($Page->signup_cc->Visible) { // signup_cc ?>
        <th class="<?= $Page->signup_cc->headerCellClass() ?>"><span id="elh_control_signup_cc" class="control_signup_cc"><?= $Page->signup_cc->caption() ?></span></th>
<?php } ?>
<?php if ($Page->deposit_bursars->Visible) { // deposit_bursars ?>
        <th class="<?= $Page->deposit_bursars->headerCellClass() ?>"><span id="elh_control_deposit_bursars" class="control_deposit_bursars"><?= $Page->deposit_bursars->caption() ?></span></th>
<?php } ?>
<?php if ($Page->deposit_cc->Visible) { // deposit_cc ?>
        <th class="<?= $Page->deposit_cc->headerCellClass() ?>"><span id="elh_control_deposit_cc" class="control_deposit_cc"><?= $Page->deposit_cc->caption() ?></span></th>
<?php } ?>
<?php if ($Page->exporter->Visible) { // exporter ?>
        <th class="<?= $Page->exporter->headerCellClass() ?>"><span id="elh_control_exporter" class="control_exporter"><?= $Page->exporter->caption() ?></span></th>
<?php } ?>
<?php if ($Page->signup->Visible) { // signup ?>
        <th class="<?= $Page->signup->headerCellClass() ?>"><span id="elh_control_signup" class="control_signup"><?= $Page->signup->caption() ?></span></th>
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
<?php if ($Page->ID->Visible) { // ID ?>
        <td<?= $Page->ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_control_ID" class="el_control_ID">
<span<?= $Page->ID->viewAttributes() ?>>
<?= $Page->ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->online->Visible) { // online ?>
        <td<?= $Page->online->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_control_online" class="el_control_online">
<span<?= $Page->online->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_online_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->online->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->online->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_online_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
<?php } ?>
<?php if ($Page->signup_bursars->Visible) { // signup_bursars ?>
        <td<?= $Page->signup_bursars->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_control_signup_bursars" class="el_control_signup_bursars">
<span<?= $Page->signup_bursars->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_signup_bursars_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->signup_bursars->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->signup_bursars->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_signup_bursars_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
<?php } ?>
<?php if ($Page->signup_cc->Visible) { // signup_cc ?>
        <td<?= $Page->signup_cc->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_control_signup_cc" class="el_control_signup_cc">
<span<?= $Page->signup_cc->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_signup_cc_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->signup_cc->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->signup_cc->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_signup_cc_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
<?php } ?>
<?php if ($Page->deposit_bursars->Visible) { // deposit_bursars ?>
        <td<?= $Page->deposit_bursars->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_control_deposit_bursars" class="el_control_deposit_bursars">
<span<?= $Page->deposit_bursars->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_deposit_bursars_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->deposit_bursars->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->deposit_bursars->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_deposit_bursars_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
<?php } ?>
<?php if ($Page->deposit_cc->Visible) { // deposit_cc ?>
        <td<?= $Page->deposit_cc->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_control_deposit_cc" class="el_control_deposit_cc">
<span<?= $Page->deposit_cc->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_deposit_cc_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->deposit_cc->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->deposit_cc->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_deposit_cc_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
<?php } ?>
<?php if ($Page->exporter->Visible) { // exporter ?>
        <td<?= $Page->exporter->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_control_exporter" class="el_control_exporter">
<span<?= $Page->exporter->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_exporter_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->exporter->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->exporter->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_exporter_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
<?php } ?>
<?php if ($Page->signup->Visible) { // signup ?>
        <td<?= $Page->signup->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_control_signup" class="el_control_signup">
<span<?= $Page->signup->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_signup_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->signup->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->signup->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_signup_<?= $Page->RowCount ?>"></label>
</div></span>
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
