<?php

namespace PHPMaker2021\project1;

// Page object
$RestaurantsAdd = &$Page;
?>
<script>
if (!ew.vars.tables.restaurants) ew.vars.tables.restaurants = <?= JsonEncode(GetClientVar("tables", "restaurants")) ?>;
var currentForm, currentPageID;
var frestaurantsadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    frestaurantsadd = currentForm = new ew.Form("frestaurantsadd", "add");

    // Add fields
    var fields = ew.vars.tables.restaurants.fields;
    frestaurantsadd.addFields([
        ["location_id", [fields.location_id.required ? ew.Validators.required(fields.location_id.caption) : null, ew.Validators.integer], fields.location_id.isInvalid],
        ["banner", [fields.banner.required ? ew.Validators.required(fields.banner.caption) : null], fields.banner.isInvalid],
        ["button_menu", [fields.button_menu.required ? ew.Validators.required(fields.button_menu.caption) : null], fields.button_menu.isInvalid],
        ["button_pdf", [fields.button_pdf.required ? ew.Validators.required(fields.button_pdf.caption) : null], fields.button_pdf.isInvalid],
        ["button_catering", [fields.button_catering.required ? ew.Validators.required(fields.button_catering.caption) : null], fields.button_catering.isInvalid],
        ["button_form", [fields.button_form.required ? ew.Validators.required(fields.button_form.caption) : null], fields.button_form.isInvalid],
        ["slides", [fields.slides.required ? ew.Validators.required(fields.slides.caption) : null, ew.Validators.integer], fields.slides.isInvalid],
        ["timestamp", [fields.timestamp.required ? ew.Validators.required(fields.timestamp.caption) : null, ew.Validators.datetime(0)], fields.timestamp.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = frestaurantsadd,
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
    frestaurantsadd.validate = function () {
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
    frestaurantsadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    frestaurantsadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("frestaurantsadd");
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
<form name="frestaurantsadd" id="frestaurantsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="restaurants">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->location_id->Visible) { // location_id ?>
    <div id="r_location_id" class="form-group row">
        <label id="elh_restaurants_location_id" for="x_location_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->location_id->caption() ?><?= $Page->location_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->location_id->cellAttributes() ?>>
<span id="el_restaurants_location_id">
<input type="<?= $Page->location_id->getInputTextType() ?>" data-table="restaurants" data-field="x_location_id" name="x_location_id" id="x_location_id" size="30" placeholder="<?= HtmlEncode($Page->location_id->getPlaceHolder()) ?>" value="<?= $Page->location_id->EditValue ?>"<?= $Page->location_id->editAttributes() ?> aria-describedby="x_location_id_help">
<?= $Page->location_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->location_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->banner->Visible) { // banner ?>
    <div id="r_banner" class="form-group row">
        <label id="elh_restaurants_banner" for="x_banner" class="<?= $Page->LeftColumnClass ?>"><?= $Page->banner->caption() ?><?= $Page->banner->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->banner->cellAttributes() ?>>
<span id="el_restaurants_banner">
<input type="<?= $Page->banner->getInputTextType() ?>" data-table="restaurants" data-field="x_banner" name="x_banner" id="x_banner" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->banner->getPlaceHolder()) ?>" value="<?= $Page->banner->EditValue ?>"<?= $Page->banner->editAttributes() ?> aria-describedby="x_banner_help">
<?= $Page->banner->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->banner->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->button_menu->Visible) { // button_menu ?>
    <div id="r_button_menu" class="form-group row">
        <label id="elh_restaurants_button_menu" for="x_button_menu" class="<?= $Page->LeftColumnClass ?>"><?= $Page->button_menu->caption() ?><?= $Page->button_menu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->button_menu->cellAttributes() ?>>
<span id="el_restaurants_button_menu">
<input type="<?= $Page->button_menu->getInputTextType() ?>" data-table="restaurants" data-field="x_button_menu" name="x_button_menu" id="x_button_menu" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->button_menu->getPlaceHolder()) ?>" value="<?= $Page->button_menu->EditValue ?>"<?= $Page->button_menu->editAttributes() ?> aria-describedby="x_button_menu_help">
<?= $Page->button_menu->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->button_menu->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->button_pdf->Visible) { // button_pdf ?>
    <div id="r_button_pdf" class="form-group row">
        <label id="elh_restaurants_button_pdf" for="x_button_pdf" class="<?= $Page->LeftColumnClass ?>"><?= $Page->button_pdf->caption() ?><?= $Page->button_pdf->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->button_pdf->cellAttributes() ?>>
<span id="el_restaurants_button_pdf">
<input type="<?= $Page->button_pdf->getInputTextType() ?>" data-table="restaurants" data-field="x_button_pdf" name="x_button_pdf" id="x_button_pdf" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->button_pdf->getPlaceHolder()) ?>" value="<?= $Page->button_pdf->EditValue ?>"<?= $Page->button_pdf->editAttributes() ?> aria-describedby="x_button_pdf_help">
<?= $Page->button_pdf->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->button_pdf->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->button_catering->Visible) { // button_catering ?>
    <div id="r_button_catering" class="form-group row">
        <label id="elh_restaurants_button_catering" for="x_button_catering" class="<?= $Page->LeftColumnClass ?>"><?= $Page->button_catering->caption() ?><?= $Page->button_catering->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->button_catering->cellAttributes() ?>>
<span id="el_restaurants_button_catering">
<input type="<?= $Page->button_catering->getInputTextType() ?>" data-table="restaurants" data-field="x_button_catering" name="x_button_catering" id="x_button_catering" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->button_catering->getPlaceHolder()) ?>" value="<?= $Page->button_catering->EditValue ?>"<?= $Page->button_catering->editAttributes() ?> aria-describedby="x_button_catering_help">
<?= $Page->button_catering->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->button_catering->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->button_form->Visible) { // button_form ?>
    <div id="r_button_form" class="form-group row">
        <label id="elh_restaurants_button_form" for="x_button_form" class="<?= $Page->LeftColumnClass ?>"><?= $Page->button_form->caption() ?><?= $Page->button_form->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->button_form->cellAttributes() ?>>
<span id="el_restaurants_button_form">
<input type="<?= $Page->button_form->getInputTextType() ?>" data-table="restaurants" data-field="x_button_form" name="x_button_form" id="x_button_form" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->button_form->getPlaceHolder()) ?>" value="<?= $Page->button_form->EditValue ?>"<?= $Page->button_form->editAttributes() ?> aria-describedby="x_button_form_help">
<?= $Page->button_form->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->button_form->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->slides->Visible) { // slides ?>
    <div id="r_slides" class="form-group row">
        <label id="elh_restaurants_slides" for="x_slides" class="<?= $Page->LeftColumnClass ?>"><?= $Page->slides->caption() ?><?= $Page->slides->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->slides->cellAttributes() ?>>
<span id="el_restaurants_slides">
<input type="<?= $Page->slides->getInputTextType() ?>" data-table="restaurants" data-field="x_slides" name="x_slides" id="x_slides" size="30" placeholder="<?= HtmlEncode($Page->slides->getPlaceHolder()) ?>" value="<?= $Page->slides->EditValue ?>"<?= $Page->slides->editAttributes() ?> aria-describedby="x_slides_help">
<?= $Page->slides->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->slides->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
    <div id="r_timestamp" class="form-group row">
        <label id="elh_restaurants_timestamp" for="x_timestamp" class="<?= $Page->LeftColumnClass ?>"><?= $Page->timestamp->caption() ?><?= $Page->timestamp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->timestamp->cellAttributes() ?>>
<span id="el_restaurants_timestamp">
<input type="<?= $Page->timestamp->getInputTextType() ?>" data-table="restaurants" data-field="x_timestamp" name="x_timestamp" id="x_timestamp" placeholder="<?= HtmlEncode($Page->timestamp->getPlaceHolder()) ?>" value="<?= $Page->timestamp->EditValue ?>"<?= $Page->timestamp->editAttributes() ?> aria-describedby="x_timestamp_help">
<?= $Page->timestamp->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->timestamp->getErrorMessage() ?></div>
<?php if (!$Page->timestamp->ReadOnly && !$Page->timestamp->Disabled && !isset($Page->timestamp->EditAttrs["readonly"]) && !isset($Page->timestamp->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["frestaurantsadd", "datetimepicker"], function() {
    ew.createDateTimePicker("frestaurantsadd", "x_timestamp", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
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
    ew.addEventHandlers("restaurants");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
