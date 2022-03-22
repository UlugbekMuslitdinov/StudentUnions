<?php

namespace PHPMaker2022\project1;

// Page object
$MenuCategoriesEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { menu_categories: currentTable } });
var currentForm, currentPageID;
var fmenu_categoriesedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmenu_categoriesedit = new ew.Form("fmenu_categoriesedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fmenu_categoriesedit;

    // Add fields
    var fields = currentTable.fields;
    fmenu_categoriesedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["category_name", [fields.category_name.visible && fields.category_name.required ? ew.Validators.required(fields.category_name.caption) : null], fields.category_name.isInvalid],
        ["category_comments", [fields.category_comments.visible && fields.category_comments.required ? ew.Validators.required(fields.category_comments.caption) : null], fields.category_comments.isInvalid]
    ]);

    // Form_CustomValidate
    fmenu_categoriesedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmenu_categoriesedit.validateRequired = ew.CLIENT_VALIDATE;

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
<form name="fmenu_categoriesedit" id="fmenu_categoriesedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
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
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_menu_categories_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_menu_categories_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="menu_categories" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->category_name->Visible) { // category_name ?>
    <div id="r_category_name"<?= $Page->category_name->rowAttributes() ?>>
        <label id="elh_menu_categories_category_name" for="x_category_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->category_name->caption() ?><?= $Page->category_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->category_name->cellAttributes() ?>>
<span id="el_menu_categories_category_name">
<textarea data-table="menu_categories" data-field="x_category_name" name="x_category_name" id="x_category_name" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->category_name->getPlaceHolder()) ?>"<?= $Page->category_name->editAttributes() ?> aria-describedby="x_category_name_help"><?= $Page->category_name->EditValue ?></textarea>
<?= $Page->category_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->category_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->category_comments->Visible) { // category_comments ?>
    <div id="r_category_comments"<?= $Page->category_comments->rowAttributes() ?>>
        <label id="elh_menu_categories_category_comments" for="x_category_comments" class="<?= $Page->LeftColumnClass ?>"><?= $Page->category_comments->caption() ?><?= $Page->category_comments->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->category_comments->cellAttributes() ?>>
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
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .row -->
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
