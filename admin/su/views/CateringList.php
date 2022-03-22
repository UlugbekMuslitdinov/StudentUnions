<?php

namespace PHPMaker2021\project1;

// Page object
$CateringList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fcateringlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fcateringlist = currentForm = new ew.Form("fcateringlist", "list");
    fcateringlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fcateringlist");
});
var fcateringlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fcateringlistsrch = currentSearchForm = new ew.Form("fcateringlistsrch");

    // Dynamic selection lists

    // Filters
    fcateringlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fcateringlistsrch");
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
<form name="fcateringlistsrch" id="fcateringlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl() ?>">
<div id="fcateringlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="catering">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> catering">
<form name="fcateringlist" id="fcateringlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="catering">
<div id="gmp_catering" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_cateringlist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_catering_id" class="catering_id"><?= $Page->renderSort($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
        <th data-name="location" class="<?= $Page->location->headerCellClass() ?>"><div id="elh_catering_location" class="catering_location"><?= $Page->renderSort($Page->location) ?></div></th>
<?php } ?>
<?php if ($Page->method->Visible) { // method ?>
        <th data-name="method" class="<?= $Page->method->headerCellClass() ?>"><div id="elh_catering_method" class="catering_method"><?= $Page->renderSort($Page->method) ?></div></th>
<?php } ?>
<?php if ($Page->delivery_date->Visible) { // delivery_date ?>
        <th data-name="delivery_date" class="<?= $Page->delivery_date->headerCellClass() ?>"><div id="elh_catering_delivery_date" class="catering_delivery_date"><?= $Page->renderSort($Page->delivery_date) ?></div></th>
<?php } ?>
<?php if ($Page->delivery_time->Visible) { // delivery_time ?>
        <th data-name="delivery_time" class="<?= $Page->delivery_time->headerCellClass() ?>"><div id="elh_catering_delivery_time" class="catering_delivery_time"><?= $Page->renderSort($Page->delivery_time) ?></div></th>
<?php } ?>
<?php if ($Page->delivery_building->Visible) { // delivery_building ?>
        <th data-name="delivery_building" class="<?= $Page->delivery_building->headerCellClass() ?>"><div id="elh_catering_delivery_building" class="catering_delivery_building"><?= $Page->renderSort($Page->delivery_building) ?></div></th>
<?php } ?>
<?php if ($Page->delivery_room->Visible) { // delivery_room ?>
        <th data-name="delivery_room" class="<?= $Page->delivery_room->headerCellClass() ?>"><div id="elh_catering_delivery_room" class="catering_delivery_room"><?= $Page->renderSort($Page->delivery_room) ?></div></th>
<?php } ?>
<?php if ($Page->onsite_name->Visible) { // onsite_name ?>
        <th data-name="onsite_name" class="<?= $Page->onsite_name->headerCellClass() ?>"><div id="elh_catering_onsite_name" class="catering_onsite_name"><?= $Page->renderSort($Page->onsite_name) ?></div></th>
<?php } ?>
<?php if ($Page->onsite_email->Visible) { // onsite_email ?>
        <th data-name="onsite_email" class="<?= $Page->onsite_email->headerCellClass() ?>"><div id="elh_catering_onsite_email" class="catering_onsite_email"><?= $Page->renderSort($Page->onsite_email) ?></div></th>
<?php } ?>
<?php if ($Page->onsite_phone->Visible) { // onsite_phone ?>
        <th data-name="onsite_phone" class="<?= $Page->onsite_phone->headerCellClass() ?>"><div id="elh_catering_onsite_phone" class="catering_onsite_phone"><?= $Page->renderSort($Page->onsite_phone) ?></div></th>
<?php } ?>
<?php if ($Page->customer_name->Visible) { // customer_name ?>
        <th data-name="customer_name" class="<?= $Page->customer_name->headerCellClass() ?>"><div id="elh_catering_customer_name" class="catering_customer_name"><?= $Page->renderSort($Page->customer_name) ?></div></th>
<?php } ?>
<?php if ($Page->customer_phone->Visible) { // customer_phone ?>
        <th data-name="customer_phone" class="<?= $Page->customer_phone->headerCellClass() ?>"><div id="elh_catering_customer_phone" class="catering_customer_phone"><?= $Page->renderSort($Page->customer_phone) ?></div></th>
<?php } ?>
<?php if ($Page->customer_email->Visible) { // customer_email ?>
        <th data-name="customer_email" class="<?= $Page->customer_email->headerCellClass() ?>"><div id="elh_catering_customer_email" class="catering_customer_email"><?= $Page->renderSort($Page->customer_email) ?></div></th>
<?php } ?>
<?php if ($Page->payment_method->Visible) { // payment_method ?>
        <th data-name="payment_method" class="<?= $Page->payment_method->headerCellClass() ?>"><div id="elh_catering_payment_method" class="catering_payment_method"><?= $Page->renderSort($Page->payment_method) ?></div></th>
<?php } ?>
<?php if ($Page->account_num->Visible) { // account_num ?>
        <th data-name="account_num" class="<?= $Page->account_num->headerCellClass() ?>"><div id="elh_catering_account_num" class="catering_account_num"><?= $Page->renderSort($Page->account_num) ?></div></th>
<?php } ?>
<?php if ($Page->sub_code->Visible) { // sub_code ?>
        <th data-name="sub_code" class="<?= $Page->sub_code->headerCellClass() ?>"><div id="elh_catering_sub_code" class="catering_sub_code"><?= $Page->renderSort($Page->sub_code) ?></div></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Page->status->headerCellClass() ?>"><div id="elh_catering_status" class="catering_status"><?= $Page->renderSort($Page->status) ?></div></th>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <th data-name="timestamp" class="<?= $Page->timestamp->headerCellClass() ?>"><div id="elh_catering_timestamp" class="catering_timestamp"><?= $Page->renderSort($Page->timestamp) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_catering", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_catering_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->location->Visible) { // location ?>
        <td data-name="location" <?= $Page->location->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_location">
<span<?= $Page->location->viewAttributes() ?>>
<?= $Page->location->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->method->Visible) { // method ?>
        <td data-name="method" <?= $Page->method->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_method">
<span<?= $Page->method->viewAttributes() ?>>
<?= $Page->method->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->delivery_date->Visible) { // delivery_date ?>
        <td data-name="delivery_date" <?= $Page->delivery_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_delivery_date">
<span<?= $Page->delivery_date->viewAttributes() ?>>
<?= $Page->delivery_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->delivery_time->Visible) { // delivery_time ?>
        <td data-name="delivery_time" <?= $Page->delivery_time->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_delivery_time">
<span<?= $Page->delivery_time->viewAttributes() ?>>
<?= $Page->delivery_time->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->delivery_building->Visible) { // delivery_building ?>
        <td data-name="delivery_building" <?= $Page->delivery_building->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_delivery_building">
<span<?= $Page->delivery_building->viewAttributes() ?>>
<?= $Page->delivery_building->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->delivery_room->Visible) { // delivery_room ?>
        <td data-name="delivery_room" <?= $Page->delivery_room->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_delivery_room">
<span<?= $Page->delivery_room->viewAttributes() ?>>
<?= $Page->delivery_room->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->onsite_name->Visible) { // onsite_name ?>
        <td data-name="onsite_name" <?= $Page->onsite_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_onsite_name">
<span<?= $Page->onsite_name->viewAttributes() ?>>
<?= $Page->onsite_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->onsite_email->Visible) { // onsite_email ?>
        <td data-name="onsite_email" <?= $Page->onsite_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_onsite_email">
<span<?= $Page->onsite_email->viewAttributes() ?>>
<?= $Page->onsite_email->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->onsite_phone->Visible) { // onsite_phone ?>
        <td data-name="onsite_phone" <?= $Page->onsite_phone->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_onsite_phone">
<span<?= $Page->onsite_phone->viewAttributes() ?>>
<?= $Page->onsite_phone->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->customer_name->Visible) { // customer_name ?>
        <td data-name="customer_name" <?= $Page->customer_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_customer_name">
<span<?= $Page->customer_name->viewAttributes() ?>>
<?= $Page->customer_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->customer_phone->Visible) { // customer_phone ?>
        <td data-name="customer_phone" <?= $Page->customer_phone->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_customer_phone">
<span<?= $Page->customer_phone->viewAttributes() ?>>
<?= $Page->customer_phone->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->customer_email->Visible) { // customer_email ?>
        <td data-name="customer_email" <?= $Page->customer_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_customer_email">
<span<?= $Page->customer_email->viewAttributes() ?>>
<?= $Page->customer_email->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->payment_method->Visible) { // payment_method ?>
        <td data-name="payment_method" <?= $Page->payment_method->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_payment_method">
<span<?= $Page->payment_method->viewAttributes() ?>>
<?= $Page->payment_method->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->account_num->Visible) { // account_num ?>
        <td data-name="account_num" <?= $Page->account_num->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_account_num">
<span<?= $Page->account_num->viewAttributes() ?>>
<?= $Page->account_num->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sub_code->Visible) { // sub_code ?>
        <td data-name="sub_code" <?= $Page->sub_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_sub_code">
<span<?= $Page->sub_code->viewAttributes() ?>>
<?= $Page->sub_code->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <td data-name="status" <?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->timestamp->Visible) { // timestamp ?>
        <td data-name="timestamp" <?= $Page->timestamp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_timestamp">
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
    ew.addEventHandlers("catering");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
