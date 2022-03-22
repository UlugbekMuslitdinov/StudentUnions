<?php

namespace PHPMaker2021\project2;

// Page object
$MenuItemsAdd = &$Page;
?>
<script>
if (!ew.vars.tables.menu_items) ew.vars.tables.menu_items = <?= JsonEncode(GetClientVar("tables", "menu_items")) ?>;
var currentForm, currentPageID;
var fmenu_itemsadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fmenu_itemsadd = currentForm = new ew.Form("fmenu_itemsadd", "add");

    // Add fields
    var fields = ew.vars.tables.menu_items.fields;
    fmenu_itemsadd.addFields([
        ["menu_item", [fields.menu_item.required ? ew.Validators.required(fields.menu_item.caption) : null], fields.menu_item.isInvalid],
        ["menu_item_price", [fields.menu_item_price.required ? ew.Validators.required(fields.menu_item_price.caption) : null], fields.menu_item_price.isInvalid],
        ["menu_restaurant", [fields.menu_restaurant.required ? ew.Validators.required(fields.menu_restaurant.caption) : null, ew.Validators.integer], fields.menu_restaurant.isInvalid],
        ["menu_category", [fields.menu_category.required ? ew.Validators.required(fields.menu_category.caption) : null, ew.Validators.integer], fields.menu_category.isInvalid],
        ["meal_details_id", [fields.meal_details_id.required ? ew.Validators.required(fields.meal_details_id.caption) : null, ew.Validators.integer], fields.meal_details_id.isInvalid],
        ["menu_item_comments", [fields.menu_item_comments.required ? ew.Validators.required(fields.menu_item_comments.caption) : null], fields.menu_item_comments.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fmenu_itemsadd,
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
    fmenu_itemsadd.validate = function () {
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
    fmenu_itemsadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmenu_itemsadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fmenu_itemsadd");
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
<form name="fmenu_itemsadd" id="fmenu_itemsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="menu_items">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->menu_item->Visible) { // menu_item ?>
    <div id="r_menu_item" class="form-group row">
        <label id="elh_menu_items_menu_item" for="x_menu_item" class="<?= $Page->LeftColumnClass ?>"><?= $Page->menu_item->caption() ?><?= $Page->menu_item->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->menu_item->cellAttributes() ?>>
<span id="el_menu_items_menu_item">
<textarea data-table="menu_items" data-field="x_menu_item" name="x_menu_item" id="x_menu_item" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->menu_item->getPlaceHolder()) ?>"<?= $Page->menu_item->editAttributes() ?> aria-describedby="x_menu_item_help"><?= $Page->menu_item->EditValue ?></textarea>
<?= $Page->menu_item->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->menu_item->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->menu_item_price->Visible) { // menu_item_price ?>
    <div id="r_menu_item_price" class="form-group row">
        <label id="elh_menu_items_menu_item_price" for="x_menu_item_price" class="<?= $Page->LeftColumnClass ?>"><?= $Page->menu_item_price->caption() ?><?= $Page->menu_item_price->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->menu_item_price->cellAttributes() ?>>
<span id="el_menu_items_menu_item_price">
<textarea data-table="menu_items" data-field="x_menu_item_price" name="x_menu_item_price" id="x_menu_item_price" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->menu_item_price->getPlaceHolder()) ?>"<?= $Page->menu_item_price->editAttributes() ?> aria-describedby="x_menu_item_price_help"><?= $Page->menu_item_price->EditValue ?></textarea>
<?= $Page->menu_item_price->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->menu_item_price->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->menu_restaurant->Visible) { // menu_restaurant ?>
    <div id="r_menu_restaurant" class="form-group row">
        <label id="elh_menu_items_menu_restaurant" for="x_menu_restaurant" class="<?= $Page->LeftColumnClass ?>"><?= $Page->menu_restaurant->caption() ?><?= $Page->menu_restaurant->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->menu_restaurant->cellAttributes() ?>>
<span id="el_menu_items_menu_restaurant">
<input type="<?= $Page->menu_restaurant->getInputTextType() ?>" data-table="menu_items" data-field="x_menu_restaurant" name="x_menu_restaurant" id="x_menu_restaurant" size="30" placeholder="<?= HtmlEncode($Page->menu_restaurant->getPlaceHolder()) ?>" value="<?= $Page->menu_restaurant->EditValue ?>"<?= $Page->menu_restaurant->editAttributes() ?> aria-describedby="x_menu_restaurant_help">
<?= $Page->menu_restaurant->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->menu_restaurant->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->menu_category->Visible) { // menu_category ?>
    <div id="r_menu_category" class="form-group row">
        <label id="elh_menu_items_menu_category" for="x_menu_category" class="<?= $Page->LeftColumnClass ?>"><?= $Page->menu_category->caption() ?><?= $Page->menu_category->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->menu_category->cellAttributes() ?>>
<span id="el_menu_items_menu_category">
<input type="<?= $Page->menu_category->getInputTextType() ?>" data-table="menu_items" data-field="x_menu_category" name="x_menu_category" id="x_menu_category" size="30" placeholder="<?= HtmlEncode($Page->menu_category->getPlaceHolder()) ?>" value="<?= $Page->menu_category->EditValue ?>"<?= $Page->menu_category->editAttributes() ?> aria-describedby="x_menu_category_help">
<?= $Page->menu_category->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->menu_category->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->meal_details_id->Visible) { // meal_details_id ?>
    <div id="r_meal_details_id" class="form-group row">
        <label id="elh_menu_items_meal_details_id" for="x_meal_details_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->meal_details_id->caption() ?><?= $Page->meal_details_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->meal_details_id->cellAttributes() ?>>
<span id="el_menu_items_meal_details_id">
<input type="<?= $Page->meal_details_id->getInputTextType() ?>" data-table="menu_items" data-field="x_meal_details_id" name="x_meal_details_id" id="x_meal_details_id" size="30" placeholder="<?= HtmlEncode($Page->meal_details_id->getPlaceHolder()) ?>" value="<?= $Page->meal_details_id->EditValue ?>"<?= $Page->meal_details_id->editAttributes() ?> aria-describedby="x_meal_details_id_help">
<?= $Page->meal_details_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->meal_details_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->menu_item_comments->Visible) { // menu_item_comments ?>
    <div id="r_menu_item_comments" class="form-group row">
        <label id="elh_menu_items_menu_item_comments" for="x_menu_item_comments" class="<?= $Page->LeftColumnClass ?>"><?= $Page->menu_item_comments->caption() ?><?= $Page->menu_item_comments->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->menu_item_comments->cellAttributes() ?>>
<span id="el_menu_items_menu_item_comments">
<textarea data-table="menu_items" data-field="x_menu_item_comments" name="x_menu_item_comments" id="x_menu_item_comments" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->menu_item_comments->getPlaceHolder()) ?>"<?= $Page->menu_item_comments->editAttributes() ?> aria-describedby="x_menu_item_comments_help"><?= $Page->menu_item_comments->EditValue ?></textarea>
<?= $Page->menu_item_comments->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->menu_item_comments->getErrorMessage() ?></div>
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
    ew.addEventHandlers("menu_items");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
