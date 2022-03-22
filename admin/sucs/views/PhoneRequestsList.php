<?php

namespace PHPMaker2021\project4;

// Page object
$PhoneRequestsList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fphone_requestslist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fphone_requestslist = currentForm = new ew.Form("fphone_requestslist", "list");
    fphone_requestslist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fphone_requestslist");
});
var fphone_requestslistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fphone_requestslistsrch = currentSearchForm = new ew.Form("fphone_requestslistsrch");

    // Dynamic selection lists

    // Filters
    fphone_requestslistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fphone_requestslistsrch");
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
<form name="fphone_requestslistsrch" id="fphone_requestslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fphone_requestslistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="phone_requests">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> phone_requests">
<form name="fphone_requestslist" id="fphone_requestslist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="phone_requests">
<div id="gmp_phone_requests" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_phone_requestslist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->supervisor_name->Visible) { // supervisor_name ?>
        <th data-name="supervisor_name" class="<?= $Page->supervisor_name->headerCellClass() ?>"><div id="elh_phone_requests_supervisor_name" class="phone_requests_supervisor_name"><?= $Page->renderSort($Page->supervisor_name) ?></div></th>
<?php } ?>
<?php if ($Page->supervisor_phone->Visible) { // supervisor_phone ?>
        <th data-name="supervisor_phone" class="<?= $Page->supervisor_phone->headerCellClass() ?>"><div id="elh_phone_requests_supervisor_phone" class="phone_requests_supervisor_phone"><?= $Page->renderSort($Page->supervisor_phone) ?></div></th>
<?php } ?>
<?php if ($Page->employee_status->Visible) { // employee_status ?>
        <th data-name="employee_status" class="<?= $Page->employee_status->headerCellClass() ?>"><div id="elh_phone_requests_employee_status" class="phone_requests_employee_status"><?= $Page->renderSort($Page->employee_status) ?></div></th>
<?php } ?>
<?php if ($Page->building->Visible) { // building ?>
        <th data-name="building" class="<?= $Page->building->headerCellClass() ?>"><div id="elh_phone_requests_building" class="phone_requests_building"><?= $Page->renderSort($Page->building) ?></div></th>
<?php } ?>
<?php if ($Page->room_number->Visible) { // room_number ?>
        <th data-name="room_number" class="<?= $Page->room_number->headerCellClass() ?>"><div id="elh_phone_requests_room_number" class="phone_requests_room_number"><?= $Page->renderSort($Page->room_number) ?></div></th>
<?php } ?>
<?php if ($Page->net_id->Visible) { // net_id ?>
        <th data-name="net_id" class="<?= $Page->net_id->headerCellClass() ?>"><div id="elh_phone_requests_net_id" class="phone_requests_net_id"><?= $Page->renderSort($Page->net_id) ?></div></th>
<?php } ?>
<?php if ($Page->jack->Visible) { // jack ?>
        <th data-name="jack" class="<?= $Page->jack->headerCellClass() ?>"><div id="elh_phone_requests_jack" class="phone_requests_jack"><?= $Page->renderSort($Page->jack) ?></div></th>
<?php } ?>
<?php if ($Page->jack_id->Visible) { // jack_id ?>
        <th data-name="jack_id" class="<?= $Page->jack_id->headerCellClass() ?>"><div id="elh_phone_requests_jack_id" class="phone_requests_jack_id"><?= $Page->renderSort($Page->jack_id) ?></div></th>
<?php } ?>
<?php if ($Page->voicemail->Visible) { // voicemail ?>
        <th data-name="voicemail" class="<?= $Page->voicemail->headerCellClass() ?>"><div id="elh_phone_requests_voicemail" class="phone_requests_voicemail"><?= $Page->renderSort($Page->voicemail) ?></div></th>
<?php } ?>
<?php if ($Page->long_distance->Visible) { // long_distance ?>
        <th data-name="long_distance" class="<?= $Page->long_distance->headerCellClass() ?>"><div id="elh_phone_requests_long_distance" class="phone_requests_long_distance"><?= $Page->renderSort($Page->long_distance) ?></div></th>
<?php } ?>
<?php if ($Page->need_phone->Visible) { // need_phone ?>
        <th data-name="need_phone" class="<?= $Page->need_phone->headerCellClass() ?>"><div id="elh_phone_requests_need_phone" class="phone_requests_need_phone"><?= $Page->renderSort($Page->need_phone) ?></div></th>
<?php } ?>
<?php if ($Page->call_appearance->Visible) { // call_appearance ?>
        <th data-name="call_appearance" class="<?= $Page->call_appearance->headerCellClass() ?>"><div id="elh_phone_requests_call_appearance" class="phone_requests_call_appearance"><?= $Page->renderSort($Page->call_appearance) ?></div></th>
<?php } ?>
<?php if ($Page->kfs_number->Visible) { // kfs_number ?>
        <th data-name="kfs_number" class="<?= $Page->kfs_number->headerCellClass() ?>"><div id="elh_phone_requests_kfs_number" class="phone_requests_kfs_number"><?= $Page->renderSort($Page->kfs_number) ?></div></th>
<?php } ?>
<?php if ($Page->call_appearance1->Visible) { // call_appearance1 ?>
        <th data-name="call_appearance1" class="<?= $Page->call_appearance1->headerCellClass() ?>"><div id="elh_phone_requests_call_appearance1" class="phone_requests_call_appearance1"><?= $Page->renderSort($Page->call_appearance1) ?></div></th>
<?php } ?>
<?php if ($Page->call_appearance2->Visible) { // call_appearance2 ?>
        <th data-name="call_appearance2" class="<?= $Page->call_appearance2->headerCellClass() ?>"><div id="elh_phone_requests_call_appearance2" class="phone_requests_call_appearance2"><?= $Page->renderSort($Page->call_appearance2) ?></div></th>
<?php } ?>
<?php if ($Page->call_appearance3->Visible) { // call_appearance3 ?>
        <th data-name="call_appearance3" class="<?= $Page->call_appearance3->headerCellClass() ?>"><div id="elh_phone_requests_call_appearance3" class="phone_requests_call_appearance3"><?= $Page->renderSort($Page->call_appearance3) ?></div></th>
<?php } ?>
<?php if ($Page->call_appearance4->Visible) { // call_appearance4 ?>
        <th data-name="call_appearance4" class="<?= $Page->call_appearance4->headerCellClass() ?>"><div id="elh_phone_requests_call_appearance4" class="phone_requests_call_appearance4"><?= $Page->renderSort($Page->call_appearance4) ?></div></th>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <th data-name="timestamp" class="<?= $Page->timestamp->headerCellClass() ?>"><div id="elh_phone_requests_timestamp" class="phone_requests_timestamp"><?= $Page->renderSort($Page->timestamp) ?></div></th>
<?php } ?>
<?php if ($Page->ID->Visible) { // ID ?>
        <th data-name="ID" class="<?= $Page->ID->headerCellClass() ?>"><div id="elh_phone_requests_ID" class="phone_requests_ID"><?= $Page->renderSort($Page->ID) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_phone_requests", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->supervisor_name->Visible) { // supervisor_name ?>
        <td data-name="supervisor_name" <?= $Page->supervisor_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_supervisor_name">
<span<?= $Page->supervisor_name->viewAttributes() ?>>
<?= $Page->supervisor_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->supervisor_phone->Visible) { // supervisor_phone ?>
        <td data-name="supervisor_phone" <?= $Page->supervisor_phone->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_supervisor_phone">
<span<?= $Page->supervisor_phone->viewAttributes() ?>>
<?= $Page->supervisor_phone->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->employee_status->Visible) { // employee_status ?>
        <td data-name="employee_status" <?= $Page->employee_status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_employee_status">
<span<?= $Page->employee_status->viewAttributes() ?>>
<?= $Page->employee_status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->building->Visible) { // building ?>
        <td data-name="building" <?= $Page->building->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_building">
<span<?= $Page->building->viewAttributes() ?>>
<?= $Page->building->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->room_number->Visible) { // room_number ?>
        <td data-name="room_number" <?= $Page->room_number->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_room_number">
<span<?= $Page->room_number->viewAttributes() ?>>
<?= $Page->room_number->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->net_id->Visible) { // net_id ?>
        <td data-name="net_id" <?= $Page->net_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_net_id">
<span<?= $Page->net_id->viewAttributes() ?>>
<?= $Page->net_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jack->Visible) { // jack ?>
        <td data-name="jack" <?= $Page->jack->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_jack">
<span<?= $Page->jack->viewAttributes() ?>>
<?= $Page->jack->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jack_id->Visible) { // jack_id ?>
        <td data-name="jack_id" <?= $Page->jack_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_jack_id">
<span<?= $Page->jack_id->viewAttributes() ?>>
<?= $Page->jack_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->voicemail->Visible) { // voicemail ?>
        <td data-name="voicemail" <?= $Page->voicemail->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_voicemail">
<span<?= $Page->voicemail->viewAttributes() ?>>
<?= $Page->voicemail->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->long_distance->Visible) { // long_distance ?>
        <td data-name="long_distance" <?= $Page->long_distance->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_long_distance">
<span<?= $Page->long_distance->viewAttributes() ?>>
<?= $Page->long_distance->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->need_phone->Visible) { // need_phone ?>
        <td data-name="need_phone" <?= $Page->need_phone->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_need_phone">
<span<?= $Page->need_phone->viewAttributes() ?>>
<?= $Page->need_phone->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->call_appearance->Visible) { // call_appearance ?>
        <td data-name="call_appearance" <?= $Page->call_appearance->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_call_appearance">
<span<?= $Page->call_appearance->viewAttributes() ?>>
<?= $Page->call_appearance->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kfs_number->Visible) { // kfs_number ?>
        <td data-name="kfs_number" <?= $Page->kfs_number->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_kfs_number">
<span<?= $Page->kfs_number->viewAttributes() ?>>
<?= $Page->kfs_number->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->call_appearance1->Visible) { // call_appearance1 ?>
        <td data-name="call_appearance1" <?= $Page->call_appearance1->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_call_appearance1">
<span<?= $Page->call_appearance1->viewAttributes() ?>>
<?= $Page->call_appearance1->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->call_appearance2->Visible) { // call_appearance2 ?>
        <td data-name="call_appearance2" <?= $Page->call_appearance2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_call_appearance2">
<span<?= $Page->call_appearance2->viewAttributes() ?>>
<?= $Page->call_appearance2->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->call_appearance3->Visible) { // call_appearance3 ?>
        <td data-name="call_appearance3" <?= $Page->call_appearance3->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_call_appearance3">
<span<?= $Page->call_appearance3->viewAttributes() ?>>
<?= $Page->call_appearance3->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->call_appearance4->Visible) { // call_appearance4 ?>
        <td data-name="call_appearance4" <?= $Page->call_appearance4->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_call_appearance4">
<span<?= $Page->call_appearance4->viewAttributes() ?>>
<?= $Page->call_appearance4->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->timestamp->Visible) { // timestamp ?>
        <td data-name="timestamp" <?= $Page->timestamp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_timestamp">
<span<?= $Page->timestamp->viewAttributes() ?>>
<?= $Page->timestamp->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ID->Visible) { // ID ?>
        <td data-name="ID" <?= $Page->ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_ID">
<span<?= $Page->ID->viewAttributes() ?>>
<?= $Page->ID->getViewValue() ?></span>
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
    ew.addEventHandlers("phone_requests");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
