<?php

namespace PHPMaker2021\project4;

// Page object
$ComputerAccessRequestsAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fcomputer_access_requestsadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fcomputer_access_requestsadd = currentForm = new ew.Form("fcomputer_access_requestsadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "computer_access_requests")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.computer_access_requests)
        ew.vars.tables.computer_access_requests = currentTable;
    fcomputer_access_requestsadd.addFields([
        ["supervisor_name", [fields.supervisor_name.visible && fields.supervisor_name.required ? ew.Validators.required(fields.supervisor_name.caption) : null], fields.supervisor_name.isInvalid],
        ["supervisor_phone", [fields.supervisor_phone.visible && fields.supervisor_phone.required ? ew.Validators.required(fields.supervisor_phone.caption) : null], fields.supervisor_phone.isInvalid],
        ["employee_type", [fields.employee_type.visible && fields.employee_type.required ? ew.Validators.required(fields.employee_type.caption) : null], fields.employee_type.isInvalid],
        ["employee_position", [fields.employee_position.visible && fields.employee_position.required ? ew.Validators.required(fields.employee_position.caption) : null], fields.employee_position.isInvalid],
        ["employee_first_name", [fields.employee_first_name.visible && fields.employee_first_name.required ? ew.Validators.required(fields.employee_first_name.caption) : null], fields.employee_first_name.isInvalid],
        ["employee_last_name", [fields.employee_last_name.visible && fields.employee_last_name.required ? ew.Validators.required(fields.employee_last_name.caption) : null], fields.employee_last_name.isInvalid],
        ["employee_title", [fields.employee_title.visible && fields.employee_title.required ? ew.Validators.required(fields.employee_title.caption) : null], fields.employee_title.isInvalid],
        ["employee_email", [fields.employee_email.visible && fields.employee_email.required ? ew.Validators.required(fields.employee_email.caption) : null], fields.employee_email.isInvalid],
        ["employee_phone", [fields.employee_phone.visible && fields.employee_phone.required ? ew.Validators.required(fields.employee_phone.caption) : null], fields.employee_phone.isInvalid],
        ["employee_unit", [fields.employee_unit.visible && fields.employee_unit.required ? ew.Validators.required(fields.employee_unit.caption) : null], fields.employee_unit.isInvalid],
        ["employee_netid", [fields.employee_netid.visible && fields.employee_netid.required ? ew.Validators.required(fields.employee_netid.caption) : null], fields.employee_netid.isInvalid],
        ["employee_id", [fields.employee_id.visible && fields.employee_id.required ? ew.Validators.required(fields.employee_id.caption) : null], fields.employee_id.isInvalid],
        ["location", [fields.location.visible && fields.location.required ? ew.Validators.required(fields.location.caption) : null], fields.location.isInvalid],
        ["access", [fields.access.visible && fields.access.required ? ew.Validators.required(fields.access.caption) : null, ew.Validators.integer], fields.access.isInvalid],
        ["foodpro_location", [fields.foodpro_location.visible && fields.foodpro_location.required ? ew.Validators.required(fields.foodpro_location.caption) : null], fields.foodpro_location.isInvalid],
        ["catcard", [fields.catcard.visible && fields.catcard.required ? ew.Validators.required(fields.catcard.caption) : null], fields.catcard.isInvalid],
        ["register_pin", [fields.register_pin.visible && fields.register_pin.required ? ew.Validators.required(fields.register_pin.caption) : null], fields.register_pin.isInvalid],
        ["other", [fields.other.visible && fields.other.required ? ew.Validators.required(fields.other.caption) : null], fields.other.isInvalid],
        ["timestamp", [fields.timestamp.visible && fields.timestamp.required ? ew.Validators.required(fields.timestamp.caption) : null, ew.Validators.datetime(0)], fields.timestamp.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fcomputer_access_requestsadd,
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
    fcomputer_access_requestsadd.validate = function () {
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
    fcomputer_access_requestsadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fcomputer_access_requestsadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fcomputer_access_requestsadd");
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
<form name="fcomputer_access_requestsadd" id="fcomputer_access_requestsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="computer_access_requests">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->supervisor_name->Visible) { // supervisor_name ?>
    <div id="r_supervisor_name" class="form-group row">
        <label id="elh_computer_access_requests_supervisor_name" for="x_supervisor_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->supervisor_name->caption() ?><?= $Page->supervisor_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->supervisor_name->cellAttributes() ?>>
<span id="el_computer_access_requests_supervisor_name">
<input type="<?= $Page->supervisor_name->getInputTextType() ?>" data-table="computer_access_requests" data-field="x_supervisor_name" name="x_supervisor_name" id="x_supervisor_name" size="30" maxlength="80" placeholder="<?= HtmlEncode($Page->supervisor_name->getPlaceHolder()) ?>" value="<?= $Page->supervisor_name->EditValue ?>"<?= $Page->supervisor_name->editAttributes() ?> aria-describedby="x_supervisor_name_help">
<?= $Page->supervisor_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->supervisor_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->supervisor_phone->Visible) { // supervisor_phone ?>
    <div id="r_supervisor_phone" class="form-group row">
        <label id="elh_computer_access_requests_supervisor_phone" for="x_supervisor_phone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->supervisor_phone->caption() ?><?= $Page->supervisor_phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->supervisor_phone->cellAttributes() ?>>
<span id="el_computer_access_requests_supervisor_phone">
<input type="<?= $Page->supervisor_phone->getInputTextType() ?>" data-table="computer_access_requests" data-field="x_supervisor_phone" name="x_supervisor_phone" id="x_supervisor_phone" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->supervisor_phone->getPlaceHolder()) ?>" value="<?= $Page->supervisor_phone->EditValue ?>"<?= $Page->supervisor_phone->editAttributes() ?> aria-describedby="x_supervisor_phone_help">
<?= $Page->supervisor_phone->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->supervisor_phone->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->employee_type->Visible) { // employee_type ?>
    <div id="r_employee_type" class="form-group row">
        <label id="elh_computer_access_requests_employee_type" for="x_employee_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employee_type->caption() ?><?= $Page->employee_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->employee_type->cellAttributes() ?>>
<span id="el_computer_access_requests_employee_type">
<input type="<?= $Page->employee_type->getInputTextType() ?>" data-table="computer_access_requests" data-field="x_employee_type" name="x_employee_type" id="x_employee_type" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->employee_type->getPlaceHolder()) ?>" value="<?= $Page->employee_type->EditValue ?>"<?= $Page->employee_type->editAttributes() ?> aria-describedby="x_employee_type_help">
<?= $Page->employee_type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->employee_type->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->employee_position->Visible) { // employee_position ?>
    <div id="r_employee_position" class="form-group row">
        <label id="elh_computer_access_requests_employee_position" for="x_employee_position" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employee_position->caption() ?><?= $Page->employee_position->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->employee_position->cellAttributes() ?>>
<span id="el_computer_access_requests_employee_position">
<input type="<?= $Page->employee_position->getInputTextType() ?>" data-table="computer_access_requests" data-field="x_employee_position" name="x_employee_position" id="x_employee_position" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->employee_position->getPlaceHolder()) ?>" value="<?= $Page->employee_position->EditValue ?>"<?= $Page->employee_position->editAttributes() ?> aria-describedby="x_employee_position_help">
<?= $Page->employee_position->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->employee_position->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->employee_first_name->Visible) { // employee_first_name ?>
    <div id="r_employee_first_name" class="form-group row">
        <label id="elh_computer_access_requests_employee_first_name" for="x_employee_first_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employee_first_name->caption() ?><?= $Page->employee_first_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->employee_first_name->cellAttributes() ?>>
<span id="el_computer_access_requests_employee_first_name">
<input type="<?= $Page->employee_first_name->getInputTextType() ?>" data-table="computer_access_requests" data-field="x_employee_first_name" name="x_employee_first_name" id="x_employee_first_name" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->employee_first_name->getPlaceHolder()) ?>" value="<?= $Page->employee_first_name->EditValue ?>"<?= $Page->employee_first_name->editAttributes() ?> aria-describedby="x_employee_first_name_help">
<?= $Page->employee_first_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->employee_first_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->employee_last_name->Visible) { // employee_last_name ?>
    <div id="r_employee_last_name" class="form-group row">
        <label id="elh_computer_access_requests_employee_last_name" for="x_employee_last_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employee_last_name->caption() ?><?= $Page->employee_last_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->employee_last_name->cellAttributes() ?>>
<span id="el_computer_access_requests_employee_last_name">
<input type="<?= $Page->employee_last_name->getInputTextType() ?>" data-table="computer_access_requests" data-field="x_employee_last_name" name="x_employee_last_name" id="x_employee_last_name" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->employee_last_name->getPlaceHolder()) ?>" value="<?= $Page->employee_last_name->EditValue ?>"<?= $Page->employee_last_name->editAttributes() ?> aria-describedby="x_employee_last_name_help">
<?= $Page->employee_last_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->employee_last_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->employee_title->Visible) { // employee_title ?>
    <div id="r_employee_title" class="form-group row">
        <label id="elh_computer_access_requests_employee_title" for="x_employee_title" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employee_title->caption() ?><?= $Page->employee_title->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->employee_title->cellAttributes() ?>>
<span id="el_computer_access_requests_employee_title">
<input type="<?= $Page->employee_title->getInputTextType() ?>" data-table="computer_access_requests" data-field="x_employee_title" name="x_employee_title" id="x_employee_title" size="30" maxlength="80" placeholder="<?= HtmlEncode($Page->employee_title->getPlaceHolder()) ?>" value="<?= $Page->employee_title->EditValue ?>"<?= $Page->employee_title->editAttributes() ?> aria-describedby="x_employee_title_help">
<?= $Page->employee_title->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->employee_title->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->employee_email->Visible) { // employee_email ?>
    <div id="r_employee_email" class="form-group row">
        <label id="elh_computer_access_requests_employee_email" for="x_employee_email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employee_email->caption() ?><?= $Page->employee_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->employee_email->cellAttributes() ?>>
<span id="el_computer_access_requests_employee_email">
<input type="<?= $Page->employee_email->getInputTextType() ?>" data-table="computer_access_requests" data-field="x_employee_email" name="x_employee_email" id="x_employee_email" size="30" maxlength="80" placeholder="<?= HtmlEncode($Page->employee_email->getPlaceHolder()) ?>" value="<?= $Page->employee_email->EditValue ?>"<?= $Page->employee_email->editAttributes() ?> aria-describedby="x_employee_email_help">
<?= $Page->employee_email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->employee_email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->employee_phone->Visible) { // employee_phone ?>
    <div id="r_employee_phone" class="form-group row">
        <label id="elh_computer_access_requests_employee_phone" for="x_employee_phone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employee_phone->caption() ?><?= $Page->employee_phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->employee_phone->cellAttributes() ?>>
<span id="el_computer_access_requests_employee_phone">
<input type="<?= $Page->employee_phone->getInputTextType() ?>" data-table="computer_access_requests" data-field="x_employee_phone" name="x_employee_phone" id="x_employee_phone" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->employee_phone->getPlaceHolder()) ?>" value="<?= $Page->employee_phone->EditValue ?>"<?= $Page->employee_phone->editAttributes() ?> aria-describedby="x_employee_phone_help">
<?= $Page->employee_phone->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->employee_phone->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->employee_unit->Visible) { // employee_unit ?>
    <div id="r_employee_unit" class="form-group row">
        <label id="elh_computer_access_requests_employee_unit" for="x_employee_unit" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employee_unit->caption() ?><?= $Page->employee_unit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->employee_unit->cellAttributes() ?>>
<span id="el_computer_access_requests_employee_unit">
<input type="<?= $Page->employee_unit->getInputTextType() ?>" data-table="computer_access_requests" data-field="x_employee_unit" name="x_employee_unit" id="x_employee_unit" size="30" maxlength="60" placeholder="<?= HtmlEncode($Page->employee_unit->getPlaceHolder()) ?>" value="<?= $Page->employee_unit->EditValue ?>"<?= $Page->employee_unit->editAttributes() ?> aria-describedby="x_employee_unit_help">
<?= $Page->employee_unit->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->employee_unit->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->employee_netid->Visible) { // employee_netid ?>
    <div id="r_employee_netid" class="form-group row">
        <label id="elh_computer_access_requests_employee_netid" for="x_employee_netid" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employee_netid->caption() ?><?= $Page->employee_netid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->employee_netid->cellAttributes() ?>>
<span id="el_computer_access_requests_employee_netid">
<input type="<?= $Page->employee_netid->getInputTextType() ?>" data-table="computer_access_requests" data-field="x_employee_netid" name="x_employee_netid" id="x_employee_netid" size="30" maxlength="60" placeholder="<?= HtmlEncode($Page->employee_netid->getPlaceHolder()) ?>" value="<?= $Page->employee_netid->EditValue ?>"<?= $Page->employee_netid->editAttributes() ?> aria-describedby="x_employee_netid_help">
<?= $Page->employee_netid->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->employee_netid->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->employee_id->Visible) { // employee_id ?>
    <div id="r_employee_id" class="form-group row">
        <label id="elh_computer_access_requests_employee_id" for="x_employee_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employee_id->caption() ?><?= $Page->employee_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->employee_id->cellAttributes() ?>>
<span id="el_computer_access_requests_employee_id">
<input type="<?= $Page->employee_id->getInputTextType() ?>" data-table="computer_access_requests" data-field="x_employee_id" name="x_employee_id" id="x_employee_id" size="30" maxlength="30" placeholder="<?= HtmlEncode($Page->employee_id->getPlaceHolder()) ?>" value="<?= $Page->employee_id->EditValue ?>"<?= $Page->employee_id->editAttributes() ?> aria-describedby="x_employee_id_help">
<?= $Page->employee_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->employee_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
    <div id="r_location" class="form-group row">
        <label id="elh_computer_access_requests_location" for="x_location" class="<?= $Page->LeftColumnClass ?>"><?= $Page->location->caption() ?><?= $Page->location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->location->cellAttributes() ?>>
<span id="el_computer_access_requests_location">
<input type="<?= $Page->location->getInputTextType() ?>" data-table="computer_access_requests" data-field="x_location" name="x_location" id="x_location" size="30" maxlength="140" placeholder="<?= HtmlEncode($Page->location->getPlaceHolder()) ?>" value="<?= $Page->location->EditValue ?>"<?= $Page->location->editAttributes() ?> aria-describedby="x_location_help">
<?= $Page->location->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->location->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->access->Visible) { // access ?>
    <div id="r_access" class="form-group row">
        <label id="elh_computer_access_requests_access" for="x_access" class="<?= $Page->LeftColumnClass ?>"><?= $Page->access->caption() ?><?= $Page->access->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->access->cellAttributes() ?>>
<span id="el_computer_access_requests_access">
<input type="<?= $Page->access->getInputTextType() ?>" data-table="computer_access_requests" data-field="x_access" name="x_access" id="x_access" size="30" placeholder="<?= HtmlEncode($Page->access->getPlaceHolder()) ?>" value="<?= $Page->access->EditValue ?>"<?= $Page->access->editAttributes() ?> aria-describedby="x_access_help">
<?= $Page->access->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->access->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->foodpro_location->Visible) { // foodpro_location ?>
    <div id="r_foodpro_location" class="form-group row">
        <label id="elh_computer_access_requests_foodpro_location" for="x_foodpro_location" class="<?= $Page->LeftColumnClass ?>"><?= $Page->foodpro_location->caption() ?><?= $Page->foodpro_location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->foodpro_location->cellAttributes() ?>>
<span id="el_computer_access_requests_foodpro_location">
<input type="<?= $Page->foodpro_location->getInputTextType() ?>" data-table="computer_access_requests" data-field="x_foodpro_location" name="x_foodpro_location" id="x_foodpro_location" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->foodpro_location->getPlaceHolder()) ?>" value="<?= $Page->foodpro_location->EditValue ?>"<?= $Page->foodpro_location->editAttributes() ?> aria-describedby="x_foodpro_location_help">
<?= $Page->foodpro_location->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->foodpro_location->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->catcard->Visible) { // catcard ?>
    <div id="r_catcard" class="form-group row">
        <label id="elh_computer_access_requests_catcard" for="x_catcard" class="<?= $Page->LeftColumnClass ?>"><?= $Page->catcard->caption() ?><?= $Page->catcard->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->catcard->cellAttributes() ?>>
<span id="el_computer_access_requests_catcard">
<input type="<?= $Page->catcard->getInputTextType() ?>" data-table="computer_access_requests" data-field="x_catcard" name="x_catcard" id="x_catcard" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->catcard->getPlaceHolder()) ?>" value="<?= $Page->catcard->EditValue ?>"<?= $Page->catcard->editAttributes() ?> aria-describedby="x_catcard_help">
<?= $Page->catcard->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->catcard->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->register_pin->Visible) { // register_pin ?>
    <div id="r_register_pin" class="form-group row">
        <label id="elh_computer_access_requests_register_pin" for="x_register_pin" class="<?= $Page->LeftColumnClass ?>"><?= $Page->register_pin->caption() ?><?= $Page->register_pin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->register_pin->cellAttributes() ?>>
<span id="el_computer_access_requests_register_pin">
<input type="<?= $Page->register_pin->getInputTextType() ?>" data-table="computer_access_requests" data-field="x_register_pin" name="x_register_pin" id="x_register_pin" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->register_pin->getPlaceHolder()) ?>" value="<?= $Page->register_pin->EditValue ?>"<?= $Page->register_pin->editAttributes() ?> aria-describedby="x_register_pin_help">
<?= $Page->register_pin->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->register_pin->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->other->Visible) { // other ?>
    <div id="r_other" class="form-group row">
        <label id="elh_computer_access_requests_other" for="x_other" class="<?= $Page->LeftColumnClass ?>"><?= $Page->other->caption() ?><?= $Page->other->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->other->cellAttributes() ?>>
<span id="el_computer_access_requests_other">
<input type="<?= $Page->other->getInputTextType() ?>" data-table="computer_access_requests" data-field="x_other" name="x_other" id="x_other" size="30" maxlength="250" placeholder="<?= HtmlEncode($Page->other->getPlaceHolder()) ?>" value="<?= $Page->other->EditValue ?>"<?= $Page->other->editAttributes() ?> aria-describedby="x_other_help">
<?= $Page->other->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->other->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
    <div id="r_timestamp" class="form-group row">
        <label id="elh_computer_access_requests_timestamp" for="x_timestamp" class="<?= $Page->LeftColumnClass ?>"><?= $Page->timestamp->caption() ?><?= $Page->timestamp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->timestamp->cellAttributes() ?>>
<span id="el_computer_access_requests_timestamp">
<input type="<?= $Page->timestamp->getInputTextType() ?>" data-table="computer_access_requests" data-field="x_timestamp" name="x_timestamp" id="x_timestamp" placeholder="<?= HtmlEncode($Page->timestamp->getPlaceHolder()) ?>" value="<?= $Page->timestamp->EditValue ?>"<?= $Page->timestamp->editAttributes() ?> aria-describedby="x_timestamp_help">
<?= $Page->timestamp->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->timestamp->getErrorMessage() ?></div>
<?php if (!$Page->timestamp->ReadOnly && !$Page->timestamp->Disabled && !isset($Page->timestamp->EditAttrs["readonly"]) && !isset($Page->timestamp->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcomputer_access_requestsadd", "datetimepicker"], function() {
    ew.createDateTimePicker("fcomputer_access_requestsadd", "x_timestamp", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
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
    ew.addEventHandlers("computer_access_requests");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
