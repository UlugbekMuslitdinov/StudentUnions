<?php

namespace PHPMaker2021\project1;

// Page object
$CateringHighlandBurritoView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fcatering_highland_burritoview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fcatering_highland_burritoview = currentForm = new ew.Form("fcatering_highland_burritoview", "view");
    loadjs.done("fcatering_highland_burritoview");
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
<form name="fcatering_highland_burritoview" id="fcatering_highland_burritoview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="catering_highland_burrito">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_highland_burrito_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_catering_highland_burrito_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->catering_id->Visible) { // catering_id ?>
    <tr id="r_catering_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_highland_burrito_catering_id"><?= $Page->catering_id->caption() ?></span></td>
        <td data-name="catering_id" <?= $Page->catering_id->cellAttributes() ?>>
<span id="el_catering_highland_burrito_catering_id">
<span<?= $Page->catering_id->viewAttributes() ?>>
<?= $Page->catering_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pack->Visible) { // pack ?>
    <tr id="r_pack">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_highland_burrito_pack"><?= $Page->pack->caption() ?></span></td>
        <td data-name="pack" <?= $Page->pack->cellAttributes() ?>>
<span id="el_catering_highland_burrito_pack">
<span<?= $Page->pack->viewAttributes() ?>>
<?= $Page->pack->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pack_num->Visible) { // pack_num ?>
    <tr id="r_pack_num">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_highland_burrito_pack_num"><?= $Page->pack_num->caption() ?></span></td>
        <td data-name="pack_num" <?= $Page->pack_num->cellAttributes() ?>>
<span id="el_catering_highland_burrito_pack_num">
<span<?= $Page->pack_num->viewAttributes() ?>>
<?= $Page->pack_num->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->burrito_num->Visible) { // burrito_num ?>
    <tr id="r_burrito_num">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_highland_burrito_burrito_num"><?= $Page->burrito_num->caption() ?></span></td>
        <td data-name="burrito_num" <?= $Page->burrito_num->cellAttributes() ?>>
<span id="el_catering_highland_burrito_burrito_num">
<span<?= $Page->burrito_num->viewAttributes() ?>>
<?= $Page->burrito_num->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->meat_1->Visible) { // meat_1 ?>
    <tr id="r_meat_1">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_highland_burrito_meat_1"><?= $Page->meat_1->caption() ?></span></td>
        <td data-name="meat_1" <?= $Page->meat_1->cellAttributes() ?>>
<span id="el_catering_highland_burrito_meat_1">
<span<?= $Page->meat_1->viewAttributes() ?>>
<?= $Page->meat_1->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->meat_2->Visible) { // meat_2 ?>
    <tr id="r_meat_2">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_highland_burrito_meat_2"><?= $Page->meat_2->caption() ?></span></td>
        <td data-name="meat_2" <?= $Page->meat_2->cellAttributes() ?>>
<span id="el_catering_highland_burrito_meat_2">
<span<?= $Page->meat_2->viewAttributes() ?>>
<?= $Page->meat_2->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->meat_3->Visible) { // meat_3 ?>
    <tr id="r_meat_3">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_highland_burrito_meat_3"><?= $Page->meat_3->caption() ?></span></td>
        <td data-name="meat_3" <?= $Page->meat_3->cellAttributes() ?>>
<span id="el_catering_highland_burrito_meat_3">
<span<?= $Page->meat_3->viewAttributes() ?>>
<?= $Page->meat_3->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->meat_4->Visible) { // meat_4 ?>
    <tr id="r_meat_4">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_highland_burrito_meat_4"><?= $Page->meat_4->caption() ?></span></td>
        <td data-name="meat_4" <?= $Page->meat_4->cellAttributes() ?>>
<span id="el_catering_highland_burrito_meat_4">
<span<?= $Page->meat_4->viewAttributes() ?>>
<?= $Page->meat_4->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->vege_1->Visible) { // vege_1 ?>
    <tr id="r_vege_1">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_highland_burrito_vege_1"><?= $Page->vege_1->caption() ?></span></td>
        <td data-name="vege_1" <?= $Page->vege_1->cellAttributes() ?>>
<span id="el_catering_highland_burrito_vege_1">
<span<?= $Page->vege_1->viewAttributes() ?>>
<?= $Page->vege_1->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->vege_2->Visible) { // vege_2 ?>
    <tr id="r_vege_2">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_highland_burrito_vege_2"><?= $Page->vege_2->caption() ?></span></td>
        <td data-name="vege_2" <?= $Page->vege_2->cellAttributes() ?>>
<span id="el_catering_highland_burrito_vege_2">
<span<?= $Page->vege_2->viewAttributes() ?>>
<?= $Page->vege_2->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->vege_3->Visible) { // vege_3 ?>
    <tr id="r_vege_3">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_highland_burrito_vege_3"><?= $Page->vege_3->caption() ?></span></td>
        <td data-name="vege_3" <?= $Page->vege_3->cellAttributes() ?>>
<span id="el_catering_highland_burrito_vege_3">
<span<?= $Page->vege_3->viewAttributes() ?>>
<?= $Page->vege_3->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->vege_4->Visible) { // vege_4 ?>
    <tr id="r_vege_4">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_highland_burrito_vege_4"><?= $Page->vege_4->caption() ?></span></td>
        <td data-name="vege_4" <?= $Page->vege_4->cellAttributes() ?>>
<span id="el_catering_highland_burrito_vege_4">
<span<?= $Page->vege_4->viewAttributes() ?>>
<?= $Page->vege_4->getViewValue() ?></span>
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
