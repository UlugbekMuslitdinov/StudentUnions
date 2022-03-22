<?php

namespace PHPMaker2022\project2;

// Page object
$HoursExceptionList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { hours_exception: currentTable } });
var currentForm, currentPageID;
var fhours_exceptionlist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fhours_exceptionlist = new ew.Form("fhours_exceptionlist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fhours_exceptionlist;
    fhours_exceptionlist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fhours_exceptionlist");
});
var fhours_exceptionsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fhours_exceptionsrch = new ew.Form("fhours_exceptionsrch", "list");
    currentSearchForm = fhours_exceptionsrch;

    // Dynamic selection lists

    // Filters
    fhours_exceptionsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fhours_exceptionsrch");
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
<?php if (!$Page->isExport() && !$Page->CurrentAction && $Page->hasSearchFields()) { ?>
<form name="fhours_exceptionsrch" id="fhours_exceptionsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fhours_exceptionsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="hours_exception">
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fhours_exceptionsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fhours_exceptionsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fhours_exceptionsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fhours_exceptionsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> hours_exception">
<form name="fhours_exceptionlist" id="fhours_exceptionlist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="hours_exception">
<div id="gmp_hours_exception" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_hours_exceptionlist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="location_id" class="<?= $Page->location_id->headerCellClass() ?>"><div id="elh_hours_exception_location_id" class="hours_exception_location_id"><?= $Page->renderFieldHeader($Page->location_id) ?></div></th>
<?php } ?>
<?php if ($Page->start->Visible) { // start ?>
        <th data-name="start" class="<?= $Page->start->headerCellClass() ?>"><div id="elh_hours_exception_start" class="hours_exception_start"><?= $Page->renderFieldHeader($Page->start) ?></div></th>
<?php } ?>
<?php if ($Page->end->Visible) { // end ?>
        <th data-name="end" class="<?= $Page->end->headerCellClass() ?>"><div id="elh_hours_exception_end" class="hours_exception_end"><?= $Page->renderFieldHeader($Page->end) ?></div></th>
<?php } ?>
<?php if ($Page->mon_openx->Visible) { // mon_openx ?>
        <th data-name="mon_openx" class="<?= $Page->mon_openx->headerCellClass() ?>"><div id="elh_hours_exception_mon_openx" class="hours_exception_mon_openx"><?= $Page->renderFieldHeader($Page->mon_openx) ?></div></th>
<?php } ?>
<?php if ($Page->mon_closex->Visible) { // mon_closex ?>
        <th data-name="mon_closex" class="<?= $Page->mon_closex->headerCellClass() ?>"><div id="elh_hours_exception_mon_closex" class="hours_exception_mon_closex"><?= $Page->renderFieldHeader($Page->mon_closex) ?></div></th>
<?php } ?>
<?php if ($Page->tue_openx->Visible) { // tue_openx ?>
        <th data-name="tue_openx" class="<?= $Page->tue_openx->headerCellClass() ?>"><div id="elh_hours_exception_tue_openx" class="hours_exception_tue_openx"><?= $Page->renderFieldHeader($Page->tue_openx) ?></div></th>
<?php } ?>
<?php if ($Page->tue_closex->Visible) { // tue_closex ?>
        <th data-name="tue_closex" class="<?= $Page->tue_closex->headerCellClass() ?>"><div id="elh_hours_exception_tue_closex" class="hours_exception_tue_closex"><?= $Page->renderFieldHeader($Page->tue_closex) ?></div></th>
<?php } ?>
<?php if ($Page->wed_openx->Visible) { // wed_openx ?>
        <th data-name="wed_openx" class="<?= $Page->wed_openx->headerCellClass() ?>"><div id="elh_hours_exception_wed_openx" class="hours_exception_wed_openx"><?= $Page->renderFieldHeader($Page->wed_openx) ?></div></th>
<?php } ?>
<?php if ($Page->wed_closex->Visible) { // wed_closex ?>
        <th data-name="wed_closex" class="<?= $Page->wed_closex->headerCellClass() ?>"><div id="elh_hours_exception_wed_closex" class="hours_exception_wed_closex"><?= $Page->renderFieldHeader($Page->wed_closex) ?></div></th>
<?php } ?>
<?php if ($Page->thu_openx->Visible) { // thu_openx ?>
        <th data-name="thu_openx" class="<?= $Page->thu_openx->headerCellClass() ?>"><div id="elh_hours_exception_thu_openx" class="hours_exception_thu_openx"><?= $Page->renderFieldHeader($Page->thu_openx) ?></div></th>
<?php } ?>
<?php if ($Page->thu_closex->Visible) { // thu_closex ?>
        <th data-name="thu_closex" class="<?= $Page->thu_closex->headerCellClass() ?>"><div id="elh_hours_exception_thu_closex" class="hours_exception_thu_closex"><?= $Page->renderFieldHeader($Page->thu_closex) ?></div></th>
<?php } ?>
<?php if ($Page->fri_openx->Visible) { // fri_openx ?>
        <th data-name="fri_openx" class="<?= $Page->fri_openx->headerCellClass() ?>"><div id="elh_hours_exception_fri_openx" class="hours_exception_fri_openx"><?= $Page->renderFieldHeader($Page->fri_openx) ?></div></th>
<?php } ?>
<?php if ($Page->fri_closex->Visible) { // fri_closex ?>
        <th data-name="fri_closex" class="<?= $Page->fri_closex->headerCellClass() ?>"><div id="elh_hours_exception_fri_closex" class="hours_exception_fri_closex"><?= $Page->renderFieldHeader($Page->fri_closex) ?></div></th>
<?php } ?>
<?php if ($Page->sat_openx->Visible) { // sat_openx ?>
        <th data-name="sat_openx" class="<?= $Page->sat_openx->headerCellClass() ?>"><div id="elh_hours_exception_sat_openx" class="hours_exception_sat_openx"><?= $Page->renderFieldHeader($Page->sat_openx) ?></div></th>
<?php } ?>
<?php if ($Page->sat_closex->Visible) { // sat_closex ?>
        <th data-name="sat_closex" class="<?= $Page->sat_closex->headerCellClass() ?>"><div id="elh_hours_exception_sat_closex" class="hours_exception_sat_closex"><?= $Page->renderFieldHeader($Page->sat_closex) ?></div></th>
<?php } ?>
<?php if ($Page->sun_openx->Visible) { // sun_openx ?>
        <th data-name="sun_openx" class="<?= $Page->sun_openx->headerCellClass() ?>"><div id="elh_hours_exception_sun_openx" class="hours_exception_sun_openx"><?= $Page->renderFieldHeader($Page->sun_openx) ?></div></th>
<?php } ?>
<?php if ($Page->sun_closex->Visible) { // sun_closex ?>
        <th data-name="sun_closex" class="<?= $Page->sun_closex->headerCellClass() ?>"><div id="elh_hours_exception_sun_closex" class="hours_exception_sun_closex"><?= $Page->renderFieldHeader($Page->sun_closex) ?></div></th>
<?php } ?>
<?php if ($Page->closex->Visible) { // closex ?>
        <th data-name="closex" class="<?= $Page->closex->headerCellClass() ?>"><div id="elh_hours_exception_closex" class="hours_exception_closex"><?= $Page->renderFieldHeader($Page->closex) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_hours_exception",
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
<span id="el<?= $Page->RowCount ?>_hours_exception_location_id" class="el_hours_exception_location_id">
<span<?= $Page->location_id->viewAttributes() ?>>
<?= $Page->location_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->start->Visible) { // start ?>
        <td data-name="start"<?= $Page->start->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_exception_start" class="el_hours_exception_start">
<span<?= $Page->start->viewAttributes() ?>>
<?= $Page->start->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->end->Visible) { // end ?>
        <td data-name="end"<?= $Page->end->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_exception_end" class="el_hours_exception_end">
<span<?= $Page->end->viewAttributes() ?>>
<?= $Page->end->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->mon_openx->Visible) { // mon_openx ?>
        <td data-name="mon_openx"<?= $Page->mon_openx->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_exception_mon_openx" class="el_hours_exception_mon_openx">
<span<?= $Page->mon_openx->viewAttributes() ?>>
<?= $Page->mon_openx->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->mon_closex->Visible) { // mon_closex ?>
        <td data-name="mon_closex"<?= $Page->mon_closex->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_exception_mon_closex" class="el_hours_exception_mon_closex">
<span<?= $Page->mon_closex->viewAttributes() ?>>
<?= $Page->mon_closex->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tue_openx->Visible) { // tue_openx ?>
        <td data-name="tue_openx"<?= $Page->tue_openx->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_exception_tue_openx" class="el_hours_exception_tue_openx">
<span<?= $Page->tue_openx->viewAttributes() ?>>
<?= $Page->tue_openx->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tue_closex->Visible) { // tue_closex ?>
        <td data-name="tue_closex"<?= $Page->tue_closex->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_exception_tue_closex" class="el_hours_exception_tue_closex">
<span<?= $Page->tue_closex->viewAttributes() ?>>
<?= $Page->tue_closex->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->wed_openx->Visible) { // wed_openx ?>
        <td data-name="wed_openx"<?= $Page->wed_openx->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_exception_wed_openx" class="el_hours_exception_wed_openx">
<span<?= $Page->wed_openx->viewAttributes() ?>>
<?= $Page->wed_openx->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->wed_closex->Visible) { // wed_closex ?>
        <td data-name="wed_closex"<?= $Page->wed_closex->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_exception_wed_closex" class="el_hours_exception_wed_closex">
<span<?= $Page->wed_closex->viewAttributes() ?>>
<?= $Page->wed_closex->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->thu_openx->Visible) { // thu_openx ?>
        <td data-name="thu_openx"<?= $Page->thu_openx->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_exception_thu_openx" class="el_hours_exception_thu_openx">
<span<?= $Page->thu_openx->viewAttributes() ?>>
<?= $Page->thu_openx->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->thu_closex->Visible) { // thu_closex ?>
        <td data-name="thu_closex"<?= $Page->thu_closex->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_exception_thu_closex" class="el_hours_exception_thu_closex">
<span<?= $Page->thu_closex->viewAttributes() ?>>
<?= $Page->thu_closex->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->fri_openx->Visible) { // fri_openx ?>
        <td data-name="fri_openx"<?= $Page->fri_openx->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_exception_fri_openx" class="el_hours_exception_fri_openx">
<span<?= $Page->fri_openx->viewAttributes() ?>>
<?= $Page->fri_openx->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->fri_closex->Visible) { // fri_closex ?>
        <td data-name="fri_closex"<?= $Page->fri_closex->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_exception_fri_closex" class="el_hours_exception_fri_closex">
<span<?= $Page->fri_closex->viewAttributes() ?>>
<?= $Page->fri_closex->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sat_openx->Visible) { // sat_openx ?>
        <td data-name="sat_openx"<?= $Page->sat_openx->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_exception_sat_openx" class="el_hours_exception_sat_openx">
<span<?= $Page->sat_openx->viewAttributes() ?>>
<?= $Page->sat_openx->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sat_closex->Visible) { // sat_closex ?>
        <td data-name="sat_closex"<?= $Page->sat_closex->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_exception_sat_closex" class="el_hours_exception_sat_closex">
<span<?= $Page->sat_closex->viewAttributes() ?>>
<?= $Page->sat_closex->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sun_openx->Visible) { // sun_openx ?>
        <td data-name="sun_openx"<?= $Page->sun_openx->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_exception_sun_openx" class="el_hours_exception_sun_openx">
<span<?= $Page->sun_openx->viewAttributes() ?>>
<?= $Page->sun_openx->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sun_closex->Visible) { // sun_closex ?>
        <td data-name="sun_closex"<?= $Page->sun_closex->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_exception_sun_closex" class="el_hours_exception_sun_closex">
<span<?= $Page->sun_closex->viewAttributes() ?>>
<?= $Page->sun_closex->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->closex->Visible) { // closex ?>
        <td data-name="closex"<?= $Page->closex->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_exception_closex" class="el_hours_exception_closex">
<span<?= $Page->closex->viewAttributes() ?>>
<?= $Page->closex->getViewValue() ?></span>
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
    ew.addEventHandlers("hours_exception");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
