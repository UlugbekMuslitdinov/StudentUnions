<?php

namespace PHPMaker2021\project4;

// Page object
$WebSupportEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fweb_supportedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fweb_supportedit = currentForm = new ew.Form("fweb_supportedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "web_support")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.web_support)
        ew.vars.tables.web_support = currentTable;
    fweb_supportedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["name_first", [fields.name_first.visible && fields.name_first.required ? ew.Validators.required(fields.name_first.caption) : null], fields.name_first.isInvalid],
        ["name_last", [fields.name_last.visible && fields.name_last.required ? ew.Validators.required(fields.name_last.caption) : null], fields.name_last.isInvalid],
        ["_email", [fields._email.visible && fields._email.required ? ew.Validators.required(fields._email.caption) : null], fields._email.isInvalid],
        ["phone", [fields.phone.visible && fields.phone.required ? ew.Validators.required(fields.phone.caption) : null], fields.phone.isInvalid],
        ["url", [fields.url.visible && fields.url.required ? ew.Validators.required(fields.url.caption) : null], fields.url.isInvalid],
        ["web_support", [fields.web_support.visible && fields.web_support.required ? ew.Validators.required(fields.web_support.caption) : null], fields.web_support.isInvalid],
        ["web_support_title", [fields.web_support_title.visible && fields.web_support_title.required ? ew.Validators.required(fields.web_support_title.caption) : null], fields.web_support_title.isInvalid],
        ["urgent", [fields.urgent.visible && fields.urgent.required ? ew.Validators.required(fields.urgent.caption) : null], fields.urgent.isInvalid],
        ["timestamp", [fields.timestamp.visible && fields.timestamp.required ? ew.Validators.required(fields.timestamp.caption) : null, ew.Validators.datetime(0)], fields.timestamp.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fweb_supportedit,
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
    fweb_supportedit.validate = function () {
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
    fweb_supportedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fweb_supportedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fweb_supportedit");
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
<form name="fweb_supportedit" id="fweb_supportedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="web_support">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_web_support_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_web_support_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="web_support" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->name_first->Visible) { // name_first ?>
    <div id="r_name_first" class="form-group row">
        <label id="elh_web_support_name_first" for="x_name_first" class="<?= $Page->LeftColumnClass ?>"><?= $Page->name_first->caption() ?><?= $Page->name_first->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->name_first->cellAttributes() ?>>
<span id="el_web_support_name_first">
<input type="<?= $Page->name_first->getInputTextType() ?>" data-table="web_support" data-field="x_name_first" name="x_name_first" id="x_name_first" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->name_first->getPlaceHolder()) ?>" value="<?= $Page->name_first->EditValue ?>"<?= $Page->name_first->editAttributes() ?> aria-describedby="x_name_first_help">
<?= $Page->name_first->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->name_first->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->name_last->Visible) { // name_last ?>
    <div id="r_name_last" class="form-group row">
        <label id="elh_web_support_name_last" for="x_name_last" class="<?= $Page->LeftColumnClass ?>"><?= $Page->name_last->caption() ?><?= $Page->name_last->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->name_last->cellAttributes() ?>>
<span id="el_web_support_name_last">
<input type="<?= $Page->name_last->getInputTextType() ?>" data-table="web_support" data-field="x_name_last" name="x_name_last" id="x_name_last" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->name_last->getPlaceHolder()) ?>" value="<?= $Page->name_last->EditValue ?>"<?= $Page->name_last->editAttributes() ?> aria-describedby="x_name_last_help">
<?= $Page->name_last->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->name_last->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
    <div id="r__email" class="form-group row">
        <label id="elh_web_support__email" for="x__email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_email->caption() ?><?= $Page->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_email->cellAttributes() ?>>
<span id="el_web_support__email">
<input type="<?= $Page->_email->getInputTextType() ?>" data-table="web_support" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->_email->getPlaceHolder()) ?>" value="<?= $Page->_email->EditValue ?>"<?= $Page->_email->editAttributes() ?> aria-describedby="x__email_help">
<?= $Page->_email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
    <div id="r_phone" class="form-group row">
        <label id="elh_web_support_phone" for="x_phone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->phone->caption() ?><?= $Page->phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->phone->cellAttributes() ?>>
