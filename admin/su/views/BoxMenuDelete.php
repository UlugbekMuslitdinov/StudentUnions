<?php

namespace PHPMaker2021\project1;

// Page object
$BoxMenuDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fbox_menudelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fbox_menudelete = currentForm = new ew.Form("fbox_menudelete", "delete");
    loadjs.done("fbox_menudelete");
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
<form name="fbox_menudelete" id="fbox_menudelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="box_menu">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_box_menu_id" class="box_menu_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date->Visible) { // date ?>
        <th class="<?= $Page->date->headerCellClass() ?>"><span id="elh_box_menu_date" class="box_menu_date"><?= $Page->date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->day->Visible) { // day ?>
        <th class="<?= $Page->day->headerCellClass() ?>"><span id="elh_box_menu_day" class="box_menu_day"><?= $Page->day->caption() ?></span></th>
<?php } ?>
<?php if ($Page->breakfast_1->Visible) { // breakfast_1 ?>
        <th class="<?= $Page->breakfast_1->headerCellClass() ?>"><span id="elh_box_menu_breakfast_1" class="box_menu_breakfast_1"><?= $Page->breakfast_1->caption() ?></span></th>
<?php } ?>
<?php if ($Page->breakfast_2->Visible) { // breakfast_2 ?>
        <th class="<?= $Page->breakfast_2->headerCellClass() ?>"><span id="elh_box_menu_breakfast_2" class="box_menu_breakfast_2"><?= $Page->breakfast_2->caption() ?></span></th>
<?php } ?>
<?php if ($Page->breakfast_bag->Visible) { // breakfast_bag ?>
        <th class="<?= $Page->breakfast_bag->headerCellClass() ?>"><span id="elh_box_menu_breakfast_bag" class="box_menu_breakfast_bag"><?= $Page->breakfast_bag->caption() ?></span></th>
<?php } ?>
<?php if ($Page->breakfast_bag2->Visible) { // breakfast_bag2 ?>
        <th class="<?= $Page->breakfast_bag2->headerCellClass() ?>"><span id="elh_box_menu_breakfast_bag2" class="box_menu_breakfast_bag2"><?= $Page->breakfast_bag2->caption() ?></span></th>
<?php } ?>
<?php if ($Page->breakfast_beverage->Visible) { // breakfast_beverage ?>
        <th class="<?= $Page->breakfast_beverage->headerCellClass() ?>"><span id="elh_box_menu_breakfast_beverage" class="box_menu_breakfast_beverage"><?= $Page->breakfast_beverage->caption() ?></span></th>
<?php } ?>
<?php if ($Page->lunch_1->Visible) { // lunch_1 ?>
        <th class="<?= $Page->lunch_1->headerCellClass() ?>"><span id="elh_box_menu_lunch_1" class="box_menu_lunch_1"><?= $Page->lunch_1->caption() ?></span></th>
<?php } ?>
<?php if ($Page->lunch_2->Visible) { // lunch_2 ?>
        <th class="<?= $Page->lunch_2->headerCellClass() ?>"><span id="elh_box_menu_lunch_2" class="box_menu_lunch_2"><?= $Page->lunch_2->caption() ?></span></th>
<?php } ?>
<?php if ($Page->lunch_3->Visible) { // lunch_3 ?>
        <th class="<?= $Page->lunch_3->headerCellClass() ?>"><span id="elh_box_menu_lunch_3" class="box_menu_lunch_3"><?= $Page->lunch_3->caption() ?></span></th>
<?php } ?>
<?php if ($Page->lunch_bag->Visible) { // lunch_bag ?>
        <th class="<?= $Page->lunch_bag->headerCellClass() ?>"><span id="elh_box_menu_lunch_bag" class="box_menu_lunch_bag"><?= $Page->lunch_bag->caption() ?></span></th>
<?php } ?>
<?php if ($Page->lunch_bag2->Visible) { // lunch_bag2 ?>
        <th class="<?= $Page->lunch_bag2->headerCellClass() ?>"><span id="elh_box_menu_lunch_bag2" class="box_menu_lunch_bag2"><?= $Page->lunch_bag2->caption() ?></span></th>
<?php } ?>
<?php if ($Page->lunch_bag3->Visible) { // lunch_bag3 ?>
        <th class="<?= $Page->lunch_bag3->headerCellClass() ?>"><span id="elh_box_menu_lunch_bag3" class="box_menu_lunch_bag3"><?= $Page->lunch_bag3->caption() ?></span></th>
<?php } ?>
<?php if ($Page->lunch_beverage->Visible) { // lunch_beverage ?>
        <th class="<?= $Page->lunch_beverage->headerCellClass() ?>"><span id="elh_box_menu_lunch_beverage" class="box_menu_lunch_beverage"><?= $Page->lunch_beverage->caption() ?></span></th>
<?php } ?>
<?php if ($Page->dinner_1->Visible) { // dinner_1 ?>
        <th class="<?= $Page->dinner_1->headerCellClass() ?>"><span id="elh_box_menu_dinner_1" class="box_menu_dinner_1"><?= $Page->dinner_1->caption() ?></span></th>
<?php } ?>
<?php if ($Page->dinner_2->Visible) { // dinner_2 ?>
        <th class="<?= $Page->dinner_2->headerCellClass() ?>"><span id="elh_box_menu_dinner_2" class="box_menu_dinner_2"><?= $Page->dinner_2->caption() ?></span></th>
<?php } ?>
<?php if ($Page->dinner_3->Visible) { // dinner_3 ?>
        <th class="<?= $Page->dinner_3->headerCellClass() ?>"><span id="elh_box_menu_dinner_3" class="box_menu_dinner_3"><?= $Page->dinner_3->caption() ?></span></th>
<?php } ?>
<?php if ($Page->dinner_bag->Visible) { // dinner_bag ?>
        <th class="<?= $Page->dinner_bag->headerCellClass() ?>"><span id="elh_box_menu_dinner_bag" class="box_menu_dinner_bag"><?= $Page->dinner_bag->caption() ?></span></th>
<?php } ?>
<?php if ($Page->dinner_bag2->Visible) { // dinner_bag2 ?>
        <th class="<?= $Page->dinner_bag2->headerCellClass() ?>"><span id="elh_box_menu_dinner_bag2" class="box_menu_dinner_bag2"><?= $Page->dinner_bag2->caption() ?></span></th>
<?php } ?>
<?php if ($Page->dinner_bag3->Visible) { // dinner_bag3 ?>
        <th class="<?= $Page->dinner_bag3->headerCellClass() ?>"><span id="elh_box_menu_dinner_bag3" class="box_menu_dinner_bag3"><?= $Page->dinner_bag3->caption() ?></span></th>
<?php } ?>
<?php if ($Page->dinner_beverage->Visible) { // dinner_beverage ?>
        <th class="<?= $Page->dinner_beverage->headerCellClass() ?>"><span id="elh_box_menu_dinner_beverage" class="box_menu_dinner_beverage"><?= $Page->dinner_beverage->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_box_menu_id" class="box_menu_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date->Visible) { // date ?>
        <td <?= $Page->date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_date" class="box_menu_date">
<span<?= $Page->date->viewAttributes() ?>>
<?= $Page->date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->day->Visible) { // day ?>
        <td <?= $Page->day->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_day" class="box_menu_day">
<span<?= $Page->day->viewAttributes() ?>>
<?= $Page->day->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->breakfast_1->Visible) { // breakfast_1 ?>
        <td <?= $Page->breakfast_1->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_breakfast_1" class="box_menu_breakfast_1">
<span<?= $Page->breakfast_1->viewAttributes() ?>>
<?= $Page->breakfast_1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->breakfast_2->Visible) { // breakfast_2 ?>
        <td <?= $Page->breakfast_2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_breakfast_2" class="box_menu_breakfast_2">
<span<?= $Page->breakfast_2->viewAttributes() ?>>
<?= $Page->breakfast_2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->breakfast_bag->Visible) { // breakfast_bag ?>
        <td <?= $Page->breakfast_bag->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_breakfast_bag" class="box_menu_breakfast_bag">
<span<?= $Page->breakfast_bag->viewAttributes() ?>>
<?= $Page->breakfast_bag->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->breakfast_bag2->Visible) { // breakfast_bag2 ?>
        <td <?= $Page->breakfast_bag2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_breakfast_bag2" class="box_menu_breakfast_bag2">
<span<?= $Page->breakfast_bag2->viewAttributes() ?>>
<?= $Page->breakfast_bag2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->breakfast_beverage->Visible) { // breakfast_beverage ?>
        <td <?= $Page->breakfast_beverage->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_breakfast_beverage" class="box_menu_breakfast_beverage">
<span<?= $Page->breakfast_beverage->viewAttributes() ?>>
<?= $Page->breakfast_beverage->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->lunch_1->Visible) { // lunch_1 ?>
        <td <?= $Page->lunch_1->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_lunch_1" class="box_menu_lunch_1">
<span<?= $Page->lunch_1->viewAttributes() ?>>
<?= $Page->lunch_1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->lunch_2->Visible) { // lunch_2 ?>
        <td <?= $Page->lunch_2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_lunch_2" class="box_menu_lunch_2">
<span<?= $Page->lunch_2->viewAttributes() ?>>
<?= $Page->lunch_2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->lunch_3->Visible) { // lunch_3 ?>
        <td <?= $Page->lunch_3->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_lunch_3" class="box_menu_lunch_3">
<span<?= $Page->lunch_3->viewAttributes() ?>>
<?= $Page->lunch_3->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->lunch_bag->Visible) { // lunch_bag ?>
        <td <?= $Page->lunch_bag->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_lunch_bag" class="box_menu_lunch_bag">
<span<?= $Page->lunch_bag->viewAttributes() ?>>
<?= $Page->lunch_bag->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->lunch_bag2->Visible) { // lunch_bag2 ?>
        <td <?= $Page->lunch_bag2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_lunch_bag2" class="box_menu_lunch_bag2">
<span<?= $Page->lunch_bag2->viewAttributes() ?>>
<?= $Page->lunch_bag2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->lunch_bag3->Visible) { // lunch_bag3 ?>
        <td <?= $Page->lunch_bag3->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_lunch_bag3" class="box_menu_lunch_bag3">
<span<?= $Page->lunch_bag3->viewAttributes() ?>>
<?= $Page->lunch_bag3->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->lunch_beverage->Visible) { // lunch_beverage ?>
        <td <?= $Page->lunch_beverage->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_lunch_beverage" class="box_menu_lunch_beverage">
<span<?= $Page->lunch_beverage->viewAttributes() ?>>
<?= $Page->lunch_beverage->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->dinner_1->Visible) { // dinner_1 ?>
        <td <?= $Page->dinner_1->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_dinner_1" class="box_menu_dinner_1">
<span<?= $Page->dinner_1->viewAttributes() ?>>
<?= $Page->dinner_1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->dinner_2->Visible) { // dinner_2 ?>
        <td <?= $Page->dinner_2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_dinner_2" class="box_menu_dinner_2">
<span<?= $Page->dinner_2->viewAttributes() ?>>
<?= $Page->dinner_2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->dinner_3->Visible) { // dinner_3 ?>
        <td <?= $Page->dinner_3->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_dinner_3" class="box_menu_dinner_3">
<span<?= $Page->dinner_3->viewAttributes() ?>>
<?= $Page->dinner_3->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->dinner_bag->Visible) { // dinner_bag ?>
        <td <?= $Page->dinner_bag->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_dinner_bag" class="box_menu_dinner_bag">
<span<?= $Page->dinner_bag->viewAttributes() ?>>
<?= $Page->dinner_bag->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->dinner_bag2->Visible) { // dinner_bag2 ?>
        <td <?= $Page->dinner_bag2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_dinner_bag2" class="box_menu_dinner_bag2">
<span<?= $Page->dinner_bag2->viewAttributes() ?>>
<?= $Page->dinner_bag2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->dinner_bag3->Visible) { // dinner_bag3 ?>
        <td <?= $Page->dinner_bag3->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_dinner_bag3" class="box_menu_dinner_bag3">
<span<?= $Page->dinner_bag3->viewAttributes() ?>>
<?= $Page->dinner_bag3->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->dinner_beverage->Visible) { // dinner_beverage ?>
        <td <?= $Page->dinner_beverage->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_menu_dinner_beverage" class="box_menu_dinner_beverage">
<span<?= $Page->dinner_beverage->viewAttributes() ?>>
<?= $Page->dinner_beverage->getViewValue() ?></span>
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
