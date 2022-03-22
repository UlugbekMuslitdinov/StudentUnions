<?php

namespace PHPMaker2021\project1;

// Page object
$RestaurantsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var frestaurantsview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    frestaurantsview = currentForm = new ew.Form("frestaurantsview", "view");
    loadjs.done("frestaurantsview");
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
<form name="frestaurantsview" id="frestaurantsview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="restaurants">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_restaurants_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_restaurants_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->location_id->Visible) { // location_id ?>
    <tr id="r_location_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_restaurants_location_id"><?= $Page->location_id->caption() ?></span></td>
        <td data-name="location_id" <?= $Page->location_id->cellAttributes() ?>>
<span id="el_restaurants_location_id">
<span<?= $Page->location_id->viewAttributes() ?>>
<?= $Page->location_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->banner->Visible) { // banner ?>
    <tr id="r_banner">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_restaurants_banner"><?= $Page->banner->caption() ?></span></td>
        <td data-name="banner" <?= $Page->banner->cellAttributes() ?>>
<span id="el_restaurants_banner">
<span<?= $Page->banner->viewAttributes() ?>>
<?= $Page->banner->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->button_menu->Visible) { // button_menu ?>
    <tr id="r_button_menu">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_restaurants_button_menu"><?= $Page->button_menu->caption() ?></span></td>
        <td data-name="button_menu" <?= $Page->button_menu->cellAttributes() ?>>
<span id="el_restaurants_button_menu">
<span<?= $Page->button_menu->viewAttributes() ?>>
<?= $Page->button_menu->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->button_pdf->Visible) { // button_pdf ?>
    <tr id="r_button_pdf">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_restaurants_button_pdf"><?= $Page->button_pdf->caption() ?></span></td>
        <td data-name="button_pdf" <?= $Page->button_pdf->cellAttributes() ?>>
<span id="el_restaurants_button_pdf">
<span<?= $Page->button_pdf->viewAttributes() ?>>
<?= $Page->button_pdf->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->button_catering->Visible) { // button_catering ?>
    <tr id="r_button_catering">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_restaurants_button_catering"><?= $Page->button_catering->caption() ?></span></td>
        <td data-name="button_catering" <?= $Page->button_catering->cellAttributes() ?>>
<span id="el_restaurants_button_catering">
<span<?= $Page->button_catering->viewAttributes() ?>>
<?= $Page->button_catering->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->button_form->Visible) { // button_form ?>
    <tr id="r_button_form">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_restaurants_button_form"><?= $Page->button_form->caption() ?></span></td>
        <td data-name="button_form" <?= $Page->button_form->cellAttributes() ?>>
<span id="el_restaurants_button_form">
<span<?= $Page->button_form->viewAttributes() ?>>
<?= $Page->button_form->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->slides->Visible) { // slides ?>
    <tr id="r_slides">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_restaurants_slides"><?= $Page->slides->caption() ?></span></td>
        <td data-name="slides" <?= $Page->slides->cellAttributes() ?>>
<span id="el_restaurants_slides">
<span<?= $Page->slides->viewAttributes() ?>>
<?= $Page->slides->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
    <tr id="r_timestamp">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_restaurants_timestamp"><?= $Page->timestamp->caption() ?></span></td>
        <td data-name="timestamp" <?= $Page->timestamp->cellAttributes() ?>>
<span id="el_restaurants_timestamp">
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
