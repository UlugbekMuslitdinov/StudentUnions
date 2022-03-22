<?php

namespace PHPMaker2021\project4;

// Page object
$BuildingAccessRequestsEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fbuilding_access_requestsedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fbuilding_access_requestsedit = currentForm = new ew.Form("fbuilding_access_requestsedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "building_access_requests")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.building_access_requests)
        ew.vars.tables.building_access_requests = currentTable;
    fbuilding_access_requestsedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["form_type", [fields.form_type.visible && fields.form_type.required ? ew.Validators.required(fields.form_type.caption) : null], fields.form_type.isInvalid],
        ["supervisor_name", [fields.supervisor_name.visible && fields.supervisor_name.required ? ew.Validators.required(fields.supervisor_name.caption) : null], fields.supervisor_name.isInvalid],
        ["supervisor_phone", [fields.supervisor_phone.visible && fields.supervisor_phone.required ? ew.Validators.required(fields.supervisor_phone.caption) : null], fields.supervisor_phone.isInvalid],
        ["employee_first_name", [fields.employee_first_name.visible && fields.employee_first_name.required ? ew.Validators.required(fields.employee_first_name.caption) : null], fields.employee_first_name.isInvalid],
        ["employee_last_name", [fields.employee_last_name.visible && fields.employee_last_name.required ? ew.Validators.required(fields.employee_last_name.caption) : null], fields.employee_last_name.isInvalid],
        ["catcard", [fields.catcard.visible && fields.catcard.required ? ew.Validators.required(fields.catcard.caption) : null], fields.catcard.isInvalid],
        ["pin", [fields.pin.visible && fields.pin.required ? ew.Validators.required(fields.pin.caption) : null], fields.pin.isInvalid],
        ["employee_unit", [fields.employee_unit.visible && fields.employee_unit.required ? ew.Validators.required(fields.employee_unit.caption) : null], fields.employee_unit.isInvalid],
        ["employee_id", [fields.employee_id.visible && fields.employee_id.required ? ew.Validators.required(fields.employee_id.caption) : null], fields.employee_id.isInvalid],
        ["other_areas", [fields.other_areas.visible && fields.other_areas.required ? ew.Validators.required(fields.other_areas.caption) : null], fields.other_areas.isInvalid],
        ["alarm_access", [fields.alarm_access.visible && fields.alarm_access.required ? ew.Validators.required(fields.alarm_access.caption) : null], fields.alarm_access.isInvalid],
        ["alarm_area", [fields.alarm_area.visible && fields.alarm_area.required ? ew.Validators.required(fields.alarm_area.caption) : null], fields.alarm_area.isInvalid],
        ["alarm_password", [fields.alarm_password.visible && fields.alarm_password.required ? ew.Validators.required(fields.alarm_password.caption) : null], fields.alarm_password.isInvalid],
        ["replacement_catcard", [fields.replacement_catcard.visible && fields.replacement_catcard.required ? ew.Validators.required(fields.replacement_catcard.caption) : null], fields.replacement_catcard.isInvalid],
        ["replacement_other", [fields.replacement_other.visible && fields.replacement_other.required ? ew.Validators.required(fields.replacement_other.caption) : null], fields.replacement_other.isInvalid],
        ["replacement_problem", [fields.replacement_problem.visible && fields.replacement_problem.required ? ew.Validators.required(fields.replacement_problem.caption) : null], fields.replacement_problem.isInvalid],
        ["delete", [fields.delete.visible && fields.delete.required ? ew.Validators.required(fields.delete.caption) : null], fields.delete.isInvalid],
        ["timestamp", [fields.timestamp.visible && fields.timestamp.required ? ew.Validators.required(fields.timestamp.caption) : null, ew.Validators.datetime(0)], fields.timestamp.isInvalid],
        ["net_id", [fields.net_id.visible && fields.net_id.required ? ew.Validators.required(fields.net_id.caption) : null], fields.net_id.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fbuilding_access_requestsedit,
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
    fbuilding_access_requestsedit.validate = function () {
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
    fbuilding_access_requestsedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fbuilding_access_requestsedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fbuilding_access_requestsedit.lists.alarm_access = <?= $Page->alarm_access->toClientList($Page) ?>;
    fbuilding_access_requestsedit.lists.delete = <?= $Page->delete->toClientList($Page) ?>;
    loadjs.done("fbuilding_access_requestsedit");
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
<form name="fbuilding_access_requestsedit" id="fbuilding_access_requestsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="building_access_requests">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_building_access_requests_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_building_access_requests_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="building_access_requests" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->form_type->Visible) { // form_type ?>
    <div id="r_form_type" class="form-group row">
        <label id="elh_building_access_requests_form_type" for="x_form_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->form_type->caption() ?><?= $Page->form_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->form_type->cellAttributes() ?>>
<span id="el_building_access_requests_form_type">
<input type="<?= $Page->form_type->getInputTextType() ?>" data-table="building_access_requests" data-field="x_form_type" name="x_form_type" id="x_form_type" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->form_type->getPlaceHolder()) ?>" value="<?= $Page->form_type->EditValue ?>"<?= $Page->form_type->editAttributes() ?> aria-describedby="x_form_type_help">
<?= $Page->form_type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->form_type->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->supervisor_name->Visible) { // supervisor_name ?>
    <div id="r_supervisor_name" class="form-group row">
        <label id="elh_building_access_requests_supervisor_name" for="x_supervisor_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->supervisor_name->caption() ?><?= $Page->supervisor_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->supervisor_name->cellAttributes() ?>>
<span id="el_building_access_requests_supervisor_name">
<input type="<?= $Page->supervisor_name->getInputTextType() ?>" data-table="building_access_requests" data-field="x_supervisor_name" name="x_supervisor_name" id="x_supervisor_name" size="30" maxlength="80" placeholder="<?= HtmlEncode($Page->supervisor_name->getPlaceHolder()) ?>" value="<?= $Page->supervisor_name->EditValue ?>"<?= $Page->supervisor_name->editAttributes() ?> aria-describedby="x_supervisor_name_help">
<?= $Page->supervisor_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->supervisor_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->supervisor_phone->Visible) { // supervisor_phone ?>
    <div id="r_supervisor_phone" class="form-group row">
        <label id="elh_building_access_requests_supervisor_phone" for="x_supervisor_phone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->supervisor_phone->caption() ?><?= $Page->supervisor_phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->supervisor_phone->cellAttributes() ?>>
<span id="el_building_access_requests_supervisor_phone">
<input type="<?= $Page->supervisor_phone->getInputTextType() ?>" data-table="building_access_requests" data-field="x_supervisor_phone" name="x_supervisor_phone" id="x_supervisor_phone" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->supervisor_phone->getPlaceHolder()) ?>" value="<?= $Page->supervisor_phone->EditValue ?>"<?= $Page->supervisor_phone->editAttributes() ?> aria-describedby="x_supervisor_phone_help">
<?= $Page->supervisor_phone->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->supervisor_phone->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->employee_first_name->Visible) { // employee_first_name ?>
    <div id="r_employee_first_name" class="form-group row">
        <label id="elh_building_access_requests_employee_first_name" for="x_employee_first_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employee_first_name->caption() ?><?= $Page->employee_first_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->employee_first_name->cellAttributes() ?>>
<span id="el_building_access_requests_employee_first_name">
<input type="<?= $Page->employee_first_name->getInputTextType() ?>" data-table="building_access_requests" data-field="x_employee_first_name" name="x_employee_first_name" id="x_employee_first_name" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->employee_first_name->getPlaceHolder()) ?>" value="<?= $Page->employee_first_name->EditValue ?>"<?= $Page->employee_first_name->editAttributes() ?> aria-describedby="x_employee_first_name_help">
<?= $Page->employee_first_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->employee_first_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->employee_last_name->Visible) { // employee_last_name ?>
    <div id="r_employee_last_name" class="form-group row">
        <label id="elh_building_access_requests_employee_last_name" for="x_employee_last_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employee_last_name->caption() ?><?= $Page->employee_last_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->employee_last_name->cellAttributes() ?>>
<span id="el_building_access_requests_employee_last_name">
<input type="<?= $Page->employee_last_name->getInputTextType() ?>" data-table="building_access_requests" data-field="x_employee_last_name" name="x_employee_last_name" id="x_employee_last_name" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->employee_last_name->getPlaceHolder()) ?>" value="<?= $Page->employee_last_name->EditValue ?>"<?= $Page->employee_last_name->editAttributes() ?> aria-describedby="x_employee_last_name_help">
<?= $Page->employee_last_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->employee_last_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->catcard->Visible) { // catcard ?>
    <div id="r_catcard" class="form-group row">
        <label id="elh_building_access_requests_catcard" for="x_catcard" class="<?= $Page->LeftColumnClass ?>"><?= $Page->catcard->caption() ?><?= $Page->catcard->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->catcard->cellAttributes() ?>>
<span id="el_building_access_requests_catcard">
<input type="<?= $Page->catcard->getInputTextType() ?>" data-table="building_access_requests" data-field="x_catcard" name="x_catcard" id="x_catcard" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->catcard->getPlaceHolder()) ?>" value="<?= $Page->catcard->EditValue ?>"<?= $Page->catcard->editAttributes() ?> aria-describedby="x_catcard_help">
<?= $Page->catcard->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->catcard->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pin->Visible) { // pin ?>
    <div id="r_pin" class="form-group row">
        <label id="elh_building_access_requests_pin" for="x_pin" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pin->caption() ?><?= $Page->pin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->pin->cellAttributes() ?>>
<span id="el_building_access_requests_pin">
<input type="<?= $Page->pin->getInputTextType() ?>" data-table="building_access_requests" data-field="x_pin" name="x_pin" id="x_pin" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->pin->getPlaceHolder()) ?>" value="<?= $Page->pin->EditValue ?>"<?= $Page->pin->editAttributes() ?> aria-describedby="x_pin_help">
<?= $Page->pin->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pin->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->employee_unit->Visible) { // employee_unit ?>
    <div id="r_employee_unit" class="form-group row">
        <label id="elh_building_access_requests_employee_unit" for="x_employee_unit" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employee_unit->caption() ?><?= $Page->employee_unit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->employee_unit->cellAttributes() ?>>
<span id="el_building_access_requests_employee_unit">
<input type="<?= $Page->employee_unit->getInputTextType() ?>" data-table="building_access_requests" data-field="x_employee_unit" name="x_employee_unit" id="x_employee_unit" size="30" maxlength="60" placeholder="<?= HtmlEncode($Page->employee_unit->getPlaceHolder()) ?>" value="<?= $Page->employee_unit->EditValue ?>"<?= $Page->employee_unit->editAttributes() ?> aria-describedby="x_employee_unit_help">
<?= $Page->employee_unit->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->employee_unit->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->employee_id->Visible) { // employee_id ?>
    <div id="r_employee_id" class="form-group row">
        <label id="elh_building_access_requests_employee_id" for="x_employee_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employee_id->caption() ?><?= $Page->employee_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->employee_id->cellAttributes() ?>>
<span id="el_building_access_requests_employee_id">
<input type="<?= $Page->employee_id->getInputTextType() ?>" data-table="building_access_requests" data-field="x_employee_id" name="x_employee_id" id="x_employee_id" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->employee_id->getPlaceHolder()) ?>" value="<?= $Page->employee_id->EditValue ?>"<?= $Page->employee_id->editAttributes() ?> aria-describedby="x_employee_id_help">
<?= $Page->employee_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->employee_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->other_areas->Visible) { // other_areas ?>
    <div id="r_other_areas" class="form-group row">
        <label id="elh_building_access_requests_other_areas" for="x_other_areas" class="<?= $Page->LeftColumnClass ?>"><?= $Page->other_areas->caption() ?><?= $Page->other_areas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->other_areas->cellAttributes() ?>>
<span id="el_building_access_requests_other_areas">
<input type="<?= $Page->other_areas->getInputTextType() ?>" data-table="building_access_requests" data-field="x_other_areas" name="x_other_areas" id="x_other_areas" size="30" maxlength="120" placeholder="<?= HtmlEncode($Page->other_areas->getPlaceHolder()) ?>" value="<?= $Page->other_areas->EditValue ?>"<?= $Page->other_areas->editAttributes() ?> aria-describedby="x_other_areas_help">
<?= $Page->other_areas->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->other_areas->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->alarm_access->Visible) { // alarm_access ?>
    <div id="r_alarm_access" class="form-group row">
        <label id="elh_building_access_requests_alarm_access" class="<?= $Page->LeftColumnClass ?>"><?= $Page->alarm_access->caption() ?><?= $Page->alarm_access->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->alarm_access->cellAttributes() ?>>
<span id="el_building_access_requests_alarm_access">
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" class="custom-control-input<?= $Page->alarm_access->isInvalidClass() ?>" data-table="building_access_requests" data-field="x_alarm_access" name="x_alarm_access[]" id="x_alarm_access_500641" value="1"<?= ConvertToBool($Page->alarm_access->CurrentValue) ? " checked" : "" ?><?= $Page->alarm_access->editAttributes() ?> aria-describedby="x_alarm_access_help">
    <label class="custom-control-label" for="x_alarm_access_500641"></label>
</div>
<?= $Page->alarm_access->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->alarm_access->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->alarm_area->Visible) { // alarm_area ?>
    <div id="r_alarm_area" class="form-group row">
        <label id="elh_building_access_requests_alarm_area" for="x_alarm_area" class="<?= $Page->LeftColumnClass ?>"><?= $Page->alarm_area->caption() ?><?= $Page->alarm_area->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->alarm_area->cellAttributes() ?>>
<span id="el_building_access_requests_alarm_area">
<input type="<?= $Page->alarm_area->getInputTextType() ?>" data-table="building_access_requests" data-field="x_alarm_area" name="x_alarm_area" id="x_alarm_area" size="30" maxlength="80" placeholder="<?= HtmlEncode($Page->alarm_area->getPlaceHolder()) ?>" value="<?= $Page->alarm_area->EditValue ?>"<?= $Page->alarm_area->editAttributes() ?> aria-describedby="x_alarm_area_help">
<?= $Page->alarm_area->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->alarm_area->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->alarm_password->Visible) { // alarm_password ?>
    <div id="r_alarm_password" class="form-group row">
        <label id="elh_building_access_requests_alarm_password" for="x_alarm_password" class="<?= $Page->LeftColumnClass ?>"><?= $Page->alarm_password->caption() ?><?= $Page->alarm_password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->alarm_password->cellAttributes() ?>>
<span id="el_building_access_requests_alarm_password">
<input type="<?= $Page->alarm_password->getInputTextType() ?>" data-table="building_access_requests" data-field="x_alarm_password" name="x_alarm_password" id="x_alarm_password" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->alarm_password->getPlaceHolder()) ?>" value="<?= $Page->alarm_password->EditValue ?>"<?= $Page->alarm_password->editAttributes() ?> aria-describedby="x_alarm_password_help">
<?= $Page->alarm_password->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->alarm_password->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->replacement_catcard->Visible) { // replacement_catcard ?>
    <div id="r_replacement_catcard" class="form-group row">
        <label id="elh_building_access_requests_replacement_catcard" for="x_replacement_catcard" class="<?= $Page->LeftColumnClass ?>"><?= $Page->replacement_catcard->caption() ?><?= $Page->replacement_catcard->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->replacement_catcard->cellAttributes() ?>>
<span id="el_building_access_requests_replacement_catcard">
<input type="<?= $Page->replacement_catcard->getInputTextType() ?>" data-table="building_access_requests" data-field="x_replacement_catcard" name="x_replacement_catcard" id="x_replacement_catcard" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->replacement_catcard->getPlaceHolder()) ?>" value="<?= $Page->replacement_catcard->EditValue ?>"<?= $Page->replacement_catcard->editAttributes() ?> aria-describedby="x_replacement_catcard_help">
<?= $Page->replacement_catcard->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->replacement_catcard->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->replacement_other->Visible) { // replacement_other ?>
    <div id="r_replacement_other" class="form-group row">
        <label id="elh_building_access_requests_replacement_other" for="x_replacement_other" class="<?= $Page->LeftColumnClass ?>"><?= $Page->replacement_other->caption() ?><?= $Page->replacement_other->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->replacement_other->cellAttributes() ?>>
<span id="el_building_access_requests_replacement_other">
<input type="<?= $Page->replacement_other->getInputTextType() ?>" data-table="building_access_requests" data-field="x_replacement_other" name="x_replacement_other" id="x_replacement_other" size="30" maxlength="120" placeholder="<?= HtmlEncode($Page->replacement_other->getPlaceHolder()) ?>" value="<?= $Page->replacement_other->EditValue ?>"<?= $Page->replacement_other->editAttributes() ?> aria-describedby="x_replacement_other_help">
<?= $Page->replacement_other->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->replacement_other->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->replacement_problem->Visible) { // replacement_problem ?>
    <div id="r_replacement_problem" class="form-group row">
        <label id="elh_building_access_requests_replacement_problem" for="x_replacement_problem" class="<?= $Page->LeftColumnClass ?>"><?= $Page->replacement_problem->caption() ?><?= $Page->replacement_problem->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->replacement_problem->cellAttributes() ?>>
<span id="el_building_access_requests_replacement_problem">
<input type="<?= $Page->replacement_problem->getInputTextType() ?>" data-table="building_access_requests" data-field="x_replacement_problem" name="x_replacement_problem" id="x_replacement_problem" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->replacement_problem->getPlaceHolder()) ?>" value="<?= $Page->replacement_problem->EditValue ?>"<?= $Page->replacement_problem->editAttributes() ?> aria-describedby="x_replacement_problem_help">
<?= $Page->replacement_problem->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->replacement_problem->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->delete->Visible) { // delete ?>
    <div id="r_delete" class="form-group row">
        <label id="elh_building_access_requests_delete" class="<?= $Page->LeftColumnClass ?>"><?= $Page->delete->caption() ?><?= $Page->delete->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->delete->cellAttributes() ?>>
<span id="el_building_access_requests_delete">
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" class="custom-control-input<?= $Page->delete->isInvalidClass() ?>" data-table="building_access_requests" data-field="x_delete" name="x_delete[]" id="x_delete_883653" value="1"<?= ConvertToBool($Page->delete->CurrentValue) ? " checked" : "" ?><?= $Page->delete->editAttributes() ?> aria-describedby="x_delete_help">
    <label class="custom-control-label" for="x_delete_883653"></label>
</div>
<?= $Page->delete->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->delete->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
    <div id="r_timestamp" class="form-group row">
        <label id="elh_building_access_requests_timestamp" for="x_timestamp" class="<?= $Page->LeftColumnClass ?>"><?= $Page->timestamp->caption() ?><?= $Page->timestamp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->timestamp->cellAttributes() ?>>
<span id="el_building_access_requests_timestamp">
<input type="<?= $Page->timestamp->getInputTextType() ?>" data-table="building_access_requests" data-field="x_timestamp" name="x_timestamp" id="x_timestamp" placeholder="<?= HtmlEncode($Page->timestamp->getPlaceHolder()) ?>" value="<?= $Page->timestamp->EditValue ?>"<?= $Page->timestamp->editAttributes() ?> aria-describedby="x_timestamp_help">
<?= $Page->timestamp->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->timestamp->getErrorMessage() ?></div>
<?php if (!$Page->timestamp->ReadOnly && !$Page->timestamp->Disabled && !isset($Page->timestamp->EditAttrs["readonly"]) && !isset($Page->timestamp->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbuilding_access_requestsedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fbuilding_access_requestsedit", "x_timestamp", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->net_id->Visible) { // net_id ?>
    <div id="r_net_id" class="form-group row">
        <label id="elh_building_access_requests_net_id" for="x_net_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->net_id->caption() ?><?= $Page->net_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->net_id->cellAttributes() ?>>
<span id="el_building_access_requests_net_id">
<input type="<?= $Page->net_id->getInputTextType() ?>" data-table="building_access_requests" data-field="x_net_id" name="x_net_id" id="x_net_id" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->net_id->getPlaceHolder()) ?>" value="<?= $Page->net_id->EditValue ?>"<?= $Page->net_id->editAttributes() ?> aria-describedby="x_net_id_help">
<?= $Page->net_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->net_id->getErrorMessage() ?></div>
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
    ew.addEventHandlers("building_access_requests");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
