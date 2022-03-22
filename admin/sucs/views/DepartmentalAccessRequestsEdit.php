<?php

namespace PHPMaker2021\project4;

// Page object
$DepartmentalAccessRequestsEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fdepartmental_access_requestsedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fdepartmental_access_requestsedit = currentForm = new ew.Form("fdepartmental_access_requestsedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "departmental_access_requests")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.departmental_access_requests)
        ew.vars.tables.departmental_access_requests = currentTable;
    fdepartmental_access_requestsedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["supervisor_name", [fields.supervisor_name.visible && fields.supervisor_name.required ? ew.Validators.required(fields.supervisor_name.caption) : null], fields.supervisor_name.isInvalid],
        ["supervisor_phone", [fields.supervisor_phone.visible && fields.supervisor_phone.required ? ew.Validators.required(fields.supervisor_phone.caption) : null], fields.supervisor_phone.isInvalid],
        ["supervisor_email", [fields.supervisor_email.visible && fields.supervisor_email.required ? ew.Validators.required(fields.supervisor_email.caption) : null], fields.supervisor_email.isInvalid],
        ["employee_first_name", [fields.employee_first_name.visible && fields.employee_first_name.required ? ew.Validators.required(fields.employee_first_name.caption) : null], fields.employee_first_name.isInvalid],
        ["employee_last_name", [fields.employee_last_name.visible && fields.employee_last_name.required ? ew.Validators.required(fields.employee_last_name.caption) : null], fields.employee_last_name.isInvalid],
        ["employee_netid", [fields.employee_netid.visible && fields.employee_netid.required ? ew.Validators.required(fields.employee_netid.caption) : null], fields.employee_netid.isInvalid],
        ["new_catwork", [fields.new_catwork.visible && fields.new_catwork.required ? ew.Validators.required(fields.new_catwork.caption) : null], fields.new_catwork.isInvalid],
        ["delete", [fields.delete.visible && fields.delete.required ? ew.Validators.required(fields.delete.caption) : null], fields.delete.isInvalid],
        ["timestamp", [fields.timestamp.visible && fields.timestamp.required ? ew.Validators.required(fields.timestamp.caption) : null, ew.Validators.datetime(0)], fields.timestamp.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fdepartmental_access_requestsedit,
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
    fdepartmental_access_requestsedit.validate = function () {
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
    fdepartmental_access_requestsedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fdepartmental_access_requestsedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fdepartmental_access_requestsedit.lists.new_catwork = <?= $Page->new_catwork->toClientList($Page) ?>;
    fdepartmental_access_requestsedit.lists.delete = <?= $Page->delete->toClientList($Page) ?>;
    loadjs.done("fdepartmental_access_requestsedit");
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
<form name="fdepartmental_access_requestsedit" id="fdepartmental_access_requestsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="departmental_access_requests">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_departmental_access_requests_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_departmental_access_requests_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="departmental_access_requests" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->supervisor_name->Visible) { // supervisor_name ?>
    <div id="r_supervisor_name" class="form-group row">
        <label id="elh_departmental_access_requests_supervisor_name" for="x_supervisor_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->supervisor_name->caption() ?><?= $Page->supervisor_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->supervisor_name->cellAttributes() ?>>
<span id="el_departmental_access_requests_supervisor_name">
<input type="<?= $Page->supervisor_name->getInputTextType() ?>" data-table="departmental_access_requests" data-field="x_supervisor_name" name="x_supervisor_name" id="x_supervisor_name" size="30" maxlength="80" placeholder="<?= HtmlEncode($Page->supervisor_name->getPlaceHolder()) ?>" value="<?= $Page->supervisor_name->EditValue ?>"<?= $Page->supervisor_name->editAttributes() ?> aria-describedby="x_supervisor_name_help">
<?= $Page->supervisor_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->supervisor_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->supervisor_phone->Visible) { // supervisor_phone ?>
    <div id="r_supervisor_phone" class="form-group row">
        <label id="elh_departmental_access_requests_supervisor_phone" for="x_supervisor_phone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->supervisor_phone->caption() ?><?= $Page->supervisor_phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->supervisor_phone->cellAttributes() ?>>
<span id="el_departmental_access_requests_supervisor_phone">
<input type="<?= $Page->supervisor_phone->getInputTextType() ?>" data-table="departmental_access_requests" data-field="x_supervisor_phone" name="x_supervisor_phone" id="x_supervisor_phone" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->supervisor_phone->getPlaceHolder()) ?>" value="<?= $Page->supervisor_phone->EditValue ?>"<?= $Page->supervisor_phone->editAttributes() ?> aria-describedby="x_supervisor_phone_help">
<?= $Page->supervisor_phone->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->supervisor_phone->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->supervisor_email->Visible) { // supervisor_email ?>
    <div id="r_supervisor_email" class="form-group row">
        <label id="elh_departmental_access_requests_supervisor_email" for="x_supervisor_email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->supervisor_email->caption() ?><?= $Page->supervisor_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->supervisor_email->cellAttributes() ?>>
<span id="el_departmental_access_requests_supervisor_email">
<input type="<?= $Page->supervisor_email->getInputTextType() ?>" data-table="departmental_access_requests" data-field="x_supervisor_email" name="x_supervisor_email" id="x_supervisor_email" size="30" maxlength="80" placeholder="<?= HtmlEncode($Page->supervisor_email->getPlaceHolder()) ?>" value="<?= $Page->supervisor_email->EditValue ?>"<?= $Page->supervisor_email->editAttributes() ?> aria-describedby="x_supervisor_email_help">
<?= $Page->supervisor_email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->supervisor_email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->employee_first_name->Visible) { // employee_first_name ?>
    <div id="r_employee_first_name" class="form-group row">
        <label id="elh_departmental_access_requests_employee_first_name" for="x_employee_first_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employee_first_name->caption() ?><?= $Page->employee_first_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->employee_first_name->cellAttributes() ?>>
<span id="el_departmental_access_requests_employee_first_name">
<input type="<?= $Page->employee_first_name->getInputTextType() ?>" data-table="departmental_access_requests" data-field="x_employee_first_name" name="x_employee_first_name" id="x_employee_first_name" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->employee_first_name->getPlaceHolder()) ?>" value="<?= $Page->employee_first_name->EditValue ?>"<?= $Page->employee_first_name->editAttributes() ?> aria-describedby="x_employee_first_name_help">
<?= $Page->employee_first_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->employee_first_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->employee_last_name->Visible) { // employee_last_name ?>
    <div id="r_employee_last_name" class="form-group row">
        <label id="elh_departmental_access_requests_employee_last_name" for="x_employee_last_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employee_last_name->caption() ?><?= $Page->employee_last_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->employee_last_name->cellAttributes() ?>>
<span id="el_departmental_access_requests_employee_last_name">
<input type="<?= $Page->employee_last_name->getInputTextType() ?>" data-table="departmental_access_requests" data-field="x_employee_last_name" name="x_employee_last_name" id="x_employee_last_name" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->employee_last_name->getPlaceHolder()) ?>" value="<?= $Page->employee_last_name->EditValue ?>"<?= $Page->employee_last_name->editAttributes() ?> aria-describedby="x_employee_last_name_help">
<?= $Page->employee_last_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->employee_last_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->employee_netid->Visible) { // employee_netid ?>
    <div id="r_employee_netid" class="form-group row">
        <label id="elh_departmental_access_requests_employee_netid" for="x_employee_netid" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employee_netid->caption() ?><?= $Page->employee_netid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->employee_netid->cellAttributes() ?>>
<span id="el_departmental_access_requests_employee_netid">
<input type="<?= $Page->employee_netid->getInputTextType() ?>" data-table="departmental_access_requests" data-field="x_employee_netid" name="x_employee_netid" id="x_employee_netid" size="30" maxlength="60" placeholder="<?= HtmlEncode($Page->employee_netid->getPlaceHolder()) ?>" value="<?= $Page->employee_netid->EditValue ?>"<?= $Page->employee_netid->editAttributes() ?> aria-describedby="x_employee_netid_help">
<?= $Page->employee_netid->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->employee_netid->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->new_catwork->Visible) { // new_catwork ?>
    <div id="r_new_catwork" class="form-group row">
        <label id="elh_departmental_access_requests_new_catwork" class="<?= $Page->LeftColumnClass ?>"><?= $Page->new_catwork->caption() ?><?= $Page->new_catwork->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->new_catwork->cellAttributes() ?>>
<span id="el_departmental_access_requests_new_catwork">
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" class="custom-control-input<?= $Page->new_catwork->isInvalidClass() ?>" data-table="departmental_access_requests" data-field="x_new_catwork" name="x_new_catwork[]" id="x_new_catwork_189557" value="1"<?= ConvertToBool($Page->new_catwork->CurrentValue) ? " checked" : "" ?><?= $Page->new_catwork->editAttributes() ?> aria-describedby="x_new_catwork_help">
    <label class="custom-control-label" for="x_new_catwork_189557"></label>
</div>
<?= $Page->new_catwork->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->new_catwork->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->delete->Visible) { // delete ?>
    <div id="r_delete" class="form-group row">
        <label id="elh_departmental_access_requests_delete" class="<?= $Page->LeftColumnClass ?>"><?= $Page->delete->caption() ?><?= $Page->delete->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->delete->cellAttributes() ?>>
<span id="el_departmental_access_requests_delete">
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" class="custom-control-input<?= $Page->delete->isInvalidClass() ?>" data-table="departmental_access_requests" data-field="x_delete" name="x_delete[]" id="x_delete_386479" value="1"<?= ConvertToBool($Page->delete->CurrentValue) ? " checked" : "" ?><?= $Page->delete->editAttributes() ?> aria-describedby="x_delete_help">
    <label class="custom-control-label" for="x_delete_386479"></label>
</div>
<?= $Page->delete->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->delete->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
    <div id="r_timestamp" class="form-group row">
        <label id="elh_departmental_access_requests_timestamp" for="x_timestamp" class="<?= $Page->LeftColumnClass ?>"><?= $Page->timestamp->caption() ?><?= $Page->timestamp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->timestamp->cellAttributes() ?>>
<span id="el_departmental_access_requests_timestamp">
<input type="<?= $Page->timestamp->getInputTextType() ?>" data-table="departmental_access_requests" data-field="x_timestamp" name="x_timestamp" id="x_timestamp" placeholder="<?= HtmlEncode($Page->timestamp->getPlaceHolder()) ?>" value="<?= $Page->timestamp->EditValue ?>"<?= $Page->timestamp->editAttributes() ?> aria-describedby="x_timestamp_help">
<?= $Page->timestamp->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->timestamp->getErrorMessage() ?></div>
<?php if (!$Page->timestamp->ReadOnly && !$Page->timestamp->Disabled && !isset($Page->timestamp->EditAttrs["readonly"]) && !isset($Page->timestamp->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdepartmental_access_requestsedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fdepartmental_access_requestsedit", "x_timestamp", {"ignoreReadonly":true,"useCurrent":false,"format":0});
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
    ew.addEventHandlers("departmental_access_requests");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
