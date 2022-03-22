<?php

namespace PHPMaker2021\project3;

// Page object
$SequentialfeedView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fsequentialfeedview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fsequentialfeedview = currentForm = new ew.Form("fsequentialfeedview", "view");
    loadjs.done("fsequentialfeedview");
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
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fsequentialfeedview" id="fsequentialfeedview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="sequentialfeed">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_sequentialfeed_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_sequentialfeed_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->resourceID->Visible) { // resourceID ?>
    <tr id="r_resourceID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_sequentialfeed_resourceID"><?= $Page->resourceID->caption() ?></span></td>
        <td data-name="resourceID" <?= $Page->resourceID->cellAttributes() ?>>
<span id="el_sequentialfeed_resourceID">
<span<?= $Page->resourceID->viewAttributes() ?>>
<?= $Page->resourceID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->displayBlockID->Visible) { // displayBlockID ?>
    <tr id="r_displayBlockID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_sequentialfeed_displayBlockID"><?= $Page->displayBlockID->caption() ?></span></td>
        <td data-name="displayBlockID" <?= $Page->displayBlockID->cellAttributes() ?>>
<span id="el_sequentialfeed_displayBlockID">
<span<?= $Page->displayBlockID->viewAttributes() ?>>
<?= $Page->displayBlockID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->startDate->Visible) { // startDate ?>
    <tr id="r_startDate">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_sequentialfeed_startDate"><?= $Page->startDate->caption() ?></span></td>
        <td data-name="startDate" <?= $Page->startDate->cellAttributes() ?>>
<span id="el_sequentialfeed_startDate">
<span<?= $Page->startDate->viewAttributes() ?>>
<?= $Page->startDate->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->endDate->Visible) { // endDate ?>
    <tr id="r_endDate">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_sequentialfeed_endDate"><?= $Page->endDate->caption() ?></span></td>
        <td data-name="endDate" <?= $Page->endDate->cellAttributes() ?>>
<span id="el_sequentialfeed_endDate">
<span<?= $Page->endDate->viewAttributes() ?>>
<?= $Page->endDate->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
