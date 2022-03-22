<?php

namespace PHPMaker2022\project1;

// Page object
$LocationDescriptionsEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { location_descriptions: currentTable } });
var currentForm, currentPageID;
var flocation_descriptionsedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    flocation_descriptionsedit = new ew.Form("flocation_descriptionsedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = flocation_descriptionsedit;

    // Add fields
    var fields = currentTable.fields;
    flocation_descriptionsedit.addFields([
        ["location_id", [fields.location_id.visible && fields.location_id.required ? ew.Validators.required(fields.location_id.caption) : null, ew.Validators.integer], fields.location_id.isInvalid],
        ["short", [fields.short.visible && fields.short.required ? ew.Validators.required(fields.short.caption) : null], fields.short.isInvalid],
        ["long", [fields.long.visible && fields.long.required ? ew.Validators.required(fields.long.caption) : null], fields.long.isInvalid],
        ["hours_message", [fields.hours_message.visible && fields.hours_message.required ? ew.Validators.required(fields.hours_message.caption) : null], fields.hours_message.isInvalid]
    ]);

    // Form_CustomValidate
    flocation_descriptionsedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    flocation_descriptionsedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("flocation_descriptionsedit");
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
<form name="flocation_descriptionsedit" id="flocation_descriptionsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="location_descriptions">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->location_id->Visible) { // location_id ?>
    <div id="r_location_id"<?= $Page->location_id->rowAttributes() ?>>
        <label id="elh_location_descriptions_location_id" for="x_location_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->location_id->caption() ?><?= $Page->location_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->location_id->cellAttributes() ?>>
<input type="<?= $Page->location_id->getInputTextType() ?>" name="x_location_id" id="x_location_id" data-table="location_descriptions" data-field="x_location_id" value="<?= $Page->location_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->location_id->getPlaceHolder()) ?>"<?= $Page->location_id->editAttributes() ?> aria-describedby="x_location_id_help">
<?= $Page->location_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->location_id->getErrorMessage() ?></div>
<input type="hidden" data-table="location_descriptions" data-field="x_location_id" data-hidden="1" name="o_location_id" id="o_location_id" value="<?= HtmlEncode($Page->location_id->OldValue ?? $Page->location_id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->short->Visible) { // short ?>
    <div id="r_short"<?= $Page->short->rowAttributes() ?>>
        <label id="elh_location_descriptions_short" for="x_short" class="<?= $Page->LeftColumnClass ?>"><?= $Page->short->caption() ?><?= $Page->short->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->short->cellAttributes() ?>>
<span id="el_location_descriptions_short">
<textarea data-table="location_descriptions" data-field="x_short" name="x_short" id="x_short" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->short->getPlaceHolder()) ?>"<?= $Page->short->editAttributes() ?> aria-describedby="x_short_help"><?= $Page->short->EditValue ?></textarea>
<?= $Page->short->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->short->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->long->Visible) { // long ?>
    <div id="r_long"<?= $Page->long->rowAttributes() ?>>
        <label id="elh_location_descriptions_long" for="x_long" class="<?= $Page->LeftColumnClass ?>"><?= $Page->long->caption() ?><?= $Page->long->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->long->cellAttributes() ?>>
<span id="el_location_descriptions_long">
<textarea data-table="location_descriptions" data-field="x_long" name="x_long" id="x_long" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->long->getPlaceHolder()) ?>"<?= $Page->long->editAttributes() ?> aria-describedby="x_long_help"><?= $Page->long->EditValue ?></textarea>
<?= $Page->long->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->long->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->hours_message->Visible) { // hours_message ?>
    <div id="r_hours_message"<?= $Page->hours_message->rowAttributes() ?>>
        <label id="elh_location_descriptions_hours_message" for="x_hours_message" class="<?= $Page->LeftColumnClass ?>"><?= $Page->hours_message->caption() ?><?= $Page->hours_message->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->hours_message->cellAttributes() ?>>
<span id="el_location_descriptions_hours_message">
<textarea data-table="location_descriptions" data-field="x_hours_message" name="x_hours_message" id="x_hours_message" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->hours_message->getPlaceHolder()) ?>"<?= $Page->hours_message->editAttributes() ?> aria-describedby="x_hours_message_help"><?= $Page->hours_message->EditValue ?></textarea>
<?= $Page->hours_message->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->hours_message->getErrorMessage() ?></div>
</span>
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
    ew.addEventHandlers("location_descriptions");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
