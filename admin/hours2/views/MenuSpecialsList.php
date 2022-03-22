<?php

namespace PHPMaker2021\project2;

// Page object
$MenuSpecialsList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fmenu_specialslist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fmenu_specialslist = currentForm = new ew.Form("fmenu_specialslist", "list");
    fmenu_specialslist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fmenu_specialslist");
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> menu_specials">
<form name="fmenu_specialslist" id="fmenu_specialslist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="menu_specials">
<div id="gmp_menu_specials" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_menu_specialslist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_menu_specials_id" class="menu_specials_id"><?= $Page->renderSort($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->menu_special_price->Visible) { // menu_special_price ?>
        <th data-name="menu_special_price" class="<?= $Page->menu_special_price->headerCellClass() ?>"><div id="elh_menu_specials_menu_special_price" class="menu_specials_menu_special_price"><?= $Page->renderSort($Page->menu_special_price) ?></div></th>
<?php } ?>
<?php if ($Page->menu_restaurant->Visible) { // menu_restaurant ?>
        <th data-name="menu_restaurant" class="<?= $Page->menu_restaurant->headerCellClass() ?>"><div id="elh_menu_specials_menu_restaurant" class="menu_specials_menu_restaurant"><?= $Page->renderSort($Page->menu_restaurant) ?></div></th>
<?php } ?>
<?php if ($Page->menu_category->Visible) { // menu_category ?>
        <th data-name="menu_category" class="<?= $Page->menu_category->headerCellClass() ?>"><div id="elh_menu_specials_menu_category" class="menu_specials_menu_category"><?= $Page->renderSort($Page->menu_category) ?></div></th>
<?php } ?>
<?php if ($Page->menu_special_startdate->Visible) { // menu_special_startdate ?>
        <th data-name="menu_special_startdate" class="<?= $Page->menu_special_startdate->headerCellClass() ?>"><div id="elh_menu_specials_menu_special_startdate" class="menu_specials_menu_special_startdate"><?= $Page->renderSort($Page->menu_special_startdate) ?></div></th>
<?php } ?>
<?php if ($Page->menu_special_enddate->Visible) { // menu_special_enddate ?>
        <th data-name="menu_special_enddate" class="<?= $Page->menu_special_enddate->headerCellClass() ?>"><div id="elh_menu_specials_menu_special_enddate" class="menu_specials_menu_special_enddate"><?= $Page->renderSort($Page->menu_special_enddate) ?></div></th>
<?php } ?>
<?php if ($Page->menu_special_replace_item->Visible) { // menu_special_replace_item ?>
        <th data-name="menu_special_replace_item" class="<?= $Page->menu_special_replace_item->headerCellClass() ?>"><div id="elh_menu_specials_menu_special_replace_item" class="menu_specials_menu_special_replace_item"><?= $Page->renderSort($Page->menu_special_replace_item) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_menu_specials", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_menu_specials_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->menu_special_price->Visible) { // menu_special_price ?>
        <td data-name="menu_special_price" <?= $Page->menu_special_price->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_menu_specials_menu_special_price">
<span<?= $Page->menu_special_price->viewAttributes() ?>>
<?= $Page->menu_special_price->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->menu_restaurant->Visible) { // menu_restaurant ?>
        <td data-name="menu_restaurant" <?= $Page->menu_restaurant->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_menu_specials_menu_restaurant">
<span<?= $Page->menu_restaurant->viewAttributes() ?>>
<?= $Page->menu_restaurant->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->menu_category->Visible) { // menu_category ?>
        <td data-name="menu_category" <?= $Page->menu_category->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_menu_specials_menu_category">
<span<?= $Page->menu_category->viewAttributes() ?>>
<?= $Page->menu_category->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->menu_special_startdate->Visible) { // menu_special_startdate ?>
        <td data-name="menu_special_startdate" <?= $Page->menu_special_startdate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_menu_specials_menu_special_startdate">
<span<?= $Page->menu_special_startdate->viewAttributes() ?>>
<?= $Page->menu_special_startdate->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->menu_special_enddate->Visible) { // menu_special_enddate ?>
        <td data-name="menu_special_enddate" <?= $Page->menu_special_enddate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_menu_specials_menu_special_enddate">
<span<?= $Page->menu_special_enddate->viewAttributes() ?>>
<?= $Page->menu_special_enddate->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->menu_special_replace_item->Visible) { // menu_special_replace_item ?>
        <td data-name="menu_special_replace_item" <?= $Page->menu_special_replace_item->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_menu_specials_menu_special_replace_item">
<span<?= $Page->menu_special_replace_item->viewAttributes() ?>>
<?= $Page->menu_special_replace_item->getViewValue() ?></span>
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
    ew.addEventHandlers("menu_specials");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
