<?php

namespace PHPMaker2021\project1;

// Page object
$AdminRoutesEdit = &$Page;
?>
<script>
if (!ew.vars.tables.admin_routes) ew.vars.tables.admin_routes = <?= JsonEncode(GetClientVar("tables", "admin_routes")) ?>;
var currentForm, currentPageID;
var fadmin_routesedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fadmin_routesedit = currentForm = new ew.Form("fadmin_routesedit", "edit");

    // Add fields
    var fields = ew.vars.tables.admin_routes.fields;
    fadmin_routesedit.addFields([
        ["id", [fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["group_id", [fields.group_id.required ? ew.Validators.required(fields.group_id.caption) : null, ew.Validators.integer], fields.group_id.isInvalid],
        ["title", [fields.title.required ? ew.Validators.required(fields.title.caption) : null], fields.title.isInvalid],
        ["icon", [fields.icon.required ? ew.Validators.required(fields.icon.caption) : null], fields.icon.isInvalid],
        ["url", [fields.url.required ? ew.Validators.required(fields.url.caption) : null], fields.url.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fadmin_routesedit,
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
    fadmin_routesedit.validate = function () {
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
    fadmin_routesedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fadmin_routesedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fadmin_routesedit");
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
<form name="fadmin_routesedit" id="fadmin_routesedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="admin_routes">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_admin_routes_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_admin_routes_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="admin_routes" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->group_id->Visible) { // group_id ?>
    <div id="r_group_id" class="form-group row">
        <label id="elh_admin_routes_group_id" for="x_group_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->group_id->caption() ?><?= $Page->group_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->group_id->cellAttributes() ?>>
<span id="el_admin_routes_group_id">
<input type="<?= $Page->group_id->getInputTextType() ?>" data-table="admin_routes" data-field="x_group_id" name="x_group_id" id="x_group_id" size="30" placeholder="<?= HtmlEncode($Page->group_id->getPlaceHolder()) ?>" value="<?= $Page->group_id->EditValue ?>"<?= $Page->group_id->editAttributes() ?> aria-describedby="x_group_id_help">
<?= $Page->group_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->group_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->title->Visible) { // title ?>
    <div id="r_title" class="form-group row">
        <label id="elh_admin_routes_title" for="x_title" class="<?= $Page->LeftColumnClass ?>"><?= $Page->title->caption() ?><?= $Page->title->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->title->cellAttributes() ?>>
<span id="el_admin_routes_title">
<input type="<?= $Page->title->getInputTextType() ?>" data-table="admin_routes" data-field="x_title" name="x_title" id="x_title" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->title->getPlaceHolder()) ?>" value="<?= $Page->title->EditValue ?>"<?= $Page->title->editAttributes() ?> aria-describedby="x_title_help">
<?= $Page->title->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->title->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->icon->Visible) { // icon ?>
    <div id="r_icon" class="form-group row">
        <label id="elh_admin_routes_icon" for="x_icon" class="<?= $Page->LeftColumnClass ?>"><?= $Page->icon->caption() ?><?= $Page->icon->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->icon->cellAttributes() ?>>
<span id="el_admin_routes_icon">
<input type="<?= $Page->icon->getInputTextType() ?>" data-table="admin_routes" data-field="x_icon" name="x_icon" id="x_icon" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->icon->getPlaceHolder()) ?>" value="<?= $Page->icon->EditValue ?>"<?= $Page->icon->editAttributes() ?> aria-describedby="x_icon_help">
<?= $Page->icon->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->icon->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->url->Visible) { // url ?>
    <div id="r_url" class="form-group row">
        <label id="elh_admin_routes_url" for="x_url" class="<?= $Page->LeftColumnClass ?>"><?= $Page->url->caption() ?><?= $Page->url->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->url->cellAttributes() ?>>
<span id="el_admin_routes_url">
<input type="<?= $Page->url->getInputTextType() ?>" data-table="admin_routes" data-field="x_url" name="x_url" id="x_url" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->url->getPlaceHolder()) ?>" value="<?= $Page->url->EditValue ?>"<?= $Page->url->editAttributes() ?> aria-describedby="x_url_help">
<?= $Page->url->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->url->getErrorMessage() ?></div>
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
    ew.addEventHandlers("admin_routes");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
