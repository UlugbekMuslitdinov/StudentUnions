<?php

namespace PHPMaker2022\project3;

// Page object
$HoursView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { hours: currentTable } });
var currentForm, currentPageID;
var fhoursview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fhoursview = new ew.Form("fhoursview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fhoursview;
    loadjs.done("fhoursview");
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
<form name="fhoursview" id="fhoursview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="hours">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->location_id->Visible) { // location_id ?>
    <tr id="r_location_id"<?= $Page->location_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_location_id"><?= $Page->location_id->caption() ?></span></td>
        <td data-name="location_id"<?= $Page->location_id->cellAttributes() ?>>
<span id="el_hours_location_id">
<span<?= $Page->location_id->viewAttributes() ?>>
<?= $Page->location_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->openm->Visible) { // openm ?>
    <tr id="r_openm"<?= $Page->openm->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_openm"><?= $Page->openm->caption() ?></span></td>
        <td data-name="openm"<?= $Page->openm->cellAttributes() ?>>
<span id="el_hours_openm">
<span<?= $Page->openm->viewAttributes() ?>>
<?= $Page->openm->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->closem->Visible) { // closem ?>
    <tr id="r_closem"<?= $Page->closem->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_closem"><?= $Page->closem->caption() ?></span></td>
        <td data-name="closem"<?= $Page->closem->cellAttributes() ?>>
<span id="el_hours_closem">
<span<?= $Page->closem->viewAttributes() ?>>
<?= $Page->closem->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->opent->Visible) { // opent ?>
    <tr id="r_opent"<?= $Page->opent->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_opent"><?= $Page->opent->caption() ?></span></td>
        <td data-name="opent"<?= $Page->opent->cellAttributes() ?>>
<span id="el_hours_opent">
<span<?= $Page->opent->viewAttributes() ?>>
<?= $Page->opent->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->closet->Visible) { // closet ?>
    <tr id="r_closet"<?= $Page->closet->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_closet"><?= $Page->closet->caption() ?></span></td>
        <td data-name="closet"<?= $Page->closet->cellAttributes() ?>>
<span id="el_hours_closet">
<span<?= $Page->closet->viewAttributes() ?>>
<?= $Page->closet->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->openw->Visible) { // openw ?>
    <tr id="r_openw"<?= $Page->openw->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_openw"><?= $Page->openw->caption() ?></span></td>
        <td data-name="openw"<?= $Page->openw->cellAttributes() ?>>
<span id="el_hours_openw">
<span<?= $Page->openw->viewAttributes() ?>>
<?= $Page->openw->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->closew->Visible) { // closew ?>
    <tr id="r_closew"<?= $Page->closew->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_closew"><?= $Page->closew->caption() ?></span></td>
        <td data-name="closew"<?= $Page->closew->cellAttributes() ?>>
<span id="el_hours_closew">
<span<?= $Page->closew->viewAttributes() ?>>
<?= $Page->closew->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->openr->Visible) { // openr ?>
    <tr id="r_openr"<?= $Page->openr->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_openr"><?= $Page->openr->caption() ?></span></td>
        <td data-name="openr"<?= $Page->openr->cellAttributes() ?>>
<span id="el_hours_openr">
<span<?= $Page->openr->viewAttributes() ?>>
<?= $Page->openr->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->closer->Visible) { // closer ?>
    <tr id="r_closer"<?= $Page->closer->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_closer"><?= $Page->closer->caption() ?></span></td>
        <td data-name="closer"<?= $Page->closer->cellAttributes() ?>>
<span id="el_hours_closer">
<span<?= $Page->closer->viewAttributes() ?>>
<?= $Page->closer->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->openf->Visible) { // openf ?>
    <tr id="r_openf"<?= $Page->openf->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_openf"><?= $Page->openf->caption() ?></span></td>
        <td data-name="openf"<?= $Page->openf->cellAttributes() ?>>
<span id="el_hours_openf">
<span<?= $Page->openf->viewAttributes() ?>>
<?= $Page->openf->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->closef->Visible) { // closef ?>
    <tr id="r_closef"<?= $Page->closef->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_closef"><?= $Page->closef->caption() ?></span></td>
        <td data-name="closef"<?= $Page->closef->cellAttributes() ?>>
<span id="el_hours_closef">
<span<?= $Page->closef->viewAttributes() ?>>
<?= $Page->closef->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->opens->Visible) { // opens ?>
    <tr id="r_opens"<?= $Page->opens->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_opens"><?= $Page->opens->caption() ?></span></td>
        <td data-name="opens"<?= $Page->opens->cellAttributes() ?>>
<span id="el_hours_opens">
<span<?= $Page->opens->viewAttributes() ?>>
<?= $Page->opens->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->closes->Visible) { // closes ?>
    <tr id="r_closes"<?= $Page->closes->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_closes"><?= $Page->closes->caption() ?></span></td>
        <td data-name="closes"<?= $Page->closes->cellAttributes() ?>>
<span id="el_hours_closes">
<span<?= $Page->closes->viewAttributes() ?>>
<?= $Page->closes->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->openu->Visible) { // openu ?>
    <tr id="r_openu"<?= $Page->openu->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_openu"><?= $Page->openu->caption() ?></span></td>
        <td data-name="openu"<?= $Page->openu->cellAttributes() ?>>
<span id="el_hours_openu">
<span<?= $Page->openu->viewAttributes() ?>>
<?= $Page->openu->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->closeu->Visible) { // closeu ?>
    <tr id="r_closeu"<?= $Page->closeu->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_closeu"><?= $Page->closeu->caption() ?></span></td>
        <td data-name="closeu"<?= $Page->closeu->cellAttributes() ?>>
<span id="el_hours_closeu">
<span<?= $Page->closeu->viewAttributes() ?>>
<?= $Page->closeu->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
    <tr id="r_type"<?= $Page->type->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_type"><?= $Page->type->caption() ?></span></td>
        <td data-name="type"<?= $Page->type->cellAttributes() ?>>
<span id="el_hours_type">
<span<?= $Page->type->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_type_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->type->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->type->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_type_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_hours_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_hours_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
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
