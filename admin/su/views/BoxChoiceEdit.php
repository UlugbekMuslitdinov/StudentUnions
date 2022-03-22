<?php

namespace PHPMaker2021\project1;

// Page object
$BoxChoiceEdit = &$Page;
?>
<script>
if (!ew.vars.tables.box_choice) ew.vars.tables.box_choice = <?= JsonEncode(GetClientVar("tables", "box_choice")) ?>;
var currentForm, currentPageID;
var fbox_choiceedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fbox_choiceedit = currentForm = new ew.Form("fbox_choiceedit", "edit");

    // Add fields
    var fields = ew.vars.tables.box_choice.fields;
    fbox_choiceedit.addFields([
        ["id", [fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["order_id", [fields.order_id.required ? ew.Validators.required(fields.order_id.caption) : null, ew.Validators.integer], fields.order_id.isInvalid],
        ["box_id", [fields.box_id.required ? ew.Validators.required(fields.box_id.caption) : null, ew.Validators.integer], fields.box_id.isInvalid],
        ["pickup_date", [fields.pickup_date.required ? ew.Validators.required(fields.pickup_date.caption) : null, ew.Validators.datetime(0)], fields.pickup_date.isInvalid],
        ["meal", [fields.meal.required ? ew.Validators.required(fields.meal.caption) : null], fields.meal.isInvalid],
        ["beverage", [fields.beverage.required ? ew.Validators.required(fields.beverage.caption) : null], fields.beverage.isInvalid],
        ["box_name", [fields.box_name.required ? ew.Validators.required(fields.box_name.caption) : null], fields.box_name.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fbox_choiceedit,
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
    fbox_choiceedit.validate = function () {
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
    fbox_choiceedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fbox_choiceedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fbox_choiceedit");
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
<form name="fbox_choiceedit" id="fbox_choiceedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="box_choice">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_box_choice_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_box_choice_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="box_choice" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->order_id->Visible) { // order_id ?>
    <div id="r_order_id" class="form-group row">
        <label id="elh_box_choice_order_id" for="x_order_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->order_id->caption() ?><?= $Page->order_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->order_id->cellAttributes() ?>>
<span id="el_box_choice_order_id">
<input type="<?= $Page->order_id->getInputTextType() ?>" data-table="box_choice" data-field="x_order_id" name="x_order_id" id="x_order_id" size="30" placeholder="<?= HtmlEncode($Page->order_id->getPlaceHolder()) ?>" value="<?= $Page->order_id->EditValue ?>"<?= $Page->order_id->editAttributes() ?> aria-describedby="x_order_id_help">
<?= $Page->order_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->order_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->box_id->Visible) { // box_id ?>
    <div id="r_box_id" class="form-group row">
        <label id="elh_box_choice_box_id" for="x_box_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->box_id->caption() ?><?= $Page->box_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->box_id->cellAttributes() ?>>
<span id="el_box_choice_box_id">
<input type="<?= $Page->box_id->getInputTextType() ?>" data-table="box_choice" data-field="x_box_id" name="x_box_id" id="x_box_id" size="30" placeholder="<?= HtmlEncode($Page->box_id->getPlaceHolder()) ?>" value="<?= $Page->box_id->EditValue ?>"<?= $Page->box_id->editAttributes() ?> aria-describedby="x_box_id_help">
<?= $Page->box_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->box_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pickup_date->Visible) { // pickup_date ?>
    <div id="r_pickup_date" class="form-group row">
        <label id="elh_box_choice_pickup_date" for="x_pickup_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pickup_date->caption() ?><?= $Page->pickup_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->pickup_date->cellAttributes() ?>>
<span id="el_box_choice_pickup_date">
<input type="<?= $Page->pickup_date->getInputTextType() ?>" data-table="box_choice" data-field="x_pickup_date" name="x_pickup_date" id="x_pickup_date" placeholder="<?= HtmlEncode($Page->pickup_date->getPlaceHolder()) ?>" value="<?= $Page->pickup_date->EditValue ?>"<?= $Page->pickup_date->editAttributes() ?> aria-describedby="x_pickup_date_help">
<?= $Page->pickup_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pickup_date->getErrorMessage() ?></div>
<?php if (!$Page->pickup_date->ReadOnly && !$Page->pickup_date->Disabled && !isset($Page->pickup_date->EditAttrs["readonly"]) && !isset($Page->pickup_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbox_choiceedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fbox_choiceedit", "x_pickup_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->meal->Visible) { // meal ?>
    <div id="r_meal" class="form-group row">
        <label id="elh_box_choice_meal" for="x_meal" class="<?= $Page->LeftColumnClass ?>"><?= $Page->meal->caption() ?><?= $Page->meal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->meal->cellAttributes() ?>>
<span id="el_box_choice_meal">
<input type="<?= $Page->meal->getInputTextType() ?>" data-table="box_choice" data-field="x_meal" name="x_meal" id="x_meal" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->meal->getPlaceHolder()) ?>" value="<?= $Page->meal->EditValue ?>"<?= $Page->meal->editAttributes() ?> aria-describedby="x_meal_help">
<?= $Page->meal->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->meal->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->beverage->Visible) { // beverage ?>
    <div id="r_beverage" class="form-group row">
        <label id="elh_box_choice_beverage" for="x_beverage" class="<?= $Page->LeftColumnClass ?>"><?= $Page->beverage->caption() ?><?= $Page->beverage->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->beverage->cellAttributes() ?>>
<span id="el_box_choice_beverage">
<input type="<?= $Page->beverage->getInputTextType() ?>" data-table="box_choice" data-field="x_beverage" name="x_beverage" id="x_beverage" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->beverage->getPlaceHolder()) ?>" value="<?= $Page->beverage->EditValue ?>"<?= $Page->beverage->editAttributes() ?> aria-describedby="x_beverage_help">
<?= $Page->beverage->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->beverage->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->box_name->Visible) { // box_name ?>
    <div id="r_box_name" class="form-group row">
        <label id="elh_box_choice_box_name" for="x_box_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->box_name->caption() ?><?= $Page->box_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->box_name->cellAttributes() ?>>
<span id="el_box_choice_box_name">
<input type="<?= $Page->box_name->getInputTextType() ?>" data-table="box_choice" data-field="x_box_name" name="x_box_name" id="x_box_name" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->box_name->getPlaceHolder()) ?>" value="<?= $Page->box_name->EditValue ?>"<?= $Page->box_name->editAttributes() ?> aria-describedby="x_box_name_help">
<?= $Page->box_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->box_name->getErrorMessage() ?></div>
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
    ew.addEventHandlers("box_choice");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
