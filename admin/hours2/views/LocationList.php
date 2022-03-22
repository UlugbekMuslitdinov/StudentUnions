<?php

namespace PHPMaker2021\project2;

// Page object
$LocationList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var flocationlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    flocationlist = currentForm = new ew.Form("flocationlist", "list");
    flocationlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("flocationlist");
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
<div class="clearfix"></div>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> location">
<form name="flocationlist" id="flocationlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="location">
<div id="gmp_location" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_locationlist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->location_id->Visible) { // location_id ?>
        <th data-name="location_id" class="<?= $Page->location_id->headerCellClass() ?>"><div id="elh_location_location_id" class="location_location_id"><?= $Page->renderSort($Page->location_id) ?></div></th>
<?php } ?>
<?php if ($Page->group_id->Visible) { // group_id ?>
        <th data-name="group_id" class="<?= $Page->group_id->headerCellClass() ?>"><div id="elh_location_group_id" class="location_group_id"><?= $Page->renderSort($Page->group_id) ?></div></th>
<?php } ?>
<?php if ($Page->group_hours->Visible) { // group_hours ?>
        <th data-name="group_hours" class="<?= $Page->group_hours->headerCellClass() ?>"><div id="elh_location_group_hours" class="location_group_hours"><?= $Page->renderSort($Page->group_hours) ?></div></th>
<?php } ?>
<?php if ($Page->old_id->Visible) { // old_id ?>
        <th data-name="old_id" class="<?= $Page->old_id->headerCellClass() ?>"><div id="elh_location_old_id" class="location_old_id"><?= $Page->renderSort($Page->old_id) ?></div></th>
<?php } ?>
<?php if ($Page->accept_plus_discount->Visible) { // accept_plus_discount ?>
        <th data-name="accept_plus_discount" class="<?= $Page->accept_plus_discount->headerCellClass() ?>"><div id="elh_location_accept_plus_discount" class="location_accept_plus_discount"><?= $Page->renderSort($Page->accept_plus_discount) ?></div></th>
<?php } ?>
<?php if ($Page->breakfast->Visible) { // breakfast ?>
        <th data-name="breakfast" class="<?= $Page->breakfast->headerCellClass() ?>"><div id="elh_location_breakfast" class="location_breakfast"><?= $Page->renderSort($Page->breakfast) ?></div></th>
<?php } ?>
<?php if ($Page->lunch->Visible) { // lunch ?>
        <th data-name="lunch" class="<?= $Page->lunch->headerCellClass() ?>"><div id="elh_location_lunch" class="location_lunch"><?= $Page->renderSort($Page->lunch) ?></div></th>
<?php } ?>
<?php if ($Page->dinner->Visible) { // dinner ?>
        <th data-name="dinner" class="<?= $Page->dinner->headerCellClass() ?>"><div id="elh_location_dinner" class="location_dinner"><?= $Page->renderSort($Page->dinner) ?></div></th>
<?php } ?>
<?php if ($Page->continuous->Visible) { // continuous ?>
        <th data-name="continuous" class="<?= $Page->continuous->headerCellClass() ?>"><div id="elh_location_continuous" class="location_continuous"><?= $Page->renderSort($Page->continuous) ?></div></th>
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
} elseif (!$Page->AllowAddDeleteRow && $Page->StopRecord == 0) {
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

        // Set up row id / data-rowindex
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_location", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->location_id->Visible) { // location_id ?>
        <td data-name="location_id" <?= $Page->location_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_location_location_id">
<span<?= $Page->location_id->viewAttributes() ?>>
<?= $Page->location_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->group_id->Visible) { // group_id ?>
        <td data-name="group_id" <?= $Page->group_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_location_group_id">
<span<?= $Page->group_id->viewAttributes() ?>>
<?= $Page->group_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->group_hours->Visible) { // group_hours ?>
        <td data-name="group_hours" <?= $Page->group_hours->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_location_group_hours">
<span<?= $Page->group_hours->viewAttributes() ?>>
<?= $Page->group_hours->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->old_id->Visible) { // old_id ?>
        <td data-name="old_id" <?= $Page->old_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_location_old_id">
<span<?= $Page->old_id->viewAttributes() ?>>
<?= $Page->old_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->accept_plus_discount->Visible) { // accept_plus_discount ?>
        <td data-name="accept_plus_discount" <?= $Page->accept_plus_discount->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_location_accept_plus_discount">
<span<?= $Page->accept_plus_discount->viewAttributes() ?>>
<?= $Page->accept_plus_discount->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->breakfast->Visible) { // breakfast ?>
        <td data-name="breakfast" <?= $Page->breakfast->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_location_breakfast">
<span<?= $Page->breakfast->viewAttributes() ?>>
<?= $Page->breakfast->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->lunch->Visible) { // lunch ?>
        <td data-name="lunch" <?= $Page->lunch->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_location_lunch">
<span<?= $Page->lunch->viewAttributes() ?>>
<?= $Page->lunch->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->dinner->Visible) { // dinner ?>
        <td data-name="dinner" <?= $Page->dinner->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_location_dinner">
<span<?= $Page->dinner->viewAttributes() ?>>
<?= $Page->dinner->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->continuous->Visible) { // continuous ?>
        <td data-name="continuous" <?= $Page->continuous->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_location_continuous">
<span<?= $Page->continuous->viewAttributes() ?>>
<?= $Page->continuous->getViewValue() ?></span>
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
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?= CurrentPageUrl() ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Page->TotalRecords == 0 && !$Page->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("location");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
