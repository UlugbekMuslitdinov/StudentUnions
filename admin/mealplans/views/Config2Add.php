<?php

namespace PHPMaker2022\mealplans;

// Page object
$Config2Add = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { config2: currentTable } });
var currentForm, currentPageID;
var fconfig2add;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fconfig2add = new ew.Form("fconfig2add", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fconfig2add;

    // Add fields
    var fields = currentTable.fields;
    fconfig2add.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null, ew.Validators.integer], fields.id.isInvalid],
        ["min_deposit", [fields.min_deposit.visible && fields.min_deposit.required ? ew.Validators.required(fields.min_deposit.caption) : null, ew.Validators.float], fields.min_deposit.isInvalid],
        ["max_deposit", [fields.max_deposit.visible && fields.max_deposit.required ? ew.Validators.required(fields.max_deposit.caption) : null, ew.Validators.float], fields.max_deposit.isInvalid],
        ["current_term_code", [fields.current_term_code.visible && fields.current_term_code.required ? ew.Validators.required(fields.current_term_code.caption) : null, ew.Validators.integer], fields.current_term_code.isInvalid],
        ["fall_term_code", [fields.fall_term_code.visible && fields.fall_term_code.required ? ew.Validators.required(fields.fall_term_code.caption) : null, ew.Validators.integer], fields.fall_term_code.isInvalid],
        ["spring_term_code", [fields.spring_term_code.visible && fields.spring_term_code.required ? ew.Validators.required(fields.spring_term_code.caption) : null, ew.Validators.integer], fields.spring_term_code.isInvalid],
        ["full_year_begin", [fields.full_year_begin.visible && fields.full_year_begin.required ? ew.Validators.required(fields.full_year_begin.caption) : null, ew.Validators.datetime(fields.full_year_begin.clientFormatPattern)], fields.full_year_begin.isInvalid],
        ["half_year_begin", [fields.half_year_begin.visible && fields.half_year_begin.required ? ew.Validators.required(fields.half_year_begin.caption) : null, ew.Validators.datetime(fields.half_year_begin.clientFormatPattern)], fields.half_year_begin.isInvalid],
        ["year_end", [fields.year_end.visible && fields.year_end.required ? ew.Validators.required(fields.year_end.caption) : null, ew.Validators.datetime(fields.year_end.clientFormatPattern)], fields.year_end.isInvalid],
        ["plus_signup_full", [fields.plus_signup_full.visible && fields.plus_signup_full.required ? ew.Validators.required(fields.plus_signup_full.caption) : null], fields.plus_signup_full.isInvalid],
        ["plus_signup_half", [fields.plus_signup_half.visible && fields.plus_signup_half.required ? ew.Validators.required(fields.plus_signup_half.caption) : null], fields.plus_signup_half.isInvalid],
        ["bursar_deposit_deadline", [fields.bursar_deposit_deadline.visible && fields.bursar_deposit_deadline.required ? ew.Validators.required(fields.bursar_deposit_deadline.caption) : null, ew.Validators.datetime(fields.bursar_deposit_deadline.clientFormatPattern)], fields.bursar_deposit_deadline.isInvalid]
    ]);

    // Form_CustomValidate
    fconfig2add.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fconfig2add.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fconfig2add.lists.plus_signup_full = <?= $Page->plus_signup_full->toClientList($Page) ?>;
    fconfig2add.lists.plus_signup_half = <?= $Page->plus_signup_half->toClientList($Page) ?>;
    loadjs.done("fconfig2add");
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
<form name="fconfig2add" id="fconfig2add" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="config2">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_config2_id" for="x_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_config2_id">
<input type="<?= $Page->id->getInputTextType() ?>" name="x_id" id="x_id" data-table="config2" data-field="x_id" value="<?= $Page->id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>"<?= $Page->id->editAttributes() ?> aria-describedby="x_id_help">
<?= $Page->id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->min_deposit->Visible) { // min_deposit ?>
    <div id="r_min_deposit"<?= $Page->min_deposit->rowAttributes() ?>>
        <label id="elh_config2_min_deposit" for="x_min_deposit" class="<?= $Page->LeftColumnClass ?>"><?= $Page->min_deposit->caption() ?><?= $Page->min_deposit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->min_deposit->cellAttributes() ?>>
<span id="el_config2_min_deposit">
<input type="<?= $Page->min_deposit->getInputTextType() ?>" name="x_min_deposit" id="x_min_deposit" data-table="config2" data-field="x_min_deposit" value="<?= $Page->min_deposit->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->min_deposit->getPlaceHolder()) ?>"<?= $Page->min_deposit->editAttributes() ?> aria-describedby="x_min_deposit_help">
<?= $Page->min_deposit->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->min_deposit->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_deposit->Visible) { // max_deposit ?>
    <div id="r_max_deposit"<?= $Page->max_deposit->rowAttributes() ?>>
        <label id="elh_config2_max_deposit" for="x_max_deposit" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_deposit->caption() ?><?= $Page->max_deposit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->max_deposit->cellAttributes() ?>>
<span id="el_config2_max_deposit">
<input type="<?= $Page->max_deposit->getInputTextType() ?>" name="x_max_deposit" id="x_max_deposit" data-table="config2" data-field="x_max_deposit" value="<?= $Page->max_deposit->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->max_deposit->getPlaceHolder()) ?>"<?= $Page->max_deposit->editAttributes() ?> aria-describedby="x_max_deposit_help">
<?= $Page->max_deposit->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_deposit->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->current_term_code->Visible) { // current_term_code ?>
    <div id="r_current_term_code"<?= $Page->current_term_code->rowAttributes() ?>>
        <label id="elh_config2_current_term_code" for="x_current_term_code" class="<?= $Page->LeftColumnClass ?>"><?= $Page->current_term_code->caption() ?><?= $Page->current_term_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->current_term_code->cellAttributes() ?>>
<span id="el_config2_current_term_code">
<input type="<?= $Page->current_term_code->getInputTextType() ?>" name="x_current_term_code" id="x_current_term_code" data-table="config2" data-field="x_current_term_code" value="<?= $Page->current_term_code->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->current_term_code->getPlaceHolder()) ?>"<?= $Page->current_term_code->editAttributes() ?> aria-describedby="x_current_term_code_help">
<?= $Page->current_term_code->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->current_term_code->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->fall_term_code->Visible) { // fall_term_code ?>
    <div id="r_fall_term_code"<?= $Page->fall_term_code->rowAttributes() ?>>
        <label id="elh_config2_fall_term_code" for="x_fall_term_code" class="<?= $Page->LeftColumnClass ?>"><?= $Page->fall_term_code->caption() ?><?= $Page->fall_term_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->fall_term_code->cellAttributes() ?>>
<span id="el_config2_fall_term_code">
<input type="<?= $Page->fall_term_code->getInputTextType() ?>" name="x_fall_term_code" id="x_fall_term_code" data-table="config2" data-field="x_fall_term_code" value="<?= $Page->fall_term_code->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->fall_term_code->getPlaceHolder()) ?>"<?= $Page->fall_term_code->editAttributes() ?> aria-describedby="x_fall_term_code_help">
<?= $Page->fall_term_code->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->fall_term_code->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->spring_term_code->Visible) { // spring_term_code ?>
    <div id="r_spring_term_code"<?= $Page->spring_term_code->rowAttributes() ?>>
        <label id="elh_config2_spring_term_code" for="x_spring_term_code" class="<?= $Page->LeftColumnClass ?>"><?= $Page->spring_term_code->caption() ?><?= $Page->spring_term_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->spring_term_code->cellAttributes() ?>>
<span id="el_config2_spring_term_code">
<input type="<?= $Page->spring_term_code->getInputTextType() ?>" name="x_spring_term_code" id="x_spring_term_code" data-table="config2" data-field="x_spring_term_code" value="<?= $Page->spring_term_code->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->spring_term_code->getPlaceHolder()) ?>"<?= $Page->spring_term_code->editAttributes() ?> aria-describedby="x_spring_term_code_help">
<?= $Page->spring_term_code->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->spring_term_code->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->full_year_begin->Visible) { // full_year_begin ?>
    <div id="r_full_year_begin"<?= $Page->full_year_begin->rowAttributes() ?>>
        <label id="elh_config2_full_year_begin" for="x_full_year_begin" class="<?= $Page->LeftColumnClass ?>"><?= $Page->full_year_begin->caption() ?><?= $Page->full_year_begin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->full_year_begin->cellAttributes() ?>>
<span id="el_config2_full_year_begin">
<input type="<?= $Page->full_year_begin->getInputTextType() ?>" name="x_full_year_begin" id="x_full_year_begin" data-table="config2" data-field="x_full_year_begin" value="<?= $Page->full_year_begin->EditValue ?>" placeholder="<?= HtmlEncode($Page->full_year_begin->getPlaceHolder()) ?>"<?= $Page->full_year_begin->editAttributes() ?> aria-describedby="x_full_year_begin_help">
<?= $Page->full_year_begin->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->full_year_begin->getErrorMessage() ?></div>
<?php if (!$Page->full_year_begin->ReadOnly && !$Page->full_year_begin->Disabled && !isset($Page->full_year_begin->EditAttrs["readonly"]) && !isset($Page->full_year_begin->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fconfig2add", "datetimepicker"], function () {
    let options = {
        localization: {
            locale: ew.LANGUAGE_ID
        },
        display: {
            inputFormat: "<?= DateFormat(0) ?>",
            icons: {
                previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
            }
        }
    };
    ew.createDateTimePicker("fconfig2add", "x_full_year_begin", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->half_year_begin->Visible) { // half_year_begin ?>
    <div id="r_half_year_begin"<?= $Page->half_year_begin->rowAttributes() ?>>
        <label id="elh_config2_half_year_begin" for="x_half_year_begin" class="<?= $Page->LeftColumnClass ?>"><?= $Page->half_year_begin->caption() ?><?= $Page->half_year_begin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->half_year_begin->cellAttributes() ?>>
<span id="el_config2_half_year_begin">
<input type="<?= $Page->half_year_begin->getInputTextType() ?>" name="x_half_year_begin" id="x_half_year_begin" data-table="config2" data-field="x_half_year_begin" value="<?= $Page->half_year_begin->EditValue ?>" placeholder="<?= HtmlEncode($Page->half_year_begin->getPlaceHolder()) ?>"<?= $Page->half_year_begin->editAttributes() ?> aria-describedby="x_half_year_begin_help">
<?= $Page->half_year_begin->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->half_year_begin->getErrorMessage() ?></div>
<?php if (!$Page->half_year_begin->ReadOnly && !$Page->half_year_begin->Disabled && !isset($Page->half_year_begin->EditAttrs["readonly"]) && !isset($Page->half_year_begin->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fconfig2add", "datetimepicker"], function () {
    let options = {
        localization: {
            locale: ew.LANGUAGE_ID
        },
        display: {
            inputFormat: "<?= DateFormat(0) ?>",
            icons: {
                previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
            }
        }
    };
    ew.createDateTimePicker("fconfig2add", "x_half_year_begin", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->year_end->Visible) { // year_end ?>
    <div id="r_year_end"<?= $Page->year_end->rowAttributes() ?>>
        <label id="elh_config2_year_end" for="x_year_end" class="<?= $Page->LeftColumnClass ?>"><?= $Page->year_end->caption() ?><?= $Page->year_end->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->year_end->cellAttributes() ?>>
<span id="el_config2_year_end">
<input type="<?= $Page->year_end->getInputTextType() ?>" name="x_year_end" id="x_year_end" data-table="config2" data-field="x_year_end" value="<?= $Page->year_end->EditValue ?>" placeholder="<?= HtmlEncode($Page->year_end->getPlaceHolder()) ?>"<?= $Page->year_end->editAttributes() ?> aria-describedby="x_year_end_help">
<?= $Page->year_end->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->year_end->getErrorMessage() ?></div>
<?php if (!$Page->year_end->ReadOnly && !$Page->year_end->Disabled && !isset($Page->year_end->EditAttrs["readonly"]) && !isset($Page->year_end->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fconfig2add", "datetimepicker"], function () {
    let options = {
        localization: {
            locale: ew.LANGUAGE_ID
        },
        display: {
            inputFormat: "<?= DateFormat(0) ?>",
            icons: {
                previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
            }
        }
    };
    ew.createDateTimePicker("fconfig2add", "x_year_end", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->plus_signup_full->Visible) { // plus_signup_full ?>
    <div id="r_plus_signup_full"<?= $Page->plus_signup_full->rowAttributes() ?>>
        <label id="elh_config2_plus_signup_full" class="<?= $Page->LeftColumnClass ?>"><?= $Page->plus_signup_full->caption() ?><?= $Page->plus_signup_full->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->plus_signup_full->cellAttributes() ?>>
<span id="el_config2_plus_signup_full">
<div class="form-check d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->plus_signup_full->isInvalidClass() ?>" data-table="config2" data-field="x_plus_signup_full" name="x_plus_signup_full[]" id="x_plus_signup_full_252473" value="1"<?= ConvertToBool($Page->plus_signup_full->CurrentValue) ? " checked" : "" ?><?= $Page->plus_signup_full->editAttributes() ?> aria-describedby="x_plus_signup_full_help">
    <div class="invalid-feedback"><?= $Page->plus_signup_full->getErrorMessage() ?></div>
</div>
<?= $Page->plus_signup_full->getCustomMessage() ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->plus_signup_half->Visible) { // plus_signup_half ?>
    <div id="r_plus_signup_half"<?= $Page->plus_signup_half->rowAttributes() ?>>
        <label id="elh_config2_plus_signup_half" class="<?= $Page->LeftColumnClass ?>"><?= $Page->plus_signup_half->caption() ?><?= $Page->plus_signup_half->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->plus_signup_half->cellAttributes() ?>>
<span id="el_config2_plus_signup_half">
<div class="form-check d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->plus_signup_half->isInvalidClass() ?>" data-table="config2" data-field="x_plus_signup_half" name="x_plus_signup_half[]" id="x_plus_signup_half_146365" value="1"<?= ConvertToBool($Page->plus_signup_half->CurrentValue) ? " checked" : "" ?><?= $Page->plus_signup_half->editAttributes() ?> aria-describedby="x_plus_signup_half_help">
    <div class="invalid-feedback"><?= $Page->plus_signup_half->getErrorMessage() ?></div>
</div>
<?= $Page->plus_signup_half->getCustomMessage() ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bursar_deposit_deadline->Visible) { // bursar_deposit_deadline ?>
    <div id="r_bursar_deposit_deadline"<?= $Page->bursar_deposit_deadline->rowAttributes() ?>>
        <label id="elh_config2_bursar_deposit_deadline" for="x_bursar_deposit_deadline" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bursar_deposit_deadline->caption() ?><?= $Page->bursar_deposit_deadline->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->bursar_deposit_deadline->cellAttributes() ?>>
<span id="el_config2_bursar_deposit_deadline">
<input type="<?= $Page->bursar_deposit_deadline->getInputTextType() ?>" name="x_bursar_deposit_deadline" id="x_bursar_deposit_deadline" data-table="config2" data-field="x_bursar_deposit_deadline" value="<?= $Page->bursar_deposit_deadline->EditValue ?>" placeholder="<?= HtmlEncode($Page->bursar_deposit_deadline->getPlaceHolder()) ?>"<?= $Page->bursar_deposit_deadline->editAttributes() ?> aria-describedby="x_bursar_deposit_deadline_help">
<?= $Page->bursar_deposit_deadline->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bursar_deposit_deadline->getErrorMessage() ?></div>
<?php if (!$Page->bursar_deposit_deadline->ReadOnly && !$Page->bursar_deposit_deadline->Disabled && !isset($Page->bursar_deposit_deadline->EditAttrs["readonly"]) && !isset($Page->bursar_deposit_deadline->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fconfig2add", "datetimepicker"], function () {
    let options = {
        localization: {
            locale: ew.LANGUAGE_ID
        },
        display: {
            inputFormat: "<?= DateFormat(0) ?>",
            icons: {
                previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
            }
        }
    };
    ew.createDateTimePicker("fconfig2add", "x_bursar_deposit_deadline", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
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
    ew.addEventHandlers("config2");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
