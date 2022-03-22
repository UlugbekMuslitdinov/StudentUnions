<?php

namespace PHPMaker2021\project4;

// Page object
$PosAccessRequestsList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpos_access_requestslist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fpos_access_requestslist = currentForm = new ew.Form("fpos_access_requestslist", "list");
    fpos_access_requestslist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fpos_access_requestslist");
});
var fpos_access_requestslistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fpos_access_requestslistsrch = currentSearchForm = new ew.Form("fpos_access_requestslistsrch");

    // Dynamic selection lists

    // Filters
    fpos_access_requestslistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fpos_access_requestslistsrch");
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
<form name="fpos_access_requestslistsrch" id="fpos_access_requestslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fpos_access_requestslistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="pos_access_requests">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> pos_access_requests">
<form name="fpos_access_requestslist" id="fpos_access_requestslist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pos_access_requests">
<div id="gmp_pos_access_requests" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_pos_access_requestslist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_pos_access_requests_id" class="pos_access_requests_id"><?= $Page->renderSort($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->supervisor_name->Visible) { // supervisor_name ?>
        <th data-name="supervisor_name" class="<?= $Page->supervisor_name->headerCellClass() ?>"><div id="elh_pos_access_requests_supervisor_name" class="pos_access_requests_supervisor_name"><?= $Page->renderSort($Page->supervisor_name) ?></div></th>
