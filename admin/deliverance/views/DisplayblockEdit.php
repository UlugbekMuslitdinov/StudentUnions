<?php

namespace PHPMaker2021\project3;

// Page object
$DisplayblockEdit = &$Page;
?>
<script>
if (!ew.vars.tables.displayblock) ew.vars.tables.displayblock = <?= JsonEncode(GetClientVar("tables", "displayblock")) ?>;
var currentForm, currentPageID;
var fdisplayblockedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fdisplayblockedit = currentForm = new ew.Form("fdisplayblockedit", "edit");

    // Add fields
    var fields = ew.vars.tables.displayblock.fields;
    fdisplayblockedit.addFields([
        ["id", [fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["displayBlockName", [fields.displayBlockName.required ? ew.Validators.required(fields.displayBlockName.caption) : null], fields.displayBlockName.isInvalid],
        ["displayType", [fields.displayType.required ? ew.Validators.required(fields.displayType.caption) : null], fields.displayType.isInvalid],
        ["dimensionsID", [fields.dimensionsID.required ? ew.Validators.required(fields.dimensionsID.caption) : null, ew.Validators.integer], fields.dimensionsID.isInvalid],
        ["feedType", [fields.feedType.required ? ew.Validators.required(fields.feedType.caption) : null], fields.feedType.isInvalid],
        ["site", [fields.site.required ? ew.Validators.required(fields.site.caption) : null], fields.site.isInvalid],
        ["resourceID", [fields.resourceID.required ? ew.Validators.required(fields.resourceID.caption) : null, ew.Validators.integer], fields.resourceID.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fdisplayblockedit,
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
    fdisplayblockedit.validate = function () {
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
    fdisplayblockedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fdisplayblockedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fdisplayblockedit.lists.displayType = <?= $Page->displayType->toClientList($Page) ?>;
    fdisplayblockedit.lists.feedType = <?= $Page->feedType->toClientList($Page) ?>;
    fdisplayblockedit.lists.site = <?= $Page->site->toClientList($Page) ?>;
    loadjs.done("fdisplayblockedit");
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
<form name="fdisplayblockedit" id="fdisplayblockedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="displayblock">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_displayblock_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_displayblock_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="displayblock" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->displayBlockName->Visible) { // displayBlockName ?>
    <div id="r_displayBlockName" class="form-group row">
        <label id="elh_displayblock_displayBlockName" for="x_displayBlockName" class="<?= $Page->LeftColumnClass ?>"><?= $Page->displayBlockName->caption() ?><?= $Page->displayBlockName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->displayBlockName->cellAttributes() ?>>
<span id="el_displayblock_displayBlockName">
<input type="<?= $Page->displayBlockName->getInputTextType() ?>" data-table="displayblock" data-field="x_displayBlockName" name="x_displayBlockName" id="x_displayBlockName" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->displayBlockName->getPlaceHolder()) ?>" value="<?= $Page->displayBlockName->EditValue ?>"<?= $Page->displayBlockName->editAttributes() ?> aria-describedby="x_displayBlockName_help">
<?= $Page->displayBlockName->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->displayBlockName->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->displayType->Visible) { // displayType ?>
    <div id="r_displayType" class="form-group row">
        <label id="elh_displayblock_displayType" class="<?= $Page->LeftColumnClass ?>"><?= $Page->displayType->caption() ?><?= $Page->displayType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->displayType->cellAttributes() ?>>
<span id="el_displayblock_displayType">
<template id="tp_x_displayType">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="displayblock" data-field="x_displayType" name="x_displayType" id="x_displayType"<?= $Page->displayType->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_displayType" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_displayType"
    name="x_displayType"
    value="<?= HtmlEncode($Page->displayType->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_displayType"
    data-target="dsl_x_displayType"
    data-repeatcolumn="5"
    class="form-control<?= $Page->displayType->isInvalidClass() ?>"
    data-table="displayblock"
    data-field="x_displayType"
    data-value-separator="<?= $Page->displayType->displayValueSeparatorAttribute() ?>"
    <?= $Page->displayType->editAttributes() ?>>
<?= $Page->displayType->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->displayType->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->dimensionsID->Visible) { // dimensionsID ?>
    <div id="r_dimensionsID" class="form-group row">
        <label id="elh_displayblock_dimensionsID" for="x_dimensionsID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dimensionsID->caption() ?><?= $Page->dimensionsID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->dimensionsID->cellAttributes() ?>>
<span id="el_displayblock_dimensionsID">
<input type="<?= $Page->dimensionsID->getInputTextType() ?>" data-table="displayblock" data-field="x_dimensionsID" name="x_dimensionsID" id="x_dimensionsID" size="30" placeholder="<?= HtmlEncode($Page->dimensionsID->getPlaceHolder()) ?>" value="<?= $Page->dimensionsID->EditValue ?>"<?= $Page->dimensionsID->editAttributes() ?> aria-describedby="x_dimensionsID_help">
<?= $Page->dimensionsID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->dimensionsID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->feedType->Visible) { // feedType ?>
    <div id="r_feedType" class="form-group row">
        <label id="elh_displayblock_feedType" class="<?= $Page->LeftColumnClass ?>"><?= $Page->feedType->caption() ?><?= $Page->feedType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->feedType->cellAttributes() ?>>
<span id="el_displayblock_feedType">
<template id="tp_x_feedType">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="displayblock" data-field="x_feedType" name="x_feedType" id="x_feedType"<?= $Page->feedType->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_feedType" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_feedType"
    name="x_feedType"
    value="<?= HtmlEncode($Page->feedType->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_feedType"
    data-target="dsl_x_feedType"
    data-repeatcolumn="5"
    class="form-control<?= $Page->feedType->isInvalidClass() ?>"
    data-table="displayblock"
    data-field="x_feedType"
    data-value-separator="<?= $Page->feedType->displayValueSeparatorAttribute() ?>"
    <?= $Page->feedType->editAttributes() ?>>
<?= $Page->feedType->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->feedType->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->site->Visible) { // site ?>
    <div id="r_site" class="form-group row">
        <label id="elh_displayblock_site" class="<?= $Page->LeftColumnClass ?>"><?= $Page->site->caption() ?><?= $Page->site->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->site->cellAttributes() ?>>
<span id="el_displayblock_site">
<template id="tp_x_site">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="displayblock" data-field="x_site" name="x_site" id="x_site"<?= $Page->site->editAttributes() ?>>
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
    data-table="displayblock"
    data-field="x_site"
    data-value-separator="<?= $Page->site->displayValueSeparatorAttribute() ?>"
    <?= $Page->site->editAttributes() ?>>
<?= $Page->site->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->site->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->resourceID->Visible) { // resourceID ?>
    <div id="r_resourceID" class="form-group row">
        <label id="elh_displayblock_resourceID" for="x_resourceID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->resourceID->caption() ?><?= $Page->resourceID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->resourceID->cellAttributes() ?>>
<span id="el_displayblock_resourceID">
<input type="<?= $Page->resourceID->getInputTextType() ?>" data-table="displayblock" data-field="x_resourceID" name="x_resourceID" id="x_resourceID" size="30" placeholder="<?= HtmlEncode($Page->resourceID->getPlaceHolder()) ?>" value="<?= $Page->resourceID->EditValue ?>"<?= $Page->resourceID->editAttributes() ?> aria-describedby="x_resourceID_help">
<?= $Page->resourceID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->resourceID->getErrorMessage() ?></div>
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
    ew.addEventHandlers("displayblock");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
