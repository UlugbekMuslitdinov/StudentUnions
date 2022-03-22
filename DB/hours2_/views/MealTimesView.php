<?php

namespace PHPMaker2022\project1;

// Page object
$MealTimesView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { meal_times: currentTable } });
var currentForm, currentPageID;
var fmeal_timesview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmeal_timesview = new ew.Form("fmeal_timesview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fmeal_timesview;
    loadjs.done("fmeal_timesview");
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
<form name="fmeal_timesview" id="fmeal_timesview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="meal_times">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_meal_times_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_meal_times_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->location_id->Visible) { // location_id ?>
    <tr id="r_location_id"<?= $Page->location_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_meal_times_location_id"><?= $Page->location_id->caption() ?></span></td>
        <td data-name="location_id"<?= $Page->location_id->cellAttributes() ?>>
<span id="el_meal_times_location_id">
<span<?= $Page->location_id->viewAttributes() ?>>
<?= $Page->location_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->meal_details_id->Visible) { // meal_details_id ?>
    <tr id="r_meal_details_id"<?= $Page->meal_details_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_meal_times_meal_details_id"><?= $Page->meal_details_id->caption() ?></span></td>
        <td data-name="meal_details_id"<?= $Page->meal_details_id->cellAttributes() ?>>
<span id="el_meal_times_meal_details_id">
<span<?= $Page->meal_details_id->viewAttributes() ?>>
<?= $Page->meal_details_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->startm->Visible) { // startm ?>
    <tr id="r_startm"<?= $Page->startm->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_meal_times_startm"><?= $Page->startm->caption() ?></span></td>
        <td data-name="startm"<?= $Page->startm->cellAttributes() ?>>
<span id="el_meal_times_startm">
<span<?= $Page->startm->viewAttributes() ?>>
<?= $Page->startm->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->endm->Visible) { // endm ?>
    <tr id="r_endm"<?= $Page->endm->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_meal_times_endm"><?= $Page->endm->caption() ?></span></td>
        <td data-name="endm"<?= $Page->endm->cellAttributes() ?>>
<span id="el_meal_times_endm">
<span<?= $Page->endm->viewAttributes() ?>>
<?= $Page->endm->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->startt->Visible) { // startt ?>
    <tr id="r_startt"<?= $Page->startt->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_meal_times_startt"><?= $Page->startt->caption() ?></span></td>
        <td data-name="startt"<?= $Page->startt->cellAttributes() ?>>
<span id="el_meal_times_startt">
<span<?= $Page->startt->viewAttributes() ?>>
<?= $Page->startt->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->endt->Visible) { // endt ?>
    <tr id="r_endt"<?= $Page->endt->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_meal_times_endt"><?= $Page->endt->caption() ?></span></td>
        <td data-name="endt"<?= $Page->endt->cellAttributes() ?>>
<span id="el_meal_times_endt">
<span<?= $Page->endt->viewAttributes() ?>>
<?= $Page->endt->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->startw->Visible) { // startw ?>
    <tr id="r_startw"<?= $Page->startw->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_meal_times_startw"><?= $Page->startw->caption() ?></span></td>
        <td data-name="startw"<?= $Page->startw->cellAttributes() ?>>
<span id="el_meal_times_startw">
<span<?= $Page->startw->viewAttributes() ?>>
<?= $Page->startw->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->endw->Visible) { // endw ?>
    <tr id="r_endw"<?= $Page->endw->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_meal_times_endw"><?= $Page->endw->caption() ?></span></td>
        <td data-name="endw"<?= $Page->endw->cellAttributes() ?>>
<span id="el_meal_times_endw">
<span<?= $Page->endw->viewAttributes() ?>>
<?= $Page->endw->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->startr->Visible) { // startr ?>
    <tr id="r_startr"<?= $Page->startr->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_meal_times_startr"><?= $Page->startr->caption() ?></span></td>
        <td data-name="startr"<?= $Page->startr->cellAttributes() ?>>
<span id="el_meal_times_startr">
<span<?= $Page->startr->viewAttributes() ?>>
<?= $Page->startr->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->endr->Visible) { // endr ?>
    <tr id="r_endr"<?= $Page->endr->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_meal_times_endr"><?= $Page->endr->caption() ?></span></td>
        <td data-name="endr"<?= $Page->endr->cellAttributes() ?>>
<span id="el_meal_times_endr">
<span<?= $Page->endr->viewAttributes() ?>>
<?= $Page->endr->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->startf->Visible) { // startf ?>
    <tr id="r_startf"<?= $Page->startf->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_meal_times_startf"><?= $Page->startf->caption() ?></span></td>
        <td data-name="startf"<?= $Page->startf->cellAttributes() ?>>
<span id="el_meal_times_startf">
<span<?= $Page->startf->viewAttributes() ?>>
<?= $Page->startf->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->endf->Visible) { // endf ?>
    <tr id="r_endf"<?= $Page->endf->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_meal_times_endf"><?= $Page->endf->caption() ?></span></td>
        <td data-name="endf"<?= $Page->endf->cellAttributes() ?>>
<span id="el_meal_times_endf">
<span<?= $Page->endf->viewAttributes() ?>>
<?= $Page->endf->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->starts->Visible) { // starts ?>
    <tr id="r_starts"<?= $Page->starts->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_meal_times_starts"><?= $Page->starts->caption() ?></span></td>
        <td data-name="starts"<?= $Page->starts->cellAttributes() ?>>
<span id="el_meal_times_starts">
<span<?= $Page->starts->viewAttributes() ?>>
<?= $Page->starts->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ends->Visible) { // ends ?>
    <tr id="r_ends"<?= $Page->ends->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_meal_times_ends"><?= $Page->ends->caption() ?></span></td>
        <td data-name="ends"<?= $Page->ends->cellAttributes() ?>>
<span id="el_meal_times_ends">
<span<?= $Page->ends->viewAttributes() ?>>
<?= $Page->ends->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->startu->Visible) { // startu ?>
    <tr id="r_startu"<?= $Page->startu->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_meal_times_startu"><?= $Page->startu->caption() ?></span></td>
        <td data-name="startu"<?= $Page->startu->cellAttributes() ?>>
<span id="el_meal_times_startu">
<span<?= $Page->startu->viewAttributes() ?>>
<?= $Page->startu->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->endu->Visible) { // endu ?>
    <tr id="r_endu"<?= $Page->endu->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_meal_times_endu"><?= $Page->endu->caption() ?></span></td>
        <td data-name="endu"<?= $Page->endu->cellAttributes() ?>>
<span id="el_meal_times_endu">
<span<?= $Page->endu->viewAttributes() ?>>
<?= $Page->endu->getViewValue() ?></span>
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
