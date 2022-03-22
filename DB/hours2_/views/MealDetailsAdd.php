<?php

namespace PHPMaker2022\project1;

// Page object
$MealDetailsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { meal_details: currentTable } });
var currentForm, currentPageID;
var fmeal_detailsadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmeal_detailsadd = new ew.Form("fmeal_detailsadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fmeal_detailsadd;

    // Add fields
    var fields = currentTable.fields;
    fmeal_detailsadd.addFields([
        ["meal_name", [fields.meal_name.visible && fields.meal_name.required ? ew.Validators.required(fields.meal_name.caption) : null], fields.meal_name.isInvalid]
    ]);

    // Form_CustomValidate
    fmeal_detailsadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmeal_detailsadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fmeal_detailsadd");
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
<form name="fmeal_detailsadd" id="fmeal_detailsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="meal_details">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->meal_name->Visible) { // meal_name ?>
    <div id="r_meal_name"<?= $Page->meal_name->rowAttributes() ?>>
        <label id="elh_meal_details_meal_name" for="x_meal_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->meal_name->caption() ?><?= $Page->meal_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->meal_name->cellAttributes() ?>>
<span id="el_meal_details_meal_name">
<input type="<?= $Page->meal_name->getInputTextType() ?>" name="x_meal_name" id="x_meal_name" data-table="meal_details" data-field="x_meal_name" value="<?= $Page->meal_name->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->meal_name->getPlaceHolder()) ?>"<?= $Page->meal_name->editAttributes() ?> aria-describedby="x_meal_name_help">
<?= $Page->meal_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->meal_name->getErrorMessage() ?></div>
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
    ew.addEventHandlers("meal_details");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
