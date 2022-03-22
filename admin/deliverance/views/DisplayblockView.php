<?php

namespace PHPMaker2021\project3;

// Page object
$DisplayblockView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fdisplayblockview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fdisplayblockview = currentForm = new ew.Form("fdisplayblockview", "view");
    loadjs.done("fdisplayblockview");
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
<form name="fdisplayblockview" id="fdisplayblockview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="displayblock">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_displayblock_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_displayblock_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->displayBlockName->Visible) { // displayBlockName ?>
    <tr id="r_displayBlockName">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_displayblock_displayBlockName"><?= $Page->displayBlockName->caption() ?></span></td>
        <td data-name="displayBlockName" <?= $Page->displayBlockName->cellAttributes() ?>>
<span id="el_displayblock_displayBlockName">
<span<?= $Page->displayBlockName->viewAttributes() ?>>
<?= $Page->displayBlockName->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->displayType->Visible) { // displayType ?>
    <tr id="r_displayType">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_displayblock_displayType"><?= $Page->displayType->caption() ?></span></td>
        <td data-name="displayType" <?= $Page->displayType->cellAttributes() ?>>
<span id="el_displayblock_displayType">
<span<?= $Page->displayType->viewAttributes() ?>>
<?= $Page->displayType->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->dimensionsID->Visible) { // dimensionsID ?>
    <tr id="r_dimensionsID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_displayblock_dimensionsID"><?= $Page->dimensionsID->caption() ?></span></td>
        <td data-name="dimensionsID" <?= $Page->dimensionsID->cellAttributes() ?>>
<span id="el_displayblock_dimensionsID">
<span<?= $Page->dimensionsID->viewAttributes() ?>>
<?= $Page->dimensionsID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->feedType->Visible) { // feedType ?>
    <tr id="r_feedType">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_displayblock_feedType"><?= $Page->feedType->caption() ?></span></td>
        <td data-name="feedType" <?= $Page->feedType->cellAttributes() ?>>
<span id="el_displayblock_feedType">
<span<?= $Page->feedType->viewAttributes() ?>>
<?= $Page->feedType->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->site->Visible) { // site ?>
    <tr id="r_site">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_displayblock_site"><?= $Page->site->caption() ?></span></td>
        <td data-name="site" <?= $Page->site->cellAttributes() ?>>
<span id="el_displayblock_site">
<span<?= $Page->site->viewAttributes() ?>>
<?= $Page->site->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->resourceID->Visible) { // resourceID ?>
    <tr id="r_resourceID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_displayblock_resourceID"><?= $Page->resourceID->caption() ?></span></td>
        <td data-name="resourceID" <?= $Page->resourceID->cellAttributes() ?>>
<span id="el_displayblock_resourceID">
<span<?= $Page->resourceID->viewAttributes() ?>>
<?= $Page->resourceID->getViewValue() ?></span>
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
