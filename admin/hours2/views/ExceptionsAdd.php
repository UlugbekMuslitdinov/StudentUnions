<?php

namespace PHPMaker2021\project2;

// Page object
$ExceptionsAdd = &$Page;
?>
<script>
if (!ew.vars.tables.exceptions) ew.vars.tables.exceptions = <?= JsonEncode(GetClientVar("tables", "exceptions")) ?>;
var currentForm, currentPageID;
var fexceptionsadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fexceptionsadd = currentForm = new ew.Form("fexceptionsadd", "add");

    // Add fields
    var fields = ew.vars.tables.exceptions.fields;
    fexceptionsadd.addFields([
        ["location_id", [fields.location_id.required ? ew.Validators.required(fields.location_id.caption) : null, ew.Validators.integer], fields.location_id.isInvalid],
        ["date_of", [fields.date_of.required ? ew.Validators.required(fields.date_of.caption) : null, ew.Validators.datetime(0)], fields.date_of.isInvalid],
        ["open", [fields.open.required ? ew.Validators.required(fields.open.caption) : null, ew.Validators.time], fields.open.isInvalid],
        ["close", [fields.close.required ? ew.Validators.required(fields.close.caption) : null, ew.Validators.time], fields.close.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fexceptionsadd,
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
    fexceptionsadd.validate = function () {
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
    fexceptionsadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fexceptionsadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fexceptionsadd");
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
<form name="fexceptionsadd" id="fexceptionsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="exceptions">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->location_id->Visible) { // location_id ?>
    <div id="r_location_id" class="form-group row">
        <label id="elh_exceptions_location_id" for="x_location_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->location_id->caption() ?><?= $Page->location_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->location_id->cellAttributes() ?>>
<span id="el_exceptions_location_id">
<input type="<?= $Page->location_id->getInputTextType() ?>" data-table="exceptions" data-field="x_location_id" name="x_location_id" id="x_location_id" size="30" placeholder="<?= HtmlEncode($Page->location_id->getPlaceHolder()) ?>" value="<?= $Page->location_id->EditValue ?>"<?= $Page->location_id->editAttributes() ?> aria-describedby="x_location_id_help">
<?= $Page->location_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->location_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_of->Visible) { // date_of ?>
    <div id="r_date_of" class="form-group row">
        <label id="elh_exceptions_date_of" for="x_date_of" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_of->caption() ?><?= $Page->date_of->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->date_of->cellAttributes() ?>>
<span id="el_exceptions_date_of">
<input type="<?= $Page->date_of->getInputTextType() ?>" data-table="exceptions" data-field="x_date_of" name="x_date_of" id="x_date_of" placeholder="<?= HtmlEncode($Page->date_of->getPlaceHolder()) ?>" value="<?= $Page->date_of->EditValue ?>"<?= $Page->date_of->editAttributes() ?> aria-describedby="x_date_of_help">
<?= $Page->date_of->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_of->getErrorMessage() ?></div>
<?php if (!$Page->date_of->ReadOnly && !$Page->date_of->Disabled && !isset($Page->date_of->EditAttrs["readonly"]) && !isset($Page->date_of->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fexceptionsadd", "datetimepicker"], function() {
    ew.createDateTimePicker("fexceptionsadd", "x_date_of", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->open->Visible) { // open ?>
    <div id="r_open" class="form-group row">
        <label id="elh_exceptions_open" for="x_open" class="<?= $Page->LeftColumnClass ?>"><?= $Page->open->caption() ?><?= $Page->open->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->open->cellAttributes() ?>>
<span id="el_exceptions_open">
<input type="<?= $Page->open->getInputTextType() ?>" data-table="exceptions" data-field="x_open" name="x_open" id="x_open" placeholder="<?= HtmlEncode($Page->open->getPlaceHolder()) ?>" value="<?= $Page->open->EditValue ?>"<?= $Page->open->editAttributes() ?> aria-describedby="x_open_help">
<?= $Page->open->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->open->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->close->Visible) { // close ?>
    <div id="r_close" class="form-group row">
        <label id="elh_exceptions_close" for="x_close" class="<?= $Page->LeftColumnClass ?>"><?= $Page->close->caption() ?><?= $Page->close->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->close->cellAttributes() ?>>
<span id="el_exceptions_close">
<input type="<?= $Page->close->getInputTextType() ?>" data-table="exceptions" data-field="x_close" name="x_close" id="x_close" placeholder="<?= HtmlEncode($Page->close->getPlaceHolder()) ?>" value="<?= $Page->close->EditValue ?>"<?= $Page->close->editAttributes() ?> aria-describedby="x_close_help">
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
    ew.addEventHandlers("exceptions");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
