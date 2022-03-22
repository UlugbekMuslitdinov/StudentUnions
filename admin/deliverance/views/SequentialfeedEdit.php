<?php

namespace PHPMaker2021\project3;

// Page object
$SequentialfeedEdit = &$Page;
?>
<script>
if (!ew.vars.tables.sequentialfeed) ew.vars.tables.sequentialfeed = <?= JsonEncode(GetClientVar("tables", "sequentialfeed")) ?>;
var currentForm, currentPageID;
var fsequentialfeededit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fsequentialfeededit = currentForm = new ew.Form("fsequentialfeededit", "edit");

    // Add fields
    var fields = ew.vars.tables.sequentialfeed.fields;
    fsequentialfeededit.addFields([
        ["id", [fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["resourceID", [fields.resourceID.required ? ew.Validators.required(fields.resourceID.caption) : null, ew.Validators.integer], fields.resourceID.isInvalid],
        ["displayBlockID", [fields.displayBlockID.required ? ew.Validators.required(fields.displayBlockID.caption) : null, ew.Validators.integer], fields.displayBlockID.isInvalid],
        ["startDate", [fields.startDate.required ? ew.Validators.required(fields.startDate.caption) : null, ew.Validators.datetime(0)], fields.startDate.isInvalid],
        ["endDate", [fields.endDate.required ? ew.Validators.required(fields.endDate.caption) : null, ew.Validators.datetime(0)], fields.endDate.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fsequentialfeededit,
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
    fsequentialfeededit.validate = function () {
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
    fsequentialfeededit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fsequentialfeededit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fsequentialfeededit");
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
<form name="fsequentialfeededit" id="fsequentialfeededit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="sequentialfeed">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_sequentialfeed_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_sequentialfeed_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="sequentialfeed" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->resourceID->Visible) { // resourceID ?>
    <div id="r_resourceID" class="form-group row">
        <label id="elh_sequentialfeed_resourceID" for="x_resourceID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->resourceID->caption() ?><?= $Page->resourceID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->resourceID->cellAttributes() ?>>
<span id="el_sequentialfeed_resourceID">
<input type="<?= $Page->resourceID->getInputTextType() ?>" data-table="sequentialfeed" data-field="x_resourceID" name="x_resourceID" id="x_resourceID" size="30" placeholder="<?= HtmlEncode($Page->resourceID->getPlaceHolder()) ?>" value="<?= $Page->resourceID->EditValue ?>"<?= $Page->resourceID->editAttributes() ?> aria-describedby="x_resourceID_help">
<?= $Page->resourceID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->resourceID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->displayBlockID->Visible) { // displayBlockID ?>
    <div id="r_displayBlockID" class="form-group row">
        <label id="elh_sequentialfeed_displayBlockID" for="x_displayBlockID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->displayBlockID->caption() ?><?= $Page->displayBlockID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->displayBlockID->cellAttributes() ?>>
<span id="el_sequentialfeed_displayBlockID">
<input type="<?= $Page->displayBlockID->getInputTextType() ?>" data-table="sequentialfeed" data-field="x_displayBlockID" name="x_displayBlockID" id="x_displayBlockID" size="30" placeholder="<?= HtmlEncode($Page->displayBlockID->getPlaceHolder()) ?>" value="<?= $Page->displayBlockID->EditValue ?>"<?= $Page->displayBlockID->editAttributes() ?> aria-describedby="x_displayBlockID_help">
<?= $Page->displayBlockID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->displayBlockID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->startDate->Visible) { // startDate ?>
    <div id="r_startDate" class="form-group row">
        <label id="elh_sequentialfeed_startDate" for="x_startDate" class="<?= $Page->LeftColumnClass ?>"><?= $Page->startDate->caption() ?><?= $Page->startDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->startDate->cellAttributes() ?>>
<span id="el_sequentialfeed_startDate">
<input type="<?= $Page->startDate->getInputTextType() ?>" data-table="sequentialfeed" data-field="x_startDate" name="x_startDate" id="x_startDate" placeholder="<?= HtmlEncode($Page->startDate->getPlaceHolder()) ?>" value="<?= $Page->startDate->EditValue ?>"<?= $Page->startDate->editAttributes() ?> aria-describedby="x_startDate_help">
<?= $Page->startDate->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->startDate->getErrorMessage() ?></div>
<?php if (!$Page->startDate->ReadOnly && !$Page->startDate->Disabled && !isset($Page->startDate->EditAttrs["readonly"]) && !isset($Page->startDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fsequentialfeededit", "datetimepicker"], function() {
    ew.createDateTimePicker("fsequentialfeededit", "x_startDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->endDate->Visible) { // endDate ?>
    <div id="r_endDate" class="form-group row">
        <label id="elh_sequentialfeed_endDate" for="x_endDate" class="<?= $Page->LeftColumnClass ?>"><?= $Page->endDate->caption() ?><?= $Page->endDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->endDate->cellAttributes() ?>>
<span id="el_sequentialfeed_endDate">
<input type="<?= $Page->endDate->getInputTextType() ?>" data-table="sequentialfeed" data-field="x_endDate" name="x_endDate" id="x_endDate" placeholder="<?= HtmlEncode($Page->endDate->getPlaceHolder()) ?>" value="<?= $Page->endDate->EditValue ?>"<?= $Page->endDate->editAttributes() ?> aria-describedby="x_endDate_help">
<?= $Page->endDate->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->endDate->getErrorMessage() ?></div>
<?php if (!$Page->endDate->ReadOnly && !$Page->endDate->Disabled && !isset($Page->endDate->EditAttrs["readonly"]) && !isset($Page->endDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fsequentialfeededit", "datetimepicker"], function() {
    ew.createDateTimePicker("fsequentialfeededit", "x_endDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
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
    ew.addEventHandlers("sequentialfeed");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
