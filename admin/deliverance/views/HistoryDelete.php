<?php

namespace PHPMaker2021\project3;

// Page object
$HistoryDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fhistorydelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fhistorydelete = currentForm = new ew.Form("fhistorydelete", "delete");
    loadjs.done("fhistorydelete");
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
<form name="fhistorydelete" id="fhistorydelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="history">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_history_id" class="history_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->netID->Visible) { // netID ?>
        <th class="<?= $Page->netID->headerCellClass() ?>"><span id="elh_history_netID" class="history_netID"><?= $Page->netID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_action->Visible) { // action ?>
        <th class="<?= $Page->_action->headerCellClass() ?>"><span id="elh_history__action" class="history__action"><?= $Page->_action->caption() ?></span></th>
<?php } ?>
<?php if ($Page->server->Visible) { // server ?>
        <th class="<?= $Page->server->headerCellClass() ?>"><span id="elh_history_server" class="history_server"><?= $Page->server->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_page->Visible) { // page ?>
        <th class="<?= $Page->_page->headerCellClass() ?>"><span id="elh_history__page" class="history__page"><?= $Page->_page->caption() ?></span></th>
<?php } ?>
<?php if ($Page->resourceName->Visible) { // resourceName ?>
        <th class="<?= $Page->resourceName->headerCellClass() ?>"><span id="elh_history_resourceName" class="history_resourceName"><?= $Page->resourceName->caption() ?></span></th>
<?php } ?>
<?php if ($Page->filePath->Visible) { // filePath ?>
        <th class="<?= $Page->filePath->headerCellClass() ?>"><span id="elh_history_filePath" class="history_filePath"><?= $Page->filePath->caption() ?></span></th>
<?php } ?>
<?php if ($Page->site->Visible) { // site ?>
        <th class="<?= $Page->site->headerCellClass() ?>"><span id="elh_history_site" class="history_site"><?= $Page->site->caption() ?></span></th>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <th class="<?= $Page->timestamp->headerCellClass() ?>"><span id="elh_history_timestamp" class="history_timestamp"><?= $Page->timestamp->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_history_id" class="history_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->netID->Visible) { // netID ?>
        <td <?= $Page->netID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_history_netID" class="history_netID">
<span<?= $Page->netID->viewAttributes() ?>>
<?= $Page->netID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_action->Visible) { // action ?>
        <td <?= $Page->_action->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_history__action" class="history__action">
<span<?= $Page->_action->viewAttributes() ?>>
<?= $Page->_action->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->server->Visible) { // server ?>
        <td <?= $Page->server->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_history_server" class="history_server">
<span<?= $Page->server->viewAttributes() ?>>
<?= $Page->server->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_page->Visible) { // page ?>
        <td <?= $Page->_page->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_history__page" class="history__page">
<span<?= $Page->_page->viewAttributes() ?>>
<?= $Page->_page->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->resourceName->Visible) { // resourceName ?>
        <td <?= $Page->resourceName->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_history_resourceName" class="history_resourceName">
<span<?= $Page->resourceName->viewAttributes() ?>>
<?= $Page->resourceName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->filePath->Visible) { // filePath ?>
        <td <?= $Page->filePath->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_history_filePath" class="history_filePath">
<span<?= $Page->filePath->viewAttributes() ?>>
<?= $Page->filePath->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->site->Visible) { // site ?>
        <td <?= $Page->site->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_history_site" class="history_site">
<span<?= $Page->site->viewAttributes() ?>>
<?= $Page->site->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <td <?= $Page->timestamp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_history_timestamp" class="history_timestamp">
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
