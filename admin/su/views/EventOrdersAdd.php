<?php

namespace PHPMaker2021\project1;

// Page object
$EventOrdersAdd = &$Page;
?>
<script>
if (!ew.vars.tables.event_orders) ew.vars.tables.event_orders = <?= JsonEncode(GetClientVar("tables", "event_orders")) ?>;
var currentForm, currentPageID;
var fevent_ordersadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fevent_ordersadd = currentForm = new ew.Form("fevent_ordersadd", "add");

    // Add fields
    var fields = ew.vars.tables.event_orders.fields;
    fevent_ordersadd.addFields([
        ["event_id", [fields.event_id.required ? ew.Validators.required(fields.event_id.caption) : null, ew.Validators.integer], fields.event_id.isInvalid],
        ["event_time", [fields.event_time.required ? ew.Validators.required(fields.event_time.caption) : null, ew.Validators.datetime(0)], fields.event_time.isInvalid],
        ["event_type", [fields.event_type.required ? ew.Validators.required(fields.event_type.caption) : null], fields.event_type.isInvalid],
        ["pdf_link", [fields.pdf_link.required ? ew.Validators.required(fields.pdf_link.caption) : null], fields.pdf_link.isInvalid],
        ["uploader", [fields.uploader.required ? ew.Validators.required(fields.uploader.caption) : null], fields.uploader.isInvalid],
        ["timestamp", [fields.timestamp.required ? ew.Validators.required(fields.timestamp.caption) : null, ew.Validators.datetime(0)], fields.timestamp.isInvalid],
        ["data", [fields.data.required ? ew.Validators.required(fields.data.caption) : null], fields.data.isInvalid],
        ["progress", [fields.progress.required ? ew.Validators.required(fields.progress.caption) : null], fields.progress.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fevent_ordersadd,
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
    fevent_ordersadd.validate = function () {
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
    fevent_ordersadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fevent_ordersadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fevent_ordersadd");
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
<form name="fevent_ordersadd" id="fevent_ordersadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="event_orders">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->event_id->Visible) { // event_id ?>
    <div id="r_event_id" class="form-group row">
        <label id="elh_event_orders_event_id" for="x_event_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->event_id->caption() ?><?= $Page->event_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->event_id->cellAttributes() ?>>
<span id="el_event_orders_event_id">
<input type="<?= $Page->event_id->getInputTextType() ?>" data-table="event_orders" data-field="x_event_id" name="x_event_id" id="x_event_id" size="30" placeholder="<?= HtmlEncode($Page->event_id->getPlaceHolder()) ?>" value="<?= $Page->event_id->EditValue ?>"<?= $Page->event_id->editAttributes() ?> aria-describedby="x_event_id_help">
<?= $Page->event_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->event_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->event_time->Visible) { // event_time ?>
    <div id="r_event_time" class="form-group row">
        <label id="elh_event_orders_event_time" for="x_event_time" class="<?= $Page->LeftColumnClass ?>"><?= $Page->event_time->caption() ?><?= $Page->event_time->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->event_time->cellAttributes() ?>>
<span id="el_event_orders_event_time">
<input type="<?= $Page->event_time->getInputTextType() ?>" data-table="event_orders" data-field="x_event_time" name="x_event_time" id="x_event_time" placeholder="<?= HtmlEncode($Page->event_time->getPlaceHolder()) ?>" value="<?= $Page->event_time->EditValue ?>"<?= $Page->event_time->editAttributes() ?> aria-describedby="x_event_time_help">
<?= $Page->event_time->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->event_time->getErrorMessage() ?></div>
<?php if (!$Page->event_time->ReadOnly && !$Page->event_time->Disabled && !isset($Page->event_time->EditAttrs["readonly"]) && !isset($Page->event_time->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fevent_ordersadd", "datetimepicker"], function() {
    ew.createDateTimePicker("fevent_ordersadd", "x_event_time", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->event_type->Visible) { // event_type ?>
    <div id="r_event_type" class="form-group row">
        <label id="elh_event_orders_event_type" for="x_event_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->event_type->caption() ?><?= $Page->event_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->event_type->cellAttributes() ?>>
<span id="el_event_orders_event_type">
<input type="<?= $Page->event_type->getInputTextType() ?>" data-table="event_orders" data-field="x_event_type" name="x_event_type" id="x_event_type" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->event_type->getPlaceHolder()) ?>" value="<?= $Page->event_type->EditValue ?>"<?= $Page->event_type->editAttributes() ?> aria-describedby="x_event_type_help">
<?= $Page->event_type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->event_type->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pdf_link->Visible) { // pdf_link ?>
    <div id="r_pdf_link" class="form-group row">
        <label id="elh_event_orders_pdf_link" for="x_pdf_link" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pdf_link->caption() ?><?= $Page->pdf_link->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->pdf_link->cellAttributes() ?>>
<span id="el_event_orders_pdf_link">
<input type="<?= $Page->pdf_link->getInputTextType() ?>" data-table="event_orders" data-field="x_pdf_link" name="x_pdf_link" id="x_pdf_link" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->pdf_link->getPlaceHolder()) ?>" value="<?= $Page->pdf_link->EditValue ?>"<?= $Page->pdf_link->editAttributes() ?> aria-describedby="x_pdf_link_help">
<?= $Page->pdf_link->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pdf_link->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->uploader->Visible) { // uploader ?>
    <div id="r_uploader" class="form-group row">
        <label id="elh_event_orders_uploader" for="x_uploader" class="<?= $Page->LeftColumnClass ?>"><?= $Page->uploader->caption() ?><?= $Page->uploader->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->uploader->cellAttributes() ?>>
<span id="el_event_orders_uploader">
<input type="<?= $Page->uploader->getInputTextType() ?>" data-table="event_orders" data-field="x_uploader" name="x_uploader" id="x_uploader" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->uploader->getPlaceHolder()) ?>" value="<?= $Page->uploader->EditValue ?>"<?= $Page->uploader->editAttributes() ?> aria-describedby="x_uploader_help">
<?= $Page->uploader->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->uploader->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
    <div id="r_timestamp" class="form-group row">
        <label id="elh_event_orders_timestamp" for="x_timestamp" class="<?= $Page->LeftColumnClass ?>"><?= $Page->timestamp->caption() ?><?= $Page->timestamp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->timestamp->cellAttributes() ?>>
<span id="el_event_orders_timestamp">
<input type="<?= $Page->timestamp->getInputTextType() ?>" data-table="event_orders" data-field="x_timestamp" name="x_timestamp" id="x_timestamp" placeholder="<?= HtmlEncode($Page->timestamp->getPlaceHolder()) ?>" value="<?= $Page->timestamp->EditValue ?>"<?= $Page->timestamp->editAttributes() ?> aria-describedby="x_timestamp_help">
<?= $Page->timestamp->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->timestamp->getErrorMessage() ?></div>
<?php if (!$Page->timestamp->ReadOnly && !$Page->timestamp->Disabled && !isset($Page->timestamp->EditAttrs["readonly"]) && !isset($Page->timestamp->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fevent_ordersadd", "datetimepicker"], function() {
    ew.createDateTimePicker("fevent_ordersadd", "x_timestamp", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->data->Visible) { // data ?>
    <div id="r_data" class="form-group row">
        <label id="elh_event_orders_data" for="x_data" class="<?= $Page->LeftColumnClass ?>"><?= $Page->data->caption() ?><?= $Page->data->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->data->cellAttributes() ?>>
<span id="el_event_orders_data">
<textarea data-table="event_orders" data-field="x_data" name="x_data" id="x_data" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->data->getPlaceHolder()) ?>"<?= $Page->data->editAttributes() ?> aria-describedby="x_data_help"><?= $Page->data->EditValue ?></textarea>
<?= $Page->data->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->data->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->progress->Visible) { // progress ?>
    <div id="r_progress" class="form-group row">
        <label id="elh_event_orders_progress" for="x_progress" class="<?= $Page->LeftColumnClass ?>"><?= $Page->progress->caption() ?><?= $Page->progress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->progress->cellAttributes() ?>>
<span id="el_event_orders_progress">
<input type="<?= $Page->progress->getInputTextType() ?>" data-table="event_orders" data-field="x_progress" name="x_progress" id="x_progress" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->progress->getPlaceHolder()) ?>" value="<?= $Page->progress->EditValue ?>"<?= $Page->progress->editAttributes() ?> aria-describedby="x_progress_help">
<?= $Page->progress->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->progress->getErrorMessage() ?></div>
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
    ew.addEventHandlers("event_orders");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
