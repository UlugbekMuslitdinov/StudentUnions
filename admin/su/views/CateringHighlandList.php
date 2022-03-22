<?php

namespace PHPMaker2021\project1;

// Page object
$CateringHighlandList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fcatering_highlandlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fcatering_highlandlist = currentForm = new ew.Form("fcatering_highlandlist", "list");
    fcatering_highlandlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fcatering_highlandlist");
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> catering_highland">
<form name="fcatering_highlandlist" id="fcatering_highlandlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="catering_highland">
<div id="gmp_catering_highland" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_catering_highlandlist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_catering_highland_id" class="catering_highland_id"><?= $Page->renderSort($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->catering_id->Visible) { // catering_id ?>
        <th data-name="catering_id" class="<?= $Page->catering_id->headerCellClass() ?>"><div id="elh_catering_highland_catering_id" class="catering_highland_catering_id"><?= $Page->renderSort($Page->catering_id) ?></div></th>
<?php } ?>
<?php if ($Page->burrito_12->Visible) { // burrito_12 ?>
        <th data-name="burrito_12" class="<?= $Page->burrito_12->headerCellClass() ?>"><div id="elh_catering_highland_burrito_12" class="catering_highland_burrito_12"><?= $Page->renderSort($Page->burrito_12) ?></div></th>
<?php } ?>
<?php if ($Page->burrito_8->Visible) { // burrito_8 ?>
        <th data-name="burrito_8" class="<?= $Page->burrito_8->headerCellClass() ?>"><div id="elh_catering_highland_burrito_8" class="catering_highland_burrito_8"><?= $Page->renderSort($Page->burrito_8) ?></div></th>
<?php } ?>
<?php if ($Page->extra_chips->Visible) { // extra_chips ?>
        <th data-name="extra_chips" class="<?= $Page->extra_chips->headerCellClass() ?>"><div id="elh_catering_highland_extra_chips" class="catering_highland_extra_chips"><?= $Page->renderSort($Page->extra_chips) ?></div></th>
<?php } ?>
<?php if ($Page->extra_salsa->Visible) { // extra_salsa ?>
        <th data-name="extra_salsa" class="<?= $Page->extra_salsa->headerCellClass() ?>"><div id="elh_catering_highland_extra_salsa" class="catering_highland_extra_salsa"><?= $Page->renderSort($Page->extra_salsa) ?></div></th>
<?php } ?>
<?php if ($Page->extra_sourcream->Visible) { // extra_sourcream ?>
        <th data-name="extra_sourcream" class="<?= $Page->extra_sourcream->headerCellClass() ?>"><div id="elh_catering_highland_extra_sourcream" class="catering_highland_extra_sourcream"><?= $Page->renderSort($Page->extra_sourcream) ?></div></th>
<?php } ?>
<?php if ($Page->extra_guacamole->Visible) { // extra_guacamole ?>
        <th data-name="extra_guacamole" class="<?= $Page->extra_guacamole->headerCellClass() ?>"><div id="elh_catering_highland_extra_guacamole" class="catering_highland_extra_guacamole"><?= $Page->renderSort($Page->extra_guacamole) ?></div></th>
<?php } ?>
<?php if ($Page->upgrade->Visible) { // upgrade ?>
        <th data-name="upgrade" class="<?= $Page->upgrade->headerCellClass() ?>"><div id="elh_catering_highland_upgrade" class="catering_highland_upgrade"><?= $Page->renderSort($Page->upgrade) ?></div></th>
<?php } ?>
<?php if ($Page->coke->Visible) { // coke ?>
        <th data-name="coke" class="<?= $Page->coke->headerCellClass() ?>"><div id="elh_catering_highland_coke" class="catering_highland_coke"><?= $Page->renderSort($Page->coke) ?></div></th>
<?php } ?>
<?php if ($Page->diet_coke->Visible) { // diet_coke ?>
        <th data-name="diet_coke" class="<?= $Page->diet_coke->headerCellClass() ?>"><div id="elh_catering_highland_diet_coke" class="catering_highland_diet_coke"><?= $Page->renderSort($Page->diet_coke) ?></div></th>
<?php } ?>
<?php if ($Page->sprite->Visible) { // sprite ?>
        <th data-name="sprite" class="<?= $Page->sprite->headerCellClass() ?>"><div id="elh_catering_highland_sprite" class="catering_highland_sprite"><?= $Page->renderSort($Page->sprite) ?></div></th>
<?php } ?>
<?php if ($Page->fanta->Visible) { // fanta ?>
        <th data-name="fanta" class="<?= $Page->fanta->headerCellClass() ?>"><div id="elh_catering_highland_fanta" class="catering_highland_fanta"><?= $Page->renderSort($Page->fanta) ?></div></th>
<?php } ?>
<?php if ($Page->water->Visible) { // water ?>
        <th data-name="water" class="<?= $Page->water->headerCellClass() ?>"><div id="elh_catering_highland_water" class="catering_highland_water"><?= $Page->renderSort($Page->water) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_catering_highland", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_catering_highland_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->catering_id->Visible) { // catering_id ?>
        <td data-name="catering_id" <?= $Page->catering_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_catering_id">
<span<?= $Page->catering_id->viewAttributes() ?>>
<?= $Page->catering_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->burrito_12->Visible) { // burrito_12 ?>
        <td data-name="burrito_12" <?= $Page->burrito_12->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_burrito_12">
<span<?= $Page->burrito_12->viewAttributes() ?>>
<?= $Page->burrito_12->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->burrito_8->Visible) { // burrito_8 ?>
        <td data-name="burrito_8" <?= $Page->burrito_8->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_burrito_8">
<span<?= $Page->burrito_8->viewAttributes() ?>>
<?= $Page->burrito_8->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->extra_chips->Visible) { // extra_chips ?>
        <td data-name="extra_chips" <?= $Page->extra_chips->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_extra_chips">
<span<?= $Page->extra_chips->viewAttributes() ?>>
<?= $Page->extra_chips->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->extra_salsa->Visible) { // extra_salsa ?>
        <td data-name="extra_salsa" <?= $Page->extra_salsa->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_extra_salsa">
<span<?= $Page->extra_salsa->viewAttributes() ?>>
<?= $Page->extra_salsa->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->extra_sourcream->Visible) { // extra_sourcream ?>
        <td data-name="extra_sourcream" <?= $Page->extra_sourcream->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_extra_sourcream">
<span<?= $Page->extra_sourcream->viewAttributes() ?>>
<?= $Page->extra_sourcream->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->extra_guacamole->Visible) { // extra_guacamole ?>
        <td data-name="extra_guacamole" <?= $Page->extra_guacamole->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_extra_guacamole">
<span<?= $Page->extra_guacamole->viewAttributes() ?>>
<?= $Page->extra_guacamole->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->upgrade->Visible) { // upgrade ?>
        <td data-name="upgrade" <?= $Page->upgrade->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_upgrade">
<span<?= $Page->upgrade->viewAttributes() ?>>
<?= $Page->upgrade->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->coke->Visible) { // coke ?>
        <td data-name="coke" <?= $Page->coke->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_coke">
<span<?= $Page->coke->viewAttributes() ?>>
<?= $Page->coke->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->diet_coke->Visible) { // diet_coke ?>
        <td data-name="diet_coke" <?= $Page->diet_coke->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_diet_coke">
<span<?= $Page->diet_coke->viewAttributes() ?>>
<?= $Page->diet_coke->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sprite->Visible) { // sprite ?>
        <td data-name="sprite" <?= $Page->sprite->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_sprite">
<span<?= $Page->sprite->viewAttributes() ?>>
<?= $Page->sprite->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->fanta->Visible) { // fanta ?>
        <td data-name="fanta" <?= $Page->fanta->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_fanta">
<span<?= $Page->fanta->viewAttributes() ?>>
<?= $Page->fanta->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->water->Visible) { // water ?>
        <td data-name="water" <?= $Page->water->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_water">
<span<?= $Page->water->viewAttributes() ?>>
<?= $Page->water->getViewValue() ?></span>
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
    ew.addEventHandlers("catering_highland");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
