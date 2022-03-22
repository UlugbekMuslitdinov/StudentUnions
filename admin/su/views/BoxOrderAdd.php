<?php

namespace PHPMaker2021\project1;

// Page object
$BoxOrderAdd = &$Page;
?>
<script>
if (!ew.vars.tables.box_order) ew.vars.tables.box_order = <?= JsonEncode(GetClientVar("tables", "box_order")) ?>;
var currentForm, currentPageID;
var fbox_orderadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fbox_orderadd = currentForm = new ew.Form("fbox_orderadd", "add");

    // Add fields
    var fields = ew.vars.tables.box_order.fields;
    fbox_orderadd.addFields([
        ["first_name", [fields.first_name.required ? ew.Validators.required(fields.first_name.caption) : null], fields.first_name.isInvalid],
        ["last_name", [fields.last_name.required ? ew.Validators.required(fields.last_name.caption) : null], fields.last_name.isInvalid],
        ["_email", [fields._email.required ? ew.Validators.required(fields._email.caption) : null], fields._email.isInvalid],
        ["phone", [fields.phone.required ? ew.Validators.required(fields.phone.caption) : null], fields.phone.isInvalid],
        ["location", [fields.location.required ? ew.Validators.required(fields.location.caption) : null], fields.location.isInvalid],
        ["payment", [fields.payment.required ? ew.Validators.required(fields.payment.caption) : null], fields.payment.isInvalid],
        ["payment_idb", [fields.payment_idb.required ? ew.Validators.required(fields.payment_idb.caption) : null], fields.payment_idb.isInvalid],
        ["amount_swipe", [fields.amount_swipe.required ? ew.Validators.required(fields.amount_swipe.caption) : null, ew.Validators.integer], fields.amount_swipe.isInvalid],
        ["amount_total", [fields.amount_total.required ? ew.Validators.required(fields.amount_total.caption) : null, ew.Validators.integer], fields.amount_total.isInvalid],
        ["timestamp", [fields.timestamp.required ? ew.Validators.required(fields.timestamp.caption) : null, ew.Validators.datetime(0)], fields.timestamp.isInvalid],
        ["status", [fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
        ["netid", [fields.netid.required ? ew.Validators.required(fields.netid.caption) : null], fields.netid.isInvalid],
        ["sid", [fields.sid.required ? ew.Validators.required(fields.sid.caption) : null], fields.sid.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fbox_orderadd,
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
    fbox_orderadd.validate = function () {
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
    fbox_orderadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fbox_orderadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fbox_orderadd");
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
<form name="fbox_orderadd" id="fbox_orderadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="box_order">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->first_name->Visible) { // first_name ?>
    <div id="r_first_name" class="form-group row">
        <label id="elh_box_order_first_name" for="x_first_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->first_name->caption() ?><?= $Page->first_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->first_name->cellAttributes() ?>>
<span id="el_box_order_first_name">
<input type="<?= $Page->first_name->getInputTextType() ?>" data-table="box_order" data-field="x_first_name" name="x_first_name" id="x_first_name" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->first_name->getPlaceHolder()) ?>" value="<?= $Page->first_name->EditValue ?>"<?= $Page->first_name->editAttributes() ?> aria-describedby="x_first_name_help">
<?= $Page->first_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->first_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->last_name->Visible) { // last_name ?>
    <div id="r_last_name" class="form-group row">
        <label id="elh_box_order_last_name" for="x_last_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->last_name->caption() ?><?= $Page->last_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->last_name->cellAttributes() ?>>
<span id="el_box_order_last_name">
<input type="<?= $Page->last_name->getInputTextType() ?>" data-table="box_order" data-field="x_last_name" name="x_last_name" id="x_last_name" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->last_name->getPlaceHolder()) ?>" value="<?= $Page->last_name->EditValue ?>"<?= $Page->last_name->editAttributes() ?> aria-describedby="x_last_name_help">
<?= $Page->last_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->last_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
    <div id="r__email" class="form-group row">
        <label id="elh_box_order__email" for="x__email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_email->caption() ?><?= $Page->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_email->cellAttributes() ?>>
<span id="el_box_order__email">
<input type="<?= $Page->_email->getInputTextType() ?>" data-table="box_order" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->_email->getPlaceHolder()) ?>" value="<?= $Page->_email->EditValue ?>"<?= $Page->_email->editAttributes() ?> aria-describedby="x__email_help">
<?= $Page->_email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
    <div id="r_phone" class="form-group row">
        <label id="elh_box_order_phone" for="x_phone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->phone->caption() ?><?= $Page->phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->phone->cellAttributes() ?>>
<span id="el_box_order_phone">
<input type="<?= $Page->phone->getInputTextType() ?>" data-table="box_order" data-field="x_phone" name="x_phone" id="x_phone" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->phone->getPlaceHolder()) ?>" value="<?= $Page->phone->EditValue ?>"<?= $Page->phone->editAttributes() ?> aria-describedby="x_phone_help">
<?= $Page->phone->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->phone->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
    <div id="r_location" class="form-group row">
        <label id="elh_box_order_location" for="x_location" class="<?= $Page->LeftColumnClass ?>"><?= $Page->location->caption() ?><?= $Page->location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->location->cellAttributes() ?>>
<span id="el_box_order_location">
<input type="<?= $Page->location->getInputTextType() ?>" data-table="box_order" data-field="x_location" name="x_location" id="x_location" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->location->getPlaceHolder()) ?>" value="<?= $Page->location->EditValue ?>"<?= $Page->location->editAttributes() ?> aria-describedby="x_location_help">
<?= $Page->location->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->location->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->payment->Visible) { // payment ?>
    <div id="r_payment" class="form-group row">
        <label id="elh_box_order_payment" for="x_payment" class="<?= $Page->LeftColumnClass ?>"><?= $Page->payment->caption() ?><?= $Page->payment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->payment->cellAttributes() ?>>
<span id="el_box_order_payment">
<input type="<?= $Page->payment->getInputTextType() ?>" data-table="box_order" data-field="x_payment" name="x_payment" id="x_payment" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->payment->getPlaceHolder()) ?>" value="<?= $Page->payment->EditValue ?>"<?= $Page->payment->editAttributes() ?> aria-describedby="x_payment_help">
<?= $Page->payment->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->payment->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->payment_idb->Visible) { // payment_idb ?>
    <div id="r_payment_idb" class="form-group row">
        <label id="elh_box_order_payment_idb" for="x_payment_idb" class="<?= $Page->LeftColumnClass ?>"><?= $Page->payment_idb->caption() ?><?= $Page->payment_idb->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->payment_idb->cellAttributes() ?>>
<span id="el_box_order_payment_idb">
<input type="<?= $Page->payment_idb->getInputTextType() ?>" data-table="box_order" data-field="x_payment_idb" name="x_payment_idb" id="x_payment_idb" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->payment_idb->getPlaceHolder()) ?>" value="<?= $Page->payment_idb->EditValue ?>"<?= $Page->payment_idb->editAttributes() ?> aria-describedby="x_payment_idb_help">
<?= $Page->payment_idb->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->payment_idb->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->amount_swipe->Visible) { // amount_swipe ?>
    <div id="r_amount_swipe" class="form-group row">
        <label id="elh_box_order_amount_swipe" for="x_amount_swipe" class="<?= $Page->LeftColumnClass ?>"><?= $Page->amount_swipe->caption() ?><?= $Page->amount_swipe->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->amount_swipe->cellAttributes() ?>>
<span id="el_box_order_amount_swipe">
<input type="<?= $Page->amount_swipe->getInputTextType() ?>" data-table="box_order" data-field="x_amount_swipe" name="x_amount_swipe" id="x_amount_swipe" size="30" placeholder="<?= HtmlEncode($Page->amount_swipe->getPlaceHolder()) ?>" value="<?= $Page->amount_swipe->EditValue ?>"<?= $Page->amount_swipe->editAttributes() ?> aria-describedby="x_amount_swipe_help">
<?= $Page->amount_swipe->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->amount_swipe->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->amount_total->Visible) { // amount_total ?>
    <div id="r_amount_total" class="form-group row">
        <label id="elh_box_order_amount_total" for="x_amount_total" class="<?= $Page->LeftColumnClass ?>"><?= $Page->amount_total->caption() ?><?= $Page->amount_total->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->amount_total->cellAttributes() ?>>
<span id="el_box_order_amount_total">
<input type="<?= $Page->amount_total->getInputTextType() ?>" data-table="box_order" data-field="x_amount_total" name="x_amount_total" id="x_amount_total" size="30" placeholder="<?= HtmlEncode($Page->amount_total->getPlaceHolder()) ?>" value="<?= $Page->amount_total->EditValue ?>"<?= $Page->amount_total->editAttributes() ?> aria-describedby="x_amount_total_help">
<?= $Page->amount_total->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->amount_total->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
    <div id="r_timestamp" class="form-group row">
        <label id="elh_box_order_timestamp" for="x_timestamp" class="<?= $Page->LeftColumnClass ?>"><?= $Page->timestamp->caption() ?><?= $Page->timestamp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->timestamp->cellAttributes() ?>>
<span id="el_box_order_timestamp">
<input type="<?= $Page->timestamp->getInputTextType() ?>" data-table="box_order" data-field="x_timestamp" name="x_timestamp" id="x_timestamp" placeholder="<?= HtmlEncode($Page->timestamp->getPlaceHolder()) ?>" value="<?= $Page->timestamp->EditValue ?>"<?= $Page->timestamp->editAttributes() ?> aria-describedby="x_timestamp_help">
<?= $Page->timestamp->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->timestamp->getErrorMessage() ?></div>
<?php if (!$Page->timestamp->ReadOnly && !$Page->timestamp->Disabled && !isset($Page->timestamp->EditAttrs["readonly"]) && !isset($Page->timestamp->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbox_orderadd", "datetimepicker"], function() {
    ew.createDateTimePicker("fbox_orderadd", "x_timestamp", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status" class="form-group row">
        <label id="elh_box_order_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->status->cellAttributes() ?>>
<span id="el_box_order_status">
<input type="<?= $Page->status->getInputTextType() ?>" data-table="box_order" data-field="x_status" name="x_status" id="x_status" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>" value="<?= $Page->status->EditValue ?>"<?= $Page->status->editAttributes() ?> aria-describedby="x_status_help">
<?= $Page->status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->netid->Visible) { // netid ?>
    <div id="r_netid" class="form-group row">
        <label id="elh_box_order_netid" for="x_netid" class="<?= $Page->LeftColumnClass ?>"><?= $Page->netid->caption() ?><?= $Page->netid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->netid->cellAttributes() ?>>
<span id="el_box_order_netid">
<input type="<?= $Page->netid->getInputTextType() ?>" data-table="box_order" data-field="x_netid" name="x_netid" id="x_netid" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->netid->getPlaceHolder()) ?>" value="<?= $Page->netid->EditValue ?>"<?= $Page->netid->editAttributes() ?> aria-describedby="x_netid_help">
<?= $Page->netid->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->netid->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sid->Visible) { // sid ?>
    <div id="r_sid" class="form-group row">
        <label id="elh_box_order_sid" for="x_sid" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sid->caption() ?><?= $Page->sid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->sid->cellAttributes() ?>>
<span id="el_box_order_sid">
<input type="<?= $Page->sid->getInputTextType() ?>" data-table="box_order" data-field="x_sid" name="x_sid" id="x_sid" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->sid->getPlaceHolder()) ?>" value="<?= $Page->sid->EditValue ?>"<?= $Page->sid->editAttributes() ?> aria-describedby="x_sid_help">
<?= $Page->sid->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sid->getErrorMessage() ?></div>
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
    ew.addEventHandlers("box_order");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
