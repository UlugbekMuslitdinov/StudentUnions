<?php

namespace PHPMaker2021\project1;

// Page object
$EventTimelineView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fevent_timelineview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fevent_timelineview = currentForm = new ew.Form("fevent_timelineview", "view");
    loadjs.done("fevent_timelineview");
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
<form name="fevent_timelineview" id="fevent_timelineview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="event_timeline">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_event_timeline_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_event_timeline_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->event_id->Visible) { // event_id ?>
    <tr id="r_event_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_event_timeline_event_id"><?= $Page->event_id->caption() ?></span></td>
        <td data-name="event_id" <?= $Page->event_id->cellAttributes() ?>>
<span id="el_event_timeline_event_id">
<span<?= $Page->event_id->viewAttributes() ?>>
<?= $Page->event_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->admin_id->Visible) { // admin_id ?>
    <tr id="r_admin_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_event_timeline_admin_id"><?= $Page->admin_id->caption() ?></span></td>
        <td data-name="admin_id" <?= $Page->admin_id->cellAttributes() ?>>
<span id="el_event_timeline_admin_id">
<span<?= $Page->admin_id->viewAttributes() ?>>
<?= $Page->admin_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_action->Visible) { // action ?>
    <tr id="r__action">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_event_timeline__action"><?= $Page->_action->caption() ?></span></td>
        <td data-name="_action" <?= $Page->_action->cellAttributes() ?>>
<span id="el_event_timeline__action">
<span<?= $Page->_action->viewAttributes() ?>>
<?= $Page->_action->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->detail->Visible) { // detail ?>
    <tr id="r_detail">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_event_timeline_detail"><?= $Page->detail->caption() ?></span></td>
        <td data-name="detail" <?= $Page->detail->cellAttributes() ?>>
<span id="el_event_timeline_detail">
<span<?= $Page->detail->viewAttributes() ?>>
<?= $Page->detail->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <tr id="r_created_at">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_event_timeline_created_at"><?= $Page->created_at->caption() ?></span></td>
        <td data-name="created_at" <?= $Page->created_at->cellAttributes() ?>>
<span id="el_event_timeline_created_at">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
    <tr id="r_updated_at">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_event_timeline_updated_at"><?= $Page->updated_at->caption() ?></span></td>
        <td data-name="updated_at" <?= $Page->updated_at->cellAttributes() ?>>
<span id="el_event_timeline_updated_at">
<span<?= $Page->updated_at->viewAttributes() ?>>
<?= $Page->updated_at->getViewValue() ?></span>
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
