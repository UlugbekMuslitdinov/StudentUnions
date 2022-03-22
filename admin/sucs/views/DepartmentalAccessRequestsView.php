<?php

namespace PHPMaker2021\project4;

// Page object
$DepartmentalAccessRequestsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fdepartmental_access_requestsview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fdepartmental_access_requestsview = currentForm = new ew.Form("fdepartmental_access_requestsview", "view");
    loadjs.done("fdepartmental_access_requestsview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.departmental_access_requests) ew.vars.tables.departmental_access_requests = <?= JsonEncode(GetClientVar("tables", "departmental_access_requests")) ?>;
</script>
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
<form name="fdepartmental_access_requestsview" id="fdepartmental_access_requestsview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="departmental_access_requests">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_departmental_access_requests_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_departmental_access_requests_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->supervisor_name->Visible) { // supervisor_name ?>
    <tr id="r_supervisor_name">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_departmental_access_requests_supervisor_name"><?= $Page->supervisor_name->caption() ?></span></td>
        <td data-name="supervisor_name" <?= $Page->supervisor_name->cellAttributes() ?>>
<span id="el_departmental_access_requests_supervisor_name">
<span<?= $Page->supervisor_name->viewAttributes() ?>>
<?= $Page->supervisor_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->supervisor_phone->Visible) { // supervisor_phone ?>
    <tr id="r_supervisor_phone">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_departmental_access_requests_supervisor_phone"><?= $Page->supervisor_phone->caption() ?></span></td>
        <td data-name="supervisor_phone" <?= $Page->supervisor_phone->cellAttributes() ?>>
<span id="el_departmental_access_requests_supervisor_phone">
<span<?= $Page->supervisor_phone->viewAttributes() ?>>
<?= $Page->supervisor_phone->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->supervisor_email->Visible) { // supervisor_email ?>
    <tr id="r_supervisor_email">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_departmental_access_requests_supervisor_email"><?= $Page->supervisor_email->caption() ?></span></td>
        <td data-name="supervisor_email" <?= $Page->supervisor_email->cellAttributes() ?>>
<span id="el_departmental_access_requests_supervisor_email">
<span<?= $Page->supervisor_email->viewAttributes() ?>>
<?= $Page->supervisor_email->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->employee_first_name->Visible) { // employee_first_name ?>
    <tr id="r_employee_first_name">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_departmental_access_requests_employee_first_name"><?= $Page->employee_first_name->caption() ?></span></td>
        <td data-name="employee_first_name" <?= $Page->employee_first_name->cellAttributes() ?>>
<span id="el_departmental_access_requests_employee_first_name">
<span<?= $Page->employee_first_name->viewAttributes() ?>>
<?= $Page->employee_first_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->employee_last_name->Visible) { // employee_last_name ?>
    <tr id="r_employee_last_name">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_departmental_access_requests_employee_last_name"><?= $Page->employee_last_name->caption() ?></span></td>
        <td data-name="employee_last_name" <?= $Page->employee_last_name->cellAttributes() ?>>
<span id="el_departmental_access_requests_employee_last_name">
<span<?= $Page->employee_last_name->viewAttributes() ?>>
<?= $Page->employee_last_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->employee_netid->Visible) { // employee_netid ?>
    <tr id="r_employee_netid">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_departmental_access_requests_employee_netid"><?= $Page->employee_netid->caption() ?></span></td>
        <td data-name="employee_netid" <?= $Page->employee_netid->cellAttributes() ?>>
<span id="el_departmental_access_requests_employee_netid">
<span<?= $Page->employee_netid->viewAttributes() ?>>
<?= $Page->employee_netid->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->new_catwork->Visible) { // new_catwork ?>
    <tr id="r_new_catwork">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_departmental_access_requests_new_catwork"><?= $Page->new_catwork->caption() ?></span></td>
        <td data-name="new_catwork" <?= $Page->new_catwork->cellAttributes() ?>>
<span id="el_departmental_access_requests_new_catwork">
<span<?= $Page->new_catwork->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_new_catwork_<?= $Page->RowCount ?>" class="custom-control-input" value="<?= $Page->new_catwork->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->new_catwork->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_new_catwork_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->delete->Visible) { // delete ?>
    <tr id="r_delete">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_departmental_access_requests_delete"><?= $Page->delete->caption() ?></span></td>
        <td data-name="delete" <?= $Page->delete->cellAttributes() ?>>
<span id="el_departmental_access_requests_delete">
<span<?= $Page->delete->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_delete_<?= $Page->RowCount ?>" class="custom-control-input" value="<?= $Page->delete->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->delete->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_delete_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
    <tr id="r_timestamp">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_departmental_access_requests_timestamp"><?= $Page->timestamp->caption() ?></span></td>
        <td data-name="timestamp" <?= $Page->timestamp->cellAttributes() ?>>
<span id="el_departmental_access_requests_timestamp">
<span<?= $Page->timestamp->viewAttributes() ?>>
<?= $Page->timestamp->getViewValue() ?></span>
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
