<?php

namespace PHPMaker2022\mealplans;

// Page object
$ControlEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { control: currentTable } });
var currentForm, currentPageID;
var fcontroledit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcontroledit = new ew.Form("fcontroledit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fcontroledit;

    // Add fields
    var fields = currentTable.fields;
    fcontroledit.addFields([
        ["ID", [fields.ID.visible && fields.ID.required ? ew.Validators.required(fields.ID.caption) : null], fields.ID.isInvalid],
        ["online", [fields.online.visible && fields.online.required ? ew.Validators.required(fields.online.caption) : null], fields.online.isInvalid],
        ["online_message", [fields.online_message.visible && fields.online_message.required ? ew.Validators.required(fields.online_message.caption) : null], fields.online_message.isInvalid],
        ["signup_bursars", [fields.signup_bursars.visible && fields.signup_bursars.required ? ew.Validators.required(fields.signup_bursars.caption) : null], fields.signup_bursars.isInvalid],
        ["signup_bursars_message", [fields.signup_bursars_message.visible && fields.signup_bursars_message.required ? ew.Validators.required(fields.signup_bursars_message.caption) : null], fields.signup_bursars_message.isInvalid],
        ["signup_cc", [fields.signup_cc.visible && fields.signup_cc.required ? ew.Validators.required(fields.signup_cc.caption) : null], fields.signup_cc.isInvalid],
        ["signup_cc_message", [fields.signup_cc_message.visible && fields.signup_cc_message.required ? ew.Validators.required(fields.signup_cc_message.caption) : null], fields.signup_cc_message.isInvalid],
        ["deposit_bursars", [fields.deposit_bursars.visible && fields.deposit_bursars.required ? ew.Validators.required(fields.deposit_bursars.caption) : null], fields.deposit_bursars.isInvalid],
        ["deposit_bursars_message", [fields.deposit_bursars_message.visible && fields.deposit_bursars_message.required ? ew.Validators.required(fields.deposit_bursars_message.caption) : null], fields.deposit_bursars_message.isInvalid],
        ["deposit_cc", [fields.deposit_cc.visible && fields.deposit_cc.required ? ew.Validators.required(fields.deposit_cc.caption) : null], fields.deposit_cc.isInvalid],
        ["deposit_cc_message", [fields.deposit_cc_message.visible && fields.deposit_cc_message.required ? ew.Validators.required(fields.deposit_cc_message.caption) : null], fields.deposit_cc_message.isInvalid],
        ["exporter", [fields.exporter.visible && fields.exporter.required ? ew.Validators.required(fields.exporter.caption) : null], fields.exporter.isInvalid],
        ["signup", [fields.signup.visible && fields.signup.required ? ew.Validators.required(fields.signup.caption) : null], fields.signup.isInvalid],
        ["signup_message", [fields.signup_message.visible && fields.signup_message.required ? ew.Validators.required(fields.signup_message.caption) : null], fields.signup_message.isInvalid]
    ]);

    // Form_CustomValidate
    fcontroledit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fcontroledit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fcontroledit.lists.online = <?= $Page->online->toClientList($Page) ?>;
    fcontroledit.lists.signup_bursars = <?= $Page->signup_bursars->toClientList($Page) ?>;
    fcontroledit.lists.signup_cc = <?= $Page->signup_cc->toClientList($Page) ?>;
    fcontroledit.lists.deposit_bursars = <?= $Page->deposit_bursars->toClientList($Page) ?>;
    fcontroledit.lists.deposit_cc = <?= $Page->deposit_cc->toClientList($Page) ?>;
    fcontroledit.lists.exporter = <?= $Page->exporter->toClientList($Page) ?>;
    fcontroledit.lists.signup = <?= $Page->signup->toClientList($Page) ?>;
    loadjs.done("fcontroledit");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fcontroledit" id="fcontroledit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="control">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->ID->Visible) { // ID ?>
    <div id="r_ID"<?= $Page->ID->rowAttributes() ?>>
        <label id="elh_control_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ID->caption() ?><?= $Page->ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ID->cellAttributes() ?>>
<span id="el_control_ID">
<span<?= $Page->ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->ID->getDisplayValue($Page->ID->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="control" data-field="x_ID" data-hidden="1" name="x_ID" id="x_ID" value="<?= HtmlEncode($Page->ID->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->online->Visible) { // online ?>
    <div id="r_online"<?= $Page->online->rowAttributes() ?>>
        <label id="elh_control_online" class="<?= $Page->LeftColumnClass ?>"><?= $Page->online->caption() ?><?= $Page->online->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->online->cellAttributes() ?>>
<span id="el_control_online">
<div class="form-check d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->online->isInvalidClass() ?>" data-table="control" data-field="x_online" name="x_online[]" id="x_online_190994" value="1"<?= ConvertToBool($Page->online->CurrentValue) ? " checked" : "" ?><?= $Page->online->editAttributes() ?> aria-describedby="x_online_help">
    <div class="invalid-feedback"><?= $Page->online->getErrorMessage() ?></div>
</div>
<?= $Page->online->getCustomMessage() ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->online_message->Visible) { // online_message ?>
    <div id="r_online_message"<?= $Page->online_message->rowAttributes() ?>>
        <label id="elh_control_online_message" for="x_online_message" class="<?= $Page->LeftColumnClass ?>"><?= $Page->online_message->caption() ?><?= $Page->online_message->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->online_message->cellAttributes() ?>>
<span id="el_control_online_message">
<textarea data-table="control" data-field="x_online_message" name="x_online_message" id="x_online_message" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->online_message->getPlaceHolder()) ?>"<?= $Page->online_message->editAttributes() ?> aria-describedby="x_online_message_help"><?= $Page->online_message->EditValue ?></textarea>
<?= $Page->online_message->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->online_message->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->signup_bursars->Visible) { // signup_bursars ?>
    <div id="r_signup_bursars"<?= $Page->signup_bursars->rowAttributes() ?>>
        <label id="elh_control_signup_bursars" class="<?= $Page->LeftColumnClass ?>"><?= $Page->signup_bursars->caption() ?><?= $Page->signup_bursars->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->signup_bursars->cellAttributes() ?>>
<span id="el_control_signup_bursars">
<div class="form-check d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->signup_bursars->isInvalidClass() ?>" data-table="control" data-field="x_signup_bursars" name="x_signup_bursars[]" id="x_signup_bursars_701210" value="1"<?= ConvertToBool($Page->signup_bursars->CurrentValue) ? " checked" : "" ?><?= $Page->signup_bursars->editAttributes() ?> aria-describedby="x_signup_bursars_help">
    <div class="invalid-feedback"><?= $Page->signup_bursars->getErrorMessage() ?></div>
</div>
<?= $Page->signup_bursars->getCustomMessage() ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->signup_bursars_message->Visible) { // signup_bursars_message ?>
    <div id="r_signup_bursars_message"<?= $Page->signup_bursars_message->rowAttributes() ?>>
        <label id="elh_control_signup_bursars_message" for="x_signup_bursars_message" class="<?= $Page->LeftColumnClass ?>"><?= $Page->signup_bursars_message->caption() ?><?= $Page->signup_bursars_message->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->signup_bursars_message->cellAttributes() ?>>
<span id="el_control_signup_bursars_message">
<textarea data-table="control" data-field="x_signup_bursars_message" name="x_signup_bursars_message" id="x_signup_bursars_message" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->signup_bursars_message->getPlaceHolder()) ?>"<?= $Page->signup_bursars_message->editAttributes() ?> aria-describedby="x_signup_bursars_message_help"><?= $Page->signup_bursars_message->EditValue ?></textarea>
<?= $Page->signup_bursars_message->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->signup_bursars_message->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->signup_cc->Visible) { // signup_cc ?>
    <div id="r_signup_cc"<?= $Page->signup_cc->rowAttributes() ?>>
        <label id="elh_control_signup_cc" class="<?= $Page->LeftColumnClass ?>"><?= $Page->signup_cc->caption() ?><?= $Page->signup_cc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->signup_cc->cellAttributes() ?>>
<span id="el_control_signup_cc">
<div class="form-check d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->signup_cc->isInvalidClass() ?>" data-table="control" data-field="x_signup_cc" name="x_signup_cc[]" id="x_signup_cc_578857" value="1"<?= ConvertToBool($Page->signup_cc->CurrentValue) ? " checked" : "" ?><?= $Page->signup_cc->editAttributes() ?> aria-describedby="x_signup_cc_help">
    <div class="invalid-feedback"><?= $Page->signup_cc->getErrorMessage() ?></div>
</div>
<?= $Page->signup_cc->getCustomMessage() ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->signup_cc_message->Visible) { // signup_cc_message ?>
    <div id="r_signup_cc_message"<?= $Page->signup_cc_message->rowAttributes() ?>>
        <label id="elh_control_signup_cc_message" for="x_signup_cc_message" class="<?= $Page->LeftColumnClass ?>"><?= $Page->signup_cc_message->caption() ?><?= $Page->signup_cc_message->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->signup_cc_message->cellAttributes() ?>>
<span id="el_control_signup_cc_message">
<textarea data-table="control" data-field="x_signup_cc_message" name="x_signup_cc_message" id="x_signup_cc_message" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->signup_cc_message->getPlaceHolder()) ?>"<?= $Page->signup_cc_message->editAttributes() ?> aria-describedby="x_signup_cc_message_help"><?= $Page->signup_cc_message->EditValue ?></textarea>
<?= $Page->signup_cc_message->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->signup_cc_message->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->deposit_bursars->Visible) { // deposit_bursars ?>
    <div id="r_deposit_bursars"<?= $Page->deposit_bursars->rowAttributes() ?>>
        <label id="elh_control_deposit_bursars" class="<?= $Page->LeftColumnClass ?>"><?= $Page->deposit_bursars->caption() ?><?= $Page->deposit_bursars->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->deposit_bursars->cellAttributes() ?>>
<span id="el_control_deposit_bursars">
<div class="form-check d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->deposit_bursars->isInvalidClass() ?>" data-table="control" data-field="x_deposit_bursars" name="x_deposit_bursars[]" id="x_deposit_bursars_585631" value="1"<?= ConvertToBool($Page->deposit_bursars->CurrentValue) ? " checked" : "" ?><?= $Page->deposit_bursars->editAttributes() ?> aria-describedby="x_deposit_bursars_help">
    <div class="invalid-feedback"><?= $Page->deposit_bursars->getErrorMessage() ?></div>
</div>
<?= $Page->deposit_bursars->getCustomMessage() ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->deposit_bursars_message->Visible) { // deposit_bursars_message ?>
    <div id="r_deposit_bursars_message"<?= $Page->deposit_bursars_message->rowAttributes() ?>>
        <label id="elh_control_deposit_bursars_message" for="x_deposit_bursars_message" class="<?= $Page->LeftColumnClass ?>"><?= $Page->deposit_bursars_message->caption() ?><?= $Page->deposit_bursars_message->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->deposit_bursars_message->cellAttributes() ?>>
<span id="el_control_deposit_bursars_message">
<textarea data-table="control" data-field="x_deposit_bursars_message" name="x_deposit_bursars_message" id="x_deposit_bursars_message" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->deposit_bursars_message->getPlaceHolder()) ?>"<?= $Page->deposit_bursars_message->editAttributes() ?> aria-describedby="x_deposit_bursars_message_help"><?= $Page->deposit_bursars_message->EditValue ?></textarea>
<?= $Page->deposit_bursars_message->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->deposit_bursars_message->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->deposit_cc->Visible) { // deposit_cc ?>
    <div id="r_deposit_cc"<?= $Page->deposit_cc->rowAttributes() ?>>
        <label id="elh_control_deposit_cc" class="<?= $Page->LeftColumnClass ?>"><?= $Page->deposit_cc->caption() ?><?= $Page->deposit_cc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->deposit_cc->cellAttributes() ?>>
<span id="el_control_deposit_cc">
<div class="form-check d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->deposit_cc->isInvalidClass() ?>" data-table="control" data-field="x_deposit_cc" name="x_deposit_cc[]" id="x_deposit_cc_781422" value="1"<?= ConvertToBool($Page->deposit_cc->CurrentValue) ? " checked" : "" ?><?= $Page->deposit_cc->editAttributes() ?> aria-describedby="x_deposit_cc_help">
    <div class="invalid-feedback"><?= $Page->deposit_cc->getErrorMessage() ?></div>
</div>
<?= $Page->deposit_cc->getCustomMessage() ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->deposit_cc_message->Visible) { // deposit_cc_message ?>
    <div id="r_deposit_cc_message"<?= $Page->deposit_cc_message->rowAttributes() ?>>
        <label id="elh_control_deposit_cc_message" for="x_deposit_cc_message" class="<?= $Page->LeftColumnClass ?>"><?= $Page->deposit_cc_message->caption() ?><?= $Page->deposit_cc_message->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->deposit_cc_message->cellAttributes() ?>>
<span id="el_control_deposit_cc_message">
<textarea data-table="control" data-field="x_deposit_cc_message" name="x_deposit_cc_message" id="x_deposit_cc_message" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->deposit_cc_message->getPlaceHolder()) ?>"<?= $Page->deposit_cc_message->editAttributes() ?> aria-describedby="x_deposit_cc_message_help"><?= $Page->deposit_cc_message->EditValue ?></textarea>
<?= $Page->deposit_cc_message->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->deposit_cc_message->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->exporter->Visible) { // exporter ?>
    <div id="r_exporter"<?= $Page->exporter->rowAttributes() ?>>
        <label id="elh_control_exporter" class="<?= $Page->LeftColumnClass ?>"><?= $Page->exporter->caption() ?><?= $Page->exporter->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->exporter->cellAttributes() ?>>
<span id="el_control_exporter">
<div class="form-check d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->exporter->isInvalidClass() ?>" data-table="control" data-field="x_exporter" name="x_exporter[]" id="x_exporter_571737" value="1"<?= ConvertToBool($Page->exporter->CurrentValue) ? " checked" : "" ?><?= $Page->exporter->editAttributes() ?> aria-describedby="x_exporter_help">
    <div class="invalid-feedback"><?= $Page->exporter->getErrorMessage() ?></div>
</div>
<?= $Page->exporter->getCustomMessage() ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->signup->Visible) { // signup ?>
    <div id="r_signup"<?= $Page->signup->rowAttributes() ?>>
        <label id="elh_control_signup" class="<?= $Page->LeftColumnClass ?>"><?= $Page->signup->caption() ?><?= $Page->signup->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->signup->cellAttributes() ?>>
<span id="el_control_signup">
<div class="form-check d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->signup->isInvalidClass() ?>" data-table="control" data-field="x_signup" name="x_signup[]" id="x_signup_643782" value="1"<?= ConvertToBool($Page->signup->CurrentValue) ? " checked" : "" ?><?= $Page->signup->editAttributes() ?> aria-describedby="x_signup_help">
    <div class="invalid-feedback"><?= $Page->signup->getErrorMessage() ?></div>
</div>
<?= $Page->signup->getCustomMessage() ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->signup_message->Visible) { // signup_message ?>
    <div id="r_signup_message"<?= $Page->signup_message->rowAttributes() ?>>
        <label id="elh_control_signup_message" for="x_signup_message" class="<?= $Page->LeftColumnClass ?>"><?= $Page->signup_message->caption() ?><?= $Page->signup_message->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->signup_message->cellAttributes() ?>>
<span id="el_control_signup_message">
<textarea data-table="control" data-field="x_signup_message" name="x_signup_message" id="x_signup_message" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->signup_message->getPlaceHolder()) ?>"<?= $Page->signup_message->editAttributes() ?> aria-describedby="x_signup_message_help"><?= $Page->signup_message->EditValue ?></textarea>
<?= $Page->signup_message->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->signup_message->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .row -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("control");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
