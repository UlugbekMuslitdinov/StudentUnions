<?php

namespace PHPMaker2021\project1;

// Page object
$ExpressTimelineDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fexpress_timelinedelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fexpress_timelinedelete = currentForm = new ew.Form("fexpress_timelinedelete", "delete");
    loadjs.done("fexpress_timelinedelete");
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
<form name="fexpress_timelinedelete" id="fexpress_timelinedelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="express_timeline">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_express_timeline_id" class="express_timeline_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->express_id->Visible) { // express_id ?>
        <th class="<?= $Page->express_id->headerCellClass() ?>"><span id="elh_express_timeline_express_id" class="express_timeline_express_id"><?= $Page->express_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->admin_id->Visible) { // admin_id ?>
        <th class="<?= $Page->admin_id->headerCellClass() ?>"><span id="elh_express_timeline_admin_id" class="express_timeline_admin_id"><?= $Page->admin_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_action->Visible) { // action ?>
        <th class="<?= $Page->_action->headerCellClass() ?>"><span id="elh_express_timeline__action" class="express_timeline__action"><?= $Page->_action->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th class="<?= $Page->created_at->headerCellClass() ?>"><span id="elh_express_timeline_created_at" class="express_timeline_created_at"><?= $Page->created_at->caption() ?></span></th>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
        <th class="<?= $Page->updated_at->headerCellClass() ?>"><span id="elh_express_timeline_updated_at" class="express_timeline_updated_at"><?= $Page->updated_at->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_express_timeline_id" class="express_timeline_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->express_id->Visible) { // express_id ?>
        <td <?= $Page->express_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_express_timeline_express_id" class="express_timeline_express_id">
<span<?= $Page->express_id->viewAttributes() ?>>
<?= $Page->express_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->admin_id->Visible) { // admin_id ?>
        <td <?= $Page->admin_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_express_timeline_admin_id" class="express_timeline_admin_id">
<span<?= $Page->admin_id->viewAttributes() ?>>
<?= $Page->admin_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_action->Visible) { // action ?>
        <td <?= $Page->_action->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_express_timeline__action" class="express_timeline__action">
<span<?= $Page->_action->viewAttributes() ?>>
<?= $Page->_action->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <td <?= $Page->created_at->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_express_timeline_created_at" class="express_timeline_created_at">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
        <td <?= $Page->updated_at->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_express_timeline_updated_at" class="express_timeline_updated_at">
<span<?= $Page->updated_at->viewAttributes() ?>>
<?= $Page->updated_at->getViewValue() ?></span>
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
