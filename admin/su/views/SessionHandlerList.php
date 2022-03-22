<?php

namespace PHPMaker2021\project1;

// Page object
$SessionHandlerList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fsession_handlerlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fsession_handlerlist = currentForm = new ew.Form("fsession_handlerlist", "list");
    fsession_handlerlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fsession_handlerlist");
});
var fsession_handlerlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fsession_handlerlistsrch = currentSearchForm = new ew.Form("fsession_handlerlistsrch");

    // Dynamic selection lists

    // Filters
    fsession_handlerlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fsession_handlerlistsrch");
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
<form name="fsession_handlerlistsrch" id="fsession_handlerlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl() ?>">
<div id="fsession_handlerlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="session_handler">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> session_handler">
<form name="fsession_handlerlist" id="fsession_handlerlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="session_handler">
<div id="gmp_session_handler" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_session_handlerlist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_session_handler_id" class="session_handler_id"><?= $Page->renderSort($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->custnum->Visible) { // custnum ?>
        <th data-name="custnum" class="<?= $Page->custnum->headerCellClass() ?>"><div id="elh_session_handler_custnum" class="session_handler_custnum"><?= $Page->renderSort($Page->custnum) ?></div></th>
<?php } ?>
<?php if ($Page->cust_id->Visible) { // cust_id ?>
        <th data-name="cust_id" class="<?= $Page->cust_id->headerCellClass() ?>"><div id="elh_session_handler_cust_id" class="session_handler_cust_id"><?= $Page->renderSort($Page->cust_id) ?></div></th>
<?php } ?>
<?php if ($Page->netid->Visible) { // netid ?>
        <th data-name="netid" class="<?= $Page->netid->headerCellClass() ?>"><div id="elh_session_handler_netid" class="session_handler_netid"><?= $Page->renderSort($Page->netid) ?></div></th>
<?php } ?>
<?php if ($Page->firstname->Visible) { // firstname ?>
        <th data-name="firstname" class="<?= $Page->firstname->headerCellClass() ?>"><div id="elh_session_handler_firstname" class="session_handler_firstname"><?= $Page->renderSort($Page->firstname) ?></div></th>
<?php } ?>
<?php if ($Page->lastname->Visible) { // lastname ?>
        <th data-name="lastname" class="<?= $Page->lastname->headerCellClass() ?>"><div id="elh_session_handler_lastname" class="session_handler_lastname"><?= $Page->renderSort($Page->lastname) ?></div></th>
<?php } ?>
<?php if ($Page->mp_state->Visible) { // mp_state ?>
        <th data-name="mp_state" class="<?= $Page->mp_state->headerCellClass() ?>"><div id="elh_session_handler_mp_state" class="session_handler_mp_state"><?= $Page->renderSort($Page->mp_state) ?></div></th>
<?php } ?>
<?php if ($Page->deposit_to->Visible) { // deposit_to ?>
        <th data-name="deposit_to" class="<?= $Page->deposit_to->headerCellClass() ?>"><div id="elh_session_handler_deposit_to" class="session_handler_deposit_to"><?= $Page->renderSort($Page->deposit_to) ?></div></th>
<?php } ?>
<?php if ($Page->iso->Visible) { // iso ?>
        <th data-name="iso" class="<?= $Page->iso->headerCellClass() ?>"><div id="elh_session_handler_iso" class="session_handler_iso"><?= $Page->renderSort($Page->iso) ?></div></th>
<?php } ?>
<?php if ($Page->activestudent->Visible) { // activestudent ?>
        <th data-name="activestudent" class="<?= $Page->activestudent->headerCellClass() ?>"><div id="elh_session_handler_activestudent" class="session_handler_activestudent"><?= $Page->renderSort($Page->activestudent) ?></div></th>
<?php } ?>
<?php if ($Page->activeemployee->Visible) { // activeemployee ?>
        <th data-name="activeemployee" class="<?= $Page->activeemployee->headerCellClass() ?>"><div id="elh_session_handler_activeemployee" class="session_handler_activeemployee"><?= $Page->renderSort($Page->activeemployee) ?></div></th>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <th data-name="timestamp" class="<?= $Page->timestamp->headerCellClass() ?>"><div id="elh_session_handler_timestamp" class="session_handler_timestamp"><?= $Page->renderSort($Page->timestamp) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_session_handler", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_session_handler_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->custnum->Visible) { // custnum ?>
        <td data-name="custnum" <?= $Page->custnum->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_session_handler_custnum">
<span<?= $Page->custnum->viewAttributes() ?>>
<?= $Page->custnum->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->cust_id->Visible) { // cust_id ?>
        <td data-name="cust_id" <?= $Page->cust_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_session_handler_cust_id">
<span<?= $Page->cust_id->viewAttributes() ?>>
<?= $Page->cust_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->netid->Visible) { // netid ?>
        <td data-name="netid" <?= $Page->netid->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_session_handler_netid">
<span<?= $Page->netid->viewAttributes() ?>>
<?= $Page->netid->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->firstname->Visible) { // firstname ?>
        <td data-name="firstname" <?= $Page->firstname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_session_handler_firstname">
<span<?= $Page->firstname->viewAttributes() ?>>
<?= $Page->firstname->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->lastname->Visible) { // lastname ?>
        <td data-name="lastname" <?= $Page->lastname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_session_handler_lastname">
<span<?= $Page->lastname->viewAttributes() ?>>
<?= $Page->lastname->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->mp_state->Visible) { // mp_state ?>
        <td data-name="mp_state" <?= $Page->mp_state->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_session_handler_mp_state">
<span<?= $Page->mp_state->viewAttributes() ?>>
<?= $Page->mp_state->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->deposit_to->Visible) { // deposit_to ?>
        <td data-name="deposit_to" <?= $Page->deposit_to->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_session_handler_deposit_to">
<span<?= $Page->deposit_to->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_deposit_to_<?= $Page->RowCount ?>" class="custom-control-input" value="<?= $Page->deposit_to->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->deposit_to->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_deposit_to_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->iso->Visible) { // iso ?>
        <td data-name="iso" <?= $Page->iso->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_session_handler_iso">
<span<?= $Page->iso->viewAttributes() ?>>
<?= $Page->iso->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->activestudent->Visible) { // activestudent ?>
        <td data-name="activestudent" <?= $Page->activestudent->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_session_handler_activestudent">
<span<?= $Page->activestudent->viewAttributes() ?>>
<?= $Page->activestudent->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->activeemployee->Visible) { // activeemployee ?>
        <td data-name="activeemployee" <?= $Page->activeemployee->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_session_handler_activeemployee">
<span<?= $Page->activeemployee->viewAttributes() ?>>
<?= $Page->activeemployee->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->timestamp->Visible) { // timestamp ?>
        <td data-name="timestamp" <?= $Page->timestamp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_session_handler_timestamp">
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
    ew.addEventHandlers("session_handler");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
