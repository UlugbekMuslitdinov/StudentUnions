<?php

namespace PHPMaker2022\project2;

// Page object
$GroupsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { groups: currentTable } });
var currentForm, currentPageID;
var fgroupsadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fgroupsadd = new ew.Form("fgroupsadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fgroupsadd;

    // Add fields
    var fields = currentTable.fields;
    fgroupsadd.addFields([
        ["group_name", [fields.group_name.visible && fields.group_name.required ? ew.Validators.required(fields.group_name.caption) : null], fields.group_name.isInvalid],
        ["active", [fields.active.visible && fields.active.required ? ew.Validators.required(fields.active.caption) : null], fields.active.isInvalid],
        ["group_key", [fields.group_key.visible && fields.group_key.required ? ew.Validators.required(fields.group_key.caption) : null], fields.group_key.isInvalid]
    ]);

    // Form_CustomValidate
    fgroupsadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fgroupsadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fgroupsadd");
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
<form name="fgroupsadd" id="fgroupsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="groups">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->group_name->Visible) { // group_name ?>
    <div id="r_group_name"<?= $Page->group_name->rowAttributes() ?>>
        <label id="elh_groups_group_name" for="x_group_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->group_name->caption() ?><?= $Page->group_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->group_name->cellAttributes() ?>>
<span id="el_groups_group_name">
<input type="<?= $Page->group_name->getInputTextType() ?>" name="x_group_name" id="x_group_name" data-table="groups" data-field="x_group_name" value="<?= $Page->group_name->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->group_name->getPlaceHolder()) ?>"<?= $Page->group_name->editAttributes() ?> aria-describedby="x_group_name_help">
<?= $Page->group_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->group_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->active->Visible) { // active ?>
    <div id="r_active"<?= $Page->active->rowAttributes() ?>>
        <label id="elh_groups_active" for="x_active" class="<?= $Page->LeftColumnClass ?>"><?= $Page->active->caption() ?><?= $Page->active->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->active->cellAttributes() ?>>
<span id="el_groups_active">
<input type="<?= $Page->active->getInputTextType() ?>" name="x_active" id="x_active" data-table="groups" data-field="x_active" value="<?= $Page->active->EditValue ?>" size="30" maxlength="8" placeholder="<?= HtmlEncode($Page->active->getPlaceHolder()) ?>"<?= $Page->active->editAttributes() ?> aria-describedby="x_active_help">
<?= $Page->active->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->active->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->group_key->Visible) { // group_key ?>
    <div id="r_group_key"<?= $Page->group_key->rowAttributes() ?>>
        <label id="elh_groups_group_key" for="x_group_key" class="<?= $Page->LeftColumnClass ?>"><?= $Page->group_key->caption() ?><?= $Page->group_key->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->group_key->cellAttributes() ?>>
<span id="el_groups_group_key">
<input type="<?= $Page->group_key->getInputTextType() ?>" name="x_group_key" id="x_group_key" data-table="groups" data-field="x_group_key" value="<?= $Page->group_key->EditValue ?>" size="30" maxlength="64" placeholder="<?= HtmlEncode($Page->group_key->getPlaceHolder()) ?>"<?= $Page->group_key->editAttributes() ?> aria-describedby="x_group_key_help">
<?= $Page->group_key->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->group_key->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .row -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("groups");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
