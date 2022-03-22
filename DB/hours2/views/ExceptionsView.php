<?php

namespace PHPMaker2022\project2;

// Page object
$ExceptionsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { exceptions: currentTable } });
var currentForm, currentPageID;
var fexceptionsview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fexceptionsview = new ew.Form("fexceptionsview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fexceptionsview;
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
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fexceptionsview" id="fexceptionsview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="exceptions">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_exceptions_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_exceptions_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->location_id->Visible) { // location_id ?>
    <tr id="r_location_id"<?= $Page->location_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_exceptions_location_id"><?= $Page->location_id->caption() ?></span></td>
        <td data-name="location_id"<?= $Page->location_id->cellAttributes() ?>>
<span id="el_exceptions_location_id">
<span<?= $Page->location_id->viewAttributes() ?>>
<?= $Page->location_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_of->Visible) { // date_of ?>
    <tr id="r_date_of"<?= $Page->date_of->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_exceptions_date_of"><?= $Page->date_of->caption() ?></span></td>
        <td data-name="date_of"<?= $Page->date_of->cellAttributes() ?>>
<span id="el_exceptions_date_of">
<span<?= $Page->date_of->viewAttributes() ?>>
<?= $Page->date_of->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->open->Visible) { // open ?>
    <tr id="r_open"<?= $Page->open->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_exceptions_open"><?= $Page->open->caption() ?></span></td>
        <td data-name="open"<?= $Page->open->cellAttributes() ?>>
<span id="el_exceptions_open">
<span<?= $Page->open->viewAttributes() ?>>
<?= $Page->open->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->close->Visible) { // close ?>
    <tr id="r_close"<?= $Page->close->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_exceptions_close"><?= $Page->close->caption() ?></span></td>
        <td data-name="close"<?= $Page->close->cellAttributes() ?>>
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
