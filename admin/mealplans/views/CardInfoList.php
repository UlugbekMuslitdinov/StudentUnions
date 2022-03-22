<?php

namespace PHPMaker2022\mealplans;

// Page object
$CardInfoList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { card_info: currentTable } });
var currentForm, currentPageID;
var fcard_infolist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcard_infolist = new ew.Form("fcard_infolist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fcard_infolist;
    fcard_infolist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fcard_infolist");
});
var fcard_infosrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fcard_infosrch = new ew.Form("fcard_infosrch", "list");
    currentSearchForm = fcard_infosrch;

    // Dynamic selection lists

    // Filters
    fcard_infosrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fcard_infosrch");
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
<form name="fcard_infosrch" id="fcard_infosrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fcard_infosrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="card_info">
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fcard_infosrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fcard_infosrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fcard_infosrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fcard_infosrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> card_info">
<form name="fcard_infolist" id="fcard_infolist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="card_info">
<div id="gmp_card_info" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_card_infolist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->card_id->Visible) { // card_id ?>
        <th data-name="card_id" class="<?= $Page->card_id->headerCellClass() ?>"><div id="elh_card_info_card_id" class="card_info_card_id"><?= $Page->renderFieldHeader($Page->card_id) ?></div></th>
<?php } ?>
<?php if ($Page->cust_id->Visible) { // cust_id ?>
        <th data-name="cust_id" class="<?= $Page->cust_id->headerCellClass() ?>"><div id="elh_card_info_cust_id" class="card_info_cust_id"><?= $Page->renderFieldHeader($Page->cust_id) ?></div></th>
<?php } ?>
<?php if ($Page->guest_id->Visible) { // guest_id ?>
        <th data-name="guest_id" class="<?= $Page->guest_id->headerCellClass() ?>"><div id="elh_card_info_guest_id" class="card_info_guest_id"><?= $Page->renderFieldHeader($Page->guest_id) ?></div></th>
<?php } ?>
<?php if ($Page->first_name->Visible) { // first_name ?>
        <th data-name="first_name" class="<?= $Page->first_name->headerCellClass() ?>"><div id="elh_card_info_first_name" class="card_info_first_name"><?= $Page->renderFieldHeader($Page->first_name) ?></div></th>
<?php } ?>
<?php if ($Page->last_name->Visible) { // last_name ?>
        <th data-name="last_name" class="<?= $Page->last_name->headerCellClass() ?>"><div id="elh_card_info_last_name" class="card_info_last_name"><?= $Page->renderFieldHeader($Page->last_name) ?></div></th>
<?php } ?>
<?php if ($Page->address->Visible) { // address ?>
        <th data-name="address" class="<?= $Page->address->headerCellClass() ?>"><div id="elh_card_info_address" class="card_info_address"><?= $Page->renderFieldHeader($Page->address) ?></div></th>
<?php } ?>
<?php if ($Page->city->Visible) { // city ?>
        <th data-name="city" class="<?= $Page->city->headerCellClass() ?>"><div id="elh_card_info_city" class="card_info_city"><?= $Page->renderFieldHeader($Page->city) ?></div></th>
<?php } ?>
<?php if ($Page->state->Visible) { // state ?>
        <th data-name="state" class="<?= $Page->state->headerCellClass() ?>"><div id="elh_card_info_state" class="card_info_state"><?= $Page->renderFieldHeader($Page->state) ?></div></th>
<?php } ?>
<?php if ($Page->zipcode->Visible) { // zipcode ?>
        <th data-name="zipcode" class="<?= $Page->zipcode->headerCellClass() ?>"><div id="elh_card_info_zipcode" class="card_info_zipcode"><?= $Page->renderFieldHeader($Page->zipcode) ?></div></th>
<?php } ?>
<?php if ($Page->card_type->Visible) { // card_type ?>
        <th data-name="card_type" class="<?= $Page->card_type->headerCellClass() ?>"><div id="elh_card_info_card_type" class="card_info_card_type"><?= $Page->renderFieldHeader($Page->card_type) ?></div></th>
<?php } ?>
<?php if ($Page->account_number->Visible) { // account_number ?>
        <th data-name="account_number" class="<?= $Page->account_number->headerCellClass() ?>"><div id="elh_card_info_account_number" class="card_info_account_number"><?= $Page->renderFieldHeader($Page->account_number) ?></div></th>
<?php } ?>
<?php if ($Page->expiration_month->Visible) { // expiration_month ?>
        <th data-name="expiration_month" class="<?= $Page->expiration_month->headerCellClass() ?>"><div id="elh_card_info_expiration_month" class="card_info_expiration_month"><?= $Page->renderFieldHeader($Page->expiration_month) ?></div></th>
<?php } ?>
<?php if ($Page->expiration_year->Visible) { // expiration_year ?>
        <th data-name="expiration_year" class="<?= $Page->expiration_year->headerCellClass() ?>"><div id="elh_card_info_expiration_year" class="card_info_expiration_year"><?= $Page->renderFieldHeader($Page->expiration_year) ?></div></th>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <th data-name="_email" class="<?= $Page->_email->headerCellClass() ?>"><div id="elh_card_info__email" class="card_info__email"><?= $Page->renderFieldHeader($Page->_email) ?></div></th>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
        <th data-name="phone" class="<?= $Page->phone->headerCellClass() ?>"><div id="elh_card_info_phone" class="card_info_phone"><?= $Page->renderFieldHeader($Page->phone) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_card_info",
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
    <?php if ($Page->card_id->Visible) { // card_id ?>
        <td data-name="card_id"<?= $Page->card_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_card_info_card_id" class="el_card_info_card_id">
<span<?= $Page->card_id->viewAttributes() ?>>
<?= $Page->card_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->cust_id->Visible) { // cust_id ?>
        <td data-name="cust_id"<?= $Page->cust_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_card_info_cust_id" class="el_card_info_cust_id">
<span<?= $Page->cust_id->viewAttributes() ?>>
<?= $Page->cust_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->guest_id->Visible) { // guest_id ?>
        <td data-name="guest_id"<?= $Page->guest_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_card_info_guest_id" class="el_card_info_guest_id">
<span<?= $Page->guest_id->viewAttributes() ?>>
<?= $Page->guest_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->first_name->Visible) { // first_name ?>
        <td data-name="first_name"<?= $Page->first_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_card_info_first_name" class="el_card_info_first_name">
<span<?= $Page->first_name->viewAttributes() ?>>
<?= $Page->first_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->last_name->Visible) { // last_name ?>
        <td data-name="last_name"<?= $Page->last_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_card_info_last_name" class="el_card_info_last_name">
<span<?= $Page->last_name->viewAttributes() ?>>
<?= $Page->last_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->address->Visible) { // address ?>
        <td data-name="address"<?= $Page->address->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_card_info_address" class="el_card_info_address">
<span<?= $Page->address->viewAttributes() ?>>
<?= $Page->address->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->city->Visible) { // city ?>
        <td data-name="city"<?= $Page->city->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_card_info_city" class="el_card_info_city">
<span<?= $Page->city->viewAttributes() ?>>
<?= $Page->city->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->state->Visible) { // state ?>
        <td data-name="state"<?= $Page->state->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_card_info_state" class="el_card_info_state">
<span<?= $Page->state->viewAttributes() ?>>
<?= $Page->state->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->zipcode->Visible) { // zipcode ?>
        <td data-name="zipcode"<?= $Page->zipcode->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_card_info_zipcode" class="el_card_info_zipcode">
<span<?= $Page->zipcode->viewAttributes() ?>>
<?= $Page->zipcode->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->card_type->Visible) { // card_type ?>
        <td data-name="card_type"<?= $Page->card_type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_card_info_card_type" class="el_card_info_card_type">
<span<?= $Page->card_type->viewAttributes() ?>>
<?= $Page->card_type->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->account_number->Visible) { // account_number ?>
        <td data-name="account_number"<?= $Page->account_number->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_card_info_account_number" class="el_card_info_account_number">
<span<?= $Page->account_number->viewAttributes() ?>>
<?= $Page->account_number->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->expiration_month->Visible) { // expiration_month ?>
        <td data-name="expiration_month"<?= $Page->expiration_month->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_card_info_expiration_month" class="el_card_info_expiration_month">
<span<?= $Page->expiration_month->viewAttributes() ?>>
<?= $Page->expiration_month->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->expiration_year->Visible) { // expiration_year ?>
        <td data-name="expiration_year"<?= $Page->expiration_year->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_card_info_expiration_year" class="el_card_info_expiration_year">
<span<?= $Page->expiration_year->viewAttributes() ?>>
<?= $Page->expiration_year->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->_email->Visible) { // email ?>
        <td data-name="_email"<?= $Page->_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_card_info__email" class="el_card_info__email">
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->phone->Visible) { // phone ?>
        <td data-name="phone"<?= $Page->phone->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_card_info_phone" class="el_card_info_phone">
<span<?= $Page->phone->viewAttributes() ?>>
<?= $Page->phone->getViewValue() ?></span>
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
    ew.addEventHandlers("card_info");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
