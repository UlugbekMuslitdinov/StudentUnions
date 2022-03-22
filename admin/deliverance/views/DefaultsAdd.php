<?php

namespace PHPMaker2021\project3;

// Page object
$DefaultsAdd = &$Page;
?>
<script>
if (!ew.vars.tables.defaults) ew.vars.tables.defaults = <?= JsonEncode(GetClientVar("tables", "defaults")) ?>;
var currentForm, currentPageID;
var fdefaultsadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fdefaultsadd = currentForm = new ew.Form("fdefaultsadd", "add");

    // Add fields
    var fields = ew.vars.tables.defaults.fields;
    fdefaultsadd.addFields([
        ["resourceID", [fields.resourceID.required ? ew.Validators.required(fields.resourceID.caption) : null, ew.Validators.integer], fields.resourceID.isInvalid],
        ["displayBlockID", [fields.displayBlockID.required ? ew.Validators.required(fields.displayBlockID.caption) : null, ew.Validators.integer], fields.displayBlockID.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fdefaultsadd,
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
    fdefaultsadd.validate = function () {
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
    fdefaultsadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fdefaultsadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fdefaultsadd");
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
<form name="fdefaultsadd" id="fdefaultsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="defaults">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->resourceID->Visible) { // resourceID ?>
    <div id="r_resourceID" class="form-group row">
        <label id="elh_defaults_resourceID" for="x_resourceID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->resourceID->caption() ?><?= $Page->resourceID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->resourceID->cellAttributes() ?>>
<span id="el_defaults_resourceID">
<input type="<?= $Page->resourceID->getInputTextType() ?>" data-table="defaults" data-field="x_resourceID" name="x_resourceID" id="x_resourceID" size="30" placeholder="<?= HtmlEncode($Page->resourceID->getPlaceHolder()) ?>" value="<?= $Page->resourceID->EditValue ?>"<?= $Page->resourceID->editAttributes() ?> aria-describedby="x_resourceID_help">
<?= $Page->resourceID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->resourceID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->displayBlockID->Visible) { // displayBlockID ?>
    <div id="r_displayBlockID" class="form-group row">
        <label id="elh_defaults_displayBlockID" for="x_displayBlockID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->displayBlockID->caption() ?><?= $Page->displayBlockID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->displayBlockID->cellAttributes() ?>>
<span id="el_defaults_displayBlockID">
<input type="<?= $Page->displayBlockID->getInputTextType() ?>" data-table="defaults" data-field="x_displayBlockID" name="x_displayBlockID" id="x_displayBlockID" size="30" placeholder="<?= HtmlEncode($Page->displayBlockID->getPlaceHolder()) ?>" value="<?= $Page->displayBlockID->EditValue ?>"<?= $Page->displayBlockID->editAttributes() ?> aria-describedby="x_displayBlockID_help">
<?= $Page->displayBlockID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->displayBlockID->getErrorMessage() ?></div>
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
    ew.addEventHandlers("defaults");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
