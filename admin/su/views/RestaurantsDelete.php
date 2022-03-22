<?php

namespace PHPMaker2021\project1;

// Page object
$RestaurantsDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var frestaurantsdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    frestaurantsdelete = currentForm = new ew.Form("frestaurantsdelete", "delete");
    loadjs.done("frestaurantsdelete");
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
<form name="frestaurantsdelete" id="frestaurantsdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="restaurants">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_restaurants_id" class="restaurants_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->location_id->Visible) { // location_id ?>
        <th class="<?= $Page->location_id->headerCellClass() ?>"><span id="elh_restaurants_location_id" class="restaurants_location_id"><?= $Page->location_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->banner->Visible) { // banner ?>
        <th class="<?= $Page->banner->headerCellClass() ?>"><span id="elh_restaurants_banner" class="restaurants_banner"><?= $Page->banner->caption() ?></span></th>
<?php } ?>
<?php if ($Page->button_menu->Visible) { // button_menu ?>
        <th class="<?= $Page->button_menu->headerCellClass() ?>"><span id="elh_restaurants_button_menu" class="restaurants_button_menu"><?= $Page->button_menu->caption() ?></span></th>
<?php } ?>
<?php if ($Page->button_pdf->Visible) { // button_pdf ?>
        <th class="<?= $Page->button_pdf->headerCellClass() ?>"><span id="elh_restaurants_button_pdf" class="restaurants_button_pdf"><?= $Page->button_pdf->caption() ?></span></th>
<?php } ?>
<?php if ($Page->button_catering->Visible) { // button_catering ?>
        <th class="<?= $Page->button_catering->headerCellClass() ?>"><span id="elh_restaurants_button_catering" class="restaurants_button_catering"><?= $Page->button_catering->caption() ?></span></th>
<?php } ?>
<?php if ($Page->button_form->Visible) { // button_form ?>
        <th class="<?= $Page->button_form->headerCellClass() ?>"><span id="elh_restaurants_button_form" class="restaurants_button_form"><?= $Page->button_form->caption() ?></span></th>
<?php } ?>
<?php if ($Page->slides->Visible) { // slides ?>
        <th class="<?= $Page->slides->headerCellClass() ?>"><span id="elh_restaurants_slides" class="restaurants_slides"><?= $Page->slides->caption() ?></span></th>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <th class="<?= $Page->timestamp->headerCellClass() ?>"><span id="elh_restaurants_timestamp" class="restaurants_timestamp"><?= $Page->timestamp->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_restaurants_id" class="restaurants_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->location_id->Visible) { // location_id ?>
        <td <?= $Page->location_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_restaurants_location_id" class="restaurants_location_id">
<span<?= $Page->location_id->viewAttributes() ?>>
<?= $Page->location_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->banner->Visible) { // banner ?>
        <td <?= $Page->banner->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_restaurants_banner" class="restaurants_banner">
<span<?= $Page->banner->viewAttributes() ?>>
<?= $Page->banner->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->button_menu->Visible) { // button_menu ?>
        <td <?= $Page->button_menu->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_restaurants_button_menu" class="restaurants_button_menu">
<span<?= $Page->button_menu->viewAttributes() ?>>
<?= $Page->button_menu->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->button_pdf->Visible) { // button_pdf ?>
        <td <?= $Page->button_pdf->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_restaurants_button_pdf" class="restaurants_button_pdf">
<span<?= $Page->button_pdf->viewAttributes() ?>>
<?= $Page->button_pdf->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->button_catering->Visible) { // button_catering ?>
        <td <?= $Page->button_catering->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_restaurants_button_catering" class="restaurants_button_catering">
<span<?= $Page->button_catering->viewAttributes() ?>>
<?= $Page->button_catering->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->button_form->Visible) { // button_form ?>
        <td <?= $Page->button_form->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_restaurants_button_form" class="restaurants_button_form">
<span<?= $Page->button_form->viewAttributes() ?>>
<?= $Page->button_form->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->slides->Visible) { // slides ?>
        <td <?= $Page->slides->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_restaurants_slides" class="restaurants_slides">
<span<?= $Page->slides->viewAttributes() ?>>
<?= $Page->slides->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <td <?= $Page->timestamp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_restaurants_timestamp" class="restaurants_timestamp">
<span<?= $Page->timestamp->viewAttributes() ?>>
<?= $Page->timestamp->getViewValue() ?></span>
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
