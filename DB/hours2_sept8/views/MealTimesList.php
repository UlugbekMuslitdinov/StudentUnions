<?php

namespace PHPMaker2022\project3;

// Page object
$MealTimesList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { meal_times: currentTable } });
var currentForm, currentPageID;
var fmeal_timeslist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmeal_timeslist = new ew.Form("fmeal_timeslist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fmeal_timeslist;
    fmeal_timeslist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fmeal_timeslist");
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> meal_times">
<form name="fmeal_timeslist" id="fmeal_timeslist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="meal_times">
<div id="gmp_meal_times" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_meal_timeslist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_meal_times_id" class="meal_times_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->location_id->Visible) { // location_id ?>
        <th data-name="location_id" class="<?= $Page->location_id->headerCellClass() ?>"><div id="elh_meal_times_location_id" class="meal_times_location_id"><?= $Page->renderFieldHeader($Page->location_id) ?></div></th>
<?php } ?>
<?php if ($Page->meal_details_id->Visible) { // meal_details_id ?>
        <th data-name="meal_details_id" class="<?= $Page->meal_details_id->headerCellClass() ?>"><div id="elh_meal_times_meal_details_id" class="meal_times_meal_details_id"><?= $Page->renderFieldHeader($Page->meal_details_id) ?></div></th>
<?php } ?>
<?php if ($Page->startm->Visible) { // startm ?>
        <th data-name="startm" class="<?= $Page->startm->headerCellClass() ?>"><div id="elh_meal_times_startm" class="meal_times_startm"><?= $Page->renderFieldHeader($Page->startm) ?></div></th>
<?php } ?>
<?php if ($Page->endm->Visible) { // endm ?>
        <th data-name="endm" class="<?= $Page->endm->headerCellClass() ?>"><div id="elh_meal_times_endm" class="meal_times_endm"><?= $Page->renderFieldHeader($Page->endm) ?></div></th>
<?php } ?>
<?php if ($Page->startt->Visible) { // startt ?>
        <th data-name="startt" class="<?= $Page->startt->headerCellClass() ?>"><div id="elh_meal_times_startt" class="meal_times_startt"><?= $Page->renderFieldHeader($Page->startt) ?></div></th>
<?php } ?>
<?php if ($Page->endt->Visible) { // endt ?>
        <th data-name="endt" class="<?= $Page->endt->headerCellClass() ?>"><div id="elh_meal_times_endt" class="meal_times_endt"><?= $Page->renderFieldHeader($Page->endt) ?></div></th>
<?php } ?>
<?php if ($Page->startw->Visible) { // startw ?>
        <th data-name="startw" class="<?= $Page->startw->headerCellClass() ?>"><div id="elh_meal_times_startw" class="meal_times_startw"><?= $Page->renderFieldHeader($Page->startw) ?></div></th>
<?php } ?>
<?php if ($Page->endw->Visible) { // endw ?>
        <th data-name="endw" class="<?= $Page->endw->headerCellClass() ?>"><div id="elh_meal_times_endw" class="meal_times_endw"><?= $Page->renderFieldHeader($Page->endw) ?></div></th>
<?php } ?>
<?php if ($Page->startr->Visible) { // startr ?>
        <th data-name="startr" class="<?= $Page->startr->headerCellClass() ?>"><div id="elh_meal_times_startr" class="meal_times_startr"><?= $Page->renderFieldHeader($Page->startr) ?></div></th>
<?php } ?>
<?php if ($Page->endr->Visible) { // endr ?>
        <th data-name="endr" class="<?= $Page->endr->headerCellClass() ?>"><div id="elh_meal_times_endr" class="meal_times_endr"><?= $Page->renderFieldHeader($Page->endr) ?></div></th>
<?php } ?>
<?php if ($Page->startf->Visible) { // startf ?>
        <th data-name="startf" class="<?= $Page->startf->headerCellClass() ?>"><div id="elh_meal_times_startf" class="meal_times_startf"><?= $Page->renderFieldHeader($Page->startf) ?></div></th>
<?php } ?>
<?php if ($Page->endf->Visible) { // endf ?>
        <th data-name="endf" class="<?= $Page->endf->headerCellClass() ?>"><div id="elh_meal_times_endf" class="meal_times_endf"><?= $Page->renderFieldHeader($Page->endf) ?></div></th>
<?php } ?>
<?php if ($Page->starts->Visible) { // starts ?>
        <th data-name="starts" class="<?= $Page->starts->headerCellClass() ?>"><div id="elh_meal_times_starts" class="meal_times_starts"><?= $Page->renderFieldHeader($Page->starts) ?></div></th>
<?php } ?>
<?php if ($Page->ends->Visible) { // ends ?>
        <th data-name="ends" class="<?= $Page->ends->headerCellClass() ?>"><div id="elh_meal_times_ends" class="meal_times_ends"><?= $Page->renderFieldHeader($Page->ends) ?></div></th>
<?php } ?>
<?php if ($Page->startu->Visible) { // startu ?>
        <th data-name="startu" class="<?= $Page->startu->headerCellClass() ?>"><div id="elh_meal_times_startu" class="meal_times_startu"><?= $Page->renderFieldHeader($Page->startu) ?></div></th>
<?php } ?>
<?php if ($Page->endu->Visible) { // endu ?>
        <th data-name="endu" class="<?= $Page->endu->headerCellClass() ?>"><div id="elh_meal_times_endu" class="meal_times_endu"><?= $Page->renderFieldHeader($Page->endu) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_meal_times",
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
<span id="el<?= $Page->RowCount ?>_meal_times_id" class="el_meal_times_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->location_id->Visible) { // location_id ?>
        <td data-name="location_id"<?= $Page->location_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_meal_times_location_id" class="el_meal_times_location_id">
<span<?= $Page->location_id->viewAttributes() ?>>
<?= $Page->location_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->meal_details_id->Visible) { // meal_details_id ?>
        <td data-name="meal_details_id"<?= $Page->meal_details_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_meal_times_meal_details_id" class="el_meal_times_meal_details_id">
<span<?= $Page->meal_details_id->viewAttributes() ?>>
<?= $Page->meal_details_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->startm->Visible) { // startm ?>
        <td data-name="startm"<?= $Page->startm->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_meal_times_startm" class="el_meal_times_startm">
<span<?= $Page->startm->viewAttributes() ?>>
<?= $Page->startm->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->endm->Visible) { // endm ?>
        <td data-name="endm"<?= $Page->endm->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_meal_times_endm" class="el_meal_times_endm">
<span<?= $Page->endm->viewAttributes() ?>>
<?= $Page->endm->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->startt->Visible) { // startt ?>
        <td data-name="startt"<?= $Page->startt->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_meal_times_startt" class="el_meal_times_startt">
<span<?= $Page->startt->viewAttributes() ?>>
<?= $Page->startt->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->endt->Visible) { // endt ?>
        <td data-name="endt"<?= $Page->endt->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_meal_times_endt" class="el_meal_times_endt">
<span<?= $Page->endt->viewAttributes() ?>>
<?= $Page->endt->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->startw->Visible) { // startw ?>
        <td data-name="startw"<?= $Page->startw->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_meal_times_startw" class="el_meal_times_startw">
<span<?= $Page->startw->viewAttributes() ?>>
<?= $Page->startw->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->endw->Visible) { // endw ?>
        <td data-name="endw"<?= $Page->endw->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_meal_times_endw" class="el_meal_times_endw">
<span<?= $Page->endw->viewAttributes() ?>>
<?= $Page->endw->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->startr->Visible) { // startr ?>
        <td data-name="startr"<?= $Page->startr->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_meal_times_startr" class="el_meal_times_startr">
<span<?= $Page->startr->viewAttributes() ?>>
<?= $Page->startr->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->endr->Visible) { // endr ?>
        <td data-name="endr"<?= $Page->endr->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_meal_times_endr" class="el_meal_times_endr">
<span<?= $Page->endr->viewAttributes() ?>>
<?= $Page->endr->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->startf->Visible) { // startf ?>
        <td data-name="startf"<?= $Page->startf->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_meal_times_startf" class="el_meal_times_startf">
<span<?= $Page->startf->viewAttributes() ?>>
<?= $Page->startf->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->endf->Visible) { // endf ?>
        <td data-name="endf"<?= $Page->endf->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_meal_times_endf" class="el_meal_times_endf">
<span<?= $Page->endf->viewAttributes() ?>>
<?= $Page->endf->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->starts->Visible) { // starts ?>
        <td data-name="starts"<?= $Page->starts->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_meal_times_starts" class="el_meal_times_starts">
<span<?= $Page->starts->viewAttributes() ?>>
<?= $Page->starts->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ends->Visible) { // ends ?>
        <td data-name="ends"<?= $Page->ends->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_meal_times_ends" class="el_meal_times_ends">
<span<?= $Page->ends->viewAttributes() ?>>
<?= $Page->ends->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->startu->Visible) { // startu ?>
        <td data-name="startu"<?= $Page->startu->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_meal_times_startu" class="el_meal_times_startu">
<span<?= $Page->startu->viewAttributes() ?>>
<?= $Page->startu->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->endu->Visible) { // endu ?>
        <td data-name="endu"<?= $Page->endu->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_meal_times_endu" class="el_meal_times_endu">
<span<?= $Page->endu->viewAttributes() ?>>
<?= $Page->endu->getViewValue() ?></span>
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
    ew.addEventHandlers("meal_times");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
