<?php

namespace PHPMaker2021\project3;

// Page object
$PagesDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fpagesdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fpagesdelete = currentForm = new ew.Form("fpagesdelete", "delete");
    loadjs.done("fpagesdelete");
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
<form name="fpagesdelete" id="fpagesdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pages">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_pages_id" class="pages_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->domain->Visible) { // domain ?>
        <th class="<?= $Page->domain->headerCellClass() ?>"><span id="elh_pages_domain" class="pages_domain"><?= $Page->domain->caption() ?></span></th>
<?php } ?>
<?php if ($Page->path->Visible) { // path ?>
        <th class="<?= $Page->path->headerCellClass() ?>"><span id="elh_pages_path" class="pages_path"><?= $Page->path->caption() ?></span></th>
<?php } ?>
<?php if ($Page->displayBlockID->Visible) { // displayBlockID ?>
        <th class="<?= $Page->displayBlockID->headerCellClass() ?>"><span id="elh_pages_displayBlockID" class="pages_displayBlockID"><?= $Page->displayBlockID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
        <th class="<?= $Page->type->headerCellClass() ?>"><span id="elh_pages_type" class="pages_type"><?= $Page->type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date->Visible) { // date ?>
        <th class="<?= $Page->date->headerCellClass() ?>"><span id="elh_pages_date" class="pages_date"><?= $Page->date->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_pages_id" class="pages_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->domain->Visible) { // domain ?>
        <td <?= $Page->domain->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pages_domain" class="pages_domain">
<span<?= $Page->domain->viewAttributes() ?>>
<?= $Page->domain->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->path->Visible) { // path ?>
        <td <?= $Page->path->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pages_path" class="pages_path">
<span<?= $Page->path->viewAttributes() ?>>
<?= $Page->path->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->displayBlockID->Visible) { // displayBlockID ?>
        <td <?= $Page->displayBlockID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pages_displayBlockID" class="pages_displayBlockID">
<span<?= $Page->displayBlockID->viewAttributes() ?>>
<?= $Page->displayBlockID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
        <td <?= $Page->type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pages_type" class="pages_type">
<span<?= $Page->type->viewAttributes() ?>>
<?= $Page->type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date->Visible) { // date ?>
        <td <?= $Page->date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pages_date" class="pages_date">
<span<?= $Page->date->viewAttributes() ?>>
<?= $Page->date->getViewValue() ?></span>
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
