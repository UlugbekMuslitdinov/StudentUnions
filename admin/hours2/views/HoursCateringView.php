<?php

namespace PHPMaker2021\project2;

// Page object
$HoursCateringView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fhours_cateringview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fhours_cateringview = currentForm = new ew.Form("fhours_cateringview", "view");
    loadjs.done("fhours_cateringview");
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
<form name="fhours_cateringview" id="fhours_cateringview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="hours_catering">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_catering_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_hours_catering_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->location_id->Visible) { // location_id ?>
    <tr id="r_location_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_catering_location_id"><?= $Page->location_id->caption() ?></span></td>
        <td data-name="location_id" <?= $Page->location_id->cellAttributes() ?>>
<span id="el_hours_catering_location_id">
<span<?= $Page->location_id->viewAttributes() ?>>
<?= $Page->location_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->day_from->Visible) { // day_from ?>
    <tr id="r_day_from">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_catering_day_from"><?= $Page->day_from->caption() ?></span></td>
        <td data-name="day_from" <?= $Page->day_from->cellAttributes() ?>>
<span id="el_hours_catering_day_from">
<span<?= $Page->day_from->viewAttributes() ?>>
<?= $Page->day_from->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->day_to->Visible) { // day_to ?>
    <tr id="r_day_to">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_catering_day_to"><?= $Page->day_to->caption() ?></span></td>
        <td data-name="day_to" <?= $Page->day_to->cellAttributes() ?>>
<span id="el_hours_catering_day_to">
<span<?= $Page->day_to->viewAttributes() ?>>
<?= $Page->day_to->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->time_from->Visible) { // time_from ?>
    <tr id="r_time_from">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_catering_time_from"><?= $Page->time_from->caption() ?></span></td>
        <td data-name="time_from" <?= $Page->time_from->cellAttributes() ?>>
<span id="el_hours_catering_time_from">
<span<?= $Page->time_from->viewAttributes() ?>>
<?= $Page->time_from->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->time_to->Visible) { // time_to ?>
    <tr id="r_time_to">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_catering_time_to"><?= $Page->time_to->caption() ?></span></td>
        <td data-name="time_to" <?= $Page->time_to->cellAttributes() ?>>
<span id="el_hours_catering_time_to">
<span<?= $Page->time_to->viewAttributes() ?>>
<?= $Page->time_to->getViewValue() ?></span>
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
