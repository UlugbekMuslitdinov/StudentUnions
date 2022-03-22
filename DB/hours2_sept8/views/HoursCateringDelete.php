<?php

namespace PHPMaker2022\project3;

// Page object
$HoursCateringDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { hours_catering: currentTable } });
var currentForm, currentPageID;
var fhours_cateringdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fhours_cateringdelete = new ew.Form("fhours_cateringdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fhours_cateringdelete;
    loadjs.done("fhours_cateringdelete");
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
<form name="fhours_cateringdelete" id="fhours_cateringdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="hours_catering">
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
<?php if ($Page->id->Visible) { // id ?>
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_hours_catering_id" class="hours_catering_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->location_id->Visible) { // location_id ?>
        <th class="<?= $Page->location_id->headerCellClass() ?>"><span id="elh_hours_catering_location_id" class="hours_catering_location_id"><?= $Page->location_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->day_from->Visible) { // day_from ?>
        <th class="<?= $Page->day_from->headerCellClass() ?>"><span id="elh_hours_catering_day_from" class="hours_catering_day_from"><?= $Page->day_from->caption() ?></span></th>
<?php } ?>
<?php if ($Page->day_to->Visible) { // day_to ?>
        <th class="<?= $Page->day_to->headerCellClass() ?>"><span id="elh_hours_catering_day_to" class="hours_catering_day_to"><?= $Page->day_to->caption() ?></span></th>
<?php } ?>
<?php if ($Page->time_from->Visible) { // time_from ?>
        <th class="<?= $Page->time_from->headerCellClass() ?>"><span id="elh_hours_catering_time_from" class="hours_catering_time_from"><?= $Page->time_from->caption() ?></span></th>
<?php } ?>
<?php if ($Page->time_to->Visible) { // time_to ?>
        <th class="<?= $Page->time_to->headerCellClass() ?>"><span id="elh_hours_catering_time_to" class="hours_catering_time_to"><?= $Page->time_to->caption() ?></span></th>
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
        <td<?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_catering_id" class="el_hours_catering_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->location_id->Visible) { // location_id ?>
        <td<?= $Page->location_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_catering_location_id" class="el_hours_catering_location_id">
<span<?= $Page->location_id->viewAttributes() ?>>
<?= $Page->location_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->day_from->Visible) { // day_from ?>
        <td<?= $Page->day_from->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_catering_day_from" class="el_hours_catering_day_from">
<span<?= $Page->day_from->viewAttributes() ?>>
<?= $Page->day_from->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->day_to->Visible) { // day_to ?>
        <td<?= $Page->day_to->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_catering_day_to" class="el_hours_catering_day_to">
<span<?= $Page->day_to->viewAttributes() ?>>
<?= $Page->day_to->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->time_from->Visible) { // time_from ?>
        <td<?= $Page->time_from->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_catering_time_from" class="el_hours_catering_time_from">
<span<?= $Page->time_from->viewAttributes() ?>>
<?= $Page->time_from->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->time_to->Visible) { // time_to ?>
        <td<?= $Page->time_to->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_catering_time_to" class="el_hours_catering_time_to">
<span<?= $Page->time_to->viewAttributes() ?>>
<?= $Page->time_to->getViewValue() ?></span>
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
