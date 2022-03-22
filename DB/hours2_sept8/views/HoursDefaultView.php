<?php

namespace PHPMaker2022\project3;

// Page object
$HoursDefaultView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { hours_default: currentTable } });
var currentForm, currentPageID;
var fhours_defaultview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fhours_defaultview = new ew.Form("fhours_defaultview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fhours_defaultview;
    loadjs.done("fhours_defaultview");
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
<form name="fhours_defaultview" id="fhours_defaultview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="hours_default">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->hour_id->Visible) { // hour_id ?>
    <tr id="r_hour_id"<?= $Page->hour_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_default_hour_id"><?= $Page->hour_id->caption() ?></span></td>
        <td data-name="hour_id"<?= $Page->hour_id->cellAttributes() ?>>
<span id="el_hours_default_hour_id">
<span<?= $Page->hour_id->viewAttributes() ?>>
<?= $Page->hour_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->mon_open->Visible) { // mon_open ?>
    <tr id="r_mon_open"<?= $Page->mon_open->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_default_mon_open"><?= $Page->mon_open->caption() ?></span></td>
        <td data-name="mon_open"<?= $Page->mon_open->cellAttributes() ?>>
<span id="el_hours_default_mon_open">
<span<?= $Page->mon_open->viewAttributes() ?>>
<?= $Page->mon_open->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->mon_close->Visible) { // mon_close ?>
    <tr id="r_mon_close"<?= $Page->mon_close->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_default_mon_close"><?= $Page->mon_close->caption() ?></span></td>
        <td data-name="mon_close"<?= $Page->mon_close->cellAttributes() ?>>
<span id="el_hours_default_mon_close">
<span<?= $Page->mon_close->viewAttributes() ?>>
<?= $Page->mon_close->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tue_open->Visible) { // tue_open ?>
    <tr id="r_tue_open"<?= $Page->tue_open->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_default_tue_open"><?= $Page->tue_open->caption() ?></span></td>
        <td data-name="tue_open"<?= $Page->tue_open->cellAttributes() ?>>
<span id="el_hours_default_tue_open">
<span<?= $Page->tue_open->viewAttributes() ?>>
<?= $Page->tue_open->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tue_close->Visible) { // tue_close ?>
    <tr id="r_tue_close"<?= $Page->tue_close->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_default_tue_close"><?= $Page->tue_close->caption() ?></span></td>
        <td data-name="tue_close"<?= $Page->tue_close->cellAttributes() ?>>
<span id="el_hours_default_tue_close">
<span<?= $Page->tue_close->viewAttributes() ?>>
<?= $Page->tue_close->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->wed_open->Visible) { // wed_open ?>
    <tr id="r_wed_open"<?= $Page->wed_open->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_default_wed_open"><?= $Page->wed_open->caption() ?></span></td>
        <td data-name="wed_open"<?= $Page->wed_open->cellAttributes() ?>>
<span id="el_hours_default_wed_open">
<span<?= $Page->wed_open->viewAttributes() ?>>
<?= $Page->wed_open->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->wed_close->Visible) { // wed_close ?>
    <tr id="r_wed_close"<?= $Page->wed_close->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_default_wed_close"><?= $Page->wed_close->caption() ?></span></td>
        <td data-name="wed_close"<?= $Page->wed_close->cellAttributes() ?>>
<span id="el_hours_default_wed_close">
<span<?= $Page->wed_close->viewAttributes() ?>>
<?= $Page->wed_close->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->thu_open->Visible) { // thu_open ?>
    <tr id="r_thu_open"<?= $Page->thu_open->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_default_thu_open"><?= $Page->thu_open->caption() ?></span></td>
        <td data-name="thu_open"<?= $Page->thu_open->cellAttributes() ?>>
<span id="el_hours_default_thu_open">
<span<?= $Page->thu_open->viewAttributes() ?>>
<?= $Page->thu_open->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->thu_close->Visible) { // thu_close ?>
    <tr id="r_thu_close"<?= $Page->thu_close->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_default_thu_close"><?= $Page->thu_close->caption() ?></span></td>
        <td data-name="thu_close"<?= $Page->thu_close->cellAttributes() ?>>
<span id="el_hours_default_thu_close">
<span<?= $Page->thu_close->viewAttributes() ?>>
<?= $Page->thu_close->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->fri_open->Visible) { // fri_open ?>
    <tr id="r_fri_open"<?= $Page->fri_open->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_default_fri_open"><?= $Page->fri_open->caption() ?></span></td>
        <td data-name="fri_open"<?= $Page->fri_open->cellAttributes() ?>>
<span id="el_hours_default_fri_open">
<span<?= $Page->fri_open->viewAttributes() ?>>
<?= $Page->fri_open->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->fri_close->Visible) { // fri_close ?>
    <tr id="r_fri_close"<?= $Page->fri_close->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_default_fri_close"><?= $Page->fri_close->caption() ?></span></td>
        <td data-name="fri_close"<?= $Page->fri_close->cellAttributes() ?>>
<span id="el_hours_default_fri_close">
<span<?= $Page->fri_close->viewAttributes() ?>>
<?= $Page->fri_close->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sat_open->Visible) { // sat_open ?>
    <tr id="r_sat_open"<?= $Page->sat_open->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_default_sat_open"><?= $Page->sat_open->caption() ?></span></td>
        <td data-name="sat_open"<?= $Page->sat_open->cellAttributes() ?>>
<span id="el_hours_default_sat_open">
<span<?= $Page->sat_open->viewAttributes() ?>>
<?= $Page->sat_open->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sat_close->Visible) { // sat_close ?>
    <tr id="r_sat_close"<?= $Page->sat_close->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_default_sat_close"><?= $Page->sat_close->caption() ?></span></td>
        <td data-name="sat_close"<?= $Page->sat_close->cellAttributes() ?>>
<span id="el_hours_default_sat_close">
<span<?= $Page->sat_close->viewAttributes() ?>>
<?= $Page->sat_close->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sun_open->Visible) { // sun_open ?>
    <tr id="r_sun_open"<?= $Page->sun_open->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_default_sun_open"><?= $Page->sun_open->caption() ?></span></td>
        <td data-name="sun_open"<?= $Page->sun_open->cellAttributes() ?>>
<span id="el_hours_default_sun_open">
<span<?= $Page->sun_open->viewAttributes() ?>>
<?= $Page->sun_open->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sun_close->Visible) { // sun_close ?>
    <tr id="r_sun_close"<?= $Page->sun_close->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_default_sun_close"><?= $Page->sun_close->caption() ?></span></td>
        <td data-name="sun_close"<?= $Page->sun_close->cellAttributes() ?>>
<span id="el_hours_default_sun_close">
<span<?= $Page->sun_close->viewAttributes() ?>>
<?= $Page->sun_close->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->close->Visible) { // close ?>
    <tr id="r_close"<?= $Page->close->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_default_close"><?= $Page->close->caption() ?></span></td>
        <td data-name="close"<?= $Page->close->cellAttributes() ?>>
<span id="el_hours_default_close">
<span<?= $Page->close->viewAttributes() ?>>
<?= $Page->close->getViewValue() ?></span>
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
