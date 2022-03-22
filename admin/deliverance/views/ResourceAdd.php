<?php

namespace PHPMaker2021\project3;

// Page object
$ResourceAdd = &$Page;
?>
<script>
if (!ew.vars.tables.resource) ew.vars.tables.resource = <?= JsonEncode(GetClientVar("tables", "resource")) ?>;
var currentForm, currentPageID;
var fresourceadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fresourceadd = currentForm = new ew.Form("fresourceadd", "add");

    // Add fields
    var fields = ew.vars.tables.resource.fields;
    fresourceadd.addFields([
        ["filePath", [fields.filePath.required ? ew.Validators.required(fields.filePath.caption) : null], fields.filePath.isInvalid],
        ["fileSize", [fields.fileSize.required ? ew.Validators.required(fields.fileSize.caption) : null, ew.Validators.integer], fields.fileSize.isInvalid],
        ["dimensionsID", [fields.dimensionsID.required ? ew.Validators.required(fields.dimensionsID.caption) : null, ew.Validators.integer], fields.dimensionsID.isInvalid],
        ["type", [fields.type.required ? ew.Validators.required(fields.type.caption) : null], fields.type.isInvalid],
        ["resourceName", [fields.resourceName.required ? ew.Validators.required(fields.resourceName.caption) : null], fields.resourceName.isInvalid],
        ["resourceLink", [fields.resourceLink.required ? ew.Validators.required(fields.resourceLink.caption) : null], fields.resourceLink.isInvalid],
        ["headline", [fields.headline.required ? ew.Validators.required(fields.headline.caption) : null], fields.headline.isInvalid],
        ["subtext", [fields.subtext.required ? ew.Validators.required(fields.subtext.caption) : null], fields.subtext.isInvalid],
        ["site", [fields.site.required ? ew.Validators.required(fields.site.caption) : null], fields.site.isInvalid],
        ["altTxt", [fields.altTxt.required ? ew.Validators.required(fields.altTxt.caption) : null], fields.altTxt.isInvalid],
        ["description", [fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid],
        ["uploadDate", [fields.uploadDate.required ? ew.Validators.required(fields.uploadDate.caption) : null, ew.Validators.datetime(0)], fields.uploadDate.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fresourceadd,
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
    fresourceadd.validate = function () {
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
    fresourceadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fresourceadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fresourceadd.lists.type = <?= $Page->type->toClientList($Page) ?>;
    fresourceadd.lists.site = <?= $Page->site->toClientList($Page) ?>;
    loadjs.done("fresourceadd");
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
<form name="fresourceadd" id="fresourceadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="resource">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->filePath->Visible) { // filePath ?>
    <div id="r_filePath" class="form-group row">
        <label id="elh_resource_filePath" for="x_filePath" class="<?= $Page->LeftColumnClass ?>"><?= $Page->filePath->caption() ?><?= $Page->filePath->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->filePath->cellAttributes() ?>>
<span id="el_resource_filePath">
<input type="<?= $Page->filePath->getInputTextType() ?>" data-table="resource" data-field="x_filePath" name="x_filePath" id="x_filePath" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->filePath->getPlaceHolder()) ?>" value="<?= $Page->filePath->EditValue ?>"<?= $Page->filePath->editAttributes() ?> aria-describedby="x_filePath_help">
<?= $Page->filePath->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->filePath->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->fileSize->Visible) { // fileSize ?>
    <div id="r_fileSize" class="form-group row">
        <label id="elh_resource_fileSize" for="x_fileSize" class="<?= $Page->LeftColumnClass ?>"><?= $Page->fileSize->caption() ?><?= $Page->fileSize->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->fileSize->cellAttributes() ?>>
<span id="el_resource_fileSize">
<input type="<?= $Page->fileSize->getInputTextType() ?>" data-table="resource" data-field="x_fileSize" name="x_fileSize" id="x_fileSize" size="30" placeholder="<?= HtmlEncode($Page->fileSize->getPlaceHolder()) ?>" value="<?= $Page->fileSize->EditValue ?>"<?= $Page->fileSize->editAttributes() ?> aria-describedby="x_fileSize_help">
<?= $Page->fileSize->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->fileSize->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->dimensionsID->Visible) { // dimensionsID ?>
    <div id="r_dimensionsID" class="form-group row">
        <label id="elh_resource_dimensionsID" for="x_dimensionsID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dimensionsID->caption() ?><?= $Page->dimensionsID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->dimensionsID->cellAttributes() ?>>
<span id="el_resource_dimensionsID">
<input type="<?= $Page->dimensionsID->getInputTextType() ?>" data-table="resource" data-field="x_dimensionsID" name="x_dimensionsID" id="x_dimensionsID" size="30" placeholder="<?= HtmlEncode($Page->dimensionsID->getPlaceHolder()) ?>" value="<?= $Page->dimensionsID->EditValue ?>"<?= $Page->dimensionsID->editAttributes() ?> aria-describedby="x_dimensionsID_help">
<?= $Page->dimensionsID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->dimensionsID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
    <div id="r_type" class="form-group row">
        <label id="elh_resource_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->type->caption() ?><?= $Page->type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->type->cellAttributes() ?>>
<span id="el_resource_type">
<template id="tp_x_type">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="resource" data-field="x_type" name="x_type" id="x_type"<?= $Page->type->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_type" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_type"
    name="x_type"
    value="<?= HtmlEncode($Page->type->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_type"
    data-target="dsl_x_type"
    data-repeatcolumn="5"
    class="form-control<?= $Page->type->isInvalidClass() ?>"
    data-table="resource"
    data-field="x_type"
    data-value-separator="<?= $Page->type->displayValueSeparatorAttribute() ?>"
    <?= $Page->type->editAttributes() ?>>
<?= $Page->type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->type->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->resourceName->Visible) { // resourceName ?>
    <div id="r_resourceName" class="form-group row">
        <label id="elh_resource_resourceName" for="x_resourceName" class="<?= $Page->LeftColumnClass ?>"><?= $Page->resourceName->caption() ?><?= $Page->resourceName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->resourceName->cellAttributes() ?>>
<span id="el_resource_resourceName">
<input type="<?= $Page->resourceName->getInputTextType() ?>" data-table="resource" data-field="x_resourceName" name="x_resourceName" id="x_resourceName" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->resourceName->getPlaceHolder()) ?>" value="<?= $Page->resourceName->EditValue ?>"<?= $Page->resourceName->editAttributes() ?> aria-describedby="x_resourceName_help">
<?= $Page->resourceName->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->resourceName->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->resourceLink->Visible) { // resourceLink ?>
    <div id="r_resourceLink" class="form-group row">
        <label id="elh_resource_resourceLink" for="x_resourceLink" class="<?= $Page->LeftColumnClass ?>"><?= $Page->resourceLink->caption() ?><?= $Page->resourceLink->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->resourceLink->cellAttributes() ?>>
<span id="el_resource_resourceLink">
<input type="<?= $Page->resourceLink->getInputTextType() ?>" data-table="resource" data-field="x_resourceLink" name="x_resourceLink" id="x_resourceLink" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->resourceLink->getPlaceHolder()) ?>" value="<?= $Page->resourceLink->EditValue ?>"<?= $Page->resourceLink->editAttributes() ?> aria-describedby="x_resourceLink_help">
<?= $Page->resourceLink->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->resourceLink->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->headline->Visible) { // headline ?>
    <div id="r_headline" class="form-group row">
        <label id="elh_resource_headline" for="x_headline" class="<?= $Page->LeftColumnClass ?>"><?= $Page->headline->caption() ?><?= $Page->headline->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->headline->cellAttributes() ?>>
<span id="el_resource_headline">
<input type="<?= $Page->headline->getInputTextType() ?>" data-table="resource" data-field="x_headline" name="x_headline" id="x_headline" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->headline->getPlaceHolder()) ?>" value="<?= $Page->headline->EditValue ?>"<?= $Page->headline->editAttributes() ?> aria-describedby="x_headline_help">
<?= $Page->headline->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->headline->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->subtext->Visible) { // subtext ?>
    <div id="r_subtext" class="form-group row">
        <label id="elh_resource_subtext" for="x_subtext" class="<?= $Page->LeftColumnClass ?>"><?= $Page->subtext->caption() ?><?= $Page->subtext->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->subtext->cellAttributes() ?>>
<span id="el_resource_subtext">
<input type="<?= $Page->subtext->getInputTextType() ?>" data-table="resource" data-field="x_subtext" name="x_subtext" id="x_subtext" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->subtext->getPlaceHolder()) ?>" value="<?= $Page->subtext->EditValue ?>"<?= $Page->subtext->editAttributes() ?> aria-describedby="x_subtext_help">
<?= $Page->subtext->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->subtext->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->site->Visible) { // site ?>
    <div id="r_site" class="form-group row">
        <label id="elh_resource_site" class="<?= $Page->LeftColumnClass ?>"><?= $Page->site->caption() ?><?= $Page->site->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->site->cellAttributes() ?>>
<span id="el_resource_site">
<template id="tp_x_site">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="resource" data-field="x_site" name="x_site" id="x_site"<?= $Page->site->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_site" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_site"
    name="x_site"
    value="<?= HtmlEncode($Page->site->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_site"
    data-target="dsl_x_site"
    data-repeatcolumn="5"
    class="form-control<?= $Page->site->isInvalidClass() ?>"
    data-table="resource"
    data-field="x_site"
    data-value-separator="<?= $Page->site->displayValueSeparatorAttribute() ?>"
    <?= $Page->site->editAttributes() ?>>
<?= $Page->site->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->site->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->altTxt->Visible) { // altTxt ?>
    <div id="r_altTxt" class="form-group row">
        <label id="elh_resource_altTxt" for="x_altTxt" class="<?= $Page->LeftColumnClass ?>"><?= $Page->altTxt->caption() ?><?= $Page->altTxt->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->altTxt->cellAttributes() ?>>
<span id="el_resource_altTxt">
<input type="<?= $Page->altTxt->getInputTextType() ?>" data-table="resource" data-field="x_altTxt" name="x_altTxt" id="x_altTxt" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->altTxt->getPlaceHolder()) ?>" value="<?= $Page->altTxt->EditValue ?>"<?= $Page->altTxt->editAttributes() ?> aria-describedby="x_altTxt_help">
<?= $Page->altTxt->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->altTxt->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description" class="form-group row">
        <label id="elh_resource_description" for="x_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->description->cellAttributes() ?>>
