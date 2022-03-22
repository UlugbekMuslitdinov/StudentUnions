<?php

namespace PHPMaker2021\project2;

// Page object
$HoursAdd = &$Page;
?>
<script>
if (!ew.vars.tables.hours) ew.vars.tables.hours = <?= JsonEncode(GetClientVar("tables", "hours")) ?>;
var currentForm, currentPageID;
var fhoursadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fhoursadd = currentForm = new ew.Form("fhoursadd", "add");

    // Add fields
    var fields = ew.vars.tables.hours.fields;
    fhoursadd.addFields([
        ["location_id", [fields.location_id.required ? ew.Validators.required(fields.location_id.caption) : null, ew.Validators.integer], fields.location_id.isInvalid],
        ["openm", [fields.openm.required ? ew.Validators.required(fields.openm.caption) : null, ew.Validators.time], fields.openm.isInvalid],
        ["closem", [fields.closem.required ? ew.Validators.required(fields.closem.caption) : null, ew.Validators.time], fields.closem.isInvalid],
        ["opent", [fields.opent.required ? ew.Validators.required(fields.opent.caption) : null, ew.Validators.time], fields.opent.isInvalid],
        ["closet", [fields.closet.required ? ew.Validators.required(fields.closet.caption) : null, ew.Validators.time], fields.closet.isInvalid],
        ["openw", [fields.openw.required ? ew.Validators.required(fields.openw.caption) : null, ew.Validators.time], fields.openw.isInvalid],
        ["closew", [fields.closew.required ? ew.Validators.required(fields.closew.caption) : null, ew.Validators.time], fields.closew.isInvalid],
        ["openr", [fields.openr.required ? ew.Validators.required(fields.openr.caption) : null, ew.Validators.time], fields.openr.isInvalid],
        ["closer", [fields.closer.required ? ew.Validators.required(fields.closer.caption) : null, ew.Validators.time], fields.closer.isInvalid],
        ["openf", [fields.openf.required ? ew.Validators.required(fields.openf.caption) : null, ew.Validators.time], fields.openf.isInvalid],
        ["closef", [fields.closef.required ? ew.Validators.required(fields.closef.caption) : null, ew.Validators.time], fields.closef.isInvalid],
        ["opens", [fields.opens.required ? ew.Validators.required(fields.opens.caption) : null, ew.Validators.time], fields.opens.isInvalid],
        ["closes", [fields.closes.required ? ew.Validators.required(fields.closes.caption) : null, ew.Validators.time], fields.closes.isInvalid],
        ["openu", [fields.openu.required ? ew.Validators.required(fields.openu.caption) : null, ew.Validators.time], fields.openu.isInvalid],
        ["closeu", [fields.closeu.required ? ew.Validators.required(fields.closeu.caption) : null, ew.Validators.time], fields.closeu.isInvalid],
        ["type", [fields.type.required ? ew.Validators.required(fields.type.caption) : null], fields.type.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fhoursadd,
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
    fhoursadd.validate = function () {
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
    fhoursadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fhoursadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fhoursadd.lists.type = <?= $Page->type->toClientList($Page) ?>;
    loadjs.done("fhoursadd");
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
<form name="fhoursadd" id="fhoursadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="hours">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->location_id->Visible) { // location_id ?>
    <div id="r_location_id" class="form-group row">
        <label id="elh_hours_location_id" for="x_location_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->location_id->caption() ?><?= $Page->location_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->location_id->cellAttributes() ?>>
<span id="el_hours_location_id">
<input type="<?= $Page->location_id->getInputTextType() ?>" data-table="hours" data-field="x_location_id" name="x_location_id" id="x_location_id" size="30" placeholder="<?= HtmlEncode($Page->location_id->getPlaceHolder()) ?>" value="<?= $Page->location_id->EditValue ?>"<?= $Page->location_id->editAttributes() ?> aria-describedby="x_location_id_help">
<?= $Page->location_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->location_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->openm->Visible) { // openm ?>
    <div id="r_openm" class="form-group row">
        <label id="elh_hours_openm" for="x_openm" class="<?= $Page->LeftColumnClass ?>"><?= $Page->openm->caption() ?><?= $Page->openm->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->openm->cellAttributes() ?>>
<span id="el_hours_openm">
<input type="<?= $Page->openm->getInputTextType() ?>" data-table="hours" data-field="x_openm" name="x_openm" id="x_openm" placeholder="<?= HtmlEncode($Page->openm->getPlaceHolder()) ?>" value="<?= $Page->openm->EditValue ?>"<?= $Page->openm->editAttributes() ?> aria-describedby="x_openm_help">
<?= $Page->openm->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->openm->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->closem->Visible) { // closem ?>
    <div id="r_closem" class="form-group row">
        <label id="elh_hours_closem" for="x_closem" class="<?= $Page->LeftColumnClass ?>"><?= $Page->closem->caption() ?><?= $Page->closem->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->closem->cellAttributes() ?>>
<span id="el_hours_closem">
<input type="<?= $Page->closem->getInputTextType() ?>" data-table="hours" data-field="x_closem" name="x_closem" id="x_closem" placeholder="<?= HtmlEncode($Page->closem->getPlaceHolder()) ?>" value="<?= $Page->closem->EditValue ?>"<?= $Page->closem->editAttributes() ?> aria-describedby="x_closem_help">
<?= $Page->closem->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->closem->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->opent->Visible) { // opent ?>
    <div id="r_opent" class="form-group row">
        <label id="elh_hours_opent" for="x_opent" class="<?= $Page->LeftColumnClass ?>"><?= $Page->opent->caption() ?><?= $Page->opent->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->opent->cellAttributes() ?>>
<span id="el_hours_opent">
<input type="<?= $Page->opent->getInputTextType() ?>" data-table="hours" data-field="x_opent" name="x_opent" id="x_opent" placeholder="<?= HtmlEncode($Page->opent->getPlaceHolder()) ?>" value="<?= $Page->opent->EditValue ?>"<?= $Page->opent->editAttributes() ?> aria-describedby="x_opent_help">
<?= $Page->opent->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->opent->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->closet->Visible) { // closet ?>
    <div id="r_closet" class="form-group row">
        <label id="elh_hours_closet" for="x_closet" class="<?= $Page->LeftColumnClass ?>"><?= $Page->closet->caption() ?><?= $Page->closet->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->closet->cellAttributes() ?>>
<span id="el_hours_closet">
<input type="<?= $Page->closet->getInputTextType() ?>" data-table="hours" data-field="x_closet" name="x_closet" id="x_closet" placeholder="<?= HtmlEncode($Page->closet->getPlaceHolder()) ?>" value="<?= $Page->closet->EditValue ?>"<?= $Page->closet->editAttributes() ?> aria-describedby="x_closet_help">
<?= $Page->closet->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->closet->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->openw->Visible) { // openw ?>
    <div id="r_openw" class="form-group row">
        <label id="elh_hours_openw" for="x_openw" class="<?= $Page->LeftColumnClass ?>"><?= $Page->openw->caption() ?><?= $Page->openw->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->openw->cellAttributes() ?>>
<span id="el_hours_openw">
<input type="<?= $Page->openw->getInputTextType() ?>" data-table="hours" data-field="x_openw" name="x_openw" id="x_openw" placeholder="<?= HtmlEncode($Page->openw->getPlaceHolder()) ?>" value="<?= $Page->openw->EditValue ?>"<?= $Page->openw->editAttributes() ?> aria-describedby="x_openw_help">
<?= $Page->openw->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->openw->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->closew->Visible) { // closew ?>
    <div id="r_closew" class="form-group row">
        <label id="elh_hours_closew" for="x_closew" class="<?= $Page->LeftColumnClass ?>"><?= $Page->closew->caption() ?><?= $Page->closew->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->closew->cellAttributes() ?>>
<span id="el_hours_closew">
<input type="<?= $Page->closew->getInputTextType() ?>" data-table="hours" data-field="x_closew" name="x_closew" id="x_closew" placeholder="<?= HtmlEncode($Page->closew->getPlaceHolder()) ?>" value="<?= $Page->closew->EditValue ?>"<?= $Page->closew->editAttributes() ?> aria-describedby="x_closew_help">
<?= $Page->closew->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->closew->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->openr->Visible) { // openr ?>
    <div id="r_openr" class="form-group row">
        <label id="elh_hours_openr" for="x_openr" class="<?= $Page->LeftColumnClass ?>"><?= $Page->openr->caption() ?><?= $Page->openr->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->openr->cellAttributes() ?>>
<span id="el_hours_openr">
<input type="<?= $Page->openr->getInputTextType() ?>" data-table="hours" data-field="x_openr" name="x_openr" id="x_openr" placeholder="<?= HtmlEncode($Page->openr->getPlaceHolder()) ?>" value="<?= $Page->openr->EditValue ?>"<?= $Page->openr->editAttributes() ?> aria-describedby="x_openr_help">
<?= $Page->openr->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->openr->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->closer->Visible) { // closer ?>
    <div id="r_closer" class="form-group row">
        <label id="elh_hours_closer" for="x_closer" class="<?= $Page->LeftColumnClass ?>"><?= $Page->closer->caption() ?><?= $Page->closer->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->closer->cellAttributes() ?>>
<span id="el_hours_closer">
<input type="<?= $Page->closer->getInputTextType() ?>" data-table="hours" data-field="x_closer" name="x_closer" id="x_closer" placeholder="<?= HtmlEncode($Page->closer->getPlaceHolder()) ?>" value="<?= $Page->closer->EditValue ?>"<?= $Page->closer->editAttributes() ?> aria-describedby="x_closer_help">
<?= $Page->closer->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->closer->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->openf->Visible) { // openf ?>
    <div id="r_openf" class="form-group row">
        <label id="elh_hours_openf" for="x_openf" class="<?= $Page->LeftColumnClass ?>"><?= $Page->openf->caption() ?><?= $Page->openf->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->openf->cellAttributes() ?>>
<span id="el_hours_openf">
<input type="<?= $Page->openf->getInputTextType() ?>" data-table="hours" data-field="x_openf" name="x_openf" id="x_openf" placeholder="<?= HtmlEncode($Page->openf->getPlaceHolder()) ?>" value="<?= $Page->openf->EditValue ?>"<?= $Page->openf->editAttributes() ?> aria-describedby="x_openf_help">
<?= $Page->openf->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->openf->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->closef->Visible) { // closef ?>
    <div id="r_closef" class="form-group row">
        <label id="elh_hours_closef" for="x_closef" class="<?= $Page->LeftColumnClass ?>"><?= $Page->closef->caption() ?><?= $Page->closef->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->closef->cellAttributes() ?>>
<span id="el_hours_closef">
<input type="<?= $Page->closef->getInputTextType() ?>" data-table="hours" data-field="x_closef" name="x_closef" id="x_closef" placeholder="<?= HtmlEncode($Page->closef->getPlaceHolder()) ?>" value="<?= $Page->closef->EditValue ?>"<?= $Page->closef->editAttributes() ?> aria-describedby="x_closef_help">
<?= $Page->closef->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->closef->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->opens->Visible) { // opens ?>
    <div id="r_opens" class="form-group row">
        <label id="elh_hours_opens" for="x_opens" class="<?= $Page->LeftColumnClass ?>"><?= $Page->opens->caption() ?><?= $Page->opens->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->opens->cellAttributes() ?>>
<span id="el_hours_opens">
<input type="<?= $Page->opens->getInputTextType() ?>" data-table="hours" data-field="x_opens" name="x_opens" id="x_opens" placeholder="<?= HtmlEncode($Page->opens->getPlaceHolder()) ?>" value="<?= $Page->opens->EditValue ?>"<?= $Page->opens->editAttributes() ?> aria-describedby="x_opens_help">
<?= $Page->opens->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->opens->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->closes->Visible) { // closes ?>
    <div id="r_closes" class="form-group row">
        <label id="elh_hours_closes" for="x_closes" class="<?= $Page->LeftColumnClass ?>"><?= $Page->closes->caption() ?><?= $Page->closes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->closes->cellAttributes() ?>>
<span id="el_hours_closes">
<input type="<?= $Page->closes->getInputTextType() ?>" data-table="hours" data-field="x_closes" name="x_closes" id="x_closes" placeholder="<?= HtmlEncode($Page->closes->getPlaceHolder()) ?>" value="<?= $Page->closes->EditValue ?>"<?= $Page->closes->editAttributes() ?> aria-describedby="x_closes_help">
<?= $Page->closes->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->closes->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->openu->Visible) { // openu ?>
    <div id="r_openu" class="form-group row">
        <label id="elh_hours_openu" for="x_openu" class="<?= $Page->LeftColumnClass ?>"><?= $Page->openu->caption() ?><?= $Page->openu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->openu->cellAttributes() ?>>
<span id="el_hours_openu">
<input type="<?= $Page->openu->getInputTextType() ?>" data-table="hours" data-field="x_openu" name="x_openu" id="x_openu" placeholder="<?= HtmlEncode($Page->openu->getPlaceHolder()) ?>" value="<?= $Page->openu->EditValue ?>"<?= $Page->openu->editAttributes() ?> aria-describedby="x_openu_help">
<?= $Page->openu->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->openu->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->closeu->Visible) { // closeu ?>
    <div id="r_closeu" class="form-group row">
        <label id="elh_hours_closeu" for="x_closeu" class="<?= $Page->LeftColumnClass ?>"><?= $Page->closeu->caption() ?><?= $Page->closeu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->closeu->cellAttributes() ?>>
<span id="el_hours_closeu">
<input type="<?= $Page->closeu->getInputTextType() ?>" data-table="hours" data-field="x_closeu" name="x_closeu" id="x_closeu" placeholder="<?= HtmlEncode($Page->closeu->getPlaceHolder()) ?>" value="<?= $Page->closeu->EditValue ?>"<?= $Page->closeu->editAttributes() ?> aria-describedby="x_closeu_help">
<?= $Page->closeu->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->closeu->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
    <div id="r_type" class="form-group row">
        <label id="elh_hours_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->type->caption() ?><?= $Page->type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->type->cellAttributes() ?>>
<span id="el_hours_type">
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" class="custom-control-input<?= $Page->type->isInvalidClass() ?>" data-table="hours" data-field="x_type" name="x_type[]" id="x_type_796162" value="1"<?= ConvertToBool($Page->type->CurrentValue) ? " checked" : "" ?><?= $Page->type->editAttributes() ?> aria-describedby="x_type_help">
    <label class="custom-control-label" for="x_type_796162"></label>
</div>
<?= $Page->type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->type->getErrorMessage() ?></div>
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
    ew.addEventHandlers("hours");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
