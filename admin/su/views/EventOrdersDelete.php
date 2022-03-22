<?php

namespace PHPMaker2021\project1;

// Page object
$EventOrdersDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fevent_ordersdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fevent_ordersdelete = currentForm = new ew.Form("fevent_ordersdelete", "delete");
    loadjs.done("fevent_ordersdelete");
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
<form name="fevent_ordersdelete" id="fevent_ordersdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="event_orders">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_event_orders_id" class="event_orders_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->event_id->Visible) { // event_id ?>
        <th class="<?= $Page->event_id->headerCellClass() ?>"><span id="elh_event_orders_event_id" class="event_orders_event_id"><?= $Page->event_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->event_time->Visible) { // event_time ?>
        <th class="<?= $Page->event_time->headerCellClass() ?>"><span id="elh_event_orders_event_time" class="event_orders_event_time"><?= $Page->event_time->caption() ?></span></th>
<?php } ?>
<?php if ($Page->event_type->Visible) { // event_type ?>
        <th class="<?= $Page->event_type->headerCellClass() ?>"><span id="elh_event_orders_event_type" class="event_orders_event_type"><?= $Page->event_type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pdf_link->Visible) { // pdf_link ?>
        <th class="<?= $Page->pdf_link->headerCellClass() ?>"><span id="elh_event_orders_pdf_link" class="event_orders_pdf_link"><?= $Page->pdf_link->caption() ?></span></th>
<?php } ?>
<?php if ($Page->uploader->Visible) { // uploader ?>
        <th class="<?= $Page->uploader->headerCellClass() ?>"><span id="elh_event_orders_uploader" class="event_orders_uploader"><?= $Page->uploader->caption() ?></span></th>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <th class="<?= $Page->timestamp->headerCellClass() ?>"><span id="elh_event_orders_timestamp" class="event_orders_timestamp"><?= $Page->timestamp->caption() ?></span></th>
<?php } ?>
<?php if ($Page->progress->Visible) { // progress ?>
        <th class="<?= $Page->progress->headerCellClass() ?>"><span id="elh_event_orders_progress" class="event_orders_progress"><?= $Page->progress->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_event_orders_id" class="event_orders_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->event_id->Visible) { // event_id ?>
        <td <?= $Page->event_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_event_orders_event_id" class="event_orders_event_id">
<span<?= $Page->event_id->viewAttributes() ?>>
<?= $Page->event_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->event_time->Visible) { // event_time ?>
        <td <?= $Page->event_time->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_event_orders_event_time" class="event_orders_event_time">
<span<?= $Page->event_time->viewAttributes() ?>>
<?= $Page->event_time->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->event_type->Visible) { // event_type ?>
        <td <?= $Page->event_type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_event_orders_event_type" class="event_orders_event_type">
<span<?= $Page->event_type->viewAttributes() ?>>
<?= $Page->event_type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pdf_link->Visible) { // pdf_link ?>
        <td <?= $Page->pdf_link->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_event_orders_pdf_link" class="event_orders_pdf_link">
<span<?= $Page->pdf_link->viewAttributes() ?>>
<?= $Page->pdf_link->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->uploader->Visible) { // uploader ?>
        <td <?= $Page->uploader->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_event_orders_uploader" class="event_orders_uploader">
<span<?= $Page->uploader->viewAttributes() ?>>
<?= $Page->uploader->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <td <?= $Page->timestamp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_event_orders_timestamp" class="event_orders_timestamp">
<span<?= $Page->timestamp->viewAttributes() ?>>
<?= $Page->timestamp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->progress->Visible) { // progress ?>
        <td <?= $Page->progress->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_event_orders_progress" class="event_orders_progress">
<span<?= $Page->progress->viewAttributes() ?>>
<?= $Page->progress->getViewValue() ?></span>
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
