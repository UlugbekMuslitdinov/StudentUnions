<?php

namespace PHPMaker2022\project1;

// Page object
$GroupsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { groups: currentTable } });
var currentForm, currentPageID;
var fgroupsdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fgroupsdelete = new ew.Form("fgroupsdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fgroupsdelete;
    loadjs.done("fgroupsdelete");
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
<form name="fgroupsdelete" id="fgroupsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="groups">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table table-bordered table-hover table-sm ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->group_id->Visible) { // group_id ?>
        <th class="<?= $Page->group_id->headerCellClass() ?>"><span id="elh_groups_group_id" class="groups_group_id"><?= $Page->group_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->group_name->Visible) { // group_name ?>
        <th class="<?= $Page->group_name->headerCellClass() ?>"><span id="elh_groups_group_name" class="groups_group_name"><?= $Page->group_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->active->Visible) { // active ?>
        <th class="<?= $Page->active->headerCellClass() ?>"><span id="elh_groups_active" class="groups_active"><?= $Page->active->caption() ?></span></th>
<?php } ?>
<?php if ($Page->group_key->Visible) { // group_key ?>
        <th class="<?= $Page->group_key->headerCellClass() ?>"><span id="elh_groups_group_key" class="groups_group_key"><?= $Page->group_key->caption() ?></span></th>
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
<?php if ($Page->group_id->Visible) { // group_id ?>
        <td<?= $Page->group_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_groups_group_id" class="el_groups_group_id">
<span<?= $Page->group_id->viewAttributes() ?>>
<?= $Page->group_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->group_name->Visible) { // group_name ?>
        <td<?= $Page->group_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_groups_group_name" class="el_groups_group_name">
<span<?= $Page->group_name->viewAttributes() ?>>
<?= $Page->group_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->active->Visible) { // active ?>
        <td<?= $Page->active->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_groups_active" class="el_groups_active">
<span<?= $Page->active->viewAttributes() ?>>
<?= $Page->active->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->group_key->Visible) { // group_key ?>
        <td<?= $Page->group_key->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_groups_group_key" class="el_groups_group_key">
<span<?= $Page->group_key->viewAttributes() ?>>
<?= $Page->group_key->getViewValue() ?></span>
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
