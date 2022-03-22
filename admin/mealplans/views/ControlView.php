<?php

namespace PHPMaker2022\mealplans;

// Page object
$ControlView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { control: currentTable } });
var currentForm, currentPageID;
var fcontrolview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcontrolview = new ew.Form("fcontrolview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fcontrolview;
    loadjs.done("fcontrolview");
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
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fcontrolview" id="fcontrolview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="control">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->ID->Visible) { // ID ?>
    <tr id="r_ID"<?= $Page->ID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_control_ID"><?= $Page->ID->caption() ?></span></td>
        <td data-name="ID"<?= $Page->ID->cellAttributes() ?>>
<span id="el_control_ID">
<span<?= $Page->ID->viewAttributes() ?>>
<?= $Page->ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->online->Visible) { // online ?>
    <tr id="r_online"<?= $Page->online->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_control_online"><?= $Page->online->caption() ?></span></td>
        <td data-name="online"<?= $Page->online->cellAttributes() ?>>
<span id="el_control_online">
<span<?= $Page->online->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_online_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->online->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->online->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_online_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->online_message->Visible) { // online_message ?>
    <tr id="r_online_message"<?= $Page->online_message->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_control_online_message"><?= $Page->online_message->caption() ?></span></td>
        <td data-name="online_message"<?= $Page->online_message->cellAttributes() ?>>
<span id="el_control_online_message">
<span<?= $Page->online_message->viewAttributes() ?>>
<?= $Page->online_message->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->signup_bursars->Visible) { // signup_bursars ?>
    <tr id="r_signup_bursars"<?= $Page->signup_bursars->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_control_signup_bursars"><?= $Page->signup_bursars->caption() ?></span></td>
        <td data-name="signup_bursars"<?= $Page->signup_bursars->cellAttributes() ?>>
<span id="el_control_signup_bursars">
<span<?= $Page->signup_bursars->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_signup_bursars_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->signup_bursars->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->signup_bursars->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_signup_bursars_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->signup_bursars_message->Visible) { // signup_bursars_message ?>
    <tr id="r_signup_bursars_message"<?= $Page->signup_bursars_message->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_control_signup_bursars_message"><?= $Page->signup_bursars_message->caption() ?></span></td>
        <td data-name="signup_bursars_message"<?= $Page->signup_bursars_message->cellAttributes() ?>>
<span id="el_control_signup_bursars_message">
<span<?= $Page->signup_bursars_message->viewAttributes() ?>>
<?= $Page->signup_bursars_message->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->signup_cc->Visible) { // signup_cc ?>
    <tr id="r_signup_cc"<?= $Page->signup_cc->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_control_signup_cc"><?= $Page->signup_cc->caption() ?></span></td>
        <td data-name="signup_cc"<?= $Page->signup_cc->cellAttributes() ?>>
<span id="el_control_signup_cc">
<span<?= $Page->signup_cc->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_signup_cc_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->signup_cc->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->signup_cc->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_signup_cc_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->signup_cc_message->Visible) { // signup_cc_message ?>
    <tr id="r_signup_cc_message"<?= $Page->signup_cc_message->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_control_signup_cc_message"><?= $Page->signup_cc_message->caption() ?></span></td>
        <td data-name="signup_cc_message"<?= $Page->signup_cc_message->cellAttributes() ?>>
<span id="el_control_signup_cc_message">
<span<?= $Page->signup_cc_message->viewAttributes() ?>>
<?= $Page->signup_cc_message->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->deposit_bursars->Visible) { // deposit_bursars ?>
    <tr id="r_deposit_bursars"<?= $Page->deposit_bursars->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_control_deposit_bursars"><?= $Page->deposit_bursars->caption() ?></span></td>
        <td data-name="deposit_bursars"<?= $Page->deposit_bursars->cellAttributes() ?>>
<span id="el_control_deposit_bursars">
<span<?= $Page->deposit_bursars->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_deposit_bursars_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->deposit_bursars->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->deposit_bursars->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_deposit_bursars_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->deposit_bursars_message->Visible) { // deposit_bursars_message ?>
    <tr id="r_deposit_bursars_message"<?= $Page->deposit_bursars_message->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_control_deposit_bursars_message"><?= $Page->deposit_bursars_message->caption() ?></span></td>
        <td data-name="deposit_bursars_message"<?= $Page->deposit_bursars_message->cellAttributes() ?>>
<span id="el_control_deposit_bursars_message">
<span<?= $Page->deposit_bursars_message->viewAttributes() ?>>
<?= $Page->deposit_bursars_message->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->deposit_cc->Visible) { // deposit_cc ?>
    <tr id="r_deposit_cc"<?= $Page->deposit_cc->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_control_deposit_cc"><?= $Page->deposit_cc->caption() ?></span></td>
        <td data-name="deposit_cc"<?= $Page->deposit_cc->cellAttributes() ?>>
<span id="el_control_deposit_cc">
<span<?= $Page->deposit_cc->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_deposit_cc_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->deposit_cc->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->deposit_cc->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_deposit_cc_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->deposit_cc_message->Visible) { // deposit_cc_message ?>
    <tr id="r_deposit_cc_message"<?= $Page->deposit_cc_message->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_control_deposit_cc_message"><?= $Page->deposit_cc_message->caption() ?></span></td>
        <td data-name="deposit_cc_message"<?= $Page->deposit_cc_message->cellAttributes() ?>>
<span id="el_control_deposit_cc_message">
<span<?= $Page->deposit_cc_message->viewAttributes() ?>>
<?= $Page->deposit_cc_message->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->exporter->Visible) { // exporter ?>
    <tr id="r_exporter"<?= $Page->exporter->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_control_exporter"><?= $Page->exporter->caption() ?></span></td>
        <td data-name="exporter"<?= $Page->exporter->cellAttributes() ?>>
<span id="el_control_exporter">
<span<?= $Page->exporter->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_exporter_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->exporter->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->exporter->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_exporter_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->signup->Visible) { // signup ?>
    <tr id="r_signup"<?= $Page->signup->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_control_signup"><?= $Page->signup->caption() ?></span></td>
        <td data-name="signup"<?= $Page->signup->cellAttributes() ?>>
<span id="el_control_signup">
<span<?= $Page->signup->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_signup_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->signup->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->signup->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_signup_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->signup_message->Visible) { // signup_message ?>
    <tr id="r_signup_message"<?= $Page->signup_message->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_control_signup_message"><?= $Page->signup_message->caption() ?></span></td>
        <td data-name="signup_message"<?= $Page->signup_message->cellAttributes() ?>>
<span id="el_control_signup_message">
<span<?= $Page->signup_message->viewAttributes() ?>>
<?= $Page->signup_message->getViewValue() ?></span>
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
