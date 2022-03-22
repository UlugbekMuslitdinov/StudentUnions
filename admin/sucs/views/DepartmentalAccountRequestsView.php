<?php

namespace PHPMaker2021\project4;

// Page object
$DepartmentalAccountRequestsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fdepartmental_account_requestsview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fdepartmental_account_requestsview = currentForm = new ew.Form("fdepartmental_account_requestsview", "view");
    loadjs.done("fdepartmental_account_requestsview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.departmental_account_requests) ew.vars.tables.departmental_account_requests = <?= JsonEncode(GetClientVar("tables", "departmental_account_requests")) ?>;
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
<form name="fdepartmental_account_requestsview" id="fdepartmental_account_requestsview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="departmental_account_requests">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_departmental_account_requests_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_departmental_account_requests_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->supervisor_name->Visible) { // supervisor_name ?>
    <tr id="r_supervisor_name">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_departmental_account_requests_supervisor_name"><?= $Page->supervisor_name->caption() ?></span></td>
        <td data-name="supervisor_name" <?= $Page->supervisor_name->cellAttributes() ?>>
<span id="el_departmental_account_requests_supervisor_name">
<span<?= $Page->supervisor_name->viewAttributes() ?>>
<?= $Page->supervisor_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->supervisor_phone->Visible) { // supervisor_phone ?>
    <tr id="r_supervisor_phone">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_departmental_account_requests_supervisor_phone"><?= $Page->supervisor_phone->caption() ?></span></td>
        <td data-name="supervisor_phone" <?= $Page->supervisor_phone->cellAttributes() ?>>
<span id="el_departmental_account_requests_supervisor_phone">
<span<?= $Page->supervisor_phone->viewAttributes() ?>>
<?= $Page->supervisor_phone->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->supervisor_email->Visible) { // supervisor_email ?>
    <tr id="r_supervisor_email">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_departmental_account_requests_supervisor_email"><?= $Page->supervisor_email->caption() ?></span></td>
        <td data-name="supervisor_email" <?= $Page->supervisor_email->cellAttributes() ?>>
<span id="el_departmental_account_requests_supervisor_email">
<span<?= $Page->supervisor_email->viewAttributes() ?>>
<?= $Page->supervisor_email->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->department->Visible) { // department ?>
    <tr id="r_department">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_departmental_account_requests_department"><?= $Page->department->caption() ?></span></td>
        <td data-name="department" <?= $Page->department->cellAttributes() ?>>
<span id="el_departmental_account_requests_department">
<span<?= $Page->department->viewAttributes() ?>>
<?= $Page->department->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->name_1->Visible) { // name_1 ?>
    <tr id="r_name_1">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_departmental_account_requests_name_1"><?= $Page->name_1->caption() ?></span></td>
        <td data-name="name_1" <?= $Page->name_1->cellAttributes() ?>>
<span id="el_departmental_account_requests_name_1">
<span<?= $Page->name_1->viewAttributes() ?>>
<?= $Page->name_1->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->name_2->Visible) { // name_2 ?>
    <tr id="r_name_2">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_departmental_account_requests_name_2"><?= $Page->name_2->caption() ?></span></td>
        <td data-name="name_2" <?= $Page->name_2->cellAttributes() ?>>
<span id="el_departmental_account_requests_name_2">
<span<?= $Page->name_2->viewAttributes() ?>>
<?= $Page->name_2->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->name_3->Visible) { // name_3 ?>
    <tr id="r_name_3">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_departmental_account_requests_name_3"><?= $Page->name_3->caption() ?></span></td>
        <td data-name="name_3" <?= $Page->name_3->cellAttributes() ?>>
<span id="el_departmental_account_requests_name_3">
<span<?= $Page->name_3->viewAttributes() ?>>
<?= $Page->name_3->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <tr id="r_description">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_departmental_account_requests_description"><?= $Page->description->caption() ?></span></td>
        <td data-name="description" <?= $Page->description->cellAttributes() ?>>
<span id="el_departmental_account_requests_description">
<span<?= $Page->description->viewAttributes() ?>>
<?= $Page->description->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
    <tr id="r_timestamp">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_departmental_account_requests_timestamp"><?= $Page->timestamp->caption() ?></span></td>
        <td data-name="timestamp" <?= $Page->timestamp->cellAttributes() ?>>
<span id="el_departmental_account_requests_timestamp">
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
