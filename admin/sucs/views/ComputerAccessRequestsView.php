<?php

namespace PHPMaker2021\project4;

// Page object
$ComputerAccessRequestsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fcomputer_access_requestsview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fcomputer_access_requestsview = currentForm = new ew.Form("fcomputer_access_requestsview", "view");
    loadjs.done("fcomputer_access_requestsview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.computer_access_requests) ew.vars.tables.computer_access_requests = <?= JsonEncode(GetClientVar("tables", "computer_access_requests")) ?>;
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
<form name="fcomputer_access_requestsview" id="fcomputer_access_requestsview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="computer_access_requests">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_computer_access_requests_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_computer_access_requests_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->supervisor_name->Visible) { // supervisor_name ?>
    <tr id="r_supervisor_name">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_computer_access_requests_supervisor_name"><?= $Page->supervisor_name->caption() ?></span></td>
        <td data-name="supervisor_name" <?= $Page->supervisor_name->cellAttributes() ?>>
<span id="el_computer_access_requests_supervisor_name">
<span<?= $Page->supervisor_name->viewAttributes() ?>>
<?= $Page->supervisor_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->supervisor_phone->Visible) { // supervisor_phone ?>
    <tr id="r_supervisor_phone">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_computer_access_requests_supervisor_phone"><?= $Page->supervisor_phone->caption() ?></span></td>
        <td data-name="supervisor_phone" <?= $Page->supervisor_phone->cellAttributes() ?>>
<span id="el_computer_access_requests_supervisor_phone">
<span<?= $Page->supervisor_phone->viewAttributes() ?>>
<?= $Page->supervisor_phone->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->employee_type->Visible) { // employee_type ?>
    <tr id="r_employee_type">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_computer_access_requests_employee_type"><?= $Page->employee_type->caption() ?></span></td>
        <td data-name="employee_type" <?= $Page->employee_type->cellAttributes() ?>>
<span id="el_computer_access_requests_employee_type">
<span<?= $Page->employee_type->viewAttributes() ?>>
<?= $Page->employee_type->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->employee_position->Visible) { // employee_position ?>
    <tr id="r_employee_position">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_computer_access_requests_employee_position"><?= $Page->employee_position->caption() ?></span></td>
        <td data-name="employee_position" <?= $Page->employee_position->cellAttributes() ?>>
<span id="el_computer_access_requests_employee_position">
<span<?= $Page->employee_position->viewAttributes() ?>>
<?= $Page->employee_position->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->employee_first_name->Visible) { // employee_first_name ?>
    <tr id="r_employee_first_name">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_computer_access_requests_employee_first_name"><?= $Page->employee_first_name->caption() ?></span></td>
        <td data-name="employee_first_name" <?= $Page->employee_first_name->cellAttributes() ?>>
<span id="el_computer_access_requests_employee_first_name">
<span<?= $Page->employee_first_name->viewAttributes() ?>>
<?= $Page->employee_first_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->employee_last_name->Visible) { // employee_last_name ?>
    <tr id="r_employee_last_name">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_computer_access_requests_employee_last_name"><?= $Page->employee_last_name->caption() ?></span></td>
        <td data-name="employee_last_name" <?= $Page->employee_last_name->cellAttributes() ?>>
<span id="el_computer_access_requests_employee_last_name">
<span<?= $Page->employee_last_name->viewAttributes() ?>>
<?= $Page->employee_last_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->employee_title->Visible) { // employee_title ?>
    <tr id="r_employee_title">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_computer_access_requests_employee_title"><?= $Page->employee_title->caption() ?></span></td>
        <td data-name="employee_title" <?= $Page->employee_title->cellAttributes() ?>>
<span id="el_computer_access_requests_employee_title">
<span<?= $Page->employee_title->viewAttributes() ?>>
<?= $Page->employee_title->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->employee_email->Visible) { // employee_email ?>
    <tr id="r_employee_email">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_computer_access_requests_employee_email"><?= $Page->employee_email->caption() ?></span></td>
        <td data-name="employee_email" <?= $Page->employee_email->cellAttributes() ?>>
<span id="el_computer_access_requests_employee_email">
<span<?= $Page->employee_email->viewAttributes() ?>>
<?= $Page->employee_email->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->employee_phone->Visible) { // employee_phone ?>
    <tr id="r_employee_phone">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_computer_access_requests_employee_phone"><?= $Page->employee_phone->caption() ?></span></td>
        <td data-name="employee_phone" <?= $Page->employee_phone->cellAttributes() ?>>
<span id="el_computer_access_requests_employee_phone">
<span<?= $Page->employee_phone->viewAttributes() ?>>
<?= $Page->employee_phone->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->employee_unit->Visible) { // employee_unit ?>
    <tr id="r_employee_unit">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_computer_access_requests_employee_unit"><?= $Page->employee_unit->caption() ?></span></td>
        <td data-name="employee_unit" <?= $Page->employee_unit->cellAttributes() ?>>
<span id="el_computer_access_requests_employee_unit">
<span<?= $Page->employee_unit->viewAttributes() ?>>
<?= $Page->employee_unit->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->employee_netid->Visible) { // employee_netid ?>
    <tr id="r_employee_netid">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_computer_access_requests_employee_netid"><?= $Page->employee_netid->caption() ?></span></td>
        <td data-name="employee_netid" <?= $Page->employee_netid->cellAttributes() ?>>
<span id="el_computer_access_requests_employee_netid">
<span<?= $Page->employee_netid->viewAttributes() ?>>
<?= $Page->employee_netid->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->employee_id->Visible) { // employee_id ?>
    <tr id="r_employee_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_computer_access_requests_employee_id"><?= $Page->employee_id->caption() ?></span></td>
        <td data-name="employee_id" <?= $Page->employee_id->cellAttributes() ?>>
<span id="el_computer_access_requests_employee_id">
<span<?= $Page->employee_id->viewAttributes() ?>>
<?= $Page->employee_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
    <tr id="r_location">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_computer_access_requests_location"><?= $Page->location->caption() ?></span></td>
        <td data-name="location" <?= $Page->location->cellAttributes() ?>>
<span id="el_computer_access_requests_location">
<span<?= $Page->location->viewAttributes() ?>>
<?= $Page->location->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->access->Visible) { // access ?>
    <tr id="r_access">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_computer_access_requests_access"><?= $Page->access->caption() ?></span></td>
        <td data-name="access" <?= $Page->access->cellAttributes() ?>>
<span id="el_computer_access_requests_access">
<span<?= $Page->access->viewAttributes() ?>>
<?= $Page->access->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->foodpro_location->Visible) { // foodpro_location ?>
    <tr id="r_foodpro_location">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_computer_access_requests_foodpro_location"><?= $Page->foodpro_location->caption() ?></span></td>
        <td data-name="foodpro_location" <?= $Page->foodpro_location->cellAttributes() ?>>
<span id="el_computer_access_requests_foodpro_location">
<span<?= $Page->foodpro_location->viewAttributes() ?>>
<?= $Page->foodpro_location->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->catcard->Visible) { // catcard ?>
    <tr id="r_catcard">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_computer_access_requests_catcard"><?= $Page->catcard->caption() ?></span></td>
        <td data-name="catcard" <?= $Page->catcard->cellAttributes() ?>>
<span id="el_computer_access_requests_catcard">
<span<?= $Page->catcard->viewAttributes() ?>>
<?= $Page->catcard->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->register_pin->Visible) { // register_pin ?>
    <tr id="r_register_pin">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_computer_access_requests_register_pin"><?= $Page->register_pin->caption() ?></span></td>
        <td data-name="register_pin" <?= $Page->register_pin->cellAttributes() ?>>
<span id="el_computer_access_requests_register_pin">
<span<?= $Page->register_pin->viewAttributes() ?>>
<?= $Page->register_pin->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->other->Visible) { // other ?>
    <tr id="r_other">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_computer_access_requests_other"><?= $Page->other->caption() ?></span></td>
        <td data-name="other" <?= $Page->other->cellAttributes() ?>>
<span id="el_computer_access_requests_other">
<span<?= $Page->other->viewAttributes() ?>>
<?= $Page->other->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
    <tr id="r_timestamp">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_computer_access_requests_timestamp"><?= $Page->timestamp->caption() ?></span></td>
        <td data-name="timestamp" <?= $Page->timestamp->cellAttributes() ?>>
<span id="el_computer_access_requests_timestamp">
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
