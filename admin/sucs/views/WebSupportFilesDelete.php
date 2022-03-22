<?php

namespace PHPMaker2021\project4;

// Page object
$WebSupportFilesDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fweb_support_filesdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fweb_support_filesdelete = currentForm = new ew.Form("fweb_support_filesdelete", "delete");
    loadjs.done("fweb_support_filesdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.web_support_files) ew.vars.tables.web_support_files = <?= JsonEncode(GetClientVar("tables", "web_support_files")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fweb_support_filesdelete" id="fweb_support_filesdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="web_support_files">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_web_support_files_id" class="web_support_files_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ws_id->Visible) { // ws_id ?>
        <th class="<?= $Page->ws_id->headerCellClass() ?>"><span id="elh_web_support_files_ws_id" class="web_support_files_ws_id"><?= $Page->ws_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->file_path->Visible) { // file_path ?>
        <th class="<?= $Page->file_path->headerCellClass() ?>"><span id="elh_web_support_files_file_path" class="web_support_files_file_path"><?= $Page->file_path->caption() ?></span></th>
<?php } ?>
<?php if ($Page->original_filename->Visible) { // original_filename ?>
        <th class="<?= $Page->original_filename->headerCellClass() ?>"><span id="elh_web_support_files_original_filename" class="web_support_files_original_filename"><?= $Page->original_filename->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_web_support_files_id" class="web_support_files_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ws_id->Visible) { // ws_id ?>
        <td <?= $Page->ws_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_web_support_files_ws_id" class="web_support_files_ws_id">
<span<?= $Page->ws_id->viewAttributes() ?>>
<?= $Page->ws_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->file_path->Visible) { // file_path ?>
        <td <?= $Page->file_path->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_web_support_files_file_path" class="web_support_files_file_path">
<span<?= $Page->file_path->viewAttributes() ?>>
<?= $Page->file_path->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->original_filename->Visible) { // original_filename ?>
        <td <?= $Page->original_filename->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_web_support_files_original_filename" class="web_support_files_original_filename">
<span<?= $Page->original_filename->viewAttributes() ?>>
<?= $Page->original_filename->getViewValue() ?></span>
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
