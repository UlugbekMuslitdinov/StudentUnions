<?php

namespace PHPMaker2022\project3;

// Page object
$MealTimesDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { meal_times: currentTable } });
var currentForm, currentPageID;
var fmeal_timesdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmeal_timesdelete = new ew.Form("fmeal_timesdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fmeal_timesdelete;
    loadjs.done("fmeal_timesdelete");
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
<form name="fmeal_timesdelete" id="fmeal_timesdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="meal_times">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_meal_times_id" class="meal_times_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->location_id->Visible) { // location_id ?>
        <th class="<?= $Page->location_id->headerCellClass() ?>"><span id="elh_meal_times_location_id" class="meal_times_location_id"><?= $Page->location_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->meal_details_id->Visible) { // meal_details_id ?>
        <th class="<?= $Page->meal_details_id->headerCellClass() ?>"><span id="elh_meal_times_meal_details_id" class="meal_times_meal_details_id"><?= $Page->meal_details_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->startm->Visible) { // startm ?>
        <th class="<?= $Page->startm->headerCellClass() ?>"><span id="elh_meal_times_startm" class="meal_times_startm"><?= $Page->startm->caption() ?></span></th>
<?php } ?>
<?php if ($Page->endm->Visible) { // endm ?>
        <th class="<?= $Page->endm->headerCellClass() ?>"><span id="elh_meal_times_endm" class="meal_times_endm"><?= $Page->endm->caption() ?></span></th>
<?php } ?>
<?php if ($Page->startt->Visible) { // startt ?>
        <th class="<?= $Page->startt->headerCellClass() ?>"><span id="elh_meal_times_startt" class="meal_times_startt"><?= $Page->startt->caption() ?></span></th>
<?php } ?>
<?php if ($Page->endt->Visible) { // endt ?>
        <th class="<?= $Page->endt->headerCellClass() ?>"><span id="elh_meal_times_endt" class="meal_times_endt"><?= $Page->endt->caption() ?></span></th>
<?php } ?>
<?php if ($Page->startw->Visible) { // startw ?>
        <th class="<?= $Page->startw->headerCellClass() ?>"><span id="elh_meal_times_startw" class="meal_times_startw"><?= $Page->startw->caption() ?></span></th>
<?php } ?>
<?php if ($Page->endw->Visible) { // endw ?>
        <th class="<?= $Page->endw->headerCellClass() ?>"><span id="elh_meal_times_endw" class="meal_times_endw"><?= $Page->endw->caption() ?></span></th>
<?php } ?>
<?php if ($Page->startr->Visible) { // startr ?>
        <th class="<?= $Page->startr->headerCellClass() ?>"><span id="elh_meal_times_startr" class="meal_times_startr"><?= $Page->startr->caption() ?></span></th>
<?php } ?>
<?php if ($Page->endr->Visible) { // endr ?>
        <th class="<?= $Page->endr->headerCellClass() ?>"><span id="elh_meal_times_endr" class="meal_times_endr"><?= $Page->endr->caption() ?></span></th>
<?php } ?>
<?php if ($Page->startf->Visible) { // startf ?>
        <th class="<?= $Page->startf->headerCellClass() ?>"><span id="elh_meal_times_startf" class="meal_times_startf"><?= $Page->startf->caption() ?></span></th>
<?php } ?>
<?php if ($Page->endf->Visible) { // endf ?>
        <th class="<?= $Page->endf->headerCellClass() ?>"><span id="elh_meal_times_endf" class="meal_times_endf"><?= $Page->endf->caption() ?></span></th>
<?php } ?>
<?php if ($Page->starts->Visible) { // starts ?>
        <th class="<?= $Page->starts->headerCellClass() ?>"><span id="elh_meal_times_starts" class="meal_times_starts"><?= $Page->starts->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ends->Visible) { // ends ?>
        <th class="<?= $Page->ends->headerCellClass() ?>"><span id="elh_meal_times_ends" class="meal_times_ends"><?= $Page->ends->caption() ?></span></th>
<?php } ?>
<?php if ($Page->startu->Visible) { // startu ?>
        <th class="<?= $Page->startu->headerCellClass() ?>"><span id="elh_meal_times_startu" class="meal_times_startu"><?= $Page->startu->caption() ?></span></th>
<?php } ?>
<?php if ($Page->endu->Visible) { // endu ?>
        <th class="<?= $Page->endu->headerCellClass() ?>"><span id="elh_meal_times_endu" class="meal_times_endu"><?= $Page->endu->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_meal_times_id" class="el_meal_times_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->location_id->Visible) { // location_id ?>
        <td<?= $Page->location_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_meal_times_location_id" class="el_meal_times_location_id">
<span<?= $Page->location_id->viewAttributes() ?>>
<?= $Page->location_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->meal_details_id->Visible) { // meal_details_id ?>
        <td<?= $Page->meal_details_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_meal_times_meal_details_id" class="el_meal_times_meal_details_id">
<span<?= $Page->meal_details_id->viewAttributes() ?>>
<?= $Page->meal_details_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->startm->Visible) { // startm ?>
        <td<?= $Page->startm->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_meal_times_startm" class="el_meal_times_startm">
<span<?= $Page->startm->viewAttributes() ?>>
<?= $Page->startm->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->endm->Visible) { // endm ?>
        <td<?= $Page->endm->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_meal_times_endm" class="el_meal_times_endm">
<span<?= $Page->endm->viewAttributes() ?>>
<?= $Page->endm->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->startt->Visible) { // startt ?>
        <td<?= $Page->startt->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_meal_times_startt" class="el_meal_times_startt">
<span<?= $Page->startt->viewAttributes() ?>>
<?= $Page->startt->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->endt->Visible) { // endt ?>
        <td<?= $Page->endt->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_meal_times_endt" class="el_meal_times_endt">
<span<?= $Page->endt->viewAttributes() ?>>
<?= $Page->endt->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->startw->Visible) { // startw ?>
        <td<?= $Page->startw->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_meal_times_startw" class="el_meal_times_startw">
<span<?= $Page->startw->viewAttributes() ?>>
<?= $Page->startw->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->endw->Visible) { // endw ?>
        <td<?= $Page->endw->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_meal_times_endw" class="el_meal_times_endw">
<span<?= $Page->endw->viewAttributes() ?>>
<?= $Page->endw->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->startr->Visible) { // startr ?>
        <td<?= $Page->startr->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_meal_times_startr" class="el_meal_times_startr">
<span<?= $Page->startr->viewAttributes() ?>>
<?= $Page->startr->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->endr->Visible) { // endr ?>
        <td<?= $Page->endr->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_meal_times_endr" class="el_meal_times_endr">
<span<?= $Page->endr->viewAttributes() ?>>
<?= $Page->endr->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->startf->Visible) { // startf ?>
        <td<?= $Page->startf->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_meal_times_startf" class="el_meal_times_startf">
<span<?= $Page->startf->viewAttributes() ?>>
<?= $Page->startf->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->endf->Visible) { // endf ?>
        <td<?= $Page->endf->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_meal_times_endf" class="el_meal_times_endf">
<span<?= $Page->endf->viewAttributes() ?>>
<?= $Page->endf->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->starts->Visible) { // starts ?>
        <td<?= $Page->starts->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_meal_times_starts" class="el_meal_times_starts">
<span<?= $Page->starts->viewAttributes() ?>>
<?= $Page->starts->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ends->Visible) { // ends ?>
        <td<?= $Page->ends->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_meal_times_ends" class="el_meal_times_ends">
<span<?= $Page->ends->viewAttributes() ?>>
<?= $Page->ends->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->startu->Visible) { // startu ?>
        <td<?= $Page->startu->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_meal_times_startu" class="el_meal_times_startu">
<span<?= $Page->startu->viewAttributes() ?>>
<?= $Page->startu->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->endu->Visible) { // endu ?>
        <td<?= $Page->endu->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_meal_times_endu" class="el_meal_times_endu">
<span<?= $Page->endu->viewAttributes() ?>>
<?= $Page->endu->getViewValue() ?></span>
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
