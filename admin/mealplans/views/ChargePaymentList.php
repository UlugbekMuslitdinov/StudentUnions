<?php

namespace PHPMaker2022\mealplans;

// Page object
$ChargePaymentList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { charge_payment: currentTable } });
var currentForm, currentPageID;
var fcharge_paymentlist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcharge_paymentlist = new ew.Form("fcharge_paymentlist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fcharge_paymentlist;
    fcharge_paymentlist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fcharge_paymentlist");
});
var fcharge_paymentsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fcharge_paymentsrch = new ew.Form("fcharge_paymentsrch", "list");
    currentSearchForm = fcharge_paymentsrch;

    // Dynamic selection lists

    // Filters
    fcharge_paymentsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fcharge_paymentsrch");
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
<form name="fcharge_paymentsrch" id="fcharge_paymentsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fcharge_paymentsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="charge_payment">
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fcharge_paymentsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fcharge_paymentsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fcharge_paymentsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fcharge_paymentsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> charge_payment">
<form name="fcharge_paymentlist" id="fcharge_paymentlist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="charge_payment">
<div id="gmp_charge_payment" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_charge_paymentlist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->charge_id->Visible) { // charge_id ?>
        <th data-name="charge_id" class="<?= $Page->charge_id->headerCellClass() ?>"><div id="elh_charge_payment_charge_id" class="charge_payment_charge_id"><?= $Page->renderFieldHeader($Page->charge_id) ?></div></th>
<?php } ?>
<?php if ($Page->ch_first_name->Visible) { // ch_first_name ?>
        <th data-name="ch_first_name" class="<?= $Page->ch_first_name->headerCellClass() ?>"><div id="elh_charge_payment_ch_first_name" class="charge_payment_ch_first_name"><?= $Page->renderFieldHeader($Page->ch_first_name) ?></div></th>
<?php } ?>
<?php if ($Page->ch_last_name->Visible) { // ch_last_name ?>
        <th data-name="ch_last_name" class="<?= $Page->ch_last_name->headerCellClass() ?>"><div id="elh_charge_payment_ch_last_name" class="charge_payment_ch_last_name"><?= $Page->renderFieldHeader($Page->ch_last_name) ?></div></th>
<?php } ?>
<?php if ($Page->address->Visible) { // address ?>
        <th data-name="address" class="<?= $Page->address->headerCellClass() ?>"><div id="elh_charge_payment_address" class="charge_payment_address"><?= $Page->renderFieldHeader($Page->address) ?></div></th>
<?php } ?>
<?php if ($Page->city->Visible) { // city ?>
        <th data-name="city" class="<?= $Page->city->headerCellClass() ?>"><div id="elh_charge_payment_city" class="charge_payment_city"><?= $Page->renderFieldHeader($Page->city) ?></div></th>
<?php } ?>
<?php if ($Page->state->Visible) { // state ?>
        <th data-name="state" class="<?= $Page->state->headerCellClass() ?>"><div id="elh_charge_payment_state" class="charge_payment_state"><?= $Page->renderFieldHeader($Page->state) ?></div></th>
<?php } ?>
<?php if ($Page->zipcode->Visible) { // zipcode ?>
        <th data-name="zipcode" class="<?= $Page->zipcode->headerCellClass() ?>"><div id="elh_charge_payment_zipcode" class="charge_payment_zipcode"><?= $Page->renderFieldHeader($Page->zipcode) ?></div></th>
<?php } ?>
<?php if ($Page->card_type->Visible) { // card_type ?>
        <th data-name="card_type" class="<?= $Page->card_type->headerCellClass() ?>"><div id="elh_charge_payment_card_type" class="charge_payment_card_type"><?= $Page->renderFieldHeader($Page->card_type) ?></div></th>
<?php } ?>
<?php if ($Page->expiration_month->Visible) { // expiration_month ?>
        <th data-name="expiration_month" class="<?= $Page->expiration_month->headerCellClass() ?>"><div id="elh_charge_payment_expiration_month" class="charge_payment_expiration_month"><?= $Page->renderFieldHeader($Page->expiration_month) ?></div></th>
<?php } ?>
<?php if ($Page->expiration_year->Visible) { // expiration_year ?>
        <th data-name="expiration_year" class="<?= $Page->expiration_year->headerCellClass() ?>"><div id="elh_charge_payment_expiration_year" class="charge_payment_expiration_year"><?= $Page->renderFieldHeader($Page->expiration_year) ?></div></th>
<?php } ?>
<?php if ($Page->cv_reply->Visible) { // cv_reply ?>
        <th data-name="cv_reply" class="<?= $Page->cv_reply->headerCellClass() ?>"><div id="elh_charge_payment_cv_reply" class="charge_payment_cv_reply"><?= $Page->renderFieldHeader($Page->cv_reply) ?></div></th>
<?php } ?>
<?php if ($Page->charge_amount->Visible) { // charge_amount ?>
        <th data-name="charge_amount" class="<?= $Page->charge_amount->headerCellClass() ?>"><div id="elh_charge_payment_charge_amount" class="charge_payment_charge_amount"><?= $Page->renderFieldHeader($Page->charge_amount) ?></div></th>
<?php } ?>
<?php if ($Page->order_number->Visible) { // order_number ?>
        <th data-name="order_number" class="<?= $Page->order_number->headerCellClass() ?>"><div id="elh_charge_payment_order_number" class="charge_payment_order_number"><?= $Page->renderFieldHeader($Page->order_number) ?></div></th>
<?php } ?>
<?php if ($Page->account_number->Visible) { // account_number ?>
        <th data-name="account_number" class="<?= $Page->account_number->headerCellClass() ?>"><div id="elh_charge_payment_account_number" class="charge_payment_account_number"><?= $Page->renderFieldHeader($Page->account_number) ?></div></th>
<?php } ?>
<?php if ($Page->decision->Visible) { // decision ?>
        <th data-name="decision" class="<?= $Page->decision->headerCellClass() ?>"><div id="elh_charge_payment_decision" class="charge_payment_decision"><?= $Page->renderFieldHeader($Page->decision) ?></div></th>
<?php } ?>
<?php if ($Page->reason_code->Visible) { // reason_code ?>
        <th data-name="reason_code" class="<?= $Page->reason_code->headerCellClass() ?>"><div id="elh_charge_payment_reason_code" class="charge_payment_reason_code"><?= $Page->renderFieldHeader($Page->reason_code) ?></div></th>
<?php } ?>
<?php if ($Page->transaction_time->Visible) { // transaction_time ?>
        <th data-name="transaction_time" class="<?= $Page->transaction_time->headerCellClass() ?>"><div id="elh_charge_payment_transaction_time" class="charge_payment_transaction_time"><?= $Page->renderFieldHeader($Page->transaction_time) ?></div></th>
<?php } ?>
<?php if ($Page->ch_email->Visible) { // ch_email ?>
        <th data-name="ch_email" class="<?= $Page->ch_email->headerCellClass() ?>"><div id="elh_charge_payment_ch_email" class="charge_payment_ch_email"><?= $Page->renderFieldHeader($Page->ch_email) ?></div></th>
<?php } ?>
<?php if ($Page->ch_phone->Visible) { // ch_phone ?>
        <th data-name="ch_phone" class="<?= $Page->ch_phone->headerCellClass() ?>"><div id="elh_charge_payment_ch_phone" class="charge_payment_ch_phone"><?= $Page->renderFieldHeader($Page->ch_phone) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_charge_payment",
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
    <?php if ($Page->charge_id->Visible) { // charge_id ?>
        <td data-name="charge_id"<?= $Page->charge_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_charge_id" class="el_charge_payment_charge_id">
<span<?= $Page->charge_id->viewAttributes() ?>>
<?= $Page->charge_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ch_first_name->Visible) { // ch_first_name ?>
        <td data-name="ch_first_name"<?= $Page->ch_first_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_ch_first_name" class="el_charge_payment_ch_first_name">
<span<?= $Page->ch_first_name->viewAttributes() ?>>
<?= $Page->ch_first_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ch_last_name->Visible) { // ch_last_name ?>
        <td data-name="ch_last_name"<?= $Page->ch_last_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_ch_last_name" class="el_charge_payment_ch_last_name">
<span<?= $Page->ch_last_name->viewAttributes() ?>>
<?= $Page->ch_last_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->address->Visible) { // address ?>
        <td data-name="address"<?= $Page->address->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_address" class="el_charge_payment_address">
<span<?= $Page->address->viewAttributes() ?>>
<?= $Page->address->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->city->Visible) { // city ?>
        <td data-name="city"<?= $Page->city->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_city" class="el_charge_payment_city">
<span<?= $Page->city->viewAttributes() ?>>
<?= $Page->city->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->state->Visible) { // state ?>
        <td data-name="state"<?= $Page->state->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_state" class="el_charge_payment_state">
<span<?= $Page->state->viewAttributes() ?>>
<?= $Page->state->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->zipcode->Visible) { // zipcode ?>
        <td data-name="zipcode"<?= $Page->zipcode->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_zipcode" class="el_charge_payment_zipcode">
<span<?= $Page->zipcode->viewAttributes() ?>>
<?= $Page->zipcode->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->card_type->Visible) { // card_type ?>
        <td data-name="card_type"<?= $Page->card_type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_card_type" class="el_charge_payment_card_type">
<span<?= $Page->card_type->viewAttributes() ?>>
<?= $Page->card_type->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->expiration_month->Visible) { // expiration_month ?>
        <td data-name="expiration_month"<?= $Page->expiration_month->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_expiration_month" class="el_charge_payment_expiration_month">
<span<?= $Page->expiration_month->viewAttributes() ?>>
<?= $Page->expiration_month->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->expiration_year->Visible) { // expiration_year ?>
        <td data-name="expiration_year"<?= $Page->expiration_year->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_expiration_year" class="el_charge_payment_expiration_year">
<span<?= $Page->expiration_year->viewAttributes() ?>>
<?= $Page->expiration_year->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->cv_reply->Visible) { // cv_reply ?>
        <td data-name="cv_reply"<?= $Page->cv_reply->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_cv_reply" class="el_charge_payment_cv_reply">
<span<?= $Page->cv_reply->viewAttributes() ?>>
<?= $Page->cv_reply->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->charge_amount->Visible) { // charge_amount ?>
        <td data-name="charge_amount"<?= $Page->charge_amount->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_charge_amount" class="el_charge_payment_charge_amount">
<span<?= $Page->charge_amount->viewAttributes() ?>>
<?= $Page->charge_amount->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->order_number->Visible) { // order_number ?>
        <td data-name="order_number"<?= $Page->order_number->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_order_number" class="el_charge_payment_order_number">
<span<?= $Page->order_number->viewAttributes() ?>>
<?= $Page->order_number->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->account_number->Visible) { // account_number ?>
        <td data-name="account_number"<?= $Page->account_number->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_account_number" class="el_charge_payment_account_number">
<span<?= $Page->account_number->viewAttributes() ?>>
<?= $Page->account_number->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->decision->Visible) { // decision ?>
        <td data-name="decision"<?= $Page->decision->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_decision" class="el_charge_payment_decision">
<span<?= $Page->decision->viewAttributes() ?>>
<?= $Page->decision->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->reason_code->Visible) { // reason_code ?>
        <td data-name="reason_code"<?= $Page->reason_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_reason_code" class="el_charge_payment_reason_code">
<span<?= $Page->reason_code->viewAttributes() ?>>
<?= $Page->reason_code->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->transaction_time->Visible) { // transaction_time ?>
        <td data-name="transaction_time"<?= $Page->transaction_time->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_transaction_time" class="el_charge_payment_transaction_time">
<span<?= $Page->transaction_time->viewAttributes() ?>>
<?= $Page->transaction_time->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ch_email->Visible) { // ch_email ?>
        <td data-name="ch_email"<?= $Page->ch_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_ch_email" class="el_charge_payment_ch_email">
<span<?= $Page->ch_email->viewAttributes() ?>>
<?= $Page->ch_email->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ch_phone->Visible) { // ch_phone ?>
        <td data-name="ch_phone"<?= $Page->ch_phone->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_ch_phone" class="el_charge_payment_ch_phone">
<span<?= $Page->ch_phone->viewAttributes() ?>>
<?= $Page->ch_phone->getViewValue() ?></span>
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
    ew.addEventHandlers("charge_payment");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