<span id="el_resource_description">
<textarea data-table="resource" data-field="x_description" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help"><?= $Page->description->EditValue ?></textarea>
<?= $Page->description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->uploadDate->Visible) { // uploadDate ?>
    <div id="r_uploadDate" class="form-group row">
        <label id="elh_resource_uploadDate" for="x_uploadDate" class="<?= $Page->LeftColumnClass ?>"><?= $Page->uploadDate->caption() ?><?= $Page->uploadDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->uploadDate->cellAttributes() ?>>
<span id="el_resource_uploadDate">
<input type="<?= $Page->uploadDate->getInputTextType() ?>" data-table="resource" data-field="x_uploadDate" name="x_uploadDate" id="x_uploadDate" placeholder="<?= HtmlEncode($Page->uploadDate->getPlaceHolder()) ?>" value="<?= $Page->uploadDate->EditValue ?>"<?= $Page->uploadDate->editAttributes() ?> aria-describedby="x_uploadDate_help">
<?= $Page->uploadDate->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->uploadDate->getErrorMessage() ?></div>
<?php if (!$Page->uploadDate->ReadOnly && !$Page->uploadDate->Disabled && !isset($Page->uploadDate->EditAttrs["readonly"]) && !isset($Page->uploadDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fresourceadd", "datetimepicker"], function() {
    ew.createDateTimePicker("fresourceadd", "x_uploadDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
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
    ew.addEventHandlers("resource");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
