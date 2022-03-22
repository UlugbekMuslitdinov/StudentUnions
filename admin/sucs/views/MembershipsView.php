<?php

namespace PHPMaker2021\project4;

// Page object
$MembershipsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fmembershipsview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fmembershipsview = currentForm = new ew.Form("fmembershipsview", "view");
    loadjs.done("fmembershipsview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.memberships) ew.vars.tables.memberships = <?= JsonEncode(GetClientVar("tables", "memberships")) ?>;
</script>
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
<form name="fmembershipsview" id="fmembershipsview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="memberships">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->membership_id->Visible) { // membership_id ?>
    <tr id="r_membership_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_memberships_membership_id"><?= $Page->membership_id->caption() ?></span></td>
        <td data-name="membership_id" <?= $Page->membership_id->cellAttributes() ?>>
<span id="el_memberships_membership_id">
<span<?= $Page->membership_id->viewAttributes() ?>>
<?= $Page->membership_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
    <tr id="r_user_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_memberships_user_id"><?= $Page->user_id->caption() ?></span></td>
        <td data-name="user_id" <?= $Page->user_id->cellAttributes() ?>>
<span id="el_memberships_user_id">
<span<?= $Page->user_id->viewAttributes() ?>>
<?= $Page->user_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->group_id->Visible) { // group_id ?>
    <tr id="r_group_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_memberships_group_id"><?= $Page->group_id->caption() ?></span></td>
        <td data-name="group_id" <?= $Page->group_id->cellAttributes() ?>>
<span id="el_memberships_group_id">
<span<?= $Page->group_id->viewAttributes() ?>>
<?= $Page->group_id->getViewValue() ?></span>
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
