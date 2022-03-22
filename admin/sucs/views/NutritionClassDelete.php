<?php

namespace PHPMaker2021\project4;

// Page object
$NutritionClassDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fnutrition_classdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fnutrition_classdelete = currentForm = new ew.Form("fnutrition_classdelete", "delete");
    loadjs.done("fnutrition_classdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.nutrition_class) ew.vars.tables.nutrition_class = <?= JsonEncode(GetClientVar("tables", "nutrition_class")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fnutrition_classdelete" id="fnutrition_classdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="nutrition_class">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_nutrition_class_id" class="nutrition_class_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->first_name->Visible) { // first_name ?>
        <th class="<?= $Page->first_name->headerCellClass() ?>"><span id="elh_nutrition_class_first_name" class="nutrition_class_first_name"><?= $Page->first_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->last_name->Visible) { // last_name ?>
        <th class="<?= $Page->last_name->headerCellClass() ?>"><span id="elh_nutrition_class_last_name" class="nutrition_class_last_name"><?= $Page->last_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <th class="<?= $Page->_email->headerCellClass() ?>"><span id="elh_nutrition_class__email" class="nutrition_class__email"><?= $Page->_email->caption() ?></span></th>
<?php } ?>
<?php if ($Page->student_id->Visible) { // student_id ?>
        <th class="<?= $Page->student_id->headerCellClass() ?>"><span id="elh_nutrition_class_student_id" class="nutrition_class_student_id"><?= $Page->student_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->phone_number->Visible) { // phone_number ?>
        <th class="<?= $Page->phone_number->headerCellClass() ?>"><span id="elh_nutrition_class_phone_number" class="nutrition_class_phone_number"><?= $Page->phone_number->caption() ?></span></th>
<?php } ?>
<?php if ($Page->payment_option->Visible) { // payment_option ?>
        <th class="<?= $Page->payment_option->headerCellClass() ?>"><span id="elh_nutrition_class_payment_option" class="nutrition_class_payment_option"><?= $Page->payment_option->caption() ?></span></th>
<?php } ?>
<?php if ($Page->class_name->Visible) { // class_name ?>
        <th class="<?= $Page->class_name->headerCellClass() ?>"><span id="elh_nutrition_class_class_name" class="nutrition_class_class_name"><?= $Page->class_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->class_time->Visible) { // class_time ?>
        <th class="<?= $Page->class_time->headerCellClass() ?>"><span id="elh_nutrition_class_class_time" class="nutrition_class_class_time"><?= $Page->class_time->caption() ?></span></th>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <th class="<?= $Page->timestamp->headerCellClass() ?>"><span id="elh_nutrition_class_timestamp" class="nutrition_class_timestamp"><?= $Page->timestamp->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_nutrition_class_id" class="nutrition_class_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->first_name->Visible) { // first_name ?>
        <td <?= $Page->first_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_nutrition_class_first_name" class="nutrition_class_first_name">
<span<?= $Page->first_name->viewAttributes() ?>>
<?= $Page->first_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->last_name->Visible) { // last_name ?>
        <td <?= $Page->last_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_nutrition_class_last_name" class="nutrition_class_last_name">
<span<?= $Page->last_name->viewAttributes() ?>>
<?= $Page->last_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <td <?= $Page->_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_nutrition_class__email" class="nutrition_class__email">
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->student_id->Visible) { // student_id ?>
        <td <?= $Page->student_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_nutrition_class_student_id" class="nutrition_class_student_id">
<span<?= $Page->student_id->viewAttributes() ?>>
<?= $Page->student_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->phone_number->Visible) { // phone_number ?>
        <td <?= $Page->phone_number->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_nutrition_class_phone_number" class="nutrition_class_phone_number">
<span<?= $Page->phone_number->viewAttributes() ?>>
<?= $Page->phone_number->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->payment_option->Visible) { // payment_option ?>
        <td <?= $Page->payment_option->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_nutrition_class_payment_option" class="nutrition_class_payment_option">
<span<?= $Page->payment_option->viewAttributes() ?>>
<?= $Page->payment_option->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->class_name->Visible) { // class_name ?>
        <td <?= $Page->class_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_nutrition_class_class_name" class="nutrition_class_class_name">
<span<?= $Page->class_name->viewAttributes() ?>>
<?= $Page->class_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->class_time->Visible) { // class_time ?>
        <td <?= $Page->class_time->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_nutrition_class_class_time" class="nutrition_class_class_time">
<span<?= $Page->class_time->viewAttributes() ?>>
<?= $Page->class_time->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <td <?= $Page->timestamp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_nutrition_class_timestamp" class="nutrition_class_timestamp">
<span<?= $Page->timestamp->viewAttributes() ?>>
<?= $Page->timestamp->getViewValue() ?></span>
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
