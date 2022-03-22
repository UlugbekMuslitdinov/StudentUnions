<?php

namespace PHPMaker2021\project3;

// Page object
$ResourceView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fresourceview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fresourceview = currentForm = new ew.Form("fresourceview", "view");
    loadjs.done("fresourceview");
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
<form name="fresourceview" id="fresourceview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="resource">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_resource_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_resource_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->filePath->Visible) { // filePath ?>
    <tr id="r_filePath">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_resource_filePath"><?= $Page->filePath->caption() ?></span></td>
        <td data-name="filePath" <?= $Page->filePath->cellAttributes() ?>>
<span id="el_resource_filePath">
<span<?= $Page->filePath->viewAttributes() ?>>
<?= $Page->filePath->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->fileSize->Visible) { // fileSize ?>
    <tr id="r_fileSize">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_resource_fileSize"><?= $Page->fileSize->caption() ?></span></td>
        <td data-name="fileSize" <?= $Page->fileSize->cellAttributes() ?>>
<span id="el_resource_fileSize">
<span<?= $Page->fileSize->viewAttributes() ?>>
<?= $Page->fileSize->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->dimensionsID->Visible) { // dimensionsID ?>
    <tr id="r_dimensionsID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_resource_dimensionsID"><?= $Page->dimensionsID->caption() ?></span></td>
        <td data-name="dimensionsID" <?= $Page->dimensionsID->cellAttributes() ?>>
<span id="el_resource_dimensionsID">
<span<?= $Page->dimensionsID->viewAttributes() ?>>
<?= $Page->dimensionsID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
    <tr id="r_type">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_resource_type"><?= $Page->type->caption() ?></span></td>
        <td data-name="type" <?= $Page->type->cellAttributes() ?>>
<span id="el_resource_type">
<span<?= $Page->type->viewAttributes() ?>>
<?= $Page->type->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->resourceName->Visible) { // resourceName ?>
    <tr id="r_resourceName">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_resource_resourceName"><?= $Page->resourceName->caption() ?></span></td>
        <td data-name="resourceName" <?= $Page->resourceName->cellAttributes() ?>>
<span id="el_resource_resourceName">
<span<?= $Page->resourceName->viewAttributes() ?>>
<?= $Page->resourceName->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->resourceLink->Visible) { // resourceLink ?>
    <tr id="r_resourceLink">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_resource_resourceLink"><?= $Page->resourceLink->caption() ?></span></td>
        <td data-name="resourceLink" <?= $Page->resourceLink->cellAttributes() ?>>
<span id="el_resource_resourceLink">
<span<?= $Page->resourceLink->viewAttributes() ?>>
<?= $Page->resourceLink->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->headline->Visible) { // headline ?>
    <tr id="r_headline">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_resource_headline"><?= $Page->headline->caption() ?></span></td>
        <td data-name="headline" <?= $Page->headline->cellAttributes() ?>>
<span id="el_resource_headline">
<span<?= $Page->headline->viewAttributes() ?>>
<?= $Page->headline->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->subtext->Visible) { // subtext ?>
    <tr id="r_subtext">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_resource_subtext"><?= $Page->subtext->caption() ?></span></td>
        <td data-name="subtext" <?= $Page->subtext->cellAttributes() ?>>
<span id="el_resource_subtext">
<span<?= $Page->subtext->viewAttributes() ?>>
<?= $Page->subtext->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->site->Visible) { // site ?>
    <tr id="r_site">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_resource_site"><?= $Page->site->caption() ?></span></td>
        <td data-name="site" <?= $Page->site->cellAttributes() ?>>
<span id="el_resource_site">
<span<?= $Page->site->viewAttributes() ?>>
<?= $Page->site->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->altTxt->Visible) { // altTxt ?>
    <tr id="r_altTxt">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_resource_altTxt"><?= $Page->altTxt->caption() ?></span></td>
        <td data-name="altTxt" <?= $Page->altTxt->cellAttributes() ?>>
<span id="el_resource_altTxt">
<span<?= $Page->altTxt->viewAttributes() ?>>
<?= $Page->altTxt->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <tr id="r_description">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_resource_description"><?= $Page->description->caption() ?></span></td>
        <td data-name="description" <?= $Page->description->cellAttributes() ?>>
<span id="el_resource_description">
<span<?= $Page->description->viewAttributes() ?>>
<?= $Page->description->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->uploadDate->Visible) { // uploadDate ?>
    <tr id="r_uploadDate">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_resource_uploadDate"><?= $Page->uploadDate->caption() ?></span></td>
        <td data-name="uploadDate" <?= $Page->uploadDate->cellAttributes() ?>>
<span id="el_resource_uploadDate">
<span<?= $Page->uploadDate->viewAttributes() ?>>
<?= $Page->uploadDate->getViewValue() ?></span>
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
