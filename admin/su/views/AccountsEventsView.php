<?php

namespace PHPMaker2021\project1;

// Page object
$AccountsEventsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var faccounts_eventsview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    faccounts_eventsview = currentForm = new ew.Form("faccounts_eventsview", "view");
    loadjs.done("faccounts_eventsview");
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
<form name="faccounts_eventsview" id="faccounts_eventsview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="accounts_events">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_accounts_events_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_accounts_events_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->account_id->Visible) { // account_id ?>
    <tr id="r_account_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_accounts_events_account_id"><?= $Page->account_id->caption() ?></span></td>
        <td data-name="account_id" <?= $Page->account_id->cellAttributes() ?>>
<span id="el_accounts_events_account_id">
<span<?= $Page->account_id->viewAttributes() ?>>
<?= $Page->account_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->event_id->Visible) { // event_id ?>
    <tr id="r_event_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_accounts_events_event_id"><?= $Page->event_id->caption() ?></span></td>
        <td data-name="event_id" <?= $Page->event_id->cellAttributes() ?>>
<span id="el_accounts_events_event_id">
<span<?= $Page->event_id->viewAttributes() ?>>
<?= $Page->event_id->getViewValue() ?></span>
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
