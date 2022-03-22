<?php

namespace PHPMaker2021\project3;

// Page object
$SequentialfeedDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fsequentialfeeddelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fsequentialfeeddelete = currentForm = new ew.Form("fsequentialfeeddelete", "delete");
    loadjs.done("fsequentialfeeddelete");
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
<form name="fsequentialfeeddelete" id="fsequentialfeeddelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="sequentialfeed">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_sequentialfeed_id" class="sequentialfeed_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->resourceID->Visible) { // resourceID ?>
        <th class="<?= $Page->resourceID->headerCellClass() ?>"><span id="elh_sequentialfeed_resourceID" class="sequentialfeed_resourceID"><?= $Page->resourceID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->displayBlockID->Visible) { // displayBlockID ?>
        <th class="<?= $Page->displayBlockID->headerCellClass() ?>"><span id="elh_sequentialfeed_displayBlockID" class="sequentialfeed_displayBlockID"><?= $Page->displayBlockID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->startDate->Visible) { // startDate ?>
        <th class="<?= $Page->startDate->headerCellClass() ?>"><span id="elh_sequentialfeed_startDate" class="sequentialfeed_startDate"><?= $Page->startDate->caption() ?></span></th>
<?php } ?>
<?php if ($Page->endDate->Visible) { // endDate ?>
        <th class="<?= $Page->endDate->headerCellClass() ?>"><span id="elh_sequentialfeed_endDate" class="sequentialfeed_endDate"><?= $Page->endDate->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_sequentialfeed_id" class="sequentialfeed_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->resourceID->Visible) { // resourceID ?>
        <td <?= $Page->resourceID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_sequentialfeed_resourceID" class="sequentialfeed_resourceID">
<span<?= $Page->resourceID->viewAttributes() ?>>
<?= $Page->resourceID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->displayBlockID->Visible) { // displayBlockID ?>
        <td <?= $Page->displayBlockID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_sequentialfeed_displayBlockID" class="sequentialfeed_displayBlockID">
<span<?= $Page->displayBlockID->viewAttributes() ?>>
<?= $Page->displayBlockID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->startDate->Visible) { // startDate ?>
        <td <?= $Page->startDate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_sequentialfeed_startDate" class="sequentialfeed_startDate">
<span<?= $Page->startDate->viewAttributes() ?>>
<?= $Page->startDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->endDate->Visible) { // endDate ?>
        <td <?= $Page->endDate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_sequentialfeed_endDate" class="sequentialfeed_endDate">
<span<?= $Page->endDate->viewAttributes() ?>>
<?= $Page->endDate->getViewValue() ?></span>
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
