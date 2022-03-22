<?php

namespace PHPMaker2022\project3;

// Page object
$HoursDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { hours: currentTable } });
var currentForm, currentPageID;
var fhoursdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fhoursdelete = new ew.Form("fhoursdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fhoursdelete;
    loadjs.done("fhoursdelete");
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
<form name="fhoursdelete" id="fhoursdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="hours">
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
<?php if ($Page->location_id->Visible) { // location_id ?>
        <th class="<?= $Page->location_id->headerCellClass() ?>"><span id="elh_hours_location_id" class="hours_location_id"><?= $Page->location_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->openm->Visible) { // openm ?>
        <th class="<?= $Page->openm->headerCellClass() ?>"><span id="elh_hours_openm" class="hours_openm"><?= $Page->openm->caption() ?></span></th>
<?php } ?>
<?php if ($Page->closem->Visible) { // closem ?>
        <th class="<?= $Page->closem->headerCellClass() ?>"><span id="elh_hours_closem" class="hours_closem"><?= $Page->closem->caption() ?></span></th>
<?php } ?>
<?php if ($Page->opent->Visible) { // opent ?>
        <th class="<?= $Page->opent->headerCellClass() ?>"><span id="elh_hours_opent" class="hours_opent"><?= $Page->opent->caption() ?></span></th>
<?php } ?>
<?php if ($Page->closet->Visible) { // closet ?>
        <th class="<?= $Page->closet->headerCellClass() ?>"><span id="elh_hours_closet" class="hours_closet"><?= $Page->closet->caption() ?></span></th>
<?php } ?>
<?php if ($Page->openw->Visible) { // openw ?>
        <th class="<?= $Page->openw->headerCellClass() ?>"><span id="elh_hours_openw" class="hours_openw"><?= $Page->openw->caption() ?></span></th>
<?php } ?>
<?php if ($Page->closew->Visible) { // closew ?>
        <th class="<?= $Page->closew->headerCellClass() ?>"><span id="elh_hours_closew" class="hours_closew"><?= $Page->closew->caption() ?></span></th>
<?php } ?>
<?php if ($Page->openr->Visible) { // openr ?>
        <th class="<?= $Page->openr->headerCellClass() ?>"><span id="elh_hours_openr" class="hours_openr"><?= $Page->openr->caption() ?></span></th>
<?php } ?>
<?php if ($Page->closer->Visible) { // closer ?>
        <th class="<?= $Page->closer->headerCellClass() ?>"><span id="elh_hours_closer" class="hours_closer"><?= $Page->closer->caption() ?></span></th>
<?php } ?>
<?php if ($Page->openf->Visible) { // openf ?>
        <th class="<?= $Page->openf->headerCellClass() ?>"><span id="elh_hours_openf" class="hours_openf"><?= $Page->openf->caption() ?></span></th>
<?php } ?>
<?php if ($Page->closef->Visible) { // closef ?>
        <th class="<?= $Page->closef->headerCellClass() ?>"><span id="elh_hours_closef" class="hours_closef"><?= $Page->closef->caption() ?></span></th>
<?php } ?>
<?php if ($Page->opens->Visible) { // opens ?>
        <th class="<?= $Page->opens->headerCellClass() ?>"><span id="elh_hours_opens" class="hours_opens"><?= $Page->opens->caption() ?></span></th>
<?php } ?>
<?php if ($Page->closes->Visible) { // closes ?>
        <th class="<?= $Page->closes->headerCellClass() ?>"><span id="elh_hours_closes" class="hours_closes"><?= $Page->closes->caption() ?></span></th>
<?php } ?>
<?php if ($Page->openu->Visible) { // openu ?>
        <th class="<?= $Page->openu->headerCellClass() ?>"><span id="elh_hours_openu" class="hours_openu"><?= $Page->openu->caption() ?></span></th>
<?php } ?>
<?php if ($Page->closeu->Visible) { // closeu ?>
        <th class="<?= $Page->closeu->headerCellClass() ?>"><span id="elh_hours_closeu" class="hours_closeu"><?= $Page->closeu->caption() ?></span></th>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
        <th class="<?= $Page->type->headerCellClass() ?>"><span id="elh_hours_type" class="hours_type"><?= $Page->type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_hours_id" class="hours_id"><?= $Page->id->caption() ?></span></th>
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
<?php if ($Page->location_id->Visible) { // location_id ?>
        <td<?= $Page->location_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_location_id" class="el_hours_location_id">
<span<?= $Page->location_id->viewAttributes() ?>>
<?= $Page->location_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->openm->Visible) { // openm ?>
        <td<?= $Page->openm->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_openm" class="el_hours_openm">
<span<?= $Page->openm->viewAttributes() ?>>
<?= $Page->openm->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->closem->Visible) { // closem ?>
        <td<?= $Page->closem->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_closem" class="el_hours_closem">
<span<?= $Page->closem->viewAttributes() ?>>
<?= $Page->closem->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->opent->Visible) { // opent ?>
        <td<?= $Page->opent->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_opent" class="el_hours_opent">
<span<?= $Page->opent->viewAttributes() ?>>
<?= $Page->opent->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->closet->Visible) { // closet ?>
        <td<?= $Page->closet->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_closet" class="el_hours_closet">
<span<?= $Page->closet->viewAttributes() ?>>
<?= $Page->closet->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->openw->Visible) { // openw ?>
        <td<?= $Page->openw->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_openw" class="el_hours_openw">
<span<?= $Page->openw->viewAttributes() ?>>
<?= $Page->openw->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->closew->Visible) { // closew ?>
        <td<?= $Page->closew->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_closew" class="el_hours_closew">
<span<?= $Page->closew->viewAttributes() ?>>
<?= $Page->closew->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->openr->Visible) { // openr ?>
        <td<?= $Page->openr->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_openr" class="el_hours_openr">
<span<?= $Page->openr->viewAttributes() ?>>
<?= $Page->openr->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->closer->Visible) { // closer ?>
        <td<?= $Page->closer->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_closer" class="el_hours_closer">
<span<?= $Page->closer->viewAttributes() ?>>
<?= $Page->closer->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->openf->Visible) { // openf ?>
        <td<?= $Page->openf->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_openf" class="el_hours_openf">
<span<?= $Page->openf->viewAttributes() ?>>
<?= $Page->openf->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->closef->Visible) { // closef ?>
        <td<?= $Page->closef->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_closef" class="el_hours_closef">
<span<?= $Page->closef->viewAttributes() ?>>
<?= $Page->closef->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->opens->Visible) { // opens ?>
        <td<?= $Page->opens->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_opens" class="el_hours_opens">
<span<?= $Page->opens->viewAttributes() ?>>
<?= $Page->opens->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->closes->Visible) { // closes ?>
        <td<?= $Page->closes->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_closes" class="el_hours_closes">
<span<?= $Page->closes->viewAttributes() ?>>
<?= $Page->closes->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->openu->Visible) { // openu ?>
        <td<?= $Page->openu->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_openu" class="el_hours_openu">
<span<?= $Page->openu->viewAttributes() ?>>
<?= $Page->openu->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->closeu->Visible) { // closeu ?>
        <td<?= $Page->closeu->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_closeu" class="el_hours_closeu">
<span<?= $Page->closeu->viewAttributes() ?>>
<?= $Page->closeu->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
        <td<?= $Page->type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_type" class="el_hours_type">
<span<?= $Page->type->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_type_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->type->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->type->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_type_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
        <td<?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_hours_id" class="el_hours_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
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
