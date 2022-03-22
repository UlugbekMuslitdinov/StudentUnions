<?php

namespace PHPMaker2021\project1;

// Page object
$RestaurantsSlidesDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var frestaurants_slidesdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    frestaurants_slidesdelete = currentForm = new ew.Form("frestaurants_slidesdelete", "delete");
    loadjs.done("frestaurants_slidesdelete");
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
<form name="frestaurants_slidesdelete" id="frestaurants_slidesdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="restaurants_slides">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_restaurants_slides_id" class="restaurants_slides_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->restaurant_id->Visible) { // restaurant_id ?>
        <th class="<?= $Page->restaurant_id->headerCellClass() ?>"><span id="elh_restaurants_slides_restaurant_id" class="restaurants_slides_restaurant_id"><?= $Page->restaurant_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->filename->Visible) { // filename ?>
        <th class="<?= $Page->filename->headerCellClass() ?>"><span id="elh_restaurants_slides_filename" class="restaurants_slides_filename"><?= $Page->filename->caption() ?></span></th>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <th class="<?= $Page->timestamp->headerCellClass() ?>"><span id="elh_restaurants_slides_timestamp" class="restaurants_slides_timestamp"><?= $Page->timestamp->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_restaurants_slides_id" class="restaurants_slides_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->restaurant_id->Visible) { // restaurant_id ?>
        <td <?= $Page->restaurant_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_restaurants_slides_restaurant_id" class="restaurants_slides_restaurant_id">
<span<?= $Page->restaurant_id->viewAttributes() ?>>
<?= $Page->restaurant_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->filename->Visible) { // filename ?>
        <td <?= $Page->filename->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_restaurants_slides_filename" class="restaurants_slides_filename">
<span<?= $Page->filename->viewAttributes() ?>>
<?= $Page->filename->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <td <?= $Page->timestamp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_restaurants_slides_timestamp" class="restaurants_slides_timestamp">
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
