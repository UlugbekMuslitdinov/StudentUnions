<?php

namespace PHPMaker2021\project1;

// Page object
$BoxChoiceDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fbox_choicedelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fbox_choicedelete = currentForm = new ew.Form("fbox_choicedelete", "delete");
    loadjs.done("fbox_choicedelete");
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
<form name="fbox_choicedelete" id="fbox_choicedelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="box_choice">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_box_choice_id" class="box_choice_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->order_id->Visible) { // order_id ?>
        <th class="<?= $Page->order_id->headerCellClass() ?>"><span id="elh_box_choice_order_id" class="box_choice_order_id"><?= $Page->order_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->box_id->Visible) { // box_id ?>
        <th class="<?= $Page->box_id->headerCellClass() ?>"><span id="elh_box_choice_box_id" class="box_choice_box_id"><?= $Page->box_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pickup_date->Visible) { // pickup_date ?>
        <th class="<?= $Page->pickup_date->headerCellClass() ?>"><span id="elh_box_choice_pickup_date" class="box_choice_pickup_date"><?= $Page->pickup_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->meal->Visible) { // meal ?>
        <th class="<?= $Page->meal->headerCellClass() ?>"><span id="elh_box_choice_meal" class="box_choice_meal"><?= $Page->meal->caption() ?></span></th>
<?php } ?>
<?php if ($Page->beverage->Visible) { // beverage ?>
        <th class="<?= $Page->beverage->headerCellClass() ?>"><span id="elh_box_choice_beverage" class="box_choice_beverage"><?= $Page->beverage->caption() ?></span></th>
<?php } ?>
<?php if ($Page->box_name->Visible) { // box_name ?>
        <th class="<?= $Page->box_name->headerCellClass() ?>"><span id="elh_box_choice_box_name" class="box_choice_box_name"><?= $Page->box_name->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_box_choice_id" class="box_choice_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->order_id->Visible) { // order_id ?>
        <td <?= $Page->order_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_choice_order_id" class="box_choice_order_id">
<span<?= $Page->order_id->viewAttributes() ?>>
<?= $Page->order_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->box_id->Visible) { // box_id ?>
        <td <?= $Page->box_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_choice_box_id" class="box_choice_box_id">
<span<?= $Page->box_id->viewAttributes() ?>>
<?= $Page->box_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pickup_date->Visible) { // pickup_date ?>
        <td <?= $Page->pickup_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_choice_pickup_date" class="box_choice_pickup_date">
<span<?= $Page->pickup_date->viewAttributes() ?>>
<?= $Page->pickup_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->meal->Visible) { // meal ?>
        <td <?= $Page->meal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_choice_meal" class="box_choice_meal">
<span<?= $Page->meal->viewAttributes() ?>>
<?= $Page->meal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->beverage->Visible) { // beverage ?>
        <td <?= $Page->beverage->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_choice_beverage" class="box_choice_beverage">
<span<?= $Page->beverage->viewAttributes() ?>>
<?= $Page->beverage->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->box_name->Visible) { // box_name ?>
        <td <?= $Page->box_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_choice_box_name" class="box_choice_box_name">
<span<?= $Page->box_name->viewAttributes() ?>>
<?= $Page->box_name->getViewValue() ?></span>
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
