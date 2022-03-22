<?php

namespace PHPMaker2021\project1;

// Page object
$MealpackageEdit = &$Page;
?>
<script>
if (!ew.vars.tables.mealpackage) ew.vars.tables.mealpackage = <?= JsonEncode(GetClientVar("tables", "mealpackage")) ?>;
var currentForm, currentPageID;
var fmealpackageedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fmealpackageedit = currentForm = new ew.Form("fmealpackageedit", "edit");

    // Add fields
    var fields = ew.vars.tables.mealpackage.fields;
    fmealpackageedit.addFields([
        ["id", [fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["netid", [fields.netid.required ? ew.Validators.required(fields.netid.caption) : null], fields.netid.isInvalid],
        ["sid", [fields.sid.required ? ew.Validators.required(fields.sid.caption) : null], fields.sid.isInvalid],
        ["_email", [fields._email.required ? ew.Validators.required(fields._email.caption) : null], fields._email.isInvalid],
        ["firstname", [fields.firstname.required ? ew.Validators.required(fields.firstname.caption) : null], fields.firstname.isInvalid],
        ["lastname", [fields.lastname.required ? ew.Validators.required(fields.lastname.caption) : null], fields.lastname.isInvalid],
        ["phone", [fields.phone.required ? ew.Validators.required(fields.phone.caption) : null], fields.phone.isInvalid],
        ["dorm", [fields.dorm.required ? ew.Validators.required(fields.dorm.caption) : null], fields.dorm.isInvalid],
        ["meal", [fields.meal.required ? ew.Validators.required(fields.meal.caption) : null], fields.meal.isInvalid],
        ["refrigerator", [fields.refrigerator.required ? ew.Validators.required(fields.refrigerator.caption) : null], fields.refrigerator.isInvalid],
        ["microwave", [fields.microwave.required ? ew.Validators.required(fields.microwave.caption) : null], fields.microwave.isInvalid],
        ["water", [fields.water.required ? ew.Validators.required(fields.water.caption) : null], fields.water.isInvalid],
        ["requests", [fields.requests.required ? ew.Validators.required(fields.requests.caption) : null], fields.requests.isInvalid],
        ["room_number", [fields.room_number.required ? ew.Validators.required(fields.room_number.caption) : null], fields.room_number.isInvalid],
        ["amount", [fields.amount.required ? ew.Validators.required(fields.amount.caption) : null, ew.Validators.integer], fields.amount.isInvalid],
        ["payment", [fields.payment.required ? ew.Validators.required(fields.payment.caption) : null], fields.payment.isInvalid],
        ["status", [fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
        ["timestamp", [fields.timestamp.required ? ew.Validators.required(fields.timestamp.caption) : null, ew.Validators.datetime(0)], fields.timestamp.isInvalid],
        ["type", [fields.type.required ? ew.Validators.required(fields.type.caption) : null], fields.type.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fmealpackageedit,
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
    fmealpackageedit.validate = function () {
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
    fmealpackageedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmealpackageedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fmealpackageedit.lists.water = <?= $Page->water->toClientList($Page) ?>;
    loadjs.done("fmealpackageedit");
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
<form name="fmealpackageedit" id="fmealpackageedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="mealpackage">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_mealpackage_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_mealpackage_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="mealpackage" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->netid->Visible) { // netid ?>
    <div id="r_netid" class="form-group row">
        <label id="elh_mealpackage_netid" for="x_netid" class="<?= $Page->LeftColumnClass ?>"><?= $Page->netid->caption() ?><?= $Page->netid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->netid->cellAttributes() ?>>
<span id="el_mealpackage_netid">
<input type="<?= $Page->netid->getInputTextType() ?>" data-table="mealpackage" data-field="x_netid" name="x_netid" id="x_netid" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->netid->getPlaceHolder()) ?>" value="<?= $Page->netid->EditValue ?>"<?= $Page->netid->editAttributes() ?> aria-describedby="x_netid_help">
<?= $Page->netid->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->netid->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sid->Visible) { // sid ?>
    <div id="r_sid" class="form-group row">
        <label id="elh_mealpackage_sid" for="x_sid" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sid->caption() ?><?= $Page->sid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->sid->cellAttributes() ?>>
<span id="el_mealpackage_sid">
<input type="<?= $Page->sid->getInputTextType() ?>" data-table="mealpackage" data-field="x_sid" name="x_sid" id="x_sid" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->sid->getPlaceHolder()) ?>" value="<?= $Page->sid->EditValue ?>"<?= $Page->sid->editAttributes() ?> aria-describedby="x_sid_help">
<?= $Page->sid->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sid->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
    <div id="r__email" class="form-group row">
        <label id="elh_mealpackage__email" for="x__email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_email->caption() ?><?= $Page->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_email->cellAttributes() ?>>
<span id="el_mealpackage__email">
<input type="<?= $Page->_email->getInputTextType() ?>" data-table="mealpackage" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->_email->getPlaceHolder()) ?>" value="<?= $Page->_email->EditValue ?>"<?= $Page->_email->editAttributes() ?> aria-describedby="x__email_help">
<?= $Page->_email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->firstname->Visible) { // firstname ?>
    <div id="r_firstname" class="form-group row">
        <label id="elh_mealpackage_firstname" for="x_firstname" class="<?= $Page->LeftColumnClass ?>"><?= $Page->firstname->caption() ?><?= $Page->firstname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->firstname->cellAttributes() ?>>
<span id="el_mealpackage_firstname">
<input type="<?= $Page->firstname->getInputTextType() ?>" data-table="mealpackage" data-field="x_firstname" name="x_firstname" id="x_firstname" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->firstname->getPlaceHolder()) ?>" value="<?= $Page->firstname->EditValue ?>"<?= $Page->firstname->editAttributes() ?> aria-describedby="x_firstname_help">
<?= $Page->firstname->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->firstname->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lastname->Visible) { // lastname ?>
    <div id="r_lastname" class="form-group row">
        <label id="elh_mealpackage_lastname" for="x_lastname" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lastname->caption() ?><?= $Page->lastname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->lastname->cellAttributes() ?>>
<span id="el_mealpackage_lastname">
<input type="<?= $Page->lastname->getInputTextType() ?>" data-table="mealpackage" data-field="x_lastname" name="x_lastname" id="x_lastname" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->lastname->getPlaceHolder()) ?>" value="<?= $Page->lastname->EditValue ?>"<?= $Page->lastname->editAttributes() ?> aria-describedby="x_lastname_help">
<?= $Page->lastname->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lastname->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
    <div id="r_phone" class="form-group row">
        <label id="elh_mealpackage_phone" for="x_phone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->phone->caption() ?><?= $Page->phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->phone->cellAttributes() ?>>
<span id="el_mealpackage_phone">
<input type="<?= $Page->phone->getInputTextType() ?>" data-table="mealpackage" data-field="x_phone" name="x_phone" id="x_phone" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->phone->getPlaceHolder()) ?>" value="<?= $Page->phone->EditValue ?>"<?= $Page->phone->editAttributes() ?> aria-describedby="x_phone_help">
<?= $Page->phone->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->phone->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->dorm->Visible) { // dorm ?>
    <div id="r_dorm" class="form-group row">
        <label id="elh_mealpackage_dorm" for="x_dorm" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dorm->caption() ?><?= $Page->dorm->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->dorm->cellAttributes() ?>>
<span id="el_mealpackage_dorm">
<input type="<?= $Page->dorm->getInputTextType() ?>" data-table="mealpackage" data-field="x_dorm" name="x_dorm" id="x_dorm" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->dorm->getPlaceHolder()) ?>" value="<?= $Page->dorm->EditValue ?>"<?= $Page->dorm->editAttributes() ?> aria-describedby="x_dorm_help">
<?= $Page->dorm->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->dorm->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->meal->Visible) { // meal ?>
    <div id="r_meal" class="form-group row">
        <label id="elh_mealpackage_meal" for="x_meal" class="<?= $Page->LeftColumnClass ?>"><?= $Page->meal->caption() ?><?= $Page->meal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->meal->cellAttributes() ?>>
<span id="el_mealpackage_meal">
<input type="<?= $Page->meal->getInputTextType() ?>" data-table="mealpackage" data-field="x_meal" name="x_meal" id="x_meal" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->meal->getPlaceHolder()) ?>" value="<?= $Page->meal->EditValue ?>"<?= $Page->meal->editAttributes() ?> aria-describedby="x_meal_help">
<?= $Page->meal->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->meal->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->refrigerator->Visible) { // refrigerator ?>
    <div id="r_refrigerator" class="form-group row">
        <label id="elh_mealpackage_refrigerator" for="x_refrigerator" class="<?= $Page->LeftColumnClass ?>"><?= $Page->refrigerator->caption() ?><?= $Page->refrigerator->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->refrigerator->cellAttributes() ?>>
<span id="el_mealpackage_refrigerator">
<input type="<?= $Page->refrigerator->getInputTextType() ?>" data-table="mealpackage" data-field="x_refrigerator" name="x_refrigerator" id="x_refrigerator" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->refrigerator->getPlaceHolder()) ?>" value="<?= $Page->refrigerator->EditValue ?>"<?= $Page->refrigerator->editAttributes() ?> aria-describedby="x_refrigerator_help">
<?= $Page->refrigerator->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->refrigerator->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->microwave->Visible) { // microwave ?>
    <div id="r_microwave" class="form-group row">
        <label id="elh_mealpackage_microwave" for="x_microwave" class="<?= $Page->LeftColumnClass ?>"><?= $Page->microwave->caption() ?><?= $Page->microwave->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->microwave->cellAttributes() ?>>
<span id="el_mealpackage_microwave">
<input type="<?= $Page->microwave->getInputTextType() ?>" data-table="mealpackage" data-field="x_microwave" name="x_microwave" id="x_microwave" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->microwave->getPlaceHolder()) ?>" value="<?= $Page->microwave->EditValue ?>"<?= $Page->microwave->editAttributes() ?> aria-describedby="x_microwave_help">
<?= $Page->microwave->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->microwave->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->water->Visible) { // water ?>
    <div id="r_water" class="form-group row">
        <label id="elh_mealpackage_water" class="<?= $Page->LeftColumnClass ?>"><?= $Page->water->caption() ?><?= $Page->water->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->water->cellAttributes() ?>>
<span id="el_mealpackage_water">
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" class="custom-control-input<?= $Page->water->isInvalidClass() ?>" data-table="mealpackage" data-field="x_water" name="x_water[]" id="x_water_482875" value="1"<?= ConvertToBool($Page->water->CurrentValue) ? " checked" : "" ?><?= $Page->water->editAttributes() ?> aria-describedby="x_water_help">
    <label class="custom-control-label" for="x_water_482875"></label>
</div>
<?= $Page->water->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->water->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->requests->Visible) { // requests ?>
    <div id="r_requests" class="form-group row">
        <label id="elh_mealpackage_requests" for="x_requests" class="<?= $Page->LeftColumnClass ?>"><?= $Page->requests->caption() ?><?= $Page->requests->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->requests->cellAttributes() ?>>
<span id="el_mealpackage_requests">
<textarea data-table="mealpackage" data-field="x_requests" name="x_requests" id="x_requests" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->requests->getPlaceHolder()) ?>"<?= $Page->requests->editAttributes() ?> aria-describedby="x_requests_help"><?= $Page->requests->EditValue ?></textarea>
<?= $Page->requests->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->requests->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->room_number->Visible) { // room_number ?>
    <div id="r_room_number" class="form-group row">
        <label id="elh_mealpackage_room_number" for="x_room_number" class="<?= $Page->LeftColumnClass ?>"><?= $Page->room_number->caption() ?><?= $Page->room_number->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->room_number->cellAttributes() ?>>
<span id="el_mealpackage_room_number">
<input type="<?= $Page->room_number->getInputTextType() ?>" data-table="mealpackage" data-field="x_room_number" name="x_room_number" id="x_room_number" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->room_number->getPlaceHolder()) ?>" value="<?= $Page->room_number->EditValue ?>"<?= $Page->room_number->editAttributes() ?> aria-describedby="x_room_number_help">
<?= $Page->room_number->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->room_number->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->amount->Visible) { // amount ?>
    <div id="r_amount" class="form-group row">
        <label id="elh_mealpackage_amount" for="x_amount" class="<?= $Page->LeftColumnClass ?>"><?= $Page->amount->caption() ?><?= $Page->amount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->amount->cellAttributes() ?>>
<span id="el_mealpackage_amount">
<input type="<?= $Page->amount->getInputTextType() ?>" data-table="mealpackage" data-field="x_amount" name="x_amount" id="x_amount" size="30" placeholder="<?= HtmlEncode($Page->amount->getPlaceHolder()) ?>" value="<?= $Page->amount->EditValue ?>"<?= $Page->amount->editAttributes() ?> aria-describedby="x_amount_help">
<?= $Page->amount->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->amount->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->payment->Visible) { // payment ?>
    <div id="r_payment" class="form-group row">
        <label id="elh_mealpackage_payment" for="x_payment" class="<?= $Page->LeftColumnClass ?>"><?= $Page->payment->caption() ?><?= $Page->payment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->payment->cellAttributes() ?>>
<span id="el_mealpackage_payment">
<input type="<?= $Page->payment->getInputTextType() ?>" data-table="mealpackage" data-field="x_payment" name="x_payment" id="x_payment" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->payment->getPlaceHolder()) ?>" value="<?= $Page->payment->EditValue ?>"<?= $Page->payment->editAttributes() ?> aria-describedby="x_payment_help">
<?= $Page->payment->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->payment->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status" class="form-group row">
        <label id="elh_mealpackage_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->status->cellAttributes() ?>>
