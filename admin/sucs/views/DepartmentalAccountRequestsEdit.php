<?php

namespace PHPMaker2021\project4;

// Page object
$DepartmentalAccountRequestsEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fdepartmental_account_requestsedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fdepartmental_account_requestsedit = currentForm = new ew.Form("fdepartmental_account_requestsedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "departmental_account_requests")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.departmental_account_requests)
        ew.vars.tables.departmental_account_requests = currentTable;
    fdepartmental_account_requestsedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["supervisor_name", [fields.supervisor_name.visible && fields.supervisor_name.required ? ew.Validators.required(fields.supervisor_name.caption) : null], fields.supervisor_name.isInvalid],
        ["supervisor_phone", [fields.supervisor_phone.visible && fields.supervisor_phone.required ? ew.Validators.required(fields.supervisor_phone.caption) : null], fields.supervisor_phone.isInvalid],
        ["supervisor_email", [fields.supervisor_email.visible && fields.supervisor_email.required ? ew.Validators.required(fields.supervisor_email.caption) : null], fields.supervisor_email.isInvalid],
        ["department", [fields.department.visible && fields.department.required ? ew.Validators.required(fields.department.caption) : null], fields.department.isInvalid],
        ["name_1", [fields.name_1.visible && fields.name_1.required ? ew.Validators.required(fields.name_1.caption) : null], fields.name_1.isInvalid],
        ["name_2", [fields.name_2.visible && fields.name_2.required ? ew.Validators.required(fields.name_2.caption) : null], fields.name_2.isInvalid],
        ["name_3", [fields.name_3.visible && fields.name_3.required ? ew.Validators.required(fields.name_3.caption) : null], fields.name_3.isInvalid],
        ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid],
        ["timestamp", [fields.timestamp.visible && fields.timestamp.required ? ew.Validators.required(fields.timestamp.caption) : null, ew.Validators.datetime(0)], fields.timestamp.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fdepartmental_account_requestsedit,
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
    fdepartmental_account_requestsedit.validate = function () {
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
    fdepartmental_account_requestsedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fdepartmental_account_requestsedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fdepartmental_account_requestsedit");
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
<form name="fdepartmental_account_requestsedit" id="fdepartmental_account_requestsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="departmental_account_requests">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_departmental_account_requests_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_departmental_account_requests_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="departmental_account_requests" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->supervisor_name->Visible) { // supervisor_name ?>
    <div id="r_supervisor_name" class="form-group row">
        <label id="elh_departmental_account_requests_supervisor_name" for="x_supervisor_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->supervisor_name->caption() ?><?= $Page->supervisor_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->supervisor_name->cellAttributes() ?>>
<span id="el_departmental_account_requests_supervisor_name">
<input type="<?= $Page->supervisor_name->getInputTextType() ?>" data-table="departmental_account_requests" data-field="x_supervisor_name" name="x_supervisor_name" id="x_supervisor_name" size="30" maxlength="80" placeholder="<?= HtmlEncode($Page->supervisor_name->getPlaceHolder()) ?>" value="<?= $Page->supervisor_name->EditValue ?>"<?= $Page->supervisor_name->editAttributes() ?> aria-describedby="x_supervisor_name_help">
<?= $Page->supervisor_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->supervisor_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->supervisor_phone->Visible) { // supervisor_phone ?>
    <div id="r_supervisor_phone" class="form-group row">
        <label id="elh_departmental_account_requests_supervisor_phone" for="x_supervisor_phone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->supervisor_phone->caption() ?><?= $Page->supervisor_phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->supervisor_phone->cellAttributes() ?>>
<span id="el_departmental_account_requests_supervisor_phone">
<input type="<?= $Page->supervisor_phone->getInputTextType() ?>" data-table="departmental_account_requests" data-field="x_supervisor_phone" name="x_supervisor_phone" id="x_supervisor_phone" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->supervisor_phone->getPlaceHolder()) ?>" value="<?= $Page->supervisor_phone->EditValue ?>"<?= $Page->supervisor_phone->editAttributes() ?> aria-describedby="x_supervisor_phone_help">
<?= $Page->supervisor_phone->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->supervisor_phone->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->supervisor_email->Visible) { // supervisor_email ?>
    <div id="r_supervisor_email" class="form-group row">
        <label id="elh_departmental_account_requests_supervisor_email" for="x_supervisor_email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->supervisor_email->caption() ?><?= $Page->supervisor_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->supervisor_email->cellAttributes() ?>>
<span id="el_departmental_account_requests_supervisor_email">
<input type="<?= $Page->supervisor_email->getInputTextType() ?>" data-table="departmental_account_requests" data-field="x_supervisor_email" name="x_supervisor_email" id="x_supervisor_email" size="30" maxlength="80" placeholder="<?= HtmlEncode($Page->supervisor_email->getPlaceHolder()) ?>" value="<?= $Page->supervisor_email->EditValue ?>"<?= $Page->supervisor_email->editAttributes() ?> aria-describedby="x_supervisor_email_help">
<?= $Page->supervisor_email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->supervisor_email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->department->Visible) { // department ?>
    <div id="r_department" class="form-group row">
        <label id="elh_departmental_account_requests_department" for="x_department" class="<?= $Page->LeftColumnClass ?>"><?= $Page->department->caption() ?><?= $Page->department->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->department->cellAttributes() ?>>
<span id="el_departmental_account_requests_department">
<input type="<?= $Page->department->getInputTextType() ?>" data-table="departmental_account_requests" data-field="x_department" name="x_department" id="x_department" size="30" maxlength="60" placeholder="<?= HtmlEncode($Page->department->getPlaceHolder()) ?>" value="<?= $Page->department->EditValue ?>"<?= $Page->department->editAttributes() ?> aria-describedby="x_department_help">
<?= $Page->department->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->department->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->name_1->Visible) { // name_1 ?>
    <div id="r_name_1" class="form-group row">
        <label id="elh_departmental_account_requests_name_1" for="x_name_1" class="<?= $Page->LeftColumnClass ?>"><?= $Page->name_1->caption() ?><?= $Page->name_1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->name_1->cellAttributes() ?>>
<span id="el_departmental_account_requests_name_1">
<input type="<?= $Page->name_1->getInputTextType() ?>" data-table="departmental_account_requests" data-field="x_name_1" name="x_name_1" id="x_name_1" size="30" maxlength="60" placeholder="<?= HtmlEncode($Page->name_1->getPlaceHolder()) ?>" value="<?= $Page->name_1->EditValue ?>"<?= $Page->name_1->editAttributes() ?> aria-describedby="x_name_1_help">
<?= $Page->name_1->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->name_1->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->name_2->Visible) { // name_2 ?>
    <div id="r_name_2" class="form-group row">
        <label id="elh_departmental_account_requests_name_2" for="x_name_2" class="<?= $Page->LeftColumnClass ?>"><?= $Page->name_2->caption() ?><?= $Page->name_2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->name_2->cellAttributes() ?>>
<span id="el_departmental_account_requests_name_2">
<input type="<?= $Page->name_2->getInputTextType() ?>" data-table="departmental_account_requests" data-field="x_name_2" name="x_name_2" id="x_name_2" size="30" maxlength="60" placeholder="<?= HtmlEncode($Page->name_2->getPlaceHolder()) ?>" value="<?= $Page->name_2->EditValue ?>"<?= $Page->name_2->editAttributes() ?> aria-describedby="x_name_2_help">
<?= $Page->name_2->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->name_2->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->name_3->Visible) { // name_3 ?>
    <div id="r_name_3" class="form-group row">
        <label id="elh_departmental_account_requests_name_3" for="x_name_3" class="<?= $Page->LeftColumnClass ?>"><?= $Page->name_3->caption() ?><?= $Page->name_3->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->name_3->cellAttributes() ?>>
<span id="el_departmental_account_requests_name_3">
<input type="<?= $Page->name_3->getInputTextType() ?>" data-table="departmental_account_requests" data-field="x_name_3" name="x_name_3" id="x_name_3" size="30" maxlength="60" placeholder="<?= HtmlEncode($Page->name_3->getPlaceHolder()) ?>" value="<?= $Page->name_3->EditValue ?>"<?= $Page->name_3->editAttributes() ?> aria-describedby="x_name_3_help">
<?= $Page->name_3->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->name_3->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description" class="form-group row">
        <label id="elh_departmental_account_requests_description" for="x_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->description->cellAttributes() ?>>
<span id="el_departmental_account_requests_description">
<input type="<?= $Page->description->getInputTextType() ?>" data-table="departmental_account_requests" data-field="x_description" name="x_description" id="x_description" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>" value="<?= $Page->description->EditValue ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help">
<?= $Page->description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
    <div id="r_timestamp" class="form-group row">
        <label id="elh_departmental_account_requests_timestamp" for="x_timestamp" class="<?= $Page->LeftColumnClass ?>"><?= $Page->timestamp->caption() ?><?= $Page->timestamp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->timestamp->cellAttributes() ?>>
<span id="el_departmental_account_requests_timestamp">
<input type="<?= $Page->timestamp->getInputTextType() ?>" data-table="departmental_account_requests" data-field="x_timestamp" name="x_timestamp" id="x_timestamp" placeholder="<?= HtmlEncode($Page->timestamp->getPlaceHolder()) ?>" value="<?= $Page->timestamp->EditValue ?>"<?= $Page->timestamp->editAttributes() ?> aria-describedby="x_timestamp_help">
<?= $Page->timestamp->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->timestamp->getErrorMessage() ?></div>
<?php if (!$Page->timestamp->ReadOnly && !$Page->timestamp->Disabled && !isset($Page->timestamp->EditAttrs["readonly"]) && !isset($Page->timestamp->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdepartmental_account_requestsedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fdepartmental_account_requestsedit", "x_timestamp", {"ignoreReadonly":true,"useCurrent":false,"format":0});
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
    ew.addEventHandlers("departmental_account_requests");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
