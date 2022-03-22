<?php

namespace PHPMaker2021\project4;

// Page object
$WorkstationAccessRequestsEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fworkstation_access_requestsedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fworkstation_access_requestsedit = currentForm = new ew.Form("fworkstation_access_requestsedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "workstation_access_requests")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.workstation_access_requests)
        ew.vars.tables.workstation_access_requests = currentTable;
    fworkstation_access_requestsedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["supervisor_name", [fields.supervisor_name.visible && fields.supervisor_name.required ? ew.Validators.required(fields.supervisor_name.caption) : null], fields.supervisor_name.isInvalid],
        ["supervisor_phone", [fields.supervisor_phone.visible && fields.supervisor_phone.required ? ew.Validators.required(fields.supervisor_phone.caption) : null], fields.supervisor_phone.isInvalid],
        ["request_type", [fields.request_type.visible && fields.request_type.required ? ew.Validators.required(fields.request_type.caption) : null], fields.request_type.isInvalid],
        ["employee_position", [fields.employee_position.visible && fields.employee_position.required ? ew.Validators.required(fields.employee_position.caption) : null], fields.employee_position.isInvalid],
        ["employee_first_name", [fields.employee_first_name.visible && fields.employee_first_name.required ? ew.Validators.required(fields.employee_first_name.caption) : null], fields.employee_first_name.isInvalid],
        ["employee_last_name", [fields.employee_last_name.visible && fields.employee_last_name.required ? ew.Validators.required(fields.employee_last_name.caption) : null], fields.employee_last_name.isInvalid],
        ["employee_title", [fields.employee_title.visible && fields.employee_title.required ? ew.Validators.required(fields.employee_title.caption) : null], fields.employee_title.isInvalid],
        ["employee_email", [fields.employee_email.visible && fields.employee_email.required ? ew.Validators.required(fields.employee_email.caption) : null], fields.employee_email.isInvalid],
        ["employee_phone", [fields.employee_phone.visible && fields.employee_phone.required ? ew.Validators.required(fields.employee_phone.caption) : null], fields.employee_phone.isInvalid],
        ["employee_unit", [fields.employee_unit.visible && fields.employee_unit.required ? ew.Validators.required(fields.employee_unit.caption) : null], fields.employee_unit.isInvalid],
        ["employee_netid", [fields.employee_netid.visible && fields.employee_netid.required ? ew.Validators.required(fields.employee_netid.caption) : null], fields.employee_netid.isInvalid],
        ["workstation_tag", [fields.workstation_tag.visible && fields.workstation_tag.required ? ew.Validators.required(fields.workstation_tag.caption) : null], fields.workstation_tag.isInvalid],
        ["access", [fields.access.visible && fields.access.required ? ew.Validators.required(fields.access.caption) : null, ew.Validators.integer], fields.access.isInvalid],
        ["foodpro_location", [fields.foodpro_location.visible && fields.foodpro_location.required ? ew.Validators.required(fields.foodpro_location.caption) : null], fields.foodpro_location.isInvalid],
        ["updates", [fields.updates.visible && fields.updates.required ? ew.Validators.required(fields.updates.caption) : null, ew.Validators.integer], fields.updates.isInvalid],
        ["comments", [fields.comments.visible && fields.comments.required ? ew.Validators.required(fields.comments.caption) : null], fields.comments.isInvalid],
        ["timestamp", [fields.timestamp.visible && fields.timestamp.required ? ew.Validators.required(fields.timestamp.caption) : null, ew.Validators.datetime(0)], fields.timestamp.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fworkstation_access_requestsedit,
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
    fworkstation_access_requestsedit.validate = function () {
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
    fworkstation_access_requestsedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fworkstation_access_requestsedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fworkstation_access_requestsedit");
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
<form name="fworkstation_access_requestsedit" id="fworkstation_access_requestsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="workstation_access_requests">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_workstation_access_requests_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_workstation_access_requests_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="workstation_access_requests" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->supervisor_name->Visible) { // supervisor_name ?>
    <div id="r_supervisor_name" class="form-group row">
        <label id="elh_workstation_access_requests_supervisor_name" for="x_supervisor_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->supervisor_name->caption() ?><?= $Page->supervisor_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->supervisor_name->cellAttributes() ?>>
<span id="el_workstation_access_requests_supervisor_name">
<input type="<?= $Page->supervisor_name->getInputTextType() ?>" data-table="workstation_access_requests" data-field="x_supervisor_name" name="x_supervisor_name" id="x_supervisor_name" size="30" maxlength="80" placeholder="<?= HtmlEncode($Page->supervisor_name->getPlaceHolder()) ?>" value="<?= $Page->supervisor_name->EditValue ?>"<?= $Page->supervisor_name->editAttributes() ?> aria-describedby="x_supervisor_name_help">
<?= $Page->supervisor_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->supervisor_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->supervisor_phone->Visible) { // supervisor_phone ?>
    <div id="r_supervisor_phone" class="form-group row">
        <label id="elh_workstation_access_requests_supervisor_phone" for="x_supervisor_phone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->supervisor_phone->caption() ?><?= $Page->supervisor_phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->supervisor_phone->cellAttributes() ?>>
<span id="el_workstation_access_requests_supervisor_phone">
<input type="<?= $Page->supervisor_phone->getInputTextType() ?>" data-table="workstation_access_requests" data-field="x_supervisor_phone" name="x_supervisor_phone" id="x_supervisor_phone" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->supervisor_phone->getPlaceHolder()) ?>" value="<?= $Page->supervisor_phone->EditValue ?>"<?= $Page->supervisor_phone->editAttributes() ?> aria-describedby="x_supervisor_phone_help">
<?= $Page->supervisor_phone->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->supervisor_phone->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->request_type->Visible) { // request_type ?>
    <div id="r_request_type" class="form-group row">
        <label id="elh_workstation_access_requests_request_type" for="x_request_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->request_type->caption() ?><?= $Page->request_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->request_type->cellAttributes() ?>>
<span id="el_workstation_access_requests_request_type">
<input type="<?= $Page->request_type->getInputTextType() ?>" data-table="workstation_access_requests" data-field="x_request_type" name="x_request_type" id="x_request_type" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->request_type->getPlaceHolder()) ?>" value="<?= $Page->request_type->EditValue ?>"<?= $Page->request_type->editAttributes() ?> aria-describedby="x_request_type_help">
<?= $Page->request_type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->request_type->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->employee_position->Visible) { // employee_position ?>
    <div id="r_employee_position" class="form-group row">
        <label id="elh_workstation_access_requests_employee_position" for="x_employee_position" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employee_position->caption() ?><?= $Page->employee_position->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->employee_position->cellAttributes() ?>>
<span id="el_workstation_access_requests_employee_position">
<input type="<?= $Page->employee_position->getInputTextType() ?>" data-table="workstation_access_requests" data-field="x_employee_position" name="x_employee_position" id="x_employee_position" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->employee_position->getPlaceHolder()) ?>" value="<?= $Page->employee_position->EditValue ?>"<?= $Page->employee_position->editAttributes() ?> aria-describedby="x_employee_position_help">
<?= $Page->employee_position->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->employee_position->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->employee_first_name->Visible) { // employee_first_name ?>
    <div id="r_employee_first_name" class="form-group row">
        <label id="elh_workstation_access_requests_employee_first_name" for="x_employee_first_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employee_first_name->caption() ?><?= $Page->employee_first_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->employee_first_name->cellAttributes() ?>>
<span id="el_workstation_access_requests_employee_first_name">
<input type="<?= $Page->employee_first_name->getInputTextType() ?>" data-table="workstation_access_requests" data-field="x_employee_first_name" name="x_employee_first_name" id="x_employee_first_name" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->employee_first_name->getPlaceHolder()) ?>" value="<?= $Page->employee_first_name->EditValue ?>"<?= $Page->employee_first_name->editAttributes() ?> aria-describedby="x_employee_first_name_help">
<?= $Page->employee_first_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->employee_first_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->employee_last_name->Visible) { // employee_last_name ?>
    <div id="r_employee_last_name" class="form-group row">
        <label id="elh_workstation_access_requests_employee_last_name" for="x_employee_last_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employee_last_name->caption() ?><?= $Page->employee_last_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->employee_last_name->cellAttributes() ?>>
<span id="el_workstation_access_requests_employee_last_name">
<input type="<?= $Page->employee_last_name->getInputTextType() ?>" data-table="workstation_access_requests" data-field="x_employee_last_name" name="x_employee_last_name" id="x_employee_last_name" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->employee_last_name->getPlaceHolder()) ?>" value="<?= $Page->employee_last_name->EditValue ?>"<?= $Page->employee_last_name->editAttributes() ?> aria-describedby="x_employee_last_name_help">
<?= $Page->employee_last_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->employee_last_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->employee_title->Visible) { // employee_title ?>
    <div id="r_employee_title" class="form-group row">
        <label id="elh_workstation_access_requests_employee_title" for="x_employee_title" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employee_title->caption() ?><?= $Page->employee_title->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->employee_title->cellAttributes() ?>>
<span id="el_workstation_access_requests_employee_title">
<input type="<?= $Page->employee_title->getInputTextType() ?>" data-table="workstation_access_requests" data-field="x_employee_title" name="x_employee_title" id="x_employee_title" size="30" maxlength="80" placeholder="<?= HtmlEncode($Page->employee_title->getPlaceHolder()) ?>" value="<?= $Page->employee_title->EditValue ?>"<?= $Page->employee_title->editAttributes() ?> aria-describedby="x_employee_title_help">
<?= $Page->employee_title->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->employee_title->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->employee_email->Visible) { // employee_email ?>
    <div id="r_employee_email" class="form-group row">
        <label id="elh_workstation_access_requests_employee_email" for="x_employee_email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employee_email->caption() ?><?= $Page->employee_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->employee_email->cellAttributes() ?>>
<span id="el_workstation_access_requests_employee_email">
<input type="<?= $Page->employee_email->getInputTextType() ?>" data-table="workstation_access_requests" data-field="x_employee_email" name="x_employee_email" id="x_employee_email" size="30" maxlength="80" placeholder="<?= HtmlEncode($Page->employee_email->getPlaceHolder()) ?>" value="<?= $Page->employee_email->EditValue ?>"<?= $Page->employee_email->editAttributes() ?> aria-describedby="x_employee_email_help">
<?= $Page->employee_email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->employee_email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->employee_phone->Visible) { // employee_phone ?>
    <div id="r_employee_phone" class="form-group row">
        <label id="elh_workstation_access_requests_employee_phone" for="x_employee_phone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employee_phone->caption() ?><?= $Page->employee_phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->employee_phone->cellAttributes() ?>>
<span id="el_workstation_access_requests_employee_phone">
<input type="<?= $Page->employee_phone->getInputTextType() ?>" data-table="workstation_access_requests" data-field="x_employee_phone" name="x_employee_phone" id="x_employee_phone" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->employee_phone->getPlaceHolder()) ?>" value="<?= $Page->employee_phone->EditValue ?>"<?= $Page->employee_phone->editAttributes() ?> aria-describedby="x_employee_phone_help">
<?= $Page->employee_phone->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->employee_phone->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->employee_unit->Visible) { // employee_unit ?>
    <div id="r_employee_unit" class="form-group row">
        <label id="elh_workstation_access_requests_employee_unit" for="x_employee_unit" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employee_unit->caption() ?><?= $Page->employee_unit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->employee_unit->cellAttributes() ?>>
<span id="el_workstation_access_requests_employee_unit">
<input type="<?= $Page->employee_unit->getInputTextType() ?>" data-table="workstation_access_requests" data-field="x_employee_unit" name="x_employee_unit" id="x_employee_unit" size="30" maxlength="60" placeholder="<?= HtmlEncode($Page->employee_unit->getPlaceHolder()) ?>" value="<?= $Page->employee_unit->EditValue ?>"<?= $Page->employee_unit->editAttributes() ?> aria-describedby="x_employee_unit_help">
<?= $Page->employee_unit->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->employee_unit->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->employee_netid->Visible) { // employee_netid ?>
    <div id="r_employee_netid" class="form-group row">
        <label id="elh_workstation_access_requests_employee_netid" for="x_employee_netid" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employee_netid->caption() ?><?= $Page->employee_netid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->employee_netid->cellAttributes() ?>>
<span id="el_workstation_access_requests_employee_netid">
<input type="<?= $Page->employee_netid->getInputTextType() ?>" data-table="workstation_access_requests" data-field="x_employee_netid" name="x_employee_netid" id="x_employee_netid" size="30" maxlength="60" placeholder="<?= HtmlEncode($Page->employee_netid->getPlaceHolder()) ?>" value="<?= $Page->employee_netid->EditValue ?>"<?= $Page->employee_netid->editAttributes() ?> aria-describedby="x_employee_netid_help">
<?= $Page->employee_netid->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->employee_netid->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->workstation_tag->Visible) { // workstation_tag ?>
    <div id="r_workstation_tag" class="form-group row">
        <label id="elh_workstation_access_requests_workstation_tag" for="x_workstation_tag" class="<?= $Page->LeftColumnClass ?>"><?= $Page->workstation_tag->caption() ?><?= $Page->workstation_tag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->workstation_tag->cellAttributes() ?>>
<span id="el_workstation_access_requests_workstation_tag">
<input type="<?= $Page->workstation_tag->getInputTextType() ?>" data-table="workstation_access_requests" data-field="x_workstation_tag" name="x_workstation_tag" id="x_workstation_tag" size="30" maxlength="140" placeholder="<?= HtmlEncode($Page->workstation_tag->getPlaceHolder()) ?>" value="<?= $Page->workstation_tag->EditValue ?>"<?= $Page->workstation_tag->editAttributes() ?> aria-describedby="x_workstation_tag_help">
<?= $Page->workstation_tag->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->workstation_tag->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->access->Visible) { // access ?>
    <div id="r_access" class="form-group row">
        <label id="elh_workstation_access_requests_access" for="x_access" class="<?= $Page->LeftColumnClass ?>"><?= $Page->access->caption() ?><?= $Page->access->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->access->cellAttributes() ?>>
<span id="el_workstation_access_requests_access">
<input type="<?= $Page->access->getInputTextType() ?>" data-table="workstation_access_requests" data-field="x_access" name="x_access" id="x_access" size="30" placeholder="<?= HtmlEncode($Page->access->getPlaceHolder()) ?>" value="<?= $Page->access->EditValue ?>"<?= $Page->access->editAttributes() ?> aria-describedby="x_access_help">
<?= $Page->access->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->access->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->foodpro_location->Visible) { // foodpro_location ?>
    <div id="r_foodpro_location" class="form-group row">
        <label id="elh_workstation_access_requests_foodpro_location" for="x_foodpro_location" class="<?= $Page->LeftColumnClass ?>"><?= $Page->foodpro_location->caption() ?><?= $Page->foodpro_location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->foodpro_location->cellAttributes() ?>>
<span id="el_workstation_access_requests_foodpro_location">
<input type="<?= $Page->foodpro_location->getInputTextType() ?>" data-table="workstation_access_requests" data-field="x_foodpro_location" name="x_foodpro_location" id="x_foodpro_location" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->foodpro_location->getPlaceHolder()) ?>" value="<?= $Page->foodpro_location->EditValue ?>"<?= $Page->foodpro_location->editAttributes() ?> aria-describedby="x_foodpro_location_help">
<?= $Page->foodpro_location->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->foodpro_location->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->updates->Visible) { // updates ?>
    <div id="r_updates" class="form-group row">
        <label id="elh_workstation_access_requests_updates" for="x_updates" class="<?= $Page->LeftColumnClass ?>"><?= $Page->updates->caption() ?><?= $Page->updates->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->updates->cellAttributes() ?>>
<span id="el_workstation_access_requests_updates">
<input type="<?= $Page->updates->getInputTextType() ?>" data-table="workstation_access_requests" data-field="x_updates" name="x_updates" id="x_updates" size="30" placeholder="<?= HtmlEncode($Page->updates->getPlaceHolder()) ?>" value="<?= $Page->updates->EditValue ?>"<?= $Page->updates->editAttributes() ?> aria-describedby="x_updates_help">
<?= $Page->updates->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->updates->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->comments->Visible) { // comments ?>
    <div id="r_comments" class="form-group row">
        <label id="elh_workstation_access_requests_comments" for="x_comments" class="<?= $Page->LeftColumnClass ?>"><?= $Page->comments->caption() ?><?= $Page->comments->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->comments->cellAttributes() ?>>
<span id="el_workstation_access_requests_comments">
<input type="<?= $Page->comments->getInputTextType() ?>" data-table="workstation_access_requests" data-field="x_comments" name="x_comments" id="x_comments" size="30" maxlength="250" placeholder="<?= HtmlEncode($Page->comments->getPlaceHolder()) ?>" value="<?= $Page->comments->EditValue ?>"<?= $Page->comments->editAttributes() ?> aria-describedby="x_comments_help">
<?= $Page->comments->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->comments->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
    <div id="r_timestamp" class="form-group row">
        <label id="elh_workstation_access_requests_timestamp" for="x_timestamp" class="<?= $Page->LeftColumnClass ?>"><?= $Page->timestamp->caption() ?><?= $Page->timestamp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->timestamp->cellAttributes() ?>>
<span id="el_workstation_access_requests_timestamp">
<input type="<?= $Page->timestamp->getInputTextType() ?>" data-table="workstation_access_requests" data-field="x_timestamp" name="x_timestamp" id="x_timestamp" placeholder="<?= HtmlEncode($Page->timestamp->getPlaceHolder()) ?>" value="<?= $Page->timestamp->EditValue ?>"<?= $Page->timestamp->editAttributes() ?> aria-describedby="x_timestamp_help">
<?= $Page->timestamp->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->timestamp->getErrorMessage() ?></div>
<?php if (!$Page->timestamp->ReadOnly && !$Page->timestamp->Disabled && !isset($Page->timestamp->EditAttrs["readonly"]) && !isset($Page->timestamp->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fworkstation_access_requestsedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fworkstation_access_requestsedit", "x_timestamp", {"ignoreReadonly":true,"useCurrent":false,"format":0});
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
    ew.addEventHandlers("workstation_access_requests");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
