<?php

namespace PHPMaker2022\project2;

// Page object
$LocationDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { location: currentTable } });
var currentForm, currentPageID;
var flocationdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    flocationdelete = new ew.Form("flocationdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = flocationdelete;
    loadjs.done("flocationdelete");
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
<form name="flocationdelete" id="flocationdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="location">
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
<?php if ($Page->location_id->Visible) { // location_id ?>
        <th class="<?= $Page->location_id->headerCellClass() ?>"><span id="elh_location_location_id" class="location_location_id"><?= $Page->location_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->group_id->Visible) { // group_id ?>
        <th class="<?= $Page->group_id->headerCellClass() ?>"><span id="elh_location_group_id" class="location_group_id"><?= $Page->group_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->group_hours->Visible) { // group_hours ?>
        <th class="<?= $Page->group_hours->headerCellClass() ?>"><span id="elh_location_group_hours" class="location_group_hours"><?= $Page->group_hours->caption() ?></span></th>
<?php } ?>
<?php if ($Page->old_id->Visible) { // old_id ?>
        <th class="<?= $Page->old_id->headerCellClass() ?>"><span id="elh_location_old_id" class="location_old_id"><?= $Page->old_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->accept_plus_discount->Visible) { // accept_plus_discount ?>
        <th class="<?= $Page->accept_plus_discount->headerCellClass() ?>"><span id="elh_location_accept_plus_discount" class="location_accept_plus_discount"><?= $Page->accept_plus_discount->caption() ?></span></th>
<?php } ?>
<?php if ($Page->breakfast->Visible) { // breakfast ?>
        <th class="<?= $Page->breakfast->headerCellClass() ?>"><span id="elh_location_breakfast" class="location_breakfast"><?= $Page->breakfast->caption() ?></span></th>
<?php } ?>
<?php if ($Page->lunch->Visible) { // lunch ?>
        <th class="<?= $Page->lunch->headerCellClass() ?>"><span id="elh_location_lunch" class="location_lunch"><?= $Page->lunch->caption() ?></span></th>
<?php } ?>
<?php if ($Page->dinner->Visible) { // dinner ?>
        <th class="<?= $Page->dinner->headerCellClass() ?>"><span id="elh_location_dinner" class="location_dinner"><?= $Page->dinner->caption() ?></span></th>
<?php } ?>
<?php if ($Page->continuous->Visible) { // continuous ?>
        <th class="<?= $Page->continuous->headerCellClass() ?>"><span id="elh_location_continuous" class="location_continuous"><?= $Page->continuous->caption() ?></span></th>
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
<?php if ($Page->location_id->Visible) { // location_id ?>
        <td<?= $Page->location_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_location_location_id" class="el_location_location_id">
<span<?= $Page->location_id->viewAttributes() ?>>
<?= $Page->location_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->group_id->Visible) { // group_id ?>
        <td<?= $Page->group_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_location_group_id" class="el_location_group_id">
<span<?= $Page->group_id->viewAttributes() ?>>
<?= $Page->group_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->group_hours->Visible) { // group_hours ?>
        <td<?= $Page->group_hours->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_location_group_hours" class="el_location_group_hours">
<span<?= $Page->group_hours->viewAttributes() ?>>
<?= $Page->group_hours->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->old_id->Visible) { // old_id ?>
        <td<?= $Page->old_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_location_old_id" class="el_location_old_id">
<span<?= $Page->old_id->viewAttributes() ?>>
<?= $Page->old_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->accept_plus_discount->Visible) { // accept_plus_discount ?>
        <td<?= $Page->accept_plus_discount->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_location_accept_plus_discount" class="el_location_accept_plus_discount">
<span<?= $Page->accept_plus_discount->viewAttributes() ?>>
<?= $Page->accept_plus_discount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->breakfast->Visible) { // breakfast ?>
        <td<?= $Page->breakfast->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_location_breakfast" class="el_location_breakfast">
<span<?= $Page->breakfast->viewAttributes() ?>>
<?= $Page->breakfast->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->lunch->Visible) { // lunch ?>
        <td<?= $Page->lunch->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_location_lunch" class="el_location_lunch">
<span<?= $Page->lunch->viewAttributes() ?>>
<?= $Page->lunch->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->dinner->Visible) { // dinner ?>
        <td<?= $Page->dinner->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_location_dinner" class="el_location_dinner">
<span<?= $Page->dinner->viewAttributes() ?>>
<?= $Page->dinner->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->continuous->Visible) { // continuous ?>
        <td<?= $Page->continuous->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_location_continuous" class="el_location_continuous">
<span<?= $Page->continuous->viewAttributes() ?>>
<?= $Page->continuous->getViewValue() ?></span>
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
