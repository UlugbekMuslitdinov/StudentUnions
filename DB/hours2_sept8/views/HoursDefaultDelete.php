<?php

namespace PHPMaker2022\project3;

// Page object
$HoursDefaultDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { hours_default: currentTable } });
var currentForm, currentPageID;
var fhours_defaultdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fhours_defaultdelete = new ew.Form("fhours_defaultdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fhours_defaultdelete;
    loadjs.done("fhours_defaultdelete");
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
<form name="fhours_defaultdelete" id="fhours_defaultdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="hours_default">
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
<?php if ($Page->hour_id->Visible) { // hour_id ?>
        <th class="<?= $Page->hour_id->headerCellClass() ?>"><span id="elh_hours_default_hour_id" class="hours_default_hour_id"><?= $Page->hour_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->mon_open->Visible) { // mon_open ?>
        <th class="<?= $Page->mon_open->headerCellClass() ?>"><span id="elh_hours_default_mon_open" class="hours_default_mon_open"><?= $Page->mon_open->caption() ?></span></th>
<?php } ?>
<?php if ($Page->mon_close->Visible) { // mon_close ?>
        <th class="<?= $Page->mon_close->headerCellClass() ?>"><span id="elh_hours_default_mon_close" class="hours_default_mon_close"><?= $Page->mon_close->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tue_open->Visible) { // tue_open ?>
        <th class="<?= $Page->tue_open->headerCellClass() ?>"><span id="elh_hours_default_tue_open" class="hours_default_tue_open"><?= $Page->tue_open->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tue_close->Visible) { // tue_close ?>
        <th class="<?= $Page->tue_close->headerCellClass() ?>"><span id="elh_hours_default_tue_close" class="hours_default_tue_close"><?= $Page->tue_close->caption() ?></span></th>
<?php } ?>
<?php if ($Page->wed_open->Visible) { // wed_open ?>
        <th class="<?= $Page->wed_open->headerCellClass() ?>"><span id="elh_hours_default_wed_open" class="hours_default_wed_open"><?= $Page->wed_open->caption() ?></span></th>
<?php } ?>
<?php if ($Page->wed_close->Visible) { // wed_close ?>
        <th class="<?= $Page->wed_close->headerCellClass() ?>"><span id="elh_hours_default_wed_close" class="hours_default_wed_close"><?= $Page->wed_close->caption() ?></span></th>
<?php } ?>
<?php if ($Page->thu_open->Visible) { // thu_open ?>
        <th class="<?= $Page->thu_open->headerCellClass() ?>"><span id="elh_hours_default_thu_open" class="hours_default_thu_open"><?= $Page->thu_open->caption() ?></span></th>
<?php } ?>
<?php if ($Page->thu_close->Visible) { // thu_close ?>
        <th class="<?= $Page->thu_close->headerCellClass() ?>"><span id="elh_hours_default_thu_close" class="hours_default_thu_close"><?= $Page->thu_close->caption() ?></span></th>
<?php } ?>
<?php if ($Page->fri_open->Visible) { // fri_open ?>
        <th class="<?= $Page->fri_open->headerCellClass() ?>"><span id="elh_hours_default_fri_open" class="hours_default_fri_open"><?= $Page->fri_open->caption() ?></span></th>
<?php } ?>
<?php if ($Page->fri_close->Visible) { // fri_close ?>
        <th class="<?= $Page->fri_close->headerCellClass() ?>"><span id="elh_hours_default_fri_close" class="hours_default_fri_close"><?= $Page->fri_close->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sat_open->Visible) { // sat_open ?>
        <th class="<?= $Page->sat_open->headerCellClass() ?>"><span id="elh_hours_default_sat_open" class="hours_default_sat_open"><?= $Page->sat_open->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sat_close->Visible) { // sat_close ?>
        <th class="<?= $Page->sat_close->headerCellClass() ?>"><span id="elh_hours_default_sat_close" class="hours_default_sat_close"><?= $Page->sat_close->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sun_open->Visible) { // sun_open ?>
        <th class="<?= $Page->sun_open->headerCellClass() ?>"><span id="elh_hours_default_sun_open" class="hours_default_sun_open"><?= $Page->sun_open->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sun_close->Visible) { // sun_close ?>
        <th class="<?= $Page->sun_close->headerCellClass() ?>"><span id="elh_hours_default_sun_close" class="hours_default_sun_close"><?= $Page->sun_close->caption() ?></span></th>
<?php } ?>
<?php if ($Page->close->Visible) { // close ?>
        <th class="<?= $Page->close->headerCellClass() ?>"><span id="elh_hours_default_close" class="hours_default_close"><?= $Page->close->caption() ?></span></th>
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
<?php if ($Page->hour_id->Visible) { // hour_id ?>
        <td<?= $Page->hour_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_hour_id" class="el_hours_default_hour_id">
<span<?= $Page->hour_id->viewAttributes() ?>>
<?= $Page->hour_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->mon_open->Visible) { // mon_open ?>
        <td<?= $Page->mon_open->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_mon_open" class="el_hours_default_mon_open">
<span<?= $Page->mon_open->viewAttributes() ?>>
<?= $Page->mon_open->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->mon_close->Visible) { // mon_close ?>
        <td<?= $Page->mon_close->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_mon_close" class="el_hours_default_mon_close">
<span<?= $Page->mon_close->viewAttributes() ?>>
<?= $Page->mon_close->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tue_open->Visible) { // tue_open ?>
        <td<?= $Page->tue_open->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_tue_open" class="el_hours_default_tue_open">
<span<?= $Page->tue_open->viewAttributes() ?>>
<?= $Page->tue_open->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tue_close->Visible) { // tue_close ?>
        <td<?= $Page->tue_close->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_tue_close" class="el_hours_default_tue_close">
<span<?= $Page->tue_close->viewAttributes() ?>>
<?= $Page->tue_close->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->wed_open->Visible) { // wed_open ?>
        <td<?= $Page->wed_open->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_wed_open" class="el_hours_default_wed_open">
<span<?= $Page->wed_open->viewAttributes() ?>>
<?= $Page->wed_open->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->wed_close->Visible) { // wed_close ?>
        <td<?= $Page->wed_close->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_wed_close" class="el_hours_default_wed_close">
<span<?= $Page->wed_close->viewAttributes() ?>>
<?= $Page->wed_close->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->thu_open->Visible) { // thu_open ?>
        <td<?= $Page->thu_open->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_thu_open" class="el_hours_default_thu_open">
<span<?= $Page->thu_open->viewAttributes() ?>>
<?= $Page->thu_open->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->thu_close->Visible) { // thu_close ?>
        <td<?= $Page->thu_close->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_thu_close" class="el_hours_default_thu_close">
<span<?= $Page->thu_close->viewAttributes() ?>>
<?= $Page->thu_close->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->fri_open->Visible) { // fri_open ?>
        <td<?= $Page->fri_open->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_fri_open" class="el_hours_default_fri_open">
<span<?= $Page->fri_open->viewAttributes() ?>>
<?= $Page->fri_open->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->fri_close->Visible) { // fri_close ?>
        <td<?= $Page->fri_close->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_fri_close" class="el_hours_default_fri_close">
<span<?= $Page->fri_close->viewAttributes() ?>>
<?= $Page->fri_close->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sat_open->Visible) { // sat_open ?>
        <td<?= $Page->sat_open->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_sat_open" class="el_hours_default_sat_open">
<span<?= $Page->sat_open->viewAttributes() ?>>
<?= $Page->sat_open->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sat_close->Visible) { // sat_close ?>
        <td<?= $Page->sat_close->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_sat_close" class="el_hours_default_sat_close">
<span<?= $Page->sat_close->viewAttributes() ?>>
<?= $Page->sat_close->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sun_open->Visible) { // sun_open ?>
        <td<?= $Page->sun_open->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_sun_open" class="el_hours_default_sun_open">
<span<?= $Page->sun_open->viewAttributes() ?>>
<?= $Page->sun_open->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sun_close->Visible) { // sun_close ?>
        <td<?= $Page->sun_close->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_sun_close" class="el_hours_default_sun_close">
<span<?= $Page->sun_close->viewAttributes() ?>>
<?= $Page->sun_close->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->close->Visible) { // close ?>
        <td<?= $Page->close->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_close" class="el_hours_default_close">
<span<?= $Page->close->viewAttributes() ?>>
<?= $Page->close->getViewValue() ?></span>
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
