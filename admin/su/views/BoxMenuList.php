<?php

namespace PHPMaker2021\project1;

// Page object
$BoxMenuList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fbox_menulist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fbox_menulist = currentForm = new ew.Form("fbox_menulist", "list");
    fbox_menulist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fbox_menulist");
});
var fbox_menulistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fbox_menulistsrch = currentSearchForm = new ew.Form("fbox_menulistsrch");

    // Dynamic selection lists

    // Filters
    fbox_menulistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fbox_menulistsrch");
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
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php if (!$Page->isExport() && !$Page->CurrentAction) { ?>
<form name="fbox_menulistsrch" id="fbox_menulistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl() ?>">
<div id="fbox_menulistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="box_menu">
    <div class="ew-extended-search">
<div id="xsr_<?= $Page->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
    <div class="ew-quick-search input-group">
        <input type="text" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>">
        <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
        <div class="input-group-append">
            <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
            <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span></button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?= $Language->phrase("QuickSearchAuto") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?= $Language->phrase("QuickSearchExact") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?= $Language->phrase("QuickSearchAll") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?= $Language->phrase("QuickSearchAny") ?></a>
            </div>
        </div>
    </div>
</div>
    </div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> box_menu">
<form name="fbox_menulist" id="fbox_menulist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="box_menu">
<div id="gmp_box_menu" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_box_menulist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_box_menu_id" class="box_menu_id"><?= $Page->renderSort($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->date->Visible) { // date ?>
        <th data-name="date" class="<?= $Page->date->headerCellClass() ?>"><div id="elh_box_menu_date" class="box_menu_date"><?= $Page->renderSort($Page->date) ?></div></th>
<?php } ?>
<?php if ($Page->day->Visible) { // day ?>
        <th data-name="day" class="<?= $Page->day->headerCellClass() ?>"><div id="elh_box_menu_day" class="box_menu_day"><?= $Page->renderSort($Page->day) ?></div></th>
<?php } ?>
<?php if ($Page->breakfast_1->Visible) { // breakfast_1 ?>
        <th data-name="breakfast_1" class="<?= $Page->breakfast_1->headerCellClass() ?>"><div id="elh_box_menu_breakfast_1" class="box_menu_breakfast_1"><?= $Page->renderSort($Page->breakfast_1) ?></div></th>
<?php } ?>
<?php if ($Page->breakfast_2->Visible) { // breakfast_2 ?>
        <th data-name="breakfast_2" class="<?= $Page->breakfast_2->headerCellClass() ?>"><div id="elh_box_menu_breakfast_2" class="box_menu_breakfast_2"><?= $Page->renderSort($Page->breakfast_2) ?></div></th>
<?php } ?>
<?php if ($Page->breakfast_bag->Visible) { // breakfast_bag ?>
        <th data-name="breakfast_bag" class="<?= $Page->breakfast_bag->headerCellClass() ?>"><div id="elh_box_menu_breakfast_bag" class="box_menu_breakfast_bag"><?= $Page->renderSort($Page->breakfast_bag) ?></div></th>
<?php } ?>
<?php if ($Page->breakfast_bag2->Visible) { // breakfast_bag2 ?>
        <th data-name="breakfast_bag2" class="<?= $Page->breakfast_bag2->headerCellClass() ?>"><div id="elh_box_menu_breakfast_bag2" class="box_menu_breakfast_bag2"><?= $Page->renderSort($Page->breakfast_bag2) ?></div></th>
<?php } ?>
<?php if ($Page->breakfast_beverage->Visible) { // breakfast_beverage ?>
        <th data-name="breakfast_beverage" class="<?= $Page->breakfast_beverage->headerCellClass() ?>"><div id="elh_box_menu_breakfast_beverage" class="box_menu_breakfast_beverage"><?= $Page->renderSort($Page->breakfast_beverage) ?></div></th>
<?php } ?>
<?php if ($Page->lunch_1->Visible) { // lunch_1 ?>
        <th data-name="lunch_1" class="<?= $Page->lunch_1->headerCellClass() ?>"><div id="elh_box_menu_lunch_1" class="box_menu_lunch_1"><?= $Page->renderSort($Page->lunch_1) ?></div></th>
<?php } ?>
<?php if ($Page->lunch_2->Visible) { // lunch_2 ?>
        <th data-name="lunch_2" class="<?= $Page->lunch_2->headerCellClass() ?>"><div id="elh_box_menu_lunch_2" class="box_menu_lunch_2"><?= $Page->renderSort($Page->lunch_2) ?></div></th>
<?php } ?>
<?php if ($Page->lunch_3->Visible) { // lunch_3 ?>
        <th data-name="lunch_3" class="<?= $Page->lunch_3->headerCellClass() ?>"><div id="elh_box_menu_lunch_3" class="box_menu_lunch_3"><?= $Page->renderSort($Page->lunch_3) ?></div></th>
<?php } ?>
<?php if ($Page->lunch_bag->Visible) { // lunch_bag ?>
        <th data-name="lunch_bag" class="<?= $Page->lunch_bag->headerCellClass() ?>"><div id="elh_box_menu_lunch_bag" class="box_menu_lunch_bag"><?= $Page->renderSort($Page->lunch_bag) ?></div></th>
<?php } ?>
<?php if ($Page->lunch_bag2->Visible) { // lunch_bag2 ?>
        <th data-name="lunch_bag2" class="<?= $Page->lunch_bag2->headerCellClass() ?>"><div id="elh_box_menu_lunch_bag2" class="box_menu_lunch_bag2"><?= $Page->renderSort($Page->lunch_bag2) ?></div></th>
<?php } ?>
<?php if ($Page->lunch_bag3->Visible) { // lunch_bag3 ?>
        <th data-name="lunch_bag3" class="<?= $Page->lunch_bag3->headerCellClass() ?>"><div id="elh_box_menu_lunch_bag3" class="box_menu_lunch_bag3"><?= $Page->renderSort($Page->lunch_bag3) ?></div></th>
<?php } ?>
<?php if ($Page->lunch_beverage->Visible) { // lunch_beverage ?>
        <th data-name="lunch_beverage" class="<?= $Page->lunch_beverage->headerCellClass() ?>"><div id="elh_box_menu_lunch_beverage" class="box_menu_lunch_beverage"><?= $Page->renderSort($Page->lunch_beverage) ?></div></th>
<?php } ?>
<?php if ($Page->dinner_1->Visible) { // dinner_1 ?>
        <th data-name="dinner_1" class="<?= $Page->dinner_1->headerCellClass() ?>"><div id="elh_box_menu_dinner_1" class="box_menu_dinner_1"><?= $Page->renderSort($Page->dinner_1) ?></div></th>
<?php } ?>
<?php if ($Page->dinner_2->Visible) { // dinner_2 ?>
        <th data-name="dinner_2" class="<?= $Page->dinner_2->headerCellClass() ?>"><div id="elh_box_menu_dinner_2" class="box_menu_dinner_2"><?= $Page->renderSort($Page->dinner_2) ?></div></th>
<?php } ?>
<?php if ($Page->dinner_3->Visible) { // dinner_3 ?>
        <th data-name="dinner_3" class="<?= $Page->dinner_3->headerCellClass() ?>"><div id="elh_box_menu_dinner_3" class="box_menu_dinner_3"><?= $Page->renderSort($Page->dinner_3) ?></div></th>
<?php } ?>
<?php if ($Page->dinner_bag->Visible) { // dinner_bag ?>
        <th data-name="dinner_bag" class="<?= $Page->dinner_bag->headerCellClass() ?>"><div id="elh_box_menu_dinner_bag" class="box_menu_dinner_bag"><?= $Page->renderSort($Page->dinner_bag) ?></div></th>
<?php } ?>
<?php if ($Page->dinner_bag2->Visible) { // dinner_bag2 ?>
        <th data-name="dinner_bag2" class="<?= $Page->dinner_bag2->headerCellClass() ?>"><div id="elh_box_menu_dinner_bag2" class="box_menu_dinner_bag2"><?= $Page->renderSort($Page->dinner_bag2) ?></div></th>
<?php } ?>
<?php if ($Page->dinner_bag3->Visible) { // dinner_bag3 ?>
        <th data-name="dinner_bag3" class="<?= $Page->dinner_bag3->headerCellClass() ?>"><div id="elh_box_menu_dinner_bag3" class="box_menu_dinner_bag3"><?= $Page->renderSort($Page->dinner_bag3) ?></div></th>
<?php } ?>
<?php if ($Page->dinner_beverage->Visible) { // dinner_beverage ?>
        <th data-name="dinner_beverage" class="<?= $Page->dinner_beverage->headerCellClass() ?>"><div id="elh_box_menu_dinner_beverage" class="box_menu_dinner_beverage"><?= $Page->renderSort($Page->dinner_beverage) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_box_menu", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_box_menu_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date->Visible) { // date ?>
        <td data-name="date" <?= $Page->date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_date">
<span<?= $Page->date->viewAttributes() ?>>
<?= $Page->date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->day->Visible) { // day ?>
        <td data-name="day" <?= $Page->day->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_day">
<span<?= $Page->day->viewAttributes() ?>>
<?= $Page->day->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->breakfast_1->Visible) { // breakfast_1 ?>
        <td data-name="breakfast_1" <?= $Page->breakfast_1->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_breakfast_1">
<span<?= $Page->breakfast_1->viewAttributes() ?>>
<?= $Page->breakfast_1->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->breakfast_2->Visible) { // breakfast_2 ?>
        <td data-name="breakfast_2" <?= $Page->breakfast_2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_breakfast_2">
<span<?= $Page->breakfast_2->viewAttributes() ?>>
<?= $Page->breakfast_2->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->breakfast_bag->Visible) { // breakfast_bag ?>
        <td data-name="breakfast_bag" <?= $Page->breakfast_bag->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_breakfast_bag">
<span<?= $Page->breakfast_bag->viewAttributes() ?>>
<?= $Page->breakfast_bag->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->breakfast_bag2->Visible) { // breakfast_bag2 ?>
        <td data-name="breakfast_bag2" <?= $Page->breakfast_bag2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_breakfast_bag2">
<span<?= $Page->breakfast_bag2->viewAttributes() ?>>
<?= $Page->breakfast_bag2->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->breakfast_beverage->Visible) { // breakfast_beverage ?>
        <td data-name="breakfast_beverage" <?= $Page->breakfast_beverage->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_breakfast_beverage">
<span<?= $Page->breakfast_beverage->viewAttributes() ?>>
<?= $Page->breakfast_beverage->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->lunch_1->Visible) { // lunch_1 ?>
        <td data-name="lunch_1" <?= $Page->lunch_1->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_lunch_1">
<span<?= $Page->lunch_1->viewAttributes() ?>>
<?= $Page->lunch_1->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->lunch_2->Visible) { // lunch_2 ?>
        <td data-name="lunch_2" <?= $Page->lunch_2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_lunch_2">
<span<?= $Page->lunch_2->viewAttributes() ?>>
<?= $Page->lunch_2->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->lunch_3->Visible) { // lunch_3 ?>
        <td data-name="lunch_3" <?= $Page->lunch_3->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_lunch_3">
<span<?= $Page->lunch_3->viewAttributes() ?>>
<?= $Page->lunch_3->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->lunch_bag->Visible) { // lunch_bag ?>
        <td data-name="lunch_bag" <?= $Page->lunch_bag->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_lunch_bag">
<span<?= $Page->lunch_bag->viewAttributes() ?>>
<?= $Page->lunch_bag->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->lunch_bag2->Visible) { // lunch_bag2 ?>
        <td data-name="lunch_bag2" <?= $Page->lunch_bag2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_lunch_bag2">
<span<?= $Page->lunch_bag2->viewAttributes() ?>>
<?= $Page->lunch_bag2->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->lunch_bag3->Visible) { // lunch_bag3 ?>
        <td data-name="lunch_bag3" <?= $Page->lunch_bag3->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_lunch_bag3">
<span<?= $Page->lunch_bag3->viewAttributes() ?>>
<?= $Page->lunch_bag3->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->lunch_beverage->Visible) { // lunch_beverage ?>
        <td data-name="lunch_beverage" <?= $Page->lunch_beverage->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_lunch_beverage">
<span<?= $Page->lunch_beverage->viewAttributes() ?>>
<?= $Page->lunch_beverage->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->dinner_1->Visible) { // dinner_1 ?>
        <td data-name="dinner_1" <?= $Page->dinner_1->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_dinner_1">
<span<?= $Page->dinner_1->viewAttributes() ?>>
<?= $Page->dinner_1->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->dinner_2->Visible) { // dinner_2 ?>
        <td data-name="dinner_2" <?= $Page->dinner_2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_dinner_2">
<span<?= $Page->dinner_2->viewAttributes() ?>>
<?= $Page->dinner_2->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->dinner_3->Visible) { // dinner_3 ?>
        <td data-name="dinner_3" <?= $Page->dinner_3->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_dinner_3">
<span<?= $Page->dinner_3->viewAttributes() ?>>
<?= $Page->dinner_3->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->dinner_bag->Visible) { // dinner_bag ?>
        <td data-name="dinner_bag" <?= $Page->dinner_bag->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_dinner_bag">
<span<?= $Page->dinner_bag->viewAttributes() ?>>
<?= $Page->dinner_bag->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->dinner_bag2->Visible) { // dinner_bag2 ?>
        <td data-name="dinner_bag2" <?= $Page->dinner_bag2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_dinner_bag2">
<span<?= $Page->dinner_bag2->viewAttributes() ?>>
<?= $Page->dinner_bag2->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->dinner_bag3->Visible) { // dinner_bag3 ?>
        <td data-name="dinner_bag3" <?= $Page->dinner_bag3->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_dinner_bag3">
<span<?= $Page->dinner_bag3->viewAttributes() ?>>
<?= $Page->dinner_bag3->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->dinner_beverage->Visible) { // dinner_beverage ?>
        <td data-name="dinner_beverage" <?= $Page->dinner_beverage->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_dinner_beverage">
<span<?= $Page->dinner_beverage->viewAttributes() ?>>
<?= $Page->dinner_beverage->getViewValue() ?></span>
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
    ew.addEventHandlers("box_menu");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
