<?php

namespace PHPMaker2021\project2;

// Page object
$HoursDefaultEdit = &$Page;
?>
<script>
if (!ew.vars.tables.hours_default) ew.vars.tables.hours_default = <?= JsonEncode(GetClientVar("tables", "hours_default")) ?>;
var currentForm, currentPageID;
var fhours_defaultedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fhours_defaultedit = currentForm = new ew.Form("fhours_defaultedit", "edit");

    // Add fields
    var fields = ew.vars.tables.hours_default.fields;
    fhours_defaultedit.addFields([
        ["hour_id", [fields.hour_id.required ? ew.Validators.required(fields.hour_id.caption) : null, ew.Validators.integer], fields.hour_id.isInvalid],
        ["mon_open", [fields.mon_open.required ? ew.Validators.required(fields.mon_open.caption) : null, ew.Validators.time], fields.mon_open.isInvalid],
        ["mon_close", [fields.mon_close.required ? ew.Validators.required(fields.mon_close.caption) : null, ew.Validators.time], fields.mon_close.isInvalid],
        ["tue_open", [fields.tue_open.required ? ew.Validators.required(fields.tue_open.caption) : null, ew.Validators.time], fields.tue_open.isInvalid],
        ["tue_close", [fields.tue_close.required ? ew.Validators.required(fields.tue_close.caption) : null, ew.Validators.time], fields.tue_close.isInvalid],
        ["wed_open", [fields.wed_open.required ? ew.Validators.required(fields.wed_open.caption) : null, ew.Validators.time], fields.wed_open.isInvalid],
        ["wed_close", [fields.wed_close.required ? ew.Validators.required(fields.wed_close.caption) : null, ew.Validators.time], fields.wed_close.isInvalid],
        ["thu_open", [fields.thu_open.required ? ew.Validators.required(fields.thu_open.caption) : null, ew.Validators.time], fields.thu_open.isInvalid],
        ["thu_close", [fields.thu_close.required ? ew.Validators.required(fields.thu_close.caption) : null, ew.Validators.time], fields.thu_close.isInvalid],
        ["fri_open", [fields.fri_open.required ? ew.Validators.required(fields.fri_open.caption) : null, ew.Validators.time], fields.fri_open.isInvalid],
        ["fri_close", [fields.fri_close.required ? ew.Validators.required(fields.fri_close.caption) : null, ew.Validators.time], fields.fri_close.isInvalid],
        ["sat_open", [fields.sat_open.required ? ew.Validators.required(fields.sat_open.caption) : null, ew.Validators.time], fields.sat_open.isInvalid],
        ["sat_close", [fields.sat_close.required ? ew.Validators.required(fields.sat_close.caption) : null, ew.Validators.time], fields.sat_close.isInvalid],
        ["sun_open", [fields.sun_open.required ? ew.Validators.required(fields.sun_open.caption) : null, ew.Validators.time], fields.sun_open.isInvalid],
        ["sun_close", [fields.sun_close.required ? ew.Validators.required(fields.sun_close.caption) : null, ew.Validators.time], fields.sun_close.isInvalid],
        ["close", [fields.close.required ? ew.Validators.required(fields.close.caption) : null], fields.close.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fhours_defaultedit,
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
    fhours_defaultedit.validate = function () {
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
    fhours_defaultedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fhours_defaultedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fhours_defaultedit");
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
<form name="fhours_defaultedit" id="fhours_defaultedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="hours_default">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->hour_id->Visible) { // hour_id ?>
    <div id="r_hour_id" class="form-group row">
        <label id="elh_hours_default_hour_id" for="x_hour_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->hour_id->caption() ?><?= $Page->hour_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->hour_id->cellAttributes() ?>>
<input type="<?= $Page->hour_id->getInputTextType() ?>" data-table="hours_default" data-field="x_hour_id" name="x_hour_id" id="x_hour_id" size="30" placeholder="<?= HtmlEncode($Page->hour_id->getPlaceHolder()) ?>" value="<?= $Page->hour_id->EditValue ?>"<?= $Page->hour_id->editAttributes() ?> aria-describedby="x_hour_id_help">
<?= $Page->hour_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->hour_id->getErrorMessage() ?></div>
<input type="hidden" data-table="hours_default" data-field="x_hour_id" data-hidden="1" name="o_hour_id" id="o_hour_id" value="<?= HtmlEncode($Page->hour_id->OldValue ?? $Page->hour_id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->mon_open->Visible) { // mon_open ?>
    <div id="r_mon_open" class="form-group row">
        <label id="elh_hours_default_mon_open" for="x_mon_open" class="<?= $Page->LeftColumnClass ?>"><?= $Page->mon_open->caption() ?><?= $Page->mon_open->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->mon_open->cellAttributes() ?>>
<span id="el_hours_default_mon_open">
<input type="<?= $Page->mon_open->getInputTextType() ?>" data-table="hours_default" data-field="x_mon_open" name="x_mon_open" id="x_mon_open" placeholder="<?= HtmlEncode($Page->mon_open->getPlaceHolder()) ?>" value="<?= $Page->mon_open->EditValue ?>"<?= $Page->mon_open->editAttributes() ?> aria-describedby="x_mon_open_help">
<?= $Page->mon_open->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->mon_open->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->mon_close->Visible) { // mon_close ?>
    <div id="r_mon_close" class="form-group row">
        <label id="elh_hours_default_mon_close" for="x_mon_close" class="<?= $Page->LeftColumnClass ?>"><?= $Page->mon_close->caption() ?><?= $Page->mon_close->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->mon_close->cellAttributes() ?>>
<span id="el_hours_default_mon_close">
<input type="<?= $Page->mon_close->getInputTextType() ?>" data-table="hours_default" data-field="x_mon_close" name="x_mon_close" id="x_mon_close" placeholder="<?= HtmlEncode($Page->mon_close->getPlaceHolder()) ?>" value="<?= $Page->mon_close->EditValue ?>"<?= $Page->mon_close->editAttributes() ?> aria-describedby="x_mon_close_help">
<?= $Page->mon_close->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->mon_close->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tue_open->Visible) { // tue_open ?>
    <div id="r_tue_open" class="form-group row">
        <label id="elh_hours_default_tue_open" for="x_tue_open" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tue_open->caption() ?><?= $Page->tue_open->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tue_open->cellAttributes() ?>>
<span id="el_hours_default_tue_open">
<input type="<?= $Page->tue_open->getInputTextType() ?>" data-table="hours_default" data-field="x_tue_open" name="x_tue_open" id="x_tue_open" placeholder="<?= HtmlEncode($Page->tue_open->getPlaceHolder()) ?>" value="<?= $Page->tue_open->EditValue ?>"<?= $Page->tue_open->editAttributes() ?> aria-describedby="x_tue_open_help">
<?= $Page->tue_open->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tue_open->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tue_close->Visible) { // tue_close ?>
    <div id="r_tue_close" class="form-group row">
        <label id="elh_hours_default_tue_close" for="x_tue_close" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tue_close->caption() ?><?= $Page->tue_close->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tue_close->cellAttributes() ?>>
<span id="el_hours_default_tue_close">
<input type="<?= $Page->tue_close->getInputTextType() ?>" data-table="hours_default" data-field="x_tue_close" name="x_tue_close" id="x_tue_close" placeholder="<?= HtmlEncode($Page->tue_close->getPlaceHolder()) ?>" value="<?= $Page->tue_close->EditValue ?>"<?= $Page->tue_close->editAttributes() ?> aria-describedby="x_tue_close_help">
<?= $Page->tue_close->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tue_close->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->wed_open->Visible) { // wed_open ?>
    <div id="r_wed_open" class="form-group row">
        <label id="elh_hours_default_wed_open" for="x_wed_open" class="<?= $Page->LeftColumnClass ?>"><?= $Page->wed_open->caption() ?><?= $Page->wed_open->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->wed_open->cellAttributes() ?>>
<span id="el_hours_default_wed_open">
<input type="<?= $Page->wed_open->getInputTextType() ?>" data-table="hours_default" data-field="x_wed_open" name="x_wed_open" id="x_wed_open" placeholder="<?= HtmlEncode($Page->wed_open->getPlaceHolder()) ?>" value="<?= $Page->wed_open->EditValue ?>"<?= $Page->wed_open->editAttributes() ?> aria-describedby="x_wed_open_help">
<?= $Page->wed_open->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->wed_open->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->wed_close->Visible) { // wed_close ?>
    <div id="r_wed_close" class="form-group row">
        <label id="elh_hours_default_wed_close" for="x_wed_close" class="<?= $Page->LeftColumnClass ?>"><?= $Page->wed_close->caption() ?><?= $Page->wed_close->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->wed_close->cellAttributes() ?>>
<span id="el_hours_default_wed_close">
<input type="<?= $Page->wed_close->getInputTextType() ?>" data-table="hours_default" data-field="x_wed_close" name="x_wed_close" id="x_wed_close" placeholder="<?= HtmlEncode($Page->wed_close->getPlaceHolder()) ?>" value="<?= $Page->wed_close->EditValue ?>"<?= $Page->wed_close->editAttributes() ?> aria-describedby="x_wed_close_help">
<?= $Page->wed_close->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->wed_close->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->thu_open->Visible) { // thu_open ?>
    <div id="r_thu_open" class="form-group row">
        <label id="elh_hours_default_thu_open" for="x_thu_open" class="<?= $Page->LeftColumnClass ?>"><?= $Page->thu_open->caption() ?><?= $Page->thu_open->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->thu_open->cellAttributes() ?>>
<span id="el_hours_default_thu_open">
<input type="<?= $Page->thu_open->getInputTextType() ?>" data-table="hours_default" data-field="x_thu_open" name="x_thu_open" id="x_thu_open" placeholder="<?= HtmlEncode($Page->thu_open->getPlaceHolder()) ?>" value="<?= $Page->thu_open->EditValue ?>"<?= $Page->thu_open->editAttributes() ?> aria-describedby="x_thu_open_help">
<?= $Page->thu_open->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->thu_open->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->thu_close->Visible) { // thu_close ?>
    <div id="r_thu_close" class="form-group row">
        <label id="elh_hours_default_thu_close" for="x_thu_close" class="<?= $Page->LeftColumnClass ?>"><?= $Page->thu_close->caption() ?><?= $Page->thu_close->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->thu_close->cellAttributes() ?>>
<span id="el_hours_default_thu_close">
<input type="<?= $Page->thu_close->getInputTextType() ?>" data-table="hours_default" data-field="x_thu_close" name="x_thu_close" id="x_thu_close" placeholder="<?= HtmlEncode($Page->thu_close->getPlaceHolder()) ?>" value="<?= $Page->thu_close->EditValue ?>"<?= $Page->thu_close->editAttributes() ?> aria-describedby="x_thu_close_help">
<?= $Page->thu_close->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->thu_close->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->fri_open->Visible) { // fri_open ?>
    <div id="r_fri_open" class="form-group row">
        <label id="elh_hours_default_fri_open" for="x_fri_open" class="<?= $Page->LeftColumnClass ?>"><?= $Page->fri_open->caption() ?><?= $Page->fri_open->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->fri_open->cellAttributes() ?>>
<span id="el_hours_default_fri_open">
<input type="<?= $Page->fri_open->getInputTextType() ?>" data-table="hours_default" data-field="x_fri_open" name="x_fri_open" id="x_fri_open" placeholder="<?= HtmlEncode($Page->fri_open->getPlaceHolder()) ?>" value="<?= $Page->fri_open->EditValue ?>"<?= $Page->fri_open->editAttributes() ?> aria-describedby="x_fri_open_help">
<?= $Page->fri_open->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->fri_open->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->fri_close->Visible) { // fri_close ?>
    <div id="r_fri_close" class="form-group row">
        <label id="elh_hours_default_fri_close" for="x_fri_close" class="<?= $Page->LeftColumnClass ?>"><?= $Page->fri_close->caption() ?><?= $Page->fri_close->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->fri_close->cellAttributes() ?>>
<span id="el_hours_default_fri_close">
<input type="<?= $Page->fri_close->getInputTextType() ?>" data-table="hours_default" data-field="x_fri_close" name="x_fri_close" id="x_fri_close" placeholder="<?= HtmlEncode($Page->fri_close->getPlaceHolder()) ?>" value="<?= $Page->fri_close->EditValue ?>"<?= $Page->fri_close->editAttributes() ?> aria-describedby="x_fri_close_help">
<?= $Page->fri_close->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->fri_close->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sat_open->Visible) { // sat_open ?>
    <div id="r_sat_open" class="form-group row">
        <label id="elh_hours_default_sat_open" for="x_sat_open" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sat_open->caption() ?><?= $Page->sat_open->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->sat_open->cellAttributes() ?>>
<span id="el_hours_default_sat_open">
<input type="<?= $Page->sat_open->getInputTextType() ?>" data-table="hours_default" data-field="x_sat_open" name="x_sat_open" id="x_sat_open" placeholder="<?= HtmlEncode($Page->sat_open->getPlaceHolder()) ?>" value="<?= $Page->sat_open->EditValue ?>"<?= $Page->sat_open->editAttributes() ?> aria-describedby="x_sat_open_help">
<?= $Page->sat_open->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sat_open->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sat_close->Visible) { // sat_close ?>
    <div id="r_sat_close" class="form-group row">
        <label id="elh_hours_default_sat_close" for="x_sat_close" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sat_close->caption() ?><?= $Page->sat_close->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->sat_close->cellAttributes() ?>>
<span id="el_hours_default_sat_close">
<input type="<?= $Page->sat_close->getInputTextType() ?>" data-table="hours_default" data-field="x_sat_close" name="x_sat_close" id="x_sat_close" placeholder="<?= HtmlEncode($Page->sat_close->getPlaceHolder()) ?>" value="<?= $Page->sat_close->EditValue ?>"<?= $Page->sat_close->editAttributes() ?> aria-describedby="x_sat_close_help">
<?= $Page->sat_close->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sat_close->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sun_open->Visible) { // sun_open ?>
    <div id="r_sun_open" class="form-group row">
        <label id="elh_hours_default_sun_open" for="x_sun_open" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sun_open->caption() ?><?= $Page->sun_open->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->sun_open->cellAttributes() ?>>
<span id="el_hours_default_sun_open">
<input type="<?= $Page->sun_open->getInputTextType() ?>" data-table="hours_default" data-field="x_sun_open" name="x_sun_open" id="x_sun_open" placeholder="<?= HtmlEncode($Page->sun_open->getPlaceHolder()) ?>" value="<?= $Page->sun_open->EditValue ?>"<?= $Page->sun_open->editAttributes() ?> aria-describedby="x_sun_open_help">
<?= $Page->sun_open->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sun_open->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sun_close->Visible) { // sun_close ?>
    <div id="r_sun_close" class="form-group row">
        <label id="elh_hours_default_sun_close" for="x_sun_close" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sun_close->caption() ?><?= $Page->sun_close->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->sun_close->cellAttributes() ?>>
<span id="el_hours_default_sun_close">
<input type="<?= $Page->sun_close->getInputTextType() ?>" data-table="hours_default" data-field="x_sun_close" name="x_sun_close" id="x_sun_close" placeholder="<?= HtmlEncode($Page->sun_close->getPlaceHolder()) ?>" value="<?= $Page->sun_close->EditValue ?>"<?= $Page->sun_close->editAttributes() ?> aria-describedby="x_sun_close_help">
<?= $Page->sun_close->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sun_close->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->close->Visible) { // close ?>
    <div id="r_close" class="form-group row">
        <label id="elh_hours_default_close" for="x_close" class="<?= $Page->LeftColumnClass ?>"><?= $Page->close->caption() ?><?= $Page->close->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->close->cellAttributes() ?>>
<span id="el_hours_default_close">
<input type="<?= $Page->close->getInputTextType() ?>" data-table="hours_default" data-field="x_close" name="x_close" id="x_close" size="30" maxlength="6" placeholder="<?= HtmlEncode($Page->close->getPlaceHolder()) ?>" value="<?= $Page->close->EditValue ?>"<?= $Page->close->editAttributes() ?> aria-describedby="x_close_help">
<?= $Page->close->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->close->getErrorMessage() ?></div>
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
    ew.addEventHandlers("hours_default");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
