<?php

namespace PHPMaker2021\project1;

// Page object
$CateringHighlandDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fcatering_highlanddelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fcatering_highlanddelete = currentForm = new ew.Form("fcatering_highlanddelete", "delete");
    loadjs.done("fcatering_highlanddelete");
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
<form name="fcatering_highlanddelete" id="fcatering_highlanddelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="catering_highland">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->id->Visible) { // id ?>
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_catering_highland_id" class="catering_highland_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->catering_id->Visible) { // catering_id ?>
        <th class="<?= $Page->catering_id->headerCellClass() ?>"><span id="elh_catering_highland_catering_id" class="catering_highland_catering_id"><?= $Page->catering_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->burrito_12->Visible) { // burrito_12 ?>
        <th class="<?= $Page->burrito_12->headerCellClass() ?>"><span id="elh_catering_highland_burrito_12" class="catering_highland_burrito_12"><?= $Page->burrito_12->caption() ?></span></th>
<?php } ?>
<?php if ($Page->burrito_8->Visible) { // burrito_8 ?>
        <th class="<?= $Page->burrito_8->headerCellClass() ?>"><span id="elh_catering_highland_burrito_8" class="catering_highland_burrito_8"><?= $Page->burrito_8->caption() ?></span></th>
<?php } ?>
<?php if ($Page->extra_chips->Visible) { // extra_chips ?>
        <th class="<?= $Page->extra_chips->headerCellClass() ?>"><span id="elh_catering_highland_extra_chips" class="catering_highland_extra_chips"><?= $Page->extra_chips->caption() ?></span></th>
<?php } ?>
<?php if ($Page->extra_salsa->Visible) { // extra_salsa ?>
        <th class="<?= $Page->extra_salsa->headerCellClass() ?>"><span id="elh_catering_highland_extra_salsa" class="catering_highland_extra_salsa"><?= $Page->extra_salsa->caption() ?></span></th>
<?php } ?>
<?php if ($Page->extra_sourcream->Visible) { // extra_sourcream ?>
        <th class="<?= $Page->extra_sourcream->headerCellClass() ?>"><span id="elh_catering_highland_extra_sourcream" class="catering_highland_extra_sourcream"><?= $Page->extra_sourcream->caption() ?></span></th>
<?php } ?>
<?php if ($Page->extra_guacamole->Visible) { // extra_guacamole ?>
        <th class="<?= $Page->extra_guacamole->headerCellClass() ?>"><span id="elh_catering_highland_extra_guacamole" class="catering_highland_extra_guacamole"><?= $Page->extra_guacamole->caption() ?></span></th>
<?php } ?>
<?php if ($Page->upgrade->Visible) { // upgrade ?>
        <th class="<?= $Page->upgrade->headerCellClass() ?>"><span id="elh_catering_highland_upgrade" class="catering_highland_upgrade"><?= $Page->upgrade->caption() ?></span></th>
<?php } ?>
<?php if ($Page->coke->Visible) { // coke ?>
        <th class="<?= $Page->coke->headerCellClass() ?>"><span id="elh_catering_highland_coke" class="catering_highland_coke"><?= $Page->coke->caption() ?></span></th>
<?php } ?>
<?php if ($Page->diet_coke->Visible) { // diet_coke ?>
        <th class="<?= $Page->diet_coke->headerCellClass() ?>"><span id="elh_catering_highland_diet_coke" class="catering_highland_diet_coke"><?= $Page->diet_coke->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sprite->Visible) { // sprite ?>
        <th class="<?= $Page->sprite->headerCellClass() ?>"><span id="elh_catering_highland_sprite" class="catering_highland_sprite"><?= $Page->sprite->caption() ?></span></th>
<?php } ?>
<?php if ($Page->fanta->Visible) { // fanta ?>
        <th class="<?= $Page->fanta->headerCellClass() ?>"><span id="elh_catering_highland_fanta" class="catering_highland_fanta"><?= $Page->fanta->caption() ?></span></th>
<?php } ?>
<?php if ($Page->water->Visible) { // water ?>
        <th class="<?= $Page->water->headerCellClass() ?>"><span id="elh_catering_highland_water" class="catering_highland_water"><?= $Page->water->caption() ?></span></th>
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
        <td <?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_id" class="catering_highland_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->catering_id->Visible) { // catering_id ?>
        <td <?= $Page->catering_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_catering_id" class="catering_highland_catering_id">
<span<?= $Page->catering_id->viewAttributes() ?>>
<?= $Page->catering_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->burrito_12->Visible) { // burrito_12 ?>
        <td <?= $Page->burrito_12->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_burrito_12" class="catering_highland_burrito_12">
<span<?= $Page->burrito_12->viewAttributes() ?>>
<?= $Page->burrito_12->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->burrito_8->Visible) { // burrito_8 ?>
        <td <?= $Page->burrito_8->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_burrito_8" class="catering_highland_burrito_8">
<span<?= $Page->burrito_8->viewAttributes() ?>>
<?= $Page->burrito_8->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->extra_chips->Visible) { // extra_chips ?>
        <td <?= $Page->extra_chips->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_extra_chips" class="catering_highland_extra_chips">
<span<?= $Page->extra_chips->viewAttributes() ?>>
<?= $Page->extra_chips->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->extra_salsa->Visible) { // extra_salsa ?>
        <td <?= $Page->extra_salsa->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_extra_salsa" class="catering_highland_extra_salsa">
<span<?= $Page->extra_salsa->viewAttributes() ?>>
<?= $Page->extra_salsa->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->extra_sourcream->Visible) { // extra_sourcream ?>
        <td <?= $Page->extra_sourcream->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_extra_sourcream" class="catering_highland_extra_sourcream">
<span<?= $Page->extra_sourcream->viewAttributes() ?>>
<?= $Page->extra_sourcream->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->extra_guacamole->Visible) { // extra_guacamole ?>
        <td <?= $Page->extra_guacamole->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_extra_guacamole" class="catering_highland_extra_guacamole">
<span<?= $Page->extra_guacamole->viewAttributes() ?>>
<?= $Page->extra_guacamole->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->upgrade->Visible) { // upgrade ?>
        <td <?= $Page->upgrade->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_upgrade" class="catering_highland_upgrade">
<span<?= $Page->upgrade->viewAttributes() ?>>
<?= $Page->upgrade->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->coke->Visible) { // coke ?>
        <td <?= $Page->coke->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_coke" class="catering_highland_coke">
<span<?= $Page->coke->viewAttributes() ?>>
<?= $Page->coke->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->diet_coke->Visible) { // diet_coke ?>
        <td <?= $Page->diet_coke->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_diet_coke" class="catering_highland_diet_coke">
<span<?= $Page->diet_coke->viewAttributes() ?>>
<?= $Page->diet_coke->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sprite->Visible) { // sprite ?>
        <td <?= $Page->sprite->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_sprite" class="catering_highland_sprite">
<span<?= $Page->sprite->viewAttributes() ?>>
<?= $Page->sprite->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->fanta->Visible) { // fanta ?>
        <td <?= $Page->fanta->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_fanta" class="catering_highland_fanta">
<span<?= $Page->fanta->viewAttributes() ?>>
<?= $Page->fanta->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->water->Visible) { // water ?>
        <td <?= $Page->water->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_water" class="catering_highland_water">
<span<?= $Page->water->viewAttributes() ?>>
<?= $Page->water->getViewValue() ?></span>
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
