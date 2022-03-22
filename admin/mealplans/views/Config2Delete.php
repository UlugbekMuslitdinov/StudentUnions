<?php

namespace PHPMaker2022\mealplans;

// Page object
$Config2Delete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { config2: currentTable } });
var currentForm, currentPageID;
var fconfig2delete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fconfig2delete = new ew.Form("fconfig2delete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fconfig2delete;
    loadjs.done("fconfig2delete");
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
<form name="fconfig2delete" id="fconfig2delete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="config2">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_config2_id" class="config2_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->min_deposit->Visible) { // min_deposit ?>
        <th class="<?= $Page->min_deposit->headerCellClass() ?>"><span id="elh_config2_min_deposit" class="config2_min_deposit"><?= $Page->min_deposit->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_deposit->Visible) { // max_deposit ?>
        <th class="<?= $Page->max_deposit->headerCellClass() ?>"><span id="elh_config2_max_deposit" class="config2_max_deposit"><?= $Page->max_deposit->caption() ?></span></th>
<?php } ?>
<?php if ($Page->current_term_code->Visible) { // current_term_code ?>
        <th class="<?= $Page->current_term_code->headerCellClass() ?>"><span id="elh_config2_current_term_code" class="config2_current_term_code"><?= $Page->current_term_code->caption() ?></span></th>
<?php } ?>
<?php if ($Page->fall_term_code->Visible) { // fall_term_code ?>
        <th class="<?= $Page->fall_term_code->headerCellClass() ?>"><span id="elh_config2_fall_term_code" class="config2_fall_term_code"><?= $Page->fall_term_code->caption() ?></span></th>
<?php } ?>
<?php if ($Page->spring_term_code->Visible) { // spring_term_code ?>
        <th class="<?= $Page->spring_term_code->headerCellClass() ?>"><span id="elh_config2_spring_term_code" class="config2_spring_term_code"><?= $Page->spring_term_code->caption() ?></span></th>
<?php } ?>
<?php if ($Page->full_year_begin->Visible) { // full_year_begin ?>
        <th class="<?= $Page->full_year_begin->headerCellClass() ?>"><span id="elh_config2_full_year_begin" class="config2_full_year_begin"><?= $Page->full_year_begin->caption() ?></span></th>
<?php } ?>
<?php if ($Page->half_year_begin->Visible) { // half_year_begin ?>
        <th class="<?= $Page->half_year_begin->headerCellClass() ?>"><span id="elh_config2_half_year_begin" class="config2_half_year_begin"><?= $Page->half_year_begin->caption() ?></span></th>
<?php } ?>
<?php if ($Page->year_end->Visible) { // year_end ?>
        <th class="<?= $Page->year_end->headerCellClass() ?>"><span id="elh_config2_year_end" class="config2_year_end"><?= $Page->year_end->caption() ?></span></th>
<?php } ?>
<?php if ($Page->plus_signup_full->Visible) { // plus_signup_full ?>
        <th class="<?= $Page->plus_signup_full->headerCellClass() ?>"><span id="elh_config2_plus_signup_full" class="config2_plus_signup_full"><?= $Page->plus_signup_full->caption() ?></span></th>
<?php } ?>
<?php if ($Page->plus_signup_half->Visible) { // plus_signup_half ?>
        <th class="<?= $Page->plus_signup_half->headerCellClass() ?>"><span id="elh_config2_plus_signup_half" class="config2_plus_signup_half"><?= $Page->plus_signup_half->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bursar_deposit_deadline->Visible) { // bursar_deposit_deadline ?>
        <th class="<?= $Page->bursar_deposit_deadline->headerCellClass() ?>"><span id="elh_config2_bursar_deposit_deadline" class="config2_bursar_deposit_deadline"><?= $Page->bursar_deposit_deadline->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_config2_id" class="el_config2_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->min_deposit->Visible) { // min_deposit ?>
        <td<?= $Page->min_deposit->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_config2_min_deposit" class="el_config2_min_deposit">
<span<?= $Page->min_deposit->viewAttributes() ?>>
<?= $Page->min_deposit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_deposit->Visible) { // max_deposit ?>
        <td<?= $Page->max_deposit->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_config2_max_deposit" class="el_config2_max_deposit">
<span<?= $Page->max_deposit->viewAttributes() ?>>
<?= $Page->max_deposit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->current_term_code->Visible) { // current_term_code ?>
        <td<?= $Page->current_term_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_config2_current_term_code" class="el_config2_current_term_code">
<span<?= $Page->current_term_code->viewAttributes() ?>>
<?= $Page->current_term_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->fall_term_code->Visible) { // fall_term_code ?>
        <td<?= $Page->fall_term_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_config2_fall_term_code" class="el_config2_fall_term_code">
<span<?= $Page->fall_term_code->viewAttributes() ?>>
<?= $Page->fall_term_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->spring_term_code->Visible) { // spring_term_code ?>
        <td<?= $Page->spring_term_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_config2_spring_term_code" class="el_config2_spring_term_code">
<span<?= $Page->spring_term_code->viewAttributes() ?>>
<?= $Page->spring_term_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->full_year_begin->Visible) { // full_year_begin ?>
        <td<?= $Page->full_year_begin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_config2_full_year_begin" class="el_config2_full_year_begin">
<span<?= $Page->full_year_begin->viewAttributes() ?>>
<?= $Page->full_year_begin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->half_year_begin->Visible) { // half_year_begin ?>
        <td<?= $Page->half_year_begin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_config2_half_year_begin" class="el_config2_half_year_begin">
<span<?= $Page->half_year_begin->viewAttributes() ?>>
<?= $Page->half_year_begin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->year_end->Visible) { // year_end ?>
        <td<?= $Page->year_end->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_config2_year_end" class="el_config2_year_end">
<span<?= $Page->year_end->viewAttributes() ?>>
<?= $Page->year_end->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->plus_signup_full->Visible) { // plus_signup_full ?>
        <td<?= $Page->plus_signup_full->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_config2_plus_signup_full" class="el_config2_plus_signup_full">
<span<?= $Page->plus_signup_full->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_plus_signup_full_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->plus_signup_full->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->plus_signup_full->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_plus_signup_full_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
<?php } ?>
<?php if ($Page->plus_signup_half->Visible) { // plus_signup_half ?>
        <td<?= $Page->plus_signup_half->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_config2_plus_signup_half" class="el_config2_plus_signup_half">
<span<?= $Page->plus_signup_half->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_plus_signup_half_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->plus_signup_half->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->plus_signup_half->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_plus_signup_half_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
<?php } ?>
<?php if ($Page->bursar_deposit_deadline->Visible) { // bursar_deposit_deadline ?>
        <td<?= $Page->bursar_deposit_deadline->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_config2_bursar_deposit_deadline" class="el_config2_bursar_deposit_deadline">
<span<?= $Page->bursar_deposit_deadline->viewAttributes() ?>>
<?= $Page->bursar_deposit_deadline->getViewValue() ?></span>
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
