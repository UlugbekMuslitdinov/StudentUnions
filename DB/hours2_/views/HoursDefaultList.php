<?php

namespace PHPMaker2022\project1;

// Page object
$HoursDefaultList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { hours_default: currentTable } });
var currentForm, currentPageID;
var fhours_defaultlist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fhours_defaultlist = new ew.Form("fhours_defaultlist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fhours_defaultlist;
    fhours_defaultlist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fhours_defaultlist");
});
var fhours_defaultsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fhours_defaultsrch = new ew.Form("fhours_defaultsrch", "list");
    currentSearchForm = fhours_defaultsrch;

    // Dynamic selection lists

    // Filters
    fhours_defaultsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fhours_defaultsrch");
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
</div>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !$Page->CurrentAction && $Page->hasSearchFields()) { ?>
<form name="fhours_defaultsrch" id="fhours_defaultsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fhours_defaultsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="hours_default">
<div class="ew-extended-search container-fluid">
<div class="row mb-0">
    <div class="col-sm-auto px-0 pe-sm-2">
        <div class="ew-basic-search input-group">
            <input type="search" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control ew-basic-search-keyword" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>" aria-label="<?= HtmlEncode($Language->phrase("Search")) ?>">
            <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" class="ew-basic-search-type" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
            <button type="button" data-bs-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false">
                <span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fhours_defaultsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fhours_defaultsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fhours_defaultsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fhours_defaultsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
            </div>
        </div>
    </div>
    <div class="col-sm-auto mb-3">
        <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
    </div>
</div>
</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> hours_default">
<form name="fhours_defaultlist" id="fhours_defaultlist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="hours_default">
<div id="gmp_hours_default" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_hours_defaultlist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="hour_id" class="<?= $Page->hour_id->headerCellClass() ?>"><div id="elh_hours_default_hour_id" class="hours_default_hour_id"><?= $Page->renderFieldHeader($Page->hour_id) ?></div></th>
<?php } ?>
<?php if ($Page->mon_open->Visible) { // mon_open ?>
        <th data-name="mon_open" class="<?= $Page->mon_open->headerCellClass() ?>"><div id="elh_hours_default_mon_open" class="hours_default_mon_open"><?= $Page->renderFieldHeader($Page->mon_open) ?></div></th>
<?php } ?>
<?php if ($Page->mon_close->Visible) { // mon_close ?>
        <th data-name="mon_close" class="<?= $Page->mon_close->headerCellClass() ?>"><div id="elh_hours_default_mon_close" class="hours_default_mon_close"><?= $Page->renderFieldHeader($Page->mon_close) ?></div></th>
<?php } ?>
<?php if ($Page->tue_open->Visible) { // tue_open ?>
        <th data-name="tue_open" class="<?= $Page->tue_open->headerCellClass() ?>"><div id="elh_hours_default_tue_open" class="hours_default_tue_open"><?= $Page->renderFieldHeader($Page->tue_open) ?></div></th>
<?php } ?>
<?php if ($Page->tue_close->Visible) { // tue_close ?>
        <th data-name="tue_close" class="<?= $Page->tue_close->headerCellClass() ?>"><div id="elh_hours_default_tue_close" class="hours_default_tue_close"><?= $Page->renderFieldHeader($Page->tue_close) ?></div></th>
<?php } ?>
<?php if ($Page->wed_open->Visible) { // wed_open ?>
        <th data-name="wed_open" class="<?= $Page->wed_open->headerCellClass() ?>"><div id="elh_hours_default_wed_open" class="hours_default_wed_open"><?= $Page->renderFieldHeader($Page->wed_open) ?></div></th>
<?php } ?>
<?php if ($Page->wed_close->Visible) { // wed_close ?>
        <th data-name="wed_close" class="<?= $Page->wed_close->headerCellClass() ?>"><div id="elh_hours_default_wed_close" class="hours_default_wed_close"><?= $Page->renderFieldHeader($Page->wed_close) ?></div></th>
<?php } ?>
<?php if ($Page->thu_open->Visible) { // thu_open ?>
        <th data-name="thu_open" class="<?= $Page->thu_open->headerCellClass() ?>"><div id="elh_hours_default_thu_open" class="hours_default_thu_open"><?= $Page->renderFieldHeader($Page->thu_open) ?></div></th>
<?php } ?>
<?php if ($Page->thu_close->Visible) { // thu_close ?>
        <th data-name="thu_close" class="<?= $Page->thu_close->headerCellClass() ?>"><div id="elh_hours_default_thu_close" class="hours_default_thu_close"><?= $Page->renderFieldHeader($Page->thu_close) ?></div></th>
<?php } ?>
<?php if ($Page->fri_open->Visible) { // fri_open ?>
        <th data-name="fri_open" class="<?= $Page->fri_open->headerCellClass() ?>"><div id="elh_hours_default_fri_open" class="hours_default_fri_open"><?= $Page->renderFieldHeader($Page->fri_open) ?></div></th>
<?php } ?>
<?php if ($Page->fri_close->Visible) { // fri_close ?>
        <th data-name="fri_close" class="<?= $Page->fri_close->headerCellClass() ?>"><div id="elh_hours_default_fri_close" class="hours_default_fri_close"><?= $Page->renderFieldHeader($Page->fri_close) ?></div></th>
<?php } ?>
<?php if ($Page->sat_open->Visible) { // sat_open ?>
        <th data-name="sat_open" class="<?= $Page->sat_open->headerCellClass() ?>"><div id="elh_hours_default_sat_open" class="hours_default_sat_open"><?= $Page->renderFieldHeader($Page->sat_open) ?></div></th>
<?php } ?>
<?php if ($Page->sat_close->Visible) { // sat_close ?>
        <th data-name="sat_close" class="<?= $Page->sat_close->headerCellClass() ?>"><div id="elh_hours_default_sat_close" class="hours_default_sat_close"><?= $Page->renderFieldHeader($Page->sat_close) ?></div></th>
<?php } ?>
<?php if ($Page->sun_open->Visible) { // sun_open ?>
        <th data-name="sun_open" class="<?= $Page->sun_open->headerCellClass() ?>"><div id="elh_hours_default_sun_open" class="hours_default_sun_open"><?= $Page->renderFieldHeader($Page->sun_open) ?></div></th>
<?php } ?>
<?php if ($Page->sun_close->Visible) { // sun_close ?>
        <th data-name="sun_close" class="<?= $Page->sun_close->headerCellClass() ?>"><div id="elh_hours_default_sun_close" class="hours_default_sun_close"><?= $Page->renderFieldHeader($Page->sun_close) ?></div></th>
<?php } ?>
<?php if ($Page->close->Visible) { // close ?>
        <th data-name="close" class="<?= $Page->close->headerCellClass() ?>"><div id="elh_hours_default_close" class="hours_default_close"><?= $Page->renderFieldHeader($Page->close) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_hours_default",
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
    <?php if ($Page->hour_id->Visible) { // hour_id ?>
        <td data-name="hour_id"<?= $Page->hour_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_hour_id" class="el_hours_default_hour_id">
<span<?= $Page->hour_id->viewAttributes() ?>>
<?= $Page->hour_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->mon_open->Visible) { // mon_open ?>
        <td data-name="mon_open"<?= $Page->mon_open->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_mon_open" class="el_hours_default_mon_open">
<span<?= $Page->mon_open->viewAttributes() ?>>
<?= $Page->mon_open->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->mon_close->Visible) { // mon_close ?>
        <td data-name="mon_close"<?= $Page->mon_close->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_mon_close" class="el_hours_default_mon_close">
<span<?= $Page->mon_close->viewAttributes() ?>>
<?= $Page->mon_close->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tue_open->Visible) { // tue_open ?>
        <td data-name="tue_open"<?= $Page->tue_open->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_tue_open" class="el_hours_default_tue_open">
<span<?= $Page->tue_open->viewAttributes() ?>>
<?= $Page->tue_open->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tue_close->Visible) { // tue_close ?>
        <td data-name="tue_close"<?= $Page->tue_close->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_tue_close" class="el_hours_default_tue_close">
<span<?= $Page->tue_close->viewAttributes() ?>>
<?= $Page->tue_close->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->wed_open->Visible) { // wed_open ?>
        <td data-name="wed_open"<?= $Page->wed_open->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_wed_open" class="el_hours_default_wed_open">
<span<?= $Page->wed_open->viewAttributes() ?>>
<?= $Page->wed_open->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->wed_close->Visible) { // wed_close ?>
        <td data-name="wed_close"<?= $Page->wed_close->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_wed_close" class="el_hours_default_wed_close">
<span<?= $Page->wed_close->viewAttributes() ?>>
<?= $Page->wed_close->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->thu_open->Visible) { // thu_open ?>
        <td data-name="thu_open"<?= $Page->thu_open->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_thu_open" class="el_hours_default_thu_open">
<span<?= $Page->thu_open->viewAttributes() ?>>
<?= $Page->thu_open->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->thu_close->Visible) { // thu_close ?>
        <td data-name="thu_close"<?= $Page->thu_close->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_thu_close" class="el_hours_default_thu_close">
<span<?= $Page->thu_close->viewAttributes() ?>>
<?= $Page->thu_close->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->fri_open->Visible) { // fri_open ?>
        <td data-name="fri_open"<?= $Page->fri_open->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_fri_open" class="el_hours_default_fri_open">
<span<?= $Page->fri_open->viewAttributes() ?>>
<?= $Page->fri_open->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->fri_close->Visible) { // fri_close ?>
        <td data-name="fri_close"<?= $Page->fri_close->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_fri_close" class="el_hours_default_fri_close">
<span<?= $Page->fri_close->viewAttributes() ?>>
<?= $Page->fri_close->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sat_open->Visible) { // sat_open ?>
        <td data-name="sat_open"<?= $Page->sat_open->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_sat_open" class="el_hours_default_sat_open">
<span<?= $Page->sat_open->viewAttributes() ?>>
<?= $Page->sat_open->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sat_close->Visible) { // sat_close ?>
        <td data-name="sat_close"<?= $Page->sat_close->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_sat_close" class="el_hours_default_sat_close">
<span<?= $Page->sat_close->viewAttributes() ?>>
<?= $Page->sat_close->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sun_open->Visible) { // sun_open ?>
        <td data-name="sun_open"<?= $Page->sun_open->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_sun_open" class="el_hours_default_sun_open">
<span<?= $Page->sun_open->viewAttributes() ?>>
<?= $Page->sun_open->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sun_close->Visible) { // sun_close ?>
        <td data-name="sun_close"<?= $Page->sun_close->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_sun_close" class="el_hours_default_sun_close">
<span<?= $Page->sun_close->viewAttributes() ?>>
<?= $Page->sun_close->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->close->Visible) { // close ?>
        <td data-name="close"<?= $Page->close->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_default_close" class="el_hours_default_close">
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
    ew.addEventHandlers("hours_default");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
