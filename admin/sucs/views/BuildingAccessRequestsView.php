<?php

namespace PHPMaker2021\project4;

// Page object
$BuildingAccessRequestsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fbuilding_access_requestsview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fbuilding_access_requestsview = currentForm = new ew.Form("fbuilding_access_requestsview", "view");
    loadjs.done("fbuilding_access_requestsview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.building_access_requests) ew.vars.tables.building_access_requests = <?= JsonEncode(GetClientVar("tables", "building_access_requests")) ?>;
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
<form name="fbuilding_access_requestsview" id="fbuilding_access_requestsview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="building_access_requests">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_building_access_requests_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_building_access_requests_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->form_type->Visible) { // form_type ?>
    <tr id="r_form_type">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_building_access_requests_form_type"><?= $Page->form_type->caption() ?></span></td>
        <td data-name="form_type" <?= $Page->form_type->cellAttributes() ?>>
<span id="el_building_access_requests_form_type">
<span<?= $Page->form_type->viewAttributes() ?>>
<?= $Page->form_type->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->supervisor_name->Visible) { // supervisor_name ?>
    <tr id="r_supervisor_name">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_building_access_requests_supervisor_name"><?= $Page->supervisor_name->caption() ?></span></td>
        <td data-name="supervisor_name" <?= $Page->supervisor_name->cellAttributes() ?>>
<span id="el_building_access_requests_supervisor_name">
<span<?= $Page->supervisor_name->viewAttributes() ?>>
<?= $Page->supervisor_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->supervisor_phone->Visible) { // supervisor_phone ?>
    <tr id="r_supervisor_phone">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_building_access_requests_supervisor_phone"><?= $Page->supervisor_phone->caption() ?></span></td>
        <td data-name="supervisor_phone" <?= $Page->supervisor_phone->cellAttributes() ?>>
<span id="el_building_access_requests_supervisor_phone">
<span<?= $Page->supervisor_phone->viewAttributes() ?>>
<?= $Page->supervisor_phone->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->employee_first_name->Visible) { // employee_first_name ?>
    <tr id="r_employee_first_name">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_building_access_requests_employee_first_name"><?= $Page->employee_first_name->caption() ?></span></td>
        <td data-name="employee_first_name" <?= $Page->employee_first_name->cellAttributes() ?>>
<span id="el_building_access_requests_employee_first_name">
<span<?= $Page->employee_first_name->viewAttributes() ?>>
<?= $Page->employee_first_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->employee_last_name->Visible) { // employee_last_name ?>
    <tr id="r_employee_last_name">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_building_access_requests_employee_last_name"><?= $Page->employee_last_name->caption() ?></span></td>
        <td data-name="employee_last_name" <?= $Page->employee_last_name->cellAttributes() ?>>
<span id="el_building_access_requests_employee_last_name">
<span<?= $Page->employee_last_name->viewAttributes() ?>>
<?= $Page->employee_last_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->catcard->Visible) { // catcard ?>
    <tr id="r_catcard">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_building_access_requests_catcard"><?= $Page->catcard->caption() ?></span></td>
        <td data-name="catcard" <?= $Page->catcard->cellAttributes() ?>>
<span id="el_building_access_requests_catcard">
<span<?= $Page->catcard->viewAttributes() ?>>
<?= $Page->catcard->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pin->Visible) { // pin ?>
    <tr id="r_pin">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_building_access_requests_pin"><?= $Page->pin->caption() ?></span></td>
        <td data-name="pin" <?= $Page->pin->cellAttributes() ?>>
<span id="el_building_access_requests_pin">
<span<?= $Page->pin->viewAttributes() ?>>
<?= $Page->pin->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->employee_unit->Visible) { // employee_unit ?>
    <tr id="r_employee_unit">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_building_access_requests_employee_unit"><?= $Page->employee_unit->caption() ?></span></td>
        <td data-name="employee_unit" <?= $Page->employee_unit->cellAttributes() ?>>
<span id="el_building_access_requests_employee_unit">
<span<?= $Page->employee_unit->viewAttributes() ?>>
<?= $Page->employee_unit->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->employee_id->Visible) { // employee_id ?>
    <tr id="r_employee_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_building_access_requests_employee_id"><?= $Page->employee_id->caption() ?></span></td>
        <td data-name="employee_id" <?= $Page->employee_id->cellAttributes() ?>>
<span id="el_building_access_requests_employee_id">
<span<?= $Page->employee_id->viewAttributes() ?>>
<?= $Page->employee_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->other_areas->Visible) { // other_areas ?>
    <tr id="r_other_areas">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_building_access_requests_other_areas"><?= $Page->other_areas->caption() ?></span></td>
        <td data-name="other_areas" <?= $Page->other_areas->cellAttributes() ?>>
<span id="el_building_access_requests_other_areas">
<span<?= $Page->other_areas->viewAttributes() ?>>
<?= $Page->other_areas->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->alarm_access->Visible) { // alarm_access ?>
    <tr id="r_alarm_access">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_building_access_requests_alarm_access"><?= $Page->alarm_access->caption() ?></span></td>
        <td data-name="alarm_access" <?= $Page->alarm_access->cellAttributes() ?>>
<span id="el_building_access_requests_alarm_access">
<span<?= $Page->alarm_access->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_alarm_access_<?= $Page->RowCount ?>" class="custom-control-input" value="<?= $Page->alarm_access->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->alarm_access->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_alarm_access_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->alarm_area->Visible) { // alarm_area ?>
    <tr id="r_alarm_area">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_building_access_requests_alarm_area"><?= $Page->alarm_area->caption() ?></span></td>
        <td data-name="alarm_area" <?= $Page->alarm_area->cellAttributes() ?>>
<span id="el_building_access_requests_alarm_area">
<span<?= $Page->alarm_area->viewAttributes() ?>>
<?= $Page->alarm_area->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->alarm_password->Visible) { // alarm_password ?>
    <tr id="r_alarm_password">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_building_access_requests_alarm_password"><?= $Page->alarm_password->caption() ?></span></td>
        <td data-name="alarm_password" <?= $Page->alarm_password->cellAttributes() ?>>
<span id="el_building_access_requests_alarm_password">
<span<?= $Page->alarm_password->viewAttributes() ?>>
<?= $Page->alarm_password->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->replacement_catcard->Visible) { // replacement_catcard ?>
    <tr id="r_replacement_catcard">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_building_access_requests_replacement_catcard"><?= $Page->replacement_catcard->caption() ?></span></td>
        <td data-name="replacement_catcard" <?= $Page->replacement_catcard->cellAttributes() ?>>
<span id="el_building_access_requests_replacement_catcard">
<span<?= $Page->replacement_catcard->viewAttributes() ?>>
<?= $Page->replacement_catcard->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->replacement_other->Visible) { // replacement_other ?>
    <tr id="r_replacement_other">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_building_access_requests_replacement_other"><?= $Page->replacement_other->caption() ?></span></td>
        <td data-name="replacement_other" <?= $Page->replacement_other->cellAttributes() ?>>
<span id="el_building_access_requests_replacement_other">
<span<?= $Page->replacement_other->viewAttributes() ?>>
<?= $Page->replacement_other->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->replacement_problem->Visible) { // replacement_problem ?>
    <tr id="r_replacement_problem">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_building_access_requests_replacement_problem"><?= $Page->replacement_problem->caption() ?></span></td>
        <td data-name="replacement_problem" <?= $Page->replacement_problem->cellAttributes() ?>>
<span id="el_building_access_requests_replacement_problem">
<span<?= $Page->replacement_problem->viewAttributes() ?>>
<?= $Page->replacement_problem->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->delete->Visible) { // delete ?>
    <tr id="r_delete">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_building_access_requests_delete"><?= $Page->delete->caption() ?></span></td>
        <td data-name="delete" <?= $Page->delete->cellAttributes() ?>>
<span id="el_building_access_requests_delete">
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
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_building_access_requests_timestamp"><?= $Page->timestamp->caption() ?></span></td>
        <td data-name="timestamp" <?= $Page->timestamp->cellAttributes() ?>>
<span id="el_building_access_requests_timestamp">
<span<?= $Page->timestamp->viewAttributes() ?>>
<?= $Page->timestamp->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->net_id->Visible) { // net_id ?>
    <tr id="r_net_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_building_access_requests_net_id"><?= $Page->net_id->caption() ?></span></td>
        <td data-name="net_id" <?= $Page->net_id->cellAttributes() ?>>
<span id="el_building_access_requests_net_id">
<span<?= $Page->net_id->viewAttributes() ?>>
<?= $Page->net_id->getViewValue() ?></span>
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
