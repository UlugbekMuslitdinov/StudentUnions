<?php

namespace PHPMaker2021\project1;

// Page object
$CateringHighlandBurritoDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fcatering_highland_burritodelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fcatering_highland_burritodelete = currentForm = new ew.Form("fcatering_highland_burritodelete", "delete");
    loadjs.done("fcatering_highland_burritodelete");
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
<form name="fcatering_highland_burritodelete" id="fcatering_highland_burritodelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="catering_highland_burrito">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_catering_highland_burrito_id" class="catering_highland_burrito_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->catering_id->Visible) { // catering_id ?>
        <th class="<?= $Page->catering_id->headerCellClass() ?>"><span id="elh_catering_highland_burrito_catering_id" class="catering_highland_burrito_catering_id"><?= $Page->catering_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pack->Visible) { // pack ?>
        <th class="<?= $Page->pack->headerCellClass() ?>"><span id="elh_catering_highland_burrito_pack" class="catering_highland_burrito_pack"><?= $Page->pack->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pack_num->Visible) { // pack_num ?>
        <th class="<?= $Page->pack_num->headerCellClass() ?>"><span id="elh_catering_highland_burrito_pack_num" class="catering_highland_burrito_pack_num"><?= $Page->pack_num->caption() ?></span></th>
<?php } ?>
<?php if ($Page->burrito_num->Visible) { // burrito_num ?>
        <th class="<?= $Page->burrito_num->headerCellClass() ?>"><span id="elh_catering_highland_burrito_burrito_num" class="catering_highland_burrito_burrito_num"><?= $Page->burrito_num->caption() ?></span></th>
<?php } ?>
<?php if ($Page->meat_1->Visible) { // meat_1 ?>
        <th class="<?= $Page->meat_1->headerCellClass() ?>"><span id="elh_catering_highland_burrito_meat_1" class="catering_highland_burrito_meat_1"><?= $Page->meat_1->caption() ?></span></th>
<?php } ?>
<?php if ($Page->meat_2->Visible) { // meat_2 ?>
        <th class="<?= $Page->meat_2->headerCellClass() ?>"><span id="elh_catering_highland_burrito_meat_2" class="catering_highland_burrito_meat_2"><?= $Page->meat_2->caption() ?></span></th>
<?php } ?>
<?php if ($Page->meat_3->Visible) { // meat_3 ?>
        <th class="<?= $Page->meat_3->headerCellClass() ?>"><span id="elh_catering_highland_burrito_meat_3" class="catering_highland_burrito_meat_3"><?= $Page->meat_3->caption() ?></span></th>
<?php } ?>
<?php if ($Page->meat_4->Visible) { // meat_4 ?>
        <th class="<?= $Page->meat_4->headerCellClass() ?>"><span id="elh_catering_highland_burrito_meat_4" class="catering_highland_burrito_meat_4"><?= $Page->meat_4->caption() ?></span></th>
<?php } ?>
<?php if ($Page->vege_1->Visible) { // vege_1 ?>
        <th class="<?= $Page->vege_1->headerCellClass() ?>"><span id="elh_catering_highland_burrito_vege_1" class="catering_highland_burrito_vege_1"><?= $Page->vege_1->caption() ?></span></th>
<?php } ?>
<?php if ($Page->vege_2->Visible) { // vege_2 ?>
        <th class="<?= $Page->vege_2->headerCellClass() ?>"><span id="elh_catering_highland_burrito_vege_2" class="catering_highland_burrito_vege_2"><?= $Page->vege_2->caption() ?></span></th>
<?php } ?>
<?php if ($Page->vege_3->Visible) { // vege_3 ?>
        <th class="<?= $Page->vege_3->headerCellClass() ?>"><span id="elh_catering_highland_burrito_vege_3" class="catering_highland_burrito_vege_3"><?= $Page->vege_3->caption() ?></span></th>
<?php } ?>
<?php if ($Page->vege_4->Visible) { // vege_4 ?>
        <th class="<?= $Page->vege_4->headerCellClass() ?>"><span id="elh_catering_highland_burrito_vege_4" class="catering_highland_burrito_vege_4"><?= $Page->vege_4->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_catering_highland_burrito_id" class="catering_highland_burrito_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->catering_id->Visible) { // catering_id ?>
        <td <?= $Page->catering_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_burrito_catering_id" class="catering_highland_burrito_catering_id">
<span<?= $Page->catering_id->viewAttributes() ?>>
<?= $Page->catering_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pack->Visible) { // pack ?>
        <td <?= $Page->pack->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_burrito_pack" class="catering_highland_burrito_pack">
<span<?= $Page->pack->viewAttributes() ?>>
<?= $Page->pack->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pack_num->Visible) { // pack_num ?>
        <td <?= $Page->pack_num->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_burrito_pack_num" class="catering_highland_burrito_pack_num">
<span<?= $Page->pack_num->viewAttributes() ?>>
<?= $Page->pack_num->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->burrito_num->Visible) { // burrito_num ?>
        <td <?= $Page->burrito_num->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_burrito_burrito_num" class="catering_highland_burrito_burrito_num">
<span<?= $Page->burrito_num->viewAttributes() ?>>
<?= $Page->burrito_num->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->meat_1->Visible) { // meat_1 ?>
        <td <?= $Page->meat_1->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_burrito_meat_1" class="catering_highland_burrito_meat_1">
<span<?= $Page->meat_1->viewAttributes() ?>>
<?= $Page->meat_1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->meat_2->Visible) { // meat_2 ?>
        <td <?= $Page->meat_2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_burrito_meat_2" class="catering_highland_burrito_meat_2">
<span<?= $Page->meat_2->viewAttributes() ?>>
<?= $Page->meat_2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->meat_3->Visible) { // meat_3 ?>
        <td <?= $Page->meat_3->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_burrito_meat_3" class="catering_highland_burrito_meat_3">
<span<?= $Page->meat_3->viewAttributes() ?>>
<?= $Page->meat_3->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->meat_4->Visible) { // meat_4 ?>
        <td <?= $Page->meat_4->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_burrito_meat_4" class="catering_highland_burrito_meat_4">
<span<?= $Page->meat_4->viewAttributes() ?>>
<?= $Page->meat_4->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->vege_1->Visible) { // vege_1 ?>
        <td <?= $Page->vege_1->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_burrito_vege_1" class="catering_highland_burrito_vege_1">
<span<?= $Page->vege_1->viewAttributes() ?>>
<?= $Page->vege_1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->vege_2->Visible) { // vege_2 ?>
        <td <?= $Page->vege_2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_burrito_vege_2" class="catering_highland_burrito_vege_2">
<span<?= $Page->vege_2->viewAttributes() ?>>
<?= $Page->vege_2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->vege_3->Visible) { // vege_3 ?>
        <td <?= $Page->vege_3->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_burrito_vege_3" class="catering_highland_burrito_vege_3">
<span<?= $Page->vege_3->viewAttributes() ?>>
<?= $Page->vege_3->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->vege_4->Visible) { // vege_4 ?>
        <td <?= $Page->vege_4->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_highland_burrito_vege_4" class="catering_highland_burrito_vege_4">
<span<?= $Page->vege_4->viewAttributes() ?>>
<?= $Page->vege_4->getViewValue() ?></span>
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
