<?php

namespace PHPMaker2021\project3;

// Page object
$HistoryEdit = &$Page;
?>
<script>
if (!ew.vars.tables.history) ew.vars.tables.history = <?= JsonEncode(GetClientVar("tables", "history")) ?>;
var currentForm, currentPageID;
var fhistoryedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fhistoryedit = currentForm = new ew.Form("fhistoryedit", "edit");

    // Add fields
    var fields = ew.vars.tables.history.fields;
    fhistoryedit.addFields([
        ["id", [fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["netID", [fields.netID.required ? ew.Validators.required(fields.netID.caption) : null], fields.netID.isInvalid],
        ["_action", [fields._action.required ? ew.Validators.required(fields._action.caption) : null], fields._action.isInvalid],
        ["server", [fields.server.required ? ew.Validators.required(fields.server.caption) : null], fields.server.isInvalid],
        ["_page", [fields._page.required ? ew.Validators.required(fields._page.caption) : null], fields._page.isInvalid],
        ["resourceName", [fields.resourceName.required ? ew.Validators.required(fields.resourceName.caption) : null], fields.resourceName.isInvalid],
        ["filePath", [fields.filePath.required ? ew.Validators.required(fields.filePath.caption) : null], fields.filePath.isInvalid],
        ["site", [fields.site.required ? ew.Validators.required(fields.site.caption) : null], fields.site.isInvalid],
        ["timestamp", [fields.timestamp.required ? ew.Validators.required(fields.timestamp.caption) : null, ew.Validators.integer], fields.timestamp.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fhistoryedit,
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
    fhistoryedit.validate = function () {
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
    fhistoryedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fhistoryedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fhistoryedit");
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
<form name="fhistoryedit" id="fhistoryedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="history">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_history_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_history_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="history" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->netID->Visible) { // netID ?>
    <div id="r_netID" class="form-group row">
        <label id="elh_history_netID" for="x_netID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->netID->caption() ?><?= $Page->netID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->netID->cellAttributes() ?>>
<span id="el_history_netID">
<input type="<?= $Page->netID->getInputTextType() ?>" data-table="history" data-field="x_netID" name="x_netID" id="x_netID" size="30" maxlength="25" placeholder="<?= HtmlEncode($Page->netID->getPlaceHolder()) ?>" value="<?= $Page->netID->EditValue ?>"<?= $Page->netID->editAttributes() ?> aria-describedby="x_netID_help">
<?= $Page->netID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->netID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_action->Visible) { // action ?>
    <div id="r__action" class="form-group row">
        <label id="elh_history__action" for="x__action" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_action->caption() ?><?= $Page->_action->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_action->cellAttributes() ?>>
<span id="el_history__action">
<input type="<?= $Page->_action->getInputTextType() ?>" data-table="history" data-field="x__action" name="x__action" id="x__action" size="30" maxlength="25" placeholder="<?= HtmlEncode($Page->_action->getPlaceHolder()) ?>" value="<?= $Page->_action->EditValue ?>"<?= $Page->_action->editAttributes() ?> aria-describedby="x__action_help">
<?= $Page->_action->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_action->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->server->Visible) { // server ?>
    <div id="r_server" class="form-group row">
        <label id="elh_history_server" for="x_server" class="<?= $Page->LeftColumnClass ?>"><?= $Page->server->caption() ?><?= $Page->server->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->server->cellAttributes() ?>>
<span id="el_history_server">
<input type="<?= $Page->server->getInputTextType() ?>" data-table="history" data-field="x_server" name="x_server" id="x_server" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->server->getPlaceHolder()) ?>" value="<?= $Page->server->EditValue ?>"<?= $Page->server->editAttributes() ?> aria-describedby="x_server_help">
<?= $Page->server->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->server->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_page->Visible) { // page ?>
    <div id="r__page" class="form-group row">
        <label id="elh_history__page" for="x__page" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_page->caption() ?><?= $Page->_page->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_page->cellAttributes() ?>>
<span id="el_history__page">
<input type="<?= $Page->_page->getInputTextType() ?>" data-table="history" data-field="x__page" name="x__page" id="x__page" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->_page->getPlaceHolder()) ?>" value="<?= $Page->_page->EditValue ?>"<?= $Page->_page->editAttributes() ?> aria-describedby="x__page_help">
<?= $Page->_page->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_page->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->resourceName->Visible) { // resourceName ?>
    <div id="r_resourceName" class="form-group row">
        <label id="elh_history_resourceName" for="x_resourceName" class="<?= $Page->LeftColumnClass ?>"><?= $Page->resourceName->caption() ?><?= $Page->resourceName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->resourceName->cellAttributes() ?>>
<span id="el_history_resourceName">
<input type="<?= $Page->resourceName->getInputTextType() ?>" data-table="history" data-field="x_resourceName" name="x_resourceName" id="x_resourceName" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->resourceName->getPlaceHolder()) ?>" value="<?= $Page->resourceName->EditValue ?>"<?= $Page->resourceName->editAttributes() ?> aria-describedby="x_resourceName_help">
<?= $Page->resourceName->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->resourceName->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->filePath->Visible) { // filePath ?>
    <div id="r_filePath" class="form-group row">
        <label id="elh_history_filePath" for="x_filePath" class="<?= $Page->LeftColumnClass ?>"><?= $Page->filePath->caption() ?><?= $Page->filePath->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->filePath->cellAttributes() ?>>
<span id="el_history_filePath">
<input type="<?= $Page->filePath->getInputTextType() ?>" data-table="history" data-field="x_filePath" name="x_filePath" id="x_filePath" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->filePath->getPlaceHolder()) ?>" value="<?= $Page->filePath->EditValue ?>"<?= $Page->filePath->editAttributes() ?> aria-describedby="x_filePath_help">
<?= $Page->filePath->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->filePath->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->site->Visible) { // site ?>
    <div id="r_site" class="form-group row">
        <label id="elh_history_site" for="x_site" class="<?= $Page->LeftColumnClass ?>"><?= $Page->site->caption() ?><?= $Page->site->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->site->cellAttributes() ?>>
<span id="el_history_site">
<input type="<?= $Page->site->getInputTextType() ?>" data-table="history" data-field="x_site" name="x_site" id="x_site" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->site->getPlaceHolder()) ?>" value="<?= $Page->site->EditValue ?>"<?= $Page->site->editAttributes() ?> aria-describedby="x_site_help">
<?= $Page->site->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->site->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
    <div id="r_timestamp" class="form-group row">
        <label id="elh_history_timestamp" for="x_timestamp" class="<?= $Page->LeftColumnClass ?>"><?= $Page->timestamp->caption() ?><?= $Page->timestamp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->timestamp->cellAttributes() ?>>
<span id="el_history_timestamp">
<input type="<?= $Page->timestamp->getInputTextType() ?>" data-table="history" data-field="x_timestamp" name="x_timestamp" id="x_timestamp" size="30" placeholder="<?= HtmlEncode($Page->timestamp->getPlaceHolder()) ?>" value="<?= $Page->timestamp->EditValue ?>"<?= $Page->timestamp->editAttributes() ?> aria-describedby="x_timestamp_help">
<?= $Page->timestamp->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->timestamp->getErrorMessage() ?></div>
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
    ew.addEventHandlers("history");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
