<?php

namespace PHPMaker2021\project4;

// Page object
$PosAccessRequestsDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fpos_access_requestsdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fpos_access_requestsdelete = currentForm = new ew.Form("fpos_access_requestsdelete", "delete");
    loadjs.done("fpos_access_requestsdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.pos_access_requests) ew.vars.tables.pos_access_requests = <?= JsonEncode(GetClientVar("tables", "pos_access_requests")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fpos_access_requestsdelete" id="fpos_access_requestsdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pos_access_requests">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_pos_access_requests_id" class="pos_access_requests_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->supervisor_name->Visible) { // supervisor_name ?>
        <th class="<?= $Page->supervisor_name->headerCellClass() ?>"><span id="elh_pos_access_requests_supervisor_name" class="pos_access_requests_supervisor_name"><?= $Page->supervisor_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->supervisor_phone->Visible) { // supervisor_phone ?>
        <th class="<?= $Page->supervisor_phone->headerCellClass() ?>"><span id="elh_pos_access_requests_supervisor_phone" class="pos_access_requests_supervisor_phone"><?= $Page->supervisor_phone->caption() ?></span></th>
<?php } ?>
<?php if ($Page->request_type->Visible) { // request_type ?>
        <th class="<?= $Page->request_type->headerCellClass() ?>"><span id="elh_pos_access_requests_request_type" class="pos_access_requests_request_type"><?= $Page->request_type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->employee_position->Visible) { // employee_position ?>
        <th class="<?= $Page->employee_position->headerCellClass() ?>"><span id="elh_pos_access_requests_employee_position" class="pos_access_requests_employee_position"><?= $Page->employee_position->caption() ?></span></th>
<?php } ?>
<?php if ($Page->employee_first_name->Visible) { // employee_first_name ?>
        <th class="<?= $Page->employee_first_name->headerCellClass() ?>"><span id="elh_pos_access_requests_employee_first_name" class="pos_access_requests_employee_first_name"><?= $Page->employee_first_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->employee_last_name->Visible) { // employee_last_name ?>
        <th class="<?= $Page->employee_last_name->headerCellClass() ?>"><span id="elh_pos_access_requests_employee_last_name" class="pos_access_requests_employee_last_name"><?= $Page->employee_last_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->employee_title->Visible) { // employee_title ?>
        <th class="<?= $Page->employee_title->headerCellClass() ?>"><span id="elh_pos_access_requests_employee_title" class="pos_access_requests_employee_title"><?= $Page->employee_title->caption() ?></span></th>
<?php } ?>
<?php if ($Page->employee_email->Visible) { // employee_email ?>
        <th class="<?= $Page->employee_email->headerCellClass() ?>"><span id="elh_pos_access_requests_employee_email" class="pos_access_requests_employee_email"><?= $Page->employee_email->caption() ?></span></th>
<?php } ?>
<?php if ($Page->employee_phone->Visible) { // employee_phone ?>
        <th class="<?= $Page->employee_phone->headerCellClass() ?>"><span id="elh_pos_access_requests_employee_phone" class="pos_access_requests_employee_phone"><?= $Page->employee_phone->caption() ?></span></th>
<?php } ?>
<?php if ($Page->employee_unit->Visible) { // employee_unit ?>
        <th class="<?= $Page->employee_unit->headerCellClass() ?>"><span id="elh_pos_access_requests_employee_unit" class="pos_access_requests_employee_unit"><?= $Page->employee_unit->caption() ?></span></th>
<?php } ?>
<?php if ($Page->employee_netid->Visible) { // employee_netid ?>
        <th class="<?= $Page->employee_netid->headerCellClass() ?>"><span id="elh_pos_access_requests_employee_netid" class="pos_access_requests_employee_netid"><?= $Page->employee_netid->caption() ?></span></th>
<?php } ?>
<?php if ($Page->employee_id->Visible) { // employee_id ?>
        <th class="<?= $Page->employee_id->headerCellClass() ?>"><span id="elh_pos_access_requests_employee_id" class="pos_access_requests_employee_id"><?= $Page->employee_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->access->Visible) { // access ?>
        <th class="<?= $Page->access->headerCellClass() ?>"><span id="elh_pos_access_requests_access" class="pos_access_requests_access"><?= $Page->access->caption() ?></span></th>
<?php } ?>
<?php if ($Page->catcard->Visible) { // catcard ?>
        <th class="<?= $Page->catcard->headerCellClass() ?>"><span id="elh_pos_access_requests_catcard" class="pos_access_requests_catcard"><?= $Page->catcard->caption() ?></span></th>
<?php } ?>
<?php if ($Page->register_pin->Visible) { // register_pin ?>
        <th class="<?= $Page->register_pin->headerCellClass() ?>"><span id="elh_pos_access_requests_register_pin" class="pos_access_requests_register_pin"><?= $Page->register_pin->caption() ?></span></th>
<?php } ?>
<?php if ($Page->updates->Visible) { // updates ?>
        <th class="<?= $Page->updates->headerCellClass() ?>"><span id="elh_pos_access_requests_updates" class="pos_access_requests_updates"><?= $Page->updates->caption() ?></span></th>
<?php } ?>
<?php if ($Page->comments->Visible) { // comments ?>
        <th class="<?= $Page->comments->headerCellClass() ?>"><span id="elh_pos_access_requests_comments" class="pos_access_requests_comments"><?= $Page->comments->caption() ?></span></th>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <th class="<?= $Page->timestamp->headerCellClass() ?>"><span id="elh_pos_access_requests_timestamp" class="pos_access_requests_timestamp"><?= $Page->timestamp->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_pos_access_requests_id" class="pos_access_requests_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->supervisor_name->Visible) { // supervisor_name ?>
        <td <?= $Page->supervisor_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_supervisor_name" class="pos_access_requests_supervisor_name">
<span<?= $Page->supervisor_name->viewAttributes() ?>>
<?= $Page->supervisor_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->supervisor_phone->Visible) { // supervisor_phone ?>
        <td <?= $Page->supervisor_phone->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_supervisor_phone" class="pos_access_requests_supervisor_phone">
<span<?= $Page->supervisor_phone->viewAttributes() ?>>
<?= $Page->supervisor_phone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->request_type->Visible) { // request_type ?>
        <td <?= $Page->request_type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_request_type" class="pos_access_requests_request_type">
<span<?= $Page->request_type->viewAttributes() ?>>
<?= $Page->request_type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->employee_position->Visible) { // employee_position ?>
        <td <?= $Page->employee_position->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_employee_position" class="pos_access_requests_employee_position">
<span<?= $Page->employee_position->viewAttributes() ?>>
<?= $Page->employee_position->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->employee_first_name->Visible) { // employee_first_name ?>
        <td <?= $Page->employee_first_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_employee_first_name" class="pos_access_requests_employee_first_name">
<span<?= $Page->employee_first_name->viewAttributes() ?>>
<?= $Page->employee_first_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->employee_last_name->Visible) { // employee_last_name ?>
        <td <?= $Page->employee_last_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_employee_last_name" class="pos_access_requests_employee_last_name">
<span<?= $Page->employee_last_name->viewAttributes() ?>>
<?= $Page->employee_last_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->employee_title->Visible) { // employee_title ?>
        <td <?= $Page->employee_title->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_employee_title" class="pos_access_requests_employee_title">
<span<?= $Page->employee_title->viewAttributes() ?>>
<?= $Page->employee_title->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->employee_email->Visible) { // employee_email ?>
        <td <?= $Page->employee_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_employee_email" class="pos_access_requests_employee_email">
<span<?= $Page->employee_email->viewAttributes() ?>>
<?= $Page->employee_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->employee_phone->Visible) { // employee_phone ?>
        <td <?= $Page->employee_phone->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_employee_phone" class="pos_access_requests_employee_phone">
<span<?= $Page->employee_phone->viewAttributes() ?>>
<?= $Page->employee_phone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->employee_unit->Visible) { // employee_unit ?>
        <td <?= $Page->employee_unit->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_employee_unit" class="pos_access_requests_employee_unit">
<span<?= $Page->employee_unit->viewAttributes() ?>>
<?= $Page->employee_unit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->employee_netid->Visible) { // employee_netid ?>
        <td <?= $Page->employee_netid->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_employee_netid" class="pos_access_requests_employee_netid">
<span<?= $Page->employee_netid->viewAttributes() ?>>
<?= $Page->employee_netid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->employee_id->Visible) { // employee_id ?>
        <td <?= $Page->employee_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_employee_id" class="pos_access_requests_employee_id">
<span<?= $Page->employee_id->viewAttributes() ?>>
<?= $Page->employee_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->access->Visible) { // access ?>
        <td <?= $Page->access->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_access" class="pos_access_requests_access">
<span<?= $Page->access->viewAttributes() ?>>
<?= $Page->access->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->catcard->Visible) { // catcard ?>
        <td <?= $Page->catcard->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_catcard" class="pos_access_requests_catcard">
<span<?= $Page->catcard->viewAttributes() ?>>
<?= $Page->catcard->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->register_pin->Visible) { // register_pin ?>
        <td <?= $Page->register_pin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_register_pin" class="pos_access_requests_register_pin">
<span<?= $Page->register_pin->viewAttributes() ?>>
<?= $Page->register_pin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->updates->Visible) { // updates ?>
        <td <?= $Page->updates->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_updates" class="pos_access_requests_updates">
<span<?= $Page->updates->viewAttributes() ?>>
<?= $Page->updates->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->comments->Visible) { // comments ?>
        <td <?= $Page->comments->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_comments" class="pos_access_requests_comments">
<span<?= $Page->comments->viewAttributes() ?>>
<?= $Page->comments->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <td <?= $Page->timestamp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pos_access_requests_timestamp" class="pos_access_requests_timestamp">
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
