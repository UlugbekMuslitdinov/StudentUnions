<?php

namespace PHPMaker2022\mealplans;

// Page object
$Config2View = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { config2: currentTable } });
var currentForm, currentPageID;
var fconfig2view;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fconfig2view = new ew.Form("fconfig2view", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fconfig2view;
    loadjs.done("fconfig2view");
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
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fconfig2view" id="fconfig2view" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="config2">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_config2_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_config2_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->min_deposit->Visible) { // min_deposit ?>
    <tr id="r_min_deposit"<?= $Page->min_deposit->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_config2_min_deposit"><?= $Page->min_deposit->caption() ?></span></td>
        <td data-name="min_deposit"<?= $Page->min_deposit->cellAttributes() ?>>
<span id="el_config2_min_deposit">
<span<?= $Page->min_deposit->viewAttributes() ?>>
<?= $Page->min_deposit->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_deposit->Visible) { // max_deposit ?>
    <tr id="r_max_deposit"<?= $Page->max_deposit->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_config2_max_deposit"><?= $Page->max_deposit->caption() ?></span></td>
        <td data-name="max_deposit"<?= $Page->max_deposit->cellAttributes() ?>>
<span id="el_config2_max_deposit">
<span<?= $Page->max_deposit->viewAttributes() ?>>
<?= $Page->max_deposit->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->current_term_code->Visible) { // current_term_code ?>
    <tr id="r_current_term_code"<?= $Page->current_term_code->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_config2_current_term_code"><?= $Page->current_term_code->caption() ?></span></td>
        <td data-name="current_term_code"<?= $Page->current_term_code->cellAttributes() ?>>
<span id="el_config2_current_term_code">
<span<?= $Page->current_term_code->viewAttributes() ?>>
<?= $Page->current_term_code->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->fall_term_code->Visible) { // fall_term_code ?>
    <tr id="r_fall_term_code"<?= $Page->fall_term_code->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_config2_fall_term_code"><?= $Page->fall_term_code->caption() ?></span></td>
        <td data-name="fall_term_code"<?= $Page->fall_term_code->cellAttributes() ?>>
<span id="el_config2_fall_term_code">
<span<?= $Page->fall_term_code->viewAttributes() ?>>
<?= $Page->fall_term_code->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->spring_term_code->Visible) { // spring_term_code ?>
    <tr id="r_spring_term_code"<?= $Page->spring_term_code->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_config2_spring_term_code"><?= $Page->spring_term_code->caption() ?></span></td>
        <td data-name="spring_term_code"<?= $Page->spring_term_code->cellAttributes() ?>>
<span id="el_config2_spring_term_code">
<span<?= $Page->spring_term_code->viewAttributes() ?>>
<?= $Page->spring_term_code->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->full_year_begin->Visible) { // full_year_begin ?>
    <tr id="r_full_year_begin"<?= $Page->full_year_begin->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_config2_full_year_begin"><?= $Page->full_year_begin->caption() ?></span></td>
        <td data-name="full_year_begin"<?= $Page->full_year_begin->cellAttributes() ?>>
<span id="el_config2_full_year_begin">
<span<?= $Page->full_year_begin->viewAttributes() ?>>
<?= $Page->full_year_begin->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->half_year_begin->Visible) { // half_year_begin ?>
    <tr id="r_half_year_begin"<?= $Page->half_year_begin->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_config2_half_year_begin"><?= $Page->half_year_begin->caption() ?></span></td>
        <td data-name="half_year_begin"<?= $Page->half_year_begin->cellAttributes() ?>>
<span id="el_config2_half_year_begin">
<span<?= $Page->half_year_begin->viewAttributes() ?>>
<?= $Page->half_year_begin->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->year_end->Visible) { // year_end ?>
    <tr id="r_year_end"<?= $Page->year_end->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_config2_year_end"><?= $Page->year_end->caption() ?></span></td>
        <td data-name="year_end"<?= $Page->year_end->cellAttributes() ?>>
<span id="el_config2_year_end">
<span<?= $Page->year_end->viewAttributes() ?>>
<?= $Page->year_end->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->plus_signup_full->Visible) { // plus_signup_full ?>
    <tr id="r_plus_signup_full"<?= $Page->plus_signup_full->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_config2_plus_signup_full"><?= $Page->plus_signup_full->caption() ?></span></td>
        <td data-name="plus_signup_full"<?= $Page->plus_signup_full->cellAttributes() ?>>
<span id="el_config2_plus_signup_full">
<span<?= $Page->plus_signup_full->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_plus_signup_full_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->plus_signup_full->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->plus_signup_full->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_plus_signup_full_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->plus_signup_half->Visible) { // plus_signup_half ?>
    <tr id="r_plus_signup_half"<?= $Page->plus_signup_half->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_config2_plus_signup_half"><?= $Page->plus_signup_half->caption() ?></span></td>
        <td data-name="plus_signup_half"<?= $Page->plus_signup_half->cellAttributes() ?>>
<span id="el_config2_plus_signup_half">
<span<?= $Page->plus_signup_half->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_plus_signup_half_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->plus_signup_half->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->plus_signup_half->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_plus_signup_half_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bursar_deposit_deadline->Visible) { // bursar_deposit_deadline ?>
    <tr id="r_bursar_deposit_deadline"<?= $Page->bursar_deposit_deadline->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_config2_bursar_deposit_deadline"><?= $Page->bursar_deposit_deadline->caption() ?></span></td>
        <td data-name="bursar_deposit_deadline"<?= $Page->bursar_deposit_deadline->cellAttributes() ?>>
<span id="el_config2_bursar_deposit_deadline">
<span<?= $Page->bursar_deposit_deadline->viewAttributes() ?>>
<?= $Page->bursar_deposit_deadline->getViewValue() ?></span>
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
