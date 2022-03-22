<?php

namespace PHPMaker2021\project4;

// Page object
$DepartmentalAccessRequestsDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fdepartmental_access_requestsdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fdepartmental_access_requestsdelete = currentForm = new ew.Form("fdepartmental_access_requestsdelete", "delete");
    loadjs.done("fdepartmental_access_requestsdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.departmental_access_requests) ew.vars.tables.departmental_access_requests = <?= JsonEncode(GetClientVar("tables", "departmental_access_requests")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fdepartmental_access_requestsdelete" id="fdepartmental_access_requestsdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="departmental_access_requests">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_departmental_access_requests_id" class="departmental_access_requests_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->supervisor_name->Visible) { // supervisor_name ?>
        <th class="<?= $Page->supervisor_name->headerCellClass() ?>"><span id="elh_departmental_access_requests_supervisor_name" class="departmental_access_requests_supervisor_name"><?= $Page->supervisor_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->supervisor_phone->Visible) { // supervisor_phone ?>
        <th class="<?= $Page->supervisor_phone->headerCellClass() ?>"><span id="elh_departmental_access_requests_supervisor_phone" class="departmental_access_requests_supervisor_phone"><?= $Page->supervisor_phone->caption() ?></span></th>
<?php } ?>
<?php if ($Page->supervisor_email->Visible) { // supervisor_email ?>
        <th class="<?= $Page->supervisor_email->headerCellClass() ?>"><span id="elh_departmental_access_requests_supervisor_email" class="departmental_access_requests_supervisor_email"><?= $Page->supervisor_email->caption() ?></span></th>
<?php } ?>
<?php if ($Page->employee_first_name->Visible) { // employee_first_name ?>
        <th class="<?= $Page->employee_first_name->headerCellClass() ?>"><span id="elh_departmental_access_requests_employee_first_name" class="departmental_access_requests_employee_first_name"><?= $Page->employee_first_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->employee_last_name->Visible) { // employee_last_name ?>
        <th class="<?= $Page->employee_last_name->headerCellClass() ?>"><span id="elh_departmental_access_requests_employee_last_name" class="departmental_access_requests_employee_last_name"><?= $Page->employee_last_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->employee_netid->Visible) { // employee_netid ?>
        <th class="<?= $Page->employee_netid->headerCellClass() ?>"><span id="elh_departmental_access_requests_employee_netid" class="departmental_access_requests_employee_netid"><?= $Page->employee_netid->caption() ?></span></th>
<?php } ?>
<?php if ($Page->new_catwork->Visible) { // new_catwork ?>
        <th class="<?= $Page->new_catwork->headerCellClass() ?>"><span id="elh_departmental_access_requests_new_catwork" class="departmental_access_requests_new_catwork"><?= $Page->new_catwork->caption() ?></span></th>
<?php } ?>
<?php if ($Page->delete->Visible) { // delete ?>
        <th class="<?= $Page->delete->headerCellClass() ?>"><span id="elh_departmental_access_requests_delete" class="departmental_access_requests_delete"><?= $Page->delete->caption() ?></span></th>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <th class="<?= $Page->timestamp->headerCellClass() ?>"><span id="elh_departmental_access_requests_timestamp" class="departmental_access_requests_timestamp"><?= $Page->timestamp->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_departmental_access_requests_id" class="departmental_access_requests_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->supervisor_name->Visible) { // supervisor_name ?>
        <td <?= $Page->supervisor_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_departmental_access_requests_supervisor_name" class="departmental_access_requests_supervisor_name">
<span<?= $Page->supervisor_name->viewAttributes() ?>>
<?= $Page->supervisor_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->supervisor_phone->Visible) { // supervisor_phone ?>
        <td <?= $Page->supervisor_phone->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_departmental_access_requests_supervisor_phone" class="departmental_access_requests_supervisor_phone">
<span<?= $Page->supervisor_phone->viewAttributes() ?>>
<?= $Page->supervisor_phone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->supervisor_email->Visible) { // supervisor_email ?>
        <td <?= $Page->supervisor_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_departmental_access_requests_supervisor_email" class="departmental_access_requests_supervisor_email">
<span<?= $Page->supervisor_email->viewAttributes() ?>>
<?= $Page->supervisor_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->employee_first_name->Visible) { // employee_first_name ?>
        <td <?= $Page->employee_first_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_departmental_access_requests_employee_first_name" class="departmental_access_requests_employee_first_name">
<span<?= $Page->employee_first_name->viewAttributes() ?>>
<?= $Page->employee_first_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->employee_last_name->Visible) { // employee_last_name ?>
        <td <?= $Page->employee_last_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_departmental_access_requests_employee_last_name" class="departmental_access_requests_employee_last_name">
<span<?= $Page->employee_last_name->viewAttributes() ?>>
<?= $Page->employee_last_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->employee_netid->Visible) { // employee_netid ?>
        <td <?= $Page->employee_netid->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_departmental_access_requests_employee_netid" class="departmental_access_requests_employee_netid">
<span<?= $Page->employee_netid->viewAttributes() ?>>
<?= $Page->employee_netid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->new_catwork->Visible) { // new_catwork ?>
        <td <?= $Page->new_catwork->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_departmental_access_requests_new_catwork" class="departmental_access_requests_new_catwork">
<span<?= $Page->new_catwork->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_new_catwork_<?= $Page->RowCount ?>" class="custom-control-input" value="<?= $Page->new_catwork->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->new_catwork->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_new_catwork_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
<?php } ?>
<?php if ($Page->delete->Visible) { // delete ?>
        <td <?= $Page->delete->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_departmental_access_requests_delete" class="departmental_access_requests_delete">
<span<?= $Page->delete->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_delete_<?= $Page->RowCount ?>" class="custom-control-input" value="<?= $Page->delete->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->delete->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_delete_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <td <?= $Page->timestamp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_departmental_access_requests_timestamp" class="departmental_access_requests_timestamp">
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
