<?php

namespace PHPMaker2021\project1;

// Page object
$AdminUsersView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fadmin_usersview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fadmin_usersview = currentForm = new ew.Form("fadmin_usersview", "view");
    loadjs.done("fadmin_usersview");
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
<form name="fadmin_usersview" id="fadmin_usersview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="admin_users">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_admin_users_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_admin_users_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->unionstaff_id->Visible) { // unionstaff_id ?>
    <tr id="r_unionstaff_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_admin_users_unionstaff_id"><?= $Page->unionstaff_id->caption() ?></span></td>
        <td data-name="unionstaff_id" <?= $Page->unionstaff_id->cellAttributes() ?>>
<span id="el_admin_users_unionstaff_id">
<span<?= $Page->unionstaff_id->viewAttributes() ?>>
<?= $Page->unionstaff_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->netid->Visible) { // netid ?>
    <tr id="r_netid">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_admin_users_netid"><?= $Page->netid->caption() ?></span></td>
        <td data-name="netid" <?= $Page->netid->cellAttributes() ?>>
<span id="el_admin_users_netid">
<span<?= $Page->netid->viewAttributes() ?>>
<?= $Page->netid->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->access_level->Visible) { // access_level ?>
    <tr id="r_access_level">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_admin_users_access_level"><?= $Page->access_level->caption() ?></span></td>
        <td data-name="access_level" <?= $Page->access_level->cellAttributes() ?>>
<span id="el_admin_users_access_level">
<span<?= $Page->access_level->viewAttributes() ?>>
<?= $Page->access_level->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->active->Visible) { // active ?>
    <tr id="r_active">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_admin_users_active"><?= $Page->active->caption() ?></span></td>
        <td data-name="active" <?= $Page->active->cellAttributes() ?>>
<span id="el_admin_users_active">
<span<?= $Page->active->viewAttributes() ?>>
<?= $Page->active->getViewValue() ?></span>
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
