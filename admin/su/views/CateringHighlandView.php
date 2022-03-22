<?php

namespace PHPMaker2021\project1;

// Page object
$CateringHighlandView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fcatering_highlandview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fcatering_highlandview = currentForm = new ew.Form("fcatering_highlandview", "view");
    loadjs.done("fcatering_highlandview");
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
<form name="fcatering_highlandview" id="fcatering_highlandview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="catering_highland">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_highland_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_catering_highland_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->catering_id->Visible) { // catering_id ?>
    <tr id="r_catering_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_highland_catering_id"><?= $Page->catering_id->caption() ?></span></td>
        <td data-name="catering_id" <?= $Page->catering_id->cellAttributes() ?>>
<span id="el_catering_highland_catering_id">
<span<?= $Page->catering_id->viewAttributes() ?>>
<?= $Page->catering_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->burrito_12->Visible) { // burrito_12 ?>
    <tr id="r_burrito_12">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_highland_burrito_12"><?= $Page->burrito_12->caption() ?></span></td>
        <td data-name="burrito_12" <?= $Page->burrito_12->cellAttributes() ?>>
<span id="el_catering_highland_burrito_12">
<span<?= $Page->burrito_12->viewAttributes() ?>>
<?= $Page->burrito_12->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->burrito_8->Visible) { // burrito_8 ?>
    <tr id="r_burrito_8">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_highland_burrito_8"><?= $Page->burrito_8->caption() ?></span></td>
        <td data-name="burrito_8" <?= $Page->burrito_8->cellAttributes() ?>>
<span id="el_catering_highland_burrito_8">
<span<?= $Page->burrito_8->viewAttributes() ?>>
<?= $Page->burrito_8->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->extra_chips->Visible) { // extra_chips ?>
    <tr id="r_extra_chips">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_highland_extra_chips"><?= $Page->extra_chips->caption() ?></span></td>
        <td data-name="extra_chips" <?= $Page->extra_chips->cellAttributes() ?>>
<span id="el_catering_highland_extra_chips">
<span<?= $Page->extra_chips->viewAttributes() ?>>
<?= $Page->extra_chips->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->extra_salsa->Visible) { // extra_salsa ?>
    <tr id="r_extra_salsa">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_highland_extra_salsa"><?= $Page->extra_salsa->caption() ?></span></td>
        <td data-name="extra_salsa" <?= $Page->extra_salsa->cellAttributes() ?>>
<span id="el_catering_highland_extra_salsa">
<span<?= $Page->extra_salsa->viewAttributes() ?>>
<?= $Page->extra_salsa->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->extra_sourcream->Visible) { // extra_sourcream ?>
    <tr id="r_extra_sourcream">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_highland_extra_sourcream"><?= $Page->extra_sourcream->caption() ?></span></td>
        <td data-name="extra_sourcream" <?= $Page->extra_sourcream->cellAttributes() ?>>
<span id="el_catering_highland_extra_sourcream">
<span<?= $Page->extra_sourcream->viewAttributes() ?>>
<?= $Page->extra_sourcream->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->extra_guacamole->Visible) { // extra_guacamole ?>
    <tr id="r_extra_guacamole">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_highland_extra_guacamole"><?= $Page->extra_guacamole->caption() ?></span></td>
        <td data-name="extra_guacamole" <?= $Page->extra_guacamole->cellAttributes() ?>>
<span id="el_catering_highland_extra_guacamole">
<span<?= $Page->extra_guacamole->viewAttributes() ?>>
<?= $Page->extra_guacamole->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->upgrade->Visible) { // upgrade ?>
    <tr id="r_upgrade">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_highland_upgrade"><?= $Page->upgrade->caption() ?></span></td>
        <td data-name="upgrade" <?= $Page->upgrade->cellAttributes() ?>>
<span id="el_catering_highland_upgrade">
<span<?= $Page->upgrade->viewAttributes() ?>>
<?= $Page->upgrade->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->coke->Visible) { // coke ?>
    <tr id="r_coke">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_highland_coke"><?= $Page->coke->caption() ?></span></td>
        <td data-name="coke" <?= $Page->coke->cellAttributes() ?>>
<span id="el_catering_highland_coke">
<span<?= $Page->coke->viewAttributes() ?>>
<?= $Page->coke->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->diet_coke->Visible) { // diet_coke ?>
    <tr id="r_diet_coke">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_highland_diet_coke"><?= $Page->diet_coke->caption() ?></span></td>
        <td data-name="diet_coke" <?= $Page->diet_coke->cellAttributes() ?>>
<span id="el_catering_highland_diet_coke">
<span<?= $Page->diet_coke->viewAttributes() ?>>
<?= $Page->diet_coke->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sprite->Visible) { // sprite ?>
    <tr id="r_sprite">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_highland_sprite"><?= $Page->sprite->caption() ?></span></td>
        <td data-name="sprite" <?= $Page->sprite->cellAttributes() ?>>
<span id="el_catering_highland_sprite">
<span<?= $Page->sprite->viewAttributes() ?>>
<?= $Page->sprite->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->fanta->Visible) { // fanta ?>
    <tr id="r_fanta">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_highland_fanta"><?= $Page->fanta->caption() ?></span></td>
        <td data-name="fanta" <?= $Page->fanta->cellAttributes() ?>>
<span id="el_catering_highland_fanta">
<span<?= $Page->fanta->viewAttributes() ?>>
<?= $Page->fanta->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->water->Visible) { // water ?>
    <tr id="r_water">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_highland_water"><?= $Page->water->caption() ?></span></td>
        <td data-name="water" <?= $Page->water->cellAttributes() ?>>
<span id="el_catering_highland_water">
<span<?= $Page->water->viewAttributes() ?>>
<?= $Page->water->getViewValue() ?></span>
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
