<?php

namespace PHPMaker2021\project1;

// Page object
$BoxMenuView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fbox_menuview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fbox_menuview = currentForm = new ew.Form("fbox_menuview", "view");
    loadjs.done("fbox_menuview");
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
<form name="fbox_menuview" id="fbox_menuview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="box_menu">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_menu_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_box_menu_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date->Visible) { // date ?>
    <tr id="r_date">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_menu_date"><?= $Page->date->caption() ?></span></td>
        <td data-name="date" <?= $Page->date->cellAttributes() ?>>
<span id="el_box_menu_date">
<span<?= $Page->date->viewAttributes() ?>>
<?= $Page->date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->day->Visible) { // day ?>
    <tr id="r_day">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_menu_day"><?= $Page->day->caption() ?></span></td>
        <td data-name="day" <?= $Page->day->cellAttributes() ?>>
<span id="el_box_menu_day">
<span<?= $Page->day->viewAttributes() ?>>
<?= $Page->day->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->breakfast_1->Visible) { // breakfast_1 ?>
    <tr id="r_breakfast_1">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_menu_breakfast_1"><?= $Page->breakfast_1->caption() ?></span></td>
        <td data-name="breakfast_1" <?= $Page->breakfast_1->cellAttributes() ?>>
<span id="el_box_menu_breakfast_1">
<span<?= $Page->breakfast_1->viewAttributes() ?>>
<?= $Page->breakfast_1->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->breakfast_2->Visible) { // breakfast_2 ?>
    <tr id="r_breakfast_2">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_menu_breakfast_2"><?= $Page->breakfast_2->caption() ?></span></td>
        <td data-name="breakfast_2" <?= $Page->breakfast_2->cellAttributes() ?>>
<span id="el_box_menu_breakfast_2">
<span<?= $Page->breakfast_2->viewAttributes() ?>>
<?= $Page->breakfast_2->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->breakfast_bag->Visible) { // breakfast_bag ?>
    <tr id="r_breakfast_bag">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_menu_breakfast_bag"><?= $Page->breakfast_bag->caption() ?></span></td>
        <td data-name="breakfast_bag" <?= $Page->breakfast_bag->cellAttributes() ?>>
<span id="el_box_menu_breakfast_bag">
<span<?= $Page->breakfast_bag->viewAttributes() ?>>
<?= $Page->breakfast_bag->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->breakfast_bag2->Visible) { // breakfast_bag2 ?>
    <tr id="r_breakfast_bag2">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_menu_breakfast_bag2"><?= $Page->breakfast_bag2->caption() ?></span></td>
        <td data-name="breakfast_bag2" <?= $Page->breakfast_bag2->cellAttributes() ?>>
<span id="el_box_menu_breakfast_bag2">
<span<?= $Page->breakfast_bag2->viewAttributes() ?>>
<?= $Page->breakfast_bag2->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->breakfast_beverage->Visible) { // breakfast_beverage ?>
    <tr id="r_breakfast_beverage">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_menu_breakfast_beverage"><?= $Page->breakfast_beverage->caption() ?></span></td>
        <td data-name="breakfast_beverage" <?= $Page->breakfast_beverage->cellAttributes() ?>>
<span id="el_box_menu_breakfast_beverage">
<span<?= $Page->breakfast_beverage->viewAttributes() ?>>
<?= $Page->breakfast_beverage->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->lunch_1->Visible) { // lunch_1 ?>
    <tr id="r_lunch_1">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_menu_lunch_1"><?= $Page->lunch_1->caption() ?></span></td>
        <td data-name="lunch_1" <?= $Page->lunch_1->cellAttributes() ?>>
<span id="el_box_menu_lunch_1">
<span<?= $Page->lunch_1->viewAttributes() ?>>
<?= $Page->lunch_1->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->lunch_2->Visible) { // lunch_2 ?>
    <tr id="r_lunch_2">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_menu_lunch_2"><?= $Page->lunch_2->caption() ?></span></td>
        <td data-name="lunch_2" <?= $Page->lunch_2->cellAttributes() ?>>
<span id="el_box_menu_lunch_2">
<span<?= $Page->lunch_2->viewAttributes() ?>>
<?= $Page->lunch_2->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->lunch_3->Visible) { // lunch_3 ?>
    <tr id="r_lunch_3">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_menu_lunch_3"><?= $Page->lunch_3->caption() ?></span></td>
        <td data-name="lunch_3" <?= $Page->lunch_3->cellAttributes() ?>>
<span id="el_box_menu_lunch_3">
<span<?= $Page->lunch_3->viewAttributes() ?>>
<?= $Page->lunch_3->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->lunch_bag->Visible) { // lunch_bag ?>
    <tr id="r_lunch_bag">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_menu_lunch_bag"><?= $Page->lunch_bag->caption() ?></span></td>
        <td data-name="lunch_bag" <?= $Page->lunch_bag->cellAttributes() ?>>
<span id="el_box_menu_lunch_bag">
<span<?= $Page->lunch_bag->viewAttributes() ?>>
<?= $Page->lunch_bag->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->lunch_bag2->Visible) { // lunch_bag2 ?>
    <tr id="r_lunch_bag2">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_menu_lunch_bag2"><?= $Page->lunch_bag2->caption() ?></span></td>
        <td data-name="lunch_bag2" <?= $Page->lunch_bag2->cellAttributes() ?>>
<span id="el_box_menu_lunch_bag2">
<span<?= $Page->lunch_bag2->viewAttributes() ?>>
<?= $Page->lunch_bag2->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->lunch_bag3->Visible) { // lunch_bag3 ?>
    <tr id="r_lunch_bag3">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_menu_lunch_bag3"><?= $Page->lunch_bag3->caption() ?></span></td>
        <td data-name="lunch_bag3" <?= $Page->lunch_bag3->cellAttributes() ?>>
<span id="el_box_menu_lunch_bag3">
<span<?= $Page->lunch_bag3->viewAttributes() ?>>
<?= $Page->lunch_bag3->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->lunch_beverage->Visible) { // lunch_beverage ?>
    <tr id="r_lunch_beverage">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_menu_lunch_beverage"><?= $Page->lunch_beverage->caption() ?></span></td>
        <td data-name="lunch_beverage" <?= $Page->lunch_beverage->cellAttributes() ?>>
<span id="el_box_menu_lunch_beverage">
<span<?= $Page->lunch_beverage->viewAttributes() ?>>
<?= $Page->lunch_beverage->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->dinner_1->Visible) { // dinner_1 ?>
    <tr id="r_dinner_1">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_menu_dinner_1"><?= $Page->dinner_1->caption() ?></span></td>
        <td data-name="dinner_1" <?= $Page->dinner_1->cellAttributes() ?>>
<span id="el_box_menu_dinner_1">
<span<?= $Page->dinner_1->viewAttributes() ?>>
<?= $Page->dinner_1->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->dinner_2->Visible) { // dinner_2 ?>
    <tr id="r_dinner_2">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_menu_dinner_2"><?= $Page->dinner_2->caption() ?></span></td>
        <td data-name="dinner_2" <?= $Page->dinner_2->cellAttributes() ?>>
<span id="el_box_menu_dinner_2">
<span<?= $Page->dinner_2->viewAttributes() ?>>
<?= $Page->dinner_2->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->dinner_3->Visible) { // dinner_3 ?>
    <tr id="r_dinner_3">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_menu_dinner_3"><?= $Page->dinner_3->caption() ?></span></td>
        <td data-name="dinner_3" <?= $Page->dinner_3->cellAttributes() ?>>
<span id="el_box_menu_dinner_3">
<span<?= $Page->dinner_3->viewAttributes() ?>>
<?= $Page->dinner_3->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->dinner_bag->Visible) { // dinner_bag ?>
    <tr id="r_dinner_bag">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_menu_dinner_bag"><?= $Page->dinner_bag->caption() ?></span></td>
        <td data-name="dinner_bag" <?= $Page->dinner_bag->cellAttributes() ?>>
<span id="el_box_menu_dinner_bag">
<span<?= $Page->dinner_bag->viewAttributes() ?>>
<?= $Page->dinner_bag->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->dinner_bag2->Visible) { // dinner_bag2 ?>
    <tr id="r_dinner_bag2">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_menu_dinner_bag2"><?= $Page->dinner_bag2->caption() ?></span></td>
        <td data-name="dinner_bag2" <?= $Page->dinner_bag2->cellAttributes() ?>>
<span id="el_box_menu_dinner_bag2">
<span<?= $Page->dinner_bag2->viewAttributes() ?>>
<?= $Page->dinner_bag2->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->dinner_bag3->Visible) { // dinner_bag3 ?>
    <tr id="r_dinner_bag3">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_menu_dinner_bag3"><?= $Page->dinner_bag3->caption() ?></span></td>
        <td data-name="dinner_bag3" <?= $Page->dinner_bag3->cellAttributes() ?>>
<span id="el_box_menu_dinner_bag3">
<span<?= $Page->dinner_bag3->viewAttributes() ?>>
<?= $Page->dinner_bag3->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->dinner_beverage->Visible) { // dinner_beverage ?>
    <tr id="r_dinner_beverage">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_box_menu_dinner_beverage"><?= $Page->dinner_beverage->caption() ?></span></td>
        <td data-name="dinner_beverage" <?= $Page->dinner_beverage->cellAttributes() ?>>
<span id="el_box_menu_dinner_beverage">
<span<?= $Page->dinner_beverage->viewAttributes() ?>>
<?= $Page->dinner_beverage->getViewValue() ?></span>
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
