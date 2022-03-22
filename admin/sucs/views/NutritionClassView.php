<?php

namespace PHPMaker2021\project4;

// Page object
$NutritionClassView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fnutrition_classview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fnutrition_classview = currentForm = new ew.Form("fnutrition_classview", "view");
    loadjs.done("fnutrition_classview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.nutrition_class) ew.vars.tables.nutrition_class = <?= JsonEncode(GetClientVar("tables", "nutrition_class")) ?>;
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
<form name="fnutrition_classview" id="fnutrition_classview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="nutrition_class">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_nutrition_class_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_nutrition_class_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->first_name->Visible) { // first_name ?>
    <tr id="r_first_name">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_nutrition_class_first_name"><?= $Page->first_name->caption() ?></span></td>
        <td data-name="first_name" <?= $Page->first_name->cellAttributes() ?>>
<span id="el_nutrition_class_first_name">
<span<?= $Page->first_name->viewAttributes() ?>>
<?= $Page->first_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->last_name->Visible) { // last_name ?>
    <tr id="r_last_name">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_nutrition_class_last_name"><?= $Page->last_name->caption() ?></span></td>
        <td data-name="last_name" <?= $Page->last_name->cellAttributes() ?>>
<span id="el_nutrition_class_last_name">
<span<?= $Page->last_name->viewAttributes() ?>>
<?= $Page->last_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
    <tr id="r__email">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_nutrition_class__email"><?= $Page->_email->caption() ?></span></td>
        <td data-name="_email" <?= $Page->_email->cellAttributes() ?>>
<span id="el_nutrition_class__email">
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->student_id->Visible) { // student_id ?>
    <tr id="r_student_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_nutrition_class_student_id"><?= $Page->student_id->caption() ?></span></td>
        <td data-name="student_id" <?= $Page->student_id->cellAttributes() ?>>
<span id="el_nutrition_class_student_id">
<span<?= $Page->student_id->viewAttributes() ?>>
<?= $Page->student_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->phone_number->Visible) { // phone_number ?>
    <tr id="r_phone_number">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_nutrition_class_phone_number"><?= $Page->phone_number->caption() ?></span></td>
        <td data-name="phone_number" <?= $Page->phone_number->cellAttributes() ?>>
<span id="el_nutrition_class_phone_number">
<span<?= $Page->phone_number->viewAttributes() ?>>
<?= $Page->phone_number->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->payment_option->Visible) { // payment_option ?>
    <tr id="r_payment_option">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_nutrition_class_payment_option"><?= $Page->payment_option->caption() ?></span></td>
        <td data-name="payment_option" <?= $Page->payment_option->cellAttributes() ?>>
<span id="el_nutrition_class_payment_option">
<span<?= $Page->payment_option->viewAttributes() ?>>
<?= $Page->payment_option->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->class_name->Visible) { // class_name ?>
    <tr id="r_class_name">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_nutrition_class_class_name"><?= $Page->class_name->caption() ?></span></td>
        <td data-name="class_name" <?= $Page->class_name->cellAttributes() ?>>
<span id="el_nutrition_class_class_name">
<span<?= $Page->class_name->viewAttributes() ?>>
<?= $Page->class_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->class_time->Visible) { // class_time ?>
    <tr id="r_class_time">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_nutrition_class_class_time"><?= $Page->class_time->caption() ?></span></td>
        <td data-name="class_time" <?= $Page->class_time->cellAttributes() ?>>
<span id="el_nutrition_class_class_time">
<span<?= $Page->class_time->viewAttributes() ?>>
<?= $Page->class_time->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
    <tr id="r_timestamp">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_nutrition_class_timestamp"><?= $Page->timestamp->caption() ?></span></td>
        <td data-name="timestamp" <?= $Page->timestamp->cellAttributes() ?>>
<span id="el_nutrition_class_timestamp">
<span<?= $Page->timestamp->viewAttributes() ?>>
<?= $Page->timestamp->getViewValue() ?></span>
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
