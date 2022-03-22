<?php

namespace PHPMaker2021\project1;

// Page object
$RestaurantsSlidesView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var frestaurants_slidesview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    frestaurants_slidesview = currentForm = new ew.Form("frestaurants_slidesview", "view");
    loadjs.done("frestaurants_slidesview");
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
<form name="frestaurants_slidesview" id="frestaurants_slidesview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="restaurants_slides">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_restaurants_slides_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_restaurants_slides_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->restaurant_id->Visible) { // restaurant_id ?>
    <tr id="r_restaurant_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_restaurants_slides_restaurant_id"><?= $Page->restaurant_id->caption() ?></span></td>
        <td data-name="restaurant_id" <?= $Page->restaurant_id->cellAttributes() ?>>
<span id="el_restaurants_slides_restaurant_id">
<span<?= $Page->restaurant_id->viewAttributes() ?>>
<?= $Page->restaurant_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->filename->Visible) { // filename ?>
    <tr id="r_filename">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_restaurants_slides_filename"><?= $Page->filename->caption() ?></span></td>
        <td data-name="filename" <?= $Page->filename->cellAttributes() ?>>
<span id="el_restaurants_slides_filename">
<span<?= $Page->filename->viewAttributes() ?>>
<?= $Page->filename->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
    <tr id="r_timestamp">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_restaurants_slides_timestamp"><?= $Page->timestamp->caption() ?></span></td>
        <td data-name="timestamp" <?= $Page->timestamp->cellAttributes() ?>>
<span id="el_restaurants_slides_timestamp">
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
