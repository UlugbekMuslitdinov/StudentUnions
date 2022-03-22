<?php

namespace PHPMaker2021\project1;

// Page object
$SessionHandlerView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fsession_handlerview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fsession_handlerview = currentForm = new ew.Form("fsession_handlerview", "view");
    loadjs.done("fsession_handlerview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
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
<form name="fsession_handlerview" id="fsession_handlerview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="session_handler">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_session_handler_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_session_handler_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->custnum->Visible) { // custnum ?>
    <tr id="r_custnum">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_session_handler_custnum"><?= $Page->custnum->caption() ?></span></td>
        <td data-name="custnum" <?= $Page->custnum->cellAttributes() ?>>
<span id="el_session_handler_custnum">
<span<?= $Page->custnum->viewAttributes() ?>>
<?= $Page->custnum->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->cust_id->Visible) { // cust_id ?>
    <tr id="r_cust_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_session_handler_cust_id"><?= $Page->cust_id->caption() ?></span></td>
        <td data-name="cust_id" <?= $Page->cust_id->cellAttributes() ?>>
<span id="el_session_handler_cust_id">
<span<?= $Page->cust_id->viewAttributes() ?>>
<?= $Page->cust_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->netid->Visible) { // netid ?>
    <tr id="r_netid">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_session_handler_netid"><?= $Page->netid->caption() ?></span></td>
        <td data-name="netid" <?= $Page->netid->cellAttributes() ?>>
<span id="el_session_handler_netid">
<span<?= $Page->netid->viewAttributes() ?>>
<?= $Page->netid->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->firstname->Visible) { // firstname ?>
    <tr id="r_firstname">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_session_handler_firstname"><?= $Page->firstname->caption() ?></span></td>
        <td data-name="firstname" <?= $Page->firstname->cellAttributes() ?>>
<span id="el_session_handler_firstname">
<span<?= $Page->firstname->viewAttributes() ?>>
<?= $Page->firstname->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->lastname->Visible) { // lastname ?>
    <tr id="r_lastname">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_session_handler_lastname"><?= $Page->lastname->caption() ?></span></td>
        <td data-name="lastname" <?= $Page->lastname->cellAttributes() ?>>
<span id="el_session_handler_lastname">
<span<?= $Page->lastname->viewAttributes() ?>>
<?= $Page->lastname->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->mp_state->Visible) { // mp_state ?>
    <tr id="r_mp_state">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_session_handler_mp_state"><?= $Page->mp_state->caption() ?></span></td>
        <td data-name="mp_state" <?= $Page->mp_state->cellAttributes() ?>>
<span id="el_session_handler_mp_state">
<span<?= $Page->mp_state->viewAttributes() ?>>
<?= $Page->mp_state->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->deposit_to->Visible) { // deposit_to ?>
    <tr id="r_deposit_to">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_session_handler_deposit_to"><?= $Page->deposit_to->caption() ?></span></td>
        <td data-name="deposit_to" <?= $Page->deposit_to->cellAttributes() ?>>
<span id="el_session_handler_deposit_to">
<span<?= $Page->deposit_to->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_deposit_to_<?= $Page->RowCount ?>" class="custom-control-input" value="<?= $Page->deposit_to->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->deposit_to->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_deposit_to_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->iso->Visible) { // iso ?>
    <tr id="r_iso">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_session_handler_iso"><?= $Page->iso->caption() ?></span></td>
        <td data-name="iso" <?= $Page->iso->cellAttributes() ?>>
<span id="el_session_handler_iso">
<span<?= $Page->iso->viewAttributes() ?>>
<?= $Page->iso->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->activestudent->Visible) { // activestudent ?>
    <tr id="r_activestudent">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_session_handler_activestudent"><?= $Page->activestudent->caption() ?></span></td>
        <td data-name="activestudent" <?= $Page->activestudent->cellAttributes() ?>>
<span id="el_session_handler_activestudent">
<span<?= $Page->activestudent->viewAttributes() ?>>
<?= $Page->activestudent->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->activeemployee->Visible) { // activeemployee ?>
    <tr id="r_activeemployee">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_session_handler_activeemployee"><?= $Page->activeemployee->caption() ?></span></td>
        <td data-name="activeemployee" <?= $Page->activeemployee->cellAttributes() ?>>
<span id="el_session_handler_activeemployee">
<span<?= $Page->activeemployee->viewAttributes() ?>>
<?= $Page->activeemployee->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
    <tr id="r_timestamp">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_session_handler_timestamp"><?= $Page->timestamp->caption() ?></span></td>
        <td data-name="timestamp" <?= $Page->timestamp->cellAttributes() ?>>
<span id="el_session_handler_timestamp">
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
