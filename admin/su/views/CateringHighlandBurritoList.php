<?php

namespace PHPMaker2021\project1;

// Page object
$CateringHighlandBurritoList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fcatering_highland_burritolist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fcatering_highland_burritolist = currentForm = new ew.Form("fcatering_highland_burritolist", "list");
    fcatering_highland_burritolist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fcatering_highland_burritolist");
});
var fcatering_highland_burritolistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fcatering_highland_burritolistsrch = currentSearchForm = new ew.Form("fcatering_highland_burritolistsrch");

    // Dynamic selection lists

    // Filters
    fcatering_highland_burritolistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fcatering_highland_burritolistsrch");
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
<form name="fcatering_highland_burritolistsrch" id="fcatering_highland_burritolistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl() ?>">
<div id="fcatering_highland_burritolistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="catering_highland_burrito">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> catering_highland_burrito">
<form name="fcatering_highland_burritolist" id="fcatering_highland_burritolist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="catering_highland_burrito">
<div id="gmp_catering_highland_burrito" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_catering_highland_burritolist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_catering_highland_burrito_id" class="catering_highland_burrito_id"><?= $Page->renderSort($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->catering_id->Visible) { // catering_id ?>
        <th data-name="catering_id" class="<?= $Page->catering_id->headerCellClass() ?>"><div id="elh_catering_highland_burrito_catering_id" class="catering_highland_burrito_catering_id"><?= $Page->renderSort($Page->catering_id) ?></div></th>
