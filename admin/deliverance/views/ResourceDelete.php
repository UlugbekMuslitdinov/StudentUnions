<?php

namespace PHPMaker2021\project3;

// Page object
$ResourceDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fresourcedelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fresourcedelete = currentForm = new ew.Form("fresourcedelete", "delete");
    loadjs.done("fresourcedelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fresourcedelete" id="fresourcedelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="resource">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->id->Visible) { // id ?>
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_resource_id" class="resource_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->filePath->Visible) { // filePath ?>
        <th class="<?= $Page->filePath->headerCellClass() ?>"><span id="elh_resource_filePath" class="resource_filePath"><?= $Page->filePath->caption() ?></span></th>
<?php } ?>
<?php if ($Page->fileSize->Visible) { // fileSize ?>
        <th class="<?= $Page->fileSize->headerCellClass() ?>"><span id="elh_resource_fileSize" class="resource_fileSize"><?= $Page->fileSize->caption() ?></span></th>
<?php } ?>
<?php if ($Page->dimensionsID->Visible) { // dimensionsID ?>
        <th class="<?= $Page->dimensionsID->headerCellClass() ?>"><span id="elh_resource_dimensionsID" class="resource_dimensionsID"><?= $Page->dimensionsID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
        <th class="<?= $Page->type->headerCellClass() ?>"><span id="elh_resource_type" class="resource_type"><?= $Page->type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->resourceName->Visible) { // resourceName ?>
        <th class="<?= $Page->resourceName->headerCellClass() ?>"><span id="elh_resource_resourceName" class="resource_resourceName"><?= $Page->resourceName->caption() ?></span></th>
<?php } ?>
<?php if ($Page->resourceLink->Visible) { // resourceLink ?>
        <th class="<?= $Page->resourceLink->headerCellClass() ?>"><span id="elh_resource_resourceLink" class="resource_resourceLink"><?= $Page->resourceLink->caption() ?></span></th>
<?php } ?>
<?php if ($Page->headline->Visible) { // headline ?>
        <th class="<?= $Page->headline->headerCellClass() ?>"><span id="elh_resource_headline" class="resource_headline"><?= $Page->headline->caption() ?></span></th>
<?php } ?>
<?php if ($Page->subtext->Visible) { // subtext ?>
        <th class="<?= $Page->subtext->headerCellClass() ?>"><span id="elh_resource_subtext" class="resource_subtext"><?= $Page->subtext->caption() ?></span></th>
<?php } ?>
<?php if ($Page->site->Visible) { // site ?>
        <th class="<?= $Page->site->headerCellClass() ?>"><span id="elh_resource_site" class="resource_site"><?= $Page->site->caption() ?></span></th>
<?php } ?>
<?php if ($Page->altTxt->Visible) { // altTxt ?>
        <th class="<?= $Page->altTxt->headerCellClass() ?>"><span id="elh_resource_altTxt" class="resource_altTxt"><?= $Page->altTxt->caption() ?></span></th>
<?php } ?>
<?php if ($Page->uploadDate->Visible) { // uploadDate ?>
        <th class="<?= $Page->uploadDate->headerCellClass() ?>"><span id="elh_resource_uploadDate" class="resource_uploadDate"><?= $Page->uploadDate->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->id->Visible) { // id ?>
        <td <?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resource_id" class="resource_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->filePath->Visible) { // filePath ?>
        <td <?= $Page->filePath->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resource_filePath" class="resource_filePath">
<span<?= $Page->filePath->viewAttributes() ?>>
<?= $Page->filePath->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->fileSize->Visible) { // fileSize ?>
        <td <?= $Page->fileSize->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resource_fileSize" class="resource_fileSize">
<span<?= $Page->fileSize->viewAttributes() ?>>
<?= $Page->fileSize->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->dimensionsID->Visible) { // dimensionsID ?>
        <td <?= $Page->dimensionsID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resource_dimensionsID" class="resource_dimensionsID">
<span<?= $Page->dimensionsID->viewAttributes() ?>>
<?= $Page->dimensionsID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
        <td <?= $Page->type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resource_type" class="resource_type">
<span<?= $Page->type->viewAttributes() ?>>
<?= $Page->type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->resourceName->Visible) { // resourceName ?>
        <td <?= $Page->resourceName->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resource_resourceName" class="resource_resourceName">
<span<?= $Page->resourceName->viewAttributes() ?>>
<?= $Page->resourceName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->resourceLink->Visible) { // resourceLink ?>
        <td <?= $Page->resourceLink->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resource_resourceLink" class="resource_resourceLink">
<span<?= $Page->resourceLink->viewAttributes() ?>>
<?= $Page->resourceLink->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->headline->Visible) { // headline ?>
        <td <?= $Page->headline->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resource_headline" class="resource_headline">
<span<?= $Page->headline->viewAttributes() ?>>
<?= $Page->headline->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->subtext->Visible) { // subtext ?>
        <td <?= $Page->subtext->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resource_subtext" class="resource_subtext">
<span<?= $Page->subtext->viewAttributes() ?>>
<?= $Page->subtext->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->site->Visible) { // site ?>
        <td <?= $Page->site->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resource_site" class="resource_site">
<span<?= $Page->site->viewAttributes() ?>>
<?= $Page->site->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->altTxt->Visible) { // altTxt ?>
        <td <?= $Page->altTxt->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resource_altTxt" class="resource_altTxt">
<span<?= $Page->altTxt->viewAttributes() ?>>
<?= $Page->altTxt->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->uploadDate->Visible) { // uploadDate ?>
        <td <?= $Page->uploadDate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_resource_uploadDate" class="resource_uploadDate">
<span<?= $Page->uploadDate->viewAttributes() ?>>
<?= $Page->uploadDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