<span id="el_web_support_phone">
<input type="<?= $Page->phone->getInputTextType() ?>" data-table="web_support" data-field="x_phone" name="x_phone" id="x_phone" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->phone->getPlaceHolder()) ?>" value="<?= $Page->phone->EditValue ?>"<?= $Page->phone->editAttributes() ?> aria-describedby="x_phone_help">
<?= $Page->phone->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->phone->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->url->Visible) { // url ?>
    <div id="r_url" class="form-group row">
        <label id="elh_web_support_url" for="x_url" class="<?= $Page->LeftColumnClass ?>"><?= $Page->url->caption() ?><?= $Page->url->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->url->cellAttributes() ?>>
<span id="el_web_support_url">
<input type="<?= $Page->url->getInputTextType() ?>" data-table="web_support" data-field="x_url" name="x_url" id="x_url" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->url->getPlaceHolder()) ?>" value="<?= $Page->url->EditValue ?>"<?= $Page->url->editAttributes() ?> aria-describedby="x_url_help">
<?= $Page->url->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->url->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->web_support->Visible) { // web_support ?>
    <div id="r_web_support" class="form-group row">
        <label id="elh_web_support_web_support" for="x_web_support" class="<?= $Page->LeftColumnClass ?>"><?= $Page->web_support->caption() ?><?= $Page->web_support->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->web_support->cellAttributes() ?>>
<span id="el_web_support_web_support">
<textarea data-table="web_support" data-field="x_web_support" name="x_web_support" id="x_web_support" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->web_support->getPlaceHolder()) ?>"<?= $Page->web_support->editAttributes() ?> aria-describedby="x_web_support_help"><?= $Page->web_support->EditValue ?></textarea>
<?= $Page->web_support->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->web_support->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->web_support_title->Visible) { // web_support_title ?>
    <div id="r_web_support_title" class="form-group row">
        <label id="elh_web_support_web_support_title" for="x_web_support_title" class="<?= $Page->LeftColumnClass ?>"><?= $Page->web_support_title->caption() ?><?= $Page->web_support_title->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->web_support_title->cellAttributes() ?>>
<span id="el_web_support_web_support_title">
<input type="<?= $Page->web_support_title->getInputTextType() ?>" data-table="web_support" data-field="x_web_support_title" name="x_web_support_title" id="x_web_support_title" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->web_support_title->getPlaceHolder()) ?>" value="<?= $Page->web_support_title->EditValue ?>"<?= $Page->web_support_title->editAttributes() ?> aria-describedby="x_web_support_title_help">
<?= $Page->web_support_title->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->web_support_title->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->urgent->Visible) { // urgent ?>
    <div id="r_urgent" class="form-group row">
        <label id="elh_web_support_urgent" for="x_urgent" class="<?= $Page->LeftColumnClass ?>"><?= $Page->urgent->caption() ?><?= $Page->urgent->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->urgent->cellAttributes() ?>>
<span id="el_web_support_urgent">
<input type="<?= $Page->urgent->getInputTextType() ?>" data-table="web_support" data-field="x_urgent" name="x_urgent" id="x_urgent" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->urgent->getPlaceHolder()) ?>" value="<?= $Page->urgent->EditValue ?>"<?= $Page->urgent->editAttributes() ?> aria-describedby="x_urgent_help">
<?= $Page->urgent->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->urgent->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
    <div id="r_timestamp" class="form-group row">
        <label id="elh_web_support_timestamp" for="x_timestamp" class="<?= $Page->LeftColumnClass ?>"><?= $Page->timestamp->caption() ?><?= $Page->timestamp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->timestamp->cellAttributes() ?>>
<span id="el_web_support_timestamp">
<input type="<?= $Page->timestamp->getInputTextType() ?>" data-table="web_support" data-field="x_timestamp" name="x_timestamp" id="x_timestamp" placeholder="<?= HtmlEncode($Page->timestamp->getPlaceHolder()) ?>" value="<?= $Page->timestamp->EditValue ?>"<?= $Page->timestamp->editAttributes() ?> aria-describedby="x_timestamp_help">
<?= $Page->timestamp->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->timestamp->getErrorMessage() ?></div>
<?php if (!$Page->timestamp->ReadOnly && !$Page->timestamp->Disabled && !isset($Page->timestamp->EditAttrs["readonly"]) && !isset($Page->timestamp->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fweb_supportedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fweb_supportedit", "x_timestamp", {"ignoreReadonly":true,"useCurrent":false,"format":0});
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
    ew.addEventHandlers("web_support");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
