<?php

namespace PHPMaker2021\project4;

// Page object
$PhoneRequestsDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fphone_requestsdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fphone_requestsdelete = currentForm = new ew.Form("fphone_requestsdelete", "delete");
    loadjs.done("fphone_requestsdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.phone_requests) ew.vars.tables.phone_requests = <?= JsonEncode(GetClientVar("tables", "phone_requests")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fphone_requestsdelete" id="fphone_requestsdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="phone_requests">
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
<?php if ($Page->supervisor_name->Visible) { // supervisor_name ?>
        <th class="<?= $Page->supervisor_name->headerCellClass() ?>"><span id="elh_phone_requests_supervisor_name" class="phone_requests_supervisor_name"><?= $Page->supervisor_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->supervisor_phone->Visible) { // supervisor_phone ?>
        <th class="<?= $Page->supervisor_phone->headerCellClass() ?>"><span id="elh_phone_requests_supervisor_phone" class="phone_requests_supervisor_phone"><?= $Page->supervisor_phone->caption() ?></span></th>
<?php } ?>
<?php if ($Page->employee_status->Visible) { // employee_status ?>
        <th class="<?= $Page->employee_status->headerCellClass() ?>"><span id="elh_phone_requests_employee_status" class="phone_requests_employee_status"><?= $Page->employee_status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->building->Visible) { // building ?>
        <th class="<?= $Page->building->headerCellClass() ?>"><span id="elh_phone_requests_building" class="phone_requests_building"><?= $Page->building->caption() ?></span></th>
<?php } ?>
<?php if ($Page->room_number->Visible) { // room_number ?>
        <th class="<?= $Page->room_number->headerCellClass() ?>"><span id="elh_phone_requests_room_number" class="phone_requests_room_number"><?= $Page->room_number->caption() ?></span></th>
<?php } ?>
<?php if ($Page->net_id->Visible) { // net_id ?>
        <th class="<?= $Page->net_id->headerCellClass() ?>"><span id="elh_phone_requests_net_id" class="phone_requests_net_id"><?= $Page->net_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jack->Visible) { // jack ?>
        <th class="<?= $Page->jack->headerCellClass() ?>"><span id="elh_phone_requests_jack" class="phone_requests_jack"><?= $Page->jack->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jack_id->Visible) { // jack_id ?>
        <th class="<?= $Page->jack_id->headerCellClass() ?>"><span id="elh_phone_requests_jack_id" class="phone_requests_jack_id"><?= $Page->jack_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->voicemail->Visible) { // voicemail ?>
        <th class="<?= $Page->voicemail->headerCellClass() ?>"><span id="elh_phone_requests_voicemail" class="phone_requests_voicemail"><?= $Page->voicemail->caption() ?></span></th>
<?php } ?>
<?php if ($Page->long_distance->Visible) { // long_distance ?>
        <th class="<?= $Page->long_distance->headerCellClass() ?>"><span id="elh_phone_requests_long_distance" class="phone_requests_long_distance"><?= $Page->long_distance->caption() ?></span></th>
<?php } ?>
<?php if ($Page->need_phone->Visible) { // need_phone ?>
        <th class="<?= $Page->need_phone->headerCellClass() ?>"><span id="elh_phone_requests_need_phone" class="phone_requests_need_phone"><?= $Page->need_phone->caption() ?></span></th>
<?php } ?>
<?php if ($Page->call_appearance->Visible) { // call_appearance ?>
        <th class="<?= $Page->call_appearance->headerCellClass() ?>"><span id="elh_phone_requests_call_appearance" class="phone_requests_call_appearance"><?= $Page->call_appearance->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kfs_number->Visible) { // kfs_number ?>
        <th class="<?= $Page->kfs_number->headerCellClass() ?>"><span id="elh_phone_requests_kfs_number" class="phone_requests_kfs_number"><?= $Page->kfs_number->caption() ?></span></th>
<?php } ?>
<?php if ($Page->call_appearance1->Visible) { // call_appearance1 ?>
        <th class="<?= $Page->call_appearance1->headerCellClass() ?>"><span id="elh_phone_requests_call_appearance1" class="phone_requests_call_appearance1"><?= $Page->call_appearance1->caption() ?></span></th>
<?php } ?>
<?php if ($Page->call_appearance2->Visible) { // call_appearance2 ?>
        <th class="<?= $Page->call_appearance2->headerCellClass() ?>"><span id="elh_phone_requests_call_appearance2" class="phone_requests_call_appearance2"><?= $Page->call_appearance2->caption() ?></span></th>
<?php } ?>
<?php if ($Page->call_appearance3->Visible) { // call_appearance3 ?>
        <th class="<?= $Page->call_appearance3->headerCellClass() ?>"><span id="elh_phone_requests_call_appearance3" class="phone_requests_call_appearance3"><?= $Page->call_appearance3->caption() ?></span></th>
<?php } ?>
<?php if ($Page->call_appearance4->Visible) { // call_appearance4 ?>
        <th class="<?= $Page->call_appearance4->headerCellClass() ?>"><span id="elh_phone_requests_call_appearance4" class="phone_requests_call_appearance4"><?= $Page->call_appearance4->caption() ?></span></th>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <th class="<?= $Page->timestamp->headerCellClass() ?>"><span id="elh_phone_requests_timestamp" class="phone_requests_timestamp"><?= $Page->timestamp->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ID->Visible) { // ID ?>
        <th class="<?= $Page->ID->headerCellClass() ?>"><span id="elh_phone_requests_ID" class="phone_requests_ID"><?= $Page->ID->caption() ?></span></th>
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
<?php if ($Page->supervisor_name->Visible) { // supervisor_name ?>
        <td <?= $Page->supervisor_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_supervisor_name" class="phone_requests_supervisor_name">
<span<?= $Page->supervisor_name->viewAttributes() ?>>
<?= $Page->supervisor_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->supervisor_phone->Visible) { // supervisor_phone ?>
        <td <?= $Page->supervisor_phone->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_supervisor_phone" class="phone_requests_supervisor_phone">
<span<?= $Page->supervisor_phone->viewAttributes() ?>>
<?= $Page->supervisor_phone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->employee_status->Visible) { // employee_status ?>
        <td <?= $Page->employee_status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_employee_status" class="phone_requests_employee_status">
<span<?= $Page->employee_status->viewAttributes() ?>>
<?= $Page->employee_status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->building->Visible) { // building ?>
        <td <?= $Page->building->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_building" class="phone_requests_building">
<span<?= $Page->building->viewAttributes() ?>>
<?= $Page->building->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->room_number->Visible) { // room_number ?>
        <td <?= $Page->room_number->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_room_number" class="phone_requests_room_number">
<span<?= $Page->room_number->viewAttributes() ?>>
<?= $Page->room_number->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->net_id->Visible) { // net_id ?>
        <td <?= $Page->net_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_net_id" class="phone_requests_net_id">
<span<?= $Page->net_id->viewAttributes() ?>>
<?= $Page->net_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jack->Visible) { // jack ?>
        <td <?= $Page->jack->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_jack" class="phone_requests_jack">
<span<?= $Page->jack->viewAttributes() ?>>
<?= $Page->jack->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jack_id->Visible) { // jack_id ?>
        <td <?= $Page->jack_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_jack_id" class="phone_requests_jack_id">
<span<?= $Page->jack_id->viewAttributes() ?>>
<?= $Page->jack_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->voicemail->Visible) { // voicemail ?>
        <td <?= $Page->voicemail->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_voicemail" class="phone_requests_voicemail">
<span<?= $Page->voicemail->viewAttributes() ?>>
<?= $Page->voicemail->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->long_distance->Visible) { // long_distance ?>
        <td <?= $Page->long_distance->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_long_distance" class="phone_requests_long_distance">
<span<?= $Page->long_distance->viewAttributes() ?>>
<?= $Page->long_distance->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->need_phone->Visible) { // need_phone ?>
        <td <?= $Page->need_phone->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_need_phone" class="phone_requests_need_phone">
<span<?= $Page->need_phone->viewAttributes() ?>>
<?= $Page->need_phone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->call_appearance->Visible) { // call_appearance ?>
        <td <?= $Page->call_appearance->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_call_appearance" class="phone_requests_call_appearance">
<span<?= $Page->call_appearance->viewAttributes() ?>>
<?= $Page->call_appearance->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kfs_number->Visible) { // kfs_number ?>
        <td <?= $Page->kfs_number->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_kfs_number" class="phone_requests_kfs_number">
<span<?= $Page->kfs_number->viewAttributes() ?>>
<?= $Page->kfs_number->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->call_appearance1->Visible) { // call_appearance1 ?>
        <td <?= $Page->call_appearance1->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_call_appearance1" class="phone_requests_call_appearance1">
<span<?= $Page->call_appearance1->viewAttributes() ?>>
<?= $Page->call_appearance1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->call_appearance2->Visible) { // call_appearance2 ?>
        <td <?= $Page->call_appearance2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_call_appearance2" class="phone_requests_call_appearance2">
<span<?= $Page->call_appearance2->viewAttributes() ?>>
<?= $Page->call_appearance2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->call_appearance3->Visible) { // call_appearance3 ?>
        <td <?= $Page->call_appearance3->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_call_appearance3" class="phone_requests_call_appearance3">
<span<?= $Page->call_appearance3->viewAttributes() ?>>
<?= $Page->call_appearance3->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->call_appearance4->Visible) { // call_appearance4 ?>
        <td <?= $Page->call_appearance4->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_call_appearance4" class="phone_requests_call_appearance4">
<span<?= $Page->call_appearance4->viewAttributes() ?>>
<?= $Page->call_appearance4->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <td <?= $Page->timestamp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_timestamp" class="phone_requests_timestamp">
<span<?= $Page->timestamp->viewAttributes() ?>>
<?= $Page->timestamp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ID->Visible) { // ID ?>
        <td <?= $Page->ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_phone_requests_ID" class="phone_requests_ID">
<span<?= $Page->ID->viewAttributes() ?>>
<?= $Page->ID->getViewValue() ?></span>
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
