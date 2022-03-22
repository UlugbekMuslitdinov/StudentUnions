<?php

namespace PHPMaker2021\project2;

// Page object
$HoursCateringAdd = &$Page;
?>
<script>
if (!ew.vars.tables.hours_catering) ew.vars.tables.hours_catering = <?= JsonEncode(GetClientVar("tables", "hours_catering")) ?>;
var currentForm, currentPageID;
var fhours_cateringadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fhours_cateringadd = currentForm = new ew.Form("fhours_cateringadd", "add");

    // Add fields
    var fields = ew.vars.tables.hours_catering.fields;
    fhours_cateringadd.addFields([
        ["location_id", [fields.location_id.required ? ew.Validators.required(fields.location_id.caption) : null, ew.Validators.integer], fields.location_id.isInvalid],
        ["day_from", [fields.day_from.required ? ew.Validators.required(fields.day_from.caption) : null], fields.day_from.isInvalid],
        ["day_to", [fields.day_to.required ? ew.Validators.required(fields.day_to.caption) : null], fields.day_to.isInvalid],
        ["time_from", [fields.time_from.required ? ew.Validators.required(fields.time_from.caption) : null], fields.time_from.isInvalid],
        ["time_to", [fields.time_to.required ? ew.Validators.required(fields.time_to.caption) : null], fields.time_to.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fhours_cateringadd,
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
    fhours_cateringadd.validate = function () {
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
    fhours_cateringadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fhours_cateringadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fhours_cateringadd");
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
<form name="fhours_cateringadd" id="fhours_cateringadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="hours_catering">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->location_id->Visible) { // location_id ?>
    <div id="r_location_id" class="form-group row">
        <label id="elh_hours_catering_location_id" for="x_location_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->location_id->caption() ?><?= $Page->location_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->location_id->cellAttributes() ?>>
<span id="el_hours_catering_location_id">
<input type="<?= $Page->location_id->getInputTextType() ?>" data-table="hours_catering" data-field="x_location_id" name="x_location_id" id="x_location_id" size="30" placeholder="<?= HtmlEncode($Page->location_id->getPlaceHolder()) ?>" value="<?= $Page->location_id->EditValue ?>"<?= $Page->location_id->editAttributes() ?> aria-describedby="x_location_id_help">
<?= $Page->location_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->location_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->day_from->Visible) { // day_from ?>
    <div id="r_day_from" class="form-group row">
        <label id="elh_hours_catering_day_from" for="x_day_from" class="<?= $Page->LeftColumnClass ?>"><?= $Page->day_from->caption() ?><?= $Page->day_from->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->day_from->cellAttributes() ?>>
<span id="el_hours_catering_day_from">
<input type="<?= $Page->day_from->getInputTextType() ?>" data-table="hours_catering" data-field="x_day_from" name="x_day_from" id="x_day_from" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->day_from->getPlaceHolder()) ?>" value="<?= $Page->day_from->EditValue ?>"<?= $Page->day_from->editAttributes() ?> aria-describedby="x_day_from_help">
<?= $Page->day_from->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->day_from->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->day_to->Visible) { // day_to ?>
    <div id="r_day_to" class="form-group row">
        <label id="elh_hours_catering_day_to" for="x_day_to" class="<?= $Page->LeftColumnClass ?>"><?= $Page->day_to->caption() ?><?= $Page->day_to->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->day_to->cellAttributes() ?>>
<span id="el_hours_catering_day_to">
<input type="<?= $Page->day_to->getInputTextType() ?>" data-table="hours_catering" data-field="x_day_to" name="x_day_to" id="x_day_to" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->day_to->getPlaceHolder()) ?>" value="<?= $Page->day_to->EditValue ?>"<?= $Page->day_to->editAttributes() ?> aria-describedby="x_day_to_help">
<?= $Page->day_to->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->day_to->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->time_from->Visible) { // time_from ?>
    <div id="r_time_from" class="form-group row">
        <label id="elh_hours_catering_time_from" for="x_time_from" class="<?= $Page->LeftColumnClass ?>"><?= $Page->time_from->caption() ?><?= $Page->time_from->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->time_from->cellAttributes() ?>>
<span id="el_hours_catering_time_from">
<input type="<?= $Page->time_from->getInputTextType() ?>" data-table="hours_catering" data-field="x_time_from" name="x_time_from" id="x_time_from" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->time_from->getPlaceHolder()) ?>" value="<?= $Page->time_from->EditValue ?>"<?= $Page->time_from->editAttributes() ?> aria-describedby="x_time_from_help">
<?= $Page->time_from->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->time_from->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->time_to->Visible) { // time_to ?>
    <div id="r_time_to" class="form-group row">
        <label id="elh_hours_catering_time_to" for="x_time_to" class="<?= $Page->LeftColumnClass ?>"><?= $Page->time_to->caption() ?><?= $Page->time_to->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->time_to->cellAttributes() ?>>
<span id="el_hours_catering_time_to">
<input type="<?= $Page->time_to->getInputTextType() ?>" data-table="hours_catering" data-field="x_time_to" name="x_time_to" id="x_time_to" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->time_to->getPlaceHolder()) ?>" value="<?= $Page->time_to->EditValue ?>"<?= $Page->time_to->editAttributes() ?> aria-describedby="x_time_to_help">
<?= $Page->time_to->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->time_to->getErrorMessage() ?></div>
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
    ew.addEventHandlers("hours_catering");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
