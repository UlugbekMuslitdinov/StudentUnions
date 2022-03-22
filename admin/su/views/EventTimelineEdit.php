<?php

namespace PHPMaker2021\project1;

// Page object
$EventTimelineEdit = &$Page;
?>
<script>
if (!ew.vars.tables.event_timeline) ew.vars.tables.event_timeline = <?= JsonEncode(GetClientVar("tables", "event_timeline")) ?>;
var currentForm, currentPageID;
var fevent_timelineedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fevent_timelineedit = currentForm = new ew.Form("fevent_timelineedit", "edit");

    // Add fields
    var fields = ew.vars.tables.event_timeline.fields;
    fevent_timelineedit.addFields([
        ["id", [fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["event_id", [fields.event_id.required ? ew.Validators.required(fields.event_id.caption) : null, ew.Validators.integer], fields.event_id.isInvalid],
        ["admin_id", [fields.admin_id.required ? ew.Validators.required(fields.admin_id.caption) : null, ew.Validators.integer], fields.admin_id.isInvalid],
        ["_action", [fields._action.required ? ew.Validators.required(fields._action.caption) : null], fields._action.isInvalid],
        ["detail", [fields.detail.required ? ew.Validators.required(fields.detail.caption) : null], fields.detail.isInvalid],
        ["created_at", [fields.created_at.required ? ew.Validators.required(fields.created_at.caption) : null, ew.Validators.datetime(0)], fields.created_at.isInvalid],
        ["updated_at", [fields.updated_at.required ? ew.Validators.required(fields.updated_at.caption) : null, ew.Validators.datetime(0)], fields.updated_at.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fevent_timelineedit,
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
    fevent_timelineedit.validate = function () {
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
    fevent_timelineedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fevent_timelineedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fevent_timelineedit");
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
<form name="fevent_timelineedit" id="fevent_timelineedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="event_timeline">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_event_timeline_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_event_timeline_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="event_timeline" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->event_id->Visible) { // event_id ?>
    <div id="r_event_id" class="form-group row">
        <label id="elh_event_timeline_event_id" for="x_event_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->event_id->caption() ?><?= $Page->event_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->event_id->cellAttributes() ?>>
<span id="el_event_timeline_event_id">
<input type="<?= $Page->event_id->getInputTextType() ?>" data-table="event_timeline" data-field="x_event_id" name="x_event_id" id="x_event_id" size="30" placeholder="<?= HtmlEncode($Page->event_id->getPlaceHolder()) ?>" value="<?= $Page->event_id->EditValue ?>"<?= $Page->event_id->editAttributes() ?> aria-describedby="x_event_id_help">
<?= $Page->event_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->event_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->admin_id->Visible) { // admin_id ?>
    <div id="r_admin_id" class="form-group row">
        <label id="elh_event_timeline_admin_id" for="x_admin_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->admin_id->caption() ?><?= $Page->admin_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->admin_id->cellAttributes() ?>>
<span id="el_event_timeline_admin_id">
<input type="<?= $Page->admin_id->getInputTextType() ?>" data-table="event_timeline" data-field="x_admin_id" name="x_admin_id" id="x_admin_id" size="30" placeholder="<?= HtmlEncode($Page->admin_id->getPlaceHolder()) ?>" value="<?= $Page->admin_id->EditValue ?>"<?= $Page->admin_id->editAttributes() ?> aria-describedby="x_admin_id_help">
<?= $Page->admin_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->admin_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_action->Visible) { // action ?>
    <div id="r__action" class="form-group row">
        <label id="elh_event_timeline__action" for="x__action" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_action->caption() ?><?= $Page->_action->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_action->cellAttributes() ?>>
<span id="el_event_timeline__action">
<input type="<?= $Page->_action->getInputTextType() ?>" data-table="event_timeline" data-field="x__action" name="x__action" id="x__action" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->_action->getPlaceHolder()) ?>" value="<?= $Page->_action->EditValue ?>"<?= $Page->_action->editAttributes() ?> aria-describedby="x__action_help">
<?= $Page->_action->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_action->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->detail->Visible) { // detail ?>
    <div id="r_detail" class="form-group row">
        <label id="elh_event_timeline_detail" for="x_detail" class="<?= $Page->LeftColumnClass ?>"><?= $Page->detail->caption() ?><?= $Page->detail->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->detail->cellAttributes() ?>>
<span id="el_event_timeline_detail">
<textarea data-table="event_timeline" data-field="x_detail" name="x_detail" id="x_detail" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->detail->getPlaceHolder()) ?>"<?= $Page->detail->editAttributes() ?> aria-describedby="x_detail_help"><?= $Page->detail->EditValue ?></textarea>
<?= $Page->detail->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->detail->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <div id="r_created_at" class="form-group row">
        <label id="elh_event_timeline_created_at" for="x_created_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_at->caption() ?><?= $Page->created_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->created_at->cellAttributes() ?>>
<span id="el_event_timeline_created_at">
<input type="<?= $Page->created_at->getInputTextType() ?>" data-table="event_timeline" data-field="x_created_at" name="x_created_at" id="x_created_at" placeholder="<?= HtmlEncode($Page->created_at->getPlaceHolder()) ?>" value="<?= $Page->created_at->EditValue ?>"<?= $Page->created_at->editAttributes() ?> aria-describedby="x_created_at_help">
<?= $Page->created_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_at->getErrorMessage() ?></div>
<?php if (!$Page->created_at->ReadOnly && !$Page->created_at->Disabled && !isset($Page->created_at->EditAttrs["readonly"]) && !isset($Page->created_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fevent_timelineedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fevent_timelineedit", "x_created_at", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
    <div id="r_updated_at" class="form-group row">
        <label id="elh_event_timeline_updated_at" for="x_updated_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->updated_at->caption() ?><?= $Page->updated_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->updated_at->cellAttributes() ?>>
<span id="el_event_timeline_updated_at">
<input type="<?= $Page->updated_at->getInputTextType() ?>" data-table="event_timeline" data-field="x_updated_at" name="x_updated_at" id="x_updated_at" placeholder="<?= HtmlEncode($Page->updated_at->getPlaceHolder()) ?>" value="<?= $Page->updated_at->EditValue ?>"<?= $Page->updated_at->editAttributes() ?> aria-describedby="x_updated_at_help">
<?= $Page->updated_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->updated_at->getErrorMessage() ?></div>
<?php if (!$Page->updated_at->ReadOnly && !$Page->updated_at->Disabled && !isset($Page->updated_at->EditAttrs["readonly"]) && !isset($Page->updated_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fevent_timelineedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fevent_timelineedit", "x_updated_at", {"ignoreReadonly":true,"useCurrent":false,"format":0});
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
    ew.addEventHandlers("event_timeline");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