<?php } ?>
<?php if ($Page->supervisor_phone->Visible) { // supervisor_phone ?>
        <th data-name="supervisor_phone" class="<?= $Page->supervisor_phone->headerCellClass() ?>"><div id="elh_pos_access_requests_supervisor_phone" class="pos_access_requests_supervisor_phone"><?= $Page->renderSort($Page->supervisor_phone) ?></div></th>
<?php } ?>
<?php if ($Page->request_type->Visible) { // request_type ?>
        <th data-name="request_type" class="<?= $Page->request_type->headerCellClass() ?>"><div id="elh_pos_access_requests_request_type" class="pos_access_requests_request_type"><?= $Page->renderSort($Page->request_type) ?></div></th>
<?php } ?>
<?php if ($Page->employee_position->Visible) { // employee_position ?>
        <th data-name="employee_position" class="<?= $Page->employee_position->headerCellClass() ?>"><div id="elh_pos_access_requests_employee_position" class="pos_access_requests_employee_position"><?= $Page->renderSort($Page->employee_position) ?></div></th>
<?php } ?>
<?php if ($Page->employee_first_name->Visible) { // employee_first_name ?>
        <th data-name="employee_first_name" class="<?= $Page->employee_first_name->headerCellClass() ?>"><div id="elh_pos_access_requests_employee_first_name" class="pos_access_requests_employee_first_name"><?= $Page->renderSort($Page->employee_first_name) ?></div></th>
<?php } ?>
<?php if ($Page->employee_last_name->Visible) { // employee_last_name ?>
        <th data-name="employee_last_name" class="<?= $Page->employee_last_name->headerCellClass() ?>"><div id="elh_pos_access_requests_employee_last_name" class="pos_access_requests_employee_last_name"><?= $Page->renderSort($Page->employee_last_name) ?></div></th>
<?php } ?>
<?php if ($Page->employee_title->Visible) { // employee_title ?>
        <th data-name="employee_title" class="<?= $Page->employee_title->headerCellClass() ?>"><div id="elh_pos_access_requests_employee_title" class="pos_access_requests_employee_title"><?= $Page->renderSort($Page->employee_title) ?></div></th>
<?php } ?>
<?php if ($Page->employee_email->Visible) { // employee_email ?>
        <th data-name="employee_email" class="<?= $Page->employee_email->headerCellClass() ?>"><div id="elh_pos_access_requests_employee_email" class="pos_access_requests_employee_email"><?= $Page->renderSort($Page->employee_email) ?></div></th>
<?php } ?>
<?php if ($Page->employee_phone->Visible) { // employee_phone ?>
        <th data-name="employee_phone" class="<?= $Page->employee_phone->headerCellClass() ?>"><div id="elh_pos_access_requests_employee_phone" class="pos_access_requests_employee_phone"><?= $Page->renderSort($Page->employee_phone) ?></div></th>
<?php } ?>
<?php if ($Page->employee_unit->Visible) { // employee_unit ?>
        <th data-name="employee_unit" class="<?= $Page->employee_unit->headerCellClass() ?>"><div id="elh_pos_access_requests_employee_unit" class="pos_access_requests_employee_unit"><?= $Page->renderSort($Page->employee_unit) ?></div></th>
<?php } ?>
<?php if ($Page->employee_netid->Visible) { // employee_netid ?>
        <th data-name="employee_netid" class="<?= $Page->employee_netid->headerCellClass() ?>"><div id="elh_pos_access_requests_employee_netid" class="pos_access_requests_employee_netid"><?= $Page->renderSort($Page->employee_netid) ?></div></th>
<?php } ?>
<?php if ($Page->employee_id->Visible) { // employee_id ?>
        <th data-name="employee_id" class="<?= $Page->employee_id->headerCellClass() ?>"><div id="elh_pos_access_requests_employee_id" class="pos_access_requests_employee_id"><?= $Page->renderSort($Page->employee_id) ?></div></th>
<?php } ?>
<?php if ($Page->access->Visible) { // access ?>
        <th data-name="access" class="<?= $Page->access->headerCellClass() ?>"><div id="elh_pos_access_requests_access" class="pos_access_requests_access"><?= $Page->renderSort($Page->access) ?></div></th>
<?php } ?>
<?php if ($Page->catcard->Visible) { // catcard ?>
        <th data-name="catcard" class="<?= $Page->catcard->headerCellClass() ?>"><div id="elh_pos_access_requests_catcard" class="pos_access_requests_catcard"><?= $Page->renderSort($Page->catcard) ?></div></th>
<?php } ?>
<?php if ($Page->register_pin->Visible) { // register_pin ?>
        <th data-name="register_pin" class="<?= $Page->register_pin->headerCellClass() ?>"><div id="elh_pos_access_requests_register_pin" class="pos_access_requests_register_pin"><?= $Page->renderSort($Page->register_pin) ?></div></th>
<?php } ?>
<?php if ($Page->updates->Visible) { // updates ?>
        <th data-name="updates" class="<?= $Page->updates->headerCellClass() ?>"><div id="elh_pos_access_requests_updates" class="pos_access_requests_updates"><?= $Page->renderSort($Page->updates) ?></div></th>
<?php } ?>
<?php if ($Page->comments->Visible) { // comments ?>
        <th data-name="comments" class="<?= $Page->comments->headerCellClass() ?>"><div id="elh_pos_access_requests_comments" class="pos_access_requests_comments"><?= $Page->renderSort($Page->comments) ?></div></th>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <th data-name="timestamp" class="<?= $Page->timestamp->headerCellClass() ?>"><div id="elh_pos_access_requests_timestamp" class="pos_access_requests_timestamp"><?= $Page->renderSort($Page->timestamp) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_pos_access_requests", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_pos_access_requests_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->supervisor_name->Visible) { // supervisor_name ?>
        <td data-name="supervisor_name" <?= $Page->supervisor_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_supervisor_name">
<span<?= $Page->supervisor_name->viewAttributes() ?>>
<?= $Page->supervisor_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->supervisor_phone->Visible) { // supervisor_phone ?>
        <td data-name="supervisor_phone" <?= $Page->supervisor_phone->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_supervisor_phone">
<span<?= $Page->supervisor_phone->viewAttributes() ?>>
<?= $Page->supervisor_phone->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->request_type->Visible) { // request_type ?>
        <td data-name="request_type" <?= $Page->request_type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_request_type">
<span<?= $Page->request_type->viewAttributes() ?>>
<?= $Page->request_type->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->employee_position->Visible) { // employee_position ?>
        <td data-name="employee_position" <?= $Page->employee_position->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_employee_position">
<span<?= $Page->employee_position->viewAttributes() ?>>
<?= $Page->employee_position->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->employee_first_name->Visible) { // employee_first_name ?>
        <td data-name="employee_first_name" <?= $Page->employee_first_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_employee_first_name">
<span<?= $Page->employee_first_name->viewAttributes() ?>>
<?= $Page->employee_first_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->employee_last_name->Visible) { // employee_last_name ?>
        <td data-name="employee_last_name" <?= $Page->employee_last_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_employee_last_name">
<span<?= $Page->employee_last_name->viewAttributes() ?>>
<?= $Page->employee_last_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->employee_title->Visible) { // employee_title ?>
        <td data-name="employee_title" <?= $Page->employee_title->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_employee_title">
<span<?= $Page->employee_title->viewAttributes() ?>>
<?= $Page->employee_title->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->employee_email->Visible) { // employee_email ?>
        <td data-name="employee_email" <?= $Page->employee_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_employee_email">
<span<?= $Page->employee_email->viewAttributes() ?>>
<?= $Page->employee_email->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->employee_phone->Visible) { // employee_phone ?>
        <td data-name="employee_phone" <?= $Page->employee_phone->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_employee_phone">
<span<?= $Page->employee_phone->viewAttributes() ?>>
<?= $Page->employee_phone->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->employee_unit->Visible) { // employee_unit ?>
        <td data-name="employee_unit" <?= $Page->employee_unit->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_employee_unit">
<span<?= $Page->employee_unit->viewAttributes() ?>>
<?= $Page->employee_unit->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->employee_netid->Visible) { // employee_netid ?>
        <td data-name="employee_netid" <?= $Page->employee_netid->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_employee_netid">
<span<?= $Page->employee_netid->viewAttributes() ?>>
<?= $Page->employee_netid->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->employee_id->Visible) { // employee_id ?>
        <td data-name="employee_id" <?= $Page->employee_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_employee_id">
<span<?= $Page->employee_id->viewAttributes() ?>>
<?= $Page->employee_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->access->Visible) { // access ?>
        <td data-name="access" <?= $Page->access->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_access">
<span<?= $Page->access->viewAttributes() ?>>
<?= $Page->access->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->catcard->Visible) { // catcard ?>
        <td data-name="catcard" <?= $Page->catcard->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_catcard">
<span<?= $Page->catcard->viewAttributes() ?>>
<?= $Page->catcard->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->register_pin->Visible) { // register_pin ?>
        <td data-name="register_pin" <?= $Page->register_pin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_register_pin">
<span<?= $Page->register_pin->viewAttributes() ?>>
<?= $Page->register_pin->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->updates->Visible) { // updates ?>
        <td data-name="updates" <?= $Page->updates->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_updates">
<span<?= $Page->updates->viewAttributes() ?>>
<?= $Page->updates->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->comments->Visible) { // comments ?>
        <td data-name="comments" <?= $Page->comments->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_comments">
<span<?= $Page->comments->viewAttributes() ?>>
<?= $Page->comments->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->timestamp->Visible) { // timestamp ?>
        <td data-name="timestamp" <?= $Page->timestamp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_timestamp">
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
    ew.addEventHandlers("pos_access_requests");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
