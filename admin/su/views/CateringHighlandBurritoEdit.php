<?php

namespace PHPMaker2021\project1;

// Page object
$CateringHighlandBurritoEdit = &$Page;
?>
<script>
if (!ew.vars.tables.catering_highland_burrito) ew.vars.tables.catering_highland_burrito = <?= JsonEncode(GetClientVar("tables", "catering_highland_burrito")) ?>;
var currentForm, currentPageID;
var fcatering_highland_burritoedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fcatering_highland_burritoedit = currentForm = new ew.Form("fcatering_highland_burritoedit", "edit");

    // Add fields
    var fields = ew.vars.tables.catering_highland_burrito.fields;
    fcatering_highland_burritoedit.addFields([
        ["id", [fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["catering_id", [fields.catering_id.required ? ew.Validators.required(fields.catering_id.caption) : null, ew.Validators.integer], fields.catering_id.isInvalid],
        ["pack", [fields.pack.required ? ew.Validators.required(fields.pack.caption) : null], fields.pack.isInvalid],
        ["pack_num", [fields.pack_num.required ? ew.Validators.required(fields.pack_num.caption) : null, ew.Validators.integer], fields.pack_num.isInvalid],
        ["burrito_num", [fields.burrito_num.required ? ew.Validators.required(fields.burrito_num.caption) : null, ew.Validators.integer], fields.burrito_num.isInvalid],
        ["meat_1", [fields.meat_1.required ? ew.Validators.required(fields.meat_1.caption) : null], fields.meat_1.isInvalid],
        ["meat_2", [fields.meat_2.required ? ew.Validators.required(fields.meat_2.caption) : null], fields.meat_2.isInvalid],
        ["meat_3", [fields.meat_3.required ? ew.Validators.required(fields.meat_3.caption) : null], fields.meat_3.isInvalid],
        ["meat_4", [fields.meat_4.required ? ew.Validators.required(fields.meat_4.caption) : null], fields.meat_4.isInvalid],
        ["vege_1", [fields.vege_1.required ? ew.Validators.required(fields.vege_1.caption) : null], fields.vege_1.isInvalid],
        ["vege_2", [fields.vege_2.required ? ew.Validators.required(fields.vege_2.caption) : null], fields.vege_2.isInvalid],
        ["vege_3", [fields.vege_3.required ? ew.Validators.required(fields.vege_3.caption) : null], fields.vege_3.isInvalid],
        ["vege_4", [fields.vege_4.required ? ew.Validators.required(fields.vege_4.caption) : null], fields.vege_4.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fcatering_highland_burritoedit,
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
    fcatering_highland_burritoedit.validate = function () {
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
    fcatering_highland_burritoedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fcatering_highland_burritoedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fcatering_highland_burritoedit");
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
<form name="fcatering_highland_burritoedit" id="fcatering_highland_burritoedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="catering_highland_burrito">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_catering_highland_burrito_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_catering_highland_burrito_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="catering_highland_burrito" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->catering_id->Visible) { // catering_id ?>
    <div id="r_catering_id" class="form-group row">
        <label id="elh_catering_highland_burrito_catering_id" for="x_catering_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->catering_id->caption() ?><?= $Page->catering_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->catering_id->cellAttributes() ?>>
<span id="el_catering_highland_burrito_catering_id">
<input type="<?= $Page->catering_id->getInputTextType() ?>" data-table="catering_highland_burrito" data-field="x_catering_id" name="x_catering_id" id="x_catering_id" size="30" placeholder="<?= HtmlEncode($Page->catering_id->getPlaceHolder()) ?>" value="<?= $Page->catering_id->EditValue ?>"<?= $Page->catering_id->editAttributes() ?> aria-describedby="x_catering_id_help">
<?= $Page->catering_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->catering_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pack->Visible) { // pack ?>
    <div id="r_pack" class="form-group row">
        <label id="elh_catering_highland_burrito_pack" for="x_pack" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pack->caption() ?><?= $Page->pack->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->pack->cellAttributes() ?>>
<span id="el_catering_highland_burrito_pack">
<input type="<?= $Page->pack->getInputTextType() ?>" data-table="catering_highland_burrito" data-field="x_pack" name="x_pack" id="x_pack" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->pack->getPlaceHolder()) ?>" value="<?= $Page->pack->EditValue ?>"<?= $Page->pack->editAttributes() ?> aria-describedby="x_pack_help">
<?= $Page->pack->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pack->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pack_num->Visible) { // pack_num ?>
    <div id="r_pack_num" class="form-group row">
        <label id="elh_catering_highland_burrito_pack_num" for="x_pack_num" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pack_num->caption() ?><?= $Page->pack_num->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->pack_num->cellAttributes() ?>>
<span id="el_catering_highland_burrito_pack_num">
<input type="<?= $Page->pack_num->getInputTextType() ?>" data-table="catering_highland_burrito" data-field="x_pack_num" name="x_pack_num" id="x_pack_num" size="30" placeholder="<?= HtmlEncode($Page->pack_num->getPlaceHolder()) ?>" value="<?= $Page->pack_num->EditValue ?>"<?= $Page->pack_num->editAttributes() ?> aria-describedby="x_pack_num_help">
<?= $Page->pack_num->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pack_num->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->burrito_num->Visible) { // burrito_num ?>
    <div id="r_burrito_num" class="form-group row">
        <label id="elh_catering_highland_burrito_burrito_num" for="x_burrito_num" class="<?= $Page->LeftColumnClass ?>"><?= $Page->burrito_num->caption() ?><?= $Page->burrito_num->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->burrito_num->cellAttributes() ?>>
<span id="el_catering_highland_burrito_burrito_num">
<input type="<?= $Page->burrito_num->getInputTextType() ?>" data-table="catering_highland_burrito" data-field="x_burrito_num" name="x_burrito_num" id="x_burrito_num" size="30" placeholder="<?= HtmlEncode($Page->burrito_num->getPlaceHolder()) ?>" value="<?= $Page->burrito_num->EditValue ?>"<?= $Page->burrito_num->editAttributes() ?> aria-describedby="x_burrito_num_help">
<?= $Page->burrito_num->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->burrito_num->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->meat_1->Visible) { // meat_1 ?>
    <div id="r_meat_1" class="form-group row">
        <label id="elh_catering_highland_burrito_meat_1" for="x_meat_1" class="<?= $Page->LeftColumnClass ?>"><?= $Page->meat_1->caption() ?><?= $Page->meat_1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->meat_1->cellAttributes() ?>>
<span id="el_catering_highland_burrito_meat_1">
<input type="<?= $Page->meat_1->getInputTextType() ?>" data-table="catering_highland_burrito" data-field="x_meat_1" name="x_meat_1" id="x_meat_1" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->meat_1->getPlaceHolder()) ?>" value="<?= $Page->meat_1->EditValue ?>"<?= $Page->meat_1->editAttributes() ?> aria-describedby="x_meat_1_help">
<?= $Page->meat_1->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->meat_1->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->meat_2->Visible) { // meat_2 ?>
    <div id="r_meat_2" class="form-group row">
        <label id="elh_catering_highland_burrito_meat_2" for="x_meat_2" class="<?= $Page->LeftColumnClass ?>"><?= $Page->meat_2->caption() ?><?= $Page->meat_2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->meat_2->cellAttributes() ?>>
<span id="el_catering_highland_burrito_meat_2">
<input type="<?= $Page->meat_2->getInputTextType() ?>" data-table="catering_highland_burrito" data-field="x_meat_2" name="x_meat_2" id="x_meat_2" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->meat_2->getPlaceHolder()) ?>" value="<?= $Page->meat_2->EditValue ?>"<?= $Page->meat_2->editAttributes() ?> aria-describedby="x_meat_2_help">
<?= $Page->meat_2->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->meat_2->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->meat_3->Visible) { // meat_3 ?>
    <div id="r_meat_3" class="form-group row">
        <label id="elh_catering_highland_burrito_meat_3" for="x_meat_3" class="<?= $Page->LeftColumnClass ?>"><?= $Page->meat_3->caption() ?><?= $Page->meat_3->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->meat_3->cellAttributes() ?>>
<span id="el_catering_highland_burrito_meat_3">
<input type="<?= $Page->meat_3->getInputTextType() ?>" data-table="catering_highland_burrito" data-field="x_meat_3" name="x_meat_3" id="x_meat_3" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->meat_3->getPlaceHolder()) ?>" value="<?= $Page->meat_3->EditValue ?>"<?= $Page->meat_3->editAttributes() ?> aria-describedby="x_meat_3_help">
<?= $Page->meat_3->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->meat_3->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->meat_4->Visible) { // meat_4 ?>
    <div id="r_meat_4" class="form-group row">
        <label id="elh_catering_highland_burrito_meat_4" for="x_meat_4" class="<?= $Page->LeftColumnClass ?>"><?= $Page->meat_4->caption() ?><?= $Page->meat_4->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->meat_4->cellAttributes() ?>>
<span id="el_catering_highland_burrito_meat_4">
<input type="<?= $Page->meat_4->getInputTextType() ?>" data-table="catering_highland_burrito" data-field="x_meat_4" name="x_meat_4" id="x_meat_4" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->meat_4->getPlaceHolder()) ?>" value="<?= $Page->meat_4->EditValue ?>"<?= $Page->meat_4->editAttributes() ?> aria-describedby="x_meat_4_help">
<?= $Page->meat_4->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->meat_4->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->vege_1->Visible) { // vege_1 ?>
    <div id="r_vege_1" class="form-group row">
        <label id="elh_catering_highland_burrito_vege_1" for="x_vege_1" class="<?= $Page->LeftColumnClass ?>"><?= $Page->vege_1->caption() ?><?= $Page->vege_1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->vege_1->cellAttributes() ?>>
<span id="el_catering_highland_burrito_vege_1">
<input type="<?= $Page->vege_1->getInputTextType() ?>" data-table="catering_highland_burrito" data-field="x_vege_1" name="x_vege_1" id="x_vege_1" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->vege_1->getPlaceHolder()) ?>" value="<?= $Page->vege_1->EditValue ?>"<?= $Page->vege_1->editAttributes() ?> aria-describedby="x_vege_1_help">
<?= $Page->vege_1->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->vege_1->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->vege_2->Visible) { // vege_2 ?>
    <div id="r_vege_2" class="form-group row">
        <label id="elh_catering_highland_burrito_vege_2" for="x_vege_2" class="<?= $Page->LeftColumnClass ?>"><?= $Page->vege_2->caption() ?><?= $Page->vege_2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->vege_2->cellAttributes() ?>>
<span id="el_catering_highland_burrito_vege_2">
<input type="<?= $Page->vege_2->getInputTextType() ?>" data-table="catering_highland_burrito" data-field="x_vege_2" name="x_vege_2" id="x_vege_2" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->vege_2->getPlaceHolder()) ?>" value="<?= $Page->vege_2->EditValue ?>"<?= $Page->vege_2->editAttributes() ?> aria-describedby="x_vege_2_help">
<?= $Page->vege_2->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->vege_2->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->vege_3->Visible) { // vege_3 ?>
    <div id="r_vege_3" class="form-group row">
        <label id="elh_catering_highland_burrito_vege_3" for="x_vege_3" class="<?= $Page->LeftColumnClass ?>"><?= $Page->vege_3->caption() ?><?= $Page->vege_3->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->vege_3->cellAttributes() ?>>
<span id="el_catering_highland_burrito_vege_3">
<input type="<?= $Page->vege_3->getInputTextType() ?>" data-table="catering_highland_burrito" data-field="x_vege_3" name="x_vege_3" id="x_vege_3" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->vege_3->getPlaceHolder()) ?>" value="<?= $Page->vege_3->EditValue ?>"<?= $Page->vege_3->editAttributes() ?> aria-describedby="x_vege_3_help">
<?= $Page->vege_3->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->vege_3->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->vege_4->Visible) { // vege_4 ?>
    <div id="r_vege_4" class="form-group row">
        <label id="elh_catering_highland_burrito_vege_4" for="x_vege_4" class="<?= $Page->LeftColumnClass ?>"><?= $Page->vege_4->caption() ?><?= $Page->vege_4->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->vege_4->cellAttributes() ?>>
<span id="el_catering_highland_burrito_vege_4">
<input type="<?= $Page->vege_4->getInputTextType() ?>" data-table="catering_highland_burrito" data-field="x_vege_4" name="x_vege_4" id="x_vege_4" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->vege_4->getPlaceHolder()) ?>" value="<?= $Page->vege_4->EditValue ?>"<?= $Page->vege_4->editAttributes() ?> aria-describedby="x_vege_4_help">
<?= $Page->vege_4->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->vege_4->getErrorMessage() ?></div>
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
    ew.addEventHandlers("catering_highland_burrito");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
