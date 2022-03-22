<?php

namespace PHPMaker2021\project1;

// Page object
$SessionHandlerEdit = &$Page;
?>
<script>
if (!ew.vars.tables.session_handler) ew.vars.tables.session_handler = <?= JsonEncode(GetClientVar("tables", "session_handler")) ?>;
var currentForm, currentPageID;
var fsession_handleredit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fsession_handleredit = currentForm = new ew.Form("fsession_handleredit", "edit");

    // Add fields
    var fields = ew.vars.tables.session_handler.fields;
    fsession_handleredit.addFields([
        ["id", [fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["custnum", [fields.custnum.required ? ew.Validators.required(fields.custnum.caption) : null, ew.Validators.integer], fields.custnum.isInvalid],
        ["cust_id", [fields.cust_id.required ? ew.Validators.required(fields.cust_id.caption) : null, ew.Validators.integer], fields.cust_id.isInvalid],
        ["netid", [fields.netid.required ? ew.Validators.required(fields.netid.caption) : null], fields.netid.isInvalid],
        ["firstname", [fields.firstname.required ? ew.Validators.required(fields.firstname.caption) : null], fields.firstname.isInvalid],
        ["lastname", [fields.lastname.required ? ew.Validators.required(fields.lastname.caption) : null], fields.lastname.isInvalid],
        ["mp_state", [fields.mp_state.required ? ew.Validators.required(fields.mp_state.caption) : null], fields.mp_state.isInvalid],
        ["deposit_to", [fields.deposit_to.required ? ew.Validators.required(fields.deposit_to.caption) : null], fields.deposit_to.isInvalid],
        ["iso", [fields.iso.required ? ew.Validators.required(fields.iso.caption) : null], fields.iso.isInvalid],
        ["activestudent", [fields.activestudent.required ? ew.Validators.required(fields.activestudent.caption) : null], fields.activestudent.isInvalid],
        ["activeemployee", [fields.activeemployee.required ? ew.Validators.required(fields.activeemployee.caption) : null], fields.activeemployee.isInvalid],
        ["timestamp", [fields.timestamp.required ? ew.Validators.required(fields.timestamp.caption) : null, ew.Validators.datetime(0)], fields.timestamp.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fsession_handleredit,
            fobj = f.getForm(),
            $fobj = $(fobj),
            $k = $fobj.find("#" + f.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            f.setInvalid(rowIndex);
        }
    });

    // Validate form
    fsession_handleredit.validate = function () {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm(),
            $fobj = $(fobj);
        if ($fobj.find("#confirm").val() == "confirm")
            return true;
        var addcnt = 0,
            $k = $fobj.find("#" + this.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1, // Check rowcnt == 0 => Inline-Add
            gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            $fobj.data("rowindex", rowIndex);

            // Validate fields
            if (!this.validateFields(rowIndex))
                return false;

            // Call Form_CustomValidate event
            if (!this.customValidate(fobj)) {
                this.focus();
                return false;
            }
        }

        // Process detail forms
        var dfs = $fobj.find("input[name='detailpage']").get();
        for (var i = 0; i < dfs.length; i++) {
            var df = dfs[i],
                val = df.value,
                frm = ew.forms.get(val);
            if (val && frm && !frm.validate())
                return false;
        }
        return true;
    }

    // Form_CustomValidate
    fsession_handleredit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fsession_handleredit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fsession_handleredit.lists.deposit_to = <?= $Page->deposit_to->toClientList($Page) ?>;
    loadjs.done("fsession_handleredit");
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
<form name="fsession_handleredit" id="fsession_handleredit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="session_handler">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_session_handler_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_session_handler_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="session_handler" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->custnum->Visible) { // custnum ?>
    <div id="r_custnum" class="form-group row">
        <label id="elh_session_handler_custnum" for="x_custnum" class="<?= $Page->LeftColumnClass ?>"><?= $Page->custnum->caption() ?><?= $Page->custnum->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->custnum->cellAttributes() ?>>
<span id="el_session_handler_custnum">
<input type="<?= $Page->custnum->getInputTextType() ?>" data-table="session_handler" data-field="x_custnum" name="x_custnum" id="x_custnum" size="30" placeholder="<?= HtmlEncode($Page->custnum->getPlaceHolder()) ?>" value="<?= $Page->custnum->EditValue ?>"<?= $Page->custnum->editAttributes() ?> aria-describedby="x_custnum_help">
<?= $Page->custnum->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->custnum->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->cust_id->Visible) { // cust_id ?>
    <div id="r_cust_id" class="form-group row">
        <label id="elh_session_handler_cust_id" for="x_cust_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->cust_id->caption() ?><?= $Page->cust_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->cust_id->cellAttributes() ?>>
<span id="el_session_handler_cust_id">
<input type="<?= $Page->cust_id->getInputTextType() ?>" data-table="session_handler" data-field="x_cust_id" name="x_cust_id" id="x_cust_id" size="30" placeholder="<?= HtmlEncode($Page->cust_id->getPlaceHolder()) ?>" value="<?= $Page->cust_id->EditValue ?>"<?= $Page->cust_id->editAttributes() ?> aria-describedby="x_cust_id_help">
<?= $Page->cust_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->cust_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->netid->Visible) { // netid ?>
    <div id="r_netid" class="form-group row">
        <label id="elh_session_handler_netid" for="x_netid" class="<?= $Page->LeftColumnClass ?>"><?= $Page->netid->caption() ?><?= $Page->netid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->netid->cellAttributes() ?>>
<span id="el_session_handler_netid">
<input type="<?= $Page->netid->getInputTextType() ?>" data-table="session_handler" data-field="x_netid" name="x_netid" id="x_netid" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->netid->getPlaceHolder()) ?>" value="<?= $Page->netid->EditValue ?>"<?= $Page->netid->editAttributes() ?> aria-describedby="x_netid_help">
<?= $Page->netid->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->netid->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->firstname->Visible) { // firstname ?>
    <div id="r_firstname" class="form-group row">
        <label id="elh_session_handler_firstname" for="x_firstname" class="<?= $Page->LeftColumnClass ?>"><?= $Page->firstname->caption() ?><?= $Page->firstname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->firstname->cellAttributes() ?>>
<span id="el_session_handler_firstname">
<input type="<?= $Page->firstname->getInputTextType() ?>" data-table="session_handler" data-field="x_firstname" name="x_firstname" id="x_firstname" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->firstname->getPlaceHolder()) ?>" value="<?= $Page->firstname->EditValue ?>"<?= $Page->firstname->editAttributes() ?> aria-describedby="x_firstname_help">
<?= $Page->firstname->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->firstname->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lastname->Visible) { // lastname ?>
    <div id="r_lastname" class="form-group row">
        <label id="elh_session_handler_lastname" for="x_lastname" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lastname->caption() ?><?= $Page->lastname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->lastname->cellAttributes() ?>>
<span id="el_session_handler_lastname">
<input type="<?= $Page->lastname->getInputTextType() ?>" data-table="session_handler" data-field="x_lastname" name="x_lastname" id="x_lastname" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->lastname->getPlaceHolder()) ?>" value="<?= $Page->lastname->EditValue ?>"<?= $Page->lastname->editAttributes() ?> aria-describedby="x_lastname_help">
<?= $Page->lastname->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lastname->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->mp_state->Visible) { // mp_state ?>
    <div id="r_mp_state" class="form-group row">
        <label id="elh_session_handler_mp_state" for="x_mp_state" class="<?= $Page->LeftColumnClass ?>"><?= $Page->mp_state->caption() ?><?= $Page->mp_state->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->mp_state->cellAttributes() ?>>
<span id="el_session_handler_mp_state">
<input type="<?= $Page->mp_state->getInputTextType() ?>" data-table="session_handler" data-field="x_mp_state" name="x_mp_state" id="x_mp_state" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->mp_state->getPlaceHolder()) ?>" value="<?= $Page->mp_state->EditValue ?>"<?= $Page->mp_state->editAttributes() ?> aria-describedby="x_mp_state_help">
<?= $Page->mp_state->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->mp_state->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->deposit_to->Visible) { // deposit_to ?>
    <div id="r_deposit_to" class="form-group row">
        <label id="elh_session_handler_deposit_to" class="<?= $Page->LeftColumnClass ?>"><?= $Page->deposit_to->caption() ?><?= $Page->deposit_to->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->deposit_to->cellAttributes() ?>>
<span id="el_session_handler_deposit_to">
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" class="custom-control-input<?= $Page->deposit_to->isInvalidClass() ?>" data-table="session_handler" data-field="x_deposit_to" name="x_deposit_to[]" id="x_deposit_to_207602" value="1"<?= ConvertToBool($Page->deposit_to->CurrentValue) ? " checked" : "" ?><?= $Page->deposit_to->editAttributes() ?> aria-describedby="x_deposit_to_help">
    <label class="custom-control-label" for="x_deposit_to_207602"></label>
</div>
<?= $Page->deposit_to->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->deposit_to->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->iso->Visible) { // iso ?>
    <div id="r_iso" class="form-group row">
        <label id="elh_session_handler_iso" for="x_iso" class="<?= $Page->LeftColumnClass ?>"><?= $Page->iso->caption() ?><?= $Page->iso->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->iso->cellAttributes() ?>>
<span id="el_session_handler_iso">
<input type="<?= $Page->iso->getInputTextType() ?>" data-table="session_handler" data-field="x_iso" name="x_iso" id="x_iso" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->iso->getPlaceHolder()) ?>" value="<?= $Page->iso->EditValue ?>"<?= $Page->iso->editAttributes() ?> aria-describedby="x_iso_help">
<?= $Page->iso->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->iso->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->activestudent->Visible) { // activestudent ?>
    <div id="r_activestudent" class="form-group row">
        <label id="elh_session_handler_activestudent" for="x_activestudent" class="<?= $Page->LeftColumnClass ?>"><?= $Page->activestudent->caption() ?><?= $Page->activestudent->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->activestudent->cellAttributes() ?>>
<span id="el_session_handler_activestudent">
<input type="<?= $Page->activestudent->getInputTextType() ?>" data-table="session_handler" data-field="x_activestudent" name="x_activestudent" id="x_activestudent" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->activestudent->getPlaceHolder()) ?>" value="<?= $Page->activestudent->EditValue ?>"<?= $Page->activestudent->editAttributes() ?> aria-describedby="x_activestudent_help">
<?= $Page->activestudent->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->activestudent->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->activeemployee->Visible) { // activeemployee ?>
    <div id="r_activeemployee" class="form-group row">
        <label id="elh_session_handler_activeemployee" for="x_activeemployee" class="<?= $Page->LeftColumnClass ?>"><?= $Page->activeemployee->caption() ?><?= $Page->activeemployee->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->activeemployee->cellAttributes() ?>>
<span id="el_session_handler_activeemployee">
<input type="<?= $Page->activeemployee->getInputTextType() ?>" data-table="session_handler" data-field="x_activeemployee" name="x_activeemployee" id="x_activeemployee" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->activeemployee->getPlaceHolder()) ?>" value="<?= $Page->activeemployee->EditValue ?>"<?= $Page->activeemployee->editAttributes() ?> aria-describedby="x_activeemployee_help">
<?= $Page->activeemployee->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->activeemployee->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
    <div id="r_timestamp" class="form-group row">
        <label id="elh_session_handler_timestamp" for="x_timestamp" class="<?= $Page->LeftColumnClass ?>"><?= $Page->timestamp->caption() ?><?= $Page->timestamp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->timestamp->cellAttributes() ?>>
<span id="el_session_handler_timestamp">
<input type="<?= $Page->timestamp->getInputTextType() ?>" data-table="session_handler" data-field="x_timestamp" name="x_timestamp" id="x_timestamp" placeholder="<?= HtmlEncode($Page->timestamp->getPlaceHolder()) ?>" value="<?= $Page->timestamp->EditValue ?>"<?= $Page->timestamp->editAttributes() ?> aria-describedby="x_timestamp_help">
<?= $Page->timestamp->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->timestamp->getErrorMessage() ?></div>
<?php if (!$Page->timestamp->ReadOnly && !$Page->timestamp->Disabled && !isset($Page->timestamp->EditAttrs["readonly"]) && !isset($Page->timestamp->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fsession_handleredit", "datetimepicker"], function() {
    ew.createDateTimePicker("fsession_handleredit", "x_timestamp", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("session_handler");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
