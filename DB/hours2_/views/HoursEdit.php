<?php

namespace PHPMaker2022\project1;

// Page object
$HoursEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { hours: currentTable } });
var currentForm, currentPageID;
var fhoursedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fhoursedit = new ew.Form("fhoursedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fhoursedit;

    // Add fields
    var fields = currentTable.fields;
    fhoursedit.addFields([
        ["location_id", [fields.location_id.visible && fields.location_id.required ? ew.Validators.required(fields.location_id.caption) : null, ew.Validators.integer], fields.location_id.isInvalid],
        ["openm", [fields.openm.visible && fields.openm.required ? ew.Validators.required(fields.openm.caption) : null, ew.Validators.time(fields.openm.clientFormatPattern)], fields.openm.isInvalid],
        ["closem", [fields.closem.visible && fields.closem.required ? ew.Validators.required(fields.closem.caption) : null, ew.Validators.time(fields.closem.clientFormatPattern)], fields.closem.isInvalid],
        ["opent", [fields.opent.visible && fields.opent.required ? ew.Validators.required(fields.opent.caption) : null, ew.Validators.time(fields.opent.clientFormatPattern)], fields.opent.isInvalid],
        ["closet", [fields.closet.visible && fields.closet.required ? ew.Validators.required(fields.closet.caption) : null, ew.Validators.time(fields.closet.clientFormatPattern)], fields.closet.isInvalid],
        ["openw", [fields.openw.visible && fields.openw.required ? ew.Validators.required(fields.openw.caption) : null, ew.Validators.time(fields.openw.clientFormatPattern)], fields.openw.isInvalid],
        ["closew", [fields.closew.visible && fields.closew.required ? ew.Validators.required(fields.closew.caption) : null, ew.Validators.time(fields.closew.clientFormatPattern)], fields.closew.isInvalid],
        ["openr", [fields.openr.visible && fields.openr.required ? ew.Validators.required(fields.openr.caption) : null, ew.Validators.time(fields.openr.clientFormatPattern)], fields.openr.isInvalid],
        ["closer", [fields.closer.visible && fields.closer.required ? ew.Validators.required(fields.closer.caption) : null, ew.Validators.time(fields.closer.clientFormatPattern)], fields.closer.isInvalid],
        ["openf", [fields.openf.visible && fields.openf.required ? ew.Validators.required(fields.openf.caption) : null, ew.Validators.time(fields.openf.clientFormatPattern)], fields.openf.isInvalid],
        ["closef", [fields.closef.visible && fields.closef.required ? ew.Validators.required(fields.closef.caption) : null, ew.Validators.time(fields.closef.clientFormatPattern)], fields.closef.isInvalid],
        ["opens", [fields.opens.visible && fields.opens.required ? ew.Validators.required(fields.opens.caption) : null, ew.Validators.time(fields.opens.clientFormatPattern)], fields.opens.isInvalid],
        ["closes", [fields.closes.visible && fields.closes.required ? ew.Validators.required(fields.closes.caption) : null, ew.Validators.time(fields.closes.clientFormatPattern)], fields.closes.isInvalid],
        ["openu", [fields.openu.visible && fields.openu.required ? ew.Validators.required(fields.openu.caption) : null, ew.Validators.time(fields.openu.clientFormatPattern)], fields.openu.isInvalid],
        ["closeu", [fields.closeu.visible && fields.closeu.required ? ew.Validators.required(fields.closeu.caption) : null, ew.Validators.time(fields.closeu.clientFormatPattern)], fields.closeu.isInvalid],
        ["type", [fields.type.visible && fields.type.required ? ew.Validators.required(fields.type.caption) : null], fields.type.isInvalid],
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid]
    ]);

    // Form_CustomValidate
    fhoursedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fhoursedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fhoursedit.lists.type = <?= $Page->type->toClientList($Page) ?>;
    loadjs.done("fhoursedit");
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
<form name="fhoursedit" id="fhoursedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="hours">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->location_id->Visible) { // location_id ?>
    <div id="r_location_id"<?= $Page->location_id->rowAttributes() ?>>
        <label id="elh_hours_location_id" for="x_location_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->location_id->caption() ?><?= $Page->location_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->location_id->cellAttributes() ?>>
