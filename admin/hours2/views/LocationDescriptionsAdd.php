<?php

namespace PHPMaker2021\project2;

// Page object
$LocationDescriptionsAdd = &$Page;
?>
<script>
if (!ew.vars.tables.location_descriptions) ew.vars.tables.location_descriptions = <?= JsonEncode(GetClientVar("tables", "location_descriptions")) ?>;
var currentForm, currentPageID;
var flocation_descriptionsadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    flocation_descriptionsadd = currentForm = new ew.Form("flocation_descriptionsadd", "add");

    // Add fields
    var fields = ew.vars.tables.location_descriptions.fields;
    flocation_descriptionsadd.addFields([
        ["location_id", [fields.location_id.required ? ew.Validators.required(fields.location_id.caption) : null, ew.Validators.integer], fields.location_id.isInvalid],
        ["short", [fields.short.required ? ew.Validators.required(fields.short.caption) : null], fields.short.isInvalid],
        ["long", [fields.long.required ? ew.Validators.required(fields.long.caption) : null], fields.long.isInvalid],
        ["hours_message", [fields.hours_message.required ? ew.Validators.required(fields.hours_message.caption) : null], fields.hours_message.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = flocation_descriptionsadd,
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
    flocation_descriptionsadd.validate = function () {
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
    flocation_descriptionsadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    flocation_descriptionsadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("flocation_descriptionsadd");
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
<form name="flocation_descriptionsadd" id="flocation_descriptionsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="location_descriptions">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->location_id->Visible) { // location_id ?>
    <div id="r_location_id" class="form-group row">
        <label id="elh_location_descriptions_location_id" for="x_location_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->location_id->caption() ?><?= $Page->location_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->location_id->cellAttributes() ?>>
<span id="el_location_descriptions_location_id">
<input type="<?= $Page->location_id->getInputTextType() ?>" data-table="location_descriptions" data-field="x_location_id" name="x_location_id" id="x_location_id" size="30" placeholder="<?= HtmlEncode($Page->location_id->getPlaceHolder()) ?>" value="<?= $Page->location_id->EditValue ?>"<?= $Page->location_id->editAttributes() ?> aria-describedby="x_location_id_help">
<?= $Page->location_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->location_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->short->Visible) { // short ?>
    <div id="r_short" class="form-group row">
        <label id="elh_location_descriptions_short" for="x_short" class="<?= $Page->LeftColumnClass ?>"><?= $Page->short->caption() ?><?= $Page->short->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->short->cellAttributes() ?>>
<span id="el_location_descriptions_short">
<textarea data-table="location_descriptions" data-field="x_short" name="x_short" id="x_short" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->short->getPlaceHolder()) ?>"<?= $Page->short->editAttributes() ?> aria-describedby="x_short_help"><?= $Page->short->EditValue ?></textarea>
<?= $Page->short->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->short->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->long->Visible) { // long ?>
    <div id="r_long" class="form-group row">
        <label id="elh_location_descriptions_long" for="x_long" class="<?= $Page->LeftColumnClass ?>"><?= $Page->long->caption() ?><?= $Page->long->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->long->cellAttributes() ?>>
<span id="el_location_descriptions_long">
<textarea data-table="location_descriptions" data-field="x_long" name="x_long" id="x_long" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->long->getPlaceHolder()) ?>"<?= $Page->long->editAttributes() ?> aria-describedby="x_long_help"><?= $Page->long->EditValue ?></textarea>
<?= $Page->long->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->long->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->hours_message->Visible) { // hours_message ?>
    <div id="r_hours_message" class="form-group row">
        <label id="elh_location_descriptions_hours_message" for="x_hours_message" class="<?= $Page->LeftColumnClass ?>"><?= $Page->hours_message->caption() ?><?= $Page->hours_message->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->hours_message->cellAttributes() ?>>
<span id="el_location_descriptions_hours_message">
<textarea data-table="location_descriptions" data-field="x_hours_message" name="x_hours_message" id="x_hours_message" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->hours_message->getPlaceHolder()) ?>"<?= $Page->hours_message->editAttributes() ?> aria-describedby="x_hours_message_help"><?= $Page->hours_message->EditValue ?></textarea>
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
    ew.addEventHandlers("location_descriptions");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
