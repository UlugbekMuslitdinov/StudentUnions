<?php

namespace PHPMaker2021\project4;

// Page object
$PhoneRequestsEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fphone_requestsedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fphone_requestsedit = currentForm = new ew.Form("fphone_requestsedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "phone_requests")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.phone_requests)
        ew.vars.tables.phone_requests = currentTable;
    fphone_requestsedit.addFields([
        ["supervisor_name", [fields.supervisor_name.visible && fields.supervisor_name.required ? ew.Validators.required(fields.supervisor_name.caption) : null], fields.supervisor_name.isInvalid],
        ["supervisor_phone", [fields.supervisor_phone.visible && fields.supervisor_phone.required ? ew.Validators.required(fields.supervisor_phone.caption) : null], fields.supervisor_phone.isInvalid],
        ["employee_status", [fields.employee_status.visible && fields.employee_status.required ? ew.Validators.required(fields.employee_status.caption) : null], fields.employee_status.isInvalid],
        ["building", [fields.building.visible && fields.building.required ? ew.Validators.required(fields.building.caption) : null], fields.building.isInvalid],
        ["room_number", [fields.room_number.visible && fields.room_number.required ? ew.Validators.required(fields.room_number.caption) : null], fields.room_number.isInvalid],
        ["net_id", [fields.net_id.visible && fields.net_id.required ? ew.Validators.required(fields.net_id.caption) : null], fields.net_id.isInvalid],
        ["jack", [fields.jack.visible && fields.jack.required ? ew.Validators.required(fields.jack.caption) : null], fields.jack.isInvalid],
        ["jack_id", [fields.jack_id.visible && fields.jack_id.required ? ew.Validators.required(fields.jack_id.caption) : null], fields.jack_id.isInvalid],
        ["voicemail", [fields.voicemail.visible && fields.voicemail.required ? ew.Validators.required(fields.voicemail.caption) : null], fields.voicemail.isInvalid],
        ["long_distance", [fields.long_distance.visible && fields.long_distance.required ? ew.Validators.required(fields.long_distance.caption) : null], fields.long_distance.isInvalid],
        ["need_phone", [fields.need_phone.visible && fields.need_phone.required ? ew.Validators.required(fields.need_phone.caption) : null], fields.need_phone.isInvalid],
        ["call_appearance", [fields.call_appearance.visible && fields.call_appearance.required ? ew.Validators.required(fields.call_appearance.caption) : null], fields.call_appearance.isInvalid],
        ["kfs_number", [fields.kfs_number.visible && fields.kfs_number.required ? ew.Validators.required(fields.kfs_number.caption) : null], fields.kfs_number.isInvalid],
        ["call_appearance1", [fields.call_appearance1.visible && fields.call_appearance1.required ? ew.Validators.required(fields.call_appearance1.caption) : null], fields.call_appearance1.isInvalid],
        ["call_appearance2", [fields.call_appearance2.visible && fields.call_appearance2.required ? ew.Validators.required(fields.call_appearance2.caption) : null], fields.call_appearance2.isInvalid],
        ["call_appearance3", [fields.call_appearance3.visible && fields.call_appearance3.required ? ew.Validators.required(fields.call_appearance3.caption) : null], fields.call_appearance3.isInvalid],
        ["call_appearance4", [fields.call_appearance4.visible && fields.call_appearance4.required ? ew.Validators.required(fields.call_appearance4.caption) : null], fields.call_appearance4.isInvalid],
        ["timestamp", [fields.timestamp.visible && fields.timestamp.required ? ew.Validators.required(fields.timestamp.caption) : null, ew.Validators.datetime(0)], fields.timestamp.isInvalid],
        ["ID", [fields.ID.visible && fields.ID.required ? ew.Validators.required(fields.ID.caption) : null], fields.ID.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fphone_requestsedit,
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
    fphone_requestsedit.validate = function () {
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
    fphone_requestsedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fphone_requestsedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fphone_requestsedit");
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
<form name="fphone_requestsedit" id="fphone_requestsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="phone_requests">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->supervisor_name->Visible) { // supervisor_name ?>
    <div id="r_supervisor_name" class="form-group row">
        <label id="elh_phone_requests_supervisor_name" for="x_supervisor_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->supervisor_name->caption() ?><?= $Page->supervisor_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->supervisor_name->cellAttributes() ?>>
<span id="el_phone_requests_supervisor_name">
<input type="<?= $Page->supervisor_name->getInputTextType() ?>" data-table="phone_requests" data-field="x_supervisor_name" name="x_supervisor_name" id="x_supervisor_name" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->supervisor_name->getPlaceHolder()) ?>" value="<?= $Page->supervisor_name->EditValue ?>"<?= $Page->supervisor_name->editAttributes() ?> aria-describedby="x_supervisor_name_help">
<?= $Page->supervisor_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->supervisor_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->supervisor_phone->Visible) { // supervisor_phone ?>
    <div id="r_supervisor_phone" class="form-group row">
        <label id="elh_phone_requests_supervisor_phone" for="x_supervisor_phone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->supervisor_phone->caption() ?><?= $Page->supervisor_phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->supervisor_phone->cellAttributes() ?>>
<span id="el_phone_requests_supervisor_phone">
<input type="<?= $Page->supervisor_phone->getInputTextType() ?>" data-table="phone_requests" data-field="x_supervisor_phone" name="x_supervisor_phone" id="x_supervisor_phone" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->supervisor_phone->getPlaceHolder()) ?>" value="<?= $Page->supervisor_phone->EditValue ?>"<?= $Page->supervisor_phone->editAttributes() ?> aria-describedby="x_supervisor_phone_help">
<?= $Page->supervisor_phone->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->supervisor_phone->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->employee_status->Visible) { // employee_status ?>
    <div id="r_employee_status" class="form-group row">
        <label id="elh_phone_requests_employee_status" for="x_employee_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employee_status->caption() ?><?= $Page->employee_status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->employee_status->cellAttributes() ?>>
<span id="el_phone_requests_employee_status">
<input type="<?= $Page->employee_status->getInputTextType() ?>" data-table="phone_requests" data-field="x_employee_status" name="x_employee_status" id="x_employee_status" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->employee_status->getPlaceHolder()) ?>" value="<?= $Page->employee_status->EditValue ?>"<?= $Page->employee_status->editAttributes() ?> aria-describedby="x_employee_status_help">
<?= $Page->employee_status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->employee_status->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->building->Visible) { // building ?>
    <div id="r_building" class="form-group row">
        <label id="elh_phone_requests_building" for="x_building" class="<?= $Page->LeftColumnClass ?>"><?= $Page->building->caption() ?><?= $Page->building->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->building->cellAttributes() ?>>
<span id="el_phone_requests_building">
<input type="<?= $Page->building->getInputTextType() ?>" data-table="phone_requests" data-field="x_building" name="x_building" id="x_building" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->building->getPlaceHolder()) ?>" value="<?= $Page->building->EditValue ?>"<?= $Page->building->editAttributes() ?> aria-describedby="x_building_help">
<?= $Page->building->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->building->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->room_number->Visible) { // room_number ?>
    <div id="r_room_number" class="form-group row">
        <label id="elh_phone_requests_room_number" for="x_room_number" class="<?= $Page->LeftColumnClass ?>"><?= $Page->room_number->caption() ?><?= $Page->room_number->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->room_number->cellAttributes() ?>>
<span id="el_phone_requests_room_number">
<input type="<?= $Page->room_number->getInputTextType() ?>" data-table="phone_requests" data-field="x_room_number" name="x_room_number" id="x_room_number" size="30" maxlength="46" placeholder="<?= HtmlEncode($Page->room_number->getPlaceHolder()) ?>" value="<?= $Page->room_number->EditValue ?>"<?= $Page->room_number->editAttributes() ?> aria-describedby="x_room_number_help">
<?= $Page->room_number->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->room_number->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->net_id->Visible) { // net_id ?>
    <div id="r_net_id" class="form-group row">
        <label id="elh_phone_requests_net_id" for="x_net_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->net_id->caption() ?><?= $Page->net_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->net_id->cellAttributes() ?>>
<span id="el_phone_requests_net_id">
<input type="<?= $Page->net_id->getInputTextType() ?>" data-table="phone_requests" data-field="x_net_id" name="x_net_id" id="x_net_id" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->net_id->getPlaceHolder()) ?>" value="<?= $Page->net_id->EditValue ?>"<?= $Page->net_id->editAttributes() ?> aria-describedby="x_net_id_help">
<?= $Page->net_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->net_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jack->Visible) { // jack ?>
    <div id="r_jack" class="form-group row">
        <label id="elh_phone_requests_jack" for="x_jack" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jack->caption() ?><?= $Page->jack->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->jack->cellAttributes() ?>>
<span id="el_phone_requests_jack">
<input type="<?= $Page->jack->getInputTextType() ?>" data-table="phone_requests" data-field="x_jack" name="x_jack" id="x_jack" size="30" maxlength="3" placeholder="<?= HtmlEncode($Page->jack->getPlaceHolder()) ?>" value="<?= $Page->jack->EditValue ?>"<?= $Page->jack->editAttributes() ?> aria-describedby="x_jack_help">
<?= $Page->jack->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jack->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jack_id->Visible) { // jack_id ?>
    <div id="r_jack_id" class="form-group row">
        <label id="elh_phone_requests_jack_id" for="x_jack_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jack_id->caption() ?><?= $Page->jack_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->jack_id->cellAttributes() ?>>
<span id="el_phone_requests_jack_id">
<input type="<?= $Page->jack_id->getInputTextType() ?>" data-table="phone_requests" data-field="x_jack_id" name="x_jack_id" id="x_jack_id" size="30" maxlength="46" placeholder="<?= HtmlEncode($Page->jack_id->getPlaceHolder()) ?>" value="<?= $Page->jack_id->EditValue ?>"<?= $Page->jack_id->editAttributes() ?> aria-describedby="x_jack_id_help">
<?= $Page->jack_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jack_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->voicemail->Visible) { // voicemail ?>
    <div id="r_voicemail" class="form-group row">
        <label id="elh_phone_requests_voicemail" for="x_voicemail" class="<?= $Page->LeftColumnClass ?>"><?= $Page->voicemail->caption() ?><?= $Page->voicemail->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->voicemail->cellAttributes() ?>>
<span id="el_phone_requests_voicemail">
<input type="<?= $Page->voicemail->getInputTextType() ?>" data-table="phone_requests" data-field="x_voicemail" name="x_voicemail" id="x_voicemail" size="30" maxlength="3" placeholder="<?= HtmlEncode($Page->voicemail->getPlaceHolder()) ?>" value="<?= $Page->voicemail->EditValue ?>"<?= $Page->voicemail->editAttributes() ?> aria-describedby="x_voicemail_help">
<?= $Page->voicemail->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->voicemail->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->long_distance->Visible) { // long_distance ?>
    <div id="r_long_distance" class="form-group row">
        <label id="elh_phone_requests_long_distance" for="x_long_distance" class="<?= $Page->LeftColumnClass ?>"><?= $Page->long_distance->caption() ?><?= $Page->long_distance->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->long_distance->cellAttributes() ?>>
<span id="el_phone_requests_long_distance">
<input type="<?= $Page->long_distance->getInputTextType() ?>" data-table="phone_requests" data-field="x_long_distance" name="x_long_distance" id="x_long_distance" size="30" maxlength="3" placeholder="<?= HtmlEncode($Page->long_distance->getPlaceHolder()) ?>" value="<?= $Page->long_distance->EditValue ?>"<?= $Page->long_distance->editAttributes() ?> aria-describedby="x_long_distance_help">
<?= $Page->long_distance->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->long_distance->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->need_phone->Visible) { // need_phone ?>
    <div id="r_need_phone" class="form-group row">
        <label id="elh_phone_requests_need_phone" for="x_need_phone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->need_phone->caption() ?><?= $Page->need_phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->need_phone->cellAttributes() ?>>
<span id="el_phone_requests_need_phone">
<input type="<?= $Page->need_phone->getInputTextType() ?>" data-table="phone_requests" data-field="x_need_phone" name="x_need_phone" id="x_need_phone" size="30" maxlength="3" placeholder="<?= HtmlEncode($Page->need_phone->getPlaceHolder()) ?>" value="<?= $Page->need_phone->EditValue ?>"<?= $Page->need_phone->editAttributes() ?> aria-describedby="x_need_phone_help">
<?= $Page->need_phone->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->need_phone->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->call_appearance->Visible) { // call_appearance ?>
    <div id="r_call_appearance" class="form-group row">
        <label id="elh_phone_requests_call_appearance" for="x_call_appearance" class="<?= $Page->LeftColumnClass ?>"><?= $Page->call_appearance->caption() ?><?= $Page->call_appearance->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->call_appearance->cellAttributes() ?>>
<span id="el_phone_requests_call_appearance">
<input type="<?= $Page->call_appearance->getInputTextType() ?>" data-table="phone_requests" data-field="x_call_appearance" name="x_call_appearance" id="x_call_appearance" size="30" maxlength="3" placeholder="<?= HtmlEncode($Page->call_appearance->getPlaceHolder()) ?>" value="<?= $Page->call_appearance->EditValue ?>"<?= $Page->call_appearance->editAttributes() ?> aria-describedby="x_call_appearance_help">
<?= $Page->call_appearance->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->call_appearance->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kfs_number->Visible) { // kfs_number ?>
    <div id="r_kfs_number" class="form-group row">
        <label id="elh_phone_requests_kfs_number" for="x_kfs_number" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kfs_number->caption() ?><?= $Page->kfs_number->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kfs_number->cellAttributes() ?>>
<span id="el_phone_requests_kfs_number">
<input type="<?= $Page->kfs_number->getInputTextType() ?>" data-table="phone_requests" data-field="x_kfs_number" name="x_kfs_number" id="x_kfs_number" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->kfs_number->getPlaceHolder()) ?>" value="<?= $Page->kfs_number->EditValue ?>"<?= $Page->kfs_number->editAttributes() ?> aria-describedby="x_kfs_number_help">
<?= $Page->kfs_number->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kfs_number->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->call_appearance1->Visible) { // call_appearance1 ?>
    <div id="r_call_appearance1" class="form-group row">
        <label id="elh_phone_requests_call_appearance1" for="x_call_appearance1" class="<?= $Page->LeftColumnClass ?>"><?= $Page->call_appearance1->caption() ?><?= $Page->call_appearance1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->call_appearance1->cellAttributes() ?>>
<span id="el_phone_requests_call_appearance1">
<input type="<?= $Page->call_appearance1->getInputTextType() ?>" data-table="phone_requests" data-field="x_call_appearance1" name="x_call_appearance1" id="x_call_appearance1" size="30" maxlength="46" placeholder="<?= HtmlEncode($Page->call_appearance1->getPlaceHolder()) ?>" value="<?= $Page->call_appearance1->EditValue ?>"<?= $Page->call_appearance1->editAttributes() ?> aria-describedby="x_call_appearance1_help">
<?= $Page->call_appearance1->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->call_appearance1->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->call_appearance2->Visible) { // call_appearance2 ?>
    <div id="r_call_appearance2" class="form-group row">
        <label id="elh_phone_requests_call_appearance2" for="x_call_appearance2" class="<?= $Page->LeftColumnClass ?>"><?= $Page->call_appearance2->caption() ?><?= $Page->call_appearance2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->call_appearance2->cellAttributes() ?>>
<span id="el_phone_requests_call_appearance2">
<input type="<?= $Page->call_appearance2->getInputTextType() ?>" data-table="phone_requests" data-field="x_call_appearance2" name="x_call_appearance2" id="x_call_appearance2" size="30" maxlength="46" placeholder="<?= HtmlEncode($Page->call_appearance2->getPlaceHolder()) ?>" value="<?= $Page->call_appearance2->EditValue ?>"<?= $Page->call_appearance2->editAttributes() ?> aria-describedby="x_call_appearance2_help">
<?= $Page->call_appearance2->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->call_appearance2->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->call_appearance3->Visible) { // call_appearance3 ?>
    <div id="r_call_appearance3" class="form-group row">
        <label id="elh_phone_requests_call_appearance3" for="x_call_appearance3" class="<?= $Page->LeftColumnClass ?>"><?= $Page->call_appearance3->caption() ?><?= $Page->call_appearance3->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->call_appearance3->cellAttributes() ?>>
<span id="el_phone_requests_call_appearance3">
<input type="<?= $Page->call_appearance3->getInputTextType() ?>" data-table="phone_requests" data-field="x_call_appearance3" name="x_call_appearance3" id="x_call_appearance3" size="30" maxlength="46" placeholder="<?= HtmlEncode($Page->call_appearance3->getPlaceHolder()) ?>" value="<?= $Page->call_appearance3->EditValue ?>"<?= $Page->call_appearance3->editAttributes() ?> aria-describedby="x_call_appearance3_help">
<?= $Page->call_appearance3->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->call_appearance3->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->call_appearance4->Visible) { // call_appearance4 ?>
    <div id="r_call_appearance4" class="form-group row">
        <label id="elh_phone_requests_call_appearance4" for="x_call_appearance4" class="<?= $Page->LeftColumnClass ?>"><?= $Page->call_appearance4->caption() ?><?= $Page->call_appearance4->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->call_appearance4->cellAttributes() ?>>
<span id="el_phone_requests_call_appearance4">
<input type="<?= $Page->call_appearance4->getInputTextType() ?>" data-table="phone_requests" data-field="x_call_appearance4" name="x_call_appearance4" id="x_call_appearance4" size="30" maxlength="46" placeholder="<?= HtmlEncode($Page->call_appearance4->getPlaceHolder()) ?>" value="<?= $Page->call_appearance4->EditValue ?>"<?= $Page->call_appearance4->editAttributes() ?> aria-describedby="x_call_appearance4_help">
<?= $Page->call_appearance4->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->call_appearance4->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
    <div id="r_timestamp" class="form-group row">
        <label id="elh_phone_requests_timestamp" for="x_timestamp" class="<?= $Page->LeftColumnClass ?>"><?= $Page->timestamp->caption() ?><?= $Page->timestamp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->timestamp->cellAttributes() ?>>
<span id="el_phone_requests_timestamp">
<input type="<?= $Page->timestamp->getInputTextType() ?>" data-table="phone_requests" data-field="x_timestamp" name="x_timestamp" id="x_timestamp" placeholder="<?= HtmlEncode($Page->timestamp->getPlaceHolder()) ?>" value="<?= $Page->timestamp->EditValue ?>"<?= $Page->timestamp->editAttributes() ?> aria-describedby="x_timestamp_help">
<?= $Page->timestamp->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->timestamp->getErrorMessage() ?></div>
<?php if (!$Page->timestamp->ReadOnly && !$Page->timestamp->Disabled && !isset($Page->timestamp->EditAttrs["readonly"]) && !isset($Page->timestamp->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fphone_requestsedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fphone_requestsedit", "x_timestamp", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ID->Visible) { // ID ?>
    <div id="r_ID" class="form-group row">
        <label id="elh_phone_requests_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ID->caption() ?><?= $Page->ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ID->cellAttributes() ?>>
<span id="el_phone_requests_ID">
<span<?= $Page->ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->ID->getDisplayValue($Page->ID->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="phone_requests" data-field="x_ID" data-hidden="1" name="x_ID" id="x_ID" value="<?= HtmlEncode($Page->ID->CurrentValue) ?>">
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
    ew.addEventHandlers("phone_requests");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
