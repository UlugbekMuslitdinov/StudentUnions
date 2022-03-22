<?php

namespace PHPMaker2022\mealplans;

// Page object
$ChargePaymentEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { charge_payment: currentTable } });
var currentForm, currentPageID;
var fcharge_paymentedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcharge_paymentedit = new ew.Form("fcharge_paymentedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fcharge_paymentedit;

    // Add fields
    var fields = currentTable.fields;
    fcharge_paymentedit.addFields([
        ["charge_id", [fields.charge_id.visible && fields.charge_id.required ? ew.Validators.required(fields.charge_id.caption) : null], fields.charge_id.isInvalid],
        ["ch_first_name", [fields.ch_first_name.visible && fields.ch_first_name.required ? ew.Validators.required(fields.ch_first_name.caption) : null], fields.ch_first_name.isInvalid],
        ["ch_last_name", [fields.ch_last_name.visible && fields.ch_last_name.required ? ew.Validators.required(fields.ch_last_name.caption) : null], fields.ch_last_name.isInvalid],
        ["address", [fields.address.visible && fields.address.required ? ew.Validators.required(fields.address.caption) : null], fields.address.isInvalid],
        ["city", [fields.city.visible && fields.city.required ? ew.Validators.required(fields.city.caption) : null], fields.city.isInvalid],
        ["state", [fields.state.visible && fields.state.required ? ew.Validators.required(fields.state.caption) : null], fields.state.isInvalid],
        ["zipcode", [fields.zipcode.visible && fields.zipcode.required ? ew.Validators.required(fields.zipcode.caption) : null], fields.zipcode.isInvalid],
        ["card_type", [fields.card_type.visible && fields.card_type.required ? ew.Validators.required(fields.card_type.caption) : null], fields.card_type.isInvalid],
        ["expiration_month", [fields.expiration_month.visible && fields.expiration_month.required ? ew.Validators.required(fields.expiration_month.caption) : null, ew.Validators.integer], fields.expiration_month.isInvalid],
        ["expiration_year", [fields.expiration_year.visible && fields.expiration_year.required ? ew.Validators.required(fields.expiration_year.caption) : null, ew.Validators.integer], fields.expiration_year.isInvalid],
        ["cv_reply", [fields.cv_reply.visible && fields.cv_reply.required ? ew.Validators.required(fields.cv_reply.caption) : null], fields.cv_reply.isInvalid],
        ["charge_amount", [fields.charge_amount.visible && fields.charge_amount.required ? ew.Validators.required(fields.charge_amount.caption) : null, ew.Validators.float], fields.charge_amount.isInvalid],
        ["order_number", [fields.order_number.visible && fields.order_number.required ? ew.Validators.required(fields.order_number.caption) : null], fields.order_number.isInvalid],
        ["account_number", [fields.account_number.visible && fields.account_number.required ? ew.Validators.required(fields.account_number.caption) : null], fields.account_number.isInvalid],
        ["decision", [fields.decision.visible && fields.decision.required ? ew.Validators.required(fields.decision.caption) : null], fields.decision.isInvalid],
        ["reason_code", [fields.reason_code.visible && fields.reason_code.required ? ew.Validators.required(fields.reason_code.caption) : null, ew.Validators.integer], fields.reason_code.isInvalid],
        ["transaction_time", [fields.transaction_time.visible && fields.transaction_time.required ? ew.Validators.required(fields.transaction_time.caption) : null, ew.Validators.datetime(fields.transaction_time.clientFormatPattern)], fields.transaction_time.isInvalid],
        ["ch_email", [fields.ch_email.visible && fields.ch_email.required ? ew.Validators.required(fields.ch_email.caption) : null], fields.ch_email.isInvalid],
        ["ch_phone", [fields.ch_phone.visible && fields.ch_phone.required ? ew.Validators.required(fields.ch_phone.caption) : null], fields.ch_phone.isInvalid]
    ]);

    // Form_CustomValidate
    fcharge_paymentedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fcharge_paymentedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fcharge_paymentedit");
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
<form name="fcharge_paymentedit" id="fcharge_paymentedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="charge_payment">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->charge_id->Visible) { // charge_id ?>
    <div id="r_charge_id"<?= $Page->charge_id->rowAttributes() ?>>
        <label id="elh_charge_payment_charge_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->charge_id->caption() ?><?= $Page->charge_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->charge_id->cellAttributes() ?>>
<span id="el_charge_payment_charge_id">
<span<?= $Page->charge_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->charge_id->getDisplayValue($Page->charge_id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="charge_payment" data-field="x_charge_id" data-hidden="1" name="x_charge_id" id="x_charge_id" value="<?= HtmlEncode($Page->charge_id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ch_first_name->Visible) { // ch_first_name ?>
    <div id="r_ch_first_name"<?= $Page->ch_first_name->rowAttributes() ?>>
        <label id="elh_charge_payment_ch_first_name" for="x_ch_first_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ch_first_name->caption() ?><?= $Page->ch_first_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ch_first_name->cellAttributes() ?>>
<span id="el_charge_payment_ch_first_name">
<input type="<?= $Page->ch_first_name->getInputTextType() ?>" name="x_ch_first_name" id="x_ch_first_name" data-table="charge_payment" data-field="x_ch_first_name" value="<?= $Page->ch_first_name->EditValue ?>" size="30" maxlength="60" placeholder="<?= HtmlEncode($Page->ch_first_name->getPlaceHolder()) ?>"<?= $Page->ch_first_name->editAttributes() ?> aria-describedby="x_ch_first_name_help">
<?= $Page->ch_first_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ch_first_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ch_last_name->Visible) { // ch_last_name ?>
    <div id="r_ch_last_name"<?= $Page->ch_last_name->rowAttributes() ?>>
        <label id="elh_charge_payment_ch_last_name" for="x_ch_last_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ch_last_name->caption() ?><?= $Page->ch_last_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ch_last_name->cellAttributes() ?>>
<span id="el_charge_payment_ch_last_name">
<input type="<?= $Page->ch_last_name->getInputTextType() ?>" name="x_ch_last_name" id="x_ch_last_name" data-table="charge_payment" data-field="x_ch_last_name" value="<?= $Page->ch_last_name->EditValue ?>" size="30" maxlength="60" placeholder="<?= HtmlEncode($Page->ch_last_name->getPlaceHolder()) ?>"<?= $Page->ch_last_name->editAttributes() ?> aria-describedby="x_ch_last_name_help">
<?= $Page->ch_last_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ch_last_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->address->Visible) { // address ?>
    <div id="r_address"<?= $Page->address->rowAttributes() ?>>
        <label id="elh_charge_payment_address" for="x_address" class="<?= $Page->LeftColumnClass ?>"><?= $Page->address->caption() ?><?= $Page->address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->address->cellAttributes() ?>>
<span id="el_charge_payment_address">
<input type="<?= $Page->address->getInputTextType() ?>" name="x_address" id="x_address" data-table="charge_payment" data-field="x_address" value="<?= $Page->address->EditValue ?>" size="30" maxlength="60" placeholder="<?= HtmlEncode($Page->address->getPlaceHolder()) ?>"<?= $Page->address->editAttributes() ?> aria-describedby="x_address_help">
<?= $Page->address->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->address->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->city->Visible) { // city ?>
    <div id="r_city"<?= $Page->city->rowAttributes() ?>>
        <label id="elh_charge_payment_city" for="x_city" class="<?= $Page->LeftColumnClass ?>"><?= $Page->city->caption() ?><?= $Page->city->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->city->cellAttributes() ?>>
<span id="el_charge_payment_city">
<input type="<?= $Page->city->getInputTextType() ?>" name="x_city" id="x_city" data-table="charge_payment" data-field="x_city" value="<?= $Page->city->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->city->getPlaceHolder()) ?>"<?= $Page->city->editAttributes() ?> aria-describedby="x_city_help">
<?= $Page->city->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->city->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->state->Visible) { // state ?>
    <div id="r_state"<?= $Page->state->rowAttributes() ?>>
        <label id="elh_charge_payment_state" for="x_state" class="<?= $Page->LeftColumnClass ?>"><?= $Page->state->caption() ?><?= $Page->state->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->state->cellAttributes() ?>>
<span id="el_charge_payment_state">
<input type="<?= $Page->state->getInputTextType() ?>" name="x_state" id="x_state" data-table="charge_payment" data-field="x_state" value="<?= $Page->state->EditValue ?>" size="30" maxlength="2" placeholder="<?= HtmlEncode($Page->state->getPlaceHolder()) ?>"<?= $Page->state->editAttributes() ?> aria-describedby="x_state_help">
<?= $Page->state->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->state->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->zipcode->Visible) { // zipcode ?>
    <div id="r_zipcode"<?= $Page->zipcode->rowAttributes() ?>>
        <label id="elh_charge_payment_zipcode" for="x_zipcode" class="<?= $Page->LeftColumnClass ?>"><?= $Page->zipcode->caption() ?><?= $Page->zipcode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->zipcode->cellAttributes() ?>>
<span id="el_charge_payment_zipcode">
<input type="<?= $Page->zipcode->getInputTextType() ?>" name="x_zipcode" id="x_zipcode" data-table="charge_payment" data-field="x_zipcode" value="<?= $Page->zipcode->EditValue ?>" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->zipcode->getPlaceHolder()) ?>"<?= $Page->zipcode->editAttributes() ?> aria-describedby="x_zipcode_help">
<?= $Page->zipcode->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->zipcode->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->card_type->Visible) { // card_type ?>
    <div id="r_card_type"<?= $Page->card_type->rowAttributes() ?>>
        <label id="elh_charge_payment_card_type" for="x_card_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->card_type->caption() ?><?= $Page->card_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->card_type->cellAttributes() ?>>
<span id="el_charge_payment_card_type">
<input type="<?= $Page->card_type->getInputTextType() ?>" name="x_card_type" id="x_card_type" data-table="charge_payment" data-field="x_card_type" value="<?= $Page->card_type->EditValue ?>" size="30" maxlength="3" placeholder="<?= HtmlEncode($Page->card_type->getPlaceHolder()) ?>"<?= $Page->card_type->editAttributes() ?> aria-describedby="x_card_type_help">
<?= $Page->card_type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->card_type->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->expiration_month->Visible) { // expiration_month ?>
    <div id="r_expiration_month"<?= $Page->expiration_month->rowAttributes() ?>>
        <label id="elh_charge_payment_expiration_month" for="x_expiration_month" class="<?= $Page->LeftColumnClass ?>"><?= $Page->expiration_month->caption() ?><?= $Page->expiration_month->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->expiration_month->cellAttributes() ?>>
<span id="el_charge_payment_expiration_month">
<input type="<?= $Page->expiration_month->getInputTextType() ?>" name="x_expiration_month" id="x_expiration_month" data-table="charge_payment" data-field="x_expiration_month" value="<?= $Page->expiration_month->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->expiration_month->getPlaceHolder()) ?>"<?= $Page->expiration_month->editAttributes() ?> aria-describedby="x_expiration_month_help">
<?= $Page->expiration_month->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->expiration_month->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->expiration_year->Visible) { // expiration_year ?>
    <div id="r_expiration_year"<?= $Page->expiration_year->rowAttributes() ?>>
        <label id="elh_charge_payment_expiration_year" for="x_expiration_year" class="<?= $Page->LeftColumnClass ?>"><?= $Page->expiration_year->caption() ?><?= $Page->expiration_year->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->expiration_year->cellAttributes() ?>>
<span id="el_charge_payment_expiration_year">
<input type="<?= $Page->expiration_year->getInputTextType() ?>" name="x_expiration_year" id="x_expiration_year" data-table="charge_payment" data-field="x_expiration_year" value="<?= $Page->expiration_year->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->expiration_year->getPlaceHolder()) ?>"<?= $Page->expiration_year->editAttributes() ?> aria-describedby="x_expiration_year_help">
<?= $Page->expiration_year->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->expiration_year->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->cv_reply->Visible) { // cv_reply ?>
    <div id="r_cv_reply"<?= $Page->cv_reply->rowAttributes() ?>>
        <label id="elh_charge_payment_cv_reply" for="x_cv_reply" class="<?= $Page->LeftColumnClass ?>"><?= $Page->cv_reply->caption() ?><?= $Page->cv_reply->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->cv_reply->cellAttributes() ?>>
<span id="el_charge_payment_cv_reply">
<input type="<?= $Page->cv_reply->getInputTextType() ?>" name="x_cv_reply" id="x_cv_reply" data-table="charge_payment" data-field="x_cv_reply" value="<?= $Page->cv_reply->EditValue ?>" size="30" maxlength="1" placeholder="<?= HtmlEncode($Page->cv_reply->getPlaceHolder()) ?>"<?= $Page->cv_reply->editAttributes() ?> aria-describedby="x_cv_reply_help">
<?= $Page->cv_reply->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->cv_reply->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->charge_amount->Visible) { // charge_amount ?>
    <div id="r_charge_amount"<?= $Page->charge_amount->rowAttributes() ?>>
        <label id="elh_charge_payment_charge_amount" for="x_charge_amount" class="<?= $Page->LeftColumnClass ?>"><?= $Page->charge_amount->caption() ?><?= $Page->charge_amount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->charge_amount->cellAttributes() ?>>
<span id="el_charge_payment_charge_amount">
<input type="<?= $Page->charge_amount->getInputTextType() ?>" name="x_charge_amount" id="x_charge_amount" data-table="charge_payment" data-field="x_charge_amount" value="<?= $Page->charge_amount->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->charge_amount->getPlaceHolder()) ?>"<?= $Page->charge_amount->editAttributes() ?> aria-describedby="x_charge_amount_help">
<?= $Page->charge_amount->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->charge_amount->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->order_number->Visible) { // order_number ?>
    <div id="r_order_number"<?= $Page->order_number->rowAttributes() ?>>
        <label id="elh_charge_payment_order_number" for="x_order_number" class="<?= $Page->LeftColumnClass ?>"><?= $Page->order_number->caption() ?><?= $Page->order_number->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->order_number->cellAttributes() ?>>
<span id="el_charge_payment_order_number">
<input type="<?= $Page->order_number->getInputTextType() ?>" name="x_order_number" id="x_order_number" data-table="charge_payment" data-field="x_order_number" value="<?= $Page->order_number->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->order_number->getPlaceHolder()) ?>"<?= $Page->order_number->editAttributes() ?> aria-describedby="x_order_number_help">
<?= $Page->order_number->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->order_number->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->account_number->Visible) { // account_number ?>
    <div id="r_account_number"<?= $Page->account_number->rowAttributes() ?>>
        <label id="elh_charge_payment_account_number" for="x_account_number" class="<?= $Page->LeftColumnClass ?>"><?= $Page->account_number->caption() ?><?= $Page->account_number->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->account_number->cellAttributes() ?>>
<span id="el_charge_payment_account_number">
<input type="<?= $Page->account_number->getInputTextType() ?>" name="x_account_number" id="x_account_number" data-table="charge_payment" data-field="x_account_number" value="<?= $Page->account_number->EditValue ?>" size="30" maxlength="4" placeholder="<?= HtmlEncode($Page->account_number->getPlaceHolder()) ?>"<?= $Page->account_number->editAttributes() ?> aria-describedby="x_account_number_help">
<?= $Page->account_number->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->account_number->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->decision->Visible) { // decision ?>
    <div id="r_decision"<?= $Page->decision->rowAttributes() ?>>
        <label id="elh_charge_payment_decision" for="x_decision" class="<?= $Page->LeftColumnClass ?>"><?= $Page->decision->caption() ?><?= $Page->decision->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->decision->cellAttributes() ?>>
<span id="el_charge_payment_decision">
<input type="<?= $Page->decision->getInputTextType() ?>" name="x_decision" id="x_decision" data-table="charge_payment" data-field="x_decision" value="<?= $Page->decision->EditValue ?>" size="30" maxlength="6" placeholder="<?= HtmlEncode($Page->decision->getPlaceHolder()) ?>"<?= $Page->decision->editAttributes() ?> aria-describedby="x_decision_help">
<?= $Page->decision->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->decision->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->reason_code->Visible) { // reason_code ?>
    <div id="r_reason_code"<?= $Page->reason_code->rowAttributes() ?>>
        <label id="elh_charge_payment_reason_code" for="x_reason_code" class="<?= $Page->LeftColumnClass ?>"><?= $Page->reason_code->caption() ?><?= $Page->reason_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->reason_code->cellAttributes() ?>>
<span id="el_charge_payment_reason_code">
<input type="<?= $Page->reason_code->getInputTextType() ?>" name="x_reason_code" id="x_reason_code" data-table="charge_payment" data-field="x_reason_code" value="<?= $Page->reason_code->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->reason_code->getPlaceHolder()) ?>"<?= $Page->reason_code->editAttributes() ?> aria-describedby="x_reason_code_help">
<?= $Page->reason_code->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->reason_code->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->transaction_time->Visible) { // transaction_time ?>
    <div id="r_transaction_time"<?= $Page->transaction_time->rowAttributes() ?>>
        <label id="elh_charge_payment_transaction_time" for="x_transaction_time" class="<?= $Page->LeftColumnClass ?>"><?= $Page->transaction_time->caption() ?><?= $Page->transaction_time->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->transaction_time->cellAttributes() ?>>
<span id="el_charge_payment_transaction_time">
<input type="<?= $Page->transaction_time->getInputTextType() ?>" name="x_transaction_time" id="x_transaction_time" data-table="charge_payment" data-field="x_transaction_time" value="<?= $Page->transaction_time->EditValue ?>" placeholder="<?= HtmlEncode($Page->transaction_time->getPlaceHolder()) ?>"<?= $Page->transaction_time->editAttributes() ?> aria-describedby="x_transaction_time_help">
<?= $Page->transaction_time->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->transaction_time->getErrorMessage() ?></div>
<?php if (!$Page->transaction_time->ReadOnly && !$Page->transaction_time->Disabled && !isset($Page->transaction_time->EditAttrs["readonly"]) && !isset($Page->transaction_time->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcharge_paymentedit", "datetimepicker"], function () {
    let options = {
        localization: {
            locale: ew.LANGUAGE_ID
        },
        display: {
            inputFormat: "<?= DateFormat(0) ?>",
            icons: {
                previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
            }
        }
    };
    ew.createDateTimePicker("fcharge_paymentedit", "x_transaction_time", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ch_email->Visible) { // ch_email ?>
    <div id="r_ch_email"<?= $Page->ch_email->rowAttributes() ?>>
        <label id="elh_charge_payment_ch_email" for="x_ch_email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ch_email->caption() ?><?= $Page->ch_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ch_email->cellAttributes() ?>>
<span id="el_charge_payment_ch_email">
<input type="<?= $Page->ch_email->getInputTextType() ?>" name="x_ch_email" id="x_ch_email" data-table="charge_payment" data-field="x_ch_email" value="<?= $Page->ch_email->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->ch_email->getPlaceHolder()) ?>"<?= $Page->ch_email->editAttributes() ?> aria-describedby="x_ch_email_help">
<?= $Page->ch_email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ch_email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ch_phone->Visible) { // ch_phone ?>
    <div id="r_ch_phone"<?= $Page->ch_phone->rowAttributes() ?>>
        <label id="elh_charge_payment_ch_phone" for="x_ch_phone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ch_phone->caption() ?><?= $Page->ch_phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ch_phone->cellAttributes() ?>>
<span id="el_charge_payment_ch_phone">
<input type="<?= $Page->ch_phone->getInputTextType() ?>" name="x_ch_phone" id="x_ch_phone" data-table="charge_payment" data-field="x_ch_phone" value="<?= $Page->ch_phone->EditValue ?>" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->ch_phone->getPlaceHolder()) ?>"<?= $Page->ch_phone->editAttributes() ?> aria-describedby="x_ch_phone_help">
<?= $Page->ch_phone->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ch_phone->getErrorMessage() ?></div>
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
    ew.addEventHandlers("charge_payment");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
