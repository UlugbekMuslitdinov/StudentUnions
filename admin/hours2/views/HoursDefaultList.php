<?php

namespace PHPMaker2021\project2;

// Page object
$HoursDefaultList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fhours_defaultlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fhours_defaultlist = currentForm = new ew.Form("fhours_defaultlist", "list");
    fhours_defaultlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fhours_defaultlist");
});
var fhours_defaultlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fhours_defaultlistsrch = currentSearchForm = new ew.Form("fhours_defaultlistsrch");

    // Dynamic selection lists

    // Filters
    fhours_defaultlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fhours_defaultlistsrch");
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
<form name="fhours_defaultlistsrch" id="fhours_defaultlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl() ?>">
<div id="fhours_defaultlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="hours_default">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> hours_default">
<form name="fhours_defaultlist" id="fhours_defaultlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="hours_default">
<div id="gmp_hours_default" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_hours_defaultlist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->hour_id->Visible) { // hour_id ?>
        <th data-name="hour_id" class="<?= $Page->hour_id->headerCellClass() ?>"><div id="elh_hours_default_hour_id" class="hours_default_hour_id"><?= $Page->renderSort($Page->hour_id) ?></div></th>
<?php } ?>
<?php if ($Page->mon_open->Visible) { // mon_open ?>
        <th data-name="mon_open" class="<?= $Page->mon_open->headerCellClass() ?>"><div id="elh_hours_default_mon_open" class="hours_default_mon_open"><?= $Page->renderSort($Page->mon_open) ?></div></th>
<?php } ?>
<?php if ($Page->mon_close->Visible) { // mon_close ?>
        <th data-name="mon_close" class="<?= $Page->mon_close->headerCellClass() ?>"><div id="elh_hours_default_mon_close" class="hours_default_mon_close"><?= $Page->renderSort($Page->mon_close) ?></div></th>
<?php } ?>
<?php if ($Page->tue_open->Visible) { // tue_open ?>
        <th data-name="tue_open" class="<?= $Page->tue_open->headerCellClass() ?>"><div id="elh_hours_default_tue_open" class="hours_default_tue_open"><?= $Page->renderSort($Page->tue_open) ?></div></th>
<?php } ?>
<?php if ($Page->tue_close->Visible) { // tue_close ?>
        <th data-name="tue_close" class="<?= $Page->tue_close->headerCellClass() ?>"><div id="elh_hours_default_tue_close" class="hours_default_tue_close"><?= $Page->renderSort($Page->tue_close) ?></div></th>
<?php } ?>
<?php if ($Page->wed_open->Visible) { // wed_open ?>
        <th data-name="wed_open" class="<?= $Page->wed_open->headerCellClass() ?>"><div id="elh_hours_default_wed_open" class="hours_default_wed_open"><?= $Page->renderSort($Page->wed_open) ?></div></th>
<?php } ?>
<?php if ($Page->wed_close->Visible) { // wed_close ?>
        <th data-name="wed_close" class="<?= $Page->wed_close->headerCellClass() ?>"><div id="elh_hours_default_wed_close" class="hours_default_wed_close"><?= $Page->renderSort($Page->wed_close) ?></div></th>
<?php } ?>
<?php if ($Page->thu_open->Visible) { // thu_open ?>
        <th data-name="thu_open" class="<?= $Page->thu_open->headerCellClass() ?>"><div id="elh_hours_default_thu_open" class="hours_default_thu_open"><?= $Page->renderSort($Page->thu_open) ?></div></th>
<?php } ?>
<?php if ($Page->thu_close->Visible) { // thu_close ?>
        <th data-name="thu_close" class="<?= $Page->thu_close->headerCellClass() ?>"><div id="elh_hours_default_thu_close" class="hours_default_thu_close"><?= $Page->renderSort($Page->thu_close) ?></div></th>
<?php } ?>
<?php if ($Page->fri_open->Visible) { // fri_open ?>
        <th data-name="fri_open" class="<?= $Page->fri_open->headerCellClass() ?>"><div id="elh_hours_default_fri_open" class="hours_default_fri_open"><?= $Page->renderSort($Page->fri_open) ?></div></th>
<?php } ?>
<?php if ($Page->fri_close->Visible) { // fri_close ?>
        <th data-name="fri_close" class="<?= $Page->fri_close->headerCellClass() ?>"><div id="elh_hours_default_fri_close" class="hours_default_fri_close"><?= $Page->renderSort($Page->fri_close) ?></div></th>
<?php } ?>
<?php if ($Page->sat_open->Visible) { // sat_open ?>
        <th data-name="sat_open" class="<?= $Page->sat_open->headerCellClass() ?>"><div id="elh_hours_default_sat_open" class="hours_default_sat_open"><?= $Page->renderSort($Page->sat_open) ?></div></th>
<?php } ?>
<?php if ($Page->sat_close->Visible) { // sat_close ?>
        <th data-name="sat_close" class="<?= $Page->sat_close->headerCellClass() ?>"><div id="elh_hours_default_sat_close" class="hours_default_sat_close"><?= $Page->renderSort($Page->sat_close) ?></div></th>
<?php } ?>
<?php if ($Page->sun_open->Visible) { // sun_open ?>
        <th data-name="sun_open" class="<?= $Page->sun_open->headerCellClass() ?>"><div id="elh_hours_default_sun_open" class="hours_default_sun_open"><?= $Page->renderSort($Page->sun_open) ?></div></th>
<?php } ?>
<?php if ($Page->sun_close->Visible) { // sun_close ?>
        <th data-name="sun_close" class="<?= $Page->sun_close->headerCellClass() ?>"><div id="elh_hours_default_sun_close" class="hours_default_sun_close"><?= $Page->renderSort($Page->sun_close) ?></div></th>
<?php } ?>
<?php if ($Page->close->Visible) { // close ?>
        <th data-name="close" class="<?= $Page->close->headerCellClass() ?>"><div id="elh_hours_default_close" class="hours_default_close"><?= $Page->renderSort($Page->close) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_hours_default", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->hour_id->Visible) { // hour_id ?>
        <td data-name="hour_id" <?= $Page->hour_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_hour_id">
<span<?= $Page->hour_id->viewAttributes() ?>>
<?= $Page->hour_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->mon_open->Visible) { // mon_open ?>
        <td data-name="mon_open" <?= $Page->mon_open->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_mon_open">
<span<?= $Page->mon_open->viewAttributes() ?>>
<?= $Page->mon_open->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->mon_close->Visible) { // mon_close ?>
        <td data-name="mon_close" <?= $Page->mon_close->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_mon_close">
<span<?= $Page->mon_close->viewAttributes() ?>>
<?= $Page->mon_close->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tue_open->Visible) { // tue_open ?>
        <td data-name="tue_open" <?= $Page->tue_open->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_tue_open">
<span<?= $Page->tue_open->viewAttributes() ?>>
<?= $Page->tue_open->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tue_close->Visible) { // tue_close ?>
        <td data-name="tue_close" <?= $Page->tue_close->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_tue_close">
<span<?= $Page->tue_close->viewAttributes() ?>>
<?= $Page->tue_close->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->wed_open->Visible) { // wed_open ?>
        <td data-name="wed_open" <?= $Page->wed_open->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_wed_open">
<span<?= $Page->wed_open->viewAttributes() ?>>
<?= $Page->wed_open->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->wed_close->Visible) { // wed_close ?>
        <td data-name="wed_close" <?= $Page->wed_close->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_wed_close">
<span<?= $Page->wed_close->viewAttributes() ?>>
<?= $Page->wed_close->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->thu_open->Visible) { // thu_open ?>
        <td data-name="thu_open" <?= $Page->thu_open->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_thu_open">
<span<?= $Page->thu_open->viewAttributes() ?>>
<?= $Page->thu_open->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->thu_close->Visible) { // thu_close ?>
        <td data-name="thu_close" <?= $Page->thu_close->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_thu_close">
<span<?= $Page->thu_close->viewAttributes() ?>>
<?= $Page->thu_close->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->fri_open->Visible) { // fri_open ?>
        <td data-name="fri_open" <?= $Page->fri_open->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_fri_open">
<span<?= $Page->fri_open->viewAttributes() ?>>
<?= $Page->fri_open->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->fri_close->Visible) { // fri_close ?>
        <td data-name="fri_close" <?= $Page->fri_close->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_fri_close">
<span<?= $Page->fri_close->viewAttributes() ?>>
<?= $Page->fri_close->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sat_open->Visible) { // sat_open ?>
        <td data-name="sat_open" <?= $Page->sat_open->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_sat_open">
<span<?= $Page->sat_open->viewAttributes() ?>>
<?= $Page->sat_open->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sat_close->Visible) { // sat_close ?>
        <td data-name="sat_close" <?= $Page->sat_close->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_sat_close">
<span<?= $Page->sat_close->viewAttributes() ?>>
<?= $Page->sat_close->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sun_open->Visible) { // sun_open ?>
        <td data-name="sun_open" <?= $Page->sun_open->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_sun_open">
<span<?= $Page->sun_open->viewAttributes() ?>>
<?= $Page->sun_open->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sun_close->Visible) { // sun_close ?>
        <td data-name="sun_close" <?= $Page->sun_close->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_sun_close">
<span<?= $Page->sun_close->viewAttributes() ?>>
<?= $Page->sun_close->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->close->Visible) { // close ?>
        <td data-name="close" <?= $Page->close->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_close">
<span<?= $Page->close->viewAttributes() ?>>
<?= $Page->close->getViewValue() ?></span>
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
    ew.addEventHandlers("hours_default");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
