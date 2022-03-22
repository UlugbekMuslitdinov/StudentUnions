<?php

namespace PHPMaker2022\project1;

// Page object
$GroupsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { groups: currentTable } });
var currentForm, currentPageID;
var fgroupsview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fgroupsview = new ew.Form("fgroupsview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fgroupsview;
    loadjs.done("fgroupsview");
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
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fgroupsview" id="fgroupsview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="groups">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->group_id->Visible) { // group_id ?>
    <tr id="r_group_id"<?= $Page->group_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_groups_group_id"><?= $Page->group_id->caption() ?></span></td>
        <td data-name="group_id"<?= $Page->group_id->cellAttributes() ?>>
<span id="el_groups_group_id">
<span<?= $Page->group_id->viewAttributes() ?>>
<?= $Page->group_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->group_name->Visible) { // group_name ?>
    <tr id="r_group_name"<?= $Page->group_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_groups_group_name"><?= $Page->group_name->caption() ?></span></td>
        <td data-name="group_name"<?= $Page->group_name->cellAttributes() ?>>
<span id="el_groups_group_name">
<span<?= $Page->group_name->viewAttributes() ?>>
<?= $Page->group_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->active->Visible) { // active ?>
    <tr id="r_active"<?= $Page->active->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_groups_active"><?= $Page->active->caption() ?></span></td>
        <td data-name="active"<?= $Page->active->cellAttributes() ?>>
<span id="el_groups_active">
<span<?= $Page->active->viewAttributes() ?>>
<?= $Page->active->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->group_key->Visible) { // group_key ?>
    <tr id="r_group_key"<?= $Page->group_key->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_groups_group_key"><?= $Page->group_key->caption() ?></span></td>
        <td data-name="group_key"<?= $Page->group_key->cellAttributes() ?>>
<span id="el_groups_group_key">
<span<?= $Page->group_key->viewAttributes() ?>>
<?= $Page->group_key->getViewValue() ?></span>
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
