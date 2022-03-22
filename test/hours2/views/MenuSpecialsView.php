<?php

namespace PHPMaker2022\project1;

// Page object
$MenuSpecialsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { menu_specials: currentTable } });
var currentForm, currentPageID;
var fmenu_specialsview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmenu_specialsview = new ew.Form("fmenu_specialsview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fmenu_specialsview;
    loadjs.done("fmenu_specialsview");
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
<form name="fmenu_specialsview" id="fmenu_specialsview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="menu_specials">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_menu_specials_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_menu_specials_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->menu_special->Visible) { // menu_special ?>
    <tr id="r_menu_special"<?= $Page->menu_special->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_menu_specials_menu_special"><?= $Page->menu_special->caption() ?></span></td>
        <td data-name="menu_special"<?= $Page->menu_special->cellAttributes() ?>>
<span id="el_menu_specials_menu_special">
<span<?= $Page->menu_special->viewAttributes() ?>>
<?= $Page->menu_special->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->menu_special_price->Visible) { // menu_special_price ?>
    <tr id="r_menu_special_price"<?= $Page->menu_special_price->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_menu_specials_menu_special_price"><?= $Page->menu_special_price->caption() ?></span></td>
        <td data-name="menu_special_price"<?= $Page->menu_special_price->cellAttributes() ?>>
<span id="el_menu_specials_menu_special_price">
<span<?= $Page->menu_special_price->viewAttributes() ?>>
<?= $Page->menu_special_price->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->menu_restaurant->Visible) { // menu_restaurant ?>
    <tr id="r_menu_restaurant"<?= $Page->menu_restaurant->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_menu_specials_menu_restaurant"><?= $Page->menu_restaurant->caption() ?></span></td>
        <td data-name="menu_restaurant"<?= $Page->menu_restaurant->cellAttributes() ?>>
<span id="el_menu_specials_menu_restaurant">
<span<?= $Page->menu_restaurant->viewAttributes() ?>>
<?= $Page->menu_restaurant->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->menu_category->Visible) { // menu_category ?>
    <tr id="r_menu_category"<?= $Page->menu_category->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_menu_specials_menu_category"><?= $Page->menu_category->caption() ?></span></td>
        <td data-name="menu_category"<?= $Page->menu_category->cellAttributes() ?>>
<span id="el_menu_specials_menu_category">
<span<?= $Page->menu_category->viewAttributes() ?>>
<?= $Page->menu_category->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->menu_special_comments->Visible) { // menu_special_comments ?>
    <tr id="r_menu_special_comments"<?= $Page->menu_special_comments->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_menu_specials_menu_special_comments"><?= $Page->menu_special_comments->caption() ?></span></td>
        <td data-name="menu_special_comments"<?= $Page->menu_special_comments->cellAttributes() ?>>
<span id="el_menu_specials_menu_special_comments">
<span<?= $Page->menu_special_comments->viewAttributes() ?>>
<?= $Page->menu_special_comments->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->menu_special_startdate->Visible) { // menu_special_startdate ?>
    <tr id="r_menu_special_startdate"<?= $Page->menu_special_startdate->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_menu_specials_menu_special_startdate"><?= $Page->menu_special_startdate->caption() ?></span></td>
        <td data-name="menu_special_startdate"<?= $Page->menu_special_startdate->cellAttributes() ?>>
<span id="el_menu_specials_menu_special_startdate">
<span<?= $Page->menu_special_startdate->viewAttributes() ?>>
<?= $Page->menu_special_startdate->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->menu_special_enddate->Visible) { // menu_special_enddate ?>
    <tr id="r_menu_special_enddate"<?= $Page->menu_special_enddate->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_menu_specials_menu_special_enddate"><?= $Page->menu_special_enddate->caption() ?></span></td>
        <td data-name="menu_special_enddate"<?= $Page->menu_special_enddate->cellAttributes() ?>>
<span id="el_menu_specials_menu_special_enddate">
<span<?= $Page->menu_special_enddate->viewAttributes() ?>>
<?= $Page->menu_special_enddate->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->menu_special_replace_item->Visible) { // menu_special_replace_item ?>
    <tr id="r_menu_special_replace_item"<?= $Page->menu_special_replace_item->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_menu_specials_menu_special_replace_item"><?= $Page->menu_special_replace_item->caption() ?></span></td>
        <td data-name="menu_special_replace_item"<?= $Page->menu_special_replace_item->cellAttributes() ?>>
<span id="el_menu_specials_menu_special_replace_item">
<span<?= $Page->menu_special_replace_item->viewAttributes() ?>>
<?= $Page->menu_special_replace_item->getViewValue() ?></span>
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
