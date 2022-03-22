<?php

namespace PHPMaker2021\project1;

// Page object
$CateringHighlandAdd = &$Page;
?>
<script>
if (!ew.vars.tables.catering_highland) ew.vars.tables.catering_highland = <?= JsonEncode(GetClientVar("tables", "catering_highland")) ?>;
var currentForm, currentPageID;
var fcatering_highlandadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fcatering_highlandadd = currentForm = new ew.Form("fcatering_highlandadd", "add");

    // Add fields
    var fields = ew.vars.tables.catering_highland.fields;
    fcatering_highlandadd.addFields([
        ["catering_id", [fields.catering_id.required ? ew.Validators.required(fields.catering_id.caption) : null, ew.Validators.integer], fields.catering_id.isInvalid],
        ["burrito_12", [fields.burrito_12.required ? ew.Validators.required(fields.burrito_12.caption) : null, ew.Validators.integer], fields.burrito_12.isInvalid],
        ["burrito_8", [fields.burrito_8.required ? ew.Validators.required(fields.burrito_8.caption) : null, ew.Validators.integer], fields.burrito_8.isInvalid],
        ["extra_chips", [fields.extra_chips.required ? ew.Validators.required(fields.extra_chips.caption) : null, ew.Validators.integer], fields.extra_chips.isInvalid],
        ["extra_salsa", [fields.extra_salsa.required ? ew.Validators.required(fields.extra_salsa.caption) : null, ew.Validators.integer], fields.extra_salsa.isInvalid],
        ["extra_sourcream", [fields.extra_sourcream.required ? ew.Validators.required(fields.extra_sourcream.caption) : null, ew.Validators.integer], fields.extra_sourcream.isInvalid],
        ["extra_guacamole", [fields.extra_guacamole.required ? ew.Validators.required(fields.extra_guacamole.caption) : null, ew.Validators.integer], fields.extra_guacamole.isInvalid],
        ["upgrade", [fields.upgrade.required ? ew.Validators.required(fields.upgrade.caption) : null, ew.Validators.integer], fields.upgrade.isInvalid],
        ["coke", [fields.coke.required ? ew.Validators.required(fields.coke.caption) : null, ew.Validators.integer], fields.coke.isInvalid],
        ["diet_coke", [fields.diet_coke.required ? ew.Validators.required(fields.diet_coke.caption) : null, ew.Validators.integer], fields.diet_coke.isInvalid],
        ["sprite", [fields.sprite.required ? ew.Validators.required(fields.sprite.caption) : null, ew.Validators.integer], fields.sprite.isInvalid],
        ["fanta", [fields.fanta.required ? ew.Validators.required(fields.fanta.caption) : null, ew.Validators.integer], fields.fanta.isInvalid],
        ["water", [fields.water.required ? ew.Validators.required(fields.water.caption) : null, ew.Validators.integer], fields.water.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fcatering_highlandadd,
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
    fcatering_highlandadd.validate = function () {
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
    fcatering_highlandadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fcatering_highlandadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fcatering_highlandadd");
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
<form name="fcatering_highlandadd" id="fcatering_highlandadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="catering_highland">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->catering_id->Visible) { // catering_id ?>
    <div id="r_catering_id" class="form-group row">
        <label id="elh_catering_highland_catering_id" for="x_catering_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->catering_id->caption() ?><?= $Page->catering_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->catering_id->cellAttributes() ?>>
<span id="el_catering_highland_catering_id">
<input type="<?= $Page->catering_id->getInputTextType() ?>" data-table="catering_highland" data-field="x_catering_id" name="x_catering_id" id="x_catering_id" size="30" placeholder="<?= HtmlEncode($Page->catering_id->getPlaceHolder()) ?>" value="<?= $Page->catering_id->EditValue ?>"<?= $Page->catering_id->editAttributes() ?> aria-describedby="x_catering_id_help">
<?= $Page->catering_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->catering_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->burrito_12->Visible) { // burrito_12 ?>
    <div id="r_burrito_12" class="form-group row">
        <label id="elh_catering_highland_burrito_12" for="x_burrito_12" class="<?= $Page->LeftColumnClass ?>"><?= $Page->burrito_12->caption() ?><?= $Page->burrito_12->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->burrito_12->cellAttributes() ?>>
<span id="el_catering_highland_burrito_12">
<input type="<?= $Page->burrito_12->getInputTextType() ?>" data-table="catering_highland" data-field="x_burrito_12" name="x_burrito_12" id="x_burrito_12" size="30" placeholder="<?= HtmlEncode($Page->burrito_12->getPlaceHolder()) ?>" value="<?= $Page->burrito_12->EditValue ?>"<?= $Page->burrito_12->editAttributes() ?> aria-describedby="x_burrito_12_help">
<?= $Page->burrito_12->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->burrito_12->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->burrito_8->Visible) { // burrito_8 ?>
    <div id="r_burrito_8" class="form-group row">
        <label id="elh_catering_highland_burrito_8" for="x_burrito_8" class="<?= $Page->LeftColumnClass ?>"><?= $Page->burrito_8->caption() ?><?= $Page->burrito_8->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->burrito_8->cellAttributes() ?>>
<span id="el_catering_highland_burrito_8">
<input type="<?= $Page->burrito_8->getInputTextType() ?>" data-table="catering_highland" data-field="x_burrito_8" name="x_burrito_8" id="x_burrito_8" size="30" placeholder="<?= HtmlEncode($Page->burrito_8->getPlaceHolder()) ?>" value="<?= $Page->burrito_8->EditValue ?>"<?= $Page->burrito_8->editAttributes() ?> aria-describedby="x_burrito_8_help">
<?= $Page->burrito_8->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->burrito_8->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->extra_chips->Visible) { // extra_chips ?>
    <div id="r_extra_chips" class="form-group row">
        <label id="elh_catering_highland_extra_chips" for="x_extra_chips" class="<?= $Page->LeftColumnClass ?>"><?= $Page->extra_chips->caption() ?><?= $Page->extra_chips->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->extra_chips->cellAttributes() ?>>
<span id="el_catering_highland_extra_chips">
<input type="<?= $Page->extra_chips->getInputTextType() ?>" data-table="catering_highland" data-field="x_extra_chips" name="x_extra_chips" id="x_extra_chips" size="30" placeholder="<?= HtmlEncode($Page->extra_chips->getPlaceHolder()) ?>" value="<?= $Page->extra_chips->EditValue ?>"<?= $Page->extra_chips->editAttributes() ?> aria-describedby="x_extra_chips_help">
<?= $Page->extra_chips->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->extra_chips->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->extra_salsa->Visible) { // extra_salsa ?>
    <div id="r_extra_salsa" class="form-group row">
        <label id="elh_catering_highland_extra_salsa" for="x_extra_salsa" class="<?= $Page->LeftColumnClass ?>"><?= $Page->extra_salsa->caption() ?><?= $Page->extra_salsa->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->extra_salsa->cellAttributes() ?>>
<span id="el_catering_highland_extra_salsa">
<input type="<?= $Page->extra_salsa->getInputTextType() ?>" data-table="catering_highland" data-field="x_extra_salsa" name="x_extra_salsa" id="x_extra_salsa" size="30" placeholder="<?= HtmlEncode($Page->extra_salsa->getPlaceHolder()) ?>" value="<?= $Page->extra_salsa->EditValue ?>"<?= $Page->extra_salsa->editAttributes() ?> aria-describedby="x_extra_salsa_help">
<?= $Page->extra_salsa->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->extra_salsa->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->extra_sourcream->Visible) { // extra_sourcream ?>
    <div id="r_extra_sourcream" class="form-group row">
        <label id="elh_catering_highland_extra_sourcream" for="x_extra_sourcream" class="<?= $Page->LeftColumnClass ?>"><?= $Page->extra_sourcream->caption() ?><?= $Page->extra_sourcream->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->extra_sourcream->cellAttributes() ?>>
<span id="el_catering_highland_extra_sourcream">
<input type="<?= $Page->extra_sourcream->getInputTextType() ?>" data-table="catering_highland" data-field="x_extra_sourcream" name="x_extra_sourcream" id="x_extra_sourcream" size="30" placeholder="<?= HtmlEncode($Page->extra_sourcream->getPlaceHolder()) ?>" value="<?= $Page->extra_sourcream->EditValue ?>"<?= $Page->extra_sourcream->editAttributes() ?> aria-describedby="x_extra_sourcream_help">
<?= $Page->extra_sourcream->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->extra_sourcream->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->extra_guacamole->Visible) { // extra_guacamole ?>
    <div id="r_extra_guacamole" class="form-group row">
        <label id="elh_catering_highland_extra_guacamole" for="x_extra_guacamole" class="<?= $Page->LeftColumnClass ?>"><?= $Page->extra_guacamole->caption() ?><?= $Page->extra_guacamole->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->extra_guacamole->cellAttributes() ?>>
<span id="el_catering_highland_extra_guacamole">
<input type="<?= $Page->extra_guacamole->getInputTextType() ?>" data-table="catering_highland" data-field="x_extra_guacamole" name="x_extra_guacamole" id="x_extra_guacamole" size="30" placeholder="<?= HtmlEncode($Page->extra_guacamole->getPlaceHolder()) ?>" value="<?= $Page->extra_guacamole->EditValue ?>"<?= $Page->extra_guacamole->editAttributes() ?> aria-describedby="x_extra_guacamole_help">
<?= $Page->extra_guacamole->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->extra_guacamole->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->upgrade->Visible) { // upgrade ?>
    <div id="r_upgrade" class="form-group row">
        <label id="elh_catering_highland_upgrade" for="x_upgrade" class="<?= $Page->LeftColumnClass ?>"><?= $Page->upgrade->caption() ?><?= $Page->upgrade->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->upgrade->cellAttributes() ?>>
<span id="el_catering_highland_upgrade">
<input type="<?= $Page->upgrade->getInputTextType() ?>" data-table="catering_highland" data-field="x_upgrade" name="x_upgrade" id="x_upgrade" size="30" placeholder="<?= HtmlEncode($Page->upgrade->getPlaceHolder()) ?>" value="<?= $Page->upgrade->EditValue ?>"<?= $Page->upgrade->editAttributes() ?> aria-describedby="x_upgrade_help">
<?= $Page->upgrade->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->upgrade->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->coke->Visible) { // coke ?>
    <div id="r_coke" class="form-group row">
        <label id="elh_catering_highland_coke" for="x_coke" class="<?= $Page->LeftColumnClass ?>"><?= $Page->coke->caption() ?><?= $Page->coke->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->coke->cellAttributes() ?>>
<span id="el_catering_highland_coke">
<input type="<?= $Page->coke->getInputTextType() ?>" data-table="catering_highland" data-field="x_coke" name="x_coke" id="x_coke" size="30" placeholder="<?= HtmlEncode($Page->coke->getPlaceHolder()) ?>" value="<?= $Page->coke->EditValue ?>"<?= $Page->coke->editAttributes() ?> aria-describedby="x_coke_help">
<?= $Page->coke->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->coke->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->diet_coke->Visible) { // diet_coke ?>
    <div id="r_diet_coke" class="form-group row">
        <label id="elh_catering_highland_diet_coke" for="x_diet_coke" class="<?= $Page->LeftColumnClass ?>"><?= $Page->diet_coke->caption() ?><?= $Page->diet_coke->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->diet_coke->cellAttributes() ?>>
<span id="el_catering_highland_diet_coke">
<input type="<?= $Page->diet_coke->getInputTextType() ?>" data-table="catering_highland" data-field="x_diet_coke" name="x_diet_coke" id="x_diet_coke" size="30" placeholder="<?= HtmlEncode($Page->diet_coke->getPlaceHolder()) ?>" value="<?= $Page->diet_coke->EditValue ?>"<?= $Page->diet_coke->editAttributes() ?> aria-describedby="x_diet_coke_help">
<?= $Page->diet_coke->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->diet_coke->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sprite->Visible) { // sprite ?>
    <div id="r_sprite" class="form-group row">
        <label id="elh_catering_highland_sprite" for="x_sprite" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sprite->caption() ?><?= $Page->sprite->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->sprite->cellAttributes() ?>>
<span id="el_catering_highland_sprite">
<input type="<?= $Page->sprite->getInputTextType() ?>" data-table="catering_highland" data-field="x_sprite" name="x_sprite" id="x_sprite" size="30" placeholder="<?= HtmlEncode($Page->sprite->getPlaceHolder()) ?>" value="<?= $Page->sprite->EditValue ?>"<?= $Page->sprite->editAttributes() ?> aria-describedby="x_sprite_help">
<?= $Page->sprite->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sprite->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->fanta->Visible) { // fanta ?>
    <div id="r_fanta" class="form-group row">
        <label id="elh_catering_highland_fanta" for="x_fanta" class="<?= $Page->LeftColumnClass ?>"><?= $Page->fanta->caption() ?><?= $Page->fanta->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->fanta->cellAttributes() ?>>
<span id="el_catering_highland_fanta">
<input type="<?= $Page->fanta->getInputTextType() ?>" data-table="catering_highland" data-field="x_fanta" name="x_fanta" id="x_fanta" size="30" placeholder="<?= HtmlEncode($Page->fanta->getPlaceHolder()) ?>" value="<?= $Page->fanta->EditValue ?>"<?= $Page->fanta->editAttributes() ?> aria-describedby="x_fanta_help">
<?= $Page->fanta->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->fanta->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->water->Visible) { // water ?>
    <div id="r_water" class="form-group row">
        <label id="elh_catering_highland_water" for="x_water" class="<?= $Page->LeftColumnClass ?>"><?= $Page->water->caption() ?><?= $Page->water->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->water->cellAttributes() ?>>
<span id="el_catering_highland_water">
<input type="<?= $Page->water->getInputTextType() ?>" data-table="catering_highland" data-field="x_water" name="x_water" id="x_water" size="30" placeholder="<?= HtmlEncode($Page->water->getPlaceHolder()) ?>" value="<?= $Page->water->EditValue ?>"<?= $Page->water->editAttributes() ?> aria-describedby="x_water_help">
<?= $Page->water->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->water->getErrorMessage() ?></div>
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
    ew.addEventHandlers("catering_highland");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
