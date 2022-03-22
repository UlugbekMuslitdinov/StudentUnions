<?php

namespace PHPMaker2021\project2;

// Page object
$ExceptionsDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fexceptionsdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fexceptionsdelete = currentForm = new ew.Form("fexceptionsdelete", "delete");
    loadjs.done("fexceptionsdelete");
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
<form name="fexceptionsdelete" id="fexceptionsdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="exceptions">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_exceptions_id" class="exceptions_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->location_id->Visible) { // location_id ?>
        <th class="<?= $Page->location_id->headerCellClass() ?>"><span id="elh_exceptions_location_id" class="exceptions_location_id"><?= $Page->location_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_of->Visible) { // date_of ?>
        <th class="<?= $Page->date_of->headerCellClass() ?>"><span id="elh_exceptions_date_of" class="exceptions_date_of"><?= $Page->date_of->caption() ?></span></th>
<?php } ?>
<?php if ($Page->open->Visible) { // open ?>
        <th class="<?= $Page->open->headerCellClass() ?>"><span id="elh_exceptions_open" class="exceptions_open"><?= $Page->open->caption() ?></span></th>
<?php } ?>
<?php if ($Page->close->Visible) { // close ?>
        <th class="<?= $Page->close->headerCellClass() ?>"><span id="elh_exceptions_close" class="exceptions_close"><?= $Page->close->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_exceptions_id" class="exceptions_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->location_id->Visible) { // location_id ?>
        <td <?= $Page->location_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_exceptions_location_id" class="exceptions_location_id">
<span<?= $Page->location_id->viewAttributes() ?>>
<?= $Page->location_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_of->Visible) { // date_of ?>
        <td <?= $Page->date_of->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_exceptions_date_of" class="exceptions_date_of">
<span<?= $Page->date_of->viewAttributes() ?>>
<?= $Page->date_of->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->open->Visible) { // open ?>
        <td <?= $Page->open->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_exceptions_open" class="exceptions_open">
<span<?= $Page->open->viewAttributes() ?>>
<?= $Page->open->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->close->Visible) { // close ?>
        <td <?= $Page->close->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_exceptions_close" class="exceptions_close">
<span<?= $Page->close->viewAttributes() ?>>
<?= $Page->close->getViewValue() ?></span>
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
