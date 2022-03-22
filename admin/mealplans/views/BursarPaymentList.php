<?php

namespace PHPMaker2022\mealplans;

// Page object
$BursarPaymentList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { bursar_payment: currentTable } });
var currentForm, currentPageID;
var fbursar_paymentlist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fbursar_paymentlist = new ew.Form("fbursar_paymentlist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fbursar_paymentlist;
    fbursar_paymentlist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fbursar_paymentlist");
});
var fbursar_paymentsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fbursar_paymentsrch = new ew.Form("fbursar_paymentsrch", "list");
    currentSearchForm = fbursar_paymentsrch;

    // Dynamic selection lists

    // Filters
    fbursar_paymentsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fbursar_paymentsrch");
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
<form name="fbursar_paymentsrch" id="fbursar_paymentsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fbursar_paymentsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="bursar_payment">
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fbursar_paymentsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fbursar_paymentsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fbursar_paymentsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fbursar_paymentsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> bursar_payment">
<form name="fbursar_paymentlist" id="fbursar_paymentlist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="bursar_payment">
<div id="gmp_bursar_payment" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_bursar_paymentlist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->bursar_id->Visible) { // bursar_id ?>
        <th data-name="bursar_id" class="<?= $Page->bursar_id->headerCellClass() ?>"><div id="elh_bursar_payment_bursar_id" class="bursar_payment_bursar_id"><?= $Page->renderFieldHeader($Page->bursar_id) ?></div></th>
<?php } ?>
<?php if ($Page->emplid->Visible) { // emplid ?>
        <th data-name="emplid" class="<?= $Page->emplid->headerCellClass() ?>"><div id="elh_bursar_payment_emplid" class="bursar_payment_emplid"><?= $Page->renderFieldHeader($Page->emplid) ?></div></th>
<?php } ?>
<?php if ($Page->subcode->Visible) { // subcode ?>
        <th data-name="subcode" class="<?= $Page->subcode->headerCellClass() ?>"><div id="elh_bursar_payment_subcode" class="bursar_payment_subcode"><?= $Page->renderFieldHeader($Page->subcode) ?></div></th>
<?php } ?>
<?php if ($Page->term->Visible) { // term ?>
        <th data-name="term" class="<?= $Page->term->headerCellClass() ?>"><div id="elh_bursar_payment_term" class="bursar_payment_term"><?= $Page->renderFieldHeader($Page->term) ?></div></th>
<?php } ?>
<?php if ($Page->bursars_amount->Visible) { // bursars_amount ?>
        <th data-name="bursars_amount" class="<?= $Page->bursars_amount->headerCellClass() ?>"><div id="elh_bursar_payment_bursars_amount" class="bursar_payment_bursars_amount"><?= $Page->renderFieldHeader($Page->bursars_amount) ?></div></th>
<?php } ?>
<?php if ($Page->item_nbr->Visible) { // item_nbr ?>
        <th data-name="item_nbr" class="<?= $Page->item_nbr->headerCellClass() ?>"><div id="elh_bursar_payment_item_nbr" class="bursar_payment_item_nbr"><?= $Page->renderFieldHeader($Page->item_nbr) ?></div></th>
<?php } ?>
<?php if ($Page->line_seq_no->Visible) { // line_seq_no ?>
        <th data-name="line_seq_no" class="<?= $Page->line_seq_no->headerCellClass() ?>"><div id="elh_bursar_payment_line_seq_no" class="bursar_payment_line_seq_no"><?= $Page->renderFieldHeader($Page->line_seq_no) ?></div></th>
<?php } ?>
<?php if ($Page->transaction_time->Visible) { // transaction_time ?>
        <th data-name="transaction_time" class="<?= $Page->transaction_time->headerCellClass() ?>"><div id="elh_bursar_payment_transaction_time" class="bursar_payment_transaction_time"><?= $Page->renderFieldHeader($Page->transaction_time) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_bursar_payment",
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
    <?php if ($Page->bursar_id->Visible) { // bursar_id ?>
        <td data-name="bursar_id"<?= $Page->bursar_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bursar_payment_bursar_id" class="el_bursar_payment_bursar_id">
<span<?= $Page->bursar_id->viewAttributes() ?>>
<?= $Page->bursar_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->emplid->Visible) { // emplid ?>
        <td data-name="emplid"<?= $Page->emplid->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bursar_payment_emplid" class="el_bursar_payment_emplid">
<span<?= $Page->emplid->viewAttributes() ?>>
<?= $Page->emplid->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->subcode->Visible) { // subcode ?>
        <td data-name="subcode"<?= $Page->subcode->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bursar_payment_subcode" class="el_bursar_payment_subcode">
<span<?= $Page->subcode->viewAttributes() ?>>
<?= $Page->subcode->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->term->Visible) { // term ?>
        <td data-name="term"<?= $Page->term->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bursar_payment_term" class="el_bursar_payment_term">
<span<?= $Page->term->viewAttributes() ?>>
<?= $Page->term->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->bursars_amount->Visible) { // bursars_amount ?>
        <td data-name="bursars_amount"<?= $Page->bursars_amount->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bursar_payment_bursars_amount" class="el_bursar_payment_bursars_amount">
<span<?= $Page->bursars_amount->viewAttributes() ?>>
<?= $Page->bursars_amount->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->item_nbr->Visible) { // item_nbr ?>
        <td data-name="item_nbr"<?= $Page->item_nbr->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bursar_payment_item_nbr" class="el_bursar_payment_item_nbr">
<span<?= $Page->item_nbr->viewAttributes() ?>>
<?= $Page->item_nbr->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->line_seq_no->Visible) { // line_seq_no ?>
        <td data-name="line_seq_no"<?= $Page->line_seq_no->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bursar_payment_line_seq_no" class="el_bursar_payment_line_seq_no">
<span<?= $Page->line_seq_no->viewAttributes() ?>>
<?= $Page->line_seq_no->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->transaction_time->Visible) { // transaction_time ?>
        <td data-name="transaction_time"<?= $Page->transaction_time->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bursar_payment_transaction_time" class="el_bursar_payment_transaction_time">
<span<?= $Page->transaction_time->viewAttributes() ?>>
<?= $Page->transaction_time->getViewValue() ?></span>
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
    ew.addEventHandlers("bursar_payment");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
