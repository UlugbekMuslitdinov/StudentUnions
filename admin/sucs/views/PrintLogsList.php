<?php

namespace PHPMaker2021\project4;

// Page object
$PrintLogsList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fprint_logslist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fprint_logslist = currentForm = new ew.Form("fprint_logslist", "list");
    fprint_logslist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fprint_logslist");
});
var fprint_logslistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fprint_logslistsrch = currentSearchForm = new ew.Form("fprint_logslistsrch");

    // Dynamic selection lists

    // Filters
    fprint_logslistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fprint_logslistsrch");
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
<form name="fprint_logslistsrch" id="fprint_logslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fprint_logslistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="print_logs">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> print_logs">
<form name="fprint_logslist" id="fprint_logslist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="print_logs">
<div id="gmp_print_logs" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_print_logslist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->Time->Visible) { // Time ?>
        <th data-name="Time" class="<?= $Page->Time->headerCellClass() ?>"><div id="elh_print_logs_Time" class="print_logs_Time"><?= $Page->renderSort($Page->Time) ?></div></th>
<?php } ?>
<?php if ($Page->User->Visible) { // User ?>
        <th data-name="User" class="<?= $Page->User->headerCellClass() ?>"><div id="elh_print_logs_User" class="print_logs_User"><?= $Page->renderSort($Page->User) ?></div></th>
<?php } ?>
<?php if ($Page->Pages->Visible) { // Pages ?>
        <th data-name="Pages" class="<?= $Page->Pages->headerCellClass() ?>"><div id="elh_print_logs_Pages" class="print_logs_Pages"><?= $Page->renderSort($Page->Pages) ?></div></th>
<?php } ?>
<?php if ($Page->Copies->Visible) { // Copies ?>
        <th data-name="Copies" class="<?= $Page->Copies->headerCellClass() ?>"><div id="elh_print_logs_Copies" class="print_logs_Copies"><?= $Page->renderSort($Page->Copies) ?></div></th>
<?php } ?>
<?php if ($Page->Printer->Visible) { // Printer ?>
        <th data-name="Printer" class="<?= $Page->Printer->headerCellClass() ?>"><div id="elh_print_logs_Printer" class="print_logs_Printer"><?= $Page->renderSort($Page->Printer) ?></div></th>
<?php } ?>
<?php if ($Page->DocumentName->Visible) { // Document Name ?>
        <th data-name="DocumentName" class="<?= $Page->DocumentName->headerCellClass() ?>"><div id="elh_print_logs_DocumentName" class="print_logs_DocumentName"><?= $Page->renderSort($Page->DocumentName) ?></div></th>
<?php } ?>
<?php if ($Page->Client->Visible) { // Client ?>
        <th data-name="Client" class="<?= $Page->Client->headerCellClass() ?>"><div id="elh_print_logs_Client" class="print_logs_Client"><?= $Page->renderSort($Page->Client) ?></div></th>
<?php } ?>
<?php if ($Page->PaperSize->Visible) { // Paper Size ?>
        <th data-name="PaperSize" class="<?= $Page->PaperSize->headerCellClass() ?>"><div id="elh_print_logs_PaperSize" class="print_logs_PaperSize"><?= $Page->renderSort($Page->PaperSize) ?></div></th>
<?php } ?>
<?php if ($Page->_Language->Visible) { // Language ?>
        <th data-name="_Language" class="<?= $Page->_Language->headerCellClass() ?>"><div id="elh_print_logs__Language" class="print_logs__Language"><?= $Page->renderSort($Page->_Language) ?></div></th>
<?php } ?>
<?php if ($Page->Height->Visible) { // Height ?>
        <th data-name="Height" class="<?= $Page->Height->headerCellClass() ?>"><div id="elh_print_logs_Height" class="print_logs_Height"><?= $Page->renderSort($Page->Height) ?></div></th>
<?php } ?>
<?php if ($Page->Width->Visible) { // Width ?>
        <th data-name="Width" class="<?= $Page->Width->headerCellClass() ?>"><div id="elh_print_logs_Width" class="print_logs_Width"><?= $Page->renderSort($Page->Width) ?></div></th>
<?php } ?>
<?php if ($Page->Duplex->Visible) { // Duplex ?>
        <th data-name="Duplex" class="<?= $Page->Duplex->headerCellClass() ?>"><div id="elh_print_logs_Duplex" class="print_logs_Duplex"><?= $Page->renderSort($Page->Duplex) ?></div></th>
<?php } ?>
<?php if ($Page->Grayscale->Visible) { // Grayscale ?>
        <th data-name="Grayscale" class="<?= $Page->Grayscale->headerCellClass() ?>"><div id="elh_print_logs_Grayscale" class="print_logs_Grayscale"><?= $Page->renderSort($Page->Grayscale) ?></div></th>
<?php } ?>
<?php if ($Page->Size->Visible) { // Size ?>
        <th data-name="Size" class="<?= $Page->Size->headerCellClass() ?>"><div id="elh_print_logs_Size" class="print_logs_Size"><?= $Page->renderSort($Page->Size) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_print_logs", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->Time->Visible) { // Time ?>
        <td data-name="Time" <?= $Page->Time->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_print_logs_Time">
<span<?= $Page->Time->viewAttributes() ?>>
<?= $Page->Time->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->User->Visible) { // User ?>
        <td data-name="User" <?= $Page->User->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_print_logs_User">
<span<?= $Page->User->viewAttributes() ?>>
<?= $Page->User->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Pages->Visible) { // Pages ?>
        <td data-name="Pages" <?= $Page->Pages->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_print_logs_Pages">
<span<?= $Page->Pages->viewAttributes() ?>>
<?= $Page->Pages->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Copies->Visible) { // Copies ?>
        <td data-name="Copies" <?= $Page->Copies->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_print_logs_Copies">
<span<?= $Page->Copies->viewAttributes() ?>>
<?= $Page->Copies->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Printer->Visible) { // Printer ?>
        <td data-name="Printer" <?= $Page->Printer->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_print_logs_Printer">
<span<?= $Page->Printer->viewAttributes() ?>>
<?= $Page->Printer->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->DocumentName->Visible) { // Document Name ?>
        <td data-name="DocumentName" <?= $Page->DocumentName->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_print_logs_DocumentName">
<span<?= $Page->DocumentName->viewAttributes() ?>>
<?= $Page->DocumentName->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Client->Visible) { // Client ?>
        <td data-name="Client" <?= $Page->Client->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_print_logs_Client">
<span<?= $Page->Client->viewAttributes() ?>>
<?= $Page->Client->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->PaperSize->Visible) { // Paper Size ?>
        <td data-name="PaperSize" <?= $Page->PaperSize->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_print_logs_PaperSize">
<span<?= $Page->PaperSize->viewAttributes() ?>>
<?= $Page->PaperSize->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->_Language->Visible) { // Language ?>
        <td data-name="_Language" <?= $Page->_Language->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_print_logs__Language">
<span<?= $Page->_Language->viewAttributes() ?>>
<?= $Page->_Language->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Height->Visible) { // Height ?>
        <td data-name="Height" <?= $Page->Height->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_print_logs_Height">
<span<?= $Page->Height->viewAttributes() ?>>
<?= $Page->Height->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Width->Visible) { // Width ?>
        <td data-name="Width" <?= $Page->Width->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_print_logs_Width">
<span<?= $Page->Width->viewAttributes() ?>>
<?= $Page->Width->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Duplex->Visible) { // Duplex ?>
        <td data-name="Duplex" <?= $Page->Duplex->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_print_logs_Duplex">
<span<?= $Page->Duplex->viewAttributes() ?>>
<?= $Page->Duplex->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Grayscale->Visible) { // Grayscale ?>
        <td data-name="Grayscale" <?= $Page->Grayscale->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_print_logs_Grayscale">
<span<?= $Page->Grayscale->viewAttributes() ?>>
<?= $Page->Grayscale->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Size->Visible) { // Size ?>
        <td data-name="Size" <?= $Page->Size->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_print_logs_Size">
<span<?= $Page->Size->viewAttributes() ?>>
<?= $Page->Size->getViewValue() ?></span>
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
    ew.addEventHandlers("print_logs");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
