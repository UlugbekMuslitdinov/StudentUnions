<?php

namespace PHPMaker2022\project1;

// Page object
$MenuSpecialsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { menu_specials: currentTable } });
var currentForm, currentPageID;
var fmenu_specialsdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmenu_specialsdelete = new ew.Form("fmenu_specialsdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fmenu_specialsdelete;
    loadjs.done("fmenu_specialsdelete");
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
<form name="fmenu_specialsdelete" id="fmenu_specialsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="menu_specials">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table table-bordered table-hover table-sm ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->id->Visible) { // id ?>
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_menu_specials_id" class="menu_specials_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->menu_special_price->Visible) { // menu_special_price ?>
        <th class="<?= $Page->menu_special_price->headerCellClass() ?>"><span id="elh_menu_specials_menu_special_price" class="menu_specials_menu_special_price"><?= $Page->menu_special_price->caption() ?></span></th>
<?php } ?>
<?php if ($Page->menu_restaurant->Visible) { // menu_restaurant ?>
        <th class="<?= $Page->menu_restaurant->headerCellClass() ?>"><span id="elh_menu_specials_menu_restaurant" class="menu_specials_menu_restaurant"><?= $Page->menu_restaurant->caption() ?></span></th>
<?php } ?>
<?php if ($Page->menu_category->Visible) { // menu_category ?>
        <th class="<?= $Page->menu_category->headerCellClass() ?>"><span id="elh_menu_specials_menu_category" class="menu_specials_menu_category"><?= $Page->menu_category->caption() ?></span></th>
<?php } ?>
<?php if ($Page->menu_special_startdate->Visible) { // menu_special_startdate ?>
        <th class="<?= $Page->menu_special_startdate->headerCellClass() ?>"><span id="elh_menu_specials_menu_special_startdate" class="menu_specials_menu_special_startdate"><?= $Page->menu_special_startdate->caption() ?></span></th>
<?php } ?>
<?php if ($Page->menu_special_enddate->Visible) { // menu_special_enddate ?>
        <th class="<?= $Page->menu_special_enddate->headerCellClass() ?>"><span id="elh_menu_specials_menu_special_enddate" class="menu_specials_menu_special_enddate"><?= $Page->menu_special_enddate->caption() ?></span></th>
<?php } ?>
<?php if ($Page->menu_special_replace_item->Visible) { // menu_special_replace_item ?>
        <th class="<?= $Page->menu_special_replace_item->headerCellClass() ?>"><span id="elh_menu_specials_menu_special_replace_item" class="menu_specials_menu_special_replace_item"><?= $Page->menu_special_replace_item->caption() ?></span></th>
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
        <td<?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_menu_specials_id" class="el_menu_specials_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->menu_special_price->Visible) { // menu_special_price ?>
        <td<?= $Page->menu_special_price->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_menu_specials_menu_special_price" class="el_menu_specials_menu_special_price">
<span<?= $Page->menu_special_price->viewAttributes() ?>>
<?= $Page->menu_special_price->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->menu_restaurant->Visible) { // menu_restaurant ?>
        <td<?= $Page->menu_restaurant->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_menu_specials_menu_restaurant" class="el_menu_specials_menu_restaurant">
<span<?= $Page->menu_restaurant->viewAttributes() ?>>
<?= $Page->menu_restaurant->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->menu_category->Visible) { // menu_category ?>
        <td<?= $Page->menu_category->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_menu_specials_menu_category" class="el_menu_specials_menu_category">
<span<?= $Page->menu_category->viewAttributes() ?>>
<?= $Page->menu_category->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->menu_special_startdate->Visible) { // menu_special_startdate ?>
        <td<?= $Page->menu_special_startdate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_menu_specials_menu_special_startdate" class="el_menu_specials_menu_special_startdate">
<span<?= $Page->menu_special_startdate->viewAttributes() ?>>
<?= $Page->menu_special_startdate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->menu_special_enddate->Visible) { // menu_special_enddate ?>
        <td<?= $Page->menu_special_enddate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_menu_specials_menu_special_enddate" class="el_menu_specials_menu_special_enddate">
<span<?= $Page->menu_special_enddate->viewAttributes() ?>>
<?= $Page->menu_special_enddate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->menu_special_replace_item->Visible) { // menu_special_replace_item ?>
        <td<?= $Page->menu_special_replace_item->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_menu_specials_menu_special_replace_item" class="el_menu_specials_menu_special_replace_item">
<span<?= $Page->menu_special_replace_item->viewAttributes() ?>>
<?= $Page->menu_special_replace_item->getViewValue() ?></span>
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
