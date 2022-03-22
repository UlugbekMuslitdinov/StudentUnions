<?php

namespace PHPMaker2022\mealplans;

// Page object
$ControlList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { control: currentTable } });
var currentForm, currentPageID;
var fcontrollist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcontrollist = new ew.Form("fcontrollist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fcontrollist;
    fcontrollist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fcontrollist");
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> control">
<form name="fcontrollist" id="fcontrollist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="control">
<div id="gmp_control" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_controllist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->ID->Visible) { // ID ?>
        <th data-name="ID" class="<?= $Page->ID->headerCellClass() ?>"><div id="elh_control_ID" class="control_ID"><?= $Page->renderFieldHeader($Page->ID) ?></div></th>
<?php } ?>
<?php if ($Page->online->Visible) { // online ?>
        <th data-name="online" class="<?= $Page->online->headerCellClass() ?>"><div id="elh_control_online" class="control_online"><?= $Page->renderFieldHeader($Page->online) ?></div></th>
<?php } ?>
<?php if ($Page->signup_bursars->Visible) { // signup_bursars ?>
        <th data-name="signup_bursars" class="<?= $Page->signup_bursars->headerCellClass() ?>"><div id="elh_control_signup_bursars" class="control_signup_bursars"><?= $Page->renderFieldHeader($Page->signup_bursars) ?></div></th>
<?php } ?>
<?php if ($Page->signup_cc->Visible) { // signup_cc ?>
        <th data-name="signup_cc" class="<?= $Page->signup_cc->headerCellClass() ?>"><div id="elh_control_signup_cc" class="control_signup_cc"><?= $Page->renderFieldHeader($Page->signup_cc) ?></div></th>
<?php } ?>
<?php if ($Page->deposit_bursars->Visible) { // deposit_bursars ?>
        <th data-name="deposit_bursars" class="<?= $Page->deposit_bursars->headerCellClass() ?>"><div id="elh_control_deposit_bursars" class="control_deposit_bursars"><?= $Page->renderFieldHeader($Page->deposit_bursars) ?></div></th>
<?php } ?>
<?php if ($Page->deposit_cc->Visible) { // deposit_cc ?>
        <th data-name="deposit_cc" class="<?= $Page->deposit_cc->headerCellClass() ?>"><div id="elh_control_deposit_cc" class="control_deposit_cc"><?= $Page->renderFieldHeader($Page->deposit_cc) ?></div></th>
<?php } ?>
<?php if ($Page->exporter->Visible) { // exporter ?>
        <th data-name="exporter" class="<?= $Page->exporter->headerCellClass() ?>"><div id="elh_control_exporter" class="control_exporter"><?= $Page->renderFieldHeader($Page->exporter) ?></div></th>
<?php } ?>
<?php if ($Page->signup->Visible) { // signup ?>
        <th data-name="signup" class="<?= $Page->signup->headerCellClass() ?>"><div id="elh_control_signup" class="control_signup"><?= $Page->renderFieldHeader($Page->signup) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_control",
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
    <?php if ($Page->ID->Visible) { // ID ?>
        <td data-name="ID"<?= $Page->ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_control_ID" class="el_control_ID">
<span<?= $Page->ID->viewAttributes() ?>>
<?= $Page->ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->online->Visible) { // online ?>
        <td data-name="online"<?= $Page->online->cellAttributes() ?>>
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
        <td data-name="signup_bursars"<?= $Page->signup_bursars->cellAttributes() ?>>
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
        <td data-name="signup_cc"<?= $Page->signup_cc->cellAttributes() ?>>
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
        <td data-name="deposit_bursars"<?= $Page->deposit_bursars->cellAttributes() ?>>
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
        <td data-name="deposit_cc"<?= $Page->deposit_cc->cellAttributes() ?>>
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
        <td data-name="exporter"<?= $Page->exporter->cellAttributes() ?>>
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
        <td data-name="signup"<?= $Page->signup->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_control_signup" class="el_control_signup">
<span<?= $Page->signup->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_signup_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->signup->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->signup->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_signup_<?= $Page->RowCount ?>"></label>
</div></span>
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
    ew.addEventHandlers("control");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
