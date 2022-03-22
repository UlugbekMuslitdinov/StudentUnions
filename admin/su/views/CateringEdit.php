<?php

namespace PHPMaker2021\project1;

// Page object
$CateringEdit = &$Page;
?>
<script>
if (!ew.vars.tables.catering) ew.vars.tables.catering = <?= JsonEncode(GetClientVar("tables", "catering")) ?>;
var currentForm, currentPageID;
var fcateringedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fcateringedit = currentForm = new ew.Form("fcateringedit", "edit");

    // Add fields
    var fields = ew.vars.tables.catering.fields;
    fcateringedit.addFields([
        ["id", [fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["location", [fields.location.required ? ew.Validators.required(fields.location.caption) : null], fields.location.isInvalid],
        ["method", [fields.method.required ? ew.Validators.required(fields.method.caption) : null], fields.method.isInvalid],
        ["delivery_date", [fields.delivery_date.required ? ew.Validators.required(fields.delivery_date.caption) : null, ew.Validators.datetime(0)], fields.delivery_date.isInvalid],
        ["delivery_time", [fields.delivery_time.required ? ew.Validators.required(fields.delivery_time.caption) : null], fields.delivery_time.isInvalid],
        ["delivery_building", [fields.delivery_building.required ? ew.Validators.required(fields.delivery_building.caption) : null], fields.delivery_building.isInvalid],
        ["delivery_room", [fields.delivery_room.required ? ew.Validators.required(fields.delivery_room.caption) : null], fields.delivery_room.isInvalid],
        ["delivery_notes", [fields.delivery_notes.required ? ew.Validators.required(fields.delivery_notes.caption) : null], fields.delivery_notes.isInvalid],
        ["onsite_name", [fields.onsite_name.required ? ew.Validators.required(fields.onsite_name.caption) : null], fields.onsite_name.isInvalid],
        ["onsite_email", [fields.onsite_email.required ? ew.Validators.required(fields.onsite_email.caption) : null], fields.onsite_email.isInvalid],
        ["onsite_phone", [fields.onsite_phone.required ? ew.Validators.required(fields.onsite_phone.caption) : null], fields.onsite_phone.isInvalid],
        ["customer_name", [fields.customer_name.required ? ew.Validators.required(fields.customer_name.caption) : null], fields.customer_name.isInvalid],
        ["customer_phone", [fields.customer_phone.required ? ew.Validators.required(fields.customer_phone.caption) : null], fields.customer_phone.isInvalid],
        ["customer_email", [fields.customer_email.required ? ew.Validators.required(fields.customer_email.caption) : null], fields.customer_email.isInvalid],
        ["payment_method", [fields.payment_method.required ? ew.Validators.required(fields.payment_method.caption) : null], fields.payment_method.isInvalid],
        ["account_num", [fields.account_num.required ? ew.Validators.required(fields.account_num.caption) : null], fields.account_num.isInvalid],
        ["sub_code", [fields.sub_code.required ? ew.Validators.required(fields.sub_code.caption) : null], fields.sub_code.isInvalid],
        ["status", [fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
        ["order", [fields.order.required ? ew.Validators.required(fields.order.caption) : null], fields.order.isInvalid],
        ["timestamp", [fields.timestamp.required ? ew.Validators.required(fields.timestamp.caption) : null, ew.Validators.datetime(0)], fields.timestamp.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fcateringedit,
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
    fcateringedit.validate = function () {
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
    fcateringedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fcateringedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fcateringedit");
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
<form name="fcateringedit" id="fcateringedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="catering">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_catering_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_catering_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="catering" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
    <div id="r_location" class="form-group row">
        <label id="elh_catering_location" for="x_location" class="<?= $Page->LeftColumnClass ?>"><?= $Page->location->caption() ?><?= $Page->location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->location->cellAttributes() ?>>
<span id="el_catering_location">
<input type="<?= $Page->location->getInputTextType() ?>" data-table="catering" data-field="x_location" name="x_location" id="x_location" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->location->getPlaceHolder()) ?>" value="<?= $Page->location->EditValue ?>"<?= $Page->location->editAttributes() ?> aria-describedby="x_location_help">
<?= $Page->location->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->location->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->method->Visible) { // method ?>
    <div id="r_method" class="form-group row">
        <label id="elh_catering_method" for="x_method" class="<?= $Page->LeftColumnClass ?>"><?= $Page->method->caption() ?><?= $Page->method->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->method->cellAttributes() ?>>
<span id="el_catering_method">
<input type="<?= $Page->method->getInputTextType() ?>" data-table="catering" data-field="x_method" name="x_method" id="x_method" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->method->getPlaceHolder()) ?>" value="<?= $Page->method->EditValue ?>"<?= $Page->method->editAttributes() ?> aria-describedby="x_method_help">
<?= $Page->method->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->method->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->delivery_date->Visible) { // delivery_date ?>
    <div id="r_delivery_date" class="form-group row">
        <label id="elh_catering_delivery_date" for="x_delivery_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->delivery_date->caption() ?><?= $Page->delivery_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->delivery_date->cellAttributes() ?>>
<span id="el_catering_delivery_date">
<input type="<?= $Page->delivery_date->getInputTextType() ?>" data-table="catering" data-field="x_delivery_date" name="x_delivery_date" id="x_delivery_date" placeholder="<?= HtmlEncode($Page->delivery_date->getPlaceHolder()) ?>" value="<?= $Page->delivery_date->EditValue ?>"<?= $Page->delivery_date->editAttributes() ?> aria-describedby="x_delivery_date_help">
<?= $Page->delivery_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->delivery_date->getErrorMessage() ?></div>
<?php if (!$Page->delivery_date->ReadOnly && !$Page->delivery_date->Disabled && !isset($Page->delivery_date->EditAttrs["readonly"]) && !isset($Page->delivery_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcateringedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fcateringedit", "x_delivery_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->delivery_time->Visible) { // delivery_time ?>
    <div id="r_delivery_time" class="form-group row">
        <label id="elh_catering_delivery_time" for="x_delivery_time" class="<?= $Page->LeftColumnClass ?>"><?= $Page->delivery_time->caption() ?><?= $Page->delivery_time->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->delivery_time->cellAttributes() ?>>
<span id="el_catering_delivery_time">
<input type="<?= $Page->delivery_time->getInputTextType() ?>" data-table="catering" data-field="x_delivery_time" name="x_delivery_time" id="x_delivery_time" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->delivery_time->getPlaceHolder()) ?>" value="<?= $Page->delivery_time->EditValue ?>"<?= $Page->delivery_time->editAttributes() ?> aria-describedby="x_delivery_time_help">
<?= $Page->delivery_time->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->delivery_time->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->delivery_building->Visible) { // delivery_building ?>
    <div id="r_delivery_building" class="form-group row">
        <label id="elh_catering_delivery_building" for="x_delivery_building" class="<?= $Page->LeftColumnClass ?>"><?= $Page->delivery_building->caption() ?><?= $Page->delivery_building->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->delivery_building->cellAttributes() ?>>
<span id="el_catering_delivery_building">
<input type="<?= $Page->delivery_building->getInputTextType() ?>" data-table="catering" data-field="x_delivery_building" name="x_delivery_building" id="x_delivery_building" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->delivery_building->getPlaceHolder()) ?>" value="<?= $Page->delivery_building->EditValue ?>"<?= $Page->delivery_building->editAttributes() ?> aria-describedby="x_delivery_building_help">
<?= $Page->delivery_building->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->delivery_building->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->delivery_room->Visible) { // delivery_room ?>
    <div id="r_delivery_room" class="form-group row">
        <label id="elh_catering_delivery_room" for="x_delivery_room" class="<?= $Page->LeftColumnClass ?>"><?= $Page->delivery_room->caption() ?><?= $Page->delivery_room->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->delivery_room->cellAttributes() ?>>
<span id="el_catering_delivery_room">
<input type="<?= $Page->delivery_room->getInputTextType() ?>" data-table="catering" data-field="x_delivery_room" name="x_delivery_room" id="x_delivery_room" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->delivery_room->getPlaceHolder()) ?>" value="<?= $Page->delivery_room->EditValue ?>"<?= $Page->delivery_room->editAttributes() ?> aria-describedby="x_delivery_room_help">
<?= $Page->delivery_room->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->delivery_room->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->delivery_notes->Visible) { // delivery_notes ?>
    <div id="r_delivery_notes" class="form-group row">
        <label id="elh_catering_delivery_notes" for="x_delivery_notes" class="<?= $Page->LeftColumnClass ?>"><?= $Page->delivery_notes->caption() ?><?= $Page->delivery_notes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->delivery_notes->cellAttributes() ?>>
<span id="el_catering_delivery_notes">
<textarea data-table="catering" data-field="x_delivery_notes" name="x_delivery_notes" id="x_delivery_notes" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->delivery_notes->getPlaceHolder()) ?>"<?= $Page->delivery_notes->editAttributes() ?> aria-describedby="x_delivery_notes_help"><?= $Page->delivery_notes->EditValue ?></textarea>
<?= $Page->delivery_notes->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->delivery_notes->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->onsite_name->Visible) { // onsite_name ?>
    <div id="r_onsite_name" class="form-group row">
        <label id="elh_catering_onsite_name" for="x_onsite_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->onsite_name->caption() ?><?= $Page->onsite_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->onsite_name->cellAttributes() ?>>
<span id="el_catering_onsite_name">
<input type="<?= $Page->onsite_name->getInputTextType() ?>" data-table="catering" data-field="x_onsite_name" name="x_onsite_name" id="x_onsite_name" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->onsite_name->getPlaceHolder()) ?>" value="<?= $Page->onsite_name->EditValue ?>"<?= $Page->onsite_name->editAttributes() ?> aria-describedby="x_onsite_name_help">
<?= $Page->onsite_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->onsite_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->onsite_email->Visible) { // onsite_email ?>
    <div id="r_onsite_email" class="form-group row">
        <label id="elh_catering_onsite_email" for="x_onsite_email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->onsite_email->caption() ?><?= $Page->onsite_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->onsite_email->cellAttributes() ?>>
<span id="el_catering_onsite_email">
<input type="<?= $Page->onsite_email->getInputTextType() ?>" data-table="catering" data-field="x_onsite_email" name="x_onsite_email" id="x_onsite_email" size="30" maxlength="70" placeholder="<?= HtmlEncode($Page->onsite_email->getPlaceHolder()) ?>" value="<?= $Page->onsite_email->EditValue ?>"<?= $Page->onsite_email->editAttributes() ?> aria-describedby="x_onsite_email_help">
<?= $Page->onsite_email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->onsite_email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->onsite_phone->Visible) { // onsite_phone ?>
    <div id="r_onsite_phone" class="form-group row">
        <label id="elh_catering_onsite_phone" for="x_onsite_phone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->onsite_phone->caption() ?><?= $Page->onsite_phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->onsite_phone->cellAttributes() ?>>
<span id="el_catering_onsite_phone">
<input type="<?= $Page->onsite_phone->getInputTextType() ?>" data-table="catering" data-field="x_onsite_phone" name="x_onsite_phone" id="x_onsite_phone" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->onsite_phone->getPlaceHolder()) ?>" value="<?= $Page->onsite_phone->EditValue ?>"<?= $Page->onsite_phone->editAttributes() ?> aria-describedby="x_onsite_phone_help">
<?= $Page->onsite_phone->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->onsite_phone->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->customer_name->Visible) { // customer_name ?>
    <div id="r_customer_name" class="form-group row">
        <label id="elh_catering_customer_name" for="x_customer_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->customer_name->caption() ?><?= $Page->customer_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->customer_name->cellAttributes() ?>>
<span id="el_catering_customer_name">
<input type="<?= $Page->customer_name->getInputTextType() ?>" data-table="catering" data-field="x_customer_name" name="x_customer_name" id="x_customer_name" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->customer_name->getPlaceHolder()) ?>" value="<?= $Page->customer_name->EditValue ?>"<?= $Page->customer_name->editAttributes() ?> aria-describedby="x_customer_name_help">
<?= $Page->customer_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->customer_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->customer_phone->Visible) { // customer_phone ?>
    <div id="r_customer_phone" class="form-group row">
        <label id="elh_catering_customer_phone" for="x_customer_phone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->customer_phone->caption() ?><?= $Page->customer_phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->customer_phone->cellAttributes() ?>>
<span id="el_catering_customer_phone">
<input type="<?= $Page->customer_phone->getInputTextType() ?>" data-table="catering" data-field="x_customer_phone" name="x_customer_phone" id="x_customer_phone" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->customer_phone->getPlaceHolder()) ?>" value="<?= $Page->customer_phone->EditValue ?>"<?= $Page->customer_phone->editAttributes() ?> aria-describedby="x_customer_phone_help">
<?= $Page->customer_phone->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->customer_phone->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->customer_email->Visible) { // customer_email ?>
    <div id="r_customer_email" class="form-group row">
        <label id="elh_catering_customer_email" for="x_customer_email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->customer_email->caption() ?><?= $Page->customer_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->customer_email->cellAttributes() ?>>
<span id="el_catering_customer_email">
<input type="<?= $Page->customer_email->getInputTextType() ?>" data-table="catering" data-field="x_customer_email" name="x_customer_email" id="x_customer_email" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->customer_email->getPlaceHolder()) ?>" value="<?= $Page->customer_email->EditValue ?>"<?= $Page->customer_email->editAttributes() ?> aria-describedby="x_customer_email_help">
<?= $Page->customer_email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->customer_email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->payment_method->Visible) { // payment_method ?>
    <div id="r_payment_method" class="form-group row">
        <label id="elh_catering_payment_method" for="x_payment_method" class="<?= $Page->LeftColumnClass ?>"><?= $Page->payment_method->caption() ?><?= $Page->payment_method->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->payment_method->cellAttributes() ?>>
<span id="el_catering_payment_method">
<input type="<?= $Page->payment_method->getInputTextType() ?>" data-table="catering" data-field="x_payment_method" name="x_payment_method" id="x_payment_method" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->payment_method->getPlaceHolder()) ?>" value="<?= $Page->payment_method->EditValue ?>"<?= $Page->payment_method->editAttributes() ?> aria-describedby="x_payment_method_help">
<?= $Page->payment_method->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->payment_method->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->account_num->Visible) { // account_num ?>
    <div id="r_account_num" class="form-group row">
        <label id="elh_catering_account_num" for="x_account_num" class="<?= $Page->LeftColumnClass ?>"><?= $Page->account_num->caption() ?><?= $Page->account_num->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->account_num->cellAttributes() ?>>
<span id="el_catering_account_num">
<input type="<?= $Page->account_num->getInputTextType() ?>" data-table="catering" data-field="x_account_num" name="x_account_num" id="x_account_num" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->account_num->getPlaceHolder()) ?>" value="<?= $Page->account_num->EditValue ?>"<?= $Page->account_num->editAttributes() ?> aria-describedby="x_account_num_help">
<?= $Page->account_num->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->account_num->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sub_code->Visible) { // sub_code ?>
    <div id="r_sub_code" class="form-group row">
        <label id="elh_catering_sub_code" for="x_sub_code" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sub_code->caption() ?><?= $Page->sub_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->sub_code->cellAttributes() ?>>
<span id="el_catering_sub_code">
<input type="<?= $Page->sub_code->getInputTextType() ?>" data-table="catering" data-field="x_sub_code" name="x_sub_code" id="x_sub_code" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->sub_code->getPlaceHolder()) ?>" value="<?= $Page->sub_code->EditValue ?>"<?= $Page->sub_code->editAttributes() ?> aria-describedby="x_sub_code_help">
<?= $Page->sub_code->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sub_code->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status" class="form-group row">
        <label id="elh_catering_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->status->cellAttributes() ?>>
