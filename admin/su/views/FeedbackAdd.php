<?php

namespace PHPMaker2021\project1;

// Page object
$FeedbackAdd = &$Page;
?>
<script>
if (!ew.vars.tables.feedback) ew.vars.tables.feedback = <?= JsonEncode(GetClientVar("tables", "feedback")) ?>;
var currentForm, currentPageID;
var ffeedbackadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    ffeedbackadd = currentForm = new ew.Form("ffeedbackadd", "add");

    // Add fields
    var fields = ew.vars.tables.feedback.fields;
    ffeedbackadd.addFields([
        ["name", [fields.name.required ? ew.Validators.required(fields.name.caption) : null], fields.name.isInvalid],
        ["_email", [fields._email.required ? ew.Validators.required(fields._email.caption) : null], fields._email.isInvalid],
        ["text", [fields.text.required ? ew.Validators.required(fields.text.caption) : null], fields.text.isInvalid],
        ["location", [fields.location.required ? ew.Validators.required(fields.location.caption) : null, ew.Validators.integer], fields.location.isInvalid],
        ["time", [fields.time.required ? ew.Validators.required(fields.time.caption) : null, ew.Validators.datetime(0)], fields.time.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = ffeedbackadd,
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
    ffeedbackadd.validate = function () {
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
    ffeedbackadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ffeedbackadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("ffeedbackadd");
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
<form name="ffeedbackadd" id="ffeedbackadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="feedback">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->name->Visible) { // name ?>
    <div id="r_name" class="form-group row">
        <label id="elh_feedback_name" for="x_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->name->caption() ?><?= $Page->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->name->cellAttributes() ?>>
<span id="el_feedback_name">
<input type="<?= $Page->name->getInputTextType() ?>" data-table="feedback" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>" value="<?= $Page->name->EditValue ?>"<?= $Page->name->editAttributes() ?> aria-describedby="x_name_help">
<?= $Page->name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
    <div id="r__email" class="form-group row">
        <label id="elh_feedback__email" for="x__email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_email->caption() ?><?= $Page->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_email->cellAttributes() ?>>
<span id="el_feedback__email">
<input type="<?= $Page->_email->getInputTextType() ?>" data-table="feedback" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="65" placeholder="<?= HtmlEncode($Page->_email->getPlaceHolder()) ?>" value="<?= $Page->_email->EditValue ?>"<?= $Page->_email->editAttributes() ?> aria-describedby="x__email_help">
<?= $Page->_email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->text->Visible) { // text ?>
    <div id="r_text" class="form-group row">
        <label id="elh_feedback_text" for="x_text" class="<?= $Page->LeftColumnClass ?>"><?= $Page->text->caption() ?><?= $Page->text->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->text->cellAttributes() ?>>
<span id="el_feedback_text">
<textarea data-table="feedback" data-field="x_text" name="x_text" id="x_text" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->text->getPlaceHolder()) ?>"<?= $Page->text->editAttributes() ?> aria-describedby="x_text_help"><?= $Page->text->EditValue ?></textarea>
<?= $Page->text->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->text->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
    <div id="r_location" class="form-group row">
        <label id="elh_feedback_location" for="x_location" class="<?= $Page->LeftColumnClass ?>"><?= $Page->location->caption() ?><?= $Page->location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->location->cellAttributes() ?>>
<span id="el_feedback_location">
<input type="<?= $Page->location->getInputTextType() ?>" data-table="feedback" data-field="x_location" name="x_location" id="x_location" size="30" placeholder="<?= HtmlEncode($Page->location->getPlaceHolder()) ?>" value="<?= $Page->location->EditValue ?>"<?= $Page->location->editAttributes() ?> aria-describedby="x_location_help">
<?= $Page->location->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->location->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->time->Visible) { // time ?>
    <div id="r_time" class="form-group row">
        <label id="elh_feedback_time" for="x_time" class="<?= $Page->LeftColumnClass ?>"><?= $Page->time->caption() ?><?= $Page->time->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->time->cellAttributes() ?>>
<span id="el_feedback_time">
<input type="<?= $Page->time->getInputTextType() ?>" data-table="feedback" data-field="x_time" name="x_time" id="x_time" placeholder="<?= HtmlEncode($Page->time->getPlaceHolder()) ?>" value="<?= $Page->time->EditValue ?>"<?= $Page->time->editAttributes() ?> aria-describedby="x_time_help">
<?= $Page->time->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->time->getErrorMessage() ?></div>
<?php if (!$Page->time->ReadOnly && !$Page->time->Disabled && !isset($Page->time->EditAttrs["readonly"]) && !isset($Page->time->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ffeedbackadd", "datetimepicker"], function() {
    ew.createDateTimePicker("ffeedbackadd", "x_time", {"ignoreReadonly":true,"useCurrent":false,"format":0});
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
    ew.addEventHandlers("feedback");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
