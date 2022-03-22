<?php

namespace PHPMaker2021\project1;

// Page object
$MealpackageList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fmealpackagelist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fmealpackagelist = currentForm = new ew.Form("fmealpackagelist", "list");
    fmealpackagelist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fmealpackagelist");
});
var fmealpackagelistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fmealpackagelistsrch = currentSearchForm = new ew.Form("fmealpackagelistsrch");

    // Dynamic selection lists

    // Filters
    fmealpackagelistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fmealpackagelistsrch");
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
<form name="fmealpackagelistsrch" id="fmealpackagelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl() ?>">
<div id="fmealpackagelistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="mealpackage">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> mealpackage">
<form name="fmealpackagelist" id="fmealpackagelist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="mealpackage">
<div id="gmp_mealpackage" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_mealpackagelist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_mealpackage_id" class="mealpackage_id"><?= $Page->renderSort($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->netid->Visible) { // netid ?>
        <th data-name="netid" class="<?= $Page->netid->headerCellClass() ?>"><div id="elh_mealpackage_netid" class="mealpackage_netid"><?= $Page->renderSort($Page->netid) ?></div></th>
<?php } ?>
<?php if ($Page->sid->Visible) { // sid ?>
        <th data-name="sid" class="<?= $Page->sid->headerCellClass() ?>"><div id="elh_mealpackage_sid" class="mealpackage_sid"><?= $Page->renderSort($Page->sid) ?></div></th>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <th data-name="_email" class="<?= $Page->_email->headerCellClass() ?>"><div id="elh_mealpackage__email" class="mealpackage__email"><?= $Page->renderSort($Page->_email) ?></div></th>
<?php } ?>
<?php if ($Page->firstname->Visible) { // firstname ?>
        <th data-name="firstname" class="<?= $Page->firstname->headerCellClass() ?>"><div id="elh_mealpackage_firstname" class="mealpackage_firstname"><?= $Page->renderSort($Page->firstname) ?></div></th>
<?php } ?>
<?php if ($Page->lastname->Visible) { // lastname ?>
        <th data-name="lastname" class="<?= $Page->lastname->headerCellClass() ?>"><div id="elh_mealpackage_lastname" class="mealpackage_lastname"><?= $Page->renderSort($Page->lastname) ?></div></th>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
        <th data-name="phone" class="<?= $Page->phone->headerCellClass() ?>"><div id="elh_mealpackage_phone" class="mealpackage_phone"><?= $Page->renderSort($Page->phone) ?></div></th>
<?php } ?>
<?php if ($Page->dorm->Visible) { // dorm ?>
        <th data-name="dorm" class="<?= $Page->dorm->headerCellClass() ?>"><div id="elh_mealpackage_dorm" class="mealpackage_dorm"><?= $Page->renderSort($Page->dorm) ?></div></th>
<?php } ?>
<?php if ($Page->meal->Visible) { // meal ?>
        <th data-name="meal" class="<?= $Page->meal->headerCellClass() ?>"><div id="elh_mealpackage_meal" class="mealpackage_meal"><?= $Page->renderSort($Page->meal) ?></div></th>
<?php } ?>
<?php if ($Page->refrigerator->Visible) { // refrigerator ?>
        <th data-name="refrigerator" class="<?= $Page->refrigerator->headerCellClass() ?>"><div id="elh_mealpackage_refrigerator" class="mealpackage_refrigerator"><?= $Page->renderSort($Page->refrigerator) ?></div></th>
<?php } ?>
<?php if ($Page->microwave->Visible) { // microwave ?>
        <th data-name="microwave" class="<?= $Page->microwave->headerCellClass() ?>"><div id="elh_mealpackage_microwave" class="mealpackage_microwave"><?= $Page->renderSort($Page->microwave) ?></div></th>
<?php } ?>
<?php if ($Page->water->Visible) { // water ?>
        <th data-name="water" class="<?= $Page->water->headerCellClass() ?>"><div id="elh_mealpackage_water" class="mealpackage_water"><?= $Page->renderSort($Page->water) ?></div></th>
<?php } ?>
<?php if ($Page->room_number->Visible) { // room_number ?>
        <th data-name="room_number" class="<?= $Page->room_number->headerCellClass() ?>"><div id="elh_mealpackage_room_number" class="mealpackage_room_number"><?= $Page->renderSort($Page->room_number) ?></div></th>
<?php } ?>
<?php if ($Page->amount->Visible) { // amount ?>
        <th data-name="amount" class="<?= $Page->amount->headerCellClass() ?>"><div id="elh_mealpackage_amount" class="mealpackage_amount"><?= $Page->renderSort($Page->amount) ?></div></th>
<?php } ?>
<?php if ($Page->payment->Visible) { // payment ?>
        <th data-name="payment" class="<?= $Page->payment->headerCellClass() ?>"><div id="elh_mealpackage_payment" class="mealpackage_payment"><?= $Page->renderSort($Page->payment) ?></div></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Page->status->headerCellClass() ?>"><div id="elh_mealpackage_status" class="mealpackage_status"><?= $Page->renderSort($Page->status) ?></div></th>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <th data-name="timestamp" class="<?= $Page->timestamp->headerCellClass() ?>"><div id="elh_mealpackage_timestamp" class="mealpackage_timestamp"><?= $Page->renderSort($Page->timestamp) ?></div></th>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
        <th data-name="type" class="<?= $Page->type->headerCellClass() ?>"><div id="elh_mealpackage_type" class="mealpackage_type"><?= $Page->renderSort($Page->type) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_mealpackage", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_mealpackage_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->netid->Visible) { // netid ?>
        <td data-name="netid" <?= $Page->netid->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mealpackage_netid">
<span<?= $Page->netid->viewAttributes() ?>>
<?= $Page->netid->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sid->Visible) { // sid ?>
        <td data-name="sid" <?= $Page->sid->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mealpackage_sid">
<span<?= $Page->sid->viewAttributes() ?>>
<?= $Page->sid->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->_email->Visible) { // email ?>
        <td data-name="_email" <?= $Page->_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mealpackage__email">
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->firstname->Visible) { // firstname ?>
        <td data-name="firstname" <?= $Page->firstname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mealpackage_firstname">
<span<?= $Page->firstname->viewAttributes() ?>>
<?= $Page->firstname->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->lastname->Visible) { // lastname ?>
        <td data-name="lastname" <?= $Page->lastname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mealpackage_lastname">
<span<?= $Page->lastname->viewAttributes() ?>>
<?= $Page->lastname->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->phone->Visible) { // phone ?>
        <td data-name="phone" <?= $Page->phone->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mealpackage_phone">
<span<?= $Page->phone->viewAttributes() ?>>
<?= $Page->phone->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->dorm->Visible) { // dorm ?>
        <td data-name="dorm" <?= $Page->dorm->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mealpackage_dorm">
<span<?= $Page->dorm->viewAttributes() ?>>
<?= $Page->dorm->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->meal->Visible) { // meal ?>
        <td data-name="meal" <?= $Page->meal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mealpackage_meal">
<span<?= $Page->meal->viewAttributes() ?>>
<?= $Page->meal->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->refrigerator->Visible) { // refrigerator ?>
        <td data-name="refrigerator" <?= $Page->refrigerator->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mealpackage_refrigerator">
<span<?= $Page->refrigerator->viewAttributes() ?>>
<?= $Page->refrigerator->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->microwave->Visible) { // microwave ?>
        <td data-name="microwave" <?= $Page->microwave->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mealpackage_microwave">
<span<?= $Page->microwave->viewAttributes() ?>>
<?= $Page->microwave->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->water->Visible) { // water ?>
        <td data-name="water" <?= $Page->water->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mealpackage_water">
<span<?= $Page->water->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_water_<?= $Page->RowCount ?>" class="custom-control-input" value="<?= $Page->water->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->water->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_water_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->room_number->Visible) { // room_number ?>
        <td data-name="room_number" <?= $Page->room_number->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mealpackage_room_number">
<span<?= $Page->room_number->viewAttributes() ?>>
<?= $Page->room_number->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->amount->Visible) { // amount ?>
        <td data-name="amount" <?= $Page->amount->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mealpackage_amount">
<span<?= $Page->amount->viewAttributes() ?>>
<?= $Page->amount->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->payment->Visible) { // payment ?>
        <td data-name="payment" <?= $Page->payment->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mealpackage_payment">
<span<?= $Page->payment->viewAttributes() ?>>
<?= $Page->payment->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <td data-name="status" <?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mealpackage_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->timestamp->Visible) { // timestamp ?>
        <td data-name="timestamp" <?= $Page->timestamp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mealpackage_timestamp">
<span<?= $Page->timestamp->viewAttributes() ?>>
<?= $Page->timestamp->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->type->Visible) { // type ?>
        <td data-name="type" <?= $Page->type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mealpackage_type">
<span<?= $Page->type->viewAttributes() ?>>
<?= $Page->type->getViewValue() ?></span>
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
    ew.addEventHandlers("mealpackage");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
