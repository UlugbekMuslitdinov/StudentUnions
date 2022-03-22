<?php

namespace PHPMaker2021\project2;

// Page object
$MenuSpecialsAdd = &$Page;
?>
<script>
if (!ew.vars.tables.menu_specials) ew.vars.tables.menu_specials = <?= JsonEncode(GetClientVar("tables", "menu_specials")) ?>;
var currentForm, currentPageID;
var fmenu_specialsadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fmenu_specialsadd = currentForm = new ew.Form("fmenu_specialsadd", "add");

    // Add fields
    var fields = ew.vars.tables.menu_specials.fields;
    fmenu_specialsadd.addFields([
        ["menu_special", [fields.menu_special.required ? ew.Validators.required(fields.menu_special.caption) : null], fields.menu_special.isInvalid],
        ["menu_special_price", [fields.menu_special_price.required ? ew.Validators.required(fields.menu_special_price.caption) : null, ew.Validators.float], fields.menu_special_price.isInvalid],
        ["menu_restaurant", [fields.menu_restaurant.required ? ew.Validators.required(fields.menu_restaurant.caption) : null, ew.Validators.integer], fields.menu_restaurant.isInvalid],
        ["menu_category", [fields.menu_category.required ? ew.Validators.required(fields.menu_category.caption) : null, ew.Validators.integer], fields.menu_category.isInvalid],
        ["menu_special_comments", [fields.menu_special_comments.required ? ew.Validators.required(fields.menu_special_comments.caption) : null], fields.menu_special_comments.isInvalid],
        ["menu_special_startdate", [fields.menu_special_startdate.required ? ew.Validators.required(fields.menu_special_startdate.caption) : null, ew.Validators.datetime(0)], fields.menu_special_startdate.isInvalid],
        ["menu_special_enddate", [fields.menu_special_enddate.required ? ew.Validators.required(fields.menu_special_enddate.caption) : null, ew.Validators.datetime(0)], fields.menu_special_enddate.isInvalid],
        ["menu_special_replace_item", [fields.menu_special_replace_item.required ? ew.Validators.required(fields.menu_special_replace_item.caption) : null, ew.Validators.integer], fields.menu_special_replace_item.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fmenu_specialsadd,
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
    fmenu_specialsadd.validate = function () {
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
    fmenu_specialsadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmenu_specialsadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

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
<form name="fmenu_specialsadd" id="fmenu_specialsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
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
    <div id="r_menu_special" class="form-group row">
        <label id="elh_menu_specials_menu_special" for="x_menu_special" class="<?= $Page->LeftColumnClass ?>"><?= $Page->menu_special->caption() ?><?= $Page->menu_special->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->menu_special->cellAttributes() ?>>
<span id="el_menu_specials_menu_special">
<textarea data-table="menu_specials" data-field="x_menu_special" name="x_menu_special" id="x_menu_special" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->menu_special->getPlaceHolder()) ?>"<?= $Page->menu_special->editAttributes() ?> aria-describedby="x_menu_special_help"><?= $Page->menu_special->EditValue ?></textarea>
<?= $Page->menu_special->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->menu_special->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->menu_special_price->Visible) { // menu_special_price ?>
    <div id="r_menu_special_price" class="form-group row">
        <label id="elh_menu_specials_menu_special_price" for="x_menu_special_price" class="<?= $Page->LeftColumnClass ?>"><?= $Page->menu_special_price->caption() ?><?= $Page->menu_special_price->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->menu_special_price->cellAttributes() ?>>
<span id="el_menu_specials_menu_special_price">
<input type="<?= $Page->menu_special_price->getInputTextType() ?>" data-table="menu_specials" data-field="x_menu_special_price" name="x_menu_special_price" id="x_menu_special_price" size="30" placeholder="<?= HtmlEncode($Page->menu_special_price->getPlaceHolder()) ?>" value="<?= $Page->menu_special_price->EditValue ?>"<?= $Page->menu_special_price->editAttributes() ?> aria-describedby="x_menu_special_price_help">
<?= $Page->menu_special_price->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->menu_special_price->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->menu_restaurant->Visible) { // menu_restaurant ?>
    <div id="r_menu_restaurant" class="form-group row">
        <label id="elh_menu_specials_menu_restaurant" for="x_menu_restaurant" class="<?= $Page->LeftColumnClass ?>"><?= $Page->menu_restaurant->caption() ?><?= $Page->menu_restaurant->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->menu_restaurant->cellAttributes() ?>>
<span id="el_menu_specials_menu_restaurant">
<input type="<?= $Page->menu_restaurant->getInputTextType() ?>" data-table="menu_specials" data-field="x_menu_restaurant" name="x_menu_restaurant" id="x_menu_restaurant" size="30" placeholder="<?= HtmlEncode($Page->menu_restaurant->getPlaceHolder()) ?>" value="<?= $Page->menu_restaurant->EditValue ?>"<?= $Page->menu_restaurant->editAttributes() ?> aria-describedby="x_menu_restaurant_help">
<?= $Page->menu_restaurant->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->menu_restaurant->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->menu_category->Visible) { // menu_category ?>
    <div id="r_menu_category" class="form-group row">
        <label id="elh_menu_specials_menu_category" for="x_menu_category" class="<?= $Page->LeftColumnClass ?>"><?= $Page->menu_category->caption() ?><?= $Page->menu_category->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->menu_category->cellAttributes() ?>>
<span id="el_menu_specials_menu_category">
<input type="<?= $Page->menu_category->getInputTextType() ?>" data-table="menu_specials" data-field="x_menu_category" name="x_menu_category" id="x_menu_category" size="30" placeholder="<?= HtmlEncode($Page->menu_category->getPlaceHolder()) ?>" value="<?= $Page->menu_category->EditValue ?>"<?= $Page->menu_category->editAttributes() ?> aria-describedby="x_menu_category_help">
<?= $Page->menu_category->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->menu_category->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->menu_special_comments->Visible) { // menu_special_comments ?>
    <div id="r_menu_special_comments" class="form-group row">
        <label id="elh_menu_specials_menu_special_comments" for="x_menu_special_comments" class="<?= $Page->LeftColumnClass ?>"><?= $Page->menu_special_comments->caption() ?><?= $Page->menu_special_comments->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->menu_special_comments->cellAttributes() ?>>
<span id="el_menu_specials_menu_special_comments">
<textarea data-table="menu_specials" data-field="x_menu_special_comments" name="x_menu_special_comments" id="x_menu_special_comments" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->menu_special_comments->getPlaceHolder()) ?>"<?= $Page->menu_special_comments->editAttributes() ?> aria-describedby="x_menu_special_comments_help"><?= $Page->menu_special_comments->EditValue ?></textarea>
<?= $Page->menu_special_comments->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->menu_special_comments->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->menu_special_startdate->Visible) { // menu_special_startdate ?>
    <div id="r_menu_special_startdate" class="form-group row">
        <label id="elh_menu_specials_menu_special_startdate" for="x_menu_special_startdate" class="<?= $Page->LeftColumnClass ?>"><?= $Page->menu_special_startdate->caption() ?><?= $Page->menu_special_startdate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->menu_special_startdate->cellAttributes() ?>>
<span id="el_menu_specials_menu_special_startdate">
<input type="<?= $Page->menu_special_startdate->getInputTextType() ?>" data-table="menu_specials" data-field="x_menu_special_startdate" name="x_menu_special_startdate" id="x_menu_special_startdate" placeholder="<?= HtmlEncode($Page->menu_special_startdate->getPlaceHolder()) ?>" value="<?= $Page->menu_special_startdate->EditValue ?>"<?= $Page->menu_special_startdate->editAttributes() ?> aria-describedby="x_menu_special_startdate_help">
<?= $Page->menu_special_startdate->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->menu_special_startdate->getErrorMessage() ?></div>
<?php if (!$Page->menu_special_startdate->ReadOnly && !$Page->menu_special_startdate->Disabled && !isset($Page->menu_special_startdate->EditAttrs["readonly"]) && !isset($Page->menu_special_startdate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmenu_specialsadd", "datetimepicker"], function() {
    ew.createDateTimePicker("fmenu_specialsadd", "x_menu_special_startdate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->menu_special_enddate->Visible) { // menu_special_enddate ?>
    <div id="r_menu_special_enddate" class="form-group row">
        <label id="elh_menu_specials_menu_special_enddate" for="x_menu_special_enddate" class="<?= $Page->LeftColumnClass ?>"><?= $Page->menu_special_enddate->caption() ?><?= $Page->menu_special_enddate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->menu_special_enddate->cellAttributes() ?>>
<span id="el_menu_specials_menu_special_enddate">
<input type="<?= $Page->menu_special_enddate->getInputTextType() ?>" data-table="menu_specials" data-field="x_menu_special_enddate" name="x_menu_special_enddate" id="x_menu_special_enddate" placeholder="<?= HtmlEncode($Page->menu_special_enddate->getPlaceHolder()) ?>" value="<?= $Page->menu_special_enddate->EditValue ?>"<?= $Page->menu_special_enddate->editAttributes() ?> aria-describedby="x_menu_special_enddate_help">
<?= $Page->menu_special_enddate->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->menu_special_enddate->getErrorMessage() ?></div>
<?php if (!$Page->menu_special_enddate->ReadOnly && !$Page->menu_special_enddate->Disabled && !isset($Page->menu_special_enddate->EditAttrs["readonly"]) && !isset($Page->menu_special_enddate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmenu_specialsadd", "datetimepicker"], function() {
    ew.createDateTimePicker("fmenu_specialsadd", "x_menu_special_enddate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->menu_special_replace_item->Visible) { // menu_special_replace_item ?>
    <div id="r_menu_special_replace_item" class="form-group row">
        <label id="elh_menu_specials_menu_special_replace_item" for="x_menu_special_replace_item" class="<?= $Page->LeftColumnClass ?>"><?= $Page->menu_special_replace_item->caption() ?><?= $Page->menu_special_replace_item->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->menu_special_replace_item->cellAttributes() ?>>
<span id="el_menu_specials_menu_special_replace_item">
<input type="<?= $Page->menu_special_replace_item->getInputTextType() ?>" data-table="menu_specials" data-field="x_menu_special_replace_item" name="x_menu_special_replace_item" id="x_menu_special_replace_item" size="30" placeholder="<?= HtmlEncode($Page->menu_special_replace_item->getPlaceHolder()) ?>" value="<?= $Page->menu_special_replace_item->EditValue ?>"<?= $Page->menu_special_replace_item->editAttributes() ?> aria-describedby="x_menu_special_replace_item_help">
<?= $Page->menu_special_replace_item->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->menu_special_replace_item->getErrorMessage() ?></div>
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
    ew.addEventHandlers("menu_specials");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