<span id="el_catering_status">
<input type="<?= $Page->status->getInputTextType() ?>" data-table="catering" data-field="x_status" name="x_status" id="x_status" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>" value="<?= $Page->status->EditValue ?>"<?= $Page->status->editAttributes() ?> aria-describedby="x_status_help">
<?= $Page->status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->order->Visible) { // order ?>
    <div id="r_order" class="form-group row">
        <label id="elh_catering_order" for="x_order" class="<?= $Page->LeftColumnClass ?>"><?= $Page->order->caption() ?><?= $Page->order->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->order->cellAttributes() ?>>
<span id="el_catering_order">
<textarea data-table="catering" data-field="x_order" name="x_order" id="x_order" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->order->getPlaceHolder()) ?>"<?= $Page->order->editAttributes() ?> aria-describedby="x_order_help"><?= $Page->order->EditValue ?></textarea>
<?= $Page->order->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->order->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
    <div id="r_timestamp" class="form-group row">
        <label id="elh_catering_timestamp" for="x_timestamp" class="<?= $Page->LeftColumnClass ?>"><?= $Page->timestamp->caption() ?><?= $Page->timestamp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->timestamp->cellAttributes() ?>>
<span id="el_catering_timestamp">
<input type="<?= $Page->timestamp->getInputTextType() ?>" data-table="catering" data-field="x_timestamp" name="x_timestamp" id="x_timestamp" placeholder="<?= HtmlEncode($Page->timestamp->getPlaceHolder()) ?>" value="<?= $Page->timestamp->EditValue ?>"<?= $Page->timestamp->editAttributes() ?> aria-describedby="x_timestamp_help">
<?= $Page->timestamp->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->timestamp->getErrorMessage() ?></div>
<?php if (!$Page->timestamp->ReadOnly && !$Page->timestamp->Disabled && !isset($Page->timestamp->EditAttrs["readonly"]) && !isset($Page->timestamp->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcateringedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fcateringedit", "x_timestamp", {"ignoreReadonly":true,"useCurrent":false,"format":0});
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
    ew.addEventHandlers("catering");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
