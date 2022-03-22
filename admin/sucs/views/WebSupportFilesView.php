<?php

namespace PHPMaker2021\project4;

// Page object
$WebSupportFilesView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fweb_support_filesview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fweb_support_filesview = currentForm = new ew.Form("fweb_support_filesview", "view");
    loadjs.done("fweb_support_filesview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.web_support_files) ew.vars.tables.web_support_files = <?= JsonEncode(GetClientVar("tables", "web_support_files")) ?>;
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
<form name="fweb_support_filesview" id="fweb_support_filesview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="web_support_files">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_web_support_files_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_web_support_files_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ws_id->Visible) { // ws_id ?>
    <tr id="r_ws_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_web_support_files_ws_id"><?= $Page->ws_id->caption() ?></span></td>
        <td data-name="ws_id" <?= $Page->ws_id->cellAttributes() ?>>
<span id="el_web_support_files_ws_id">
<span<?= $Page->ws_id->viewAttributes() ?>>
<?= $Page->ws_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->file_path->Visible) { // file_path ?>
    <tr id="r_file_path">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_web_support_files_file_path"><?= $Page->file_path->caption() ?></span></td>
        <td data-name="file_path" <?= $Page->file_path->cellAttributes() ?>>
<span id="el_web_support_files_file_path">
<span<?= $Page->file_path->viewAttributes() ?>>
<?= $Page->file_path->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->original_filename->Visible) { // original_filename ?>
    <tr id="r_original_filename">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_web_support_files_original_filename"><?= $Page->original_filename->caption() ?></span></td>
        <td data-name="original_filename" <?= $Page->original_filename->cellAttributes() ?>>
<span id="el_web_support_files_original_filename">
<span<?= $Page->original_filename->viewAttributes() ?>>
<?= $Page->original_filename->getViewValue() ?></span>
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
