<?php

namespace PHPMaker2021\project2;

// Page object
$LocationAdd = &$Page;
?>
<script>
if (!ew.vars.tables.location) ew.vars.tables.location = <?= JsonEncode(GetClientVar("tables", "location")) ?>;
var currentForm, currentPageID;
var flocationadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    flocationadd = currentForm = new ew.Form("flocationadd", "add");

    // Add fields
    var fields = ew.vars.tables.location.fields;
    flocationadd.addFields([
        ["location_id", [fields.location_id.required ? ew.Validators.required(fields.location_id.caption) : null, ew.Validators.integer], fields.location_id.isInvalid],
        ["location_name", [fields.location_name.required ? ew.Validators.required(fields.location_name.caption) : null], fields.location_name.isInvalid],
        ["location_url", [fields.location_url.required ? ew.Validators.required(fields.location_url.caption) : null], fields.location_url.isInvalid],
        ["group_id", [fields.group_id.required ? ew.Validators.required(fields.group_id.caption) : null, ew.Validators.integer], fields.group_id.isInvalid],
        ["active", [fields.active.required ? ew.Validators.required(fields.active.caption) : null], fields.active.isInvalid],
        ["group_hours", [fields.group_hours.required ? ew.Validators.required(fields.group_hours.caption) : null], fields.group_hours.isInvalid],
        ["phone", [fields.phone.required ? ew.Validators.required(fields.phone.caption) : null], fields.phone.isInvalid],
        ["subgroup", [fields.subgroup.required ? ew.Validators.required(fields.subgroup.caption) : null], fields.subgroup.isInvalid],
        ["old_id", [fields.old_id.required ? ew.Validators.required(fields.old_id.caption) : null, ew.Validators.integer], fields.old_id.isInvalid],
        ["short_name", [fields.short_name.required ? ew.Validators.required(fields.short_name.caption) : null], fields.short_name.isInvalid],
        ["accept_plus_discount", [fields.accept_plus_discount.required ? ew.Validators.required(fields.accept_plus_discount.caption) : null, ew.Validators.integer], fields.accept_plus_discount.isInvalid],
        ["lat", [fields.lat.required ? ew.Validators.required(fields.lat.caption) : null], fields.lat.isInvalid],
        ["long", [fields.long.required ? ew.Validators.required(fields.long.caption) : null], fields.long.isInvalid],
        ["ua_mobile_categories", [fields.ua_mobile_categories.required ? ew.Validators.required(fields.ua_mobile_categories.caption) : null], fields.ua_mobile_categories.isInvalid],
        ["breakfast", [fields.breakfast.required ? ew.Validators.required(fields.breakfast.caption) : null], fields.breakfast.isInvalid],
        ["lunch", [fields.lunch.required ? ew.Validators.required(fields.lunch.caption) : null], fields.lunch.isInvalid],
        ["dinner", [fields.dinner.required ? ew.Validators.required(fields.dinner.caption) : null], fields.dinner.isInvalid],
        ["continuous", [fields.continuous.required ? ew.Validators.required(fields.continuous.caption) : null], fields.continuous.isInvalid],
        ["hours_message", [fields.hours_message.required ? ew.Validators.required(fields.hours_message.caption) : null], fields.hours_message.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = flocationadd,
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
    flocationadd.validate = function () {
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
    flocationadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    flocationadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    flocationadd.lists.group_hours = <?= $Page->group_hours->toClientList($Page) ?>;
    flocationadd.lists.breakfast = <?= $Page->breakfast->toClientList($Page) ?>;
    flocationadd.lists.lunch = <?= $Page->lunch->toClientList($Page) ?>;
    flocationadd.lists.dinner = <?= $Page->dinner->toClientList($Page) ?>;
    flocationadd.lists.continuous = <?= $Page->continuous->toClientList($Page) ?>;
    loadjs.done("flocationadd");
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
<form name="flocationadd" id="flocationadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="location">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->location_id->Visible) { // location_id ?>
    <div id="r_location_id" class="form-group row">
        <label id="elh_location_location_id" for="x_location_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->location_id->caption() ?><?= $Page->location_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->location_id->cellAttributes() ?>>
<span id="el_location_location_id">
<input type="<?= $Page->location_id->getInputTextType() ?>" data-table="location" data-field="x_location_id" name="x_location_id" id="x_location_id" size="30" placeholder="<?= HtmlEncode($Page->location_id->getPlaceHolder()) ?>" value="<?= $Page->location_id->EditValue ?>"<?= $Page->location_id->editAttributes() ?> aria-describedby="x_location_id_help">
<?= $Page->location_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->location_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->location_name->Visible) { // location_name ?>
    <div id="r_location_name" class="form-group row">
        <label id="elh_location_location_name" for="x_location_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->location_name->caption() ?><?= $Page->location_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->location_name->cellAttributes() ?>>
<span id="el_location_location_name">
<textarea data-table="location" data-field="x_location_name" name="x_location_name" id="x_location_name" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->location_name->getPlaceHolder()) ?>"<?= $Page->location_name->editAttributes() ?> aria-describedby="x_location_name_help"><?= $Page->location_name->EditValue ?></textarea>
<?= $Page->location_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->location_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->location_url->Visible) { // location_url ?>
    <div id="r_location_url" class="form-group row">
        <label id="elh_location_location_url" for="x_location_url" class="<?= $Page->LeftColumnClass ?>"><?= $Page->location_url->caption() ?><?= $Page->location_url->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->location_url->cellAttributes() ?>>
<span id="el_location_location_url">
<textarea data-table="location" data-field="x_location_url" name="x_location_url" id="x_location_url" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->location_url->getPlaceHolder()) ?>"<?= $Page->location_url->editAttributes() ?> aria-describedby="x_location_url_help"><?= $Page->location_url->EditValue ?></textarea>
<?= $Page->location_url->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->location_url->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->group_id->Visible) { // group_id ?>
    <div id="r_group_id" class="form-group row">
        <label id="elh_location_group_id" for="x_group_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->group_id->caption() ?><?= $Page->group_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->group_id->cellAttributes() ?>>
<span id="el_location_group_id">
<input type="<?= $Page->group_id->getInputTextType() ?>" data-table="location" data-field="x_group_id" name="x_group_id" id="x_group_id" size="30" placeholder="<?= HtmlEncode($Page->group_id->getPlaceHolder()) ?>" value="<?= $Page->group_id->EditValue ?>"<?= $Page->group_id->editAttributes() ?> aria-describedby="x_group_id_help">
<?= $Page->group_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->group_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->active->Visible) { // active ?>
    <div id="r_active" class="form-group row">
        <label id="elh_location_active" for="x_active" class="<?= $Page->LeftColumnClass ?>"><?= $Page->active->caption() ?><?= $Page->active->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->active->cellAttributes() ?>>
<span id="el_location_active">
<textarea data-table="location" data-field="x_active" name="x_active" id="x_active" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->active->getPlaceHolder()) ?>"<?= $Page->active->editAttributes() ?> aria-describedby="x_active_help"><?= $Page->active->EditValue ?></textarea>
<?= $Page->active->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->active->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->group_hours->Visible) { // group_hours ?>
    <div id="r_group_hours" class="form-group row">
        <label id="elh_location_group_hours" class="<?= $Page->LeftColumnClass ?>"><?= $Page->group_hours->caption() ?><?= $Page->group_hours->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->group_hours->cellAttributes() ?>>
<span id="el_location_group_hours">
<template id="tp_x_group_hours">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="location" data-field="x_group_hours" name="x_group_hours" id="x_group_hours"<?= $Page->group_hours->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_group_hours" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_group_hours"
    name="x_group_hours"
    value="<?= HtmlEncode($Page->group_hours->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_group_hours"
    data-target="dsl_x_group_hours"
    data-repeatcolumn="5"
    class="form-control<?= $Page->group_hours->isInvalidClass() ?>"
    data-table="location"
    data-field="x_group_hours"
    data-value-separator="<?= $Page->group_hours->displayValueSeparatorAttribute() ?>"
    <?= $Page->group_hours->editAttributes() ?>>
<?= $Page->group_hours->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->group_hours->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
    <div id="r_phone" class="form-group row">
        <label id="elh_location_phone" for="x_phone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->phone->caption() ?><?= $Page->phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->phone->cellAttributes() ?>>
<span id="el_location_phone">
<textarea data-table="location" data-field="x_phone" name="x_phone" id="x_phone" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->phone->getPlaceHolder()) ?>"<?= $Page->phone->editAttributes() ?> aria-describedby="x_phone_help"><?= $Page->phone->EditValue ?></textarea>
<?= $Page->phone->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->phone->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->subgroup->Visible) { // subgroup ?>
    <div id="r_subgroup" class="form-group row">
        <label id="elh_location_subgroup" for="x_subgroup" class="<?= $Page->LeftColumnClass ?>"><?= $Page->subgroup->caption() ?><?= $Page->subgroup->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->subgroup->cellAttributes() ?>>
<span id="el_location_subgroup">
<textarea data-table="location" data-field="x_subgroup" name="x_subgroup" id="x_subgroup" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->subgroup->getPlaceHolder()) ?>"<?= $Page->subgroup->editAttributes() ?> aria-describedby="x_subgroup_help"><?= $Page->subgroup->EditValue ?></textarea>
<?= $Page->subgroup->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->subgroup->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->old_id->Visible) { // old_id ?>
    <div id="r_old_id" class="form-group row">
        <label id="elh_location_old_id" for="x_old_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->old_id->caption() ?><?= $Page->old_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->old_id->cellAttributes() ?>>
<span id="el_location_old_id">
<input type="<?= $Page->old_id->getInputTextType() ?>" data-table="location" data-field="x_old_id" name="x_old_id" id="x_old_id" size="30" placeholder="<?= HtmlEncode($Page->old_id->getPlaceHolder()) ?>" value="<?= $Page->old_id->EditValue ?>"<?= $Page->old_id->editAttributes() ?> aria-describedby="x_old_id_help">
<?= $Page->old_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->old_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->short_name->Visible) { // short_name ?>
    <div id="r_short_name" class="form-group row">
        <label id="elh_location_short_name" for="x_short_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->short_name->caption() ?><?= $Page->short_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->short_name->cellAttributes() ?>>
<span id="el_location_short_name">
<textarea data-table="location" data-field="x_short_name" name="x_short_name" id="x_short_name" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->short_name->getPlaceHolder()) ?>"<?= $Page->short_name->editAttributes() ?> aria-describedby="x_short_name_help"><?= $Page->short_name->EditValue ?></textarea>
<?= $Page->short_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->short_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->accept_plus_discount->Visible) { // accept_plus_discount ?>
    <div id="r_accept_plus_discount" class="form-group row">
        <label id="elh_location_accept_plus_discount" for="x_accept_plus_discount" class="<?= $Page->LeftColumnClass ?>"><?= $Page->accept_plus_discount->caption() ?><?= $Page->accept_plus_discount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->accept_plus_discount->cellAttributes() ?>>
<span id="el_location_accept_plus_discount">
<input type="<?= $Page->accept_plus_discount->getInputTextType() ?>" data-table="location" data-field="x_accept_plus_discount" name="x_accept_plus_discount" id="x_accept_plus_discount" size="30" placeholder="<?= HtmlEncode($Page->accept_plus_discount->getPlaceHolder()) ?>" value="<?= $Page->accept_plus_discount->EditValue ?>"<?= $Page->accept_plus_discount->editAttributes() ?> aria-describedby="x_accept_plus_discount_help">
<?= $Page->accept_plus_discount->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->accept_plus_discount->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lat->Visible) { // lat ?>
    <div id="r_lat" class="form-group row">
        <label id="elh_location_lat" for="x_lat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lat->caption() ?><?= $Page->lat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->lat->cellAttributes() ?>>
<span id="el_location_lat">
<textarea data-table="location" data-field="x_lat" name="x_lat" id="x_lat" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->lat->getPlaceHolder()) ?>"<?= $Page->lat->editAttributes() ?> aria-describedby="x_lat_help"><?= $Page->lat->EditValue ?></textarea>
<?= $Page->lat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lat->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->long->Visible) { // long ?>
    <div id="r_long" class="form-group row">
        <label id="elh_location_long" for="x_long" class="<?= $Page->LeftColumnClass ?>"><?= $Page->long->caption() ?><?= $Page->long->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->long->cellAttributes() ?>>
<span id="el_location_long">
<textarea data-table="location" data-field="x_long" name="x_long" id="x_long" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->long->getPlaceHolder()) ?>"<?= $Page->long->editAttributes() ?> aria-describedby="x_long_help"><?= $Page->long->EditValue ?></textarea>
<?= $Page->long->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->long->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ua_mobile_categories->Visible) { // ua_mobile_categories ?>
    <div id="r_ua_mobile_categories" class="form-group row">
        <label id="elh_location_ua_mobile_categories" for="x_ua_mobile_categories" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ua_mobile_categories->caption() ?><?= $Page->ua_mobile_categories->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ua_mobile_categories->cellAttributes() ?>>
<span id="el_location_ua_mobile_categories">
<textarea data-table="location" data-field="x_ua_mobile_categories" name="x_ua_mobile_categories" id="x_ua_mobile_categories" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->ua_mobile_categories->getPlaceHolder()) ?>"<?= $Page->ua_mobile_categories->editAttributes() ?> aria-describedby="x_ua_mobile_categories_help"><?= $Page->ua_mobile_categories->EditValue ?></textarea>
<?= $Page->ua_mobile_categories->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ua_mobile_categories->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->breakfast->Visible) { // breakfast ?>
    <div id="r_breakfast" class="form-group row">
        <label id="elh_location_breakfast" class="<?= $Page->LeftColumnClass ?>"><?= $Page->breakfast->caption() ?><?= $Page->breakfast->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->breakfast->cellAttributes() ?>>
<span id="el_location_breakfast">
<template id="tp_x_breakfast">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="location" data-field="x_breakfast" name="x_breakfast" id="x_breakfast"<?= $Page->breakfast->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_breakfast" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_breakfast"
    name="x_breakfast"
    value="<?= HtmlEncode($Page->breakfast->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_breakfast"
    data-target="dsl_x_breakfast"
    data-repeatcolumn="5"
    class="form-control<?= $Page->breakfast->isInvalidClass() ?>"
    data-table="location"
    data-field="x_breakfast"
    data-value-separator="<?= $Page->breakfast->displayValueSeparatorAttribute() ?>"
    <?= $Page->breakfast->editAttributes() ?>>
<?= $Page->breakfast->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->breakfast->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lunch->Visible) { // lunch ?>
    <div id="r_lunch" class="form-group row">
        <label id="elh_location_lunch" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lunch->caption() ?><?= $Page->lunch->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->lunch->cellAttributes() ?>>
<span id="el_location_lunch">
<template id="tp_x_lunch">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="location" data-field="x_lunch" name="x_lunch" id="x_lunch"<?= $Page->lunch->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_lunch" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_lunch"
    name="x_lunch"
    value="<?= HtmlEncode($Page->lunch->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_lunch"
    data-target="dsl_x_lunch"
    data-repeatcolumn="5"
    class="form-control<?= $Page->lunch->isInvalidClass() ?>"
    data-table="location"
    data-field="x_lunch"
    data-value-separator="<?= $Page->lunch->displayValueSeparatorAttribute() ?>"
    <?= $Page->lunch->editAttributes() ?>>
<?= $Page->lunch->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lunch->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->dinner->Visible) { // dinner ?>
    <div id="r_dinner" class="form-group row">
        <label id="elh_location_dinner" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dinner->caption() ?><?= $Page->dinner->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->dinner->cellAttributes() ?>>
<span id="el_location_dinner">
<template id="tp_x_dinner">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="location" data-field="x_dinner" name="x_dinner" id="x_dinner"<?= $Page->dinner->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_dinner" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_dinner"
    name="x_dinner"
    value="<?= HtmlEncode($Page->dinner->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_dinner"
    data-target="dsl_x_dinner"
    data-repeatcolumn="5"
    class="form-control<?= $Page->dinner->isInvalidClass() ?>"
    data-table="location"
    data-field="x_dinner"
    data-value-separator="<?= $Page->dinner->displayValueSeparatorAttribute() ?>"
    <?= $Page->dinner->editAttributes() ?>>
<?= $Page->dinner->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->dinner->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->continuous->Visible) { // continuous ?>
    <div id="r_continuous" class="form-group row">
        <label id="elh_location_continuous" class="<?= $Page->LeftColumnClass ?>"><?= $Page->continuous->caption() ?><?= $Page->continuous->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->continuous->cellAttributes() ?>>
<span id="el_location_continuous">
<template id="tp_x_continuous">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="location" data-field="x_continuous" name="x_continuous" id="x_continuous"<?= $Page->continuous->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_continuous" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_continuous"
    name="x_continuous"
    value="<?= HtmlEncode($Page->continuous->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_continuous"
    data-target="dsl_x_continuous"
    data-repeatcolumn="5"
    class="form-control<?= $Page->continuous->isInvalidClass() ?>"
    data-table="location"
    data-field="x_continuous"
    data-value-separator="<?= $Page->continuous->displayValueSeparatorAttribute() ?>"
    <?= $Page->continuous->editAttributes() ?>>
<?= $Page->continuous->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->continuous->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->hours_message->Visible) { // hours_message ?>
    <div id="r_hours_message" class="form-group row">
        <label id="elh_location_hours_message" for="x_hours_message" class="<?= $Page->LeftColumnClass ?>"><?= $Page->hours_message->caption() ?><?= $Page->hours_message->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->hours_message->cellAttributes() ?>>
<span id="el_location_hours_message">
<textarea data-table="location" data-field="x_hours_message" name="x_hours_message" id="x_hours_message" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->hours_message->getPlaceHolder()) ?>"<?= $Page->hours_message->editAttributes() ?> aria-describedby="x_hours_message_help"><?= $Page->hours_message->EditValue ?></textarea>
<?= $Page->hours_message->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->hours_message->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
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
    ew.addEventHandlers("location");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
