<?php

namespace PHPMaker2021\project4;

// Page object
$NutritionClassAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fnutrition_classadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fnutrition_classadd = currentForm = new ew.Form("fnutrition_classadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "nutrition_class")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.nutrition_class)
        ew.vars.tables.nutrition_class = currentTable;
    fnutrition_classadd.addFields([
        ["first_name", [fields.first_name.visible && fields.first_name.required ? ew.Validators.required(fields.first_name.caption) : null], fields.first_name.isInvalid],
        ["last_name", [fields.last_name.visible && fields.last_name.required ? ew.Validators.required(fields.last_name.caption) : null], fields.last_name.isInvalid],
        ["_email", [fields._email.visible && fields._email.required ? ew.Validators.required(fields._email.caption) : null], fields._email.isInvalid],
        ["student_id", [fields.student_id.visible && fields.student_id.required ? ew.Validators.required(fields.student_id.caption) : null], fields.student_id.isInvalid],
        ["phone_number", [fields.phone_number.visible && fields.phone_number.required ? ew.Validators.required(fields.phone_number.caption) : null], fields.phone_number.isInvalid],
        ["payment_option", [fields.payment_option.visible && fields.payment_option.required ? ew.Validators.required(fields.payment_option.caption) : null], fields.payment_option.isInvalid],
        ["class_name", [fields.class_name.visible && fields.class_name.required ? ew.Validators.required(fields.class_name.caption) : null], fields.class_name.isInvalid],
        ["class_time", [fields.class_time.visible && fields.class_time.required ? ew.Validators.required(fields.class_time.caption) : null], fields.class_time.isInvalid],
        ["timestamp", [fields.timestamp.visible && fields.timestamp.required ? ew.Validators.required(fields.timestamp.caption) : null, ew.Validators.datetime(0)], fields.timestamp.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fnutrition_classadd,
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
    fnutrition_classadd.validate = function () {
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
    fnutrition_classadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fnutrition_classadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fnutrition_classadd");
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
<form name="fnutrition_classadd" id="fnutrition_classadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="nutrition_class">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->first_name->Visible) { // first_name ?>
    <div id="r_first_name" class="form-group row">
        <label id="elh_nutrition_class_first_name" for="x_first_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->first_name->caption() ?><?= $Page->first_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->first_name->cellAttributes() ?>>
<span id="el_nutrition_class_first_name">
<input type="<?= $Page->first_name->getInputTextType() ?>" data-table="nutrition_class" data-field="x_first_name" name="x_first_name" id="x_first_name" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->first_name->getPlaceHolder()) ?>" value="<?= $Page->first_name->EditValue ?>"<?= $Page->first_name->editAttributes() ?> aria-describedby="x_first_name_help">
<?= $Page->first_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->first_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->last_name->Visible) { // last_name ?>
    <div id="r_last_name" class="form-group row">
        <label id="elh_nutrition_class_last_name" for="x_last_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->last_name->caption() ?><?= $Page->last_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->last_name->cellAttributes() ?>>
<span id="el_nutrition_class_last_name">
<input type="<?= $Page->last_name->getInputTextType() ?>" data-table="nutrition_class" data-field="x_last_name" name="x_last_name" id="x_last_name" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->last_name->getPlaceHolder()) ?>" value="<?= $Page->last_name->EditValue ?>"<?= $Page->last_name->editAttributes() ?> aria-describedby="x_last_name_help">
<?= $Page->last_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->last_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
    <div id="r__email" class="form-group row">
        <label id="elh_nutrition_class__email" for="x__email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_email->caption() ?><?= $Page->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_email->cellAttributes() ?>>
<span id="el_nutrition_class__email">
<input type="<?= $Page->_email->getInputTextType() ?>" data-table="nutrition_class" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->_email->getPlaceHolder()) ?>" value="<?= $Page->_email->EditValue ?>"<?= $Page->_email->editAttributes() ?> aria-describedby="x__email_help">
<?= $Page->_email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->student_id->Visible) { // student_id ?>
    <div id="r_student_id" class="form-group row">
        <label id="elh_nutrition_class_student_id" for="x_student_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->student_id->caption() ?><?= $Page->student_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->student_id->cellAttributes() ?>>
<span id="el_nutrition_class_student_id">
<input type="<?= $Page->student_id->getInputTextType() ?>" data-table="nutrition_class" data-field="x_student_id" name="x_student_id" id="x_student_id" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->student_id->getPlaceHolder()) ?>" value="<?= $Page->student_id->EditValue ?>"<?= $Page->student_id->editAttributes() ?> aria-describedby="x_student_id_help">
<?= $Page->student_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->student_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->phone_number->Visible) { // phone_number ?>
    <div id="r_phone_number" class="form-group row">
        <label id="elh_nutrition_class_phone_number" for="x_phone_number" class="<?= $Page->LeftColumnClass ?>"><?= $Page->phone_number->caption() ?><?= $Page->phone_number->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->phone_number->cellAttributes() ?>>
<span id="el_nutrition_class_phone_number">
<input type="<?= $Page->phone_number->getInputTextType() ?>" data-table="nutrition_class" data-field="x_phone_number" name="x_phone_number" id="x_phone_number" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->phone_number->getPlaceHolder()) ?>" value="<?= $Page->phone_number->EditValue ?>"<?= $Page->phone_number->editAttributes() ?> aria-describedby="x_phone_number_help">
<?= $Page->phone_number->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->phone_number->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->payment_option->Visible) { // payment_option ?>
    <div id="r_payment_option" class="form-group row">
        <label id="elh_nutrition_class_payment_option" for="x_payment_option" class="<?= $Page->LeftColumnClass ?>"><?= $Page->payment_option->caption() ?><?= $Page->payment_option->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->payment_option->cellAttributes() ?>>
<span id="el_nutrition_class_payment_option">
<input type="<?= $Page->payment_option->getInputTextType() ?>" data-table="nutrition_class" data-field="x_payment_option" name="x_payment_option" id="x_payment_option" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->payment_option->getPlaceHolder()) ?>" value="<?= $Page->payment_option->EditValue ?>"<?= $Page->payment_option->editAttributes() ?> aria-describedby="x_payment_option_help">
<?= $Page->payment_option->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->payment_option->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->class_name->Visible) { // class_name ?>
    <div id="r_class_name" class="form-group row">
        <label id="elh_nutrition_class_class_name" for="x_class_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->class_name->caption() ?><?= $Page->class_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->class_name->cellAttributes() ?>>
<span id="el_nutrition_class_class_name">
<input type="<?= $Page->class_name->getInputTextType() ?>" data-table="nutrition_class" data-field="x_class_name" name="x_class_name" id="x_class_name" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->class_name->getPlaceHolder()) ?>" value="<?= $Page->class_name->EditValue ?>"<?= $Page->class_name->editAttributes() ?> aria-describedby="x_class_name_help">
<?= $Page->class_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->class_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->class_time->Visible) { // class_time ?>
    <div id="r_class_time" class="form-group row">
        <label id="elh_nutrition_class_class_time" for="x_class_time" class="<?= $Page->LeftColumnClass ?>"><?= $Page->class_time->caption() ?><?= $Page->class_time->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->class_time->cellAttributes() ?>>
<span id="el_nutrition_class_class_time">
<input type="<?= $Page->class_time->getInputTextType() ?>" data-table="nutrition_class" data-field="x_class_time" name="x_class_time" id="x_class_time" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->class_time->getPlaceHolder()) ?>" value="<?= $Page->class_time->EditValue ?>"<?= $Page->class_time->editAttributes() ?> aria-describedby="x_class_time_help">
<?= $Page->class_time->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->class_time->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
    <div id="r_timestamp" class="form-group row">
        <label id="elh_nutrition_class_timestamp" for="x_timestamp" class="<?= $Page->LeftColumnClass ?>"><?= $Page->timestamp->caption() ?><?= $Page->timestamp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->timestamp->cellAttributes() ?>>
<span id="el_nutrition_class_timestamp">
<input type="<?= $Page->timestamp->getInputTextType() ?>" data-table="nutrition_class" data-field="x_timestamp" name="x_timestamp" id="x_timestamp" placeholder="<?= HtmlEncode($Page->timestamp->getPlaceHolder()) ?>" value="<?= $Page->timestamp->EditValue ?>"<?= $Page->timestamp->editAttributes() ?> aria-describedby="x_timestamp_help">
<?= $Page->timestamp->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->timestamp->getErrorMessage() ?></div>
<?php if (!$Page->timestamp->ReadOnly && !$Page->timestamp->Disabled && !isset($Page->timestamp->EditAttrs["readonly"]) && !isset($Page->timestamp->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fnutrition_classadd", "datetimepicker"], function() {
    ew.createDateTimePicker("fnutrition_classadd", "x_timestamp", {"ignoreReadonly":true,"useCurrent":false,"format":0});
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
    ew.addEventHandlers("nutrition_class");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
