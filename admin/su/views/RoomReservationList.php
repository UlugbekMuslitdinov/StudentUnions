<?php

namespace PHPMaker2021\project1;

// Page object
$RoomReservationList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var froom_reservationlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    froom_reservationlist = currentForm = new ew.Form("froom_reservationlist", "list");
    froom_reservationlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("froom_reservationlist");
});
var froom_reservationlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    froom_reservationlistsrch = currentSearchForm = new ew.Form("froom_reservationlistsrch");

    // Dynamic selection lists

    // Filters
    froom_reservationlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("froom_reservationlistsrch");
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
<form name="froom_reservationlistsrch" id="froom_reservationlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl() ?>">
<div id="froom_reservationlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="room_reservation">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> room_reservation">
<form name="froom_reservationlist" id="froom_reservationlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="room_reservation">
<div id="gmp_room_reservation" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_room_reservationlist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_room_reservation_id" class="room_reservation_id"><?= $Page->renderSort($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->contact_org->Visible) { // contact_org ?>
        <th data-name="contact_org" class="<?= $Page->contact_org->headerCellClass() ?>"><div id="elh_room_reservation_contact_org" class="room_reservation_contact_org"><?= $Page->renderSort($Page->contact_org) ?></div></th>
<?php } ?>
<?php if ($Page->contact_name->Visible) { // contact_name ?>
        <th data-name="contact_name" class="<?= $Page->contact_name->headerCellClass() ?>"><div id="elh_room_reservation_contact_name" class="room_reservation_contact_name"><?= $Page->renderSort($Page->contact_name) ?></div></th>
<?php } ?>
<?php if ($Page->contact_email->Visible) { // contact_email ?>
        <th data-name="contact_email" class="<?= $Page->contact_email->headerCellClass() ?>"><div id="elh_room_reservation_contact_email" class="room_reservation_contact_email"><?= $Page->renderSort($Page->contact_email) ?></div></th>
<?php } ?>
<?php if ($Page->contact_phone->Visible) { // contact_phone ?>
        <th data-name="contact_phone" class="<?= $Page->contact_phone->headerCellClass() ?>"><div id="elh_room_reservation_contact_phone" class="room_reservation_contact_phone"><?= $Page->renderSort($Page->contact_phone) ?></div></th>
<?php } ?>
<?php if ($Page->contact_fax->Visible) { // contact_fax ?>
        <th data-name="contact_fax" class="<?= $Page->contact_fax->headerCellClass() ?>"><div id="elh_room_reservation_contact_fax" class="room_reservation_contact_fax"><?= $Page->renderSort($Page->contact_fax) ?></div></th>
<?php } ?>
<?php if ($Page->contact_address->Visible) { // contact_address ?>
        <th data-name="contact_address" class="<?= $Page->contact_address->headerCellClass() ?>"><div id="elh_room_reservation_contact_address" class="room_reservation_contact_address"><?= $Page->renderSort($Page->contact_address) ?></div></th>
<?php } ?>
<?php if ($Page->contact_city->Visible) { // contact_city ?>
        <th data-name="contact_city" class="<?= $Page->contact_city->headerCellClass() ?>"><div id="elh_room_reservation_contact_city" class="room_reservation_contact_city"><?= $Page->renderSort($Page->contact_city) ?></div></th>
<?php } ?>
<?php if ($Page->contact_state->Visible) { // contact_state ?>
        <th data-name="contact_state" class="<?= $Page->contact_state->headerCellClass() ?>"><div id="elh_room_reservation_contact_state" class="room_reservation_contact_state"><?= $Page->renderSort($Page->contact_state) ?></div></th>
<?php } ?>
<?php if ($Page->contact_zip->Visible) { // contact_zip ?>
        <th data-name="contact_zip" class="<?= $Page->contact_zip->headerCellClass() ?>"><div id="elh_room_reservation_contact_zip" class="room_reservation_contact_zip"><?= $Page->renderSort($Page->contact_zip) ?></div></th>
<?php } ?>
<?php if ($Page->contact_advisor->Visible) { // contact_advisor ?>
        <th data-name="contact_advisor" class="<?= $Page->contact_advisor->headerCellClass() ?>"><div id="elh_room_reservation_contact_advisor" class="room_reservation_contact_advisor"><?= $Page->renderSort($Page->contact_advisor) ?></div></th>
<?php } ?>
<?php if ($Page->contact_advisor_phone->Visible) { // contact_advisor_phone ?>
        <th data-name="contact_advisor_phone" class="<?= $Page->contact_advisor_phone->headerCellClass() ?>"><div id="elh_room_reservation_contact_advisor_phone" class="room_reservation_contact_advisor_phone"><?= $Page->renderSort($Page->contact_advisor_phone) ?></div></th>
<?php } ?>
<?php if ($Page->contact_advisor_email->Visible) { // contact_advisor_email ?>
        <th data-name="contact_advisor_email" class="<?= $Page->contact_advisor_email->headerCellClass() ?>"><div id="elh_room_reservation_contact_advisor_email" class="room_reservation_contact_advisor_email"><?= $Page->renderSort($Page->contact_advisor_email) ?></div></th>
<?php } ?>
<?php if ($Page->billing_org->Visible) { // billing_org ?>
        <th data-name="billing_org" class="<?= $Page->billing_org->headerCellClass() ?>"><div id="elh_room_reservation_billing_org" class="room_reservation_billing_org"><?= $Page->renderSort($Page->billing_org) ?></div></th>
<?php } ?>
<?php if ($Page->billing_name->Visible) { // billing_name ?>
        <th data-name="billing_name" class="<?= $Page->billing_name->headerCellClass() ?>"><div id="elh_room_reservation_billing_name" class="room_reservation_billing_name"><?= $Page->renderSort($Page->billing_name) ?></div></th>
<?php } ?>
<?php if ($Page->billing_email->Visible) { // billing_email ?>
        <th data-name="billing_email" class="<?= $Page->billing_email->headerCellClass() ?>"><div id="elh_room_reservation_billing_email" class="room_reservation_billing_email"><?= $Page->renderSort($Page->billing_email) ?></div></th>
<?php } ?>
<?php if ($Page->billing_phone->Visible) { // billing_phone ?>
        <th data-name="billing_phone" class="<?= $Page->billing_phone->headerCellClass() ?>"><div id="elh_room_reservation_billing_phone" class="room_reservation_billing_phone"><?= $Page->renderSort($Page->billing_phone) ?></div></th>
<?php } ?>
<?php if ($Page->billing_fax->Visible) { // billing_fax ?>
        <th data-name="billing_fax" class="<?= $Page->billing_fax->headerCellClass() ?>"><div id="elh_room_reservation_billing_fax" class="room_reservation_billing_fax"><?= $Page->renderSort($Page->billing_fax) ?></div></th>
<?php } ?>
<?php if ($Page->billing_address->Visible) { // billing_address ?>
        <th data-name="billing_address" class="<?= $Page->billing_address->headerCellClass() ?>"><div id="elh_room_reservation_billing_address" class="room_reservation_billing_address"><?= $Page->renderSort($Page->billing_address) ?></div></th>
<?php } ?>
<?php if ($Page->billing_city->Visible) { // billing_city ?>
        <th data-name="billing_city" class="<?= $Page->billing_city->headerCellClass() ?>"><div id="elh_room_reservation_billing_city" class="room_reservation_billing_city"><?= $Page->renderSort($Page->billing_city) ?></div></th>
<?php } ?>
<?php if ($Page->billing_state->Visible) { // billing_state ?>
        <th data-name="billing_state" class="<?= $Page->billing_state->headerCellClass() ?>"><div id="elh_room_reservation_billing_state" class="room_reservation_billing_state"><?= $Page->renderSort($Page->billing_state) ?></div></th>
<?php } ?>
<?php if ($Page->billing_zip->Visible) { // billing_zip ?>
        <th data-name="billing_zip" class="<?= $Page->billing_zip->headerCellClass() ?>"><div id="elh_room_reservation_billing_zip" class="room_reservation_billing_zip"><?= $Page->renderSort($Page->billing_zip) ?></div></th>
<?php } ?>
<?php if ($Page->billing_method->Visible) { // billing_method ?>
        <th data-name="billing_method" class="<?= $Page->billing_method->headerCellClass() ?>"><div id="elh_room_reservation_billing_method" class="room_reservation_billing_method"><?= $Page->renderSort($Page->billing_method) ?></div></th>
<?php } ?>
<?php if ($Page->billing_frs->Visible) { // billing_frs ?>
        <th data-name="billing_frs" class="<?= $Page->billing_frs->headerCellClass() ?>"><div id="elh_room_reservation_billing_frs" class="room_reservation_billing_frs"><?= $Page->renderSort($Page->billing_frs) ?></div></th>
<?php } ?>
<?php if ($Page->event_title->Visible) { // event_title ?>
        <th data-name="event_title" class="<?= $Page->event_title->headerCellClass() ?>"><div id="elh_room_reservation_event_title" class="room_reservation_event_title"><?= $Page->renderSort($Page->event_title) ?></div></th>
<?php } ?>
<?php if ($Page->event_type->Visible) { // event_type ?>
        <th data-name="event_type" class="<?= $Page->event_type->headerCellClass() ?>"><div id="elh_room_reservation_event_type" class="room_reservation_event_type"><?= $Page->renderSort($Page->event_type) ?></div></th>
<?php } ?>
<?php if ($Page->event_date->Visible) { // event_date ?>
        <th data-name="event_date" class="<?= $Page->event_date->headerCellClass() ?>"><div id="elh_room_reservation_event_date" class="room_reservation_event_date"><?= $Page->renderSort($Page->event_date) ?></div></th>
<?php } ?>
<?php if ($Page->event_time_start->Visible) { // event_time_start ?>
        <th data-name="event_time_start" class="<?= $Page->event_time_start->headerCellClass() ?>"><div id="elh_room_reservation_event_time_start" class="room_reservation_event_time_start"><?= $Page->renderSort($Page->event_time_start) ?></div></th>
<?php } ?>
<?php if ($Page->event_time_end->Visible) { // event_time_end ?>
        <th data-name="event_time_end" class="<?= $Page->event_time_end->headerCellClass() ?>"><div id="elh_room_reservation_event_time_end" class="room_reservation_event_time_end"><?= $Page->renderSort($Page->event_time_end) ?></div></th>
<?php } ?>
<?php if ($Page->event_num_people->Visible) { // event_num_people ?>
        <th data-name="event_num_people" class="<?= $Page->event_num_people->headerCellClass() ?>"><div id="elh_room_reservation_event_num_people" class="room_reservation_event_num_people"><?= $Page->renderSort($Page->event_num_people) ?></div></th>
<?php } ?>
<?php if ($Page->event_room_preference->Visible) { // event_room_preference ?>
        <th data-name="event_room_preference" class="<?= $Page->event_room_preference->headerCellClass() ?>"><div id="elh_room_reservation_event_room_preference" class="room_reservation_event_room_preference"><?= $Page->renderSort($Page->event_room_preference) ?></div></th>
<?php } ?>
<?php if ($Page->recurring_jan->Visible) { // recurring_jan ?>
        <th data-name="recurring_jan" class="<?= $Page->recurring_jan->headerCellClass() ?>"><div id="elh_room_reservation_recurring_jan" class="room_reservation_recurring_jan"><?= $Page->renderSort($Page->recurring_jan) ?></div></th>
<?php } ?>
<?php if ($Page->recurring_feb->Visible) { // recurring_feb ?>
        <th data-name="recurring_feb" class="<?= $Page->recurring_feb->headerCellClass() ?>"><div id="elh_room_reservation_recurring_feb" class="room_reservation_recurring_feb"><?= $Page->renderSort($Page->recurring_feb) ?></div></th>
<?php } ?>
<?php if ($Page->recurring_mar->Visible) { // recurring_mar ?>
        <th data-name="recurring_mar" class="<?= $Page->recurring_mar->headerCellClass() ?>"><div id="elh_room_reservation_recurring_mar" class="room_reservation_recurring_mar"><?= $Page->renderSort($Page->recurring_mar) ?></div></th>
<?php } ?>
<?php if ($Page->recurring_apr->Visible) { // recurring_apr ?>
        <th data-name="recurring_apr" class="<?= $Page->recurring_apr->headerCellClass() ?>"><div id="elh_room_reservation_recurring_apr" class="room_reservation_recurring_apr"><?= $Page->renderSort($Page->recurring_apr) ?></div></th>
<?php } ?>
<?php if ($Page->recurring_may->Visible) { // recurring_may ?>
        <th data-name="recurring_may" class="<?= $Page->recurring_may->headerCellClass() ?>"><div id="elh_room_reservation_recurring_may" class="room_reservation_recurring_may"><?= $Page->renderSort($Page->recurring_may) ?></div></th>
<?php } ?>
<?php if ($Page->recurring_jun->Visible) { // recurring_jun ?>
        <th data-name="recurring_jun" class="<?= $Page->recurring_jun->headerCellClass() ?>"><div id="elh_room_reservation_recurring_jun" class="room_reservation_recurring_jun"><?= $Page->renderSort($Page->recurring_jun) ?></div></th>
<?php } ?>
<?php if ($Page->recurring_jul->Visible) { // recurring_jul ?>
        <th data-name="recurring_jul" class="<?= $Page->recurring_jul->headerCellClass() ?>"><div id="elh_room_reservation_recurring_jul" class="room_reservation_recurring_jul"><?= $Page->renderSort($Page->recurring_jul) ?></div></th>
<?php } ?>
<?php if ($Page->recurring_aug->Visible) { // recurring_aug ?>
        <th data-name="recurring_aug" class="<?= $Page->recurring_aug->headerCellClass() ?>"><div id="elh_room_reservation_recurring_aug" class="room_reservation_recurring_aug"><?= $Page->renderSort($Page->recurring_aug) ?></div></th>
<?php } ?>
<?php if ($Page->recurring_sep->Visible) { // recurring_sep ?>
        <th data-name="recurring_sep" class="<?= $Page->recurring_sep->headerCellClass() ?>"><div id="elh_room_reservation_recurring_sep" class="room_reservation_recurring_sep"><?= $Page->renderSort($Page->recurring_sep) ?></div></th>
<?php } ?>
<?php if ($Page->recurring_oct->Visible) { // recurring_oct ?>
        <th data-name="recurring_oct" class="<?= $Page->recurring_oct->headerCellClass() ?>"><div id="elh_room_reservation_recurring_oct" class="room_reservation_recurring_oct"><?= $Page->renderSort($Page->recurring_oct) ?></div></th>
<?php } ?>
<?php if ($Page->recurring_nov->Visible) { // recurring_nov ?>
        <th data-name="recurring_nov" class="<?= $Page->recurring_nov->headerCellClass() ?>"><div id="elh_room_reservation_recurring_nov" class="room_reservation_recurring_nov"><?= $Page->renderSort($Page->recurring_nov) ?></div></th>
<?php } ?>
<?php if ($Page->recurring_dec->Visible) { // recurring_dec ?>
        <th data-name="recurring_dec" class="<?= $Page->recurring_dec->headerCellClass() ?>"><div id="elh_room_reservation_recurring_dec" class="room_reservation_recurring_dec"><?= $Page->renderSort($Page->recurring_dec) ?></div></th>
<?php } ?>
<?php if ($Page->setup_shape->Visible) { // setup_shape ?>
        <th data-name="setup_shape" class="<?= $Page->setup_shape->headerCellClass() ?>"><div id="elh_room_reservation_setup_shape" class="room_reservation_setup_shape"><?= $Page->renderSort($Page->setup_shape) ?></div></th>
<?php } ?>
<?php if ($Page->certification_name->Visible) { // certification_name ?>
        <th data-name="certification_name" class="<?= $Page->certification_name->headerCellClass() ?>"><div id="elh_room_reservation_certification_name" class="room_reservation_certification_name"><?= $Page->renderSort($Page->certification_name) ?></div></th>
<?php } ?>
<?php if ($Page->certification_date->Visible) { // certification_date ?>
        <th data-name="certification_date" class="<?= $Page->certification_date->headerCellClass() ?>"><div id="elh_room_reservation_certification_date" class="room_reservation_certification_date"><?= $Page->renderSort($Page->certification_date) ?></div></th>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <th data-name="timestamp" class="<?= $Page->timestamp->headerCellClass() ?>"><div id="elh_room_reservation_timestamp" class="room_reservation_timestamp"><?= $Page->renderSort($Page->timestamp) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_room_reservation", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_room_reservation_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->contact_org->Visible) { // contact_org ?>
        <td data-name="contact_org" <?= $Page->contact_org->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_contact_org">
<span<?= $Page->contact_org->viewAttributes() ?>>
<?= $Page->contact_org->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->contact_name->Visible) { // contact_name ?>
        <td data-name="contact_name" <?= $Page->contact_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_contact_name">
<span<?= $Page->contact_name->viewAttributes() ?>>
<?= $Page->contact_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->contact_email->Visible) { // contact_email ?>
        <td data-name="contact_email" <?= $Page->contact_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_contact_email">
<span<?= $Page->contact_email->viewAttributes() ?>>
<?= $Page->contact_email->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->contact_phone->Visible) { // contact_phone ?>
        <td data-name="contact_phone" <?= $Page->contact_phone->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_contact_phone">
<span<?= $Page->contact_phone->viewAttributes() ?>>
<?= $Page->contact_phone->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->contact_fax->Visible) { // contact_fax ?>
        <td data-name="contact_fax" <?= $Page->contact_fax->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_contact_fax">
<span<?= $Page->contact_fax->viewAttributes() ?>>
<?= $Page->contact_fax->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->contact_address->Visible) { // contact_address ?>
        <td data-name="contact_address" <?= $Page->contact_address->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_contact_address">
<span<?= $Page->contact_address->viewAttributes() ?>>
<?= $Page->contact_address->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->contact_city->Visible) { // contact_city ?>
        <td data-name="contact_city" <?= $Page->contact_city->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_contact_city">
<span<?= $Page->contact_city->viewAttributes() ?>>
<?= $Page->contact_city->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->contact_state->Visible) { // contact_state ?>
        <td data-name="contact_state" <?= $Page->contact_state->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_contact_state">
<span<?= $Page->contact_state->viewAttributes() ?>>
<?= $Page->contact_state->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->contact_zip->Visible) { // contact_zip ?>
        <td data-name="contact_zip" <?= $Page->contact_zip->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_contact_zip">
<span<?= $Page->contact_zip->viewAttributes() ?>>
<?= $Page->contact_zip->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->contact_advisor->Visible) { // contact_advisor ?>
        <td data-name="contact_advisor" <?= $Page->contact_advisor->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_contact_advisor">
<span<?= $Page->contact_advisor->viewAttributes() ?>>
<?= $Page->contact_advisor->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->contact_advisor_phone->Visible) { // contact_advisor_phone ?>
        <td data-name="contact_advisor_phone" <?= $Page->contact_advisor_phone->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_contact_advisor_phone">
<span<?= $Page->contact_advisor_phone->viewAttributes() ?>>
<?= $Page->contact_advisor_phone->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->contact_advisor_email->Visible) { // contact_advisor_email ?>
        <td data-name="contact_advisor_email" <?= $Page->contact_advisor_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_contact_advisor_email">
<span<?= $Page->contact_advisor_email->viewAttributes() ?>>
<?= $Page->contact_advisor_email->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->billing_org->Visible) { // billing_org ?>
        <td data-name="billing_org" <?= $Page->billing_org->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_billing_org">
<span<?= $Page->billing_org->viewAttributes() ?>>
<?= $Page->billing_org->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->billing_name->Visible) { // billing_name ?>
        <td data-name="billing_name" <?= $Page->billing_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_billing_name">
<span<?= $Page->billing_name->viewAttributes() ?>>
<?= $Page->billing_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->billing_email->Visible) { // billing_email ?>
        <td data-name="billing_email" <?= $Page->billing_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_billing_email">
<span<?= $Page->billing_email->viewAttributes() ?>>
<?= $Page->billing_email->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->billing_phone->Visible) { // billing_phone ?>
        <td data-name="billing_phone" <?= $Page->billing_phone->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_billing_phone">
<span<?= $Page->billing_phone->viewAttributes() ?>>
<?= $Page->billing_phone->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->billing_fax->Visible) { // billing_fax ?>
        <td data-name="billing_fax" <?= $Page->billing_fax->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_billing_fax">
<span<?= $Page->billing_fax->viewAttributes() ?>>
<?= $Page->billing_fax->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->billing_address->Visible) { // billing_address ?>
        <td data-name="billing_address" <?= $Page->billing_address->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_billing_address">
<span<?= $Page->billing_address->viewAttributes() ?>>
<?= $Page->billing_address->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->billing_city->Visible) { // billing_city ?>
        <td data-name="billing_city" <?= $Page->billing_city->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_billing_city">
<span<?= $Page->billing_city->viewAttributes() ?>>
<?= $Page->billing_city->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->billing_state->Visible) { // billing_state ?>
        <td data-name="billing_state" <?= $Page->billing_state->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_billing_state">
<span<?= $Page->billing_state->viewAttributes() ?>>
<?= $Page->billing_state->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->billing_zip->Visible) { // billing_zip ?>
        <td data-name="billing_zip" <?= $Page->billing_zip->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_billing_zip">
<span<?= $Page->billing_zip->viewAttributes() ?>>
<?= $Page->billing_zip->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->billing_method->Visible) { // billing_method ?>
        <td data-name="billing_method" <?= $Page->billing_method->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_billing_method">
<span<?= $Page->billing_method->viewAttributes() ?>>
<?= $Page->billing_method->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->billing_frs->Visible) { // billing_frs ?>
        <td data-name="billing_frs" <?= $Page->billing_frs->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_billing_frs">
<span<?= $Page->billing_frs->viewAttributes() ?>>
<?= $Page->billing_frs->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->event_title->Visible) { // event_title ?>
        <td data-name="event_title" <?= $Page->event_title->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_event_title">
<span<?= $Page->event_title->viewAttributes() ?>>
<?= $Page->event_title->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->event_type->Visible) { // event_type ?>
        <td data-name="event_type" <?= $Page->event_type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_event_type">
<span<?= $Page->event_type->viewAttributes() ?>>
<?= $Page->event_type->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->event_date->Visible) { // event_date ?>
        <td data-name="event_date" <?= $Page->event_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_event_date">
<span<?= $Page->event_date->viewAttributes() ?>>
<?= $Page->event_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->event_time_start->Visible) { // event_time_start ?>
        <td data-name="event_time_start" <?= $Page->event_time_start->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_event_time_start">
<span<?= $Page->event_time_start->viewAttributes() ?>>
<?= $Page->event_time_start->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->event_time_end->Visible) { // event_time_end ?>
        <td data-name="event_time_end" <?= $Page->event_time_end->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_event_time_end">
<span<?= $Page->event_time_end->viewAttributes() ?>>
<?= $Page->event_time_end->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->event_num_people->Visible) { // event_num_people ?>
        <td data-name="event_num_people" <?= $Page->event_num_people->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_event_num_people">
<span<?= $Page->event_num_people->viewAttributes() ?>>
<?= $Page->event_num_people->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->event_room_preference->Visible) { // event_room_preference ?>
        <td data-name="event_room_preference" <?= $Page->event_room_preference->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_event_room_preference">
<span<?= $Page->event_room_preference->viewAttributes() ?>>
<?= $Page->event_room_preference->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->recurring_jan->Visible) { // recurring_jan ?>
        <td data-name="recurring_jan" <?= $Page->recurring_jan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_recurring_jan">
<span<?= $Page->recurring_jan->viewAttributes() ?>>
<?= $Page->recurring_jan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->recurring_feb->Visible) { // recurring_feb ?>
        <td data-name="recurring_feb" <?= $Page->recurring_feb->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_recurring_feb">
<span<?= $Page->recurring_feb->viewAttributes() ?>>
<?= $Page->recurring_feb->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->recurring_mar->Visible) { // recurring_mar ?>
        <td data-name="recurring_mar" <?= $Page->recurring_mar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_recurring_mar">
<span<?= $Page->recurring_mar->viewAttributes() ?>>
<?= $Page->recurring_mar->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->recurring_apr->Visible) { // recurring_apr ?>
        <td data-name="recurring_apr" <?= $Page->recurring_apr->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_recurring_apr">
<span<?= $Page->recurring_apr->viewAttributes() ?>>
<?= $Page->recurring_apr->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->recurring_may->Visible) { // recurring_may ?>
        <td data-name="recurring_may" <?= $Page->recurring_may->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_recurring_may">
<span<?= $Page->recurring_may->viewAttributes() ?>>
<?= $Page->recurring_may->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->recurring_jun->Visible) { // recurring_jun ?>
        <td data-name="recurring_jun" <?= $Page->recurring_jun->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_recurring_jun">
<span<?= $Page->recurring_jun->viewAttributes() ?>>
<?= $Page->recurring_jun->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->recurring_jul->Visible) { // recurring_jul ?>
        <td data-name="recurring_jul" <?= $Page->recurring_jul->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_recurring_jul">
<span<?= $Page->recurring_jul->viewAttributes() ?>>
<?= $Page->recurring_jul->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->recurring_aug->Visible) { // recurring_aug ?>
        <td data-name="recurring_aug" <?= $Page->recurring_aug->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_recurring_aug">
<span<?= $Page->recurring_aug->viewAttributes() ?>>
<?= $Page->recurring_aug->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->recurring_sep->Visible) { // recurring_sep ?>
        <td data-name="recurring_sep" <?= $Page->recurring_sep->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_recurring_sep">
<span<?= $Page->recurring_sep->viewAttributes() ?>>
<?= $Page->recurring_sep->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->recurring_oct->Visible) { // recurring_oct ?>
        <td data-name="recurring_oct" <?= $Page->recurring_oct->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_recurring_oct">
<span<?= $Page->recurring_oct->viewAttributes() ?>>
<?= $Page->recurring_oct->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->recurring_nov->Visible) { // recurring_nov ?>
        <td data-name="recurring_nov" <?= $Page->recurring_nov->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_recurring_nov">
<span<?= $Page->recurring_nov->viewAttributes() ?>>
<?= $Page->recurring_nov->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->recurring_dec->Visible) { // recurring_dec ?>
        <td data-name="recurring_dec" <?= $Page->recurring_dec->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_recurring_dec">
<span<?= $Page->recurring_dec->viewAttributes() ?>>
<?= $Page->recurring_dec->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->setup_shape->Visible) { // setup_shape ?>
        <td data-name="setup_shape" <?= $Page->setup_shape->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_setup_shape">
<span<?= $Page->setup_shape->viewAttributes() ?>>
<?= $Page->setup_shape->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->certification_name->Visible) { // certification_name ?>
        <td data-name="certification_name" <?= $Page->certification_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_certification_name">
<span<?= $Page->certification_name->viewAttributes() ?>>
<?= $Page->certification_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->certification_date->Visible) { // certification_date ?>
        <td data-name="certification_date" <?= $Page->certification_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_certification_date">
<span<?= $Page->certification_date->viewAttributes() ?>>
<?= $Page->certification_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->timestamp->Visible) { // timestamp ?>
        <td data-name="timestamp" <?= $Page->timestamp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_timestamp">
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
    ew.addEventHandlers("room_reservation");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
