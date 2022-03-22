<?php

namespace PHPMaker2021\project4;

// Page object
$DepartmentalAccessRequestsList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fdepartmental_access_requestslist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fdepartmental_access_requestslist = currentForm = new ew.Form("fdepartmental_access_requestslist", "list");
    fdepartmental_access_requestslist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fdepartmental_access_requestslist");
});
var fdepartmental_access_requestslistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fdepartmental_access_requestslistsrch = currentSearchForm = new ew.Form("fdepartmental_access_requestslistsrch");

    // Dynamic selection lists

    // Filters
    fdepartmental_access_requestslistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fdepartmental_access_requestslistsrch");
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
<form name="fdepartmental_access_requestslistsrch" id="fdepartmental_access_requestslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fdepartmental_access_requestslistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="departmental_access_requests">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> departmental_access_requests">
<form name="fdepartmental_access_requestslist" id="fdepartmental_access_requestslist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="departmental_access_requests">
<div id="gmp_departmental_access_requests" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_departmental_access_requestslist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_departmental_access_requests_id" class="departmental_access_requests_id"><?= $Page->renderSort($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->supervisor_name->Visible) { // supervisor_name ?>
        <th data-name="supervisor_name" class="<?= $Page->supervisor_name->headerCellClass() ?>"><div id="elh_departmental_access_requests_supervisor_name" class="departmental_access_requests_supervisor_name"><?= $Page->renderSort($Page->supervisor_name) ?></div></th>
<?php } ?>
<?php if ($Page->supervisor_phone->Visible) { // supervisor_phone ?>
        <th data-name="supervisor_phone" class="<?= $Page->supervisor_phone->headerCellClass() ?>"><div id="elh_departmental_access_requests_supervisor_phone" class="departmental_access_requests_supervisor_phone"><?= $Page->renderSort($Page->supervisor_phone) ?></div></th>
<?php } ?>
<?php if ($Page->supervisor_email->Visible) { // supervisor_email ?>
        <th data-name="supervisor_email" class="<?= $Page->supervisor_email->headerCellClass() ?>"><div id="elh_departmental_access_requests_supervisor_email" class="departmental_access_requests_supervisor_email"><?= $Page->renderSort($Page->supervisor_email) ?></div></th>
<?php } ?>
<?php if ($Page->employee_first_name->Visible) { // employee_first_name ?>
        <th data-name="employee_first_name" class="<?= $Page->employee_first_name->headerCellClass() ?>"><div id="elh_departmental_access_requests_employee_first_name" class="departmental_access_requests_employee_first_name"><?= $Page->renderSort($Page->employee_first_name) ?></div></th>
<?php } ?>
<?php if ($Page->employee_last_name->Visible) { // employee_last_name ?>
        <th data-name="employee_last_name" class="<?= $Page->employee_last_name->headerCellClass() ?>"><div id="elh_departmental_access_requests_employee_last_name" class="departmental_access_requests_employee_last_name"><?= $Page->renderSort($Page->employee_last_name) ?></div></th>
<?php } ?>
<?php if ($Page->employee_netid->Visible) { // employee_netid ?>
        <th data-name="employee_netid" class="<?= $Page->employee_netid->headerCellClass() ?>"><div id="elh_departmental_access_requests_employee_netid" class="departmental_access_requests_employee_netid"><?= $Page->renderSort($Page->employee_netid) ?></div></th>
<?php } ?>
<?php if ($Page->new_catwork->Visible) { // new_catwork ?>
        <th data-name="new_catwork" class="<?= $Page->new_catwork->headerCellClass() ?>"><div id="elh_departmental_access_requests_new_catwork" class="departmental_access_requests_new_catwork"><?= $Page->renderSort($Page->new_catwork) ?></div></th>
<?php } ?>
<?php if ($Page->delete->Visible) { // delete ?>
        <th data-name="delete" class="<?= $Page->delete->headerCellClass() ?>"><div id="elh_departmental_access_requests_delete" class="departmental_access_requests_delete"><?= $Page->renderSort($Page->delete) ?></div></th>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <th data-name="timestamp" class="<?= $Page->timestamp->headerCellClass() ?>"><div id="elh_departmental_access_requests_timestamp" class="departmental_access_requests_timestamp"><?= $Page->renderSort($Page->timestamp) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_departmental_access_requests", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_departmental_access_requests_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->supervisor_name->Visible) { // supervisor_name ?>
        <td data-name="supervisor_name" <?= $Page->supervisor_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_departmental_access_requests_supervisor_name">
<span<?= $Page->supervisor_name->viewAttributes() ?>>
<?= $Page->supervisor_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->supervisor_phone->Visible) { // supervisor_phone ?>
        <td data-name="supervisor_phone" <?= $Page->supervisor_phone->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_departmental_access_requests_supervisor_phone">
<span<?= $Page->supervisor_phone->viewAttributes() ?>>
<?= $Page->supervisor_phone->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->supervisor_email->Visible) { // supervisor_email ?>
        <td data-name="supervisor_email" <?= $Page->supervisor_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_departmental_access_requests_supervisor_email">
<span<?= $Page->supervisor_email->viewAttributes() ?>>
<?= $Page->supervisor_email->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->employee_first_name->Visible) { // employee_first_name ?>
        <td data-name="employee_first_name" <?= $Page->employee_first_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_departmental_access_requests_employee_first_name">
<span<?= $Page->employee_first_name->viewAttributes() ?>>
<?= $Page->employee_first_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->employee_last_name->Visible) { // employee_last_name ?>
        <td data-name="employee_last_name" <?= $Page->employee_last_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_departmental_access_requests_employee_last_name">
<span<?= $Page->employee_last_name->viewAttributes() ?>>
<?= $Page->employee_last_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->employee_netid->Visible) { // employee_netid ?>
        <td data-name="employee_netid" <?= $Page->employee_netid->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_departmental_access_requests_employee_netid">
<span<?= $Page->employee_netid->viewAttributes() ?>>
<?= $Page->employee_netid->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->new_catwork->Visible) { // new_catwork ?>
        <td data-name="new_catwork" <?= $Page->new_catwork->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_departmental_access_requests_new_catwork">
<span<?= $Page->new_catwork->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_new_catwork_<?= $Page->RowCount ?>" class="custom-control-input" value="<?= $Page->new_catwork->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->new_catwork->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_new_catwork_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->delete->Visible) { // delete ?>
        <td data-name="delete" <?= $Page->delete->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_departmental_access_requests_delete">
<span<?= $Page->delete->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_delete_<?= $Page->RowCount ?>" class="custom-control-input" value="<?= $Page->delete->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->delete->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_delete_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->timestamp->Visible) { // timestamp ?>
        <td data-name="timestamp" <?= $Page->timestamp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_departmental_access_requests_timestamp">
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
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
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
    ew.addEventHandlers("departmental_access_requests");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
