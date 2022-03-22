<?php

namespace PHPMaker2021\project2;

// Page object
$ExceptionsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fexceptionsview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fexceptionsview = currentForm = new ew.Form("fexceptionsview", "view");
    loadjs.done("fexceptionsview");
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
<form name="fexceptionsview" id="fexceptionsview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="exceptions">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_exceptions_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_exceptions_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->location_id->Visible) { // location_id ?>
    <tr id="r_location_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_exceptions_location_id"><?= $Page->location_id->caption() ?></span></td>
        <td data-name="location_id" <?= $Page->location_id->cellAttributes() ?>>
<span id="el_exceptions_location_id">
<span<?= $Page->location_id->viewAttributes() ?>>
<?= $Page->location_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_of->Visible) { // date_of ?>
    <tr id="r_date_of">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_exceptions_date_of"><?= $Page->date_of->caption() ?></span></td>
        <td data-name="date_of" <?= $Page->date_of->cellAttributes() ?>>
<span id="el_exceptions_date_of">
<span<?= $Page->date_of->viewAttributes() ?>>
<?= $Page->date_of->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->open->Visible) { // open ?>
    <tr id="r_open">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_exceptions_open"><?= $Page->open->caption() ?></span></td>
        <td data-name="open" <?= $Page->open->cellAttributes() ?>>
<span id="el_exceptions_open">
<span<?= $Page->open->viewAttributes() ?>>
<?= $Page->open->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->close->Visible) { // close ?>
    <tr id="r_close">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_exceptions_close"><?= $Page->close->caption() ?></span></td>
        <td data-name="close" <?= $Page->close->cellAttributes() ?>>
<span id="el_exceptions_close">
<span<?= $Page->close->viewAttributes() ?>>
<?= $Page->close->getViewValue() ?></span>
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