<span id="el_mealpackage_status">
<input type="<?= $Page->status->getInputTextType() ?>" data-table="mealpackage" data-field="x_status" name="x_status" id="x_status" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>" value="<?= $Page->status->EditValue ?>"<?= $Page->status->editAttributes() ?> aria-describedby="x_status_help">
<?= $Page->status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
    <div id="r_timestamp" class="form-group row">
        <label id="elh_mealpackage_timestamp" for="x_timestamp" class="<?= $Page->LeftColumnClass ?>"><?= $Page->timestamp->caption() ?><?= $Page->timestamp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->timestamp->cellAttributes() ?>>
<span id="el_mealpackage_timestamp">
<input type="<?= $Page->timestamp->getInputTextType() ?>" data-table="mealpackage" data-field="x_timestamp" name="x_timestamp" id="x_timestamp" placeholder="<?= HtmlEncode($Page->timestamp->getPlaceHolder()) ?>" value="<?= $Page->timestamp->EditValue ?>"<?= $Page->timestamp->editAttributes() ?> aria-describedby="x_timestamp_help">
<?= $Page->timestamp->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->timestamp->getErrorMessage() ?></div>
<?php if (!$Page->timestamp->ReadOnly && !$Page->timestamp->Disabled && !isset($Page->timestamp->EditAttrs["readonly"]) && !isset($Page->timestamp->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmealpackageedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fmealpackageedit", "x_timestamp", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
    <div id="r_type" class="form-group row">
        <label id="elh_mealpackage_type" for="x_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->type->caption() ?><?= $Page->type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->type->cellAttributes() ?>>
<span id="el_mealpackage_type">
<input type="<?= $Page->type->getInputTextType() ?>" data-table="mealpackage" data-field="x_type" name="x_type" id="x_type" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->type->getPlaceHolder()) ?>" value="<?= $Page->type->EditValue ?>"<?= $Page->type->editAttributes() ?> aria-describedby="x_type_help">
<?= $Page->type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->type->getErrorMessage() ?></div>
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
    ew.addEventHandlers("mealpackage");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