<span id="el_hours_location_id">
<input type="<?= $Page->location_id->getInputTextType() ?>" name="x_location_id" id="x_location_id" data-table="hours" data-field="x_location_id" value="<?= $Page->location_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->location_id->getPlaceHolder()) ?>"<?= $Page->location_id->editAttributes() ?> aria-describedby="x_location_id_help">
<?= $Page->location_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->location_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->openm->Visible) { // openm ?>
    <div id="r_openm"<?= $Page->openm->rowAttributes() ?>>
        <label id="elh_hours_openm" for="x_openm" class="<?= $Page->LeftColumnClass ?>"><?= $Page->openm->caption() ?><?= $Page->openm->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->openm->cellAttributes() ?>>
<span id="el_hours_openm">
<input type="<?= $Page->openm->getInputTextType() ?>" name="x_openm" id="x_openm" data-table="hours" data-field="x_openm" value="<?= $Page->openm->EditValue ?>" placeholder="<?= HtmlEncode($Page->openm->getPlaceHolder()) ?>"<?= $Page->openm->editAttributes() ?> aria-describedby="x_openm_help">
<?= $Page->openm->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->openm->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->closem->Visible) { // closem ?>
    <div id="r_closem"<?= $Page->closem->rowAttributes() ?>>
        <label id="elh_hours_closem" for="x_closem" class="<?= $Page->LeftColumnClass ?>"><?= $Page->closem->caption() ?><?= $Page->closem->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->closem->cellAttributes() ?>>
<span id="el_hours_closem">
<input type="<?= $Page->closem->getInputTextType() ?>" name="x_closem" id="x_closem" data-table="hours" data-field="x_closem" value="<?= $Page->closem->EditValue ?>" placeholder="<?= HtmlEncode($Page->closem->getPlaceHolder()) ?>"<?= $Page->closem->editAttributes() ?> aria-describedby="x_closem_help">
<?= $Page->closem->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->closem->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->opent->Visible) { // opent ?>
    <div id="r_opent"<?= $Page->opent->rowAttributes() ?>>
        <label id="elh_hours_opent" for="x_opent" class="<?= $Page->LeftColumnClass ?>"><?= $Page->opent->caption() ?><?= $Page->opent->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->opent->cellAttributes() ?>>
<span id="el_hours_opent">
<input type="<?= $Page->opent->getInputTextType() ?>" name="x_opent" id="x_opent" data-table="hours" data-field="x_opent" value="<?= $Page->opent->EditValue ?>" placeholder="<?= HtmlEncode($Page->opent->getPlaceHolder()) ?>"<?= $Page->opent->editAttributes() ?> aria-describedby="x_opent_help">
<?= $Page->opent->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->opent->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->closet->Visible) { // closet ?>
    <div id="r_closet"<?= $Page->closet->rowAttributes() ?>>
        <label id="elh_hours_closet" for="x_closet" class="<?= $Page->LeftColumnClass ?>"><?= $Page->closet->caption() ?><?= $Page->closet->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->closet->cellAttributes() ?>>
<span id="el_hours_closet">
<input type="<?= $Page->closet->getInputTextType() ?>" name="x_closet" id="x_closet" data-table="hours" data-field="x_closet" value="<?= $Page->closet->EditValue ?>" placeholder="<?= HtmlEncode($Page->closet->getPlaceHolder()) ?>"<?= $Page->closet->editAttributes() ?> aria-describedby="x_closet_help">
<?= $Page->closet->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->closet->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->openw->Visible) { // openw ?>
    <div id="r_openw"<?= $Page->openw->rowAttributes() ?>>
        <label id="elh_hours_openw" for="x_openw" class="<?= $Page->LeftColumnClass ?>"><?= $Page->openw->caption() ?><?= $Page->openw->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->openw->cellAttributes() ?>>
<span id="el_hours_openw">
<input type="<?= $Page->openw->getInputTextType() ?>" name="x_openw" id="x_openw" data-table="hours" data-field="x_openw" value="<?= $Page->openw->EditValue ?>" placeholder="<?= HtmlEncode($Page->openw->getPlaceHolder()) ?>"<?= $Page->openw->editAttributes() ?> aria-describedby="x_openw_help">
<?= $Page->openw->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->openw->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->closew->Visible) { // closew ?>
    <div id="r_closew"<?= $Page->closew->rowAttributes() ?>>
        <label id="elh_hours_closew" for="x_closew" class="<?= $Page->LeftColumnClass ?>"><?= $Page->closew->caption() ?><?= $Page->closew->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->closew->cellAttributes() ?>>
<span id="el_hours_closew">
<input type="<?= $Page->closew->getInputTextType() ?>" name="x_closew" id="x_closew" data-table="hours" data-field="x_closew" value="<?= $Page->closew->EditValue ?>" placeholder="<?= HtmlEncode($Page->closew->getPlaceHolder()) ?>"<?= $Page->closew->editAttributes() ?> aria-describedby="x_closew_help">
<?= $Page->closew->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->closew->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->openr->Visible) { // openr ?>
    <div id="r_openr"<?= $Page->openr->rowAttributes() ?>>
        <label id="elh_hours_openr" for="x_openr" class="<?= $Page->LeftColumnClass ?>"><?= $Page->openr->caption() ?><?= $Page->openr->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->openr->cellAttributes() ?>>
<span id="el_hours_openr">
<input type="<?= $Page->openr->getInputTextType() ?>" name="x_openr" id="x_openr" data-table="hours" data-field="x_openr" value="<?= $Page->openr->EditValue ?>" placeholder="<?= HtmlEncode($Page->openr->getPlaceHolder()) ?>"<?= $Page->openr->editAttributes() ?> aria-describedby="x_openr_help">
<?= $Page->openr->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->openr->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->closer->Visible) { // closer ?>
    <div id="r_closer"<?= $Page->closer->rowAttributes() ?>>
        <label id="elh_hours_closer" for="x_closer" class="<?= $Page->LeftColumnClass ?>"><?= $Page->closer->caption() ?><?= $Page->closer->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->closer->cellAttributes() ?>>
<span id="el_hours_closer">
<input type="<?= $Page->closer->getInputTextType() ?>" name="x_closer" id="x_closer" data-table="hours" data-field="x_closer" value="<?= $Page->closer->EditValue ?>" placeholder="<?= HtmlEncode($Page->closer->getPlaceHolder()) ?>"<?= $Page->closer->editAttributes() ?> aria-describedby="x_closer_help">
<?= $Page->closer->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->closer->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->openf->Visible) { // openf ?>
    <div id="r_openf"<?= $Page->openf->rowAttributes() ?>>
        <label id="elh_hours_openf" for="x_openf" class="<?= $Page->LeftColumnClass ?>"><?= $Page->openf->caption() ?><?= $Page->openf->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->openf->cellAttributes() ?>>
<span id="el_hours_openf">
<input type="<?= $Page->openf->getInputTextType() ?>" name="x_openf" id="x_openf" data-table="hours" data-field="x_openf" value="<?= $Page->openf->EditValue ?>" placeholder="<?= HtmlEncode($Page->openf->getPlaceHolder()) ?>"<?= $Page->openf->editAttributes() ?> aria-describedby="x_openf_help">
<?= $Page->openf->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->openf->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->closef->Visible) { // closef ?>
    <div id="r_closef"<?= $Page->closef->rowAttributes() ?>>
        <label id="elh_hours_closef" for="x_closef" class="<?= $Page->LeftColumnClass ?>"><?= $Page->closef->caption() ?><?= $Page->closef->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->closef->cellAttributes() ?>>
<span id="el_hours_closef">
<input type="<?= $Page->closef->getInputTextType() ?>" name="x_closef" id="x_closef" data-table="hours" data-field="x_closef" value="<?= $Page->closef->EditValue ?>" placeholder="<?= HtmlEncode($Page->closef->getPlaceHolder()) ?>"<?= $Page->closef->editAttributes() ?> aria-describedby="x_closef_help">
<?= $Page->closef->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->closef->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->opens->Visible) { // opens ?>
    <div id="r_opens"<?= $Page->opens->rowAttributes() ?>>
        <label id="elh_hours_opens" for="x_opens" class="<?= $Page->LeftColumnClass ?>"><?= $Page->opens->caption() ?><?= $Page->opens->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->opens->cellAttributes() ?>>
<span id="el_hours_opens">
<input type="<?= $Page->opens->getInputTextType() ?>" name="x_opens" id="x_opens" data-table="hours" data-field="x_opens" value="<?= $Page->opens->EditValue ?>" placeholder="<?= HtmlEncode($Page->opens->getPlaceHolder()) ?>"<?= $Page->opens->editAttributes() ?> aria-describedby="x_opens_help">
<?= $Page->opens->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->opens->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->closes->Visible) { // closes ?>
    <div id="r_closes"<?= $Page->closes->rowAttributes() ?>>
        <label id="elh_hours_closes" for="x_closes" class="<?= $Page->LeftColumnClass ?>"><?= $Page->closes->caption() ?><?= $Page->closes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->closes->cellAttributes() ?>>
<span id="el_hours_closes">
<input type="<?= $Page->closes->getInputTextType() ?>" name="x_closes" id="x_closes" data-table="hours" data-field="x_closes" value="<?= $Page->closes->EditValue ?>" placeholder="<?= HtmlEncode($Page->closes->getPlaceHolder()) ?>"<?= $Page->closes->editAttributes() ?> aria-describedby="x_closes_help">
<?= $Page->closes->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->closes->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->openu->Visible) { // openu ?>
    <div id="r_openu"<?= $Page->openu->rowAttributes() ?>>
        <label id="elh_hours_openu" for="x_openu" class="<?= $Page->LeftColumnClass ?>"><?= $Page->openu->caption() ?><?= $Page->openu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->openu->cellAttributes() ?>>
<span id="el_hours_openu">
<input type="<?= $Page->openu->getInputTextType() ?>" name="x_openu" id="x_openu" data-table="hours" data-field="x_openu" value="<?= $Page->openu->EditValue ?>" placeholder="<?= HtmlEncode($Page->openu->getPlaceHolder()) ?>"<?= $Page->openu->editAttributes() ?> aria-describedby="x_openu_help">
<?= $Page->openu->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->openu->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->closeu->Visible) { // closeu ?>
    <div id="r_closeu"<?= $Page->closeu->rowAttributes() ?>>
        <label id="elh_hours_closeu" for="x_closeu" class="<?= $Page->LeftColumnClass ?>"><?= $Page->closeu->caption() ?><?= $Page->closeu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->closeu->cellAttributes() ?>>
<span id="el_hours_closeu">
<input type="<?= $Page->closeu->getInputTextType() ?>" name="x_closeu" id="x_closeu" data-table="hours" data-field="x_closeu" value="<?= $Page->closeu->EditValue ?>" placeholder="<?= HtmlEncode($Page->closeu->getPlaceHolder()) ?>"<?= $Page->closeu->editAttributes() ?> aria-describedby="x_closeu_help">
<?= $Page->closeu->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->closeu->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
    <div id="r_type"<?= $Page->type->rowAttributes() ?>>
        <label id="elh_hours_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->type->caption() ?><?= $Page->type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->type->cellAttributes() ?>>
<span id="el_hours_type">
<div class="form-check d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->type->isInvalidClass() ?>" data-table="hours" data-field="x_type" name="x_type[]" id="x_type_858036" value="1"<?= ConvertToBool($Page->type->CurrentValue) ? " checked" : "" ?><?= $Page->type->editAttributes() ?> aria-describedby="x_type_help">
    <div class="invalid-feedback"><?= $Page->type->getErrorMessage() ?></div>
</div>
<?= $Page->type->getCustomMessage() ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_hours_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_hours_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="hours" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
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
    ew.addEventHandlers("hours");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
