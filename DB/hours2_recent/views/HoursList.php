<?php

namespace PHPMaker2022\project2;

// Page object
$HoursList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { hours: currentTable } });
var currentForm, currentPageID;
var fhourslist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fhourslist = new ew.Form("fhourslist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fhourslist;
    fhourslist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fhourslist");
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> hours">
<form name="fhourslist" id="fhourslist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="hours">
<div id="gmp_hours" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_hourslist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="location_id" class="<?= $Page->location_id->headerCellClass() ?>"><div id="elh_hours_location_id" class="hours_location_id"><?= $Page->renderFieldHeader($Page->location_id) ?></div></th>
<?php } ?>
<?php if ($Page->openm->Visible) { // openm ?>
        <th data-name="openm" class="<?= $Page->openm->headerCellClass() ?>"><div id="elh_hours_openm" class="hours_openm"><?= $Page->renderFieldHeader($Page->openm) ?></div></th>
<?php } ?>
<?php if ($Page->closem->Visible) { // closem ?>
        <th data-name="closem" class="<?= $Page->closem->headerCellClass() ?>"><div id="elh_hours_closem" class="hours_closem"><?= $Page->renderFieldHeader($Page->closem) ?></div></th>
<?php } ?>
<?php if ($Page->opent->Visible) { // opent ?>
        <th data-name="opent" class="<?= $Page->opent->headerCellClass() ?>"><div id="elh_hours_opent" class="hours_opent"><?= $Page->renderFieldHeader($Page->opent) ?></div></th>
<?php } ?>
<?php if ($Page->closet->Visible) { // closet ?>
        <th data-name="closet" class="<?= $Page->closet->headerCellClass() ?>"><div id="elh_hours_closet" class="hours_closet"><?= $Page->renderFieldHeader($Page->closet) ?></div></th>
<?php } ?>
<?php if ($Page->openw->Visible) { // openw ?>
        <th data-name="openw" class="<?= $Page->openw->headerCellClass() ?>"><div id="elh_hours_openw" class="hours_openw"><?= $Page->renderFieldHeader($Page->openw) ?></div></th>
<?php } ?>
<?php if ($Page->closew->Visible) { // closew ?>
        <th data-name="closew" class="<?= $Page->closew->headerCellClass() ?>"><div id="elh_hours_closew" class="hours_closew"><?= $Page->renderFieldHeader($Page->closew) ?></div></th>
<?php } ?>
<?php if ($Page->openr->Visible) { // openr ?>
        <th data-name="openr" class="<?= $Page->openr->headerCellClass() ?>"><div id="elh_hours_openr" class="hours_openr"><?= $Page->renderFieldHeader($Page->openr) ?></div></th>
<?php } ?>
<?php if ($Page->closer->Visible) { // closer ?>
        <th data-name="closer" class="<?= $Page->closer->headerCellClass() ?>"><div id="elh_hours_closer" class="hours_closer"><?= $Page->renderFieldHeader($Page->closer) ?></div></th>
<?php } ?>
<?php if ($Page->openf->Visible) { // openf ?>
        <th data-name="openf" class="<?= $Page->openf->headerCellClass() ?>"><div id="elh_hours_openf" class="hours_openf"><?= $Page->renderFieldHeader($Page->openf) ?></div></th>
<?php } ?>
<?php if ($Page->closef->Visible) { // closef ?>
        <th data-name="closef" class="<?= $Page->closef->headerCellClass() ?>"><div id="elh_hours_closef" class="hours_closef"><?= $Page->renderFieldHeader($Page->closef) ?></div></th>
<?php } ?>
<?php if ($Page->opens->Visible) { // opens ?>
        <th data-name="opens" class="<?= $Page->opens->headerCellClass() ?>"><div id="elh_hours_opens" class="hours_opens"><?= $Page->renderFieldHeader($Page->opens) ?></div></th>
<?php } ?>
<?php if ($Page->closes->Visible) { // closes ?>
        <th data-name="closes" class="<?= $Page->closes->headerCellClass() ?>"><div id="elh_hours_closes" class="hours_closes"><?= $Page->renderFieldHeader($Page->closes) ?></div></th>
<?php } ?>
<?php if ($Page->openu->Visible) { // openu ?>
        <th data-name="openu" class="<?= $Page->openu->headerCellClass() ?>"><div id="elh_hours_openu" class="hours_openu"><?= $Page->renderFieldHeader($Page->openu) ?></div></th>
<?php } ?>
<?php if ($Page->closeu->Visible) { // closeu ?>
        <th data-name="closeu" class="<?= $Page->closeu->headerCellClass() ?>"><div id="elh_hours_closeu" class="hours_closeu"><?= $Page->renderFieldHeader($Page->closeu) ?></div></th>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
        <th data-name="type" class="<?= $Page->type->headerCellClass() ?>"><div id="elh_hours_type" class="hours_type"><?= $Page->renderFieldHeader($Page->type) ?></div></th>
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_hours_id" class="hours_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_hours",
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
    <?php if ($Page->location_id->Visible) { // location_id ?>
        <td data-name="location_id"<?= $Page->location_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_location_id" class="el_hours_location_id">
<span<?= $Page->location_id->viewAttributes() ?>>
<?= $Page->location_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->openm->Visible) { // openm ?>
        <td data-name="openm"<?= $Page->openm->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_openm" class="el_hours_openm">
<span<?= $Page->openm->viewAttributes() ?>>
<?= $Page->openm->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->closem->Visible) { // closem ?>
        <td data-name="closem"<?= $Page->closem->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_closem" class="el_hours_closem">
<span<?= $Page->closem->viewAttributes() ?>>
<?= $Page->closem->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->opent->Visible) { // opent ?>
        <td data-name="opent"<?= $Page->opent->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_opent" class="el_hours_opent">
<span<?= $Page->opent->viewAttributes() ?>>
<?= $Page->opent->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->closet->Visible) { // closet ?>
        <td data-name="closet"<?= $Page->closet->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_closet" class="el_hours_closet">
<span<?= $Page->closet->viewAttributes() ?>>
<?= $Page->closet->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->openw->Visible) { // openw ?>
        <td data-name="openw"<?= $Page->openw->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_openw" class="el_hours_openw">
<span<?= $Page->openw->viewAttributes() ?>>
<?= $Page->openw->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->closew->Visible) { // closew ?>
        <td data-name="closew"<?= $Page->closew->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_closew" class="el_hours_closew">
<span<?= $Page->closew->viewAttributes() ?>>
<?= $Page->closew->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->openr->Visible) { // openr ?>
        <td data-name="openr"<?= $Page->openr->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_openr" class="el_hours_openr">
<span<?= $Page->openr->viewAttributes() ?>>
<?= $Page->openr->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->closer->Visible) { // closer ?>
        <td data-name="closer"<?= $Page->closer->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_closer" class="el_hours_closer">
<span<?= $Page->closer->viewAttributes() ?>>
<?= $Page->closer->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->openf->Visible) { // openf ?>
        <td data-name="openf"<?= $Page->openf->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_openf" class="el_hours_openf">
<span<?= $Page->openf->viewAttributes() ?>>
<?= $Page->openf->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->closef->Visible) { // closef ?>
        <td data-name="closef"<?= $Page->closef->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_closef" class="el_hours_closef">
<span<?= $Page->closef->viewAttributes() ?>>
<?= $Page->closef->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->opens->Visible) { // opens ?>
        <td data-name="opens"<?= $Page->opens->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_opens" class="el_hours_opens">
<span<?= $Page->opens->viewAttributes() ?>>
<?= $Page->opens->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->closes->Visible) { // closes ?>
        <td data-name="closes"<?= $Page->closes->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_closes" class="el_hours_closes">
<span<?= $Page->closes->viewAttributes() ?>>
<?= $Page->closes->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->openu->Visible) { // openu ?>
        <td data-name="openu"<?= $Page->openu->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_openu" class="el_hours_openu">
<span<?= $Page->openu->viewAttributes() ?>>
<?= $Page->openu->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->closeu->Visible) { // closeu ?>
        <td data-name="closeu"<?= $Page->closeu->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_closeu" class="el_hours_closeu">
<span<?= $Page->closeu->viewAttributes() ?>>
<?= $Page->closeu->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->type->Visible) { // type ?>
        <td data-name="type"<?= $Page->type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_type" class="el_hours_type">
<span<?= $Page->type->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_type_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->type->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->type->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_type_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->id->Visible) { // id ?>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_id" class="el_hours_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
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
    ew.addEventHandlers("hours");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
