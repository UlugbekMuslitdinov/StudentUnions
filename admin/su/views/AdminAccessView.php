<?php

namespace PHPMaker2021\project1;

// Page object
$AdminAccessView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fadmin_accessview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fadmin_accessview = currentForm = new ew.Form("fadmin_accessview", "view");
    loadjs.done("fadmin_accessview");
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
<form name="fadmin_accessview" id="fadmin_accessview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="admin_access">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_admin_access_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_admin_access_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->admin_user_id->Visible) { // admin_user_id ?>
    <tr id="r_admin_user_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_admin_access_admin_user_id"><?= $Page->admin_user_id->caption() ?></span></td>
        <td data-name="admin_user_id" <?= $Page->admin_user_id->cellAttributes() ?>>
<span id="el_admin_access_admin_user_id">
<span<?= $Page->admin_user_id->viewAttributes() ?>>
<?= $Page->admin_user_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->admin_screen_id->Visible) { // admin_screen_id ?>
    <tr id="r_admin_screen_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_admin_access_admin_screen_id"><?= $Page->admin_screen_id->caption() ?></span></td>
        <td data-name="admin_screen_id" <?= $Page->admin_screen_id->cellAttributes() ?>>
<span id="el_admin_access_admin_screen_id">
<span<?= $Page->admin_screen_id->viewAttributes() ?>>
<?= $Page->admin_screen_id->getViewValue() ?></span>
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
