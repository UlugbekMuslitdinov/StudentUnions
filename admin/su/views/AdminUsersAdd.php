<?php

namespace PHPMaker2021\project1;

// Page object
$AdminUsersAdd = &$Page;
?>
<script>
if (!ew.vars.tables.admin_users) ew.vars.tables.admin_users = <?= JsonEncode(GetClientVar("tables", "admin_users")) ?>;
var currentForm, currentPageID;
var fadmin_usersadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fadmin_usersadd = currentForm = new ew.Form("fadmin_usersadd", "add");

    // Add fields
    var fields = ew.vars.tables.admin_users.fields;
    fadmin_usersadd.addFields([
        ["unionstaff_id", [fields.unionstaff_id.required ? ew.Validators.required(fields.unionstaff_id.caption) : null, ew.Validators.integer], fields.unionstaff_id.isInvalid],
        ["netid", [fields.netid.required ? ew.Validators.required(fields.netid.caption) : null], fields.netid.isInvalid],
        ["access_level", [fields.access_level.required ? ew.Validators.required(fields.access_level.caption) : null, ew.Validators.integer], fields.access_level.isInvalid],
        ["active", [fields.active.required ? ew.Validators.required(fields.active.caption) : null, ew.Validators.integer], fields.active.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fadmin_usersadd,
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
    fadmin_usersadd.validate = function () {
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
    fadmin_usersadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fadmin_usersadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fadmin_usersadd");
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
<form name="fadmin_usersadd" id="fadmin_usersadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="admin_users">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->unionstaff_id->Visible) { // unionstaff_id ?>
    <div id="r_unionstaff_id" class="form-group row">
        <label id="elh_admin_users_unionstaff_id" for="x_unionstaff_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->unionstaff_id->caption() ?><?= $Page->unionstaff_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->unionstaff_id->cellAttributes() ?>>
<span id="el_admin_users_unionstaff_id">
<input type="<?= $Page->unionstaff_id->getInputTextType() ?>" data-table="admin_users" data-field="x_unionstaff_id" name="x_unionstaff_id" id="x_unionstaff_id" size="30" placeholder="<?= HtmlEncode($Page->unionstaff_id->getPlaceHolder()) ?>" value="<?= $Page->unionstaff_id->EditValue ?>"<?= $Page->unionstaff_id->editAttributes() ?> aria-describedby="x_unionstaff_id_help">
<?= $Page->unionstaff_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->unionstaff_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->netid->Visible) { // netid ?>
    <div id="r_netid" class="form-group row">
        <label id="elh_admin_users_netid" for="x_netid" class="<?= $Page->LeftColumnClass ?>"><?= $Page->netid->caption() ?><?= $Page->netid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->netid->cellAttributes() ?>>
<span id="el_admin_users_netid">
<input type="<?= $Page->netid->getInputTextType() ?>" data-table="admin_users" data-field="x_netid" name="x_netid" id="x_netid" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->netid->getPlaceHolder()) ?>" value="<?= $Page->netid->EditValue ?>"<?= $Page->netid->editAttributes() ?> aria-describedby="x_netid_help">
<?= $Page->netid->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->netid->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->access_level->Visible) { // access_level ?>
    <div id="r_access_level" class="form-group row">
        <label id="elh_admin_users_access_level" for="x_access_level" class="<?= $Page->LeftColumnClass ?>"><?= $Page->access_level->caption() ?><?= $Page->access_level->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->access_level->cellAttributes() ?>>
<span id="el_admin_users_access_level">
<input type="<?= $Page->access_level->getInputTextType() ?>" data-table="admin_users" data-field="x_access_level" name="x_access_level" id="x_access_level" size="30" placeholder="<?= HtmlEncode($Page->access_level->getPlaceHolder()) ?>" value="<?= $Page->access_level->EditValue ?>"<?= $Page->access_level->editAttributes() ?> aria-describedby="x_access_level_help">
<?= $Page->access_level->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->access_level->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->active->Visible) { // active ?>
    <div id="r_active" class="form-group row">
        <label id="elh_admin_users_active" for="x_active" class="<?= $Page->LeftColumnClass ?>"><?= $Page->active->caption() ?><?= $Page->active->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->active->cellAttributes() ?>>
<span id="el_admin_users_active">
<input type="<?= $Page->active->getInputTextType() ?>" data-table="admin_users" data-field="x_active" name="x_active" id="x_active" size="30" placeholder="<?= HtmlEncode($Page->active->getPlaceHolder()) ?>" value="<?= $Page->active->EditValue ?>"<?= $Page->active->editAttributes() ?> aria-describedby="x_active_help">
<?= $Page->active->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->active->getErrorMessage() ?></div>
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
    ew.addEventHandlers("admin_users");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
