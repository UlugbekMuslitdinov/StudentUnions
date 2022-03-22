<?php

namespace PHPMaker2021\project1;

// Page object
$RoomReservationAdd = &$Page;
?>
<script>
if (!ew.vars.tables.room_reservation) ew.vars.tables.room_reservation = <?= JsonEncode(GetClientVar("tables", "room_reservation")) ?>;
var currentForm, currentPageID;
var froom_reservationadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    froom_reservationadd = currentForm = new ew.Form("froom_reservationadd", "add");

    // Add fields
    var fields = ew.vars.tables.room_reservation.fields;
    froom_reservationadd.addFields([
        ["contact_org", [fields.contact_org.required ? ew.Validators.required(fields.contact_org.caption) : null], fields.contact_org.isInvalid],
        ["contact_name", [fields.contact_name.required ? ew.Validators.required(fields.contact_name.caption) : null], fields.contact_name.isInvalid],
        ["contact_email", [fields.contact_email.required ? ew.Validators.required(fields.contact_email.caption) : null], fields.contact_email.isInvalid],
        ["contact_phone", [fields.contact_phone.required ? ew.Validators.required(fields.contact_phone.caption) : null], fields.contact_phone.isInvalid],
        ["contact_fax", [fields.contact_fax.required ? ew.Validators.required(fields.contact_fax.caption) : null], fields.contact_fax.isInvalid],
        ["contact_address", [fields.contact_address.required ? ew.Validators.required(fields.contact_address.caption) : null], fields.contact_address.isInvalid],
        ["contact_city", [fields.contact_city.required ? ew.Validators.required(fields.contact_city.caption) : null], fields.contact_city.isInvalid],
        ["contact_state", [fields.contact_state.required ? ew.Validators.required(fields.contact_state.caption) : null], fields.contact_state.isInvalid],
        ["contact_zip", [fields.contact_zip.required ? ew.Validators.required(fields.contact_zip.caption) : null], fields.contact_zip.isInvalid],
        ["contact_advisor", [fields.contact_advisor.required ? ew.Validators.required(fields.contact_advisor.caption) : null], fields.contact_advisor.isInvalid],
        ["contact_advisor_phone", [fields.contact_advisor_phone.required ? ew.Validators.required(fields.contact_advisor_phone.caption) : null], fields.contact_advisor_phone.isInvalid],
        ["contact_advisor_email", [fields.contact_advisor_email.required ? ew.Validators.required(fields.contact_advisor_email.caption) : null], fields.contact_advisor_email.isInvalid],
        ["billing_org", [fields.billing_org.required ? ew.Validators.required(fields.billing_org.caption) : null], fields.billing_org.isInvalid],
        ["billing_name", [fields.billing_name.required ? ew.Validators.required(fields.billing_name.caption) : null], fields.billing_name.isInvalid],
        ["billing_email", [fields.billing_email.required ? ew.Validators.required(fields.billing_email.caption) : null], fields.billing_email.isInvalid],
        ["billing_phone", [fields.billing_phone.required ? ew.Validators.required(fields.billing_phone.caption) : null], fields.billing_phone.isInvalid],
        ["billing_fax", [fields.billing_fax.required ? ew.Validators.required(fields.billing_fax.caption) : null], fields.billing_fax.isInvalid],
        ["billing_address", [fields.billing_address.required ? ew.Validators.required(fields.billing_address.caption) : null], fields.billing_address.isInvalid],
        ["billing_city", [fields.billing_city.required ? ew.Validators.required(fields.billing_city.caption) : null], fields.billing_city.isInvalid],
        ["billing_state", [fields.billing_state.required ? ew.Validators.required(fields.billing_state.caption) : null], fields.billing_state.isInvalid],
        ["billing_zip", [fields.billing_zip.required ? ew.Validators.required(fields.billing_zip.caption) : null], fields.billing_zip.isInvalid],
        ["billing_method", [fields.billing_method.required ? ew.Validators.required(fields.billing_method.caption) : null], fields.billing_method.isInvalid],
        ["billing_frs", [fields.billing_frs.required ? ew.Validators.required(fields.billing_frs.caption) : null], fields.billing_frs.isInvalid],
        ["event_title", [fields.event_title.required ? ew.Validators.required(fields.event_title.caption) : null], fields.event_title.isInvalid],
        ["event_type", [fields.event_type.required ? ew.Validators.required(fields.event_type.caption) : null], fields.event_type.isInvalid],
        ["event_date", [fields.event_date.required ? ew.Validators.required(fields.event_date.caption) : null, ew.Validators.datetime(0)], fields.event_date.isInvalid],
        ["event_time_start", [fields.event_time_start.required ? ew.Validators.required(fields.event_time_start.caption) : null], fields.event_time_start.isInvalid],
        ["event_time_end", [fields.event_time_end.required ? ew.Validators.required(fields.event_time_end.caption) : null], fields.event_time_end.isInvalid],
        ["event_num_people", [fields.event_num_people.required ? ew.Validators.required(fields.event_num_people.caption) : null, ew.Validators.integer], fields.event_num_people.isInvalid],
        ["event_room_preference", [fields.event_room_preference.required ? ew.Validators.required(fields.event_room_preference.caption) : null], fields.event_room_preference.isInvalid],
        ["recurring_jan", [fields.recurring_jan.required ? ew.Validators.required(fields.recurring_jan.caption) : null], fields.recurring_jan.isInvalid],
        ["recurring_feb", [fields.recurring_feb.required ? ew.Validators.required(fields.recurring_feb.caption) : null], fields.recurring_feb.isInvalid],
        ["recurring_mar", [fields.recurring_mar.required ? ew.Validators.required(fields.recurring_mar.caption) : null], fields.recurring_mar.isInvalid],
        ["recurring_apr", [fields.recurring_apr.required ? ew.Validators.required(fields.recurring_apr.caption) : null], fields.recurring_apr.isInvalid],
        ["recurring_may", [fields.recurring_may.required ? ew.Validators.required(fields.recurring_may.caption) : null], fields.recurring_may.isInvalid],
        ["recurring_jun", [fields.recurring_jun.required ? ew.Validators.required(fields.recurring_jun.caption) : null], fields.recurring_jun.isInvalid],
        ["recurring_jul", [fields.recurring_jul.required ? ew.Validators.required(fields.recurring_jul.caption) : null], fields.recurring_jul.isInvalid],
        ["recurring_aug", [fields.recurring_aug.required ? ew.Validators.required(fields.recurring_aug.caption) : null], fields.recurring_aug.isInvalid],
        ["recurring_sep", [fields.recurring_sep.required ? ew.Validators.required(fields.recurring_sep.caption) : null], fields.recurring_sep.isInvalid],
        ["recurring_oct", [fields.recurring_oct.required ? ew.Validators.required(fields.recurring_oct.caption) : null], fields.recurring_oct.isInvalid],
        ["recurring_nov", [fields.recurring_nov.required ? ew.Validators.required(fields.recurring_nov.caption) : null], fields.recurring_nov.isInvalid],
        ["recurring_dec", [fields.recurring_dec.required ? ew.Validators.required(fields.recurring_dec.caption) : null], fields.recurring_dec.isInvalid],
        ["setup_shape", [fields.setup_shape.required ? ew.Validators.required(fields.setup_shape.caption) : null], fields.setup_shape.isInvalid],
        ["certification_name", [fields.certification_name.required ? ew.Validators.required(fields.certification_name.caption) : null], fields.certification_name.isInvalid],
        ["certification_date", [fields.certification_date.required ? ew.Validators.required(fields.certification_date.caption) : null, ew.Validators.datetime(0)], fields.certification_date.isInvalid],
        ["timestamp", [fields.timestamp.required ? ew.Validators.required(fields.timestamp.caption) : null, ew.Validators.datetime(0)], fields.timestamp.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = froom_reservationadd,
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
    froom_reservationadd.validate = function () {
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
    froom_reservationadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    froom_reservationadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("froom_reservationadd");
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
<form name="froom_reservationadd" id="froom_reservationadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="room_reservation">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->contact_org->Visible) { // contact_org ?>
    <div id="r_contact_org" class="form-group row">
        <label id="elh_room_reservation_contact_org" for="x_contact_org" class="<?= $Page->LeftColumnClass ?>"><?= $Page->contact_org->caption() ?><?= $Page->contact_org->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->contact_org->cellAttributes() ?>>
<span id="el_room_reservation_contact_org">
<input type="<?= $Page->contact_org->getInputTextType() ?>" data-table="room_reservation" data-field="x_contact_org" name="x_contact_org" id="x_contact_org" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->contact_org->getPlaceHolder()) ?>" value="<?= $Page->contact_org->EditValue ?>"<?= $Page->contact_org->editAttributes() ?> aria-describedby="x_contact_org_help">
<?= $Page->contact_org->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->contact_org->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->contact_name->Visible) { // contact_name ?>
    <div id="r_contact_name" class="form-group row">
        <label id="elh_room_reservation_contact_name" for="x_contact_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->contact_name->caption() ?><?= $Page->contact_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->contact_name->cellAttributes() ?>>
<span id="el_room_reservation_contact_name">
<input type="<?= $Page->contact_name->getInputTextType() ?>" data-table="room_reservation" data-field="x_contact_name" name="x_contact_name" id="x_contact_name" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->contact_name->getPlaceHolder()) ?>" value="<?= $Page->contact_name->EditValue ?>"<?= $Page->contact_name->editAttributes() ?> aria-describedby="x_contact_name_help">
<?= $Page->contact_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->contact_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->contact_email->Visible) { // contact_email ?>
    <div id="r_contact_email" class="form-group row">
        <label id="elh_room_reservation_contact_email" for="x_contact_email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->contact_email->caption() ?><?= $Page->contact_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->contact_email->cellAttributes() ?>>
<span id="el_room_reservation_contact_email">
<input type="<?= $Page->contact_email->getInputTextType() ?>" data-table="room_reservation" data-field="x_contact_email" name="x_contact_email" id="x_contact_email" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->contact_email->getPlaceHolder()) ?>" value="<?= $Page->contact_email->EditValue ?>"<?= $Page->contact_email->editAttributes() ?> aria-describedby="x_contact_email_help">
<?= $Page->contact_email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->contact_email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->contact_phone->Visible) { // contact_phone ?>
    <div id="r_contact_phone" class="form-group row">
        <label id="elh_room_reservation_contact_phone" for="x_contact_phone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->contact_phone->caption() ?><?= $Page->contact_phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->contact_phone->cellAttributes() ?>>
<span id="el_room_reservation_contact_phone">
<input type="<?= $Page->contact_phone->getInputTextType() ?>" data-table="room_reservation" data-field="x_contact_phone" name="x_contact_phone" id="x_contact_phone" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->contact_phone->getPlaceHolder()) ?>" value="<?= $Page->contact_phone->EditValue ?>"<?= $Page->contact_phone->editAttributes() ?> aria-describedby="x_contact_phone_help">
<?= $Page->contact_phone->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->contact_phone->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->contact_fax->Visible) { // contact_fax ?>
    <div id="r_contact_fax" class="form-group row">
        <label id="elh_room_reservation_contact_fax" for="x_contact_fax" class="<?= $Page->LeftColumnClass ?>"><?= $Page->contact_fax->caption() ?><?= $Page->contact_fax->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->contact_fax->cellAttributes() ?>>
<span id="el_room_reservation_contact_fax">
<input type="<?= $Page->contact_fax->getInputTextType() ?>" data-table="room_reservation" data-field="x_contact_fax" name="x_contact_fax" id="x_contact_fax" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->contact_fax->getPlaceHolder()) ?>" value="<?= $Page->contact_fax->EditValue ?>"<?= $Page->contact_fax->editAttributes() ?> aria-describedby="x_contact_fax_help">
<?= $Page->contact_fax->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->contact_fax->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->contact_address->Visible) { // contact_address ?>
    <div id="r_contact_address" class="form-group row">
        <label id="elh_room_reservation_contact_address" for="x_contact_address" class="<?= $Page->LeftColumnClass ?>"><?= $Page->contact_address->caption() ?><?= $Page->contact_address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->contact_address->cellAttributes() ?>>
<span id="el_room_reservation_contact_address">
<input type="<?= $Page->contact_address->getInputTextType() ?>" data-table="room_reservation" data-field="x_contact_address" name="x_contact_address" id="x_contact_address" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->contact_address->getPlaceHolder()) ?>" value="<?= $Page->contact_address->EditValue ?>"<?= $Page->contact_address->editAttributes() ?> aria-describedby="x_contact_address_help">
<?= $Page->contact_address->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->contact_address->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->contact_city->Visible) { // contact_city ?>
    <div id="r_contact_city" class="form-group row">
        <label id="elh_room_reservation_contact_city" for="x_contact_city" class="<?= $Page->LeftColumnClass ?>"><?= $Page->contact_city->caption() ?><?= $Page->contact_city->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->contact_city->cellAttributes() ?>>
<span id="el_room_reservation_contact_city">
<input type="<?= $Page->contact_city->getInputTextType() ?>" data-table="room_reservation" data-field="x_contact_city" name="x_contact_city" id="x_contact_city" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->contact_city->getPlaceHolder()) ?>" value="<?= $Page->contact_city->EditValue ?>"<?= $Page->contact_city->editAttributes() ?> aria-describedby="x_contact_city_help">
<?= $Page->contact_city->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->contact_city->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->contact_state->Visible) { // contact_state ?>
    <div id="r_contact_state" class="form-group row">
        <label id="elh_room_reservation_contact_state" for="x_contact_state" class="<?= $Page->LeftColumnClass ?>"><?= $Page->contact_state->caption() ?><?= $Page->contact_state->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->contact_state->cellAttributes() ?>>
<span id="el_room_reservation_contact_state">
<input type="<?= $Page->contact_state->getInputTextType() ?>" data-table="room_reservation" data-field="x_contact_state" name="x_contact_state" id="x_contact_state" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->contact_state->getPlaceHolder()) ?>" value="<?= $Page->contact_state->EditValue ?>"<?= $Page->contact_state->editAttributes() ?> aria-describedby="x_contact_state_help">
<?= $Page->contact_state->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->contact_state->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->contact_zip->Visible) { // contact_zip ?>
    <div id="r_contact_zip" class="form-group row">
        <label id="elh_room_reservation_contact_zip" for="x_contact_zip" class="<?= $Page->LeftColumnClass ?>"><?= $Page->contact_zip->caption() ?><?= $Page->contact_zip->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->contact_zip->cellAttributes() ?>>
<span id="el_room_reservation_contact_zip">
<input type="<?= $Page->contact_zip->getInputTextType() ?>" data-table="room_reservation" data-field="x_contact_zip" name="x_contact_zip" id="x_contact_zip" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->contact_zip->getPlaceHolder()) ?>" value="<?= $Page->contact_zip->EditValue ?>"<?= $Page->contact_zip->editAttributes() ?> aria-describedby="x_contact_zip_help">
<?= $Page->contact_zip->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->contact_zip->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->contact_advisor->Visible) { // contact_advisor ?>
    <div id="r_contact_advisor" class="form-group row">
        <label id="elh_room_reservation_contact_advisor" for="x_contact_advisor" class="<?= $Page->LeftColumnClass ?>"><?= $Page->contact_advisor->caption() ?><?= $Page->contact_advisor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->contact_advisor->cellAttributes() ?>>
<span id="el_room_reservation_contact_advisor">
<input type="<?= $Page->contact_advisor->getInputTextType() ?>" data-table="room_reservation" data-field="x_contact_advisor" name="x_contact_advisor" id="x_contact_advisor" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->contact_advisor->getPlaceHolder()) ?>" value="<?= $Page->contact_advisor->EditValue ?>"<?= $Page->contact_advisor->editAttributes() ?> aria-describedby="x_contact_advisor_help">
<?= $Page->contact_advisor->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->contact_advisor->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->contact_advisor_phone->Visible) { // contact_advisor_phone ?>
    <div id="r_contact_advisor_phone" class="form-group row">
        <label id="elh_room_reservation_contact_advisor_phone" for="x_contact_advisor_phone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->contact_advisor_phone->caption() ?><?= $Page->contact_advisor_phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->contact_advisor_phone->cellAttributes() ?>>
<span id="el_room_reservation_contact_advisor_phone">
<input type="<?= $Page->contact_advisor_phone->getInputTextType() ?>" data-table="room_reservation" data-field="x_contact_advisor_phone" name="x_contact_advisor_phone" id="x_contact_advisor_phone" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->contact_advisor_phone->getPlaceHolder()) ?>" value="<?= $Page->contact_advisor_phone->EditValue ?>"<?= $Page->contact_advisor_phone->editAttributes() ?> aria-describedby="x_contact_advisor_phone_help">
<?= $Page->contact_advisor_phone->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->contact_advisor_phone->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->contact_advisor_email->Visible) { // contact_advisor_email ?>
    <div id="r_contact_advisor_email" class="form-group row">
        <label id="elh_room_reservation_contact_advisor_email" for="x_contact_advisor_email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->contact_advisor_email->caption() ?><?= $Page->contact_advisor_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->contact_advisor_email->cellAttributes() ?>>
<span id="el_room_reservation_contact_advisor_email">
<input type="<?= $Page->contact_advisor_email->getInputTextType() ?>" data-table="room_reservation" data-field="x_contact_advisor_email" name="x_contact_advisor_email" id="x_contact_advisor_email" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->contact_advisor_email->getPlaceHolder()) ?>" value="<?= $Page->contact_advisor_email->EditValue ?>"<?= $Page->contact_advisor_email->editAttributes() ?> aria-describedby="x_contact_advisor_email_help">
<?= $Page->contact_advisor_email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->contact_advisor_email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->billing_org->Visible) { // billing_org ?>
    <div id="r_billing_org" class="form-group row">
        <label id="elh_room_reservation_billing_org" for="x_billing_org" class="<?= $Page->LeftColumnClass ?>"><?= $Page->billing_org->caption() ?><?= $Page->billing_org->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->billing_org->cellAttributes() ?>>
<span id="el_room_reservation_billing_org">
<input type="<?= $Page->billing_org->getInputTextType() ?>" data-table="room_reservation" data-field="x_billing_org" name="x_billing_org" id="x_billing_org" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->billing_org->getPlaceHolder()) ?>" value="<?= $Page->billing_org->EditValue ?>"<?= $Page->billing_org->editAttributes() ?> aria-describedby="x_billing_org_help">
<?= $Page->billing_org->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->billing_org->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->billing_name->Visible) { // billing_name ?>
    <div id="r_billing_name" class="form-group row">
        <label id="elh_room_reservation_billing_name" for="x_billing_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->billing_name->caption() ?><?= $Page->billing_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->billing_name->cellAttributes() ?>>
<span id="el_room_reservation_billing_name">
<input type="<?= $Page->billing_name->getInputTextType() ?>" data-table="room_reservation" data-field="x_billing_name" name="x_billing_name" id="x_billing_name" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->billing_name->getPlaceHolder()) ?>" value="<?= $Page->billing_name->EditValue ?>"<?= $Page->billing_name->editAttributes() ?> aria-describedby="x_billing_name_help">
<?= $Page->billing_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->billing_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->billing_email->Visible) { // billing_email ?>
    <div id="r_billing_email" class="form-group row">
        <label id="elh_room_reservation_billing_email" for="x_billing_email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->billing_email->caption() ?><?= $Page->billing_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->billing_email->cellAttributes() ?>>
<span id="el_room_reservation_billing_email">
<input type="<?= $Page->billing_email->getInputTextType() ?>" data-table="room_reservation" data-field="x_billing_email" name="x_billing_email" id="x_billing_email" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->billing_email->getPlaceHolder()) ?>" value="<?= $Page->billing_email->EditValue ?>"<?= $Page->billing_email->editAttributes() ?> aria-describedby="x_billing_email_help">
<?= $Page->billing_email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->billing_email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->billing_phone->Visible) { // billing_phone ?>
    <div id="r_billing_phone" class="form-group row">
        <label id="elh_room_reservation_billing_phone" for="x_billing_phone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->billing_phone->caption() ?><?= $Page->billing_phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->billing_phone->cellAttributes() ?>>
<span id="el_room_reservation_billing_phone">
<input type="<?= $Page->billing_phone->getInputTextType() ?>" data-table="room_reservation" data-field="x_billing_phone" name="x_billing_phone" id="x_billing_phone" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->billing_phone->getPlaceHolder()) ?>" value="<?= $Page->billing_phone->EditValue ?>"<?= $Page->billing_phone->editAttributes() ?> aria-describedby="x_billing_phone_help">
<?= $Page->billing_phone->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->billing_phone->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->billing_fax->Visible) { // billing_fax ?>
    <div id="r_billing_fax" class="form-group row">
        <label id="elh_room_reservation_billing_fax" for="x_billing_fax" class="<?= $Page->LeftColumnClass ?>"><?= $Page->billing_fax->caption() ?><?= $Page->billing_fax->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->billing_fax->cellAttributes() ?>>
<span id="el_room_reservation_billing_fax">
<input type="<?= $Page->billing_fax->getInputTextType() ?>" data-table="room_reservation" data-field="x_billing_fax" name="x_billing_fax" id="x_billing_fax" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->billing_fax->getPlaceHolder()) ?>" value="<?= $Page->billing_fax->EditValue ?>"<?= $Page->billing_fax->editAttributes() ?> aria-describedby="x_billing_fax_help">
<?= $Page->billing_fax->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->billing_fax->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->billing_address->Visible) { // billing_address ?>
    <div id="r_billing_address" class="form-group row">
        <label id="elh_room_reservation_billing_address" for="x_billing_address" class="<?= $Page->LeftColumnClass ?>"><?= $Page->billing_address->caption() ?><?= $Page->billing_address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->billing_address->cellAttributes() ?>>
<span id="el_room_reservation_billing_address">
<input type="<?= $Page->billing_address->getInputTextType() ?>" data-table="room_reservation" data-field="x_billing_address" name="x_billing_address" id="x_billing_address" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->billing_address->getPlaceHolder()) ?>" value="<?= $Page->billing_address->EditValue ?>"<?= $Page->billing_address->editAttributes() ?> aria-describedby="x_billing_address_help">
<?= $Page->billing_address->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->billing_address->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->billing_city->Visible) { // billing_city ?>
    <div id="r_billing_city" class="form-group row">
        <label id="elh_room_reservation_billing_city" for="x_billing_city" class="<?= $Page->LeftColumnClass ?>"><?= $Page->billing_city->caption() ?><?= $Page->billing_city->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->billing_city->cellAttributes() ?>>
<span id="el_room_reservation_billing_city">
<input type="<?= $Page->billing_city->getInputTextType() ?>" data-table="room_reservation" data-field="x_billing_city" name="x_billing_city" id="x_billing_city" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->billing_city->getPlaceHolder()) ?>" value="<?= $Page->billing_city->EditValue ?>"<?= $Page->billing_city->editAttributes() ?> aria-describedby="x_billing_city_help">
<?= $Page->billing_city->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->billing_city->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->billing_state->Visible) { // billing_state ?>
    <div id="r_billing_state" class="form-group row">
        <label id="elh_room_reservation_billing_state" for="x_billing_state" class="<?= $Page->LeftColumnClass ?>"><?= $Page->billing_state->caption() ?><?= $Page->billing_state->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->billing_state->cellAttributes() ?>>
<span id="el_room_reservation_billing_state">
<input type="<?= $Page->billing_state->getInputTextType() ?>" data-table="room_reservation" data-field="x_billing_state" name="x_billing_state" id="x_billing_state" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->billing_state->getPlaceHolder()) ?>" value="<?= $Page->billing_state->EditValue ?>"<?= $Page->billing_state->editAttributes() ?> aria-describedby="x_billing_state_help">
<?= $Page->billing_state->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->billing_state->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->billing_zip->Visible) { // billing_zip ?>
    <div id="r_billing_zip" class="form-group row">
        <label id="elh_room_reservation_billing_zip" for="x_billing_zip" class="<?= $Page->LeftColumnClass ?>"><?= $Page->billing_zip->caption() ?><?= $Page->billing_zip->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->billing_zip->cellAttributes() ?>>
<span id="el_room_reservation_billing_zip">
<input type="<?= $Page->billing_zip->getInputTextType() ?>" data-table="room_reservation" data-field="x_billing_zip" name="x_billing_zip" id="x_billing_zip" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->billing_zip->getPlaceHolder()) ?>" value="<?= $Page->billing_zip->EditValue ?>"<?= $Page->billing_zip->editAttributes() ?> aria-describedby="x_billing_zip_help">
<?= $Page->billing_zip->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->billing_zip->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->billing_method->Visible) { // billing_method ?>
    <div id="r_billing_method" class="form-group row">
        <label id="elh_room_reservation_billing_method" for="x_billing_method" class="<?= $Page->LeftColumnClass ?>"><?= $Page->billing_method->caption() ?><?= $Page->billing_method->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->billing_method->cellAttributes() ?>>
<span id="el_room_reservation_billing_method">
<input type="<?= $Page->billing_method->getInputTextType() ?>" data-table="room_reservation" data-field="x_billing_method" name="x_billing_method" id="x_billing_method" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->billing_method->getPlaceHolder()) ?>" value="<?= $Page->billing_method->EditValue ?>"<?= $Page->billing_method->editAttributes() ?> aria-describedby="x_billing_method_help">
<?= $Page->billing_method->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->billing_method->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->billing_frs->Visible) { // billing_frs ?>
    <div id="r_billing_frs" class="form-group row">
        <label id="elh_room_reservation_billing_frs" for="x_billing_frs" class="<?= $Page->LeftColumnClass ?>"><?= $Page->billing_frs->caption() ?><?= $Page->billing_frs->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->billing_frs->cellAttributes() ?>>
<span id="el_room_reservation_billing_frs">
<input type="<?= $Page->billing_frs->getInputTextType() ?>" data-table="room_reservation" data-field="x_billing_frs" name="x_billing_frs" id="x_billing_frs" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->billing_frs->getPlaceHolder()) ?>" value="<?= $Page->billing_frs->EditValue ?>"<?= $Page->billing_frs->editAttributes() ?> aria-describedby="x_billing_frs_help">
<?= $Page->billing_frs->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->billing_frs->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->event_title->Visible) { // event_title ?>
    <div id="r_event_title" class="form-group row">
        <label id="elh_room_reservation_event_title" for="x_event_title" class="<?= $Page->LeftColumnClass ?>"><?= $Page->event_title->caption() ?><?= $Page->event_title->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->event_title->cellAttributes() ?>>
<span id="el_room_reservation_event_title">
<input type="<?= $Page->event_title->getInputTextType() ?>" data-table="room_reservation" data-field="x_event_title" name="x_event_title" id="x_event_title" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->event_title->getPlaceHolder()) ?>" value="<?= $Page->event_title->EditValue ?>"<?= $Page->event_title->editAttributes() ?> aria-describedby="x_event_title_help">
<?= $Page->event_title->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->event_title->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->event_type->Visible) { // event_type ?>
    <div id="r_event_type" class="form-group row">
        <label id="elh_room_reservation_event_type" for="x_event_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->event_type->caption() ?><?= $Page->event_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->event_type->cellAttributes() ?>>
<span id="el_room_reservation_event_type">
<input type="<?= $Page->event_type->getInputTextType() ?>" data-table="room_reservation" data-field="x_event_type" name="x_event_type" id="x_event_type" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->event_type->getPlaceHolder()) ?>" value="<?= $Page->event_type->EditValue ?>"<?= $Page->event_type->editAttributes() ?> aria-describedby="x_event_type_help">
<?= $Page->event_type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->event_type->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->event_date->Visible) { // event_date ?>
    <div id="r_event_date" class="form-group row">
        <label id="elh_room_reservation_event_date" for="x_event_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->event_date->caption() ?><?= $Page->event_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->event_date->cellAttributes() ?>>
<span id="el_room_reservation_event_date">
<input type="<?= $Page->event_date->getInputTextType() ?>" data-table="room_reservation" data-field="x_event_date" name="x_event_date" id="x_event_date" placeholder="<?= HtmlEncode($Page->event_date->getPlaceHolder()) ?>" value="<?= $Page->event_date->EditValue ?>"<?= $Page->event_date->editAttributes() ?> aria-describedby="x_event_date_help">
<?= $Page->event_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->event_date->getErrorMessage() ?></div>
<?php if (!$Page->event_date->ReadOnly && !$Page->event_date->Disabled && !isset($Page->event_date->EditAttrs["readonly"]) && !isset($Page->event_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["froom_reservationadd", "datetimepicker"], function() {
    ew.createDateTimePicker("froom_reservationadd", "x_event_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->event_time_start->Visible) { // event_time_start ?>
    <div id="r_event_time_start" class="form-group row">
        <label id="elh_room_reservation_event_time_start" for="x_event_time_start" class="<?= $Page->LeftColumnClass ?>"><?= $Page->event_time_start->caption() ?><?= $Page->event_time_start->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->event_time_start->cellAttributes() ?>>
<span id="el_room_reservation_event_time_start">
<input type="<?= $Page->event_time_start->getInputTextType() ?>" data-table="room_reservation" data-field="x_event_time_start" name="x_event_time_start" id="x_event_time_start" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->event_time_start->getPlaceHolder()) ?>" value="<?= $Page->event_time_start->EditValue ?>"<?= $Page->event_time_start->editAttributes() ?> aria-describedby="x_event_time_start_help">
<?= $Page->event_time_start->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->event_time_start->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->event_time_end->Visible) { // event_time_end ?>
    <div id="r_event_time_end" class="form-group row">
        <label id="elh_room_reservation_event_time_end" for="x_event_time_end" class="<?= $Page->LeftColumnClass ?>"><?= $Page->event_time_end->caption() ?><?= $Page->event_time_end->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->event_time_end->cellAttributes() ?>>
<span id="el_room_reservation_event_time_end">
<input type="<?= $Page->event_time_end->getInputTextType() ?>" data-table="room_reservation" data-field="x_event_time_end" name="x_event_time_end" id="x_event_time_end" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->event_time_end->getPlaceHolder()) ?>" value="<?= $Page->event_time_end->EditValue ?>"<?= $Page->event_time_end->editAttributes() ?> aria-describedby="x_event_time_end_help">
<?= $Page->event_time_end->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->event_time_end->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->event_num_people->Visible) { // event_num_people ?>
    <div id="r_event_num_people" class="form-group row">
        <label id="elh_room_reservation_event_num_people" for="x_event_num_people" class="<?= $Page->LeftColumnClass ?>"><?= $Page->event_num_people->caption() ?><?= $Page->event_num_people->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->event_num_people->cellAttributes() ?>>
<span id="el_room_reservation_event_num_people">
<input type="<?= $Page->event_num_people->getInputTextType() ?>" data-table="room_reservation" data-field="x_event_num_people" name="x_event_num_people" id="x_event_num_people" size="30" placeholder="<?= HtmlEncode($Page->event_num_people->getPlaceHolder()) ?>" value="<?= $Page->event_num_people->EditValue ?>"<?= $Page->event_num_people->editAttributes() ?> aria-describedby="x_event_num_people_help">
<?= $Page->event_num_people->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->event_num_people->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->event_room_preference->Visible) { // event_room_preference ?>
    <div id="r_event_room_preference" class="form-group row">
        <label id="elh_room_reservation_event_room_preference" for="x_event_room_preference" class="<?= $Page->LeftColumnClass ?>"><?= $Page->event_room_preference->caption() ?><?= $Page->event_room_preference->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->event_room_preference->cellAttributes() ?>>
<span id="el_room_reservation_event_room_preference">
<input type="<?= $Page->event_room_preference->getInputTextType() ?>" data-table="room_reservation" data-field="x_event_room_preference" name="x_event_room_preference" id="x_event_room_preference" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->event_room_preference->getPlaceHolder()) ?>" value="<?= $Page->event_room_preference->EditValue ?>"<?= $Page->event_room_preference->editAttributes() ?> aria-describedby="x_event_room_preference_help">
<?= $Page->event_room_preference->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->event_room_preference->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->recurring_jan->Visible) { // recurring_jan ?>
    <div id="r_recurring_jan" class="form-group row">
        <label id="elh_room_reservation_recurring_jan" for="x_recurring_jan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->recurring_jan->caption() ?><?= $Page->recurring_jan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->recurring_jan->cellAttributes() ?>>
<span id="el_room_reservation_recurring_jan">
<input type="<?= $Page->recurring_jan->getInputTextType() ?>" data-table="room_reservation" data-field="x_recurring_jan" name="x_recurring_jan" id="x_recurring_jan" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->recurring_jan->getPlaceHolder()) ?>" value="<?= $Page->recurring_jan->EditValue ?>"<?= $Page->recurring_jan->editAttributes() ?> aria-describedby="x_recurring_jan_help">
<?= $Page->recurring_jan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->recurring_jan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->recurring_feb->Visible) { // recurring_feb ?>
    <div id="r_recurring_feb" class="form-group row">
        <label id="elh_room_reservation_recurring_feb" for="x_recurring_feb" class="<?= $Page->LeftColumnClass ?>"><?= $Page->recurring_feb->caption() ?><?= $Page->recurring_feb->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->recurring_feb->cellAttributes() ?>>
<span id="el_room_reservation_recurring_feb">
<input type="<?= $Page->recurring_feb->getInputTextType() ?>" data-table="room_reservation" data-field="x_recurring_feb" name="x_recurring_feb" id="x_recurring_feb" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->recurring_feb->getPlaceHolder()) ?>" value="<?= $Page->recurring_feb->EditValue ?>"<?= $Page->recurring_feb->editAttributes() ?> aria-describedby="x_recurring_feb_help">
<?= $Page->recurring_feb->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->recurring_feb->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->recurring_mar->Visible) { // recurring_mar ?>
    <div id="r_recurring_mar" class="form-group row">
        <label id="elh_room_reservation_recurring_mar" for="x_recurring_mar" class="<?= $Page->LeftColumnClass ?>"><?= $Page->recurring_mar->caption() ?><?= $Page->recurring_mar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->recurring_mar->cellAttributes() ?>>
<span id="el_room_reservation_recurring_mar">
<input type="<?= $Page->recurring_mar->getInputTextType() ?>" data-table="room_reservation" data-field="x_recurring_mar" name="x_recurring_mar" id="x_recurring_mar" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->recurring_mar->getPlaceHolder()) ?>" value="<?= $Page->recurring_mar->EditValue ?>"<?= $Page->recurring_mar->editAttributes() ?> aria-describedby="x_recurring_mar_help">
<?= $Page->recurring_mar->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->recurring_mar->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->recurring_apr->Visible) { // recurring_apr ?>
    <div id="r_recurring_apr" class="form-group row">
        <label id="elh_room_reservation_recurring_apr" for="x_recurring_apr" class="<?= $Page->LeftColumnClass ?>"><?= $Page->recurring_apr->caption() ?><?= $Page->recurring_apr->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->recurring_apr->cellAttributes() ?>>
<span id="el_room_reservation_recurring_apr">
<input type="<?= $Page->recurring_apr->getInputTextType() ?>" data-table="room_reservation" data-field="x_recurring_apr" name="x_recurring_apr" id="x_recurring_apr" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->recurring_apr->getPlaceHolder()) ?>" value="<?= $Page->recurring_apr->EditValue ?>"<?= $Page->recurring_apr->editAttributes() ?> aria-describedby="x_recurring_apr_help">
<?= $Page->recurring_apr->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->recurring_apr->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->recurring_may->Visible) { // recurring_may ?>
    <div id="r_recurring_may" class="form-group row">
        <label id="elh_room_reservation_recurring_may" for="x_recurring_may" class="<?= $Page->LeftColumnClass ?>"><?= $Page->recurring_may->caption() ?><?= $Page->recurring_may->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->recurring_may->cellAttributes() ?>>
<span id="el_room_reservation_recurring_may">
<input type="<?= $Page->recurring_may->getInputTextType() ?>" data-table="room_reservation" data-field="x_recurring_may" name="x_recurring_may" id="x_recurring_may" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->recurring_may->getPlaceHolder()) ?>" value="<?= $Page->recurring_may->EditValue ?>"<?= $Page->recurring_may->editAttributes() ?> aria-describedby="x_recurring_may_help">
<?= $Page->recurring_may->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->recurring_may->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->recurring_jun->Visible) { // recurring_jun ?>
    <div id="r_recurring_jun" class="form-group row">
        <label id="elh_room_reservation_recurring_jun" for="x_recurring_jun" class="<?= $Page->LeftColumnClass ?>"><?= $Page->recurring_jun->caption() ?><?= $Page->recurring_jun->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->recurring_jun->cellAttributes() ?>>
<span id="el_room_reservation_recurring_jun">
<input type="<?= $Page->recurring_jun->getInputTextType() ?>" data-table="room_reservation" data-field="x_recurring_jun" name="x_recurring_jun" id="x_recurring_jun" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->recurring_jun->getPlaceHolder()) ?>" value="<?= $Page->recurring_jun->EditValue ?>"<?= $Page->recurring_jun->editAttributes() ?> aria-describedby="x_recurring_jun_help">
<?= $Page->recurring_jun->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->recurring_jun->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->recurring_jul->Visible) { // recurring_jul ?>
    <div id="r_recurring_jul" class="form-group row">
        <label id="elh_room_reservation_recurring_jul" for="x_recurring_jul" class="<?= $Page->LeftColumnClass ?>"><?= $Page->recurring_jul->caption() ?><?= $Page->recurring_jul->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->recurring_jul->cellAttributes() ?>>
<span id="el_room_reservation_recurring_jul">
<input type="<?= $Page->recurring_jul->getInputTextType() ?>" data-table="room_reservation" data-field="x_recurring_jul" name="x_recurring_jul" id="x_recurring_jul" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->recurring_jul->getPlaceHolder()) ?>" value="<?= $Page->recurring_jul->EditValue ?>"<?= $Page->recurring_jul->editAttributes() ?> aria-describedby="x_recurring_jul_help">
<?= $Page->recurring_jul->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->recurring_jul->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->recurring_aug->Visible) { // recurring_aug ?>
    <div id="r_recurring_aug" class="form-group row">
        <label id="elh_room_reservation_recurring_aug" for="x_recurring_aug" class="<?= $Page->LeftColumnClass ?>"><?= $Page->recurring_aug->caption() ?><?= $Page->recurring_aug->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->recurring_aug->cellAttributes() ?>>
<span id="el_room_reservation_recurring_aug">
<input type="<?= $Page->recurring_aug->getInputTextType() ?>" data-table="room_reservation" data-field="x_recurring_aug" name="x_recurring_aug" id="x_recurring_aug" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->recurring_aug->getPlaceHolder()) ?>" value="<?= $Page->recurring_aug->EditValue ?>"<?= $Page->recurring_aug->editAttributes() ?> aria-describedby="x_recurring_aug_help">
<?= $Page->recurring_aug->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->recurring_aug->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->recurring_sep->Visible) { // recurring_sep ?>
    <div id="r_recurring_sep" class="form-group row">
        <label id="elh_room_reservation_recurring_sep" for="x_recurring_sep" class="<?= $Page->LeftColumnClass ?>"><?= $Page->recurring_sep->caption() ?><?= $Page->recurring_sep->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->recurring_sep->cellAttributes() ?>>
<span id="el_room_reservation_recurring_sep">
<input type="<?= $Page->recurring_sep->getInputTextType() ?>" data-table="room_reservation" data-field="x_recurring_sep" name="x_recurring_sep" id="x_recurring_sep" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->recurring_sep->getPlaceHolder()) ?>" value="<?= $Page->recurring_sep->EditValue ?>"<?= $Page->recurring_sep->editAttributes() ?> aria-describedby="x_recurring_sep_help">
<?= $Page->recurring_sep->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->recurring_sep->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->recurring_oct->Visible) { // recurring_oct ?>
    <div id="r_recurring_oct" class="form-group row">
        <label id="elh_room_reservation_recurring_oct" for="x_recurring_oct" class="<?= $Page->LeftColumnClass ?>"><?= $Page->recurring_oct->caption() ?><?= $Page->recurring_oct->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->recurring_oct->cellAttributes() ?>>
<span id="el_room_reservation_recurring_oct">
<input type="<?= $Page->recurring_oct->getInputTextType() ?>" data-table="room_reservation" data-field="x_recurring_oct" name="x_recurring_oct" id="x_recurring_oct" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->recurring_oct->getPlaceHolder()) ?>" value="<?= $Page->recurring_oct->EditValue ?>"<?= $Page->recurring_oct->editAttributes() ?> aria-describedby="x_recurring_oct_help">
<?= $Page->recurring_oct->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->recurring_oct->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->recurring_nov->Visible) { // recurring_nov ?>
    <div id="r_recurring_nov" class="form-group row">
        <label id="elh_room_reservation_recurring_nov" for="x_recurring_nov" class="<?= $Page->LeftColumnClass ?>"><?= $Page->recurring_nov->caption() ?><?= $Page->recurring_nov->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->recurring_nov->cellAttributes() ?>>
<span id="el_room_reservation_recurring_nov">
<input type="<?= $Page->recurring_nov->getInputTextType() ?>" data-table="room_reservation" data-field="x_recurring_nov" name="x_recurring_nov" id="x_recurring_nov" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->recurring_nov->getPlaceHolder()) ?>" value="<?= $Page->recurring_nov->EditValue ?>"<?= $Page->recurring_nov->editAttributes() ?> aria-describedby="x_recurring_nov_help">
<?= $Page->recurring_nov->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->recurring_nov->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->recurring_dec->Visible) { // recurring_dec ?>
    <div id="r_recurring_dec" class="form-group row">
        <label id="elh_room_reservation_recurring_dec" for="x_recurring_dec" class="<?= $Page->LeftColumnClass ?>"><?= $Page->recurring_dec->caption() ?><?= $Page->recurring_dec->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->recurring_dec->cellAttributes() ?>>
<span id="el_room_reservation_recurring_dec">
<input type="<?= $Page->recurring_dec->getInputTextType() ?>" data-table="room_reservation" data-field="x_recurring_dec" name="x_recurring_dec" id="x_recurring_dec" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->recurring_dec->getPlaceHolder()) ?>" value="<?= $Page->recurring_dec->EditValue ?>"<?= $Page->recurring_dec->editAttributes() ?> aria-describedby="x_recurring_dec_help">
<?= $Page->recurring_dec->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->recurring_dec->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->setup_shape->Visible) { // setup_shape ?>
    <div id="r_setup_shape" class="form-group row">
        <label id="elh_room_reservation_setup_shape" for="x_setup_shape" class="<?= $Page->LeftColumnClass ?>"><?= $Page->setup_shape->caption() ?><?= $Page->setup_shape->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->setup_shape->cellAttributes() ?>>
<span id="el_room_reservation_setup_shape">
<input type="<?= $Page->setup_shape->getInputTextType() ?>" data-table="room_reservation" data-field="x_setup_shape" name="x_setup_shape" id="x_setup_shape" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->setup_shape->getPlaceHolder()) ?>" value="<?= $Page->setup_shape->EditValue ?>"<?= $Page->setup_shape->editAttributes() ?> aria-describedby="x_setup_shape_help">
<?= $Page->setup_shape->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->setup_shape->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->certification_name->Visible) { // certification_name ?>
    <div id="r_certification_name" class="form-group row">
        <label id="elh_room_reservation_certification_name" for="x_certification_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->certification_name->caption() ?><?= $Page->certification_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->certification_name->cellAttributes() ?>>
<span id="el_room_reservation_certification_name">
<input type="<?= $Page->certification_name->getInputTextType() ?>" data-table="room_reservation" data-field="x_certification_name" name="x_certification_name" id="x_certification_name" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->certification_name->getPlaceHolder()) ?>" value="<?= $Page->certification_name->EditValue ?>"<?= $Page->certification_name->editAttributes() ?> aria-describedby="x_certification_name_help">
<?= $Page->certification_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->certification_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->certification_date->Visible) { // certification_date ?>
    <div id="r_certification_date" class="form-group row">
        <label id="elh_room_reservation_certification_date" for="x_certification_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->certification_date->caption() ?><?= $Page->certification_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->certification_date->cellAttributes() ?>>
<span id="el_room_reservation_certification_date">
<input type="<?= $Page->certification_date->getInputTextType() ?>" data-table="room_reservation" data-field="x_certification_date" name="x_certification_date" id="x_certification_date" placeholder="<?= HtmlEncode($Page->certification_date->getPlaceHolder()) ?>" value="<?= $Page->certification_date->EditValue ?>"<?= $Page->certification_date->editAttributes() ?> aria-describedby="x_certification_date_help">
<?= $Page->certification_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->certification_date->getErrorMessage() ?></div>
<?php if (!$Page->certification_date->ReadOnly && !$Page->certification_date->Disabled && !isset($Page->certification_date->EditAttrs["readonly"]) && !isset($Page->certification_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["froom_reservationadd", "datetimepicker"], function() {
    ew.createDateTimePicker("froom_reservationadd", "x_certification_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
    <div id="r_timestamp" class="form-group row">
        <label id="elh_room_reservation_timestamp" for="x_timestamp" class="<?= $Page->LeftColumnClass ?>"><?= $Page->timestamp->caption() ?><?= $Page->timestamp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->timestamp->cellAttributes() ?>>
<span id="el_room_reservation_timestamp">
<input type="<?= $Page->timestamp->getInputTextType() ?>" data-table="room_reservation" data-field="x_timestamp" name="x_timestamp" id="x_timestamp" placeholder="<?= HtmlEncode($Page->timestamp->getPlaceHolder()) ?>" value="<?= $Page->timestamp->EditValue ?>"<?= $Page->timestamp->editAttributes() ?> aria-describedby="x_timestamp_help">
<?= $Page->timestamp->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->timestamp->getErrorMessage() ?></div>
<?php if (!$Page->timestamp->ReadOnly && !$Page->timestamp->Disabled && !isset($Page->timestamp->EditAttrs["readonly"]) && !isset($Page->timestamp->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["froom_reservationadd", "datetimepicker"], function() {
    ew.createDateTimePicker("froom_reservationadd", "x_timestamp", {"ignoreReadonly":true,"useCurrent":false,"format":0});
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
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
    ew.addEventHandlers("room_reservation");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
