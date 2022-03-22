<?php

namespace PHPMaker2021\project2;

// Page object
$MenuCategoriesEdit = &$Page;
?>
<script>
if (!ew.vars.tables.menu_categories) ew.vars.tables.menu_categories = <?= JsonEncode(GetClientVar("tables", "menu_categories")) ?>;
var currentForm, currentPageID;
var fmenu_categoriesedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fmenu_categoriesedit = currentForm = new ew.Form("fmenu_categoriesedit", "edit");

    // Add fields
    var fields = ew.vars.tables.menu_categories.fields;
    fmenu_categoriesedit.addFields([
        ["id", [fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["category_name", [fields.category_name.required ? ew.Validators.required(fields.category_name.caption) : null], fields.category_name.isInvalid],
        ["category_comments", [fields.category_comments.required ? ew.Validators.required(fields.category_comments.caption) : null], fields.category_comments.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fmenu_categoriesedit,
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
    fmenu_categoriesedit.validate = function () {
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
    fmenu_categoriesedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmenu_categoriesedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fmenu_categoriesedit");
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
<form name="fmenu_categoriesedit" id="fmenu_categoriesedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="menu_categories">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_menu_categories_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_menu_categories_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="menu_categories" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->category_name->Visible) { // category_name ?>
    <div id="r_category_name" class="form-group row">
        <label id="elh_menu_categories_category_name" for="x_category_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->category_name->caption() ?><?= $Page->category_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->category_name->cellAttributes() ?>>
<span id="el_menu_categories_category_name">
<textarea data-table="menu_categories" data-field="x_category_name" name="x_category_name" id="x_category_name" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->category_name->getPlaceHolder()) ?>"<?= $Page->category_name->editAttributes() ?> aria-describedby="x_category_name_help"><?= $Page->category_name->EditValue ?></textarea>
<?= $Page->category_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->category_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->category_comments->Visible) { // category_comments ?>
    <div id="r_category_comments" class="form-group row">
        <label id="elh_menu_categories_category_comments" for="x_category_comments" class="<?= $Page->LeftColumnClass ?>"><?= $Page->category_comments->caption() ?><?= $Page->category_comments->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->category_comments->cellAttributes() ?>>
<span id="el_menu_categories_category_comments">
<textarea data-table="menu_categories" data-field="x_category_comments" name="x_category_comments" id="x_category_comments" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->category_comments->getPlaceHolder()) ?>"<?= $Page->category_comments->editAttributes() ?> aria-describedby="x_category_comments_help"><?= $Page->category_comments->EditValue ?></textarea>
<?= $Page->category_comments->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->category_comments->getErrorMessage() ?></div>
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
    ew.addEventHandlers("menu_categories");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
