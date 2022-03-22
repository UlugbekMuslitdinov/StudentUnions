<?php

namespace PHPMaker2021\project3;

// Page object
$ResourceList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fresourcelist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fresourcelist = currentForm = new ew.Form("fresourcelist", "list");
    fresourcelist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fresourcelist");
});
var fresourcelistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fresourcelistsrch = currentSearchForm = new ew.Form("fresourcelistsrch");

    // Dynamic selection lists

    // Filters
    fresourcelistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fresourcelistsrch");
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
<form name="fresourcelistsrch" id="fresourcelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl() ?>">
<div id="fresourcelistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="resource">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> resource">
<form name="fresourcelist" id="fresourcelist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="resource">
<div id="gmp_resource" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_resourcelist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_resource_id" class="resource_id"><?= $Page->renderSort($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->filePath->Visible) { // filePath ?>
        <th data-name="filePath" class="<?= $Page->filePath->headerCellClass() ?>"><div id="elh_resource_filePath" class="resource_filePath"><?= $Page->renderSort($Page->filePath) ?></div></th>
<?php } ?>
<?php if ($Page->fileSize->Visible) { // fileSize ?>
        <th data-name="fileSize" class="<?= $Page->fileSize->headerCellClass() ?>"><div id="elh_resource_fileSize" class="resource_fileSize"><?= $Page->renderSort($Page->fileSize) ?></div></th>
<?php } ?>
<?php if ($Page->dimensionsID->Visible) { // dimensionsID ?>
        <th data-name="dimensionsID" class="<?= $Page->dimensionsID->headerCellClass() ?>"><div id="elh_resource_dimensionsID" class="resource_dimensionsID"><?= $Page->renderSort($Page->dimensionsID) ?></div></th>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
        <th data-name="type" class="<?= $Page->type->headerCellClass() ?>"><div id="elh_resource_type" class="resource_type"><?= $Page->renderSort($Page->type) ?></div></th>
<?php } ?>
<?php if ($Page->resourceName->Visible) { // resourceName ?>
        <th data-name="resourceName" class="<?= $Page->resourceName->headerCellClass() ?>"><div id="elh_resource_resourceName" class="resource_resourceName"><?= $Page->renderSort($Page->resourceName) ?></div></th>
<?php } ?>
<?php if ($Page->resourceLink->Visible) { // resourceLink ?>
        <th data-name="resourceLink" class="<?= $Page->resourceLink->headerCellClass() ?>"><div id="elh_resource_resourceLink" class="resource_resourceLink"><?= $Page->renderSort($Page->resourceLink) ?></div></th>
<?php } ?>
<?php if ($Page->headline->Visible) { // headline ?>
        <th data-name="headline" class="<?= $Page->headline->headerCellClass() ?>"><div id="elh_resource_headline" class="resource_headline"><?= $Page->renderSort($Page->headline) ?></div></th>
<?php } ?>
<?php if ($Page->subtext->Visible) { // subtext ?>
        <th data-name="subtext" class="<?= $Page->subtext->headerCellClass() ?>"><div id="elh_resource_subtext" class="resource_subtext"><?= $Page->renderSort($Page->subtext) ?></div></th>
<?php } ?>
<?php if ($Page->site->Visible) { // site ?>
        <th data-name="site" class="<?= $Page->site->headerCellClass() ?>"><div id="elh_resource_site" class="resource_site"><?= $Page->renderSort($Page->site) ?></div></th>
<?php } ?>
<?php if ($Page->altTxt->Visible) { // altTxt ?>
        <th data-name="altTxt" class="<?= $Page->altTxt->headerCellClass() ?>"><div id="elh_resource_altTxt" class="resource_altTxt"><?= $Page->renderSort($Page->altTxt) ?></div></th>
<?php } ?>
<?php if ($Page->uploadDate->Visible) { // uploadDate ?>
        <th data-name="uploadDate" class="<?= $Page->uploadDate->headerCellClass() ?>"><div id="elh_resource_uploadDate" class="resource_uploadDate"><?= $Page->renderSort($Page->uploadDate) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_resource", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_resource_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->filePath->Visible) { // filePath ?>
        <td data-name="filePath" <?= $Page->filePath->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resource_filePath">
<span<?= $Page->filePath->viewAttributes() ?>>
<?= $Page->filePath->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->fileSize->Visible) { // fileSize ?>
        <td data-name="fileSize" <?= $Page->fileSize->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resource_fileSize">
<span<?= $Page->fileSize->viewAttributes() ?>>
<?= $Page->fileSize->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->dimensionsID->Visible) { // dimensionsID ?>
        <td data-name="dimensionsID" <?= $Page->dimensionsID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resource_dimensionsID">
<span<?= $Page->dimensionsID->viewAttributes() ?>>
<?= $Page->dimensionsID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->type->Visible) { // type ?>
        <td data-name="type" <?= $Page->type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resource_type">
<span<?= $Page->type->viewAttributes() ?>>
<?= $Page->type->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->resourceName->Visible) { // resourceName ?>
        <td data-name="resourceName" <?= $Page->resourceName->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resource_resourceName">
<span<?= $Page->resourceName->viewAttributes() ?>>
<?= $Page->resourceName->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->resourceLink->Visible) { // resourceLink ?>
        <td data-name="resourceLink" <?= $Page->resourceLink->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resource_resourceLink">
<span<?= $Page->resourceLink->viewAttributes() ?>>
<?= $Page->resourceLink->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->headline->Visible) { // headline ?>
        <td data-name="headline" <?= $Page->headline->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resource_headline">
<span<?= $Page->headline->viewAttributes() ?>>
<?= $Page->headline->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->subtext->Visible) { // subtext ?>
        <td data-name="subtext" <?= $Page->subtext->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resource_subtext">
<span<?= $Page->subtext->viewAttributes() ?>>
<?= $Page->subtext->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->site->Visible) { // site ?>
        <td data-name="site" <?= $Page->site->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resource_site">
<span<?= $Page->site->viewAttributes() ?>>
<?= $Page->site->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->altTxt->Visible) { // altTxt ?>
        <td data-name="altTxt" <?= $Page->altTxt->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resource_altTxt">
<span<?= $Page->altTxt->viewAttributes() ?>>
<?= $Page->altTxt->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->uploadDate->Visible) { // uploadDate ?>
        <td data-name="uploadDate" <?= $Page->uploadDate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resource_uploadDate">
<span<?= $Page->uploadDate->viewAttributes() ?>>
<?= $Page->uploadDate->getViewValue() ?></span>
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
    ew.addEventHandlers("resource");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
