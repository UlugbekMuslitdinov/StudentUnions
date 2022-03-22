<?php

namespace PHPMaker2022\project3;

// Page object
$MealTimesAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { meal_times: currentTable } });
var currentForm, currentPageID;
var fmeal_timesadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmeal_timesadd = new ew.Form("fmeal_timesadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fmeal_timesadd;

    // Add fields
    var fields = currentTable.fields;
    fmeal_timesadd.addFields([
        ["location_id", [fields.location_id.visible && fields.location_id.required ? ew.Validators.required(fields.location_id.caption) : null, ew.Validators.integer], fields.location_id.isInvalid],
        ["meal_details_id", [fields.meal_details_id.visible && fields.meal_details_id.required ? ew.Validators.required(fields.meal_details_id.caption) : null, ew.Validators.integer], fields.meal_details_id.isInvalid],
        ["startm", [fields.startm.visible && fields.startm.required ? ew.Validators.required(fields.startm.caption) : null, ew.Validators.time(fields.startm.clientFormatPattern)], fields.startm.isInvalid],
        ["endm", [fields.endm.visible && fields.endm.required ? ew.Validators.required(fields.endm.caption) : null, ew.Validators.time(fields.endm.clientFormatPattern)], fields.endm.isInvalid],
        ["startt", [fields.startt.visible && fields.startt.required ? ew.Validators.required(fields.startt.caption) : null, ew.Validators.time(fields.startt.clientFormatPattern)], fields.startt.isInvalid],
        ["endt", [fields.endt.visible && fields.endt.required ? ew.Validators.required(fields.endt.caption) : null, ew.Validators.time(fields.endt.clientFormatPattern)], fields.endt.isInvalid],
        ["startw", [fields.startw.visible && fields.startw.required ? ew.Validators.required(fields.startw.caption) : null, ew.Validators.time(fields.startw.clientFormatPattern)], fields.startw.isInvalid],
        ["endw", [fields.endw.visible && fields.endw.required ? ew.Validators.required(fields.endw.caption) : null, ew.Validators.time(fields.endw.clientFormatPattern)], fields.endw.isInvalid],
        ["startr", [fields.startr.visible && fields.startr.required ? ew.Validators.required(fields.startr.caption) : null, ew.Validators.time(fields.startr.clientFormatPattern)], fields.startr.isInvalid],
        ["endr", [fields.endr.visible && fields.endr.required ? ew.Validators.required(fields.endr.caption) : null, ew.Validators.time(fields.endr.clientFormatPattern)], fields.endr.isInvalid],
        ["startf", [fields.startf.visible && fields.startf.required ? ew.Validators.required(fields.startf.caption) : null, ew.Validators.time(fields.startf.clientFormatPattern)], fields.startf.isInvalid],
        ["endf", [fields.endf.visible && fields.endf.required ? ew.Validators.required(fields.endf.caption) : null, ew.Validators.time(fields.endf.clientFormatPattern)], fields.endf.isInvalid],
        ["starts", [fields.starts.visible && fields.starts.required ? ew.Validators.required(fields.starts.caption) : null, ew.Validators.time(fields.starts.clientFormatPattern)], fields.starts.isInvalid],
        ["ends", [fields.ends.visible && fields.ends.required ? ew.Validators.required(fields.ends.caption) : null, ew.Validators.time(fields.ends.clientFormatPattern)], fields.ends.isInvalid],
        ["startu", [fields.startu.visible && fields.startu.required ? ew.Validators.required(fields.startu.caption) : null, ew.Validators.time(fields.startu.clientFormatPattern)], fields.startu.isInvalid],
        ["endu", [fields.endu.visible && fields.endu.required ? ew.Validators.required(fields.endu.caption) : null, ew.Validators.time(fields.endu.clientFormatPattern)], fields.endu.isInvalid]
    ]);

    // Form_CustomValidate
    fmeal_timesadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmeal_timesadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fmeal_timesadd");
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
<form name="fmeal_timesadd" id="fmeal_timesadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="meal_times">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->location_id->Visible) { // location_id ?>
    <div id="r_location_id"<?= $Page->location_id->rowAttributes() ?>>
        <label id="elh_meal_times_location_id" for="x_location_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->location_id->caption() ?><?= $Page->location_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->location_id->cellAttributes() ?>>
<span id="el_meal_times_location_id">
<input type="<?= $Page->location_id->getInputTextType() ?>" name="x_location_id" id="x_location_id" data-table="meal_times" data-field="x_location_id" value="<?= $Page->location_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->location_id->getPlaceHolder()) ?>"<?= $Page->location_id->editAttributes() ?> aria-describedby="x_location_id_help">
<?= $Page->location_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->location_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->meal_details_id->Visible) { // meal_details_id ?>
    <div id="r_meal_details_id"<?= $Page->meal_details_id->rowAttributes() ?>>
        <label id="elh_meal_times_meal_details_id" for="x_meal_details_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->meal_details_id->caption() ?><?= $Page->meal_details_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->meal_details_id->cellAttributes() ?>>
<span id="el_meal_times_meal_details_id">
<input type="<?= $Page->meal_details_id->getInputTextType() ?>" name="x_meal_details_id" id="x_meal_details_id" data-table="meal_times" data-field="x_meal_details_id" value="<?= $Page->meal_details_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->meal_details_id->getPlaceHolder()) ?>"<?= $Page->meal_details_id->editAttributes() ?> aria-describedby="x_meal_details_id_help">
<?= $Page->meal_details_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->meal_details_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->startm->Visible) { // startm ?>
    <div id="r_startm"<?= $Page->startm->rowAttributes() ?>>
        <label id="elh_meal_times_startm" for="x_startm" class="<?= $Page->LeftColumnClass ?>"><?= $Page->startm->caption() ?><?= $Page->startm->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->startm->cellAttributes() ?>>
<span id="el_meal_times_startm">
<input type="<?= $Page->startm->getInputTextType() ?>" name="x_startm" id="x_startm" data-table="meal_times" data-field="x_startm" value="<?= $Page->startm->EditValue ?>" placeholder="<?= HtmlEncode($Page->startm->getPlaceHolder()) ?>"<?= $Page->startm->editAttributes() ?> aria-describedby="x_startm_help">
<?= $Page->startm->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->startm->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->endm->Visible) { // endm ?>
    <div id="r_endm"<?= $Page->endm->rowAttributes() ?>>
        <label id="elh_meal_times_endm" for="x_endm" class="<?= $Page->LeftColumnClass ?>"><?= $Page->endm->caption() ?><?= $Page->endm->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->endm->cellAttributes() ?>>
<span id="el_meal_times_endm">
<input type="<?= $Page->endm->getInputTextType() ?>" name="x_endm" id="x_endm" data-table="meal_times" data-field="x_endm" value="<?= $Page->endm->EditValue ?>" placeholder="<?= HtmlEncode($Page->endm->getPlaceHolder()) ?>"<?= $Page->endm->editAttributes() ?> aria-describedby="x_endm_help">
<?= $Page->endm->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->endm->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->startt->Visible) { // startt ?>
    <div id="r_startt"<?= $Page->startt->rowAttributes() ?>>
        <label id="elh_meal_times_startt" for="x_startt" class="<?= $Page->LeftColumnClass ?>"><?= $Page->startt->caption() ?><?= $Page->startt->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->startt->cellAttributes() ?>>
<span id="el_meal_times_startt">
<input type="<?= $Page->startt->getInputTextType() ?>" name="x_startt" id="x_startt" data-table="meal_times" data-field="x_startt" value="<?= $Page->startt->EditValue ?>" placeholder="<?= HtmlEncode($Page->startt->getPlaceHolder()) ?>"<?= $Page->startt->editAttributes() ?> aria-describedby="x_startt_help">
<?= $Page->startt->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->startt->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->endt->Visible) { // endt ?>
    <div id="r_endt"<?= $Page->endt->rowAttributes() ?>>
        <label id="elh_meal_times_endt" for="x_endt" class="<?= $Page->LeftColumnClass ?>"><?= $Page->endt->caption() ?><?= $Page->endt->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->endt->cellAttributes() ?>>
<span id="el_meal_times_endt">
<input type="<?= $Page->endt->getInputTextType() ?>" name="x_endt" id="x_endt" data-table="meal_times" data-field="x_endt" value="<?= $Page->endt->EditValue ?>" placeholder="<?= HtmlEncode($Page->endt->getPlaceHolder()) ?>"<?= $Page->endt->editAttributes() ?> aria-describedby="x_endt_help">
<?= $Page->endt->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->endt->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->startw->Visible) { // startw ?>
    <div id="r_startw"<?= $Page->startw->rowAttributes() ?>>
        <label id="elh_meal_times_startw" for="x_startw" class="<?= $Page->LeftColumnClass ?>"><?= $Page->startw->caption() ?><?= $Page->startw->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->startw->cellAttributes() ?>>
<span id="el_meal_times_startw">
<input type="<?= $Page->startw->getInputTextType() ?>" name="x_startw" id="x_startw" data-table="meal_times" data-field="x_startw" value="<?= $Page->startw->EditValue ?>" placeholder="<?= HtmlEncode($Page->startw->getPlaceHolder()) ?>"<?= $Page->startw->editAttributes() ?> aria-describedby="x_startw_help">
<?= $Page->startw->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->startw->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->endw->Visible) { // endw ?>
    <div id="r_endw"<?= $Page->endw->rowAttributes() ?>>
        <label id="elh_meal_times_endw" for="x_endw" class="<?= $Page->LeftColumnClass ?>"><?= $Page->endw->caption() ?><?= $Page->endw->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->endw->cellAttributes() ?>>
<span id="el_meal_times_endw">
<input type="<?= $Page->endw->getInputTextType() ?>" name="x_endw" id="x_endw" data-table="meal_times" data-field="x_endw" value="<?= $Page->endw->EditValue ?>" placeholder="<?= HtmlEncode($Page->endw->getPlaceHolder()) ?>"<?= $Page->endw->editAttributes() ?> aria-describedby="x_endw_help">
<?= $Page->endw->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->endw->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->startr->Visible) { // startr ?>
    <div id="r_startr"<?= $Page->startr->rowAttributes() ?>>
        <label id="elh_meal_times_startr" for="x_startr" class="<?= $Page->LeftColumnClass ?>"><?= $Page->startr->caption() ?><?= $Page->startr->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->startr->cellAttributes() ?>>
<span id="el_meal_times_startr">
<input type="<?= $Page->startr->getInputTextType() ?>" name="x_startr" id="x_startr" data-table="meal_times" data-field="x_startr" value="<?= $Page->startr->EditValue ?>" placeholder="<?= HtmlEncode($Page->startr->getPlaceHolder()) ?>"<?= $Page->startr->editAttributes() ?> aria-describedby="x_startr_help">
<?= $Page->startr->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->startr->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->endr->Visible) { // endr ?>
    <div id="r_endr"<?= $Page->endr->rowAttributes() ?>>
        <label id="elh_meal_times_endr" for="x_endr" class="<?= $Page->LeftColumnClass ?>"><?= $Page->endr->caption() ?><?= $Page->endr->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->endr->cellAttributes() ?>>
<span id="el_meal_times_endr">
<input type="<?= $Page->endr->getInputTextType() ?>" name="x_endr" id="x_endr" data-table="meal_times" data-field="x_endr" value="<?= $Page->endr->EditValue ?>" placeholder="<?= HtmlEncode($Page->endr->getPlaceHolder()) ?>"<?= $Page->endr->editAttributes() ?> aria-describedby="x_endr_help">
<?= $Page->endr->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->endr->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->startf->Visible) { // startf ?>
    <div id="r_startf"<?= $Page->startf->rowAttributes() ?>>
        <label id="elh_meal_times_startf" for="x_startf" class="<?= $Page->LeftColumnClass ?>"><?= $Page->startf->caption() ?><?= $Page->startf->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->startf->cellAttributes() ?>>
<span id="el_meal_times_startf">
<input type="<?= $Page->startf->getInputTextType() ?>" name="x_startf" id="x_startf" data-table="meal_times" data-field="x_startf" value="<?= $Page->startf->EditValue ?>" placeholder="<?= HtmlEncode($Page->startf->getPlaceHolder()) ?>"<?= $Page->startf->editAttributes() ?> aria-describedby="x_startf_help">
<?= $Page->startf->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->startf->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->endf->Visible) { // endf ?>
    <div id="r_endf"<?= $Page->endf->rowAttributes() ?>>
        <label id="elh_meal_times_endf" for="x_endf" class="<?= $Page->LeftColumnClass ?>"><?= $Page->endf->caption() ?><?= $Page->endf->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->endf->cellAttributes() ?>>
<span id="el_meal_times_endf">
<input type="<?= $Page->endf->getInputTextType() ?>" name="x_endf" id="x_endf" data-table="meal_times" data-field="x_endf" value="<?= $Page->endf->EditValue ?>" placeholder="<?= HtmlEncode($Page->endf->getPlaceHolder()) ?>"<?= $Page->endf->editAttributes() ?> aria-describedby="x_endf_help">
<?= $Page->endf->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->endf->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->starts->Visible) { // starts ?>
    <div id="r_starts"<?= $Page->starts->rowAttributes() ?>>
        <label id="elh_meal_times_starts" for="x_starts" class="<?= $Page->LeftColumnClass ?>"><?= $Page->starts->caption() ?><?= $Page->starts->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->starts->cellAttributes() ?>>
<span id="el_meal_times_starts">
<input type="<?= $Page->starts->getInputTextType() ?>" name="x_starts" id="x_starts" data-table="meal_times" data-field="x_starts" value="<?= $Page->starts->EditValue ?>" placeholder="<?= HtmlEncode($Page->starts->getPlaceHolder()) ?>"<?= $Page->starts->editAttributes() ?> aria-describedby="x_starts_help">
<?= $Page->starts->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->starts->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ends->Visible) { // ends ?>
    <div id="r_ends"<?= $Page->ends->rowAttributes() ?>>
        <label id="elh_meal_times_ends" for="x_ends" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ends->caption() ?><?= $Page->ends->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ends->cellAttributes() ?>>
<span id="el_meal_times_ends">
<input type="<?= $Page->ends->getInputTextType() ?>" name="x_ends" id="x_ends" data-table="meal_times" data-field="x_ends" value="<?= $Page->ends->EditValue ?>" placeholder="<?= HtmlEncode($Page->ends->getPlaceHolder()) ?>"<?= $Page->ends->editAttributes() ?> aria-describedby="x_ends_help">
<?= $Page->ends->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ends->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->startu->Visible) { // startu ?>
    <div id="r_startu"<?= $Page->startu->rowAttributes() ?>>
        <label id="elh_meal_times_startu" for="x_startu" class="<?= $Page->LeftColumnClass ?>"><?= $Page->startu->caption() ?><?= $Page->startu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->startu->cellAttributes() ?>>
<span id="el_meal_times_startu">
<input type="<?= $Page->startu->getInputTextType() ?>" name="x_startu" id="x_startu" data-table="meal_times" data-field="x_startu" value="<?= $Page->startu->EditValue ?>" placeholder="<?= HtmlEncode($Page->startu->getPlaceHolder()) ?>"<?= $Page->startu->editAttributes() ?> aria-describedby="x_startu_help">
<?= $Page->startu->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->startu->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->endu->Visible) { // endu ?>
    <div id="r_endu"<?= $Page->endu->rowAttributes() ?>>
        <label id="elh_meal_times_endu" for="x_endu" class="<?= $Page->LeftColumnClass ?>"><?= $Page->endu->caption() ?><?= $Page->endu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->endu->cellAttributes() ?>>
<span id="el_meal_times_endu">
<input type="<?= $Page->endu->getInputTextType() ?>" name="x_endu" id="x_endu" data-table="meal_times" data-field="x_endu" value="<?= $Page->endu->EditValue ?>" placeholder="<?= HtmlEncode($Page->endu->getPlaceHolder()) ?>"<?= $Page->endu->editAttributes() ?> aria-describedby="x_endu_help">
<?= $Page->endu->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->endu->getErrorMessage() ?></div>
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
    ew.addEventHandlers("meal_times");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
