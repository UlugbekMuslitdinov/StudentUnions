<?php

namespace PHPMaker2021\project4;

// Page object
$DepartmentalAccountRequestsDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fdepartmental_account_requestsdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fdepartmental_account_requestsdelete = currentForm = new ew.Form("fdepartmental_account_requestsdelete", "delete");
    loadjs.done("fdepartmental_account_requestsdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.departmental_account_requests) ew.vars.tables.departmental_account_requests = <?= JsonEncode(GetClientVar("tables", "departmental_account_requests")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fdepartmental_account_requestsdelete" id="fdepartmental_account_requestsdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="departmental_account_requests">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_departmental_account_requests_id" class="departmental_account_requests_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->supervisor_name->Visible) { // supervisor_name ?>
        <th class="<?= $Page->supervisor_name->headerCellClass() ?>"><span id="elh_departmental_account_requests_supervisor_name" class="departmental_account_requests_supervisor_name"><?= $Page->supervisor_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->supervisor_phone->Visible) { // supervisor_phone ?>
        <th class="<?= $Page->supervisor_phone->headerCellClass() ?>"><span id="elh_departmental_account_requests_supervisor_phone" class="departmental_account_requests_supervisor_phone"><?= $Page->supervisor_phone->caption() ?></span></th>
<?php } ?>
<?php if ($Page->supervisor_email->Visible) { // supervisor_email ?>
        <th class="<?= $Page->supervisor_email->headerCellClass() ?>"><span id="elh_departmental_account_requests_supervisor_email" class="departmental_account_requests_supervisor_email"><?= $Page->supervisor_email->caption() ?></span></th>
<?php } ?>
<?php if ($Page->department->Visible) { // department ?>
        <th class="<?= $Page->department->headerCellClass() ?>"><span id="elh_departmental_account_requests_department" class="departmental_account_requests_department"><?= $Page->department->caption() ?></span></th>
<?php } ?>
<?php if ($Page->name_1->Visible) { // name_1 ?>
        <th class="<?= $Page->name_1->headerCellClass() ?>"><span id="elh_departmental_account_requests_name_1" class="departmental_account_requests_name_1"><?= $Page->name_1->caption() ?></span></th>
<?php } ?>
<?php if ($Page->name_2->Visible) { // name_2 ?>
        <th class="<?= $Page->name_2->headerCellClass() ?>"><span id="elh_departmental_account_requests_name_2" class="departmental_account_requests_name_2"><?= $Page->name_2->caption() ?></span></th>
<?php } ?>
<?php if ($Page->name_3->Visible) { // name_3 ?>
        <th class="<?= $Page->name_3->headerCellClass() ?>"><span id="elh_departmental_account_requests_name_3" class="departmental_account_requests_name_3"><?= $Page->name_3->caption() ?></span></th>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
        <th class="<?= $Page->description->headerCellClass() ?>"><span id="elh_departmental_account_requests_description" class="departmental_account_requests_description"><?= $Page->description->caption() ?></span></th>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <th class="<?= $Page->timestamp->headerCellClass() ?>"><span id="elh_departmental_account_requests_timestamp" class="departmental_account_requests_timestamp"><?= $Page->timestamp->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_departmental_account_requests_id" class="departmental_account_requests_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->supervisor_name->Visible) { // supervisor_name ?>
        <td <?= $Page->supervisor_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_departmental_account_requests_supervisor_name" class="departmental_account_requests_supervisor_name">
<span<?= $Page->supervisor_name->viewAttributes() ?>>
<?= $Page->supervisor_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->supervisor_phone->Visible) { // supervisor_phone ?>
        <td <?= $Page->supervisor_phone->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_departmental_account_requests_supervisor_phone" class="departmental_account_requests_supervisor_phone">
<span<?= $Page->supervisor_phone->viewAttributes() ?>>
<?= $Page->supervisor_phone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->supervisor_email->Visible) { // supervisor_email ?>
        <td <?= $Page->supervisor_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_departmental_account_requests_supervisor_email" class="departmental_account_requests_supervisor_email">
<span<?= $Page->supervisor_email->viewAttributes() ?>>
<?= $Page->supervisor_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->department->Visible) { // department ?>
        <td <?= $Page->department->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_departmental_account_requests_department" class="departmental_account_requests_department">
<span<?= $Page->department->viewAttributes() ?>>
<?= $Page->department->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->name_1->Visible) { // name_1 ?>
        <td <?= $Page->name_1->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_departmental_account_requests_name_1" class="departmental_account_requests_name_1">
<span<?= $Page->name_1->viewAttributes() ?>>
<?= $Page->name_1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->name_2->Visible) { // name_2 ?>
        <td <?= $Page->name_2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_departmental_account_requests_name_2" class="departmental_account_requests_name_2">
<span<?= $Page->name_2->viewAttributes() ?>>
<?= $Page->name_2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->name_3->Visible) { // name_3 ?>
        <td <?= $Page->name_3->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_departmental_account_requests_name_3" class="departmental_account_requests_name_3">
<span<?= $Page->name_3->viewAttributes() ?>>
<?= $Page->name_3->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
        <td <?= $Page->description->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_departmental_account_requests_description" class="departmental_account_requests_description">
<span<?= $Page->description->viewAttributes() ?>>
<?= $Page->description->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <td <?= $Page->timestamp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_departmental_account_requests_timestamp" class="departmental_account_requests_timestamp">
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
