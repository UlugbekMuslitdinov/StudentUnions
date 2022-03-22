<?php

namespace PHPMaker2021\project1;

// Page object
$AdminAccessAdd = &$Page;
?>
<script>
if (!ew.vars.tables.admin_access) ew.vars.tables.admin_access = <?= JsonEncode(GetClientVar("tables", "admin_access")) ?>;
var currentForm, currentPageID;
var fadmin_accessadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fadmin_accessadd = currentForm = new ew.Form("fadmin_accessadd", "add");

    // Add fields
    var fields = ew.vars.tables.admin_access.fields;
    fadmin_accessadd.addFields([
        ["admin_user_id", [fields.admin_user_id.required ? ew.Validators.required(fields.admin_user_id.caption) : null, ew.Validators.integer], fields.admin_user_id.isInvalid],
        ["admin_screen_id", [fields.admin_screen_id.required ? ew.Validators.required(fields.admin_screen_id.caption) : null, ew.Validators.integer], fields.admin_screen_id.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fadmin_accessadd,
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
    fadmin_accessadd.validate = function () {
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
    fadmin_accessadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fadmin_accessadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fadmin_accessadd");
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
<form name="fadmin_accessadd" id="fadmin_accessadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="admin_access">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->admin_user_id->Visible) { // admin_user_id ?>
    <div id="r_admin_user_id" class="form-group row">
        <label id="elh_admin_access_admin_user_id" for="x_admin_user_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->admin_user_id->caption() ?><?= $Page->admin_user_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->admin_user_id->cellAttributes() ?>>
<span id="el_admin_access_admin_user_id">
<input type="<?= $Page->admin_user_id->getInputTextType() ?>" data-table="admin_access" data-field="x_admin_user_id" name="x_admin_user_id" id="x_admin_user_id" size="30" placeholder="<?= HtmlEncode($Page->admin_user_id->getPlaceHolder()) ?>" value="<?= $Page->admin_user_id->EditValue ?>"<?= $Page->admin_user_id->editAttributes() ?> aria-describedby="x_admin_user_id_help">
<?= $Page->admin_user_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->admin_user_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->admin_screen_id->Visible) { // admin_screen_id ?>
    <div id="r_admin_screen_id" class="form-group row">
        <label id="elh_admin_access_admin_screen_id" for="x_admin_screen_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->admin_screen_id->caption() ?><?= $Page->admin_screen_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->admin_screen_id->cellAttributes() ?>>
<span id="el_admin_access_admin_screen_id">
<input type="<?= $Page->admin_screen_id->getInputTextType() ?>" data-table="admin_access" data-field="x_admin_screen_id" name="x_admin_screen_id" id="x_admin_screen_id" size="30" placeholder="<?= HtmlEncode($Page->admin_screen_id->getPlaceHolder()) ?>" value="<?= $Page->admin_screen_id->EditValue ?>"<?= $Page->admin_screen_id->editAttributes() ?> aria-describedby="x_admin_screen_id_help">
<?= $Page->admin_screen_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->admin_screen_id->getErrorMessage() ?></div>
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
    ew.addEventHandlers("admin_access");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
