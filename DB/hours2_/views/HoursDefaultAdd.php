<?php

namespace PHPMaker2022\project1;

// Page object
$HoursDefaultAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { hours_default: currentTable } });
var currentForm, currentPageID;
var fhours_defaultadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fhours_defaultadd = new ew.Form("fhours_defaultadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fhours_defaultadd;

    // Add fields
    var fields = currentTable.fields;
    fhours_defaultadd.addFields([
        ["hour_id", [fields.hour_id.visible && fields.hour_id.required ? ew.Validators.required(fields.hour_id.caption) : null, ew.Validators.integer], fields.hour_id.isInvalid],
        ["mon_open", [fields.mon_open.visible && fields.mon_open.required ? ew.Validators.required(fields.mon_open.caption) : null, ew.Validators.time(fields.mon_open.clientFormatPattern)], fields.mon_open.isInvalid],
        ["mon_close", [fields.mon_close.visible && fields.mon_close.required ? ew.Validators.required(fields.mon_close.caption) : null, ew.Validators.time(fields.mon_close.clientFormatPattern)], fields.mon_close.isInvalid],
        ["tue_open", [fields.tue_open.visible && fields.tue_open.required ? ew.Validators.required(fields.tue_open.caption) : null, ew.Validators.time(fields.tue_open.clientFormatPattern)], fields.tue_open.isInvalid],
        ["tue_close", [fields.tue_close.visible && fields.tue_close.required ? ew.Validators.required(fields.tue_close.caption) : null, ew.Validators.time(fields.tue_close.clientFormatPattern)], fields.tue_close.isInvalid],
        ["wed_open", [fields.wed_open.visible && fields.wed_open.required ? ew.Validators.required(fields.wed_open.caption) : null, ew.Validators.time(fields.wed_open.clientFormatPattern)], fields.wed_open.isInvalid],
        ["wed_close", [fields.wed_close.visible && fields.wed_close.required ? ew.Validators.required(fields.wed_close.caption) : null, ew.Validators.time(fields.wed_close.clientFormatPattern)], fields.wed_close.isInvalid],
        ["thu_open", [fields.thu_open.visible && fields.thu_open.required ? ew.Validators.required(fields.thu_open.caption) : null, ew.Validators.time(fields.thu_open.clientFormatPattern)], fields.thu_open.isInvalid],
        ["thu_close", [fields.thu_close.visible && fields.thu_close.required ? ew.Validators.required(fields.thu_close.caption) : null, ew.Validators.time(fields.thu_close.clientFormatPattern)], fields.thu_close.isInvalid],
        ["fri_open", [fields.fri_open.visible && fields.fri_open.required ? ew.Validators.required(fields.fri_open.caption) : null, ew.Validators.time(fields.fri_open.clientFormatPattern)], fields.fri_open.isInvalid],
        ["fri_close", [fields.fri_close.visible && fields.fri_close.required ? ew.Validators.required(fields.fri_close.caption) : null, ew.Validators.time(fields.fri_close.clientFormatPattern)], fields.fri_close.isInvalid],
        ["sat_open", [fields.sat_open.visible && fields.sat_open.required ? ew.Validators.required(fields.sat_open.caption) : null, ew.Validators.time(fields.sat_open.clientFormatPattern)], fields.sat_open.isInvalid],
        ["sat_close", [fields.sat_close.visible && fields.sat_close.required ? ew.Validators.required(fields.sat_close.caption) : null, ew.Validators.time(fields.sat_close.clientFormatPattern)], fields.sat_close.isInvalid],
        ["sun_open", [fields.sun_open.visible && fields.sun_open.required ? ew.Validators.required(fields.sun_open.caption) : null, ew.Validators.time(fields.sun_open.clientFormatPattern)], fields.sun_open.isInvalid],
        ["sun_close", [fields.sun_close.visible && fields.sun_close.required ? ew.Validators.required(fields.sun_close.caption) : null, ew.Validators.time(fields.sun_close.clientFormatPattern)], fields.sun_close.isInvalid],
        ["close", [fields.close.visible && fields.close.required ? ew.Validators.required(fields.close.caption) : null], fields.close.isInvalid]
    ]);

    // Form_CustomValidate
    fhours_defaultadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fhours_defaultadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fhours_defaultadd");
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
<form name="fhours_defaultadd" id="fhours_defaultadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="hours_default">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->hour_id->Visible) { // hour_id ?>
    <div id="r_hour_id"<?= $Page->hour_id->rowAttributes() ?>>
        <label id="elh_hours_default_hour_id" for="x_hour_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->hour_id->caption() ?><?= $Page->hour_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->hour_id->cellAttributes() ?>>
<span id="el_hours_default_hour_id">
<input type="<?= $Page->hour_id->getInputTextType() ?>" name="x_hour_id" id="x_hour_id" data-table="hours_default" data-field="x_hour_id" value="<?= $Page->hour_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->hour_id->getPlaceHolder()) ?>"<?= $Page->hour_id->editAttributes() ?> aria-describedby="x_hour_id_help">
<?= $Page->hour_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->hour_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->mon_open->Visible) { // mon_open ?>
    <div id="r_mon_open"<?= $Page->mon_open->rowAttributes() ?>>
        <label id="elh_hours_default_mon_open" for="x_mon_open" class="<?= $Page->LeftColumnClass ?>"><?= $Page->mon_open->caption() ?><?= $Page->mon_open->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->mon_open->cellAttributes() ?>>
<span id="el_hours_default_mon_open">
<input type="<?= $Page->mon_open->getInputTextType() ?>" name="x_mon_open" id="x_mon_open" data-table="hours_default" data-field="x_mon_open" value="<?= $Page->mon_open->EditValue ?>" placeholder="<?= HtmlEncode($Page->mon_open->getPlaceHolder()) ?>"<?= $Page->mon_open->editAttributes() ?> aria-describedby="x_mon_open_help">
<?= $Page->mon_open->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->mon_open->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->mon_close->Visible) { // mon_close ?>
    <div id="r_mon_close"<?= $Page->mon_close->rowAttributes() ?>>
        <label id="elh_hours_default_mon_close" for="x_mon_close" class="<?= $Page->LeftColumnClass ?>"><?= $Page->mon_close->caption() ?><?= $Page->mon_close->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->mon_close->cellAttributes() ?>>
<span id="el_hours_default_mon_close">
<input type="<?= $Page->mon_close->getInputTextType() ?>" name="x_mon_close" id="x_mon_close" data-table="hours_default" data-field="x_mon_close" value="<?= $Page->mon_close->EditValue ?>" placeholder="<?= HtmlEncode($Page->mon_close->getPlaceHolder()) ?>"<?= $Page->mon_close->editAttributes() ?> aria-describedby="x_mon_close_help">
<?= $Page->mon_close->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->mon_close->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tue_open->Visible) { // tue_open ?>
    <div id="r_tue_open"<?= $Page->tue_open->rowAttributes() ?>>
        <label id="elh_hours_default_tue_open" for="x_tue_open" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tue_open->caption() ?><?= $Page->tue_open->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tue_open->cellAttributes() ?>>
<span id="el_hours_default_tue_open">
<input type="<?= $Page->tue_open->getInputTextType() ?>" name="x_tue_open" id="x_tue_open" data-table="hours_default" data-field="x_tue_open" value="<?= $Page->tue_open->EditValue ?>" placeholder="<?= HtmlEncode($Page->tue_open->getPlaceHolder()) ?>"<?= $Page->tue_open->editAttributes() ?> aria-describedby="x_tue_open_help">
<?= $Page->tue_open->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tue_open->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tue_close->Visible) { // tue_close ?>
    <div id="r_tue_close"<?= $Page->tue_close->rowAttributes() ?>>
        <label id="elh_hours_default_tue_close" for="x_tue_close" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tue_close->caption() ?><?= $Page->tue_close->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tue_close->cellAttributes() ?>>
<span id="el_hours_default_tue_close">
<input type="<?= $Page->tue_close->getInputTextType() ?>" name="x_tue_close" id="x_tue_close" data-table="hours_default" data-field="x_tue_close" value="<?= $Page->tue_close->EditValue ?>" placeholder="<?= HtmlEncode($Page->tue_close->getPlaceHolder()) ?>"<?= $Page->tue_close->editAttributes() ?> aria-describedby="x_tue_close_help">
<?= $Page->tue_close->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tue_close->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->wed_open->Visible) { // wed_open ?>
    <div id="r_wed_open"<?= $Page->wed_open->rowAttributes() ?>>
        <label id="elh_hours_default_wed_open" for="x_wed_open" class="<?= $Page->LeftColumnClass ?>"><?= $Page->wed_open->caption() ?><?= $Page->wed_open->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->wed_open->cellAttributes() ?>>
<span id="el_hours_default_wed_open">
<input type="<?= $Page->wed_open->getInputTextType() ?>" name="x_wed_open" id="x_wed_open" data-table="hours_default" data-field="x_wed_open" value="<?= $Page->wed_open->EditValue ?>" placeholder="<?= HtmlEncode($Page->wed_open->getPlaceHolder()) ?>"<?= $Page->wed_open->editAttributes() ?> aria-describedby="x_wed_open_help">
<?= $Page->wed_open->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->wed_open->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->wed_close->Visible) { // wed_close ?>
    <div id="r_wed_close"<?= $Page->wed_close->rowAttributes() ?>>
        <label id="elh_hours_default_wed_close" for="x_wed_close" class="<?= $Page->LeftColumnClass ?>"><?= $Page->wed_close->caption() ?><?= $Page->wed_close->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->wed_close->cellAttributes() ?>>
<span id="el_hours_default_wed_close">
<input type="<?= $Page->wed_close->getInputTextType() ?>" name="x_wed_close" id="x_wed_close" data-table="hours_default" data-field="x_wed_close" value="<?= $Page->wed_close->EditValue ?>" placeholder="<?= HtmlEncode($Page->wed_close->getPlaceHolder()) ?>"<?= $Page->wed_close->editAttributes() ?> aria-describedby="x_wed_close_help">
<?= $Page->wed_close->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->wed_close->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->thu_open->Visible) { // thu_open ?>
    <div id="r_thu_open"<?= $Page->thu_open->rowAttributes() ?>>
        <label id="elh_hours_default_thu_open" for="x_thu_open" class="<?= $Page->LeftColumnClass ?>"><?= $Page->thu_open->caption() ?><?= $Page->thu_open->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->thu_open->cellAttributes() ?>>
<span id="el_hours_default_thu_open">
<input type="<?= $Page->thu_open->getInputTextType() ?>" name="x_thu_open" id="x_thu_open" data-table="hours_default" data-field="x_thu_open" value="<?= $Page->thu_open->EditValue ?>" placeholder="<?= HtmlEncode($Page->thu_open->getPlaceHolder()) ?>"<?= $Page->thu_open->editAttributes() ?> aria-describedby="x_thu_open_help">
<?= $Page->thu_open->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->thu_open->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->thu_close->Visible) { // thu_close ?>
    <div id="r_thu_close"<?= $Page->thu_close->rowAttributes() ?>>
        <label id="elh_hours_default_thu_close" for="x_thu_close" class="<?= $Page->LeftColumnClass ?>"><?= $Page->thu_close->caption() ?><?= $Page->thu_close->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->thu_close->cellAttributes() ?>>
<span id="el_hours_default_thu_close">
<input type="<?= $Page->thu_close->getInputTextType() ?>" name="x_thu_close" id="x_thu_close" data-table="hours_default" data-field="x_thu_close" value="<?= $Page->thu_close->EditValue ?>" placeholder="<?= HtmlEncode($Page->thu_close->getPlaceHolder()) ?>"<?= $Page->thu_close->editAttributes() ?> aria-describedby="x_thu_close_help">
<?= $Page->thu_close->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->thu_close->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->fri_open->Visible) { // fri_open ?>
    <div id="r_fri_open"<?= $Page->fri_open->rowAttributes() ?>>
        <label id="elh_hours_default_fri_open" for="x_fri_open" class="<?= $Page->LeftColumnClass ?>"><?= $Page->fri_open->caption() ?><?= $Page->fri_open->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->fri_open->cellAttributes() ?>>
<span id="el_hours_default_fri_open">
<input type="<?= $Page->fri_open->getInputTextType() ?>" name="x_fri_open" id="x_fri_open" data-table="hours_default" data-field="x_fri_open" value="<?= $Page->fri_open->EditValue ?>" placeholder="<?= HtmlEncode($Page->fri_open->getPlaceHolder()) ?>"<?= $Page->fri_open->editAttributes() ?> aria-describedby="x_fri_open_help">
<?= $Page->fri_open->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->fri_open->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->fri_close->Visible) { // fri_close ?>
    <div id="r_fri_close"<?= $Page->fri_close->rowAttributes() ?>>
        <label id="elh_hours_default_fri_close" for="x_fri_close" class="<?= $Page->LeftColumnClass ?>"><?= $Page->fri_close->caption() ?><?= $Page->fri_close->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->fri_close->cellAttributes() ?>>
<span id="el_hours_default_fri_close">
<input type="<?= $Page->fri_close->getInputTextType() ?>" name="x_fri_close" id="x_fri_close" data-table="hours_default" data-field="x_fri_close" value="<?= $Page->fri_close->EditValue ?>" placeholder="<?= HtmlEncode($Page->fri_close->getPlaceHolder()) ?>"<?= $Page->fri_close->editAttributes() ?> aria-describedby="x_fri_close_help">
<?= $Page->fri_close->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->fri_close->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sat_open->Visible) { // sat_open ?>
    <div id="r_sat_open"<?= $Page->sat_open->rowAttributes() ?>>
        <label id="elh_hours_default_sat_open" for="x_sat_open" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sat_open->caption() ?><?= $Page->sat_open->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sat_open->cellAttributes() ?>>
<span id="el_hours_default_sat_open">
<input type="<?= $Page->sat_open->getInputTextType() ?>" name="x_sat_open" id="x_sat_open" data-table="hours_default" data-field="x_sat_open" value="<?= $Page->sat_open->EditValue ?>" placeholder="<?= HtmlEncode($Page->sat_open->getPlaceHolder()) ?>"<?= $Page->sat_open->editAttributes() ?> aria-describedby="x_sat_open_help">
<?= $Page->sat_open->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sat_open->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sat_close->Visible) { // sat_close ?>
    <div id="r_sat_close"<?= $Page->sat_close->rowAttributes() ?>>
        <label id="elh_hours_default_sat_close" for="x_sat_close" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sat_close->caption() ?><?= $Page->sat_close->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sat_close->cellAttributes() ?>>
<span id="el_hours_default_sat_close">
<input type="<?= $Page->sat_close->getInputTextType() ?>" name="x_sat_close" id="x_sat_close" data-table="hours_default" data-field="x_sat_close" value="<?= $Page->sat_close->EditValue ?>" placeholder="<?= HtmlEncode($Page->sat_close->getPlaceHolder()) ?>"<?= $Page->sat_close->editAttributes() ?> aria-describedby="x_sat_close_help">
<?= $Page->sat_close->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sat_close->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sun_open->Visible) { // sun_open ?>
    <div id="r_sun_open"<?= $Page->sun_open->rowAttributes() ?>>
        <label id="elh_hours_default_sun_open" for="x_sun_open" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sun_open->caption() ?><?= $Page->sun_open->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sun_open->cellAttributes() ?>>
<span id="el_hours_default_sun_open">
<input type="<?= $Page->sun_open->getInputTextType() ?>" name="x_sun_open" id="x_sun_open" data-table="hours_default" data-field="x_sun_open" value="<?= $Page->sun_open->EditValue ?>" placeholder="<?= HtmlEncode($Page->sun_open->getPlaceHolder()) ?>"<?= $Page->sun_open->editAttributes() ?> aria-describedby="x_sun_open_help">
<?= $Page->sun_open->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sun_open->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sun_close->Visible) { // sun_close ?>
    <div id="r_sun_close"<?= $Page->sun_close->rowAttributes() ?>>
        <label id="elh_hours_default_sun_close" for="x_sun_close" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sun_close->caption() ?><?= $Page->sun_close->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sun_close->cellAttributes() ?>>
<span id="el_hours_default_sun_close">
<input type="<?= $Page->sun_close->getInputTextType() ?>" name="x_sun_close" id="x_sun_close" data-table="hours_default" data-field="x_sun_close" value="<?= $Page->sun_close->EditValue ?>" placeholder="<?= HtmlEncode($Page->sun_close->getPlaceHolder()) ?>"<?= $Page->sun_close->editAttributes() ?> aria-describedby="x_sun_close_help">
<?= $Page->sun_close->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sun_close->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->close->Visible) { // close ?>
    <div id="r_close"<?= $Page->close->rowAttributes() ?>>
        <label id="elh_hours_default_close" for="x_close" class="<?= $Page->LeftColumnClass ?>"><?= $Page->close->caption() ?><?= $Page->close->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->close->cellAttributes() ?>>
<span id="el_hours_default_close">
<input type="<?= $Page->close->getInputTextType() ?>" name="x_close" id="x_close" data-table="hours_default" data-field="x_close" value="<?= $Page->close->EditValue ?>" size="30" maxlength="6" placeholder="<?= HtmlEncode($Page->close->getPlaceHolder()) ?>"<?= $Page->close->editAttributes() ?> aria-describedby="x_close_help">
<?= $Page->close->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->close->getErrorMessage() ?></div>
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
    ew.addEventHandlers("hours_default");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
