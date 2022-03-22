<?php

namespace PHPMaker2022\mealplans;

// Page object
$Config2List = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { config2: currentTable } });
var currentForm, currentPageID;
var fconfig2list;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fconfig2list = new ew.Form("fconfig2list", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fconfig2list;
    fconfig2list.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fconfig2list");
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
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
</div>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> config2">
<form name="fconfig2list" id="fconfig2list" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="config2">
<div id="gmp_config2" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_config2list" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->id->Visible) { // id ?>
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_config2_id" class="config2_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->min_deposit->Visible) { // min_deposit ?>
        <th data-name="min_deposit" class="<?= $Page->min_deposit->headerCellClass() ?>"><div id="elh_config2_min_deposit" class="config2_min_deposit"><?= $Page->renderFieldHeader($Page->min_deposit) ?></div></th>
<?php } ?>
<?php if ($Page->max_deposit->Visible) { // max_deposit ?>
        <th data-name="max_deposit" class="<?= $Page->max_deposit->headerCellClass() ?>"><div id="elh_config2_max_deposit" class="config2_max_deposit"><?= $Page->renderFieldHeader($Page->max_deposit) ?></div></th>
<?php } ?>
<?php if ($Page->current_term_code->Visible) { // current_term_code ?>
        <th data-name="current_term_code" class="<?= $Page->current_term_code->headerCellClass() ?>"><div id="elh_config2_current_term_code" class="config2_current_term_code"><?= $Page->renderFieldHeader($Page->current_term_code) ?></div></th>
<?php } ?>
<?php if ($Page->fall_term_code->Visible) { // fall_term_code ?>
        <th data-name="fall_term_code" class="<?= $Page->fall_term_code->headerCellClass() ?>"><div id="elh_config2_fall_term_code" class="config2_fall_term_code"><?= $Page->renderFieldHeader($Page->fall_term_code) ?></div></th>
<?php } ?>
<?php if ($Page->spring_term_code->Visible) { // spring_term_code ?>
        <th data-name="spring_term_code" class="<?= $Page->spring_term_code->headerCellClass() ?>"><div id="elh_config2_spring_term_code" class="config2_spring_term_code"><?= $Page->renderFieldHeader($Page->spring_term_code) ?></div></th>
<?php } ?>
<?php if ($Page->full_year_begin->Visible) { // full_year_begin ?>
        <th data-name="full_year_begin" class="<?= $Page->full_year_begin->headerCellClass() ?>"><div id="elh_config2_full_year_begin" class="config2_full_year_begin"><?= $Page->renderFieldHeader($Page->full_year_begin) ?></div></th>
<?php } ?>
<?php if ($Page->half_year_begin->Visible) { // half_year_begin ?>
        <th data-name="half_year_begin" class="<?= $Page->half_year_begin->headerCellClass() ?>"><div id="elh_config2_half_year_begin" class="config2_half_year_begin"><?= $Page->renderFieldHeader($Page->half_year_begin) ?></div></th>
<?php } ?>
<?php if ($Page->year_end->Visible) { // year_end ?>
        <th data-name="year_end" class="<?= $Page->year_end->headerCellClass() ?>"><div id="elh_config2_year_end" class="config2_year_end"><?= $Page->renderFieldHeader($Page->year_end) ?></div></th>
<?php } ?>
<?php if ($Page->plus_signup_full->Visible) { // plus_signup_full ?>
        <th data-name="plus_signup_full" class="<?= $Page->plus_signup_full->headerCellClass() ?>"><div id="elh_config2_plus_signup_full" class="config2_plus_signup_full"><?= $Page->renderFieldHeader($Page->plus_signup_full) ?></div></th>
<?php } ?>
<?php if ($Page->plus_signup_half->Visible) { // plus_signup_half ?>
        <th data-name="plus_signup_half" class="<?= $Page->plus_signup_half->headerCellClass() ?>"><div id="elh_config2_plus_signup_half" class="config2_plus_signup_half"><?= $Page->renderFieldHeader($Page->plus_signup_half) ?></div></th>
<?php } ?>
<?php if ($Page->bursar_deposit_deadline->Visible) { // bursar_deposit_deadline ?>
        <th data-name="bursar_deposit_deadline" class="<?= $Page->bursar_deposit_deadline->headerCellClass() ?>"><div id="elh_config2_bursar_deposit_deadline" class="config2_bursar_deposit_deadline"><?= $Page->renderFieldHeader($Page->bursar_deposit_deadline) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
if ($Page->ExportAll && $Page->isExport()) {
    $Page->StopRecord = $Page->TotalRecords;
} else {
    // Set the last record to display
    if ($Page->TotalRecords > $Page->StartRecord + $Page->DisplayRecords - 1) {
        $Page->StopRecord = $Page->StartRecord + $Page->DisplayRecords - 1;
    } else {
        $Page->StopRecord = $Page->TotalRecords;
    }
}
$Page->RecordCount = $Page->StartRecord - 1;
if ($Page->Recordset && !$Page->Recordset->EOF) {
    // Nothing to do
} elseif ($Page->isGridAdd() && !$Page->AllowAddDeleteRow && $Page->StopRecord == 0) {
    $Page->StopRecord = $Page->GridAddRowCount;
}

// Initialize aggregate
$Page->RowType = ROWTYPE_AGGREGATEINIT;
$Page->resetAttributes();
$Page->renderRow();
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->RowCount++;

        // Set up key count
        $Page->KeyCount = $Page->RowIndex;

        // Init row class and style
        $Page->resetAttributes();
        $Page->CssClass = "";
        if ($Page->isGridAdd()) {
            $Page->loadRowValues(); // Load default values
            $Page->OldKey = "";
            $Page->setKey($Page->OldKey);
        } else {
            $Page->loadRowValues($Page->Recordset); // Load row values
            if ($Page->isGridEdit()) {
                $Page->OldKey = $Page->getKey(true); // Get from CurrentValue
                $Page->setKey($Page->OldKey);
            }
        }
        $Page->RowType = ROWTYPE_VIEW; // Render view

        // Set up row attributes
        $Page->RowAttrs->merge([
            "data-rowindex" => $Page->RowCount,
            "id" => "r" . $Page->RowCount . "_config2",
            "data-rowtype" => $Page->RowType,
            "class" => ($Page->RowCount % 2 != 1) ? "ew-table-alt-row" : "",
        ]);
        if ($Page->isAdd() && $Page->RowType == ROWTYPE_ADD || $Page->isEdit() && $Page->RowType == ROWTYPE_EDIT) { // Inline-Add/Edit row
            $Page->RowAttrs->appendClass("table-active");
        }

        // Render row
        $Page->renderRow();

        // Render list options
        $Page->renderListOptions();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->id->Visible) { // id ?>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_config2_id" class="el_config2_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->min_deposit->Visible) { // min_deposit ?>
        <td data-name="min_deposit"<?= $Page->min_deposit->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_config2_min_deposit" class="el_config2_min_deposit">
<span<?= $Page->min_deposit->viewAttributes() ?>>
<?= $Page->min_deposit->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_deposit->Visible) { // max_deposit ?>
        <td data-name="max_deposit"<?= $Page->max_deposit->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_config2_max_deposit" class="el_config2_max_deposit">
<span<?= $Page->max_deposit->viewAttributes() ?>>
<?= $Page->max_deposit->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->current_term_code->Visible) { // current_term_code ?>
        <td data-name="current_term_code"<?= $Page->current_term_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_config2_current_term_code" class="el_config2_current_term_code">
<span<?= $Page->current_term_code->viewAttributes() ?>>
<?= $Page->current_term_code->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->fall_term_code->Visible) { // fall_term_code ?>
        <td data-name="fall_term_code"<?= $Page->fall_term_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_config2_fall_term_code" class="el_config2_fall_term_code">
<span<?= $Page->fall_term_code->viewAttributes() ?>>
<?= $Page->fall_term_code->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->spring_term_code->Visible) { // spring_term_code ?>
        <td data-name="spring_term_code"<?= $Page->spring_term_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_config2_spring_term_code" class="el_config2_spring_term_code">
<span<?= $Page->spring_term_code->viewAttributes() ?>>
<?= $Page->spring_term_code->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->full_year_begin->Visible) { // full_year_begin ?>
        <td data-name="full_year_begin"<?= $Page->full_year_begin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_config2_full_year_begin" class="el_config2_full_year_begin">
<span<?= $Page->full_year_begin->viewAttributes() ?>>
<?= $Page->full_year_begin->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->half_year_begin->Visible) { // half_year_begin ?>
        <td data-name="half_year_begin"<?= $Page->half_year_begin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_config2_half_year_begin" class="el_config2_half_year_begin">
<span<?= $Page->half_year_begin->viewAttributes() ?>>
<?= $Page->half_year_begin->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->year_end->Visible) { // year_end ?>
        <td data-name="year_end"<?= $Page->year_end->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_config2_year_end" class="el_config2_year_end">
<span<?= $Page->year_end->viewAttributes() ?>>
<?= $Page->year_end->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->plus_signup_full->Visible) { // plus_signup_full ?>
        <td data-name="plus_signup_full"<?= $Page->plus_signup_full->cellAttributes() ?>>
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
        <td data-name="plus_signup_half"<?= $Page->plus_signup_half->cellAttributes() ?>>
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
        <td data-name="bursar_deposit_deadline"<?= $Page->bursar_deposit_deadline->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_config2_bursar_deposit_deadline" class="el_config2_bursar_deposit_deadline">
<span<?= $Page->bursar_deposit_deadline->viewAttributes() ?>>
<?= $Page->bursar_deposit_deadline->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
<?php if (!$Page->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("config2");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
