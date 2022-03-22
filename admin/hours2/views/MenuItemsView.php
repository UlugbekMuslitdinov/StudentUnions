<?php

namespace PHPMaker2021\project2;

// Page object
$MenuItemsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fmenu_itemsview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fmenu_itemsview = currentForm = new ew.Form("fmenu_itemsview", "view");
    loadjs.done("fmenu_itemsview");
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
<form name="fmenu_itemsview" id="fmenu_itemsview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="menu_items">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_menu_items_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_menu_items_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->menu_item->Visible) { // menu_item ?>
    <tr id="r_menu_item">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_menu_items_menu_item"><?= $Page->menu_item->caption() ?></span></td>
        <td data-name="menu_item" <?= $Page->menu_item->cellAttributes() ?>>
<span id="el_menu_items_menu_item">
<span<?= $Page->menu_item->viewAttributes() ?>>
<?= $Page->menu_item->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->menu_item_price->Visible) { // menu_item_price ?>
    <tr id="r_menu_item_price">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_menu_items_menu_item_price"><?= $Page->menu_item_price->caption() ?></span></td>
        <td data-name="menu_item_price" <?= $Page->menu_item_price->cellAttributes() ?>>
<span id="el_menu_items_menu_item_price">
<span<?= $Page->menu_item_price->viewAttributes() ?>>
<?= $Page->menu_item_price->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->menu_restaurant->Visible) { // menu_restaurant ?>
    <tr id="r_menu_restaurant">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_menu_items_menu_restaurant"><?= $Page->menu_restaurant->caption() ?></span></td>
        <td data-name="menu_restaurant" <?= $Page->menu_restaurant->cellAttributes() ?>>
<span id="el_menu_items_menu_restaurant">
<span<?= $Page->menu_restaurant->viewAttributes() ?>>
<?= $Page->menu_restaurant->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->menu_category->Visible) { // menu_category ?>
    <tr id="r_menu_category">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_menu_items_menu_category"><?= $Page->menu_category->caption() ?></span></td>
        <td data-name="menu_category" <?= $Page->menu_category->cellAttributes() ?>>
<span id="el_menu_items_menu_category">
<span<?= $Page->menu_category->viewAttributes() ?>>
<?= $Page->menu_category->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->meal_details_id->Visible) { // meal_details_id ?>
    <tr id="r_meal_details_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_menu_items_meal_details_id"><?= $Page->meal_details_id->caption() ?></span></td>
        <td data-name="meal_details_id" <?= $Page->meal_details_id->cellAttributes() ?>>
<span id="el_menu_items_meal_details_id">
<span<?= $Page->meal_details_id->viewAttributes() ?>>
<?= $Page->meal_details_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->menu_item_comments->Visible) { // menu_item_comments ?>
    <tr id="r_menu_item_comments">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_menu_items_menu_item_comments"><?= $Page->menu_item_comments->caption() ?></span></td>
        <td data-name="menu_item_comments" <?= $Page->menu_item_comments->cellAttributes() ?>>
<span id="el_menu_items_menu_item_comments">
<span<?= $Page->menu_item_comments->viewAttributes() ?>>
<?= $Page->menu_item_comments->getViewValue() ?></span>
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
