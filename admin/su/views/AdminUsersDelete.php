<?php

namespace PHPMaker2021\project1;

// Page object
$AdminUsersDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fadmin_usersdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fadmin_usersdelete = currentForm = new ew.Form("fadmin_usersdelete", "delete");
    loadjs.done("fadmin_usersdelete");
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
<form name="fadmin_usersdelete" id="fadmin_usersdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="admin_users">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_admin_users_id" class="admin_users_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->unionstaff_id->Visible) { // unionstaff_id ?>
        <th class="<?= $Page->unionstaff_id->headerCellClass() ?>"><span id="elh_admin_users_unionstaff_id" class="admin_users_unionstaff_id"><?= $Page->unionstaff_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->netid->Visible) { // netid ?>
        <th class="<?= $Page->netid->headerCellClass() ?>"><span id="elh_admin_users_netid" class="admin_users_netid"><?= $Page->netid->caption() ?></span></th>
<?php } ?>
<?php if ($Page->access_level->Visible) { // access_level ?>
        <th class="<?= $Page->access_level->headerCellClass() ?>"><span id="elh_admin_users_access_level" class="admin_users_access_level"><?= $Page->access_level->caption() ?></span></th>
<?php } ?>
<?php if ($Page->active->Visible) { // active ?>
        <th class="<?= $Page->active->headerCellClass() ?>"><span id="elh_admin_users_active" class="admin_users_active"><?= $Page->active->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_admin_users_id" class="admin_users_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->unionstaff_id->Visible) { // unionstaff_id ?>
        <td <?= $Page->unionstaff_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_admin_users_unionstaff_id" class="admin_users_unionstaff_id">
<span<?= $Page->unionstaff_id->viewAttributes() ?>>
<?= $Page->unionstaff_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->netid->Visible) { // netid ?>
        <td <?= $Page->netid->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_admin_users_netid" class="admin_users_netid">
<span<?= $Page->netid->viewAttributes() ?>>
<?= $Page->netid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->access_level->Visible) { // access_level ?>
        <td <?= $Page->access_level->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_admin_users_access_level" class="admin_users_access_level">
<span<?= $Page->access_level->viewAttributes() ?>>
<?= $Page->access_level->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->active->Visible) { // active ?>
        <td <?= $Page->active->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_admin_users_active" class="admin_users_active">
<span<?= $Page->active->viewAttributes() ?>>
<?= $Page->active->getViewValue() ?></span>
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
