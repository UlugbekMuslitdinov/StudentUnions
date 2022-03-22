<?php

namespace PHPMaker2021\project4;

// Page object
$WebSupportFilesEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fweb_support_filesedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fweb_support_filesedit = currentForm = new ew.Form("fweb_support_filesedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "web_support_files")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.web_support_files)
        ew.vars.tables.web_support_files = currentTable;
    fweb_support_filesedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["ws_id", [fields.ws_id.visible && fields.ws_id.required ? ew.Validators.required(fields.ws_id.caption) : null, ew.Validators.integer], fields.ws_id.isInvalid],
        ["file_path", [fields.file_path.visible && fields.file_path.required ? ew.Validators.required(fields.file_path.caption) : null], fields.file_path.isInvalid],
        ["original_filename", [fields.original_filename.visible && fields.original_filename.required ? ew.Validators.required(fields.original_filename.caption) : null], fields.original_filename.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fweb_support_filesedit,
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
    fweb_support_filesedit.validate = function () {
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
    fweb_support_filesedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fweb_support_filesedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fweb_support_filesedit");
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
<form name="fweb_support_filesedit" id="fweb_support_filesedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="web_support_files">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_web_support_files_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_web_support_files_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="web_support_files" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ws_id->Visible) { // ws_id ?>
    <div id="r_ws_id" class="form-group row">
        <label id="elh_web_support_files_ws_id" for="x_ws_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ws_id->caption() ?><?= $Page->ws_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ws_id->cellAttributes() ?>>
<span id="el_web_support_files_ws_id">
<input type="<?= $Page->ws_id->getInputTextType() ?>" data-table="web_support_files" data-field="x_ws_id" name="x_ws_id" id="x_ws_id" size="30" placeholder="<?= HtmlEncode($Page->ws_id->getPlaceHolder()) ?>" value="<?= $Page->ws_id->EditValue ?>"<?= $Page->ws_id->editAttributes() ?> aria-describedby="x_ws_id_help">
<?= $Page->ws_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ws_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->file_path->Visible) { // file_path ?>
    <div id="r_file_path" class="form-group row">
        <label id="elh_web_support_files_file_path" for="x_file_path" class="<?= $Page->LeftColumnClass ?>"><?= $Page->file_path->caption() ?><?= $Page->file_path->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->file_path->cellAttributes() ?>>
<span id="el_web_support_files_file_path">
<input type="<?= $Page->file_path->getInputTextType() ?>" data-table="web_support_files" data-field="x_file_path" name="x_file_path" id="x_file_path" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->file_path->getPlaceHolder()) ?>" value="<?= $Page->file_path->EditValue ?>"<?= $Page->file_path->editAttributes() ?> aria-describedby="x_file_path_help">
<?= $Page->file_path->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->file_path->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->original_filename->Visible) { // original_filename ?>
    <div id="r_original_filename" class="form-group row">
        <label id="elh_web_support_files_original_filename" for="x_original_filename" class="<?= $Page->LeftColumnClass ?>"><?= $Page->original_filename->caption() ?><?= $Page->original_filename->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->original_filename->cellAttributes() ?>>
<span id="el_web_support_files_original_filename">
<input type="<?= $Page->original_filename->getInputTextType() ?>" data-table="web_support_files" data-field="x_original_filename" name="x_original_filename" id="x_original_filename" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->original_filename->getPlaceHolder()) ?>" value="<?= $Page->original_filename->EditValue ?>"<?= $Page->original_filename->editAttributes() ?> aria-describedby="x_original_filename_help">
<?= $Page->original_filename->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->original_filename->getErrorMessage() ?></div>
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
    ew.addEventHandlers("web_support_files");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
