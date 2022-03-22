<?php

namespace PHPMaker2022\project1;

// Page object
$MenuSpecialsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { menu_specials: currentTable } });
var currentForm, currentPageID;
var fmenu_specialsadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmenu_specialsadd = new ew.Form("fmenu_specialsadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fmenu_specialsadd;

    // Add fields
    var fields = currentTable.fields;
    fmenu_specialsadd.addFields([
        ["menu_special", [fields.menu_special.visible && fields.menu_special.required ? ew.Validators.required(fields.menu_special.caption) : null], fields.menu_special.isInvalid],
        ["menu_special_price", [fields.menu_special_price.visible && fields.menu_special_price.required ? ew.Validators.required(fields.menu_special_price.caption) : null, ew.Validators.float], fields.menu_special_price.isInvalid],
        ["menu_restaurant", [fields.menu_restaurant.visible && fields.menu_restaurant.required ? ew.Validators.required(fields.menu_restaurant.caption) : null, ew.Validators.integer], fields.menu_restaurant.isInvalid],
        ["menu_category", [fields.menu_category.visible && fields.menu_category.required ? ew.Validators.required(fields.menu_category.caption) : null, ew.Validators.integer], fields.menu_category.isInvalid],
        ["menu_special_comments", [fields.menu_special_comments.visible && fields.menu_special_comments.required ? ew.Validators.required(fields.menu_special_comments.caption) : null], fields.menu_special_comments.isInvalid],
        ["menu_special_startdate", [fields.menu_special_startdate.visible && fields.menu_special_startdate.required ? ew.Validators.required(fields.menu_special_startdate.caption) : null, ew.Validators.datetime(fields.menu_special_startdate.clientFormatPattern)], fields.menu_special_startdate.isInvalid],
        ["menu_special_enddate", [fields.menu_special_enddate.visible && fields.menu_special_enddate.required ? ew.Validators.required(fields.menu_special_enddate.caption) : null, ew.Validators.datetime(fields.menu_special_enddate.clientFormatPattern)], fields.menu_special_enddate.isInvalid],
        ["menu_special_replace_item", [fields.menu_special_replace_item.visible && fields.menu_special_replace_item.required ? ew.Validators.required(fields.menu_special_replace_item.caption) : null, ew.Validators.integer], fields.menu_special_replace_item.isInvalid]
    ]);

    // Form_CustomValidate
    fmenu_specialsadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmenu_specialsadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fmenu_specialsadd");
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
<form name="fmenu_specialsadd" id="fmenu_specialsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="menu_specials">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->menu_special->Visible) { // menu_special ?>
    <div id="r_menu_special"<?= $Page->menu_special->rowAttributes() ?>>
        <label id="elh_menu_specials_menu_special" for="x_menu_special" class="<?= $Page->LeftColumnClass ?>"><?= $Page->menu_special->caption() ?><?= $Page->menu_special->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->menu_special->cellAttributes() ?>>
<span id="el_menu_specials_menu_special">
<textarea data-table="menu_specials" data-field="x_menu_special" name="x_menu_special" id="x_menu_special" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->menu_special->getPlaceHolder()) ?>"<?= $Page->menu_special->editAttributes() ?> aria-describedby="x_menu_special_help"><?= $Page->menu_special->EditValue ?></textarea>
<?= $Page->menu_special->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->menu_special->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->menu_special_price->Visible) { // menu_special_price ?>
    <div id="r_menu_special_price"<?= $Page->menu_special_price->rowAttributes() ?>>
        <label id="elh_menu_specials_menu_special_price" for="x_menu_special_price" class="<?= $Page->LeftColumnClass ?>"><?= $Page->menu_special_price->caption() ?><?= $Page->menu_special_price->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->menu_special_price->cellAttributes() ?>>
<span id="el_menu_specials_menu_special_price">
<input type="<?= $Page->menu_special_price->getInputTextType() ?>" name="x_menu_special_price" id="x_menu_special_price" data-table="menu_specials" data-field="x_menu_special_price" value="<?= $Page->menu_special_price->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->menu_special_price->getPlaceHolder()) ?>"<?= $Page->menu_special_price->editAttributes() ?> aria-describedby="x_menu_special_price_help">
<?= $Page->menu_special_price->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->menu_special_price->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->menu_restaurant->Visible) { // menu_restaurant ?>
    <div id="r_menu_restaurant"<?= $Page->menu_restaurant->rowAttributes() ?>>
        <label id="elh_menu_specials_menu_restaurant" for="x_menu_restaurant" class="<?= $Page->LeftColumnClass ?>"><?= $Page->menu_restaurant->caption() ?><?= $Page->menu_restaurant->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->menu_restaurant->cellAttributes() ?>>
<span id="el_menu_specials_menu_restaurant">
<input type="<?= $Page->menu_restaurant->getInputTextType() ?>" name="x_menu_restaurant" id="x_menu_restaurant" data-table="menu_specials" data-field="x_menu_restaurant" value="<?= $Page->menu_restaurant->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->menu_restaurant->getPlaceHolder()) ?>"<?= $Page->menu_restaurant->editAttributes() ?> aria-describedby="x_menu_restaurant_help">
<?= $Page->menu_restaurant->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->menu_restaurant->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->menu_category->Visible) { // menu_category ?>
    <div id="r_menu_category"<?= $Page->menu_category->rowAttributes() ?>>
        <label id="elh_menu_specials_menu_category" for="x_menu_category" class="<?= $Page->LeftColumnClass ?>"><?= $Page->menu_category->caption() ?><?= $Page->menu_category->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->menu_category->cellAttributes() ?>>
<span id="el_menu_specials_menu_category">
<input type="<?= $Page->menu_category->getInputTextType() ?>" name="x_menu_category" id="x_menu_category" data-table="menu_specials" data-field="x_menu_category" value="<?= $Page->menu_category->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->menu_category->getPlaceHolder()) ?>"<?= $Page->menu_category->editAttributes() ?> aria-describedby="x_menu_category_help">
<?= $Page->menu_category->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->menu_category->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->menu_special_comments->Visible) { // menu_special_comments ?>
    <div id="r_menu_special_comments"<?= $Page->menu_special_comments->rowAttributes() ?>>
        <label id="elh_menu_specials_menu_special_comments" for="x_menu_special_comments" class="<?= $Page->LeftColumnClass ?>"><?= $Page->menu_special_comments->caption() ?><?= $Page->menu_special_comments->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->menu_special_comments->cellAttributes() ?>>
<span id="el_menu_specials_menu_special_comments">
<textarea data-table="menu_specials" data-field="x_menu_special_comments" name="x_menu_special_comments" id="x_menu_special_comments" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->menu_special_comments->getPlaceHolder()) ?>"<?= $Page->menu_special_comments->editAttributes() ?> aria-describedby="x_menu_special_comments_help"><?= $Page->menu_special_comments->EditValue ?></textarea>
<?= $Page->menu_special_comments->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->menu_special_comments->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->menu_special_startdate->Visible) { // menu_special_startdate ?>
    <div id="r_menu_special_startdate"<?= $Page->menu_special_startdate->rowAttributes() ?>>
        <label id="elh_menu_specials_menu_special_startdate" for="x_menu_special_startdate" class="<?= $Page->LeftColumnClass ?>"><?= $Page->menu_special_startdate->caption() ?><?= $Page->menu_special_startdate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->menu_special_startdate->cellAttributes() ?>>
<span id="el_menu_specials_menu_special_startdate">
<input type="<?= $Page->menu_special_startdate->getInputTextType() ?>" name="x_menu_special_startdate" id="x_menu_special_startdate" data-table="menu_specials" data-field="x_menu_special_startdate" value="<?= $Page->menu_special_startdate->EditValue ?>" placeholder="<?= HtmlEncode($Page->menu_special_startdate->getPlaceHolder()) ?>"<?= $Page->menu_special_startdate->editAttributes() ?> aria-describedby="x_menu_special_startdate_help">
<?= $Page->menu_special_startdate->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->menu_special_startdate->getErrorMessage() ?></div>
<?php if (!$Page->menu_special_startdate->ReadOnly && !$Page->menu_special_startdate->Disabled && !isset($Page->menu_special_startdate->EditAttrs["readonly"]) && !isset($Page->menu_special_startdate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmenu_specialsadd", "datetimepicker"], function () {
    let options = {
        localization: {
            locale: ew.LANGUAGE_ID
        },
        display: {
            inputFormat: "<?= DateFormat(0) ?>",
            icons: {
                previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
            }
        }
    };
    ew.createDateTimePicker("fmenu_specialsadd", "x_menu_special_startdate", jQuery.extend(true, {"ignoreReadonly":true,"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->menu_special_enddate->Visible) { // menu_special_enddate ?>
    <div id="r_menu_special_enddate"<?= $Page->menu_special_enddate->rowAttributes() ?>>
        <label id="elh_menu_specials_menu_special_enddate" for="x_menu_special_enddate" class="<?= $Page->LeftColumnClass ?>"><?= $Page->menu_special_enddate->caption() ?><?= $Page->menu_special_enddate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->menu_special_enddate->cellAttributes() ?>>
<span id="el_menu_specials_menu_special_enddate">
<input type="<?= $Page->menu_special_enddate->getInputTextType() ?>" name="x_menu_special_enddate" id="x_menu_special_enddate" data-table="menu_specials" data-field="x_menu_special_enddate" value="<?= $Page->menu_special_enddate->EditValue ?>" placeholder="<?= HtmlEncode($Page->menu_special_enddate->getPlaceHolder()) ?>"<?= $Page->menu_special_enddate->editAttributes() ?> aria-describedby="x_menu_special_enddate_help">
<?= $Page->menu_special_enddate->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->menu_special_enddate->getErrorMessage() ?></div>
<?php if (!$Page->menu_special_enddate->ReadOnly && !$Page->menu_special_enddate->Disabled && !isset($Page->menu_special_enddate->EditAttrs["readonly"]) && !isset($Page->menu_special_enddate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmenu_specialsadd", "datetimepicker"], function () {
    let options = {
        localization: {
            locale: ew.LANGUAGE_ID
        },
        display: {
            inputFormat: "<?= DateFormat(0) ?>",
            icons: {
                previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
            }
        }
    };
    ew.createDateTimePicker("fmenu_specialsadd", "x_menu_special_enddate", jQuery.extend(true, {"ignoreReadonly":true,"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->menu_special_replace_item->Visible) { // menu_special_replace_item ?>
    <div id="r_menu_special_replace_item"<?= $Page->menu_special_replace_item->rowAttributes() ?>>
        <label id="elh_menu_specials_menu_special_replace_item" for="x_menu_special_replace_item" class="<?= $Page->LeftColumnClass ?>"><?= $Page->menu_special_replace_item->caption() ?><?= $Page->menu_special_replace_item->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->menu_special_replace_item->cellAttributes() ?>>
<span id="el_menu_specials_menu_special_replace_item">
<input type="<?= $Page->menu_special_replace_item->getInputTextType() ?>" name="x_menu_special_replace_item" id="x_menu_special_replace_item" data-table="menu_specials" data-field="x_menu_special_replace_item" value="<?= $Page->menu_special_replace_item->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->menu_special_replace_item->getPlaceHolder()) ?>"<?= $Page->menu_special_replace_item->editAttributes() ?> aria-describedby="x_menu_special_replace_item_help">
<?= $Page->menu_special_replace_item->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->menu_special_replace_item->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
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
    ew.addEventHandlers("menu_specials");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
