<?php

namespace PHPMaker2021\project3;

// Page object
$SequentialfeedList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fsequentialfeedlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fsequentialfeedlist = currentForm = new ew.Form("fsequentialfeedlist", "list");
    fsequentialfeedlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fsequentialfeedlist");
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> sequentialfeed">
<form name="fsequentialfeedlist" id="fsequentialfeedlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="sequentialfeed">
<div id="gmp_sequentialfeed" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_sequentialfeedlist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_sequentialfeed_id" class="sequentialfeed_id"><?= $Page->renderSort($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->resourceID->Visible) { // resourceID ?>
        <th data-name="resourceID" class="<?= $Page->resourceID->headerCellClass() ?>"><div id="elh_sequentialfeed_resourceID" class="sequentialfeed_resourceID"><?= $Page->renderSort($Page->resourceID) ?></div></th>
<?php } ?>
<?php if ($Page->displayBlockID->Visible) { // displayBlockID ?>
        <th data-name="displayBlockID" class="<?= $Page->displayBlockID->headerCellClass() ?>"><div id="elh_sequentialfeed_displayBlockID" class="sequentialfeed_displayBlockID"><?= $Page->renderSort($Page->displayBlockID) ?></div></th>
<?php } ?>
<?php if ($Page->startDate->Visible) { // startDate ?>
        <th data-name="startDate" class="<?= $Page->startDate->headerCellClass() ?>"><div id="elh_sequentialfeed_startDate" class="sequentialfeed_startDate"><?= $Page->renderSort($Page->startDate) ?></div></th>
<?php } ?>
<?php if ($Page->endDate->Visible) { // endDate ?>
        <th data-name="endDate" class="<?= $Page->endDate->headerCellClass() ?>"><div id="elh_sequentialfeed_endDate" class="sequentialfeed_endDate"><?= $Page->renderSort($Page->endDate) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_sequentialfeed", "data-rowtype" => $Page->RowType]);

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
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_sequentialfeed_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->resourceID->Visible) { // resourceID ?>
        <td data-name="resourceID" <?= $Page->resourceID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_sequentialfeed_resourceID">
<span<?= $Page->resourceID->viewAttributes() ?>>
<?= $Page->resourceID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->displayBlockID->Visible) { // displayBlockID ?>
        <td data-name="displayBlockID" <?= $Page->displayBlockID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_sequentialfeed_displayBlockID">
<span<?= $Page->displayBlockID->viewAttributes() ?>>
<?= $Page->displayBlockID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->startDate->Visible) { // startDate ?>
        <td data-name="startDate" <?= $Page->startDate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_sequentialfeed_startDate">
<span<?= $Page->startDate->viewAttributes() ?>>
<?= $Page->startDate->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->endDate->Visible) { // endDate ?>
        <td data-name="endDate" <?= $Page->endDate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_sequentialfeed_endDate">
<span<?= $Page->endDate->viewAttributes() ?>>
<?= $Page->endDate->getViewValue() ?></span>
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
    ew.addEventHandlers("sequentialfeed");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
