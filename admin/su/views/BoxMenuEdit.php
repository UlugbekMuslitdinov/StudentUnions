<?php

namespace PHPMaker2021\project1;

// Page object
$BoxMenuEdit = &$Page;
?>
<script>
if (!ew.vars.tables.box_menu) ew.vars.tables.box_menu = <?= JsonEncode(GetClientVar("tables", "box_menu")) ?>;
var currentForm, currentPageID;
var fbox_menuedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fbox_menuedit = currentForm = new ew.Form("fbox_menuedit", "edit");

    // Add fields
    var fields = ew.vars.tables.box_menu.fields;
    fbox_menuedit.addFields([
        ["id", [fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["date", [fields.date.required ? ew.Validators.required(fields.date.caption) : null], fields.date.isInvalid],
        ["day", [fields.day.required ? ew.Validators.required(fields.day.caption) : null], fields.day.isInvalid],
        ["breakfast_1", [fields.breakfast_1.required ? ew.Validators.required(fields.breakfast_1.caption) : null], fields.breakfast_1.isInvalid],
        ["breakfast_2", [fields.breakfast_2.required ? ew.Validators.required(fields.breakfast_2.caption) : null], fields.breakfast_2.isInvalid],
        ["breakfast_bag", [fields.breakfast_bag.required ? ew.Validators.required(fields.breakfast_bag.caption) : null], fields.breakfast_bag.isInvalid],
        ["breakfast_bag2", [fields.breakfast_bag2.required ? ew.Validators.required(fields.breakfast_bag2.caption) : null], fields.breakfast_bag2.isInvalid],
        ["breakfast_beverage", [fields.breakfast_beverage.required ? ew.Validators.required(fields.breakfast_beverage.caption) : null], fields.breakfast_beverage.isInvalid],
        ["lunch_1", [fields.lunch_1.required ? ew.Validators.required(fields.lunch_1.caption) : null], fields.lunch_1.isInvalid],
        ["lunch_2", [fields.lunch_2.required ? ew.Validators.required(fields.lunch_2.caption) : null], fields.lunch_2.isInvalid],
        ["lunch_3", [fields.lunch_3.required ? ew.Validators.required(fields.lunch_3.caption) : null], fields.lunch_3.isInvalid],
        ["lunch_bag", [fields.lunch_bag.required ? ew.Validators.required(fields.lunch_bag.caption) : null], fields.lunch_bag.isInvalid],
        ["lunch_bag2", [fields.lunch_bag2.required ? ew.Validators.required(fields.lunch_bag2.caption) : null], fields.lunch_bag2.isInvalid],
        ["lunch_bag3", [fields.lunch_bag3.required ? ew.Validators.required(fields.lunch_bag3.caption) : null], fields.lunch_bag3.isInvalid],
        ["lunch_beverage", [fields.lunch_beverage.required ? ew.Validators.required(fields.lunch_beverage.caption) : null], fields.lunch_beverage.isInvalid],
        ["dinner_1", [fields.dinner_1.required ? ew.Validators.required(fields.dinner_1.caption) : null], fields.dinner_1.isInvalid],
        ["dinner_2", [fields.dinner_2.required ? ew.Validators.required(fields.dinner_2.caption) : null], fields.dinner_2.isInvalid],
        ["dinner_3", [fields.dinner_3.required ? ew.Validators.required(fields.dinner_3.caption) : null], fields.dinner_3.isInvalid],
        ["dinner_bag", [fields.dinner_bag.required ? ew.Validators.required(fields.dinner_bag.caption) : null], fields.dinner_bag.isInvalid],
        ["dinner_bag2", [fields.dinner_bag2.required ? ew.Validators.required(fields.dinner_bag2.caption) : null], fields.dinner_bag2.isInvalid],
        ["dinner_bag3", [fields.dinner_bag3.required ? ew.Validators.required(fields.dinner_bag3.caption) : null], fields.dinner_bag3.isInvalid],
        ["dinner_beverage", [fields.dinner_beverage.required ? ew.Validators.required(fields.dinner_beverage.caption) : null], fields.dinner_beverage.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fbox_menuedit,
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
    fbox_menuedit.validate = function () {
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
    fbox_menuedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fbox_menuedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fbox_menuedit");
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
<form name="fbox_menuedit" id="fbox_menuedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="box_menu">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_box_menu_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_box_menu_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="box_menu" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date->Visible) { // date ?>
    <div id="r_date" class="form-group row">
        <label id="elh_box_menu_date" for="x_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date->caption() ?><?= $Page->date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->date->cellAttributes() ?>>
<span id="el_box_menu_date">
<input type="<?= $Page->date->getInputTextType() ?>" data-table="box_menu" data-field="x_date" name="x_date" id="x_date" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->date->getPlaceHolder()) ?>" value="<?= $Page->date->EditValue ?>"<?= $Page->date->editAttributes() ?> aria-describedby="x_date_help">
<?= $Page->date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->day->Visible) { // day ?>
    <div id="r_day" class="form-group row">
        <label id="elh_box_menu_day" for="x_day" class="<?= $Page->LeftColumnClass ?>"><?= $Page->day->caption() ?><?= $Page->day->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->day->cellAttributes() ?>>
<span id="el_box_menu_day">
<input type="<?= $Page->day->getInputTextType() ?>" data-table="box_menu" data-field="x_day" name="x_day" id="x_day" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->day->getPlaceHolder()) ?>" value="<?= $Page->day->EditValue ?>"<?= $Page->day->editAttributes() ?> aria-describedby="x_day_help">
<?= $Page->day->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->day->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->breakfast_1->Visible) { // breakfast_1 ?>
    <div id="r_breakfast_1" class="form-group row">
        <label id="elh_box_menu_breakfast_1" for="x_breakfast_1" class="<?= $Page->LeftColumnClass ?>"><?= $Page->breakfast_1->caption() ?><?= $Page->breakfast_1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->breakfast_1->cellAttributes() ?>>
<span id="el_box_menu_breakfast_1">
<input type="<?= $Page->breakfast_1->getInputTextType() ?>" data-table="box_menu" data-field="x_breakfast_1" name="x_breakfast_1" id="x_breakfast_1" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->breakfast_1->getPlaceHolder()) ?>" value="<?= $Page->breakfast_1->EditValue ?>"<?= $Page->breakfast_1->editAttributes() ?> aria-describedby="x_breakfast_1_help">
<?= $Page->breakfast_1->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->breakfast_1->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->breakfast_2->Visible) { // breakfast_2 ?>
    <div id="r_breakfast_2" class="form-group row">
        <label id="elh_box_menu_breakfast_2" for="x_breakfast_2" class="<?= $Page->LeftColumnClass ?>"><?= $Page->breakfast_2->caption() ?><?= $Page->breakfast_2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->breakfast_2->cellAttributes() ?>>
<span id="el_box_menu_breakfast_2">
<input type="<?= $Page->breakfast_2->getInputTextType() ?>" data-table="box_menu" data-field="x_breakfast_2" name="x_breakfast_2" id="x_breakfast_2" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->breakfast_2->getPlaceHolder()) ?>" value="<?= $Page->breakfast_2->EditValue ?>"<?= $Page->breakfast_2->editAttributes() ?> aria-describedby="x_breakfast_2_help">
<?= $Page->breakfast_2->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->breakfast_2->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->breakfast_bag->Visible) { // breakfast_bag ?>
    <div id="r_breakfast_bag" class="form-group row">
        <label id="elh_box_menu_breakfast_bag" for="x_breakfast_bag" class="<?= $Page->LeftColumnClass ?>"><?= $Page->breakfast_bag->caption() ?><?= $Page->breakfast_bag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->breakfast_bag->cellAttributes() ?>>
<span id="el_box_menu_breakfast_bag">
<input type="<?= $Page->breakfast_bag->getInputTextType() ?>" data-table="box_menu" data-field="x_breakfast_bag" name="x_breakfast_bag" id="x_breakfast_bag" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->breakfast_bag->getPlaceHolder()) ?>" value="<?= $Page->breakfast_bag->EditValue ?>"<?= $Page->breakfast_bag->editAttributes() ?> aria-describedby="x_breakfast_bag_help">
<?= $Page->breakfast_bag->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->breakfast_bag->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->breakfast_bag2->Visible) { // breakfast_bag2 ?>
    <div id="r_breakfast_bag2" class="form-group row">
        <label id="elh_box_menu_breakfast_bag2" for="x_breakfast_bag2" class="<?= $Page->LeftColumnClass ?>"><?= $Page->breakfast_bag2->caption() ?><?= $Page->breakfast_bag2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->breakfast_bag2->cellAttributes() ?>>
<span id="el_box_menu_breakfast_bag2">
<input type="<?= $Page->breakfast_bag2->getInputTextType() ?>" data-table="box_menu" data-field="x_breakfast_bag2" name="x_breakfast_bag2" id="x_breakfast_bag2" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->breakfast_bag2->getPlaceHolder()) ?>" value="<?= $Page->breakfast_bag2->EditValue ?>"<?= $Page->breakfast_bag2->editAttributes() ?> aria-describedby="x_breakfast_bag2_help">
<?= $Page->breakfast_bag2->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->breakfast_bag2->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->breakfast_beverage->Visible) { // breakfast_beverage ?>
    <div id="r_breakfast_beverage" class="form-group row">
        <label id="elh_box_menu_breakfast_beverage" for="x_breakfast_beverage" class="<?= $Page->LeftColumnClass ?>"><?= $Page->breakfast_beverage->caption() ?><?= $Page->breakfast_beverage->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->breakfast_beverage->cellAttributes() ?>>
<span id="el_box_menu_breakfast_beverage">
<input type="<?= $Page->breakfast_beverage->getInputTextType() ?>" data-table="box_menu" data-field="x_breakfast_beverage" name="x_breakfast_beverage" id="x_breakfast_beverage" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->breakfast_beverage->getPlaceHolder()) ?>" value="<?= $Page->breakfast_beverage->EditValue ?>"<?= $Page->breakfast_beverage->editAttributes() ?> aria-describedby="x_breakfast_beverage_help">
<?= $Page->breakfast_beverage->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->breakfast_beverage->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lunch_1->Visible) { // lunch_1 ?>
    <div id="r_lunch_1" class="form-group row">
        <label id="elh_box_menu_lunch_1" for="x_lunch_1" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lunch_1->caption() ?><?= $Page->lunch_1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->lunch_1->cellAttributes() ?>>
<span id="el_box_menu_lunch_1">
<input type="<?= $Page->lunch_1->getInputTextType() ?>" data-table="box_menu" data-field="x_lunch_1" name="x_lunch_1" id="x_lunch_1" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->lunch_1->getPlaceHolder()) ?>" value="<?= $Page->lunch_1->EditValue ?>"<?= $Page->lunch_1->editAttributes() ?> aria-describedby="x_lunch_1_help">
<?= $Page->lunch_1->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lunch_1->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lunch_2->Visible) { // lunch_2 ?>
    <div id="r_lunch_2" class="form-group row">
        <label id="elh_box_menu_lunch_2" for="x_lunch_2" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lunch_2->caption() ?><?= $Page->lunch_2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->lunch_2->cellAttributes() ?>>
<span id="el_box_menu_lunch_2">
<input type="<?= $Page->lunch_2->getInputTextType() ?>" data-table="box_menu" data-field="x_lunch_2" name="x_lunch_2" id="x_lunch_2" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->lunch_2->getPlaceHolder()) ?>" value="<?= $Page->lunch_2->EditValue ?>"<?= $Page->lunch_2->editAttributes() ?> aria-describedby="x_lunch_2_help">
<?= $Page->lunch_2->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lunch_2->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lunch_3->Visible) { // lunch_3 ?>
    <div id="r_lunch_3" class="form-group row">
        <label id="elh_box_menu_lunch_3" for="x_lunch_3" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lunch_3->caption() ?><?= $Page->lunch_3->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->lunch_3->cellAttributes() ?>>
<span id="el_box_menu_lunch_3">
<input type="<?= $Page->lunch_3->getInputTextType() ?>" data-table="box_menu" data-field="x_lunch_3" name="x_lunch_3" id="x_lunch_3" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->lunch_3->getPlaceHolder()) ?>" value="<?= $Page->lunch_3->EditValue ?>"<?= $Page->lunch_3->editAttributes() ?> aria-describedby="x_lunch_3_help">
<?= $Page->lunch_3->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lunch_3->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lunch_bag->Visible) { // lunch_bag ?>
    <div id="r_lunch_bag" class="form-group row">
        <label id="elh_box_menu_lunch_bag" for="x_lunch_bag" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lunch_bag->caption() ?><?= $Page->lunch_bag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->lunch_bag->cellAttributes() ?>>
<span id="el_box_menu_lunch_bag">
<input type="<?= $Page->lunch_bag->getInputTextType() ?>" data-table="box_menu" data-field="x_lunch_bag" name="x_lunch_bag" id="x_lunch_bag" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->lunch_bag->getPlaceHolder()) ?>" value="<?= $Page->lunch_bag->EditValue ?>"<?= $Page->lunch_bag->editAttributes() ?> aria-describedby="x_lunch_bag_help">
<?= $Page->lunch_bag->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lunch_bag->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lunch_bag2->Visible) { // lunch_bag2 ?>
    <div id="r_lunch_bag2" class="form-group row">
        <label id="elh_box_menu_lunch_bag2" for="x_lunch_bag2" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lunch_bag2->caption() ?><?= $Page->lunch_bag2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->lunch_bag2->cellAttributes() ?>>
<span id="el_box_menu_lunch_bag2">
<input type="<?= $Page->lunch_bag2->getInputTextType() ?>" data-table="box_menu" data-field="x_lunch_bag2" name="x_lunch_bag2" id="x_lunch_bag2" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->lunch_bag2->getPlaceHolder()) ?>" value="<?= $Page->lunch_bag2->EditValue ?>"<?= $Page->lunch_bag2->editAttributes() ?> aria-describedby="x_lunch_bag2_help">
<?= $Page->lunch_bag2->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lunch_bag2->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lunch_bag3->Visible) { // lunch_bag3 ?>
    <div id="r_lunch_bag3" class="form-group row">
        <label id="elh_box_menu_lunch_bag3" for="x_lunch_bag3" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lunch_bag3->caption() ?><?= $Page->lunch_bag3->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->lunch_bag3->cellAttributes() ?>>
<span id="el_box_menu_lunch_bag3">
<input type="<?= $Page->lunch_bag3->getInputTextType() ?>" data-table="box_menu" data-field="x_lunch_bag3" name="x_lunch_bag3" id="x_lunch_bag3" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->lunch_bag3->getPlaceHolder()) ?>" value="<?= $Page->lunch_bag3->EditValue ?>"<?= $Page->lunch_bag3->editAttributes() ?> aria-describedby="x_lunch_bag3_help">
<?= $Page->lunch_bag3->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lunch_bag3->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lunch_beverage->Visible) { // lunch_beverage ?>
    <div id="r_lunch_beverage" class="form-group row">
        <label id="elh_box_menu_lunch_beverage" for="x_lunch_beverage" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lunch_beverage->caption() ?><?= $Page->lunch_beverage->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->lunch_beverage->cellAttributes() ?>>
<span id="el_box_menu_lunch_beverage">
<input type="<?= $Page->lunch_beverage->getInputTextType() ?>" data-table="box_menu" data-field="x_lunch_beverage" name="x_lunch_beverage" id="x_lunch_beverage" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->lunch_beverage->getPlaceHolder()) ?>" value="<?= $Page->lunch_beverage->EditValue ?>"<?= $Page->lunch_beverage->editAttributes() ?> aria-describedby="x_lunch_beverage_help">
<?= $Page->lunch_beverage->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lunch_beverage->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->dinner_1->Visible) { // dinner_1 ?>
    <div id="r_dinner_1" class="form-group row">
        <label id="elh_box_menu_dinner_1" for="x_dinner_1" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dinner_1->caption() ?><?= $Page->dinner_1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->dinner_1->cellAttributes() ?>>
<span id="el_box_menu_dinner_1">
<input type="<?= $Page->dinner_1->getInputTextType() ?>" data-table="box_menu" data-field="x_dinner_1" name="x_dinner_1" id="x_dinner_1" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->dinner_1->getPlaceHolder()) ?>" value="<?= $Page->dinner_1->EditValue ?>"<?= $Page->dinner_1->editAttributes() ?> aria-describedby="x_dinner_1_help">
<?= $Page->dinner_1->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->dinner_1->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->dinner_2->Visible) { // dinner_2 ?>
    <div id="r_dinner_2" class="form-group row">
        <label id="elh_box_menu_dinner_2" for="x_dinner_2" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dinner_2->caption() ?><?= $Page->dinner_2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->dinner_2->cellAttributes() ?>>
<span id="el_box_menu_dinner_2">
<input type="<?= $Page->dinner_2->getInputTextType() ?>" data-table="box_menu" data-field="x_dinner_2" name="x_dinner_2" id="x_dinner_2" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->dinner_2->getPlaceHolder()) ?>" value="<?= $Page->dinner_2->EditValue ?>"<?= $Page->dinner_2->editAttributes() ?> aria-describedby="x_dinner_2_help">
<?= $Page->dinner_2->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->dinner_2->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->dinner_3->Visible) { // dinner_3 ?>
    <div id="r_dinner_3" class="form-group row">
        <label id="elh_box_menu_dinner_3" for="x_dinner_3" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dinner_3->caption() ?><?= $Page->dinner_3->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->dinner_3->cellAttributes() ?>>
<span id="el_box_menu_dinner_3">
<input type="<?= $Page->dinner_3->getInputTextType() ?>" data-table="box_menu" data-field="x_dinner_3" name="x_dinner_3" id="x_dinner_3" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->dinner_3->getPlaceHolder()) ?>" value="<?= $Page->dinner_3->EditValue ?>"<?= $Page->dinner_3->editAttributes() ?> aria-describedby="x_dinner_3_help">
<?= $Page->dinner_3->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->dinner_3->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->dinner_bag->Visible) { // dinner_bag ?>
    <div id="r_dinner_bag" class="form-group row">
        <label id="elh_box_menu_dinner_bag" for="x_dinner_bag" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dinner_bag->caption() ?><?= $Page->dinner_bag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->dinner_bag->cellAttributes() ?>>
<span id="el_box_menu_dinner_bag">
<input type="<?= $Page->dinner_bag->getInputTextType() ?>" data-table="box_menu" data-field="x_dinner_bag" name="x_dinner_bag" id="x_dinner_bag" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->dinner_bag->getPlaceHolder()) ?>" value="<?= $Page->dinner_bag->EditValue ?>"<?= $Page->dinner_bag->editAttributes() ?> aria-describedby="x_dinner_bag_help">
<?= $Page->dinner_bag->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->dinner_bag->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->dinner_bag2->Visible) { // dinner_bag2 ?>
    <div id="r_dinner_bag2" class="form-group row">
        <label id="elh_box_menu_dinner_bag2" for="x_dinner_bag2" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dinner_bag2->caption() ?><?= $Page->dinner_bag2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->dinner_bag2->cellAttributes() ?>>
<span id="el_box_menu_dinner_bag2">
<input type="<?= $Page->dinner_bag2->getInputTextType() ?>" data-table="box_menu" data-field="x_dinner_bag2" name="x_dinner_bag2" id="x_dinner_bag2" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->dinner_bag2->getPlaceHolder()) ?>" value="<?= $Page->dinner_bag2->EditValue ?>"<?= $Page->dinner_bag2->editAttributes() ?> aria-describedby="x_dinner_bag2_help">
<?= $Page->dinner_bag2->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->dinner_bag2->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->dinner_bag3->Visible) { // dinner_bag3 ?>
    <div id="r_dinner_bag3" class="form-group row">
        <label id="elh_box_menu_dinner_bag3" for="x_dinner_bag3" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dinner_bag3->caption() ?><?= $Page->dinner_bag3->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->dinner_bag3->cellAttributes() ?>>
<span id="el_box_menu_dinner_bag3">
<input type="<?= $Page->dinner_bag3->getInputTextType() ?>" data-table="box_menu" data-field="x_dinner_bag3" name="x_dinner_bag3" id="x_dinner_bag3" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->dinner_bag3->getPlaceHolder()) ?>" value="<?= $Page->dinner_bag3->EditValue ?>"<?= $Page->dinner_bag3->editAttributes() ?> aria-describedby="x_dinner_bag3_help">
<?= $Page->dinner_bag3->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->dinner_bag3->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->dinner_beverage->Visible) { // dinner_beverage ?>
    <div id="r_dinner_beverage" class="form-group row">
        <label id="elh_box_menu_dinner_beverage" for="x_dinner_beverage" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dinner_beverage->caption() ?><?= $Page->dinner_beverage->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->dinner_beverage->cellAttributes() ?>>
<span id="el_box_menu_dinner_beverage">
<input type="<?= $Page->dinner_beverage->getInputTextType() ?>" data-table="box_menu" data-field="x_dinner_beverage" name="x_dinner_beverage" id="x_dinner_beverage" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->dinner_beverage->getPlaceHolder()) ?>" value="<?= $Page->dinner_beverage->EditValue ?>"<?= $Page->dinner_beverage->editAttributes() ?> aria-describedby="x_dinner_beverage_help">
<?= $Page->dinner_beverage->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->dinner_beverage->getErrorMessage() ?></div>
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
    ew.addEventHandlers("box_menu");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
