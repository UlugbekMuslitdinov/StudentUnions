<?php

namespace PHPMaker2021\project1;

// Page object
$AccountsEventsDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var faccounts_eventsdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    faccounts_eventsdelete = currentForm = new ew.Form("faccounts_eventsdelete", "delete");
    loadjs.done("faccounts_eventsdelete");
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
<form name="faccounts_eventsdelete" id="faccounts_eventsdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="accounts_events">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_accounts_events_id" class="accounts_events_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->account_id->Visible) { // account_id ?>
        <th class="<?= $Page->account_id->headerCellClass() ?>"><span id="elh_accounts_events_account_id" class="accounts_events_account_id"><?= $Page->account_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->event_id->Visible) { // event_id ?>
        <th class="<?= $Page->event_id->headerCellClass() ?>"><span id="elh_accounts_events_event_id" class="accounts_events_event_id"><?= $Page->event_id->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_accounts_events_id" class="accounts_events_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->account_id->Visible) { // account_id ?>
        <td <?= $Page->account_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_accounts_events_account_id" class="accounts_events_account_id">
<span<?= $Page->account_id->viewAttributes() ?>>
<?= $Page->account_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->event_id->Visible) { // event_id ?>
        <td <?= $Page->event_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_accounts_events_event_id" class="accounts_events_event_id">
<span<?= $Page->event_id->viewAttributes() ?>>
<?= $Page->event_id->getViewValue() ?></span>
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
