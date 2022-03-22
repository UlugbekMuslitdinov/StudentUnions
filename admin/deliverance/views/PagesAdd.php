<?php

namespace PHPMaker2021\project3;

// Page object
$PagesAdd = &$Page;
?>
<script>
if (!ew.vars.tables.pages) ew.vars.tables.pages = <?= JsonEncode(GetClientVar("tables", "pages")) ?>;
var currentForm, currentPageID;
var fpagesadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fpagesadd = currentForm = new ew.Form("fpagesadd", "add");

    // Add fields
    var fields = ew.vars.tables.pages.fields;
    fpagesadd.addFields([
        ["domain", [fields.domain.required ? ew.Validators.required(fields.domain.caption) : null], fields.domain.isInvalid],
        ["path", [fields.path.required ? ew.Validators.required(fields.path.caption) : null], fields.path.isInvalid],
        ["displayBlockID", [fields.displayBlockID.required ? ew.Validators.required(fields.displayBlockID.caption) : null, ew.Validators.integer], fields.displayBlockID.isInvalid],
        ["type", [fields.type.required ? ew.Validators.required(fields.type.caption) : null], fields.type.isInvalid],
        ["date", [fields.date.required ? ew.Validators.required(fields.date.caption) : null, ew.Validators.datetime(0)], fields.date.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fpagesadd,
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
    fpagesadd.validate = function () {
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
    fpagesadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpagesadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fpagesadd");
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
<form name="fpagesadd" id="fpagesadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pages">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->domain->Visible) { // domain ?>
    <div id="r_domain" class="form-group row">
        <label id="elh_pages_domain" for="x_domain" class="<?= $Page->LeftColumnClass ?>"><?= $Page->domain->caption() ?><?= $Page->domain->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->domain->cellAttributes() ?>>
<span id="el_pages_domain">
<input type="<?= $Page->domain->getInputTextType() ?>" data-table="pages" data-field="x_domain" name="x_domain" id="x_domain" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->domain->getPlaceHolder()) ?>" value="<?= $Page->domain->EditValue ?>"<?= $Page->domain->editAttributes() ?> aria-describedby="x_domain_help">
<?= $Page->domain->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->domain->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->path->Visible) { // path ?>
    <div id="r_path" class="form-group row">
        <label id="elh_pages_path" for="x_path" class="<?= $Page->LeftColumnClass ?>"><?= $Page->path->caption() ?><?= $Page->path->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->path->cellAttributes() ?>>
<span id="el_pages_path">
<input type="<?= $Page->path->getInputTextType() ?>" data-table="pages" data-field="x_path" name="x_path" id="x_path" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->path->getPlaceHolder()) ?>" value="<?= $Page->path->EditValue ?>"<?= $Page->path->editAttributes() ?> aria-describedby="x_path_help">
<?= $Page->path->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->path->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->displayBlockID->Visible) { // displayBlockID ?>
    <div id="r_displayBlockID" class="form-group row">
        <label id="elh_pages_displayBlockID" for="x_displayBlockID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->displayBlockID->caption() ?><?= $Page->displayBlockID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->displayBlockID->cellAttributes() ?>>
<span id="el_pages_displayBlockID">
<input type="<?= $Page->displayBlockID->getInputTextType() ?>" data-table="pages" data-field="x_displayBlockID" name="x_displayBlockID" id="x_displayBlockID" size="30" placeholder="<?= HtmlEncode($Page->displayBlockID->getPlaceHolder()) ?>" value="<?= $Page->displayBlockID->EditValue ?>"<?= $Page->displayBlockID->editAttributes() ?> aria-describedby="x_displayBlockID_help">
<?= $Page->displayBlockID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->displayBlockID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
    <div id="r_type" class="form-group row">
        <label id="elh_pages_type" for="x_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->type->caption() ?><?= $Page->type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->type->cellAttributes() ?>>
<span id="el_pages_type">
<input type="<?= $Page->type->getInputTextType() ?>" data-table="pages" data-field="x_type" name="x_type" id="x_type" size="30" maxlength="25" placeholder="<?= HtmlEncode($Page->type->getPlaceHolder()) ?>" value="<?= $Page->type->EditValue ?>"<?= $Page->type->editAttributes() ?> aria-describedby="x_type_help">
<?= $Page->type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->type->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date->Visible) { // date ?>
    <div id="r_date" class="form-group row">
        <label id="elh_pages_date" for="x_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date->caption() ?><?= $Page->date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->date->cellAttributes() ?>>
<span id="el_pages_date">
<input type="<?= $Page->date->getInputTextType() ?>" data-table="pages" data-field="x_date" name="x_date" id="x_date" placeholder="<?= HtmlEncode($Page->date->getPlaceHolder()) ?>" value="<?= $Page->date->EditValue ?>"<?= $Page->date->editAttributes() ?> aria-describedby="x_date_help">
<?= $Page->date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date->getErrorMessage() ?></div>
<?php if (!$Page->date->ReadOnly && !$Page->date->Disabled && !isset($Page->date->EditAttrs["readonly"]) && !isset($Page->date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpagesadd", "datetimepicker"], function() {
    ew.createDateTimePicker("fpagesadd", "x_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
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
    ew.addEventHandlers("pages");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
