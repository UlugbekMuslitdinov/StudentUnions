<?php

namespace PHPMaker2021\project4;

// Page object
$BuildingAccessRequestsDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fbuilding_access_requestsdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fbuilding_access_requestsdelete = currentForm = new ew.Form("fbuilding_access_requestsdelete", "delete");
    loadjs.done("fbuilding_access_requestsdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.building_access_requests) ew.vars.tables.building_access_requests = <?= JsonEncode(GetClientVar("tables", "building_access_requests")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fbuilding_access_requestsdelete" id="fbuilding_access_requestsdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="building_access_requests">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_building_access_requests_id" class="building_access_requests_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->form_type->Visible) { // form_type ?>
        <th class="<?= $Page->form_type->headerCellClass() ?>"><span id="elh_building_access_requests_form_type" class="building_access_requests_form_type"><?= $Page->form_type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->supervisor_name->Visible) { // supervisor_name ?>
        <th class="<?= $Page->supervisor_name->headerCellClass() ?>"><span id="elh_building_access_requests_supervisor_name" class="building_access_requests_supervisor_name"><?= $Page->supervisor_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->supervisor_phone->Visible) { // supervisor_phone ?>
        <th class="<?= $Page->supervisor_phone->headerCellClass() ?>"><span id="elh_building_access_requests_supervisor_phone" class="building_access_requests_supervisor_phone"><?= $Page->supervisor_phone->caption() ?></span></th>
<?php } ?>
<?php if ($Page->employee_first_name->Visible) { // employee_first_name ?>
        <th class="<?= $Page->employee_first_name->headerCellClass() ?>"><span id="elh_building_access_requests_employee_first_name" class="building_access_requests_employee_first_name"><?= $Page->employee_first_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->employee_last_name->Visible) { // employee_last_name ?>
        <th class="<?= $Page->employee_last_name->headerCellClass() ?>"><span id="elh_building_access_requests_employee_last_name" class="building_access_requests_employee_last_name"><?= $Page->employee_last_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->catcard->Visible) { // catcard ?>
        <th class="<?= $Page->catcard->headerCellClass() ?>"><span id="elh_building_access_requests_catcard" class="building_access_requests_catcard"><?= $Page->catcard->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pin->Visible) { // pin ?>
        <th class="<?= $Page->pin->headerCellClass() ?>"><span id="elh_building_access_requests_pin" class="building_access_requests_pin"><?= $Page->pin->caption() ?></span></th>
<?php } ?>
<?php if ($Page->employee_unit->Visible) { // employee_unit ?>
        <th class="<?= $Page->employee_unit->headerCellClass() ?>"><span id="elh_building_access_requests_employee_unit" class="building_access_requests_employee_unit"><?= $Page->employee_unit->caption() ?></span></th>
<?php } ?>
<?php if ($Page->employee_id->Visible) { // employee_id ?>
        <th class="<?= $Page->employee_id->headerCellClass() ?>"><span id="elh_building_access_requests_employee_id" class="building_access_requests_employee_id"><?= $Page->employee_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->other_areas->Visible) { // other_areas ?>
        <th class="<?= $Page->other_areas->headerCellClass() ?>"><span id="elh_building_access_requests_other_areas" class="building_access_requests_other_areas"><?= $Page->other_areas->caption() ?></span></th>
<?php } ?>
<?php if ($Page->alarm_access->Visible) { // alarm_access ?>
        <th class="<?= $Page->alarm_access->headerCellClass() ?>"><span id="elh_building_access_requests_alarm_access" class="building_access_requests_alarm_access"><?= $Page->alarm_access->caption() ?></span></th>
<?php } ?>
<?php if ($Page->alarm_area->Visible) { // alarm_area ?>
        <th class="<?= $Page->alarm_area->headerCellClass() ?>"><span id="elh_building_access_requests_alarm_area" class="building_access_requests_alarm_area"><?= $Page->alarm_area->caption() ?></span></th>
<?php } ?>
<?php if ($Page->alarm_password->Visible) { // alarm_password ?>
        <th class="<?= $Page->alarm_password->headerCellClass() ?>"><span id="elh_building_access_requests_alarm_password" class="building_access_requests_alarm_password"><?= $Page->alarm_password->caption() ?></span></th>
<?php } ?>
<?php if ($Page->replacement_catcard->Visible) { // replacement_catcard ?>
        <th class="<?= $Page->replacement_catcard->headerCellClass() ?>"><span id="elh_building_access_requests_replacement_catcard" class="building_access_requests_replacement_catcard"><?= $Page->replacement_catcard->caption() ?></span></th>
<?php } ?>
<?php if ($Page->replacement_other->Visible) { // replacement_other ?>
        <th class="<?= $Page->replacement_other->headerCellClass() ?>"><span id="elh_building_access_requests_replacement_other" class="building_access_requests_replacement_other"><?= $Page->replacement_other->caption() ?></span></th>
<?php } ?>
<?php if ($Page->replacement_problem->Visible) { // replacement_problem ?>
        <th class="<?= $Page->replacement_problem->headerCellClass() ?>"><span id="elh_building_access_requests_replacement_problem" class="building_access_requests_replacement_problem"><?= $Page->replacement_problem->caption() ?></span></th>
<?php } ?>
<?php if ($Page->delete->Visible) { // delete ?>
        <th class="<?= $Page->delete->headerCellClass() ?>"><span id="elh_building_access_requests_delete" class="building_access_requests_delete"><?= $Page->delete->caption() ?></span></th>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <th class="<?= $Page->timestamp->headerCellClass() ?>"><span id="elh_building_access_requests_timestamp" class="building_access_requests_timestamp"><?= $Page->timestamp->caption() ?></span></th>
<?php } ?>
<?php if ($Page->net_id->Visible) { // net_id ?>
        <th class="<?= $Page->net_id->headerCellClass() ?>"><span id="elh_building_access_requests_net_id" class="building_access_requests_net_id"><?= $Page->net_id->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_building_access_requests_id" class="building_access_requests_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->form_type->Visible) { // form_type ?>
        <td <?= $Page->form_type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_building_access_requests_form_type" class="building_access_requests_form_type">
<span<?= $Page->form_type->viewAttributes() ?>>
<?= $Page->form_type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->supervisor_name->Visible) { // supervisor_name ?>
        <td <?= $Page->supervisor_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_building_access_requests_supervisor_name" class="building_access_requests_supervisor_name">
<span<?= $Page->supervisor_name->viewAttributes() ?>>
<?= $Page->supervisor_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->supervisor_phone->Visible) { // supervisor_phone ?>
        <td <?= $Page->supervisor_phone->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_building_access_requests_supervisor_phone" class="building_access_requests_supervisor_phone">
<span<?= $Page->supervisor_phone->viewAttributes() ?>>
<?= $Page->supervisor_phone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->employee_first_name->Visible) { // employee_first_name ?>
        <td <?= $Page->employee_first_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_building_access_requests_employee_first_name" class="building_access_requests_employee_first_name">
<span<?= $Page->employee_first_name->viewAttributes() ?>>
<?= $Page->employee_first_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->employee_last_name->Visible) { // employee_last_name ?>
        <td <?= $Page->employee_last_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_building_access_requests_employee_last_name" class="building_access_requests_employee_last_name">
<span<?= $Page->employee_last_name->viewAttributes() ?>>
<?= $Page->employee_last_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->catcard->Visible) { // catcard ?>
        <td <?= $Page->catcard->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_building_access_requests_catcard" class="building_access_requests_catcard">
<span<?= $Page->catcard->viewAttributes() ?>>
<?= $Page->catcard->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pin->Visible) { // pin ?>
        <td <?= $Page->pin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_building_access_requests_pin" class="building_access_requests_pin">
<span<?= $Page->pin->viewAttributes() ?>>
<?= $Page->pin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->employee_unit->Visible) { // employee_unit ?>
        <td <?= $Page->employee_unit->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_building_access_requests_employee_unit" class="building_access_requests_employee_unit">
<span<?= $Page->employee_unit->viewAttributes() ?>>
<?= $Page->employee_unit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->employee_id->Visible) { // employee_id ?>
        <td <?= $Page->employee_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_building_access_requests_employee_id" class="building_access_requests_employee_id">
<span<?= $Page->employee_id->viewAttributes() ?>>
<?= $Page->employee_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->other_areas->Visible) { // other_areas ?>
        <td <?= $Page->other_areas->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_building_access_requests_other_areas" class="building_access_requests_other_areas">
<span<?= $Page->other_areas->viewAttributes() ?>>
<?= $Page->other_areas->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->alarm_access->Visible) { // alarm_access ?>
        <td <?= $Page->alarm_access->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_building_access_requests_alarm_access" class="building_access_requests_alarm_access">
<span<?= $Page->alarm_access->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_alarm_access_<?= $Page->RowCount ?>" class="custom-control-input" value="<?= $Page->alarm_access->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->alarm_access->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_alarm_access_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
<?php } ?>
<?php if ($Page->alarm_area->Visible) { // alarm_area ?>
        <td <?= $Page->alarm_area->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_building_access_requests_alarm_area" class="building_access_requests_alarm_area">
<span<?= $Page->alarm_area->viewAttributes() ?>>
<?= $Page->alarm_area->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->alarm_password->Visible) { // alarm_password ?>
        <td <?= $Page->alarm_password->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_building_access_requests_alarm_password" class="building_access_requests_alarm_password">
<span<?= $Page->alarm_password->viewAttributes() ?>>
<?= $Page->alarm_password->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->replacement_catcard->Visible) { // replacement_catcard ?>
        <td <?= $Page->replacement_catcard->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_building_access_requests_replacement_catcard" class="building_access_requests_replacement_catcard">
<span<?= $Page->replacement_catcard->viewAttributes() ?>>
<?= $Page->replacement_catcard->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->replacement_other->Visible) { // replacement_other ?>
        <td <?= $Page->replacement_other->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_building_access_requests_replacement_other" class="building_access_requests_replacement_other">
<span<?= $Page->replacement_other->viewAttributes() ?>>
<?= $Page->replacement_other->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->replacement_problem->Visible) { // replacement_problem ?>
        <td <?= $Page->replacement_problem->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_building_access_requests_replacement_problem" class="building_access_requests_replacement_problem">
<span<?= $Page->replacement_problem->viewAttributes() ?>>
<?= $Page->replacement_problem->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->delete->Visible) { // delete ?>
        <td <?= $Page->delete->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_building_access_requests_delete" class="building_access_requests_delete">
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
<span id="el<?= $Page->RowCount ?>_building_access_requests_timestamp" class="building_access_requests_timestamp">
<span<?= $Page->timestamp->viewAttributes() ?>>
<?= $Page->timestamp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->net_id->Visible) { // net_id ?>
        <td <?= $Page->net_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_building_access_requests_net_id" class="building_access_requests_net_id">
<span<?= $Page->net_id->viewAttributes() ?>>
<?= $Page->net_id->getViewValue() ?></span>
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
