<?php

namespace PHPMaker2021\project1;

// Page object
$BoxChoiceView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fbox_choiceview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fbox_choiceview = currentForm = new ew.Form("fbox_choiceview", "view");
    loadjs.done("fbox_choiceview");
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
<form name="fbox_choiceview" id="fbox_choiceview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="box_choice">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_choice_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_box_choice_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->order_id->Visible) { // order_id ?>
    <tr id="r_order_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_choice_order_id"><?= $Page->order_id->caption() ?></span></td>
        <td data-name="order_id" <?= $Page->order_id->cellAttributes() ?>>
<span id="el_box_choice_order_id">
<span<?= $Page->order_id->viewAttributes() ?>>
<?= $Page->order_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->box_id->Visible) { // box_id ?>
    <tr id="r_box_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_choice_box_id"><?= $Page->box_id->caption() ?></span></td>
        <td data-name="box_id" <?= $Page->box_id->cellAttributes() ?>>
<span id="el_box_choice_box_id">
<span<?= $Page->box_id->viewAttributes() ?>>
<?= $Page->box_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pickup_date->Visible) { // pickup_date ?>
    <tr id="r_pickup_date">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_choice_pickup_date"><?= $Page->pickup_date->caption() ?></span></td>
        <td data-name="pickup_date" <?= $Page->pickup_date->cellAttributes() ?>>
<span id="el_box_choice_pickup_date">
<span<?= $Page->pickup_date->viewAttributes() ?>>
<?= $Page->pickup_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->meal->Visible) { // meal ?>
    <tr id="r_meal">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_choice_meal"><?= $Page->meal->caption() ?></span></td>
        <td data-name="meal" <?= $Page->meal->cellAttributes() ?>>
<span id="el_box_choice_meal">
<span<?= $Page->meal->viewAttributes() ?>>
<?= $Page->meal->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->beverage->Visible) { // beverage ?>
    <tr id="r_beverage">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_choice_beverage"><?= $Page->beverage->caption() ?></span></td>
        <td data-name="beverage" <?= $Page->beverage->cellAttributes() ?>>
<span id="el_box_choice_beverage">
<span<?= $Page->beverage->viewAttributes() ?>>
<?= $Page->beverage->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->box_name->Visible) { // box_name ?>
    <tr id="r_box_name">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_choice_box_name"><?= $Page->box_name->caption() ?></span></td>
        <td data-name="box_name" <?= $Page->box_name->cellAttributes() ?>>
<span id="el_box_choice_box_name">
<span<?= $Page->box_name->viewAttributes() ?>>
<?= $Page->box_name->getViewValue() ?></span>
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
