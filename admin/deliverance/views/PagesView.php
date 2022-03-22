<?php

namespace PHPMaker2021\project3;

// Page object
$PagesView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpagesview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fpagesview = currentForm = new ew.Form("fpagesview", "view");
    loadjs.done("fpagesview");
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
<form name="fpagesview" id="fpagesview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pages">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pages_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_pages_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->domain->Visible) { // domain ?>
    <tr id="r_domain">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pages_domain"><?= $Page->domain->caption() ?></span></td>
        <td data-name="domain" <?= $Page->domain->cellAttributes() ?>>
<span id="el_pages_domain">
<span<?= $Page->domain->viewAttributes() ?>>
<?= $Page->domain->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->path->Visible) { // path ?>
    <tr id="r_path">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pages_path"><?= $Page->path->caption() ?></span></td>
        <td data-name="path" <?= $Page->path->cellAttributes() ?>>
<span id="el_pages_path">
<span<?= $Page->path->viewAttributes() ?>>
<?= $Page->path->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->displayBlockID->Visible) { // displayBlockID ?>
    <tr id="r_displayBlockID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pages_displayBlockID"><?= $Page->displayBlockID->caption() ?></span></td>
        <td data-name="displayBlockID" <?= $Page->displayBlockID->cellAttributes() ?>>
<span id="el_pages_displayBlockID">
<span<?= $Page->displayBlockID->viewAttributes() ?>>
<?= $Page->displayBlockID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
    <tr id="r_type">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pages_type"><?= $Page->type->caption() ?></span></td>
        <td data-name="type" <?= $Page->type->cellAttributes() ?>>
<span id="el_pages_type">
<span<?= $Page->type->viewAttributes() ?>>
<?= $Page->type->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date->Visible) { // date ?>
    <tr id="r_date">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pages_date"><?= $Page->date->caption() ?></span></td>
        <td data-name="date" <?= $Page->date->cellAttributes() ?>>
<span id="el_pages_date">
<span<?= $Page->date->viewAttributes() ?>>
<?= $Page->date->getViewValue() ?></span>
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
