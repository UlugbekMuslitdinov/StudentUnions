<?php

namespace PHPMaker2022\project3;

// Page object
$HoursCateringAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { hours_catering: currentTable } });
var currentForm, currentPageID;
var fhours_cateringadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fhours_cateringadd = new ew.Form("fhours_cateringadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fhours_cateringadd;

    // Add fields
    var fields = currentTable.fields;
    fhours_cateringadd.addFields([
        ["location_id", [fields.location_id.visible && fields.location_id.required ? ew.Validators.required(fields.location_id.caption) : null, ew.Validators.integer], fields.location_id.isInvalid],
        ["day_from", [fields.day_from.visible && fields.day_from.required ? ew.Validators.required(fields.day_from.caption) : null], fields.day_from.isInvalid],
        ["day_to", [fields.day_to.visible && fields.day_to.required ? ew.Validators.required(fields.day_to.caption) : null], fields.day_to.isInvalid],
        ["time_from", [fields.time_from.visible && fields.time_from.required ? ew.Validators.required(fields.time_from.caption) : null], fields.time_from.isInvalid],
        ["time_to", [fields.time_to.visible && fields.time_to.required ? ew.Validators.required(fields.time_to.caption) : null], fields.time_to.isInvalid]
    ]);

    // Form_CustomValidate
    fhours_cateringadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fhours_cateringadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fhours_cateringadd");
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
<form name="fhours_cateringadd" id="fhours_cateringadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="hours_catering">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->location_id->Visible) { // location_id ?>
    <div id="r_location_id"<?= $Page->location_id->rowAttributes() ?>>
        <label id="elh_hours_catering_location_id" for="x_location_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->location_id->caption() ?><?= $Page->location_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->location_id->cellAttributes() ?>>
<span id="el_hours_catering_location_id">
<input type="<?= $Page->location_id->getInputTextType() ?>" name="x_location_id" id="x_location_id" data-table="hours_catering" data-field="x_location_id" value="<?= $Page->location_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->location_id->getPlaceHolder()) ?>"<?= $Page->location_id->editAttributes() ?> aria-describedby="x_location_id_help">
<?= $Page->location_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->location_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->day_from->Visible) { // day_from ?>
    <div id="r_day_from"<?= $Page->day_from->rowAttributes() ?>>
        <label id="elh_hours_catering_day_from" for="x_day_from" class="<?= $Page->LeftColumnClass ?>"><?= $Page->day_from->caption() ?><?= $Page->day_from->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->day_from->cellAttributes() ?>>
<span id="el_hours_catering_day_from">
<input type="<?= $Page->day_from->getInputTextType() ?>" name="x_day_from" id="x_day_from" data-table="hours_catering" data-field="x_day_from" value="<?= $Page->day_from->EditValue ?>" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->day_from->getPlaceHolder()) ?>"<?= $Page->day_from->editAttributes() ?> aria-describedby="x_day_from_help">
<?= $Page->day_from->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->day_from->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->day_to->Visible) { // day_to ?>
    <div id="r_day_to"<?= $Page->day_to->rowAttributes() ?>>
        <label id="elh_hours_catering_day_to" for="x_day_to" class="<?= $Page->LeftColumnClass ?>"><?= $Page->day_to->caption() ?><?= $Page->day_to->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->day_to->cellAttributes() ?>>
<span id="el_hours_catering_day_to">
<input type="<?= $Page->day_to->getInputTextType() ?>" name="x_day_to" id="x_day_to" data-table="hours_catering" data-field="x_day_to" value="<?= $Page->day_to->EditValue ?>" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->day_to->getPlaceHolder()) ?>"<?= $Page->day_to->editAttributes() ?> aria-describedby="x_day_to_help">
<?= $Page->day_to->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->day_to->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->time_from->Visible) { // time_from ?>
    <div id="r_time_from"<?= $Page->time_from->rowAttributes() ?>>
        <label id="elh_hours_catering_time_from" for="x_time_from" class="<?= $Page->LeftColumnClass ?>"><?= $Page->time_from->caption() ?><?= $Page->time_from->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->time_from->cellAttributes() ?>>
<span id="el_hours_catering_time_from">
<input type="<?= $Page->time_from->getInputTextType() ?>" name="x_time_from" id="x_time_from" data-table="hours_catering" data-field="x_time_from" value="<?= $Page->time_from->EditValue ?>" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->time_from->getPlaceHolder()) ?>"<?= $Page->time_from->editAttributes() ?> aria-describedby="x_time_from_help">
<?= $Page->time_from->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->time_from->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->time_to->Visible) { // time_to ?>
    <div id="r_time_to"<?= $Page->time_to->rowAttributes() ?>>
        <label id="elh_hours_catering_time_to" for="x_time_to" class="<?= $Page->LeftColumnClass ?>"><?= $Page->time_to->caption() ?><?= $Page->time_to->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->time_to->cellAttributes() ?>>
<span id="el_hours_catering_time_to">
<input type="<?= $Page->time_to->getInputTextType() ?>" name="x_time_to" id="x_time_to" data-table="hours_catering" data-field="x_time_to" value="<?= $Page->time_to->EditValue ?>" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->time_to->getPlaceHolder()) ?>"<?= $Page->time_to->editAttributes() ?> aria-describedby="x_time_to_help">
<?= $Page->time_to->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->time_to->getErrorMessage() ?></div>
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
    ew.addEventHandlers("hours_catering");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