<?php } ?>
<?php if ($Page->pack->Visible) { // pack ?>
        <th data-name="pack" class="<?= $Page->pack->headerCellClass() ?>"><div id="elh_catering_highland_burrito_pack" class="catering_highland_burrito_pack"><?= $Page->renderSort($Page->pack) ?></div></th>
<?php } ?>
<?php if ($Page->pack_num->Visible) { // pack_num ?>
        <th data-name="pack_num" class="<?= $Page->pack_num->headerCellClass() ?>"><div id="elh_catering_highland_burrito_pack_num" class="catering_highland_burrito_pack_num"><?= $Page->renderSort($Page->pack_num) ?></div></th>
<?php } ?>
<?php if ($Page->burrito_num->Visible) { // burrito_num ?>
        <th data-name="burrito_num" class="<?= $Page->burrito_num->headerCellClass() ?>"><div id="elh_catering_highland_burrito_burrito_num" class="catering_highland_burrito_burrito_num"><?= $Page->renderSort($Page->burrito_num) ?></div></th>
<?php } ?>
<?php if ($Page->meat_1->Visible) { // meat_1 ?>
        <th data-name="meat_1" class="<?= $Page->meat_1->headerCellClass() ?>"><div id="elh_catering_highland_burrito_meat_1" class="catering_highland_burrito_meat_1"><?= $Page->renderSort($Page->meat_1) ?></div></th>
<?php } ?>
<?php if ($Page->meat_2->Visible) { // meat_2 ?>
        <th data-name="meat_2" class="<?= $Page->meat_2->headerCellClass() ?>"><div id="elh_catering_highland_burrito_meat_2" class="catering_highland_burrito_meat_2"><?= $Page->renderSort($Page->meat_2) ?></div></th>
<?php } ?>
<?php if ($Page->meat_3->Visible) { // meat_3 ?>
        <th data-name="meat_3" class="<?= $Page->meat_3->headerCellClass() ?>"><div id="elh_catering_highland_burrito_meat_3" class="catering_highland_burrito_meat_3"><?= $Page->renderSort($Page->meat_3) ?></div></th>
<?php } ?>
<?php if ($Page->meat_4->Visible) { // meat_4 ?>
        <th data-name="meat_4" class="<?= $Page->meat_4->headerCellClass() ?>"><div id="elh_catering_highland_burrito_meat_4" class="catering_highland_burrito_meat_4"><?= $Page->renderSort($Page->meat_4) ?></div></th>
<?php } ?>
<?php if ($Page->vege_1->Visible) { // vege_1 ?>
        <th data-name="vege_1" class="<?= $Page->vege_1->headerCellClass() ?>"><div id="elh_catering_highland_burrito_vege_1" class="catering_highland_burrito_vege_1"><?= $Page->renderSort($Page->vege_1) ?></div></th>
<?php } ?>
<?php if ($Page->vege_2->Visible) { // vege_2 ?>
        <th data-name="vege_2" class="<?= $Page->vege_2->headerCellClass() ?>"><div id="elh_catering_highland_burrito_vege_2" class="catering_highland_burrito_vege_2"><?= $Page->renderSort($Page->vege_2) ?></div></th>
<?php } ?>
<?php if ($Page->vege_3->Visible) { // vege_3 ?>
        <th data-name="vege_3" class="<?= $Page->vege_3->headerCellClass() ?>"><div id="elh_catering_highland_burrito_vege_3" class="catering_highland_burrito_vege_3"><?= $Page->renderSort($Page->vege_3) ?></div></th>
<?php } ?>
<?php if ($Page->vege_4->Visible) { // vege_4 ?>
        <th data-name="vege_4" class="<?= $Page->vege_4->headerCellClass() ?>"><div id="elh_catering_highland_burrito_vege_4" class="catering_highland_burrito_vege_4"><?= $Page->renderSort($Page->vege_4) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_catering_highland_burrito", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_catering_highland_burrito_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->catering_id->Visible) { // catering_id ?>
        <td data-name="catering_id" <?= $Page->catering_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_burrito_catering_id">
<span<?= $Page->catering_id->viewAttributes() ?>>
<?= $Page->catering_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pack->Visible) { // pack ?>
        <td data-name="pack" <?= $Page->pack->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_burrito_pack">
<span<?= $Page->pack->viewAttributes() ?>>
<?= $Page->pack->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pack_num->Visible) { // pack_num ?>
        <td data-name="pack_num" <?= $Page->pack_num->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_burrito_pack_num">
<span<?= $Page->pack_num->viewAttributes() ?>>
<?= $Page->pack_num->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->burrito_num->Visible) { // burrito_num ?>
        <td data-name="burrito_num" <?= $Page->burrito_num->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_burrito_burrito_num">
<span<?= $Page->burrito_num->viewAttributes() ?>>
<?= $Page->burrito_num->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->meat_1->Visible) { // meat_1 ?>
        <td data-name="meat_1" <?= $Page->meat_1->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_burrito_meat_1">
<span<?= $Page->meat_1->viewAttributes() ?>>
<?= $Page->meat_1->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->meat_2->Visible) { // meat_2 ?>
        <td data-name="meat_2" <?= $Page->meat_2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_burrito_meat_2">
<span<?= $Page->meat_2->viewAttributes() ?>>
<?= $Page->meat_2->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->meat_3->Visible) { // meat_3 ?>
        <td data-name="meat_3" <?= $Page->meat_3->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_burrito_meat_3">
<span<?= $Page->meat_3->viewAttributes() ?>>
<?= $Page->meat_3->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->meat_4->Visible) { // meat_4 ?>
        <td data-name="meat_4" <?= $Page->meat_4->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_burrito_meat_4">
<span<?= $Page->meat_4->viewAttributes() ?>>
<?= $Page->meat_4->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->vege_1->Visible) { // vege_1 ?>
        <td data-name="vege_1" <?= $Page->vege_1->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_burrito_vege_1">
<span<?= $Page->vege_1->viewAttributes() ?>>
<?= $Page->vege_1->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->vege_2->Visible) { // vege_2 ?>
        <td data-name="vege_2" <?= $Page->vege_2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_burrito_vege_2">
<span<?= $Page->vege_2->viewAttributes() ?>>
<?= $Page->vege_2->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->vege_3->Visible) { // vege_3 ?>
        <td data-name="vege_3" <?= $Page->vege_3->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_burrito_vege_3">
<span<?= $Page->vege_3->viewAttributes() ?>>
<?= $Page->vege_3->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->vege_4->Visible) { // vege_4 ?>
        <td data-name="vege_4" <?= $Page->vege_4->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_burrito_vege_4">
<span<?= $Page->vege_4->viewAttributes() ?>>
<?= $Page->vege_4->getViewValue() ?></span>
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
    ew.addEventHandlers("catering_highland_burrito");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
