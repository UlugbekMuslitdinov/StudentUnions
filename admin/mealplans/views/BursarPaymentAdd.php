<?php

namespace PHPMaker2022\mealplans;

// Page object
$BursarPaymentAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { bursar_payment: currentTable } });
var currentForm, currentPageID;
var fbursar_paymentadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fbursar_paymentadd = new ew.Form("fbursar_paymentadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fbursar_paymentadd;

    // Add fields
    var fields = currentTable.fields;
    fbursar_paymentadd.addFields([
        ["emplid", [fields.emplid.visible && fields.emplid.required ? ew.Validators.required(fields.emplid.caption) : null, ew.Validators.integer], fields.emplid.isInvalid],
        ["subcode", [fields.subcode.visible && fields.subcode.required ? ew.Validators.required(fields.subcode.caption) : null], fields.subcode.isInvalid],
        ["term", [fields.term.visible && fields.term.required ? ew.Validators.required(fields.term.caption) : null, ew.Validators.integer], fields.term.isInvalid],
        ["bursars_amount", [fields.bursars_amount.visible && fields.bursars_amount.required ? ew.Validators.required(fields.bursars_amount.caption) : null, ew.Validators.float], fields.bursars_amount.isInvalid],
        ["_response", [fields._response.visible && fields._response.required ? ew.Validators.required(fields._response.caption) : null], fields._response.isInvalid],
        ["item_nbr", [fields.item_nbr.visible && fields.item_nbr.required ? ew.Validators.required(fields.item_nbr.caption) : null, ew.Validators.integer], fields.item_nbr.isInvalid],
        ["line_seq_no", [fields.line_seq_no.visible && fields.line_seq_no.required ? ew.Validators.required(fields.line_seq_no.caption) : null, ew.Validators.integer], fields.line_seq_no.isInvalid],
        ["transaction_time", [fields.transaction_time.visible && fields.transaction_time.required ? ew.Validators.required(fields.transaction_time.caption) : null, ew.Validators.datetime(fields.transaction_time.clientFormatPattern)], fields.transaction_time.isInvalid]
    ]);

    // Form_CustomValidate
    fbursar_paymentadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fbursar_paymentadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fbursar_paymentadd");
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
<form name="fbursar_paymentadd" id="fbursar_paymentadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="bursar_payment">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->emplid->Visible) { // emplid ?>
    <div id="r_emplid"<?= $Page->emplid->rowAttributes() ?>>
        <label id="elh_bursar_payment_emplid" for="x_emplid" class="<?= $Page->LeftColumnClass ?>"><?= $Page->emplid->caption() ?><?= $Page->emplid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->emplid->cellAttributes() ?>>
<span id="el_bursar_payment_emplid">
<input type="<?= $Page->emplid->getInputTextType() ?>" name="x_emplid" id="x_emplid" data-table="bursar_payment" data-field="x_emplid" value="<?= $Page->emplid->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->emplid->getPlaceHolder()) ?>"<?= $Page->emplid->editAttributes() ?> aria-describedby="x_emplid_help">
<?= $Page->emplid->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->emplid->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->subcode->Visible) { // subcode ?>
    <div id="r_subcode"<?= $Page->subcode->rowAttributes() ?>>
        <label id="elh_bursar_payment_subcode" for="x_subcode" class="<?= $Page->LeftColumnClass ?>"><?= $Page->subcode->caption() ?><?= $Page->subcode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->subcode->cellAttributes() ?>>
<span id="el_bursar_payment_subcode">
<input type="<?= $Page->subcode->getInputTextType() ?>" name="x_subcode" id="x_subcode" data-table="bursar_payment" data-field="x_subcode" value="<?= $Page->subcode->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->subcode->getPlaceHolder()) ?>"<?= $Page->subcode->editAttributes() ?> aria-describedby="x_subcode_help">
<?= $Page->subcode->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->subcode->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->term->Visible) { // term ?>
    <div id="r_term"<?= $Page->term->rowAttributes() ?>>
        <label id="elh_bursar_payment_term" for="x_term" class="<?= $Page->LeftColumnClass ?>"><?= $Page->term->caption() ?><?= $Page->term->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->term->cellAttributes() ?>>
<span id="el_bursar_payment_term">
<input type="<?= $Page->term->getInputTextType() ?>" name="x_term" id="x_term" data-table="bursar_payment" data-field="x_term" value="<?= $Page->term->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->term->getPlaceHolder()) ?>"<?= $Page->term->editAttributes() ?> aria-describedby="x_term_help">
<?= $Page->term->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->term->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bursars_amount->Visible) { // bursars_amount ?>
    <div id="r_bursars_amount"<?= $Page->bursars_amount->rowAttributes() ?>>
        <label id="elh_bursar_payment_bursars_amount" for="x_bursars_amount" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bursars_amount->caption() ?><?= $Page->bursars_amount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->bursars_amount->cellAttributes() ?>>
<span id="el_bursar_payment_bursars_amount">
<input type="<?= $Page->bursars_amount->getInputTextType() ?>" name="x_bursars_amount" id="x_bursars_amount" data-table="bursar_payment" data-field="x_bursars_amount" value="<?= $Page->bursars_amount->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->bursars_amount->getPlaceHolder()) ?>"<?= $Page->bursars_amount->editAttributes() ?> aria-describedby="x_bursars_amount_help">
<?= $Page->bursars_amount->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bursars_amount->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_response->Visible) { // response ?>
    <div id="r__response"<?= $Page->_response->rowAttributes() ?>>
        <label id="elh_bursar_payment__response" for="x__response" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_response->caption() ?><?= $Page->_response->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_response->cellAttributes() ?>>
<span id="el_bursar_payment__response">
<textarea data-table="bursar_payment" data-field="x__response" name="x__response" id="x__response" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->_response->getPlaceHolder()) ?>"<?= $Page->_response->editAttributes() ?> aria-describedby="x__response_help"><?= $Page->_response->EditValue ?></textarea>
<?= $Page->_response->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_response->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->item_nbr->Visible) { // item_nbr ?>
    <div id="r_item_nbr"<?= $Page->item_nbr->rowAttributes() ?>>
        <label id="elh_bursar_payment_item_nbr" for="x_item_nbr" class="<?= $Page->LeftColumnClass ?>"><?= $Page->item_nbr->caption() ?><?= $Page->item_nbr->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->item_nbr->cellAttributes() ?>>
<span id="el_bursar_payment_item_nbr">
<input type="<?= $Page->item_nbr->getInputTextType() ?>" name="x_item_nbr" id="x_item_nbr" data-table="bursar_payment" data-field="x_item_nbr" value="<?= $Page->item_nbr->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->item_nbr->getPlaceHolder()) ?>"<?= $Page->item_nbr->editAttributes() ?> aria-describedby="x_item_nbr_help">
<?= $Page->item_nbr->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->item_nbr->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->line_seq_no->Visible) { // line_seq_no ?>
    <div id="r_line_seq_no"<?= $Page->line_seq_no->rowAttributes() ?>>
        <label id="elh_bursar_payment_line_seq_no" for="x_line_seq_no" class="<?= $Page->LeftColumnClass ?>"><?= $Page->line_seq_no->caption() ?><?= $Page->line_seq_no->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->line_seq_no->cellAttributes() ?>>
<span id="el_bursar_payment_line_seq_no">
<input type="<?= $Page->line_seq_no->getInputTextType() ?>" name="x_line_seq_no" id="x_line_seq_no" data-table="bursar_payment" data-field="x_line_seq_no" value="<?= $Page->line_seq_no->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->line_seq_no->getPlaceHolder()) ?>"<?= $Page->line_seq_no->editAttributes() ?> aria-describedby="x_line_seq_no_help">
<?= $Page->line_seq_no->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->line_seq_no->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->transaction_time->Visible) { // transaction_time ?>
    <div id="r_transaction_time"<?= $Page->transaction_time->rowAttributes() ?>>
        <label id="elh_bursar_payment_transaction_time" for="x_transaction_time" class="<?= $Page->LeftColumnClass ?>"><?= $Page->transaction_time->caption() ?><?= $Page->transaction_time->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->transaction_time->cellAttributes() ?>>
<span id="el_bursar_payment_transaction_time">
<input type="<?= $Page->transaction_time->getInputTextType() ?>" name="x_transaction_time" id="x_transaction_time" data-table="bursar_payment" data-field="x_transaction_time" value="<?= $Page->transaction_time->EditValue ?>" placeholder="<?= HtmlEncode($Page->transaction_time->getPlaceHolder()) ?>"<?= $Page->transaction_time->editAttributes() ?> aria-describedby="x_transaction_time_help">
<?= $Page->transaction_time->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->transaction_time->getErrorMessage() ?></div>
<?php if (!$Page->transaction_time->ReadOnly && !$Page->transaction_time->Disabled && !isset($Page->transaction_time->EditAttrs["readonly"]) && !isset($Page->transaction_time->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbursar_paymentadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fbursar_paymentadd", "x_transaction_time", jQuery.extend(true, {"useCurrent":false}, options));
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
    ew.addEventHandlers("bursar_payment");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
