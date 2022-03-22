<?php

namespace PHPMaker2021\project3;

// Page object
$DisplayblockDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fdisplayblockdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fdisplayblockdelete = currentForm = new ew.Form("fdisplayblockdelete", "delete");
    loadjs.done("fdisplayblockdelete");
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
<form name="fdisplayblockdelete" id="fdisplayblockdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="displayblock">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_displayblock_id" class="displayblock_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->displayBlockName->Visible) { // displayBlockName ?>
        <th class="<?= $Page->displayBlockName->headerCellClass() ?>"><span id="elh_displayblock_displayBlockName" class="displayblock_displayBlockName"><?= $Page->displayBlockName->caption() ?></span></th>
<?php } ?>
<?php if ($Page->displayType->Visible) { // displayType ?>
        <th class="<?= $Page->displayType->headerCellClass() ?>"><span id="elh_displayblock_displayType" class="displayblock_displayType"><?= $Page->displayType->caption() ?></span></th>
<?php } ?>
<?php if ($Page->dimensionsID->Visible) { // dimensionsID ?>
        <th class="<?= $Page->dimensionsID->headerCellClass() ?>"><span id="elh_displayblock_dimensionsID" class="displayblock_dimensionsID"><?= $Page->dimensionsID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->feedType->Visible) { // feedType ?>
        <th class="<?= $Page->feedType->headerCellClass() ?>"><span id="elh_displayblock_feedType" class="displayblock_feedType"><?= $Page->feedType->caption() ?></span></th>
<?php } ?>
<?php if ($Page->site->Visible) { // site ?>
        <th class="<?= $Page->site->headerCellClass() ?>"><span id="elh_displayblock_site" class="displayblock_site"><?= $Page->site->caption() ?></span></th>
<?php } ?>
<?php if ($Page->resourceID->Visible) { // resourceID ?>
        <th class="<?= $Page->resourceID->headerCellClass() ?>"><span id="elh_displayblock_resourceID" class="displayblock_resourceID"><?= $Page->resourceID->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_displayblock_id" class="displayblock_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->displayBlockName->Visible) { // displayBlockName ?>
        <td <?= $Page->displayBlockName->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_displayblock_displayBlockName" class="displayblock_displayBlockName">
<span<?= $Page->displayBlockName->viewAttributes() ?>>
<?= $Page->displayBlockName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->displayType->Visible) { // displayType ?>
        <td <?= $Page->displayType->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_displayblock_displayType" class="displayblock_displayType">
<span<?= $Page->displayType->viewAttributes() ?>>
<?= $Page->displayType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->dimensionsID->Visible) { // dimensionsID ?>
        <td <?= $Page->dimensionsID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_displayblock_dimensionsID" class="displayblock_dimensionsID">
<span<?= $Page->dimensionsID->viewAttributes() ?>>
<?= $Page->dimensionsID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->feedType->Visible) { // feedType ?>
        <td <?= $Page->feedType->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_displayblock_feedType" class="displayblock_feedType">
<span<?= $Page->feedType->viewAttributes() ?>>
<?= $Page->feedType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->site->Visible) { // site ?>
        <td <?= $Page->site->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_displayblock_site" class="displayblock_site">
<span<?= $Page->site->viewAttributes() ?>>
<?= $Page->site->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->resourceID->Visible) { // resourceID ?>
        <td <?= $Page->resourceID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_displayblock_resourceID" class="displayblock_resourceID">
<span<?= $Page->resourceID->viewAttributes() ?>>
<?= $Page->resourceID->getViewValue() ?></span>
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
