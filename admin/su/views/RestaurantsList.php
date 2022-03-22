<?php

namespace PHPMaker2021\project1;

// Page object
$RestaurantsList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var frestaurantslist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    frestaurantslist = currentForm = new ew.Form("frestaurantslist", "list");
    frestaurantslist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("frestaurantslist");
});
var frestaurantslistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    frestaurantslistsrch = currentSearchForm = new ew.Form("frestaurantslistsrch");

    // Dynamic selection lists

    // Filters
    frestaurantslistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("frestaurantslistsrch");
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
<form name="frestaurantslistsrch" id="frestaurantslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl() ?>">
<div id="frestaurantslistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="restaurants">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> restaurants">
<form name="frestaurantslist" id="frestaurantslist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="restaurants">
<div id="gmp_restaurants" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_restaurantslist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_restaurants_id" class="restaurants_id"><?= $Page->renderSort($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->location_id->Visible) { // location_id ?>
        <th data-name="location_id" class="<?= $Page->location_id->headerCellClass() ?>"><div id="elh_restaurants_location_id" class="restaurants_location_id"><?= $Page->renderSort($Page->location_id) ?></div></th>
<?php } ?>
<?php if ($Page->banner->Visible) { // banner ?>
        <th data-name="banner" class="<?= $Page->banner->headerCellClass() ?>"><div id="elh_restaurants_banner" class="restaurants_banner"><?= $Page->renderSort($Page->banner) ?></div></th>
<?php } ?>
<?php if ($Page->button_menu->Visible) { // button_menu ?>
        <th data-name="button_menu" class="<?= $Page->button_menu->headerCellClass() ?>"><div id="elh_restaurants_button_menu" class="restaurants_button_menu"><?= $Page->renderSort($Page->button_menu) ?></div></th>
<?php } ?>
<?php if ($Page->button_pdf->Visible) { // button_pdf ?>
        <th data-name="button_pdf" class="<?= $Page->button_pdf->headerCellClass() ?>"><div id="elh_restaurants_button_pdf" class="restaurants_button_pdf"><?= $Page->renderSort($Page->button_pdf) ?></div></th>
<?php } ?>
<?php if ($Page->button_catering->Visible) { // button_catering ?>
        <th data-name="button_catering" class="<?= $Page->button_catering->headerCellClass() ?>"><div id="elh_restaurants_button_catering" class="restaurants_button_catering"><?= $Page->renderSort($Page->button_catering) ?></div></th>
<?php } ?>
<?php if ($Page->button_form->Visible) { // button_form ?>
        <th data-name="button_form" class="<?= $Page->button_form->headerCellClass() ?>"><div id="elh_restaurants_button_form" class="restaurants_button_form"><?= $Page->renderSort($Page->button_form) ?></div></th>
<?php } ?>
<?php if ($Page->slides->Visible) { // slides ?>
        <th data-name="slides" class="<?= $Page->slides->headerCellClass() ?>"><div id="elh_restaurants_slides" class="restaurants_slides"><?= $Page->renderSort($Page->slides) ?></div></th>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <th data-name="timestamp" class="<?= $Page->timestamp->headerCellClass() ?>"><div id="elh_restaurants_timestamp" class="restaurants_timestamp"><?= $Page->renderSort($Page->timestamp) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_restaurants", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_restaurants_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->location_id->Visible) { // location_id ?>
        <td data-name="location_id" <?= $Page->location_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_restaurants_location_id">
<span<?= $Page->location_id->viewAttributes() ?>>
<?= $Page->location_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->banner->Visible) { // banner ?>
        <td data-name="banner" <?= $Page->banner->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_restaurants_banner">
<span<?= $Page->banner->viewAttributes() ?>>
<?= $Page->banner->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->button_menu->Visible) { // button_menu ?>
        <td data-name="button_menu" <?= $Page->button_menu->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_restaurants_button_menu">
<span<?= $Page->button_menu->viewAttributes() ?>>
<?= $Page->button_menu->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->button_pdf->Visible) { // button_pdf ?>
        <td data-name="button_pdf" <?= $Page->button_pdf->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_restaurants_button_pdf">
<span<?= $Page->button_pdf->viewAttributes() ?>>
<?= $Page->button_pdf->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->button_catering->Visible) { // button_catering ?>
        <td data-name="button_catering" <?= $Page->button_catering->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_restaurants_button_catering">
<span<?= $Page->button_catering->viewAttributes() ?>>
<?= $Page->button_catering->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->button_form->Visible) { // button_form ?>
        <td data-name="button_form" <?= $Page->button_form->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_restaurants_button_form">
<span<?= $Page->button_form->viewAttributes() ?>>
<?= $Page->button_form->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->slides->Visible) { // slides ?>
        <td data-name="slides" <?= $Page->slides->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_restaurants_slides">
<span<?= $Page->slides->viewAttributes() ?>>
<?= $Page->slides->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->timestamp->Visible) { // timestamp ?>
        <td data-name="timestamp" <?= $Page->timestamp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_restaurants_timestamp">
<span<?= $Page->timestamp->viewAttributes() ?>>
<?= $Page->timestamp->getViewValue() ?></span>
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
    ew.addEventHandlers("restaurants");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
