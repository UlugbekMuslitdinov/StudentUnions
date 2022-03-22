<?php

namespace PHPMaker2021\project3;

// Page object
$CurrentAdd = &$Page;
?>
<script>
if (!ew.vars.tables.current) ew.vars.tables.current = <?= JsonEncode(GetClientVar("tables", "current")) ?>;
var currentForm, currentPageID;
var fcurrentadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fcurrentadd = currentForm = new ew.Form("fcurrentadd", "add");

    // Add fields
    var fields = ew.vars.tables.current.fields;
    fcurrentadd.addFields([
        ["resourceID", [fields.resourceID.required ? ew.Validators.required(fields.resourceID.caption) : null, ew.Validators.integer], fields.resourceID.isInvalid],
        ["displayBlockID", [fields.displayBlockID.required ? ew.Validators.required(fields.displayBlockID.caption) : null, ew.Validators.integer], fields.displayBlockID.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fcurrentadd,
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
    fcurrentadd.validate = function () {
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
    fcurrentadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fcurrentadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fcurrentadd");
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
<form name="fcurrentadd" id="fcurrentadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="current">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->resourceID->Visible) { // resourceID ?>
    <div id="r_resourceID" class="form-group row">
        <label id="elh_current_resourceID" for="x_resourceID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->resourceID->caption() ?><?= $Page->resourceID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->resourceID->cellAttributes() ?>>
<span id="el_current_resourceID">
<input type="<?= $Page->resourceID->getInputTextType() ?>" data-table="current" data-field="x_resourceID" name="x_resourceID" id="x_resourceID" size="30" placeholder="<?= HtmlEncode($Page->resourceID->getPlaceHolder()) ?>" value="<?= $Page->resourceID->EditValue ?>"<?= $Page->resourceID->editAttributes() ?> aria-describedby="x_resourceID_help">
<?= $Page->resourceID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->resourceID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->displayBlockID->Visible) { // displayBlockID ?>
    <div id="r_displayBlockID" class="form-group row">
        <label id="elh_current_displayBlockID" for="x_displayBlockID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->displayBlockID->caption() ?><?= $Page->displayBlockID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->displayBlockID->cellAttributes() ?>>
<span id="el_current_displayBlockID">
<input type="<?= $Page->displayBlockID->getInputTextType() ?>" data-table="current" data-field="x_displayBlockID" name="x_displayBlockID" id="x_displayBlockID" size="30" placeholder="<?= HtmlEncode($Page->displayBlockID->getPlaceHolder()) ?>" value="<?= $Page->displayBlockID->EditValue ?>"<?= $Page->displayBlockID->editAttributes() ?> aria-describedby="x_displayBlockID_help">
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
    ew.addEventHandlers("current");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
