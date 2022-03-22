<?php

namespace PHPMaker2022\project1;

// Page object
$MenuItemsEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { menu_items: currentTable } });
var currentForm, currentPageID;
var fmenu_itemsedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmenu_itemsedit = new ew.Form("fmenu_itemsedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fmenu_itemsedit;

    // Add fields
    var fields = currentTable.fields;
    fmenu_itemsedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["menu_item", [fields.menu_item.visible && fields.menu_item.required ? ew.Validators.required(fields.menu_item.caption) : null], fields.menu_item.isInvalid],
        ["menu_item_price", [fields.menu_item_price.visible && fields.menu_item_price.required ? ew.Validators.required(fields.menu_item_price.caption) : null], fields.menu_item_price.isInvalid],
        ["menu_restaurant", [fields.menu_restaurant.visible && fields.menu_restaurant.required ? ew.Validators.required(fields.menu_restaurant.caption) : null, ew.Validators.integer], fields.menu_restaurant.isInvalid],
        ["menu_category", [fields.menu_category.visible && fields.menu_category.required ? ew.Validators.required(fields.menu_category.caption) : null, ew.Validators.integer], fields.menu_category.isInvalid],
        ["meal_details_id", [fields.meal_details_id.visible && fields.meal_details_id.required ? ew.Validators.required(fields.meal_details_id.caption) : null, ew.Validators.integer], fields.meal_details_id.isInvalid],
        ["menu_item_comments", [fields.menu_item_comments.visible && fields.menu_item_comments.required ? ew.Validators.required(fields.menu_item_comments.caption) : null], fields.menu_item_comments.isInvalid]
    ]);

    // Form_CustomValidate
    fmenu_itemsedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmenu_itemsedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fmenu_itemsedit");
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
<form name="fmenu_itemsedit" id="fmenu_itemsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="menu_items">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_menu_items_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_menu_items_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="menu_items" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->menu_item->Visible) { // menu_item ?>
    <div id="r_menu_item"<?= $Page->menu_item->rowAttributes() ?>>
        <label id="elh_menu_items_menu_item" for="x_menu_item" class="<?= $Page->LeftColumnClass ?>"><?= $Page->menu_item->caption() ?><?= $Page->menu_item->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->menu_item->cellAttributes() ?>>
<span id="el_menu_items_menu_item">
<textarea data-table="menu_items" data-field="x_menu_item" name="x_menu_item" id="x_menu_item" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->menu_item->getPlaceHolder()) ?>"<?= $Page->menu_item->editAttributes() ?> aria-describedby="x_menu_item_help"><?= $Page->menu_item->EditValue ?></textarea>
<?= $Page->menu_item->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->menu_item->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->menu_item_price->Visible) { // menu_item_price ?>
    <div id="r_menu_item_price"<?= $Page->menu_item_price->rowAttributes() ?>>
        <label id="elh_menu_items_menu_item_price" for="x_menu_item_price" class="<?= $Page->LeftColumnClass ?>"><?= $Page->menu_item_price->caption() ?><?= $Page->menu_item_price->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->menu_item_price->cellAttributes() ?>>
<span id="el_menu_items_menu_item_price">
<textarea data-table="menu_items" data-field="x_menu_item_price" name="x_menu_item_price" id="x_menu_item_price" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->menu_item_price->getPlaceHolder()) ?>"<?= $Page->menu_item_price->editAttributes() ?> aria-describedby="x_menu_item_price_help"><?= $Page->menu_item_price->EditValue ?></textarea>
<?= $Page->menu_item_price->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->menu_item_price->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->menu_restaurant->Visible) { // menu_restaurant ?>
    <div id="r_menu_restaurant"<?= $Page->menu_restaurant->rowAttributes() ?>>
        <label id="elh_menu_items_menu_restaurant" for="x_menu_restaurant" class="<?= $Page->LeftColumnClass ?>"><?= $Page->menu_restaurant->caption() ?><?= $Page->menu_restaurant->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->menu_restaurant->cellAttributes() ?>>
<span id="el_menu_items_menu_restaurant">
<input type="<?= $Page->menu_restaurant->getInputTextType() ?>" name="x_menu_restaurant" id="x_menu_restaurant" data-table="menu_items" data-field="x_menu_restaurant" value="<?= $Page->menu_restaurant->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->menu_restaurant->getPlaceHolder()) ?>"<?= $Page->menu_restaurant->editAttributes() ?> aria-describedby="x_menu_restaurant_help">
<?= $Page->menu_restaurant->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->menu_restaurant->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->menu_category->Visible) { // menu_category ?>
    <div id="r_menu_category"<?= $Page->menu_category->rowAttributes() ?>>
        <label id="elh_menu_items_menu_category" for="x_menu_category" class="<?= $Page->LeftColumnClass ?>"><?= $Page->menu_category->caption() ?><?= $Page->menu_category->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->menu_category->cellAttributes() ?>>
<span id="el_menu_items_menu_category">
<input type="<?= $Page->menu_category->getInputTextType() ?>" name="x_menu_category" id="x_menu_category" data-table="menu_items" data-field="x_menu_category" value="<?= $Page->menu_category->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->menu_category->getPlaceHolder()) ?>"<?= $Page->menu_category->editAttributes() ?> aria-describedby="x_menu_category_help">
<?= $Page->menu_category->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->menu_category->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->meal_details_id->Visible) { // meal_details_id ?>
    <div id="r_meal_details_id"<?= $Page->meal_details_id->rowAttributes() ?>>
        <label id="elh_menu_items_meal_details_id" for="x_meal_details_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->meal_details_id->caption() ?><?= $Page->meal_details_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->meal_details_id->cellAttributes() ?>>
<span id="el_menu_items_meal_details_id">
<input type="<?= $Page->meal_details_id->getInputTextType() ?>" name="x_meal_details_id" id="x_meal_details_id" data-table="menu_items" data-field="x_meal_details_id" value="<?= $Page->meal_details_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->meal_details_id->getPlaceHolder()) ?>"<?= $Page->meal_details_id->editAttributes() ?> aria-describedby="x_meal_details_id_help">
<?= $Page->meal_details_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->meal_details_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->menu_item_comments->Visible) { // menu_item_comments ?>
    <div id="r_menu_item_comments"<?= $Page->menu_item_comments->rowAttributes() ?>>
        <label id="elh_menu_items_menu_item_comments" for="x_menu_item_comments" class="<?= $Page->LeftColumnClass ?>"><?= $Page->menu_item_comments->caption() ?><?= $Page->menu_item_comments->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->menu_item_comments->cellAttributes() ?>>
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
    ew.addEventHandlers("menu_items");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
