<?php

namespace PHPMaker2021\project4;

// Page object
$PhoneRequestsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fphone_requestsview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fphone_requestsview = currentForm = new ew.Form("fphone_requestsview", "view");
    loadjs.done("fphone_requestsview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.phone_requests) ew.vars.tables.phone_requests = <?= JsonEncode(GetClientVar("tables", "phone_requests")) ?>;
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
<form name="fphone_requestsview" id="fphone_requestsview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="phone_requests">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->supervisor_name->Visible) { // supervisor_name ?>
    <tr id="r_supervisor_name">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_phone_requests_supervisor_name"><?= $Page->supervisor_name->caption() ?></span></td>
        <td data-name="supervisor_name" <?= $Page->supervisor_name->cellAttributes() ?>>
<span id="el_phone_requests_supervisor_name">
<span<?= $Page->supervisor_name->viewAttributes() ?>>
<?= $Page->supervisor_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->supervisor_phone->Visible) { // supervisor_phone ?>
    <tr id="r_supervisor_phone">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_phone_requests_supervisor_phone"><?= $Page->supervisor_phone->caption() ?></span></td>
        <td data-name="supervisor_phone" <?= $Page->supervisor_phone->cellAttributes() ?>>
<span id="el_phone_requests_supervisor_phone">
<span<?= $Page->supervisor_phone->viewAttributes() ?>>
<?= $Page->supervisor_phone->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->employee_status->Visible) { // employee_status ?>
    <tr id="r_employee_status">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_phone_requests_employee_status"><?= $Page->employee_status->caption() ?></span></td>
        <td data-name="employee_status" <?= $Page->employee_status->cellAttributes() ?>>
<span id="el_phone_requests_employee_status">
<span<?= $Page->employee_status->viewAttributes() ?>>
<?= $Page->employee_status->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->building->Visible) { // building ?>
    <tr id="r_building">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_phone_requests_building"><?= $Page->building->caption() ?></span></td>
        <td data-name="building" <?= $Page->building->cellAttributes() ?>>
<span id="el_phone_requests_building">
<span<?= $Page->building->viewAttributes() ?>>
<?= $Page->building->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->room_number->Visible) { // room_number ?>
    <tr id="r_room_number">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_phone_requests_room_number"><?= $Page->room_number->caption() ?></span></td>
        <td data-name="room_number" <?= $Page->room_number->cellAttributes() ?>>
<span id="el_phone_requests_room_number">
<span<?= $Page->room_number->viewAttributes() ?>>
<?= $Page->room_number->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->net_id->Visible) { // net_id ?>
    <tr id="r_net_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_phone_requests_net_id"><?= $Page->net_id->caption() ?></span></td>
        <td data-name="net_id" <?= $Page->net_id->cellAttributes() ?>>
<span id="el_phone_requests_net_id">
<span<?= $Page->net_id->viewAttributes() ?>>
<?= $Page->net_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jack->Visible) { // jack ?>
    <tr id="r_jack">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_phone_requests_jack"><?= $Page->jack->caption() ?></span></td>
        <td data-name="jack" <?= $Page->jack->cellAttributes() ?>>
<span id="el_phone_requests_jack">
<span<?= $Page->jack->viewAttributes() ?>>
<?= $Page->jack->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jack_id->Visible) { // jack_id ?>
    <tr id="r_jack_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_phone_requests_jack_id"><?= $Page->jack_id->caption() ?></span></td>
        <td data-name="jack_id" <?= $Page->jack_id->cellAttributes() ?>>
<span id="el_phone_requests_jack_id">
<span<?= $Page->jack_id->viewAttributes() ?>>
<?= $Page->jack_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->voicemail->Visible) { // voicemail ?>
    <tr id="r_voicemail">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_phone_requests_voicemail"><?= $Page->voicemail->caption() ?></span></td>
        <td data-name="voicemail" <?= $Page->voicemail->cellAttributes() ?>>
<span id="el_phone_requests_voicemail">
<span<?= $Page->voicemail->viewAttributes() ?>>
<?= $Page->voicemail->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->long_distance->Visible) { // long_distance ?>
    <tr id="r_long_distance">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_phone_requests_long_distance"><?= $Page->long_distance->caption() ?></span></td>
        <td data-name="long_distance" <?= $Page->long_distance->cellAttributes() ?>>
<span id="el_phone_requests_long_distance">
<span<?= $Page->long_distance->viewAttributes() ?>>
<?= $Page->long_distance->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->need_phone->Visible) { // need_phone ?>
    <tr id="r_need_phone">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_phone_requests_need_phone"><?= $Page->need_phone->caption() ?></span></td>
        <td data-name="need_phone" <?= $Page->need_phone->cellAttributes() ?>>
<span id="el_phone_requests_need_phone">
<span<?= $Page->need_phone->viewAttributes() ?>>
<?= $Page->need_phone->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->call_appearance->Visible) { // call_appearance ?>
    <tr id="r_call_appearance">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_phone_requests_call_appearance"><?= $Page->call_appearance->caption() ?></span></td>
        <td data-name="call_appearance" <?= $Page->call_appearance->cellAttributes() ?>>
<span id="el_phone_requests_call_appearance">
<span<?= $Page->call_appearance->viewAttributes() ?>>
<?= $Page->call_appearance->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kfs_number->Visible) { // kfs_number ?>
    <tr id="r_kfs_number">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_phone_requests_kfs_number"><?= $Page->kfs_number->caption() ?></span></td>
        <td data-name="kfs_number" <?= $Page->kfs_number->cellAttributes() ?>>
<span id="el_phone_requests_kfs_number">
<span<?= $Page->kfs_number->viewAttributes() ?>>
<?= $Page->kfs_number->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->call_appearance1->Visible) { // call_appearance1 ?>
    <tr id="r_call_appearance1">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_phone_requests_call_appearance1"><?= $Page->call_appearance1->caption() ?></span></td>
        <td data-name="call_appearance1" <?= $Page->call_appearance1->cellAttributes() ?>>
<span id="el_phone_requests_call_appearance1">
<span<?= $Page->call_appearance1->viewAttributes() ?>>
<?= $Page->call_appearance1->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->call_appearance2->Visible) { // call_appearance2 ?>
    <tr id="r_call_appearance2">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_phone_requests_call_appearance2"><?= $Page->call_appearance2->caption() ?></span></td>
        <td data-name="call_appearance2" <?= $Page->call_appearance2->cellAttributes() ?>>
<span id="el_phone_requests_call_appearance2">
<span<?= $Page->call_appearance2->viewAttributes() ?>>
<?= $Page->call_appearance2->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->call_appearance3->Visible) { // call_appearance3 ?>
    <tr id="r_call_appearance3">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_phone_requests_call_appearance3"><?= $Page->call_appearance3->caption() ?></span></td>
        <td data-name="call_appearance3" <?= $Page->call_appearance3->cellAttributes() ?>>
<span id="el_phone_requests_call_appearance3">
<span<?= $Page->call_appearance3->viewAttributes() ?>>
<?= $Page->call_appearance3->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->call_appearance4->Visible) { // call_appearance4 ?>
    <tr id="r_call_appearance4">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_phone_requests_call_appearance4"><?= $Page->call_appearance4->caption() ?></span></td>
        <td data-name="call_appearance4" <?= $Page->call_appearance4->cellAttributes() ?>>
<span id="el_phone_requests_call_appearance4">
<span<?= $Page->call_appearance4->viewAttributes() ?>>
<?= $Page->call_appearance4->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
    <tr id="r_timestamp">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_phone_requests_timestamp"><?= $Page->timestamp->caption() ?></span></td>
        <td data-name="timestamp" <?= $Page->timestamp->cellAttributes() ?>>
<span id="el_phone_requests_timestamp">
<span<?= $Page->timestamp->viewAttributes() ?>>
<?= $Page->timestamp->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ID->Visible) { // ID ?>
    <tr id="r_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_phone_requests_ID"><?= $Page->ID->caption() ?></span></td>
        <td data-name="ID" <?= $Page->ID->cellAttributes() ?>>
<span id="el_phone_requests_ID">
<span<?= $Page->ID->viewAttributes() ?>>
<?= $Page->ID->getViewValue() ?></span>
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
