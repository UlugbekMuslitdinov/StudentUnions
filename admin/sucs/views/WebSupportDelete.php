<?php

namespace PHPMaker2021\project4;

// Page object
$WebSupportDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fweb_supportdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fweb_supportdelete = currentForm = new ew.Form("fweb_supportdelete", "delete");
    loadjs.done("fweb_supportdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.web_support) ew.vars.tables.web_support = <?= JsonEncode(GetClientVar("tables", "web_support")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fweb_supportdelete" id="fweb_supportdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="web_support">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_web_support_id" class="web_support_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->name_first->Visible) { // name_first ?>
        <th class="<?= $Page->name_first->headerCellClass() ?>"><span id="elh_web_support_name_first" class="web_support_name_first"><?= $Page->name_first->caption() ?></span></th>
<?php } ?>
<?php if ($Page->name_last->Visible) { // name_last ?>
        <th class="<?= $Page->name_last->headerCellClass() ?>"><span id="elh_web_support_name_last" class="web_support_name_last"><?= $Page->name_last->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <th class="<?= $Page->_email->headerCellClass() ?>"><span id="elh_web_support__email" class="web_support__email"><?= $Page->_email->caption() ?></span></th>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
        <th class="<?= $Page->phone->headerCellClass() ?>"><span id="elh_web_support_phone" class="web_support_phone"><?= $Page->phone->caption() ?></span></th>
<?php } ?>
<?php if ($Page->url->Visible) { // url ?>
        <th class="<?= $Page->url->headerCellClass() ?>"><span id="elh_web_support_url" class="web_support_url"><?= $Page->url->caption() ?></span></th>
<?php } ?>
<?php if ($Page->web_support_title->Visible) { // web_support_title ?>
        <th class="<?= $Page->web_support_title->headerCellClass() ?>"><span id="elh_web_support_web_support_title" class="web_support_web_support_title"><?= $Page->web_support_title->caption() ?></span></th>
<?php } ?>
<?php if ($Page->urgent->Visible) { // urgent ?>
        <th class="<?= $Page->urgent->headerCellClass() ?>"><span id="elh_web_support_urgent" class="web_support_urgent"><?= $Page->urgent->caption() ?></span></th>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <th class="<?= $Page->timestamp->headerCellClass() ?>"><span id="elh_web_support_timestamp" class="web_support_timestamp"><?= $Page->timestamp->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_web_support_id" class="web_support_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->name_first->Visible) { // name_first ?>
        <td <?= $Page->name_first->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_web_support_name_first" class="web_support_name_first">
<span<?= $Page->name_first->viewAttributes() ?>>
<?= $Page->name_first->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->name_last->Visible) { // name_last ?>
        <td <?= $Page->name_last->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_web_support_name_last" class="web_support_name_last">
<span<?= $Page->name_last->viewAttributes() ?>>
<?= $Page->name_last->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <td <?= $Page->_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_web_support__email" class="web_support__email">
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
        <td <?= $Page->phone->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_web_support_phone" class="web_support_phone">
<span<?= $Page->phone->viewAttributes() ?>>
<?= $Page->phone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->url->Visible) { // url ?>
        <td <?= $Page->url->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_web_support_url" class="web_support_url">
<span<?= $Page->url->viewAttributes() ?>>
<?= $Page->url->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->web_support_title->Visible) { // web_support_title ?>
        <td <?= $Page->web_support_title->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_web_support_web_support_title" class="web_support_web_support_title">
<span<?= $Page->web_support_title->viewAttributes() ?>>
<?= $Page->web_support_title->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->urgent->Visible) { // urgent ?>
        <td <?= $Page->urgent->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_web_support_urgent" class="web_support_urgent">
<span<?= $Page->urgent->viewAttributes() ?>>
<?= $Page->urgent->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <td <?= $Page->timestamp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_web_support_timestamp" class="web_support_timestamp">
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
