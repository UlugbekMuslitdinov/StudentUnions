<?php

namespace PHPMaker2022\project1;

// Page object
$LocationDescriptionsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { location_descriptions: currentTable } });
var currentForm, currentPageID;
var flocation_descriptionsview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    flocation_descriptionsview = new ew.Form("flocation_descriptionsview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = flocation_descriptionsview;
    loadjs.done("flocation_descriptionsview");
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
<form name="flocation_descriptionsview" id="flocation_descriptionsview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="location_descriptions">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->location_id->Visible) { // location_id ?>
    <tr id="r_location_id"<?= $Page->location_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_location_descriptions_location_id"><?= $Page->location_id->caption() ?></span></td>
        <td data-name="location_id"<?= $Page->location_id->cellAttributes() ?>>
<span id="el_location_descriptions_location_id">
<span<?= $Page->location_id->viewAttributes() ?>>
<?= $Page->location_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->short->Visible) { // short ?>
    <tr id="r_short"<?= $Page->short->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_location_descriptions_short"><?= $Page->short->caption() ?></span></td>
        <td data-name="short"<?= $Page->short->cellAttributes() ?>>
<span id="el_location_descriptions_short">
<span<?= $Page->short->viewAttributes() ?>>
<?= $Page->short->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->long->Visible) { // long ?>
    <tr id="r_long"<?= $Page->long->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_location_descriptions_long"><?= $Page->long->caption() ?></span></td>
        <td data-name="long"<?= $Page->long->cellAttributes() ?>>
<span id="el_location_descriptions_long">
<span<?= $Page->long->viewAttributes() ?>>
<?= $Page->long->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->hours_message->Visible) { // hours_message ?>
    <tr id="r_hours_message"<?= $Page->hours_message->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_location_descriptions_hours_message"><?= $Page->hours_message->caption() ?></span></td>
        <td data-name="hours_message"<?= $Page->hours_message->cellAttributes() ?>>
<span id="el_location_descriptions_hours_message">
<span<?= $Page->hours_message->viewAttributes() ?>>
<?= $Page->hours_message->getViewValue() ?></span>
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
