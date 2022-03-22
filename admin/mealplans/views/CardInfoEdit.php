<?php

namespace PHPMaker2022\mealplans;

// Page object
$CardInfoEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { card_info: currentTable } });
var currentForm, currentPageID;
var fcard_infoedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcard_infoedit = new ew.Form("fcard_infoedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fcard_infoedit;

    // Add fields
    var fields = currentTable.fields;
    fcard_infoedit.addFields([
        ["card_id", [fields.card_id.visible && fields.card_id.required ? ew.Validators.required(fields.card_id.caption) : null], fields.card_id.isInvalid],
        ["cust_id", [fields.cust_id.visible && fields.cust_id.required ? ew.Validators.required(fields.cust_id.caption) : null, ew.Validators.integer], fields.cust_id.isInvalid],
        ["guest_id", [fields.guest_id.visible && fields.guest_id.required ? ew.Validators.required(fields.guest_id.caption) : null, ew.Validators.integer], fields.guest_id.isInvalid],
        ["first_name", [fields.first_name.visible && fields.first_name.required ? ew.Validators.required(fields.first_name.caption) : null], fields.first_name.isInvalid],
        ["last_name", [fields.last_name.visible && fields.last_name.required ? ew.Validators.required(fields.last_name.caption) : null], fields.last_name.isInvalid],
        ["address", [fields.address.visible && fields.address.required ? ew.Validators.required(fields.address.caption) : null], fields.address.isInvalid],
        ["city", [fields.city.visible && fields.city.required ? ew.Validators.required(fields.city.caption) : null], fields.city.isInvalid],
        ["state", [fields.state.visible && fields.state.required ? ew.Validators.required(fields.state.caption) : null], fields.state.isInvalid],
        ["zipcode", [fields.zipcode.visible && fields.zipcode.required ? ew.Validators.required(fields.zipcode.caption) : null], fields.zipcode.isInvalid],
        ["card_type", [fields.card_type.visible && fields.card_type.required ? ew.Validators.required(fields.card_type.caption) : null], fields.card_type.isInvalid],
        ["account_number", [fields.account_number.visible && fields.account_number.required ? ew.Validators.required(fields.account_number.caption) : null], fields.account_number.isInvalid],
        ["expiration_month", [fields.expiration_month.visible && fields.expiration_month.required ? ew.Validators.required(fields.expiration_month.caption) : null, ew.Validators.integer], fields.expiration_month.isInvalid],
        ["expiration_year", [fields.expiration_year.visible && fields.expiration_year.required ? ew.Validators.required(fields.expiration_year.caption) : null, ew.Validators.integer], fields.expiration_year.isInvalid],
        ["_email", [fields._email.visible && fields._email.required ? ew.Validators.required(fields._email.caption) : null], fields._email.isInvalid],
        ["phone", [fields.phone.visible && fields.phone.required ? ew.Validators.required(fields.phone.caption) : null], fields.phone.isInvalid]
    ]);

    // Form_CustomValidate
    fcard_infoedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fcard_infoedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fcard_infoedit");
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
<form name="fcard_infoedit" id="fcard_infoedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="card_info">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->card_id->Visible) { // card_id ?>
    <div id="r_card_id"<?= $Page->card_id->rowAttributes() ?>>
        <label id="elh_card_info_card_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->card_id->caption() ?><?= $Page->card_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->card_id->cellAttributes() ?>>
<span id="el_card_info_card_id">
<span<?= $Page->card_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->card_id->getDisplayValue($Page->card_id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="card_info" data-field="x_card_id" data-hidden="1" name="x_card_id" id="x_card_id" value="<?= HtmlEncode($Page->card_id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->cust_id->Visible) { // cust_id ?>
    <div id="r_cust_id"<?= $Page->cust_id->rowAttributes() ?>>
        <label id="elh_card_info_cust_id" for="x_cust_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->cust_id->caption() ?><?= $Page->cust_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->cust_id->cellAttributes() ?>>
<span id="el_card_info_cust_id">
<input type="<?= $Page->cust_id->getInputTextType() ?>" name="x_cust_id" id="x_cust_id" data-table="card_info" data-field="x_cust_id" value="<?= $Page->cust_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->cust_id->getPlaceHolder()) ?>"<?= $Page->cust_id->editAttributes() ?> aria-describedby="x_cust_id_help">
<?= $Page->cust_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->cust_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->guest_id->Visible) { // guest_id ?>
    <div id="r_guest_id"<?= $Page->guest_id->rowAttributes() ?>>
        <label id="elh_card_info_guest_id" for="x_guest_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->guest_id->caption() ?><?= $Page->guest_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->guest_id->cellAttributes() ?>>
<span id="el_card_info_guest_id">
<input type="<?= $Page->guest_id->getInputTextType() ?>" name="x_guest_id" id="x_guest_id" data-table="card_info" data-field="x_guest_id" value="<?= $Page->guest_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->guest_id->getPlaceHolder()) ?>"<?= $Page->guest_id->editAttributes() ?> aria-describedby="x_guest_id_help">
<?= $Page->guest_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->guest_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->first_name->Visible) { // first_name ?>
    <div id="r_first_name"<?= $Page->first_name->rowAttributes() ?>>
        <label id="elh_card_info_first_name" for="x_first_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->first_name->caption() ?><?= $Page->first_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->first_name->cellAttributes() ?>>
<span id="el_card_info_first_name">
<input type="<?= $Page->first_name->getInputTextType() ?>" name="x_first_name" id="x_first_name" data-table="card_info" data-field="x_first_name" value="<?= $Page->first_name->EditValue ?>" size="30" maxlength="60" placeholder="<?= HtmlEncode($Page->first_name->getPlaceHolder()) ?>"<?= $Page->first_name->editAttributes() ?> aria-describedby="x_first_name_help">
<?= $Page->first_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->first_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->last_name->Visible) { // last_name ?>
    <div id="r_last_name"<?= $Page->last_name->rowAttributes() ?>>
        <label id="elh_card_info_last_name" for="x_last_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->last_name->caption() ?><?= $Page->last_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->last_name->cellAttributes() ?>>
<span id="el_card_info_last_name">
<input type="<?= $Page->last_name->getInputTextType() ?>" name="x_last_name" id="x_last_name" data-table="card_info" data-field="x_last_name" value="<?= $Page->last_name->EditValue ?>" size="30" maxlength="60" placeholder="<?= HtmlEncode($Page->last_name->getPlaceHolder()) ?>"<?= $Page->last_name->editAttributes() ?> aria-describedby="x_last_name_help">
<?= $Page->last_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->last_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->address->Visible) { // address ?>
    <div id="r_address"<?= $Page->address->rowAttributes() ?>>
        <label id="elh_card_info_address" for="x_address" class="<?= $Page->LeftColumnClass ?>"><?= $Page->address->caption() ?><?= $Page->address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->address->cellAttributes() ?>>
<span id="el_card_info_address">
<input type="<?= $Page->address->getInputTextType() ?>" name="x_address" id="x_address" data-table="card_info" data-field="x_address" value="<?= $Page->address->EditValue ?>" size="30" maxlength="60" placeholder="<?= HtmlEncode($Page->address->getPlaceHolder()) ?>"<?= $Page->address->editAttributes() ?> aria-describedby="x_address_help">
<?= $Page->address->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->address->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->city->Visible) { // city ?>
    <div id="r_city"<?= $Page->city->rowAttributes() ?>>
        <label id="elh_card_info_city" for="x_city" class="<?= $Page->LeftColumnClass ?>"><?= $Page->city->caption() ?><?= $Page->city->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->city->cellAttributes() ?>>
<span id="el_card_info_city">
<input type="<?= $Page->city->getInputTextType() ?>" name="x_city" id="x_city" data-table="card_info" data-field="x_city" value="<?= $Page->city->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->city->getPlaceHolder()) ?>"<?= $Page->city->editAttributes() ?> aria-describedby="x_city_help">
<?= $Page->city->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->city->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->state->Visible) { // state ?>
    <div id="r_state"<?= $Page->state->rowAttributes() ?>>
        <label id="elh_card_info_state" for="x_state" class="<?= $Page->LeftColumnClass ?>"><?= $Page->state->caption() ?><?= $Page->state->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->state->cellAttributes() ?>>
<span id="el_card_info_state">
<input type="<?= $Page->state->getInputTextType() ?>" name="x_state" id="x_state" data-table="card_info" data-field="x_state" value="<?= $Page->state->EditValue ?>" size="30" maxlength="2" placeholder="<?= HtmlEncode($Page->state->getPlaceHolder()) ?>"<?= $Page->state->editAttributes() ?> aria-describedby="x_state_help">
<?= $Page->state->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->state->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->zipcode->Visible) { // zipcode ?>
    <div id="r_zipcode"<?= $Page->zipcode->rowAttributes() ?>>
        <label id="elh_card_info_zipcode" for="x_zipcode" class="<?= $Page->LeftColumnClass ?>"><?= $Page->zipcode->caption() ?><?= $Page->zipcode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->zipcode->cellAttributes() ?>>
<span id="el_card_info_zipcode">
<input type="<?= $Page->zipcode->getInputTextType() ?>" name="x_zipcode" id="x_zipcode" data-table="card_info" data-field="x_zipcode" value="<?= $Page->zipcode->EditValue ?>" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->zipcode->getPlaceHolder()) ?>"<?= $Page->zipcode->editAttributes() ?> aria-describedby="x_zipcode_help">
<?= $Page->zipcode->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->zipcode->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->card_type->Visible) { // card_type ?>
    <div id="r_card_type"<?= $Page->card_type->rowAttributes() ?>>
        <label id="elh_card_info_card_type" for="x_card_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->card_type->caption() ?><?= $Page->card_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->card_type->cellAttributes() ?>>
<span id="el_card_info_card_type">
<input type="<?= $Page->card_type->getInputTextType() ?>" name="x_card_type" id="x_card_type" data-table="card_info" data-field="x_card_type" value="<?= $Page->card_type->EditValue ?>" size="30" maxlength="3" placeholder="<?= HtmlEncode($Page->card_type->getPlaceHolder()) ?>"<?= $Page->card_type->editAttributes() ?> aria-describedby="x_card_type_help">
<?= $Page->card_type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->card_type->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->account_number->Visible) { // account_number ?>
    <div id="r_account_number"<?= $Page->account_number->rowAttributes() ?>>
        <label id="elh_card_info_account_number" for="x_account_number" class="<?= $Page->LeftColumnClass ?>"><?= $Page->account_number->caption() ?><?= $Page->account_number->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->account_number->cellAttributes() ?>>
<span id="el_card_info_account_number">
<input type="<?= $Page->account_number->getInputTextType() ?>" name="x_account_number" id="x_account_number" data-table="card_info" data-field="x_account_number" value="<?= $Page->account_number->EditValue ?>" size="30" maxlength="4" placeholder="<?= HtmlEncode($Page->account_number->getPlaceHolder()) ?>"<?= $Page->account_number->editAttributes() ?> aria-describedby="x_account_number_help">
<?= $Page->account_number->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->account_number->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->expiration_month->Visible) { // expiration_month ?>
    <div id="r_expiration_month"<?= $Page->expiration_month->rowAttributes() ?>>
        <label id="elh_card_info_expiration_month" for="x_expiration_month" class="<?= $Page->LeftColumnClass ?>"><?= $Page->expiration_month->caption() ?><?= $Page->expiration_month->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->expiration_month->cellAttributes() ?>>
<span id="el_card_info_expiration_month">
<input type="<?= $Page->expiration_month->getInputTextType() ?>" name="x_expiration_month" id="x_expiration_month" data-table="card_info" data-field="x_expiration_month" value="<?= $Page->expiration_month->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->expiration_month->getPlaceHolder()) ?>"<?= $Page->expiration_month->editAttributes() ?> aria-describedby="x_expiration_month_help">
<?= $Page->expiration_month->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->expiration_month->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->expiration_year->Visible) { // expiration_year ?>
    <div id="r_expiration_year"<?= $Page->expiration_year->rowAttributes() ?>>
        <label id="elh_card_info_expiration_year" for="x_expiration_year" class="<?= $Page->LeftColumnClass ?>"><?= $Page->expiration_year->caption() ?><?= $Page->expiration_year->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->expiration_year->cellAttributes() ?>>
<span id="el_card_info_expiration_year">
<input type="<?= $Page->expiration_year->getInputTextType() ?>" name="x_expiration_year" id="x_expiration_year" data-table="card_info" data-field="x_expiration_year" value="<?= $Page->expiration_year->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->expiration_year->getPlaceHolder()) ?>"<?= $Page->expiration_year->editAttributes() ?> aria-describedby="x_expiration_year_help">
<?= $Page->expiration_year->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->expiration_year->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
    <div id="r__email"<?= $Page->_email->rowAttributes() ?>>
        <label id="elh_card_info__email" for="x__email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_email->caption() ?><?= $Page->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_email->cellAttributes() ?>>
<span id="el_card_info__email">
<input type="<?= $Page->_email->getInputTextType() ?>" name="x__email" id="x__email" data-table="card_info" data-field="x__email" value="<?= $Page->_email->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->_email->getPlaceHolder()) ?>"<?= $Page->_email->editAttributes() ?> aria-describedby="x__email_help">
<?= $Page->_email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
    <div id="r_phone"<?= $Page->phone->rowAttributes() ?>>
        <label id="elh_card_info_phone" for="x_phone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->phone->caption() ?><?= $Page->phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->phone->cellAttributes() ?>>
<span id="el_card_info_phone">
<input type="<?= $Page->phone->getInputTextType() ?>" name="x_phone" id="x_phone" data-table="card_info" data-field="x_phone" value="<?= $Page->phone->EditValue ?>" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->phone->getPlaceHolder()) ?>"<?= $Page->phone->editAttributes() ?> aria-describedby="x_phone_help">
<?= $Page->phone->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->phone->getErrorMessage() ?></div>
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
    ew.addEventHandlers("card_info");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
