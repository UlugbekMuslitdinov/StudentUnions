<?php

namespace PHPMaker2021\project1;

// Page object
$EventOrdersView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fevent_ordersview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fevent_ordersview = currentForm = new ew.Form("fevent_ordersview", "view");
    loadjs.done("fevent_ordersview");
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
<form name="fevent_ordersview" id="fevent_ordersview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="event_orders">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_event_orders_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_event_orders_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->event_id->Visible) { // event_id ?>
    <tr id="r_event_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_event_orders_event_id"><?= $Page->event_id->caption() ?></span></td>
        <td data-name="event_id" <?= $Page->event_id->cellAttributes() ?>>
<span id="el_event_orders_event_id">
<span<?= $Page->event_id->viewAttributes() ?>>
<?= $Page->event_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->event_time->Visible) { // event_time ?>
    <tr id="r_event_time">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_event_orders_event_time"><?= $Page->event_time->caption() ?></span></td>
        <td data-name="event_time" <?= $Page->event_time->cellAttributes() ?>>
<span id="el_event_orders_event_time">
<span<?= $Page->event_time->viewAttributes() ?>>
<?= $Page->event_time->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->event_type->Visible) { // event_type ?>
    <tr id="r_event_type">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_event_orders_event_type"><?= $Page->event_type->caption() ?></span></td>
        <td data-name="event_type" <?= $Page->event_type->cellAttributes() ?>>
<span id="el_event_orders_event_type">
<span<?= $Page->event_type->viewAttributes() ?>>
<?= $Page->event_type->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pdf_link->Visible) { // pdf_link ?>
    <tr id="r_pdf_link">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_event_orders_pdf_link"><?= $Page->pdf_link->caption() ?></span></td>
        <td data-name="pdf_link" <?= $Page->pdf_link->cellAttributes() ?>>
<span id="el_event_orders_pdf_link">
<span<?= $Page->pdf_link->viewAttributes() ?>>
<?= $Page->pdf_link->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->uploader->Visible) { // uploader ?>
    <tr id="r_uploader">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_event_orders_uploader"><?= $Page->uploader->caption() ?></span></td>
        <td data-name="uploader" <?= $Page->uploader->cellAttributes() ?>>
<span id="el_event_orders_uploader">
<span<?= $Page->uploader->viewAttributes() ?>>
<?= $Page->uploader->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
    <tr id="r_timestamp">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_event_orders_timestamp"><?= $Page->timestamp->caption() ?></span></td>
        <td data-name="timestamp" <?= $Page->timestamp->cellAttributes() ?>>
<span id="el_event_orders_timestamp">
<span<?= $Page->timestamp->viewAttributes() ?>>
<?= $Page->timestamp->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->data->Visible) { // data ?>
    <tr id="r_data">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_event_orders_data"><?= $Page->data->caption() ?></span></td>
        <td data-name="data" <?= $Page->data->cellAttributes() ?>>
<span id="el_event_orders_data">
<span<?= $Page->data->viewAttributes() ?>>
<?= $Page->data->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->progress->Visible) { // progress ?>
    <tr id="r_progress">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_event_orders_progress"><?= $Page->progress->caption() ?></span></td>
        <td data-name="progress" <?= $Page->progress->cellAttributes() ?>>
<span id="el_event_orders_progress">
<span<?= $Page->progress->viewAttributes() ?>>
<?= $Page->progress->getViewValue() ?></span>
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
