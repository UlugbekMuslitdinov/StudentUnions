<?php

namespace PHPMaker2021\project1;

// Page object
$RestaurantsSlidesEdit = &$Page;
?>
<script>
if (!ew.vars.tables.restaurants_slides) ew.vars.tables.restaurants_slides = <?= JsonEncode(GetClientVar("tables", "restaurants_slides")) ?>;
var currentForm, currentPageID;
var frestaurants_slidesedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    frestaurants_slidesedit = currentForm = new ew.Form("frestaurants_slidesedit", "edit");

    // Add fields
    var fields = ew.vars.tables.restaurants_slides.fields;
    frestaurants_slidesedit.addFields([
        ["id", [fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["restaurant_id", [fields.restaurant_id.required ? ew.Validators.required(fields.restaurant_id.caption) : null, ew.Validators.integer], fields.restaurant_id.isInvalid],
        ["filename", [fields.filename.required ? ew.Validators.required(fields.filename.caption) : null], fields.filename.isInvalid],
        ["timestamp", [fields.timestamp.required ? ew.Validators.required(fields.timestamp.caption) : null, ew.Validators.datetime(0)], fields.timestamp.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = frestaurants_slidesedit,
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
    frestaurants_slidesedit.validate = function () {
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
    frestaurants_slidesedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    frestaurants_slidesedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("frestaurants_slidesedit");
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
<form name="frestaurants_slidesedit" id="frestaurants_slidesedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="restaurants_slides">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_restaurants_slides_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_restaurants_slides_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="restaurants_slides" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->restaurant_id->Visible) { // restaurant_id ?>
    <div id="r_restaurant_id" class="form-group row">
        <label id="elh_restaurants_slides_restaurant_id" for="x_restaurant_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->restaurant_id->caption() ?><?= $Page->restaurant_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->restaurant_id->cellAttributes() ?>>
<span id="el_restaurants_slides_restaurant_id">
<input type="<?= $Page->restaurant_id->getInputTextType() ?>" data-table="restaurants_slides" data-field="x_restaurant_id" name="x_restaurant_id" id="x_restaurant_id" size="30" placeholder="<?= HtmlEncode($Page->restaurant_id->getPlaceHolder()) ?>" value="<?= $Page->restaurant_id->EditValue ?>"<?= $Page->restaurant_id->editAttributes() ?> aria-describedby="x_restaurant_id_help">
<?= $Page->restaurant_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->restaurant_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->filename->Visible) { // filename ?>
    <div id="r_filename" class="form-group row">
        <label id="elh_restaurants_slides_filename" for="x_filename" class="<?= $Page->LeftColumnClass ?>"><?= $Page->filename->caption() ?><?= $Page->filename->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->filename->cellAttributes() ?>>
<span id="el_restaurants_slides_filename">
<input type="<?= $Page->filename->getInputTextType() ?>" data-table="restaurants_slides" data-field="x_filename" name="x_filename" id="x_filename" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->filename->getPlaceHolder()) ?>" value="<?= $Page->filename->EditValue ?>"<?= $Page->filename->editAttributes() ?> aria-describedby="x_filename_help">
<?= $Page->filename->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->filename->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
    <div id="r_timestamp" class="form-group row">
        <label id="elh_restaurants_slides_timestamp" for="x_timestamp" class="<?= $Page->LeftColumnClass ?>"><?= $Page->timestamp->caption() ?><?= $Page->timestamp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->timestamp->cellAttributes() ?>>
<span id="el_restaurants_slides_timestamp">
<input type="<?= $Page->timestamp->getInputTextType() ?>" data-table="restaurants_slides" data-field="x_timestamp" name="x_timestamp" id="x_timestamp" placeholder="<?= HtmlEncode($Page->timestamp->getPlaceHolder()) ?>" value="<?= $Page->timestamp->EditValue ?>"<?= $Page->timestamp->editAttributes() ?> aria-describedby="x_timestamp_help">
<?= $Page->timestamp->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->timestamp->getErrorMessage() ?></div>
<?php if (!$Page->timestamp->ReadOnly && !$Page->timestamp->Disabled && !isset($Page->timestamp->EditAttrs["readonly"]) && !isset($Page->timestamp->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["frestaurants_slidesedit", "datetimepicker"], function() {
    ew.createDateTimePicker("frestaurants_slidesedit", "x_timestamp", {"ignoreReadonly":true,"useCurrent":false,"format":0});
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
    ew.addEventHandlers("restaurants_slides");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
